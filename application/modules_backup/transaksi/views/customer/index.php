<link href='<?= base_url() ?>assets/rating/css/star-rating.css' type='text/css' rel='stylesheet'>
<link href='<?= base_url() ?>assets/rating/css/bootstrap.css' type='text/css' rel='stylesheet'>
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
</style>
<style type="text/css">
	.dataTable thead .sorting_desc:after
	{
		content: ' ' !important;
	}
</style>
<div class="product-body">
	<h2 class="product-name">Daftar Transaksi Pembelian</h2>
	<button type="button" class="btn btn-success button_action" onclick="table_data()">
		<i class="fa fa-undo"></i> &nbsp; Refresh
	</button>
	<br>
	<table class="table" cellpadding="0" cellspacing="0" border="0" class="display" width="100%" style="margin-bottom:50px">
		<td>
			<input type="text" name="filter_nama" placeholder="Cari Nama Barang" required="" class="filter_nama form-control" maxlength="20">
		</td>
		<td>
			<input type="text" name="filter_invoice" placeholder="Cari Invoice" required="" class="filter_invoice form-control" maxlength="20">
		</td>
		<td>
			<select class="filter_status select2 form-control">
				<option value="">--Semua Status--</option>
				<?php 
				foreach ($master_status_transaksi as $sts) {
					echo '<option value="'.$sts->id_status_transaksi.'">'.$sts->nama_status.'</option>';
				}
				?>
			</select>
		</td>

	</table>
	<table class="table table-hover tabel" id="tabel">
		
		<tbody>

		</tbody>
	</table>
</div>

<?php
	$this->load->view('modal');
	$this->load->view('js');
	require_once APPPATH.'modules/transaksi/views/detail_pengiriman.php';	
?>
