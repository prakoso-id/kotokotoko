<script type="text/javascript">
    $(document).ready(function(){
        $('[data-toggle="popover"]').popover();
        tampil_diskusi(); 
    });
    
    function login_ulasan()
    {
        swal.fire({
            title: "Perhatian",
            text: "Untuk Diskusi Produk, Harap Login Terlebih dahulu.",
            type: "error",
            confirmButtonText: "Login"
        }).then((result) => {
            if (result.value) {
                // login();
                window.location.href = "<?php echo base_url('login'); ?>";
            }
        });
    }

    function hubungi_pesan(id,id_umkm)
    {
        $.ajax({
            url : '<?php echo site_url("ajax/ajax_data"); ?>',
            type: 'post',
            data: {
                type        : 'buka_pesan',
                id_produk   : id,
                id_umkm     : id_umkm,
                <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            success: function (res) {
                var obj = JSON.parse(res);
                if(obj.status)
                {
                    $('#modal_chat').modal('show');
                    var nama = obj.umkm.namausaha;
                    $('#modal_chat .modal-title').text('TOKO '+nama.toUpperCase());
                    $('.data_pesan').empty('');
                    $('.data_pesan').load('<?=base_url('list_produk/pesan/');?>'+obj.id_group+'/'+id, function(data, status){});
                }
                else {
                    swal.fire({
                        type: 'error',
                        text: 'Pengambilan data pesan gagal, silahkan ulangi lagi',
                        title : '',
                        button: true,
                        timer: 3000
                    });
                }
                
            }
        });
    }



    function detail_chat(id_group,id=null)
    {
        $('.data_pesan').empty('');
        $('.data_pesan').load('<?=base_url('list_produk/pesan/');?>'+id_group+'/'+id+'/hapus', function(data, status){});
    }

	function simpan_diskusi(id)
    {
        $.ajax({
            url : '<?php echo site_url("ajax/ajax_save"); ?>',
            type: 'post',
            data: {
                type : 'simpan_diskusi',
                id: $('[name="id_produk"]').val(),
                pesan: $('[name="pesan_diskusi"]').val(),
                <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
            },

            success: function (res) {
                var obj = JSON.parse(res);
                if(obj.status)
                {
                    if (obj.success !== true) {
                        swal.fire({
                            text: obj.message,
                            title: "",
                            type: "error",
                            button: true,
                            timer: 1000
                        });
                    }
                    else {
                         swal.fire({
                            text: obj.message,
                            title: "",
                            type: "success",
                            button: true,
                             }).then((result) => {
                                if (result.value) {
                                    tampil_diskusi();
                                }
                           }
                        );
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
                    swal.fire({
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
    }

    function balas_diskusi(id)
    {
        <?php if(!$this->user_model->is_login()):?>
            swal.fire({
                title: "Perhatian",
                text: "Untuk membalas diskusi produk, Harap Login Terlebih dahulu.",
                type: "error",
                confirmButtonText: "Login"
            }).then((result) => {
                if (result.value) {
                    // login();
                    window.location.href = "<?php echo base_url('login'); ?>";
                }
            });
        <?php else: ?> 
            save_method = 'add';
            $('form')[0].reset();
            $('.form-group').removeClass('has-error');
            $('.help').empty();
            $('[name="id"]').val(id);
            $('#modal_tambah').modal('show');
            $('.modal-title').text('Tambah Balasan Diskusi');
        <?php endif; ?>
    }

    function simpan_data()
    {
        $('#btnSave').text('sedang menyimpan...'); //change button text
        $('#btnSave').attr('disabled',true); //set button disable
        $('.form-group').removeClass('has-error');
        $('.help').empty();
                
        var form = $('form#add_tambah')[0];
        var data = new FormData(form);

        if(save_method == 'add')
        {
            var url = '<?php echo base_url("ajax/ajax_save"); ?>';
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
                if(obj.status)
                {
                    if (obj.success !== true) {
                        swal.fire({
                            text: obj.message,
                            title: "",
                            type: "error",
                            button: true,
                            timer: 1000
                        });
                    }
                    else {
                        swal.fire({
                            text: obj.message,
                            title: "",
                            type: "success",
                            button: true,
                        }).then((result) => {
                            if (result.value) {
                                $('#modal_tambah').modal('hide');
                                tampil_diskusi();
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
                    swal.fire({
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
    }

    function tampil_diskusi()
    {
        $.ajax({
            url : '<?php echo site_url("ajax/ajax_data"); ?>',
            type: 'post',
            dataType: "html",
            data: {
                type : 'diskusi',
                id: '<?php echo $produk->id_produk; ?>',
                pemilik: '<?php echo $produk->username; ?>',
                <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            success: function (data) {
                $('.tampil_diskusi').html(data);
                $('[name="pesan_diskusi"]').val('');
            }
        });   
    }

    function hubungi_wa(nowa,text) {
        if (typeof window.orientation !== 'undefined') {
            window.open('https://api.whatsapp.com/send?phone=' + nowa + '&text='+text, '_blank');
        } else {
            window.open('https://web.whatsapp.com/send?phone=' + nowa + '&text='+text, '_blank');
        }
    }

    function copy_text(){
        $('#link_produk').show();
        /* Get the text field */
        var copyText = document.getElementById("link_produk");

        /* Select the text field */
        copyText.select();
        // copyText.setSelectionRange(0, 99999); /*For mobile devices*/

        /* Copy the text inside the text field */
        document.execCommand("copy");
        $('#link_produk').hide();

        Toast.fire({
            type : 'success',
            title: 'Tautan berhasil di salin',
            text: '',
        });
    }
</script>