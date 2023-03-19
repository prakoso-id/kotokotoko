<!-- FOOTER -->
<footer id="footer" class="section section-grey" style="background-color: #4a0813; margin-top: 50px;">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row" style="-ms-flex-pack: center!important; justify-content: center!important;">
			<!-- footer widget -->
			<div class="col-md-6 col-sm-12 col-xs-12">
				<div class="footer">
					<!-- footer logo -->
					<div class="footer-logo" style="margin-top: -100px; text-align: center;">
						<img src="<?php echo base_url('assets/images/footer.png') ?>">
					</div>
					<p style="text-align: center; color: #fff">
						DINAS KOPERASI DAN UMKM KOTA TANGERANG &COPY; 2020
					</p>
				</div>
			</div>
			<!-- /footer widget -->

			<!-- footer widget -->
			<div class="col-md-3 col-sm-6 col-xs-6">
				<div class="footer">
					<h3 class="footer-header">Kategori</h3>
					<ul class="list-links">
						<?php
						$url = $this->uri->segment(3);
						foreach ($kategori as $value) {
							if($url == url($value->nama_usaha))
							{
								echo '
							 		<li  class="active"><a href="'.base_url('list-produk/kategori/'.url($value->nama_usaha)).'">'.$value->nama_usaha.'</a></li>
							 	';
							}else{
								echo '
							 		<li><a href="'.base_url('list-produk/kategori/'.url($value->nama_usaha)).'">'.$value->nama_usaha.'</a></li>
							 	';
							}
						 } 
						?>
					</ul>
				</div>
			</div>
			<!-- /footer widget -->

			<!-- footer widget -->
			<div class="col-md-3 col-sm-6 col-xs-6">
				<div class="footer">
					<h3 class="footer-header">Menu</h3>
					<ul class="list-links">
						<li><a href="<?php echo base_url() ?>">Beranda</a></li>
						<li><a href="<?php echo base_url('list-umkm') ?>">UMKM</a></li>
						<li><a href="<?php echo base_url('list-produk') ?>">Produk</a></li>
						<li><a href="<?php echo base_url('list-berita') ?>">Berita</a></li>
						<li><a href="<?php echo base_url('list-dasar-hukum') ?>">Dasar Hukum</a></li>
						<li><a href="<?php echo base_url('list-agenda') ?>">Agenda</a></li>
					</ul>
				</div>
			</div>
			<!-- /footer widget -->
		</div>
		<!-- /row -->

		<!-- row -->
		<div class="row" style="display: none;">
			<div class="col-md-8 col-md-offset-2 text-center">
				<!-- footer copyright -->
				<div class="footer-copyright">
					
					<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->

					<span style="display: none;">Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a></span>
					<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
				</div>
				<!-- /footer copyright -->
			</div>
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</footer>
	<!-- /FOOTER -->