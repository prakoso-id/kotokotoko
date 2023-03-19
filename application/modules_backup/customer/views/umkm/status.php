<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
<style type="text/css">
	.select2-results__option[aria-selected=true] { display: none;}
</style>
<div class="status_umkm">
	<h2 class="product-name">Data UMKM</h2>
	<button type="button" class="btn btn-primary button_action" onclick="button_sudah(1)">
		<i class="fa fa-plus"></i> &nbsp; Tambah UMKM
	</button>
	<table class="table" cellpadding="0" cellspacing="0" border="0" class="display" width="100%" style="margin-bottom:20px">
		<td style="border-bottom: 1px solid #ddd;  padding-top: 15px ">
			<span style="color: #000; font-weight: 700;">Pencarian : </span>
		</td>
		<td style="border-bottom: 1px solid #ddd; ">
			<input type="text" name="filter_nama" placeholder="Nama Usaha" required="" class="filter_perusahaan form-control" maxlength="20">
		</td>
		<td style="border-bottom: 1px solid #ddd; ">
			<select name="status" class="filter_status select2 form-control">
				<option value="">Semua Status</option>
				<?php foreach ($m_status as $sts) {
					echo '<option value="'.$sts->id_status.'">'.$sts->nama.'</option>';
				} ?>
			</select>
		</td>
	</table>
	<table class="table table-striped row-border table-hover tabel" id="tabel">
		<thead>
			<tr>
				<th> </th>
				<th>Nama Usaha</th>
				<th>Kategori Usaha</th>
				<th>Ratting</th>
				<th>Status</th>
				<th>Aksi</th>
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