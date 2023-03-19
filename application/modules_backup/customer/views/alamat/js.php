<script type="text/javascript">
	$('.select2').select2();
	$("#modal_tambah .select2").select2({
      dropdownParent: $("#modal_tambah")
    });
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
		autoWidth:true,
		aLengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
		ajax: {
			url: '<?php echo base_url('customer/daftar_alamat/ajax_list')?>',
			type: 'POST',
			data: function (data) {
				data.filter = {
					'nama'		: $('.filter_alamat').val(),
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
			{'data':'nama_alamat'},
			{'data':'nama_penerima'},
			{'data':'no_penerima'},
			{'data':'nama_prop'},
			{'data':'nama_kota'},
			{'data':'nama_kec'},
			{'data':'nama_kel'},
			{'data':'aksi','orderable':false},
		],
		"scrollX": true,
		"scrollCollapse": true,
		"fixedColumns": {
			"leftColumns": 0,
			"rightColumns": 1,
		},
	});

	function table_data(){
		dataTable.ajax.reload(null,true);
	}

	$(".filter_alamat").keyup(function(){
		delay(function(){
        	table_data();
      	}, 800);
	});

    $(".load_table").click(function(){
        table_data();
    });

    $('[name="id_prop"]').change(function(){
    	var id = $('[name="id_prop"]').val();
    	$.ajax({
			url : '<?php echo base_url("dashboard/ajax_data"); ?>',
			type: 'post',
			dataType:'html',
			data: {
				data_propinsi: id,
				type : 'data_kota',
				<?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
			},
			success: function (data) {
				if(id == 0)
				{
					$('[name="id_kota"]').html('');
					$('[name="id_kec"]').html('');
					$('[name="id_kel"]').html('');
				}else{
					$('[name="id_kota"]').html(DOMPurify.sanitize( data, { SAFE_FOR_JQUERY: true } ));
					$('[name="id_kec"]').html('');
					$('[name="id_kel"]').html('');				
				}
			}
		});
    });

    $('[name="id_kota"]').change(function(){
    	var id_prop = $('[name="id_prop"]').val();
    	var id_kota = $('[name="id_kota"]').val();
    	$.ajax({
			url : '<?php echo base_url("dashboard/ajax_data"); ?>',
			type: 'post',
			dataType:'html',
			data: {
				data_propinsi: id_prop,
				data_kota : id_kota,
				type : 'data_kecamatan',
				<?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
			},
			success: function (data) {
				if(id_kota == 0)
				{
					$('[name="id_kec"]').html('');
					$('[name="id_kel"]').html('');
				}else{
					$('[name="id_kec"]').html(DOMPurify.sanitize( data, { SAFE_FOR_JQUERY: true } ));	
					$('[name="id_kel"]').html('');				
				}
			}
		});
    });

    $('[name="id_kec"]').change(function(){
    	var id_prop = $('[name="id_prop"]').val();
    	var id_kota = $('[name="id_kota"]').val();
    	var id_kec = $('[name="id_kec"]').val();
    	$.ajax({
			url : '<?php echo base_url("dashboard/ajax_data"); ?>',
			type: 'post',
			dataType:'html',
			data: {
				data_propinsi: id_prop,
				data_kota : id_kota,
				data_kec : id_kec,
				type : 'data_kelurahan',
				<?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
			},
			success: function (data) {
				if(id_kec == 0)
				{
					$('[name="id_kel"]').html('');
				}else{
					$('[name="id_kel"]').html(DOMPurify.sanitize( data, { SAFE_FOR_JQUERY: true } ));					
				}
			}
		});
    });


    $(".tambah_data").click(function(event){
    	$('#add_tambah')[0].reset();
		save_method = 'add';
		$('form')[0].reset();
		$('.form-group').removeClass('has-error');
		$('.help').empty();

		$.ajax({
			url : '<?php echo base_url("dashboard/ajax_data"); ?>',
			type: 'post',
			dataType:'html',
			data: {
				type : 'data_propinsi',
				<?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
			},
			success: function (data) {
				$('[name="id_prop"]').html(DOMPurify.sanitize( data, { SAFE_FOR_JQUERY: true } ));
			}
		});

		$('[name="id_kota"]').html('');
		$('[name="id_kec"]').html('');
		$('[name="id_kel"]').html('');
		$('#modal_tambah').modal('show');
		$('.modal-title').text('Tambah Daftar Alamat');
    });

    function simpan_data()
    {
    	$('#btnSave').text('sedang menyimpan...'); //change button text
    	$('#btnSave').attr('disabled',true); //set button disable
    	$('.form-group').removeClass('has-error');
    	$('.help').empty();
				
		var form = $('#add_tambah')[0];
		var data = new FormData(form);

		if(save_method == 'add')
		{
			var url = '<?php echo base_url("customer/daftar_alamat/ajax_save"); ?>';
		}
		else{
			var url = '<?php echo base_url("customer/daftar_alamat/ajax_ubah"); ?>';
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
				$('.confirm').text('sedang menyimpan...'); //change button text
    			$('.confirm').attr('disabled',true); //set button disable

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
                                text: 'Proses Simpan Gagal, Silahkan Melengkapi Data Yang Harus Diisi',
                                title : '',
                                button: true,
                                timer: 3000
                            });
							$('#btnSave').text('Simpan'); //change button text
            				$('#btnSave').attr('disabled',false); //set button enable
						}
					}
				});
			}else{
				$('.confirm').text('Simpan'); //change button text
    			$('.confirm').attr('disabled',false); //set button disable'

				$('#btnSave').text('Simpan'); //change button text
            	$('#btnSave').attr('disabled',false); //set button enable
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
               url : "<?php echo base_url('customer/daftar_alamat/ajax_lihat/')?>",
               type: "POST",
               data : {
                    id   : id,
                    <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
               },
               dataType: "JSON",
               success: function(data){
					$('.nama_alamat').text(data.nama_alamat);
					$('.propinsi').text(data.nama_prop);
					$('.kota').text(data.nama_kota);
					$('.kecamatan').text(data.nama_kec);
					$('.kelurahan').text(data.nama_kel);
					$('.alamat').text(data.alamat);
					$('.nama_penerima').text(data.nama_penerima);
					$('.no_penerima').text(data.no_penerima);
                    $('#modal_data').modal('show');
                    $('.modal-title').text('Data Alamat');
               },
               error: function (jqXHR, textStatus, errorThrown){
                    alert('Error get data from ajax');
               }
          });
	}

	function ubah_data(id)
	{
		save_method = 'edit';
		$('#add_tambah')[0].reset();
		$('.form-group').removeClass('has-error');
		$('.help').empty();

          $.ajax({
               url : "<?php echo base_url('customer/daftar_alamat/ajax_lihat/')?>",
               type: "POST",
               data : {
                    id   : id,
                    <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
               },
               dataType: "JSON",
               success: function(data){
               		if(data.utama != 0)
               		{
               			$('[name="utama"]').prop('checked', true);
               		}
					$('[name="id"]').val(id);               	
					$('[name="nama_alamat"]').val(data.nama_alamat);
					$('[name="alamat"]').val(data.alamat);
					$('[name="nama_penerima"]').val(data.nama_penerima);
					$('[name="no_penerima"]').val(data.no_penerima);

					$.ajax({
						url : '<?php echo base_url("dashboard/ajax_data"); ?>',
						type: 'post',
						dataType:'html',
						data: {
							id : data.id_prop,
							type : 'data_propinsi',
							<?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
						},
						success: function (data) {
							$('[name="id_prop"]').html(DOMPurify.sanitize( data, { SAFE_FOR_JQUERY: true } ));
						}
					});

					$.ajax({
						url : '<?php echo base_url("dashboard/ajax_data"); ?>',
						type: 'post',
						dataType:'html',
						data: {
							data_propinsi: data.id_prop,
							id : data.id_kota,
							type : 'data_kota',
							<?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
						},
						success: function (data) {
							$('[name="id_kota"]').html(DOMPurify.sanitize( data, { SAFE_FOR_JQUERY: true } ));
						}
					});

					$.ajax({
						url : '<?php echo base_url("dashboard/ajax_data"); ?>',
						type: 'post',
						dataType:'html',
						data: {
							data_propinsi: data.id_prop,
							data_kota : data.id_kota,
							id : data.id_kec,
							type : 'data_kecamatan',
							<?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
						},
						success: function (data) {
							$('[name="id_kec"]').html(DOMPurify.sanitize( data, { SAFE_FOR_JQUERY: true } ));
						}
					});

					$.ajax({
						url : '<?php echo base_url("dashboard/ajax_data"); ?>',
						type: 'post',
						dataType:'html',
						data: {
							data_propinsi: data.id_prop,
							data_kota : data.id_kota,
							data_kec : data.id_kec,
							id : data.id_kel,
							type : 'data_kelurahan',
							<?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
						},
						success: function (data) {
							$('[name="id_kel"]').html(DOMPurify.sanitize( data, { SAFE_FOR_JQUERY: true } ));
						}
					});

                    $('#modal_tambah').modal('show');
                    $('.modal-title').text('Ubah Data Alamat');
               },
               error: function (jqXHR, textStatus, errorThrown){
                    alert('Error get data from ajax');
               }
          });
	}

	 function hapus_data(id)
	{
		swal({
			text: "Apakah data ini ingin dihapus?",
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
					url : '<?php echo site_url("customer/daftar_alamat/ajax_hapus"); ?>',
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