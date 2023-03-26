<header id="header" class="header-v5">
    <!-- <div class="header-top-banner">
        <a href="#"><img src="<?php echo base_url()?>assets/mytemplate/img/banner-top.jpg" alt="" class="img-reponsive"></a>
    </div> -->
    <div class="topbar">
        <div class="container container-240">
            <div class="row flex">
                <div class="col-md-8 col-sm-8 flex-left">
                    <div class="topbar-left">
                        <div class="element hidden-xs hidden-sm">
                            <a href="https://play.google.com/store/apps/details?id=id.go.tangerangkota.tangeranglive" target="_blank"><i class="fa fa-mobile fa-2x"></i> Download Aplikasi Tangerang Live</a>
                        </div>
                        <div class="element hidden-xs hidden-sm">
                            <a class="<?php echo ($active == 'list-hukum'?'active-menu':'') ?>" href="<?php echo base_url('dasar-hukum') ?>">Dasar Hukum</a>
                        </div>
                        <div class="element hidden-xs hidden-sm">
                            <a href="javascript:void(0)" onclick="hubungi_wa(`+62111146288`,`Halo Admin, Saya butuh bantuan perihal..`)"><img src="<?php echo base_url()?>assets/mytemplate/img/icon-call.png" alt="" height="30px"><span>Bermasalah saat belanja? Hubungi kami: 08111146288</span></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 col-xs-12 flex-right">
                    <div class="topbar-right">
                        
                        <?php if ($this->user_model->is_umkm_user() || $this->user_model->is_umkm_penjual()) {
                            if ($this->user_model->is_umkm_user() && !$this->user_model->is_umkm_penjual()) {
                                $status = $this->user_model->cek_status_umkm();
                                if ($status) { 
                                    $t = 'Status Toko';
                                }else{ 
                                    $t = 'Daftar Toko';
                                } ?>

                                <!-- <div class="element element-currency col-md-6 col-sm-6 col-xs-6" style="text-align: right;">
                                    <a href="<?= base_url('customer/umkm') ?>" title="<?= $t ?>" class="btn btn-sm e-checkout btn-blue">
                                        <img src="<?php echo base_url()?>assets/mytemplate/img/icons8-online-store-32.png" alt="" width="19px">
                                        <span style="color: white;"><?= $t ?></span>
                                    </a>
                                </div> -->
                            <?php } ?>

                            <div class="element element-leaguage col-md-8 col-sm-8 col-xs-8" style="text-align: right;">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" id="label2">
                                    <img src="<?php echo base_url()?>assets/mytemplate/img/icon-user.png" alt="" width="19px">
                                    <span><?php echo $this->session->nama_lengkap; ?></span>
                                    <span class="ion-ios-arrow-down f-10 e-arrow"></span>
                                </a>
                                <div class="dropdown-menu dropdown-cart">
                                    <?php if ($this->user_model->is_umkm_admin()) { ?>
                                        <ul class="mini-products-list">
                                            <li class="item-cart">
                                                <a class="<?php echo ($active == 'wishlist'?'active-menu':'')?>" href="<?php echo base_url('dashboard') ?>"><img src="<?php echo base_url()?>assets/mytemplate/img/icon-user.png" alt="" width="19px"> Dashboard</a>
                                            </li>
                                        </ul>
                                    <?php }else{?>
                                        <ul class="mini-products-list">
                                            <li class="item-cart">
                                                <a class="<?php echo ($active == 'biodata'?'active-menu':'')?>" href="<?php echo base_url('customer/biodata') ?>">Biodata</a>
                                            </li>
                                            <li class="item-cart">
                                                <a class="<?php echo ($active == 'alamat'?'active-menu':'')?>" href="<?php echo base_url('customer/daftar-alamat') ?>">Alamat</a>
                                            </li>
                                            <li class="item-cart">
                                                <a class="<?php echo ($active == 'transaksi_customer'?'active-menu':'')?>" href="<?php echo base_url('transaksi/customer') ?>">Pembelian</a>
                                            </li>
                                            <li class="item-cart">
                                                <a class="<?php echo ($active == 'wishlist'?'active-menu':'')?>" href="<?php echo base_url('wishlist') ?>">Produk Favorit</a>
                                            </li>
                                        </ul>
                                    <?php } ?>
                                    
                                    <div class="bottom-cart" style="margin-top: 10px;">
                                        <div class="button-cart pull-right">
                                            <a href="<?php echo base_url('keluar') ?>" class="cart-btn e-checkout btn-gradient" style="color:white;">Keluar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php }else{
                            if($this->user_model->is_login()){ ?>
                                <a href="<?php echo base_url('keluar') ?>" class="btn btn-sm e-checkout btn-blue">Keluar</a>
                            <?php }else{ ?>
                                <a href="<?php echo base_url('login') ?>" class="btn btn-sm e-checkout btn-blue">Masuk / Daftar</a>
                            <?php }
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="header-center header-fixed" id="myHeader">
        <div class="container container-240">
            <div class="row flex">
                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6 v-center header-logo">
                    <a href="<?php echo base_url(); ?>">
                        <!-- <div class="header-sub-element">
                            <div class="sub-left">
                                <img src="<?php echo base_url(); ?>assets/images/logo.png" alt="" width="80px">
                            </div>
                            <div class="sub-right">
                                <span style="font-size: 13px;"><b>Yazeri Indonesia Moslem Clothes no 1 di indonesia</b></span>
                            </div>
                        </div> -->
                        <img src="<?php echo base_url(); ?>assets/images/borongsaylogomedium.png" alt="" class="img-reponsive logo-atas">
                    </a>
                </div>
                <div class="col-lg-7 col-md-7 v-center header-search hidden-xs hidden-sm">
                    <form method="get" class="searchform ajax-search" action="<?php echo base_url('list-produk') ?>" role="search" style="margin-left: -80px;margin-right: -50px;">
                        <input type="text" name="cari" class="form-control form-cari" placeholder="Cari produk..." value="<?php echo htmlentities($this->input->get('cari',true), ENT_QUOTES, 'UTF-8') ?>" required>
                        <ul class="list-product-search hidden-xs hidden-sm" style="overflow-y: scroll; height:400px;">
                        </ul>
                        <div class="search-panel">
                            <div class="col-sm-10" style="margin-left: -20px;">
                            <select name="kat" class="form-control form-control-sm" style="font-size: 12px !important;">
                                <option value="">Semua Kategori</option>
                                <?php 
                                $url = $this->uri->segment(3);
                                $kat = $kat = htmlentities($this->input->get('kat',true), ENT_QUOTES, 'UTF-8');
                                foreach ($kategori as $value) {
                                    if($url == url($value->nama_usaha) || $kat == url($value->nama_usaha)){
                                        $selected = 'selected';
                                    }else{
                                        $selected = '';
                                    }
                                    echo '<option '.$selected.' value="'.url($value->nama_usaha).'">'.$value->nama_usaha.'</option>';
                                } 
                                ?>
                            </select>
                            </div>
                        </div>
                        <span class="input-group-btn">
                            <button class="button_search" type="submit"><i class="ion-ios-search-strong"></i></button>
                        </span>
                    </form>
                    <div class="search-aoutocomplte-list"></div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 v-center header-sub">
                    <div class="right-panel">
                        <div class="header-sub-element row">
                            <?php if ($this->user_model->is_umkm_user() || $this->user_model->is_umkm_penjual()) { ?>
                                <div class="cart" title="Notifikasi">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" id="label5">
                                        <img src="<?php echo base_url()?>assets/mytemplate/img/icons8-notification-24.png" alt="" width="30px" style="min-width: 12px;">
                                        <span class="count-notif-all"></span>
                                        <input type="hidden" name="count_notif_all" id="count_notif_all" value="0">
                                    </a>
                                    <div class="dropdown-menu dropdown-cart">
                                        <div style="overflow-y: scroll; height:400px;">
                                            <ul class="mini-products-list notif-list">
                                                
                                            </ul>
                                        </div>

                                        <div class="bottom-cart" style="margin-top: 10px;">
                                            <div class="button-cart pull-right">
                                                <a href="<?php echo base_url('notif'); ?>" class="cart-btn e-checkout btn-gradient">Lihat Notifikasi</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- <a href="<?php echo base_url('pesan') ?>" class="cart" title="Pesan">
                                    <img src="<?php echo base_url()?>assets/mytemplate/img/icons8-envelope-24.png" alt="" width="30px" style="min-width: 12px;">
                                    <span class="count-pesan-all"></span>
                                    <input type="hidden" name="count_pesan_all" id="count_pesan_all" value="0">
                                </a> -->
                                <a href="<?php echo base_url('wishlist') ?>" title="Favorit"><img src="<?php echo base_url()?>assets/mytemplate/img/icon-heart.png" alt="" style="min-width: 12px;"></a>
                            <?php } ?>
                            
                            <div class="cart" title="Keranjang">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" id="label5">
                                    <img src="<?php echo base_url()?>assets/mytemplate/img/icon-cart.png" alt="" style="min-width: 12px;">
                                    <span class="count cart-count jumlah_keranjang"><?php echo $jml_keranjang; ?></span>
                                    <input type="hidden" name="jumlah_keranjang" value="<?php echo $jml_keranjang; ?>">
                                </a>
                                <div class="dropdown-menu dropdown-cart">
                                    <div style="overflow-y: scroll; height:400px;">
                                        <ul class="mini-products-list cart-list">
                                            <?php if ($keranjang) {
                                                $i = 0; 
                                                foreach ($keranjang as $value) { ?>
                                                    <li class="item-cart <?php echo $value->id_produk; ?>">
                                                        <div class="product-img-wrap">
                                                            <a href="<?php echo base_url('list-produk/produk/'.short($value->kode_produk)) ?>">
                                                                <img src="<?php echo base_url('assets/produk/'.$value->username.'/'.$value->foto);?>" alt="" class="img-reponsive" style="width: 60px;object-fit: cover;height: 60px;">
                                                            </a>
                                                        </div>
                                                        <div class="product-details">
                                                            <div class="inner-left">
                                                                <div class="product-name"><a href="<?php echo base_url('list-produk/produk/'.short($value->kode_produk)) ?>"><?php echo readMore($value->nama_produk,50); ?> </a></div>
                                                                <div class="product-price">
                                                                    <?php if ($value->diskon > 0) : ?>
                                                                        <?php echo "Rp. ".rp($value->harga - $value->diskon_nominal); ?> <span id="notif_cart_qty_<?php echo $i; ?>">( x <?php echo $value->quantity; ?>)</span><br>
                                                                        <span style="text-decoration:line-through"><?php echo "Rp. ".rp($value->harga); ?></span>
                                                                    <?php else : ?>
                                                                        <?php echo "Rp. ".rp($value->harga); ?> <span id="notif_cart_qty_<?php echo $i; ?>">( x <?php echo $value->quantity; ?>)</span>
                                                                    <?php endif; ?>                                                                        
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div title="Hapus Produk dari Keranjang" class="e-del hapus-produk" data-id="<?php echo $value->id_produk; ?>"><i class="fa fa-trash"></i></div>
                                                    </li>
                                                <?php $i++; }
                                                
                                            }else{
                                                echo '<li class="item-cart">
                                                            <span>
                                                                <h3 style="font-size: 14px;font-weight: 600;line-height: 1.5; color:black;">TIDAK ADA PRODUK DI KERANJANG.</h3>
                                                                <br>
                                                                <a href="'.base_url('list-produk').'" class="btn-banner">Belanja sekarang <i class="ion-ios-arrow-forward"></i></a>
                                                            </span>
                                                      </li>';
                                            } ?>
                                        </ul>
                                    </div>

                                    <div class="bottom-cart" style="margin-top: 10px;">
                                        <div class="button-cart pull-right">
                                            <?php 
                                            if ($this->user_model->is_login()) {
                                                echo '<a href="'.base_url('keranjang').'" class="cart-btn e-checkout btn-gradient">Lihat Keranjang</a>';
                                            }else{
                                                echo '<a href="javascript:void(0)" onclick="proses_cart(1,`add_chart`)" class="cart-btn e-checkout btn-gradient">Lihat Keranjang</a>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <a href="javascript:void(0)" class="hidden-md hidden-lg icon-pushmenu js-push-menu">
                                <i class="fa fa-bars f-15"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row flex">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 v-center hidden-xs hidden-sm">
                <?php if (isset($paling_dicari)) { ?>
                    <div class="tags">
                        <span>Paling banyak dicari :</span>
                        <?php foreach ($paling_dicari as $value) {
                            echo '<a href="'.base_url('list-produk/produk/'.short($value->kode_produk)).'">'.text(readMore($value->nama_produk,50)).'</a>';
                        } ?>
                    </div>
                <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="header-bottom hidden-xs hidden-sm content">
        <div class="container container-240">
            <div class="row flex lr2">
                <div class="col-lg-3 widget-verticalmenu">
                    <div class="navbar-vertical">
                        <button class="navbar-toggles navbar-drop js-vertical-menu"><span>Kategori</span></button>
                    </div>
                    <div class="vertical-wrapper">
                        <ul class="vertical-group">

                            <?php
                            $url = $this->uri->segment(3);
                            foreach ($kategori as $value) {
                                if($url == url($value->nama_usaha)){
                                    $class = 'active-menu';
                                }else{
                                    $class = '';
                                }
                                echo '<li class="vertical-item level1 mega-parent">
                                        <a class="'.$class.'" href="'.base_url('list-produk/kategori/'.url($value->nama_usaha)).'"><img src="'.base_url().'assets/images/kategori/'.$value->icon.'" style="width:20px;" alt="icon"> '.$value->nama_usaha.'</a>
                                      </li>';
                             } 
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9 widget-left">
                    <div class="flex lr e-border">
                        <nav class="main-menu flex align-center">
                            <button type="button" class="icon-mobile e-icon-menu icon-pushmenu js-push-menu">
                                <span class="navbar-toggler-bar"></span>
                                <span class="navbar-toggler-bar"></span>
                                <span class="navbar-toggler-bar"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="myNavbar">
                                <ul class="nav navbar-nav js-menubar">
                                    <li class="level1">
                                        <a class="<?php echo ($active == 'beranda'?'active-menu':'') ?>" href="<?php echo base_url() ?>">
                                            Beranda
                                        </a>
                                    </li>
                                    <li class="level1">
                                        <a class="<?php echo ($active == 'list-produk'?'active-menu':'') ?>" href="<?php echo base_url('list-produk') ?>">
                                            Produk
                                        </a>
                                    </li>
                                    <li class="level1">
                                        <a class="<?php echo ($active == 'list-umkm'?'active-menu':'') ?>" href="<?php echo base_url('list-umkm') ?>">
                                            Toko
                                        </a>
                                    </li>
                                    <li class="level1">
                                        <a class="<?php echo ($active == 'list-agenda'?'active-menu':'') ?>" href="<?php echo base_url('agenda') ?>">
                                            Agenda
                                        </a>
                                    </li>
                                    <li class="level1">
                                        <a class="<?php echo ($active == 'list-berita'?'active-menu':'') ?>" href="<?php echo base_url('list-berita') ?>">
                                            Berita
                                        </a>
                                    </li>
                                    <li class="level1">
                                        <a class="<?php echo ($active == 'diskon'?'active-menu':'') ?>" href="<?php echo base_url('diskon') ?>">
                                            Tangerang Great Sale
                                            <span class="h-ribbon h-pos e-red">sale</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                        <div class="header-bottom-right hidden-xs hidden-sm">
                            <!-- <div class="header-sub-element hidden-xs hidden-sm" style="margin-top: 15px;">
                                <div class="sub-left">
                                    <img src="<?php echo base_url()?>assets/mytemplate/img/icon-call.png" alt="">
                                </div>
                                <div class="sub-right">
                                    <span style="font-size: 10px;">Bermasalah saat belanja? Hubungi kami.</span>
                                    <div class="phone" style="font-size: 16px;">08111146288 </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>