<!-- menu nav -->
<div class="menu-nav">
	<span class="menu-header">Menu <i class="fa fa-bars"></i></span>
	<ul class="menu-list">
		<li>
			<a class="<?php echo ($active == 'beranda'?'active':'') ?>" href="<?php echo base_url() ?>">
				Beranda
			</a>
		</li>
		<li>
			<a class="<?php echo ($active == 'list-umkm'?'active':'') ?>" href="<?php echo base_url('list-umkm') ?>">
				UMKM
			</a>
		</li>
		<li>
			<a class="<?php echo ($active == 'list-produk'?'active':'') ?>" href="<?php echo base_url('list-produk') ?>">
				Produk
			</a>
		</li>
		<li>
			<a class="<?php echo ($active == 'list-berita'?'active':'') ?>" href="<?php echo base_url('list-berita') ?>">
				Berita
			</a>
		</li>
	</ul>
</div>
<!-- menu nav -->