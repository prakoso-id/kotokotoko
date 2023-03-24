<style type="text/css">
    .dataTable thead .sorting_desc:after{
        content: ' ' !important;
    }
</style>
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Notifikasi</h4>
                    <div class="breadcrumb__links">
						<a href="<?php echo base_url(); ?>">Beranda</a>
                        <span>Notifikasi</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->
<div class="container container-240">

    <div class="row" style="margin-top:20px;margin-bottom: 20px;">
    	<div class="col-md-12">


            <ul class="product-tab-sw2 my-tab">
                <li class="tab-transaksi active"><a data-toggle="tab" href="#transaksi" aria-expanded="false">Transaksi <?php echo ($count_notif_transaksi) ? '<span class="label label-warning">'.$count_notif_transaksi.'</span>' : ''; ?></a></li>
                <li class="tab-update"><a data-toggle="tab" href="#update" aria-expanded="false">Update <?php echo ($count_notif_update) ? '<span class="label label-warning">'.$count_notif_update.'</span>' : ''; ?></a></li>
            </ul>
            <div class="tab-content">
                <div id="transaksi" class="tab-pane fade active in">
                    <div class="row shop-colect" style="margin-top: 20px;">
                        
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group row">
                                <label for="filter_is_read" class="col-sm-3 col-form-label">Status</label>
                                <div class="col-sm-9">
                                  <select name="filter_is_read" id="filter_is_read" class="form-control select2" onchange="table_data()">
                                      <option value="">--Semua--</option>
                                      <option value="2">Belum Dibaca</option>
                                      <option value="1">Sudah Dibaca</option>
                                  </select>
                                </div>
                             </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group row">
                                <label for="filter_jenis_transaksi" class="col-sm-3 col-form-label">Jenis Transaksi</label>
                                <div class="col-sm-9">
                                  <select name="filter_jenis_transaksi" id="filter_jenis_transaksi" class="form-control select2" onchange="table_data()">
                                      <option value="">--Semua--</option>
                                      <option value="transaksi_pembelian">Pembelian</option>
                                      <option value="transaksi_penjualan">Penjualan</option>
                                  </select>
                                </div>
                             </div>
                        </div>

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <table class="table table-hover" id="tabel-notif-transaksi" width="100%">
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div id="update" class="tab-pane fade">
                    <div class="row shop-colect" style="margin-top: 20px;">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group row">
                                <label for="filter_is_read_update" class="col-sm-3 col-form-label">Status</label>
                                <div class="col-sm-9">
                                  <select name="filter_is_read_update" id="filter_is_read_update" class="form-control select2" onchange="table_data2()">
                                      <option value="">--Semua--</option>
                                      <option value="2">Belum Dibaca</option>
                                      <option value="1">Sudah Dibaca</option>
                                  </select>
                                </div>
                             </div>
                        </div>

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <table class="table table-hover" id="tabel-notif-update" width="100%">
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>
</div>
<?php $this->load->view('js'); ?>