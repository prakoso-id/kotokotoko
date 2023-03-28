<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Produk</h4>
                    <div class="breadcrumb__links">
                        <a href="<?= base_url()?>">Home</a>
                        <span>Produk</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->
<div class="container container-240 shop-collection" style="margin-top:20px;">
    <div class="filter-collection-left hidden-lg hidden-md">
      <a class="btn btn-gradient">Filter</a>
    </div>
    <div class="row shop-colect">
        <div class="col-md-3 col-sm-3 col-xs-12 col-left collection-sidebar" id="filter-sidebar">
            <div class="shop__sidebar">
                        <!-- <div class="shop__sidebar__search">
                            <form action="#">
                                <input type="text" placeholder="Search...">
                                <button type="submit"><span class="icon_search"></span></button>
                            </form>
                        </div> -->
                        <div class="shop__sidebar__search">
                            <div class="filter-content" style="margin-top: 10px; padding-right: 23px;">
                                <div class="input-group col-md-12 col-sm-12 col-xs-12">
                                    <input type="hidden" class="form-control" id="cari_produk_kategori_old" value="<?php echo htmlentities($this->input->get('cari',true), ENT_QUOTES, 'UTF-8') ?>">
                                    <input type="text" class="form-control" id="cari_produk_kategori" placeholder="Cari" value="<?php echo htmlentities($this->input->get('cari',true), ENT_QUOTES, 'UTF-8') ?>">
                                    <div class="input-group-btn">
                                    <button class="btn btn-blue" id="btn_cari_produk_kategori" style="background:#170e0e !important;" type="button">
                                        <i class="glyphicon glyphicon-search"></i>
                                    </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="shop__sidebar__accordion">
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseOne">Categories</a>
                                    </div>
                                    <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__categories">
                                                <ul class="nice-scroll">
                                                    <?php 
                                                        $kat = htmlentities($this->input->get('kat',true), ENT_QUOTES, 'UTF-8');
                                                        if (!$kat) {
                                                            $class = 'active-menu';
                                                        }else{
                                                            $class = '';
                                                        }

                                                        echo '<li class="active"><a href="javascript:void(0);" onclick="set_url(`kat`,``,`'.$kat.'`)" class="'.$class.'">Semua Kategori</a></li>';
                                                        
                                                        foreach ($kategori as $value) {
                                                            $url_kat = url($value->nama_usaha);
                                                            if ($kat === $url_kat) {
                                                                $class = 'active-menu';
                                                            }else{
                                                                $class = '';
                                                            }
                                                            echo '<li class="active">
                                                                    <a href="javascript:void(0);" onclick="set_url(`kat`,`'.$url_kat.'`,`'.$kat.'`)" class="'.$class.'"><img src="'.base_url().'assets/images/kategori/'.$value->icon.'" style="width:20px;" alt="icon"> '.$value->nama_usaha.'</a>
                                                                </li>';
                                                        }
                                                    ?>
                                                   
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                               
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseFour">Harga</a>
                                    </div>
                                    <div id="collapseFour" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="filter-price filter-inside">
                                                
                                                <div class="filter-content">
                                                    <div class="price-range-holder">
                                                        <input type="text" class="price-slider" value="" name="filter_price">
                                                    </div>
                                                    <span class="min-max">
                                                        <span class="price-range">
                                                        <?php 
                                                        $filter_price = htmlentities($this->input->get('filter_price',true), ENT_QUOTES, 'UTF-8');
                                                        if ($filter_price != '') {
                                                            $p = explode(',', $filter_price);
                                                            echo 'Harga : Rp.'.rp($p[0]).' - Rp.'.rp($p[1]);
                                                        }else{
                                                            echo 'Harga: Rp.10.000 - Rp.100.000';
                                                        }
                                                        ?>
                                                        </span>
                                                    </span>
                                                    <a href="javascript:void(0);" onclick="set_url_price(`<?php echo $filter_price; ?>`)" class="btn-filter btn-gradient">Filter</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            
        </div>
        

        <div class="col-md-9 col-sm-12 col-xs-12 collection-list">
            <div class="e-product">
                <!-- <div class="pd-banner">
                   <a href="javascript:void(0);" class="image-bd effect_img2"><img src="<?php echo base_url(); ?>assets/images/banner_produk.jpg" alt="" class="img-reponsive"></a>  
                </div> -->
                <div class="pd-top">
                    <h1 class="title">Produk</h1>
                    <div class="show-element"><span><?= 'Menampilkan '.rp($count_s).'-'.rp($count_e).' dari '.rp($count_all).' data'; ?></span></div>
                </div>
                <div class="pd-middle">
                    <div class="view-mode view-group">
                        <a class="grid-icon col"><img src="<?php echo base_url() ?>assets/mytemplate/img/grid.png" alt=""></a>
                        <a class="grid-icon col2 active"><img src="<?php echo base_url() ?>assets/mytemplate/img/grid2.png" alt=""></a>
                        <a class="list-icon list"><img src="<?php echo base_url() ?>assets/mytemplate/img/list.png" alt=""></a>
                    </div>
                    <div class="pd-sort">
                        <div class="filter-sort">
                            <div class="dropdown">
                              <button class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <?php 
                                    $ob = htmlentities($this->input->get('ob',true), ENT_QUOTES, 'UTF-8');
                                    if ($ob != '') {
                                        echo '<span class="dropdown-label">'.str_replace('_', ' ', $ob).'</span>';
                                    }else{
                                        echo '<span class="dropdown-label">Urutkan</span>';
                                    }
                                    ?>
                              </button>
                              <ul class="dropdown-menu">
                                  <li><a href="javascript:void(0);"onclick="set_url(`ob`,`Terfavorit`,`<?php echo $ob; ?>`)">Terfavorit</a></li>   
                                  <li><a href="javascript:void(0);"onclick="set_url(`ob`,`Penjualan_Terbaik`,`<?php echo $ob; ?>`)">Penjualan Terbaik</a></li>
                                  <li><a href="javascript:void(0);"onclick="set_url(`ob`,`Abjad,_A-Z`,`<?php echo $ob; ?>`)">Abjad, A-Z</a></li>
                                  <li><a href="javascript:void(0);"onclick="set_url(`ob`,`Abjad,_Z-A`,`<?php echo $ob; ?>`)">Abjad, Z-A</a></li>
                                  <li><a href="javascript:void(0);"onclick="set_url(`ob`,`Harga,_termahal-termurah`,`<?php echo $ob; ?>`)">Harga, termahal - termurah</a></li>
                                  <li><a href="javascript:void(0);"onclick="set_url(`ob`,`Harga,_termurah-termahal`,`<?php echo $ob; ?>`)">Harga, termurah - termahal</a></li>
                                  <li><a href="javascript:void(0);"onclick="set_url(`ob`,`Tanggal,_terlama-terbaru`,`<?php echo $ob; ?>`)">Tanggal, terlama - terbaru</a></li>
                                  <li><a href="javascript:void(0);"onclick="set_url(`ob`,`Tanggal,_terbaru-terlama`,`<?php echo $ob; ?>`)">Tanggal, terbaru - terlama</a></li>
                              </ul>
                            </div>
                        </div>
                        <div class="filter-show">
                            <div class="dropdown">
                                  <button class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                      Menampilkan
                                        <?php
                                        $limit = htmlentities($this->input->get('limit',true), ENT_QUOTES, 'UTF-8'); 
                                        if ($limit != '') {
                                            echo '<span class="dropdown-label">'.$limit.'</span>';
                                        }else{
                                            echo '<span class="dropdown-label">12</span>';
                                        } ?>
                                  </button>
                                  <ul class="dropdown-menu">
                                      <li><a href="javascript:void(0);" onclick="set_url('limit','12','<?php echo $limit; ?>')">12</a></li>   
                                      <li><a href="javascript:void(0);" onclick="set_url('limit','24','<?php echo $limit; ?>')">24</a></li>
                                      <li><a href="javascript:void(0);" onclick="set_url('limit','36','<?php echo $limit; ?>')">36</a></li>
                                      <li><a href="javascript:void(0);" onclick="set_url('limit','48','<?php echo $limit; ?>')">48</a></li>
                                  </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-collection-grid product-grid product-grid-v2">
                    <div class="row">
                        <?php 
                        if ($produk) {
                            foreach ($produk as $value) {
                                echo '<div class="col-lg-4 col-md-6 col-sm-6">';
                                echo card_produk($value,'product-grid product-grid-v2');
                                echo '</div>';
                            }
                        }else{ ?>
                            <div class="shopping-cart v2 bd-7">
                                <div class="cmt-title text-center abs">
                                    <h1 class="page-title v4">Oppss..</h1>
                                    <div class="w-empty">
                                        <p>Produk tidak ditemukan !</p>
                                    </div>
                                </div>
                                
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <div class="pd-middle space-v1">
                    <!--Tampilkan pagination-->
                    <?php echo $pagination; ?>
                    <div class="pd-sort">
                        <div class="filter-sort">
                            <div class="dropdown">
                              <button class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <?php
                                    $ob = htmlentities($this->input->get('ob',true), ENT_QUOTES, 'UTF-8'); 
                                    if ($ob != '') {
                                        echo '<span class="dropdown-label">'.str_replace('_', ' ', $ob).'</span>';
                                    }else{
                                        echo '<span class="dropdown-label">Urutkan</span>';
                                    }
                                    ?>
                              </button>
                              <ul class="dropdown-menu">
                                  <li><a href="javascript:void(0);"onclick="set_url(`ob`,`Terfavorit`,`<?php echo $ob; ?>`)">Terfavorit</a></li>   
                                  <li><a href="javascript:void(0);"onclick="set_url(`ob`,`Penjualan_Terbaik`,`<?php echo $ob; ?>`)">Penjualan Terbaik</a></li>
                                  <li><a href="javascript:void(0);"onclick="set_url(`ob`,`Abjad,_A-Z`,`<?php echo $ob; ?>`)">Abjad, A-Z</a></li>
                                  <li><a href="javascript:void(0);"onclick="set_url(`ob`,`Abjad,_Z-A`,`<?php echo $ob; ?>`)">Abjad, Z-A</a></li>
                                  <li><a href="javascript:void(0);"onclick="set_url(`ob`,`Harga,_termahal-termurah`,`<?php echo $ob; ?>`)">Harga, termahal - termurah</a></li>
                                  <li><a href="javascript:void(0);"onclick="set_url(`ob`,`Harga,_termurah-termahal`,`<?php echo $ob; ?>`)">Harga, termurah - termahal</a></li>
                                  <li><a href="javascript:void(0);"onclick="set_url(`ob`,`Tanggal,_terlama-terbaru`,`<?php echo $ob; ?>`)">Tanggal, terlama - terbaru</a></li>
                                  <li><a href="javascript:void(0);"onclick="set_url(`ob`,`Tanggal,_terbaru-terlama`,`<?php echo $ob; ?>`)">Tanggal, terbaru - terlama</a></li>
                              </ul>
                            </div>
                        </div>
                        <div class="filter-show">
                            <div class="dropdown">
                                  <button class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                      Menampilkan
                                        <?php 
                                        $limit = htmlentities($this->input->get('limit',true), ENT_QUOTES, 'UTF-8');
                                        if ($limit != '') {
                                            echo '<span class="dropdown-label">'.$limit.'</span>';
                                        }else{
                                            echo '<span class="dropdown-label">12</span>';
                                        } ?>
                                  </button>
                                  <ul class="dropdown-menu">
                                      <li><a href="javascript:void(0);" onclick="set_url('limit','12','<?php echo $limit; ?>')">12</a></li>   
                                      <li><a href="javascript:void(0);" onclick="set_url('limit','24','<?php echo $limit; ?>')">24</a></li>
                                      <li><a href="javascript:void(0);" onclick="set_url('limit','36','<?php echo $limit; ?>')">36</a></li>
                                      <li><a href="javascript:void(0);" onclick="set_url('limit','48','<?php echo $limit; ?>')">48</a></li>
                                  </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        var filter_price = '<?php echo $filter_price; ?>';

        if (filter_price != '') {
            var p = filter_price.split(',');
            $('.price-slider').slider({
                min: 10000,
                max: 10000000,
                step: 10000,
                value: [parseInt(p[0]), parseInt(p[1])],
            });
        }

        $('.price-slider').slider({
            min: 10000,
            max: 10000000,
            step: 10000,
            value: [10000, 100000],
        });

        $(".price-slider").on("slide", function(slideEvt) {
            $('.price-range').text('Harga : Rp.'+format_uang(slideEvt.value[0])+' - Rp.'+format_uang(slideEvt.value[1]));
        }).on("change", function(val) {
            $('.price-range').text('Harga : Rp.'+format_uang(val.value.newValue[0])+' - Rp.'+format_uang(val.value.newValue[1]));
        });   
    });

    $('#btn_cari_produk_kategori').click(function() {
        var cari = $('#cari_produk_kategori').val();
        var cari_old = $('#cari_produk_kategori_old').val();
        set_url('cari',cari,cari_old);
    });

    $('#cari_produk_kategori').keyup(function(e){
        if(e.keyCode == 13){
            var cari = $('#cari_produk_kategori').val();
            var cari_old = $('#cari_produk_kategori_old').val();
            set_url('cari',cari,cari_old);
        }
    });

    function set_url_price(old_value=null){
        var new_value = $('[name="filter_price"]').val();
        set_url('filter_price',new_value,old_value);
    }

    function set_url(param,new_value='',old_value=null) {
        if(document.location.href.includes('?')) {
            var separator = '&';
        }else{
            var separator = '?';
        }

        if (document.location.href.includes(param)) {
            var url = document.location.href.replace(param+"="+encodeURIComponent(old_value), param+"="+encodeURIComponent(new_value));
        }else{
            var url = document.location.href+""+separator+""+param+"="+encodeURIComponent(new_value);
        }

        document.location = url;
    }
</script>