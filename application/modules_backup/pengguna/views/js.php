<script type="text/javascript">

	$('.select2').select2();
	
	var delay = (function(){
      var timer = 0;
      return function(callback, ms){
        clearTimeout(timer);
        timer = setTimeout(callback,ms);
      };
    })();  

	var table;

	dataTable = $('.tabel').DataTable( {
		paginationType:'full_numbers',
		processing: true,
		serverSide: true,
		filter: false,
		autoWidth:false,
		aLengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
		ajax: {
			url: '<?php echo base_url('pengguna/ajax_list')?>',
			type: 'POST',
			data: function (data) {
				data.filter = {
					'nama'		: $('.filter_nama').val(),	
					'username'	: $('.filter_username').val(),	
					'group'		: $('.filter_group').val(),
				};
				data.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
			},
		},
		language: {
			sProcessing: 'Sedang memproses...',
			sLengthMenu: 'Tampilkan _MENU_ entri',
			sZeroRecords: 'Tidak ditemukan data yang sesuai',
			sInfo: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ entri',
			sInfoEmpty: 'Menampilkan 0 sampai 0 dari 0 entri',
			sInfoFiltered: '(disaring dari _MAX_ entri keseluruhan)',
			sInfoPostFix: '',
			sSearch: 'Cari:',
			sUrl: '',
			oPaginate: {
				sFirst: '<<',
				sPrevious: '<',
				sNext: '>',
				sLast: '>>'
			}
		},
		order: [0, 'desc'],
		columns: [
			{'data':'no'},
			{'data':'nama'},
			{'data':'nama_group'},
			{'data':'last_login'},
			{'data':'status'},
			{'data':'aksi','orderable':false},
		],
	});

	function table_data(){
		dataTable.ajax.reload(null,true);
	}

	$(".filter_nama").keyup(function(){
		delay(function(){
        	table_data();
      	}, 800);
	});

    $(".filter_username").keyup(function(){
		delay(function(){
        	table_data();
      	}, 800);
	});

	$(".filter_group").change(function(){
		table_data();
	});

    $(".load_table").click(function(){
        table_data();
    });

     $("[name='username']").change(function(){
    	$.ajax({
			url : '<?php echo base_url("dashboard/ajax_data"); ?>',
			type: 'post',
			data: {
				nip: $('input[name="username"]').val(),
				type : 'cari_nip',
				<?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
			},

			success: function (res) {
				var obj = JSON.parse(res);
				if (obj.success !== true) {
					swal({
						text: "Data Tidak Ditemukan",
						title: "",
						type: "error",
						button: true,
						timer: 1000
					});
				}
				else {
					swal({
						text: 'Data Berhasil Ditemukan',
						title: "",
						type: "success",
						button: true,
						timer: 1000
					});

					$('input[name="nama_lengkap"]').val(obj.nama_pegawai);
					$('input[name="tmpt_lahir"]').val(obj.tempat_lahir);
					$('input[name="tgl_lahir"]').val(obj.tanggal_lahir);
					$('input[name="jabatan"]').val(obj.nomenklatur_jabatan);
					$('.jenis_id').val('nip');
					$('.kode_unor').val(obj.kode_unor);
					$('.gender').val(obj.gender);
					$('.id_group').html('');
					$.ajax({
			            url : "<?php echo base_url('dashboard/ajax_data/')?>",
			               type: "POST",
			               data : {
			               		type : 'data_group',
			                    id   : 'nip',
			                    <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
			               },
			               dataType: "html",
			               success: function(data){
			                    $('.id_group').html(DOMPurify.sanitize( data, { SAFE_FOR_JQUERY: true } ));
			               },
			               error: function (jqXHR, textStatus, errorThrown){
			                    alert('Error get data from ajax');
			               }
			          });
				}
			}
		});
    });

    $(".tambah_data").click(function(event){
		save_method = 'add';
		$('form')[0].reset();
		$('.form-group').removeClass('has-error');
		$('.help').empty();
		$('.id_group').html(' ');
		$('#modal_tambah').modal('show');
		$('.modal-title').text('Tambah Data Pengguna');
    });

    function simpan_data()
    {
    	$('#btnSave').text('sedang menyimpan...'); //change button text
    	$('#btnSave').attr('disabled',true); //set button disable
    	$('.form-group').removeClass('has-error');
    	$('.help').empty();
				
		

		if(save_method == 'add')
		{
			var url = '<?php echo base_url("dashboard/ajax_save"); ?>';
			var form = $('#add_tambah')[0];
			var data = new FormData(form);
		}
		else{
			var url = '<?php echo base_url("dashboard/ajax_ubah"); ?>';
			var form = $('#add_ubah')[0];
			var data = new FormData(form);
		}


		swal({
			text: "Apakah Data ini Ingin Di Simpan?",
			title: "",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#2196F3",
			confirmButtonText: "Simpan",
			cancelButtonText: "Tidak",
			closeOnConfirm: false,
			closeOnCancel: true
		},
		function(isConfirm){
			if (isConfirm) {
				$.ajax({
					url: url,
					type: 'post',
					data: data,
					processData:false,
					contentType:false,
					cache:false,
					success: function (res) {
						var obj = JSON.parse(res);
						if(obj.status)
						{
							if (obj.success !== true) {
								swal({
									text: obj.message,
									title: "",
									type: "error",
									button: true,
									timer: 1000
								});
							}
							else {
								swal({
									text: obj.message,
									title: "",
									type: "success",
									button: true,
								},function(isConfirm){
									if (isConfirm) {
										$('#modal_tambah').modal('hide');
										$('#modal_ubah').modal('hide');
										table_data();
									}
								});
							}
							$('#btnSave').text('Simpan'); //change button text
            				$('#btnSave').attr('disabled',false); //set button enable
						}
						else {
							for (var i = 0; i < obj.inputerror.length; i++) 
							{
								$('[name="'+obj.inputerror[i]+'"]').parent().parent().addClass('has-error');
								$('[name="'+obj.inputerror[i]+'"]').next().text(obj.error_string[i]); 
							}
							swal({
								type: 'error',
								text: obj.error_string[0],
								title : '',
								button: true,
								timer: 1500
							});
							$('#btnSave').text('Simpan'); //change button text
            				$('#btnSave').attr('disabled',false); //set button enable
						}
					}
				});
			}else{
				$('#btnSave').text('Simpan'); //change button text
            	$('#btnSave').attr('disabled',false); //set button enable
			}

		});
    }

    function ubah_data(id)
	{
		save_method = 'edit';
		$('#add_modal')[0].reset();
		$('.form-group').removeClass('has-error');
		$('.help').empty();

          $.ajax({
               url : "<?php echo base_url('pengguna/ajax_lihat/')?>",
               type: "POST",
               data : {
                    id   : id,
                    <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
               },
               dataType: "JSON",
               success: function(data){
                    $('#modal_ubah').modal('show');
                    $('.modal-title').text('Ubah Group Pengguna');
                    $('[name="id"]').val(id);
                    $('input[name="username"]').val(data.username);
                    $('input[name="nama_lengkap"]').val(data.nama);
					$('input[name="tmpt_lahir"]').val(data.tempat_lahir);
					$('input[name="tgl_lahir"]').val(data.tanggal_lahir);
					$('input[name="jabatan"]').val(data.nomenklatur_jabatan);
					$('.jenis_id').val('nip');
					$('.kode_unor').val(data.kode_unor);
					$('.gender').val(data.gender);
					$('.id_group').html('');
					$.ajax({
			            url : "<?php echo base_url('dashboard/ajax_data/')?>",
			               type: "POST",
			               data : {
			               		type : 'data_group',
			                    id   : 'all',
			                    id_group : data.id_group,
			                    <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
			               },
			               dataType: "html",
			               success: function(data){
			                    $('.id_group').html(DOMPurify.sanitize( data, { SAFE_FOR_JQUERY: true } ));
			               },
			               error: function (jqXHR, textStatus, errorThrown){
			                    alert('Error get data from ajax');
			               }
			          });
               },
               error: function (jqXHR, textStatus, errorThrown){
                    alert('Error get data from ajax');
               }
          });
	}

    function lihat_data(id)
	{
		save_method = 'edit';
		$('#add_modal')[0].reset();
		$('.form-group').removeClass('has-error');
		$('.help').empty();

          $.ajax({
               url : "<?php echo base_url('pengguna/ajax_lihat/')?>",
               type: "POST",
               data : {
                    id   : id,
                    <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
               },
               dataType: "JSON",
               success: function(data){
					$('.nik').text(data.username);
					$('.nama').text(data.nama);
					$('.jenis_kelamin').text(data.jenis_kelamin);
					if(data.tempat_lahir != null || data.tanggal_lahir != null)
					{
						$('.ttl').text(data.tempat_lahir+' '+data.tanggal_lahir);
					}else{
						$('.ttl').text(' ');
					}
					$('.alamat').text(data.alamat);
					$('.email').text(data.email);
					$('.domisili').text(data.domisili);
					if(data.status)
					{
						$('.status').text('Aktif');
					}else{
						$('.status').text('Tidak Aktif');	
					}
					
                    $('#modal_data').modal('show');
                    $('.modal-title').text('Data Pengguna');
               },
               error: function (jqXHR, textStatus, errorThrown){
                    alert('Error get data from ajax');
               }
          });
	}

	function hapus_data(id)
	{
		swal({
			text: "Apakah akun ini ingin dinon aktifkan?",
			title: "",
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
					url : '<?php echo site_url("pengguna/ajax_hapus"); ?>',
					type: 'post',
					data: {
						id: id,
						<?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
					},

					success: function (res) {
						var obj = JSON.parse(res);
						if (obj.success !== true) {
							swal({
								text: obj.message,
								title: "",
								type: "error",
								button: true,
								timer: 1000
							});
						}
						else {
							swal({
								text: obj.message,
								title: "",
								type: "success",
								button: true,
                                   },function(isConfirm){
                                        if (isConfirm) {
                                             table_data();
                                        }
                                   });
						}
					}
				});
			}
		});
	}

	function aktif_data(id)
	{
		swal({
			text: "Apakah akun ini ingin diaktifkan?",
			title: "",
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
					url : '<?php echo site_url("pengguna/ajax_restore"); ?>',
					type: 'post',
					data: {
						id: id,
						<?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
					},

					success: function (res) {
						var obj = JSON.parse(res);
						if (obj.success !== true) {
							swal({
								text: obj.message,
								title: "",
								type: "error",
								button: true,
								timer: 1000
							});
						}
						else {
							swal({
								text: obj.message,
								title: "",
								type: "success",
								button: true,
                                   },function(isConfirm){
                                        if (isConfirm) {
                                             table_data();
                                        }
                                   });
						}
					}
				});
			}
		});
	}

</script>