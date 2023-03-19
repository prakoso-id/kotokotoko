<script type="text/javascript">

	$('.select2').select2();

    var $inp = $('.rating-input');
        
    //$inp.attr('value','5');
        
    $inp.rating({
            min: 0,
            max: 5,
            step: 1,
            size: 'sm',
            showClear: false
        });

    var $inpn = $('.rating-produk');
        
    //$inp.attr('value','5');
        
    $inpn.rating({
            min: 0,
            max: 5,
            step: 1,
            size: 'sm',
            showClear: false
        });
	
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
					'nama'			: $('.filter_nama').val(),
					'status'		: $('.filter_status').val(),
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

	function table_data(){
		dataTable.ajax.reload(null,true);
	}

	$(".filter_nama").keyup(function(){
		delay(function(){
        	table_data();
      	}, 800);
	});

	$(".filter_status").change(function(){
		table_data();
	});

	$(".filter_invoice").keyup(function(){
		delay(function(){
        	table_data();
      	}, 800);
	});

    $(".load_table").click(function(){
        table_data();
    });

    function detail_pesanan(id)
	{
		$('#modal_data').modal('show');
        $('#modal_data .modal-title').text('Detail Pembelian');
        $('.simpan_data').html('');
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

                if (data.id_status_transaksi == 0) { //jika status menunggu pembayaran
                    $('.simpan_data').html('<button type="button" class="btn btn-success" onclick="upload_bukti_bayar('+data.id_transaksi+')"> Upload Bukti Pembayaran</button>');
                }

        		if(data.id_status_transaksi == 3){ //jika status sedang dikirim
        			$('.simpan_data').html('<button type="button" class="btn btn-success" id="btnSaveSampai" onclick="simpan_data()"> Pesanan sudah sampai</button>');
        		}else if(data.id_status_transaksi == 4){ //jika status sudah sampai tujuan
                    cek_ulasan(data.id_transaksi);
        		}
        	},
        	error: function (jqXHR, textStatus, errorThrown){
        		alert('Error get data from ajax');
        	}
        });
	}

    function cek_ulasan(id){
        $.ajax({
            url : "<?php echo base_url('transaksi/ajax_lihat/')?>",
            type: "POST",
            data : {
                id   : id,
                <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>',
                type : 'data_ratting',
            },
            dataType: "JSON",
            success: function(hasil){
                if(!hasil){
                    $('.simpan_data').html('<button type="button" class="btn btn-success" onclick="tambah_ulasan('+id+')"> Tambah Ulasan</button>'); 
                }
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert('Error get data from ajax');
            }
        });
    }

	function simpan_data(){
		var id = $('[name="id"]').val();
		$('#btnSaveSampai').text('sedang menyimpan...'); //change button text
        $('#btnSaveSampai').attr('disabled',true); //set button disable
        $('.form-group').removeClass('has-error');
        $('.help').empty();
                
        var form = $('#add_modal')[0];
        var data = new FormData(form);
        var url = '<?php echo base_url("transaksi/ajax_save"); ?>';

        swal({
            text: "Apakah pesanan sudah sampai?",
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
                            }else {
                                swal({
                                    text: obj.message,
                                    title: "",
                                    type: "success",
                                    button: true,
                                },function(isConfirm){
                                    if (isConfirm) {
                                        $('#modal_data').modal('hide');
                                        table_data();
                                    }
                                });
                            }
                        }else {
                            for (var i = 0; i < obj.inputerror.length; i++) {
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
                        }
                        $('#btnSaveSampai').text('Pesanan sudah sampai'); //change button text
                        $('#btnSaveSampai').attr('disabled',false); //set button enable
                    }
                });
            }else{
                $('.confirm').text('Simpan'); //change button text
                $('.confirm').attr('disabled',false); //set button disable'

                $('#btnSaveSampai').text('Pesanan sudah sampai'); //change button text
                $('#btnSaveSampai').attr('disabled',false); //set button enable
            }

        });
	}

	function tambah_ulasan(id)
	{
		$('#modal_tambah').modal('show');
        $('#modal_tambah .modal-title').text('Tambah Ulasan');

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
                $('[name="id_transaksi"]').val(data.id_transaksi);
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
                        type : 'tambah_ulasan',
                        id   : id_transaksi,
                    },
                    dataType: "html",
                    success: function(data){
                        $('#ulasan-produk').html(data);
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

    function simpan_ulasan(){
        var id = $('[name="id_transaksi_detail"]').val();
        $('#btnSaveUlasan').text('sedang menyimpan...'); //change button text
        $('#btnSaveUlasan').attr('disabled',true); //set button disable
        $('.form-group').removeClass('has-error');
        $('.help').empty();
                
        var form = $('#add_tambah')[0];
        var data = new FormData(form);
        var url = '<?php echo base_url("transaksi/ajax_save"); ?>';

        swal({
            text: "Apakah data yang disimpan sudah benar?",
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
                                        $('#modal_data').modal('hide');
                                        $('#modal_tambah').modal('hide');
                                        table_data();
                                    }
                                });
                            }
                        }else {
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
                        }
                        $('#btnSaveUlasan').text('Simpan'); //change button text
                        $('#btnSaveUlasan').attr('disabled',false); //set button enable
                    }
                });
            }else{
                $('.confirm').text('Simpan'); //change button text
                $('.confirm').attr('disabled',false); //set button disable'

                $('#btnSaveUlasan').text('Simpan'); //change button text
                $('#btnSaveUlasan').attr('disabled',false); //set button enable
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
                    $('.data_pesan').empty('');
                    $('.data_pesan').load('<?=base_url('transaksi/pesan/');?>'+obj.id_group+'/'+id, function(data, status){});
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
                if(data.status)
                {
                    detail_chat(id_group,data.id_produk,'hapus');
                    $('[name="id_transaksi_pesan"]').val('');
                }else{
                    swal.fire({
                        title: "Perhatian",
                        text: "Pesan tidak boleh kosong",
                        type: "error",
                    });
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
        $('#btnSaveBuktiBayar').text('sedang menyimpan...'); //change button text
        $('#btnSaveBuktiBayar').attr('disabled',true); //set button disable
        $('.form-group').removeClass('has-error');
        $('.help').empty();

        var form = $('#form_upload_bukti_bayar')[0];
        var data = new FormData(form);
        var url = '<?php echo base_url("transaksi/ajax_save"); ?>';

        swal({
            text: "Apakah ingin menyimpan bukti pembayaran ? Pastikan file yang anda upload sudah benar.",
            title: "Konfirmasi Simpan",
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
                                        $('#modal_data').modal('hide');
                                        $('#modal_upload_bukti_bayar').modal('hide');
                                        table_data();
                                    }
                                });
                            }
                        }else {
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
                        }
                        $('#btnSaveBuktiBayar').text('Simpan'); //change button text
                        $('#btnSaveBuktiBayar').attr('disabled',false); //set button enable
                    }
                });
            }else{
                $('.confirm').text('Simpan'); //change button text
                $('.confirm').attr('disabled',false); //set button disable'

                $('#btnSaveBuktiBayar').text('Simpan'); //change button text
                $('#btnSaveBuktiBayar').attr('disabled',false); //set button enable
            }
        });
    }

    function uploadFile() {
      //validasi ukuran file
      if($('#file_bukti_bayar').prop('files')[0].size > 2000000){ // MAX 2MB
        Swal({type: 'warning',title: 'Peringatan',text: 'File yang anda pilih terlalu besar !'});
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
                swal({type: 'error',title: 'Oops...',text: ''+data.error_string+''});
              } else {
                $('#nama_file_bukti_bayar').val(data.file);
                $('.preview-upload-file-bukti-bayar').html(`<img src="<?php echo base_url(); ?>assets/bukti_pembayaran/`+data.file+`" alt="File Bukti Pembayaran" width="100%">`);
                swal({type: 'success',title: 'Sukses',text: 'Berhasil Mengunggah File !',showConfirmButton: false,timer: 1500});
              }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
      }
     }
</script>