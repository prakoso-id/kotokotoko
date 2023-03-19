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
						<li  class="'.($active == 'dashboard'?'active':'').'"><a href="'.base_url('wishlist').'">Wishlist</a></li>
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
					<li  class="'.($active == 'dashboard'?'active':'').'"><a href="'.base_url('wishlist').'">Wishlist</a></li>
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