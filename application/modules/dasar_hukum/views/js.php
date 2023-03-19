<script type="text/javascript">
    $(document).ready(function() {
        $('.select2').select2();

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
    });

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

    function table_data(){
        dataTable.ajax.reload(null,true);
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
        CKEDITOR.instances['pesan_keterangan'].setData('');
        $('#modal_tambah').modal('show');
        $('.modal-title').text('Tambah Berita');
    }

    function ubah_data(id){
        save_method = 'edit';
        $.ajax({
            url : "<?php echo base_url('dasar_hukum/ajax_data')?>",
            type: "POST",
            data : {
                id : id,
                type : 'dasar_hukum',
                <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            dataType: "JSON",
            success: function(data){
                $('.form-control').removeClass('is-invalid');
                $('.help-block').empty();
                CKEDITOR.instances['pesan_keterangan'].setData(data.keterangan);
                $('[name="id"]').val(data.id_dasar_hukum);
                $('[name="judul"]').val(data.judul);
                $('#modal_tambah').modal('show');
                $('.modal-title').text('Ubah Dasar Hukum');
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
                $('#btnSave').text('sedang menyimpan...'); //change button text
                $('#btnSave').attr('disabled',true); //set button disable
                $('.form-control').removeClass('is-invalid');
                $('.help-block').empty();
                        
                var form = $('#add_tambah')[0];
                var data = new FormData(form);
                data.append('deskripsi',toAsci(CKEDITOR.instances['pesan_keterangan'].getData()));

                if(save_method == 'add'){
                    var url = '<?php echo base_url("dasar_hukum/ajax_save"); ?>';
                }else{
                    var url = '<?php echo base_url("dasar_hukum/ajax_ubah"); ?>';
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
                            Swal.fire({type: 'error',text: 'Proses Simpan Gagal, Silahkan Melengkapi Data Yang Harus Diisi',title : 'Perhatian !'});
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
                    url : '<?php echo site_url("dasar_hukum/ajax_hapus"); ?>',
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
                    url : '<?php echo site_url("dasar_hukum/ajax_restore"); ?>',
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
</script>