<section class="section">
    <div class="section-header">
        <h1><?php echo $title_beranda; ?></h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><?php echo $title_beranda; ?></div>
        </div>
    </div>

<?=$this->session->flashdata('message')?>

<div class="section-body">
    <div class="row">
        <div class="col-12 col-sm-12 col-lg-12">
            <div class="card card-danger">
                <div class="card-header">
                    <h4>DATA PRODUK</h4>
                    <div class="card-header-action">
                        <a class="btn btn-icon btn-secondary" href="javascript:void(0);" onclick="refresh_produk();" title="Refresh"><i class="fas fa-sync"></i></a>
                        <a data-collapse="#card-produk" class="btn btn-icon btn-danger" href="#"><i class="fas fa-minus"></i></a>
                    </div>
                </div>
                <div class="collapse show" id="card-produk">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                <div class="card card-statistic-1" onclick="list_produk(null,'Semua Produk',null,null)" style="cursor: pointer;">
                                    <div class="card-icon bg-primary">
                                    <i class="far fa-list-alt"></i>
                                    </div>
                                    <div class="card-wrap">
                                        <div class="card-header">
                                            <h4>Total Produk</h4>
                                        </div>
                                        <div class="card-body jum_produk_all">
                                    
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                <div class="card card-statistic-1" onclick="list_produk(null,'Aktif',1,null)" style="cursor: pointer;">
                                    <div class="card-icon bg-success">
                                        <i class="far fa-check-square"></i>
                                    </div>
                                    <div class="card-wrap">
                                        <div class="card-header">
                                            <h4>Aktif</h4>
                                        </div>
                                        <div class="card-body jum_produk_aktif">
                                
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                <div class="card card-statistic-1" onclick="list_produk(null,'Tidak Aktif',2,null)" style="cursor: pointer;">
                                    <div class="card-icon bg-danger">
                                        <i class="far fa-window-close"></i>
                                    </div>
                                    <div class="card-wrap">
                                        <div class="card-header">
                                            <h4>Tidak Aktif</h4>
                                        </div>
                                        <div class="card-body jum_produk_nonaktif">
                                
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                              <div class="card card-statistic-1" onclick="list_produk(null,'Stok Tersedia',null,'tersedia')" style="cursor: pointer;">
                                <div class="card-icon bg-success">
                                  <i class="fas fa-boxes"></i>
                                </div>
                                <div class="card-wrap">
                                  <div class="card-header">
                                    <h4>Stok Tersedia</h4>
                                  </div>
                                  <div class="card-body jum_produk_tersedia">
                                    
                                  </div>
                                </div>
                              </div>
                            </div> 

                            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                              <div class="card card-statistic-1" onclick="list_produk(null,'Stok Habis',null,'habis')" style="cursor: pointer;">
                                <div class="card-icon bg-danger">
                                  <i class="fas fa-box-open"></i>
                                </div>
                                <div class="card-wrap">
                                  <div class="card-header">
                                    <h4>Stok Habis</h4>
                                  </div>
                                  <div class="card-body jum_produk_habis">
                                    
                                  </div>
                                </div>
                              </div>
                            </div>                  
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Produk Terbaik</h4>
                                    </div>
                                    <div class="card-body">
                                        <?php 
                                        if ($produk_terbaik) { 
                                            echo '<div class="owl-carousel owl-theme" id="products-carousel">';
                                            foreach ($produk_terbaik as $value) {
                                                $jumlah = 5 - $value->ratting;
                                                 $icon_star = ''; 
                                                 for($i=0; $i<$value->ratting; $i++){
                                                      $icon_star .= '<i class="fa fa-star"></i>';
                                                 }

                                                 for($i=0; $i<$jumlah; $i++){
                                                      $icon_star .= '<i class="fa fa-star" style="color:#dfdfdf;"></i>';
                                                 }
                                                echo '<div>
                                                        <div class="product-item pb-3">
                                                            <div class="product-image">
                                                                <img alt="image" src="'.base_url('assets/produk/'.$value->id_umkm.'/'.$value->foto).'" class="img-fluid">
                                                            </div>
                                                            <div class="product-details">
                                                                <div class="product-name">'.readMore($value->nama_produk,20).'</div>
                                                                <div class="product-review">
                                                                    '.$icon_star.'
                                                                </div>
                                                                <div class="text-muted text-small">'.$value->jum_terjual.' Terjual</div>
                                                                <div class="product-cta">
                                                                    <a href="javascript:void(0);" onclick="lihat_produk('.$value->id_produk.',`detail`)" class="btn btn-danger">Detail</a>
                                                                </div>
                                                            </div>  
                                                        </div>
                                                    </div>';
                                            }
                                            echo '</div>';
                                        }else{
                                            echo '<span>Belum ada produk yang terjual...</span>';
                                        } 
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>   
            </div>

            <div class="card card-danger">
                <div class="card-header">
                    <h4>DATA TRANSAKSI PENJUALAN</h4>
                    <div class="card-header-action">
                        <a class="btn btn-icon btn-secondary" href="javascript:void(0);" onclick="get_rekap_transaksi();" title="Refresh"><i class="fas fa-sync"></i></a>
                        <a data-collapse="#card-transaksi" class="btn btn-icon btn-danger" href="#"><i class="fas fa-minus"></i></a>
                    </div>
                </div>
                <div class="collapse show" id="card-transaksi">
                    <div class="card-body">
                        <div class="row" style="margin-bottom: 10px; margin-top: 10px;">
                            <div class="col-md-6">
                                <div class="list-group">
                                    <a href="javascript:void(0);" onclick="list_transaksi()" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                        <i class="fa fa-fw fa-th-list"></i> 
                                        Total Transaksi
                                        <span class="badge badge-danger badge-pill jum_transaksi">0</span>
                                    </a>
                                    <a href="javascript:void(0);" onclick="list_transaksi(0,'Menunggu Pembayaran')" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                        <i class="fa fa-fw fa-credit-card"></i> 
                                        Menunggu Pembayaran
                                        <span class="badge badge-danger badge-pill jum_menunggu_pembayaran">0</span>
                                    </a>
                                    <a href="javascript:void(0);" onclick="list_transaksi(1,'Menunggu Konfirmasi')" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                        <i class="fa fa-fw fa-hourglass-start"></i> 
                                        Menunggu Konfirmasi
                                        <span class="badge badge-danger badge-pill jum_menunggu_konfirmasi">0</span>
                                    </a>
                                    <a href="javascript:void(0);" onclick="list_transaksi(2,'Pesanan Diproses')" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                        <i class="fa fa-fw fa-check-square"></i> 
                                        Pesanan Diproses
                                        <span class="badge badge-danger badge-pill jum_diproses">0</span>
                                    </a>
                                    <a href="javascript:void(0);" onclick="list_transaksi(2,'Sedang Dikirim')" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                        <i class="fa fa-fw fa-truck"></i> 
                                        Sedang Dikirim
                                        <span class="badge badge-danger badge-pill jum_dikirim">0</span>
                                    </a>
                                    <a href="javascript:void(0);" onclick="list_transaksi(4,'Sampai Tujuan & Selesai')" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                        <i class="fa fa-fw fa-check"></i> 
                                        Sampai Tujuan & Selesai
                                        <span class="badge badge-danger badge-pill jum_sampai">0</span>
                                    </a>
                                    <a href="javascript:void(0);" onclick="list_transaksi(5,'Dibatalkan')" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                        <i class="fa fa-fw fa-window-close"></i> 
                                        Dibatalkan
                                        <span class="badge badge-danger badge-pill jum_batal">0</span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="list-group">
                                    <a href="javascript:void(0);" onclick="list_transaksi_e()" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                        <i class="fa fa-fw fa-th-list"></i> 
                                        Total Transaksi e-Order
                                        <span class="badge badge-danger badge-pill jum_transaksi_e">0</span>
                                    </a>
                                    <a href="javascript:void(0);" onclick="list_transaksi_e(1,'Menunggu Konfirmasi')" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                        <i class="fa fa-fw fa-hourglass-start"></i> 
                                        Menunggu Konfirmasi
                                        <span class="badge badge-danger badge-pill jum_menunggu_konfirmasi_e">0</span>
                                    </a>
                                    <a href="javascript:void(0);" onclick="list_transaksi_e(2,'Pesanan Diproses')" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                        <i class="fa fa-fw fa-check-square"></i> 
                                        Pesanan Diproses
                                        <span class="badge badge-danger badge-pill jum_diproses_e">0</span>
                                    </a>
                                    <a href="javascript:void(0);" onclick="list_transaksi_e(2,'Sedang Dikirim')" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                        <i class="fa fa-fw fa-truck"></i> 
                                        Sedang Dikirim
                                        <span class="badge badge-danger badge-pill jum_dikirim_e">0</span>
                                    </a>
                                    <a href="javascript:void(0);" onclick="list_transaksi_e(4,'Sampai Tujuan')" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                        <i class="fa fa-fw fa-check"></i> 
                                        Sampai Tujuan
                                        <span class="badge badge-danger badge-pill jum_sampai_e">0</span>
                                    </a>
                                    <a href="javascript:void(0);" onclick="list_transaksi_e(0,'Pembayaran & Selesai')" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                        <i class="fa fa-fw fa-credit-card"></i> 
                                        Pembayaran & Selesai
                                        <span class="badge badge-danger badge-pill jum_menunggu_pembayaran_e">0</span>
                                    </a>
                                    <a href="javascript:void(0);" onclick="list_transaksi_e(7,'Dibatalkan')" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                        <i class="fa fa-fw fa-window-close"></i> 
                                        Dibatalkan
                                        <span class="badge badge-danger badge-pill jum_batal_e">0</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>    
            </div>
        </div>
    </div>
</div>
</section>

<div id="modal_produk" class="modal fade" data-backdrop="false">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Daftar Produk <span class="ket_title_produk"></span></h5>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
                <div class="modal-body">
                    <div class="table-responsive">
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
                </div>
                <div class="modal-footer">
                    <button type="button"  class="btn btn-icon icon-left btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Tutup</button>
                </div>
        </div>
    </div>
</div>

<div id="modal_transaksi" class="modal fade" data-backdrop="false">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Daftar Transaksi <span class="ket_title_transaksi"></span></h5>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
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
            </div>
            <div class="modal-footer">
                <button type="button"  class="btn btn-icon icon-left btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Tutup</button>
            </div>
        </div>
    </div>
</div>

<div id="modal_invoice" class="modal fade" data-backdrop="false">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Daftar Pesanan <span class="ket_title_transaksi"></span></h5>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="table_transaksi_inv" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th width="2%">ID</th>
                                <th>Produk</th>
                                <th>Jumlah</th>
                                <th>Harga Satuan</th>
                                <th>Total Belanja</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <a id="link_surat_pesanan" href="#" target="_blank" class="btn btn-icon icon-left btn-success"><i class="fas fa-receipt"></i> Surat Pesanan</a>
                <button type="button"  class="btn btn-icon icon-left btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Tutup</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
var table;
$(document).ready(function(){
    $('.select2').select2();
    get_rekap_produk_by_status();
    get_rekap_transaksi();

    $("#products-carousel").owlCarousel({
      items: 6,
      margin: 10,
      autoplay: true,
      autoplayTimeout: 5000,
      loop: false,
      responsive: {
        0: {
          items: 2
        },
        768: {
          items: 4
        },
        1200: {
          items: 6
        }
      }
    });
});

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
            $('.jum_produk_tersedia').text(data.jum_tersedia);
            $('.jum_produk_habis').text(data.jum_habis);   
        }   
    });
}

function list_produk(id_jenis_usaha=null,ket=null,status=null,stok=null){
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
                    'stok' : stok,
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

function lihat_produk(id_produk,type='detail'){
    $.redirect(
        '<?php echo base_url(); ?>produk',
        {
            id_produk:id_produk,
            type:type,
            <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
        }
    );
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

            $('.jum_transaksi_e').text(data.jum_transaksi_e);
            $('.jum_menunggu_pembayaran_e').text(data.jum_menunggu_pembayaran_e);
            $('.jum_menunggu_konfirmasi_e').text(data.jum_menunggu_konfirmasi_e);
            $('.jum_diproses_e').text(data.jum_diproses_e);
            $('.jum_dikirim_e').text(data.jum_dikirim_e);
            $('.jum_sampai_e').text(data.jum_sampai_e);
            $('.jum_batal_e').text(data.jum_batal_e);
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
                data.ket = ket;
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

    $('.ket_title_transaksi').text(ket?'('+ket+')':'');
    $('#modal_transaksi').modal('show');
}

function list_transaksi_e(id_status_transaksi=null,ket=null){
    $('#table_transaksi').DataTable().destroy();
    dataTable = $('#table_transaksi').DataTable( {
        paginationType:'full_numbers',
        processing: true,
        serverSide: true,
        filter: false,
        paging:false,
        info:false,
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
                data.type = 'transaksi_e';
                data.ket = ket;
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

    $('.ket_title_transaksi').text(ket?'('+ket+')':'');
    $('#modal_transaksi').modal('show');
}

function detail_transaksi(id_transaksi){
    $.redirect(
        '<?php echo base_url(); ?>transaksi/penjual',
        {
            id_transaksi:id_transaksi,
            <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
        }
    );
}
function detail_transaksi_e(id_transaksi, status=0){
    $.ajax({ 
        url: "<?php echo base_url('dashboard/ajax_confirm_eorder') ?>",
        method:"POST",
        data : {
            invoice_id : id_transaksi,
            status: status,
            <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
        },
        dataType: "json",
        success: function(data) {
            console.log(data);
            if (data.status.success) {
                if (status === 2)
                    Swal.fire({type: 'success',title: 'Konfirmasi berhasil...',text: 'Pesanan ini telah diterima, harap siapkan pesanan sebelum jatuh tempo pengiriman.'});
                if (status === 3)
                    Swal.fire({type: 'success',title: 'Konfirmasi berhasil...',text: 'Pesanan dikonfirmasi dalam pengiriman.'});
                if (status === 7)
                    Swal.fire({type: 'success',title: 'Konfirmasi berhasil...',text: 'Pesanan ini telah ditolak, bersiap untuk pesanan berikutnya.'});
            }
            $('#table_transaksi').DataTable().ajax.reload();
        }   
    });
}
function show_invoice(invoice_id){
    $('#table_transaksi_inv').DataTable().destroy();
    dataTable = $('#table_transaksi_inv').DataTable( {
        paginationType:'full_numbers',
        processing: true,
        serverSide: true,
        filter: false,
        paging:false,
        info:false,
        autoWidth:false,
        aLengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        ajax: {
            url: '<?php echo base_url('dashboard/ajax_show_invoice')?>',
            type: 'POST',
            data: function (data) {
                data.invoice_id = invoice_id;
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
        order: [0, 'asc'],
        columns: [
            {'data':'p_id','orderable':false,"className": "text-center"},
            {'data':'p_name'},
            {'data':'p_quantity'},
            {'data':'price_satuan'},
            {'data':'price_total'},
            // {'data':'p_created'},
        ],
    });
    $('#link_surat_pesanan').attr('href', 'http://103.50.218.58/e-order/order/downloadfaktur?no='+invoice_id);
    $('#modal_invoice').modal('show');
}
</script>