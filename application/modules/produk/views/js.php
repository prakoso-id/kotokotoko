<script type="text/html" id="files-template">
<li class="media">
    <div class="media-body mb-1">
        <img style="width: 80%" name="plugin" src="" alt="Preview Tidak Tersedia">
        <p class="mb-2">
            Status: <span class="text-muted">Waiting</span>
        </p>
        <div class="progress mb-2">
            <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <input type="hidden" class="form-control" name="file[]" value="%%inputname%%">
        
        <button type="button" onclick="hapus_foto('%%namafile%%')" class="btn btn-danger hapus_data" style="float:right; margin-top:10px;"> Hapus </button>
    </div>
    <hr class="mt-1 mb-1">
</li>
</script>
<script type="text/javascript">
    function toAsci(data)
    {
        var index = data.length;
        var new_sentence = "";
        for (var i = 0; i < index; i++) {
          new_sentence = new_sentence+data.charCodeAt(i)+',';
        }
        return new_sentence;
    }
    $(function() {
        CKEDITOR.replace('pesan_keterangan', {
             height: '300px',
             filebrowserBrowseUrl : '<?php echo base_url();?>assets/ckfinder/ckfinder.html',
             filebrowserUploadUrl: '<?php echo base_url();?>assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
             extraPlugins: 'uploadimage,image2',
             removePlugins: 'image',
        });

        CKEDITOR.replace('pesan_detail', {
             height: '300px',
             filebrowserBrowseUrl : '<?php echo base_url();?>assets/ckfinder/ckfinder.html',
             filebrowserUploadUrl: '<?php echo base_url();?>assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
             extraPlugins: 'uploadimage,image2',
             removePlugins: 'image',
        }); 
   });
</script>

<script type="text/javascript"> 
    $(document).ready(function(){
        $('.select2').select2();

        $("#modal_tambah .select2").select2({
            dropdownParent: $("#modal_tambah")
        });

        $(".inputtags").tagsinput('items');

        dataTable = $('.tabel').DataTable( {
            paginationType:'full_numbers',
            processing: true,
            serverSide: true,
            filter: false,
            autoWidth:false,
            aLengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            ajax: {
                url: '<?php echo base_url('produk/ajax_list')?>',
                type: 'POST',
                data: function (data) {
                    data.filter = {
                        'nama'      : $('.filter_produk').val(),
                        'status'    : $('.filter_status').val(),
                        'id_umkm'   : $('.filter_umkm').val(),
                        'nama_umkm' : $('.filter_nama_umkm').val(),
                        'group'     : $('.filter_kategori').val(),
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
                {'data':'foto'},
                {'data':'nama_produk'},
                {'data':'nama_usaha'},
                {'data':'status','visible':false},
                {'data':'stok'},
                {'data':'harga_produk'},
                {'data':'status'},
                {'data':'aksi','orderable':false},
            ],
            columnDefs: [
                {
                    render: function (data, type, row) {
                        if (row['is_eorder'] == 1) {
                            return '<img src="e-order.ico"/> e-order';
                        } else {
                            return row['stok'];
                        }
                    },
                    targets: 5
                },
            ]
        });

        var id_produk = '<?php echo $id_produk; ?>';
        if (id_produk) {
            var type = '<?php echo $type; ?>';
            if (type == 'detail') {
                lihat_data(id_produk);
            }else if (type == 'edit') {
                ubah_data(id_produk);
            }
        }

        $('#cekEorder').on("click", function(){
            if ($(this).is(":checked")) {
                // $('[name="stok"]').attr('disabled', true);
                // $('[name="id_kurir[]').attr('disabled', true);
                $('#showstok,#showkurir').hide();
            } else {
                // $('[name="stok"]').attr('disabled', false);
                // $('[name="id_kurir[]').attr('disabled', false);
                $('#showstok,#showkurir').show();
            }
        });
    });   

    function table_data(){
        dataTable.ajax.reload(null,true);
    }

    $(".filter_produk").keyup(function(){
        table_data();
    });

    $(".filter_nama_umkm").keyup(function(){
        table_data();
    });

    $(".filter_status").change(function(){
        table_data();
    });

    $(".filter_umkm").change(function(){
        table_data();
    });

    $(".filter_kategori").change(function(){
        table_data();
    });

    function tambah_data(){
        save_method = 'add';
        $('.id_umkm').attr('style','display:flex');
        $('#add_produk')[0].reset();
        $('.form-control').removeClass('is-invalid');
        $('.help-block').empty();
        $('#files').html('<li class="text-muted text-center empty">No files uploaded.</li>');
        $('.inputtags').tagsinput('removeAll');
        $('.inputtags input').attr('disabled', 'disabled');
        $('.f_link_video').html('');
        $('.f_link_stok').html('');
        $('[name="stok"]').attr('disabled', false);
        $('[name="id_kurir[]').attr('disabled', false);
        $.ajax({
            url : "<?php echo base_url('dashboard/ajax_data')?>",
            type: "POST",
            async : false,
            data : {
                type : 'data_umkm',
                <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            dataType: "html",
            success: function(data){
                if (data) {
                    $('[name="id_umkm"]').html(DOMPurify.sanitize( data, { SAFE_FOR_JQUERY: true } ));
                    cek_status_verif_umkm();
                    get_jenis_usaha();
                    var id_umkm = $('[name="id_umkm"]').val();
                    get_ecommerce(id_umkm);
                    get_m_kurir('kurir_umkm',id_umkm);

                    $('.tags').html('');
                    CKEDITOR.instances['pesan_keterangan'].setData('');

                    $('.f_link_video').append(html_form_video(0));

                    $('#files').on("click",".hapus_data", function(e){
                        e.preventDefault(); 
                        $(this).parents('li').last().remove();
                    });

                    $('#modal_tambah').modal('show');
                    $('.modal-title').text('Tambah Data Produk');
                }else{
                    Swal.fire({
                        text: 'Anda belum mempunyai UMKM atau data UMKM anda belum lengkap, silahkan daftar UMKM atau lengkapi data UMKM terlebih dahulu !',
                        title: "Peringatan",
                        type: "warning",
                    }).then(function(){
                       //Confirmed
                       window.location = "<?php echo base_url() ?>customer/umkm";
                    });
                }
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert('Error get data from ajax');
            }
        });
    }

    $('[name="id_umkm"]').change(function(){
        cek_status_verif_umkm();
        get_jenis_usaha();
        var id_umkm = $('[name="id_umkm"]').val();
        get_ecommerce(id_umkm);
        get_m_kurir('kurir_umkm',id_umkm);
    });

    function cek_status_verif_umkm(){
        $.ajax({
            url : "<?php echo base_url('dashboard/ajax_data')?>",
            type: "POST",
            async:false,
            data : {
                type : 'cek_status_verif_umkm',
                id_umkm : $('[name="id_umkm"]').val(), 
                <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            dataType: "json",
            success: function(data){
                if (data.status_verif == 1) {
                    $('.alert-umkm').hide();
                }else{
                    $('.alert-umkm').html(DOMPurify.sanitize( data.message, { SAFE_FOR_JQUERY: true } ));
                    $('.alert-umkm').show();
                }
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert('Error get data from ajax');
            }
        });
    }

    function get_jenis_usaha(id=null){
        $.ajax({
            url : "<?php echo base_url('dashboard/ajax_data')?>",
            type: "POST",
            async:false,
            data : {
                type : 'jenis_usaha',
                id : id,
                id_umkm : $('[name="id_umkm"]').val(), 
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

    function get_ecommerce(id_umkm){
        $('.f_link_ekternal_produk').empty();
        $.ajax({
            url : "<?php echo base_url('dashboard/ajax_data')?>",
            type: "POST",
            async:false,
            data : {
                type : 'data_ecommerce',
                id_umkm : id_umkm, 
                <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            dataType: "html",
            success: function(data){
                $('.f_link_ekternal_produk').html(DOMPurify.sanitize( data, { SAFE_FOR_JQUERY: true } ));
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert('Error get data from ajax');
            }
        });
    }

     function get_m_kurir(is_kurir_umkm=null,id_umkm=null){
        $.ajax({
            url : "<?php echo base_url('transaksi/ajax_data')?>",
            type: "POST",
            async:false,
            data : {
                type : 'data_kurir',
                is_kurir_umkm : is_kurir_umkm,
                id_umkm : id_umkm,
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

    var i_vid = 1;
    function add_video(){
        $('.f_link_video').append(html_form_video(i_vid));
        i_vid++;
    }

    function html_form_video(i,v='',is_disabled=false){
        if (is_disabled) {
            var disabled = 'disabled';
            var btn_del = '';
        }else{
            var disabled = '';
            var btn_del = `<div class="col-lg-2"><button type="button" class="btn btn-danger" onclick="del_video(`+i+`)"><i class="fas fa-trash"></i> Hapus</button></div>`;
        }
        
        var html = `<div class="position-relative row form-group link_video_`+i+`">
                        <label class="col-sm-3 col-form-label" style="font-weight:600">Link Video</label>
                        <div class="col-lg-9">
                            <div class="row">
                                <div class="col-lg-10">
                                    <input type="text" name="link_video[]" `+disabled+` class="form-control" id="link_video_`+i+`" placeholder="Link Video Youtube" value="`+v+`">
                                </div>
                                `+btn_del+`
                            </div>
                            <span class="help-block"></span>
                        </div>
                    </div>`;
        return html;
    }

    function del_video(i){
        $('.link_video_'+i).remove();
    }

    var i_stok = 1;
    function add_stok(){
        $('.f_link_stok').append(html_form_stok(i_stok));
        i_stok++;
    }

    function html_form_stok(i,v='',d='',is_disabled=false){
        if (is_disabled) {
            var disabled = 'disabled';
            var btn_del = '';
        }else{
            var disabled = '';
            var btn_del = `<div class="col-lg-2"><button type="button" class="btn btn-danger" onclick="del_stok(`+i+`)"><i class="fas fa-trash"></i> Hapus</button></div>`;
        }
        
        var html = `<div class="position-relative row form-group link_stok_`+i+`">
                        <label class="col-sm-3 col-form-label" style="font-weight:600">Stok Ukuran</label>
                        <div class="col-lg-9">
                            <div class="row">
                                <div class="col-lg-7">
                                    <input type="text" name="ukuran[]" `+disabled+` class="form-control" id="link_stok_`+i+`" placeholder="Ukuran" value="`+d+`">
                                </div>
                                <div class="col-lg-3">
                                    <input type="text" name="stok[]" `+disabled+` class="form-control currency-field" oninput="changeNumber(`+i+`)" placeholder="Stok Produk" id="mount_stok_`+i+`" placeholder="Stok Produk" value="`+v+`">
                                </div>
                                `+btn_del+`
                            </div>
                            <span class="help-block"></span>
                        </div>
                    </div>`;
        return html;
    }

    function del_stok(i){
        $('.link_stok_'+i).remove();
    }

    function changeNumber(id){
        const val = this.value;
        // console.log(val);
        // // return this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')
        setInputFilter(document.getElementById("mount_stok_"+id), function(value) {
        return /^-?\d*[.]?\d{0,2}$/.test(value) && (value === "" || parseInt(value) <= 999); });
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
                $('#btnSave').text('sedang menyimpan...'); //change button text
                $('#btnSave').attr('disabled',true); //set button disable
                $('.form-control').removeClass('is-invalid');
                $('.help-block').empty();
                        
                var form = $('#add_produk')[0];
                var data = new FormData(form);
                data.append('deskripsi',toAsci(CKEDITOR.instances['pesan_keterangan'].getData()));

                if(save_method == 'add'){
                    var url = '<?php echo base_url("produk/ajax_save"); ?>';
                }else{
                    var url = '<?php echo base_url("produk/ajax_ubah"); ?>';
                }

                $.ajax({
                    url: url,
                    type: 'post',
                    data: data,
                    processData:false,
                    contentType:false,
                    cache:false,
                    success: function (res) {
                        var obj = JSON.parse(res);
                        if(obj.status){
                            if (obj.success !== true) {
                                Swal.fire({text: obj.message,title: "Opps..",type: "error"});
                            }else {
                                Swal.fire({text: obj.message,title: "Sukses",type: "success"});
                                $('#modal_tambah').modal('hide');
                                table_data();
                            }
                            
                        }else {
                            for (var i = 0; i < obj.inputerror.length; i++) {
                                $('[name="'+obj.inputerror[i]+'"]').addClass('is-invalid');
                                $('[name="'+obj.inputerror[i]+'"]').next().addClass('invalid-feedback');
                                $('[name="'+obj.inputerror[i]+'"]').next().html(obj.error_string[i]);
                            }
                            Swal.fire({type: 'error',text: 'Proses Simpan Gagal, Silahkan Melengkapi Data Yang Harus Diisi',title : ''});
                        }

                        $('#btnSave').text('Simpan'); //change button text
                        $('#btnSave').attr('disabled',false); //set button enable
                    }
                });
            }else{
                return false;
            }
        });
    }

    function ubah_data(id)
    {
        save_method = 'update';
        $('.form-control').removeClass('is-invalid');
        $('.help-block').empty();       
        $('#images').html(' ');
        $('.inputtags').tagsinput('removeAll');
        $('.inputtags input').attr('disabled', 'disabled');
        $('.f_link_video').html('');
        $('.f_link_stok').html('');

        $.ajax({
            url : "<?php echo base_url('produk/ajax_lihat')?>",
            type: "post",
            data : {
                id   : id,
                <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            dataType: "JSON",
            success: function(data){
                $('[name="id"]').val(id);
                var html_umkm = '<option value="'+data.produk.username+'">'+data.produk.username+'</option>';
                $('[name="id_umkm"]').html(DOMPurify.sanitize( html_umkm, { SAFE_FOR_JQUERY: true } ));
                $('[name="nama_produk"]').val(data.produk.nama_produk);
                $('.id_umkm').attr('style','display:none');
                get_jenis_usaha(data.produk.id_jenis_usaha);
                get_ecommerce(data.produk.username);
                if (data.produk.link_eksternal) {
                    var arr_link_eksternal = JSON.parse(data.produk.link_eksternal);
                    $.each(arr_link_eksternal, function(item, i) {
                        $('#link_'+i.nama_ecommerce).val(i.link_produk);
                    });
                }
                if (data.produk.link_sosmed) {
                    var arr_link_sosmed = JSON.parse(data.produk.link_sosmed);
                    $.each(arr_link_sosmed, function(item, i) {
                        $('#link_'+i.nama_medsos).val(i.link_produk);
                    });
                }

                if (data.produk.link_video) {
                    var arr_link_video = JSON.parse(data.produk.link_video);
                    $.each(arr_link_video, function(item, i) {
                        $('.f_link_video').append(html_form_video(item,i));
                    });
                }

                if (data.stok) {
                    if(data.stok.length != 0){
                        var stok = data.stok;
                        for (var i = 0; i < stok.length; i++) {
                            $('.f_link_stok').append(html_form_stok(stok[i].id_stock,stok[i].stok,stok[i].ukuran));
                        }
                    }
                }

                $('[name="diskon"]').val(data.produk.diskon);
                $('[name="diskon_nominal"]').val(format_uang(data.produk.diskon_nominal));

                $('[name="harga"]').val(format_uang(data.produk.harga));
                $('[name="stok"]').val(format_uang(data.produk.stok));
                $('[name="is_eorder"]').prop('checked', (data.produk.is_eorder=='1'));
                if ($('[name="is_eorder"]').is(":checked")) {
                    // $('[name="stok"]').attr('disabled', true);
                    // $('[name="id_kurir[]').attr('disabled', true);
                    $('#showstok,#showkurir').hide();
                } else {
                    // $('[name="stok"]').attr('disabled', false);
                    // $('[name="id_kurir[]').attr('disabled', false);
                    $('#showstok,#showkurir').show();
                }
                $('[name="berat"]').val(data.produk.berat);

                get_m_kurir();
                var id_kurir = JSON.parse(data.produk.id_kurir);
                $('[name="id_kurir[]').val(id_kurir).change();

                CKEDITOR.instances['pesan_keterangan'].setData(data.produk.deskripsi);
                $(".inputtags").tagsinput('add', data.produk.tags);


                $('#files').empty();
                if(data.gallery.length != 0){
                    for (var i = 0; i < data.gallery.length; i++) {
                        $('#files').append('<li class="media"><div class="media-body mb-1"><embed width="80%" name="plugin" src="<?php echo base_url("assets/produk/"); ?>'+data.produk.username+'/'+data.gallery[i].foto+'"><p class="mb-2">Status: <span class="text-muted">Done</span></p><div class="progress mb-2"><div class="progress-bar bg-primary bg- bg-success" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">100%</div></div><input type="hidden" class="form-control" name="file[]" value="'+data.gallery[i].foto+'"><button class="btn btn-danger hapus_data" onclick="hapus_foto(\''+data.gallery[i].foto+'\')" style="float:right; margin-top:10px;"> Hapus </button></div> <hr class="mt-1 mb-1" /></li>');
                    }
                }

                $('#files').on("click",".hapus_data", function(e){
                    e.preventDefault(); 
                    $(this).parents('li').last().remove();
                });

                $('.modal-title').text('Ubah Data Produk');
                $('#modal_tambah').modal('show');
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert('Error get data from ajax');
            }
        });
    }

    function lihat_data(id){
        $('.form-control').removeClass('is-invalid');
        $('.help-block').empty();
        $('#images').html(' ');
        $('.inputtags').tagsinput('removeAll');
        $('.inputtags input').attr('disabled', 'disabled');
        $('.f_link_video').html('');
        $.ajax({
            url : "<?php echo base_url('produk/ajax_lihat')?>",
            type: "post",
            async:false,
            data : {
                id   : id,
                <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            dataType: "JSON",
            success: function(data)
            {
                $('[name="id"]').val(id);
                $('[name="nama_produk"]').val(data.produk.nama_produk);
                $('[name="namausaha"]').val(data.produk.namausaha);
                $('[name="nama_usaha"]').val(data.produk.nama_usaha);
                $('[name="harga"]').val(format_uang(data.produk.harga));
                $('[name="stok"]').val(format_uang(data.produk.stok));
                $('[name="is_eorder"]').prop('checked', false);
                $('[name="berat"]').val(data.produk.berat);
                
                get_m_kurir();
                var id_kurir = JSON.parse(data.produk.id_kurir);
                $('[name="id_kurir[]"]').val(id_kurir).change();

                get_ecommerce(data.produk.username);
                if (data.produk.link_eksternal) {
                    var arr_link_eksternal = JSON.parse(data.produk.link_eksternal);
                    $('#modal_data [name="link_produk[]"]').attr('readonly', true);
                    $.each(arr_link_eksternal, function(item, i) {
                        $('#modal_data #link_'+i.nama_ecommerce).val(i.link_produk);
                    });
                }
                if (data.produk.link_sosmed) {
                    var arr_link_sosmed = JSON.parse(data.produk.link_sosmed);
                    $('#modal_data [name="link_produk_medsos[]"]').attr('readonly', true);
                    $.each(arr_link_sosmed, function(item, i) {
                        $('#modal_data #link_'+i.nama_medsos).val(i.link_produk);
                    });
                }

                if (data.produk.link_video) {
                    var arr_link_video = JSON.parse(data.produk.link_video);
                    $.each(arr_link_video, function(item, i) {
                        $('.f_link_video').append(html_form_video(item,i,true));
                    });
                }

                if (data.produk.link_video) {
                    var arr_link_video = JSON.parse(data.produk.link_video);
                    $.each(arr_link_video, function(item, i) {
                        $('.f_link_video').append(html_form_video(item,i,true));
                    });
                }

                if (data.stok) {
                    if(data.stok.length != 0){
                        var stok = data.stok;
                        for (var i = 0; i < stok.length; i++) {
                            $('.f_link_stok').append(html_form_stok(stok[i].id_stock,stok[i].stok,stok[i].ukuran,true));
                        }
                    }
                }

                CKEDITOR.instances['pesan_detail'].setData(data.produk.deskripsi);
                $(".inputtags").tagsinput('add', data.produk.tags);
                $('.files_').empty();
                if(data.gallery.length != 0){
                    for (var i = 0; i < data.gallery.length; i++) {
                        $('.files_').append('<li class="media"><div class="media-body mb-1"><embed height="250px;" name="plugin" src="<?php echo base_url("assets/produk/"); ?>'+data.produk.username+'/'+data.gallery[i].foto+'"><p class="mb-2">Status: <span class="text-muted">Done</span></p><div class="progress mb-2"><div class="progress-bar bg-primary bg- bg-success" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">100%</div></div><input type="hidden" class="form-control" name="file[]" value="'+data.gallery[i].foto+'"></div> <hr class="mt-1 mb-1" /></li>');
                    }
                }

                $('#files').on("click",".hapus_data", function(e){
                    e.preventDefault(); 
                    $(this).parents('li').last().remove();
                });

                $('.modal-title').text('Detail Data Produk');
                $('#modal_data').modal('show');
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert('Error get data from ajax');
            }
        });
    }

    function hapus_data(id){
        (async () => {
            const {value: text} = await Swal.fire({
                title: 'Apakah Produk ini Ingin Di Non aktifkan?',
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
                    url : '<?php echo site_url("produk/ajax_hapus"); ?>',
                    type: 'post',
                    data: {
                        id: id,
                        data : $("[name='alasan_hapus']").val(),
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
          text: "Apakah Data ini Ingin Di Aktifkan?",
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
                    url : '<?php echo site_url("produk/ajax_restore"); ?>',
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
        });
    }

    function hapus_foto(nama){
        $.ajax({
            url : "<?php echo base_url('produk/ajax_hapus_foto')?>",
            type: "POST",
            data : {
                nama : nama,
                <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>',
                id_umkm : $('[name="id_umkm"]').val(),
            },
            dataType: "html",
            success: function(res){
                var data = JSON.parse(res);
                if(data.status){
                    Swal.fire({type: 'success',title: 'Sukses',text: data.message,showConfirmButton: false,timer: 1500});
                }else{
                    Swal.fire({text: data.message,title: "Opps..",type: "error"});
                }
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert('Error get data from ajax');
            }
        });
    }

</script>
<script type="text/javascript">
    $('#drag-and-drop-zone').dmUploader({
        url: '<?php echo base_url('produk/ajax_upload'); ?>',
        extraData: function() {
            return {
               <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>',
               id_umkm : $('[name="id_umkm"]').val(),
            };
        }
        ,
        maxFileSize: 5242880,
        allowedTypes: "png|jpg|jpeg",
        extFilter: ["jpg", "jpeg","png"],
        onDragEnter: function(){
            this.addClass('active');
        },
        onDragLeave: function(){
            this.removeClass('active');
        },
        onInit: function(){
            ui_add_log('Penguin initialized :)', 'info');
        },
        onComplete: function(){
            ui_add_log('All pending tranfers finished');
        },
        onNewFile: function(id, file){
            ui_add_log('New file added #' + id);
            ui_multi_add_file(id, file);

            if (typeof FileReader !== "undefined"){
                var reader = new FileReader();
                var img = $('#uploaderFile' + id).find('img');

                reader.onload = function (e) {
                    img.attr('src', e.target.result);
                }
                reader.readAsDataURL(file);
            }
        },
        onBeforeUpload: function(id){
            ui_add_log('Starting the upload of #' + id);
            ui_multi_update_file_progress(id, 0, '', true);
            ui_multi_update_file_status(id, 'uploading', 'Uploading...');
        },
        onUploadProgress: function(id, percent){
            ui_multi_update_file_progress(id, percent);
        },
        onUploadSuccess: function(id, data){
            ui_add_log('Server Response for file #' + id + ': ' + JSON.stringify(data));
            ui_add_log('Upload of file #' + id + ' COMPLETED', 'success');
            ui_multi_update_file_status(id, 'success', 'Upload Complete');
            ui_multi_update_file_progress(id, 100, 'success', false);
        },
        onUploadError: function(id, xhr, status, message){
            ui_multi_update_file_status(id, 'danger', message);
            ui_multi_update_file_progress(id, 0, 'danger', false);  
            swal({text: message,title: "Error",type: "error"});
        },
        onFallbackMode: function(){
            ui_add_log('Plugin cant be used here, running Fallback callback', 'danger');
        },
        onFileSizeError: function(file){
            ui_add_log('File \'' + file.name + '\' cannot be added: size excess limit', 'danger');
            swal({text: "Ukuran file terlalu besar !",title: "Error",type: "error"});
        },
        onFileTypeError: function(file){
            ui_add_log('File \'' + file.name + '\' cannot be added: must be an image (type error)', 'danger');
            swal({text: "Type file yang dipilih tidak diizinkan !",title: "Error",type: "error"});
        },
        onFileExtError: function(file){
            ui_add_log('File \'' + file.name + '\' cannot be added: must be an image (extension error)', 'danger');
        }
    });

    // Restricts input for the given textbox to the given inputFilter.
    function setInputFilter(textbox, inputFilter) {
      ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
        textbox.addEventListener(event, function() {
          if (inputFilter(this.value)) {
            this.oldValue = this.value;
            this.oldSelectionStart = this.selectionStart;
            this.oldSelectionEnd = this.selectionEnd;
          } else if (this.hasOwnProperty("oldValue")) {
            this.value = this.oldValue;
            this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
          } else {
            this.value = "";
          }
        });
      });
    }
    setInputFilter(document.getElementById("berat"), function(value) {
        return /^-?\d*[.]?\d{0,2}$/.test(value) && (value === "" || parseInt(value) <= 999); });

    // $('#diskon').on('input', function () {
    //     var harga = $('[name=harga').val().replace(/[^0-9]+/g, '');
    //         harga = parseInt(harga);
    //     var nilai_diskon = '';
    //     var nilai_akhir = '';

    //     this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');

    //     if (harga == '' || harga < 1) {
    //         Swal.fire({text: "Harga produk tidak boleh kosong!",title: "Error",type: "error"});
    //         $(this).val('');
    //         return false;
    //     }

    //     if (document.getElementById('persen').checked == true) {
    //         if (this.value >= 100) {
    //             Swal.fire({text: "Nilai diskon tidak valid!",title: "Error",type: "error"});
    //             $('#hint_diskon').text('');
    //             $('#hint_diskon2').text('');
    //             return false;
    //         }

    //         nilai_diskon = harga * (this.value / 100);
    //         nilai_akhir = harga - nilai_diskon;
    //     } else {
    //         nilai_diskon = this.value;
    //         console.log(harga);

    //         if (nilai_diskon >= harga) {
    //             Swal.fire({text: "Nilai diskon tidak valid2!",title: "Error",type: "error"});
    //             $('#hint_diskon').text('');
    //             $('#hint_diskon2').text('');
    //             return false;
    //         }

    //         nilai_akhir = harga - nilai_diskon;
    //     }

    //     $('#hint_diskon').text('Diskon sebesar : Rp' + numberFormat(nilai_diskon, 0, ',', '.'));
    //     $('#hint_diskon2').text('Harga setelah diskon : Rp' + numberFormat(nilai_akhir, 0, ',', '.'));
    // });

    // $('[name=jenis_diskon]').on('click', function () {
    //     if (this.value == 'persen') {
    //         $('#diskon').attr('maxlength', 4);
    //     } else {
    //         $('#diskon').attr('maxlength', 99);
    //     }

    //     $('#diskon').val('');
    //     $('#hint_diskon').text('');
    //     $('#hint_diskon2').text('');
    // });

    function numberFormat (number, decimals, dec_point, thousands_sep) {
        // Strip all characters but numerical ones.
        number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function (n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }

    $('#diskon').on('keyup', function () {
        var harga = $('[name=harga').val().replace(/[^0-9]+/g, '');
        var diskon = parseFloat(this.value);
        var diskon_nominal = 0;
        var harga_akhir = 0;

        if (harga == '' || harga < 1) {
            Swal.fire({text: "Harga produk tidak valid!",title: "Error",type: "error"});
            $(this).val('');
            return false;
        }

        if (diskon >= 100) {
            Swal.fire({text: "Nilai diskon tidak valid!",title: "Error",type: "error"});
            $('#diskon').val('');
            $('#diskon_nominal').val('');
            $('#diskon_hint').text('');
            return false;
        }

        diskon_nominal = harga * (this.value / 100);
        $('#diskon_nominal').val(numberFormat(diskon_nominal, 0, ',', '.'));

        harga_akhir = harga - diskon_nominal;
        $('#diskon_hint').text('Harga setelah diskon: ' + numberFormat(harga_akhir, 0, ',', '.'));
    });

    $('#diskon_nominal').on('keyup', function () {
        var harga = $('[name=harga').val().replace(/[^0-9]+/g, '');
        var diskon_nominal = parseInt(this.value.replace(/[^0-9]+/g, ''));
        var diskon = 0;
        var harga_akhir = 0;

        if (harga == '' || harga < 1) {
            Swal.fire({text: "Harga produk tidak valid!",title: "Error",type: "error"});
            $(this).val('');
            return false;
        }

        if (diskon_nominal >= harga) {
            Swal.fire({text: "Nominal diskon tidak valid!",title: "Error",type: "error"});
            $('#diskon').val('');
            $('#diskon_nominal').val('');
            $('#diskon_hint').text('');
            return false;
        }

        diskon = diskon_nominal / harga * 100;
        $('#diskon').val(numberFormat(diskon, 2, '.', ','));

        harga_akhir = harga - diskon_nominal;
        $('#diskon_hint').text('Harga setelah diskon: ' + numberFormat(harga_akhir, 0, ',', '.'));
    });

    $('#harga').on('keyup', function () {
        $('#diskon').val('');
        $('#diskon_nominal').val('');
        $('#diskon_hint').text('');
    });
</script>
