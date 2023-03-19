<script type="text/javascript">
    $(document).ready(function(){
        $('.select2').select2();

        $("[name='nomor_npwp']").inputmask({"mask": "99.999.999.9-999.999"});

        $('#tgl_usaha').datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd',
            endDate: new Date()  
        });

        var page = '<?php echo $active; ?>';

        if (page === 'umkm') {
            dataTable = $('.tabel').DataTable( {
                paginationType:'full_numbers',
                processing: true,
                serverSide: true,
                filter: false,
                autoWidth:false,
                aLengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                ajax: {
                    url: '<?php echo base_url('customer/umkm/ajax_list')?>',
                    type: 'POST',
                    data: function (data) {
                        data.filter = {
                            'nama'      : $('.filter_perusahaan').val(),
                            'iumkm'    : $('.filter_status').val(),
                        };
                        data.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
                    },
                },
                language: {
                    sProcessing: 'Sedang memproses...',
                    sLengthMenu: 'Tampilkan _MENU_ entri',
                    sZeroRecords: 'Tidak ditemukan data yang sesuai',
                    sInfo: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ entri',
                    sInfoEmpty: 'Menampilkan 0 sampai 0 dari 0 entri',
                    sInfoFiltered: '(disaring dari _MAX_ entri keseluruhan)',
                    sInfoPostFix: '',
                    sSearch: 'Cari:',
                    sUrl: '',
                    oPaginate: {
                        sFirst: '<<',
                        sPrevious: '<',
                        sNext: '>',
                        sLast: '>>'
                    }
                },
                order: [0, 'desc'],
                columns: [
                {'data':'no'},
                {'data':'namausaha'},
                {'data':'nama_usaha'},
                {'data':'ratting'},
                {'data':'status'},
                {'data':'aksi','orderable':false},
                ],
            });
        }

        var btnFinish = $('<button type="button"></button>').text('Simpan dan Proses')
                                           .addClass('btn btn-primary btn-save')
                                           .on('click', function(){ simpan_data(); });

        $('#smartwizard_form').smartWizard({
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
                toolbarExtraButtons: [btnFinish] // Extra buttons to show on toolbar, array of jQuery input/buttons elements
            },
            anchorSettings: {
                anchorClickable: true, // Enable/Disable anchor navigation
                enableAllAnchors: false, // Activates all anchors clickable all times
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

        $("#smartwizard_form").on("showStep", function(e, anchorObject, stepNumber, stepDirection) {
            if($('button.sw-btn-next').hasClass('disabled')){
                get_resume();
                $('.btn-save').show(); // show the button extra only in the last page
            }else{
                $('.btn-save').hide();                
            }
            document.body.scrollTop = 0; // For Safari
            document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
        });
    });

    function table_data(){
        dataTable.ajax.reload(null,true);
    }

    $(".filter_perusahaan").keyup(function(){
        table_data();
    });

    $(".filter_status").change(function(){
        table_data();
    });

    function refresh_page(){
        location.reload();
    }

    function button_sudah(id){
        $("#loading").show();
        save_method = 'add';
        alamatSama = false;
        $('#add_tambah')[0].reset();
        $('.form-control').removeClass('is-invalid');
        $('.help-block').empty();
        $('[name="jenis"]').val('sudah');
        $('[name="memiliki_iumk"]').val(id);
        $('#maps').empty('');
        $('#defaultCheck1').attr('checked', false); 
        $('#maps').load('<?=base_url('customer/umkm/maps');?>', function(data, status){
            //$("#loading-overlay").hide();         
        });

        $('.view_jenis_usaha').html('');
        $('.view_ecommerce').html('');
        $('.view_medsos').html('');
        
        $.ajax({
            url : "<?php echo base_url('dashboard/ajax_data')?>",
            type: "POST",
            data : {
                type : 'data_pengguna',
                <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            dataType: "JSON",
            success: function(data){
                $('[name="nama"]').val(data.nama);
                $('[name="username"]').val(data.username);
                $('[name="domisili"]').val(data.domisili);
                $('[name="tempat_lahir"]').val(data.tempat_lahir);
                $('[name="tanggal_lahir"]').val(data.tanggal_lahir);
                $('[name="jenis_kelamin"]').val(data.jenis_kelamin);
                $('[name="kode_pos_rumah"]').val(data.kode_pos);
                if (data.nama_ibu) {
                    $('[name="nama_ibu"]').val(data.nama_ibu);
                    $('[name="nama_ibu"]').prop('readonly', true);
                }else{
                    $('[name="nama_ibu"]').prop('readonly', false);
                }
                
                if(data.domisili == 'Luar Kota'){
                    $('[name="alamat_sama"]').attr('disabled', true);
                }else{
                    $('[name="alamat_sama"]').attr('disabled', false);
                }

                tambah_izin_usaha(1);
                get_form_ecommerce();
                get_form_medsos();

                get_prop(data.no_prop);
                get_kab(data.no_prop,data.no_kab);
                get_kec(data.no_prop,data.no_kab,data.no_kec);
                get_kel(data.no_prop,data.no_kab,data.no_kec,data.no_kel)
                get_kode_pos(data.no_prop,data.no_kab,data.no_kec,data.no_kel);
                $('[name="no_rw"]').val(data.no_rw);
                $('[name="no_rt"]').val(data.no_rt);
                $('[name="alamat_rumah"]').val(data.alamat);

                get_jenis_usaha();
                get_bentuk_usaha(8);
                get_sektor_usaha();
                get_sarana_usaha();
                get_status_tempat();
                get_modal_luar();
                get_bahan_bakar();
                get_lainnya();
                get_m_bank();
                get_m_kurir();
                get_kec(null,null,null,'alamat_umkm');
                get_data_umkm_sidata(data.username);

                if (id === 1) {
                    $('#nama_izin_usaha_1').val('IUMK').change();
                }

                $('#smartwizard_form').smartWizard("reset");
                $('#step-1').css('width', '100%');

                $("#loading").hide();
                $('.card-index').hide();
                $('.card-form').show();
            },
            error: function (jqXHR, textStatus, errorThrown){
                $("#loading").hide();
                alert('Error get data from ajax');
            }
        });
    } //end function tambah

    function get_data_umkm_sidata(nik){
        $.ajax({
            url : "<?php echo base_url('dashboard/ajax_data/')?>",
            type: "POST",
            async:false,
            data : {
                type : 'detail_umkm_sidata',
                nik   : nik,
                <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            dataType: "json",
            success: function(data){
                if (data.status) {
                    var data = data.data;
                    $('[name="nama_usaha"]').val(data.nama_usaha);
                    $('[name="kegiatan_usaha_utama"]').val(data.jenisusaha);
                    $('[name="no_hp"]').val(data.telepon);
                    $('[name="email_toko"]').val(data.email);

                    if (data.id_kecamatan == data.id_kecamatan_workshop && data.id_kelurahan == data.id_kelurahan_workshop) {
                        $('#defaultCheck1').prop('checked', true);
                        $('[name="kode_pos"]').prop('readonly', true);
                        $('[name="id_kec"]').prop('disabled', true);
                        $('[name="id_kel"]').prop('disabled', true);
                        get_kec(36,71,data.id_kecamatan_workshop,'alamat_umkm');
                        get_kel(36,71,data.id_kecamatan_workshop,data.id_kelurahan_workshop,'alamat_umkm');
                        get_kode_pos(36,71,data.id_kecamatan_workshop,data.id_kelurahan_workshop,'kode_pos_umkm');

                        alamatSama = true;
                    }


                    $('[name="lat"]').val(data.latitude);
                    $('[name="long"]').val(data.longitude);
                    $('#maps').empty('');
                    $('#maps').load('<?=base_url('customer/umkm/maps');?>', function(data, status) 
                        {
                            //$("#loading-overlay").hide();         
                        }
                    );
                    $('[name="alamat"]').val(data.alamatworkshop);
                }
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert('Error get data from ajax');
            }
        });
    }

    function get_prop(no_prop=null){
        $.ajax({
            url : "<?php echo base_url('dashboard/ajax_data/')?>",
            type: "POST",
            async:false,
            data : {
                type : 'data_propinsi',
                id   : no_prop,
                <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            dataType: "html",
            success: function(data){
                $('[name="no_prop"]').html(DOMPurify.sanitize( data, { SAFE_FOR_JQUERY: true } ));
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert('Error get data from ajax');
            }
        });
    }

    function get_kab(no_prop=null,no_kab=null){
        $.ajax({
            url : "<?php echo base_url('dashboard/ajax_data/')?>",
            type: "POST",
            async:false,
            data : {
                type : 'data_kota',
                data_propinsi : no_prop,
                id : no_kab,
                <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            dataType: "html",
            success: function(data){
                $('[name="no_kota"]').html(DOMPurify.sanitize( data, { SAFE_FOR_JQUERY: true } ));
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert('Error get data from ajax');
            }
        });
    }

    function get_kec(no_prop=null,no_kab=null,no_kec=null,type=null){
        $.ajax({
            url : "<?php echo base_url('dashboard/ajax_data/')?>",
            type: "POST",
            async:false,
            data : {
                type : 'data_kecamatan',
                data_propinsi : no_prop,
                data_kota : no_kab,
                id : no_kec,
                <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            dataType: "html",
            success: function(data){
                if (type=='alamat_umkm') {
                    $('[name="id_kec"]').html(DOMPurify.sanitize( data, { SAFE_FOR_JQUERY: true } ));
                }else{
                    $('[name="no_kec"]').html(DOMPurify.sanitize( data, { SAFE_FOR_JQUERY: true } ));
                }
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert('Error get data from ajax');
            }
        });
    }

    function get_kel(no_prop=null,no_kab=null,no_kec=null,no_kel=null,type=null){
        $.ajax({
            url : "<?php echo base_url('dashboard/ajax_data/')?>",
            type: "POST",
            async:false,
            data : {
                type : 'data_kelurahan',
                data_propinsi : no_prop,
                data_kota : no_kab,
                data_kec : no_kec,
                id_kel : no_kel,
                <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            dataType: "html",
            success: function(data){
                if (type == 'alamat_umkm') {
                    $('[name="id_kel"]').html(DOMPurify.sanitize( data, { SAFE_FOR_JQUERY: true } ));
                    if (kodeWilayah != '') {
                        $('[name=id_kel]').val(kodeWilayah.substr(6,4)).trigger('change');
                    }
                }else{
                    $('[name="no_kel"]').html(DOMPurify.sanitize( data, { SAFE_FOR_JQUERY: true } ));
                }
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert('Error get data from ajax');
            }
        });
    }

    function get_kode_pos(no_prop=null,no_kab=null,no_kec=null,no_kel=null,type=null){
        $.ajax({
            url : "<?php echo base_url('dashboard/ajax_data/')?>",
            type: "POST",
            async:false,
            data : {
                type : 'data_kode_pos',
                no_prop: no_prop,
                no_kab : no_kab,
                no_kec : no_kec,
                no_kel : no_kel,
                <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            dataType: "json",
            success: function(data){
                if (data) {
                    if (type=='kode_pos_umkm') {
                        $('[name="kode_pos"]').val(data.kode_pos);
                    }else{
                        $('[name="kode_pos_rumah"]').val(data.kode_pos);
                        $('[name="kode_pos_rumah"]').prop('readonly', true);
                    }
                }
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert('Error get data from ajax');
            }
        });
    }

    function get_jenis_usaha(id=null){
        $.ajax({
            url : "<?php echo base_url('dashboard/ajax_data/')?>",
            type: "POST",
            data : {
                type : 'jenis_usaha',
                id : id,
                <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            dataType: "html",
            success: function(data){
                $('[name="id_jenis_usaha"]').html(DOMPurify.sanitize( data, { SAFE_FOR_JQUERY: true } ));
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert('Error get data from ajax');
            }
        });
    }

    function get_bentuk_usaha(id=null){
        $.ajax({
            url : "<?php echo base_url('dashboard/ajax_data/')?>",
            type: "POST",
            async:false,
            data : {
                type : 'bentuk_usaha',
                id : id,
                <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            dataType: "html",
            success: function(data){
                $('[name="id_bentuk_usaha"]').html(DOMPurify.sanitize( data, { SAFE_FOR_JQUERY: true } ));
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert('Error get data from ajax');
            }
        });
    }

    function get_sektor_usaha(id=null){
        var id_jenis_usaha = $('[name="id_jenis_usaha"]').val();
        $.ajax({
            url : "<?php echo base_url('dashboard/ajax_data/')?>",
            type: "POST",
            data : {
                type : 'sektor_usaha',
                id_jenis_usaha : id_jenis_usaha,
                id : id,
                <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            dataType: "html",
            success: function(data){
                $('[name="id_sektor_usaha[]"]').html(DOMPurify.sanitize( data, { SAFE_FOR_JQUERY: true } ));
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert('Error get data from ajax');
            }
        });
    }

    function get_sarana_usaha(id=null){
        $.ajax({
            url : "<?php echo base_url('dashboard/ajax_data/')?>",
            type: "POST",
            data : {
                type : 'sarana_usaha',
                id : id,
                <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            dataType: "html",
            success: function(data){
                $('[name="id_sarana_usaha"]').html(DOMPurify.sanitize( data, { SAFE_FOR_JQUERY: true } ));
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert('Error get data from ajax');
            }
        });
    }

    function get_status_tempat(id=null){
        $.ajax({
            url : "<?php echo base_url('dashboard/ajax_data/')?>",
            type: "POST",
            data : {
                type : 'status_tempat',
                id : id,
                <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            dataType: "html",
            success: function(data){
                $('[name="id_status_tempat_usaha"]').html(DOMPurify.sanitize( data, { SAFE_FOR_JQUERY: true } ));
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert('Error get data from ajax');
            }
        });
    }

    function get_modal_luar(id=null){
        $.ajax({
            url : "<?php echo base_url('dashboard/ajax_data/')?>",
            type: "POST",
            data : {
                type : 'modal_luar',
                id : id,
                <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            dataType: "html",
            success: function(data){
                $('[name="modal_luar"]').html(DOMPurify.sanitize( data, { SAFE_FOR_JQUERY: true } ));
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert('Error get data from ajax');
            }
        });
    }

    function get_bahan_bakar(id=null){
        $.ajax({
            url : "<?php echo base_url('dashboard/ajax_data/')?>",
            type: "POST",
            data : {
                type : 'bahan_bakar',
                id : id,
                <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            dataType: "html",
            success: function(data){
                $('[name="id_bahan_bakar"]').html(DOMPurify.sanitize( data, { SAFE_FOR_JQUERY: true } ));
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert('Error get data from ajax');
            }
        });
    }

    function get_lainnya(id=null){
        $.ajax({
            url : "<?php echo base_url('dashboard/ajax_data/')?>",
            type: "POST",
            data : {
                type : 'lainnya',
                id : id,
                <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            dataType: "html",
            success: function(data){
                $('[name="lainnya"]').html(DOMPurify.sanitize( data, { SAFE_FOR_JQUERY: true } ));
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert('Error get data from ajax');
            }
        });
    }

    function get_m_bank(id_bank=null){
        $.ajax({
            url : "<?php echo base_url('dashboard/ajax_data/')?>",
            type: "POST",
            data : {
                type : 'master_bank',
                id_bank : id_bank,
                <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            dataType: "html",
            success: function(data){
                $('[name="id_bank"]').html(DOMPurify.sanitize( data, { SAFE_FOR_JQUERY: true } ));
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert('Error get data from ajax');
            }
        });
    }

    function get_m_kurir(){
        $.ajax({
            url : "<?php echo base_url('transaksi/ajax_data/')?>",
            type: "POST",
            async:false,
            data : {
                type : 'data_kurir',
                <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            dataType: "html",
            success: function(data){
                $('[name="id_kurir[]"]').html(DOMPurify.sanitize( data, { SAFE_FOR_JQUERY: true } ));
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert('Error get data from ajax');
            }
        });
    }

    function load_form_nama_perusahaan(){
        var id_bentuk_usaha = $('[name="id_bentuk_usaha"]').val();
        if (id_bentuk_usaha == 8) { //jika perorangan
            $('[name="nama_perusahaan"]').val('');
            $('.f_nama_perusahaan').hide();
            $('.f_no_telp_kantor').hide();
        }else{
            $('.f_nama_perusahaan').show();
            $('.f_no_telp_kantor').show();
        }
    }

    $(".input-ojol-nothing").click(function(){ 
        if($(this).is(":checked")){
            $(".input-ojol").prop("checked", false);    
            $(".input-ojol").attr("disabled", true);
        }else{
            $(".input-ojol").attr("disabled", false);
        }
    });

    $(".nama_izin_usaha").change(function(){
        if($(this).val() == 'LAINNYA')
        {
            $('.check_lainnya').removeAttr('style');
        }else{
            $('.check_lainnya').attr('style','display:none');
        }
    });

    $("[name='id_sarana_usaha']").change(function(){
        if($(this).val() == '4')
        {
            $('.nama_sarana_lainnya').removeAttr('style');
        }else{
            $('.nama_sarana_lainnya').attr('style','display:none');
        }
    });

    $("[name='id_status_tempat_usaha']").change(function(){
        if($(this).val() == '4')
        {
            $('.nama_status_lainnya').removeAttr('style');
        }else{
            $('.nama_status_lainnya').attr('style','display:none');
        }
    });

    var count = 1;
    $('.tambah_izin_usaha').click(function (e) {
        count++;
        tambah_izin_usaha(count);
    });

    function tambah_izin_usaha(count,dt=null){
        $.ajax({
            url : '<?php echo base_url("dashboard/ajax_data"); ?>',
            type: 'post',
            async:false,
            data: {
                type : 'tambah_izin_usaha',
                count : count,
                data : dt,
                <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            dataType: "html",
            success: function (data) {
                $('.view_jenis_usaha').append(data);
            }
        });
    }

    $('#defaultCheck1').change(function() {
        if(this.checked) {
            $.ajax({
                url : "<?php echo base_url('dashboard/ajax_data/')?>",
                type: "POST",
                data : {
                    type : 'data_pengguna',
                    <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
                },
                dataType: "JSON",
                success: function(data){
                    $('[name="id_prop"]').val(data.no_prop);
                    $('[name="id_kota"]').val(data.no_kab);

                    get_kec(data.no_prop,data.no_kab,data.no_kec,'alamat_umkm');
                    get_kel(data.no_prop,data.no_kab,data.no_kec,data.no_kel,'alamat_umkm');

                    var kode_pos_rumah = $('[name="kode_pos_rumah"]').val();
                    if (kode_pos_rumah) {
                        $('[name="kode_pos"]').val(kode_pos_rumah);
                    }else if(data.kode_pos){
                        $('[name="kode_pos"]').val(data.kode_pos);
                    }else{
                        get_kode_pos(data.no_prop,data.no_kab,data.no_kec,data.no_kel,'kode_pos_umkm');
                    }

                    $('[name="kode_pos"]').prop('readonly', true);
                    $('[name="id_kec"]').prop('disabled', true);
                    $('[name="id_kel"]').prop('disabled', true);
                    alamatSama = true;
                },
                error: function (jqXHR, textStatus, errorThrown){
                    alert('Error get data from ajax');
                }
            });
        }else{
            $('[name="kode_pos"]').prop('readonly', false);
            $('[name="id_kec"]').prop('disabled', false);
            $('[name="id_kel"]').prop('disabled', false);
            get_kec(null,null,null,'alamat_umkm');
            $('[name="id_kel"]').html('');
            $('[name="id_prop"]').val('');
            $('[name="id_kota"]').val('');
            $('[name="kode_pos"]').val('');
            alamatSama = false;
        }  
    });
    
    $('.hapus_izin_usaha').click(function (e) {
        if(count != 0){
            $('.izin_usaha_'+count).remove();
            count = count - 1;    
        }
    });

    var count_ecommerce = 1;
    var jenis_ecommerce = '<?php echo json_encode(get_jenis_toko_online()); ?>';
    var arr_ecommerce = JSON.parse(jenis_ecommerce);
    function get_form_ecommerce(nama='',keterangan=''){
        count_ecommerce++;
        var html = `<div class="row ecommerce_`+count_ecommerce+`">
                        <hr>
                        <div class="col-md-6">
                            <div class="position-relative row form-group">
                                <label class="col-sm-12 col-form-label" style="font-weight:600">Toko Online</label>
                                <div class="col-lg-12">
                                    <select class="form-control nama_ecommerce`+count_ecommerce+` select2" style="width: 100%;" data-step="step-1" name="nama_ecommerce[]" id="nama_ecommerce_`+count_ecommerce+`">
                                        <option value="0">Pilih Salah Satu</option>`;

                                        $.each(arr_ecommerce, function (m, item) {
                                            if (item == nama) {
                                                var selected = 'selected';
                                            }else{
                                                var selected = '';
                                            }
                                            html += `<option value="`+item+`" `+selected+`>`+item+`</option>`;
                                        });
                                    
                            html += `</select>
                                    <input type="hidden" name="nm_ecommerce[]" id="nm_ecommerce_`+count_ecommerce+`" class="form-control" data-step="step-1">
                                    <span class="help"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative row form-group">
                                <label class="col-sm-12 col-form-label" style="font-weight:600">Link / Url</label>
                                <div class="col-lg-12">
                                    <input type="text" name="keterangan_ecommerce[]" id="keterangan_ecommerce_`+count_ecommerce+`" value="`+keterangan+`" class="form-control" data-step="step-1" placeholder="Contoh : https://www.tokopedia.com/merchandise">
                                    <span class="help"></span>
                                </div>
                            </div>
                        </div>   
                    </div>`;
        $('.view_ecommerce').append(DOMPurify.sanitize( html, { SAFE_FOR_JQUERY: true } ));
    }

    $('.hapus_ecommerce').click(function (e) {
        if(count_ecommerce != 0){
            $('.ecommerce_'+count_ecommerce).remove();
            count_ecommerce = count_ecommerce - 1;    
        }
    });

    var count_medsos = 1;
    var jenis_medsos = '<?php echo json_encode(get_jenis_medsos()); ?>';
    var arr_medsos = JSON.parse(jenis_medsos);
    function get_form_medsos(nama='',keterangan=''){
        count_medsos++;
        var html = `<div class="row medsos_`+count_medsos+`">
                        <hr>
                        <div class="col-md-6">
                            <div class="position-relative row form-group">
                                <label class="col-sm-12 col-form-label" style="font-weight:600">Sosial Media</label>
                                <div class="col-lg-12">
                                    <select class="form-control nama_medsos`+count_medsos+` select2" style="width: 100%;"  data-step="step-1" name="nama_medsos[]" id="nama_medsos_`+count_medsos+`">
                                        <option value="0">Pilih Salah Satu</option>`;

                                        $.each(arr_medsos, function (m, item) {
                                            if (item == nama) {
                                                var selected = 'selected';
                                            }else{
                                                var selected = '';
                                            }
                                            html += `<option value="`+item+`" `+selected+`>`+item+`</option>`;
                                        });
                                    
                            html += `</select>
                                    <input type="hidden" name="nm_medsos[]" id="nm_medsos_`+count_medsos+`" class="form-control" data-step="step-1">
                                    <span class="help"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative row form-group">
                                <label class="col-sm-12 col-form-label" style="font-weight:600">Link / Url</label>
                                <div class="col-lg-12">
                                    <input type="text" name="keterangan_medsos[]" id="keterangan_medsos_`+count_medsos+`" value="`+keterangan+`" class="form-control" data-step="step-1" placeholder="Contoh : https://www.instagram.com/tokokue/">
                                    <span class="help"></span>
                                </div>
                            </div>
                        </div>   
                    </div>`;
        $('.view_medsos').append(DOMPurify.sanitize( html, { SAFE_FOR_JQUERY: true } ));
    }

    $('.hapus_medsos').click(function (e) {
        if(count_medsos != 0){
            $('.medsos_'+count_medsos).remove();
            count_medsos = count_medsos - 1;    
        }
    });

    $("[name='id_kec']").change(function(){
        var id_prop = $('[name="id_prop"]').val();
        var id_kota =  $('[name="id_kota"]').val();
        var id_kec = $('[name="id_kec"]').val();
        console.log(id_kec);
        get_kel(id_prop,id_kota,id_kec,null,'alamat_umkm');
    });

    $("[name='id_kel']").change(function(){
        var id_kec = $('[name="id_kec"]').val();
        var id_kel = $('[name="id_kel"]').val();
        get_kode_pos(36,71,id_kec,id_kel,'kode_pos_umkm');
    });

    function get_selected_sektor_usaha(){
        $.ajax({
            url : "<?php echo base_url('dashboard/ajax_data/')?>",
            type: "POST",
            data : {
                id_jenis_usaha : $('[name="id_jenis_usaha"]').val(),
                type : 'sektor_usaha',
                <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            dataType: "html",
            success: function(data){
                $('[name="id_sektor_usaha[]"]').html(DOMPurify.sanitize( data, { SAFE_FOR_JQUERY: true } ));

            },
            error: function (jqXHR, textStatus, errorThrown){
                alert('Error get data from ajax');
            }
        });
    }

    function simpan_data(){
         Swal.fire({
          title: 'Konfirmasi Simpan',
          text: "Apakah Data ini Ingin Di Simpan?",
          type: 'question',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya',
          cancelButtonText: 'Tidak',
        }).then((result) => {
            if (result.value) {
                $('#loading').show();
                $('.btn-save').text('sedang menyimpan...'); //change button text
                $('.btn-save').attr('disabled',true); //set button disable
                $('.form-control').removeClass('is-invalid');
                $('.help-block').empty();

                if (alamatSama) {
                    $('[name="id_kec"]').prop('disabled', false);
                    $('[name="id_kel"]').prop('disabled', false);
                }

                var form = $('#add_tambah')[0];
                var data = new FormData(form);

                if(save_method == 'add'){
                    var url = '<?php echo base_url("customer/umkm/ajax_save"); ?>';
                }else{
                    var url = '<?php echo base_url("customer/umkm/ajax_ubah"); ?>';
                }

                $.ajax({
                    url: url,
                    type: 'post',
                    data: data,
                    processData:false,
                    contentType:false,
                    cache:false,
                    success: function (res) {
                        $('#loading').hide();
                        if (alamatSama) {
                            $('[name="id_kec"]').prop('disabled', true);
                            $('[name="id_kel"]').prop('disabled', true);
                        }

                        var obj = JSON.parse(res);
                        if(obj.status){
                            if (obj.success !== true){
                                Swal.fire({text: obj.message,title: "Gagal",type: "error"});
                            }else{
                                Swal.fire({text: obj.message,title: "Sukses",type: "success"});
                                $('.card-form').hide();
                                // refresh_page();
                                window.location.href = "<?php echo base_url('customer/umkm'); ?>";
                            }
                        }else {
                            $('.nav-link').removeClass('danger');
                            for (var i = 0; i < obj.inputerror.length; i++) {
                                var step = $('[name="'+obj.inputerror[i]+'"]').attr("data-step");
                                $('#nav_link_'+step).removeClass('done').addClass('danger');

                                $('[name="'+obj.inputerror[i]+'"]').addClass('is-invalid');
                                $('[name="'+obj.inputerror[i]+'"]').next().html(obj.error_string[i]); 
                            }

                            var step = $('[name="'+obj.inputerror[0]+'"]').attr("data-step");
                            var expld = step.split("-");
                            var idx_step = expld[1];
                            var step_err = parseInt(idx_step) - 1;
                            $('#smartwizard_form').smartWizard("goToStep", step_err);

                            Swal.fire({type: 'warning',text: 'Proses Simpan Gagal, Silahkan Melengkapi Data Yang Harus Diisi',title : 'Perhatian'});
                        }

                        $('.btn-save').text('Simpan dan Proses'); //change button text
                        $('.btn-save').attr('disabled',false); //set button enable
                    }
                });
            }else{
                return false;
            }
        })
    }

    $("[name='pegawai_laki']").keyup(function(){
        var pr =  $('[name="pegawai_perempuan"]').val();
        var lk = $('[name="pegawai_laki"]').val();
        if (lk == '') {
            lk = 0;
        }
        if (pr == '') {
            pr = 0;
        }
        var total = parseInt(lk) + parseInt(pr);
        $('[name="jml_pegawai"]').val(total); 
    });

    $("[name='pegawai_perempuan']").keyup(function(){
        var pr =  $('[name="pegawai_perempuan"]').val();
        var lk = $('[name="pegawai_laki"]').val();
        if (lk == '') {
            lk = 0;
        }
        if (pr == '') {
            pr = 0;
        }
        var total = parseInt(lk) + parseInt(pr);
        $('[name="jml_pegawai"]').val(total); 
    });

    function ubah_data(id)
    {
        $("#loading").show();
        $('.view_jenis_usaha').empty();
        $('.view_ecommerce').empty();
        $('.view_medsos').empty();
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
                save_method = 'edit';
                $('[name="id"]').val(id);
                $('form')[0].reset();
                $('.form-group').removeClass('has-error');
                $('.help').empty();
                $('[name="jenis"]').val('sudah');
                
                if (data.memiliki_surat_iumkm == 1) {
                    $('[name="memiliki_iumk"]').val(1);
                }else{
                    $('[name="memiliki_iumk"]').val(0);
                }
                
                $('#maps').empty('');
                $('#defaultCheck1').attr('checked', false); 
                $('#maps').load('<?=base_url('customer/umkm/maps');?>', function(data, status){});
                $('[name="nama"]').val(data.nama);
                
                $('[name="username"]').val(data.username);
                $('[name="domisili"]').val(data.domisili);
                $('[name="tempat_lahir"]').val(data.tempat_lahir);
                $('[name="tanggal_lahir"]').val(data.tanggal_lahir);
                $('[name="jenis_kelamin"]').val(data.jenis_kelamin);
                if (data.kode_pos) {
                    $('[name="kode_pos_rumah"]').val(data.kode_pos);
                }else{
                    get_kel(data.no_prop_pengguna,data.no_kab_pengguna,data.no_kec,data.no_kel,'kode_pos_rumah');
                }
                
                if(data.domisili == 'Luar Kota'){
                    $('[name="alamat_sama"]').attr('disabled', true);
                }else{
                    $('[name="alamat_sama"]').attr('disabled', false);
                }

                $('[name="nama_ibu"]').val(data.nama_ibu);
                $('[name="nama_usaha"]').val(data.namausaha);
                $('[name="nomor_npwp"]').val(data.npwp);

                if (data.cara_pembayaran != 'langsung') {
                    $('[name=cara_pembayaran]').val('transfer').trigger('click');
                }

                if(data.nama_izin_usaha.length > 0){
                    tambah_izin_usaha(count,data.nama_izin_usaha);
                }

                
                if(data.situs_web){
                    var arr_ecommerce = JSON.parse(data.situs_web);
                    $.each(arr_ecommerce, function(item, i) {
                        get_form_ecommerce(i.nama_ecommerce,i.keterangan_ecommerce);
                    });
                }

                if(data.sosmed){
                    var arr_medsos = JSON.parse(data.sosmed);
                    $.each(arr_medsos, function(item, i) {
                        get_form_medsos(i.nama_medsos,i.keterangan_medsos);
                    });
                }

                $('ojol').prop("checked", false); 
                if(data.ojol){
                    var arr_ojol = JSON.parse(data.ojol);
                    var count_ojol = $('.ojol').length;
                    for (var x = 1; x <= count_ojol ; x++) {
                        var nama_ojol = $('#ojol_'+x).val();
                        $.each(arr_ojol, function(item, i) {
                            if (i.nama_ojol == nama_ojol) {
                                $('#ojol_'+x).prop("checked", true); 
                            }
                        });
                    }
                }

                get_bentuk_usaha(data.id_bentuk_usaha);
                if (data.id_bentuk_usaha == 8) {
                    $('.f_nama_perusahaan').hide();
                    $('.f_no_telp_kantor').hide();
                }else{
                    $('[name="nama_perusahaan"]').val(data.nama_perusahaan);
                    $('.f_nama_perusahaan').show();
                    $('[name="no_kantor"]').val(data.no_kantor);
                    $('.f_no_telp_kantor').show();
                }
                get_jenis_usaha(data.id_jenis_usaha);
                $('[name="kegiatan_usaha_utama"]').val(data.kegiatan_usaha_utama);
                get_sektor_usaha(data.id_sektor_usaha);
                $('[name="tgl_usaha"]').val(data.tgl_usaha);
                get_m_bank(data.id_bank);
                get_m_kurir();
                var id_kurir = JSON.parse(data.id_kurir);
                $('[name="id_kurir[]"]').val(id_kurir).change();
                $('[name="no_rekening"]').val(data.no_rekening);
                $('[name="an_rekening"]').val(data.an_rekening);
                $('[name="no_rumah"]').val(data.no_rumah);
                $('[name="no_hp"]').val(data.no_hp);
                $('[name="fax"]').val(data.fax);
                $('[name="email_toko"]').val(data.email);
                $('[name="pegawai_laki"]').val(format_uang(data.pegawai_laki));
                $('[name="pegawai_perempuan"]').val(format_uang(data.pegawai_perempuan));
                $('[name="jml_pegawai"]').val(format_uang(data.jml_pegawai));
                $('[name="jml_omset_sebelumnya"]').val(format_uang(data.jml_omset_sebelumnya));
                $('[name="jml_omset_sekarang"]').val(format_uang(data.jml_omset_sekarang));
                $('[name="jml_asset"]').val(format_uang(data.jml_asset));
                $('[name="jml_modal_awal"]').val(format_uang(data.jml_modal_awal));
                get_modal_luar(data.id_modal_luar);
                $('[name="nominal_modal_luar"]').val(format_uang(data.nominal_modal_luar));
                
                get_sarana_usaha(data.id_sarana_usaha);
                if(data.id_sarana_usaha == 4)
                {
                    $('.nama_sarana_lainnya').removeAttr('style');
                    $('.nama_sarana_lainnya_data').text(text(data.nama_sarana_usaha_lainnya));
                    $('[name="nama_sarana_lainnya"]').val(text(data.nama_sarana_usaha_lainnya));
                }else{
                    $('.nama_sarana_lainnya').attr('style','display:none');
                }

                get_status_tempat(data.id_status_tempat_usaha);
                if(data.id_status_tempat_usaha == 4)
                {
                    $('.nama_status_lainnya').removeAttr('style');
                    $('.nama_status_lainnya_data').text(text(data.nama_status_tempat_lainnya));
                    $('[name="nama_status_lainnya"]').val(text(data.nama_status_tempat_lainnya));
                }else{
                    $('.nama_status_lainnya').attr('style','display:none');
                }

                get_bahan_bakar(data.id_bahan_bakar);
                get_lainnya(data.id_lainnya);
                get_prop(data.no_prop_pengguna);
                get_kab(data.no_prop_pengguna,data.no_kab_pengguna);
                get_kec(data.no_prop_pengguna,data.no_kab_pengguna,data.no_kec);
                get_kel(data.no_prop_pengguna,data.no_kab_pengguna,data.no_kec,data.no_kel);

                $('[name="no_rw"]').val(data.no_rw);
                $('[name="no_rt"]').val(data.no_rt);
                $('[name="alamat_rumah"]').val(data.alamat_pengguna);
            
                if(data.tmpt_tinggal == 1){
                    $('#defaultCheck1').prop('checked', true);
                    $('[name="kode_pos"]').prop('readonly', true);
                    $('[name="id_kec"]').prop('disabled', true);
                    $('[name="id_kel"]').prop('disabled', true);
                    alamatSama = true;
                }else{
                   $('#defaultCheck1').prop('checked', false);
                   alamatSama = false;
                }

                get_kec(36,71,data.id_kec,'alamat_umkm');
                get_kel(36,71,data.id_kec,data.id_kel,'alamat_umkm');
                if (data.kode_pos_umkm) {
                    $('[name="kode_pos"]').val(data.kode_pos_umkm);
                }else{
                    get_kode_pos(36,71,data.id_kec,data.id_kel,'kode_pos_umkm');
                }
                

                $('[name="lat"]').val(data.lat);
                $('[name="long"]').val(data.long);
                $('#maps').empty('');
                $('#maps').load('<?=base_url('customer/umkm/maps');?>', function(data, status) 
                    {
                        //$("#loading-overlay").hide();         
                    }
                );
                $('[name="alamat"]').val(data.alamat);
                var url = '<?php echo base_url('assets/media/') ?>'+data.username;
                if(data.surat_iumkm != null && data.surat_iumkm != ""){
                    $('.prev_surat_iumkm').show();
                    $('.surat_iumkm').attr('src',url+'/umkm/'+data.surat_iumkm);
                }else{
                    $('.surat_iumkm').attr('src','');
                }

                if(data.foto_npwp != null  && data.foto_npwp != ""){
                    $('.surat_npwp').attr('src',url+'/npwp/'+data.foto_npwp);    
                }else{
                    $('.surat_npwp').attr('src','');
                }

                if(data.foto_ktp != null  && data.foto_ktp != ""){
                    $('.surat_ktp').attr('src',url+'/ktp/'+data.foto_ktp);    
                }else{
                    $('.surat_ktp').attr('src','');
                }

                if(data.foto_pas != null  && data.foto_pas != ""){
                    $('.surat_foto').attr('src',url+'/foto/'+data.foto_pas);
                }else{
                    $('.surat_foto').attr('src','');
                }

                var url_logo = '<?php echo base_url('assets/logo') ?>';
                if(data.logo_umkm != null  && data.logo_umkm != ""){
                    $('.surat_logo').attr('src',url_logo+'/'+data.logo_umkm);
                }else{
                    $('.surat_logo').attr('src','');
                }

                $('[name="file_umkm"]').val(data.surat_iumkm);
                $('[name="file_npwp"]').val(data.foto_npwp);
                $('[name="file_ktp"]').val(data.foto_ktp);
                $('[name="file_foto"]').val(data.foto_pas);
                $('[name="file_logo"]').val(data.logo_umkm);

                $('#smartwizard_form').smartWizard("reset");
                $('#step-1').css('width', '100%');

                $("#loading").hide();

                $('.card-index').hide();
                $('.card-form').show();
            },
            error: function (jqXHR, textStatus, errorThrown){
                $("#loading").hide();
                alert('Error get data from ajax');
            }
        });
    }


    function get_resume(){
        $('.preview-nama_perusahaan').text($('[name="nama_perusahaan"]').val());
        $('.preview-nama_usaha').text($('[name="nama_usaha"]').val());
        $('.preview-nomor_npwp').text($('[name="nomor_npwp"]').val());

        $('.preview-bentuk_usaha').text($('[name="id_bentuk_usaha"] option:selected').text());
        $('.preview-jenis_usaha').text($('[name="id_jenis_usaha"] option:selected').text());
        $('.preview-kegiatan_usaha_utama').text($('[name="kegiatan_usaha_utama"]').val());

        //sektor usaha
        var arr_id_sektor_usaha = $('[name="id_sektor_usaha[]"]').val();
        var sektor_usaha = '';
        if (arr_id_sektor_usaha != '') {
            sektor_usaha += '<ul style="list-style-type:square">';

            $('[name="id_sektor_usaha[]"] option:selected').each(function () {
                var $this = $(this);
                var selText = $this.text();
                sektor_usaha += '<li>'+selText+'</li>';
            });
            sektor_usaha += '</ul>';
        }
        $('.preview-sektor_usaha').html(DOMPurify.sanitize( sektor_usaha, { SAFE_FOR_JQUERY: true } ));

        //izin usaha
        var izin_usaha = '<ul style="list-style-type:square">';
        for (var i = 1; i <= count; i++) {
            var nama_izin_usaha = $('#nama_izin_usaha_'+i).val();
            if (nama_izin_usaha != 0 && nama_izin_usaha != undefined) {
                var no_surat = $('#no_surat_'+i).val();
                if (nama_izin_usaha == 'LAINNYA') {
                    var nama_izin_usaha_lain = '('+ $('#nama_izin_usaha_lain_'+i).val() + ')';
                }else{
                    var nama_izin_usaha_lain = '';
                }
                
                izin_usaha += '<li> Nama Izin Usaha : '+nama_izin_usaha+' '+nama_izin_usaha_lain+' <br> NIB : '+no_surat+'</li>';
            }
        }
        izin_usaha += '</ul>';
        $('.preview_izin_usaha').html(DOMPurify.sanitize( izin_usaha, { SAFE_FOR_JQUERY: true } ));

        //ecommerce
        var html_ecommerce = '<ul style="list-style-type:square">';
        for (var i = 1; i <= count_ecommerce; i++) {
            var nama_ecommerce = $('#nama_ecommerce_'+i).val();
            if (nama_ecommerce != 0 && nama_ecommerce != undefined) {
                var keterangan_ecommerce = $('#keterangan_ecommerce_'+i).val();
                html_ecommerce += '<li> Toko Online : '+nama_ecommerce+' <br> Link / Url : '+keterangan_ecommerce+'</li>';
            }
        }
        html_ecommerce += '</ul>';
        $('.preview-ecommerce').html(DOMPurify.sanitize( html_ecommerce, { SAFE_FOR_JQUERY: true } ));

        //medsos
        var html_medsos = '<ul style="list-style-type:square">';
        for (var i = 1; i <= count_medsos; i++) {
            var nama_medsos = $('#nama_medsos_'+i).val();
            if (nama_medsos != 0 && nama_medsos != undefined) {
                var keterangan_medsos = $('#keterangan_medsos_'+i).val();
                html_medsos += '<li> Sosial Media : '+nama_medsos+' <br> Link / Url : '+keterangan_medsos+'</li>';
            }
        }
        html_medsos += '</ul>';
        $('.preview-medsos').html(DOMPurify.sanitize( html_medsos, { SAFE_FOR_JQUERY: true } ));

        //ojol
        var count_ojol = $('.ojol').length;
        var html_ojol = '<ul style="list-style-type:square">';
        for (var i = 1; i <= count_ojol ; i++) {
            if($('#ojol_'+i).prop("checked") == true){
                var nama_ojol = $('#ojol_'+i).val();
                var keterangan_ojol = '';
                html_ojol += '<li> Ojol : '+nama_ojol+' <br> Link / Url : '+keterangan_ojol+'</li>';
            }
        }
        html_ojol += '</ul>';
        $('.preview-ojol').html(DOMPurify.sanitize( html_ojol, { SAFE_FOR_JQUERY: true } ));

        $('.preview-tgl_usaha').text($('[name="tgl_usaha"]').val() != '' ? tanggal_indo($('[name="tgl_usaha"]').val()) : '');
        if ($('[name="no_rekening"]').val()) {
            var nama_bank = $('[name="id_bank"]').val() != 0 ? $('[name="id_bank"] option:selected').text() : '-';
            var an_rekening = $('[name="an_rekening"]').val() ? $('[name="an_rekening"]').val() : '-';
            var no_rek = $('[name="no_rekening"]').val()+ ',  Bank : '+nama_bank+',  Atas Nama : '+$('[name="an_rekening"]').val();
        }else{
            var no_rek = '';
        }
        $('.preview-no_rekening').text(no_rek);
        $('.preview-no_rumah').text($('[name="no_rumah"]').val());
        $('.preview-no_kantor').text($('[name="no_kantor"]').val());
        $('.preview-no_hp').text($('[name="no_hp"]').val());
        $('.preview-email_toko').text($('[name="email_toko"]').val());
        $('.preview-alamat_web').text($('[name="alamat_web"]').val());
        $('.preview-alamat_sosmed').text($('[name="alamat_sosmed"]').val());
        $('.preview-pegawai_laki').text($('[name="pegawai_laki"]').val() ? format_uang($('[name="pegawai_laki"]').val())+ " Orang" : "0 Orang");
        $('.preview-pegawai_perempuan').text($('[name="pegawai_perempuan"]').val() ? format_uang($('[name="pegawai_perempuan"]').val())+ " Orang" : "0 Orang");
        $('.preview-jml_pegawai').text($('[name="jml_pegawai"]').val() ? format_uang($('[name="jml_pegawai"]').val())+ " Orang" : "0 Orang");
        $('.preview-jml_omset_sebelumnya').text($('[name="jml_omset_sebelumnya"]').val() ? 'Rp. '+$('[name="jml_omset_sebelumnya"]').val() : 'Rp. 0');
        $('.preview-jml_omset_sekarang').text($('[name="jml_omset_sekarang"]').val() ? 'Rp. '+$('[name="jml_omset_sekarang"]').val() : 'Rp. 0');
        $('.preview-jml_asset').text($('[name="jml_asset"]').val() ? 'Rp. '+$('[name="jml_asset"]').val() : 'Rp. 0');
        $('.preview-jml_modal_awal').text($('[name="jml_modal_awal"]').val() ? 'Rp. '+$('[name="jml_modal_awal"]').val() : 'Rp. 0');
        $('.preview-modal_luar').text($('[name="modal_luar"]').val() != 0 ? $('[name="modal_luar"] option:selected').text() : '');
        $('.preview-nominal_modal_luar').text($('[name="nominal_modal_luar"]').val() ? 'Rp. '+$('[name="nominal_modal_luar"]').val() : 'Rp. 0');
        $('.preview-id_sarana_usaha').text($('[name="id_sarana_usaha"] option:selected').text());
        $('.preview-id_status_tempat_usaha').text($('[name="id_status_tempat_usaha"] option:selected').text());
        $('.preview-id_bahan_bakar').text($('[name="id_bahan_bakar"] option:selected').text());
        $('.preview-lainnya').text($('[name="lainnya"]').val() != 0 ? $('[name="lainnya"] option:selected').text() : '');
        
        //kurir
        var arr_id_kurir = $('[name="id_kurir[]"]').val();
        var kurir = '';
        if (arr_id_kurir != '') {
            kurir += '<ul style="list-style-type:square">';

            $('[name="id_kurir[]"] option:selected').each(function () {
                var $this = $(this);
                var selText = $this.text();
                kurir += '<li>'+selText+'</li>';
            });
            kurir += '</ul>';
        }
        $('.preview-kurir').html(DOMPurify.sanitize( kurir, { SAFE_FOR_JQUERY: true } ));

        $('.preview-no_prop').text($('[name="no_prop"]').val() != 0 ? $('[name="no_prop"] option:selected').text() : '');
        $('.preview-no_kota').text($('[name="no_kota"]').val() != 0 ? $('[name="no_kota"] option:selected').text() : '');
        $('.preview-no_kec').text($('[name="no_kec"]').val() != 0 ? $('[name="no_kec"] option:selected').text() : '');
        $('.preview-no_kel').text($('[name="no_kel"]').val() != 0 ? $('[name="no_kel"] option:selected').text() : '');
        var alamat_rumah = $('[name="alamat_rumah"]').val()+', RT : '+$('[name="no_rt"]').val()+', RW : '+$('[name="no_rw"]').val()+', KODE POS : '+$('[name="kode_pos_rumah"]').val();
        $('.preview-alamat_rumah').text(alamat_rumah);
        $('.preview-id_kec').text($('[name="id_kec"]').val() != 0 ? $('[name="id_kec"] option:selected').text() : '');
        $('.preview-id_kel').text($('[name="id_kel"]').val() != 0 ? $('[name="id_kel"] option:selected').text() : '');
        $('.preview-kode_pos').text($('[name="kode_pos"]').val());
        $('.preview-alamat').text($('[name="alamat"]').val());

        var username = '<?php echo $this->session->userdata('identity'); ?>';
        var url = '<?php echo base_url('assets/media/') ?>'+username;
        var file_iumkm = $('[name="file_umkm"]').val();
        if(file_iumkm != null && file_iumkm != ""){
            $('.preview-foto_umkm').html(`<div class="embed-responsive embed-responsive-16by9" style="clear:both; margin-bottom:10px;">
                    <iframe src="`+url+`/umkm/`+file_iumkm+`" class="embed-responsive-item" frameborder="0" width="100%"></iframe>
                  </div>`);
        }else{
            $('.preview-foto_umkm').html('');
        }

        var file_npwp = $('[name="file_npwp"]').val();
        if(file_npwp != null && file_npwp != ""){
            $('.preview-file_npwp').attr('src',url+'/npwp/'+file_npwp);
        }else{
            $('.preview-file_npwp').attr('src','');
        }

        var file_ktp = $('[name="file_ktp"]').val();
        if(file_ktp != null && file_ktp != ""){
            $('.preview-file_ktp').attr('src',url+'/ktp/'+file_ktp);
        }else{
            $('.preview-file_ktp').attr('src','');
        }

        var file_pas_foto = $('[name="file_foto"]').val();
        if(file_pas_foto != null && file_pas_foto != ""){
            $('.preview-file_foto').attr('src',url+'/foto/'+file_pas_foto);
        }else{
            $('.preview-file_foto').attr('src','');
        }

        var file_logo = $('[name="file_logo"]').val();
        var url_logo = '<?php echo base_url('assets/logo') ?>';
        if(file_logo != null && file_logo != ""){
            $('.preview-file_logo').attr('src',url_logo+'/'+file_logo);
        }else{
            $('.preview-file_logo').attr('src','');
        }
    }
</script>

<script>
// Show the file browse dialog
document.querySelector('#choose-upload-button').addEventListener('click', function() {
    document.querySelector('#upload-file').click();
});


// When a new file is selected
document.querySelector('#upload-file').addEventListener('change', function() {
    var file = this.files[0],
    excel_mime_types = [ 'image/jpeg','image/jpg', 'image/png','application/pdf'];
    
    document.querySelector('#error-message').style.display = 'none';
    
    // Validate MIME type
    if(excel_mime_types.indexOf(file.type) == -1) {
        document.querySelector('#error-message').style.display = 'block';
        document.querySelector('#error-message').innerText = 'Error : Only JPEG, PNG and PDF files allowed';
        return;
    }

    if (file.size > 5000000) {
        document.querySelector('#error-message').style.display = 'block';
        document.querySelector('#error-message').innerText = 'Error : The file you are attempting to upload is larger than the permitted size.';
        return;
    }

    document.querySelector('#upload-choose-container').style.display = 'none';
    document.querySelector('#upload-file-final-container').style.display = 'block';
    document.querySelector('#file-name').innerText = file.name;
});


// Cancel button event
document.querySelector('#cancel-button').addEventListener('click', function() {
    document.querySelector('#error-message').style.display = 'none';
    document.querySelector('#upload-choose-container').style.display = 'block';
    document.querySelector('#upload-file-final-container').style.display = 'none';

    document.querySelector('#upload-file').setAttribute('value', '');
});


// Upload via AJAX
document.querySelector('#upload-button').addEventListener('click', function() {
    var data = new FormData(),
    request;

    data.append('file', document.querySelector('#upload-file').files[0]);
    data.append('<?php echo $this->security->get_csrf_token_name(); ?>', '<?php echo $this->security->get_csrf_hash(); ?>');
    data.append('type', 'upload_umkm');

    var request = new XMLHttpRequest();
    request.addEventListener('load', function(e) {
        document.querySelector('#upload-progress').style.display = 'none';

        if(request.response.error == 1) {
            document.querySelector('#error-message').innerText = request.response.message;
            document.querySelector('#error-message').style.display = 'block';
        }
        else if(request.response.error == 0) {
            document.querySelector('#cancel-button').click();
            $('[name="file_umkm"]').val(request.response.file);
            $('.prev_surat_iumkm').show();
            $('.surat_iumkm').attr('src',request.response.url);
        }
    });
    request.upload.addEventListener('progress', function(e) {
        var percent_complete = (e.loaded / e.total)*100;
        
        document.querySelector('#upload-percentage').innerText = percent_complete;
        document.querySelector('#upload-progress').style.display = 'block';
    });
    request.responseType = 'json';
    request.open('post', '<?php echo base_url('customer/umkm/upload') ?>'); 
    request.send(data); 
});
</script>

<script>
// Show the file browse dialog
document.querySelector('#choose-upload-button1').addEventListener('click', function() {
    document.querySelector('#upload-file1').click();
});


// When a new file is selected
document.querySelector('#upload-file1').addEventListener('change', function() {
    var file = this.files[0],
    excel_mime_types = [ 'image/jpeg','image/jpg', 'image/png' ];
    
    document.querySelector('#error-message1').style.display = 'none';
    
    // Validate MIME type
    if(excel_mime_types.indexOf(file.type) == -1) {
        document.querySelector('#error-message1').style.display = 'block';
        document.querySelector('#error-message1').innerText = 'Error : Hanya File JPG dan PNG yang diizinkan';
        return;
    }

    if (file.size > 5000000) {
        document.querySelector('#error-message1').style.display = 'block';
        document.querySelector('#error-message1').innerText = 'Error : The file you are attempting to upload is larger than the permitted size.';
        return;
    }

    document.querySelector('#upload-choose-container1').style.display = 'none';
    document.querySelector('#upload-file-final-container1').style.display = 'block';
    document.querySelector('#file-name1').innerText = file.name;
});


// Cancel button event
document.querySelector('#cancel-button1').addEventListener('click', function() {
    document.querySelector('#error-message1').style.display = 'none';
    document.querySelector('#upload-choose-container1').style.display = 'block';
    document.querySelector('#upload-file-final-container1').style.display = 'none';

    document.querySelector('#upload-file1').setAttribute('value', '');
});


// Upload via AJAX
document.querySelector('#upload-button1').addEventListener('click', function() {
    var data = new FormData(),
    request;

    data.append('file', document.querySelector('#upload-file1').files[0]);
    data.append('<?php echo $this->security->get_csrf_token_name(); ?>', '<?php echo $this->security->get_csrf_hash(); ?>');
    data.append('type', 'upload_npwp');

    var request = new XMLHttpRequest();
    request.addEventListener('load', function(e) {
        document.querySelector('#upload-progress1').style.display = 'none';

        if(request.response.error == 1) {
            document.querySelector('#error-message1').innerText = request.response.message;
            document.querySelector('#error-message1').style.display = 'block';
        }
        else if(request.response.error == 0) {
            document.querySelector('#cancel-button1').click();
            $('[name="file_npwp"]').val(request.response.file);
            $('.surat_npwp').attr('src',request.response.url);
        }
    });
    request.upload.addEventListener('progress', function(e) {
        var percent_complete = (e.loaded / e.total)*100;
        
        document.querySelector('#upload-percentage1').innerText = percent_complete;
        document.querySelector('#upload-progress1').style.display = 'block';
    });
    request.responseType = 'json';
    request.open('post', '<?php echo base_url('customer/umkm/upload') ?>'); 
    request.send(data); 
});
</script>

<script>
// Show the file browse dialog
document.querySelector('#choose-upload-button2').addEventListener('click', function() {
    document.querySelector('#upload-file2').click();
});


// When a new file is selected
document.querySelector('#upload-file2').addEventListener('change', function() {
    var file = this.files[0],
    excel_mime_types = [ 'image/jpeg','image/jpg', 'image/png' ];
    
    document.querySelector('#error-message2').style.display = 'none';
    
    // Validate MIME type
    if(excel_mime_types.indexOf(file.type) == -1) {
        document.querySelector('#error-message2').style.display = 'block';
        document.querySelector('#error-message2').innerText = 'Error : Hanya File JPG dan PNG yang diizinkan';
        return;
    }

    if (file.size > 5000000) {
        document.querySelector('#error-message2').style.display = 'block';
        document.querySelector('#error-message2').innerText = 'Error : The file you are attempting to upload is larger than the permitted size.';
        return;
    }

    document.querySelector('#upload-choose-container2').style.display = 'none';
    document.querySelector('#upload-file-final-container2').style.display = 'block';
    document.querySelector('#file-name2').innerText = file.name;
});


// Cancel button event
document.querySelector('#cancel-button2').addEventListener('click', function() {
    document.querySelector('#error-message2').style.display = 'none';
    document.querySelector('#upload-choose-container2').style.display = 'block';
    document.querySelector('#upload-file-final-container2').style.display = 'none';

    document.querySelector('#upload-file2').setAttribute('value', '');
});


// Upload via AJAX
document.querySelector('#upload-button2').addEventListener('click', function() {
    var data = new FormData(),
    request;

    data.append('file', document.querySelector('#upload-file2').files[0]);
    data.append('<?php echo $this->security->get_csrf_token_name(); ?>', '<?php echo $this->security->get_csrf_hash(); ?>');
    data.append('type', 'upload_ktp');

    var request = new XMLHttpRequest();
    request.addEventListener('load', function(e) {
        document.querySelector('#upload-progress2').style.display = 'none';

        if(request.response.error == 1) {
            document.querySelector('#error-message2').innerText = request.response.message;
            document.querySelector('#error-message2').style.display = 'block';
        }
        else if(request.response.error == 0) {
            document.querySelector('#cancel-button2').click();
            $('[name="file_ktp"]').val(request.response.file);
            $('.surat_ktp').attr('src',request.response.url);
        }
    });
    request.upload.addEventListener('progress', function(e) {
        var percent_complete = (e.loaded / e.total)*100;
        
        document.querySelector('#upload-percentage2').innerText = percent_complete;
        document.querySelector('#upload-progress2').style.display = 'block';
    });
    request.responseType = 'json';
    request.open('post', '<?php echo base_url('customer/umkm/upload') ?>'); 
    request.send(data); 
});
</script>

<script>
// Show the file browse dialog
document.querySelector('#choose-upload-button4').addEventListener('click', function() {
    document.querySelector('#upload-file4').click();
});


// When a new file is selected
document.querySelector('#upload-file4').addEventListener('change', function() {
    var file = this.files[0],
    excel_mime_types = [ 'image/jpeg','image/jpg', 'image/png' ];
    
    document.querySelector('#error-message4').style.display = 'none';
    
    // Validate MIME type
    if(excel_mime_types.indexOf(file.type) == -1) {
        document.querySelector('#error-message4').style.display = 'block';
        document.querySelector('#error-message4').innerText = 'Error : Hanya File JPG dan PNG yang diizinkan';
        return;
    }

    if (file.size > 5000000) {
        document.querySelector('#error-message4').style.display = 'block';
        document.querySelector('#error-message4').innerText = 'Error : The file you are attempting to upload is larger than the permitted size.';
        return;
    }

    document.querySelector('#upload-choose-container4').style.display = 'none';
    document.querySelector('#upload-file-final-container4').style.display = 'block';
    document.querySelector('#file-name4').innerText = file.name;
});


// Cancel button event
document.querySelector('#cancel-button4').addEventListener('click', function() {
    document.querySelector('#error-message4').style.display = 'none';
    document.querySelector('#upload-choose-container4').style.display = 'block';
    document.querySelector('#upload-file-final-container4').style.display = 'none';

    document.querySelector('#upload-file4').setAttribute('value', '');
});


// Upload via AJAX
document.querySelector('#upload-button4').addEventListener('click', function() {
    var data = new FormData(),
    request;

    data.append('file', document.querySelector('#upload-file4').files[0]);
    data.append('<?php echo $this->security->get_csrf_token_name(); ?>', '<?php echo $this->security->get_csrf_hash(); ?>');
    data.append('type', 'upload_foto');

    var request = new XMLHttpRequest();
    request.addEventListener('load', function(e) {
        document.querySelector('#upload-progress4').style.display = 'none';

        if(request.response.error == 1) {
            document.querySelector('#error-message4').innerText = request.response.message;
            document.querySelector('#error-message4').style.display = 'block';
        }
        else if(request.response.error == 0) {
            document.querySelector('#cancel-button4').click();
            $('[name="file_foto"]').val(request.response.file);
            $('.surat_foto').attr('src',request.response.url);
        }
    });
    request.upload.addEventListener('progress', function(e) {
        var percent_complete = (e.loaded / e.total)*100;
        
        document.querySelector('#upload-percentage4').innerText = percent_complete;
        document.querySelector('#upload-progress4').style.display = 'block';
    });
    request.responseType = 'json';
    request.open('post', '<?php echo base_url('customer/umkm/upload') ?>'); 
    request.send(data); 
});
</script>

<script>
// Logo
// Show the file browse dialog
document.querySelector('#choose-upload-button3').addEventListener('click', function() {
    document.querySelector('#upload-file3').click();
});


// When a new file is selected
document.querySelector('#upload-file3').addEventListener('change', function() {
    var file = this.files[0],
    excel_mime_types = [ 'image/jpeg','image/jpg', 'image/png' ];
    
    document.querySelector('#error-message3').style.display = 'none';
    
    // Validate MIME type
    if(excel_mime_types.indexOf(file.type) == -1) {
        document.querySelector('#error-message3').style.display = 'block';
        document.querySelector('#error-message3').innerText = 'Error : Hanya File JPG dan PNG yang diizinkan';
        return;
    }

    if (file.size > 3000000) {
        document.querySelector('#error-message3').style.display = 'block';
        document.querySelector('#error-message3').innerText = 'Error : The file you are attempting to upload is larger than the permitted size.';
        return;
    }

    document.querySelector('#upload-choose-container3').style.display = 'none';
    document.querySelector('#upload-file-final-container3').style.display = 'block';
    document.querySelector('#file-name3').innerText = file.name;
});


// Cancel button event
document.querySelector('#cancel-button3').addEventListener('click', function() {
    document.querySelector('#error-message3').style.display = 'none';
    document.querySelector('#upload-choose-container3').style.display = 'block';
    document.querySelector('#upload-file-final-container3').style.display = 'none';

    document.querySelector('#upload-file3').setAttribute('value', '');
});


// Upload via AJAX
document.querySelector('#upload-button3').addEventListener('click', function() {
    var data = new FormData(),
    request;

    data.append('file', document.querySelector('#upload-file3').files[0]);
    data.append('<?php echo $this->security->get_csrf_token_name(); ?>', '<?php echo $this->security->get_csrf_hash(); ?>');
     data.append('type', 'upload_logo');

    var request = new XMLHttpRequest();
    request.addEventListener('load', function(e) {
        document.querySelector('#upload-progress3').style.display = 'none';

        if(request.response.error == 1) {
            document.querySelector('#error-message3').innerText = request.response.message;
            document.querySelector('#error-message3').style.display = 'block';
        }
        else if(request.response.error == 0) {
            document.querySelector('#cancel-button3').click();
            $('[name="file_logo"]').val(request.response.file);
            $('.surat_logo').attr('src',request.response.url);
        }
    });
    request.upload.addEventListener('progress', function(e) {
        var percent_complete = (e.loaded / e.total)*100;
        
        document.querySelector('#upload-percentage3').innerText = percent_complete;
        document.querySelector('#upload-progress3').style.display = 'block';
    });
    request.responseType = 'json';
    request.open('post', '<?php echo base_url('customer/umkm/upload') ?>'); 
    request.send(data); 
});

$('[name=jenis_pembayaran]').on('change', function () {
    if (this.value == 'pg') {
        $('#jenis_pembayaran_rb').hide();
        $('#jenis_pembayaran_pg').show();
    } else {
        $('#jenis_pembayaran_pg').hide();
        $('#jenis_pembayaran_rb').show();
    }
});

$('[name=cara_pembayaran]').on('change', function () {
    if (this.value == 'langsung') {
        $('#transfer_bank').hide();
    } else {
        $('#transfer_bank').show();
    }
});
</script>