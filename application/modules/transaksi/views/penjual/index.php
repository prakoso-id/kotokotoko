<style type="text/css">
	.progress {
		height: 25px;
		width: 100%;
	}
	.rating-container .caption {
		display: none;
	}
	.rating-stars {
		margin: 0 auto;
    	display: table !important;
	}
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
		      			<h4>Data Transaksi Penjualan</h4>
		        		<div class="card-header-action">
				        	<a class="btn btn-icon btn-secondary" href="javascript:void(0);" onclick="table_data();" title="Refresh"><i class="fas fa-sync"></i></a>
			            <a data-collapse="#card-transaksi" class="btn btn-icon btn-danger" href="#"><i class="fas fa-minus"></i></a>
			          	</div>
		      		</div>
		      		<div class="collapse show" id="card-transaksi">
		      			<div class="card-body">
		      				<div class="form-row">
								<div class="form-group col-md-4">
					              	<label for="filter_umkm">UMKM</label>
					              	<select class="form-control select2 filter_umkm" name="filter_umkm" id="filter_umkm">
										<option value="">--Semua--</option>
										<?php
											foreach ($option_umkm as $key => $value) {
												if ($value->id_status == '1') {
													$sts_verif = '&#10004;';
												}else{
													$sts_verif = '';
												}
												echo "<option value='".$value->id_umkm."'>".text($value->namausaha)."  ".$sts_verif."</option>";
											}
										?>
									</select>
					            </div>
								<div class="form-group col-md-4">
					              	<label for="filter_invoice">Invoice</label>
					              	<input type="text" name="filter_invoice" id="filter_invoice" placeholder="Cari Invoice" required="" class="filter_invoice form-control" maxlength="20">
					            </div>
					            <div class="form-group col-md-4">
					              	<label for="filter_status">Status</label>
					              	<select class="filter_status select2 form-control" id="filter_status">
										<option value=""> --Semua Status--</option>
										<?php 
										foreach ($master_status_transaksi as $sts) {
											echo '<option value="'.$sts->id_status_transaksi.'">'.$sts->nama_status.'</option>';
										}
										?>
									</select>
					            </div>
				          	</div>

				          	<div class="table-responsive">
				          		<table class="table table-hover tabel" id="tabel" width="100%">
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
</section>
<?php
	$this->load->view('modal');
	$this->load->view('js');
	require_once APPPATH.'modules/transaksi/views/detail_pengiriman.php';	
?>