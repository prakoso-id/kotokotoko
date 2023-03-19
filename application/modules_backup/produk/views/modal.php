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
			<form action="" id="add_produk">
				<div class="modal-body" style="min-height: 200px !important;">
					<input type="hidden" name="<?=$name;?>" value="<?=$hash;?>" />
					<input type="hidden" name="id">
					<div class="position-relative row form-group id_umkm">
						<label class="col-sm-3 col-form-label" style="font-weight:600">*UMKM</label>
						<div class="col-lg-9">
							<select name="id_umkm" class="form-control select2">
								
							</select>
							<span class="help"></span>
							<div class="alert alert-warning alert-umkm" role="alert" style="margin-top: 5px; display: none;">
							  
							</div>
						</div>
					</div>
					<div class="position-relative row form-group">
						<label class="col-sm-3 col-form-label" style="font-weight:600">*Kategori Produk</label>
						<div class="col-lg-9">
							<select name="id_jenis_usaha" class="form-control select2">
								
							</select>
							<input type="hidden" name="jenis_usaha">
							<span class="help"></span>
						</div>
					</div>
					<div class="position-relative row form-group">
						<label class="col-sm-3 col-form-label" style="font-weight:600">*Nama Produk</label>
						<div class="col-lg-9">
							<input type="text" name="nama_produk" class="form-control" placeholder="Nama Produk">
							<span class="help"></span>
						</div>
					</div>
					<div class="position-relative row form-group">
						<label class="col-sm-3 col-form-label" style="font-weight:600">*Harga</label>
						<div class="col-lg-9">
							<input type="text" name="harga" class="form-control currency-field" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency" placeholder="Harga Produk">
							<span class="help"></span>
						</div>
					</div>
					<div class="position-relative row form-group">
						<label class="col-sm-3 col-form-label" style="font-weight:600">*Stok</label>
						<div class="col-lg-9">
							<input type="text" name="stok" class="form-control currency-field" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency" placeholder="Stok Produk">
							<span class="help"></span>
						</div>
					</div>
					<div class="position-relative row form-group">
						<label class="col-sm-3 col-form-label" style="font-weight:600">*Berat (Kg)</label>
						<div class="col-lg-9">
							<input type="text" name="berat" id="berat" class="form-control" maxlength="6" placeholder="Berat Produk">
							<span class="help"></span>
						</div>
					</div>
					<div class="position-relative row form-group">
                        <label class="col-sm-3 col-form-label" style="font-weight:600">*Dukungan Kurir</label>
                        <div class="col-lg-9">
                            <select name="id_kurir[]" id="id_kurir" multiple="multiple" class="form-control select2" placeholder="Pilih kurir">

                            </select>
                            <input type="hidden" name="nama_kurir">
                            <span class="help"></span>
                        </div>
                    </div>   
					<div class="position-relative row form-group">
						<label class="col-sm-3 col-form-label" style="font-weight:600">Tags</label>
						<div class="col-lg-9">
							<select name="tags[]" class="form-control tags" multiple="multiple">
								
							</select>
							<input type="hidden" name="nama_tags">
							<span class="help"></span>
						</div>
					</div>
					<hr>
					<div class="f_link_ekternal_produk">
						
					</div>
					<div class="position-relative row form-group">
						<label class="col-sm-12 col-form-label" style="font-weight:600">*Foto Produk</label>
						<label class="col-sm-12 col-form-label" style="font-weight:400">
							<i>Maskimal 5 Mb, Hanya file jpg, jpeg dan png.</i>
						</label>
						
						<div class="col-md-12">
							<input type="hidden" name="data_produk">
							<span class="help"></span>
						</div>
						<div class="col-md-5 col-sm-12">
							<div id="drag-and-drop-zone" class="dm-uploader p-5">
								<h3 class="mb-5 mt-5 text-muted">Drag &amp; drop files here</h3>
								<div class="btn btn-primary btn-block mb-5">
									<span>Open the file Browser</span>
									<input type="file" title='Click to add Files' accept=".jpg, .jpeg, .png"/>
								</div>
							</div>
						</div>
						<div class="col-md-7 col-sm-12">
							<div class="card h-100">
								<div class="card-header">
									Foto Produk
								</div>

								<ul class="list-unstyled p-2 d-flex flex-column col" id="files">
									<li class="text-muted text-center empty">No files uploaded.</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="position-relative row form-group">
						<label class="col-sm-3 col-form-label" style="font-weight:600">*Deksripsi</label>
						<div class="col-lg-9">
							<textarea name="deskripsis" id="pesan_keterangan" class="form-control" rows="5" style="resize: none;" placeholder="Tulis Deksripsi Produk"></textarea>
							<input type="hidden" name="data_deskripsi">
							<span class="help"></span>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" data-dismiss="modal" class="btn btn-danger" data-dismiss="modal">Tutup</button>
					<button type="button" onclick="simpan_data()" class="btn btn-success">
						Simpan
					</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div id="modal_detail" class="modal fade" data-backdrop="false">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle"></h5>
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
			</div>
			<form action="">
				<div class="modal-body" style="min-height: 200px !important;">
					<input type="hidden" name="<?=$name;?>" value="<?=$hash;?>" />
					<input type="hidden" name="id">
					<div class="position-relative row form-group">
						<label class="col-sm-3 col-form-label" style="font-weight:600">Kategori Produk</label>
						<div class="col-lg-9">
							<select name="id_jenis_usaha" class="form-control select2">
								
							</select>
							<input type="hidden" name="jenis_usaha">
							<span class="help"></span>
						</div>
					</div>
					<div class="position-relative row form-group">
						<label class="col-sm-3 col-form-label" style="font-weight:600">Nama Produk</label>
						<div class="col-lg-9">
							<input type="text" name="nama_produk" class="form-control">
							<span class="help"></span>
						</div>
					</div>
					<div class="position-relative row form-group">
						<label class="col-sm-3 col-form-label" style="font-weight:600">Harga</label>
						<div class="col-lg-9">
							<input type="text" name="harga" class="form-control currency-field" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency" placeholder="Harga Produk">
							<span class="help"></span>
						</div>
					</div>
					<div class="position-relative row form-group">
						<label class="col-sm-3 col-form-label" style="font-weight:600">Stok</label>
						<div class="col-lg-9">
							<input type="text" name="stok" class="form-control currency-field" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency" placeholder="Stok Produk">
							<span class="help"></span>
						</div>
					</div>
					<div class="position-relative row form-group">
						<label class="col-sm-3 col-form-label" style="font-weight:600">Tags</label>
						<div class="col-lg-9">
							<select name="tags[]" class="form-control tags" multiple="multiple">
								
							</select>
							<input type="hidden" name="nama_tags">
							<span class="help"></span>
						</div>
					</div>
					<div class="position-relative row form-group">
						<label class="col-sm-12 col-form-label" style="font-weight:600">Foto Produk</label>
						<label class="col-sm-12 col-form-label" style="font-weight:400">
							<i>Maskimal 5 Mb, Hanya file jpg, jpeg dan png.</i>
						</label>
						
						<div class="col-md-12">
							<input type="hidden" name="data_produk">
							<span class="help"></span>
						</div>
						<div class="col-md-5 col-sm-12">
							<div id="drag-and-drop-zone" class="dm-uploader p-5">
								<h3 class="mb-5 mt-5 text-muted">Drag &amp; drop files here</h3>
								<div class="btn btn-primary btn-block mb-5">
									<span>Open the file Browser</span>
									<input type="file" title='Click to add Files' accept="image/jpg,image/jpeg,image/png,"/>
								</div>
							</div>
						</div>
						<div class="col-md-7 col-sm-12">
							<div class="card h-100">
								<div class="card-header">
									Foto Produk
								</div>

								<ul class="list-unstyled p-2 d-flex flex-column col" id="files">
									<li class="text-muted text-center empty">No files uploaded.</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="position-relative row form-group">
						<label class="col-sm-3 col-form-label" style="font-weight:600">Deksripsi</label>
						<div class="col-lg-9">
							<textarea name="deskripsis" class="form-control" rows="5" style="resize: none;" placeholder="Tulis Deksripsi Produk"></textarea>
							<input type="hidden" name="data_deskripsi">
							<span class="help"></span>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" data-dismiss="modal" class="btn btn-danger" data-dismiss="modal">Tutup</button>
					<button type="button" onclick="simpan_data()" class="btn btn-success">
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
			<form action="">
				<div class="modal-body" style="min-height: 200px !important;">
					<input type="hidden" name="<?=$name;?>" value="<?=$hash;?>" />
					<input type="hidden" name="id">
					<div class="position-relative row form-group">
						<label class="col-sm-3 col-form-label" style="font-weight:600">Nama Produk</label>
						<div class="col-lg-9">
							<input type="text" readonly="" name="nama_produk" class="form-control">
							<span class="help"></span>
						</div>
					</div>
					<div class="position-relative row form-group">
						<label class="col-sm-3 col-form-label" style="font-weight:600">Kategori Produk</label>
						<div class="col-lg-9">
							<select disabled="" name="id_jenis_usaha" class="form-control select2">
								
							</select>
							<input type="hidden" name="jenis_usaha">
							<span class="help"></span>
						</div>
					</div>
					<div class="position-relative row form-group">
						<label class="col-sm-3 col-form-label" style="font-weight:600">Harga</label>
						<div class="col-lg-9">
							<input readonly="" type="text" name="harga" class="form-control currency-field" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency" placeholder="Harga Produk">
							<span class="help"></span>
						</div>
					</div>
					<div class="position-relative row form-group">
						<label class="col-sm-3 col-form-label" style="font-weight:600">Stok</label>
						<div class="col-lg-9">
							<input readonly="" type="text" name="stok" class="form-control currency-field" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency" placeholder="Stok Produk">
							<span class="help"></span>
						</div>
					</div>
					<div class="position-relative row form-group">
						<label class="col-sm-3 col-form-label" style="font-weight:600">Tags</label>
						<div class="col-lg-9">
							<select disabled="" name="tags[]" class="form-control tags" multiple="multiple">
								
							</select>
							<input type="hidden" name="nama_tags">
							<span class="help"></span>
						</div>
					</div>
					<div class="position-relative row form-group">
						<label class="col-sm-12 col-form-label" style="font-weight:600">Foto Produk</label>
						<label class="col-sm-12 col-form-label" style="font-weight:400">
							<i>Maskimal 5 Mb, Hanya file jpg, jpeg dan png.</i>
						</label>
						
						<div class="col-md-12">
							<input type="hidden" name="data_produk">
							<span class="help"></span>
						</div>
						
						<div class="col-md-12 col-sm-12">
							<div class="card h-100">
								<div class="card-header">
									Foto Produk
								</div>

								<ul class="list-unstyled p-2 d-flex flex-column col files_" id="files">
									<li class="text-muted text-center empty">No files uploaded.</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="position-relative row form-group">
						<label class="col-sm-3 col-form-label" style="font-weight:600">Deksripsi</label>
						<div class="col-lg-9">
							<textarea readonly="" name="deskripsis" id="pesan_detail" class="form-control" rows="5" style="resize: none;" placeholder="Tulis Deksripsi Produk"></textarea>
							<input type="hidden" name="data_deskripsi">
							<span class="help"></span>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" data-dismiss="modal" class="btn btn-danger" data-dismiss="modal">Tutup</button>
				</div>
			</form>
		</div>
	</div>
</div>


