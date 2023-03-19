<style type="text/css">
    .dataTable thead .sorting_desc:after{
		content: ' ' !important;
	}

	.dataTable thead {
		display: none !important;
	}
</style>

<section class="section">
  	<div class="section-header">
	    <h1><?php echo $title_beranda; ?></h1>
	    <div class="section-header-breadcrumb">
	      	<div class="breadcrumb-item "><a href="<?php echo base_url('dashboard'); ?>">Dashboard</a></div>
	      	<div class="breadcrumb-item active"><?php echo $title_beranda; ?></div>
	    </div>
  	</div>

	<div class="section-body">
	  	<div class="row">
		    <div class="col-12 col-sm-12 col-lg-12">
		      	<div class="card card-danger">
		      		<div class="card-header">
		      			<h4>Data Notifikasi</h4>
		      		</div>
	      			<div class="card-body">
	      				<ul class="nav nav-pills" id="myTab3" role="tablist">
		                    <li class="nav-item">
		                        <a class="nav-link active" id="transaksi-tab3" data-toggle="tab" href="#transaksi3" role="tab" aria-controls="transaksi" aria-selected="true">Transaksi <?php echo ($count_notif_transaksi) ? '<span class="badge badge-danger">'.$count_notif_transaksi.'</span>' : ''; ?></a>
		                    </li>
		                    <li class="nav-item">
		                        <a class="nav-link" id="profile-tab3" data-toggle="tab" href="#update3" role="tab" aria-controls="update" aria-selected="false">update <?php echo ($count_notif_update) ? '<span class="badge badge-danger">'.$count_notif_update.'</span>' : ''; ?></a>
		                    </li>
	                    </ul>
	                    <div class="tab-content" id="myTabContent2">
	                      	<div class="tab-pane fade show active" id="transaksi3" role="tabpanel" aria-labelledby="transaksi-tab3">
	                      		<div class="row">
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
			                    </div>

		                        <div class="col-md-12 col-sm-12 col-xs-12">
		                            <table class="table table-hover" id="tabel-notif-transaksi" width="100%">
		                                <tbody>

		                                </tbody>
		                            </table>
		                        </div>
	                      	</div>
	                      	<div class="tab-pane fade" id="update3" role="tabpanel" aria-labelledby="update-tab3">
	                      		<div class="row">
		                        	<div class="col-md-6 col-sm-6 col-xs-12">
			                            <div class="form-group row">
			                                <label for="filter_is_read_update" class="col-sm-3 col-form-label">Status</label>
			                                <div class="col-sm-9">
			                                  <select name="filter_is_read_update" id="filter_is_read_update" class="form-control select2" onchange="table_data2()" style="width: 100%;">
			                                      <option value="">--Semua--</option>
			                                      <option value="2">Belum Dibaca</option>
			                                      <option value="1">Sudah Dibaca</option>
			                                  </select>
			                                </div>
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
	</div>
</section>

<?php $this->load->view('js'); ?>