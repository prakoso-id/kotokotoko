<script type="text/javascript">
	var table;
	$(document).ready(function(){
		$('.select2').select2();
		$("#modal_tambah .select2").select2({
	      dropdownParent: $("#modal_tambah")
	    });

	    dataTable = $('.tabel').DataTable( {
			paginationType:'full_numbers',
			processing: true,
			serverSide: true,
			filter: false,
			autoWidth : false,
			width:"100%",
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
		});
	});

	function table_data(){
		dataTable.ajax.reload(null,true);
	}

	$(".filter_alamat").keyup(function(){
        table_data();
	});

    $(".load_table").click(function(){
        table_data();
    });

    function get_prop(id=null){
    	$.ajax({
			url : '<?php echo base_url("dashboard/ajax_data"); ?>',
			type: 'post',
			dataType:'html',
			async:false,
			data: {
				type : 'data_propinsi',
				id : id,
				<?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
			},
			success: function (data) {
				$('[name="id_prop"]').html(DOMPurify.sanitize( data, { SAFE_FOR_JQUERY: true } ));
				$('[name="id_kota"]').html('');
				$('[name="id_kec"]').html('');
				$('[name="id_kel"]').html('');
			}
		});
    }

    function get_kab(id=null){
    	var id_prop = $('[name="id_prop"]').val();

    	var nama_prop = $("[name='id_prop'] option:selected").text();
        $("[name='nama_prop']").val(nama_prop);

    	$.ajax({
			url : '<?php echo base_url("dashboard/ajax_data"); ?>',
			type: 'post',
			dataType:'html',
			async:false,
			data: {
				data_propinsi: id_prop,
				id : id,
				type : 'data_kota',
				<?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
			},
			success: function (data) {
				if(id_prop == 0)
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
    }

    function get_kec(id=null){
    	var id_prop = $('[name="id_prop"]').val();
    	var id_kota = $('[name="id_kota"]').val();

    	var nama_kota = $("[name='id_kota'] option:selected").text();
        $("[name='nama_kota']").val(nama_kota);

    	$.ajax({
			url : '<?php echo base_url("dashboard/ajax_data"); ?>',
			type: 'post',
			dataType:'html',
			async:false,
			data: {
				data_propinsi: id_prop,
				data_kota : id_kota,
				id : id,
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
    }

    function get_kel(id=null){
    	var id_prop = $('[name="id_prop"]').val();
    	var id_kota = $('[name="id_kota"]').val();
    	var id_kec = $('[name="id_kec"]').val();

    	var nama_kec = $("[name='id_kec'] option:selected").text();
        $("[name='nama_kec']").val(nama_kec);

    	$.ajax({
			url : '<?php echo base_url("dashboard/ajax_data"); ?>',
			type: 'post',
			dataType:'html',
			async:false,
			data: {
				data_propinsi: id_prop,
				data_kota : id_kota,
				data_kec : id_kec,
				id : id,
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
    }

    function set_nama_kel(){
    	var nama_kel = $("[name='id_kel'] option:selected").text();
        $("[name='nama_kel']").val(nama_kel);
    }

    $(".tambah_data").click(function(event){
    	$('#add_tambah')[0].reset();
		save_method = 'add';
		$('form')[0].reset();
		$('.form-group').removeClass('has-error');
		$('.help').empty();
		get_prop();
		$('#modal_tambah').modal('show');
		$('.modal-title').text('Tambah Daftar Alamat');
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
	      		$('#btnSave').text('sedang menyimpan...'); //change button text
		    	$('#btnSave').attr('disabled',true); //set button disable
		    	$('.form-group').removeClass('has-error');
		    	$('.help').empty();
						
				var form = $('#add_tambah')[0];
				var data = new FormData(form);

				if(save_method == 'add'){
					var url = '<?php echo base_url("customer/daftar_alamat/ajax_save"); ?>';
				}else{
					var url = '<?php echo base_url("customer/daftar_alamat/ajax_ubah"); ?>';
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
								Swal.fire({text: obj.message,title: "Error",type: "error"});
							}else {
								Swal.fire({text: obj.message,title: "Sukses",type: "success"});
								$('#modal_tambah').modal('hide');
								table_data();
							}

							$('#btnSave').text('Simpan'); //change button text
            				$('#btnSave').attr('disabled',false); //set button enable
						}else {
							for (var i = 0; i < obj.inputerror.length; i++) {
								$('[name="'+obj.inputerror[i]+'"]').parent().parent().addClass('has-error');
								$('[name="'+obj.inputerror[i]+'"]').next().text(obj.error_string[i]); 
							}
							
							Swal.fire({type: 'error',text: 'Proses Simpan Gagal, Silahkan Lengkapi Data Yang Harus Diisi',title : 'Opps..'});

							$('#btnSave').text('Simpan'); //change button text
            				$('#btnSave').attr('disabled',false); //set button enable
						}
					}
				});
			}else{
	        	return false;
	      	}
	    })
    }

    function lihat_data(id){
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

	function ubah_data(id){
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
               	if(data.utama != 0){
               		$('[name="utama"]').prop('checked', true);
               	}
				$('[name="id"]').val(id);               	
				$('[name="nama_alamat"]').val(data.nama_alamat);
				$('[name="alamat"]').val(data.alamat);
				$('[name="nama_penerima"]').val(data.nama_penerima);
				$('[name="no_penerima"]').val(data.no_penerima);

				get_prop(data.id_prop);
				get_kab(data.id_kota);
				get_kec(data.id_kec);
				get_kel(data.id_kel);

                $('#modal_tambah').modal('show');
                $('.modal-title').text('Ubah Data Alamat');
           	},
           	error: function (jqXHR, textStatus, errorThrown){
                alert('Error get data from ajax');
           	}
        });
	}

	function hapus_data(id){
		Swal.fire({
	      title: 'Konfirmasi Hapus',
	      text: "Apakah data ini ingin dihapus?",
	      type: 'question',
	      showCancelButton: true,
	      confirmButtonColor: '#3085d6',
	      cancelButtonColor: '#d33',
	      confirmButtonText: 'Ya',
	      cancelButtonText: 'Tidak',
	    }).then((result) => {
	      	if (result.value) {
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
							Swal.fire({text: obj.message,title: "Error",type: "error"});
						}else {
							Swal.fire({text: obj.message,title: "Sukses",type: "success"});
							table_data();
						}
					}
				});
			}else{
	        	return false;
	      	}
	    })
	}
</script>