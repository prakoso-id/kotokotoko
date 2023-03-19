<div class="container container-240">
	<div class="myaccount">
	    <ul class="breadcrumb v3">
	        <li><a href="<?php echo base_url(); ?>">Beranda</a></li>
	        <li class="active">Biodata</li>
	    </ul>
	    <div class="row">
            <div class="col-md-12">
                <div class="cmt-title text-center abs">
                    <h1 class="page-title v1">Biodata</h1>
                </div>
                <div class="page-content">
                    <form class="login-form" action="" id="add_tambah"> 
                    	<input type="hidden" name="<?=$name;?>" value="<?=$hash;?>" />
						<input type="hidden" name="id" value="">
                          <div class="form-group col-md-6">
                            <label>NIK <span class="f-red">*</span></label>
                            <input type="text" class="form-control bdr" value="<?php echo @$data->username; ?>" readonly>

                            <label>Nama Lengkap <span class="f-red">*</span></label>
                            <input type="text" class="form-control bdr" value="<?php echo @$data->nama; ?>" readonly>

                            <label>Email <span class="f-red">*</span></label>
                            <input type="text" class="form-control bdr" value="<?php echo @$data->email; ?>" readonly>

                            <label>No. Telp <span class="f-red">*</span></label>
                            <input type="text" class="form-control bdr" value="<?php echo @$data->no_telp; ?>" readonly>
                          </div>
                          <div class="form-group col-md-6">
                          	<label>Jenis Kelamin <span class="f-red">*</span></label>
                            <input type="text" class="form-control bdr" value="<?php echo @$data->jenis_kelamin; ?>" readonly>

                            <label>Tempat, Tanggal Lahir <span class="f-red">*</span></label>
                            <input type="text" class="form-control bdr" value="<?php echo @$data->tempat_lahir.' , '.@indonesian_date_2(@$data->tanggal_lahir); ?>" readonly>

                            <label>Alamat <span class="f-red">*</span></label>
                            <input type="text" class="form-control bdr" value="<?php echo @$data->alamat; ?>" readonly>
                          </div>
                          <div class="form-group col-md-12">
                              <button type="button" class="btn btn-submit btn-gradient sinkron" style="float: right;">
                                  <i class="fa fa-refresh"></i> Sinkronisasi
                              </button>
                          </div>
                    </form>
                </div>
            </div>
        </div>
	</div>
</div>
<?php
	$this->load->view('js');
?>