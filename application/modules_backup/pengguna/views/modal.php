<div id="modal_tambah" class="modal fade" data-backdrop="false">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle"></h5>
				<button type="button" class="close" data-dismiss="modal"> <span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="" id="add_tambah">
				<div class="modal-body" style="min-height: 200px !important;">
					<input type="hidden" name="<?=$name;?>" value="<?=$hash;?>" />
					<input type="hidden" name="type" value="data_pengguna">
					<div class="position-relative row form-group">
						<label class="col-sm-3 col-form-label" style="font-weight:600">Username</label>
						<div class="col-lg-9">
							<input type="text" name="username" placeholder="NIP" class="form-control" onkeypress="return Angkasaja(event)" maxlength="20">
							<span class="help"></span>
						</div>
					</div>
					<div class="position-relative row form-group">
						<label class="col-sm-3 col-form-label" style="font-weight:600">Nama Lengkap</label>
						<div class="col-lg-9">
							<input type="text" name="nama_lengkap" readonly="" class="form-control">
							<span class="help"></span>
							<input type="hidden" name="jenis_id" class="jenis_id">
							<input type="hidden" name="kode_unor" class="kode_unor">
							
							<input type="hidden" name="gender" class="gender">
						</div>
					</div>
					<div class="position-relative row form-group">
						<label class="col-sm-3 col-form-label" style="font-weight:600">Jabatan</label>
						<div class="col-lg-9">
							<input type="text" name="jabatan" class="jabatan form-control" readonly="">
							<span class="help"></span>
						</div>
					</div>
					<div class="position-relative row form-group" style="display: none;">
						<label class="col-sm-3 col-form-label" style="font-weight:600">Tempat Lahir</label>
						<div class="col-lg-9">
							<input type="text" name="tmpt_lahir" readonly="" class="form-control">
							<span class="help"></span>
						</div>
					</div>
					<div class="position-relative row form-group" style="display: none;">
						<label class="col-sm-3 col-form-label" style="font-weight:600">Tanggal Lahir</label>
						<div class="col-lg-9">
							<input type="date" name="tgl_lahir" readonly="" class="form-control">
							<span class="help"></span>
						</div>
					</div>
					<div class="position-relative row form-group">
						<label class="col-sm-3 col-form-label" style="font-weight:600">Group</label>
						<div class="col-lg-9">
							<select name="id_group" class="form-control id_group select2">
								
							</select>
							<input type="hidden" name="grup" readonly="" class="form-control">
							<span class="help"></span>
						</div>
					</div>
				</div>

				<div class="modal-footer">
					<button type="button" data-dismiss="modal" class="btn btn-danger" data-dismiss="modal">Tutup</button>
					<button type="button" onclick="simpan_data()" id="btnSave" class="btn btn-success">
						Simpan
					</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div id="modal_ubah" class="modal fade" data-backdrop="false">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle"></h5>
				<button type="button" class="close" data-dismiss="modal"> <span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="" id="add_ubah">
				<div class="modal-body" style="min-height: 200px !important;">
					<input type="hidden" name="<?=$name;?>" value="<?=$hash;?>" />
					<input type="hidden" name="type" value="data_pengguna">
					<div class="position-relative row form-group">
						<label class="col-sm-3 col-form-label" style="font-weight:600">Username</label>
						<div class="col-lg-9">
							<input type="hidden" name="id" value="">
							<input readonly="" type="text" name="username" placeholder="NIP" class="form-control" onkeypress="return Angkasaja(event)" maxlength="20">
							<span class="help"></span>
						</div>
					</div>
					<div class="position-relative row form-group">
						<label class="col-sm-3 col-form-label" style="font-weight:600">Nama Lengkap</label>
						<div class="col-lg-9">
							<input type="text" name="nama_lengkap" readonly="" class="form-control">
							<span class="help"></span>
							<input type="hidden" name="jenis_id" class="jenis_id">
							<input type="hidden" name="kode_unor" class="kode_unor">
							<input type="hidden" name="jabatan" class="jabatan">
							<input type="hidden" name="gender" class="gender">
						</div>
					</div>
					<div class="position-relative row form-group" style="display: none;">
						<label class="col-sm-3 col-form-label" style="font-weight:600">Tempat Lahir</label>
						<div class="col-lg-9">
							<input type="text" name="tmpt_lahir" readonly="" class="form-control">
							<span class="help"></span>
						</div>
					</div>
					<div class="position-relative row form-group" style="display: none;">
						<label class="col-sm-3 col-form-label" style="font-weight:600">Tanggal Lahir</label>
						<div class="col-lg-9">
							<input type="date" name="tgl_lahir" readonly="" class="form-control">
							<span class="help"></span>
						</div>
					</div>
					<div class="position-relative row form-group">
						<label class="col-sm-3 col-form-label" style="font-weight:600">Group</label>
						<div class="col-lg-9">
							<select name="id_group" class="form-control id_group select2">
								
							</select>
							<input type="hidden" name="grup" readonly="" class="form-control">
							<span class="help"></span>
						</div>
					</div>
				</div>

				<div class="modal-footer">
					<button type="button" data-dismiss="modal" class="btn btn-danger" data-dismiss="modal">Tutup</button>
					<button type="button" onclick="simpan_data()" id="btnSave" class="btn btn-success">
						Simpan
					</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div id="modal_data" class="modal fade" data-backdrop="false">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle"></h5>
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
			</div>
			<form action="" id="add_modal">
				<div class="modal-body">
					<div class="position-relative row form-group">
						<label class="col-sm-3 col-form-label" style="font-weight:700">Username</label>
						<label class="col-sm-9 col-form-label nik" style="font-weight:500"></label>
					</div>
					<div class="position-relative row form-group">
						<label class="col-sm-3 col-form-label" style="font-weight:700">Nama Lengkap</label>
						<label class="col-sm-9 col-form-label nama" style="font-weight:500"></label>
					</div>
					<div class="position-relative row form-group">
						<label class="col-sm-3 col-form-label" style="font-weight:700">Jenis Kelamin</label>
						<label class="col-sm-9 col-form-label jenis_kelamin" style="font-weight:500"></label>
					</div>
					<div class="position-relative row form-group">
						<label class="col-sm-3 col-form-label" style="font-weight:700">Email</label>
						<label class="col-sm-9 col-form-label email" style="font-weight:500"></label>
					</div>
					<div class="position-relative row form-group">
						<label class="col-sm-3 col-form-label" style="font-weight:700">Domisili</label>
						<label class="col-sm-9 col-form-label domisili" style="font-weight:500"></label>
					</div>
					<div class="position-relative row form-group">
						<label class="col-sm-3 col-form-label" style="font-weight:700">Alamat</label>
						<label class="col-sm-9 col-form-label alamat" style="font-weight:500"></label>
					</div>
					<div class="position-relative row form-group">
						<label class="col-sm-3 col-form-label" style="font-weight:700">Status</label>
						<label class="col-sm-9 col-form-label status" style="font-weight:500"></label>
					</div>
				</div>

				<div class="modal-footer">
					<button type="button"  class="btn btn-danger" data-dismiss="modal">Tutup</button>
				</div>
			</form>
		</div>
	</div>
</div>