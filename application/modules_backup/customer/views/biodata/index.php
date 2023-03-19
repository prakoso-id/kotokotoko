<div class="product-body">
	<div class="col-md-12">
	<form action="" id="add_tambah">
		<div class="modal-body" style="min-height: 200px !important;">
			<input type="hidden" name="<?=$name;?>" value="<?=$hash;?>" />
			<input type="hidden" name="id" value="">
			<div class="position-relative row form-group">
				<label class="col-sm-3 col-form-label" style="font-weight:600">NIK</label>
				<div class="col-lg-9">
					<input type="text" class="form-control" readonly value="<?php echo @$data->username; ?>">
					<span class="help"></span>
				</div>
			</div>
			<div class="position-relative row form-group">
				<label class="col-sm-3 col-form-label" style="font-weight:600">Nama Lengkap</label>
				<div class="col-lg-9">
					<input type="text" readonly="" class="form-control" value="<?php echo @$data->nama; ?>">
				</div>
			</div>
			<div class="position-relative row form-group">
				<label class="col-sm-3 col-form-label" style="font-weight:600">Email</label>
				<div class="col-lg-9">
					<input type="text" readonly="" class="form-control" value="<?php echo @$data->email; ?>">
					<span class="help"></span>
				</div>
			</div>
			<div class="position-relative row form-group">
				<label class="col-sm-3 col-form-label" style="font-weight:600">No. Telp</label>
				<div class="col-lg-9">
					<input type="text" readonly="" class="form-control" value="<?php echo @$data->no_telp; ?>">
					<span class="help"></span>
				</div>
			</div>
			<div class="position-relative row form-group">
				<label class="col-sm-3 col-form-label" style="font-weight:600">Jenis Kelamin</label>
				<div class="col-lg-9">
					<input type="text" readonly="" class="form-control" value="<?php echo @$data->jenis_kelamin; ?>">
				</div>
			</div>
			<div class="position-relative row form-group">
				<label class="col-sm-3 col-form-label" style="font-weight:600">Tempat, Tanggal Lahir</label>
				<div class="col-lg-9">
					<input type="text"  readonly="" class="form-control" value="<?php echo @$data->tempat_lahir.' , '.@indonesian_date_2(@$data->tanggal_lahir); ?>">
					<span class="help"></span>
				</div>
			</div>
			<div class="position-relative row form-group">
				<label class="col-sm-3 col-form-label" style="font-weight:600">Alamat</label>
				<div class="col-lg-9">
					<input type="text" readonly="" class="form-control" value="<?php echo @$data->alamat; ?>">
					<span class="help"></span>
				</div>
			</div>
			<button type="button" class="btn btn-primary button_action sinkron">
				<i class="fa fa-refresh"></i> &nbsp; Sinkronisasi
			</button>
		</div>
	</form>
	</div>
</div>
<?php
	$this->load->view('js');
?>