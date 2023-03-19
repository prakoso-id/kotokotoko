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
<div class="container container-240">
    <ul class="breadcrumb v3">
        <li><a href="<?php echo base_url(); ?>">Beranda</a></li>
        <li class="active">Transaksi Pembelian</li>
    </ul>
    <div class="row">
        <div class="col-md-12">
            <div class="cmt-title text-center abs">
                <h1 class="page-title v1" style="width: auto !important;padding: 5px;">Daftar Transaksi Pembelian</h1>
            </div>
            <div class="page-content">
            	<div class="row" style="margin-bottom: 10px;">
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

<?php
	$this->load->view('modal');
	$this->load->view('js');
	require_once APPPATH.'modules/transaksi/views/detail_pengiriman.php';	
?>
