<style type="text/css">
	.icon-foto{
		font-size: 64px;
		font-weight: 700;
    	color: #fff;
	}
	.latest-text {
		text-align: center;
	}
</style>
	<!-- BREADCRUMB -->
	<div id="breadcrumb">
		<div class="container">
			<ul class="breadcrumb">
				<li><a href="<?php echo base_url(); ?>">Beranda</a></li>
				<li class="active">UMKM</li>
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
						<h3 class="aside-title">Pencarian UMKM:</h3>
						<div class="row">
							<form action="<?php echo $url_cari ?>" method="get">
							<div class="col-sm-12">
								<div class="input-group" style="display: flex;">
									<input type="text" name="cari" class="form-control" placeholder="Search..." value="<?php echo htmlentities($this->input->get('cari',true), ENT_QUOTES, 'UTF-8'); ?>">
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
						<h3 class="aside-title">Kategori UMKM</h3>
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
					<!-- /aside widget -->
				</div>
				<!-- /ASIDE -->

				<!-- MAIN -->
				<div id="main" class="col-md-9">
					<!-- STORE -->
					<div>
						<!-- row -->
						<div class="row">
							<?php
							if ($umkm):
							foreach ($umkm as $value):
								if ($value->logo_umkm) {
									$bg = "background:url('".base_url()."assets/logo/".$value->logo_umkm."');";
								}else{
									$bg = "background:#e95a5c;";
								}
							?>
					            <div class="col-lg-4" style="height: 400px; margin-bottom: 10px;">
					                <div class="latest-items" style="height: 400px;">
					                    <div class="latest-pic" style="<?= $bg; ?> height: 150px;text-align: center;padding-top: 10px;">
					                    	<a title="<?php echo text($value->namausaha); ?>" href="<?php echo base_url('toko/'.short($value->id_umkm)) ?>">	
						                        <?php
						                        	if (!$value->logo_umkm) {
						                        		echo get_icon($value->namausaha);
						                        	}
						                        ?>
					                    	</a>
					                    </div>
					                    <div class="latest-text" style="height: 250px;">
					                        <h5 style="height: 40px; margin-bottom: 15px;">
					                        	<a title="<?php echo text($value->namausaha); ?>" href="<?php echo base_url('toko/'.short($value->id_umkm)) ?>">
					                        		<?php echo text(readMore($value->namausaha,30)); ?>
					                        	</a>
					                        </h5>
					                        <span style="font-size: 14px; height: 30px;">
					                        	<?php
					                        		echo text(readMore($value->nama_usaha,30)).'<p>'.text($value->nama_kel).'<p>';
					                        	?>
					                        </span>
					                        <br>
					                        <div class="product-rating" style="height: 20px;">
					                        	
												<?php
												$ratting = get_ratting_umkm($value->id_umkm);
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
											<p style="height: 30px;">(<?php echo get_jumlah_ulasan($value->id_umkm); ?> Ulasan & <?php echo get_jumlah_diskusi($value->id_umkm); ?> Diskusi)</p>
					                        
					                    </div>
					                </div>
					            </div>
					        <?php endforeach; ?>
					        <div class="row">
						        <div class="col-md-12">
						            <!--Tampilkan pagination-->
						            <?php echo $pagination; ?>
						        </div>
						    </div>
						    <?php else: ?>
						    <div class="col-md-12">
						    	<div class="card">
								  <div class="card-body">
								  	<center>
									  	<img style="width: 200px; margin-bottom: 10px;" src="<?php echo base_url('assets/images/not_found.png');?>" alt="not found">
									  	<span>
									  		<h3>Oops, UMKM tidak ditemukan</h3>
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