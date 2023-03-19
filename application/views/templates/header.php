<!-- HEADER -->
<style type="text/css">
	.active {
		color: #e95a5c;
	}
	.custom-menu {
		z-index: 1000;
	}
</style>
<header>
	<!-- top Header -->
	<div id="top-header">
		<div class="container">
			<div class="pull-left">
				<span>PORTAL UMKM KOTA TANGERANG</span>
			</div>
			<div class="pull-right">
				<ul class="header-top-links">
					<li><a <?php echo ($active == 'list-agenda'?'style="color:#e95a5c"':'') ?> href="<?php echo base_url('agenda') ?>" <?php echo ($active == 'detail-agenda' ?'style="color:#e95a5c"':'') ?>>Agenda</a></li>
					<li><a href="<?php echo base_url('dasar-hukum'); ?>" <?php echo ($active == 'list-hukum'?'style="color:#e95a5c"':'') ?>>Dasar Hukum</a></li>
					<?php
					if($this->user_model->is_umkm_admin())
					{
						echo '
						<li class="dropdown default-dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><strong style="color:#e95a5c">'.$this->session->nama_lengkap.'</strong> <i class="fa fa-caret-down"></i></a>
						<ul class="custom-menu">
							<li><a class="'.($active == 'dashboard'?'active':'').'" href="'.base_url('dashboard').'">Dashboard</a></li>
							<li><a class="'.($active == 'pengguna'?'active':'').'" href="'.base_url('pengguna').'">Pengguna</a></li>
							<li><a class="'.($active == 'umkm'?'active':'').'" href="'.base_url('umkm').'">Verifikasi UMKM</a></li>
							<li><a class="'.($active == 'produk'?'active':'').'" href="'.base_url('produk').'">Produk</a></li>
							<li><a class="'.($active == 'transaksi_admin'?'active':'').'" href="'.base_url('transaksi/admin').'">Transaksi</a></li>
							<li><a class="'.($active == 'slider'?'active':'').'" href="'.base_url('slider').'">Slider</a></li>
							<li><a class="'.($active == 'agenda'?'active':'').'" href="'.base_url('agenda/data').'">Agenda</a></li>
							<li><a class="'.($active == 'dasar_hukum'?'active':'').'" href="'.base_url('dasar_hukum/data').'">Dasar Hukum</a></li>
						</ul>
						</li>
						';
					}
					else if($this->user_model->is_umkm_verifikator())
					{
						echo '
						<li class="dropdown default-dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><strong style="color:#e95a5c">'.$this->session->nama_lengkap.'</strong> <i class="fa fa-caret-down"></i></a>
						<ul class="custom-menu">
							<li><a class="'.($active == 'dashboard'?'active':'').'" href="'.base_url('dashboard').'">Dashboard</a></li>
							<li><a class="'.($active == 'umkm'?'active':'').'" href="'.base_url('umkm').'">Verifikasi UMKM</a></li>
						</ul>
						</li>
						';
					}
					else if($this->user_model->is_umkm_penjual())
					{
						echo '<li><a '.($active == 'pesan'?'style="color:#e95a5c"':'').' href="'.base_url('pesan').'">Pesan</a>
								<span class="count-pesan-all"></span>
								<input type="hidden" name="count_pesan_all" id="count_pesan_all" value="0">
							</li>';
						echo '
						<li class="dropdown default-dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><strong style="color:#e95a5c">'.$this->session->nama_lengkap.'</strong> <i class="fa fa-caret-down"></i></a>
						<ul class="custom-menu">
							<li><a class="'.($active == 'biodata'?'active':'').'" href="'.base_url('customer/biodata').'">Biodata</a></li>
							<li><a class="'.($active == 'alamat'?'active':'').'" href="'.base_url('customer/daftar-alamat').'">Daftar Alamat</a></li>
							<li><a class="'.($active == 'transaksi_customer'?'active':'').'" href="'.base_url('transaksi/customer').'">Transaksi Pembelian</a></li>
							<li><a class="'.($active == 'wishlist'?'active':'').'" href="'.base_url('wishlist').'">Wishlist</a></li>
						</ul>
						</li>
						';

						echo '
						<li class="dropdown default-dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><strong style="color:#e95a5c"> AKUN UMKM</strong> <i class="fa fa-caret-down"></i></a>
						<ul class="custom-menu">
							
							<li><a class="'.($active == 'umkm'?'active':'').'" href="'.base_url('customer/umkm').'">Data UMKM</a></li>
							<li class="'.($active == 'logo_umkm'?'active':'').'"><a href="'.base_url('logo_umkm').'">Logo UMKM</a></li>
							<li><a class="'.($active == 'transaksi_penjual'?'active':'').'" href="'.base_url('transaksi/penjual').'">Transaksi Penjualan</a></li>
						</ul>
						</li>
						';
						echo '<li><a class="'.($active == 'dashboard'?'active':'').'" href="'.base_url('dashboard').'">Dashboard</a></li>
							  <li><a class="'.($active == 'produk'?'active':'').'" href="'.base_url('produk').'">Produk Saya</a></li>';
						
					}
					else if($this->user_model->is_umkm_user())
					{
						echo '<li><a '.($active == 'pesan'?'style="color:#e95a5c"':'').' href="'.base_url('pesan').'">Pesan</a>
								<span class="count-pesan-all"></span>
								<input type="hidden" name="count_pesan_all" id="count_pesan_all" value="0">
							</li>';
						echo '
						<li class="dropdown default-dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><strong style="color:#e95a5c">'.$this->session->nama_lengkap.'</strong> <i class="fa fa-caret-down"></i></a>
						<ul class="custom-menu">
							<li><a class="'.($active == 'biodata'?'active':'').'" href="'.base_url('customer/biodata').'">Biodata</a></li>
							<li><a class="'.($active == 'alamat'?'active':'').'" href="'.base_url('customer/daftar-alamat').'">Daftar Alamat</a></li>
							<li><a class="'.($active == 'transaksi_customer'?'active':'').'" href="'.base_url('transaksi/customer').'">Transaksi Pembelian</a></li>
							<li><a class="'.($active == 'wishlist'?'active':'').'" href="'.base_url('wishlist').'">Wishlist</a></li>
						</ul>
						</li>
						';
						$status = $this->user_model->cek_status_umkm();
						if($status)
						{
							echo '<li class="'.($active == 'umkm'?'active':'').'"><a style="font-weight:700;" href="'.base_url('customer/umkm').'">STATUS UMKM</a></li>';
						}
						else{
							echo '<li class="'.($active == 'umkm'?'active':'').'"><a style="font-weight:700;" href="'.base_url('customer/umkm').'">DAFTAR UMKM</a></li>';
						}
					}
					

					if($this->user_model->is_login())
					{
						echo '<li><a href="'.base_url('keluar').'">Keluar</a></li>';
					}else{
						echo '<li><a href="'.base_url('login').'">Login / Daftar</a></li>';
					}
					?>
				</ul>
			</div>
		</div>
	</div>
	
	<!-- /top Header -->

	<!-- header -->
	<div id="header">
		<div class="container">
			<div class="pull-left">
				<!-- Logo -->
				<div class="header-logo">
					<a class="logo" href="<?php echo base_url(); ?>" style="font-size: 20px;font-weight: 700">
						<img style="width: auto !important;" src="<?php echo base_url('assets/images/logo.png');?>" alt="">
						Portal UMKM Kota Tangerang
					</a>
				</div>
				<!-- /Logo -->
			</div>
			<!-- <div class="pull-right">
				<ul class="header-btns">
					
					<li class="header-cart dropdown default-dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
							<div class="header-btns-icon" style="overflow: visible !important;">
								<i class="fa fa-shopping-cart"></i>
								<span class="qty jumlah_keranjang"><?php echo $jml_keranjang; ?></span>
							</div>
						</a>
						<div class="custom-menu">
							<div id="shopping-cart">
								<?php
								if($keranjang): 
								?>
								<div class="shopping-cart-list">
									<?php
										foreach ($keranjang as $value):
									?>
											<div class="product product-widget <?php echo $value->id_produk; ?>">
												<div class="product-thumb" style="height: 60px;width: 60px; background:url('<?php echo base_url('assets/produk/'.$value->username.'/'.$value->foto);?>');">
												</div>
												<div class="product-body">
													<h3 class="product-price">Rp. <?php echo rp($value->harga); ?></h3>
													<h2 class="product-name"><a href="<?php echo base_url('list-produk/produk/'.short($value->kode_produk)) ?>"><?php echo $value->nama_produk; ?></a></h2>
												</div>
												<a href="javascript:void(0);" class="cancel-btn hapus-produk-<?php echo $value->id_produk; ?>" onclick="add_chart('<?php echo $value->id_produk; ?>','hapus')"><i class="fa fa-trash"></i></a>
											</div>
									<?php
										endforeach;
									?>
								</div>
								<?php else: ?>
								<div class="shopping-cart-list">
									<span>
										<h3 style="font-size: 14px;font-weight: 600;padding: 10px;line-height: 1.5;">TIDAK ADA PRODUK DI KERANJANG.</h3>
									</span>
								</div>
								
								<?php endif; ?>
								<div class="shopping-cart-btns">
									<a href="<?php echo base_url('keranjang'); ?>" class="primary-btn">Lihat Keranjang <i class="fa fa-arrow-circle-right"></i></a>
								</div>
							</div>
						</div>
					</li> -->
					<!--
					<li class="header-cart dropdown default-dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
							<div class="header-btns-icon" style="overflow: visible !important;">
								<i class="fa fa-bell"></i>
								<span class="qty">0</span>
							</div>
						</a>
						<div class="custom-menu">
							<div id="shopping-cart">
								<div class="shopping-cart-list">
									<div class="product product-widget">
										<a href="'.base_url('dashboard').'">Dashboard</a>
									</div>
								</div>
							</div>
						</div>
					</li>
					-->
					<!-- <li class="nav-toggle">
						<button class="nav-toggle-btn main-btn icon-btn"><i class="fa fa-bars"></i></button>
					</li> -->
					<!-- / Mobile nav toggle -->
				<!-- </ul>
				
			</div> -->
		</div>
		<!-- header -->
	</div>
	
	<!-- container -->
</header>
<!-- /HEADER -->
<script type="text/javascript">
	$(document).ready(function(){
		get_count_pesan();
	});

	function get_count_pesan(){
		$.ajax({
	        url : "<?php echo base_url('ajax/ajax_data/')?>",
	        type: "POST",
	        data : {
	            <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>',
	            type : 'count_pesan_all',
	        },
	        dataType: "JSON",
	        success: function(data){
	        	if (data.count > 0) {
	        		var html_count_msg = '<span style="background:#e95a5c;" class="badge">'+data.count+'</span>';
	        		$('.count-pesan-all').html(DOMPurify.sanitize( html_count_msg, { SAFE_FOR_JQUERY: true } ));
	        	}else{
	        		$('.count-pesan-all').html('');
	        	}
	        	$('#count_pesan_all').val(data.count);
	        },
	        error: function (jqXHR, textStatus, errorThrown){
	            alert('Error get data from ajax');
	        }
	    });
	}
</script>
