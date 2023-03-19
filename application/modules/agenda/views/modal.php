<div id="modal_tambah" class="modal fade" data-backdrop="false">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                <button type="button" class="close" onclick="refresh_page()"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="" id="add_tambah">
                <div class="modal-body" style="min-height: 200px !important;">
                    <input type="hidden" name="<?=$name;?>" value="<?=$hash;?>" />
                    <input type="hidden" name="id">
                    <div class="position-relative row form-group">
                        <label class="col-sm-3 col-form-label" style="font-weight:600"><font color="red">*</font>Judul</label>
                        <div class="col-lg-9">
                            <input type="text" name="judul" class="form-control">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="position-relative row form-group">
                        <label class="col-sm-3 col-form-label" style="font-weight:600"><font color="red">*</font>Foto</label>
                        <div class="col-lg-9">
                            <img src="" class="foto_berita img-responsive">
                            <br>
                            <div id="upload-choose-container">
                                <input type="file" id="upload-file" accept="image/jpg,image/jpeg,image/png" />
                                <button  type="button" id="choose-upload-button" class="btn btn-primary" style="width: 100%">Pilih Foto Agenda</button>
                            </div>
                            <div id="upload-file-final-container">
                                <span id="file-name"></span><button type="button" class="btn btn-primary" id="upload-button">Upload</button><button type="button" class="btn btn-danger" id="cancel-button">Cancel</button>
                            </div>
                            <div id="upload-progress"><span id="upload-percentage"></span> % uploaded</div>
                            <div id="error-message"></div>

                            <input type="hidden" name="file_berita">
                            <span class="help-block" style="width: 100%"></span>
                            <span>Hanya file berformat jpg atau png dan maksimal file 5 Mb</span>
                            <hr style="border-bottom:1px solid #000;margin-bottom: 30px ">
                        </div>
                    </div>
                    <div class="position-relative row form-group">
                        <label class="col-sm-3 col-form-label" style="font-weight:600"><font color="red">*</font>Tanggal Acara</label>
                        <div class="col-lg-9">
                            <input style="width:100%;" class="form-control" type="text" name="tanggal" id="tanggal">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="position-relative row form-group">
                        <label class="col-sm-3 col-form-label" style="font-weight:600"><font color="red">*</font>Lokasi Acara</label>
                        <div class="col-sm-9">
                            <input type="hidden" class="form-control" id="lat" name="lat" required="" value="">
                            <input type="hidden" class="form-control" id="long" name="long" required="" value="">
                            <div id="maps" style="width:100%;height:450px;margin: 0 auto;"></div>
                        </div>
                    </div>
                    <div class="position-relative row form-group">
                        <label class="col-sm-3"></label>
                        <label class="col-sm-9 col-form-label" style="font-weight:500">Silahkan klik pada peta ke lokasi sesuai lokasi usaha anda. Alamat akan otomatis terisi.</label>
                    </div>
                    <div class="position-relative row form-group">
                        <label class="col-sm-3 col-form-label" style="font-weight:600"><font color="red">*</font>Lokasi</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="alamat" name="alamat" value=""> 
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="position-relative row form-group">
                        <label class="col-sm-3 col-form-label" style="font-weight:600"><font color="red">*</font>Deksripsi</label>
                        <div class="col-lg-9">
                            <textarea name="deskripsi" id="pesan_keterangan" class="form-control" rows="5" style="resize: none;" placeholder="Tulis Deksripsi Produk"></textarea>
                            <input type="hidden" name="data_deskripsi">
                            <span class="help-block"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="refresh_page()" class="btn btn-icon icon-left btn-danger"><i class="fas fa-times"></i> Tutup</button>
                    <button type="button" onclick="simpan_data()" id="btnSave" class="btn btn-icon icon-left btn-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>