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
                url: '<?php echo base_url('slider/ajax_list')?>',
                type: 'POST',
                data: function (data) {
                    data.filter = {
                        'nama'      : $('.filter_berita').val(),    
                        'status'     : $('.filter_status').val(), 
                    };
                    data.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
                    data.type = 'slider';
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
            {'data':'title'},
            {'data':'jenis'},
            {'data':'url'},
            {'data':'status'},
            {'data':'aksi','orderable':false},
            ]
        });

        dataTable_banner_produk = $('.tabel_banner_produk').DataTable( {
            paginationType:'full_numbers',
            processing: true,
            serverSide: true,
            filter: false,
            autoWidth:false,
            aLengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            ajax: {
                url: '<?php echo base_url('slider/ajax_list')?>',
                type: 'POST',
                data: function (data) {
                    // data.filter = {

                    // };
                    data.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
                    data.type = 'banner_produk';
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
            {'data':'title'},
            {'data':'nama_produk'},
            {'data':'url'},
            {'data':'aksi','orderable':false},
            ]
        });
    });

    function table_data(){
        dataTable.ajax.reload(null,true);
    }

     function table_data_banner_produk(){
        dataTable_banner_produk.ajax.reload(null,true);
    }

    $(".filter_status").change(function(){
        table_data();
    });

    $(".filter_berita").keyup(function(){
        table_data();
    });

    function tambah_data(){
        save_method = 'add';
        $('#add_tambah')[0].reset();
        $('.form-control').removeClass('is-invalid');
        $('.help-block').empty();
        $('.f-detail').hide();
        $('.foto_berita').removeAttr('src');
        $('#modal_tambah').modal('show');
        $('.modal-title').text('Tambah Slider');
    }

    function show_form_detail(){
        var jenis = $('#jenis').val();
        $('.f-detail').hide();
        if (jenis == 'url') {
            $('.f-url').show();
        }else if (jenis == 'produk') {
            $('.f-produk').show();
        }else if (jenis == 'umkm') {
            $('.f-umkm').show();
        }else if (jenis == 'berita') {
            $('.f-berita').show();
        }else if (jenis == 'agenda') {
            $('.f-agenda').show();
        }
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

                var form = $('#add_tambah')[0];
                var data = new FormData(form);

                if(save_method == 'add'){
                    var url = '<?php echo base_url("slider/ajax_save"); ?>';
                }else{
                    var url = '<?php echo base_url("slider/ajax_ubah"); ?>';
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
                                Swal.fire({text: obj.message,title: "",type: "success"});
                                $('#modal_tambah').modal('hide');
                                table_data();
                            }                     
                        }else {
                            for (var i = 0; i < obj.inputerror.length; i++) {
                                $('[name="'+obj.inputerror[i]+'"]').addClass('is-invalid');
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
        });
    }

    function hapus_data(id){
        Swal.fire({
          title: 'Konfirmasi',
          text: "Apakah data ini ingin dinonaktifkan?",
          type: 'question',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya',
          cancelButtonText: 'Tidak',
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url : '<?php echo site_url("slider/ajax_hapus"); ?>',
                    type: 'post',
                    data: {
                        id: id,
                        <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
                    },
                    success: function (res) {
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

    function restore_data(id){
        Swal.fire({
          title: 'Konfirmasi',
          text: "Apakah data ini ingin dinonaktifkan?",
          type: 'question',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya',
          cancelButtonText: 'Tidak',
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url : '<?php echo site_url("slider/ajax_restore"); ?>',
                    type: 'post',
                    data: {
                        id: id,
                        <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
                    },
                    success: function (res) {
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

    function ubah_data(id,jenis=null,id_jenis=null){
        $('.form-control').removeClass('is-invalid');
        $('.help-block').empty();
        $('.f-detail').hide();
        save_method = 'ubah';
        $.ajax({
            url : "<?php echo base_url('slider/ajax_data')?>",
            type: "POST",
            data : {
                id : id,
                jenis : jenis,
                id_jenis : id_jenis,
                type : 'slider',
                <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            dataType: "JSON",
            success: function(data){
                $('.foto_berita').removeAttr('src');
                $('[name="id"]').val(id);
                $('[name="title"]').val(data.title);
                $('[name="jenis"]').val(data.jenis).change();

                if (data.jenis == 'url') {
                    $('[name="url"]').val(data.url);
                }else if (data.jenis == 'produk') {
                    $('#id_produk').html('<option value="'+data.id_jenis+'#'+data.kode_jenis+'">'+data.nama_jenis+'</option>');
                }else if (data.jenis == 'umkm') {
                    $('#id_umkm').html('<option value="'+data.id_jenis+'">'+data.nama_jenis+'</option>');
                }else if (data.jenis == 'berita') {
                    $('#id_berita').html('<option value="'+data.id_jenis+'#'+data.kode_jenis+'">'+data.nama_jenis+'</option>');
                }else if (data.jenis == 'agenda') {
                   $('#id_agenda').html('<option value="'+data.id_jenis+'#'+data.kode_jenis+'">'+data.nama_jenis+'</option>');
                }

                $('.foto_berita').attr('src','<?php echo base_url('assets/images/slider/') ?>'+data.image);
                $('[name="file_berita"]').val(data.image);
                $('#modal_tambah').modal('show');
                $('#modal_tambah .modal-title').text('Ubah Slider');
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert('Error get data from ajax');
            }
        });
    }

    function ubah_data_banner_produk(id){
        $('.form-control').removeClass('is-invalid');
        $('.help-block').empty();
        save_method = 'ubah';
        $.ajax({
            url : "<?php echo base_url('slider/ajax_data')?>",
            type: "POST",
            data : {
                id : id,
                type : 'banner_produk',
                <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            dataType: "JSON",
            success: function(data){
                $('.foto_banner_produk').removeAttr('src');
                $('[name="id_banner_produk"]').val(id);
                $('[name="title"]').val(data.title);
                $('#id_produk_banner').html('<option value="'+data.id_produk+'#'+data.kode_produk+'">'+data.nama_produk+'</option>');
                $('.foto_banner_produk').attr('src','<?php echo base_url('assets/images/banner_produk/') ?>'+data.image);
                $('[name="file_banner_produk"]').val(data.image);
                $('#modal_tambah_banner_produk').modal('show');
                $('#modal_tambah_banner_produk .modal-title').text('Ubah Banner Produk');
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert('Error get data from ajax');
            }
        });
    }

    function simpan_data_banner_produk(){
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
                $('#btnSave_banner_produk').text('sedang menyimpan...'); //change button text
                $('#btnSave_banner_produk').attr('disabled',true); //set button disable
                $('.form-control').removeClass('is-invalid');
                $('.help-block').empty();

                var form = $('#add_tambah_banner_produk')[0];
                var data = new FormData(form);

                var url = '<?php echo base_url("slider/ajax_ubah"); ?>';

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
                                Swal.fire({text: obj.message,title: "",type: "success"});
                                $('#modal_tambah_banner_produk').modal('hide');
                                table_data_banner_produk();
                            }                     
                        }else {
                            for (var i = 0; i < obj.inputerror.length; i++) {
                                $('[name="'+obj.inputerror[i]+'"]').addClass('is-invalid');
                                $('[name="'+obj.inputerror[i]+'"]').next().html(obj.error_string[i]);
                            }
                            Swal.fire({type: 'warning',text: 'Proses Simpan Gagal, Silahkan Melengkapi Data Yang Harus Diisi',title : 'Perhatian !'});
                        }
                        $('#btnSave_banner_produk').text('Simpan'); //change button text
                        $('#btnSave_banner_produk').attr('disabled',false); //set button enable
                    }
                });
            }else{
                return false;
            }
        });
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
    data.append('type', 'slider');

    var request = new XMLHttpRequest();
    request.addEventListener('load', function(e) {
        document.querySelector('#upload-progress').style.display = 'none';

        if(request.response.error == 1) {
            document.querySelector('#error-message').innerText = request.response.message;
            document.querySelector('#error-message').style.display = 'block';
        }
        else if(request.response.error == 0) {
            document.querySelector('#cancel-button').click();
            $('[name="file_berita"]').val(request.response.file);
            $('.foto_berita').attr('src',request.response.url);
        }
    });
    request.upload.addEventListener('progress', function(e) {
        var percent_complete = (e.loaded / e.total)*100;
        
        document.querySelector('#upload-percentage').innerText = percent_complete;
        document.querySelector('#upload-progress').style.display = 'block';
    });
    request.responseType = 'json';
    request.open('post', '<?php echo base_url('slider/ajax_upload') ?>'); 
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
        document.querySelector('#error-message1').innerText = 'Error : Only JPEG and PNG files allowed';
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
    data.append('type', 'banner_produk');

    var request = new XMLHttpRequest();
    request.addEventListener('load', function(e) {
        document.querySelector('#upload-progress1').style.display = 'none';

        if(request.response.error == 1) {
            document.querySelector('#error-message1').innerText = request.response.message;
            document.querySelector('#error-message1').style.display = 'block';
        }
        else if(request.response.error == 0) {
            document.querySelector('#cancel-button1').click();
            $('[name="file_banner_produk"]').val(request.response.file);
            $('.foto_banner_produk').attr('src',request.response.url);
        }
    });
    request.upload.addEventListener('progress', function(e) {
        var percent_complete = (e.loaded / e.total)*100;
        
        document.querySelector('#upload-percentage1').innerText = percent_complete;
        document.querySelector('#upload-progress1').style.display = 'block';
    });
    request.responseType = 'json';
    request.open('post', '<?php echo base_url('slider/ajax_upload') ?>'); 
    request.send(data); 
});
</script>