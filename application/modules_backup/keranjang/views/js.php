<script type="text/javascript">

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

	$('.check_semua'). click(function(){
		<?php
		if($keranjang):
			$i=0;
			foreach ($keranjang as $value):
		?>
			if($('.check_semua').is(":checked"))
			{
				$('.check_<?php echo $i; ?>').prop('checked',true);
				dataTotal();
			}
			else{
				$('.check_<?php echo $i; ?>').removeAttr('checked');
				dataTotal();
				
			}
				

		<?php
		$i++;
			endforeach;
		endif;
		?>
	});

	function getTotal()
	{
		$.ajax({
			url : "<?php echo base_url('ajax/ajax_data/')?>",
			type: "POST",
			data : {
				type : 'total_belanja',
				<?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>',
			},
			dataType: "JSON",
			success: function(data){
				$('.total_harga').text("Rp. "+rp(data.total));
				$('[name="total_harga"]').val(data.total);
				if(data.total == 0)
				{
					$('.bayar_semua').attr('disabled','true');
				}else{
					$('.bayar_semua').removeAttr('disabled');
				}
			},
			error: function (jqXHR, textStatus, errorThrown){
				alert('Error get data from ajax');
			}
		});
	}


	function dataTotal()
	{
		var data = 0;
		<?php
		if($keranjang):
			$i=0;
			foreach ($keranjang as $value):
		?>
				if($('.check_<?php echo $i ?>').is(":checked"))
				{
					data = data + parseInt($('#total_<?php echo $i ?>').val());
				}
				

		<?php
		$i++;
			endforeach;
		endif;
		?>
		$('.total_harga').text("Rp. "+rp(data));
		$('[name="total_harga"]').val(data);
		if(data == 0)
		{
			$('.bayar_semua').attr('disabled','true');
		}else{
			$('.bayar_semua').removeAttr('disabled');
		}
	}

	getTotal();

	<?php
	if($keranjang):
		$i=0;
		foreach ($keranjang as $value):
	?>
		$('.check_<?php echo $i ?>'). click(function(){
			dataTotal();
			$('.check_semua').removeAttr('checked');
		});

		$('.btn-number-<?php echo $i; ?>').click(function(e){
			e.preventDefault();

			fieldName = $(this).attr('data-field');
			type      = $(this).attr('data-type');
			var input = $("#"+fieldName);
			var currentVal = parseInt(input.val());
			harga = $("#harga_<?php echo $i; ?>").val();
			if (!isNaN(currentVal)) {
				if(type == 'minus') {

					if(currentVal > input.attr('min')) {
						$('#plus-<?php echo $i; ?>').removeAttr('disabled', true);
						currentVal = currentVal - 1;
						input.val(currentVal).change();
						total = currentVal * harga;
						$('.total_<?php echo $i; ?>').text('Rp. '+rp(total));
						$('#total_<?php echo $i; ?>').val(total);
						$.ajax({
							url : "<?php echo base_url('ajax/ajax_ubah/')?>",
							type: "POST",
							data : {
								jumlah : currentVal,
								type : 'quantity',
								<?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>',
								id : '<?php echo $value->id_keranjang; ?>'
							},
							dataType: "JSON",
							success: function(data){
								dataTotal();
							},
							error: function (jqXHR, textStatus, errorThrown){
								alert('Error get data from ajax');
							}
						});
					}
					

					if(parseInt(input.val()) == input.attr('min')) {
						$(this).attr('disabled', true);

						Toast.fire({
							type : 'warning',
							title: 'Maaf minimal pembelian produk ini 1 barang.',
							text: '',
			         	});
					}

				} else if(type == 'plus') {

					if(currentVal < input.attr('max')) {
						$('#minus-<?php echo $i; ?>').removeAttr('disabled', true);
						currentVal = currentVal + 1;
						input.val(currentVal).change();
						total = currentVal * harga;
						$('.total_<?php echo $i; ?>').text('Rp. '+rp(total));
						$('#total_<?php echo $i; ?>').val(total);

						$.ajax({
							url : "<?php echo base_url('ajax/ajax_ubah/')?>",
							type: "POST",
							data : {
								jumlah : currentVal,
								type : 'quantity',
								<?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>',
								id : '<?php echo $value->id_keranjang; ?>'
							},
							dataType: "JSON",
							success: function(data){
								dataTotal();
							},
							error: function (jqXHR, textStatus, errorThrown){
								alert('Error get data from ajax');
							}
						});
					}

					if(parseInt(input.val()) == input.attr('max')) {
						$(this).attr('disabled', true);
						Toast.fire({
							type : 'warning',
							title: 'Stok Tersedia '+input.attr('max')+'. Harap kurangi jumlah tersedia.',
							text: '',
						});
					}

				}
			} else {
				input.val(0);
			}
		});
		$('.input-number-<?php echo $i; ?>').focusin(function(){
			$(this).data('oldValue', $(this).val());
		});
		$('.input-number-<?php echo $i; ?>').keyup(stopp(function (e) {
			harga = $("#harga_<?php echo $i; ?>").val();
			minValue =  parseInt($(this).attr('min'));
			maxValue =  parseInt($(this).attr('max'));
			valueCurrent = parseInt($(this).val()) || 0;

			name = $(this).attr('name');
			if(valueCurrent >= minValue) {
				$(".btn-number-<?php echo $i; ?>[data-type='minus'][data-field='"+name+"']").removeAttr('disabled');
				total = valueCurrent * harga;
				$('.total_<?php echo $i; ?>').text('Rp. '+rp(total));
				$('#total_<?php echo $i; ?>').val(total);
				$.ajax({
					url : "<?php echo base_url('ajax/ajax_ubah/')?>",
					type: "POST",
					data : {
						jumlah : valueCurrent,
						type : 'quantity',
						<?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>',
						id : '<?php echo $value->id_keranjang; ?>'
					},
					dataType: "JSON",
					success: function(data){
						dataTotal();
					},
					error: function (jqXHR, textStatus, errorThrown){
						alert('Error get data from ajax');
					}
				});
			} else if(valueCurrent != 0) {
				Toast.fire({
					type : 'warning',
					title: 'Maaf minimal pembelian produk ini 1 barang.',
					text: '',
	         	});

	         	$.ajax({
					url : "<?php echo base_url('ajax/ajax_ubah/')?>",
					type: "POST",
					data : {
						jumlah : $(this).data('oldValue'),
						type : 'quantity',
						<?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>',
						id : '<?php echo $value->id_keranjang; ?>'
					},
					dataType: "JSON",
					success: function(data){
						dataTotal();
					},
					error: function (jqXHR, textStatus, errorThrown){
						alert('Error get data from ajax');
					}
				});
				$(this).val($(this).data('oldValue'));
			}

			if(valueCurrent <= maxValue) {
				$(".btn-number-<?php echo $i; ?>[data-type='plus'][data-field='"+name+"']").removeAttr('disabled');
				total = valueCurrent * harga;
				$('.total_<?php echo $i; ?>').text('Rp. '+rp(total));
				$('#total_<?php echo $i; ?>').val(total);
				$.ajax({
					url : "<?php echo base_url('ajax/ajax_ubah/')?>",
					type: "POST",
					data : {
						jumlah : valueCurrent,
						type : 'quantity',
						<?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>',
						id : '<?php echo $value->id_keranjang; ?>'
					},
					dataType: "JSON",
					success: function(data){
						dataTotal();
					},
					error: function (jqXHR, textStatus, errorThrown){
						alert('Error get data from ajax');
					}
				});
			} else{
				Toast.fire({
					type : 'warning',
					title: 'Stok Tersedia '+maxValue+'. Harap kurangi jumlah tersedia.',
					text: '',
				});
				$.ajax({
					url : "<?php echo base_url('ajax/ajax_ubah/')?>",
					type: "POST",
					data : {
						jumlah : $(this).data('oldValue'),
						type : 'quantity',
						<?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>',
						id : '<?php echo $value->id_keranjang; ?>'
					},
					dataType: "JSON",
					success: function(data){
						dataTotal();
					},
					error: function (jqXHR, textStatus, errorThrown){
						alert('Error get data from ajax');
					}
				});
				$(this).val($(this).data('oldValue'));
			}


		}, 500));
		$(".input-number-<?php echo $i; ?>").keydown(function (e) {
			if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
				(e.keyCode == 65 && e.ctrlKey === true) || 
				(e.keyCode >= 35 && e.keyCode <= 39)) {
				return;
				}

			if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
				e.preventDefault();
			}
		});
		
		$('.hapus-produk-<?php echo $i; ?>').click(function(e){
			$.ajax({
				url : "<?php echo base_url('ajax/ajax_data/')?>",
				type: "POST",
				data : {
					status : 'hapus',
					type : 'add_chart',
					<?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>',
					id : $('[name="id_produk[<?php echo $i; ?>]"]').val(),
				},
				dataType: "JSON",
				success: function(data){
					if(data.success)
					{
						location.reload();
					}
				},
				error: function (jqXHR, textStatus, errorThrown){
					alert('Error get data from ajax');
				}
			});
		});
	<?php
	$i++;
		endforeach;
		endif;
	?>

	function rp(bilangan)
    {
        if(bilangan != null)
        {
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