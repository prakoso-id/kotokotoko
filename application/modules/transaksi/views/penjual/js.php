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
                url: '<?php echo base_url('transaksi/ajax_list')?>',
                type: 'POST',
                data: function (data) {
                    data.filter = {
                        'invoice'       : $('.filter_invoice').val(),
                        'id_umkm'       : $('.filter_umkm').val(),
                        'status'        : $('.filter_status').val(),
                    };
                    data.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
                    data.type = 'penjual';
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
                {'data':'dt','orderable':false},
            ],
        });

        var id_transaksi = '<?php echo $id_transaksi; ?>';
        if (id_transaksi) {
            var submodul = '<?php echo $submodul; ?>';
            if (submodul == 'detail_transaksi') {
                detail_pesanan(id_transaksi);
            }else if (submodul == 'ulasan') {
                lihat_ulasan(id_transaksi);
            }else{
                detail_pesanan(id_transaksi);
            }
        }
    });

	function table_data(){
		dataTable.ajax.reload(null,true);
	}

	$(".filter_status").change(function(){
		table_data();
	});

    $(".filter_umkm").change(function(){
        table_data();
    });

	$(".filter_invoice").keyup(function(){
		table_data();
	});

    function detail_pesanan(id){
        $('.f_status_transaksi').hide();
        $('.f_no_resi').hide();
        $('.f_pesan_batal').hide();
        $('#btnSave').hide();
        $.ajax({
        	url : "<?php echo base_url('transaksi/ajax_lihat')?>",
        	type: "POST",
        	data : {
        		id   : id,
        		<?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>',
        		type : 'detail_pesanan',
        	},
        	dataType: "JSON",
        	success: function(data){
                if (data.status) {
                    var data = data.data;

                    console.log(data);

                    $('.nama_status').text(data.nama_status);

                    // set progres bar
                    $('.progressbar li').removeClass('done');
                    $('.progressbar li').removeClass('active');
                    $('.progressbar li').removeClass('batal');

                    if (data.id_status_transaksi == 0 || data.id_status_transaksi == 1) {
                        $('.timeline_bayar').addClass('active');
                    }else if (data.id_status_transaksi == 2) {
                        $('.timeline_bayar').addClass('done');
                        $('.timeline_proses').addClass('active');
                    }else if (data.id_status_transaksi == 3) {
                        $('.timeline_bayar').addClass('done');
                        $('.timeline_proses').addClass('done');
                        $('.timeline_kirim').addClass('active');
                    }else if (data.id_status_transaksi == 4) {
                        $('.timeline_bayar').addClass('done');
                        $('.timeline_proses').addClass('done');
                        $('.timeline_kirim').addClass('done');
                        $('.timeline_selesai').addClass('done');
                    }else if (data.id_status_transaksi == 5) {
                        var html_nama_status = data.nama_status+' <font color ="red">(<i>'+data.pesan_batal+'</i>)</font>';
                        $('.nama_status').html(DOMPurify.sanitize( html_nama_status, { SAFE_FOR_JQUERY: true } ));
                        if (data.tgl_pembayaran) {
                            $('.timeline_bayar').addClass('batal');
                        }
                        if (data.tgl_konfirmasi) {
                            $('.timeline_bayar').addClass('batal');
                            $('.timeline_proses').addClass('batal');
                        }
                        if (data.tgl_kirim) {
                            $('.timeline_bayar').addClass('batal');
                            $('.timeline_proses').addClass('batal');
                            $('.timeline_kirim').addClass('batal');
                        }
                        if (data.tgl_sampai) {
                            $('.timeline_bayar').addClass('batal');
                            $('.timeline_proses').addClass('batal');
                            $('.timeline_kirim').addClass('batal');
                            $('.timeline_selesai').addClass('batal');
                        }
                    }else if (data.id_status_transaksi == 6) {
                        var html_nama_status = data.nama_status+' <font color ="red">(<i>Pesanan telah dibatalkan secara otomatis oleh sistem karena Pembeli tidak melakukan pembayaran tepat waktu</i>)</font>';
                        $('.nama_status').html(DOMPurify.sanitize( html_nama_status, { SAFE_FOR_JQUERY: true } ));
                        $('.timeline_bayar').addClass('batal');
                        $('.timeline_proses').addClass('batal');
                    }

                    $('.timeline-tgl').text('');
                    if (data.tgl_pembayaran) {
                        $('.timeline_bayar .timeline-tgl').text(data.tgl_pembayaran);
                    }
                    if (data.tgl_konfirmasi) {
                        $('.timeline_proses .timeline-tgl').text(data.tgl_konfirmasi);
                    }
                    if (data.tgl_kirim) {
                        $('.timeline_kirim .timeline-tgl').text(data.tgl_kirim);
                    }
                    if (data.tgl_sampai) {
                        $('.timeline_selesai .timeline-tgl').text(data.tgl_sampai);
                    }
                    
            		$('[name="id"]').val(data.id_transaksi);
                    $('[name="no_invoice"]').val(data.no_invoice);
                    $('[name="username_pembeli"]').val(data.username);

            		$('.tgl_pembelian').text(data.created_at);
            		$('.inv').text(data.no_invoice);
                    var alamat = data.nama_penerima+' <br> '+data.no_penerima+' <br> '+data.alamat+' <br> KEL.'+data.nama_kel+' KEC.'+data.nama_kec+' KAB/KOTA.'+data.nama_kota+' PROP.'+data.nama_prop;
                    $('.alamat_pengiriman').html(DOMPurify.sanitize( alamat.toUpperCase(), { SAFE_FOR_JQUERY: true } ));
                    $('.kurir').text(data.nama_kurir+" ("+data.kurir_service+")");

                    //jika status sedang dikirim atau sampai tujuan
                    if(data.id_status_transaksi == 3 || data.id_status_transaksi == 4){ 
                        $('.data_resi').attr('style','display:block');
                        $('.no_resi').html(data.no_resi+'&nbsp;&nbsp;|&nbsp;&nbsp;<a href="javascript:void(0);" onclick="copy_text()"><i>Salin</i></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="javascript:void(0);" onclick="lacak_resi('+data.no_resi+',`'+data.kode_kurir+'`,`'+data.nama_kurir+'`)"><i>Lacak</i></a>');
                        $('#no_resi').val(data.no_resi);
                    }else{
                        $('.data_resi').attr('style','display:none');
                    }

                    var url_toko = '<?php echo base_url('/list-umkm/umkm/');?>'+data.kode_umkm;
                    $('.nama_toko').html(`<a target="_blank" href="`+url_toko+`" class="text-color-1">`+data.namausaha+`</a>`);
            		
                    $('.dataa-produk').html('');
                    for (var i = 0; i < data.produk.length; i++) {
                        var url_image = '<?php echo base_url('/assets/produk/');?>'+data.produk[i].id_umkm+'/'+data.produk[i].foto;
                        var url_produk = '<?php echo base_url('/list_produk/produk/');?>'+data.kode_produk[i];
                        var total = data.produk[i].harga * data.produk[i].quantity;

                        $('.dataa-produk').append(`
                            <div class="row" style="margin-bottom:20px;">
                                <div class="col-md-8" style="margin-bottom:10px;">
                                    <div class="row">
                                        <div class="foto_produk col-md-3 col-sm-3 col-xs-3" style="background:url(`+url_image+`);">
                                        </div>
                                        <div class="col-md-9 col-sm-9 col-xs-9">
                                            <a target="_blank" href="`+url_produk+`" class="text-color-1" style="font-weight: 700;">`+data.produk[i].nama_produk+`</a>
                                            <br>
                                            <span>`+data.produk[i].quantity+` Produk (`+data.produk[i].jumlah_berat+` kg) x Rp. `+format_uang(data.produk[i].harga)+`</span>
                                            <br>
                                            <span style="color:red;">Catatan : <i>`+((data.produk[i].catatan) ? data.produk[i].catatan : '')+`</i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4" style="margin-bottom:10px;">
                                    <span style="font-weight: 700;">Harga Barang</span> <br>
                                    <span style="font-size:16px; font-weight: 700;" class="text-color-2">Rp. `+format_uang(total)+`</span>
                                </div>
                            </div>
                        `);
                    }

                    $('.total_barang').text('('+data.produk.length+' Barang)');
                    $('.total_harga').text("Rp. "+format_uang(data.total_harga));
                    $('.total_berat').text('('+data.total_berat+' kg)');
                    $('.total_ongkir').text("Rp. "+format_uang(data.ongkir));
                    $('.total_bayar').text("Rp. "+format_uang(data.total));

                    $('.tgl_pembayaran').text(data.tgl_pembayaran);
                    if (data.bukti_pembayaran) {
                        var html_bukti_pembayaran = `<img src="<?php echo base_url(); ?>assets/bukti_pembayaran/`+data.bukti_pembayaran+`" alt="File Bukti Pembayaran" width="100%">`;
                        $('.bukti_pembayaran').html(DOMPurify.sanitize( html_bukti_pembayaran, { SAFE_FOR_JQUERY: true } ));
                    }else{
                        $('.bukti_pembayaran').html('-');
                    }

                    //jika status menunggu konfirmasi atau sedang diproses maka munculkan form untuk ubah status
                    if (data.id_status_transaksi == 1 || data.id_status_transaksi == 2) {
                        console.log('wow');
                        $('.f_status_transaksi').show();
                        get_m_status_transaksi(data.id_status_transaksi);
                        $('#btnSave').show();
                    }

                    $('#modal_data').modal('show');
                    $('#modal_data .modal-title').text('Detail Transaksi');
                }else{
                    Swal.fire({title: "Opps..",text: "Data tidak ditemukan !",type: "error"});
                }
        	},
        	error: function (jqXHR, textStatus, errorThrown){
        		alert('Error get data from ajax');
        	}
        });
	}

    function get_m_status_transaksi(id){
        $.ajax({
            url : "<?php echo base_url('transaksi/ajax_data')?>",
            type: "POST",
            data : {
                id   : id,
                <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>',
                type : 'status_transaksi',
            },
            dataType: "html",
            success: function(hasil){
                $('[name="status_transaksi"]').html(DOMPurify.sanitize( hasil, { SAFE_FOR_JQUERY: true } ));
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert('Error get data from ajax');
            }
        });
    }

	$("[name='status_transaksi']").change(function(){
		var id = $(this).val();
		if(id == 3){ //jika sedang dikirim maka tampilkan form input no resi
			$('.f_no_resi').show();
		}else{
			$('.f_no_resi').hide();
		}

        if (id == 5) {
            $('.f_pesan_batal').show();
        }else{
            $('.f_pesan_batal').hide();
        }
	});

	function simpan_data(){
        Swal.fire({
          title: 'Konfirmasi',
          text: "Apakah Data ini Ingin Di Simpan?",
          type: 'question',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya',
          cancelButtonText: 'Tidak',
        }).then((result) => {
            if (result.value) {
                $('#loading').show();
                $('#btnSave').text('sedang menyimpan...'); //change button text
                $('#btnSave').attr('disabled',true); //set button disable
                $('.form-group').removeClass('is-invalid');
                $('.help-block').empty();
                        
                var form = $('#add_data')[0];
                var data = new FormData(form);
                var url = '<?php echo base_url("transaksi/ajax_save"); ?>';

                $.ajax({
                    url: url,
                    type: 'post',
                    data: data,
                    processData:false,
                    contentType:false,
                    cache:false,
                    async:false,
                    success: function (res) {
                        $('#loading').hide();
                        var obj = JSON.parse(res);
                        if(obj.status){
                            if (obj.success !== true) {
                                Swal.fire({text: obj.message,title: "Opps..",type: "error"});
                            }else {
                                Swal.fire({text: obj.message,title: "Sukses",type: "success"});
                                $('#modal_data').modal('hide');
                                table_data();
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
                    },
                    error: function (jqXHR, textStatus, errorThrown){
                        $('#loading').hide();
                        alert('Error get data from ajax');
                    }
                });
            }else{
                return false;
            }
        });
	}

    function lihat_ulasan(id){
        $.ajax({
            url : "<?php echo base_url('transaksi/ajax_lihat')?>",
            type: "POST",
            data : {
                id   : id,
                <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>',
                type : 'ratting_ulasan',
            },
            dataType: "JSON",
            success: function(data){
                var toko = data.namausaha;
                $('.logo_toko').text(toko.substring(0, 1));
                $('.nama_toko').text(toko);
                $('.alamat_toko').text(data.nama_kel);
                ulasan_list_produk(data.id_transaksi);
                rating_toko(id);
                $('#modal_ulasan').modal('show');
                $('#modal_ulasan .modal-title').text('Detail Ulasan');
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert('Error get data from ajax');
            }
        });
    }

    function ulasan_list_produk(id_transaksi){
        $.ajax({
            url : "<?php echo base_url('transaksi/ajax_lihat')?>",
            type: "POST",
            data : {
                <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>',
                type : 'view_ulasan',
                id   : id_transaksi,
            },
            dataType: "html",
            success: function(data){
                $('#ulasan-tampil').html(DOMPurify.sanitize( data, { SAFE_FOR_JQUERY: true } ));
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert('Error get data from ajax');
            }
        });
    }

    function rating_toko(id){
        $.ajax({
            url : "<?php echo base_url('transaksi/ajax_lihat')?>",
            type: "POST",
            data : {
                id   : id,
                <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>',
                type : 'data_ratting',
            },
            dataType: "JSON",
            success: function(data){
                var ratting_toko = data.ratting_toko * 20;
                $('.data_toko').attr('style','width : '+ratting_toko+'%');
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert('Error get data from ajax');
            }
        });
    }

    function hubungi_pesan(id,id_umkm){
        $.ajax({
            url : '<?php echo site_url("ajax/ajax_data"); ?>',
            type: 'post',
            data: {
                type  : 'buka_pesan',
                id_transaksi : id,
                id_umkm : id_umkm,
                <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            success: function (res) {
                var obj = JSON.parse(res);
                if(obj.status){
                    $('#modal_chat').modal('show');
                    $('#modal_chat .modal-title').text('KIRIM PESAN');
                    $('.data_pesan').empty('');
                    $('.data_pesan').load('<?=base_url('transaksi/pesan/');?>'+obj.id_group+'/'+id, function(data, status){});
                }else {
                    Swal.fire({type: 'error',text: 'Pengambilan data pesan gagal, silahkan ulangi lagi',title : 'Opps..'});
                }
                
            }
        });
    }

    function kirim_pesan(id_group) {
        $.ajax({
            url : "<?php echo base_url('ajax/ajax_save/')?>",
            type: "POST",
            data : {
                type : 'simpan_pesan',
                <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>',
                id_transaksi : $('[name="id_transaksi_pesan"]').val(),
                username : $('[name="username"]').val(),
                pesan : $('[name="pesan_chat"]').val(),
                id_group : id_group,
            },
            dataType: "JSON",
            success: function(data){
                if(data.status){
                    detail_chat(id_group,data.id_produk,'hapus');
                    $('[name="id_transaksi_pesan"]').val();
                }else{
                    Swal.fire({title: "Perhatian",text: "Pesan tidak boleh kosong",type: "warning"});
                }
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert('Error get data from ajax');
            }
        });
    }

    function hapus(){
        $('.produk_preview_hapus').empty('');
        $('[name="id_transaksi_pesan"]').val()
    }

    function detail_chat(id_group,id=null){
        $('.data_pesan').empty('');
        $('.data_pesan').load('<?=base_url('transaksi/pesan/');?>'+id_group+'/'+id+'/hapus', function(data, status){});
    }
</script>