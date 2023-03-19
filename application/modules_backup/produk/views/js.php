<script src="<?php echo base_url('assets/js/jquery.dm-uploader.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/ui-main.js') ?>"></script>
<script src="<?php echo base_url('assets/js/ui-multiple.js') ?>"></script>
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
<script>
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
	$('.select2').select2();

    $("#modal_tambah .select2").select2({
      dropdownParent: $("#modal_tambah")
    });

    $(".tags").select2({
        tags: true,
    });

    var delay = (function(){
      var timer = 0;
      return function(callback, ms){
        clearTimeout(timer);
        timer = setTimeout(callback,ms);
      };
    })();  


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
            {'data':'nama_produk'},
            {'data':'namausaha'},
            {'data':'stok'},
            {'data':'harga'},
            {'data':'status'},
            {'data':'aksi','orderable':false},
        ]
    });

    function table_data(){
        dataTable.ajax.reload(null,true);
    }


    $(".filter_produk").keyup(function(){
        delay(function(){
            table_data();
        }, 800);
    });

    $(".filter_nama_umkm").keyup(function(){
        delay(function(){
            table_data();
        }, 800);
    });

    $(".filter_status").change(function(){
        table_data();
    });

    $(".filter_umkm").change(function(){
        table_data();
    });

    $(".load_table").click(function(){
        table_data();
    });

    function tambah_data(){
        save_method = 'add';
        $('.id_umkm').attr('style','display:flex');
        $('#add_produk')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help').empty();
        $('#files').html('<li class="text-muted text-center empty">No files uploaded.</li>');
        $.ajax({
            url : "<?php echo base_url('dashboard/ajax_data/')?>",
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
                    get_ecommerce();
                    var id_umkm = $('[name="id_umkm"]').val();
                    get_m_kurir('kurir_umkm',id_umkm);

                    $('.tags').html('');
                    CKEDITOR.instances['pesan_keterangan'].setData('');

                    $('#files').on("click",".hapus_data", function(e){
                        e.preventDefault(); 
                        $(this).parents('li').last().remove();
                    });

                    $('#modal_tambah').modal('show');
                    $('.modal-title').text('Tambah Data Produk');
                }else{
                    swal({
                        text: 'Anda belum mempunyai UMKM atau data UMKM anda belum lengkap, silahkan daftar UMKM atau lengkapi data UMKM terlebih dahulu !',
                        title: "Peringatan",
                        type: "warning",
                        button: true,
                    },function(isConfirm){
                        if (isConfirm) {
                            window.open("<?php echo base_url() ?>customer/umkm"); 
                        }
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
        get_ecommerce();
        var id_umkm = $('[name="id_umkm"]').val();
        get_m_kurir('kurir_umkm',id_umkm);
    });

    function cek_status_verif_umkm(){
        $.ajax({
            url : "<?php echo base_url('dashboard/ajax_data/')?>",
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
            url : "<?php echo base_url('dashboard/ajax_data/')?>",
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

    function get_ecommerce(){
        $.ajax({
            url : "<?php echo base_url('dashboard/ajax_data/')?>",
            type: "POST",
            async:false,
            data : {
                type : 'data_ecommerce',
                id_umkm : $('[name="id_umkm"]').val(), 
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
            url : "<?php echo base_url('transaksi/ajax_data/')?>",
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

    function simpan_data()
    {
        $('#btnSave').text('sedang menyimpan...'); //change button text
        $('#btnSave').attr('disabled',true); //set button disable
        $('.form-group').removeClass('has-error');
        $('.help').empty();
                
        var form = $('#add_produk')[0];
        var data = new FormData(form);
        data.append('deskripsi',toAsci(CKEDITOR.instances['pesan_keterangan'].getData()));

        if(save_method == 'add')
        {
            var url = '<?php echo base_url("produk/ajax_save"); ?>';
        }
        else{
            var url = '<?php echo base_url("produk/ajax_ubah"); ?>';
        }

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
                                    title: "",
                                    type: "error",
                                    button: true,
                                });
                            }
                            else {
                                swal({
                                    text: obj.message,
                                    title: "",
                                    type: "success",
                                    button: true,
                                },function(isConfirm){
                                    if (isConfirm) {
                                        $('#modal_tambah').modal('hide');
                                        table_data();
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
                                title : '',
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

    function ubah_data(id)
    {
        save_method = 'update';
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $('.help').empty();        
        $('#images').html(' ');
        $.ajax({
            url : "<?php echo base_url('produk/ajax_lihat')?>",
            type: "post",
            data : {
                id   : id,
                <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            dataType: "JSON",
            success: function(data)
            {
                $('[name="id"]').val(id);
                var html_umkm = '<option value="'+data.produk.username+'">'+data.produk.username+'</option>';
                $('[name="id_umkm"]').html(DOMPurify.sanitize( html_umkm, { SAFE_FOR_JQUERY: true } ));
                $('[name="nama_produk"]').val(data.produk.nama_produk);
                $('.id_umkm').attr('style','display:none');
                get_jenis_usaha(data.produk.id_jenis_usaha);
                get_ecommerce();
                if (data.produk.link_eksternal) {
                    var arr_link_eksternal = JSON.parse(data.produk.link_eksternal);
                    $.each(arr_link_eksternal, function(item, i) {
                        $('#link_'+i.nama_ecommerce).val(i.link_produk);
                    });
                }
                $('[name="harga"]').val(format_uang(data.produk.harga));
                $('[name="stok"]').val(format_uang(data.produk.stok));
                $('[name="berat"]').val(data.produk.berat);

                get_m_kurir();
                var id_kurir = JSON.parse(data.produk.id_kurir);
                $('[name="id_kurir[]').val(id_kurir).change();

                CKEDITOR.instances['pesan_keterangan'].setData(data.produk.deskripsi);
                get_tags(data.produk.tags);
                $('#files').empty();
                $('.modal-title').text('Ubah Data Produk');
                $('#modal_tambah').modal('show');
                if(data.gallery.length != 0)
                {
                    for (var i = 0; i < data.gallery.length; i++) {
                        $('#files').append('<li class="media"><div class="media-body mb-1"><embed width="80%" name="plugin" src="<?php echo base_url("assets/produk/"); ?>'+data.produk.username+'/'+data.gallery[i].foto+'"><p class="mb-2">Status: <span class="text-muted">Done</span></p><div class="progress mb-2"><div class="progress-bar bg-primary bg- bg-success" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">100%</div></div><input type="hidden" class="form-control" name="file[]" value="'+data.gallery[i].foto+'"><button class="btn btn-danger hapus_data" onclick="hapus_foto(\''+data.gallery[i].foto+'\')" style="float:right; margin-top:10px;"> Hapus </button></div> <hr class="mt-1 mb-1" /></li>');
                    }
                }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
        $('#files').on("click",".hapus_data", function(e){
            e.preventDefault(); 
            $(this).parents('li').last().remove();
        });
    }

    function lihat_data(id)
    {
        save_method = 'update';
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $('#images').html(' ');
        $.ajax({
            url : "<?php echo base_url('produk/ajax_lihat')?>",
            type: "post",
            data : {
                id   : id,
                <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            dataType: "JSON",
            success: function(data)
            {
                $('[name="id"]').val(id);
                $('[name="nama_produk"]').val(data.produk.nama_produk);
                get_jenis_usaha(data.produk.id_jenis_usaha);
                $('[name="harga"]').val(format_uang(data.produk.harga));
                $('[name="stok"]').val(format_uang(data.produk.stok));
                $('[name="berat"]').val(data.produk.berat);
                
                get_m_kurir();
                var id_kurir = JSON.parse(data.produk.id_kurir);
                $('[name="id_kurir[]"]').val(id_kurir).change();

                CKEDITOR.instances['pesan_detail'].setData(data.produk.deskripsi);
                get_tags(data.produk.tags);
                $('.files_').empty();
                $('.modal-title').text('Detail Data Produk');
                $('#modal_data').modal('show');
                if(data.gallery.length != 0)
                {
                    for (var i = 0; i < data.gallery.length; i++) {
                        $('.files_').append('<li class="media"><div class="media-body mb-1"><embed height="250px;" name="plugin" src="<?php echo base_url("assets/produk/"); ?>'+data.produk.username+'/'+data.gallery[i].foto+'"><p class="mb-2">Status: <span class="text-muted">Done</span></p><div class="progress mb-2"><div class="progress-bar bg-primary bg- bg-success" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">100%</div></div><input type="hidden" class="form-control" name="file[]" value="'+data.gallery[i].foto+'"></div> <hr class="mt-1 mb-1" /></li>');
                    }
                }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
        $('#files').on("click",".hapus_data", function(e){
            e.preventDefault(); 
            $(this).parents('li').last().remove();
        });
    }

    function get_tags(tags){
         $.ajax({
            url : "<?php echo base_url('dashboard/ajax_data/')?>",
            type: "POST",
            data : {
                type : 'tags_produk',
                data : tags,
                <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            dataType: "html",
            success: function(res){
                $('.tags').html(DOMPurify.sanitize( res, { SAFE_FOR_JQUERY: true } ));

            },
            error: function (jqXHR, textStatus, errorThrown){
                alert('Error get data from ajax');
            }
        });
    }

    function hapus_data(id)
    {
        swal({
            text: "Apakah Produk ini Ingin Di Non aktifkan?<br><br><textarea style='resize:none;' class='form-control' name='alasan_hapus' placeholder='Alasan dinonaktifkan?'></textarea>",
            title: "Perhatian!",
            type: "warning",
            html:true,
            showCancelButton: true,
            confirmButtonColor: "#f8ce86",
            confirmButtonText: "Hapus",
            cancelButtonText: "Tidak",
            closeOnConfirm: false,
            closeOnCancel: true
        },
        function(isConfirm){
            if (isConfirm) {
                $.ajax({
                    url : '<?php echo site_url("produk/ajax_hapus"); ?>',
                    type: 'post',
                    data: {
                        id: id,
                        data : $("[name='alasan_hapus']").val(),
                        <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
                    },
                    beforeSend: function () {
                        $('.confirm').text('sedang menyimpan...'); //change button text
                        $('.confirm').attr('disabled',true); //set button disable
                    },
                    complete: function () {
                        $('.confirm').text('Selesai'); //change button text
                        $('.confirm').attr('disabled',false); //set button disable'
                    },
                    success: function (res) {
                        var obj = JSON.parse(res);
                        if (obj.success !== true) {
                            swal({
                                text: obj.message,
                                title: "",
                                type: "error",
                                button: true,
                                timer: 1000
                            });
                        }
                        else {
                            swal({
                                text: obj.message,
                                title: "",
                                type: "success",
                                button: true,
                                   },function(isConfirm){
                                        if (isConfirm) {
                                             table_data();
                                        }
                                   });
                        }
                    }
                });
            }
        });
    }

    function aktif_data(id)
    {
        swal({
            text: "Apakah Data ini Ingin Di Aktifkan?",
            title: "",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#f8ce86",
            confirmButtonText: "Aktif",
            cancelButtonText: "Tidak",
            closeOnConfirm: false,
            closeOnCancel: true
        },
        function(isConfirm){
            if (isConfirm) {
                $.ajax({
                    url : '<?php echo site_url("produk/ajax_restore"); ?>',
                    type: 'post',
                    data: {
                        id: id,
                        <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
                    },
                    beforeSend: function () {
                        $('.confirm').text('sedang menyimpan...'); //change button text
                        $('.confirm').attr('disabled',true); //set button disable
                    },
                    complete: function () {
                        $('.confirm').text('Selesai'); //change button text
                        $('.confirm').attr('disabled',false); //set button disable'
                    },
                    success: function (res) {
                        var obj = JSON.parse(res);
                        if (obj.success !== true) {
                            swal({
                                text: obj.message,
                                title: "",
                                type: "error",
                                button: true,
                                timer: 1000
                            });
                        }
                        else {
                            swal({
                                text: obj.message,
                                title: "",
                                type: "success",
                                button: true,
                                   },function(isConfirm){
                                        if (isConfirm) {
                                             table_data();
                                        }
                                   });
                        }
                    }
                });
            }
        });
    }

    function hapus_foto(nama)
    {
        $.ajax({
            url : "<?php echo base_url('produk/ajax_hapus_foto/')?>",
            type: "POST",
            data : {
                nama : nama,
                <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>',
                id_umkm : $('[name="id_umkm"]').val(),
            },
            dataType: "html",
            success: function(res){
                var data = JSON.parse(res);
                if(data.status)
                {
                    swal({
                        text: data.message,
                        title: "",
                        type: "success",
                        button: true,
                        timer: 1000
                    });   
                }else{
                    swal({
                        text: data.message,
                        title: "",
                        type: "error",
                        button: true,
                        timer: 1000
                    });
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
</script>
