<style type="text/css">
	.product-bacground {
		height: 300px;
		background-size: contain !important;
		background-repeat: no-repeat !important;
		background-position: center !important;
	}

	.product-list {
		height: 100px;
		background-size: cover !important;
		background-repeat: no-repeat !important;
		background-position: center !important;
	}
	.produk-data {
		font-size: 16px;
		padding-bottom: 40px;
	}
	/*#my_centered_buttons { display: flex; justify-content: center; }*/
</style>
<!-- BREADCRUMB -->
<div id="breadcrumb">
	<div class="container">
		<ul class="breadcrumb">
			<li><a href="<?php echo base_url() ?>">Beranda</a></li>
			<li><a href="<?php echo base_url('list-produk') ?>">Produk</a></li>
			<li>
				<a href="<?php echo base_url('list-produk/kategori/'.url($produk->nama_usaha)) ?>">
					<?php echo $produk->nama_usaha; ?>
				</a>
			</li>
			<li class="active">
				<?php echo text($produk->nama_produk); ?>
			</li>
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
			<!--  Product Details -->
			<div class="product product-details clearfix">
				<div class="col-md-6">
					<div id="product-main-view">
						<?php
							foreach ($gallery as $key) {
								echo '
									<div class="product-view">
										<img src="'.base_url('assets/produk/'.$produk->username.'/'.$key->foto).'" alt="">
									</div>
								';
							}
						?>
					</div>
					<div id="product-view">
						<?php
							foreach ($gallery as $key) {
								echo '
									<div class="product-view product-list" style="background:url('.base_url('assets/produk/'.$produk->username.'/'.$key->foto).')">
										
									</div>
								';
							}
						?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="product-body">
						<h1 class="product-name"><?php echo $produk->nama_produk; ?></h1>
						<h3 class="product-price" style="color: #e95a5c">Rp. <?php echo rp($produk->harga); ?></h3>
						<div>
							<div class="product-rating">
								<?php
									$jumlah = 5 - $produk->ratting; 
									for($i=0; $i<$produk->ratting; $i++)
									{
										echo '<i class="fa fa-star"></i>';
									}

									for($i=0; $i<$jumlah; $i++)
									{
										echo '<i class="fa fa-star-o"></i>';
									}
								?>
							</div>
						</div>
						<div class="product-options" style="margin-top: -5px;padding-top: 15px;">
							<p><strong> Terjual:</strong> <?php echo rp($produk->terjual); ?> Produk </p>
							<p><strong>Dilihat : </strong> <?php echo rp($produk->dilihat); ?> Kali </p>
							<p><strong>Stok:</strong> <?php echo ($produk->stok?$produk->stok:0); ?> Produk</p> 
							<p><strong>Toko:</strong> <?php echo "<a style='color:#e95a5c;' href='".base_url('list-umkm/umkm/'.short($produk->id_umkm))."'>".text($produk->namausaha)." </a>" ?> </p>
							<p><strong>Lokasi : </strong> <?php echo text($produk->nama_kel); ?></p>
						</div>
						<div class="product-options">
							<div class="product-btns">
								<div class="pull-right">
									<?php
									// $html_bagikan = "<ol>
									// 					<li><a href='javascript:void(0);' onclick='copy_text()'><i class='fa fa-link'></i> Salin Tautan</a></li>
									// 				</ol>";

									$html_bagikan = "<div class='a2a_kit a2a_kit_size_32 a2a_default_style row' style='margin:2px;'>
													<a class='a2a_button_facebook' style='padding:2px;'></a>
													<a class='a2a_button_twitter' style='padding:2px;'></a>
													<a class='a2a_button_email' style='padding:2px;'></a>
													<a class='a2a_button_whatsapp' style='padding:2px;'></a>
													<a class='a2a_button_line' style='padding:2px;'></a>
													<a class='a2a_button_copy_link' style='padding:2px;'></a>
													</div>
													<script async src='https://static.addtoany.com/menu/page.js'></script>";

									echo '<input type="text" style="display: none;" value="'.base_url().'list-produk/produk/'.$this->uri->segment(3).'" class="form-control" id="link_produk" readonly>';

									echo '<button tabindex="0" class="main-btn icon-btn" role="button" data-html="true" data-trigger="focus" data-toggle="popover" title="Bagikan" data-placement="bottom" data-content="'.$html_bagikan.'">
													<i class="fa fa-share-alt-square" title="Bagikan"></i>
												</button> ';

									if ($produk->ojol_toko) {
										if (isJSON($produk->ojol_toko)) {
											$array_ojol_toko = json_decode($produk->ojol_toko);
											$ojol = "<ol>";
											foreach ($array_ojol_toko as $row) {
												$ojol .= "<li><b>".$row->nama_ojol."</b><br><a href='".$row->keterangan_ojol."' target='_blank'>".$row->keterangan_ojol."</a></li>";
											}
											$ojol .= "</ol>";
											echo '<button tabindex="0" class="main-btn icon-btn" role="button" data-html="true" data-trigger="focus" data-toggle="popover" title="Ojek Online" data-placement="bottom" data-content="'.$ojol.'">
													<i class="fa fa-motorcycle" title="Ojek Online"></i>
												</button> ';
										}
									}

									if ($produk->situs_web_toko) {
										if (isJSON($produk->situs_web_toko)) {
											$array_web_toko = json_decode($produk->situs_web_toko);
											$web_toko = "<ol>";
											foreach ($array_web_toko as $row) {
												$web_toko .= "<li><b>".$row->nama_ecommerce."</b><br><a href='".$row->keterangan_ecommerce."' target='_blank'>".$row->keterangan_ecommerce."</a></li>";
											}
											$web_toko .= "</ol>";
											echo '<button tabindex="0" class="main-btn icon-btn" role="button" data-html="true" data-trigger="focus" data-toggle="popover" title="Toko Online" data-placement="bottom" data-content="'.$web_toko.'">
													<i class="fa fa-globe" title="Toko Online"></i>
												</button> ';
										}
									}

									if ($produk->sosmed_toko) {
										if (isJSON($produk->sosmed_toko)) {
											$array_sosmed_toko = json_decode($produk->sosmed_toko);
											$sosmed_toko = "<ol>";
											foreach ($array_sosmed_toko as $row) {
												$sosmed_toko .= "<li><b>".$row->nama_medsos."</b><br><a href='".$row->keterangan_medsos."' target='_blank'>".$row->keterangan_medsos."</a></li>";
											}
											$sosmed_toko .= "</ol>";
											echo '<button tabindex="0" class="main-btn icon-btn" role="button" data-html="true" data-trigger="focus" data-toggle="popover" title="Sosial Media" data-placement="bottom" data-content="'.$sosmed_toko.'">
													<i class="fa fa-external-link" title="Sosial Media"></i>
												</button> ';
										}
									}

									if($this->user_model->is_login()){
										if($this->session->identity != $produk->nik){
											echo '<button class="main-btn icon-btn" onclick="hubungi_pesan('.$produk->id_produk.','.$produk->username.')">
														<i class="fa fa-comments" title="Hubungi Penjual"></i>
													</button> ';
										}
									}

									if ($produk->no_hp) {
										$explode_no = explode(',', $produk->no_hp); //jika no hp nya banyak
                    					$no_wa1 = substr($explode_no[0], 1,12);
                    					$text_wa = base_url().'list-produk/produk/'.$this->uri->segment(3).'%0a Hai *'.trim($produk->namausaha).'* apakah produk *'.trim($produk->nama_produk).'* masih tersedia ?';
										echo '<button class="main-btn icon-btn" onclick="hubungi_wa(`+62'.$no_wa1.'`,`'.$text_wa.'`)">
												<i class="fa fa-whatsapp" title="Hubungi Penjual Via Whatsapp"></i>
											</button> ';
									}
									?>
									
									<button title="Tambah Wishlist" type="button" onclick="wishlist('<?php echo $produk->id_produk ?>')" class="main-btn icon-btn "><i class="fa fa-heart <?php echo $produk->id_produk ?>" <?php echo fungsi_wishlist($produk->id_produk) ?>></i></button>
									<!-- <a title="Tambah Keranjang" href="javascript:void(0);" onclick="add_chart('<?php echo $produk->id_produk; ?>','add_chart')" class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i></a> -->
									<!-- <button onclick="beli_chart('<?php echo $produk->id_produk; ?>','add_chart')" class="primary-btn add-to-cart" style="width: 150px;">Beli</button> -->
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="product-tab">
						<ul class="tab-nav">
							<li class="active"><a data-toggle="tab" href="#tab1">Deskripsi</a></li>
							<li><a data-toggle="tab" href="#tab2">Ulasan</a></li>
							<li><a data-toggle="tab" href="#tab3">Diskusi</a></li>
						</ul>
						<div class="tab-content">
							<div id="tab1" class="tab-pane fade in active">
								<?php
									echo $produk->deskripsi; 
								?>
							</div>
							<div id="tab2" class="tab-pane fade in">

								<div class="row">
									<div class="col-md-12">
										<div class="product-reviews">
											<?php
												if($ulasan):
												foreach ($ulasan as $value):
											?>
													<div class="single-review">
														<div class="review-heading">
															<div>
																<a href="javascript:void(0);">
																	<i class="fa fa-user-o"></i>
																	<?php echo text($value->nama); ?>
																</a>
															</div>
															<div>
																<a href="javascript:void(0)">
																	<i class="fa fa-clock-o"></i>
																	<?php echo indonesian_date($value->created_at) ?>
																</a>
															</div>
															<div class="review-rating pull-right">
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
														</div>
														<div class="review-body">
															<p><?php echo $value->deskripsi; ?></p>
														</div>
													</div>
											<?php
												endforeach;
												else:
											?>
													<p>Produk Tidak Memiliki Ulasan</p>
											<?php
												endif;
											?>
										</div>
									</div>
								</div>
							</div>
							<div id="tab3" class="tab-pane fade in">
								<div class="row">
									<div class="col-md-5">
										<div class="product-reviews tampil_diskusi">
											
										</div>
									</div>
									<div class="col-md-2">
										
									</div>
									<div class="col-md-5">
										<?php
											if($this->user_model->is_login()):
										?>
												<h4 class="text-uppercase">
													Beri Pertanyaan
												</h4>
												<p>Ada pertanyaan? Diskusikan dengan penjual atau pengguna lain</p>
												<form class="review-form">
													<div class="form-group">
														<input type="hidden" name="id_produk" value="<?php echo $produk->id_produk; ?>">
														<textarea style="resize: none; height: 150px;color: #000;" class="input" name="pesan_diskusi" placeholder="Apa yang ingin anda tanyakan mengenai produk ini?"></textarea>
														<input type="hidden" name="pesan">
														<span class="help"></span>
													</div>
													<button class="primary-btn" type="button" onclick="simpan_diskusi()">Kirim</button>
												</form>
										<?php
											else:
										?>
											<p>Harap <a href="javascript:void(0);" onclick="login_ulasan()" style="color: #e95a5c"> login </a> terlebih dahulu sebelum mengajukan pertanyaan. </p>		
										<?php
											endif;
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
			<!-- /Product Details -->
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
					<h2 class="title">Rekomendasi Produk</h2>
				</div>
			</div>
			<!-- section title -->

			<!-- section title -->
			<?php
			foreach ($rekomendasi as $value):
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
							<?php for($i=1; $i<=$value->ratting; $i++): ?>
								<i class="fa fa-star"></i>
							<?php endfor; ?>
						</div>
						<div class="product-btns" style="margin: 0 auto;">
							<button type="button" onclick="wishlist('<?php echo $value->id_produk ?>')" class="main-btn icon-btn "><i class="fa fa-heart <?php echo $value->id_produk ?>" <?php echo fungsi_wishlist($value->id_produk) ?>></i></button>
							<!-- <a href="javascript:void(0);" onclick="add_chart('<?php echo $value->id_produk; ?>','add_chart')" class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i></a> -->
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
<div id="modal_tambah" class="modal fade" data-backdrop="false">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle"></h5>
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
			</div>
			<form action="" id="add_tambah">
				<div class="modal-body" style="min-height: 200px !important;">
					<input type="hidden" name=" <?php echo $this->security->get_csrf_token_name(); ?>" value='<?php echo $this->security->get_csrf_hash(); ?>' />
					<input type="hidden" name="id">
					<input type="hidden" name="type" value="balas_diskusi">
					<div class="form-group">
						<textarea class="input" style="resize: none; height: 150px;" name="pesan_diskusi" placeholder="Apa yang ingin anda tanyakan mengenai produk ini?"></textarea>
						<input type="hidden" name="pesan_balasan">
						<span class="help"></span>
					</div>
				</div>

				<div class="modal-footer">
					<button type="button" data-dismiss="modal" class="btn btn-danger" data-dismiss="modal">Tutup</button>
					<button type="button" onclick="simpan_data()" id="btnSave" class="btn btn-success">
						Simpan
					</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div id="modal_chat" class="modal fade" data-backdrop="false">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">
					
				</h5>
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="data_pesan">
					
			</div>
		</div>
	</div>
</div>
<?php
	$this->load->view('js');
?>
