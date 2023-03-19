<script type="text/javascript">
	var keranjang = '<?php echo json_encode($detail_bayar['data'],JSON_UNESCAPED_SLASHES); ?>';
	var arr_keranjang = JSON.parse(keranjang);

	$.ajax({
		url : "<?php echo base_url('ajax/ajax_data/')?>",
		type: "POST",
		data : {
			type : 'data_alamat',
			<?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>',
		},
		dataType: "html",
		success: function(data){
			$('.nama_alamat').html(DOMPurify.sanitize( data, { SAFE_FOR_JQUERY: true } ));
		},
		error: function (jqXHR, textStatus, errorThrown){
			alert('Error get data from ajax');
		}
	});
	function pilih_alamat()
	{
		$('#modal_alamat .modal-title').text('Data Alamat');
		$('#modal_alamat').modal('show');
		$('#modal_alamat .table_alamat').html('');	
		$('#modal_alamat .table_alamat').load('<?php echo base_url('ajax/table_alamat');?>/', function(data, status) 
	        {
	            //$("#loading-overlay").hide();         
	        }
	    );
	}

	function proses(){

    	$('#proses_data').text('sedang memproses...'); //change button text
    	$('#proses_data').attr('disabled',true); //set button disable
    	$('.form-group').removeClass('has-error');
    	$('.help').empty();
				
		var form = $('#checkout-form')[0];
		var data = new FormData(form);

		var url = '<?php echo base_url("ajax/ajax_save"); ?>';

		swal.fire({
			text: "Apakah Data yang dimasukkan sudah benar?",
			title: "",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#2196F3",
			confirmButtonText: "Simpan",
			cancelButtonText: "Tidak",
			closeOnConfirm: false,
			closeOnCancel: true
		}).then((result) => {
			
			if (result.value) {
				$('.confirm').text('sedang memproses...'); //change button text
				$('.confirm').attr('disabled',true); //set button disable

				$.ajax({
					url: url,
					type: 'post',
					data: data,
					processData:false,
					contentType:false,
					cache:false,
					beforeSend: function() {
		                $("#loading").show();  
		            },
					success: function (res) {
						var obj = JSON.parse(res);
						if(obj.status)
						{
							if (obj.success !== true) {
								swal.fire({
									text: obj.message,
									title: "",
									type: "error",
									button: true,
									timer: 1000
								});
								
							}
							else {
								swal.fire({
									text: obj.message,
									title: "",
									type: "success",
									button: true,
								}).then((result) => {
									if (result.value) {
										window.location.href = "<?php echo base_url('transaksi/customer'); ?>";
									}
								});
							}
							$('#proses_data').text('Proses'); //change button text
	        				$('#proses_data').attr('disabled',false); //set button enable
						}
						else {
							for (var i = 0; i < obj.inputerror.length; i++) 
							{
								$('[name="'+obj.inputerror[i]+'"]').parent().parent().addClass('has-error');
								$('[name="'+obj.inputerror[i]+'"]').next().text(obj.error_string[i]); 
							}
							swal.fire({
	                            type: 'error',
	                            text: 'Proses Simpan Gagal, Silahkan Melengkapi Data Yang Harus Diisi',
	                            title : '',
	                            button: true,
	                            timer: 3000
	                        });
							$('#proses_data').text('Proses'); //change button text
	        				$('#proses_data').attr('disabled',false); //set button enable
						}
					},complete: function(){
						$("#loading").fadeOut("fast");
					}
				});
			}else{
				
				$('.confirm').text('Proses'); //change button text
				$('.confirm').attr('disabled',false); //set button disable'

				$('#proses_data').text('Proses'); //change button text
	        	$('#proses_data').attr('disabled',false); //set button enable
			}

		});
	}

	function get_ongkir(id_umkm){
		var id_alamat = $('#id_alamat').val();
		var id_kurir = $('#id_kurir_'+id_umkm).val();
		if (!id_alamat) {
			swal.fire({
                type: 'warning',
                text: 'Silahkan pilih alamat pengiriman terlebih dahulu !',
                title : 'Peringatan',
            });

            $('#id_kurir_'+id_umkm).val('');
            $('#kurir_service_'+id_umkm).html('<option value="">--Pilih Service--</option>');
            hitung_total_checkout();
		}else if(id_kurir == ''){
			$('.sub_total_ongkir_umkm_'+id_umkm).text(rp(0));
			$('#sub_total_ongkir_umkm_'+id_umkm).val('');
			$('#kurir_service_'+id_umkm).html('<option value="">--Pilih Service--</option>');
			hitung_total_checkout();
		}else{
			$("#loading").show();
			$('#kurir_service_'+id_umkm).html('<option value="">--Pilih Service--</option>');
			$.ajax({
				url : "<?php echo base_url('ajax/ajax_data/')?>",
				type: "POST",
				data : {
					type : 'data_ongkir',
					id_alamat : id_alamat,
					no_kel : $('#id_kel').val(),
					no_kec : $('#id_kec').val(),
					no_kab : $('#id_kab').val(),
					no_prop : $('#id_prop').val(),
					id_kurir : id_kurir,
					berat : $('#sub_total_berat_barang_umkm_'+id_umkm).val(),
					no_kel_umkm : $('#id_kel_umkm_'+id_umkm).val(),
					no_kec_umkm : $('#id_kec_umkm_'+id_umkm).val(),
					no_kab_umkm : $('#no_kab_umkm_'+id_umkm).val(),
					no_prop_umkm : $('#no_prop_umkm_'+id_umkm).val(),
					<?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>',
				},
				dataType: "json",
				success: function(data){
					$("#loading").hide(); 
					if (data.status) {
						$('#kurir_service_'+id_umkm).html(DOMPurify.sanitize( data.service_option, { SAFE_FOR_JQUERY: true } ));
						$('.sub_total_ongkir_umkm_'+id_umkm).text(rp(0));
						$('#sub_total_ongkir_umkm_'+id_umkm).val('');
						hitung_total_checkout();
					}else{
						$('#id_kurir_'+id_umkm).val('');
						$('.sub_total_ongkir_umkm_'+id_umkm).text(rp(0));
						$('#sub_total_ongkir_umkm_'+id_umkm).val('');
						swal.fire({
			                type: 'error',
			                text: 'Gagal mendapatkan data service pengiriman, silahkan coba beberapa saat lagi !',
			                title : 'Terjadi Kesalahan !',
			            });
					}
				},
				error: function (jqXHR, textStatus, errorThrown){
					$("#loading").hide(); 
					alert('Error get data from ajax');
				}
			});
		}
	}

	function set_ongkir(id_umkm){
		var kurir_service = $('#kurir_service_'+id_umkm).val();
		var exlpd_service = kurir_service.split("#");
		if (kurir_service == '') {
			$('.sub_total_ongkir_umkm_'+id_umkm).text(rp(0));
			$('#sub_total_ongkir_umkm_'+id_umkm).val('');
			hitung_total_checkout();
		}else{
			$('.sub_total_ongkir_umkm_'+id_umkm).text(rp(exlpd_service[2]));
			$('#sub_total_ongkir_umkm_'+id_umkm).val(exlpd_service[2]);
			hitung_total_checkout();
		}
	}

	function hitung_total_checkout(){
		var total_pesanan = 0;
		var total_harga_barang = 0;
		var total_ongkir = 0;

		$.each(arr_keranjang, function(i, val) {
			var jum_harga_barang = $('#sub_total_harga_barang_umkm_'+val.id_umkm).val();
			var jum_ongkir = $('#sub_total_ongkir_umkm_'+val.id_umkm).val();
			if (jum_ongkir == '') {
				jum_ongkir = 0;
			}
			var sub_total = parseInt(jum_harga_barang) + parseInt(jum_ongkir);

			$('#sub_total_ongkir_'+val.id_umkm).val(jum_ongkir);
			$('.sub_total_ongkir_'+val.id_umkm).text(rp(jum_ongkir));
			$('#sub_total_pesanan_'+val.id_umkm).val(sub_total);
			$('.sub_total_pesanan_'+val.id_umkm).text(rp(sub_total));

			total_harga_barang = total_harga_barang + parseInt(jum_harga_barang);
			total_ongkir = total_ongkir + parseInt(jum_ongkir);
			total_pesanan = total_pesanan + parseInt(sub_total);
		});

		$('#total_pesanan').val(total_pesanan);
		$('.total_pesanan').text(rp(total_pesanan));
		$('#sub_total_ongkir').val(total_ongkir);
		$('.sub_total_ongkir').text(rp(total_ongkir));
	}
</script>