<style>
	/* Important part */
	.modal-dialog{
	    overflow-y: initial !important;
	}
	.modal-body{
	    height: 400px;
	    overflow-y: auto;
	}
</style>

<div class="col-md-12">
	<div class="row">
		<div class="col-md- col-sm-6 col-xs-12">
			<button type="button" class="btn btn-gradient tambah_data">
				<i class="fa fa-plus"></i> &nbsp; Tambah
			</button>
			<button type="button" class="btn" onclick="table_data()">
				<i class="fa fa-undo"></i> &nbsp; Refresh
			</button>
		</div>
		<div class="col-md-4 col-sm-6 col-xs-12">
			<div class="form-group row">
			    <label for="filter_alamat" class="col-sm-4 col-form-label">Pencarian</label>
			    <div class="col-sm-8">
			      <input type="text" name="filter_alamat" placeholder="Cari Alamat" required="" class="filter_alamat form-control" maxlength="20">
			    </div>
			 </div>
		</div>
	</div>
	<table class="table table-hover tabel" id="tabel">
		<thead>
			<tr>
				<th> </th>
				<th>Nama Alamat</th>
				<th>Nama Penerima</th>
				<th>Nomor Penerima</th>
				<th>Propinsi</th>
				<th>Kota / Kabupaten</th>
				<th>Kecamatan</th>
				<th>Kelurahan</th>
				<th class="text-center">Aksi</th>
			</tr>
		</thead>
		<tbody>

		</tbody>
	</table>
</div>

<div id="modal_tambah" class="modal fade" data-backdrop="false">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle"></h5>
				<button type="button" class="close" onclick="tutup_tambah()"><span aria-hidden="true">&times;</span></button>
			</div>
			<form action="" id="add_tambah">
				<div class="modal-body">
					<input type="hidden" name="<?=$name;?>" value="<?=$hash;?>" />
					<input type="hidden" name="type" value="data_alamat">
					<input type="hidden" name="id">
					<div class="position-relative row form-group">
						<label class="col-sm-3 col-form-label" style="font-weight:600">Utama</label>
						<div class="col-lg-9">
							<input type="checkbox" name="utama" value="1">
							<span class="help"></span>
						</div>
					</div>
					<div class="position-relative row form-group">
						<label class="col-sm-3 col-form-label" style="font-weight:600">Nama Alamat*</label>
						<div class="col-lg-9">
							<input type="text" name="nama_alamat" class="form-control" placeholder="Contoh : Rumah atau Kantor atau dsb">
							<span class="help"></span>
						</div>
					</div>
					<div class="position-relative row form-group">
						<label class="col-sm-3 col-form-label" style="font-weight:600">Nama Penerima*</label>
						<div class="col-lg-9">
							<input type="text" name="nama_penerima" class="form-control">
							<span class="help"></span>
						</div>
					</div>
					<div class="position-relative row form-group">
						<label class="col-sm-3 col-form-label" style="font-weight:600">Nomor Penerima*</label>
						<div class="col-lg-9">
							<input type="text" name="no_penerima" class="form-control" onkeypress="return Angkasaja(event)" maxlength="20">
							<span class="help"></span>
						</div>
					</div>
					<div class="position-relative row form-group">
						<label class="col-sm-3 col-form-label" style="font-weight:600">Propinsi*</label>
						<div class="col-lg-9">
							<select name="id_prop" class="form-control select2" onchange="get_kab()">
								
							</select>
							<input type="hidden" name="nama_prop">
							<span class="help"></span>
						</div>
					</div>
					<div class="position-relative row form-group">
						<label class="col-sm-3 col-form-label" style="font-weight:600">Kota / Kabupaten*</label>
						<div class="col-lg-9">
							<select name="id_kota" class="form-control select2" onchange="get_kec()">
								
							</select>
							<input type="hidden" name="nama_kota">
							<span class="help"></span>
						</div>
					</div>
					<div class="position-relative row form-group">
						<label class="col-sm-3 col-form-label" style="font-weight:600">Kecamatan*</label>
						<div class="col-lg-9">
							<select name="id_kec" class="form-control select2" onchange="get_kel()">
								
							</select>
							<input type="hidden" name="nama_kec">
							<span class="help"></span>
						</div>
					</div>
					<div class="position-relative row form-group">
						<label class="col-sm-3 col-form-label" style="font-weight:600">Kelurahan*</label>
						<div class="col-lg-9">
							<select name="id_kel" class="form-control select2" onchange="set_nama_kel()">
								
							</select>
							<input type="hidden" name="nama_kel">
							<span class="help"></span>
						</div>
					</div>
					<div class="position-relative row form-group">
						<label class="col-sm-3 col-form-label" style="font-weight:600">Alamat*</label>
						<div class="col-lg-9">
							<textarea name="alamat" class="form-control" rows="5" style="resize: none;" placeholder="Tulis No. Rumah, Blok, RT/RW, Kode Pos, dll"></textarea>
							<input type="hidden" name="data_alamat">
							<span class="help"></span>
						</div>
					</div>
				</div>

				<div class="modal-footer">
					<button type="button"  class="btn" onclick="tutup_tambah()">Tutup</button>
					<button type="button" onclick="simpan_data()" id="btnSave" class="btn btn-gradient">
						Simpan
					</button>
				</div>
			</form>
		</div>
	</div>
</div>
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
			autoWidth:false,
			aLengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
			ajax: {
				url: '<?php echo base_url('ajax/ajax_list')?>',
				type: 'POST',
				data: function (data) {
					data.filter = {
						'nama'		: $('.filter_alamat').val(),
					};
					data.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
					data.type ='alamat';
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

	function tutup_tambah(){
		$('#modal_tambah').modal('hide');
	}

	function table_data(){
		dataTable.ajax.reload(null,true);
	}

	$(".filter_alamat").keyup(function(){
        table_data();
	});

    $(".load_table").click(function(){
        table_data();
    });

    $(".tambah_data").click(function(event){
		save_method = 'add';
		$('#add_tambah')[0].reset();
		$('.form-group').removeClass('has-error');
		$('.help').empty();
		get_prop();
		$('#modal_tambah').modal('show');
		$('#modal_tambah .modal-title').text('Tambah Daftar Alamat');
    });

    function get_prop(){
    	$.ajax({
			url : '<?php echo base_url("dashboard/ajax_data"); ?>',
			type: 'post',
			async:false,
			dataType:'html',
			data: {
				type : 'data_propinsi',
				<?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
			},
			success: function (data) {
				$('#modal_tambah [name="id_prop"]').html(DOMPurify.sanitize( data, { SAFE_FOR_JQUERY: true } ));
				$('#modal_tambah [name="id_kota"]').html('');
				$('#modal_tambah [name="id_kec"]').html('');
				$('#modal_tambah [name="id_kel"]').html('');
			}
		});
    }

    function get_kab(){
    	var id_prop = $('#modal_tambah [name="id_prop"]').val();

    	var nama_prop = $("[name='id_prop'] option:selected").text();
        $("[name='nama_prop']").val(nama_prop);

    	$.ajax({
			url : '<?php echo base_url("dashboard/ajax_data"); ?>',
			type: 'post',
			async:false,
			dataType:'html',
			data: {
				data_propinsi: id_prop,
				type : 'data_kota',
				<?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
			},
			success: function (data) {
				if(id_prop == 0){
					$('#modal_tambah [name="id_kota"]').html('');
					$('#modal_tambah [name="id_kec"]').html('');
					$('#modal_tambah [name="id_kel"]').html('');
				}else{
					$('#modal_tambah [name="id_kota"]').html(DOMPurify.sanitize( data, { SAFE_FOR_JQUERY: true } ));
					$('#modal_tambah [name="id_kec"]').html('');
					$('#modal_tambah [name="id_kel"]').html('');				
				}
			}
		});
    }

    function get_kec(){
    	var id_prop = $('#modal_tambah [name="id_prop"]').val();
    	var id_kota = $('#modal_tambah [name="id_kota"]').val();

    	var nama_kota = $("[name='id_kota'] option:selected").text();
        $("[name='nama_kota']").val(nama_kota);

    	$.ajax({
			url : '<?php echo base_url("dashboard/ajax_data"); ?>',
			type: 'post',
			async:false,
			dataType:'html',
			data: {
				data_propinsi: id_prop,
				data_kota : id_kota,
				type : 'data_kecamatan',
				<?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
			},
			success: function (data) {
				if(id_kota == 0){
					$('#modal_tambah [name="id_kec"]').html('');
					$('#modal_tambah [name="id_kel"]').html('');
				}else{
					$('#modal_tambah [name="id_kec"]').html(DOMPurify.sanitize( data, { SAFE_FOR_JQUERY: true } ));	
					$('#modal_tambah [name="id_kel"]').html('');				
				}
			}
		});
    }

    function get_kel(){
    	var id_prop = $('#modal_tambah [name="id_prop"]').val();
    	var id_kota = $('#modal_tambah [name="id_kota"]').val();
    	var id_kec = $('#modal_tambah [name="id_kec"]').val();

    	var nama_kec = $("[name='id_kec'] option:selected").text();
        $("[name='nama_kec']").val(nama_kec);

    	$.ajax({
			url : '<?php echo base_url("dashboard/ajax_data"); ?>',
			type: 'post',
			async:false,
			dataType:'html',
			data: {
				data_propinsi: id_prop,
				data_kota : id_kota,
				data_kec : id_kec,
				type : 'data_kelurahan',
				<?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
			},
			success: function (data) {
				if(id_kec == 0){
					$('#modal_tambah [name="id_kel"]').html('');
				}else{
					$('#modal_tambah [name="id_kel"]').html(DOMPurify.sanitize( data, { SAFE_FOR_JQUERY: true } ));					
				}
			}
		});
    }

    function set_nama_kel(){
    	var nama_kel = $("[name='id_kel'] option:selected").text();
        $("[name='nama_kel']").val(nama_kel);
    }

    function simpan_data(){
		Swal.fire({
	      title: 'Konfirmasi',
	      text: "Apakah anda ingin menyimpan data alamat ?",
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
							
						}else {
							for (var i = 0; i < obj.inputerror.length; i++) {
								$('[name="'+obj.inputerror[i]+'"]').parent().parent().addClass('has-error');
								$('[name="'+obj.inputerror[i]+'"]').next().text(obj.error_string[i]); 
							}
							Swal.fire({type: 'warning',text: 'Gagal menyimpan data, silahkan lengkapi data yang harus diisi !',title : 'Peringatan'});
						}

						$('#btnSave').text('Simpan'); //change button text
	        			$('#btnSave').attr('disabled',false); //set button enable
					},
	               	error: function (jqXHR, textStatus, errorThrown){
	                    alert('Error get data from ajax');
	               	}
				});
			}else{
	        	return false;
	      	}
	    });
    }


	function ubah_data(id){
		save_method = 'edit';
		$('#add_tambah')[0].reset();
		$('.form-group').removeClass('has-error');
		$('.help').empty();

        $.ajax({
           	url : "<?php echo base_url('customer/daftar_alamat/ajax_lihat')?>",
           	type: "POST",
           	data : {
                id   : id,
                <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
           	},
           	dataType: "JSON",
           	success: function(data){
           		if(data.utama != 0){
           			$('#modal_tambah [name="utama"]').prop('checked', true);
           		}
				$('#modal_tambah [name="id"]').val(id);               	
				$('#modal_tambah [name="nama_alamat"]').val(data.nama_alamat);
				$('#modal_tambah [name="alamat"]').val(data.alamat);
				$('#modal_tambah [name="nama_penerima"]').val(data.nama_penerima);
				$('#modal_tambah [name="no_penerima"]').val(data.no_penerima);

				get_prop();
				$('#modal_tambah [name="id_prop"]').val(data.id_prop).change();
				$('#modal_tambah [name="id_kota"]').val(data.id_kota).change();
				$('#modal_tambah [name="id_kec"]').val(data.id_kec).change();
				$('#modal_tambah [name="id_kel"]').val(data.id_kel).change();

                $('#modal_tambah').modal('show');
                $('#modal_tambah .modal-title').text('Ubah Daftar Alamat');
           	},
           	error: function (jqXHR, textStatus, errorThrown){
                alert('Error get data from ajax');
           	}
        });
	}

	function hapus_data(id){
		Swal.fire({
	      title: 'Konfirmasi',
	      text: "Apakah anda ingin menghapus data alamat ?",
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
	    });
	}
	function pilih_data(){
		var id = $('[name="id_data_alamat"]:checked').val();
		if(id){
			$.ajax({
				url : "<?php echo base_url('ajax/ajax_data')?>",
				type: "POST",
				data : {
					type : 'data_alamat',
					<?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>',
					id : id,
				},
				dataType: "html",
				success: function(data){
					$('.nama_alamat').html(DOMPurify.sanitize( data, { SAFE_FOR_JQUERY: true } ));
					$.each(arr_keranjang, function(i, val) {
						get_ongkir(val.id_umkm);
					});

					$('#modal_alamat').modal('hide');
				},
				error: function (jqXHR, textStatus, errorThrown){
					alert('Error get data from ajax');
				}
			});
		}else{
			Swal.fire({text: 'Data Alamat Belum Dipilih',title: "Perhatian",type: "warning"});
		}
	}
</script>
