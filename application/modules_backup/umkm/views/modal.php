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
                                <strong style="position: relative;left: 35%;">
                                    Data Pribadi
                                </strong>
                                <a href="#cara1" data-toggle="tab" aria-controls="cara1" role="tab">
                                    <span class="round-tab">
                                        <i class="fa fa-user"></i>
                                    </span>
                                </a>
                            </li>

                            <li role="presentation" style="width: 25% !important;">
                                <strong style="position: relative;left: 35%;">
                                    Profil UMKM
                                </strong>
                                <a href="#cara2" data-toggle="tab" aria-controls="cara2" role="tab">
                                    <span class="round-tab">
                                        <i class="fa fa-building"></i>
                                    </span>
                                </a>
                            </li>
                            <li role="presentation" style="width: 25% !important;">
                                <strong style="position: relative;left: 35%;">
                                    Alamat Usaha
                                </strong>
                                <a href="#cara3" data-toggle="tab" aria-controls="cara3" role="tab">
                                    <span class="round-tab">
                                        <i class="fa fa-location-arrow"></i>
                                    </span>
                                </a>
                            </li>
                            <li role="presentation" style="width: 25% !important;">
                                <strong style="position: relative;left: 35%;">
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
                        <input type="hidden" name="id">
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
                                        <div class="position-relative row form-group check_domisili" style="display: none;">
                                            <label class="col-sm-12 col-form-label" style="font-weight:600">Provinsi</label>
                                            <label class="col-sm-12 col-form-label prop" style="font-weight:500"></label>
                                        </div>
                                        <div class="position-relative row form-group check_domisili" style="display: none;">
                                            <label class="col-sm-12 col-form-label" style="font-weight:600">Kota / Kabupaten</label>
                                            <label class="col-sm-12 col-form-label kota" style="font-weight:500"></label>
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
                                        <div class="view_jenis_usaha">

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
                                            <label class="col-sm-12 col-form-label" style="font-weight:600">Handphone</label>
                                            <label class="col-sm-12 col-form-label no_hp" style="font-weight:500"></label>
                                        </div>
                                        <div class="position-relative row form-group">
                                            <label class="col-sm-12 col-form-label" style="font-weight:600">Fax</label>
                                            <label class="col-sm-12 col-form-label fax" style="font-weight:500"></label>
                                        </div>
                                        <div class="position-relative row form-group">
                                            <label class="col-sm-12 col-form-label" style="font-weight:600">Email</label>
                                            <label class="col-sm-12 col-form-label email_toko" style="font-weight:500"></label>
                                        </div>
                                        <div class="view_ecommerce">

                                        </div>
                                        <div class="view_medsos">

                                        </div>
                                        <div class="view_ojol">

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
                                    </div>
                                </div>
                                <ul class="list-inline pull-right">
                                    <li><button type="button" class="btn btn-default prev-step">Kembali</button></li>
                                    <li><button type="button" class="btn btn-primary next-step">Selanjutnya</button></li>
                                </ul>
                            </div>
                            <div class="tab-pane" role="tabpanel" id="cara3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="position-relative row form-group">
                                            <label class="col-sm-12 col-form-label" style="font-weight:600">
                                                ALAMAT PEMILIK USAHA (SESUAI KTP)
                                            </label>
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
                                    <label class="col-sm-3 col-form-label" style="font-weight:600">Upload Surat IUMK</label>
                                    <div class="col-lg-9">
                                        <label class="detail_foto_umkm"></label>
                                        <img src="" class="foto_umkm img-responsive">
                                        <hr style="border-bottom:1px solid #000;margin-bottom: 30px ">
                                    </div>
                                </div>
                                <div class="position-relative row form-group">
                                    <label class="col-sm-3 col-form-label" style="font-weight:600">Upload NPWP</label>
                                    <div class="col-lg-9">
                                        <img src="" class="file_npwp img-responsive">
                                        <hr style="border-bottom:1px solid #000;margin-bottom: 30px ">
                                    </div>
                                </div>
                                <div class="position-relative row form-group">
                                    <label class="col-sm-3 col-form-label" style="font-weight:600">Upload KTP</label>
                                    <div class="col-lg-9">
                                        <img src="" class="file_ktp img-responsive">
                                        <hr style="border-bottom:1px solid #000;margin-bottom: 30px ">
                                    </div>
                                </div>
                                <div class="position-relative row form-group">
                                    <label class="col-sm-3 col-form-label" style="font-weight:600">Upload Pas Foto</label>
                                    <div class="col-lg-9">
                                        <img src="" class="file_foto img-responsive">
                                        <hr style="border-bottom:1px solid #000;margin-bottom: 30px ">
                                    </div>
                                </div>
                                <ul class="list-inline pull-right">
                                    <li><button type="button" class="btn btn-default prev-step">Kembali</button></li>
                                    <li><button type="button" class="btn btn-info btn-info-full konfirmasi" onclick="konfirmasi()">Konfirmasi</button></li>
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

<div id="modal_data" class="modal fade" data-backdrop="false">
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
                                <strong style="position: relative;left: 35%;">
                                    Data Pribadi
                                </strong>
                                <a href="#cara1_" data-toggle="tab" aria-controls="cara1_" role="tab">
                                    <span class="round-tab">
                                        <i class="fa fa-user"></i>
                                    </span>
                                </a>
                            </li>

                            <li role="presentation" style="width: 25% !important;">
                                <strong style="position: relative;left: 35%;">
                                    Profil UMKM
                                </strong>
                                <a href="#cara2_" data-toggle="tab" aria-controls="cara2_" role="tab">
                                    <span class="round-tab">
                                        <i class="fa fa-building"></i>
                                    </span>
                                </a>
                            </li>
                            <li role="presentation" style="width: 25% !important;">
                                <strong style="position: relative;left: 35%;">
                                    Alamat Usaha
                                </strong>
                                <a href="#cara3_" data-toggle="tab" aria-controls="cara3_" role="tab">
                                    <span class="round-tab">
                                        <i class="fa fa-location-arrow"></i>
                                    </span>
                                </a>
                            </li>
                            <li role="presentation" style="width: 25% !important;">
                                <strong style="position: relative;left: 35%;">
                                    Upload Berkas
                                </strong>
                                <a href="#cara4_" data-toggle="tab" aria-controls="cara4_" role="tab">
                                    <span class="round-tab">
                                        <i class="fa fa-files-o"></i>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <form role="form">
                        <div class="tab-content">
                            <div class="tab-pane active" role="tabpanel" id="cara1_">
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
                                        <div class="position-relative row form-group check_domisili" style="display: none;">
                                            <label class="col-sm-12 col-form-label" style="font-weight:600">Provinsi</label>
                                            <label class="col-sm-12 col-form-label prop" style="font-weight:500"></label>
                                        </div>
                                        <div class="position-relative row form-group check_domisili" style="display: none;">
                                            <label class="col-sm-12 col-form-label" style="font-weight:600">Kota / Kabupaten</label>
                                            <label class="col-sm-12 col-form-label kota" style="font-weight:500"></label>
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
                            <div class="tab-pane" role="tabpanel" id="cara2_">
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
                                        <div class="view_jenis_usaha">

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
                                            <label class="col-sm-12 col-form-label" style="font-weight:600">Handphone</label>
                                            <label class="col-sm-12 col-form-label no_hp" style="font-weight:500"></label>
                                        </div>
                                        <div class="position-relative row form-group">
                                            <label class="col-sm-12 col-form-label" style="font-weight:600">Fax</label>
                                            <label class="col-sm-12 col-form-label fax" style="font-weight:500"></label>
                                        </div>
                                        <div class="position-relative row form-group">
                                            <label class="col-sm-12 col-form-label" style="font-weight:600">Email</label>
                                            <label class="col-sm-12 col-form-label email_toko" style="font-weight:500"></label>
                                        </div>
                                        <div class="view_ecommerce">

                                        </div>
                                        <div class="view_medsos">

                                        </div>
                                        <div class="view_ojol">

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
                                    </div>
                                </div>
                                <ul class="list-inline pull-right">
                                    <li><button type="button" class="btn btn-default prev-step">Kembali</button></li>
                                    <li><button type="button" class="btn btn-primary next-step">Selanjutnya</button></li>
                                </ul>
                            </div>
                            <div class="tab-pane" role="tabpanel" id="cara3_">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="position-relative row form-group">
                                            <label class="col-sm-12 col-form-label" style="font-weight:600">
                                                ALAMAT PEMILIK USAHA (SESUAI KTP)
                                            </label>
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
                            <div class="tab-pane" role="tabpanel" id="cara4_">
                                <div class="position-relative row form-group file_umkm">
                                    <label class="col-sm-3 col-form-label" style="font-weight:600">Surat IUMK</label>
                                    <div class="col-lg-9">
                                        <label class="detail_foto_umkm"></label>
                                        <img src="" class="foto_umkm img-responsive" style="height: ">
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
                                    <li><button type="button" class="btn btn-info btn-info-full" data-dismiss="modal">Tutup</button></li>
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

<div id="modal_tambah" class="modal fade" data-backdrop="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"></h5>
            </div>
            <form action="" id="add_tambah">
                <div class="modal-body" style="min-height: 200px !important;">
                    <input type="hidden" name="<?=$name;?>" value="<?=$hash;?>" />
                    <div class="position-relative row form-group">
                        <label class="col-sm-3 col-form-label" style="font-weight:600">Status</label>
                        <div class="col-lg-9">
                            <select name="status" class="form-control select2">
                                <option value="1">Konfirmasi Diterima</option>
                                <option value="3">Konfirmasi Ditolak</option>
                            </select>
                            <span class="help"></span>
                        </div>
                    </div>
                    <div class="position-relative row form-group alasan">
                        <label class="col-sm-3 col-form-label" style="font-weight:600">Alasan</label>
                        <div class="col-lg-9">
                            <textarea name="alasan" class="form-control" rows="5" style="resize: none;" placeholder="Tulis alasan kenapa ditolak"></textarea>
                            <input type="hidden" name="data_alasan">
                            <span class="help"></span>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" onclick="simpan_data()" id="btnSave" class="btn btn-primary">
                        Proses
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="modal_ubah" class="modal fade" data-backdrop="false">
    <div class="modal-dialog modal-full">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                <button type="button" class="close" onclick="refresh_page()"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="" id="simpan_umkm">
                <div class="modal-body" style="min-height: 200px !important;">
                    <div class="wizard">
                        <div class="wizard-inner">
                            <div class="connecting-line"></div>
                            <ul class="nav nav-tabs" role="tablist">

                                <li role="presentation" class="active">
                                    <strong style="position: relative;left: 35%;">
                                        Data Pribadi
                                    </strong>
                                    <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab">

                                        <span class="round-tab">
                                            <i class="fa fa-user">
                                                
                                            </i>
                                            
                                           
                                        </span>
                                    </a>
                                </li>

                                <li role="presentation">
                                    <strong style="position: relative;left: 35%;">
                                        Profil UMKM
                                    </strong>
                                    <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab">
                                        <span class="round-tab">
                                            <i class="fa fa-building"></i>
                                        </span>
                                    </a>
                                </li>
                                <li role="presentation">
                                    <strong style="position: relative;left: 35%;">
                                        Alamat Usaha
                                    </strong>
                                    <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab">
                                        <span class="round-tab">
                                            <i class="fa fa-location-arrow"></i>
                                        </span>
                                    </a>
                                </li>
                                <li role="presentation">
                                    <strong style="position: relative;left: 35%;">
                                        Upload Berkas
                                    </strong>
                                    <a href="#step4" data-toggle="tab" aria-controls="step3" role="tab">
                                        <span class="round-tab">
                                            <i class="fa fa-files-o"></i>
                                        </span>
                                    </a>
                                </li>
                                <li role="presentation">
                                    <strong style="position: relative;left: 35%;">
                                        Selesai
                                    </strong>
                                    <a href="#complete" data-toggle="tab" aria-controls="complete" role="tab">
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
                                        <div class="position-relative row form-group">
                                            <label class="col-sm-12 col-form-label" style="font-weight:600">*No KTP</label>
                                            <div class="col-lg-12">
                                                <input type="text" name="username" class="form-control" readonly="">
                                                <span class="help"></span>
                                            </div>
                                        </div>
                                        <div class="position-relative row form-group">
                                            <label class="col-sm-12 col-form-label" style="font-weight:600">*Domisili</label>
                                            <div class="col-lg-12">
                                                <input type="text" name="domisili" class="form-control" readonly="">
                                                <span class="help"></span>
                                            </div>
                                        </div>
                                        <div class="position-relative row form-group check_domisili" style="display: none;">
                                            <label class="col-sm-12 col-form-label" style="font-weight:600">*Provinsi</label>
                                            <div class="col-lg-12">
                                                <select name="prop" class="form-control select2">
                                                    
                                                </select>
                                                <input type="hidden" name="prop_form">
                                                <span class="help"></span>
                                            </div>
                                        </div>
                                        <div class="position-relative row form-group check_domisili" style="display: none;">
                                            <label class="col-sm-12 col-form-label" style="font-weight:600">*Kota</label>
                                            <div class="col-lg-12">
                                                <select name="kota" class="form-control select2">
                                                    
                                                </select>
                                                <input type="hidden" name="kota_form">
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
                                                <input type="text" name="nama" class="form-control" readonly="">
                                                <span class="help"></span>
                                            </div>
                                        </div>
                                        <div class="position-relative row form-group">
                                            <label class="col-sm-12 col-form-label" style="font-weight:600">*Tempat Lahir</label>
                                            <div class="col-lg-12">
                                                <input type="text" name="tempat_lahir" class="form-control" readonly="">
                                                <span class="help"></span>
                                            </div>
                                        </div>
                                        <div class="position-relative row form-group">
                                            <label class="col-sm-12 col-form-label" style="font-weight:600">*Tanggal Lahir</label>
                                            <div class="col-lg-12">
                                                <input type="text" name="tanggal_lahir" class="form-control" readonly="">
                                                <span class="help"></span>
                                            </div>
                                        </div>
                                        <div class="position-relative row form-group">
                                            <label class="col-sm-12 col-form-label" style="font-weight:600">*Jenis Kelamin</label>
                                            <div class="col-lg-12">
                                                <input type="text" name="jenis_kelamin" class="form-control" readonly="">
                                                <span class="help"></span>
                                            </div>
                                        </div>
                                        <div class="position-relative row form-group">
                                            <label class="col-sm-12 col-form-label" style="font-weight:600">*Nama Ibu Kandung</label>
                                            <div class="col-lg-12">
                                                <input type="text" name="nama_ibu" class="form-control" placeholder="Contoh : Sulistiyawati">
                                                <span class="help"></span>
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
                                        <div class="position-relative row form-group">
                                            <label class="col-sm-12 col-form-label" style="font-weight:600">Nama Perusahaan</label>
                                            <div class="col-lg-12">
                                                <input type="text" name="nama_perusahaan" class="form-control" placeholder="Contoh : PT. ABCD / CV. ABCD">
                                                <span class="help"></span>
                                            </div>
                                        </div>
                                        <div class="position-relative row form-group">
                                            <label class="col-sm-12 col-form-label" style="font-weight:600">*Nama Usaha</label>
                                            <div class="col-lg-12">
                                                <input type="text" name="nama_usaha" class="form-control" placeholder="Contoh : Warung Kita Semua">
                                                <span class="help"></span>
                                            </div>
                                        </div>
                                        <div class="position-relative row form-group">
                                            <label class="col-sm-12 col-form-label" style="font-weight:600">*Nomor NPWP</label>
                                            <div class="col-lg-12">
                                                <input type="text" name="nomor_npwp" class="form-control" placeholder="Contoh : 01.855.081.4-412.000">
                                                <span class="help"></span>
                                            </div>
                                        </div>  
                                        <div class="view_jenis_usaha">
                                            
                                        </div>
                                        <div class="position-relative row form-group">
                                            <label class="col-sm-12 col-form-label" style="font-weight:600">
                                                <button type="button" class="btn btn-danger hapus_izin_usaha" style="float: right; margin-left: 10px;">
                                                    <i class="fa fa-minus"></i> &nbsp; Hapus Nama Izin Usaha
                                                </button>
                                                <button type="button" class="btn btn-primary tambah_izin_usaha" style="float: right;">
                                                    <i class="fa fa-plus"></i> &nbsp; Tambah Nama Izin Usaha
                                                </button>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="position-relative row form-group">
                                            <label class="col-sm-12 col-form-label" style="font-weight:600">*Bentuk Usaha</label>
                                            <div class="col-lg-12">
                                                <select name="id_bentuk_usaha" class="form-control select2">

                                                </select>
                                                <input type="hidden" name="bentuk_usaha">
                                                <span class="help"></span>
                                            </div>
                                        </div>
                                        <div class="position-relative row form-group">
                                            <label class="col-sm-12 col-form-label" style="font-weight:600">*Jenis Usaha</label>
                                            <div class="col-lg-12">
                                                <select name="id_jenis_usaha" class="form-control select2">

                                                </select>
                                                <input type="hidden" name="jenis_usaha">
                                                <span class="help"></span>
                                            </div>
                                        </div>
                                        <div class="position-relative row form-group">
                                            <label class="col-sm-12 col-form-label" style="font-weight:600">*Kegiatan Usaha Utama</label>
                                            <div class="col-lg-12">
                                                <input type="text" name="kegiatan_usaha_utama" class="form-control" placeholder="Contoh : Usaha Makanan Beku">
                                                <span class="help"></span>
                                            </div>
                                        </div>
                                        <div class="position-relative row form-group">
                                            <label class="col-sm-12 col-form-label" style="font-weight:600">*Sektor Usaha</label>
                                            <div class="col-lg-12">
                                                <select name="id_sektor_usaha[]" multiple="multiple" class="form-control select2" placeholder="Pilih sektor usaha yang sedang dijalani">

                                                </select>
                                                <input type="hidden" name="sektor_usaha">
                                                <span class="help"></span>
                                            </div>
                                        </div>
                                        <div class="position-relative row form-group">
                                            <label class="col-sm-12 col-form-label" style="font-weight:600">*Tanggal Mulai Usaha</label>
                                            <div class="col-lg-12">
                                                <input type="date" name="tgl_usaha" class="form-control">
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
                                                    <label class="col-sm-12 col-form-label" style="font-weight:600">*Telepon Rumah</label>
                                                    <div class="col-lg-12">
                                                        <input type="text" name="no_rumah" class="form-control" onkeypress="return Angkasaja(event)" maxlength="20" placeholder="Contoh : 02112345678">
                                                        <span class="help"></span>
                                                    </div>
                                                </div>   
                                            </div>
                                            <div class="col-md-6">
                                                <div class="position-relative row form-group">
                                                    <label class="col-sm-12 col-form-label" style="font-weight:600">*Telepon Kantor</label>
                                                    <div class="col-lg-12">
                                                        <input type="text" name="no_kantor" class="form-control" onkeypress="return Angkasaja(event)" maxlength="20" placeholder="Contoh : 02112345678">
                                                        <span class="help"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="position-relative row form-group">
                                            <label class="col-sm-12 col-form-label" style="font-weight:600">*Handphone</label>
                                            <div class="col-lg-12">
                                                <input type="text" name="no_hp" class="form-control" onkeypress="return Angkasaja(event)" maxlength="20" placeholder="Contoh : 08381234567">
                                                <span class="help"></span>
                                            </div>
                                        </div>
                                        <div class="position-relative row form-group">
                                            <label class="col-sm-12 col-form-label" style="font-weight:600">*Fax</label>
                                            <div class="col-lg-12">
                                                <input type="text" name="fax" class="form-control" onkeypress="return Angkasaja(event)" maxlength="20" placeholder="Contoh : 0212323567 ">
                                                <span class="help"></span>
                                            </div>
                                        </div>
                                        <div class="position-relative row form-group">
                                            <label class="col-sm-12 col-form-label" style="font-weight:600">*Email</label>
                                            <div class="col-lg-12">
                                                <input type="text" name="email_toko" class="form-control" placeholder="Contoh : info@toko.com">
                                                <span class="help"></span>
                                            </div>
                                        </div>
                                        <div class="position-relative row form-group">
                                            <label class="col-sm-12 col-form-label" style="font-weight:600">Alamat Toko Online</label>
                                            <div class="col-lg-12">
                                                <input type="text" name="alamat_web" class="form-control" placeholder="Contoh : www.tokopedia.com/merchandise">
                                                <span class="help"></span>
                                            </div>
                                        </div>
                                        <div class="position-relative row form-group">
                                            <label class="col-sm-12 col-form-label" style="font-weight:600">Alamat Sosial Media</label>
                                            <div class="col-lg-12">
                                                <input type="text" name="alamat_sosmed" class="form-control" placeholder="Contoh : Instagram - @tokokue">
                                                <span class="help"></span>
                                            </div>
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
                                                    <label class="col-sm-12 col-form-label" style="font-weight:600">*Karyawan Laki-laki</label>
                                                    <div class="col-lg-12">
                                                        <input type="text" name="pegawai_laki" class="form-control" onkeypress="return Angkasaja(event)" placeholder="Contoh : 10">
                                                        <span class="help"></span>
                                                    </div>
                                                </div>   
                                            </div>
                                            <div class="col-md-6">
                                                <div class="position-relative row form-group">
                                                    <label class="col-sm-12 col-form-label" style="font-weight:600">*Karyawan Perempuan</label>
                                                    <div class="col-lg-12">
                                                        <input type="text" name="pegawai_perempuan" class="form-control" onkeypress="return Angkasaja(event)" placeholder="Contoh : 10">
                                                        <span class="help"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="position-relative row form-group">
                                            <label class="col-sm-12 col-form-label" style="font-weight:600">*Total Tenaga Kerja</label>
                                            <div class="col-lg-12">
                                                <input type="text" name="jml_pegawai" class="form-control currency-field" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency" placeholder="Contoh : 20">
                                                <span class="help"></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="position-relative row form-group">
                                                    <label class="col-sm-12 col-form-label" style="font-weight:600">*Jumlah Omset Tahun Awal / Sebelumnya</label>
                                                    <div class="col-lg-12">
                                                        <input type="text" name="jml_omset_sebelumnya" class="form-control currency-field" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency" placeholder="Contoh : 300.000.000">
                                                        <span class="help"></span>
                                                    </div>
                                                </div> 
                                            </div>
                                            <div class="col-md-6">
                                                <div class="position-relative row form-group">
                                                    <label class="col-sm-12 col-form-label" style="font-weight:600">*Jumlah Omset Tahun Sekarang</label>
                                                    <div class="col-lg-12">
                                                        <input type="text" name="jml_omset_sekarang" class="form-control currency-field" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency" placeholder="Contoh : 300.000.000">
                                                        <span class="help"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="position-relative row form-group">
                                            <label class="col-sm-12 col-form-label" style="font-weight:600">*Jumlah Asset</label>
                                            <div class="col-lg-12">
                                                <input type="text" name="jml_asset" class="form-control currency-field" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency" placeholder="Contoh : 300.000.000">
                                                <span class="help"></span>
                                            </div>
                                        </div>
                                        <div class="position-relative row form-group">
                                            <label class="col-sm-12 col-form-label" style="font-weight:600">*Modal Sendiri</label>
                                            <div class="col-lg-12">
                                                <input type="text" name="jml_modal_awal" class="form-control currency-field" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency" placeholder="Contoh : 300.000.000">
                                                <span class="help"></span>
                                            </div>
                                        </div>
                                        <div class="position-relative row form-group">
                                            <label class="col-sm-12 col-form-label" style="font-weight:600">Modal Luar</label>
                                            <div class="col-lg-12">
                                                <select class="form-control select2" name="modal_luar">
                                                    
                                                </select>
                                                <span class="help"></span>
                                            </div>
                                        </div>
                                        <div class="position-relative row form-group">
                                            <label class="col-sm-12 col-form-label" style="font-weight:600">Nominal</label>
                                            <div class="col-lg-12">
                                                <input type="text" name="nominal_modal_luar" class="form-control currency-field" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency" placeholder="Contoh : 300.000.000">
                                                <span class="help"></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="position-relative row form-group">
                                                    <label class="col-sm-12 col-form-label" style="font-weight:600">*Sarana Usaha</label>
                                                    <div class="col-lg-12">
                                                        <select name="id_sarana_usaha" class="form-control select2" placeholder="Pilih Sarana Usaha">

                                                        </select>
                                                        <input type="hidden" name="sarana_usaha">
                                                        <span class="help"></span>
                                                    </div>
                                                </div>
                                                <div class="position-relative row form-group nama_sarana_lainnya" style="display: none;">
                                                    <label class="col-sm-12 col-form-label" style="font-weight:600">Nama Sarana Usaha*</label>
                                                    <div class="col-lg-12">
                                                        <input type="text" name="nama_sarana_lainnya" class="form-control" placeholder="Contoh : Gerobak">
                                                        <span class="help"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="position-relative row form-group">
                                                    <label class="col-sm-12 col-form-label" style="font-weight:600">*Status Tempat Usaha</label>
                                                    <div class="col-lg-12">
                                                        <select name="id_status_tempat_usaha" class="form-control select2">

                                                        </select>
                                                        <input type="hidden" name="status_tempat">
                                                        <span class="help"></span>
                                                    </div>
                                                </div>
                                                <div class="position-relative row form-group nama_status_lainnya" style="display: none;">
                                                    <label class="col-sm-12 col-form-label" style="font-weight:600">Nama Status Usaha*</label>
                                                    <div class="col-lg-12">
                                                        <input type="text" name="nama_status_lainnya" class="form-control" placeholder="Contoh : Milik Sendiri">
                                                        <span class="help"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="position-relative row form-group">
                                            <label class="col-sm-12 col-form-label" style="font-weight:600">*Bahan Bakar</label>
                                            <div class="col-lg-12">
                                                <select name="id_bahan_bakar" class="form-control select2">

                                                </select>
                                                <span class="help"></span>
                                            </div>
                                        </div>
                                        <div class="position-relative row form-group">
                                            <label class="col-sm-12 col-form-label" style="font-weight:600">*Lainnya</label>
                                            <div class="col-lg-12">
                                                <select name="lainnya" class="form-control select2">

                                                </select>
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
                                    <div class="col-md-6">
                                        <div class="position-relative row form-group">
                                            <label class="col-sm-12 col-form-label" style="font-weight:600">
                                                ALAMAT PEMILIK USAHA (SESUAI KTP)
                                            </label>
                                        </div>
                                        <div class="position-relative row form-group">
                                            <label class="col-sm-12 col-form-label" style="font-weight:600">Provinsi</label>
                                            <div class="col-lg-12">
                                                <select disabled="true" class="form-control select2" name="no_prop">
                                                    
                                                </select>
                                                <span class="help"></span>
                                            </div>
                                        </div>
                                        <div class="position-relative row form-group">
                                            <label class="col-sm-12 col-form-label" style="font-weight:600">Kota</label>
                                            <div class="col-lg-12">
                                                <select disabled="true" class="form-control select2" name="no_kota">
                                                    
                                                </select>
                                                <span class="help"></span>
                                            </div>
                                        </div>
                                        <div class="position-relative row form-group">
                                            <label class="col-sm-12 col-form-label" style="font-weight:600">Kecamatan</label>
                                            <div class="col-lg-12">
                                                <select disabled="true" class="form-control select2" name="no_kec">
                                                    
                                                </select>
                                                <span class="help"></span>
                                            </div>
                                        </div>
                                        <div class="position-relative row form-group">
                                            <label class="col-sm-12 col-form-label" style="font-weight:600">Kelurahan</label>
                                            <div class="col-lg-12">
                                                <select disabled="true" class="form-control select2" name="no_kel">
                                                    
                                                </select>
                                                <span class="help"></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="position-relative row form-group">
                                                    <label class="col-sm-12 col-form-label" style="font-weight:600">RW</label>
                                                    <div class="col-lg-12">
                                                        <input readonly="" type="text" name="no_rw" class="form-control" placeholder="Contoh : 5">
                                                        <span class="help"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="position-relative row form-group">
                                                    <label class="col-sm-12 col-form-label" style="font-weight:600">RT</label>
                                                    <div class="col-lg-12">
                                                        <input readonly="" type="text" name="no_rt" class="form-control" placeholder="Contoh : 5">
                                                        <span class="help"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="position-relative row form-group">
                                            <label class="col-sm-12 col-form-label" style="font-weight:600">Kode Pos</label>
                                            <div class="col-lg-12">
                                                <input type="text" name="kode_pos_rumah" class="form-control" placeholder="Contoh : 14145">
                                                <span class="help"></span>
                                            </div>
                                        </div>
                                        <div class="position-relative row form-group">
                                            <label class="col-sm-12 col-form-label" style="font-weight:600">Alamat Rumah</label>
                                            <div class="col-lg-12">
                                                <textarea readonly="" name="alamat_rumah" class="form-control" rows="6" style="resize: none;" placeholder="Contoh : Jl. Pesanggrahan Timur 2"></textarea>
                                                <span class="help"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="position-relative row form-group">
                                            <label class="col-sm-12 col-form-label" style="font-weight:600">
                                                ALAMAT WORKSHOP LOKASI USAHA
                                            </label>
                                        </div>
                                        <div class="position-relative row form-group">
                                            <div class="form-check" style="padding: 0 15px;">
                                                <input class="form-check-input checked_alamatsama" type="checkbox" value="1" id="defaultCheck1" name="alamat_sama">
                                                <label class="form-check-label" style="font-weight: 600;margin-left: 10px;top: -2px;position: relative;" for="defaultCheck1">
                                                    SAMA DENGAN ALAMAT TEMPAT TINGGAL
                                                </label>
                                            </div>
                                        </div>
                                        <div class="position-relative row form-group">
                                            <label class="col-sm-12 col-form-label" style="font-weight:600">*Kecamatan</label>
                                            <div class="col-lg-12">
                                                <input type="hidden" name="id_prop">
                                                <input type="hidden" name="id_kota">
                                                <select name="id_kec" class="form-control select2">

                                                </select>
                                                <input type="hidden" name="nama_kec">
                                                <span class="help"></span>
                                            </div>
                                        </div>
                                        <div class="position-relative row form-group">
                                            <label class="col-sm-12 col-form-label" style="font-weight:600">*Kelurahan</label>
                                            <div class="col-lg-12">
                                                <select name="id_kel" class="form-control select2">

                                                </select>
                                                <input type="hidden" name="nama_kel">
                                                <span class="help"></span>
                                            </div>
                                        </div>
                                        <div class="position-relative row form-group">
                                            <label class="col-sm-12 col-form-label" style="font-weight:600">*Kode Pos</label>
                                            <div class="col-lg-12">
                                                <input type="text" name="kode_pos" class="form-control" placeholder="Contoh : 14514" onkeypress="return Angkasaja(event)">
                                                <span class="help"></span>
                                            </div>
                                        </div>
                                        <div class="position-relative row form-group">
                                            <div class="col-sm-12">
                                                <input type="hidden" class="form-control" id="lat" name="lat" required="" value="">
                                                <input type="hidden" class="form-control" id="long" name="long" required="" value="">
                                                <div id="maps" style="width:100%;height:450px;margin: 0 auto;"></div>
                                            </div>
                                        </div>
                                        <div class="position-relative row form-group">
                                            <label class="col-sm-12 col-form-label" style="font-weight:500">Silahkan klik pada peta ke lokasi sesuai lokasi usaha anda. Alamat akan otomatis terisi.</label>
                                        </div>
                                        <div class="position-relative row form-group">
                                            <label class="col-sm-12 col-form-label" style="font-weight:600">*Alamat Usaha</label>
                                            <div class="col-lg-12">
                                                <textarea class="form-control" id="alamat" name="alamat" style="resize: none;" rows="5"></textarea>
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
                                    <label class="col-sm-3 col-form-label" style="font-weight:600">*Upload Surat IUMK</label>
                                    <div class="col-lg-9">
                                        <img src="" class="surat_iumkm img-responsive">
                                        <br>
                                        <div id="upload-choose-container">
                                            <input type="file" id="upload-file" accept="image/jpg,image/jpeg,image/png" />
                                            <button  type="button" id="choose-upload-button" class="btn btn-primary" style="width: 100%">Pilih Surat IUMK</button>
                                        </div>
                                        <div id="upload-file-final-container">
                                            <span id="file-name"></span><button type="button" class="btn btn-primary" id="upload-button">Upload</button><button type="button" class="btn btn-danger" id="cancel-button">Cancel</button>
                                        </div>
                                        <div id="upload-progress"><span id="upload-percentage"></span> % uploaded</div>
                                        <div id="error-message"></div>

                                        <input type="hidden" name="file_umkm">
                                        <span class="help" style="width: 100%"></span>
                                        <span>Hanya file berformat jpg atau png dan maksimal file 5 Mb</span>
                                        <hr style="border-bottom:1px solid #000;margin-bottom: 30px ">
                                    </div>
                                </div>
                                <div class="position-relative row form-group">
                                    <label class="col-sm-3 col-form-label" style="font-weight:600">*Upload NPWP</label>
                                    <div class="col-lg-9">
                                        <img src="" class="surat_npwp img-responsive">
                                        <br>
                                        <div id="upload-choose-container1">
                                            <input type="file" id="upload-file1" accept="image/jpg,image/jpeg,image/png" />
                                            <button type="button" id="choose-upload-button1" class="btn btn-primary" style="width: 100%">Pilih NPWP</button>
                                        </div>
                                        <div id="upload-file-final-container1">
                                            <span id="file-name1"></span><button type="button" class="btn btn-primary" id="upload-button1">Upload</button><button type="button" class="btn btn-danger" id="cancel-button1">Cancel</button>
                                        </div>
                                        <div id="upload-progress1"><span id="upload-percentage1"></span> % uploaded</div>
                                        <div id="error-message1"></div>

                                        <input type="hidden" name="file_npwp">
                                        <span class="help" style="width: 100%"></span>
                                        <span>Hanya file berformat jpg atau png dan maksimal file 5 Mb</span>
                                        <hr style="border-bottom:1px solid #000;margin-bottom: 30px ">
                                    </div>
                                </div>
                                <div class="position-relative row form-group">
                                    <label class="col-sm-3 col-form-label" style="font-weight:600">*Upload KTP</label>
                                    <div class="col-lg-9">
                                        <img src="" class="surat_ktp img-responsive">
                                        <br>
                                        <div id="upload-choose-container2">
                                            <input type="file" id="upload-file2" accept="image/jpg,image/jpeg,image/png" />
                                            <button type="button" id="choose-upload-button2" class="btn btn-primary" style="width: 100%">Pilih KTP</button>
                                        </div>
                                        <div id="upload-file-final-container2">
                                            <span id="file-name2"></span><button type="button" class="btn btn-primary" id="upload-button2">Upload</button><button type="button" class="btn btn-danger" id="cancel-button2">Cancel</button>
                                        </div>
                                        <div id="upload-progress2"><span id="upload-percentage2"></span> % uploaded</div>
                                        <div id="error-message2"></div>

                                        <input type="hidden" name="file_ktp">
                                        <span class="help" style="width: 100%"></span>
                                        <span>Hanya file berformat jpg atau png dan maksimal file 5 Mb</span>
                                        <hr style="border-bottom:1px solid #000;margin-bottom: 30px ">
                                    </div>
                                </div>
                                <div class="position-relative row form-group">
                                    <label class="col-sm-3 col-form-label" style="font-weight:600">*Upload Pas Foto</label>
                                    <div class="col-lg-9">
                                        <img src="" class="surat_foto img-responsive">
                                        <br>
                                        <div id="upload-choose-container4">
                                            <input type="file" id="upload-file4" accept="image/jpg,image/jpeg,image/png" />
                                            <button type="button" id="choose-upload-button4" class="btn btn-primary" style="width: 100%">Pilih Pas Foto</button>
                                        </div>
                                        <div id="upload-file-final-container4">
                                            <span id="file-name4"></span><button type="button" class="btn btn-primary" id="upload-button4">Upload</button><button type="button" class="btn btn-danger" id="cancel-button4">Cancel</button>
                                        </div>
                                        <div id="upload-progress4"><span id="upload-percentage4"></span> % uploaded</div>
                                        <div id="error-message4"></div>

                                        <input type="hidden" name="file_foto">
                                        <span class="help" style="width: 100%"></span>
                                        <span>Hanya file berformat jpg atau png dan maksimal file 5 Mb</span>
                                        <hr style="border-bottom:1px solid #000;margin-bottom: 30px ">
                                    </div>
                                </div>
                                <ul class="list-inline pull-right">
                                    <li><button type="button" class="btn btn-default prev-step">Kembali</button></li>
                                    <li><button type="button" class="btn btn-primary btn-info-full next-step">Selanjutnya</button></li>
                                </ul>
                            </div>
                            <div class="tab-pane" role="tabpanel" id="complete">
                                <div class="position-relative row form-group">
                                    <label class="col-sm-12 col-form-label" style="font-weight:600">
                                        Apakah data yang dikirim sudah benar?
                                    </label>
                                    <div class="col-sm-12">
                                        <p style="text-align: justify;">Data yang sudah disimpan tidak bisa diubah lagi, pastikan data yang dimasukkan benar.</p>
                                    </div>
                                </div>
                                <ul class="list-inline pull-right">
                                    <li><button type="button" class="btn btn-default prev-step-awal">Cek Ulang</button></li>
                                    <li><!-- <button type="button" class="btn btn-primary btn-info-full" onclick="simpan_data()">Simpan Dan Proses</button> --></li>
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
<div id="modal_upload" class="modal fade" data-backdrop="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form class="form-excel" action="" id="upload_excel">
                <div class="modal-body">
                    <div class="position-relative row form-group">
                        <label class="col-sm-3 col-form-label" style="font-weight:600">Excel</label>
                        <div class="col-lg-9">
                            <input type="hidden" name="<?=$name;?>" value="<?=$hash;?>" />
                            <input type="file" name="excel" class="form-control" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                            <span class="help"></span>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                    <button type="button" onclick="upload()" id="submit" class="btn btn-primary">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>
