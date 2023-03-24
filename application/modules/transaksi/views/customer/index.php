<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/mytemplate/css/style.css">
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
</style>
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Transaksi Pembelian</h4>
                    <div class="breadcrumb__links">
						<a href="<?php echo base_url(); ?>">Beranda</a>
                        <span>Transaksi Pembelian</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->
<div class="container container-240">

    <div class="row">
        <div class="col-md-12">
            
            <div class="page-content">
            	<div class="row" style="margin-top:20px;margin-bottom: 10px;">
            		<div class="col-md-12">
					    <div class="col-sm-4">
					      	<input type="text" name="filter_nama" placeholder="Cari Nama Barang" required="" class="filter_nama form-control" maxlength="20">
					    </div>
					    <div class="col-sm-3">
					    	<input type="text" name="filter_invoice" placeholder="Cari Invoice" required="" class="filter_invoice form-control" maxlength="20">
						</div>
						<div class="col-sm-3">
							<select class="filter_status select2 form-control" onchange="table_data()">
								<option value="">--Semua Status--</option>
								<?php 
								foreach ($master_status_transaksi as $sts) {
									echo '<option value="'.$sts->id_status_transaksi.'">'.$sts->nama_status.'</option>';
								}
								?>
							</select>
						</div>
						<div class="col-sm-2">
							<button type="button" class="btn" onclick="table_data()">
								<i class="fa fa-undo"></i> &nbsp; Refresh
							</button>
						</div>
            		</div>
            	</div>

            	<div class="col-md-12 table-responsive">
	            	<table class="table table-hover tabel" id="tabel">
			
						<tbody>

						</tbody>
					</table>
				</div>
			</div>
        </div>
    </div>
</div>
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-I6-gbAMFndGtup5U"></script>
<!-- <script src="https://app.midtrans.com/snap/snap.js" data-client-key="Mid-client-4uYv68mbQD3CkMvY"></script> -->
<?php
	$this->load->view('modal');
	$this->load->view('js');
	require_once APPPATH.'modules/transaksi/views/detail_pengiriman.php';	
?>
