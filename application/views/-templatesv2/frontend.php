<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <base href="<?php echo base_url(); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php echo $meta_tag; ?>
    <title><?php echo $site_title; ?></title>
    <link rel="stylesheet" href="<?php echo base_url()?>assets/mytemplate/css/owl.carousel.min.css">
    <link rel="shortcut icon" href="<?php echo base_url()?>assets/images/logo.png" type="image/png">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/mytemplate/css/slick.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/mytemplate/css/slick-theme.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/mytemplate/css/owl.theme.default.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/mytemplate/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/select2/select2.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/sweetalert2/sweetalert2.css') ?>">
    <?php echo $styles; ?>
    <script src="<?php echo base_url()?>assets/mytemplate/js/jquery.js"></script>
    <?php echo $scripts_header; ?>
</head>

<body>
    <!-- push menu-->
    <div class="pushmenu menu-home5">
        <div class="menu-push">
            <span class="close-left js-close"><i class="icon-close f-20"></i></span>
            <div class="clearfix"></div>
            <form role="search" method="get" id="searchform" class="searchform" action="<?php echo base_url('list-produk') ?>">
                <div>
                    <label class="screen-reader-text" for="q"></label>
                    <input type="text" placeholder="Cari produk..." value="<?php echo htmlentities($this->input->get('cari',true), ENT_QUOTES, 'UTF-8') ?>" name="cari" autocomplete="off" required>
                    <button type="submit" id="searchsubmit"><i class="ion-ios-search-strong"></i></button>
                </div>
            </form>
            <ul class="nav-home5 js-menubar">
                <li class="level1 dropdown">
                    <a class="<?php echo ($active == 'beranda'?'active-menu':'') ?>" href="<?php echo base_url() ?>">Beranda</a>
                </li>
                <li class="level1 dropdown">
                    <a class="<?php echo ($active == 'list-produk'?'active-menu':'') ?>" href="<?php echo base_url('list-produk') ?>">Produk</a>
                </li>
                <li class="level1 dropdown">
                    <a class="<?php echo ($active == 'list-umkm'?'active-menu':'') ?>" href="<?php echo base_url('list-umkm') ?>">UMKM</a>
                </li>
                <li class="level1 dropdown">
                    <a class="<?php echo ($active == 'list-agenda'?'active-menu':'') ?>" href="<?php echo base_url('agenda') ?>">Agenda</a>
                </li>
                <li class="level1 dropdown">
                    <a class="<?php echo ($active == 'list-berita'?'active-menu':'') ?>" href="<?php echo base_url('list-berita') ?>">Berita</a>
                </li>
                <li class="level1 dropdown">
                    <a class="<?php echo ($active == 'list-hukum'?'active-menu':'') ?>" href="<?php echo base_url('dasar-hukum') ?>">Dasar Hukum</a>
                </li>
                <li class="level1 dropdown"><a href="https://play.google.com/store/apps/details?id=id.go.tangerangkota.tangeranglive" target="_blank">Download Aplikasi Tangerang LIVE</a></li>
                <?php if ($this->user_model->is_login()) {
                    echo '<li class="level1 dropdown"><a href="'.base_url('keluar').'">Keluar</a></li>';
                }else{
                    echo '<li class="level1 dropdown"><a href="'.base_url('login').'">Daftar / Masuk</a></li>';
                } ?>
            </ul>
        </div>
    </div>
    <!-- end push menu-->
    <div class="wrappage">
        <div id="loading"></div>
        <?php $this->load->view('templatesv2/header');?>
        <!-- /header -->
        <?php echo $content; ?>
        <!-- / end content -->
        <?php $this->load->view('templatesv2/footer'); ?>
        <!-- /footer -->
        <!-- /footer -->
    </div>
    <a href="#" class="btn-gradient scroll_top" style="display: block;"><i class="ion-ios-arrow-up"></i></a>
    <script src="<?php echo base_url()?>assets/mytemplate/js/bootstrap.js"></script>
    <script src="<?php echo base_url()?>assets/mytemplate/js/owl.carousel.min.js"></script>
    <script src="<?php echo base_url()?>assets/mytemplate/js/slick.js"></script>
    <script src="<?php echo base_url()?>assets/mytemplate/js/countdown.js"></script>
    <script src="<?php echo base_url()?>assets/mytemplate/js/main.js"></script>
    <script src="<?php echo base_url('assets/plugins/sweetalert2/sweetalert2.min.js');?>"></script>
    <script src="<?php echo base_url('assets/plugins/forms/selects/select2.min.js');?>"></script>
    <script src="<?php echo base_url('assets/plugins/toastr/toastr.min.js');?>"></script>
    <script src="<?php echo base_url('assets/plugins/jQuery/purify.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/jquery.redirect.js'); ?>"></script>
    <?php echo $scripts_footer; ?>

    <script type="text/javascript">
        var page = "<?php echo $this->uri->segment(1); ?>";

        $(window).on('load', function () {
            $("#loading").fadeOut("fast");
        });

        $(document).ready(function(){
            <?php if (isset($this->session->identity) && !$this->user_model->is_umkm_verifikator()) { ?>
                get_count_pesan();
                // get_notif();
            <?php } ?>

            $('.form-cari').keyup(function(){  
               var query = $(this).val();  
               if(query != ''){  
                    $.ajax({  
                        url : "<?php echo base_url('list_produk/ajax_cari_produk_umkm') ?>?q="+query+"&limit=5",  
                        method:"GET", 
                        dataType: 'JSON', 
                        success:function(data){
                            if (data) {
                                var html = '';
                                if (data.produk.length > 0) {
                                    html += `<li><a class="flex" href="javascript:void(0)">Produk</a></li>`;
                                    $.each(data.produk, function (index, produk) {
                                        html += `<li>
                                                    <a class="flex align-center" href="<?php echo base_url('list-produk');?>/produk/`+data.product_unique_code[index]+`">
                                                        <div class="product-img">
                                                            <img src="<?php echo base_url();?>assets/produk/`+produk.id_umkm+`/`+produk.foto+`" alt="" class="img-reponsive" style="width: 60px;object-fit: cover;height: 60px;" alt="">
                                                        </div>
                                                        <h3 class="product-title">`+produk.nama_produk+`</h3>
                                                    </a>
                                                </li>`;
                                    });
                                }

                                if (data.umkm.length > 0) {
                                    html += `<li><a class="flex" href="javascript:void(0)">UMKM</a></li>`;
                                    $.each(data.umkm, function (index, umkm) {
                                        if (umkm.logo_umkm) {
                                            var logo_umkm = `<img src="<?php echo base_url();?>assets/logo/`+umkm.logo_umkm+`" alt="" class="img-reponsive" style="width: 60px;object-fit: cover;height: 60px;" alt="">`;
                                        }else{
                                            var inisial = umkm.namausaha.substring(0, 1);
                                            var logo_umkm = `<div class="icon-umkm btn-gradient"><span>`+inisial.toUpperCase()+`</span></div>`;
                                        }
                                        
                                        html += `<li>
                                                    <a class="flex align-center" href="<?php echo base_url('toko');?>/`+data.umkm_unique_code[index]+`">
                                                        <div class="product-img">
                                                            `+logo_umkm+`
                                                        </div>
                                                        <div class="product-title">
                                                            <h5>`+umkm.namausaha+`</h5>
                                                            <p style="font-size: 9px;margin-bottom: 3px;">`+((umkm.nama_kel) ? '<i class="fa fa-map-marker"></i> '+umkm.nama_kel+'' : '')+`</p>
                                                        </div>
                                                    </a>
                                                </li>`;
                                    });
                                }

                                html += '<li><a class="flex align-center" href="<?php echo base_url('list-produk') ?>?cari='+query+'">Lihat semua</a></li>'
                            }else{
                                var html = '';
                                $('.list-product-search').removeClass('active');
                            }
                            
                            $('.list-product-search').html(html);
                        }  
                    });  
               }  
            });
        });

        function get_count_pesan(){
            $.ajax({
                url : "<?php echo base_url('ajax/ajax_data')?>",
                type: "POST",
                data : {
                    <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>',
                    type : 'count_pesan_all',
                },
                dataType: "JSON",
                success: function(data){
                    if (data.count > 0) {
                        var html_count_msg = '<span class="count cart-count">'+data.count+'</span>';
                        $('.count-pesan-all').html(DOMPurify.sanitize( html_count_msg, { SAFE_FOR_JQUERY: true } ));
                    }else{
                        $('.count-pesan-all').html('');
                    }
                    $('#count_pesan_all').val(data.count);
                },
                error: function (jqXHR, textStatus, errorThrown){
                    alert('Error get data from ajax');
                }
            });
        }

        // function get_notif(){
        //     $.ajax({
        //         url : "<?php echo base_url('notif/ajax_data')?>",
        //         type: "POST",
        //         data : {
        //             <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>',
        //             type : 'get_notif',
        //         },
        //         dataType: "JSON",
        //         success: function(data){
        //             if (data.count > 0) {
        //                 var html_count_msg = '<span class="count cart-count">'+data.count+'</span>';
        //                 $('.count-notif-all').html(DOMPurify.sanitize( html_count_msg, { SAFE_FOR_JQUERY: true } ));

        //                 var html = '';
        //                 $.each(data.data, function(i, val) {
        //                     var expld_tanggal = val.tanggal.split(" ");
        //                      html += `<li class="item-cart">
        //                                 <a href="javascript:void(0)" onclick="detail_notif(`+val.id_notifikasi+`,`+val.id_detail+`,'`+val.modul+`','`+val.submodul+`')">
        //                                     <span style="font-size:12px;"><b>`+val.judul+`</b></span>
        //                                     <br>
        //                                     <span style="font-size:10px;">`+val.message+`</span>
        //                                     <br>
        //                                     <span style="font-size:10px;">`+tanggal_indo(expld_tanggal[0])+` `+expld_tanggal[1]+`</span>
        //                                 </a>  
        //                             </li>`;
        //                 });
        //                 $('.notif-list').html(html);
        //             }else{
        //                 $('.count-notif-all').html('');

        //                 $('.notif-list').html(`<li class="item-cart"><span><h3 style="font-size: 14px;font-weight: 600;line-height: 1.5; color:black;">TIDAK ADA NOTIFIKASI YANG BELUM DIBACA.</h3></span></li>`);
        //             }
        //             $('#count_notif_all').val(data.count);
        //         },
        //         error: function (jqXHR, textStatus, errorThrown){
        //             alert('Error get data from ajax');
        //         }
        //     });
        // }

        function detail_notif(id_notifikasi,id_detail=null,modul=null,submodul=null) {
            read_notif(id_notifikasi);
            if (modul === 'transaksi_penjualan') {
                $.redirect(
                    '<?php echo base_url(); ?>transaksi/penjual',
                    {
                        id_transaksi:id_detail,
                        submodul:submodul,
                        <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
                    }
                );
            }else if (modul === 'transaksi_pembelian') {
                $.redirect(
                    '<?php echo base_url(); ?>transaksi/customer',
                    {
                        id_transaksi:id_detail,
                        submodul:submodul,
                        <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
                    }
                );
            }
        }

        function read_notif(id_notifikasi){
            $.ajax({
            url : "<?php echo base_url(); ?>notif/read_notif",
                type: "POST",
                async:false,
                data: {
                    id_notifikasi : id_notifikasi,
                    <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
                },
                dataType: "JSON",
                success: function(data){
                    
                },
                error: function (jqXHR, textStatus, errorThrown){
                    Swal.fire({type: 'error',title: 'Oops...',text: 'Terjadi kesalahan !'});
                }
            });
        }

        $('.love-produk').click(function() {
            var id_produk = $(this).data("id");
            wishlist(id_produk);
        });

        function wishlist(id){   
            $("#loading").show();
            $.ajax({
                url : "<?php echo base_url('ajax/ajax_data')?>",
                type: "POST",
                data : {
                    type : 'wishlist',
                    <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>',
                    id : id
                },
                dataType: "JSON",
                success: function(data){
                    $("#loading").hide();
                    if(data.success)
                    {
                        if(data.status == 'like')
                        {
                            $('.wish-'+id).removeClass('fa-heart-o').addClass('fa-heart').attr('style', 'color:#e95a5c');
                            notif_sukses('wishlist','tambah');
                        }else{
                            $('.wish-'+id).removeClass('fa-heart').addClass('fa-heart-o').removeAttr('style','color:#e95a5c');
                            notif_sukses('wishlist','hapus');
                            // location.reload();
                        }
                    }else{
                        swal.fire({
                            title: "Perhatian",
                            text: "Untuk menambahkan produk favorit harap login terlebih dahulu !",
                            type: "warning",
                            confirmButtonText: "Login"
                        }).then((result) => {
                            if (result.value) {
                                // login();
                                window.location.href = "<?php echo base_url('login'); ?>";
                            }
                        });
                    }
                },
                error: function (jqXHR, textStatus, errorThrown){
                    $("#loading").hide();
                    alert('Error get data from ajax');
                }
            });
        }

        $('.hapus-produk').click(function() {
            var id_produk = $(this).data("id");
            del_cart(id_produk);
        });

        function del_cart(id){   
            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: "Apakah anda yakin ingin menghapus produk dari keranjang ?",
                type: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
            }).then((result) => {
                if (result.value) {
                    proses_cart(id,'hapus');
                }else{
                    return false;
                }
            })
        }

        $('.add-chart').click(function() {
            var id_produk = $(this).data("id");
            proses_cart(id_produk,'add_chart');
        });

        function proses_cart(id,type='add_chart'){
            $("#loading").show();
            $.ajax({
                url : "<?php echo base_url('ajax/ajax_data')?>",
                type: "POST",
                data : {
                    status : type,
                    type : 'add_chart',
                    <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>',
                    id : id
                },
                dataType: "JSON",
                success: function(data){
                    $("#loading").hide();
                    if(data.success){
                        if(data.status == 'simpan'){
                            if(data.jml_keranjang == 1){
                                $('.cart-list').html('');
                                $('.cart-list').append(DOMPurify.sanitize( data.keranjang, { SAFE_FOR_JQUERY: true } ));
                            }else{
                                $('.cart-list').append(DOMPurify.sanitize( data.keranjang, { SAFE_FOR_JQUERY: true } ));
                            }
                            notif_sukses('keranjang','tambah');
                        }else if(data.status == 'hapus'){
                            if (data.jml_keranjang == 0) {
                                $('.cart-list').html('');
                                $('.cart-list').append(DOMPurify.sanitize( data.keranjang, { SAFE_FOR_JQUERY: true } ));
                            }else{
                                $('.cart-list > .'+id).remove();
                                
                            }
                            notif_sukses('keranjang','hapus');
                        }else if (data.status == 'update') {
                            $('.cart-list > .'+id).remove();
                            $('.cart-list').append(DOMPurify.sanitize( data.keranjang, { SAFE_FOR_JQUERY: true } ));
                            notif_sukses('keranjang','tambah');
                        }

                        $('.jumlah_keranjang').text(data.jml_keranjang);
                        $('[name="jumlah_keranjang"]').val(data.jml_keranjang);

                        $('.hapus-produk').click(function() {
                            var id_produk = $(this).data("id");
                            del_cart(id_produk);
                        });
                    }else{
                        if (data.login) {
                            swal.fire({title: "Perhatian",text: data.message,type: "warning"});
                        }else{
                            swal.fire({
                                title: "Perhatian",
                                text: "Untuk menambahkan produk ke keranjang harap login terlebih dahulu !",
                                type: "warning",
                                confirmButtonText: "Login"
                            }).then((result) => {
                                if (result.value) {
                                    // login();
                                    window.location.href = "<?php echo base_url('login'); ?>";
                                }
                            });
                        }
                    }

                    if (page == 'keranjang') {
                        load_data_keranjang();
                        window.scrollTo(0,0);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown){
                    $("#loading").hide();
                    alert('Error get data from ajax');
                }
            });
        }

        function beli_chart(id,type,qty=1){   
            $("#loading").show();
            $.ajax({
                url : "<?php echo base_url('ajax/ajax_data')?>",
                type: "POST",
                data : {
                    status : type,
                    type : 'beli_chart',
                    <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>',
                    id : id,
                    qty : qty
                },
                dataType: "JSON",
                success: function(data){
                    $("#loading").hide();
                    if(data.success){
                        window.location.href = "<?php echo base_url('keranjang'); ?>";
                    }else{
                        if (data.login) {
                            swal.fire({title: "Perhatian",text: data.message,type: "warning"});
                        }else{
                            swal.fire({
                                title: "Perhatian",
                                text: "Untuk menambahkan produk ke keranjang harap login terlebih dahulu !",
                                type: "warning",
                                confirmButtonText: "Login"
                            }).then((result) => {
                                if (result.value) {
                                    // login();
                                    window.location.href = "<?php echo base_url('login'); ?>";
                                }
                            });
                        }
                    }
                },
                error: function (jqXHR, textStatus, errorThrown){
                    $("#loading").hide();
                    alert('Error get data from ajax');
                }
            });
        }

        function rp(bilangan)
        {
            if(bilangan != null)
            {
                var number_string = bilangan.toString(),
                sisa    = number_string.length % 3,
                rupiah  = number_string.substr(0, sisa),
                ribuan  = number_string.substr(sisa).match(/\d{3}/g);
                        
                if (ribuan) {
                    separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }
            }else{
                rupiah = '';
            }
            
            return rupiah;
        }

        const Toast = Swal.mixin({
           toast: true,
           position: 'top-end',
           showConfirmButton: false,
           timer : 3000
        });

        function notif_sukses(data,type){   
            if(data == 'wishlist'){
                if(type == 'tambah'){
                    Toast.fire({
                        type : 'success',
                        title: 'Produk berhasil ditambahkan ke daftar favorit',
                        text: '',
                    });
                }else if(type == 'hapus'){
                    Toast.fire({
                        type : 'success',
                        title: 'Produk berhasil dihapus dari daftar favorit',
                        text: '',
                    });
                }
            }else if(data == 'keranjang'){
                if(type == 'tambah'){
                    Toast.fire({
                        type : 'success',
                        title: 'Produk berhasil ditambahkan ke keranjang',
                        text: '',
                    });
                    
                }else if(type == 'hapus'){
                    Toast.fire({
                        type : 'success',
                        title: 'Produk berhasil dihapus dari keranjang',
                        text: '',
                    });
                }
            }   
        }

        function htmlEncode(str){
          return String(str).replace(/[^\w. ]/gi, function(c){
             return '&#'+c.charCodeAt(0)+';';
          });
        }

        function Angkasaja(evt) 
        {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }

        function format_uang(bilangan)
        {
            if(bilangan != null)
            {
                var number_string = bilangan.toString(),
                sisa    = number_string.length % 3,
                rupiah  = number_string.substr(0, sisa),
                ribuan  = number_string.substr(sisa).match(/\d{3}/g);
                        
                if (ribuan) {
                    separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }
            }else{
                rupiah = '';
            }
            

            return rupiah;
        }

        $("input[data-type='currency']").on({
            keyup: function() {
                formatCurrency($(this));
            },
            blur: function() { 
                formatCurrency($(this), "blur");
            }
        });

        function formatNumber(n) {
            return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        }

        function formatCurrency(input, blur) {
            var input_val = input.val().replace(/^0+/, '');
            if (input_val === "") { return; }
            var original_len = input_val.length;
            var caret_pos = input.prop("selectionStart");

            if (input_val.indexOf(",") >= 0) {
                var decimal_pos = input_val.indexOf(",");
                var left_side = input_val.substring(0, decimal_pos);
                var right_side = input_val.substring(decimal_pos);

                // add commas to left side of number
                left_side = formatNumber(left_side);

                // validate right side
                right_side = formatNumber(right_side);
                
                // On blur make sure 2 numbers after decimal
                if (blur === "blur") {
                right_side += "";
                }
                
                // Limit decimal to only 2 digits
                right_side = right_side.substring(0, 2);

                // join number by .
                input_val = left_side + "" + right_side;

            } else {
                input_val = formatNumber(input_val);
                input_val = input_val;
                if (blur === "blur") {
                    input_val += "";
                }
            }
            
            input.val(input_val);

            var updated_len = input_val.length;
            caret_pos = updated_len - original_len + caret_pos;
            input[0].setSelectionRange(caret_pos, caret_pos);
        }

        function tanggal_indo(data){
            var tgl = data.split("-");
            return tgl[2]+' '+get_bulan(tgl[1])+' '+tgl[0];
        }

        function get_bulan(data){
            var id = parseInt(data);
            switch(id) {
                case 1: { return 'Januari'; break; }
                case 2: { return 'Februari'; break; }
                case 3: { return 'Maret'; break; }
                case 4: { return 'April'; break; }
                case 5: { return 'Mei'; break; }
                case 6: { return 'Juni'; break; }  
                case 7: { return 'Juli'; break; }
                case 8: { return 'Agustus'; break; }
                case 9: { return 'September'; break; }
                case 10: { return 'Oktober'; break; }
                case 11: { return 'November'; break; }
                case 12: { return 'Desember'; break; }
            }
        }  
    </script>
</body>
</html>