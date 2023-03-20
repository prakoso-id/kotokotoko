<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4><?php echo $berita->judul; ?></h4>
                    <div class="breadcrumb__links">
                        <a href="<?= base_url()?>">Beranda</a>
                        <a href="<?= base_url('list-berita')?>">Berita</a>
                        <span><?php echo $berita->judul; ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->
<div class="container container-240">
    <div class="blog spc1">
        <div class="blog-single-post">
            <div class="row">
            	<div class="blog-content  col-md-9  col-xs-12">
                    <div class="blog-post-item v2">
                        <div class="blog-img">
                            <a href="#" class="hover-images"><img src="<?php echo base_url('assets/images/berita/').$berita->foto; ?>" alt="" class="img-reponsive"></a>
                            <div class="blog-post-date e-gradient abs v2">
                                <span class="b-date"><?php echo $berita->tanggal; ?></span>
                                <span class="b-month"><?php echo tampil_bulan($berita->bulan); ?></span>
                            </div>
                        </div>
                        <div class="blog-info-bd">
                            <div class="blog-info">
                                <h3 class="blog-post-title v2"><?php echo $berita->judul; ?></h3>
                                <span>
                                    Posted by : <?php echo $berita->nama_pengguna; ?>
                                </span>
                                <br>
                                <span>
                                	<i class="fa fa-clock-o"></i>
                            		<?php echo indonesian_date($berita->created_at); ?>
                            	</span>
                                
                                <div class="blog-post-desc" style="margin-top: 10px;">
                                    <?php echo $berita->berita; ?>
                                </div>
                            </div>
                            <div class="blog-post-author v2">
                                <div class="blog-post-tags">
                                	<span>Bagikan : </span>
                                    <!-- AddToAny BEGIN -->
									<div class="a2a_kit a2a_kit_size_32 a2a_default_style">
									<a class="a2a_button_facebook"></a>
									<a class="a2a_button_twitter"></a>
									<a class="a2a_button_email"></a>
									<a class="a2a_button_whatsapp"></a>
									<a class="a2a_button_line"></a>
									<a class="a2a_button_print"></a>
									<a class="a2a_button_copy_link"></a>
									</div>
									<script>
									var a2a_config = a2a_config || {};
									a2a_config.onclick = 1;
									a2a_config.locale = "id";
									</script>
									<script async src="https://static.addtoany.com/menu/page.js"></script>
									<!-- AddToAny END -->
                                </div>

                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="blog-sidebar col-md-3 col-xs-12">
                    <div class="blog-widget blog-widget-popular">
                        <h1 class="widget-blog-title">Berita Lainnya</h1>
                        <div class="owl-carousel owl-theme js-owl-post">
                            <div class="item">
                            	<?php 
                            	if ($list_berita) {
                            		foreach ($list_berita as $value) { ?>
                            			<div class="post-item">
		                                    <div class="post-img">
		                                        <img style="max-width: 70px !important; width: 70px; height: 70px; object-fit:cover; display: block;margin-left: auto;margin-right: auto;" src="<?php echo base_url('assets/images/berita/').$value->foto; ?>" alt="">
		                                    </div>
		                                    <div class="post-info">
		                                        <h3><a href="<?php echo base_url('list-berita/berita/'.short($value->kode_berita)) ?>"><?php echo readMore($value->judul,100); ?></a></h3>
		                                        <p><?php echo indonesian_date_2($value->date); ?></p>
		                                    </div>
		                                </div>
                            		<?php }
                            		echo '<div class="post-item"><a href="'.base_url('list-berita').'" class="active-menu">Lihat Semua..</a></div>';
                            	}else{
                            		echo '<div class="post-item">Tidak ada berita lainnya..</div>';
                            	}
                            	?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>