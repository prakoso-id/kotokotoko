<script type="text/javascript">
	$(".sinkron").click(function(){
        swal({
			text: "Apakah data ini ingin disinkronkan ke akun Tangerang Live?",
			title: "Perhatian",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#f8ce86",
			confirmButtonText: "Iya",
			cancelButtonText: "Tidak",
			closeOnConfirm: false,
			closeOnCancel: true
		},
		function(isConfirm){
			if (isConfirm) {
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
							swal({
								text: obj.message,
								title: "Perhatian!",
								type: "error",
								button: true,
								timer: 1000
							});
						}
						else {
							swal({
								text: obj.message,
								title: "Berhasil!",
								type: "success",
								button: true,
                                   },function(isConfirm){
                                        if (isConfirm) {
                                             location.reload();
                                        }
                                   });
						}
					}
				});
			}
		});
    });
</script>