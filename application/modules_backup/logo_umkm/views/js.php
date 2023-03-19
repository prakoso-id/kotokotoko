<script>
    $('.select2').select2();
    $(".sinkron").click(function(){
        swal({
            text: "Apakah data ini ingin disimpan?",
            title: "Perhatian",
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
                    url : '<?php echo site_url("logo_umkm/ajax_ubah"); ?>',
                    type: 'post',
                    data: {
                        <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>',
                        'logo_umkm'     : $('[name="logo_umkm"]').val(),
                        'id_umkm'       :$('[name="id_umkm"]').val(),
                    },

                    success: function (res) {
                        var obj = JSON.parse(res);
                        var obj = JSON.parse(res);
                        if(obj.status)
                        {
                            if (obj.success !== true) {
                                swal({
                                    text: obj.message,
                                    title: "Perhatian!",
                                    type: "error",
                                    button: true,
                                    timer: 1000
                                });
                            }
                            else {
                                swal({
                                    text: obj.message,
                                    title: "Berhasil!",
                                    type: "success",
                                    button: true,
                                       },function(isConfirm){
                                            if (isConfirm) {
                                                 location.reload();
                                            }
                                       });
                            }
                        }
                        else {
                            for (var i = 0; i < obj.inputerror.length; i++) 
                            {
                                $('[name="'+obj.inputerror[i]+'"]').parent().parent().addClass('has-error');
                                $('[name="'+obj.inputerror[i]+'"]').next().text(obj.error_string[i]); 
                            }
                            swal({
                                type: 'error',
                                text: obj.error_string[0],
                                title : '',
                                button: true,
                                timer: 1500
                            });
                            $('#btnSave').text('Simpan'); //change button text
                            $('#btnSave').attr('disabled',false); //set button enable
                        }
                    }
                });
            }
        });
    });

    $("[name='id_umkm']").change(function(){
        if($(this).val() != 0)
        {
            $('.logo_umkm').removeAttr('style');
            $.ajax({
                url : "<?php echo base_url('logo_umkm/ajax_data/')?>",
                type: "POST",
                data : {
                    id : $(this).val(),
                    <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
                },
                dataType: "JSON",
                success: function(data){
                    if(data.foto)
                    {
                        $('.foto_berita').attr('src',data.url);
                        $('[name="logo_umkm"]').val(data.foto);
                    }else{
                         $('.foto_berita').removeAttr('src');
                         $('[name="logo_umkm"]').val('');
                    }
                },
                error: function (jqXHR, textStatus, errorThrown){
                    alert('Error get data from ajax');
                }
            });
        }else{
            $('.foto_berita').removeAttr('src');
            $('[name="logo_umkm"]').val('');
            $('.logo_umkm').attr('style','display:none');
        }
         
    });
    $.ajax({
            url : "<?php echo base_url('dashboard/ajax_data/')?>",
            type: "POST",
            data : {
                type : 'data_umkm',
                <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            dataType: "html",
            success: function(data){
                $('[name="id_umkm"]').append('<option value="0"> Pilih UMKM </option>');
                $('[name="id_umkm"]').append(data);
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert('Error get data from ajax');
            }
        });

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
            $('[name="logo_umkm"]').val(request.response.file);
            $('.foto_berita').attr('src',request.response.url);
        }
    });
    request.upload.addEventListener('progress', function(e) {
        var percent_complete = (e.loaded / e.total)*100;
        
        document.querySelector('#upload-percentage').innerText = percent_complete;
        document.querySelector('#upload-progress').style.display = 'block';
    });
    request.responseType = 'json';
    request.open('post', '<?php echo base_url('logo_umkm/ajax_upload') ?>'); 
    request.send(data); 
});

</script>