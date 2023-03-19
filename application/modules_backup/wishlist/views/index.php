<!-- BREADCRUMB -->
<div id="breadcrumb">
	<div class="container">
		<ul class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>">Beranda</a></li>
			<li class="active">Wishlist</li>
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
			<div id="aside" class="col-md-3">
				<div id="responsive-nav" class="aside">
					<div class="category-nav" style="float: none !important; width: auto;">
						<span class="category-header">MENU <i class="fa fa-list"></i></span>
						<ul class="category-list" style="position: relative !important; width: auto;">
							<?php
							if($this->user_model->is_umkm_admin())
							{
								echo '
								<li class="'.($active == 'dashboard'?'active':'').'"><a href="'.base_url('dashboard').'">Dashboard</a></li>
								<li class="'.($active == 'pengguna'?'active':'').'"><a href="'.base_url('pengguna').'">Pengguna</a></li>
								<li class="'.($active == 'umkm'?'active':'').'"><a href="'.base_url('umkm').'">Verifikasi UMKM</a></li>
								<li class="'.($active == ''?'active':'').'"><a href="'.base_url('produk').'">Produk</a></li>
								<li class="'.($active == ''?'active':'').'"><a href="'.base_url('slider').'">Slider</a></li>
								<li class="'.($active == ''?'active':'').'"><a href="'.base_url('agenda/data').'">Agenda</a></li>
								<li class="'.($active == ''?'active':'').'"><a href="'.base_url('dasar_hukum/data').'">Dasar Hukum</a></li>
								';
							}
							else if($this->user_model->is_umkm_verifikator())
							{
								echo '
								<li class="'.($active == 'dashboard'?'active':'').'"><a href="'.base_url('dashboard').'">Dashboard</a></li>
								<li class="'.($active == 'umkm'?'active':'').'"><a href="'.base_url('umkm').'">Verifikasi UMKM</a></li>
								';
							}
							else if($this->user_model->is_umkm_penjual())
							{
								if($this->session->tempdata('jenis_menu') == 'user')
								{
									echo '
									<li  class="'.($active == 'biodata'?'active':'').'"><a href="'.base_url('customer/biodata').'">Biodata</a></li>
									<li  class="'.($active == 'alamat'?'active':'').'"><a href="'.base_url('customer/daftar-alamat').'">Daftar Alamat</a></li>
									<li  class="'.($active == 'transaksi_customer'?'active':'').'"><a href="'.base_url('transaksi/customer').'">Transaksi Pembelian</a></li>
									<li  class="'.($active == 'wishlist'?'active':'').'"><a href="'.base_url('wishlist').'">Wishlist</a></li>
									';    
								}

								if($this->session->tempdata('jenis_menu') == 'admin')
								{
									echo '
									<li  class="'.($active == 'dashboard'?'active':'').'"><a href="'.base_url('dashboard').'">Dashboard</a></li>
									<li  class="'.($active == 'dashboard'?'active':'').'"><a href="'.base_url('customer/umkm').'">Data UMKM</a></li>
									<li  class="'.($active == 'dashboard'?'active':'').'"><a href="'.base_url('produk').'">Produk</a></li>
									<li  class="'.($active == 'dashboard'?'active':'').'"><a href="'.base_url('transaksi/penjual').'">Transaksi Penjualan</a></li>
									';
								}
							}
							else if($this->user_model->is_umkm_user())
							{
								echo '
								<li  class="'.($active == 'biodata'?'active':'').'"><a href="'.base_url('customer/biodata').'">Biodata</a></li>
								<li  class="'.($active == 'alamat'?'active':'').'"><a href="'.base_url('customer/daftar-alamat').'">Daftar Alamat</a></li>
								<li  class="'.($active == 'transaksi_customer'?'active':'').'"><a href="'.base_url('transaksi/customer').'">Transaksi Pembelian</a></li>
								<li  class="'.($active == 'wishlist'?'active':'').'"><a href="'.base_url('wishlist').'">Wishlist</a></li>
								';
								echo '<li><a href="'.base_url('customer/umkm').'"><strong style="color:#000"> DAFTAR UMKM </strong> </a></li>';
							}
							?>
						</ul>
					</div>
				</div>
				<div class="aside">
					<h3 class="aside-title">Pencarian Produk:</h3>
					<div class="row">
						<form action="<?php echo base_url('list-produk') ?>" method="get">
							<div class="col-sm-12">
								<div class="input-group" style="display: flex;">
									<input type="text" name="cari" class="form-control" placeholder="Search..." value="<?php echo $this->input->get('cari') ?>">
									<div class="input-group-append" style="position: relative;">
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
			<div class="col-md-9">
				<div class="order-summary clearfix">
					<div class="section-title">
						<h3 class="title">
							<div class="form-group">
								<div class="input-checkbox">
									<label class="font-weak" for="" style="color: #30323A;font-weight: 700;font-size: 16px;">
										Wishlist
									</label>
								</div>
							</div>
						</h3>
					</div>
					<?php
					if($wishlist):
						?>
						<table class="shopping-cart-table table">
							<thead>
								<tr>
									<th>Produk</th>
									<th></th>
									<th>Harga</th>
									<th width="200px;"></th>
								</tr>
							</thead>
							<tbody>
								<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
								<?php
								$i=1;
								foreach ($wishlist as $value):
									?>
									<tr id="list-data-<?php echo $value->id_produk; ?>">
										<td><div class="product-thumb" style="height: 150px;width: 150px; background:url('<?php echo base_url('assets/produk/'.$value->username.'/'.$value->foto);?>');">
											</div>
										</td>
										<td></td>
										<td class="details">
											<a href="<?php echo base_url('list-produk/produk/'.short($value->kode_produk)) ?>"><?php echo $value->nama_produk; ?></a>
											<ul>
												<li><span>Stok : <?php echo $value->stok; ?></span></li>
											</ul>
										</td>
										<td>
											<button title="Wishlist" type="button" onclick="wishlist('<?php echo $value->id_produk ?>')" class="main-btn icon-btn "><i class="fa fa-heart <?php echo $value->id_produk ?>" <?php echo fungsi_wishlist($value->id_produk) ?>></i></button>
											<!-- <a href="javascript:void(0);" onclick="add_chart('<?php echo $value->id_produk; ?>','add_chart')" class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i></a>
											<button onclick="beli_chart('<?php echo $value->id_produk; ?>','add_chart')" class="primary-btn add-to-cart">Beli</button> -->
										</td>
									</tr>
								<?php
								$i++;
							endforeach;
							?>
						</tbody>
					</table>
					<?php
				else:
					?>
					<table class="shopping-cart-table table" style="margin-bottom: 450px">
						<thead>
							<tr>
								<th style="border-bottom: 0px !important">
									Tidak ada produk di wishlist.
								</th>
							</tr>
						</thead>
					</table>
					<?php
				endif;
				?>
			</div>
		</div>
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /section -->
<div class="section">
	
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<!-- section title -->
			<div class="col-md-12">
				<div class="section-title">
					<h2 class="title">
						<a href="<?php echo base_url('list-produk'); ?>">
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
<?php
	$this->load->view('js');
?>