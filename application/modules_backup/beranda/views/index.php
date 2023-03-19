<!-- HOME -->
<div id="home" style="margin-bottom: 30px;">
	<!-- home wrap -->
	<div class="home-wrap">
		<!-- home slick -->
		<div id="home-slick">
			<?php
				foreach ($slider as $value):
					if($value->id_slider == 2):
			?>
					<!-- banner -->

					<div class="banner banner-1" style="background: url(<?php echo base_url('assets/images/slider/'.$value->foto);?>); background-size: contain;background-position: center;background-repeat: no-repeat;">
						
					</div>
					<!-- /banner -->
			<?php
					else:
			?>
					<!-- banner -->

					<div class="banner banner-1" style="background: url(<?php echo base_url('assets/images/slider/'.$value->foto);?>); background-size: cover;background-position: center;background-repeat: no-repeat;">
						
					</div>
					<!-- /banner -->
			<?php
					endif;
				endforeach;
			?>
		</div>
		<!-- /home slick -->
	</div>
	<!-- /home wrap -->
</div>
<!-- /HOME -->
<!-- section -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<!-- banner -->
			<div class="col-md-4 col-sm-6">
				<a class="banner banner-1" href="<?php echo base_url('list-produk/kategori/kuliner') ?>">
					<img src="<?php echo base_url('assets/images/kategori/b-makan.png') ?>" alt="">
					<div class="banner-caption text-center">
						<h2 class="white-color">MAKANAN MINUMAN</h2>
					</div>
				</a>
			</div>
			<!-- /banner -->

			<!-- banner -->
			<div class="col-md-4 col-sm-6">
				<a class="banner banner-1" href="<?php echo base_url('list-produk/kategori/fashion') ?>">
					<img src="<?php echo base_url('assets/images/kategori/b-pakaian.png') ?>" alt="">
					<div class="banner-caption text-center">
						<h2 class="white-color">PAKAIAN</h2>
					</div>
				</a>
			</div>
			<!-- /banner -->

			<!-- banner -->
			<div class="col-md-4 col-md-offset-0 col-sm-6 col-sm-offset-3">
				<a class="banner banner-1" href="<?php echo base_url('list-produk/kategori/aksesoris') ?>">
					<img src="<?php echo base_url('assets/images/kategori/b-aksesoris.png') ?>" alt="">
					<div class="banner-caption text-center">
						<h2 class="white-color">AKSESORIS</h2>
					</div>
				</a>
			</div>
			<!-- /banner -->

		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /section -->
<!-- section -->
<div class="section">
	
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<!-- section title -->
			<div class="col-md-12">
				<div class="section-title">
					<h2 class="title">
						<a href="<?php echo base_url('list-produk'); ?>"> Produk Favorit </a>
					</h2>
				</div>
			</div>
			<!-- section title -->
			<?php
			foreach ($populer as $value):
			?>
			<!-- Product Single -->
			<div class="col-md-3 col-sm-6 col-xs-6">
				<div class="product product-single">
					<div class="product-thumb">
						<div class="product-label">
							<span><a href="<?php echo base_url('list-produk/kategori/'.url($value->nama_usaha)); ?>"> <?php echo $value->nama_usaha; ?> </a></span>
						</div>
						<a href="<?php echo base_url('list-produk/produk/'.short($value->kode_produk)) ?>" class="main-btn quick-view">
							<i class="fa fa-search-plus"></i> Lihat
						</a> 
						<div class="produk-foto" style="background:url('<?php echo base_url('assets/produk/'.$value->username.'/'.$value->foto);?>');">
							
						</div>
					</div>
					<div class="product-body">
						<h3 class="product-price" style="height: 30px;">
							<?php
							echo "Rp. ".rp($value->harga);
							?>
						</h3>
						<h2 class="product-name" style="height: 30px;">
							<a href="<?php echo base_url('list-produk/produk/'.short($value->kode_produk)) ?>">
								<?php echo readMore($value->nama_produk,50); ?>
							</a>
						</h2>
						<div class="product-rating">
							<?php
								$jumlah = 5 - $value->ratting; 
								for($i=0; $i<$value->ratting; $i++)
								{
									echo '<i class="fa fa-star"></i>';
								}

								for($i=0; $i<$jumlah; $i++)
								{
									echo '<i class="fa fa-star-o"></i>';
								}
							?>
						</div>
						<div class="product-btns" style="margin: 0 auto;">
							<button title="Tambah Wishlist" type="button" onclick="wishlist('<?php echo $value->id_produk ?>')" class="main-btn icon-btn "><i class="fa fa-heart <?php echo $value->id_produk ?>" <?php echo fungsi_wishlist($value->id_produk) ?>></i></button>
							<!-- <a title="Tambah Keranjang" href="javascript:void(0);" onclick="add_chart('<?php echo $value->id_produk; ?>','add_chart')" class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i></a> -->
							<!-- <button onclick="beli_chart('<?php echo $value->id_produk; ?>','add_chart')" class="primary-btn add-to-cart">Beli</button> -->
						</div>
					</div>
				</div>
			</div>
			<!-- /Product Single -->
			<?php
			endforeach;
			?>
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /section -->

<!-- section -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<!-- section title -->
			<div class="col-md-12">
				<div class="section-title">
					<h2 class="title">
						<a href="<?php echo base_url('list-produk'); ?>"> Produk Terbaru </a>
					</h2>
				</div>
			</div>
			<!-- section title -->
			<?php
			foreach ($terbaru as $value):
			?>
			<!-- Product Single -->
			<div class="col-md-3 col-sm-6 col-xs-6">
				<div class="product product-single">
					<div class="product-thumb">
						<div class="product-label">
							<span><a href="<?php echo base_url('list-produk/kategori/'.url($value->nama_usaha)); ?>"> <?php echo $value->nama_usaha; ?> </a></span>
						</div>
						<a href="<?php echo base_url('list-produk/produk/'.short($value->kode_produk)) ?>" class="main-btn quick-view">
							<i class="fa fa-search-plus"></i> Lihat
						</a> 
						<div class="produk-foto" style="background:url('<?php echo base_url('assets/produk/'.$value->username.'/'.$value->foto);?>');">
							
						</div>
					</div>
					<div class="product-body">
						<h3 class="product-price" style="height: 30px;">
							<?php
							echo "Rp. ".rp($value->harga);
							?>
						</h3>
						<h2 class="product-name" style="height: 30px;">
							<a href="<?php echo base_url('list-produk/produk/'.short($value->kode_produk)) ?>">
								<?php echo readMore($value->nama_produk,50); ?>
							</a>
						</h2>
						<div class="product-rating">
							<?php
								$jumlah = 5 - $value->ratting; 
								for($i=0; $i<$value->ratting; $i++)
								{
									echo '<i class="fa fa-star"></i>';
								}

								for($i=0; $i<$jumlah; $i++)
								{
									echo '<i class="fa fa-star-o"></i>';
								}
							?>
						</div>
						<div class="product-btns" style="margin: 0 auto;">
							<button type="button" onclick="wishlist('<?php echo $value->id_produk ?>')" class="main-btn icon-btn"><i class="fa fa-heart <?php echo $value->id_produk ?>" <?php echo fungsi_wishlist($value->id_produk) ?>></i></button>
							<!-- <button type="button" onclick="add_chart('<?php echo $value->id_produk; ?>','add_chart')" class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i></button> -->
							<!-- <button onclick="beli_chart('<?php echo $value->id_produk; ?>','add_chart')" class="primary-btn add-to-cart">Beli</button> -->
						</div>
					</div>
				</div>
			</div>
			<!-- /Product Single -->
			<?php
			endforeach;
			?>
			<center>
				<a class="primary-btn" href="<?php echo base_url('list-produk'); ?>">Lihat Semua</a>
			</center>
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /section -->
<!-- section -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<!-- section title -->
			<div class="col-md-12">
				<div class="section-title">
					<h2 class="title">
						<a href="<?php echo base_url('list-berita'); ?>"> Berita </a>
					</h2>
				</div>
			</div>
			
		</div>
		<div class="row">
			<?php
			foreach ($berita as $value):
			?>
	            <div class="col-lg-4">
	                <div class="latest-items">
	                    <div class="latest-pic" style="background:url('<?php echo base_url('assets/images/berita/').$value->foto; ?>')">
	                        
	                    </div>
	                    <div class="latest-text">
	                        <div class="latest-tag">
	                            <div class="tag-clock">
	                                <i class="fa fa-clock-o"></i>
	                                <?php echo indonesian_date($value->created_at); ?>
	                            </div>
	                        </div>
	                        <h5><a title="<?php echo $value->judul; ?>" href="<?php echo base_url('list-berita/berita/'.short($value->kode_berita)) ?>"><?php echo readMore($value->judul,50); ?></a></h5>
	                    </div>
	                </div>
	            </div>
	        <?php
	    	endforeach;
	        ?>
	        <center>
				<a class="primary-btn" href="<?php echo base_url('list-berita'); ?>">Lihat Semua</a>
			</center>
        </div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /section -->
<?php
	$this->load->view('js');
?>

