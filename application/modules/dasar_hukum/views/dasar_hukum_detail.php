<div class="container container-240">
    <div class="blog-banner pd-banner v2">
       <a href="#" class="effect_img2"><img src="<?php echo base_url(); ?>assets/mytemplate/img/blog/blog-banner.png" alt="" class="img-reponsive"></a> 
    </div>
    <div class="blog spc1">
        <ul class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>">Beranda</a></li>
            <li><a href="<?php echo base_url('dasar_hukum'); ?>">Dasar Hukum</a></li>
            <li class="active"><?php echo $berita->judul; ?></li>
        </ul>
        <div class="blog-single-post">
            <div class="row">
            	<div class="blog-content  col-md-9  col-xs-12">
                    <div class="blog-post-item v2">
                        <div class="blog-info-bd">
                            <div class="blog-info" style="padding: 20px 39px 30px 41px;">
                                <h3 class="blog-post-title v2"><?php echo $berita->judul; ?></h3>
                                <span>
                                	<i class="fa fa-clock-o"></i>
                            		<?php echo indonesian_date($berita->created_at); ?>
                            	</span>
                                
                                <div class="blog-post-desc" style="margin-top: 10px;">
                                    <?php echo $berita->keterangan; ?>
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
                        <h1 class="widget-blog-title">Dasar Hukum Lainnya</h1>
                        <div class="owl-carousel owl-theme js-owl-post">
                            <div class="item">
                            	<?php 
                            	if ($list_berita) {
                            		foreach ($list_berita as $value) { ?>
                            			<div class="post-item">
		                                    <div class="post-info">
		                                        <h3><a href="<?php echo base_url('dasar_hukum/detail'.short($value->kode_dasar_hukum)) ?>"><?php echo readMore($value->judul,100); ?></a></h3>
		                                        <p><?php echo indonesian_date_2($value->date); ?></p>
		                                    </div>
		                                </div>
                            		<?php }
                            		echo '<div class="post-item"><a href="'.base_url('dasar_hukum').'" class="active-menu">Lihat Semua..</a></div>';
                            	}else{
                            		echo '<div class="post-item">Tidak ada dasar hukum lainnya..</div>';
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