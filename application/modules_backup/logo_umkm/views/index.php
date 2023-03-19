<div class="product-body">
	<h2 class="product-name">Logo UMKM</h2>
	<div class="col-md-12">
	<form action="" id="add_tambah">
		<div class="modal-body" style="min-height: 200px !important;">
			<input type="hidden" name="<?=$name;?>" value="<?=$hash;?>" />
			<input type="hidden" name="id" value="">
            <div class="position-relative row form-group id_umkm">
                <label class="col-sm-3 col-form-label" style="font-weight:600">UMKM</label>
                <div class="col-lg-9">
                    <select name="id_umkm" class="form-control select2">

                    </select>
                    <input type="hidden" name="umkm_id">
                    <span class="help"></span>
                </div>
            </div>
			<div class="position-relative row logo_umkm" style="display: none;">
                <div class="col-lg-12">
                    <img src="" class="foto_berita img-responsive">
                    <br>
                    <div id="upload-choose-container">
                        <input type="file" id="upload-file" accept="image/jpg,image/jpeg,image/png" />
                        <button  type="button" id="choose-upload-button" class="btn btn-primary" style="width: 100%">Pilih Logo</button>
                    </div>
                    <div id="upload-file-final-container">
                        <span id="file-name"></span><button type="button" class="btn btn-primary" id="upload-button">Upload</button><button type="button" class="btn btn-danger" id="cancel-button">Cancel</button>
                    </div>
                    <div id="upload-progress"><span id="upload-percentage"></span> % uploaded</div>
                    <div id="error-message"></div>

                    <input type="hidden" name="logo_umkm">
                    <span class="help" style="width: 100%"></span>
                    <span>Hanya file berformat jpg atau png dan maksimal file 5 Mb</span>
                    <hr style="border-bottom:1px solid #000;margin-bottom: 30px ">
                </div>
            </div>
			<button type="button" class="btn btn-primary button_action sinkron">
				Simpan
			</button>
		</div>
	</form>
	</div>
</div>
<?php
	$this->load->view('js');
?>