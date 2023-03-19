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

<script type="text/javascript">
$(document).ready(function () {
    //Initialize tooltips
    $('.nav-tabs > li a[title]').tooltip('show');
    
    //Wizard
    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

        var $target = $(e.target);
    
        if ($target.parent().hasClass('disabled')) {
            return false;
        }
    });

    $(".next-step").click(function (e) {
        var $active = $('.wizard .nav-tabs li.active');
        $active.next().removeClass('disabled');
        nextTab($active);
        $('.modal').scrollTop(0); //scroll modal to the top
    });
    $(".prev-step").click(function (e) {
        var $active = $('.wizard .nav-tabs li.active');
        prevTab($active);
        $('.modal').scrollTop(0); //scroll modal to the top
    });
    $(".prev-step-awal").click(function (e) {
        var active = $('.wizard .nav-tabs li.active');
        $(active).prev().prev().prev().prev().find('a[data-toggle="tab"]').click();
        $('.modal').scrollTop(0); //scroll modal to the top
    });
});

function nextTab(elem) {
    $(elem).next().find('a[data-toggle="tab"]').click();
}
function prevTab(elem) {
    $(elem).prev().find('a[data-toggle="tab"]').click();
}

function lihat_data(id){
    $('.view_jenis_usaha').empty();
    $('.view_ecommerce').empty();
    $('.view_medsos').empty();
    $('.view_ojol').empty();
    $.ajax({
        url : "<?php echo base_url('dashboard/ajax_data/')?>",
        type: "POST",
        data : {
            id : id,
            type : 'detail_umkm',
            <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
        },
        dataType: "JSON",
        success: function(data){
            $('.username').text(text(data.username));
            $('.domisili').text(text(data.domisili));
            if(data.domisili == 'Luar Kota')
            {
                $('.check_domisili').removeAttr('style');
                $('.prop').text(text(data.nama_domisili_prop));
                $('.kota').text(text(data.nama_domisili_kota));
            }else{
                $('.check_domisili').attr('style','display:none');
            }
            $('.nama').text(text(data.nama));
            $('.tempat_lahir').text(text(data.tempat_lahir));
            $('.tanggal_lahir').text(data.tanggal_lahir ? tanggal_indo(data.tanggal_lahir) : '');
            $('.jenis_kelamin').text(text(data.jenis_kelamin));
            $('.nama_ibu').text(text(data.nama_ibu));

            $('.nama_perusahaan').text(text(data.nama_perusahaan));
            $('.nama_usaha').text(text(data.namausaha));
            $('.nomor_npwp').text(data.npwp);

            if(data.nama_izin_usaha.length > 0){
                data.nama_izin_usaha.forEach(function(hasil){
                    if(hasil.nama_izin_usaha == 'LAINNYA')
                    {
                        $('.view_jenis_usaha').append(`
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="position-relative row form-group"><label class="col-sm-12 col-form-label" style="font-weight:600">Nama Izin Usaha</label><label class="col-sm-12 col-form-label" style="font-weight:500">`+text(hasil.nama_izin_usaha)+`</label></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="position-relative row form-group"><label class="col-sm-12 col-form-label" style="font-weight:600">Nomor Surat IUMK</label><label class="col-sm-12 col-form-label" style="font-weight:500">`+hasil.nomor_izin_usaha+`</label></div>
                                </div>
                                <div class="col-md-12">
                                    <div class="position-relative row form-group check_lainnya"><label class="col-sm-12 col-form-label" style="font-weight:600">Lainnya</label><label class="col-sm-12 col-form-label" style="font-weight:500">`+text(hasil.nama_izin_lainnya)+`</label></div>
                                </div>
                            </div> <hr>`);
                    }else{
                        $('.view_jenis_usaha').append(`
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="position-relative row form-group"><label class="col-sm-12 col-form-label" style="font-weight:600">Nama Izin Usaha</label><label class="col-sm-12 col-form-label" style="font-weight:500">`+text(hasil.nama_izin_usaha)+`</label></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="position-relative row form-group"><label class="col-sm-12 col-form-label" style="font-weight:600">Nomor Surat IUMK</label><label class="col-sm-12 col-form-label" style="font-weight:500">`+hasil.nomor_izin_usaha+`</label></div>
                                </div>
                            </div> <hr>`);    
                    }
                });
            }

            
            if(data.situs_web){
                var arr_ecommerce = JSON.parse(data.situs_web);
                $.each(arr_ecommerce, function(item, i) {
                    $('.view_ecommerce').append(`
                        <div class="row">
                            <div class="col-md-6">
                                <div class="position-relative row form-group"><label class="col-sm-12 col-form-label" style="font-weight:600">Toko Online</label><label class="col-sm-12 col-form-label" style="font-weight:500">`+text(i.nama_ecommerce)+`</label></div>
                            </div>
                            <div class="col-md-6">
                                <div class="position-relative row form-group"><label class="col-sm-12 col-form-label" style="font-weight:600">Link / ID / Akun</label><label class="col-sm-12 col-form-label" style="font-weight:500">`+i.keterangan_ecommerce+`</label></div>
                            </div>
                        </div> <hr>`);    
                });
            }
            
            if(data.sosmed){
                var arr_medsos = JSON.parse(data.sosmed);
                $.each(arr_medsos, function(item, i) {
                    $('.view_medsos').append(`
                        <div class="row">
                            <div class="col-md-6">
                                <div class="position-relative row form-group"><label class="col-sm-12 col-form-label" style="font-weight:600">Sosial Media</label><label class="col-sm-12 col-form-label" style="font-weight:500">`+text(i.nama_medsos)+`</label></div>
                            </div>
                            <div class="col-md-6">
                                <div class="position-relative row form-group"><label class="col-sm-12 col-form-label" style="font-weight:600">Link / ID / Akun</label><label class="col-sm-12 col-form-label" style="font-weight:500">`+i.keterangan_medsos+`</label></div>
                            </div>
                        </div> <hr>`);    
                });
            }

            if(data.ojol){
                var arr_ojol = JSON.parse(data.ojol);
                $.each(arr_ojol, function(item, i) {
                    $('.view_ojol').append(`
                        <div class="row">
                            <div class="col-md-6">
                                <div class="position-relative row form-group"><label class="col-sm-12 col-form-label" style="font-weight:600">Ojol</label><label class="col-sm-12 col-form-label" style="font-weight:500">`+text(i.nama_ojol)+`</label></div>
                            </div>
                            <div class="col-md-6">
                                <div class="position-relative row form-group"><label class="col-sm-12 col-form-label" style="font-weight:600">Link / ID / Akun</label><label class="col-sm-12 col-form-label" style="font-weight:500">`+i.keterangan_ojol+`</label></div>
                            </div>
                        </div> <hr>`);    
                });
            }

            $('.bentuk_usaha').text(data.nama_bentuk_usaha);
            $('.id_jenis_usaha').text(data.nama_usaha);
            $('.kegiatan_usaha_utama').text(data.kegiatan_usaha_utama);
            $('.id_sektor_usaha').text(data.nama_sektor_usaha);
            $('.tgl_usaha').text(data.tgl_usaha ? tanggal_indo(data.tgl_usaha) : '');
            $('.no_rekening').text(data.no_rekening);
            $('.nama_bank').text(data.nama_bank);
            $('.an_rekening').text(data.an_rekening);
            $('.no_rumah').text(data.no_rumah);
            $('.no_kantor').text(data.no_kantor);
            $('.no_hp').text(data.no_hp);
            $('.fax').text(data.fax);
            $('.email_toko').text(data.email);
            $('.pegawai_laki').text(format_uang(data.pegawai_laki)+" Orang");
            $('.pegawai_perempuan').text(format_uang(data.pegawai_perempuan)+" Orang");
            $('.jml_pegawai').text(format_uang(data.jml_pegawai)+" Orang");
            $('.jml_omset_sebelumnya').text("Rp. "+format_uang(data.jml_omset_sebelumnya));
            $('.jml_omset_sekarang').text("Rp. "+format_uang(data.jml_omset_sekarang));
            $('.jml_asset').text("Rp. "+format_uang(data.jml_asset));
            $('.jml_modal_awal').text("Rp. "+format_uang(data.jml_modal_awal));
            $('.modal_luar').text(text(data.nama_modal_luar));
            $('.nominal_modal_luar').text("Rp. "+format_uang(data.nominal_modal_luar));
            $('.id_sarana_usaha').text(text(data.nama_sarana_usaha));
            if(data.id_sarana_usaha == 4)
            {
                $('.nama_sarana_lainnya').removeAttr('style');
                $('.nama_sarana_lainnya_data').text(text(data.nama_sarana_usaha_lainnya));
            }else{
                $('.nama_sarana_lainnya').attr('style','display:none');
            }

            $('.id_status_tempat_usaha').text(text(data.nama_status_tempat_usaha));
            if(data.id_status_tempat_usaha == 4)
            {
                $('.nama_status_lainnya').removeAttr('style');
                $('.nama_status_lainnya_data').text(text(data.nama_status_tempat_lainnya));
            }else{
                $('.nama_status_lainnya').attr('style','display:none');
            }

            $('.id_bahan_bakar').text(text(data.nama_bahan_bakar));
            $('.lainnya').text(data.nama_lainnya);
            $('.no_prop').text(data.nama_prop_pengguna);
            $('.no_kota').text(data.nama_kab_pengguna);
            $('.no_kec').text(data.nama_kec_pengguna);
            $('.no_kel').text(data.nama_kel_pengguna);
            $('.no_rw').text(data.no_rw);
            $('.no_rt').text(data.no_rt);
            $('.kode_pos_rumah').text(data.kode_pos_pengguna);
            $('.alamat_rumah').text(data.alamat_pengguna);
            $('.id_kec').text(data.nama_kec);
            $('.id_kel').text(data.nama_kel);
            $('.kode_pos').text(data.kode_pos);
            $('.alamat').text(data.alamat);

            var url = '<?php echo base_url('assets/media/') ?>'+data.username;
            if(data.surat_iumkm != null && data.surat_iumkm != ""){
                $('.foto_umkm').attr('src',url+'/umkm/'+data.surat_iumkm);
            }else{
                $('.foto_umkm').attr('src','');
            }

            if(data.foto_npwp != null  && data.foto_npwp != ""){
                $('.file_npwp').attr('src',url+'/npwp/'+data.foto_npwp);    
            }else{
                $('.file_npwp').attr('src','');
            }

            if(data.foto_ktp != null  && data.foto_ktp != ""){
                $('.file_ktp').attr('src',url+'/ktp/'+data.foto_ktp);    
            }else{
                $('.file_ktp').attr('src','');
            }

            if(data.foto_pas != null  && data.foto_pas != ""){
                $('.file_foto').attr('src',url+'/foto/'+data.foto_pas);
            }else{
                $('.file_foto').attr('src','');
            }

            $('#modal_data').modal('show');
            $('#modal_data .modal-title').text('Detail Pendataan UMKM');
        },
        error: function (jqXHR, textStatus, errorThrown){
            alert('Error get data from ajax');
        }
    });
}
</script>