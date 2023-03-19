<div class="container container-240 shop-collection">
    <ul class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>">Beranda</a></li>
        <li class="active">Produk Favorit Saya</li>
    </ul>
    <div class="row shop-colect">
    	<div class="col-md-12 col-sm-12 col-xs-12 collection-list">
            <div class="e-product">
                <div class="pd-top">
                    <h1 class="title">Produk Favorit Saya</h1>
                    <div class="show-element"><span><?= 'Menampilkan '.$count_s.'-'.$count_e.' dari '.$count_all.' data'; ?></span></div>
                </div>
                <div class="row">
                	<div class="col-md-12">
	                	<div class="input-group col-md-3 col-sm-4 col-xs-12" style="float: right;">
	                        <input type="hidden" class="form-control" id="cari_produk_old" value="<?php echo htmlentities($this->input->get('cari',true), ENT_QUOTES, 'UTF-8') ?>">
	                        <input type="text" class="form-control" id="cari_produk" placeholder="Cari di favorit saya" value="<?php echo htmlentities($this->input->get('cari',true), ENT_QUOTES, 'UTF-8') ?>">
	                        <div class="input-group-btn">
	                          <button class="btn btn-blue" id="btn_cari_produk" type="button">
	                            <i class="glyphicon glyphicon-search"></i>
	                          </button>
	                        </div>
	                    </div>
                    </div>
                </div>
                <div class="pd-middle">
                    <div class="view-mode view-group">
                        <a class="grid-icon col"><img src="<?php echo base_url() ?>assets/mytemplate/img/grid.png" alt=""></a>
                        <a class="grid-icon col2 active"><img src="<?php echo base_url() ?>assets/mytemplate/img/grid2.png" alt=""></a>
                        <a class="list-icon list"><img src="<?php echo base_url() ?>assets/mytemplate/img/list.png" alt=""></a>
                    </div>
                    <div class="pd-sort">
                        <div class="filter-show">
                            <div class="dropdown">
                                  <button class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                      Menampilkan
                                        <?php
                                        $limit = htmlentities($this->input->get('limit',true), ENT_QUOTES, 'UTF-8'); 
                                        if ($limit != '') {
                                            echo '<span class="dropdown-label">'.$limit.'</span>';
                                        }else{
                                            echo '<span class="dropdown-label">16</span>';
                                        } ?>
                                  </button>
                                  <ul class="dropdown-menu">
                                      <li><a href="javascript:void(0);" onclick="set_url('limit','16','<?php echo $limit; ?>')">16</a></li>   
                                      <li><a href="javascript:void(0);" onclick="set_url('limit','32','<?php echo $limit; ?>')">32</a></li>
                                      <li><a href="javascript:void(0);" onclick="set_url('limit','64','<?php echo $limit; ?>')">64</a></li>
                                      <li><a href="javascript:void(0);" onclick="set_url('limit','128','<?php echo $limit; ?>')">128</a></li>
                                  </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-collection-grid product-grid product-grid-v2">
                    <div class="row">
                        <?php 
                        if ($wishlist) {
                            foreach ($wishlist as $value) {
                                echo card_produk($value,'col-xs-6 col-sm-6 col-md-3 col-lg-3');
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
                        <div class="filter-show">
                            <div class="dropdown">
                                  <button class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                      Menampilkan
                                        <?php
                                        $limit = htmlentities($this->input->get('limit',true), ENT_QUOTES, 'UTF-8'); 
                                        if ($limit != '') {
                                            echo '<span class="dropdown-label">'.$limit.'</span>';
                                        }else{
                                            echo '<span class="dropdown-label">16</span>';
                                        } ?>
                                  </button>
                                  <ul class="dropdown-menu">
                                      <li><a href="javascript:void(0);" onclick="set_url('limit','16','<?php echo $limit; ?>')">16</a></li>   
                                      <li><a href="javascript:void(0);" onclick="set_url('limit','32','<?php echo $limit; ?>')">32</a></li>
                                      <li><a href="javascript:void(0);" onclick="set_url('limit','64','<?php echo $limit; ?>')">64</a></li>
                                      <li><a href="javascript:void(0);" onclick="set_url('limit','128','<?php echo $limit; ?>')">128</a></li>
                                  </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php $this->load->view('keranjang/terakhir_dilihat'); ?>
</div>
<?php $this->load->view('js'); ?>