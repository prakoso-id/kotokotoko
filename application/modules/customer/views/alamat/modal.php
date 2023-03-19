<style type="text/css">
 .modal-body {
    max-height: calc(115vh - 212px);
    overflow-y: auto;
  }
</style>
<div id="modal_tambah" class="modal fade" data-backdrop="false">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle"></h5>
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
			</div>
			<form action="" id="add_tambah">
				<div class="modal-body" style="min-height: 200px !important;">
					<input type="hidden" name="<?=$name;?>" value="<?=$hash;?>" />
					<input type="hidden" name="type" value="data_alamat">
					<input type="hidden" name="id">
					<div class="position-relative row form-group">
						<label class="col-sm-3 col-form-label" style="font-weight:600">Utama</label>
						<div class="col-lg-9">
							<input type="checkbox" name="utama" value="1">
							<span class="help"></span>
						</div>
					</div>
					<div class="position-relative row form-group">
						<label class="col-sm-3 col-form-label" style="font-weight:600">Nama Alamat <span class="f-red">*</span></label>
						<div class="col-lg-9">
							<input type="text" name="nama_alamat" class="form-control" placeholder="Contoh : Alamat Rumah atau Alamat Kantor atau dsb">
							<span class="help"></span>
						</div>
					</div>
					<div class="position-relative row form-group">
						<label class="col-sm-3 col-form-label" style="font-weight:600">Nama Penerima <span class="f-red">*</span></label>
						<div class="col-lg-9">
							<input type="text" name="nama_penerima" class="form-control">
							<span class="help"></span>
						</div>
					</div>
					<div class="position-relative row form-group">
						<label class="col-sm-3 col-form-label" style="font-weight:600">Nomor Telepon Penerima <span class="f-red">*</span></label>
						<div class="col-lg-9">
							<input type="text" name="no_penerima" class="form-control" onkeypress="return Angkasaja(event)" maxlength="20">
							<span class="help"></span>
						</div>
					</div>
					<div class="position-relative row form-group">
						<label class="col-sm-3 col-form-label" style="font-weight:600">Propinsi <span class="f-red">*</span></label>
						<div class="col-lg-9">
							<select name="id_prop" class="form-control select2" onchange="get_kab()">
								
							</select>
							<input type="hidden" name="nama_prop">
							<span class="help"></span>
						</div>
					</div>
					<div class="position-relative row form-group">
						<label class="col-sm-3 col-form-label" style="font-weight:600">Kota / Kabupaten <span class="f-red">*</span></label>
						<div class="col-lg-9">
							<select name="id_kota" class="form-control select2" onchange="get_kec()">
								
							</select>
							<input type="hidden" name="nama_kota">
							<span class="help"></span>
						</div>
					</div>
					<div class="position-relative row form-group">
						<label class="col-sm-3 col-form-label" style="font-weight:600">Kecamatan <span class="f-red">*</span></label>
						<div class="col-lg-9">
							<select name="id_kec" class="form-control select2" onchange="get_kel()">
								
							</select>
							<input type="hidden" name="nama_kec">
							<span class="help"></span>
						</div>
					</div>
					<div class="position-relative row form-group">
						<label class="col-sm-3 col-form-label" style="font-weight:600">Kelurahan <span class="f-red">*</span></label>
						<div class="col-lg-9">
							<select name="id_kel" class="form-control select2" onchange="set_nama_kel()">
								
							</select>
							<input type="hidden" name="nama_kel">
							<span class="help"></span>
						</div>
					</div>
					<div class="position-relative row form-group">
						<label class="col-sm-3 col-form-label" style="font-weight:600">Alamat <span class="f-red">*</span></label>
						<div class="col-lg-9">
							<textarea name="alamat" class="form-control" rows="5" style="resize: none;" placeholder="Tulis No. Rumah, Blok, RT/RW, Kode Pos, dll"></textarea>
							<input type="hidden" name="data_alamat">
							<span class="help"></span>
						</div>
					</div>
				</div>

				<div class="modal-footer">
					<button type="button" data-dismiss="modal" class="btn" data-dismiss="modal">Tutup</button>
					<button type="button" onclick="simpan_data()" id="btnSave" class="btn btn-gradient">
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
				<button type="button" class="close"><span aria-hidden="true">&times;</span></button>
			</div>
			<form action="" id="add_modal">
				<div class="modal-body">
					<div class="col-md-12">
						<table class="table" width="100%">
							<tr>
								<td width="20%">Nama Alamat</td>
								<td width="2%"> : </td>
								<td width="78%" class="nama_alamat"></td>
							</tr>
							<tr>
								<td>Provinsi</td>
								<td> : </td>
								<td class="propinsi"></td>
							</tr>
							<tr>
								<td>Kabupaten/Kota</td>
								<td> : </td>
								<td class="kota"></td>
							</tr>
							<tr>
								<td>Kecamatan</td>
								<td> : </td>
								<td class="kecamatan"></td>
							</tr>
							<tr>
								<td>Kelurahan</td>
								<td> : </td>
								<td class="kelurahan"></td>
							</tr>
							<tr>
								<td>Alamat</td>
								<td> : </td>
								<td class="alamat"></td>
							</tr>
							<tr>
								<td>Nama Penerima</td>
								<td> : </td>
								<td class="nama_penerima"></td>
							</tr>
							<tr>
								<td>Nomor Telepon Penerima</td>
								<td> : </td>
								<td class="no_penerima"></td>
							</tr>
						</table>
					</div>
				</div>

				<div class="modal-footer">
					<button type="button"  class="btn" data-dismiss="modal">Tutup</button>
				</div>
			</form>
		</div>
	</div>
</div>