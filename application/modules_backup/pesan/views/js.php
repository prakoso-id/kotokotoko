<script type="text/javascript">
	function detail_chat(id,count_not_read=0)
	{
		$('.mesgs').empty('');
	    $.ajax({
			url : "<?php echo base_url('pesan/detail_pesan')?>",
			type: "POST",
			data : {
				<?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>',
				id : id,
			},
			dataType: "html",
			success: function(data){
				$('.mesgs').html(DOMPurify.sanitize( data, { SAFE_FOR_JQUERY: true } ));

				$('.msg_history').animate({
					scrollTop: $("#scrollHeightReference").offset().top
				}, 2000);

				$('.count-pesan-'+id).html('');
			    var count_all_not_read = $('#count_pesan_all').val();
			    if (count_all_not_read > 0) {
			    	var count_all = count_all_not_read - count_not_read;
			    	$('#count_pesan_all').val(count_all);
			    	if (count_all > 0) {
			    		var html_count_msg = '<span style="background:#e95a5c;" class="badge">'+count_all+'</span>';
			    		$('.count-pesan-all').html(DOMPurify.sanitize( html_count_msg, { SAFE_FOR_JQUERY: true } ));
			    	}else{
			    		$('.count-pesan-all').html('');
			    	}
			    }

			    $("#btn_send_msg").click(function(){
			        kirim_pesan();
			    });
			},
			error: function (jqXHR, textStatus, errorThrown){
				alert('Error get data from ajax');
			}
		});
	}

	function kirim_pesan() {
		var id_group = $('[name="id_group"]').val();
		$.ajax({
			url : "<?php echo base_url('ajax/ajax_save/')?>",
			type: "POST",
			data : {
				type : 'simpan_pesan',
				<?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>',
				id_produk : $('[name="id_produk"]').val(),
				username : $('[name="username"]').val(),
				pesan : $('[name="pesan_chat"]').val(),
				id_group : id_group,
			},
			dataType: "JSON",
			success: function(data){
				if(data.status)
				{
					if (data.success) {
						detail_chat(id_group);
						swal({type : 'success',title: 'Sukses', text: 'Pesan berhasil dikirimkan'});
					}else{
						swal({type : 'error',title: 'Error', text: 'Pesan gagal dikirimkan !'});
					}
				}else{
					swal({type : 'warning',title: 'Perhatian',text: 'Pesan tidak boleh kosong'});
				}
			},
			error: function (jqXHR, textStatus, errorThrown){
				alert('Error get data from ajax');
			}
		});
	}

	function refresh()
	{
		location.reload();
	}
</script>