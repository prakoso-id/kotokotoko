<!-- BREADCRUMB -->
<div id="breadcrumb">
	<div class="container">
		<ul class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>">Beranda</a></li>
			<li class="active">List Berita</li>
		</ul>
	</div>
</div>
<!-- /BREADCRUMB -->
<!-- section -->
<div class="section">
	<!-- container -->
	<div class="container">
		<div class="row">
			<div id="aside" class="col-md-3">
				<div class="aside">
                    <h3 class="aside-title">Pencarian Produk:</h3>
                    <div class="row">
                        <form action="<?php echo base_url('list-produk') ?>" method="get">
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
                <div class="aside">
                    <h3 class="aside-title">Kategori Produk :</h3>
                    <ul class="list-links">
                        <?php
                        $url = $this->uri->segment(3);
                        foreach ($kategori as $value) {
                            if($url == url($value->nama_usaha))
                            {
                                echo '<li  class="active"><a href="'.base_url('list-produk/kategori/'.url($value->nama_usaha)).'">'.$value->nama_usaha.'</a></li>';
                            }else{
                                echo '<li><a href="'.base_url('list-produk/kategori/'.url($value->nama_usaha)).'">'.$value->nama_usaha.'</a></li>';
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
                                echo '<li  class="active"><a href="'.base_url('list-umkm/kategori/'.url($value->nama_usaha)).'">'.$value->nama_usaha.'</a></li>';
                            }else{
                                echo '<li><a href="'.base_url('list-umkm/kategori/'.url($value->nama_usaha)).'">'.$value->nama_usaha.'</a></li>';
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
					<!-- row -->
					<div class="row">
						<?php
                        if ($berita):
                        foreach ($berita as $value): ?>
							<div class="col-lg-6">
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
                                        <h3>Oops, Tidak ada berita.</h3>
                                    </span>
                                </center>
                              </div>
                            </div>
                        </div>
                        <?php endif; ?>
					</div>
					<!-- /row -->
				</div>
			</div>
		</div>
	</div>
	<!-- /container -->
</div>
<!-- /section -->


