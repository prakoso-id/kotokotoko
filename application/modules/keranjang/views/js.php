<script type="text/javascript">
	$(document).ready(function() {
		load_data_keranjang();
	});

	function stopp(callback, ms) {
		var timer = 0;
		return function() {
			var context = this, args = arguments;
			clearTimeout(timer);
			timer = setTimeout(function () {
				callback.apply(context, args);
			}, ms || 0);
		};
	}

	function load_data_keranjang(){
		$("#loading").show();
		$.ajax({
			url : "<?php echo base_url('keranjang/ajax_list')?>",
			async:false,
			type: "POST",
			data : {
				<?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>',
			},
			dataType: "JSON",
			success: function(data){
				$("#loading").hide();
				if (data.status) {
					$('.data_keranjang').html(DOMPurify.sanitize( data.data, { SAFE_FOR_JQUERY: true } ));

					hitungTotal();

					$("#cek_all").click(function(){ // Ketika user men-cek checkbox all      
					  if($(this).is(":checked")){ // Jika checkbox all diceklis        
					    $(".check-item").prop("checked", true); // ceklis semua checkbox
					    $(".check-umkm-all").prop("checked", true);
					    update_checked_multiple("checked");    
					  }else{ // Jika checkbox all tidak diceklis        
					    $(".check-item").prop("checked", false); // un-ceklis semua checkbox 
					    $(".check-umkm-all").prop("checked", false);
					    update_checked_multiple("unchecked"); 
					  }
					});

					$(".check-umkm-all").click(function(){ // Ketika user men-cek checkbox all  
					  var id_umkm = $(this).attr('data-id');   
					  if($(this).is(":checked")){ // Jika checkbox all diceklis        
					    $(".chek-item-umkm-"+id_umkm).prop("checked", true); // ceklis semua checkbox

					    var array_values = [];
						$('.chek-item-umkm-'+id_umkm).each( function() {
						    if( $(this).is(':checked') ) {
						        array_values.push( $(this).val() );
						    }
						});

					    update_checked_multiple_umkm("checked",id_umkm,array_values);    
					  }else{ // Jika checkbox all tidak diceklis
					  	var array_values = [];
						$('.chek-item-umkm-'+id_umkm).each( function() {
						    if( $(this).is(':checked') ) {
						        array_values.push( $(this).val() );
						    }
						});

					    $(".chek-item-umkm-"+id_umkm).prop("checked", false); // un-ceklis semua checkbox 
					    update_checked_multiple_umkm("unchecked",id_umkm,array_values); 
					  }
					});


					$('.check-item').click(function() {
						var id_produk = $(this).val();
						if($(this).is(":checked")){
							update_checked(id_produk,'checked');
						}else{
							update_checked(id_produk,'unchecked');
						}
					});

					$('.btn_del_all').click(function() {
						checked = $(".check-item:checked").length;
						if(!checked) {
						    Swal.fire({type: 'warning',title: 'Peringatan',text: 'Silhakan pilih salah satu produk untuk dihapus !'});
						    return false;
						}else{
							del_multiple_cart();
						}
					});

					$('.love-produk').click(function() {
						var id_produk = $(this).data("id");
						wishlist(id_produk);
					});

					$('.hapus-produk').click(function() {
						var id_produk = $(this).data("id");
						del_cart(id_produk);
					});

					$('.btn-number').click(function(e){
				    e.preventDefault();
				    
					    fieldName = $(this).attr('data-field');
					    type      = $(this).attr('data-type');
					    idx 	  = $(this).attr('data-i');
					    var input = $("#"+fieldName+"");
					    var id_keranjang = input.attr('data-id_keranjang');
					    var id_produk = input.attr('data-id_produk');
					    var currentVal = parseInt(input.val());
					    var harga = $("#harga_"+idx).val();
					    var diskon = $("#diskon_"+idx).val();

					    if (!isNaN(currentVal)) {
					        if(type == 'minus') {
					            if(currentVal > input.attr('min')) {
					            	var jum_akhir = currentVal - 1;
					                update_quantity(jum_akhir,id_keranjang,id_produk);
				                	input.val(jum_akhir).change();
				                	var sub_total = jum_akhir * (harga - diskon);
									$('#sub_total_harga_'+idx).val(sub_total);
									var diskon_total = jum_akhir * diskon;
									$('#jumlah_diskon_'+idx).val(diskon_total);
									hitungTotal();
									$('#notif_cart_qty_' + idx).text('( x ' + jum_akhir + ')');
					            } 
					            if(parseInt(input.val()) == input.attr('min')) {
					                $(this).attr('disabled', true);
					                Toast.fire({type : 'warning',title: '',text: 'Maaf minimal pembelian produk adalah 1 pcs.'});
					            }else{
					            	$(".btn-number[data-type='plus'][data-field='"+fieldName+"']").removeAttr('disabled');
					            }
					        } else if(type == 'plus') {
					            if(currentVal < input.attr('max')) {
					            	var jum_akhir = currentVal + 1;
					                update_quantity(jum_akhir,id_keranjang,id_produk);
				                	input.val(jum_akhir).change();
				                	var sub_total = jum_akhir * (harga - diskon);
									$('#sub_total_harga_'+idx).val(sub_total);
									var diskon_total = jum_akhir * diskon;
									$('#jumlah_diskon_'+idx).val(diskon_total);
									hitungTotal();
									$('#notif_cart_qty_' + idx).text('( x ' + jum_akhir + ')');
					            }
					            if(parseInt(input.val()) == input.attr('max')) {
					                $(this).attr('disabled', true);
					                Toast.fire({type : 'warning',title: '',text: 'Maaf stok barang yang tersedia tinggal '+input.attr('max')+' pcs. Anda tidak dapat menambahkannya lagi ke dalam keranjang !'});
					            }else{
					            	$(".btn-number[data-type='minus'][data-field='"+fieldName+"']").removeAttr('disabled');
					            }
					        }
					    } else {
					        input.val(0);
					    }
					});

					$('.input-number').focusin(function(){
					   $(this).data('oldValue', $(this).val());
					});

					$('.input-number').keyup(stopp(function() {
					    
					    minValue =  parseInt($(this).attr('min'));
					    maxValue =  parseInt($(this).attr('max'));
					    valueCurrent = parseInt($(this).val());
					    name = $(this).attr('name');
					    idx  = $(this).attr('data-i');

						$('#notif_cart_qty_' + idx).text('( x ' + valueCurrent + ')');

					    var id_keranjang = $(this).attr('data-id_keranjang');
					    var id_produk = $(this).attr('data-id_produk');
						var harga = $("#harga_"+idx).val();
						var diskon = $("#diskon_"+idx).val();

						if (valueCurrent >= minValue && valueCurrent <= maxValue) {
					        $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled');
					        $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled');

						    update_quantity(valueCurrent,id_keranjang,id_produk);
				        	var sub_total = valueCurrent * (harga - diskon);
							$('#sub_total_harga_'+idx).val(sub_total);
							var diskon_total = valueCurrent * diskon;
							$('#jumlah_diskon_'+idx).val(diskon_total);
							hitungTotal();
						}else{
							if (valueCurrent < minValue) {
								Toast.fire({type : 'warning',title: '',text: 'Maaf minimal pembelian produk adalah 1 pcs.'});
						    	$(this).val($(this).data('oldValue'));
							}
							if (valueCurrent > maxValue) {
								Toast.fire({type : 'warning',title: '',text: 'Maaf stok barang yang tersedia tinggal '+maxValue+' pcs. Anda tidak dapat menambahkannya lagi ke dalam keranjang !'});
					        	$(this).val($(this).data('oldValue'));
							}
						}
					}, 500));

					$(".input-number").keydown(function (e) {
					    // Allow: backspace, delete, tab, escape, enter and .
					    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
					         // Allow: Ctrl+A
					        (e.keyCode == 65 && e.ctrlKey === true) || 
					         // Allow: home, end, left, right
					        (e.keyCode >= 35 && e.keyCode <= 39)) {
					             // let it happen, don't do anything
					             return;
					    }
					    // Ensure that it is a number and stop the keypress
					    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
					        e.preventDefault();
					    }
					});
				}
			},
			error: function (jqXHR, textStatus, errorThrown){
				$("#loading").hide();
				alert('Error get data from ajax');
			}
		});
	}

	function update_checked_multiple(status){
		$.ajax({
			url : "<?php echo base_url('ajax/ajax_ubah')?>",
			type: "POST",
			async:false,
			data : {
				status : status,
				type : 'update_checked_multiple',
				<?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>',
			},
			dataType: "JSON",
			success: function(data){
				if (!data.status && !data.login) {
					alert_login();
				}else{
					hitungTotal();
				}
			},
			error: function (jqXHR, textStatus, errorThrown){
				alert('Error get data from ajax');
			}
		});
	}

	function update_checked_multiple_umkm(status,id_umkm,arr_id_produk=null){
		if (arr_id_produk.length == 0) {
			Toast.fire({type : 'warning',title: 'Perhatian',text: 'Tidak bisa memilih item !'});
			$('#check_umkm_'+id_umkm).prop('checked', false);
			return false;
		}

		$.ajax({
			url : "<?php echo base_url('ajax/ajax_ubah')?>",
			type: "POST",
			async:false,
			data : {
				status : status,
				id_produk : arr_id_produk,
				type : 'update_checked_multiple_umkm',
				<?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>',
			},
			dataType: "JSON",
			success: function(data){
				if (data.status) {
					hitungTotal();
				}else{
					if (data.login) {
						Toast.fire({type : 'error',title: 'Error',text: 'Terjadi kesalahan'});
					}else{
						alert_login();
					}
				}
			},
			error: function (jqXHR, textStatus, errorThrown){
				alert('Error get data from ajax');
			}
		});
	}

	function update_checked(id_produk,status){
		$.ajax({
			url : "<?php echo base_url('ajax/ajax_ubah')?>",
			type: "POST",
			async:false,
			data : {
				id : id_produk,
				status : status,
				type : 'update_checked',
				<?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>',
			},
			dataType: "JSON",
			success: function(data){
				if (!data.status && !data.login) {
					alert_login();
				}else{
					hitungTotal();
				}
			},
			error: function (jqXHR, textStatus, errorThrown){
				alert('Error get data from ajax');
			}
		});
	}

	function del_multiple_cart(){
		Swal.fire({
            title: 'Konfirmasi Hapus',
            text: "Apakah anda yakin ingin menghapus produk yang terpilih dari keranjang ? "+checked+" item produk terpilih.",
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak',
        }).then((result) => {
            if (result.value) {
            	$("#loading").show();

            	//creat array item checked
            	var array_values = [];
				$('.check-item').each( function() {
				    if( $(this).is(':checked') ) {
				        array_values.push( $(this).val() );
				    }
				});

            	$.ajax({ 
	            	url : "<?php echo base_url('ajax/ajax_ubah')?>",
			        type: "POST",
			        async:false,
			        data: {
			        	type : 'delete_multiple_cart',
			        	id : array_values,
			        	<?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>', 
			        },
			        dataType: "JSON",
			        async: false,
			        success: function(data){
			        	$("#loading").hide();
			        	if (data.status) {
			        		Toast.fire({type : 'success',title: 'Sukses',text: 'Produk berhasil dihapus dari keranjang'});
			        		load_data_keranjang();

			        		$('.check-item').each( function() {
							    if( $(this).is(':checked') ) {
							    	$('.mini-products-list > .'+$(this).val()).remove();
							    }
							});

							var jumlah_sekarang = $('[name="jumlah_keranjang"]').val();
							var jumlah_dihapus = checked;
							var jumlah_akhir = parseInt(jumlah_sekarang) - parseInt(jumlah_dihapus);
							$('[name="jumlah_keranjang"]').val(jumlah_akhir);
							$('.jumlah_keranjang').text(jumlah_akhir);
			        	}else{
			        		if (data.login) {
			        			Toast.fire({type : 'error',title: 'Error',text: 'Produk gagal dihapus dari keranjang'});
			        		}else{
			        			alert_login();
			        		}
			        	}
					},
	        		error: function (jqXHR, textStatus, errorThrown){
	        			$("#loading").hide();
	        			alert('Error get data from ajax');
	        		}
				});
            }else{
                return false;
            }
        })
	}

	function update_quantity(jum,id_keranjang,id_produk){
		$.ajax({
			url : "<?php echo base_url('ajax/ajax_ubah')?>",
			type: "POST",
			async:false,
			data : {
				jumlah : jum,
				id_keranjang : id_keranjang,
				id_produk : id_produk,
				type : 'quantity',
				<?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
			},
			dataType: "JSON",
			success: function(data){
				if (data.status) {
				
				}else{
					if (data.login) {
						Toast.fire({type : 'warning',title: 'Peringatan',text: data.message});
					}else{
						alert_login();
					}
				}

				returnValue = data.status;
			},
			error: function (jqXHR, textStatus, errorThrown){
				alert('Error get data from ajax');
				returnValue = false;
			}
		});

		return returnValue;
	}

	function alert_login(){
		swal.fire({
            title: "Perhatian",
            text: "Maaf session anda habis, harap login ulang terlebih dahulu !",
            type: "warning",
            confirmButtonText: "Login"
        }).then((result) => {
            if (result.value) {
                window.location.href = "<?php echo base_url('login'); ?>";
            }
        });
	}

	function hitungTotal(){
		var data = 0;
		var diskon = 0;
		var qty = 0;
		var unchecked = 0;
		var over_order = 0;
		$('.check-item').each( function() {
			var idx = $(this).attr("data-i");
			var id_umkm = $(this).attr("data-id_umkm");
			var input_qty = $('#data_quantity_'+idx).val();
			var max_beli = $('#data_quantity_'+idx).attr('max');

		    if( $(this).is(':checked') ) {
		    	data = data + parseInt($('#sub_total_harga_'+idx).val());
		    	diskon = diskon + parseInt($('#jumlah_diskon_'+idx).val());
		    	qty = qty + parseInt($('#data_quantity_'+idx).val());
		    	if (parseInt(input_qty) > parseInt(max_beli)) {
		    		over_order = 1;
		    	}
		    }else{
		    	unchecked = 1;
		    }
		});

		if (unchecked == 1) {
			$('#cek_all').prop('checked', false);
		}else{
			$('#cek_all').prop('checked', true);
		}

		
		$('.check-umkm-all').each( function() {
			id_umkm = $(this).attr('data-id');
			unchecked_umkm = 0;
			if ($('.chek-item-umkm-'+id_umkm).length > 0) {
				$('.chek-item-umkm-'+id_umkm).each( function() {
					if ($(this).is(':checked')) {

					}else{
						unchecked_umkm = 1;
					}
				});

				if (unchecked_umkm == 1) {
					$('#check_umkm_'+id_umkm).prop('checked', false);
				}else{
					$('#check_umkm_'+id_umkm).prop('checked', true);
				}
			}else{
				$('#check_umkm_'+id_umkm).prop('checked', false);
			}
		});

		$('.total_quantity').text('('+qty+')');
		$('.total_harga').text("Rp. "+rp(data));
		$('.total_diskon').text("Rp. "+rp(diskon));
		$('[name=jumlah_diskon]').val(diskon);
		$('[name="total_harga"]').val(data);
		if(data == 0 || over_order == 1){
			$('.btn-checkout').attr('disabled','true');
			$('.btn-checkout').removeClass('btn-gradient');
		}else{
			$('.btn-checkout').addClass('btn-gradient');
			$('.btn-checkout').removeAttr('disabled');
		}

		if (diskon > 0) {
			$('.order-diskon').show();
		} else {
			$('.order-diskon').hide();
		}
	}

	function rp(bilangan){
        if(bilangan != null){
            var number_string = bilangan.toString(),
            sisa    = number_string.length % 3,
            rupiah  = number_string.substr(0, sisa),
            ribuan  = number_string.substr(sisa).match(/\d{3}/g);
                
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
        }else{
            rupiah = '';
        }

        return rupiah;
    }
</script>