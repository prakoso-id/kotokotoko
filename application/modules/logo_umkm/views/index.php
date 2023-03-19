<section class="section">
    <div class="section-header">
        <h1><?php echo $title_beranda; ?></h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item "><a href="<?php echo base_url('dashboard'); ?>">Dashboard</a></div>
            <div class="breadcrumb-item active"><?php echo $title_beranda; ?></div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12 col-sm-12 col-lg-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4>Logo UMKM</h4>
                        <div class="card-header-action">
                            <a data-collapse="#card-umkm" class="btn btn-icon btn-primary" href="#"><i class="fas fa-minus"></i></a>
                        </div>
                    </div>
                    <div class="collapse show" id="card-umkm">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="" id="add_tambah">
                                        <input type="hidden" name="<?=$name;?>" value="<?=$hash;?>" />
                                        <input type="hidden" name="id" value="">
                                        <div class="position-relative row form-group id_umkm">
                                            <label class="col-sm-3 col-form-label" style="font-weight:600">UMKM</label>
                                            <div class="col-lg-9">
                                                <select name="id_umkm" class="form-control select2">

                                                </select>
                                                <input type="hidden" name="umkm_id" class="form-control">
                                                <span class="help-block invalid-feedback"></span>
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
                                            <button type="button" class="btn btn-primary btn-icon icon-left sinkron">
                                                <i class="fas fa-save"></i> Simpan
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</section>
<?php
	$this->load->view('js');
?>