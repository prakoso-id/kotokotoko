<style type="text/css">
    .step-11{
        width: 100%;
    }
</style>

<div id="modal_data" class="modal fade" data-backdrop="false">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body" style="min-height: 200px !important;">

                <div id="smartwizard" class="smartwizard">
                    <ul class="nav">
                       <li>
                           <a class="nav-link" href="#step-11">
                              <i class="fas fa-user"></i>
                              <br>
                              <small>Data Pribadi</small>
                           </a>
                       </li>
                       <li>
                           <a class="nav-link" href="#step-12">
                              <i class="fas fa-building"></i>
                              <br>
                              <small>Profil UMKM</small>
                           </a>
                       </li>
                       <li>
                           <a class="nav-link" href="#step-13">
                              <i class="fas fa-location-arrow"></i>
                              <br>
                              <small>Alamat Usaha</small>
                           </a>
                       </li>
                       <li>
                           <a class="nav-link" href="#step-14">
                              <i class="fas fa-file-alt"></i>
                              <br>
                              <small>Upload Berkas</small>
                           </a>
                       </li>
                    </ul>
                 
                    <div class="tab-content">
                       <div id="step-11" class="tab-pane step-11" role="tabpanel">
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
                                </div> 
                            </div>
                       </div>
                       <div id="step-12" class="tab-pane step-12" role="tabpanel">
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
                                                                         
                                </div>
                            </div>
                       </div>
                       <div id="step-13" class="tab-pane step-13" role="tabpanel">
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
                       </div>
                       <div id="step-14" class="tab-pane step-14" role="tabpanel">
                            <div class="row">
                                <label class="col-sm-2" style="font-weight:600">Logo Toko</label>
                                <div class="col-sm-10">
                                    <img src="" class="file_logo img-fluid">
                                    <hr style="border-bottom:1px solid #000;margin-bottom: 30px ">
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-sm-2 col-form-label" style="font-weight:600">Surat IUMK</label>
                                <div class="col-sm-10">
                                    <label class="detail_foto_umkm"></label>
                                    <div class="embed-responsive embed-responsive-16by9" style="clear:both; margin-bottom:10px;">
                                        <iframe src="" class="embed-responsive-item foto_umkm" frameborder="0" width="100%"></iframe>
                                    </div>

                                    <hr style="border-bottom:1px solid #000;margin-bottom: 30px ">
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2" style="font-weight:600">NPWP</label>
                                <div class="col-sm-10">
                                    <img src="" class="file_npwp img-fluid">
                                    <hr style="border-bottom:1px solid #000;margin-bottom: 30px ">
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2" style="font-weight:600">KTP</label>
                                <div class="col-sm-10">
                                    <img src="" class="file_ktp img-fluid">
                                    <hr style="border-bottom:1px solid #000;margin-bottom: 30px ">
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2" style="font-weight:600">Pas Foto</label>
                                <div class="col-sm-10">
                                    <img src="" class="file_foto img-fluid">
                                    <hr style="border-bottom:1px solid #000;margin-bottom: 30px ">
                                </div>
                            </div>
                       </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button"  class="btn btn-icon icon-left btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Tutup</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function () {
    $('#smartwizard').smartWizard({
        selected: 0, // Initial selected step, 0 = first step
        theme: 'arrows', // theme for the wizard, related css need to include for other than default theme
        justified: true, // Nav menu justification. true/false
        backButtonSupport: true, // Enable the back button support
        autoAdjustHeight: true,
        transition: {
          animation: 'slide-h', // Effect on navigation, none/fade/slide-horizontal/slide-vertical/slide-swing
          speed: '400', // Transion animation speed
          easing:'' // Transition animation easing. Not supported without a jQuery easing plugin
        },
        loader : 'show',
        toolbarSettings: {
            toolbarPosition: 'bottom', // none, top, bottom, both
            toolbarButtonPosition: 'right', // left, right, center
            showNextButton: true, // show/hide a Next button
            showPreviousButton: true, // show/hide a Previous button
            toolbarExtraButtons: [] // Extra buttons to show on toolbar, array of jQuery input/buttons elements
        },
        anchorSettings: {
            anchorClickable: true, // Enable/Disable anchor navigation
            enableAllAnchors: true, // Activates all anchors clickable all times
            markDoneStep: true, // Add done state on navigation
            markAllPreviousStepsAsDone: true, // When a step selected by url hash, all previous steps are marked done
            removeDoneStepOnNavigateBack: true, // While navigate back done step after active step will be cleared
            enableAnchorOnDoneStep: true // Enable/Disable the done steps navigation
        },
        lang: { // Language variables for button
          next: 'Selanjutnya',
          previous: 'Kembali'
        },
        disabledSteps: [], // Array Steps disabled
        errorSteps: [], // Highlight step with errors
        hiddenSteps: [] // Hidden steps
    });

    $("#smartwizard").on("showStep", function(e, anchorObject, stepNumber, stepDirection) {
        $('#modal_data').animate({ scrollTop: 0 }, 'slow');
    });

});

function lihat_data(id){
    $('.view_jenis_usaha').empty();
    $('.view_ecommerce').empty();
    $('.view_medsos').empty();
    $('.view_ojol').empty();
    $('#loading').show();
    $.ajax({
        url : "<?php echo base_url('dashboard/ajax_data')?>",
        type: "POST",
        data : {
            id : id,
            type : 'detail_umkm',
            <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
        },
        dataType: "json",
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

            var url_logo = '<?php echo base_url('assets/logo') ?>';
            if(data.logo_umkm != null && data.logo_umkm != ""){
                $('.file_logo').attr('src',url_logo+'/'+data.logo_umkm);
            }else{
                $('.file_logo').attr('src','');
            }

            $('#smartwizard').smartWizard("reset");
            $('#step-11').css('width', '100%');

            $('#loading').hide();

            $('#modal_data').modal('show');
            $('#modal_data .modal-title').text('Detail Pendataan ');
        },
        error: function (jqXHR, textStatus, errorThrown){
            $('#loading').hide();
            alert('Error get data from ajax');
        }
    });
}
</script>