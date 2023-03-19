<script type="text/javascript">

    $('.select2').select2();

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
            url: '<?php echo base_url('dasar_hukum/ajax_list')?>',
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
        ],
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
        $('.modal-title').text('Tambah Berita');
        $('.tags').html('');
        CKEDITOR.instances['pesan_keterangan'].setData('');

        $('#files').on("click",".hapus_data", function(e){
            e.preventDefault(); 
            $(this).parents('li').last().remove();
        });
    }


    function ubah_data(id)
    {
        save_method = 'edit';
        $.ajax({
            url : "<?php echo base_url('dasar_hukum/ajax_data/')?>",
            type: "POST",
            data : {
                id : id,
                type : 'dasar_hukum',
                <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            dataType: "JSON",
            success: function(data){
                $('.form-group').removeClass('has-error');
                $('.help').empty();
                $('#modal_tambah').modal('show');
                $('.modal-title').text('Ubah Dasar Hukum');
                CKEDITOR.instances['pesan_keterangan'].setData(data.keterangan);
                $('[name="id"]').val(data.id_dasar_hukum);
                $('[name="judul"]').val(data.judul);

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
                
        var form = $('form')[0];
        var data = new FormData(form);
        data.append('deskripsi',toAsci(CKEDITOR.instances['pesan_keterangan'].getData()));

        if(save_method == 'add')
        {
            var url = '<?php echo base_url("dasar_hukum/ajax_save"); ?>';
        }
        else{
            var url = '<?php echo base_url("dasar_hukum/ajax_ubah"); ?>';
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
                    url : '<?php echo site_url("dasar_hukum/ajax_hapus"); ?>',
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
                    url : '<?php echo site_url("dasar_hukum/ajax_restore"); ?>',
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

</script>