<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Male_Fashion Template">
    <meta name="keywords" content="Male_Fashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php echo $meta_tag; ?>
    <title><?php echo $site_title; ?></title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap"
    rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="<?= base_url('assets/templateFE2/')?>css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="<?= base_url('assets/templateFE2/')?>css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="<?= base_url('assets/templateFE2/')?>css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="<?= base_url('assets/templateFE2/')?>css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="<?= base_url('assets/templateFE2/')?>css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="<?= base_url('assets/templateFE2/')?>css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="<?= base_url('assets/templateFE2/')?>css/slicknav.min.css" type="text/css">

    <link rel="stylesheet" href="<?= base_url('assets/templateFE2/')?>css/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/mytemplate/css/style.css">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/sweetalert2/sweetalert2.css') ?>">
    <?php echo $styles; ?>
    <!-- Js Plugins -->
    <script src="<?= base_url('assets/templateFE2/')?>js/jquery-3.3.1.min.js"></script>
    <?php echo $scripts_header; ?>

    <script src="<?php echo base_url()?>assets/mytemplate/js/bootstrap.js"></script>
    <script src="<?php echo base_url()?>assets/mytemplate/js/owl.carousel.min.js"></script>
    <script src="<?php echo base_url()?>assets/mytemplate/js/slick.js"></script>
    <script src="<?php echo base_url()?>assets/mytemplate/js/countdown.js"></script>
    <script src="<?php echo base_url(); ?>assets/mytemplate_backend/modules/popper.js"></script>
    <script src="<?= base_url('assets/templateFE2/')?>js/jquery.nice-select.min.js"></script>
    <script src="<?= base_url('assets/templateFE2/')?>js/jquery.nicescroll.min.js"></script>
    <script src="<?= base_url('assets/templateFE2/')?>js/jquery.magnific-popup.min.js"></script>
    <script src="<?= base_url('assets/templateFE2/')?>js/jquery.countdown.min.js"></script>
    <script src="<?= base_url('assets/templateFE2/')?>js/jquery.slicknav.js"></script>
    <script src="<?= base_url('assets/templateFE2/')?>js/mixitup.min.js"></script>
    <script src="<?= base_url('assets/templateFE2/')?>js/owl.carousel.min.js"></script>
    <script src="<?= base_url('assets/templateFE2/')?>js/main.js"></script>
    
    <script src="<?php echo base_url('assets/plugins/jQuery/purify.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/plugins/sweetalert2/sweetalert2.min.js');?>"></script>
    
    <?php echo $scripts_footer; ?>

</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <!-- <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__option">
            <div class="offcanvas__links">
                <a href="#">Sign in</a>
                <a href="#">FAQs</a>
            </div>
            <div class="offcanvas__top__hover">
                <span>Usd <i class="arrow_carrot-down"></i></span>
                <ul>
                    <li>USD</li>
                    <li>EUR</li>
                    <li>USD</li>
                </ul>
            </div>
        </div>
        <div class="offcanvas__nav__option">
            <a href="#" class="search-switch"><img src="img/icon/search.png" alt=""></a>
            <a href="#"><img src="img/icon/heart.png" alt=""></a>
            <a href="#"><img src="img/icon/cart.png" alt=""> <span>0</span></a>
            <div class="price">$0.00</div>
        </div>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__text">
            <p>Free shipping, 30-day return or refund guarantee.</p>
        </div>
    </div> -->
    <!-- Offcanvas Menu End -->

    <?php $this->load->view('frontend/header');?>
        <!-- /header -->
    <?php echo $content; ?>
    <!-- / end content -->
    <?php $this->load->view('frontend/footer'); ?>

    <!-- Search Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch">+</div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Search here.....">
            </form>
        </div>
    </div>
    <!-- Search End -->

    

    <script type="text/javascript">
        var page = "<?php echo $this->uri->segment(1); ?>";

        $(window).on('load', function () {
            $("#preload").fadeOut("fast");
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
                        va : id_detail,
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
            $("#preload").show();
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
                    $("#preload").hide();
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
                    $("#preload").hide();
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

        $('.add-cart').click(function() {
            var id_produk = $(this).data("id");
            proses_cart(id_produk,'add_chart');
        });

        function proses_cart(id,type='add_chart'){
            $("#preload").show();
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
                    $("#preload").hide();
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
                    $("#preload").hide();
                    alert('Error get data from ajax');
                }
            });
        }

        function beli_chart(id,type,qty=1){   
            $("#preload").show();
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
                    $("#preload").hide();
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
                    $("#preload").hide();
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

    // let tokenFcm = "<?=$this->session->userdata('token_fcm')?>";
    // let username = "<?=$this->session->userdata('identity')?>";

    // // Your web app's Firebase configuration
    // // For Firebase JS SDK v7.20.0 and later, measurementId is optional
    // var firebaseConfig = {
    //     apiKey: "AIzaSyCK0GX5tpbtSKrqhUXxMO1Br1pB6jsYK9w",
    //     authDomain: "umkm-tng.firebaseapp.com",
    //     projectId: "umkm-tng",
    //     storageBucket: "umkm-tng.appspot.com",
    //     messagingSenderId: "301681348555",
    //     appId: "1:301681348555:web:43fdb709bb5ab4ddda704e",
    //     measurementId: "G-YVCPLXC95V"
    // };
    // // Initialize Firebase
    // firebase.initializeApp(firebaseConfig);
    // firebase.analytics();

    // Retrieve Firebase Messaging object.
    // const messaging = firebase.messaging();

    // navigator.serviceWorker.register('<?php echo base_url() ?>assets/js/firebase-messaging-sw.js')
    //     .then((registration) => {
    //         messaging.useServiceWorker(registration);

    //         // Request permission and get token.....
    //         messaging.onTokenRefresh(function () {
    //             messaging.getToken().then(function (refreshedToken) {
    //                 // console.log('Token refreshed.');
    //                 setTokenSentToServer(false);
    //                 sendTokenToServer(refreshedToken);
    //                 resetUI();
    //             }).catch(function (err) {
    //                 // console.log('Unable to retrieve refreshed token ', err);
    //                 showToken('Unable to retrieve refreshed token ', err);
    //             });
    //         });
            
    //         messaging.onMessage(function (payload) {
    //             console.log('Message received. ', payload);

    //             // =========================================

    //             const pd = payload.data;
    //             const title= pd.judul;
    //             const options = {body: pd.isi, icon:pd.icon};
    //             return registration.showNotification(title, options);
    //         });

    //         resetUI();
    //     });

    //     function resetUI() {
    //         messaging.getToken().then(function (currentToken) {
    //             if (currentToken) {
    //                 sendTokenToServer(currentToken);
    //             } else {
    //                 // console.log('No Instance ID token available. Request permission to generate one.');
    //                 setTokenSentToServer(false);
    //             }
    //         }).catch(function (err) {
    //             // console.log('An error occurred while retrieving token. ', err);
    //             setTokenSentToServer(false);
    //         });
    //     }

    //     function setTokenSentToServer(sent) {
    //         window.localStorage.setItem('sentToServer', sent ? '1' : '0');
    //     }

    //     function sendTokenToServer(currentToken) {
    //         if (!isTokenSentToServer()) {
    //             // console.log('Sending token to server...');
    //             subscribeToken(currentToken);
    //             setTokenSentToServer(true);
    //         } else {
    //             // console.log('Token already sent to server so won\'t send it again unless it changes');
    //             subscribeToken(currentToken);
    //         }

    //     }

    //     function isTokenSentToServer() {
    //         return window.localStorage.getItem('sentToServer') === '1';
    //     }

    //     function requestPermission() {
    //         // console.log('Requesting permission...');
    //         messaging.requestPermission().then(function () {
    //             // console.log('Notification permission granted.');
    //             resetUI();
    //         }).catch(function (err) {
    //             // console.log('Unable to get permission to notify.', err);
    //         });
    //     }

    //     function deleteToken() {
    //         console.log('Deleting token...');

    //         messaging.getToken().then(function (currentToken) {
    //             messaging.deleteToken(currentToken).then(function () {
    //                 console.log('Token deleted.');
    //                 setTokenSentToServer(false);
    //                 resetUI();
    //             }).catch(function (err) {
    //                 console.log('Unable to delete token. ', err);
    //             });
    //         }).catch(function (err) {
    //             console.log('Error retrieving Instance ID token. ', err);
    //         });

    //     }

    //     function subscribeToken(token) {
    //         var OSName = "Unknown OS";
    //         if (navigator.appVersion.indexOf("Win")!=-1) OSName="Windows";
    //         if (navigator.appVersion.indexOf("Mac")!=-1) OSName="MacOS";
    //         if (navigator.appVersion.indexOf("X11")!=-1) OSName="UNIX";
    //         if (navigator.appVersion.indexOf("Linux")!=-1) OSName="Linux";

    //         var nVer = navigator.appVersion;
    //         var nAgt = navigator.userAgent;
    //         var browserName = navigator.appName;
    //         var fullVersion = '' + parseFloat(navigator.appVersion);
    //         var majorVersion = parseInt(navigator.appVersion, 10);
    //         var nameOffset, verOffset, ix;

    //         // In Opera, the true version is after "Opera" or after "Version"
    //         if ((verOffset = nAgt.indexOf("Opera")) != -1) {
    //             browserName = "Opera";
    //             fullVersion = nAgt.substring(verOffset + 6);
    //             if ((verOffset = nAgt.indexOf("Version")) != -1)
    //                 fullVersion = nAgt.substring(verOffset + 8);
    //         }
    //         // In MSIE, the true version is after "MSIE" in userAgent
    //         else if ((verOffset = nAgt.indexOf("MSIE")) != -1) {
    //             browserName = "Microsoft Internet Explorer";
    //             fullVersion = nAgt.substring(verOffset + 5);
    //         }
    //         // In Chrome, the true version is after "Chrome" 
    //         else if ((verOffset = nAgt.indexOf("Chrome")) != -1) {
    //             browserName = "Chrome";
    //             fullVersion = nAgt.substring(verOffset + 7);
    //         }
    //         // In Safari, the true version is after "Safari" or after "Version" 
    //         else if ((verOffset = nAgt.indexOf("Safari")) != -1) {
    //             browserName = "Safari";
    //             fullVersion = nAgt.substring(verOffset + 7);
    //             if ((verOffset = nAgt.indexOf("Version")) != -1)
    //                 fullVersion = nAgt.substring(verOffset + 8);
    //         }
    //         // In Firefox, the true version is after "Firefox" 
    //         else if ((verOffset = nAgt.indexOf("Firefox")) != -1) {
    //             browserName = "Firefox";
    //             fullVersion = nAgt.substring(verOffset + 8);
    //         }
    //         // In most other browsers, "name/version" is at the end of userAgent 
    //         else if ((nameOffset = nAgt.lastIndexOf(' ') + 1) <
    //             (verOffset = nAgt.lastIndexOf('/'))) {
    //             browserName = nAgt.substring(nameOffset, verOffset);
    //             fullVersion = nAgt.substring(verOffset + 1);
    //             if (browserName.toLowerCase() == browserName.toUpperCase()) {
    //                 browserName = navigator.appName;
    //             }
    //         }
    //         // trim the fullVersion string at semicolon/space if present
    //         if ((ix = fullVersion.indexOf(";")) != -1)
    //             fullVersion = fullVersion.substring(0, ix);
    //         if ((ix = fullVersion.indexOf(" ")) != -1)
    //             fullVersion = fullVersion.substring(0, ix);

    //         majorVersion = parseInt('' + fullVersion, 10);
    //         if (isNaN(majorVersion)) {
    //             fullVersion = '' + parseFloat(navigator.appVersion);
    //             majorVersion = parseInt(navigator.appVersion, 10);
    //         }
            
    //         let userInfo = {
    //             OSName: OSName,
    //             browserName: browserName,
    //             fullVersion: fullVersion,
    //             majorVersion: majorVersion,
    //             userAgent: navigator.userAgent
    //         };

    //         console.log(token);

    //         if (token !== tokenFcm && username) {
    //             $.ajax({
    //                 url: "<?=site_url('ajax/ajax_ubah')?>",
    //                 type: "post",
    //                 data: {
    //                     device_name: 'Web ' + browserName + ' on ' + OSName,
    //                     device_info: JSON.stringify(userInfo),
    //                     token: token,
    //                     type : 'subs_token',
    //                     <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>',
    //                 },
    //                 success: function (response) {

    //                 }
    //             });
    //         }
    //     }

        function hubungi_wa(nowa,text) {
            if (typeof window.orientation !== 'undefined') {
                window.open('https://api.whatsapp.com/send?phone=' + nowa + '&text='+text, '_blank');
            } else {
                window.open('https://web.whatsapp.com/send?phone=' + nowa + '&text='+text, '_blank');
            }
        }
    </script>
</body>

</html>