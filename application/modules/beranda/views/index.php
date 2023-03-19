<!-- Hero Section Begin -->
<section class="hero">
    <div class="hero__slider owl-carousel">
    <?php foreach ($slider as $value) { ?>
        
        <div class="hero__items set-bg" data-setbg="<?php echo base_url('assets/images/slider/'.$value->image);?>">
            <div class="container">
                <a href="<?php echo $value->url; ?>" >
                    <div class="row">
                        <div class="col-xl-5 col-lg-7 col-md-8">
                        </div>
                    </div>
                </a>
            </div>
        </div>
    <?php } ?>
        
    </div>
</section>
<!-- Hero Section End -->

<!-- Banner Section Begin -->
<section class="banner spad">
    <div class="container">
        <div class="row">
        <?php 
             $i=0;
             foreach ($kategori as $value) {
                  if ($value->is_show_home == 1) {
                     if($i== 0){
                        $col = 'col-lg-7 offset-lg-4';
                     }
                     switch ($i) {
                        case 0:
                            $col = 'col-lg-7 offset-lg-4';
                            $bannerItem ='';
                          break;
                        case 1:
                            $col = 'col-lg-5';
                            $bannerItem ='banner__item--middle';
                          break;
                        case 2:
                            $col = 'col-lg-7';
                            $bannerItem ='banner__item--last';
                          break;
                      }
                      echo '
                         <div class="'.$col.'">
                             <div class="banner__item '.$bannerItem.'">
                                 <div class="banner__item__pic">
                                     <img src="'.base_url().'assets/images/kategori/'.$value->banner.'" alt="">
                                 </div>
                                 <div class="banner__item__text">
                                     <h2>'.$value->nama_usaha.'</h2>
                                     <a href="'.base_url('list-produk/kategori/'.url($value->nama_usaha)).'">Shop now</a>
                                 </div>
                             </div>
                         </div>';
                         $i++;
                  }
            } ?>
        </div>
    </div>
</section>
<!-- Banner Section End -->

<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="filter__controls">
                    <li class="active" data-filter="*">Best Sellers</li>
                    <li data-filter=".new-arrivals">New Arrivals</li>
                    <li data-filter=".hot-sales">Hot Sales</li>
                </ul>
            </div>
        </div>
        <div class="row product__filter">
        <?php 
                if ($terbaru) {
                    foreach ($terbaru as $value){ 
                        echo '<div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix new-arrivals">';
                        echo card_produk($value,'product-grid product-grid-v2');
                        echo '</div>';
                    }
                } 
            ?>
            <?php 
                    if ($populer) {
                        foreach ($populer as $value){ 
                            echo '<div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix hot-sales">';
                            echo card_produk($value,'product-grid product-grid-v2');
                            echo '</div>';
                        }
                    } 
                    ?>
            
        </div>
    </div>
</section>
<!-- Product Section End -->

<!-- Categories Section Begin -->
<section class="categories spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="categories__text">
                    <h2>Clothings Hot <br /> <span>Shoe Collection</span> <br /> Accessories</h2>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="categories__hot__deal">
                    <img src="img/product-sale.png" alt="">
                    <div class="hot__deal__sticker">
                        <span>Sale Of</span>
                        <h5>$29.99</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 offset-lg-1">
                <div class="categories__deal__countdown">
                    <span>Deal Of The Week</span>
                    <h2>Multi-pocket Chest Bag Black</h2>
                    <div class="categories__deal__countdown__timer" id="countdown">
                        <div class="cd-item">
                            <span>3</span>
                            <p>Days</p>
                        </div>
                        <div class="cd-item">
                            <span>1</span>
                            <p>Hours</p>
                        </div>
                        <div class="cd-item">
                            <span>50</span>
                            <p>Minutes</p>
                        </div>
                        <div class="cd-item">
                            <span>18</span>
                            <p>Seconds</p>
                        </div>
                    </div>
                    <a href="#" class="primary-btn">Shop now</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Categories Section End -->

<!-- Instagram Section Begin -->
<section class="instagram spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="instagram__pic">
                    <div class="instagram__pic__item set-bg" data-setbg="img/instagram/instagram-1.jpg"></div>
                    <div class="instagram__pic__item set-bg" data-setbg="img/instagram/instagram-2.jpg"></div>
                    <div class="instagram__pic__item set-bg" data-setbg="img/instagram/instagram-3.jpg"></div>
                    <div class="instagram__pic__item set-bg" data-setbg="img/instagram/instagram-4.jpg"></div>
                    <div class="instagram__pic__item set-bg" data-setbg="img/instagram/instagram-5.jpg"></div>
                    <div class="instagram__pic__item set-bg" data-setbg="img/instagram/instagram-6.jpg"></div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="instagram__text">
                    <h2>Instagram</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua.</p>
                    <h3>#Male_Fashion</h3>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Instagram Section End -->

<!-- Latest Blog Section Begin -->
<section class="latest spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <span>Latest News</span>
                    <h2>Fashion New Trends</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic set-bg" data-setbg="img/blog/blog-1.jpg"></div>
                    <div class="blog__item__text">
                        <span><img src="img/icon/calendar.png" alt=""> 16 February 2020</span>
                        <h5>What Curling Irons Are The Best Ones</h5>
                        <a href="#">Read More</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic set-bg" data-setbg="img/blog/blog-2.jpg"></div>
                    <div class="blog__item__text">
                        <span><img src="img/icon/calendar.png" alt=""> 21 February 2020</span>
                        <h5>Eternity Bands Do Last Forever</h5>
                        <a href="#">Read More</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic set-bg" data-setbg="img/blog/blog-3.jpg"></div>
                    <div class="blog__item__text">
                        <span><img src="img/icon/calendar.png" alt=""> 28 February 2020</span>
                        <h5>The Health Benefits Of Sunglasses</h5>
                        <a href="#">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Latest Blog Section End -->