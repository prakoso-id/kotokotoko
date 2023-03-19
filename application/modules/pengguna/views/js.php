<script type="text/javascript">
	$(document).ready(function(){
		$('.select2').select2();

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

	});

	function table_data(){
		dataTable.ajax.reload(null,true);
	}

	$(".filter_nama").keyup(function(){
        table_data();
	});

    $(".filter_username").keyup(function(){
        table_data();
	});

	$(".filter_group").change(function(){
		table_data();
	});

    $(".load_table").click(function(){
        table_data();
    });

    function get_m_group(id=null,id_group=null){
    	$.ajax({
	        url : "<?php echo base_url('dashboard/ajax_data')?>",
           	type: "POST",
           	data : {
           		type : 'data_group',
                id   : id,
                id_group : id_group,
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
					Swal.fire({text: "NIP Tidak Ditemukan",title: "Opps..",type: "error"});
				}else {
					Swal.fire({text: 'NIP Berhasil Ditemukan',title: "Sukses",type: "success"});
					$('input[name="nama_lengkap"]').val(obj.nama_pegawai);
					$('input[name="tmpt_lahir"]').val(obj.tempat_lahir);
					$('input[name="tgl_lahir"]').val(obj.tanggal_lahir);
					$('input[name="jabatan"]').val(obj.nomenklatur_jabatan);
					$('.jenis_id').val('nip');
					$('.kode_unor').val(obj.kode_unor);
					$('.gender').val(obj.gender);
					$('.id_group').html('');
					get_m_group('nip');
				}
			}
		});
    });

    $(".tambah_data").click(function(event){
		save_method = 'add';
		$('#add_tambah')[0].reset();
		$('.form-control').removeClass('is-invalid');
		$('.help-block').empty();
		$('.id_group').html('');
		$('#modal_tambah').modal('show');
		$('.modal-title').text('Tambah Data Pengguna');
    });

    function simpan_data(){
		Swal.fire({
	      title: 'Konfirmasi Simpan',
	      text: "Apakah Data ini Ingin Di Simpan?",
	      type: 'question',
	      showCancelButton: true,
	      confirmButtonColor: '#3085d6',
	      cancelButtonColor: '#d33',
	      confirmButtonText: 'Ya',
	      cancelButtonText: 'Tidak',
	    }).then((result) => {
	      	if (result.value) {
	      		$('.btnSave').text('sedang menyimpan...'); //change button text
		    	$('.btnSave').attr('disabled',true); //set button disable
		    	$('.form-control').removeClass('is-invalid');
		    	$('.help-block').empty();

				if(save_method == 'add'){
					var url = '<?php echo base_url("dashboard/ajax_save"); ?>';
					var form = $('#add_tambah')[0];
					var data = new FormData(form);
				}else{
					var url = '<?php echo base_url("dashboard/ajax_ubah"); ?>';
					var form = $('#add_ubah')[0];
					var data = new FormData(form);
				}

				$.ajax({
					url: url,
					type: 'post',
					data: data,
					processData:false,
					contentType:false,
					cache:false,
					success: function (res) {
						var obj = JSON.parse(res);
						if(obj.status){
							if (obj.success !== true) {
								Swal.fire({text: obj.message,title: "Opps..",type: "error"});
							}else {
								Swal.fire({text: obj.message,title: "Sukses",type: "success"});
								$('#modal_tambah').modal('hide');
								$('#modal_ubah').modal('hide');
								table_data();
							}
						}else {
							for (var i = 0; i < obj.inputerror.length; i++) {
								$('[name="'+obj.inputerror[i]+'"]').addClass('is-invalid');
                                $('[name="'+obj.inputerror[i]+'"]').next().addClass('invalid-feedback');
                                $('[name="'+obj.inputerror[i]+'"]').next().html(obj.error_string[i]);
							}
							Swal.fire({type: 'warning',text: obj.error_string[0],title : 'Perhatian !'});
						}

						$('.btnSave').text('Simpan'); //change button text
            			$('.btnSave').attr('disabled',false); //set button enable
					}
				});
			}else{
	        	return false;
	      	}
	    });
    }

    function ubah_data(id){
		save_method = 'edit';
		$('#add_ubah')[0].reset();
		$('.form-control').removeClass('is-invalid');
		$('.help-block').empty();
        $.ajax({
           	url : "<?php echo base_url('pengguna/ajax_lihat')?>",
           	type: "POST",
           	data : {
                id   : id,
                <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
           	},
           	dataType: "JSON",
           	success: function(data){
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
				get_m_group('all',data.id_group);

				$('#modal_ubah').modal('show');
                $('.modal-title').text('Ubah Group Pengguna');
           	},
           	error: function (jqXHR, textStatus, errorThrown){
                alert('Error get data from ajax');
           	}
        });
	}

    function lihat_data(id){
          $.ajax({
               url : "<?php echo base_url('pengguna/ajax_lihat')?>",
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
					if(data.tempat_lahir != null || data.tanggal_lahir != null){
						$('.ttl').text(data.tempat_lahir+' '+data.tanggal_lahir);
					}else{
						$('.ttl').text(' ');
					}
					$('.alamat').text(data.alamat);
					$('.email').text(data.email);
					$('.domisili').text(data.domisili);
					if(data.status){
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

	function hapus_data(id){
		Swal.fire({
	      title: 'Konfirmasi Hapus',
	      text: "Apakah akun ini ingin di nonaktifkan ?",
	      type: 'question',
	      showCancelButton: true,
	      confirmButtonColor: '#3085d6',
	      cancelButtonColor: '#d33',
	      confirmButtonText: 'Ya',
	      cancelButtonText: 'Tidak',
	    }).then((result) => {
	      	if (result.value) {
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
							Swal.fire({text: obj.message,title: "Opps..",type: "error"});
						}else {
							Swal.fire({text: obj.message,title: "Sukses",type: "success"});
							table_data();
						}
					}
				});
			}else{
	        	return false;
	      	}
	    });
	}

	function aktif_data(id){
		Swal.fire({
	      title: 'Konfirmasi',
	      text: "Apakah akun ini ingin di aktifkan ?",
	      type: 'question',
	      showCancelButton: true,
	      confirmButtonColor: '#3085d6',
	      cancelButtonColor: '#d33',
	      confirmButtonText: 'Ya',
	      cancelButtonText: 'Tidak',
	    }).then((result) => {
	      	if (result.value) {
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
							Swal.fire({text: obj.message,title: "Opps..",type: "error"});
						}else {
							Swal.fire({text: obj.message,title: "Sukses",type: "success"});
							table_data();
						}
					}
				});
			}else{
	        	return false;
	      	}
	    });
	}
</script>