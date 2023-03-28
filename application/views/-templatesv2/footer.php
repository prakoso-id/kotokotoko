<footer>
    <div class="f-top" style="background-image: url('assets/mytemplate/img/footer_no_bg.png'); background-color: #f4f4f4; background-size: 80%;background-position: center;background-repeat: no-repeat;background-position: bottom;">
        <div class="container container-240">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <div class="footer-block footer-about">
                        <div class="f-logo">
                            <a href="<?php echo base_url(); ?>">
                                <div class="header-sub-element">
                                    <div class="sub-left">
                                        <img src="<?php echo base_url(); ?>assets/images/logo.png" alt="" width="50px">
                                    </div>
                                    <div class="sub-right" style="margin-top:3px;">
                                        <span style="font-size: 15px;"><b>Yazer Indonesia Moslem Clothes no 1 di indonesia</b></span>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <ul class="footer-block-content">
                            <li>
                                <span>Copyright © 2020 Dinas Koperasi & UMKM - Pemerintah Kota Tangerang</span>
                            </li>
                            <li class="address">
                                <span>Jl. Perintis Kemerdekaan No.1 Cikokol, Tangerang.</span>
                            </li>
                            <li class="phone">
                                <span>(021) 55798288, 5517542, Fax : (021) 5517542</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    <div class="footer-block">
                        <h3 class="footer-block-title">Kategori</h3>
                        <div class="row">
                            <?php
                            $url = $this->uri->segment(3);
                            $jum_kat = count($kategori);
                            $split = ($jum_kat / 3) + 1;
                            $arr_kat = array_chunk($kategori,(int)$split);

                            foreach ($arr_kat as $k) {
                                echo '<div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
                                        <ul class="footer-block-content">';
                                foreach ($k as $value) {
                                    if($url == url($value->nama_usaha)){
                                        $class = 'active-menu';
                                    }else{
                                        $class = '';
                                    }

                                    echo '<li><a class="'.$class.'" href="'.base_url('list-produk/kategori/'.url($value->nama_usaha)).'"><img src="'.base_url().'assets/images/kategori/'.$value->icon.'" style="width:20px;" alt="icon"> '.$value->nama_usaha.'</a></li>';
                                } 
                                echo '</ul>
                                    </div>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2">
                    <div class="footer-block">
                        <h3 class="footer-block-title">Menu</h3>
                        <ul class="footer-block-content">
                            <li><a class="<?php echo ($active == 'beranda'?'active-menu':'') ?>" href="<?php echo base_url() ?>">Beranda</a></li>
                            <li><a class="<?php echo ($active == 'list-umkm'?'active-menu':'') ?>" href="<?php echo base_url('list-umkm') ?>">UMKM</a></li>
                            <li><a class="<?php echo ($active == 'list-produk'?'active-menu':'') ?>" href="<?php echo base_url('list-produk') ?>">Produk</a></li>
                            <li><a class="<?php echo ($active == 'list-berita'?'active-menu':'') ?>" href="<?php echo base_url('list-berita') ?>">Berita</a></li>
                            <li><a class="<?php echo ($active == 'list-agenda'?'active-menu':'') ?>" href="<?php echo base_url('list-agenda') ?>">Agenda</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <div class="footer-block">
                        <div class="footer-block-phone">
                            <h3 class="footer-block-title">Hot Line</h3>
                            <div class="header-sub-element">
                                <div class="sub-left">
                                    <img src="http://172.16.10.57/umkm/assets/mytemplate/img/icon-call.png" alt="">
                                </div>
                                <div class="sub-right">
                                    <span style="font-size: 10px;">Bermasalah saat belanja? Hubungi kami.</span>
                                    <div class="phone" style="font-size: 16px;">(+123) 456 789 </div>
                                </div>
                            </div>
                        </div>
                        <div class="footer-block-newsletter">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="f-bottom">
        <div class="container container-240">
            <div class="row flex lr">
                <div class="col-xs-6 f-copyright"><span>© 2020 <a href="https://diskominfo.tangerangkota.go.id/" target="_blank"><strong style="color: white;">Diskominfo Kota Tangerang</strong></a>. All rights reserved.</span></div>
                <div class="col-xs-6 f-payment hidden-xs">
                    
                </div>
            </div>
        </div>
    </div>
</footer>