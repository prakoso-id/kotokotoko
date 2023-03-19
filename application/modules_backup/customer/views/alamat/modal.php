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
						<label class="col-sm-3 col-form-label" style="font-weight:600">Nama Alamat</label>
						<div class="col-lg-9">
							<input type="text" name="nama_alamat" class="form-control" placeholder="Contoh : Alamat Rumah atau Alamat Kantor atau dsb">
							<span class="help"></span>
						</div>
					</div>
					<div class="position-relative row form-group">
						<label class="col-sm-3 col-form-label" style="font-weight:600">Nama Penerima</label>
						<div class="col-lg-9">
							<input type="text" name="nama_penerima" class="form-control">
							<span class="help"></span>
						</div>
					</div>
					<div class="position-relative row form-group">
						<label class="col-sm-3 col-form-label" style="font-weight:600">Nomor Penerima</label>
						<div class="col-lg-9">
							<input type="text" name="no_penerima" class="form-control" onkeypress="return Angkasaja(event)" maxlength="20">
							<span class="help"></span>
						</div>
					</div>
					<div class="position-relative row form-group">
						<label class="col-sm-3 col-form-label" style="font-weight:600">Propinsi</label>
						<div class="col-lg-9">
							<select name="id_prop" class="form-control select2">
								
							</select>
							<input type="hidden" name="nama_prop">
							<span class="help"></span>
						</div>
					</div>
					<div class="position-relative row form-group">
						<label class="col-sm-3 col-form-label" style="font-weight:600">Kota / Kabupaten</label>
						<div class="col-lg-9">
							<select name="id_kota" class="form-control select2">
								
							</select>
							<input type="hidden" name="nama_kota">
							<span class="help"></span>
						</div>
					</div>
					<div class="position-relative row form-group">
						<label class="col-sm-3 col-form-label" style="font-weight:600">Kecamatan</label>
						<div class="col-lg-9">
							<select name="id_kec" class="form-control select2">
								
							</select>
							<input type="hidden" name="nama_kec">
							<span class="help"></span>
						</div>
					</div>
					<div class="position-relative row form-group">
						<label class="col-sm-3 col-form-label" style="font-weight:600">Kelurahan</label>
						<div class="col-lg-9">
							<select name="id_kel" class="form-control select2">
								
							</select>
							<input type="hidden" name="nama_kel">
							<span class="help"></span>
						</div>
					</div>
					<div class="position-relative row form-group">
						<label class="col-sm-3 col-form-label" style="font-weight:600">Alamat</label>
						<div class="col-lg-9">
							<textarea name="alamat" class="form-control" rows="5" style="resize: none;" placeholder="Tulis No. Rumah, Blok, RT/RW, Kode Pos, dll"></textarea>
							<input type="hidden" name="data_alamat">
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
				<button type="button" class="close"><span aria-hidden="true">&times;</span></button>
			</div>
			<form action="" id="add_modal">
				<div class="modal-body">
					<div class="position-relative row form-group">
						<label class="col-sm-3 col-form-label" style="font-weight:700">Nama Alamat</label>
						<label class="col-sm-9 col-form-label nama_alamat" style="font-weight:500"></label>
					</div>
					<div class="position-relative row form-group">
						<label class="col-sm-3 col-form-label" style="font-weight:700">Propinsi</label>
						<label class="col-sm-9 col-form-label propinsi" style="font-weight:500"></label>
					</div>
					<div class="position-relative row form-group">
						<label class="col-sm-3 col-form-label" style="font-weight:700">Kabupaten</label>
						<label class="col-sm-9 col-form-label kota" style="font-weight:500"></label>
					</div>
					<div class="position-relative row form-group">
						<label class="col-sm-3 col-form-label" style="font-weight:700">Kecamatan</label>
						<label class="col-sm-9 col-form-label kecamatan" style="font-weight:500"></label>
					</div>
					<div class="position-relative row form-group">
						<label class="col-sm-3 col-form-label" style="font-weight:700">Kelurahan</label>
						<label class="col-sm-9 col-form-label kelurahan" style="font-weight:500"></label>
					</div>
					<div class="position-relative row form-group">
						<label class="col-sm-3 col-form-label" style="font-weight:700">Alamat</label>
						<label class="col-sm-9 col-form-label alamat" style="font-weight:500"></label>
					</div>
					<div class="position-relative row form-group">
						<label class="col-sm-3 col-form-label" style="font-weight:700">Nama Penerima</label>
						<label class="col-sm-9 col-form-label nama_penerima" style="font-weight:500"></label>
					</div>
					<div class="position-relative row form-group">
						<label class="col-sm-3 col-form-label" style="font-weight:700">Nomor Penerima</label>
						<label class="col-sm-9 col-form-label no_penerima" style="font-weight:500"></label>
					</div>
				</div>

				<div class="modal-footer">
					<button type="button"  class="btn btn-danger" data-dismiss="modal">Tutup</button>
				</div>
			</form>
		</div>
	</div>
</div>