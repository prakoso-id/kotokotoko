<script type="text/javascript">

    $('.select2').select2();

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
        url: '<?php echo base_url('slider/ajax_list')?>',
        type: 'POST',
        data: function (data) {
            data.filter = {
                'nama'      : $('.filter_berita').val(),    
                'status'     : $('.filter_status').val(), 
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
    {'data':'judul'},
    {'data':'status'},
    {'data':'aksi','orderable':false},
    ]
});

function table_data(){
    dataTable.ajax.reload(null,true);
}

$(".filter_status").change(function(){
    table_data();
});

$(".filter_berita").keyup(function(){
    delay(function(){
        table_data();
    }, 800);
});

$(".load_table").click(function(){
    table_data();
});

function tambah_data(){
    save_method = 'add';
    $('form')[0].reset();
    $('.foto_berita').removeAttr('src');
    $('.form-group').removeClass('has-error');
    $('.help').empty();
    $('#modal_tambah').modal('show');
    $('.modal-title').text('Tambah Slide');
}


    function simpan_data()
    {
        $('#btnSave').text('sedang menyimpan...'); //change button text
        $('#btnSave').attr('disabled',true); //set button disable
        $('.form-group').removeClass('has-error');
        $('.help').empty();

        var form = $('form')[0];
        var data = new FormData(form);

        if(save_method == 'add')
        {
            var url = '<?php echo base_url("slider/ajax_save"); ?>';
        }
        else{
            var url = '<?php echo base_url("slider/ajax_ubah"); ?>';
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

    function hapus_data(id)
    {
        swal({
            text: "Apakah data ini ingin dinonaktifkan?",
            title: "",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#f8ce86",
            confirmButtonText: "Iya",
            cancelButtonText: "Tidak",
            closeOnConfirm: false,
            closeOnCancel: true
        },
        function(isConfirm){
            if (isConfirm) {
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

    function restore_data(id)
    {
        swal({
            text: "Apakah data ini ingin diaktifkan?",
            title: "",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#f8ce86",
            confirmButtonText: "Iya",
            cancelButtonText: "Tidak",
            closeOnConfirm: false,
            closeOnCancel: true
        },
        function(isConfirm){
            if (isConfirm) {
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

    function ubah_data(id)
    {
        save_method = 'ubah';
        $.ajax({
            url : "<?php echo base_url('slider/ajax_data/')?>",
            type: "POST",
            data : {
                id : id,
                type : 'slider',
                <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            dataType: "JSON",
            success: function(data){
                $('.foto_berita').removeAttr('src');
                $('.form-group').removeClass('has-error');
                $('.help').empty();
                $('[name="id"]').val(id);
                $('[name="judul"]').val(data.judul);
                $('.foto_berita').attr('src','<?php echo base_url('assets/images/slider/') ?>'+data.foto);
                
                $('#modal_tambah').modal('show');
                $('#modal_tambah .modal-title').text('Ubah Slide');

            },
            error: function (jqXHR, textStatus, errorThrown){
                alert('Error get data from ajax');
            }
        });


        $('#modal_tambah').modal('show');
        $('.modal-title').text('Ubah Agenda');
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
    data.append('type', 'upload_berita');

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