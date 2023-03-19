<script type="text/javascript">
    $(document).ready(function(){
        $('.select2').select2();

        dataTable = $('.tabel').DataTable( {
            paginationType:'full_numbers',
            processing: true,
            serverSide: true,
            filter: false,
            autoWidth:false,
            aLengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            ajax: {
                url: '<?php echo base_url('umkm/ajax_list')?>',
                type: 'POST',
                data: function (data) {
                    data.filter = {
                        'nama'      : $('.filter_perusahaan').val(),    
                        'iumkm'     : $('.filter_iumkm').val(), 
                        'group'     : $('.filter_group').val(),
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
                {'data':'nama_pemilik'},
                {'data':'nama_usaha'},
                {'data':'status'},
                {'data':'aksi','orderable':false},
            ],
        });

        $('#smartwizard_konfirmasi').smartWizard({
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
    });

	function table_data(){
		dataTable.ajax.reload(null,true);
	}

	$(".filter_iumkm").change(function(){
		table_data();
	});

    $(".filter_perusahaan").keyup(function(){
		table_data();
	});

	$(".filter_group").change(function(){
		table_data();
	});

    function upload_excel(){
        $('#upload_excel')[0].reset();
        $('.form-control').removeClass('is-invalid');
        $('.help-block').empty();
        $('#modal_upload').modal('show');
        $('#modal_upload .modal-title').text('Upload Data UMKM');
    }

    function upload(){
        Swal.fire({
          title: 'Konfirmasi',
          text: "Apakah Data ini Ingin Di Simpan?",
          type: 'question',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya',
          cancelButtonText: 'Tidak',
        }).then((result) => {
            if (result.value) {
                $('.form-group').removeClass('has-error');
                $('.input-group').removeClass('has-error');
                $('.help').empty();

                var url = '<?php echo base_url("umkm/ajax_upload"); ?>';
                var form = $('.form-excel')[0];
                var data = new FormData(form);

                $('#loading').show();
                $.ajax({
                    url: url,
                    type: 'post',
                    data: data,
                    processData:false,
                    contentType:false,
                    cache:false,
                    success: function (res) {
                        $('#loading').hide();
                        var obj = JSON.parse(res);
                        if(obj.status){
                            if (obj.success !== true) {
                                Swal.fire({text: obj.message,title: "Opps..",type: "error"});
                            }else {
                                Swal.fire({text: obj.message,title: "Sukses",type: "success"});
                                $('#modal_upload').modal('hide');
                                table_data();
                            }
                            
                        }else {
                            for (var i = 0; i < obj.inputerror.length; i++) {
                                $('[name="'+obj.inputerror[i]+'"]').parent().parent().addClass('has-error');
                                $('[name="'+obj.inputerror[i]+'"]').next().text(obj.error_string[i]); 
                            }
                            Swal.fire({type: 'warning',text: 'Data Tidak Boleh Kosong',title : 'Perhatian !'});
                        }
                    }
                });
            }else{
                return false;
            }
        })
    }

    function hapus_data(id){
        (async () => {
            const {value: text} = await Swal.fire({
                title: 'Apakah UMKM ini ingin di nonaktifkan?',
                input: 'textarea',
                inputLabel: 'Masukkan alasan',
                inputPlaceholder: 'Masukkan alasan penonaktifan...',
                inputAttributes: {
                    'aria-label': 'Masukkan alasan penonaktifan...'
                },
                showCancelButton: true,
                confirmButtonText: "Ya",
                cancelButtonText: "Tidak",
                inputValidator: (value) => {
                    if (!value) {
                      return 'Silahkan masukkan alasan terlebih dahulu !'
                    }
                }
            })
            if (text) {
                $('#loading').show();
                $.ajax({
                    url : '<?php echo site_url("umkm/ajax_tolak"); ?>',
                    type: 'post',
                    data: {
                        id: id,
                        data : text,
                        <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
                    },
                    success: function (res) {
                        $('#loading').hide();
                        var obj = JSON.parse(res);
                        if (obj.success !== true) {
                            Swal.fire({text: obj.message,title: "Opps..",type: "error"});
                        }else {
                            Swal.fire({text: obj.message,title: "Sukses",type: "success"});
                            table_data();
                        }
                    }
                });
            }
        })()
    }

    function aktif_data(id){
        Swal.fire({
          title: 'Konfirmasi',
          text: "Apakah UMKM ini Ingin Di Aktifkan?",
          type: 'question',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya',
          cancelButtonText: 'Tidak',
        }).then((result) => {
            if (result.value) {
                $('#loading').show();
                $.ajax({
                    url : '<?php echo site_url("umkm/ajax_restore"); ?>',
                    type: 'post',
                    data: {
                        id: id,
                        <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
                    },
                    success: function (res) {
                        $('#loading').hide();
                        var obj = JSON.parse(res);
                        if (obj.success !== true) {
                            Swal.fire({text: obj.message,title: "Opps..",type: "error"});
                        }else {
                            Swal.fire({text: obj.message,title: "Sukses",type: "success"});
                            table_data();
                        }
                    }
                });
            }else{
                return false;
            }
        })
    }

    function verifikasi_data(id){
        $('#loading').show();
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
                $('[name="id"]').val(id);
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
                $('.tanggal_lahir').text(tanggal_indo(data.tanggal_lahir));
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
                $('.tgl_usaha').text(tanggal_indo(data.tgl_usaha));
                $('.no_rekening').text(data.no_rekening);
                $('.an_rekening').text(data.an_rekening);
                $('.nama_bank').text(data.nama_bank);
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

                $('#smartwizard_konfirmasi').smartWizard("reset");
                $('#step-a').css('width', '100%');

                $('#loading').hide();

                $('#modal_detail').modal('show');
                $('.modal-title').text('Verifikasi Pendataan IUMKM');
            },
            error: function (jqXHR, textStatus, errorThrown){
                $('#loading').hide();
                alert('Error get data from ajax');
            }
        });
    }

    function konfirmasi(){
        save_method = 'add';
        $('[name="status"]').val(1).change();
        $('[name="alasan"]').val('');
        $('.form-group').removeClass('has-error');
        $('.help').empty();
        $('.alasan').attr('style','display:none');
        $('#modal_tambah').modal('show');
        $('.modal-title').text('Konfirmasi UMKM');
    }

    $('[name="status"]').change(function(){
        var id = $('[name="status"]').val();
        if(id == 3){
            $('.alasan').show();
        }else{
            $('.alasan').hide();
        }
    });

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
                var dataString = { 
                    id : $("[name='id']").val(),
                    status : $('[name="status"]').val(),
                    alasan : $('[name="alasan"]').val(),
                    <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>',
                    type : 'konfirmasi_umkm'
                };
                $('#btnSave').text('sedang menyimpan...'); //change button text
                $('#btnSave').attr('disabled',true); //set button disable
                $('.form-control').removeClass('is-invalid');
                $('.help-block').empty();

                var url = '<?php echo base_url("dashboard/ajax_ubah"); ?>';

                $.ajax({
                    url: url,
                    type: 'post',
                    data: dataString,
                    success: function (res) {
                        $('#loading').hide();
                        var obj = JSON.parse(res);
                        if(obj.status){
                            if (obj.success !== true) {
                                Swal.fire({text: obj.message,title: "Opps..",type: "error"});
                            }else {
                                Swal.fire({text: obj.message,title: "Sukses",type: "success"});
                                $('#modal_detail').modal('hide');
                                $('#modal_tambah').modal('hide');
                                table_data();
                            }
                        }else {
                            for (var i = 0; i < obj.inputerror.length; i++) {
                                $('[name="'+obj.inputerror[i]+'"]').addClass('is-invalid');
                                $('[name="'+obj.inputerror[i]+'"]').next().addClass('invalid-feedback');
                                $('[name="'+obj.inputerror[i]+'"]').next().html(obj.error_string[i]);

                            }
                            Swal.fire({type: 'warning',text: 'Proses Simpan Gagal, Silahkan Melengkapi Data Yang Harus Diisi',title : 'Perhatian !'});
                        }
                        $('#btnSave').text('Simpan'); //change button text
                        $('#btnSave').attr('disabled',false); //set button enable
                    }
                });
            }else{
                return false;
            }
        })
    }

    function ubah_data(id)
    {
        $.ajax({
            url : "<?php echo base_url('dashboard/ajax_data')?>",
            type: "POST",
            data : {
                id : id,
                type : 'detail_umkm',
                <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            dataType: "JSON",
            success: function(data){
                save_method = 'add';

                $('form')[0].reset();
                $('.form-control').removeClass('is-invalid');
                $('.help-block').empty();
                $('[name="jenis"]').val('sudah');
                $('[name="memiliki_iumk"]').val(id);
                $('#maps').empty('');
                $('#defaultCheck1').attr('checked', false); 
                $('#maps').load('<?=base_url('customer/umkm/maps');?>', function(data, status){});
                $('[name="nama"]').val(data.nama);
                
                $('[name="username"]').val(data.username);
                $('[name="domisili"]').val(data.domisili);
                $('[name="tempat_lahir"]').val(data.tempat_lahir);
                $('[name="tanggal_lahir"]').val(data.tanggal_lahir);
                $('[name="jenis_kelamin"]').val(data.jenis_kelamin);
                $('[name="kode_pos_rumah"]').val(data.kode_pos);
                if(data.domisili == 'Luar Kota')
                {
                    $('.check_domisili').removeAttr('style');
                    $.ajax({
                        url : "<?php echo base_url('dashboard/ajax_data/')?>",
                        type: "POST",
                        data : {
                            id : data.domisili_prop,
                            type : 'data_propinsi',
                            <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
                        },
                        dataType: "html",
                        success: function(data){
                           $('[name="prop"]').html(DOMPurify.sanitize( data, { SAFE_FOR_JQUERY: true } ));

                        },
                        error: function (jqXHR, textStatus, errorThrown){
                            alert('Error get data from ajax');
                        }
                    });
                    $.ajax({
                        url : '<?php echo base_url("dashboard/ajax_data"); ?>',
                        type: 'post',
                        data: {
                            data_propinsi: data.domisili_prop,
                            id  : data.domisili_kota,
                            type : 'data_kota',
                            <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
                        },
                        dataType: "html",
                        success: function (data) {
                            $('[name="kota"]').html(DOMPurify.sanitize( data, { SAFE_FOR_JQUERY: true } ));
                        }
                    });
                }else{
                    $('.check_domisili').attr('style','display:none;');
                }

                $('[name="nama_ibu"]').val(data.nama_ibu);
                $('[name="nama_perusahaan"]').val(data.nama_perusahaan);
                $('[name="nama_usaha"]').val(data.namausaha);
                $('[name="nomor_npwp"]').val(data.npwp);

                $.ajax({
                    url : '<?php echo base_url("dashboard/ajax_data"); ?>',
                    type: 'post',
                    data: {
                        data : data.nama_izin_usaha,
                        type : 'tambah_izin_usaha',
                        count : count,
                        <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
                    },
                    dataType: "html",
                    success: function (data) {
                        $('.view_jenis_usaha').append(DOMPurify.sanitize( data, { SAFE_FOR_JQUERY: true } ));
                    }
                });

                $.ajax({
                    url : "<?php echo base_url('dashboard/ajax_data/')?>",
                    type: "POST",
                    data : {
                        type : 'bentuk_usaha',
                        <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>',
                        id : data.id_bentuk_usaha,
                    },
                    dataType: "html",
                    success: function(data){
                        $('[name="id_bentuk_usaha"]').html(DOMPurify.sanitize( data, { SAFE_FOR_JQUERY: true } ));

                    },
                    error: function (jqXHR, textStatus, errorThrown){
                        alert('Error get data from ajax');
                    }
                });
                
                $.ajax({
                    url : "<?php echo base_url('dashboard/ajax_data/')?>",
                    type: "POST",
                    data : {
                        id : data.id_jenis_usaha,
                        type : 'jenis_usaha',
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
                $('[name="kegiatan_usaha_utama"]').val(data.kegiatan_usaha_utama);
                $.ajax({
                    url : "<?php echo base_url('dashboard/ajax_data/')?>",
                    type: "POST",
                    data : {
                        id : data.id_sektor_usaha,
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
                $('[name="tgl_usaha"]').val(data.tgl_usaha);
                $('[name="no_rumah"]').val(data.no_rumah);
                $('[name="no_kantor"]').val(data.no_kantor);
                $('[name="no_hp"]').val(data.no_hp);
                $('[name="fax"]').val(data.fax);
                $('[name="email_toko"]').val(data.email);
                $('[name="alamat_web"]').val(data.situs_web);
                $('[name="alamat_sosmed"]').val(data.sosmed);
                $('[name="pegawai_laki"]').val(format_uang(data.pegawai_laki));
                $('[name="pegawai_perempuan"]').val(format_uang(data.pegawai_perempuan));
                $('[name="jml_pegawai"]').val(format_uang(data.jml_pegawai));
                $('[name="jml_omset_sebelumnya"]').val(format_uang(data.jml_omset_sebelumnya));
                $('[name="jml_omset_sekarang"]').val(format_uang(data.jml_omset_sekarang));
                $('[name="jml_asset"]').val(format_uang(data.jml_asset));
                $('[name="jml_modal_awal"]').val(format_uang(data.jml_modal_awal));
                $.ajax({
                    url : "<?php echo base_url('dashboard/ajax_data/')?>",
                    type: "POST",
                    data : {
                        type : 'modal_luar',
                        id : data.id_modal_luar,
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
                $('[name="nominal_modal_luar"]').val(format_uang(data.nominal_modal_luar));
                $.ajax({
                    url : "<?php echo base_url('dashboard/ajax_data/')?>",
                    type: "POST",
                    data : {
                        type : 'sarana_usaha',
                        id : data.id_sarana_usaha,
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
                if(data.id_sarana_usaha == 4)
                {
                    $('.nama_sarana_lainnya').removeAttr('style');
                    $('.nama_sarana_lainnya_data').text(text(data.nama_sarana_usaha_lainnya));
                }else{
                    $('.nama_sarana_lainnya').attr('style','display:none');
                }

                $.ajax({
                    url : "<?php echo base_url('dashboard/ajax_data/')?>",
                    type: "POST",
                    data : {
                        id : data.id_status_tempat_usaha,
                        type : 'status_tempat',
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
                if(data.id_status_tempat_usaha == 4)
                {
                    $('.nama_status_lainnya').removeAttr('style');
                    $('.nama_status_lainnya_data').text(text(data.nama_status_tempat_lainnya));
                }else{
                    $('.nama_status_lainnya').attr('style','display:none');
                }

                $.ajax({
                    url : "<?php echo base_url('dashboard/ajax_data/')?>",
                    type: "POST",
                    data : {
                        type : 'bahan_bakar',
                        id : data.id_bahan_bakar,
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

                $.ajax({
                    url : "<?php echo base_url('dashboard/ajax_data/')?>",
                    type: "POST",
                    data : {
                        type : 'lainnya',
                        id : data.id_lainnya,
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

                $.ajax({
                    url : "<?php echo base_url('dashboard/ajax_data/')?>",
                    type: "POST",
                    data : {
                        type : 'data_propinsi',
                        id   : data.no_prop_pengguna,
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

                $.ajax({
                    url : "<?php echo base_url('dashboard/ajax_data/')?>",
                    type: "POST",
                    data : {
                        type : 'data_kota',
                        data_propinsi   : data.no_prop,
                        id : data.no_kab,
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

                $.ajax({
                    url : "<?php echo base_url('dashboard/ajax_data/')?>",
                    type: "POST",
                    data : {
                        type : 'data_kecamatan',
                        data_propinsi   : data.no_prop,
                        data_kota : data.no_kab,
                        id : data.no_kec,
                        <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
                    },
                    dataType: "html",
                    success: function(data){
                        $('[name="no_kec"]').html(DOMPurify.sanitize( data, { SAFE_FOR_JQUERY: true } ));

                    },
                    error: function (jqXHR, textStatus, errorThrown){
                        alert('Error get data from ajax');
                    }
                });

                $.ajax({
                    url : "<?php echo base_url('dashboard/ajax_data/')?>",
                    type: "POST",
                    data : {
                        type : 'data_kelurahan',
                        data_propinsi   : data.no_prop,
                        data_kota : data.no_kab,
                        data_kec : data.no_kec,
                        id_kel : data.no_kel,
                        <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
                    },
                    dataType: "html",
                    success: function(data){
                        $('[name="no_kel"]').html(DOMPurify.sanitize( data, { SAFE_FOR_JQUERY: true } ));

                    },
                    error: function (jqXHR, textStatus, errorThrown){
                        alert('Error get data from ajax');
                    }
                });

                $('[name="no_rw"]').val(data.no_rw);
                $('[name="no_rt"]').val(data.no_rt);
                $('[name="alamat_rumah"]').val(data.alamat_pengguna);
                if(data.tmpt_tinggal == 1)
                {
                    $('.checked_alamatsama').prop('checked', true);
                }else{
                   $('.checked_alamatsama').prop('checked', false);
                }

                $.ajax({
                    url : "<?php echo base_url('dashboard/ajax_data/')?>",
                    type: "POST",
                    data : {
                        data_propinsi   : data.no_prop,
                        data_kota : data.no_kab,
                        id : data.no_kec,
                        type : 'data_kecamatan',
                        <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
                    },
                    dataType: "html",
                    success: function(data){
                        $('[name="id_kec"]').html(DOMPurify.sanitize( data, { SAFE_FOR_JQUERY: true } ));

                    },
                    error: function (jqXHR, textStatus, errorThrown){
                        alert('Error get data from ajax');
                    }
                });

                $.ajax({
                    url : '<?php echo base_url("dashboard/ajax_data"); ?>',
                    type: 'post',
                    data: {
                        type : 'data_kelurahan',
                        data_propinsi   : data.no_prop,
                        data_kota : data.no_kab,
                        data_kec : data.no_kec,
                        id_kel : data.no_kel,
                        <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
                    },
                    dataType: "html",
                    success: function (data) {
                        $('[name="id_kel"]').html(DOMPurify.sanitize( data, { SAFE_FOR_JQUERY: true } ));
                    }
                });
                $('[name="kode_pos"]').val(data.kode_pos);
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

                $('[name="file_umkm"]').val(data.surat_iumkm);
                $('[name="file_npwp"]').val(data.foto_npwp);
                $('[name="file_ktp"]').val(data.foto_ktp);
                $('[name="file_foto"]').val(data.foto_pas);

                $('#modal_ubah').modal('show');
                $('#modal_ubah .modal-title').text('Ubah Pendataan IUMKM');
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert('Error get data from ajax');
            }
        });
    }

    $("[name='prop']").change(function(){
        $.ajax({
            url : '<?php echo base_url("dashboard/ajax_data"); ?>',
            type: 'post',
            data: {
                data_propinsi: $('[name="prop"]').val(),
                type : 'data_kota',
                <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            dataType: "html",
            success: function (data) {
               $('[name="kota"]').html(DOMPurify.sanitize( data, { SAFE_FOR_JQUERY: true } ));
           }
       });
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
    var count = 0;
    $('.tambah_izin_usaha').click(function (e) {
        count += 1;
        $.ajax({
            url : '<?php echo base_url("dashboard/ajax_data"); ?>',
            type: 'post',
            data: {
                type : 'tambah_izin_usaha',
                count : count,
                <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            dataType: "html",
            success: function (data) {
                $('.view_jenis_usaha').append(data);
            }
        });
    });

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
                    $('[name="kode_pos"]').val(data.kode_pos);
                    $.ajax({
                        url : "<?php echo base_url('dashboard/ajax_data/')?>",
                        type: "POST",
                        data : {
                            type : 'data_kecamatan',
                            data_propinsi   : data.no_prop,
                            data_kota : data.no_kab,
                            id : data.no_kec,
                            <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
                        },
                        dataType: "html",
                        success: function(data){
                            $('[name="id_kec"]').html(DOMPurify.sanitize( data, { SAFE_FOR_JQUERY: true } ));

                        },
                        error: function (jqXHR, textStatus, errorThrown){
                            alert('Error get data from ajax');
                        }
                    });

                    $.ajax({
                        url : '<?php echo base_url("dashboard/ajax_data"); ?>',
                        type: 'post',
                        data: {
                            type : 'data_kelurahan',
                            data_propinsi   : data.no_prop,
                            data_kota : data.no_kab,
                            data_kec : data.no_kec,
                            id_kel : data.no_kel,
                            <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
                        },
                        dataType: "html",
                        success: function (data) {
                            $('[name="id_kel"]').html(DOMPurify.sanitize( data, { SAFE_FOR_JQUERY: true } ));
                        }
                    });
                },
                error: function (jqXHR, textStatus, errorThrown){
                    alert('Error get data from ajax');
                }
            });
        }else{
            $.ajax({
                url : "<?php echo base_url('dashboard/ajax_data/')?>",
                type: "POST",
                data : {
                    type : 'data_kecamatan',
                    <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
                },
                dataType: "html",
                success: function(data){
                    $('[name="id_kec"]').html(DOMPurify.sanitize( data, { SAFE_FOR_JQUERY: true } ));

                },
                error: function (jqXHR, textStatus, errorThrown){
                    alert('Error get data from ajax');
                }
            });

            $('[name="id_kel"]').html('');
            $('[name="id_prop"]').val('');
            $('[name="id_kota"]').val('');
            $('[name="kode_pos"]').val('');
        }
               
    });
    
    $('.hapus_izin_usaha').click(function (e) {
        if(count != 0)
        {
            $('.'+count).remove();
            count = count - 1;    
        }
        
    });
    

    $("[name='id_kec']").change(function(){
        $.ajax({
            url : '<?php echo base_url("dashboard/ajax_data"); ?>',
            type: 'post',
            data: {
                id: $('[name="id_kec"]').val(),
                type : 'data_kelurahan',
                <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            dataType: "html",
            success: function (data) {
               $('[name="id_kel"]').html(DOMPurify.sanitize( data, { SAFE_FOR_JQUERY: true } ));
           }
       });
    });

    function simpan_umkm()
    {
        $('#btnSave').text('sedang menyimpan...'); //change button text
        $('#btnSave').attr('disabled',true); //set button disable
        $('.form-group').removeClass('has-error');
        $('.help').empty();
                
        var form = $('#simpan_umkm')[0];
        var data = new FormData(form);

        var url = '<?php echo base_url("customer/umkm/ajax_ubah"); ?>';


        swal({
            text: "Apakah Data ini Ingin Di Simpan?",
            title: "",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#2196F3",
            confirmButtonText: "Simpan",
            cancelButtonText: "Tidak",
            closeOnConfirm: false,
            closeOnCancel: true
        },
        function(isConfirm){
            if (isConfirm) {
                $('.confirm').text('sedang menyimpan...'); //change button text
                $('.confirm').attr('disabled',true); //set button disable

                $.ajax({
                    url: url,
                    type: 'post',
                    data: data,
                    processData:false,
                    contentType:false,
                    cache:false,
                    success: function (res) {
                        var obj = JSON.parse(res);
                        if(obj.status)
                        {
                            if (obj.success !== true) {
                                swal({
                                    text: obj.message,
                                    title: "Gagal",
                                    type: "error",
                                    button: true,
                                    timer: 1000
                                });
                            }
                            else {
                                swal({
                                    text: obj.message,
                                    title: "Berhasil",
                                    type: "success",
                                    button: true,
                                },function(isConfirm){
                                    if (isConfirm) {
                                        refresh_page();
                                    }
                                });
                            }
                            $('#btnSave').text('Simpan'); //change button text
                            $('#btnSave').attr('disabled',false); //set button enable
                        }
                        else {
                            for (var i = 0; i < obj.inputerror.length; i++) 
                            {
                                $('[name="'+obj.inputerror[i]+'"]').parent().parent().addClass('has-error');
                                $('[name="'+obj.inputerror[i]+'"]').next().text(obj.error_string[i]); 
                            }
                            swal({
                                type: 'error',
                                text: 'Proses Simpan Gagal, Silahkan Melengkapi Data Yang Harus Diisi',
                                title : 'Perhatian',
                                button: true,
                                timer: 3000
                            });
                            $('#btnSave').text('Simpan'); //change button text
                            $('#btnSave').attr('disabled',false); //set button enable
                        }
                    }
                });
            }else{
                $('.confirm').text('Simpan'); //change button text
                $('.confirm').attr('disabled',false); //set button disable'

                $('#btnSave').text('Simpan'); //change button text
                $('#btnSave').attr('disabled',false); //set button enable
            }

        });
    }

    function refresh_page(){
        location.reload();
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
        excel_mime_types = [ 'image/jpeg','image/jpg', 'image/png' ];
    
    document.querySelector('#error-message').style.display = 'none';
    
    // Validate MIME type
    if(excel_mime_types.indexOf(file.type) == -1) {
        document.querySelector('#error-message').style.display = 'block';
        document.querySelector('#error-message').innerText = 'Error : Only JPEG and PNG files allowed';
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