<!-- Header Section Begin -->
<header class="header" id="myHeader">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-7">
                        <div class="header__top__left">
                            <p>Free shipping, 30-day return or refund guarantee.</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-5">
                        <div class="header__top__right">
                            <?php if ($this->user_model->is_umkm_user() || $this->user_model->is_umkm_penjual()) {?>
                                <div class="header__top__hover">
                                    <span><?php echo $this->session->nama_lengkap; ?> <i class="arrow_carrot-down"></i></span>
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
                                </div>
                            <?php } else{?>
                            <div class="header__top__links">
                                <a href="<?= base_url('login') ?>">Masuk/Daftar</a>
                            </div>
                            <?php }?>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="header__logo">
                        <a href="<?= base_url() ?>"><img src="<?= base_url('assets/templateFE2/') ?>img/logo.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            <li><a href="<?= base_url() ?>">Home</a></li>
                            <li><a href="<?= base_url('list-produk') ?>">Produk</a></li>
                            <!-- <li><a href="#">Pages</a>
                                <ul class="dropdown">
                                    <li><a href="./about.html">About Us</a></li>
                                    <li><a href="<?= base_url('list-produk') ?>">Produk</a></li>
                                    <li><a href="./shopping-cart.html">Shopping Cart</a></li>
                                    <li><a href="./checkout.html">Check Out</a></li>
                                    <li><a href="./blog-details.html">Blog Details</a></li>
                                </ul>
                            </li> -->
                            <li><a href="<?= base_url('list-berita') ?>">News</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="header__nav__option">
                        <div class="row d-flex justify-content-end">
                            <div class="px-5">
                                <a href="#" class="search-switch"><img src="<?= base_url('assets/templateFE2/')?>/img/icon/search.png" alt=""></a>
                            </div>                            
                            <div class="px-5">
                                <a href="#"><img src="<?= base_url('assets/templateFE2/')?>/img/icon/heart.png" alt=""></a>
                            </div>
                            <div class="cart px-5" title="Keranjang">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                    aria-haspopup="true" aria-expanded="false" id="label5">
                                    <img src="<?= base_url('assets/templateFE2/')?>/img/icon/cart.png" />
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
                                                    <a
                                                        href="<?php echo base_url('list-produk/produk/'.short($value->kode_produk)) ?>">
                                                        <img src="<?php echo base_url('assets/produk/'.$value->username.'/'.$value->foto);?>"
                                                            alt="" class="img-reponsive"
                                                            style="width: 60px;object-fit: cover;height: 60px;">
                                                    </a>
                                                </div>
                                                <div class="product-details">
                                                    <div class="inner-left">
                                                        <div class="product-name"><a
                                                                href="<?php echo base_url('list-produk/produk/'.short($value->kode_produk)) ?>"><?php echo readMore($value->nama_produk,50); ?>
                                                            </a></div>
                                                        <div class="product-price">
                                                            <span>Ukuran : <?php echo $value->size; ?></span>
                                                            <br>
                                                            <?php if ($value->diskon > 0) : ?>
                                                            <?php echo "Rp. ".rp($value->harga - $value->diskon_nominal); ?>
                                                            <span id="notif_cart_qty_<?php echo $i; ?>">( x
                                                                <?php echo $value->quantity; ?>)</span><br>
                                                            <span
                                                                style="text-decoration:line-through"><?php echo "Rp. ".rp($value->harga); ?></span>
                                                            <?php else : ?>
                                                            <?php echo "Rp. ".rp($value->harga); ?> <span
                                                                id="notif_cart_qty_<?php echo $i; ?>">( x
                                                                <?php echo $value->quantity; ?>)</span>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div title="Hapus Produk dari Keranjang" class="e-del hapus-produk"
                                                    data-id="<?php echo $value->id_produk; ?>"data-size="<?php echo $value->size; ?>"><i class="fa fa-trash"></i>
                                                </div>
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
                        </div>

                        <!-- <div class="price"><?php echo $jml_keranjang; ?></div> -->
                    </div>
                </div>
            </div>
            <div class="canvas__open"><i class="fa fa-bars"></i></div>
        </div>
    </header>
    <!-- Header Section End -->