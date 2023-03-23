<style type="text/css">
  .smartwizard>.tab-content{
    display:block;
    min-height:35em;
    overflow-y: auto;
    position:relative
    }
</style>

<div class="card card-danger card-form" style="display: none;">
    <div class="card-header">
        <h4>Form Pendaftaran Toko</h4>
        <div class="card-header-action">
            <a class="btn btn-icon btn-danger" href="javascript:void(0);" onclick="refresh_page()" title="Tutup Form"><i class="fas fa-times"></i></a>
        </div>
    </div>
    <div class="collapse show" id="card-umkm">
        <div class="card-body">

            <form action="" id="add_tambah">
                <div id="smartwizard_form" class="smartwizard">
                    <ul class="nav">
                        <li>
                            <a class="nav-link" id="nav_link_step-1" href="#step-1">
                                <i class="fas fa-building"></i>
                                <br>
                                <small>Profil Toko</small>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" id="nav_link_step-2" href="#step-2">
                                <i class="fas fa-location-arrow"></i>
                                <br>
                                <small>Alamat Usaha</small>
                            </a>
                        </li>
                        <!-- <li>
                            <a class="nav-link" id="nav_link_step-3" href="#step-3">
                                <i class="fas fa-file-alt"></i>
                                <br>
                                <small>Upload Logo</small>
                            </a>
                        </li> -->

                        <li>
                            <a class="nav-link" id="nav_link_step-3" href="#step-4">
                                <i class="fas fa-check-circle"></i>
                                <br>
                                <small>Selesai</small>
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div id="step-1" class="tab-pane step-1" role="tabpanel">
                            <input type="hidden" name="<?=$name;?>" value="<?=$hash;?>" />
                            <input type="hidden" name="memiliki_iumk">
                            <input type="hidden" name="type" value="daftar_umkm">
                            <input type="hidden" name="jenis">
                            <input type="hidden" name="id">
                            <div class="row">
                                <div class="col-lg-12" style="display: none;">
                                    <div class="position-relative row form-group">
                                        <label class="col-sm-12 col-form-label" style="font-weight:600">LEGALITAS IZIN USAHA</label>
                                    </div>
                                </div>
                                <div class="col-md-6" style="display: none;">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="position-relative row form-group " style="display: none;">
                                                <label class="col-sm-12 col-form-label" style="font-weight:600"><font color="red">*</font>Bentuk Usaha</label>
                                                <div class="col-lg-12">
                                                    <select name="id_bentuk_usaha" class="form-control select2" data-step="step-1" style="width: 100%;" onchange="load_form_nama_perusahaan()">

                                                    </select>
                                                    <input type="hidden" name="bentuk_usaha" class="" data-step="step-1">
                                                    <span class="help-block invalid-feedback"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 f_nama_perusahaan" >
                                            <div class="position-relative row form-group" style="display: none;">
                                                <label class="col-sm-12 col-form-label" style="font-weight:600"><font color="red">*</font>Nama Perusahaan</label>
                                                <div class="col-lg-12">
                                                    <input type="text" name="nama_perusahaan" class="form-control" data-step="step-1" placeholder="Contoh : ABCD (Tanpa PT/CV)">
                                                    <span class="help-block invalid-feedback"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="position-relative row form-group" style="display: none;">
                                        <label class="col-sm-12 col-form-label" style="font-weight:600"><font color="red">*</font>Nama Usaha</label>
                                        <div class="col-lg-12">
                                            <input type="text" name="nama_usaha" class="form-control" data-step="step-1" placeholder="Contoh : Warung Kita Semua">
                                            <span class="help-block invalid-feedback"></span>
                                        </div>
                                    </div>
                                    <div class="position-relative row form-group" style="display: none;">
                                        <label class="col-sm-12 col-form-label" style="font-weight:600">Nomor NPWP</label>
                                        <div class="col-lg-12">
                                            <input type="text" name="nomor_npwp" class="form-control" data-step="step-1" placeholder="Contoh : 01.855.081.4-412.000">
                                            <span class="help-block invalid-feedback"></span>
                                        </div>
                                    </div>
                                    <div class="view_jenis_usaha">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="position-relative row form-group">
                                                    <label class="col-sm-12 col-form-label" style="font-weight:600">Nama Izin Usaha</label>
                                                    <div class="col-lg-12">
                                                        <select class="form-control select2 nama_izin_usaha" data-step="step-1" style="width: 100%;" name="nama_izin_usaha[]" id="nama_izin_usaha_1">
                                                            <option value="0">Pilih Salah Satu</option>
                                                            <?php 
                                                            $nama_izin_usaha = get_nama_izin_usaha();
                                                            foreach ($nama_izin_usaha as $row) {
                                                                echo '<option value="'.$row.'">'.$row.'</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                        <input type="hidden" name="nm_izin_usaha[]" id="nm_izin_usaha_1" class="form-control" data-step="step-1">
                                                        <span class="help-block invalid-feedback"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="position-relative row form-group">
                                                    <label class="col-sm-12 col-form-label" style="font-weight:600">Nomor</label>
                                                    <div class="col-lg-12">
                                                        <input maxlength="30" type="text" name="no_surat[]" id="no_surat_1" class="form-control" data-step="step-1" placeholder="Contoh : 01.004/UMKM-SM/V/2020">
                                                        <span class="help-block invalid-feedback"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="position-relative row form-group check_lainnya" style="display: none;">
                                                    <label class="col-sm-12 col-form-label" style="font-weight:600">Lainnya</label>
                                                    <div class="col-lg-12">
                                                        <input type="text" name="nama_izin_usaha_lain[]" id="nama_izin_usaha_lain_1" class="form-control" data-step="step-1" placeholder="Contoh : IUMK">
                                                        <span class="help-block invalid-feedback"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="position-relative row form-group" style="display:none;">
                                        <div class="col-md-12">
                                            <button type="button" class="btn btn-primary tambah_izin_usaha">
                                                <i class="fa fa-plus"></i> &nbsp; Tambah Nama Izin Usaha
                                            </button>
                                            <button type="button" class="btn btn-danger hapus_izin_usaha">
                                                <i class="fa fa-minus"></i> &nbsp; Hapus Nama Izin Usaha
                                            </button>    
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="position-relative row form-group" >
                                        <!-- <label class="col-sm-12 col-form-label" style="font-weight:600"style="display: none;"><font color="red">*</font>Cara Pembayaran</label> -->
                                        <div class="col-lg-12">
                                            <div class="custom-control custom-checkbox"style="display: none;">
                                                <input class="custom-control-input" type="radio" name="cara_pembayaran" id="langsung" value="langsung" checked>
                                                <label class="custom-control-label" for="langsung">
                                                    Langsung&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                </label>
                                            </div>
                                            <div class="custom-control custom-checkbox"style="display: none;">
                                                <input class="custom-control-input" type="radio" name="cara_pembayaran" id="transfer" value="transfer">
                                                <label class="custom-control-label" for="transfer">
                                                    Transfer Bank&nbsp;&nbsp;&nbsp;
                                                </label>
                                            </div>
                                            <div id="transfer_bank" >
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="position-relative row form-group"style="display: none;">
                                                            <label class="col-sm-12 col-form-label" style="font-weight:600">Nomor Rekening</label>
                                                            <div class="col-lg-12">
                                                                <input type="text" name="no_rekening" class="form-control" data-step="step-1" placeholder="Nomor Rekening" onkeypress="return Angkasaja(event)" maxlength="20">
                                                                <span class="help-block invalid-feedback"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="position-relative row form-group"style="display: none;">
                                                            <label class="col-sm-12 col-form-label" style="font-weight:600">Bank</label>
                                                            <div class="col-lg-12">
                                                                <select name="id_bank" class="form-control select2 " data-step="step-1" style="width: 100%;">

                                                                </select>
                                                                <input type="hidden" name="nama_bank" class="" data-step="step-1">
                                                                <span class="help-block invalid-feedback"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="position-relative row form-group"style="display: none;">
                                                    <label class="col-sm-12 col-form-label" style="font-weight:600">Rekening Atas Nama</label>
                                                    <div class="col-lg-12">
                                                        <input type="text" name="an_rekening" class="form-control" data-step="step-1" placeholder="Rekening Atas Nama" value="<?php echo $this->session->nama_lengkap; ?>">
                                                        <span class="help-block invalid-feedback"></span>
                                                    </div>
                                                </div>
                                                <div class="position-relative row form-group">
                                                    <label class="col-sm-12 col-form-label" style="font-weight:600"><font color="red">*</font>Dukungan Kurir</label>
                                                    <div class="col-lg-12">
                                                        <select name="id_kurir[]" multiple="multiple" class="form-control select2" data-step="step-1" style="width: 100%;" placeholder="Pilih kurir">

                                                        </select>
                                                        <input type="hidden" name="nama_kurir" class="form-control" data-step="step-1">
                                                        <span class="help-block invalid-feedback"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="position-relative row form-group">
                                        <label class="col-sm-12 col-form-label" style="font-weight:600"><font color="red">*</font>Jenis Usaha</label>
                                        <div class="col-lg-12">
                                            <select name="id_jenis_usaha" class="form-control select2" data-step="step-1" style="width: 100%;" onchange="get_selected_sektor_usaha()">

                                            </select>
                                            <input type="hidden" name="jenis_usaha" class="form-control" data-step="step-1">
                                            <span class="help-block invalid-feedback"></span>
                                        </div>
                                    </div>
                                    <div class="position-relative row form-group"style="display: none;">
                                        <label class="col-sm-12 col-form-label" style="font-weight:600"><font color="red">*</font>Sektor Usaha</label>
                                        <div class="col-lg-12">
                                            <select name="id_sektor_usaha[]" multiple="multiple" class="form-control select2 " data-step="step-1" style="width: 100%;" placeholder="Pilih sektor usaha yang sedang dijalani">

                                            </select>
                                            <input type="hidden" name="sektor_usaha" class="form-control" data-step="step-1">
                                            <span class="help-block invalid-feedback"></span>
                                        </div>
                                    </div>
                                   
                                    <div class="position-relative row form-group"style="display: none;">
                                        <label class="col-sm-12 col-form-label" style="font-weight:600">Kegiatan Usaha Utama</label>
                                        <div class="col-lg-12">
                                            <input type="text" name="kegiatan_usaha_utama" class="form-control" data-step="step-1" placeholder="Contoh : Usaha Makanan Beku">
                                            <span class="help-block invalid-feedback"></span>
                                        </div>
                                    </div>     
                                        
                                    <div class="position-relative row form-group"style="display: none;">
                                        <label class="col-sm-12 col-form-label" style="font-weight:600"><font color="red">*</font>Tanggal Mulai Usaha</label>
                                        <div class="col-lg-12">
                                            <input style="width:100%;" class="form-control " data-step="step-1" type="text"  name="tgl_usaha" id="tgl_usaha">
                                            <span class="help-block invalid-feedback"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr style="margin-top:40px; margin-bottom: 40px;">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="position-relative row form-group">
                                        <label class="col-sm-12 col-form-label" style="font-weight:600">
                                            KONTAK
                                        </label>
                                    </div> 
                                    <div class="row f_no_telp_kantor" style="display: none;">
                                        <div class="col-md-12">
                                            <div class="position-relative row form-group">
                                                <label class="col-sm-12 col-form-label" style="font-weight:600">Telepon Kantor</label>
                                                <div class="col-lg-12">
                                                    <input type="text" name="no_kantor" class="form-control" data-step="step-1" onkeypress="return Angkasaja(event)" maxlength="20" placeholder="Contoh : 02112345678">
                                                    <span class="help-block invalid-feedback"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="position-relative row form-group">
                                                <label class="col-sm-12 col-form-label" style="font-weight:600"><font color="red">*</font>Nomor Handphone / WA</label>
                                                <div class="col-lg-12">
                                                    <input type="text" name="no_hp" class="form-control" data-step="step-1" onkeypress="return Angkasaja(event)" maxlength="20" placeholder="Contoh : 08381234567" value="<?php echo $this->session->userdata('no_telp'); ?>">
                                                    <span class="help-block invalid-feedback"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="position-relative row form-group">
                                                <label class="col-sm-12 col-form-label" style="font-weight:600">Email</label>
                                                <div class="col-lg-12">
                                                    <input type="text" name="email_toko" class="form-control " data-step="step-1" placeholder="Contoh : info@toko.com" value="<?php echo $this->session->userdata('email'); ?>">
                                                    <span class="help-block invalid-feedback"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="view_ecommerce" style="display: none;">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="position-relative row form-group">
                                                    <label class="col-sm-12 col-form-label" style="font-weight:600">Toko Online</label>
                                                    <div class="col-lg-12">
                                                        <select class="form-control select2 nama_ecommerce" data-step="step-1" style="width: 100%;" name="nama_ecommerce[]" id="nama_ecommerce_1">
                                                            <option value="0">Pilih Salah Satu</option>
                                                            <?php 
                                                            $jenis_toko_online = get_jenis_toko_online();
                                                            foreach ($jenis_toko_online as $row) {
                                                                echo '<option value="'.$row.'">'.$row.'</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                        <input type="hidden" name="nm_ecommerce[]" id="nm_ecommerce_1" class="" data-step="step-1">
                                                        <span class="help-block invalid-feedback"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="position-relative row form-group">
                                                    <label class="col-sm-12 col-form-label" style="font-weight:600">Link / Url</label>
                                                    <div class="col-lg-12">
                                                        <input type="text" name="keterangan_ecommerce[]" id="keterangan_ecommerce_1" class="form-control " data-step="step-1" placeholder="Contoh : https://www.tokopedia.com/merchandise">
                                                        <span class="help-block invalid-feedback"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="position-relative row form-group" style="display: none;">
                                        <div class="col-md-12">
                                            <button type="button" class="btn btn-primary tambah_ecommerce" onclick="get_form_ecommerce()">
                                                <i class="fa fa-plus"></i> &nbsp; Tambah Toko Online
                                            </button>
                                            <button type="button" class="btn btn-danger hapus_ecommerce">
                                                <i class="fa fa-minus"></i> &nbsp; Hapus Toko Online
                                            </button>    
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="position-relative row form-group">
                                        <label class="col-sm-12 col-form-label" style="font-weight:600">
                                            &nbsp;
                                        </label>
                                    </div>
                                    
                                    <div class="view_medsos" >
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="position-relative row form-group">
                                                    <label class="col-sm-12 col-form-label" style="font-weight:600">Sosial Media</label>
                                                    <div class="col-lg-12">
                                                        <select class="form-control select2 nama_medsos " data-step="step-1" style="width: 100%;" name="nama_medsos[]" id="nama_medsos_1">
                                                            <option value="0">Pilih Salah Satu</option>
                                                            <?php 
                                                            $jenis_medsos = get_jenis_medsos();
                                                            foreach ($jenis_medsos as $row) {
                                                                echo '<option value="'.$row.'">'.$row.'</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                        <input type="hidden" name="nm_medsos[]" id="nm_medsos_1" class="form-control" data-step="step-1">
                                                        <span class="help-block invalid-feedback"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="position-relative row form-group">
                                                    <label class="col-sm-12 col-form-label" style="font-weight:600">Link / Url</label>
                                                    <div class="col-lg-12">
                                                        <input type="text" name="keterangan_medsos[]" id="keterangan_medsos_1" class="form-control" data-step="step-1" placeholder="Contoh : https://www.instagram.com/tokokue/">
                                                        <span class="help-block invalid-feedback"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="position-relative row form-group">
                                        <div class="col-md-12">
                                            <button type="button" class="btn btn-primary tambah_medsos" onclick="get_form_medsos()">
                                                <i class="fa fa-plus"></i> &nbsp; Tambah Sosial Media
                                            </button>
                                            <button type="button" class="btn btn-danger hapus_medsos">
                                                <i class="fa fa-minus"></i> &nbsp; Hapus Sosial Media
                                            </button>    
                                        </div>
                                    </div>
                                    <div style="display: none;">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="position-relative row form-group">
                                                    <label class="col-sm-12 col-form-label" style="font-weight:600">Ojol</label>
                                                    <div class="col-lg-12">
                                                        <div class="custom-control custom-checkbox">
                                                          <input type="checkbox" class="custom-control-input ojol input-ojol-nothing" id="ojol_1" name="nama_ojol[]" value="Tidak ada Ojol">
                                                          <label class="custom-control-label" for="ojol_1">Tidak ada Ojol</label>
                                                          <input type="hidden" name="keterangan_ojol[]" id="keterangan_ojol_1">
                                                        </div>
                                                        <?php 
                                                        $m_ojol = get_jenis_ojol();
                                                        $i=2;
                                                        foreach ($m_ojol as $r) {
                                                            echo '<div class="custom-control custom-checkbox">
                                                                  <input type="checkbox" class="custom-control-input ojol input-ojol" id="ojol_'.$i.'" name="nama_ojol[]" value="'.$r.'">
                                                                  <label class="custom-control-label" for="ojol_'.$i.'">'.$r.'</label>
                                                                  <input type="hidden" name="keterangan_ojol[]" id="keterangan_ojol_'.$i.'">
                                                                </div>';
                                                            $i++;
                                                        }
                                                        ?>
                                                        <span class="help-block invalid-feedback"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <hr style="margin-top:40px; margin-bottom: 40px;">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="position-relative row form-group">
                                        <label class="col-sm-12 col-form-label" style="font-weight:600">
                                            PEMBAYARAN
                                        </label>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" type="radio" name="jenis_pembayaran" id="rb" value="rb" checked>
                                                <label class="custom-control-label" for="rb">
                                                    Rekening Bank&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                </label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" type="radio" name="jenis_pembayaran" id="pg" value="pg">
                                                <label class="custom-control-label" for="pg">
                                                    Payment Gateway&nbsp;&nbsp;&nbsp;
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div id="jenis_pembayaran_rb">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="position-relative row form-group">
                                                            <label class="col-sm-12 col-form-label" style="font-weight:600">Nomor Rekening</label>
                                                            <div class="col-lg-12">
                                                                <input type="text" name="no_rekening" class="form-control" data-step="step-1" placeholder="Nomor Rekening" onkeypress="return Angkasaja(event)" maxlength="20">
                                                                <span class="help-block invalid-feedback"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="position-relative row form-group">
                                                            <label class="col-sm-12 col-form-label" style="font-weight:600">Bank</label>
                                                            <div class="col-lg-12">
                                                                <select name="id_bank" class="form-control select2 " data-step="step-1" style="width: 100%;">

                                                                </select>
                                                                <input type="hidden" name="nama_bank" class="" data-step="step-1">
                                                                <span class="help-block invalid-feedback"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="position-relative row form-group">
                                                    <label class="col-sm-12 col-form-label" style="font-weight:600">Rekening Atas Nama</label>
                                                    <div class="col-lg-12">
                                                        <input type="text" name="an_rekening" class="form-control" data-step="step-1" placeholder="Rekening Atas Nama">
                                                        <span class="help-block invalid-feedback"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="jenis_pembayaran_pg" style="display:none">
                                                <div class="row">
                                                    <?php foreach(get_payment_gateway() as $key => $val) : ?>
                                                        <div class="col-md-4">
                                                            <div class="custom-control custom-checkbox">
                                                                <input class="custom-control-input" type="checkbox" name="payment_gateway[]" id="<?php echo $key; ?>" value="<?php echo $key; ?>">
                                                                <label class="custom-control-label" for="<?php echo $key; ?>">
                                                                    <?php echo $val; ?>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="col-lg-4">
                                                                <input type="text" name="an_rekening" class="form-control" data-step="step-1" placeholder="Rekening Atas Nama">
                                                                <span class="help-block invalid-feedback"></span>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        </div>

                        <div id="step-2" class="tab-pane step-2" role="tabpanel">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="position-relative row form-group">
                                        <label class="col-sm-12 col-form-label" style="font-weight:600">
                                            ALAMAT WORKSHOP LOKASI USAHA
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <!-- <div class="col-md-12">
                                        <div class="position-relative row form-group">
                                            <div class="form-check" style="padding: 0 15px;">
                                                <input class="form-check-input" data-step="step-2" type="checkbox" value="1" id="defaultCheck1" name="alamat_sama">
                                                <label class="form-check-label" style="font-weight: 600;margin-left: 10px;top: -2px;position: relative;" for="defaultCheck1">
                                                    SAMA DENGAN ALAMAT TEMPAT TINGGAL
                                                </label>
                                            </div>
                                        </div>
                                    </div> -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="position-relative row form-group">
                                                <label class="col-sm-12 col-form-label" style="font-weight:600"><font color="red">*</font>Provinsi</label>
                                                <div class="col-lg-12">
                                                    <select name="id_prop" class="form-control select2" data-step="step-2" style="width: 100%;">

                                                    </select>
                                                    <input type="hidden" name="nama_prop" class="form-control" data-step="step-2">
                                                    <span class="help-block invalid-feedback"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="position-relative row form-group">
                                                <label class="col-sm-12 col-form-label" style="font-weight:600"><font color="red">*</font>Kota</label>
                                                <div class="col-lg-12">
                                                    <select name="id_kota" class="form-control select2" data-step="step-2" style="width: 100%;">

                                                    </select>
                                                    <input type="hidden" name="nama_kota" class="form-control" data-step="step-2">
                                                    <span class="help-block invalid-feedback"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="position-relative row form-group">
                                                <label class="col-sm-12 col-form-label" style="font-weight:600"><font color="red">*</font>Kecamatan</label>
                                                <div class="col-lg-12">
                                                    <select name="id_kec" class="form-control select2" data-step="step-2" style="width: 100%;">

                                                    </select>
                                                    <input type="hidden" name="nama_kec" class="form-control" data-step="step-2">
                                                    <span class="help-block invalid-feedback"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="position-relative row form-group">
                                                <label class="col-sm-12 col-form-label" style="font-weight:600"><font color="red">*</font>Kelurahan</label>
                                                <div class="col-lg-12">
                                                    <select name="id_kel" class="form-control select2" data-step="step-2" style="width: 100%;">

                                                    </select>
                                                    <input type="hidden" name="nama_kel" class="form-control" data-step="step-2">
                                                    <span class="help-block invalid-feedback"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="position-relative row form-group">
                                        <label class="col-sm-12 col-form-label" style="font-weight:600">Kode Pos</label>
                                        <div class="col-lg-12">
                                            <input type="text" name="kode_pos" class="form-control" data-step="step-2" placeholder="Contoh : 14514" onkeypress="return Angkasaja(event)">
                                            <span class="help-block invalid-feedback"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="position-relative row form-group">
                                        <div class="col-sm-12">
                                            <input type="hidden" class="form-control" data-step="step-2" id="lat" name="lat" required="" value="">
                                            <input type="hidden" class="form-control" data-step="step-2" id="long" name="long" required="" value="">
                                            <div id="maps" style="width:100%;height:450px;margin: 0 auto;"></div>
                                        </div>
                                    </div>
                                    <div class="position-relative row form-group">
                                        <label class="col-sm-12 col-form-label" style="font-weight:500">Silahkan klik pada peta ke lokasi sesuai lokasi usaha anda. Alamat akan otomatis terisi.</label>
                                    </div>
                                    <div class="position-relative row form-group">
                                        <label class="col-sm-12 col-form-label" style="font-weight:600"><font color="red">*</font>Alamat Usaha</label>
                                        <div class="col-lg-12">
                                            <textarea class="form-control" data-step="step-2" id="alamat" name="alamat" style="resize: none;" rows="5"></textarea>
                                            <span class="help-block invalid-feedback"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="step-" class="tab-pane step-" role="tabpanel" >
                            <div class="position-relative row form-group">
                                <label class="col-sm-3 col-form-label" style="font-weight:600">Logo Toko</label>
                                <div class="col-lg-9">
                                    <img src="" class="surat_logo img-responsive">
                                    <br>
                                    <div id="upload-choose-container3">
                                        <input type="file" id="upload-file3" accept=".jpg, .jpeg, .png" />
                                        <button type="button" id="choose-upload-button3" class="btn btn-primary" style="width: 100%">Pilih Logo</button>
                                    </div>
                                    <div id="upload-file-final-container3">
                                        <span id="file-name3"></span><button type="button" class="btn btn-primary" id="upload-button3">Upload</button><button type="button" class="btn btn-danger" id="cancel-button3">Cancel</button>
                                    </div>
                                    <div id="upload-progress3"><span id="upload-percentage3"></span> % uploaded</div>
                                    <div id="error-message3"></div>

                                    <input type="hidden" name="file_logo" class="form-control" data-step="step-3">
                                    <span class="help-block invalid-feedback" style="width: 100%"></span>
                                    <span>Hanya file berformat jpg atau png dan maksimal file 5 Mb</span>
                                    <hr style="border-bottom:1px solid #000;margin-bottom: 30px ">
                                </div>
                            </div>

                            <div class="position-relative row form-group file_umkm">
                                <label class="col-sm-3 col-form-label" style="font-weight:600">Upload Surat IUMK / NIB</label>
                                <div class="col-lg-9">
                                    <div class="embed-responsive embed-responsive-16by9 prev_surat_iumkm" style="clear:both; margin-bottom:10px; display: none;">
                                        <iframe src="" class="embed-responsive-item surat_iumkm" frameborder="0" width="100%"></iframe>
                                    </div>

                                    <br>
                                    <div id="upload-choose-container">
                                        <input type="file" id="upload-file" accept=".jpg, .jpeg, .png, .pdf" />
                                        <button  type="button" id="choose-upload-button" class="btn btn-primary" style="width: 100%">Pilih Surat IUMK</button>
                                    </div>
                                    <div id="upload-file-final-container">
                                        <span id="file-name"></span><button type="button" class="btn btn-primary" id="upload-button">Upload</button><button type="button" class="btn btn-danger" id="cancel-button">Cancel</button>
                                    </div>
                                    <div id="upload-progress"><span id="upload-percentage"></span> % uploaded</div>
                                    <div id="error-message"></div>

                                    <input type="hidden" name="file_umkm" class="form-control" data-step="step-3">
                                    <span class="help-block invalid-feedback" style="width: 100%"></span>
                                    <span>Hanya file berformat jpg, png, pdf dan maksimal file 5 Mb</span>
                                    <hr style="border-bottom:1px solid #000;margin-bottom: 30px ">
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <label class="col-sm-3 col-form-label" style="font-weight:600">Upload NPWP</label>
                                <div class="col-lg-9">
                                    <img src="" class="surat_npwp img-responsive">
                                    <br>
                                    <div id="upload-choose-container1">
                                        <input type="file" id="upload-file1" accept=".jpg, .jpeg, .png" />
                                        <button type="button" id="choose-upload-button1" class="btn btn-primary" style="width: 100%">Pilih NPWP</button>
                                    </div>
                                    <div id="upload-file-final-container1">
                                        <span id="file-name1"></span><button type="button" class="btn btn-primary" id="upload-button1">Upload</button><button type="button" class="btn btn-danger" id="cancel-button1">Cancel</button>
                                    </div>
                                    <div id="upload-progress1"><span id="upload-percentage1"></span> % uploaded</div>
                                    <div id="error-message1"></div>

                                    <input type="hidden" name="file_npwp" class="form-control" data-step="step-3">
                                    <span class="help-block invalid-feedback" style="width: 100%"></span>
                                    <span>Hanya file berformat jpg atau png dan maksimal file 5 Mb</span>
                                    <hr style="border-bottom:1px solid #000;margin-bottom: 30px ">
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <label class="col-sm-3 col-form-label" style="font-weight:600">Upload KTP</label>
                                <div class="col-lg-9">
                                    <img src="" class="surat_ktp img-responsive">
                                    <br>
                                    <div id="upload-choose-container2">
                                        <input type="file" id="upload-file2" accept=".jpg, .jpeg, .png" />
                                        <button type="button" id="choose-upload-button2" class="btn btn-primary" style="width: 100%">Pilih KTP</button>
                                    </div>
                                    <div id="upload-file-final-container2">
                                        <span id="file-name2"></span><button type="button" class="btn btn-primary" id="upload-button2">Upload</button><button type="button" class="btn btn-danger" id="cancel-button2">Cancel</button>
                                    </div>
                                    <div id="upload-progress2"><span id="upload-percentage2"></span> % uploaded</div>
                                    <div id="error-message2"></div>

                                    <input type="hidden" name="file_ktp" class="form-control" data-step="step-3">
                                    <span class="help-block invalid-feedback" style="width: 100%"></span>
                                    <span>Hanya file berformat jpg atau png dan maksimal file 5 Mb</span>
                                    <hr style="border-bottom:1px solid #000;margin-bottom: 30px ">
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <label class="col-sm-3 col-form-label" style="font-weight:600">Upload Pas Foto</label>
                                <div class="col-lg-9">
                                    <img src="" class="surat_foto img-responsive">
                                    <br>
                                    <div id="upload-choose-container4">
                                        <input type="file" id="upload-file4" accept=".jpg, .jpeg, .png" />
                                        <button type="button" id="choose-upload-button4" class="btn btn-primary" style="width: 100%">Pilih Pas Foto</button>
                                    </div>
                                    <div id="upload-file-final-container4">
                                        <span id="file-name4"></span><button type="button" class="btn btn-primary" id="upload-button4">Upload</button><button type="button" class="btn btn-danger" id="cancel-button4">Cancel</button>
                                    </div>
                                    <div id="upload-progress4"><span id="upload-percentage4"></span> % uploaded</div>
                                    <div id="error-message4"></div>

                                    <input type="hidden" name="file_foto" class="form-control" data-step="step-3">
                                    <span class="help-block invalid-feedback" style="width: 100%"></span>
                                    <span>Hanya file berformat jpg atau png dan maksimal file 5 Mb</span>
                                    <hr style="border-bottom:1px solid #000;margin-bottom: 30px ">
                                </div>
                            </div>
                        </div>

                        <div id="step-3" class="tab-pane step-3" role="tabpanel">
                            <div class="alert alert-warning" role="alert">
                              <h4 class="alert-heading">Apakah data yang dikirim sudah benar?</h4>
                              <p style="text-align: justify;">Data yang sudah disimpan tidak bisa diubah lagi, pastikan data yang dimasukkan benar.</p>
                            </div>
                    
                            <div class="position-relative row form-group">
                                <div class="col-md-12">
                                    <h5 >PROFIL UMKM</h5>
                                </div>
                                
                                <div class="col-md-12">
                                    <h6 >LEGALITAS IZIN USAHAs</h6>
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6" style="display:none;">
                                            <table class="table table-striped" width="100%">
                                                <tr>
                                                  <th scope="row" width="30%">Nama Perusahaan</th><td width="70%"><span class="preview-nama_perusahaan"></span></td>
                                                </tr>
                                                <tr>
                                                  <th scope="row">Nama Usaha</th><td><span class="preview-nama_usaha"></span></td>
                                                </tr>
                                                <tr>
                                                  <th scope="row">Nomor NPWP</th><td><span class="preview-nomor_npwp"></span></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Izin Usaha</th><td><span class="preview_izin_usaha"></span></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-md-6" style="display:none;">
                                            <table class="table table-striped" width="100%">
                                                <tr>
                                                  <th scope="row" width="30%">Bentuk Usaha</th><td width="70%"><span class="preview-bentuk_usaha"></span></td>
                                                </tr>
                                                <tr>
                                                  <th scope="row">Jenis Usaha</th><td><span class="preview-jenis_usaha"></span></td>
                                                </tr>
                                                <tr>
                                                  <th scope="row">Kegiatan Usaha Utama</th><td><span class="preview-kegiatan_usaha_utama"></span></td>
                                                </tr>
                                                <tr>
                                                  <th scope="row" valign="top">Sektor Usaha</th><td><span class="preview-sektor_usaha"></span></td>
                                                </tr>
                                                <tr>
                                                  <th scope="row">Tanggal Mulai Usaha</th><td><span class="preview-tgl_usaha"></span></td>
                                                </tr>
                                                <tr>
                                                  <th scope="row">Nomor Rekening</th><td><span class="preview-no_rekening"></span></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6>KONTAK</h6>
                                            <table class="table table-striped" width="100%">
                                                <tr>
                                                  <th scope="row" width="30%">Telepon Kantor</th><td width="70%"><span class="preview-no_kantor"></span></td>
                                                </tr>
                                                <tr>
                                                  <th scope="row">Handphone / WA</th><td><span class="preview-no_hp"></span></td>
                                                </tr>
                                                <tr>
                                                  <th scope="row">Email</th><td><span class="preview-email_toko"></span></td>
                                                </tr>
                                                <tr>
                                                  <th scope="row">Alamat Toko Online</th><td><span class="preview-ecommerce"></span></td>
                                                </tr>
                                                <tr>
                                                  <th scope="row">Alamat Sosial Media</th><td><span class="preview-medsos"></span></td>
                                                </tr>
                                                <tr>
                                                  <th scope="row">Ojek Online</th><td><span class="preview-ojol"></span></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <h6>Lainnya</h6>
                                            <table class="table table-striped" width="100%">
                                                <tr>
                                                  <th scope="row">Dukungan Kurir</th><td><span class="preview-kurir"></span></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <div class="col-md-12">
                                    <h5 >ALAMAT USAHA</h5>
                                </div>
                                <div class="col-md-12">
                                    <h6 >ALAMAT WORKSHOP LOKASI USAHA</h6>
                                    <table class="table table-striped" width="100%">
                                        <tr>
                                          <th scope="row">Provinsi</th><td><span class="preview-id_prop"></span></td>
                                        </tr>
                                        <tr>
                                          <th scope="row">Kota/Kabupaten</th><td><span class="preview-id_kota"></span></td>
                                        </tr>
                                        <tr>
                                          <th scope="row">Kecamatan</th><td><span class="preview-id_kec"></span></td>
                                        </tr>
                                        <tr>
                                          <th scope="row">Kelurahan</th><td><span class="preview-id_kel"></span></td>
                                        </tr>
                                        <tr>
                                          <th scope="row">Kode Pos</th><td><span class="preview-kode_pos"></span></td>
                                        </tr>
                                        <tr>
                                          <th scope="row">Alamat Usaha</th><td><span class="preview-alamat"></span></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <div class="col-md-12">
                                    <h5 >BERKAS</h5>
                                </div>
                                <div class="col-md-12">
                                    <div class="position-relative row form-group">
                                        <label class="col-sm-3 col-form-label" style="font-weight:600">Logo Toko</label>
                                        <div class="col-lg-9">
                                            <img src="" class="preview-file_logo img-responsive">
                                            <hr style="border-bottom:1px solid #000;margin-bottom: 30px ">
                                        </div>
                                    </div>
                                    <div class="position-relative row form-group">
                                        <label class="col-sm-3 col-form-label" style="font-weight:600">Surat IUMK</label>
                                        <div class="col-lg-9">
                                            <div class="preview-foto_umkm">
                                                
                                            </div>
                                            <hr style="border-bottom:1px solid #000;margin-bottom: 30px ">
                                        </div>
                                    </div>
                                    <div class="position-relative row form-group">
                                        <label class="col-sm-3 col-form-label" style="font-weight:600">NPWP</label>
                                        <div class="col-lg-9">
                                            <img src="" class="preview-file_npwp img-responsive">
                                            <hr style="border-bottom:1px solid #000;margin-bottom: 30px ">
                                        </div>
                                    </div>
                                    <div class="position-relative row form-group">
                                        <label class="col-sm-3 col-form-label" style="font-weight:600">KTP</label>
                                        <div class="col-lg-9">
                                            <img src="" class="preview-file_ktp img-responsive">
                                            <hr style="border-bottom:1px solid #000;margin-bottom: 30px ">
                                        </div>
                                    </div>
                                    <div class="position-relative row form-group">
                                        <label class="col-sm-3 col-form-label" style="font-weight:600">Pas Foto</label>
                                        <div class="col-lg-9">
                                            <img src="" class="preview-file_foto img-responsive">
                                            <hr style="border-bottom:1px solid #000;margin-bottom: 30px ">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>