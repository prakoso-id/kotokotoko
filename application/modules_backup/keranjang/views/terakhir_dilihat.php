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
						<a href="<?php echo base_url('list-produk'); ?>"> Terakhir dilihat </a>
					</h2>
				</div>
			</div>
			<!-- section title -->
			<?php
			foreach ($dilihat as $value):
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
						<h3 class="product-price">
							<?php
							echo "Rp. ".rp($value->harga);
							?>
						</h3>
						<h2 class="product-name">
							<a href="<?php echo base_url('list-produk/produk/'.short($value->kode_produk)) ?>">
								<?php echo $value->nama_produk ?>
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
							<a title="Tambah Keranjang" href="javascript:void(0);" onclick="add_chart('<?php echo $value->id_produk; ?>','add_chart')" class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i></a>
							<button onclick="beli_chart('<?php echo $value->id_produk; ?>','add_chart')" class="primary-btn add-to-cart">Beli</button>
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