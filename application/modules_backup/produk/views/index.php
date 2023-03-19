<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/upload.css') ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/jquery.dm-uploader.min.css') ?>">

<style type="text/css">
	.progress {
		width: 100%;
		height: 30px !important;
	}
	.progress-bar {
		height: 20px;
	}
	.media {
		display: table;
    	margin-bottom: 30px;
    	border-bottom: 1px solid #ccc;
	}
	.media-body{
		padding-bottom: 20px;
	}
</style>
<div class="product-body">
	<h2 class="product-name">Data Produk</h2>
	<button type="button" class="btn btn-success button_action" onclick="table_data()">
		<i class="fa fa-undo"></i> &nbsp; Refresh
	</button>
	<?php
		if(!$this->user_model->is_umkm_admin()){
	?>
			<button type="button" class="btn btn-primary button_action" onclick="tambah_data()">
				<i class="fa fa-plus"></i> &nbsp; Tambah
			</button>
	<?php
		}
	?>
	<br>
	<table class="table" cellpadding="0" cellspacing="0" border="0" class="display" width="100%" style="margin-bottom:20px">
		
		<?php
		if(!$this->user_model->is_umkm_admin()):
		?>
		<td style="border-bottom: 1px solid #ddd;  padding-top: 15px ">
			<span style="color: #000; font-weight: 700;">UMKM : </span>
		</td>
		<td style="border-bottom: 1px solid #ddd; ">
			<select class="form-control select2 filter_umkm" name="filter_umkm">
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
		</td>
		<?php
		else:
			echo '<input type="hidden" class="form-control filter_umkm" name="filter_umkm">';
		endif;
		?>
		<td style="border-bottom: 1px solid #ddd;  padding-top: 15px ">
			<span style="color: #000; font-weight: 700;">Pencarian : </span>
		</td>
		<td style="border-bottom: 1px solid #ddd; ">
			<input type="text" name="filter_produk" placeholder="Nama produk" required="" class="filter_produk form-control" maxlength="20">
		</td>
		<?php if ($this->user_model->is_umkm_admin()) { ?>
		<td style="border-bottom: 1px solid #ddd; ">
			<input type="text" name="filter_nama_umkm" placeholder="Nama UMKM" required="" class="filter_nama_umkm form-control" maxlength="20">
		</td>
		<?php }else{
			echo '<input type="hidden" class="form-control filter_nama_umkm" name="filter_nama_umkm">';
		} ?>
		<td style="border-bottom: 1px solid #ddd; ">
			<select class="form-control select2 filter_status" name="filter_status">
				<option value="">-- Status Produk --</option>
				<option value="1">Aktif</option>
				<option value="2">Tidak Aktif</option>
			</select>
		</td>
	</table>
	<table class="table table-hover tabel" id="tabel">
		<thead>
			<tr>
				<th> </th>
				<th>Nama Produk</th>
				<th>Nama UMKM</th>
				<th>Stok</th>
				<th>Harga</th>
				<th>Status</th>
				<th class="text-center">Aksi</th>
			</tr>
		</thead>
		<tbody>

		</tbody>
	</table>
	
</div>
<?php
	$this->load->view('modal');
	$this->load->view('js');
?>

