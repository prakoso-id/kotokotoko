<style type="text/css">
	.icon-foto{
		font-size: 55px;
		font-weight: 700;
    	color: #fff;
    	text-align: center;
    	width: 80px;
    	height: 80px;
    	border: 1px solid #f0f0f0;
		border-radius: 5px;
	}

	.image-produk {
		width: 70px;
		height: 70px;
		object-fit: cover;
		display: block;
		margin-left: auto;
		margin-right: auto;
		border: 1px solid #f0f0f0;
		border-radius: 5px;
	}
	
	.image-umkm {
		width: 80px;height:80px;object-fit:cover;
		border: 1px solid #f0f0f0;
		border-radius: 5px;
	}

	.image-umkm:hover {
    color: #fff;
    -webkit-box-shadow: 0px 2px 20px 2px rgba(194, 106, 245, 0.68);
            box-shadow: 0px 2px 20px 2px rgba(194, 106, 245, 0.68); }

    .harga-produk {
    	color: rgb(250, 89, 29);
    	font-size: 10px;
    }

    .harga-produk-diskon {
        color: #aaaaaa;
        font-size: 10px;
        text-decoration:line-through;
    }
</style>
<div class="container container-240 shop-collection">
    <ul class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>">Beranda</a></li>
        <li class="active">Toko</li>
    </ul>
    <div class="filter-collection-left hidden-lg hidden-md">
      <a class="btn btn-gradient">Filter</a>
    </div>
    <div class="row shop-colect">
        <div class="col-md-3 col-sm-3 col-xs-12 col-left collection-sidebar" id="filter-sidebar">
            <div class="close-sidebar-collection hidden-lg hidden-md">
                <span>filter</span><i class="icon_close ion-close"></i>
            </div>

            <div class="filter filter-group">
                <h1 class="widget-blog-title">Pencarian Toko</h1>
                <div class="filter-brand filter-inside">
                    <div class="filter-content" style="margin-top: 10px; padding-right: 23px;">
                        <div class="input-group col-md-12 col-sm-12 col-xs-12">
                            <input type="hidden" class="form-control" id="cari_produk_kategori_old" value="<?php echo htmlentities($this->input->get('cari',true), ENT_QUOTES, 'UTF-8') ?>">
                            <input type="text" class="form-control" id="cari_produk_kategori" placeholder="Cari" value="<?php echo htmlentities($this->input->get('cari',true), ENT_QUOTES, 'UTF-8') ?>">
                            <div class="input-group-btn">
                              <button class="btn btn-blue" id="btn_cari_produk_kategori" type="button">
                                <i class="glyphicon glyphicon-search"></i>
                              </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="filter filter-cate">
            	<h1 class="widget-blog-title" style="padding-top: 17px;">Kategori Toko</h1>
                <ul class="wiget-content v2">
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
            <div class="filter filter-group">
                <h1 class="widget-blog-title">Lokasi</h1>
                <div class="filter-brand filter-inside">
                    <ul class="e-filter brand-filter">
                        <?php 
                        $kec = htmlentities($this->input->get('kec',true), ENT_QUOTES, 'UTF-8');

                        if (!$kec) {
                            $class = 'active-menu';
                        }else{
                            $class = '';
                        }

                        echo '<li><a href="javascript:void(0);" onclick="set_url(`kec`,``,`'.$kec.'`)" class="'.$class.'">Semua Lokasi</a></li>';

                        foreach ($m_kecamatan as $value) {
                            if ($kec === $value->no_kec) {
                                $class = 'active-menu';
                            }else{
                                $class = '';
                            }
                            echo '<li><a href="javascript:void(0);" onclick="set_url(`kec`,`'.$value->no_kec.'`,`'.$kec.'`)" class="'.$class.'">'.$value->nama_kec.'</a></li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-9 col-sm-12 col-xs-12 collection-list">
            <div class="e-product">
                <div class="pd-banner">
                   <a href="javascript:void(0);" class="image-bd effect_img2"><img src="<?php echo base_url(); ?>assets/images/banner_umkm.jpg" alt="" class="img-reponsive"></a> 
                </div>
                <div class="pd-top">
                    <h1 class="title">Toko</h1>
                    <div class="show-element"><span><?= 'Menampilkan '.rp($count_s).'-'.rp($count_e).' dari '.rp($count_all).' data'; ?></span></div>
                </div>

                <div class="row engoc-equal-row">
                <?php 
                if ($umkm) {
                    foreach ($umkm as $value) { 
                    	echo card_umkm($value);
                    }
                }else{ ?>
                	<div class="col-xs-12 col-sm-12 col-md-12">
	                    <div class="shopping-cart v2 bd-7">
	                        <div class="cmt-title text-center abs">
	                            <h1 class="page-title v4">Oppss..</h1>
	                            <div class="w-empty">
	                                <p>UMKM tidak ditemukan !</p>
	                            </div>
	                        </div>
	                    </div>
                	</div>
                <?php } ?>
                </div>

                <div class="pd-middle space-v1">
                    <!--Tampilkan pagination-->
                    <?php echo $pagination; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
      	
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