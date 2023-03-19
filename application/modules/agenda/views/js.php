<script type="text/javascript">
    $(document).ready(function(){
        $('.select2').select2();

        $('#tanggal').datepicker({
          autoclose: true,
          format: 'yyyy-mm-dd',
          endDate: new Date()
        });

        dataTable = $('.tabel').DataTable( {
            paginationType:'full_numbers',
            processing: true,
            serverSide: true,
            filter: false,
            autoWidth:false,
            aLengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            ajax: {
                url: '<?php echo base_url('agenda/ajax_list')?>',
                type: 'POST',
                data: function (data) {
                    data.filter = {
                        'nama'      : $('.filter_agenda').val(),    
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
                {'data':'foto'},
                {'data':'judul'},
                {'data':'lokasi'},
                {'data':'tanggal'},
                {'data':'aksi','orderable':false},
            ],
        });
    });

    function toAsci(data){
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
   });

    function table_data(){
        dataTable.ajax.reload(null,true);
    }

    $(".filter_status").change(function(){
        table_data();
    });

    $(".filter_agenda").keyup(function(){
        table_data();
    });

    function tambah_data(){
        save_method = 'add';
        $('#add_tambah')[0].reset();
        $('.foto_berita').removeAttr('src');
        $('.form-group').removeClass('is-invalid');
        $('.help-block').empty();
        $('#modal_tambah').modal('show');
        $('.modal-title').text('Tambah Agenda');
        CKEDITOR.instances['pesan_keterangan'].setData('');

        $('#maps').empty('');
        $('#maps').load('<?=base_url('customer/umkm/maps');?>', function(data, status) 
            {
                //$("#loading-overlay").hide();         
            }
        );
    }

    function ubah_data(id){
        save_method = 'ubah';
        $.ajax({
            url : "<?php echo base_url('agenda/ajax_data')?>",
            type: "POST",
            data : {
                id : id,
                type : 'agenda',
                <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            dataType: "JSON",
            success: function(data){
                $('.foto_berita').removeAttr('src');
                $('.form-group').removeClass('is-invalid');
                $('.help-block').empty();
                
                CKEDITOR.instances['pesan_keterangan'].setData(data.keterangan);
                $('[name="file_berita"]').val(data.foto);
                $('[name="id"]').val(data.id_agenda);
                $('[name="judul"]').val(data.judul);
                $('.foto_berita').attr('src','<?php echo base_url('assets/images/agenda/') ?>'+data.foto);
                $('[name="tanggal"]').val(data.tanggal);
                $('[name="lat"]').val(data.lat);
                $('[name="long"]').val(data.long);
                $('#maps').empty('');
                $('#maps').load('<?=base_url('customer/umkm/maps');?>', function(data, status) 
                    {
                        //$("#loading-overlay").hide();         
                    }
                );
                $('[name="alamat"]').val(data.lokasi);

                $('#modal_tambah').modal('show');
                $('.modal-title').text('Ubah Agenda');
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert('Error get data from ajax');
            }
        });
    }

    function refresh_page(){
        location.reload();
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
                data.append('deskripsi',toAsci(CKEDITOR.instances['pesan_keterangan'].getData()));

                if(save_method == 'add'){
                    var url = '<?php echo base_url("agenda/ajax_save"); ?>';
                }else{
                    var url = '<?php echo base_url("agenda/ajax_ubah"); ?>';
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
                                Swal.fire({text: obj.message,title: "Opps..",type: "error" });
                            }else {
                                Swal.fire({text: obj.message,title: "Sukses",type: "success",
                                }).then((result) => {
                                    $('#modal_tambah').modal('hide');
                                    refresh_page();
                                });
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
                    url : '<?php echo site_url("agenda/ajax_hapus"); ?>',
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
          text: "Apakah data ini ingin diaktifkan?",
          type: 'question',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya',
          cancelButtonText: 'Tidak',
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url : '<?php echo site_url("agenda/ajax_restore"); ?>',
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
        request.open('post', '<?php echo base_url('agenda/ajax_upload') ?>'); 
        request.send(data); 
    });
</script>