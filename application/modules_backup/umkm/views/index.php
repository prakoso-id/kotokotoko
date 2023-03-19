<script type="text/javascript" src="https://cdn.rawgit.com/taromero/swal-forms/master/live-demo/sweet-alert.js"></script>
<script type="text/javascript" src="https://cdn.rawgit.com/taromero/swal-forms/master/swal-forms.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">

<div class="product-body">
	<button type="button" class="btn btn-success button_action" onclick="table_data()">
		<i class="fa fa-undo"></i> &nbsp; Refresh
	</button>
	<!-- <a class="btn btn-primary button_action" href="<?php echo base_url('assets/umkm.xlsx'); ?>" target="_blank">
		<i class="fa fa-file-excel-o"></i> &nbsp; Template Upload Excel
	</a>
	<button class="btn btn-info button_action" onclick="upload_excel()">
		<i class="fa fa-file-excel-o"></i> &nbsp; Upload Excel
	</button> -->
	<br>
	<table class="table" cellpadding="0" cellspacing="0" border="0" class="display" width="100%" style="margin-bottom:20px">
		<td style="border-bottom: 1px solid #ddd;  padding-top: 15px ">
			<span style="color: #000; font-weight: 700;">Pencarian : </span>
		</td>
		<td style="border-bottom: 1px solid #ddd; ">
			<input type="text" name="filter_perusahaan" placeholder="Nama Usaha" required="" class="filter_perusahaan form-control" maxlength="20">
		</td>
		<td style="border-bottom: 1px solid #ddd; ">
			<select class="form-control select2 filter_group" name="filter_group">
			</select>
		</td>
		<td style="border-bottom: 1px solid #ddd; ">
			<select class="form-control select2 filter_iumkm" name="filter_iumkm">
				<option value="">Semua Status</option>
				<?php foreach ($m_status as $sts) {
					echo '<option value="'.$sts->id_status.'">'.$sts->nama.'</option>';
				} ?>
			</select>
		</td>
	</table>
	<table class="table table-hover tabel" id="tabel">
		<thead>
			<tr>
				<th> </th>
				<th>Nama Usaha</th>
				<th>Nama Pemilik</th>
				<th>Jenis Usaha</th>
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

