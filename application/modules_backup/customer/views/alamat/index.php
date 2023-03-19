<style type="text/css">
	.select2-results__option[aria-selected=true] { display: none;}
</style>
<div class="product-body">
	<button type="button" class="btn btn-success button_action" onclick="table_data()">
		<i class="fa fa-undo"></i> &nbsp; Refresh
	</button>
	<button type="button" class="btn btn-primary button_action tambah_data">
		<i class="fa fa-plus"></i> &nbsp; Tambah
	</button>
	<br>
	<table class="table" cellpadding="0" cellspacing="0" border="0" class="display" width="100%" style="margin-bottom:20px">
		<td style="border-bottom: 1px solid #ddd;  padding-top: 15px ">
			<span style="color: #000; font-weight: 700;">Pencarian : </span>
		</td>
		<td style="border-bottom: 1px solid #ddd; ">
			<input type="text" name="filter_alamat" placeholder="Cari Alamat" required="" class="filter_alamat form-control" maxlength="20">
		</td>
	</table>
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
<?php
	$this->load->view('modal');
	$this->load->view('js');
?>
