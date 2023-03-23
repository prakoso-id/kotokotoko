<script type="text/javascript">
    var table;
    var table_ulasan;
    $(document).ready(function(){
        $('[data-toggle="popover"]').popover({container: 'body'});
        
        table = $('#tabel-diskusi').DataTable( {
            paginationType:'full_numbers',
            processing: true,
            serverSide: true,
            filter: false,
            autoWidth:false,
            scrollX: true,
            width:'100%',
            aLengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
            ajax: {
                url: '<?php echo base_url('list_produk/ajax_list')?>',
                type: 'POST',
                data: function (data) {
                    data.filter = {
                        'id' : '<?php echo $produk->id_produk; ?>',
                    };
                    data.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
                    data.type = 'diskusi_produk';
                    data.pemilik = '<?php echo $produk->nik; ?>';
                    data.id_umkm = '<?php echo $produk->id_umkm; ?>';
                },
            },
            language: {
                sProcessing: 'Sedang memproses...',
                sLengthMenu: 'Tampilkan _MENU_ entri',
                sZeroRecords: 'Tidak ada diskusi',
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
                {'data':'dt','orderable':false,className: "text-left"},
            ],
        });

        table_ulasan = $('#tabel-ulasan').DataTable( {
            paginationType:'full_numbers',
            processing: true,
            serverSide: true,
            filter: false,
            autoWidth:false,
            scrollX: true,
            width:'100%',
            aLengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
            ajax: {
                url: '<?php echo base_url('list_produk/ajax_list')?>',
                type: 'POST',
                data: function (data) {
                    data.filter = {
                        'id' : '<?php echo $produk->id_produk; ?>',
                    };
                    data.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
                    data.type = 'ulasan_produk';
                },
            },
            language: {
                sProcessing: 'Sedang memproses...',
                sLengthMenu: 'Tampilkan _MENU_ entri',
                sZeroRecords: 'Tidak ada diskusi',
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
                {'data':'dt','orderable':false,className: "text-left"},
            ],
        });
    });



    function add_to_chart(id,type){
        var qty = $('[name="quantity"]').val();
        var size = document.querySelector('input[name="ukuran"]:checked');
        if(size ==null){
            swal.fire({title: "Perhatian",text: 'Silahkan Pilih Ukuran ',type: "warning"});

            return

        }
        var value = size.value

        beli_chart(id,type,qty,value);
    }

    function table_data(){
        table.ajax.reload(null,true);
    }

    function table_data_ulasan(){
        table_ulasan.ajax.reload(null,true);
    }
    
    function login_ulasan()
    {
        swal.fire({
            title: "Perhatian",
            text: "Untuk menambahkan diskusi produk, harap Login terlebih dahulu !",
            type: "warning",
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
                    $('#modal_chat .last_login').text('Terakhir dilihat : '+(obj.umkm.last_login) ? obj.umkm.last_login : 'Belum pernah dilihat');
                    $('.data_pesan').empty('');
                    $('.data_pesan').load('<?=base_url('list_produk/pesan/');?>'+obj.id_group+'/'+id, function(data, status){});
                } else {
                    swal.fire({
                        type: 'error',
                        text: 'Pengambilan data pesan gagal, silahkan coba beberapa saat lagi',
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
                username_umkm: $('[name="username_umkm"]').val(),
                pesan: $('[name="pesan_diskusi"]').val(),
                <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
            },

            success: function (res) {
                var obj = JSON.parse(res);
                if(obj.status)
                {
                    if (obj.success !== true) {
                        Toast.fire({
                            type : 'error',
                            title: 'Error',
                            text: obj.message,
                        });
                    }
                    else {
                        Toast.fire({
                            type : 'success',
                            title: 'Sukses',
                            text: obj.message,
                        });

                        table_data();
                        $('[name="pesan_diskusi"]').val('');
                        $('.form-group').removeClass('has-error');
                        $('.help').empty();
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
                        text: 'Proses Simpan Gagal, Silahkan Lengkapi Data Yang Harus Diisi',
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

    function balas_diskusi(id,username_penanya)
    {
        <?php if(!$this->user_model->is_login()):?>
            swal.fire({
                title: "Perhatian",
                text: "Untuk membalas diskusi produk, harap login terlebih dahulu !",
                type: "warning",
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
            $('[name="username_penanya"]').val(username_penanya);
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
                        Toast.fire({
                            type : 'error',
                            title: 'Error',
                            text: obj.message,
                        });
                    }
                    else {
                        Toast.fire({
                            type : 'success',
                            title: 'Sukses',
                            text: obj.message,
                        });

                        $('#modal_tambah').modal('hide');
                        table_data();
                        $('[name="pesan_diskusi"]').val('');
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
                        text: 'Proses Simpan Gagal, Silahkan Lengkapi Data Yang Harus Diisi',
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
</script>