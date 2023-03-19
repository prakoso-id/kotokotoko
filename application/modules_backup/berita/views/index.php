<div class="product-body">
	<h2 class="product-name">Berita</h2>
	<button type="button" class="btn btn-success button_action" onclick="table_data()">
		<i class="fa fa-undo"></i> &nbsp; Refresh
	</button>
	<button type="button" class="btn btn-primary button_action" onclick="tambah_data()">
		<i class="fa fa-plus"></i> &nbsp; Tambah Berita
	</button>
	<br>
	<table class="table" cellpadding="0" cellspacing="0" border="0" class="display" width="100%" style="margin-bottom:20px">
		<td style="border-bottom: 1px solid #ddd;  padding-top: 15px ">
			<span style="color: #000; font-weight: 700;">Pencarian : </span>
		</td>
		<td style="border-bottom: 1px solid #ddd; ">
			<input type="text" name="filter_berita" placeholder="Judul Berita" required="" class="filter_berita form-control" maxlength="20">
		</td>
		<td style="border-bottom: 1px solid #ddd; ">
			<select class="form-control select2 filter_status" name="filter_status">
				<option value="0">Semua Status</option>
				<option value="aktif">Aktif</option>
				<option value="nonaktif">Non Aktif</option>
			</select>
		</td>
	</table>
	<table class="table table-hover tabel" id="tabel">
		<thead>
			<tr>
				<th> </th>
				<th>Judul</th>
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

