<!-- BREADCRUMB -->
<div id="breadcrumb">
	<div class="container">
		<ul class="breadcrumb">
			<li><a href="<?php echo base_url(''); ?>">Beranda</a></li>
			<li><a href="<?php echo base_url('keranjang'); ?>">Keranjang</a></li>
			<li class="active">Checkout</li>
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
			<!-- menu sidebar -->
			<?php $this->load->view('menu_sidebar'); ?>

			<form id="checkout-form" class="clearfix">
				<div class="col-md-9">
					<div class="shiping-methods">
						<div class="section-title">
							<h4 class="title">Alamat Pengiriman</h4>
						</div>
						<div class="nama_alamat">
							<input type="hidden" name="id_alamat" value="" id="id_alamat" value="">
						</div>
						<button type="button" onclick="pilih_alamat();" class="primary-btn" style="font-size: 12px;padding: 5px 10px; text-transform: none;">
							Pilih Alamat Lain
						</button>
					</div>
				</div>
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value='<?php echo $this->security->get_csrf_hash(); ?>'>
				<input type="hidden" name="type" value="checkout">
				<div class="col-md-9" id="detail_bayar">
					<?php $this->load->view('bayar_detail',$detail_bayar); ?>
				</div>
			</form>
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /section -->
<?php
	$this->load->view('terakhir_dilihat');
	$this->load->view('bayar_js');
	$this->load->view('bayar_modal');
?>