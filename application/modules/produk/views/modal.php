<div id="modal_tambah" class="modal fade" data-backdrop="false">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle"></h5>
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
			</div>
			<form action="" id="add_produk">
				<div class="modal-body" style="min-height: 200px !important;">
					<input type="hidden" name="<?=$name;?>" value="<?=$hash;?>" />
					<input type="hidden" name="id">
					<div class="position-relative row form-group id_umkm d-none">
						<label class="col-sm-3 col-form-label" style="font-weight:600"><font color="red">*</font>UMKM</label>
						<div class="col-lg-9">
							<select name="id_umkm" class="form-control select2" style="width: 100%;">
								
							</select>
							<span class="help-block"></span>
							<div class="alert alert-warning alert-umkm" role="alert" style="margin-top: 5px; display: none;">
							  
							</div>
						</div>
					</div>
					<div class="position-relative row form-group">
						<label class="col-sm-3 col-form-label" style="font-weight:600"><font color="red">*</font>Kategori Produk</label>
						<div class="col-lg-9">
							<select name="id_jenis_usaha" class="form-control select2" style="width: 100%;">
								
							</select>
							<input type="hidden" name="jenis_usaha" class="form-control">
							<span class="help-block"></span>
						</div>
					</div>
					<div class="position-relative row form-group">
						<label class="col-sm-3 col-form-label" style="font-weight:600"><font color="red">*</font>Nama Produk</label>
						<div class="col-lg-9">
							<input type="text" name="nama_produk" class="form-control" placeholder="Nama Produk">
							<span class="help-block"></span>
						</div>
					</div>
					<div class="position-relative row form-group">
						<label class="col-sm-3 col-form-label" style="font-weight:600"><font color="red">*</font>Harga</label>
						<div class="col-lg-9">
							<input type="text" id="harga" name="harga" class="form-control currency-field" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency" placeholder="Harga Produk">
							<span class="help-block"></span>
						</div>
					</div>
					<!-- <div class="position-relative row form-group">
						<label class="col-sm-3 col-form-label" style="font-weight:600">Diskon</label>
						<div class="col-lg-1">
							<div class="custom-control custom-checkbox">
								<input class="custom-control-input" type="radio" name="jenis_diskon" id="persen" value="persen" checked>
								<label class="custom-control-label" for="persen">
									Persentase&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								</label>
							</div>
							<div class="custom-control custom-checkbox">
								<input class="custom-control-input" type="radio" name="jenis_diskon" id="nominal" value="nominal">
								<label class="custom-control-label" for="nominal">
									Nominal&nbsp;&nbsp;&nbsp;
								</label>
							</div>
						</div>
						<div class="col-lg-4">
							<input type="text" id="diskon" name="diskon" class="form-control" placeholder="Diskon Produk" maxlength="4">
							<span class="help-block"></span>
						</div>
						<div class="col-lg-4">
							<span id="hint_diskon" style="font-style:italic"></span><br>
							<span id="hint_diskon2" style="font-style:italic"></span>
						</div>
					</div> -->
					<!-- <div class="position-relative row form-group">
						<label class="col-sm-3 col-form-label" style="font-weight:600">Diskon</label>
						<label class="col-sm-1 col-form-label" style="font-weight:600">Persentase</label>
						<div class="col-lg-8">
							<input type="text" id="diskon" name="diskon" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="5">
							<span class="help-block"></span>
						</div>
					</div>
					<div class="position-relative row form-group">
						<label class="col-sm-3 col-form-label" style="font-weight:600"></label>
						<label class="col-sm-1 col-form-label" style="font-weight:600">Nominal</label>
						<div class="col-lg-8">
							<input type="text" id="diskon_nominal" name="diskon_nominal" class="form-control currency-field" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency">
							<span class="help-block"></span>
						</div>
					</div> -->
					<div class="position-relative row form-group">
						<label class="col-sm-3 col-form-label" style="font-weight:600">Diskon</label>
						<label class="col-sm-1 col-form-label" style="font-weight:600">Persentase</label>
						<div class="col-lg-1">
							<input type="text" id="diskon" name="diskon" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="5">
							<span class="help-block"></span>
						</div>
						<label class="col-sm-1 col-form-label" style="font-weight:600">Nominal</label>
						<div class="col-lg-3">
							<input type="text" id="diskon_nominal" name="diskon_nominal" class="form-control currency-field" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency">
							<span class="help-block"></span>
						</div>
						<label id="diskon_hint" class="col-sm-3 col-form-label" style="font-style:italic"></label>
					</div>
					<div class="position-relative row form-group" style="display:none">
						<label class="col-sm-3 col-form-label" style="font-weight:600">Integrasi</label>
						<div class="col-lg-9">
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" class="custom-control-input" id="cekEorder" name="is_eorder">
								<label class="custom-control-label" for="cekEorder" title="Centang untuk menampilkan produk di e-Order">e-Order</label>
							</div>
							<div class="alert alert-warning alert-has-icon">
		                      <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
		                      <div class="alert-body">
		                        <div class="alert-title">Perhatian !</div>
		                        Jika anda memilih integrasi e-order maka data produk yang anda input hanya akan muncul di halaman web e-order saja.
		                      </div>
		                    </div>
							<span class="help-block"></span>
						</div>
					</div>
					<!-- <div class="position-relative row form-group" id="showstok">
						<label class="col-sm-3 col-form-label" style="font-weight:600"><font color="red">*</font>Stok</label>
						<div class="col-lg-9">
							<input type="text" name="stok" class="form-control currency-field" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency" placeholder="Stok Produk">
							<span class="help-block"></span>
						</div>
					</div> -->
					
					<button type="button" class="btn btn-primary my-2" onclick="add_stok()"><i class="fas fa-plus"></i> Tambah Stok</button>
					<div class="f_link_stok">
						
					</div>

					<div class="position-relative row form-group">
						<label class="col-sm-3 col-form-label" style="font-weight:600"><font color="red">*</font>Berat (Kg)</label>
						<div class="col-lg-9">
							<input type="text" name="berat" id="berat" class="form-control" maxlength="6" placeholder="Berat Produk">
							<span class="help-block"></span>
						</div>
					</div>
					<div class="position-relative row form-group" id="showkurir">
                        <label class="col-sm-3 col-form-label" style="font-weight:600"><font color="red">*</font>Dukungan Kurir</label>
                        <div class="col-lg-9">
                            <select name="id_kurir[]" id="id_kurir" multiple="multiple" class="form-control select2" style="width: 100%;" placeholder="Pilih kurir">

                            </select>
                            <input type="hidden" name="nama_kurir" class="form-control">
                            <span class="help-block"></span>
                        </div>
                    </div>   
					<div class="position-relative row form-group">
						<label class="col-sm-3 col-form-label" style="font-weight:600">Tags</label>
						<div class="col-lg-9">
							<input type="text" name="tags[]" class="form-control inputtags">
							<input type="hidden" name="nama_tags" class="form-control">
							<span class="help-block"></span>
						</div>
					</div>
					<hr>
					<div class="f_link_ekternal_produk">
						
					</div>
					
					<h6>Link Video Youtube</h6>
					<button type="button" class="btn btn-primary" onclick="add_video()"><i class="fas fa-plus"></i> Tambah Video</button>
					<div class="f_link_video">
						
					</div>
					<div class="position-relative row form-group">
						<label class="col-sm-12 col-form-label" style="font-weight:600"><font color="red">*</font>Foto Produk</label>
						<label class="col-sm-12 col-form-label" style="font-weight:400">
							<i>Maskimal 5 Mb, Hanya file jpg, jpeg dan png.</i>
						</label>
						
						<div class="col-md-12">
							<input type="hidden" name="data_produk">
							<span class="help-block"></span>
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
						<label class="col-sm-3 col-form-label" style="font-weight:600"><font color="red">*</font>Deksripsi</label>
						<div class="col-lg-9">
							<textarea name="deskripsis" id="pesan_keterangan" class="form-control" rows="5" style="resize: none;" placeholder="Tulis Deksripsi Produk"></textarea>
							<input type="hidden" name="data_deskripsi" class="form-control">
							<span class="help-block"></span>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" data-dismiss="modal" class="btn btn-icon icon-left btn-danger"><i class="fas fa-times"></i> Tutup</button>
					<button type="button" onclick="simpan_data()" id="btnSave" class="btn btn-icon icon-left btn-primary">
						<i class="fas fa-save"></i> Simpan
					</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div id="modal_data" class="modal fade" data-backdrop="false">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle"></h5>
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body" style="min-height: 200px !important;">
				<input type="hidden" name="<?=$name;?>" value="<?=$hash;?>" />
				<input type="hidden" name="id">
				<div class="position-relative row form-group">
					<label class="col-sm-3 col-form-label" style="font-weight:600">Nama Produk</label>
					<div class="col-lg-9">
						<input type="text" readonly="" name="nama_produk" class="form-control">
						<span class="help-block"></span>
					</div>
				</div>
				<div class="position-relative row form-group">
					<label class="col-sm-3 col-form-label" style="font-weight:600">UMKM</label>
					<div class="col-lg-9">
						<input type="text" readonly="" name="namausaha" class="form-control">
						<span class="help-block"></span>
					</div>
				</div>
				<div class="position-relative row form-group">
					<label class="col-sm-3 col-form-label" style="font-weight:600">Kategori Produk</label>
					<div class="col-lg-9">
						<input type="text" readonly="" name="nama_usaha" class="form-control">
						<span class="help-block"></span>
					</div>
				</div>
				<div class="position-relative row form-group">
					<label class="col-sm-3 col-form-label" style="font-weight:600">Harga</label>
					<div class="col-lg-9">
						<input readonly="" type="text" name="harga" class="form-control currency-field" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency" placeholder="Harga Produk">
						<span class="help-block"></span>
					</div>
				</div>
				<div class="position-relative row form-group">
					<label class="col-sm-3 col-form-label" style="font-weight:600">Stok</label>
					<div class="col-lg-9">
						<input readonly="" type="text" name="stok" class="form-control currency-field" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency" placeholder="Stok Produk">
						<span class="help-block"></span>
					</div>
				</div>
				<div class="position-relative row form-group">
					<label class="col-sm-3 col-form-label" style="font-weight:600">Berat (kg)</label>
					<div class="col-lg-9">
						<input readonly="" type="text" name="berat" class="form-control currency-field" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency" placeholder="Berat Produk">
						<span class="help-block"></span>
					</div>
				</div>
				<div class="position-relative row form-group">
                    <label class="col-sm-3 col-form-label" style="font-weight:600">Dukungan Kurir</label>
                    <div class="col-lg-9">
                        <select disabled="" name="id_kurir[]" multiple="multiple" class="form-control select2" style="width: 100%;" placeholder="Pilih kurir">

                        </select>
                        <span class="help-block"></span>
                    </div>
                </div> 
				<div class="position-relative row form-group">
					<label class="col-sm-3 col-form-label" style="font-weight:600">Tags</label>
					<div class="col-lg-9">
						<input type="text" class="form-control inputtags" disabled="" style="width: 100%;">
						<input type="hidden" name="nama_tags">
						<span class="help-block"></span>
					</div>
				</div>
				<hr>
				<div class="f_link_ekternal_produk">
						
				</div>
				<div class="f_link_video">
						
				</div>
				<div class="position-relative row form-group">
					<label class="col-sm-12 col-form-label" style="font-weight:600">Foto Produk</label>
					<label class="col-sm-12 col-form-label" style="font-weight:400">
						<i>Maskimal 5 Mb, Hanya file jpg, jpeg dan png.</i>
					</label>
					
					<div class="col-md-12">
						<input type="hidden" name="data_produk">
						<span class="help-block"></span>
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
						<span class="help-block"></span>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" data-dismiss="modal" class="btn btn-icon icon-left btn-danger"><i class="fas fa-times"></i> Tutup</button>
			</div>
		</div>
	</div>
</div>