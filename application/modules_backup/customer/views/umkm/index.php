<style type="text/css">
	.select2-results__option[aria-selected=true] { display: none;}
</style>
<div class="product-body">
	<div class="daftar_umkm">
		<h2 class="product-name">Daftar UMKM</h2>
		<div class="position-relative row form-group">
			<label class="col-sm-12 col-form-label" style="font-weight:500">
				Halaman ini diperuntukan bagi pelaku UMKM yang  memiliki produk dan ingin menjual produknya melalui portal UMKM. Apakah anda sudah memiliki IUMK?
			</label>
		</div>
		<button type="button" class="btn btn-primary" onclick="button_sudah(1)">
			<i class="fa fa-sign-in"></i> &nbsp; Sudah
		</button>
		<button type="button" class="btn btn-danger" onclick="button_sudah(0)">
			<i class="fa fa-sign-in"></i> &nbsp; Belum
		</button>
	</div>
	
</div>
<?php
	$this->load->view('modal');
	$this->load->view('js');
?>