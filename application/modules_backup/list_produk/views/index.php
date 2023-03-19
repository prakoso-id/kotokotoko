	<!-- BREADCRUMB -->
	<div id="breadcrumb">
		<div class="container">
			<ul class="breadcrumb">
				<li><a href="<?php echo base_url(); ?>">Beranda</a></li>
				<li class="active">Produk</li>
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
                        <h3 class="aside-title">Pencarian Produk:</h3>
                        <div class="row">
                            <form action="<?php echo $url_cari ?>" method="get">
                                <div class="col-sm-12">
                                    <div class="input-group" style="display: flex;">
                                        <input type="text" name="cari" class="form-control" placeholder="Search..." value="<?php echo htmlentities($this->input->get('cari',true), ENT_QUOTES, 'UTF-8') ?>">
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
                    <!-- /aside widget -->

                    <!-- aside widget -->
                    <div class="aside">
                        <h3 class="aside-title">Kategori Produk :</h3>
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
                    <div class="aside">
                        <h3 class="aside-title">Kategori UMKM : </h3>
                        <ul class="list-links">
                            <?php
                            $url = $this->uri->segment(3);
                            foreach ($kategori as $value) {
                                if($url == url($value->nama_usaha))
                                {
                                    echo '
                                        <li  class="active"><a href="'.base_url('list-umkm/kategori/'.url($value->nama_usaha)).'">'.$value->nama_usaha.'</a></li>
                                    ';
                                }else{
                                    echo '
                                        <li><a href="'.base_url('list-umkm/kategori/'.url($value->nama_usaha)).'">'.$value->nama_usaha.'</a></li>
                                    ';
                                }
                             } 
                            ?>
                        </ul>
                    </div>
				</div>
				<!-- /ASIDE -->

				<!-- MAIN -->
				<div id="main" class="col-md-9">
					<!-- STORE -->
					<div>
						<div class="row">
							<div class="form-group row col-md-6">
			                    <label for="urutkan" class="col-sm-3 col-form-label">Urutkan : </label>
			                    <div class="col-sm-9">
			                      	<select name="urut" id="urut" class="form-control">
			                      		<option value="Paling Sesuai">Paling Sesuai</option>
			                      		<option value="Ulasan">Ulasan</option>
			                      		<option value="Terbaru">Terbaru</option>
			                      		<option value="Harga Terendah">Harga Terendah</option>
			                      		<option value="Harga Tertinggi">Harga Tertinggi</option>
			                      	</select>
			                    </div>
			                 </div>
						</div>
						<!-- row -->
						<div class="row">
							<!-- section title -->
							<?php
							if ($produk):
								foreach ($produk as $value):
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
												<?php echo readMore($value->nama_produk,50);  ?>
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
							<?php endforeach;?>
					        <div class="col-md-12">
					            <!--Tampilkan pagination-->
					            <?php echo $pagination; ?>
					        </div>
						    <?php else:?>
						    <div class="col-md-12">
						    	<div class="card">
								  <div class="card-body">
								  	<center>
									  	<img style="width: 200px; margin-bottom: 10px;" src="<?php echo base_url('assets/images/not_found.png');?>" alt="not found">
									  	<span>
									  		<h3>Oops, produk tidak ditemukan</h3>
									    	Silahkan coba kata kunci lain.
									  	</span>
								  	</center>
								  </div>
								</div>
							</div>
							<?php endif; ?>
						</div>
						<!-- /row -->
					</div>
					<!-- /STORE -->

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