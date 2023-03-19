<script type="text/javascript">
	$(".sinkron").click(function(){
		Swal.fire({
	      title: 'Konfirmasi',
	      text: "Apakah data ini ingin disinkronkan ke akun Tangerang Live?",
	      type: 'question',
	      showCancelButton: true,
	      confirmButtonColor: '#3085d6',
	      cancelButtonColor: '#d33',
	      confirmButtonText: 'Ya',
	      cancelButtonText: 'Tidak',
	    }).then((result) => {
	      if (result.value) {
	        $.ajax({
				url : '<?php echo site_url("customer/biodata/ajax_ubah"); ?>',
				type: 'post',
				data: {
					'type'	: 'update_biodata',
					<?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
				},
				success: function (res) {
					var obj = JSON.parse(res);
					if (obj.success !== true) {
						Swal.fire({
							text: obj.message,
							title: "Perhatian !",
							type: "error"
						});
					}else {
						Swal.fire({
							text: obj.message,
							title: "Berhasil !",
							type: "success",
                        }).then((result) => {
                        	location.reload();
                        });
					}
				}
			});
	      }else{
	        return false;
	      }
	    })
    });
</script>