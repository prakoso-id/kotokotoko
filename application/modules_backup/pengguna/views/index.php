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
			<input type="text" name="filter_username" placeholder="NIK / NIP" required="" class="filter_username form-control" maxlength="20">
		</td>
		<td style="border-bottom: 1px solid #ddd; ">
			<input type="text" name="filter_nama" placeholder="Nama Lengkap" required="" class="filter_nama form-control" maxlength="20">
		</td>
		<td style="border-bottom: 1px solid #ddd; ">
			<select class="form-control select2 filter_group" name="filter_group">
				<option value="0">-- Semua Group --</option>
				<option value="1">Administrator</option>
				<option value="3">Verifikator</option>
				<option value="2">Pengguna</option>
			</select>
		</td>
	</table>
	<table class="table table-hover tabel" id="tabel">
		<thead>
			<tr>
				<th> </th>
				<th>Nama</th>
				<th>Group</th>
				<th>Terakhir Login</th>
				<th>Status</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>

		</tbody>
	</table>
</div>
<?php
	$this->load->view('pengguna/modal');
	$this->load->view('pengguna/js');
?>
