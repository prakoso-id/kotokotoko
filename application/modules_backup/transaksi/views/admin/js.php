<script type="text/javascript">

	$('.select2').select2();
	
	var delay = (function(){
      var timer = 0;
      return function(callback, ms){
        clearTimeout(timer);
        timer = setTimeout(callback,ms);
      };
    })();  

	var table;

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
					'invoice'		: $('.filter_invoice').val(),
                    'id_umkm'       : $('.filter_umkm').val(),
                    'nama_umkm'     : $('.filter_nama_umkm').val(),
                    'nama_pembeli'  : $('.filter_nama_pembeli').val(),
					'status'		: $('.filter_status').val(),
				};
				data.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
				data.type = 'admin';
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
        detail_pesanan(id_transaksi);
    }

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
		delay(function(){
        	table_data();
      	}, 800);
	});

    $(".filter_nama_umkm").keyup(function(){
        delay(function(){
            table_data();
        }, 800);
    });

    $(".filter_nama_pembeli").keyup(function(){
        delay(function(){
            table_data();
        }, 800);
    });

    $(".load_table").click(function(){
        table_data();
    });

    function detail_pesanan(id)
	{
        $('.f_status_transaksi').hide();
        $('.f_no_resi').hide();
        $('.f_pesan_batal').hide();
        $('#btnSave').hide();
        $.ajax({
        	url : "<?php echo base_url('transaksi/ajax_lihat/')?>",
        	type: "POST",
        	data : {
        		id   : id,
        		<?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>',
        		type : 'detail_pesanan',
        	},
        	dataType: "JSON",
        	success: function(data){
                // set progres bar
                $('#progressbar li').removeClass('done');
                $('#progressbar li').removeClass('active');
                $('#progressbar li').removeClass('batal');

                if (data.id_status_transaksi == 0 || data.id_status_transaksi == 1) {
                    $('#timeline_bayar').addClass('active');
                }else if (data.id_status_transaksi == 2) {
                    $('#timeline_bayar').addClass('done');
                    $('#timeline_proses').addClass('active');
                }else if (data.id_status_transaksi == 3) {
                    $('#timeline_bayar').addClass('done');
                    $('#timeline_proses').addClass('done');
                    $('#timeline_kirim').addClass('active');
                }else if (data.id_status_transaksi == 4) {
                    $('#timeline_bayar').addClass('done');
                    $('#timeline_proses').addClass('done');
                    $('#timeline_kirim').addClass('done');
                    $('#timeline_selesai').addClass('done');
                }else if (data.id_status_transaksi == 5) {
                    if (data.tgl_pembayaran) {
                        $('#timeline_bayar').addClass('batal');
                    }
                    if (data.tgl_konfirmasi) {
                        $('#timeline_bayar').addClass('batal');
                        $('#timeline_proses').addClass('batal');
                    }
                    if (data.tgl_kirim) {
                        $('#timeline_bayar').addClass('batal');
                        $('#timeline_proses').addClass('batal');
                        $('#timeline_kirim').addClass('batal');
                    }
                    if (data.tgl_sampai) {
                        $('#timeline_bayar').addClass('batal');
                        $('#timeline_proses').addClass('batal');
                        $('#timeline_kirim').addClass('batal');
                        $('#timeline_selesai').addClass('batal');
                    }
                }else if (data.id_status_transaksi == 6) {
                    $('#timeline_bayar').addClass('batal');
                    $('#timeline_proses').addClass('batal');
                }

                $('.timeline-tgl').text('');
                $('#timeline_bayar .timeline-tgl').text(data.tgl_pembayaran);
                $('#timeline_proses .timeline-tgl').text(data.tgl_konfirmasi);
                $('#timeline_kirim .timeline-tgl').text(data.tgl_kirim);
                $('#timeline_selesai .timeline-tgl').text(data.tgl_sampai);
                
        		$('[name="id"]').val(data.id_transaksi);
        		if (data.id_status_transaksi == 5) {
                    var sts = data.nama_status+' <font color="red">(<i>'+data.pesan_batal+'</i>)</font>';
                }else if (data.id_status_transaksi == 6) {
                    var sts = data.nama_status+' <font color ="red">(<i>Pesanan telah dibatalkan secara otomatis oleh sistem karena Pembeli tidak melakukan pembayaran tepat waktu</i>)</font>';
                }else{
                    var sts = data.nama_status;
                }

                $('.nama_status').text(sts);
        		$('.tgl_pembelian').text(data.created_at);
        		$('.invoice').text(data.no_invoice);
                var alamat = data.nama_penerima+' <br> '+data.no_penerima+' <br> '+data.alamat+' <br> KEL.'+data.nama_kel+' KEC.'+data.nama_kec+' KAB/KOTA.'+data.nama_kota+' PROP.'+data.nama_prop;
                $('.alamat_pengiriman').html(DOMPurify.sanitize( alamat.toUpperCase(), { SAFE_FOR_JQUERY: true } ));
                $('.kurir').text(data.nama_kurir+" ("+data.kurir_service+")");
                $('.ongkir').text("Rp. "+format_uang(data.ongkir));

                //jika status sedang dikirim atau sampai tujuan
                if(data.id_status_transaksi == 3 || data.id_status_transaksi == 4){ 
                    $('.data_resi').attr('style','display:block');
                    $('.no_resi').html(data.no_resi+' <a href="javascript:void(0);" onclick="copy_text()"><i>Salin</i></a>&nbsp;&nbsp;<a href="javascript:void(0);" onclick="lacak_resi('+data.no_resi+',`'+data.kode_kurir+'`,`'+data.nama_kurir+'`)"><i>Lacak</i></a>');
                    $('#no_resi').val(data.no_resi);
                }else{
                    $('.data_resi').attr('style','display:none');
                }

                $('.nama_toko').text(data.namausaha.toUpperCase());
        		
                $('.dataa-produk').html('');
                for (var i = 0; i < data.produk.length; i++) {
                    var url = '<?php echo base_url('/assets/produk/');?>'+data.produk[i].id_umkm+'/'+data.produk[i].foto;
                    var total = data.produk[i].harga * data.produk[i].quantity;
                    $('.dataa-produk').append('<div class="product__item bom" style="display: flex !important;"><div font-size="12" class="css-1e6gctp-unf-link edi449x0 foto_produk col-md-12" style="background:url('+url+'); margin-right:20px;"></div><div class="product__item__desc css-1e6gctp-unf-link edi449x0 col-md-12" font-size="12" style="margin-top: 30px;"><div class="font__size--m font--bold ellipsis-two-line"><div class="nama_produk" style="font-size: 14px; font-weight:600">'+data.produk[i].nama_produk+'</div><div class="catatan_produk" style="font-size: 12px;">Catatan : '+data.produk[i].catatan+'</div></div><div style="text-align: right;"><span class="stok_produk css-1n5r376 padding--left" style="font-size:12px !important; margin-left: 20px;">('+data.produk[i].quantity+' Produk) </span><span class="harga_produk font__type--trx" style="font-size:13px !important;">Rp. '+format_uang(data.produk[i].harga)+'</span></div><div class="font__size--m font--bold ellipsis-two-line" style="text-align: right;"><div style="font-size: 14px; font-weight:600">Rp. '+format_uang(total)+'</div></div></div></div><hr>');
                }

                var total_pembayaran = `<div class="row" style="font-size: 14px; font-weight:600">
                                            <div class="col-md-9">Subtotal Harga Produk</div>
                                            <div class="col-md-3" style="text-align: right; padding-right:30px;">Rp. `+format_uang(data.total_harga)+`</div>
                                        </div>
                                        <hr>
                                        <div class="row" style="font-size: 14px; font-weight:600">
                                            <div class="col-md-9">Biaya Pengiriman</div>
                                            <div class="col-md-3" style="text-align: right; padding-right:30px;">Rp. `+format_uang(data.ongkir)+`</div>
                                        </div>
                                        <hr>
                                        <div class="row primary-color" style="font-size: 16px; font-weight:600">
                                            <div class="col-md-9">Total Pembayaran</div>
                                            <div class="col-md-3" style="text-align: right; padding-right:30px;">Rp. `+format_uang(data.total)+`</div>
                                        </div>
                                        <hr>`;
                $('.dataa-produk').append(total_pembayaran);

                $('.tgl_pembayaran').text(data.tgl_pembayaran);
                if (data.bukti_pembayaran) {
                    var html_bukti_pembayaran = `<img src="<?php echo base_url(); ?>assets/bukti_pembayaran/`+data.bukti_pembayaran+`" alt="File Bukti Pembayaran" width="100%">`;
                    $('.bukti_pembayaran').html(DOMPurify.sanitize( html_bukti_pembayaran, { SAFE_FOR_JQUERY: true } ));
                }else{
                    $('.bukti_pembayaran').html('-');
                }

                //jika status menunggu konfirmasi atau sedang diproses maka munculkan form untuk ubah status
                // if (data.id_status_transaksi == 1 || data.id_status_transaksi == 2) {
                //     $('.f_status_transaksi').show();
                //     get_m_status_transaksi(data.id_status_transaksi);
                //     $('#btnSave').show();
                // }

                $('#modal_data').modal('show');
                $('#modal_data .modal-title').text('Detail Transaksi');
        	},
        	error: function (jqXHR, textStatus, errorThrown){
        		alert('Error get data from ajax');
        	}
        });
	}

    function get_m_status_transaksi(id){
        $.ajax({
            url : "<?php echo base_url('transaksi/ajax_data/')?>",
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

    function lihat_ulasan(id)
    {
        $('#modal_ulasan').modal('show');
        $('#modal_ulasan .modal-title').text('Detail Ulasan');

        $.ajax({
            url : "<?php echo base_url('transaksi/ajax_lihat/')?>",
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
                var id_transaksi = data.id_transaksi;
                $.ajax({
                    url : "<?php echo base_url('transaksi/ajax_lihat/')?>",
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
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert('Error get data from ajax');
            }
        });

        $.ajax({
            url : "<?php echo base_url('transaksi/ajax_lihat/')?>",
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
</script>