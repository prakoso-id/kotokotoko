<script type="text/javascript" src="https://cdn.rawgit.com/taromero/swal-forms/master/live-demo/sweet-alert.js"></script>
<script type="text/javascript" src="https://cdn.rawgit.com/taromero/swal-forms/master/swal-forms.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">

<div class="product-body">
	<div class="row">
		<div class="col-md-12">
			<div class="section-title">
				<h3 class="title">
					DATA UMKM
				</h3>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="store-filter clearfix">
			<div class="pull-left">
				<div class="sort-filter">
					<span class="text-uppercase">Sumber Data:</span>
					<select class="input select2" name="filter_sumber" id="filter_sumber">
						<option value="">--Semua--</option>
						<option value="sidata">SIDATA</option>
						<option value="umkm">UMKM</option>
					</select>
				</div>
				<div class="sort-filter">
					<span class="text-uppercase">IUMK:</span>
					<select class="input select2" name="filter_iumk" id="filter_iumk">
						<option value="">--Semua--</option>
						<option value="punya">Punya</option>
						<option value="belum_punya">Belum Punya</option>
					</select>
				</div>
				<div class="sort-filter">
					<span class="text-uppercase">Status Verif:</span>
					<select class="input select2" name="filter_status_verif" id="filter_status_verif">
						<option value="">--Semua--</option>
						<?php foreach ($m_status as $sts) {
							echo '<option value="'.$sts->id_status.'">'.$sts->nama.'</option>';
						} ?>
					</select>
				</div>
			</div>
			<div class="pull-right">
				<button type="button" class="btn btn-success button_action" id="btnRefresh">
					<i class="fa fa-undo"></i> &nbsp; Refresh
				</button>
			</div>
		</div>
	</div>
	<hr>
	<div class="row" style="margin-bottom: 10px; margin-top: 10px;">
	  <div class="col-md-4 col-sm-6 col-12">
	    <div class="card">
	      <div class="card-body">
	      	<div class="row">
	      		<div class="col-md-2">
	      		<i class="fa fa-th-list fa-2x"></i>
		      	</div>
		      	<div class="col-md-10">
		      		<h5 class="card-title">Total UMKM</h5>
		        	<h3 class="jum_umkm_all">0</h3>
		      	</div>
	      	</div>
	      </div>
	    </div>
	  </div>
	  <div class="col-md-4 col-sm-6 col-12">
	    <div class="card">
	      <div class="card-body">
	      	<div class="row">
	      		<div class="col-md-2">
		      		<i class="fa fa-check-square fa-2x"></i>
		      	</div>
		      	<div class="col-md-10">
		      		<h5 class="card-title">Sudah Terverifikasi</h5>
		        	<h3 class="jum_verif_diterima">0</h3>
		      	</div>
	      	</div>
	      </div>
	    </div>
	  </div>
	  <div class="col-md-4 col-sm-6 col-12">
	    <div class="card">
	      <div class="card-body">
	      	<div class="row">
	      		<div class="col-md-2">
		      		<i class="fa fa-hourglass-start fa-2x"></i>
		      	</div>
		      	<div class="col-md-10">
		      		<h5 class="card-title">Belum Terverifikasi</h5>
		        	<h3 class="jum_verif_menunggu">0</h3>
		      	</div>
	      	</div>
	      </div>
	    </div>
	  </div>
	</div>
	<hr>
	<table class="table table-hover tabel" id="tabel">
		<thead>
			<tr>
				<th>No</th>
				<th>Nama Usaha</th>
				<th>Nama Pemilik</th>
				<th>Jenis Usaha</th>
				<th>Status</th>
				<th>Sumber</th>
				<th>IUMK</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>

		</tbody>
	</table>
</div>
<hr>
<div class="product-body">
	<div class="row">
		<div class="col-md-12">
			<div class="section-title">
				<h3 class="title">
					DATA PRODUK
				</h3>
			</div>
		</div>
	</div>
	<div class="row" style="margin-bottom: 10px; margin-top: 10px;">
	  <div class="col-md-4 col-sm-6 col-12">
	  	<a href="javascript:void(0);" onclick="list_produk()">
		    <div class="card">
		      <div class="card-body">
		      	<div class="row">
		      		<div class="col-md-2">
		      		<i class="fa fa-th-list fa-2x"></i>
			      	</div>
			      	<div class="col-md-10">
			      		<h5 class="card-title">Total Produk</h5>
			        	<h3 class="jum_produk_all">0</h3>
			      	</div>
		      	</div>
		      </div>
		    </div>
		</a>
	  </div>
	  <div class="col-md-4 col-sm-6 col-12">
	  	<a href="javascript:void(0);" onclick="list_produk(null,'Aktif',1)">
		    <div class="card">
		      <div class="card-body">
		      	<div class="row">
		      		<div class="col-md-2">
			      		<i class="fa fa-check-square fa-2x"></i>
			      	</div>
			      	<div class="col-md-10">
			      		<h5 class="card-title">Aktif</h5>
			        	<h3 class="jum_produk_aktif">0</h3>
			      	</div>
		      	</div>
		      </div>
		    </div>
		</a>
	  </div>
	  <div class="col-md-4 col-sm-6 col-12">
	  	<a href="javascript:void(0);" onclick="list_produk(null,'Tidak Aktif',2)">
		    <div class="card">
		      <div class="card-body">
		      	<div class="row">
		      		<div class="col-md-2">
			      		<i class="fa fa-window-close fa-2x"></i>
			      	</div>
			      	<div class="col-md-10">
			      		<h5 class="card-title">Tidak Aktif</h5>
			        	<h3 class="jum_produk_nonaktif">0</h3>
			      	</div>
		      	</div>
		      </div>
		    </div>
		</a>
	  </div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<h5>Produk Berdasarkan Kategori</h5>
		</div>
		<div class="data-produk-kategori">
			
		</div>
	</div>
</div>
<hr>
<div class="product-body">
	<div class="row">
		<div class="col-md-12">
			<div class="section-title">
				<h3 class="title">
					DATA TRANSAKSI
				</h3>
			</div>
		</div>
	</div>
	<div class="row" style="margin-bottom: 10px; margin-top: 10px;">
		<div class="col-md-6">
			<div class="list-group">
			  	<a href="javascript:void(0);" onclick="list_transaksi()" class="list-group-item list-group-item-action">
			  		<i class="fa fa-th-list"></i> 
			  		Total Transaksi
			  		<span class="badge badge-primary badge-pill jum_transaksi">0</span>
			  	</a>
			  	<a href="javascript:void(0);" onclick="list_transaksi(0,'Menunggu Pembayaran')" class="list-group-item list-group-item-action">
			  		<i class="fa fa-credit-card"></i> 
			  		Menunggu Pembayaran
			  		<span class="badge badge-primary badge-pill jum_menunggu_pembayaran">0</span>
			  	</a>
			  	<a href="javascript:void(0);" onclick="list_transaksi(1,'Menunggu Konfirmasi')" class="list-group-item list-group-item-action">
			  		<i class="fa fa-hourglass-start"></i> 
			  		Menunggu Konfirmasi
			  		<span class="badge badge-primary badge-pill jum_menunggu_konfirmasi">0</span>
			  	</a>
			  	<a href="javascript:void(0);" onclick="list_transaksi(2,'Pesanan Diproses')" class="list-group-item list-group-item-action">
			  		<i class="fa fa-check-square"></i> 
			  		Pesanan Diproses
			  		<span class="badge badge-primary badge-pill jum_diproses">0</span>
			  	</a>
			</div>
		</div>
		<div class="col-md-6">
			<div class="list-group">
			  	<a href="javascript:void(0);" onclick="list_transaksi(2,'Sedang Dikirim')" class="list-group-item list-group-item-action">
			  		<i class="fa fa-truck"></i> 
			  		Sedang Dikirim
			  		<span class="badge badge-primary badge-pill jum_dikirim">0</span>
			  	</a>
			  	<a href="javascript:void(0);" onclick="list_transaksi(4,'Sampai Tujuan & Selesai')" class="list-group-item list-group-item-action">
			  		<i class="fa fa-check"></i> 
			  		Sampai Tujuan & Selesai
			  		<span class="badge badge-primary badge-pill jum_sampai">0</span>
			  	</a>
			  	<a href="javascript:void(0);" onclick="list_transaksi(5,'Dibatalkan')" class="list-group-item list-group-item-action">
			  		<i class="fa fa-window-close"></i> 
			  		Dibatalkan
			  		<span class="badge badge-primary badge-pill jum_batal">0</span>
			  	</a>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div id="modal_produk" class="modal fade" data-backdrop="false">
	<div class="modal-dialog modal-full">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Daftar Produk <span class="ket_title_produk"></span></h5>
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
			</div>
			<form action="" id="add_data">
				<div class="modal-body">
					<table id="table_produk" class="table table-bordered table-striped table-hover">
						<thead>
							<tr>
								<th width="2%">No</th>
								<th>Nama Produk</th>
								<th>Nama UMKM</th>
								<th>Stok</th>
								<th>Harga</th>
								<th>Ketegori</th>
								<th>Status</th>
								<th width="2%">Aksi</th>
							</tr>
						</thead>
						<tbody>

						</tbody>
					</table>
				</div>
				<div class="modal-footer">
					<button type="button"  class="btn btn-danger" data-dismiss="modal">Tutup</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div id="modal_transaksi" class="modal fade" data-backdrop="false">
	<div class="modal-dialog modal-full">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Daftar Transaksi <span class="ket_title_transaksi"></span></h5>
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
			</div>
			<form action="" id="add_data">
				<div class="modal-body">
					<table id="table_transaksi" class="table table-bordered table-striped table-hover">
						<thead>
							<tr>
								<th width="2%">No</th>
								<th>Tanggal Pemesanan</th>
								<th>Nomor Invoice</th>
								<th>Pembeli</th>
								<th>Penjual</th>
								<th>Total Belanja</th>
								<th>Status</th>
								<th width="2%">Aksi</th>
							</tr>
						</thead>
						<tbody>

						</tbody>
					</table>
				</div>
				<div class="modal-footer">
					<button type="button"  class="btn btn-danger" data-dismiss="modal">Tutup</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
var table;
$(document).ready(function(){
	$('.select2').select2();
	get_detail_rekap();

	//datatables
    table = $('#tabel').DataTable({ 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        "width" : '100%',

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('dashboard/ajax_list')?>",
            "type": "POST",
            "data": function ( data ) {
            	data.sumber = $('[name="filter_sumber"]').val();
            	data.iumk = $('[name="filter_iumk"]').val();
            	data.status_verif = $('[name="filter_status_verif"]').val();
                data.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
                data.type = 'umkm';
            }
        },

        //Set column definition initialisation properties.
        "columnDefs": [
            { "targets": [ 0,7 ],"orderable": false},
        ],
    });

    get_rekap_produk_by_status();
    get_rekap_produk_by_kategori();
    get_rekap_transaksi();

    $("#filter_sumber").change(function(){
    	get_detail_rekap();
        reload_table();
    });

    $("#filter_iumk").change(function(){
    	get_detail_rekap();
        reload_table();
    });

    $("#filter_status_verif").change(function(){
        reload_table();
    });

    $("#btnRefresh").click(function(){
    	get_detail_rekap();
        reload_table();
    });
});

function reload_table(){
    table.ajax.reload(null,false);
}

function get_detail_rekap(){
	var sumber = $('[name="filter_sumber"]').val();
	var iumk = $('[name="filter_iumk"]').val();
    $.ajax({ 
        url: "<?php echo base_url('dashboard/ajax_data') ?>",
        method:"POST",
        data : {
            sumber : sumber,
            iumk : iumk,
            type : 'detail_rekap_umkm',
            <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
        },
        dataType: "json",
        success: function(data) {
            $('.jum_umkm_all').text((data.data.jum_umkm_all == null) ? "0" : data.data.jum_umkm_all);
            $('.jum_verif_diterima').text((data.data.jum_verif_diterima == null) ? "0" : data.data.jum_verif_diterima);
            $('.jum_verif_menunggu').text((data.data.jum_verif_menunggu == null) ? "0" : data.data.jum_verif_menunggu);
        }   
    });
}

function get_rekap_produk_by_status(){
	$.ajax({ 
        url: "<?php echo base_url('dashboard/ajax_data') ?>",
        method:"POST",
        data : {
            type : 'detail_rekap_produk_by_status',
            <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
        },
        dataType: "json",
        success: function(data) {
        	var data = data.data;
            $('.jum_produk_all').text(data.jum_produk);
            $('.jum_produk_aktif').text(data.jum_aktif);
            $('.jum_produk_nonaktif').text(data.jum_nonaktif);        
        }   
    });
}

function get_rekap_produk_by_kategori(){
	$.ajax({ 
        url: "<?php echo base_url('dashboard/ajax_data') ?>",
        method:"POST",
        data : {
            type : 'detail_rekap_produk_by_kategori',
            <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
        },
        dataType: "html",
        success: function(data) {
        	$('.data-produk-kategori').html(DOMPurify.sanitize( data, { SAFE_FOR_JQUERY: true } ));
       	}   
    });
}

function get_rekap_transaksi(){
	$.ajax({ 
        url: "<?php echo base_url('dashboard/ajax_data') ?>",
        method:"POST",
        data : {
            type : 'detail_rekap_transaksi',
            <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
        },
        dataType: "json",
        success: function(data) {
        	var data = data.data;
            $('.jum_transaksi').text(data.jum_transaksi);
            $('.jum_menunggu_pembayaran').text(data.jum_menunggu_pembayaran);
            $('.jum_menunggu_konfirmasi').text(data.jum_menunggu_konfirmasi);
            $('.jum_diproses').text(data.jum_diproses);
            $('.jum_dikirim').text(data.jum_dikirim);
            $('.jum_sampai').text(data.jum_sampai);
            $('.jum_batal').text(data.jum_batal);
        }   
    });
}

function list_transaksi(id_status_transaksi=null,ket=null){
	$('#table_transaksi').DataTable().destroy();
	dataTable = $('#table_transaksi').DataTable( {
		paginationType:'full_numbers',
		processing: true,
		serverSide: true,
		// filter: false,
		autoWidth:false,
		aLengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
		ajax: {
			url: '<?php echo base_url('dashboard/ajax_list')?>',
			type: 'POST',
			data: function (data) {
				data.filter = {
					'status' : id_status_transaksi,
				};
				data.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
				data.type = 'transaksi';
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
			{'data':'no','orderable':false,"className": "text-center"},
            {'data':'created_transaksi'},
            {'data':'no_invoice'},
            {'data':'nama'},
            {'data':'namausaha'},
            {'data':'total',"className": "text-right"},
            {'data':'nama_status'},
            {'data':'aksi','orderable':false,"className": "text-center"},
		],
	});

	if (ket) {
		$('.ket_title_transaksi').text('('+ket+')');
	}
	$('#modal_transaksi').modal('show');
}

function detail_transaksi(id_transaksi){
    $.redirect(
    	'<?php echo base_url(); ?>transaksi/admin',
    	{
    		id_transaksi:id_transaksi,
    		<?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
    	}
    );
}

function list_produk(id_jenis_usaha=null,ket=null,status=null){
	$('#table_produk').DataTable().destroy();
	dataTable = $('#table_produk').DataTable( {
		paginationType:'full_numbers',
		processing: true,
		serverSide: true,
		// filter: false,
		autoWidth:false,
		aLengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
		ajax: {
			url: '<?php echo base_url('dashboard/ajax_list')?>',
			type: 'POST',
			data: function (data) {
				data.filter = {
					'group' : id_jenis_usaha,
					'status' : status,
				};
				data.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
				data.type = 'produk';
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
            {'data':'no','orderable':false,"className": "text-center"},
            {'data':'nama_produk'},
            {'data':'namausaha'},
            {'data':'stok',"className": "text-center"},
            {'data':'harga',"className": "text-right"},
            {'data':'nama_usaha'},
            {'data':'status',"className": "text-center"},
            {'data':'aksi','orderable':false,"className": "text-center"},
		],
	});

	if (ket) {
		$('.ket_title_produk').text('('+ket+')');
	}
	$('#modal_produk').modal('show');
}
</script>

<?php $this->load->view('detail_umkm'); ?>
