<style type="text/css">
 .modal-body {
    max-height: calc(115vh - 212px);
    overflow-y: auto;
  }
</style>
<div id="modal_tambah" class="modal fade" data-backdrop="false">
    <div class="modal-dialog modal-full">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                <button type="button" class="close" onclick="refresh_page()"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="" id="add_tambah">
                <div class="modal-body" style="min-height: 200px !important;">
                    <div class="wizard">
                        <div class="wizard-inner">
                            <div class="connecting-line"></div>
                            <ul class="nav nav-tabs" role="tablist">

                                <li role="presentation" class="active">
                                    <strong style="position: relative;left: 35%;" class="title-tab title-step1">
                                        Data Pribadi
                                    </strong>
                                    <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" class="a-step1">
                                        <span class="round-tab">
                                            <i class="fa fa-user">
                                                
                                            </i>
                                        </span>
                                    </a>
                                </li>

                                <li role="presentation" class="disabled">
                                    <strong style="position: relative;left: 35%;" class="title-tab title-step2">
                                        Profil UMKM
                                    </strong>
                                    <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" class="a-step2">
                                        <span class="round-tab">
                                            <i class="fa fa-building"></i>
                                        </span>
                                    </a>
                                </li>
                                <li role="presentation" class="disabled">
                                    <strong style="position: relative;left: 35%;" class="title-tab title-step3">
                                        Alamat Usaha
                                    </strong>
                                    <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" class="a-step3">
                                        <span class="round-tab">
                                            <i class="fa fa-location-arrow"></i>
                                        </span>
                                    </a>
                                </li>
                                <li role="presentation" class="disabled">
                                    <strong style="position: relative;left: 35%;" class="title-tab title-step4">
                                        Upload Berkas
                                    </strong>
                                    <a href="#step4" data-toggle="tab" aria-controls="step3" role="tab" class="a-step4">
                                        <span class="round-tab">
                                            <i class="fa fa-files-o"></i>
                                        </span>
                                    </a>
                                </li>
                                <li role="presentation" class="disabled">
                                    <strong style="position: relative;left: 40%;" class="title-tab title-complete">
                                        Selesai
                                    </strong>
                                    <a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" class="a-complete" onclick="get_resume()">
                                        <span class="round-tab">
                                            <i class="fa fa-check-circle-o"></i>
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="tab-content">
                            <div class="tab-pane active" role="tabpanel" id="step1">
                                <input type="hidden" name="<?=$name;?>" value="<?=$hash;?>" />
                                <input type="hidden" name="memiliki_iumk">
                                <input type="hidden" name="type" value="daftar_umkm">
                                <input type="hidden" name="jenis">
                                <input type="hidden" name="id">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="position-relative row form-group">
                                            <label class="col-sm-12 col-form-label" style="font-weight:600">INFORMASI KTP</label>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="position-relative row form-group">
                                                    <label class="col-sm-12 col-form-label" style="font-weight:600">*No KTP</label>
                                                    <div class="col-lg-12">
                                                        <input type="text" name="username" class="form-control step1" readonly="">
                                                        <span class="help"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="position-relative row form-group">
                                                    <label class="col-sm-12 col-form-label" style="font-weight:600">*Domisili</label>
                                                    <div class="col-lg-12">
                                                        <input type="text" name="domisili" class="form-control step1" readonly="">
                                                        <span class="help"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="position-relative row form-group">
                                                    <label class="col-sm-12 col-form-label" style="font-weight:600">Provinsi</label>
                                                    <div class="col-lg-12">
                                                        <select disabled="true" class="form-control select2 step1" name="no_prop">
                                                            
                                                        </select>
                                                        <span class="help"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="position-relative row form-group">
                                                    <label class="col-sm-12 col-form-label" style="font-weight:600">Kota</label>
                                                    <div class="col-lg-12">
                                                        <select disabled="true" class="form-control select2 step1" name="no_kota">
                                                            
                                                        </select>
                                                        <span class="help"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="position-relative row form-group">
                                                    <label class="col-sm-12 col-form-label" style="font-weight:600">Kecamatan</label>
                                                    <div class="col-lg-12">
                                                        <select disabled="true" class="form-control select2 step1" name="no_kec">
                                                            
                                                        </select>
                                                        <span class="help"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="position-relative row form-group">
                                                    <label class="col-sm-12 col-form-label" style="font-weight:600">Kelurahan</label>
                                                    <div class="col-lg-12">
                                                        <select disabled="true" class="form-control select2 step1" name="no_kel">
                                                            
                                                        </select>
                                                        <span class="help"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="position-relative row form-group">
                                                    <label class="col-sm-12 col-form-label" style="font-weight:600">RW</label>
                                                    <div class="col-lg-12">
                                                        <input readonly="" type="text" name="no_rw" class="form-control step1" placeholder="Contoh : 5">
                                                        <span class="help"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="position-relative row form-group">
                                                    <label class="col-sm-12 col-form-label" style="font-weight:600">RT</label>
                                                    <div class="col-lg-12">
                                                        <input readonly="" type="text" name="no_rt" class="form-control step1" placeholder="Contoh : 5">
                                                        <span class="help"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="position-relative row form-group">
                                                    <label class="col-sm-12 col-form-label" style="font-weight:600">Kode Pos</label>
                                                    <div class="col-lg-12">
                                                        <input type="text" name="kode_pos_rumah" class="form-control step1" placeholder="Contoh : 14145">
                                                        <span class="help"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="position-relative row form-group">
                                            <label class="col-sm-12 col-form-label" style="font-weight:600">Alamat Rumah</label>
                                            <div class="col-lg-12">
                                                <input type="text" readonly="" name="alamat_rumah" class="form-control step1" placeholder="Contoh : Jl. Pesanggrahan Timur 2">
                                                <span class="help"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="position-relative row form-group">
                                            <label class="col-sm-12 col-form-label" style="font-weight:600">BIODATA DIRI</label>
                                        </div>
                                        <div class="position-relative row form-group">
                                            <label class="col-sm-12 col-form-label" style="font-weight:600">*Nama Lengkap</label>
                                            <div class="col-lg-12">
                                                <input type="text" name="nama" class="form-control step1" readonly="">
                                                <span class="help"></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="position-relative row form-group">
                                                    <label class="col-sm-12 col-form-label" style="font-weight:600">*Tempat Lahir</label>
                                                    <div class="col-lg-12">
                                                        <input type="text" name="tempat_lahir" class="form-control step1" readonly="">
                                                        <span class="help"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="position-relative row form-group">
                                                    <label class="col-sm-12 col-form-label" style="font-weight:600">*Tanggal Lahir</label>
                                                    <div class="col-lg-12">
                                                        <input type="text" name="tanggal_lahir" class="form-control step1" readonly="">
                                                        <span class="help"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="position-relative row form-group">
                                                    <label class="col-sm-12 col-form-label" style="font-weight:600">*Jenis Kelamin</label>
                                                    <div class="col-lg-12">
                                                        <input type="text" name="jenis_kelamin" class="form-control step1" readonly="">
                                                        <span class="help"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="position-relative row form-group">
                                                    <label class="col-sm-12 col-form-label" style="font-weight:600">*Nama Ibu Kandung</label>
                                                    <div class="col-lg-12">
                                                        <input type="text" name="nama_ibu" class="form-control step1" placeholder="Contoh : Sulistiyawati">
                                                        <span class="help"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                                <ul class="list-inline pull-right">
                                    <li>
                                        <button type="button" class="btn btn-primary next-step">Selanjutnya</button>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-pane" role="tabpanel" id="step2">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="position-relative row form-group">
                                            <label class="col-sm-12 col-form-label" style="font-weight:600">LEGALITAS IZIN USAHA</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="position-relative row form-group">
                                                    <label class="col-sm-12 col-form-label" style="font-weight:600">*Bentuk Usaha</label>
                                                    <div class="col-lg-12">
                                                        <select name="id_bentuk_usaha" class="form-control select2 step2">

                                                        </select>
                                                        <input type="hidden" name="bentuk_usaha" class="step2">
                                                        <span class="help"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="position-relative row form-group">
                                                    <label class="col-sm-12 col-form-label" style="font-weight:600">Nama Perusahaan</label>
                                                    <div class="col-lg-12">
                                                        <input type="text" name="nama_perusahaan" class="form-control step2" placeholder="Contoh : ABCD (Tanpa PT/CV)">
                                                        <span class="help"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="position-relative row form-group">
                                            <label class="col-sm-12 col-form-label" style="font-weight:600">*Nama Usaha</label>
                                            <div class="col-lg-12">
                                                <input type="text" name="nama_usaha" class="form-control step2" placeholder="Contoh : Warung Kita Semua">
                                                <span class="help"></span>
                                            </div>
                                        </div>
                                        <div class="position-relative row form-group">
                                            <label class="col-sm-12 col-form-label" style="font-weight:600">Nomor NPWP</label>
                                            <div class="col-lg-12">
                                                <input type="text" name="nomor_npwp" class="form-control step2" placeholder="Contoh : 01.855.081.4-412.000">
                                                <span class="help"></span>
                                            </div>
                                        </div>
                                        <div class="view_jenis_usaha">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="position-relative row form-group">
                                                        <label class="col-sm-12 col-form-label" style="font-weight:600">Nama Izin Usaha</label>
                                                        <div class="col-lg-12">
                                                            <select class="form-control select2 nama_izin_usaha step2" name="nama_izin_usaha[]" id="nama_izin_usaha_1">
                                                                <option value="0">Pilih Salah Satu</option>
                                                                <?php 
                                                                $nama_izin_usaha = get_nama_izin_usaha();
                                                                foreach ($nama_izin_usaha as $row) {
                                                                    echo '<option value="'.$row.'">'.$row.'</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                            <input type="hidden" name="nm_izin_usaha[]" id="nm_izin_usaha_1" class="step2">
                                                            <span class="help"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="position-relative row form-group">
                                                        <label class="col-sm-12 col-form-label" style="font-weight:600">Nomor Izin Berusaha (NIB)</label>
                                                        <div class="col-lg-12">
                                                            <input type="text" name="no_surat[]" id="no_surat_1" class="form-control step2" placeholder="Contoh : 01.004/UMKM-SM/V/2020">
                                                            <span class="help"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="position-relative row form-group check_lainnya" style="display: none;">
                                                        <label class="col-sm-12 col-form-label" style="font-weight:600">Lainnya</label>
                                                        <div class="col-lg-12">
                                                            <input type="text" name="nama_izin_usaha_lain[]" id="nama_izin_usaha_lain_1" class="form-control step2" placeholder="Contoh : IUMK">
                                                            <span class="help"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="position-relative row form-group">
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
                                        <div class="position-relative row form-group">
                                            <label class="col-sm-12 col-form-label" style="font-weight:600">*Jenis Usaha</label>
                                            <div class="col-lg-12">
                                                <select name="id_jenis_usaha" class="form-control select2 step2" onchange="get_selected_sektor_usaha()">

                                                </select>
                                                <input type="hidden" name="jenis_usaha" class="step2">
                                                <span class="help"></span>
                                            </div>
                                        </div>
                                        <div class="position-relative row form-group">
                                            <label class="col-sm-12 col-form-label" style="font-weight:600">*Sektor Usaha</label>
                                            <div class="col-lg-12">
                                                <select name="id_sektor_usaha[]" multiple="multiple" class="form-control select2 step2" placeholder="Pilih sektor usaha yang sedang dijalani">

                                                </select>
                                                <input type="hidden" name="sektor_usaha" class="step2">
                                                <span class="help"></span>
                                            </div>
                                        </div>
                                       
                                        <div class="position-relative row form-group">
                                            <label class="col-sm-12 col-form-label" style="font-weight:600">*Kegiatan Usaha Utama</label>
                                            <div class="col-lg-12">
                                                <input type="text" name="kegiatan_usaha_utama" class="form-control step2" placeholder="Contoh : Usaha Makanan Beku">
                                                <span class="help"></span>
                                            </div>
                                        </div>     
                                            
                                        <div class="position-relative row form-group">
                                            <label class="col-sm-12 col-form-label" style="font-weight:600">*Tanggal Mulai Usaha</label>
                                            <div class="col-lg-12">
                                                <input type="date" name="tgl_usaha" max='<?php echo date('Y-m-d') ?>' class="form-control step2">
                                                <span class="help"></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="position-relative row form-group">
                                                    <label class="col-sm-12 col-form-label" style="font-weight:600">Nomor Rekening</label>
                                                    <div class="col-lg-12">
                                                        <input type="text" name="no_rekening" class="form-control step2" placeholder="Nomor Rekening" onkeypress="return Angkasaja(event)" maxlength="20">
                                                        <span class="help"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="position-relative row form-group">
                                                    <label class="col-sm-12 col-form-label" style="font-weight:600">Bank</label>
                                                    <div class="col-lg-12">
                                                        <select name="id_bank" class="form-control select2 step2">

                                                        </select>
                                                        <input type="hidden" name="nama_bank" class="step2">
                                                        <span class="help"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="position-relative row form-group">
                                            <label class="col-sm-12 col-form-label" style="font-weight:600">Rekening Atas Nama</label>
                                            <div class="col-lg-12">
                                                <input type="text" name="an_rekening" class="form-control step2" placeholder="Rekening Atas Nama">
                                                <span class="help"></span>
                                            </div>
                                        </div>    
                                    </div>
                                </div>
                                <hr style="margin-top:40px; margin-bottom: 40px;">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="position-relative row form-group">
                                            <label class="col-sm-12 col-form-label" style="font-weight:600">
                                                NO TELEPON
                                            </label>
                                        </div> 
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="position-relative row form-group">
                                                    <label class="col-sm-12 col-form-label" style="font-weight:600">Telepon Rumah</label>
                                                    <div class="col-lg-12">
                                                        <input type="text" name="no_rumah" class="form-control step2" onkeypress="return Angkasaja(event)" maxlength="20" placeholder="Contoh : 02112345678">
                                                        <span class="help"></span>
                                                    </div>
                                                </div>   
                                            </div>
                                            <div class="col-md-6">
                                                <div class="position-relative row form-group">
                                                    <label class="col-sm-12 col-form-label" style="font-weight:600">Telepon Kantor</label>
                                                    <div class="col-lg-12">
                                                        <input type="text" name="no_kantor" class="form-control step2" onkeypress="return Angkasaja(event)" maxlength="20" placeholder="Contoh : 02112345678">
                                                        <span class="help"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="position-relative row form-group">
                                                    <label class="col-sm-12 col-form-label" style="font-weight:600">*Handphone / WA</label>
                                                    <div class="col-lg-12">
                                                        <input type="text" name="no_hp" class="form-control step2" onkeypress="return Angkasaja(event)" maxlength="20" placeholder="Contoh : 08381234567">
                                                        <span class="help"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="position-relative row form-group">
                                                    <label class="col-sm-12 col-form-label" style="font-weight:600">Email</label>
                                                    <div class="col-lg-12">
                                                        <input type="text" name="email_toko" class="form-control step2" placeholder="Contoh : info@toko.com">
                                                        <span class="help"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="view_ecommerce">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="position-relative row form-group">
                                                        <label class="col-sm-12 col-form-label" style="font-weight:600">Toko Online</label>
                                                        <div class="col-lg-12">
                                                            <select class="form-control select2 nama_ecommerce step2" name="nama_ecommerce[]" id="nama_ecommerce_1">
                                                                <option value="0">Pilih Salah Satu</option>
                                                                <?php 
                                                                $jenis_toko_online = get_jenis_toko_online();
                                                                foreach ($jenis_toko_online as $row) {
                                                                    echo '<option value="'.$row.'">'.$row.'</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                            <input type="hidden" name="nm_ecommerce[]" id="nm_ecommerce_1" class="step2">
                                                            <span class="help"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="position-relative row form-group">
                                                        <label class="col-sm-12 col-form-label" style="font-weight:600">Link / Url</label>
                                                        <div class="col-lg-12">
                                                            <input type="text" name="keterangan_ecommerce[]" id="keterangan_ecommerce_1" class="form-control step2" placeholder="Contoh : https://www.tokopedia.com/merchandise">
                                                            <span class="help"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="position-relative row form-group">
                                            <div class="col-md-12">
                                                <button type="button" class="btn btn-primary tambah_ecommerce" onclick="get_form_ecommerce()">
                                                    <i class="fa fa-plus"></i> &nbsp; Tambah Toko Online
                                                </button>
                                                <button type="button" class="btn btn-danger hapus_ecommerce">
                                                    <i class="fa fa-minus"></i> &nbsp; Hapus Toko Online
                                                </button>    
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="view_medsos">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="position-relative row form-group">
                                                        <label class="col-sm-12 col-form-label" style="font-weight:600">Sosial Media</label>
                                                        <div class="col-lg-12">
                                                            <select class="form-control select2 nama_medsos step2" name="nama_medsos[]" id="nama_medsos_1">
                                                                <option value="0">Pilih Salah Satu</option>
                                                                <?php 
                                                                $jenis_medsos = get_jenis_medsos();
                                                                foreach ($jenis_medsos as $row) {
                                                                    echo '<option value="'.$row.'">'.$row.'</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                            <input type="hidden" name="nm_medsos[]" id="nm_medsos_1" class="step2">
                                                            <span class="help"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="position-relative row form-group">
                                                        <label class="col-sm-12 col-form-label" style="font-weight:600">Link / Url</label>
                                                        <div class="col-lg-12">
                                                            <input type="text" name="keterangan_medsos[]" id="keterangan_medsos_1" class="form-control step2" placeholder="Contoh : https://www.instagram.com/tokokue/">
                                                            <span class="help"></span>
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
                                        <hr>
                                        <div class="view_ojol">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="position-relative row form-group">
                                                        <label class="col-sm-12 col-form-label" style="font-weight:600">Ojol</label>
                                                        <div class="col-lg-12">
                                                            <select class="form-control select2 nama_ojol step2" name="nama_ojol[]" id="nama_ojol_1">
                                                                <option value="0">Pilih Salah Satu</option>
                                                                <?php 
                                                                $jenis_ojol = get_jenis_ojol();
                                                                foreach ($jenis_ojol as $row) {
                                                                    echo '<option value="'.$row.'">'.$row.'</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                            <input type="hidden" name="nm_ojol[]" id="nm_ojol_1" class="step2">
                                                            <span class="help"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="position-relative row form-group">
                                                        <label class="col-sm-12 col-form-label" style="font-weight:600">Link / Url</label>
                                                        <div class="col-lg-12">
                                                            <input type="text" name="keterangan_ojol[]" id="keterangan_ojol_1" class="form-control step2" placeholder="Contoh : https://gofood.link/u/JVweR">
                                                            <span class="help"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="position-relative row form-group">
                                            <div class="col-md-12">
                                                <button type="button" class="btn btn-primary tambah_ojol" onclick="get_form_ojol()">
                                                    <i class="fa fa-plus"></i> &nbsp; Tambah Ojol
                                                </button>
                                                <button type="button" class="btn btn-danger hapus_ojol">
                                                    <i class="fa fa-minus"></i> &nbsp; Hapus Ojol
                                                </button>    
                                            </div>
                                        </div>
                                        <hr>  
                                    </div>
                                    <div class="col-md-6">
                                        <div class="position-relative row form-group">
                                            <label class="col-sm-12 col-form-label" style="font-weight:600">
                                                KELEMBAGAAN & INDIKATOR USAHA
                                            </label>
                                        </div>
                                        <div class="row" style="margin-bottom: 5px;">
                                            <div class="col-md-4">
                                                <div class="position-relative row form-group">
                                                    <label class="col-sm-12 col-form-label" style="font-weight:600">*Karyawan Laki-laki</label>
                                                    <div class="col-lg-12">
                                                        <input type="text" name="pegawai_laki" class="form-control step2" onkeypress="return Angkasaja(event)" placeholder="Contoh : 10">
                                                        <span class="help"></span>
                                                    </div>
                                                </div>   
                                            </div>
                                            <div class="col-md-4">
                                                <div class="position-relative row form-group">
                                                    <label class="col-sm-12 col-form-label" style="font-weight:600">*Karyawan Perempuan</label>
                                                    <div class="col-lg-12">
                                                        <input type="text" name="pegawai_perempuan" class="form-control step2" onkeypress="return Angkasaja(event)" placeholder="Contoh : 10">
                                                        <span class="help"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="position-relative row form-group">
                                                    <label class="col-sm-12 col-form-label" style="font-weight:600">*Total Tenaga Kerja</label>
                                                    <div class="col-lg-12">
                                                        <input type="text" name="jml_pegawai" class="form-control currency-field step2" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency" placeholder="Contoh : 20" readonly>
                                                        <span class="help"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12"><i>Isi angka nol jika tidak memiki karyawan</i></div>
                                        </div>
                                        <div class="row" style="margin-bottom: 5px;">
                                            <div class="col-md-6">
                                                <div class="position-relative row form-group">
                                                    <label class="col-sm-12 col-form-label" style="font-weight:600">*Jumlah Omset Tahun Awal / Sebelumnya</label>
                                                    <div class="col-lg-12">
                                                        <input type="text" name="jml_omset_sebelumnya" class="form-control currency-field step2" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency" placeholder="Contoh : 300.000.000">
                                                        <span class="help"></span>
                                                    </div>
                                                </div> 
                                            </div>
                                            <div class="col-md-6">
                                                <div class="position-relative row form-group">
                                                    <label class="col-sm-12 col-form-label" style="font-weight:600">*Jumlah Omset Tahun Sekarang</label>
                                                    <div class="col-lg-12">
                                                        <input type="text" name="jml_omset_sekarang" class="form-control currency-field step2" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency" placeholder="Contoh : 300.000.000">
                                                        <span class="help"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12"><i>Isi angka nol jika tidak memiki omset</i></div>
                                        </div>
                                        <div class="row" style="margin-bottom: 5px;">
                                            <div class="col-md-6">
                                                <div class="position-relative row form-group">
                                                    <label class="col-sm-12 col-form-label" style="font-weight:600">*Jumlah Asset</label>
                                                    <div class="col-lg-12">
                                                        <input type="text" name="jml_asset" class="form-control currency-field step2" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency" placeholder="Contoh : 300.000.000">
                                                        <span class="help"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="position-relative row form-group">
                                                    <label class="col-sm-12 col-form-label" style="font-weight:600">*Modal Sendiri</label>
                                                    <div class="col-lg-12">
                                                        <input type="text" name="jml_modal_awal" class="form-control currency-field step2" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency" placeholder="Contoh : 300.000.000">
                                                        <span class="help"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12"><i>Isi angka nol jika tidak memiki modal</i></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="position-relative row form-group">
                                                    <label class="col-sm-12 col-form-label" style="font-weight:600">Modal Luar</label>
                                                    <div class="col-lg-12">
                                                        <select class="form-control select2 step2" name="modal_luar">
                                                            
                                                        </select>
                                                        <span class="help"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                 <div class="position-relative row form-group">
                                                    <label class="col-sm-12 col-form-label" style="font-weight:600">Nominal Modal Luar</label>
                                                    <div class="col-lg-12">
                                                        <input type="text" name="nominal_modal_luar" class="form-control currency-field step2" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency" placeholder="Contoh : 300.000.000">
                                                        <span class="help"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="position-relative row form-group">
                                                    <label class="col-sm-12 col-form-label" style="font-weight:600">*Sarana Usaha</label>
                                                    <div class="col-lg-12">
                                                        <select name="id_sarana_usaha" class="form-control select2 step2" placeholder="Pilih Sarana Usaha">

                                                        </select>
                                                        <input type="hidden" name="sarana_usaha" class="step2">
                                                        <span class="help"></span>
                                                    </div>
                                                </div>
                                                <div class="position-relative row form-group nama_sarana_lainnya" style="display: none;">
                                                    <label class="col-sm-12 col-form-label" style="font-weight:600">Nama Sarana Usaha*</label>
                                                    <div class="col-lg-12">
                                                        <input type="text" name="nama_sarana_lainnya" class="form-control step2" placeholder="Contoh : Gerobak">
                                                        <span class="help"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="position-relative row form-group">
                                                    <label class="col-sm-12 col-form-label" style="font-weight:600">*Status Tempat Usaha</label>
                                                    <div class="col-lg-12">
                                                        <select name="id_status_tempat_usaha" class="form-control select2 step2">

                                                        </select>
                                                        <input type="hidden" name="status_tempat" class="step2">
                                                        <span class="help"></span>
                                                    </div>
                                                </div>
                                                <div class="position-relative row form-group nama_status_lainnya" style="display: none;">
                                                    <label class="col-sm-12 col-form-label" style="font-weight:600">Nama Status Usaha*</label>
                                                    <div class="col-lg-12">
                                                        <input type="text" name="nama_status_lainnya" class="form-control step2" placeholder="Contoh : Milik Sendiri">
                                                        <span class="help"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="position-relative row form-group">
                                                    <label class="col-sm-12 col-form-label" style="font-weight:600">*Bahan Bakar</label>
                                                    <div class="col-lg-12">
                                                        <select name="id_bahan_bakar" class="form-control select2 step2">

                                                        </select>
                                                        <span class="help"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="position-relative row form-group">
                                                    <label class="col-sm-12 col-form-label" style="font-weight:600">Lainnya</label>
                                                    <div class="col-lg-12">
                                                        <select name="lainnya" class="form-control select2 step2">

                                                        </select>
                                                        <span class="help"></span>
                                                    </div>
                                                </div>  
                                            </div>
                                        </div> 
                                        <hr>
                                        <div class="position-relative row form-group">
                                            <label class="col-sm-12 col-form-label" style="font-weight:600">*Dukungan Kurir</label>
                                            <div class="col-lg-12">
                                                <select name="id_kurir[]" multiple="multiple" class="form-control select2 step2" placeholder="Pilih kurir">

                                                </select>
                                                <input type="hidden" name="nama_kurir" class="step2">
                                                <span class="help"></span>
                                            </div>
                                        </div>                             
                                    </div>
                                </div>
                                <ul class="list-inline pull-right">
                                    <li><button type="button" class="btn btn-default prev-step">Kembali</button></li>
                                    <li><button type="button" class="btn btn-primary next-step">Selanjutnya</button></li>
                                </ul>
                            </div>
                            <div class="tab-pane" role="tabpanel" id="step3">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="position-relative row form-group">
                                            <label class="col-sm-12 col-form-label" style="font-weight:600">
                                                ALAMAT WORKSHOP LOKASI USAHA
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="position-relative row form-group">
                                            <div class="form-check" style="padding: 0 15px;">
                                                <input class="form-check-input step3" type="checkbox" value="1" id="defaultCheck1" name="alamat_sama">
                                                <label class="form-check-label" style="font-weight: 600;margin-left: 10px;top: -2px;position: relative;" for="defaultCheck1">
                                                    SAMA DENGAN ALAMAT TEMPAT TINGGAL
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="position-relative row form-group">
                                                    <label class="col-sm-12 col-form-label" style="font-weight:600">*Kecamatan</label>
                                                    <div class="col-lg-12">
                                                        <input type="hidden" name="id_prop" class="step3">
                                                        <input type="hidden" name="id_kota" class="step3">
                                                        <select name="id_kec" class="form-control select2 step3">

                                                        </select>
                                                        <input type="hidden" name="nama_kec" class="step3">
                                                        <span class="help"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="position-relative row form-group">
                                                    <label class="col-sm-12 col-form-label" style="font-weight:600">*Kelurahan</label>
                                                    <div class="col-lg-12">
                                                        <select name="id_kel" class="form-control select2 step3">

                                                        </select>
                                                        <input type="hidden" name="nama_kel" class="step3">
                                                        <span class="help"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="position-relative row form-group">
                                            <label class="col-sm-12 col-form-label" style="font-weight:600">Kode Pos</label>
                                            <div class="col-lg-12">
                                                <input type="text" name="kode_pos" class="form-control step3" placeholder="Contoh : 14514" onkeypress="return Angkasaja(event)">
                                                <span class="help"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="position-relative row form-group">
                                            <div class="col-sm-12">
                                                <input type="hidden" class="form-control step3" id="lat" name="lat" required="" value="">
                                                <input type="hidden" class="form-control step3" id="long" name="long" required="" value="">
                                                <div id="maps" style="width:100%;height:450px;margin: 0 auto;"></div>
                                            </div>
                                        </div>
                                        <div class="position-relative row form-group">
                                            <label class="col-sm-12 col-form-label" style="font-weight:500">Silahkan klik pada peta ke lokasi sesuai lokasi usaha anda. Alamat akan otomatis terisi.</label>
                                        </div>
                                        <div class="position-relative row form-group">
                                            <label class="col-sm-12 col-form-label" style="font-weight:600">*Alamat Usaha</label>
                                            <div class="col-lg-12">
                                                <textarea class="form-control step3" id="alamat" name="alamat" style="resize: none;" rows="5"></textarea>
                                                <span class="help"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <ul class="list-inline pull-right">
                                    <li><button type="button" class="btn btn-default prev-step">Kembali</button></li>
                                    <li><button type="button" class="btn btn-primary btn-info-full next-step">Selanjutnya</button></li>
                                </ul>
                            </div>
                            <div class="tab-pane" role="tabpanel" id="step4">
                                <div class="position-relative row form-group">
                                </div>
                                <div class="position-relative row form-group file_umkm">
                                    <label class="col-sm-3 col-form-label" style="font-weight:600">Upload Surat IUMK / NIB</label>
                                    <div class="col-lg-9">
                                        <img src="" class="surat_iumkm img-responsive">
                                        <br>
                                        <div id="upload-choose-container">
                                            <input type="file" id="upload-file" accept=".jpg, .jpeg, .png" />
                                            <button  type="button" id="choose-upload-button" class="btn btn-primary" style="width: 100%">Pilih Surat IUMK</button>
                                        </div>
                                        <div id="upload-file-final-container">
                                            <span id="file-name"></span><button type="button" class="btn btn-primary" id="upload-button">Upload</button><button type="button" class="btn btn-danger" id="cancel-button">Cancel</button>
                                        </div>
                                        <div id="upload-progress"><span id="upload-percentage"></span> % uploaded</div>
                                        <div id="error-message"></div>

                                        <input type="hidden" name="file_umkm" class="step4">
                                        <span class="help" style="width: 100%"></span>
                                        <span>Hanya file berformat jpg atau png dan maksimal file 5 Mb</span>
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

                                        <input type="hidden" name="file_npwp" class="step4">
                                        <span class="help" style="width: 100%"></span>
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

                                        <input type="hidden" name="file_ktp" class="step4">
                                        <span class="help" style="width: 100%"></span>
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

                                        <input type="hidden" name="file_foto" class="step4">
                                        <span class="help" style="width: 100%"></span>
                                        <span>Hanya file berformat jpg atau png dan maksimal file 5 Mb</span>
                                        <hr style="border-bottom:1px solid #000;margin-bottom: 30px ">
                                    </div>
                                </div>
                                <ul class="list-inline pull-right">
                                    <li><button type="button" class="btn btn-default prev-step">Kembali</button></li>
                                    <li><button type="button" class="btn btn-primary btn-info-full next-step" onclick="get_resume()">Selanjutnya</button></li>
                                </ul>
                            </div>
                            <div class="tab-pane" role="tabpanel" id="complete">
                                <div class="alert alert-warning" role="alert">
                                  <h4 class="alert-heading">Apakah data yang dikirim sudah benar?</h4>
                                  <p style="text-align: justify;">Data yang sudah disimpan tidak bisa diubah lagi, pastikan data yang dimasukkan benar.</p>
                                </div>

                                <div class="position-relative row form-group">
                                    <div class="col-md-12">
                                        <div class="section-title">
                                            <h5 class="title">DATA PRIBADI</h5>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-striped" width="100%">
                                            <tr>
                                              <th scope="row" width="30%">No KTP</th><td width="70%"><span class="preview-username"></span></td>
                                            </tr>
                                            <tr>
                                              <th scope="row">Domisili</th><td><span class="preview-domisili"></span></td>
                                            </tr>
                                            <tr>
                                              <th scope="row" width="30%">Provinsi</th><td width="70%"><span class="preview-no_prop"></span></td>
                                            </tr>
                                            <tr>
                                              <th scope="row">Kota</th><td><span class="preview-no_kota"></span></td>
                                            </tr>
                                            <tr>
                                              <th scope="row">Kecamatan</th><td><span class="preview-no_kec"></span></td>
                                            </tr>
                                            <tr>
                                              <th scope="row">Kelurahan</th><td><span class="preview-no_kel"></span></td>
                                            </tr>
                                            <tr>
                                              <th scope="row">Alamat Rumah</th><td><span class="preview-alamat_rumah"></span></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-striped" width="100%">
                                            <tr>
                                              <th scope="row" width="30%">Nama Lengkap</th><td width="70%"><span class="preview-nama"></span></td>
                                            </tr>
                                            <tr>
                                              <th scope="row">Tempat Lahir</th><td><span class="preview-tempat_lahir"></span></td>
                                            </tr>
                                            <tr>
                                              <th scope="row">Tanggal Lahir</th><td><span class="preview-tanggal_lahir"></span></td>
                                            </tr>
                                            <tr>
                                              <th scope="row">Jenis Kelamin</th><td><span class="preview-jenis_kelamin"></span></td>
                                            </tr>
                                            <tr>
                                              <th scope="row">Nama Ibu Kandung</th><td><span class="preview-nama_ibu"></span></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                        
                                <div class="position-relative row form-group">
                                    <div class="col-md-12">
                                        <div class="section-title">
                                            <h5 class="title">PROFIL UMKM</h5>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="section-title">
                                            <h6 class="title">LEGALITAS IZIN USAHA</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-md-6">
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
                                            <div class="col-md-6">
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
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-md-6">
                                                <div class="section-title">
                                                    <h6 class="title">KONTAK</h6>
                                                </div>
                                                <table class="table table-striped" width="100%">
                                                    <tr>
                                                      <th scope="row" width="30%">Telepon Rumah</th><td width="70%"><span class="preview-no_rumah"></span></td>
                                                    </tr>
                                                    <tr>
                                                      <th scope="row">Telepon Kantor</th><td><span class="preview-no_kantor"></span></td>
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
                                                <div class="section-title">
                                                    <h6 class="title">KELEMBAGAAN & INDIKATOR USAHA </h6>
                                                </div>
                                                <table class="table table-striped" width="100%">
                                                    <tr>
                                                      <th scope="row" width="30%">Karyawan Laki-Laki</th><td width="70%"><span class="preview-pegawai_laki"></span></td>
                                                    </tr>
                                                    <tr>
                                                      <th scope="row">Karyawan Perempuan</th><td><span class="preview-pegawai_perempuan"></span></td>
                                                    </tr>
                                                    <tr>
                                                      <th scope="row">Total Tenaga Kerja</th><td><span class="preview-jml_pegawai"></span></td>
                                                    </tr>
                                                    <tr>
                                                      <th scope="row">Jumlah Omset Tahun Awal / Sebelumnya</th><td><span class="preview-jml_omset_sebelumnya"></span></td>
                                                    </tr>
                                                    <tr>
                                                      <th scope="row">Jumlah Omset Tahun Sekarang</th><td><span class="preview-jml_omset_sekarang"></span></td>
                                                    </tr>
                                                    <tr>
                                                      <th scope="row">Jumlah Asset</th><td><span class="preview-jml_asset"></span></td>
                                                    </tr>
                                                    <tr>
                                                      <th scope="row">Modal Sendiri</th><td><span class="preview-jml_modal_awal"></span></td>
                                                    </tr>
                                                    <tr>
                                                      <th scope="row">Modal Luar</th><td><span class="preview-modal_luar"></span></td>
                                                    </tr>
                                                    <tr>
                                                      <th scope="row">Nominal</th><td><span class="preview-nominal_modal_luar"></span></td>
                                                    </tr>
                                                    <tr>
                                                      <th scope="row">Sarana Usaha</th><td><span class="preview-id_sarana_usaha"></span></td>
                                                    </tr>
                                                    <tr>
                                                      <th scope="row">Status Tempat Usaha</th><td><span class="preview-id_status_tempat_usaha"></span></td>
                                                    </tr>
                                                    <tr>
                                                      <th scope="row">Bahan Bakar</th><td><span class="preview-id_bahan_bakar"></span></td>
                                                    </tr>
                                                    <tr>
                                                      <th scope="row">Lainnya</th><td><span class="preview-lainnya"></span></td>
                                                    </tr>
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
                                        <div class="section-title">
                                            <h5 class="title">ALAMAT USAHA</h5>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="section-title">
                                            <h6 class="title">ALAMAT WORKSHOP LOKASI USAHA</h6>
                                        </div>
                                        <table class="table table-striped" width="100%">
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
                                        <div class="section-title">
                                            <h5 class="title">BERKAS</h5>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="position-relative row form-group">
                                            <label class="col-sm-3 col-form-label" style="font-weight:600">Surat IUMK</label>
                                            <div class="col-lg-9">
                                                <img src="" class="preview-foto_umkm img-responsive">
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
                                <ul class="list-inline pull-right">
                                    <li><button type="button" class="btn btn-default prev-step-awal">Cek Ulang</button></li>
                                    <li><button type="button" class="btn btn-primary btn-info-full" onclick="simpan_data()">Simpan Dan Proses</button></li>
                                </ul>
                            </div>

                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="modal_detail" class="modal fade" data-backdrop="false">
    <div class="modal-dialog modal-full">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body" style="min-height: 200px !important;">
                    <div class="wizard">
                        <div class="wizard-inner">
                            <div class="connecting-line"></div>
                            <ul class="nav nav-tabs" role="tablist">

                                <li role="presentation" class="active" style="width: 25% !important;">
                                    <strong style="position: relative;left: 40%;">
                                        Data Pribadi
                                    </strong>
                                    <a href="#cara1" data-toggle="tab" aria-controls="cara1" role="tab">
                                        <span class="round-tab">
                                            <i class="fa fa-user"></i>
                                        </span>
                                    </a>
                                   
                                </li>

                                <li role="presentation" style="width: 25% !important;">
                                    <strong style="position: relative;left: 40%;">
                                        Profil UMKM
                                    </strong>
                                    <a href="#cara2" data-toggle="tab" aria-controls="cara2" role="tab">
                                        <span class="round-tab">
                                            <i class="fa fa-building"></i>
                                        </span>
                                    </a>
                                </li>
                                <li role="presentation" style="width: 25% !important;">
                                    <strong style="position: relative;left: 40%;">
                                        Alamat Usaha
                                    </strong>
                                    <a href="#cara3" data-toggle="tab" aria-controls="cara3" role="tab">
                                        <span class="round-tab">
                                            <i class="fa fa-location-arrow"></i>
                                        </span>
                                    </a>
                                </li>
                                <li role="presentation" style="width: 25% !important;">
                                    <strong style="position: relative;left: 40%;">
                                        Upload Berkas
                                    </strong>
                                    <a href="#cara4" data-toggle="tab" aria-controls="cara4" role="tab">
                                        <span class="round-tab">
                                            <i class="fa fa-files-o"></i>
                                        </span>
                                    </a>
                                     
                                </li>

                            </ul>
                        </div>

                        <form role="form">
                            <div class="tab-content">
                                <div class="tab-pane active" role="tabpanel" id="cara1">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="position-relative row form-group">
                                                <label class="col-sm-12 col-form-label" style="font-weight:600">INFORMASI KTP</label>
                                            </div>
                                            <div class="position-relative row form-group">
                                                <label class="col-sm-12 col-form-label" style="font-weight:600">No KTP</label>
                                                <label class="col-sm-12 col-form-label username" style="font-weight:500"></label>
                                            </div>
                                            <div class="position-relative row form-group">
                                                <label class="col-sm-12 col-form-label" style="font-weight:600">Domisili</label>
                                                <label class="col-sm-12 col-form-label domisili" style="font-weight:500"></label>
                                            </div>
                                            <div class="position-relative row form-group">
                                                <label class="col-sm-12 col-form-label" style="font-weight:600">Provinsi</label>
                                                <label class="col-sm-12 col-form-label no_prop" style="font-weight:500"></label>
                                            </div>
                                            <div class="position-relative row form-group">
                                                <label class="col-sm-12 col-form-label" style="font-weight:600">Kota</label>
                                                <label class="col-sm-12 col-form-label no_kota" style="font-weight:500"></label>
                                            </div>
                                            <div class="position-relative row form-group">
                                                <label class="col-sm-12 col-form-label" style="font-weight:600">Kecamatan</label>
                                                <label class="col-sm-12 col-form-label no_kec" style="font-weight:500"></label>
                                            </div>
                                            <div class="position-relative row form-group">
                                                <label class="col-sm-12 col-form-label" style="font-weight:600">Kelurahan</label>
                                                <label class="col-sm-12 col-form-label no_kel" style="font-weight:500"></label>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="position-relative row form-group">
                                                        <label class="col-sm-12 col-form-label" style="font-weight:600">RW</label>
                                                        <label class="col-sm-12 col-form-label no_rw" style="font-weight:500"></label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="position-relative row form-group">
                                                        <label class="col-sm-12 col-form-label" style="font-weight:600">RT</label>
                                                        <label class="col-sm-12 col-form-label no_rt" style="font-weight:500"></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group">
                                                <label class="col-sm-12 col-form-label" style="font-weight:600">Kode Pos</label>
                                                <label class="col-sm-12 col-form-label kode_pos_rumah" style="font-weight:500"></label>
                                            </div>
                                            <div class="position-relative row form-group">
                                                <label class="col-sm-12 col-form-label" style="font-weight:600">Alamat Rumah</label>
                                                <label class="col-sm-12 col-form-label alamat_rumah" style="font-weight:500"></label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="position-relative row form-group">
                                                <label class="col-sm-12 col-form-label" style="font-weight:600">BIODATA DIRI</label>
                                            </div>
                                            <div class="position-relative row form-group">
                                                <label class="col-sm-12 col-form-label" style="font-weight:600">Nama Lengkap</label>
                                                <label class="col-sm-12 col-form-label nama" style="font-weight:500"></label>
                                            </div>
                                            <div class="position-relative row form-group">
                                                <label class="col-sm-12 col-form-label" style="font-weight:600">Tempat Lahir</label>
                                                <label class="col-sm-12 col-form-label tempat_lahir" style="font-weight:500"></label>
                                            </div>
                                            <div class="position-relative row form-group">
                                                <label class="col-sm-12 col-form-label" style="font-weight:600">Tanggal Lahir</label>
                                                <label class="col-sm-12 col-form-label tanggal_lahir" style="font-weight:500"></label>
                                            </div>
                                            <div class="position-relative row form-group">
                                                <label class="col-sm-12 col-form-label" style="font-weight:600">Jenis Kelamin</label>
                                                <label class="col-sm-12 col-form-label jenis_kelamin" style="font-weight:500"></label>
                                            </div>
                                            <div class="position-relative row form-group">
                                                <label class="col-sm-12 col-form-label" style="font-weight:600">Nama Ibu Kandung</label>
                                                <label class="col-sm-12 col-form-label nama_ibu" style="font-weight:500"></label>
                                            </div>
                                        </div> 
                                    </div>
                                    <ul class="list-inline pull-right">
                                        <li>
                                            <button type="button" class="btn btn-primary next-step">Selanjutnya</button>
                                        </li>
                                    </ul>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="cara2">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="position-relative row form-group">
                                                <label class="col-sm-12 col-form-label" style="font-weight:600">LEGALITAS IZIN USAHA</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="position-relative row form-group">
                                                <label class="col-sm-12 col-form-label" style="font-weight:600">Nama Perusahaan</label>
                                                <label class="col-sm-12 col-form-label nama_perusahaan" style="font-weight:500"></label>
                                            </div>
                                            <div class="position-relative row form-group">
                                                <label class="col-sm-12 col-form-label" style="font-weight:600">Nama Usaha</label>
                                                <label class="col-sm-12 col-form-label nama_usaha" style="font-weight:500"></label>
                                            </div>
                                            <div class="position-relative row form-group">
                                                <label class="col-sm-12 col-form-label" style="font-weight:600">Nomor NPWP</label>
                                                <label class="col-sm-12 col-form-label nomor_npwp" style="font-weight:500"></label>
                                            </div>
                                            <div class="view_jenis_usaha_detail">

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="position-relative row form-group">
                                                <label class="col-sm-12 col-form-label" style="font-weight:600">Bentuk Usaha</label>
                                                <label class="col-sm-12 col-form-label bentuk_usaha" style="font-weight:500"></label>
                                            </div>
                                            <div class="position-relative row form-group">
                                                <label class="col-sm-12 col-form-label" style="font-weight:600">Jenis Usaha</label>
                                                <label class="col-sm-12 col-form-label id_jenis_usaha" style="font-weight:500"></label>
                                            </div>
                                            <div class="position-relative row form-group">
                                                <label class="col-sm-12 col-form-label" style="font-weight:600">Kegiatan Usaha Utama</label>
                                                <label class="col-sm-12 col-form-label kegiatan_usaha_utama" style="font-weight:500"></label>
                                            </div>
                                            <div class="position-relative row form-group">
                                                <label class="col-sm-12 col-form-label" style="font-weight:600">Sektor Usaha</label>
                                                <label class="col-sm-12 col-form-label id_sektor_usaha" style="font-weight:500"></label>
                                            </div>
                                            <div class="position-relative row form-group">
                                                <label class="col-sm-12 col-form-label" style="font-weight:600">Tanggal Mulai Usaha</label>
                                                <label class="col-sm-12 col-form-label tgl_usaha" style="font-weight:500"></label>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="position-relative row form-group">
                                                        <label class="col-sm-12 col-form-label" style="font-weight:600">Nomor Rekening</label>
                                                        <label class="col-sm-12 col-form-label no_rekening" style="font-weight:500"></label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="position-relative row form-group">
                                                        <label class="col-sm-12 col-form-label" style="font-weight:600">Bank</label>
                                                        <label class="col-sm-12 col-form-label nama_bank" style="font-weight:500"></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group">
                                                <label class="col-sm-12 col-form-label" style="font-weight:600">Rekening Atas Nama</label>
                                                <label class="col-sm-12 col-form-label an_rekening" style="font-weight:500"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <hr style="margin-top:40px; margin-bottom: 40px;">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="position-relative row form-group">
                                                <label class="col-sm-12 col-form-label" style="font-weight:600">
                                                    NO TELEPON
                                                </label>
                                            </div> 
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="position-relative row form-group">
                                                        <label class="col-sm-12 col-form-label" style="font-weight:600">Telepon Rumah</label>
                                                        <label class="col-sm-12 col-form-label no_rumah" style="font-weight:500"></label>
                                                    </div>   
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="position-relative row form-group">
                                                        <label class="col-sm-12 col-form-label" style="font-weight:600">Telepon Kantor</label>
                                                        <label class="col-sm-12 col-form-label no_kantor" style="font-weight:500"></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group">
                                                <label class="col-sm-12 col-form-label" style="font-weight:600">Handphone / WA</label>
                                                <label class="col-sm-12 col-form-label no_hp" style="font-weight:500"></label>
                                            </div>
                                            <div class="position-relative row form-group">
                                                <label class="col-sm-12 col-form-label" style="font-weight:600">Email</label>
                                                <label class="col-sm-12 col-form-label email_toko" style="font-weight:500"></label>
                                            </div>
                                            <div class="view_ecommerce_detail">

                                            </div>
                                            <div class="view_medsos_detail">

                                            </div>
                                            <div class="view_ojol_detail">

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="position-relative row form-group">
                                                <label class="col-sm-12 col-form-label" style="font-weight:600">
                                                    KELEMBAGAAN & INDIKATOR USAHA
                                                </label>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="position-relative row form-group">
                                                        <label class="col-sm-12 col-form-label" style="font-weight:600">Karyawan Laki-laki</label>
                                                        <label class="col-sm-12 col-form-label pegawai_laki" style="font-weight:500"></label>
                                                    </div>   
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="position-relative row form-group">
                                                        <label class="col-sm-12 col-form-label" style="font-weight:600">Karyawan Perempuan</label>
                                                        <label class="col-sm-12 col-form-label pegawai_perempuan" style="font-weight:500"></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group">
                                                <label class="col-sm-12 col-form-label" style="font-weight:600">Total Tenaga Kerja</label>
                                                <label class="col-sm-12 col-form-label jml_pegawai" style="font-weight:500"></label>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="position-relative row form-group">
                                                        <label class="col-sm-12 col-form-label" style="font-weight:600">Jumlah Omset Tahun Awal / Sebelumnya</label>
                                                        <label class="col-sm-12 col-form-label jml_omset_sebelumnya" style="font-weight:500"></label>
                                                    </div> 
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="position-relative row form-group">
                                                        <label class="col-sm-12 col-form-label" style="font-weight:600">Jumlah Omset Tahun Sekarang</label>
                                                        <label class="col-sm-12 col-form-label jml_omset_sekarang" style="font-weight:500"></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group">
                                                <label class="col-sm-12 col-form-label" style="font-weight:600">Jumlah Asset</label>
                                                <label class="col-sm-12 col-form-label jml_asset" style="font-weight:500"></label>
                                            </div>
                                            <div class="position-relative row form-group">
                                                <label class="col-sm-12 col-form-label" style="font-weight:600">Modal Sendiri</label>
                                                <label class="col-sm-12 col-form-label jml_modal_awal" style="font-weight:500"></label>
                                            </div>
                                            <div class="position-relative row form-group">
                                                <label class="col-sm-12 col-form-label" style="font-weight:600">Modal Luar</label>
                                                <label class="col-sm-12 col-form-label modal_luar" style="font-weight:500"></label>
                                            </div>
                                            <div class="position-relative row form-group">
                                                <label class="col-sm-12 col-form-label" style="font-weight:600">Nominal</label>
                                                <label class="col-sm-12 col-form-label nominal_modal_luar" style="font-weight:500"></label>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="position-relative row form-group">
                                                        <label class="col-sm-12 col-form-label" style="font-weight:600">Sarana Usaha</label>
                                                        <label class="col-sm-12 col-form-label id_sarana_usaha" style="font-weight:500"></label>
                                                    </div>
                                                    <div class="position-relative row form-group nama_sarana_lainnya" style="display: none;">
                                                        <label class="col-sm-12 col-form-label" style="font-weight:600">Nama Sarana Usaha</label>
                                                        <label class="col-sm-12 col-form-label nama_sarana_lainnya_data" style="font-weight:500"></label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="position-relative row form-group">
                                                        <label class="col-sm-12 col-form-label" style="font-weight:600">Status Tempat Usaha</label>
                                                        <label class="col-sm-12 col-form-label id_status_tempat_usaha" style="font-weight:500"></label>
                                                    </div>
                                                    <div class="position-relative row form-group nama_status_lainnya" style="display: none;">
                                                        <label class="col-sm-12 col-form-label" style="font-weight:600">Nama Status Usaha</label>
                                                        <label class="col-sm-12 col-form-label nama_status_lainnya_data" style="font-weight:500"></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group">
                                                <label class="col-sm-12 col-form-label" style="font-weight:600">Bahan Bakar</label>
                                                <label class="col-sm-12 col-form-label id_bahan_bakar" style="font-weight:500"></label>
                                            </div>
                                            <div class="position-relative row form-group">
                                                <label class="col-sm-12 col-form-label" style="font-weight:600">Lainnya</label>
                                                <label class="col-sm-12 col-form-label lainnya" style="font-weight:500"></label>
                                            </div>
                                            <div class="position-relative row form-group">
                                                <label class="col-sm-12 col-form-label" style="font-weight:600">Dukungan Kurir</label>
                                                <label class="col-sm-12 col-form-label kurir" style="font-weight:500"></label>
                                            </div>                                        
                                        </div>
                                    </div>
                                    <ul class="list-inline pull-right">
                                        <li><button type="button" class="btn btn-default prev-step">Kembali</button></li>
                                        <li><button type="button" class="btn btn-primary next-step">Selanjutnya</button></li>
                                    </ul>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="cara3">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="position-relative row form-group">
                                                <label class="col-sm-12 col-form-label" style="font-weight:600">
                                                    ALAMAT WORKSHOP LOKASI USAHA
                                                </label>
                                            </div>
                                            <div class="position-relative row form-group">
                                                <label class="col-sm-12 col-form-label" style="font-weight:600">Kecamatan</label>
                                                <label class="col-sm-12 col-form-label id_kec" style="font-weight:500"></label>
                                            </div>
                                            <div class="position-relative row form-group">
                                                <label class="col-sm-12 col-form-label" style="font-weight:600">Kelurahan</label>
                                                <label class="col-sm-12 col-form-label id_kel" style="font-weight:500"></label>
                                            </div>
                                            <div class="position-relative row form-group">
                                                <label class="col-sm-12 col-form-label" style="font-weight:600">Kode Pos</label>
                                                <label class="col-sm-12 col-form-label kode_pos" style="font-weight:500"></label>
                                            </div>
                                            <div class="position-relative row form-group">
                                                <label class="col-sm-12 col-form-label" style="font-weight:600">Alamat Usaha</label>
                                                <label class="col-sm-12 col-form-label alamat" style="font-weight:500"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="list-inline pull-right">
                                        <li><button type="button" class="btn btn-default prev-step">Kembali</button></li>
                                        <li><button type="button" class="btn btn-primary btn-info-full next-step">Selanjutnya</button></li>
                                    </ul>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="cara4">
                                    <div class="position-relative row form-group file_umkm">
                                        <label class="col-sm-3 col-form-label" style="font-weight:600">Surat IUMK</label>
                                        <div class="col-lg-9">
                                            <img src="" class="foto_umkm img-responsive">
                                            <hr style="border-bottom:1px solid #000;margin-bottom: 30px ">
                                        </div>
                                    </div>
                                    <div class="position-relative row form-group">
                                        <label class="col-sm-3 col-form-label" style="font-weight:600">NPWP</label>
                                        <div class="col-lg-9">
                                            <img src="" class="file_npwp img-responsive">
                                            <hr style="border-bottom:1px solid #000;margin-bottom: 30px ">
                                        </div>
                                    </div>
                                    <div class="position-relative row form-group">
                                        <label class="col-sm-3 col-form-label" style="font-weight:600">KTP</label>
                                        <div class="col-lg-9">
                                            <img src="" class="file_ktp img-responsive">
                                            <hr style="border-bottom:1px solid #000;margin-bottom: 30px ">
                                        </div>
                                    </div>
                                    <div class="position-relative row form-group">
                                        <label class="col-sm-3 col-form-label" style="font-weight:600">Pas Foto</label>
                                        <div class="col-lg-9">
                                            <img src="" class="file_foto img-responsive">
                                            <hr style="border-bottom:1px solid #000;margin-bottom: 30px ">
                                        </div>
                                    </div>
                                    <ul class="list-inline pull-right">
                                        <li><button type="button" class="btn btn-default prev-step">Kembali</button></li>
                                        <li><button type="button" class="btn btn-primary btn-info-full" data-dismiss="modal">Tutup</button></li>
                                    </ul>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </form>
                    </div>
                </div>
        </div>
    </div>
</div>