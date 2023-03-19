<div id="modal_tambah" class="modal fade" data-backdrop="false">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="" id="add_tambah">
                <div class="modal-body" style="min-height: 200px !important;">
                    <input type="hidden" name="<?=$name;?>" value="<?=$hash;?>" />
                    <input type="hidden" name="id">
                    <input type="hidden" name="type" value="slider">
                    <div class="position-relative row form-group">
                        <label class="col-sm-3 col-form-label" style="font-weight:600"><font color="red">*</font>Judul</label>
                        <div class="col-lg-9">
                            <input type="text" name="title" class="form-control" maxlength="100">
                            <span class="help-block invalid-feedback"></span>
                        </div>
                    </div>
                    <div class="position-relative row form-group">
                        <label class="col-sm-3 col-form-label" style="font-weight:600"><font color="red">*</font>Jenis</label>
                        <div class="col-lg-9">
                            <select name="jenis" id="jenis" class="form-control" onchange="show_form_detail()">
                                <option value="">--Pilih Jenis--</option>
                                <option value="url">Url</option>
                                <option value="produk">Produk</option>
                                <option value="umkm">UMKM</option>
                                <option value="agenda">Agenda</option>
                                <option value="berita">Berita</option>
                            </select>
                            <input type="hidden" class="form-control" name="nm_jenis">
                            <span class="help-block invalid-feedback"></span>
                        </div>
                    </div>
                    <div class="position-relative row form-group f-detail f-url" style="display: none;">
                        <label class="col-sm-3 col-form-label" style="font-weight:600"><font color="red">*</font>Url</label>
                        <div class="col-lg-9">
                            <input type="text" name="url" id="url" class="form-control" maxlength="100">
                            <span class="help-block invalid-feedback"></span>
                        </div>
                    </div>
                    <div class="position-relative row form-group f-detail f-produk" style="display: none;">
                        <label class="col-sm-3 col-form-label" style="font-weight:600"><font color="red">*</font>Produk</label>
                        <div class="col-lg-9">
                            <select class="pilih-produk" name="id_produk" id="id_produk" style="width: 100%"></select>
                            <input type="hidden" name="nm_produk" class="form-control">
                            <span class="help-block invalid-feedback"></span>
                        </div>
                    </div>
                    <div class="position-relative row form-group f-detail f-umkm" style="display: none;">
                        <label class="col-sm-3 col-form-label" style="font-weight:600"><font color="red">*</font>UMKM</label>
                        <div class="col-lg-9">
                            <select class="pilih-umkm" name="id_umkm" id="id_umkm" style="width: 100%"></select>
                            <input type="hidden" name="nm_umkm" class="form-control">
                            <span class="help-block invalid-feedback"></span>
                        </div>
                    </div>
                    <div class="position-relative row form-group f-detail f-berita" style="display: none;">
                        <label class="col-sm-3 col-form-label" style="font-weight:600"><font color="red">*</font>Berita</label>
                        <div class="col-lg-9">
                            <select class="pilih-berita" name="id_berita" id="id_berita" style="width: 100%"></select>
                            <input type="hidden" name="nm_berita" class="form-control">
                            <span class="help-block invalid-feedback"></span>
                        </div>
                    </div>
                    <div class="position-relative row form-group f-detail f-agenda" style="display: none;">
                        <label class="col-sm-3 col-form-label" style="font-weight:600"><font color="red">*</font>Agenda</label>
                        <div class="col-lg-9">
                            <select class="pilih-agenda" name="id_agenda" id="id_agenda" style="width: 100%"></select>
                            <input type="hidden" name="nm_agenda" class="form-control">
                            <span class="help-block invalid-feedback"></span>
                        </div>
                    </div>
                    <div class="position-relative row form-group">
                        <label class="col-sm-3 col-form-label" style="font-weight:600"><font color="red">*</font>Foto</label>
                        <div class="col-lg-9">
                            <img src="" class="foto_berita img-responsive">
                            <br>
                            <div id="upload-choose-container">
                                <input type="file" id="upload-file" accept="image/jpg,image/jpeg,image/png" />
                                <button  type="button" id="choose-upload-button" class="btn btn-primary" style="width: 100%">Pilih Foto Slider</button>
                            </div>
                            <div id="upload-file-final-container">
                                <span id="file-name"></span><button type="button" class="btn btn-primary" id="upload-button">Upload</button><button type="button" class="btn btn-danger" id="cancel-button">Cancel</button>
                            </div>
                            <div id="upload-progress"><span id="upload-percentage"></span> % uploaded</div>
                            <div id="error-message"></div>

                            <input type="hidden" name="file_berita" class="form-control">
                            <span class="help-block invalid-feedback" style="width: 100%"></span>
                            <span>Hanya file berformat jpg atau png dan maksimal file 5 Mb <br> Untuk tampilan yang optomal silahkan pilih gambar dengan resolusi 920 x 614 px.</span>
                            <hr style="border-bottom:1px solid #000;margin-bottom: 30px ">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-icon icon-left btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Tutup</button>
                    <button type="button" onclick="simpan_data()" id="btnSave" class="btn btn-icon icon-left btn-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="modal_tambah_banner_produk" class="modal fade" data-backdrop="false">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="" id="add_tambah_banner_produk">
                <div class="modal-body" style="min-height: 200px !important;">
                    <input type="hidden" name="<?=$name;?>" value="<?=$hash;?>" />
                    <input type="hidden" name="id_banner_produk">
                    <input type="hidden" name="type" value="banner_produk">
                    <div class="position-relative row form-group">
                        <label class="col-sm-3 col-form-label" style="font-weight:600"><font color="red">*</font>Judul</label>
                        <div class="col-lg-9">
                            <input type="text" name="title" class="form-control" maxlength="100">
                            <span class="help-block invalid-feedback"></span>
                        </div>
                    </div>
                    <div class="position-relative row form-group f-detail f-produk">
                        <label class="col-sm-3 col-form-label" style="font-weight:600"><font color="red">*</font>Produk</label>
                        <div class="col-lg-9">
                            <select class="pilih-produk2" name="id_produk" id="id_produk_banner" style="width: 100%"></select>
                            <input type="hidden" name="nm_produk" class="form-control">
                            <span class="help-block invalid-feedback"></span>
                        </div>
                    </div>
                    <div class="position-relative row form-group">
                        <label class="col-sm-3 col-form-label" style="font-weight:600"><font color="red">*</font>Foto</label>
                        <div class="col-lg-9">
                            <img src="" class="foto_banner_produk img-responsive">
                            <br>
                            <div id="upload-choose-container1">
                                <input type="file" id="upload-file1" accept="image/jpg,image/jpeg,image/png" />
                                <button  type="button" id="choose-upload-button1" class="btn btn-primary" style="width: 100%">Pilih Foto Banner</button>
                            </div>
                            <div id="upload-file-final-container1">
                                <span id="file-name1"></span><button type="button" class="btn btn-primary" id="upload-button1">Upload</button><button type="button" class="btn btn-danger" id="cancel-button1">Cancel</button>
                            </div>
                            <div id="upload-progress1"><span id="upload-percentage1"></span> % uploaded</div>
                            <div id="error-message1"></div>

                            <input type="hidden" name="file_banner_produk" class="form-control">
                            <span class="help-block invalid-feedback" style="width: 100%"></span>
                            <span>Hanya file berformat jpg atau png dan maksimal file 5 Mb <br> Untuk tampilan yang optomal silahkan pilih gambar dengan resolusi 464 x 299 px.</span>
                            <hr style="border-bottom:1px solid #000;margin-bottom: 30px ">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-icon icon-left btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Tutup</button>
                    <button type="button" onclick="simpan_data_banner_produk()" id="btnSave_banner_produk" class="btn btn-icon icon-left btn-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>