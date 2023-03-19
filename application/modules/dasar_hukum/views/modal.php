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
                    <div class="position-relative row form-group">
                        <label class="col-sm-3 col-form-label" style="font-weight:600">Judul*</label>
                        <div class="col-lg-9">
                            <input type="text" name="judul" class="form-control">
                            <span class="help"></span>
                        </div>
                    </div>
                    <div class="position-relative row form-group">
                        <label class="col-sm-3 col-form-label" style="font-weight:600">Deksripsi*</label>
                        <div class="col-lg-9">
                            <textarea name="deskripsis" id="pesan_keterangan" class="form-control" rows="5" style="resize: none;" placeholder="Tulis Deksripsi Produk"></textarea>
                            <input type="hidden" name="data_deskripsi">
                            <span class="help"></span>
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