<script type="text/javascript">
    var table;
    $(document).ready(function(){
        $('.select2').select2();

        var $inp = $('.rating-input');
        window.x = null; // setinterval countdown timer
            
        $inp.rating({
                min: 0,
                max: 5,
                step: 1,
                size: 'sm',
                showClear: false
            });

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
                        'nama'          : $('.filter_nama').val(),
                        'status'        : $('.filter_status').val(),
                    };
                    data.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
                    data.type = 'customer';
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

        var post_id_transaksi = '<?php echo $id_transaksi; ?>';
        var submodul = '<?php echo $submodul; ?>';
        if (post_id_transaksi) {
            if (submodul == 'detail_transaksi') {
                detail_pesanan(post_id_transaksi);
            }
        }

        var post_va = '<?php echo $va; ?>';
        if (post_va) {
            if (submodul == 'detail_transaksi_va_belum_bayar') {
                detail_pesanan_belum_bayar_va(post_va);
            }
        }

        var id_transaksi = '<?php echo $this->session->flashdata('id_transaksi'); ?>';
        var no_virtual_acount = '<?php echo $this->session->flashdata('no_virtual_acount'); ?>';
        if (id_transaksi || no_virtual_acount) {
            lihat_pembayaran(id_transaksi,no_virtual_acount,'checkout');
        }
    });

	function table_data(){
		dataTable.ajax.reload(null,true);
	}

	$(".filter_nama").keyup(function(){
        table_data();
	});

	$(".filter_invoice").keyup(function(){
        table_data();
	});

    $(".load_table").click(function(){
        table_data();
    });

    function detail_pesanan(id){
        $('.simpan_data').html('');
        $('.perintah_pembayaran').hide();
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
                    clearInterval(x); // biar countdown timer ngga bentrok
                    var data = data.data;
                    if (data.id_status_transaksi == 0) {
                        $('.perintah_pembayaran').show();

                        var now = new Date().getTime();
                        var created = new Date(data.created_at_datetime);
                        var tomorrow = new Date(created);
                        tomorrow = tomorrow.setDate(tomorrow.getDate() + 1);

                        if (now < tomorrow) {
                            $('.batas_waktu_pembayaran').html(`<i class="fa fa-clock-o"></i> <span class="countdown" data-time="`+tomorrow+`">00 : 00 : 00</span>`);
                            var time_pembayaran = $('.countdown');
                            countdown(time_pembayaran.data('time'));
                        }else{
                            $('.batas_waktu_pembayaran').text(`Sudah Habis`);
                        }
                    }

                    if (data.tgl_kirim != null && data.tgl_sampai == null) {
                        $('.estimasi_pengiriman').show();
                        var now = new Date().getTime();
                        var created = new Date(data.tgl_kirim2);
                        var tomorrow = new Date(created);
                        tomorrow = tomorrow.setDate(tomorrow.getDate() + 3);

                        if (now < tomorrow) {
                            $('.estimasi_waktu_pengiriman').html(`<i class="fa fa-clock-o"></i> <span class="countdown_pengiriman" data-time="`+tomorrow+`">00 : 00 : 00</span>`);
                            var estimasi_sampai = $('.countdown_pengiriman');
                            countdown(estimasi_sampai.data('time'));
                        } else {
                            $('.estimasi_waktu_pengiriman').html('Pesanan sudah sampai.');
                        }
                    } else {
                        $('.estimasi_pengiriman').hide();
                    }


                    if (data.metode_bayar == 'bank_transfer') {
                        $('.detail_pembayaran').show();
                        if (data.pembayaran.no_rekening) {
                            $('.nama_bank').text(data.pembayaran.nama_bank);
                            $('.an_rekening').text(data.pembayaran.an_rekening.toUpperCase());
                            $('.no_rekening').text(data.pembayaran.no_rekening);
                        }else{
                            $('.nama_bank').text('');
                            $('.an_rekening').text('');
                            $('.no_rekening').text('');
                        }
                        $('.total_pembayaran').text('Rp. '+format_uang(data.pembayaran.total));
                    }else{
                        $('.detail_pembayaran').hide();
                    }

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
                    $('[name="username_umkm"]').val(data.username_umkm);

                    if (data.id_status_transaksi == 5) {
                        var sts = data.nama_status+' <font color="red">(<i>'+data.pesan_batal+'</i>)</font>';
                    }else if (data.id_status_transaksi == 6) {
                        var sts = data.nama_status+' <font color ="red">(<i>Pesanan telah dibatalkan secara otomatis oleh sistem karena Pembeli tidak melakukan pembayaran tepat waktu</i>)</font>';
                    }else{
                        var sts = data.nama_status;
                    }

            		$('.nama_status').html(sts);
            		$('.tgl_pembelian').text(data.created_at);
            		$('.invoice').text(data.no_invoice);
                    var alamat = 'Dikirim kepada <b>'+data.nama_penerima+'</b> <br>'+data.alamat+' <br> Kel.'+data.nama_kel+' Kec.'+data.nama_kec+' Kab/Kota.'+data.nama_kota+' Prop.'+data.nama_prop+'<br> Telp. '+data.no_penerima;
                    $('.alamat_pengiriman').html(DOMPurify.sanitize( alamat, { SAFE_FOR_JQUERY: true } ));
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
                                <div class="col-md-6" style="margin-bottom:10px;">
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
                                <div class="col-md-2">
                                    <a class="btn btn-block btn-gradient-2" style="margin-bottom:10px;" target="_blank" href="`+url_produk+`">Beli Lagi</a>
                                </div>
                            </div>
                        `);
                    }

                    $('.total_barang').text('('+data.produk.length+' Barang)');
                    $('.total_harga').text("Rp. "+format_uang(data.total_harga));
                    $('.total_berat').text('('+data.total_berat+' kg)');
                    $('.total_ongkir').text("Rp. "+format_uang(data.ongkir));
                    $('.total_bayar').text("Rp. "+format_uang(data.total));

                    if (data.id_status_transaksi == 0) { //jika status menunggu pembayaran
                        $('.simpan_data').html('<button type="button" class="btn btn-gradient-1" onclick="upload_bukti_bayar('+data.id_transaksi+')"> Upload Bukti Pembayaran</button>');
                    }else if(data.id_status_transaksi == 3){ //jika status sedang dikirim
            			$('.simpan_data').html('<button type="button" class="btn btn-gradient-1" id="btnSaveSampai" onclick="simpan_data()"> Pesanan sudah sampai</button>');
            		}else if(data.id_status_transaksi == 4){ //jika status sudah sampai tujuan
                        cek_ulasan(data.id_transaksi);
            		}

                    $('.btn-tanya').attr('onclick', 'hubungi_pesan('+id+','+data.id_umkm+')');
                    
                    $('#modal_data').modal('show');
                    $('#modal_data .modal-title').text('Detail Pembelian'); 
                }else{
                    Swal.fire({title: "Opps..",text: "Data tidak ditemukan !",type: "error"});
                }
        	},
        	error: function (jqXHR, textStatus, errorThrown){
        		alert('Error get data from ajax');
        	}
        });
	}

    function detail_pesanan_belum_bayar_va(va) {
        $.ajax({
            url : "<?php echo base_url('transaksi/ajax_lihat')?>",
            type: "POST",
            data : {
                va   : va,
                <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>',
                type : 'detail_pesanan_belum_bayar_va',
            },
            dataType: "JSON",
            success: function(data){
                if (data.status) {
                    var data = data.data;
                    // set progres bar
                    $('.progressbar li').removeClass('done');
                    $('.progressbar li').removeClass('active');
                    $('.progressbar li').removeClass('batal');

                    $('.timeline_bayar').addClass('active');

                    $('.timeline-tgl').text('');

                    var now = new Date().getTime();
                    var expired = new Date(data.expired_virtual_account).getTime();
                    if (now < expired) {
                        $('.batas_waktu_pembayaran_va').html(`<i class="fa fa-clock-o"></i> <span class="countdown" data-time="`+expired+`">00 : 00 : 00</span>`);
                        var time_pembayaran = $('.countdown');
                        countdown(time_pembayaran.data('time'));
                    }else{
                        $('.batas_waktu_pembayaran_va').text(`Sudah Habis`);
                    }

                    $('.tgl_pembelian').text(data.created_at);
                    $('.no_va').text(data.va_full);
                    $('.total_pembayaran').text("Rp. "+format_uang(data.total_bayar));

                    $('.dataa-produk').html('');
                    $.each(data.transaksi, function(i, t) {
                        var url_umkm = '<?php echo base_url();?>toko/'+t.kode_umkm;
                        $('.dataa-produk').append(`<div class="row">
                            <div class="col-md-12">
                                <a target="_blank" href="`+url_umkm+`" class="text-color-1" style="font-weight: 800;">`+t.namausaha+`</a>
                                <a class="btn btn-default" href="javascript:void(0);" onclick="hubungi_pesan(`+t.id_transaksi+`,`+t.id_umkm+`)"  style="float: right;"><i class="fa fa-comments"></i> Tanya Penjual</a>
                            </div>
                        </div><hr>`);

                        $.each(data.produk[t.id_transaksi], function(j, p) {
                            var url_image = '<?php echo base_url('/assets/produk/');?>'+p.id_umkm+'/'+p.foto;
                            var url_produk = '<?php echo base_url('/list_produk/produk/');?>'+data.kode_produk[p.id_produk];

                            var jum_harga_barang = p.harga * p.quantity;
                            $('.dataa-produk').append(`
                            <div class="row">
                                <div class="col-md-8" style="margin-bottom:10px;">
                                    <div class="row">
                                        <div class="foto_produk col-md-3 col-sm-3 col-xs-3" style="background:url(`+url_image+`);">
                                        </div>
                                        <div class="col-md-9 col-sm-9 col-xs-9">
                                            <a target="_blank" href="`+url_produk+`" class="text-color-1" style="font-weight: 700;">`+p.nama_produk+`</a>
                                            <br>
                                            <span>`+p.quantity+` Produk (`+p.jumlah_berat+` kg) x Rp. `+format_uang(p.harga)+`</span>
                                            <br>
                                            <span style="color:red;">Catatan : <i>`+((p.catatan) ? p.catatan : '')+`</i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4" style="margin-bottom:10px; text-align:right;">
                                    <span><b>Rp. `+format_uang(jum_harga_barang)+`</b></span>
                                </div>
                            </div><hr>`);
                        });

                        $('.dataa-produk').append(`<div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered" width="100%" style="text-align:right;">
                                    <tr>
                                        <td width="70%">Subtotal harga barang</td>
                                        <td width="30%">Rp. `+format_uang(t.total_harga)+`</td>
                                    </tr>
                                    <tr>
                                        <td>Ongkos Kirim</td>
                                        <td>Rp. `+format_uang(t.ongkir)+`</td>
                                    </tr>
                                    <tr>
                                        <td>Total Pesanan</td>
                                        <td><span style="font-size:16px; font-weight: 700;" class="text-color-2">Rp. `+format_uang(t.total)+`</span></td>
                                    </tr>
                                </table>
                            </div>
                        </div>`);
                    });

                    $('.dataa-produk').append(`<div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered" width="100%" style="text-align:right;">
                                <tr>
                                    <td width="70%">Total Pesanan</td>
                                    <td width="30%"><span style="font-size:18px; font-weight: 700;" class="text-color-1">Rp. `+format_uang(data.total_bayar)+`</span></td>
                                </tr>
                            </table>
                        </div>
                    </div>`);

                    var alamat = 'Dikirim kepada <b>'+data.nama_penerima+'</b> <br>'+data.alamat+' <br> Kel.'+data.nama_kel+' Kec.'+data.nama_kec+' Kab/Kota.'+data.nama_kota+' Prop.'+data.nama_prop+'<br> Telp. '+data.no_penerima;
                    $('.alamat_pengiriman').html(DOMPurify.sanitize( alamat, { SAFE_FOR_JQUERY: true } ));

                    $('.btn-bayar-sekarang').click(function (e) {
                        lihat_pembayaran(null,data.va_full);
                    });

                    $('#modal_data_va').modal('show');
                    $('#modal_data_va .modal-title').text('Detail Pembelian'); 
                }else{
                    Swal.fire({title: "Opps..",text: "Data tidak ditemukan !",type: "error"});
                }
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert('Error get data from ajax');
            }
        });
    }

    function cek_ulasan(id,tipe=null){
        $.ajax({
            url : "<?php echo base_url('transaksi/ajax_lihat')?>",
            type: "POST",
            data : {
                id   : id,
                <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>',
                type : 'data_ratting',
            },
            dataType: "JSON",
            success: function(hasil){
                if (tipe == null) {
                    if(!hasil){
                        $('.simpan_data').html('<button type="button" class="btn btn-gradient-1" onclick="tambah_ulasan('+id+')"> Tambah Ulasan</button>'); 
                    } 
                }else if (tipe == 'ratting_toko') {
                    var ratting_toko = hasil.ratting_toko * 20;
                    $('.data_toko').attr('style','width : '+ratting_toko+'%');
                }
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert('Error get data from ajax');
            }
        });
    }

	function simpan_data(){
        Swal.fire({
          title: 'Konfirmasi',
          text: "Apakah pesanan sudah sampai?",
          type: 'question',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya',
          cancelButtonText: 'Tidak',
        }).then((result) => {
            if (result.value) {
                $('#loading').show();
                var id = $('[name="id"]').val();
                $('#btnSaveSampai').text('sedang menyimpan...'); //change button text
                $('#btnSaveSampai').attr('disabled',true); //set button disable
                $('.form-group').removeClass('has-error');
                $('.help').empty();
                        
                var form = $('#add_modal')[0];
                var data = new FormData(form);
                var url = '<?php echo base_url("transaksi/ajax_save"); ?>';

                $.ajax({
                    url: url,
                    type: 'post',
                    data: data,
                    processData:false,
                    contentType:false,
                    cache:false,
                    success: function (res) {
                        $('#loading').hide();
                        var obj = JSON.parse(res);
                        if(obj.status){
                            if (obj.success !== true) {
                                Swal.fire({text: obj.message,title: "Error",type: "error"});
                            }else {
                                Swal.fire({text: obj.message,title: "Sukses",type: "success"});
                                $('#modal_data').modal('hide');
                                table_data();
                            }
                        }else {
                            for (var i = 0; i < obj.inputerror.length; i++) {
                                $('[name="'+obj.inputerror[i]+'"]').parent().parent().addClass('has-error');
                                $('[name="'+obj.inputerror[i]+'"]').next().text(obj.error_string[i]); 
                            }
                            Swal.fire({type: 'error',text: 'Proses Simpan Gagal, Silahkan Lengkapi Data Yang Harus Diisi',title : 'Opps..',});
                        }

                        $('#btnSaveSampai').text('Pesanan sudah sampai'); //change button text
                        $('#btnSaveSampai').attr('disabled',false); //set button enable
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

	function tambah_ulasan(id)
	{
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
                $('[name="id_transaksi"]').val(data.id_transaksi);
                $('[name="id_umkm"]').val(data.id_umkm);
                $('[name="username_umkm"]').val(data.username_umkm);
                var toko = data.namausaha;
                $('.logo_toko').text(toko.substring(0, 1));
                $('.nama_toko').text(toko);
                $('.alamat_toko').text(data.nama_kel);

                ulasan_list_produk(data.id_transaksi,'tambah_ulasan');

                $('#modal_tambah').modal('show');
                $('#modal_tambah .modal-title').text('Tambah Ulasan');
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert('Error get data from ajax');
            }
        });
	}

    function ulasan_list_produk(id_transaksi,type){
        $.ajax({
            url : "<?php echo base_url('transaksi/ajax_lihat')?>",
            type: "POST",
            data : {
                <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>',
                type : type,
                id   : id_transaksi,
            },
            dataType: "html",
            success: function(data){
                if (type == 'tambah_ulasan') {
                    $('#ulasan-produk').html(DOMPurify.sanitize( data, { SAFE_FOR_JQUERY: true } ));
                    var $inpn = $('.rating-produk');
                    $inpn.rating({
                        min: 0,
                        max: 5,
                        step: 1,
                        size: 'sm',
                        showClear: false
                    });
                }else{
                    $('#ulasan-tampil').html(DOMPurify.sanitize( data, { SAFE_FOR_JQUERY: true } ));
                }
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert('Error get data from ajax');
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

                ulasan_list_produk(data.id_transaksi,'view_ulasan');
                cek_ulasan(id,'ratting_toko');

                $('#modal_ulasan').modal('show');
                $('#modal_ulasan .modal-title').text('Detail Ulasan');
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert('Error get data from ajax');
            }
        });
    }

    function simpan_ulasan(){
        Swal.fire({
          title: 'Konfirmasi Simpan',
          text: "Apakah data yang disimpan sudah benar?",
          type: 'question',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya',
          cancelButtonText: 'Tidak',
        }).then((result) => {
            if (result.value) {
                $('#loading').show();
                var id = $('[name="id_transaksi_detail"]').val();
                $('#btnSaveUlasan').text('sedang menyimpan...'); //change button text
                $('#btnSaveUlasan').attr('disabled',true); //set button disable
                $('.form-group').removeClass('has-error');
                $('.help').empty();
                        
                var form = $('#add_tambah')[0];
                var data = new FormData(form);
                var url = '<?php echo base_url("transaksi/ajax_save"); ?>';

                $.ajax({
                    url: url,
                    type: 'post',
                    data: data,
                    processData:false,
                    contentType:false,
                    cache:false,
                    success: function (res) {
                        $('#loading').hide();
                        var obj = JSON.parse(res);
                        if(obj.status){
                            if (obj.success !== true) {
                                Swal.fire({text: obj.message,title: "Error",type: "error"});
                            }else {
                                Swal.fire({text: obj.message,title: "Sukses",type: "success"});
                                $('#modal_data').modal('hide');
                                $('#modal_tambah').modal('hide');
                                table_data();
                            }
                        }else {
                            for (var i = 0; i < obj.inputerror.length; i++) 
                            {
                                $('[name="'+obj.inputerror[i]+'"]').parent().parent().addClass('has-error');
                                $('[name="'+obj.inputerror[i]+'"]').next().text(obj.error_string[i]); 
                            }
                            Swal.fire({type: 'error',text: 'Proses Simpan Gagal, Silahkan Lengkapi Data Yang Harus Diisi',title : 'Opps..',
                            });
                        }

                        $('#btnSaveUlasan').text('Simpan'); //change button text
                        $('#btnSaveUlasan').attr('disabled',false); //set button enable
                    },
                    error: function (jqXHR, textStatus, errorThrown){
                        $('#loading').hide();
                        alert('Error get data from ajax');
                    }
                });
            }else{
                return false;
            }
        })
    }

    function hubungi_pesan(id,id_umkm)
    {
        $.ajax({
            url : '<?php echo site_url("ajax/ajax_data"); ?>',
            type: 'post',
            data: {
                type        : 'buka_pesan',
                id_transaksi: id,
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
                    $('#modal_chat .last_login').text('Terakhir dilihat : '+obj.umkm.last_login);
                    $('.data_pesan').empty('');
                    $('.data_pesan').load('<?=base_url('transaksi/pesan/');?>'+obj.id_group+'/'+id, function(data, status){});
                }
                else {
                    Swal.fire({type: 'error',text: 'Pengambilan data pesan gagal, silahkan ulangi lagi',title : 'Error'});
                }
            }
        });
    }

    function kirim_pesan(id_group) {
        $.ajax({
            url : "<?php echo base_url('ajax/ajax_save')?>",
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
                if(data.status)
                {
                    detail_chat(id_group,data.id_produk,'hapus');
                    $('[name="id_transaksi_pesan"]').val('');
                }else{
                    Swal.fire({title: "Perhatian",text: "Pesan tidak boleh kosong",type: "warning",});
                }
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert('Error get data from ajax');
            }
        });
    }

    function hapus(){
        $('.produk_preview_hapus').empty('');
        $('[name="id_transaksi_pesan"]').val('');
    }

    function detail_chat(id_group,id=null)
    {
        $('.data_pesan').empty('');
        $('.data_pesan').load('<?=base_url('transaksi/pesan/');?>'+id_group+'/'+id+'/hapus', function(data, status){});
    }

    function upload_bukti_bayar(id_transaksi){
        $('[name="file_bukti_bayar"]').val('');
        $('[name="nama_file_bukti_bayar"]').val('');
        $('.preview-upload-file-bukti-bayar').empty();
        $.ajax({
            url : "<?php echo base_url('transaksi/ajax_lihat/')?>",
            type: "POST",
            data : {
                id   : id_transaksi,
                <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>',
                type : 'detail_pembayaran',
            },
            dataType: "JSON",
            success: function(data){
                $('[name="id_transaksi"]').val(id_transaksi);
                $('[name="no_invoice"]').val(data.no_invoice);
                $('[name="username_umkm"]').val(data.username);
                if (data.no_rekening) {
                    $('.nama_bank').text(data.nama_bank);
                    $('.an_rekening').text(data.an_rekening.toUpperCase());
                    $('.no_rekening').text(data.no_rekening);
                }else{
                    $('.nama_bank').text('');
                    $('.an_rekening').text('');
                    $('.no_rekening').text('');
                }
                
                $('.total_pembayaran').text('Rp. '+format_uang(data.total));
                $('#modal_upload_bukti_bayar').modal('show');
                $('#modal_upload_bukti_bayar .modal-title').text('Upload Bukti Pembayaran');
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert('Error get data from ajax');
            }
        });
    }

    function simpan_bukti_bayar(){
        Swal.fire({
          title: 'Konfirmasi Simpan',
          text: "Apakah ingin menyimpan bukti pembayaran ? Pastikan file yang anda upload sudah benar.",
          type: 'question',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya',
          cancelButtonText: 'Tidak',
        }).then((result) => {
            if (result.value) {
                $('#btnSaveBuktiBayar').text('sedang menyimpan...'); //change button text
                $('#btnSaveBuktiBayar').attr('disabled',true); //set button disable
                $('.form-group').removeClass('has-error');
                $('.help').empty();

                var form = $('#form_upload_bukti_bayar')[0];
                var data = new FormData(form);
                var url = '<?php echo base_url("transaksi/ajax_save"); ?>';

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
                                Swal.fire({text: obj.message,title: "Error",type: "error"});
                            }else {
                                Swal.fire({text: obj.message,title: "",type: "success"});
                                $('#modal_data').modal('hide');
                                $('#modal_upload_bukti_bayar').modal('hide');
                                table_data();
                            }
                        }else {
                            for (var i = 0; i < obj.inputerror.length; i++) 
                            {
                                $('[name="'+obj.inputerror[i]+'"]').parent().parent().addClass('has-error');
                                $('[name="'+obj.inputerror[i]+'"]').next().text(obj.error_string[i]); 
                            }
                            Swal.fire({type: 'error',text: 'Proses Simpan Gagal, Silahkan Melengkapi Data Yang Harus Diisi',title : 'Opps..'});
                        }

                        $('#btnSaveBuktiBayar').text('Simpan'); //change button text
                        $('#btnSaveBuktiBayar').attr('disabled',false); //set button enable
                    }
                });
            }else{
                return false;
            }
        });
    }

    function uploadFile() {
      //validasi ukuran file
      if($('#file_bukti_bayar').prop('files')[0].size > 2000000){ // MAX 2MB
        Swal.fire({type: 'warning',title: 'Peringatan',text: 'File yang anda pilih terlalu besar !'});
        $('#file_bukti_bayar').val(null);
      }else{
        //proses upload file ke server
        var dataForm = new FormData();
        dataForm.append('file', $('#file_bukti_bayar').prop('files')[0]);
        dataForm.append('<?php echo $this->security->get_csrf_token_name(); ?>', '<?php echo $this->security->get_csrf_hash(); ?>');

        $.ajax({
            url: "<?php echo site_url('transaksi/upload_bukti_bayar'); ?>",
            type: "POST",
            data: dataForm,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function (data) {
              if (data.status === false) {
                $('#nama_file_bukti_bayar').val('');
                $('#file_bukti_bayar').val(null);
                Swal.fire({type: 'error',title: 'Oops...',text: ''+data.error_string+''});
              } else {
                $('#nama_file_bukti_bayar').val(data.file);
                $('.preview-upload-file-bukti-bayar').html(`<img src="<?php echo base_url(); ?>assets/bukti_pembayaran/`+data.file+`" alt="File Bukti Pembayaran" width="100%">`);
                Swal.fire({type: 'success',title: 'Sukses',text: 'Berhasil Mengunggah File !',showConfirmButton: false,timer: 1500});
              }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
      }
    }

    
    function countdown(t){
        // var time = new Date(t);
        var time = t;
        console.log(t);
        var n = new Date();
            x = setInterval(function(){
          var now = new Date().getTime();
          var dis = time - now;
          var d = Math.floor(dis / (1000 * 60 * 60 * 24));
          var h = Math.floor((dis % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
          var m = Math.floor((dis % (1000 * 60 * 60)) / (1000 * 60));
          var s = Math.floor((dis % (1000 * 60)) / (1000));
          d = ("0" + d).slice(-2);
          h = ("0" + h).slice(-2);
          m = ("0" + m).slice(-2);
          s = ("0" + s).slice(-2);
          
          var cd = h + " : " + m + " : " + s;
          $('.countdown').html(cd);

          var cd2 = d + " Hari, " + h + " Jam, " + m + " Menit, " + s + " Detik ";
          $('.countdown_pengiriman').html(cd2);
          
          setTimeout(function() {
            location.reload(true);
          }, dis);
        }, 1000);
    }

    function lihat_pembayaran(id_transaksi=null,no_virtual_acount=null,is_checkout=null) {
        $.ajax({
            url : "<?php echo base_url('transaksi/ajax_lihat')?>",
            type: "POST",
            data : {
                id  : id_transaksi,
                no_va : no_virtual_acount,
                <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>',
                type : 'detail_pembayaran',
            },
            dataType: "JSON",
            success: function(data){
                if (data.no_rekening) {
                    var norek = data.no_rekening;
                    var nama_bank = data.nama_bank;
                    var an_rek = data.an_rekening.toUpperCase();
                }else{
                    var norek = '';
                    var nama_bank = '';
                    var an_rek = '';
                }

                if (data.va == null) {
                    var html = `
                        <div class="alert alert-warning" role="alert">
                            <p style="text-align: justify;">Silahkan lakukan pembayaran dengan melakukan transfer langsung ke nomor rekening UMKM. Pesanan Anda tidak akan dikirim sampai Anda telah menyelesaikan dan mengupload bukti pembayaran.</p>
                            <hr>
                            <p class="mb-0" style="text-align: justify;">Jika anda tidak melakukan pembayaran dalam waktu 24 jam, maka pesanan anda akan di batalkan secara otomatis oleh sistem.</p>
                        </div>
                        
                        <hr>
                        
                        <label>Detail Pembayaran</label>
                        <table class="table" width="100%">
                            <tr align="left">
                                <td width="30%">Nama Bank</td>
                                <td width="2%"> : </td>
                                <td width="68%"><strong>`+nama_bank+`</strong></td>
                            </tr>
                            <tr align="left">
                                <td>Nama Pemilik</td>
                                <td> : </td>
                                <td><strong>`+an_rek+`</strong></td>
                            </tr>
                            <tr align="left">
                                <td>Nomor Rekening</td>
                                <td> : </td>
                                <td><strong>`+norek+`</strong></td>
                            </tr>
                            <tr align="left">
                                <td>Jumlah yang harus dibayar</td>
                                <td> : </td>
                                <td><strong>Rp. `+format_uang(data.total)+`</strong></td>
                            </tr>
                        </table>`;
                } else {
                    var html = `
                        <div class="alert alert-warning" role="alert">
                            <p style="text-align: justify;">Silahkan lakukan pembayaran dengan melakukan transfer langsung ke nomor Virtual Account Bank BJB. Pesanan Anda tidak akan dikirim sampai Anda telah menyelesaikan pembayaran.</p>
                            <hr>
                            <p class="mb-0" style="text-align: justify;">Jika anda tidak melakukan pembayaran dalam waktu 1 jam, maka pesanan anda akan di batalkan secara otomatis oleh sistem.</p>
                        </div>

                        <hr>
                        
                        <label>Detail Pembayaran</label>

                        <table class="table" width="100%">
                            <tr align="left">
                                <td width="30%">Nama Bank</td>
                                <td width="2%"> : </td>
                                <td width="68%"><strong>BANK BJB</strong></td>
                            </tr>
                            <tr align="left">
                                <td>Nomor Virtual Account</td>
                                <td> : </td>
                                <td><strong>`+data.va+`</strong></td>
                            </tr>
                            <tr align="left">
                                <td>Jumlah yang harus dibayar</td>
                                <td> : </td>
                                <td><strong>Rp. `+format_uang(data.total)+`</strong></td>
                            </tr>
                            <tr align="left">
                                <td>Batas Akhir Pembayaran</td>
                                <td> : </td>
                                <td><strong>`+data.expired_virtual_account+`</strong></td>
                            </tr>
                        </table>

                        <hr>

                        <label>Cara Pembayaran</label>

                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true" style="margin-top:20px; text-align:left;">`;

                    $.each(data.cara_bayar, function(i, cb) {
                        if (i == 0) {
                            var is_open = 'in';
                        }else{
                            var is_open = '';
                        }

                        html += `<div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="heading`+i+`">
                                        <h4 class="panel-title">
                                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse`+i+`" aria-expanded="true" aria-controls="collapse`+i+`">
                                                `+cb.channel+`
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapse`+i+`" class="panel-collapse collapse `+is_open+`" role="tabpanel" aria-labelledby="heading`+i+`">
                                        <div class="panel-body">
                                            <ul>`;
                                            $.each(cb.cara, function(x, cr) {
                                                html += `<li>`+(x+1)+`. `+cr+`</li>`;
                                            });
                                    html += `</ul>
                                        </div>
                                    </div>
                                </div>`;
                    });

                    html += `</div>`;
                }

                if (is_checkout) {
                    var msg_title = '<strong>Pesanan Anda berhasil dibuat</strong>';
                }else{
                    var msg_title = '<strong>Pembayaran</strong>';
                }

                Swal.fire({
                  title: msg_title,
                  icon: 'info',
                  width: 800,
                  html: html,
                  showCloseButton: true,
                  focusConfirm: false,
                  confirmButtonText:'<i class="fa fa-thumbs-up"></i> Oke',
                  confirmButtonAriaLabel: 'Thumbs up, great!'
                });
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert('Error get data from ajax');
            }
        });
     } 
</script>