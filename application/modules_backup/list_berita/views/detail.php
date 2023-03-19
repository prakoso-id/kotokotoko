<!-- BREADCRUMB -->
<div id="breadcrumb">
	<div class="container">
		<ul class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>">Beranda</a></li>
			<li><a href="<?php echo base_url('list-berita'); ?>">List Berita</a></li>
			<li class="active"><?php echo $berita->judul; ?></li>
		</ul>
	</div>
</div>
<!-- /BREADCRUMB -->
<!-- section -->
<section class="blog-section spad">
	<div class="container">
		<!-- row -->
		<div class="col-lg-9 col-sm-12">
			<div class="blog-details">
				<div class="bd-text">
				 	<div class="latest-pi" style="background:url('<?php echo base_url('assets/images/berita/').$berita->foto; ?>'); height: 350px; background-position: center; background-size: cover;">    
                    </div>
                    <br>
					<h2><?php echo $berita->judul; ?></h2>
					<div class="latest-tag">
                        <div class="tag-clock">
                            <i class="fa fa-clock-o"></i>
                            <?php echo indonesian_date($berita->created_at); ?>
                        </div>
                    </div>
                    <br>
					<?php 
						echo $berita->berita;
					?>
				</div>
			</div>
		</div>
		<div class="col-lg-3 offset-lg-1 col-sm-12">
			<!-- aside widget -->
			
			<div class="aside">
				<h3 class="aside-title">Pencarian Produk:</h3>
				<div class="row">
					<form action="<?php echo base_url('list-produk') ?>" method="get">
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
			<div class="aside">
				<h3 class="aside-title">Berita Lain :</h3>
				<div class="row">
					<div class="col-sm-12">
						<div class="blog-sidebar" style="margin-left: 0px; margin-right: 0px;">
			                <div class="sidebar-recent">
			                    <?php
			                    foreach ($list_berita as $key => $value) {
			                    ?>
			                    	<div class="sr-item">
				                        <a href="<?php echo base_url('list-berita/berita/'.short($value->kode_berita)); ?>" class="active">
				                            <h5 title="<?php echo $value->judul; ?>"><?php echo readMore($value->judul,40); ?></h5>
				                        </a>
				                        <div class="blog-date"><?php echo indonesian_date_2($value->created_at); ?></div>
				                    </div>
			                    <?php
			                    } 
			                    ?>   
			                </div>
			            </div>
					</div>
				</div>
			</div>
            
        </div>
	</div>
	<!-- /container -->
</section>
<!-- /section -->
