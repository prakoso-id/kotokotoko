<style type="text/css">
	.icon-foto{
		font-size: 64px;
		font-weight: 700;
    	color: #fff;
	}
	.latest-text {
		text-align: center;
	}
	.header-toko
	{
		padding: 16px;
	    display: block;
	    text-transform: uppercase;
	    background: #e95a5c;
	    color: #FFF;
	    font-weight: 700;
	}
</style>
	<!-- BREADCRUMB -->
	<div id="breadcrumb">
		<div class="container">
			<ul class="breadcrumb">
				<li><a href="<?php echo base_url(); ?>">Beranda</a></li>
				<li><a href="<?php echo base_url('list-umkm'); ?>">UMKM</a></li>
				<li class="active"><?php echo text($umkm->namausaha); ?></li>
			</ul>
		</div>
	</div>
	<!-- /BREADCRUMB -->

	<!-- section -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!-- ASIDE -->
				<div id="aside" class="col-md-3">
					<!-- aside widget -->
					<div class="aside">
						<h3 class="aside-title">Cari Produk:</h3>
						<div class="row">
							<form action="<?php echo base_url('toko/'.short($umkm->id_umkm).'/'.get_url($umkm->namausaha)) ?>" method="get">
							<div class="col-sm-12">
								<div class="input-group" style="display: flex;">
									<input type="text" name="cari" class="form-control" placeholder="Search..." value="<?php echo $this->input->get('cari') ?>">
						            <div class="input-group-append">
						                <button type="submit" class="btn primary-btn" style="border-radius: 0px; padding: 7px 15px;">
						                    <i class="fa fa-search"></i>
						                </button>
						            </div>
						        </div>
							</div>
							</form>
						</div>
					</div>
					<div class="aside">
						<div class="row">
							<div class="col-md-12">
								<div id="responsive-nav" class="aside">
									<div class="category-nav" style="float: none !important; width: auto;">
										<ul class="category-list" style="position: relative !important; width: auto;    border-top: 1px solid #DADADA;">
											<?php
											$url = 'toko/'.short($umkm->id_umkm).'/'.get_url($umkm->namausaha);
											echo fungsi_menu_produk($umkm->produk,$url);
											
											?>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- /aside widget -->
				</div>
				<!-- /ASIDE -->

				<!-- MAIN -->
				<div id="main" class="col-md-9">
					<div class="row">
							<!-- section title -->
							<?php
							if(!empty($produk)):
								foreach ($produk as $value):
							?>
								<!-- Product Single -->
								<div class="col-md-4 col-sm-6 col-xs-6">
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
												<button type="button" onclick="wishlist('<?php echo $value->id_produk ?>')" class="main-btn icon-btn "><i class="fa fa-heart <?php echo $value->id_produk ?>" <?php echo fungsi_wishlist($value->id_produk) ?>></i></button>
												<!-- <a href="javascript:void(0);" onclick="add_chart('<?php echo $value->id_produk; ?>','add_chart')" class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i></a> -->
												<!-- <button onclick="beli_chart('<?php echo $value->id_produk; ?>','add_chart')" class="primary-btn add-to-cart">Beli</button> -->
											</div>
										</div>
									</div>
								</div>
								<!-- /Product Single -->
							<?php
								endforeach;
							else:
							?>

								<div class="col-md-12">
							    	<div class="card">
									  <div class="card-body">
									  	<center>
										  	<img style="width: 200px; margin-bottom: 10px;" src="<?php echo base_url('assets/images/not_found.png');?>" alt="not found">
										  	<span>
										  		<h3>Oops! Produk Tidak ditemukan</h3>
										  	</span>
									  	</center>
									  </div>
									</div>
								</div>
							<?php
							endif;
							?>
						</div>

					<!-- store bottom filter -->
					<div class="store-filter clearfix">
						
					</div>
					<!-- /store bottom filter -->
				</div>
				<!-- /MAIN -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /section -->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title" id="exampleModalLabel"><?php echo text($umkm->namausaha); ?></h3>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
							<div class="col-md-12">
								<div class="position-relative row form-group">
			                        <label class="col-sm-3 col-form-label" style="font-weight:600">Nama Usaha</label>
			                        <div class="col-lg-9" style="text-align: right;">
			                           	<?php echo text($umkm->namausaha); ?>
			                        </div>
			                    </div>
								<div class="position-relative row form-group">
			                        <label class="col-sm-3 col-form-label" style="font-weight:600">Kategori</label>
			                        <div class="col-lg-9" style="text-align: right;">
			                           	<?php
			                        		echo $umkm->nama_usaha;
			                        	?>
			                        </div>
			                    </div>
			                    <div class="position-relative row form-group">
			                        <label class="col-sm-3 col-form-label" style="font-weight:600">Kelurahan</label>
			                        <div class="col-lg-9" style="text-align: right;">
			                           	<?php
			                        		echo text($umkm->nama_kel);
			                        	?>
			                        </div>
			                    </div>
			                    <div class="position-relative row form-group">
			                        <label class="col-sm-3 col-form-label" style="font-weight:600">Kecamatan</label>
			                        <div class="col-lg-9" style="text-align: right;">
			                           	<?php
			                        		echo text($umkm->nama_kec);
			                        	?>
			                        </div>
			                    </div>
			                    <div class="position-relative row form-group">
			                        <label class="col-sm-3 col-form-label" style="font-weight:600">Alamat</label>
			                        <div class="col-lg-9" style="text-align: right;">
			                           	<?php
			                        		echo text($umkm->alamat);
			                        	?>
			                        </div>
			                    </div>
			                    <div class="position-relative row form-group">
			                        <label class="col-sm-3 col-form-label" style="font-weight:600">Ratting</label>
			                        <div class="col-lg-9" style="text-align: right;">
			                           	<div class="product-rating">
											<?php
											$ratting = get_ratting_umkm($umkm->id_umkm);
												$jumlah = 5 - $ratting; 
												for($i=0; $i<$ratting; $i++)
												{
													echo '<i class="fa fa-star"></i>';
												}

												for($i=0; $i<$jumlah; $i++)
												{
													echo '<i class="fa fa-star-o"></i>';
												}
											?>
										</div>
										<p>(<?php echo get_jumlah_ulasan($umkm->id_umkm); ?> Ulasan & <?php echo get_jumlah_diskusi($umkm->id_umkm); ?> Diskusi)</p>
			                        </div>
			                    </div>
			                    <hr>
			                    <div class="position-relative row form-group">
			                        <label class="col-sm-3 col-form-label" style="font-weight:600">Toko Online</label>
			                        <div class="col-lg-9" style="text-align: right;">
			                           	<?php 
			                           	$toko_online = '-';
			                           	if ($umkm->situs_web) {
			                           		if (isJSON($umkm->situs_web)) {
												$array_situs_web = json_decode($umkm->situs_web);
												$toko_online = '';
												foreach ($array_situs_web as $row) {
													$toko_online .= '<b>'.$row->nama_ecommerce.'</b><br>'.$row->keterangan_ecommerce.'<br>';
												}
											}
			                           	}

			                           	echo $toko_online;
			                           	?>
			                        </div>
			                    </div>
			                    <hr>
			                    <div class="position-relative row form-group">
			                        <label class="col-sm-3 col-form-label" style="font-weight:600">Ojek Online</label>
			                        <div class="col-lg-9" style="text-align: right;">
			                           	<?php 
			                           	$ojol = '-';
			                           	if ($umkm->ojol) {
			                           		if (isJSON($umkm->ojol)) {
												$array_ojol = json_decode($umkm->ojol);
												$ojol = '';
												foreach ($array_ojol as $row) {
													$ojol .= '<b>'.$row->nama_ojol.'</b><br>'.$row->keterangan_ojol.'<br>';
												}
											}
			                           	}

			                           	echo $ojol;
			                           	?>
			                        </div>
			                    </div>
			                    <hr>
			                    <div class="position-relative row form-group">
			                        <label class="col-sm-3 col-form-label" style="font-weight:600">Sosial Media</label>
			                        <div class="col-lg-9" style="text-align: right;">
			                           	<?php 
			                           	$sosmed = '-';
			                           	if ($umkm->sosmed) {
			                           		if (isJSON($umkm->sosmed)) {
												$array_sosmed = json_decode($umkm->sosmed);
												$sosmed = '';
												foreach ($array_sosmed as $row) {
													$sosmed .= '<b>'.$row->nama_medsos.'</b><br>'.$row->keterangan_medsos.'<br>';
												}
											}
			                           	}

			                           	echo $sosmed;
			                           	?>
			                        </div>
			                    </div>
							</div>
						</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
				</div>
			</div>
		</div>
	</div>