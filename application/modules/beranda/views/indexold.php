<style type="text/css">
    /*.product-item {
        margin-bottom:15px !important;
    }*/
    .product-grid {
        padding-top: 30px !important;
    }
</style>
<!-- Slide -->
<div class="ads-group v2 bd-slick content">
    <div class="container container-240">
        <div class="row">
            <div class="col-md-8 col-sm-8 col-xs-12">
                <div class="e-slide js-slider-3items">
                    <?php foreach ($slider as $value) { ?>
                        <div class="e-slide-img">
                            <a href="<?php echo $value->url; ?>" target="_blank">
                                <img src="<?php echo base_url('assets/images/slider/'.$value->image);?>" alt="" class="img-responsive">
                                <div class="slide-content v1">
                                    <!-- <p class="cate"></p> -->
                                    <!-- <h3></h3> -->
                                    <!-- <p class="sale"> <span class="red"> </span> </p> -->
                                    <!-- <a href="<?php echo base_url('list-produk'); ?>" class="slide-btn e-pink-gradient">Shop now<i class="ion-ios-arrow-forward"></i></a> -->
                                </div>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="row">
                    <?php foreach ($banner_produk as $value) { ?>
                       <div class="col-md-12 banner-img-item">
                            <div class="banner-img banner-img2">
                                <a href="<?php echo $value->url; ?>" target="_blank"><img src="<?php echo base_url('assets/images/banner_produk/'.$value->image)?>" alt="" class="img-responsive"></a>
                                <div class="h-banner-content v4">
                                    <p class="content-name" style="color: #fff;text-shadow: 2px 1px #7e7d7d;"><?php echo $value->title; ?></p>
                                    <br>
                                    <!-- <p class="content-price">From <span class="red">29.99</span></p> -->
                                    <a href="<?php echo $value->url; ?>" class="btn-banner">Beli Sekarang<i class="ion-ios-arrow-forward"></i></a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<center style="margin-bottom: 30px;"><h2>Lagi Trending, nih !</h2></center>

<div class="e-feature" style="margin-bottom: 0px; padding-bottom: 0px !important;">
    <div class="container container-240">
        <div class="row">
            <?php 
            foreach ($kategori as $value) {
                 if ($value->is_show_home == 1) {
                     echo '<div class="col-xs-12 col-sm-4 col-md-4 feature-item">
                            <div class="banner-img banner-img2">
                                <a href="'.base_url().'list-produk/kategori/'.url($value->nama_usaha).'"><img src="'.base_url().'assets/images/kategori/'.$value->banner.'" alt="" class="img-responsive"></a>
                                <div class="h-banner-content v5">
                                    <p class="content-name" style="color:white; text-shadow: 1px 1px #dbdbdb;">'.$value->nama_usaha.'</p>
                                    <p class="content-price"></p>
                                    <a href="'.base_url('list-produk/kategori/'.url($value->nama_usaha)).'" class="btn-banner" style="color:white;">Belanja sekarang<i class="ion-ios-arrow-forward"></i></a>
                                </div>
                            </div>
                        </div>';
                 }
            } ?>
        </div>
    </div>
</div>

<!-- Product tab gradient -->
<div class="releases spc1 bg-gradient bg-insinde" style="padding-bottom: 30px !important;padding-top: 30px !important;">
    <div class="container container-240">
        <div class="ecome-heading style2 spc5" style="margin-bottom: 0px !important;">
            <ul class="product-tab-sw v2">
                <li class="active"><a data-toggle="tab" href="#terbaru" aria-expanded="true">Produk Terbaru</a></li>
                <li class=""><a data-toggle="tab" href="#top-rated" aria-expanded="false">Produk Favorit</a></li>
            </ul>
            <a href="<?php echo base_url('list-produk'); ?>" class="btn-show">Lihat Semua<i class="ion-ios-arrow-forward"></i></a>
        </div>
        <div class="tab-content">
            <div id="terbaru" class="tab-pane fade in active">
                <div class="owl-carousel owl-theme owl-cate v3 js-owl-cate">
                    <?php 
                    if ($terbaru) {
                        foreach ($terbaru as $value){ 
                            echo card_produk($value,'product-grid product-grid-v2');
                        }
                    } 
                    ?>
                </div>
            </div>
            <div id="top-rated" class="tab-pane fade">
                <div class="owl-carousel owl-theme owl-cate v3 js-owl-cate">
                    <?php 
                    if ($populer) {
                        foreach ($populer as $value){ 
                            echo card_produk($value,'product-grid product-grid-v2');
                        }
                    } 
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<center style="margin-bottom: 30px; margin-top: 30px;"><h2>Lagi Cari Kategori Apa ?</h2></center>

<div class="homepage-banner bg-gradient bg-insinde">
    <div class="container container-240">
        <div class="row">
            <?php foreach ($kategori as $value) { ?>
                <div class="col-md-2 col-sm-2 col-xs-6" style="margin-bottom: 20px;">
                    <div class="banner-img banner-img2">
                        <?php 
                        if ($value->banner) {
                            $url_image = base_url('assets/images/kategori/'.$value->banner);
                        }else{
                            $url_image = base_url('assets/mytemplate/img/b-product1.jpg');
                        }
                        ?>
                        <a href="<?php echo base_url('list-produk/kategori/'.url($value->nama_usaha)); ?>"><img src="<?php echo $url_image; ?>" alt="" class="img-responsive"></a>
                        <div class="h-banner-content v6">
                            <p class="content-name"><a style="color:white; text-shadow: 1px 1px #dbdbdb;" href="<?php echo base_url('list-produk/kategori/'.url($value->nama_usaha)); ?>"><?php echo $value->nama_usaha; ?></a></p>
                        </div>
                    </div>
                </div>
            <?php } ?>
            
        </div>
    </div>
</div>

<div class="our-blog" style="padding-top: 10px;padding-bottom: 0px;margin-bottom: 10px;">
    <div class="container container-240">
        <div class="ecome-heading style2">
            <div class="title-icon t-inline t-line">
                <i class="fa fa-newspaper-o fa-3x fa-gradient"></i>
                <h1>Berita</h1>
            </div>
            <a href="<?php echo base_url('list-berita'); ?>" class="btn-show">Lihat Semua<i class="ion-ios-arrow-forward"></i></a>
        </div>
        <p class="ecome-info spc2" style="margin-bottom: 30px;"></p>
        <div class="product-tab-pd owl-carousel owl-theme js-owl-blog owl-custom-dots v2">
            <?php 
            if ($berita) {
                foreach ($berita as $value) { 
                    echo card_berita($value);
                }
            } 
            ?>
        </div>
    </div>
</div>
<!-- End blog