<style type="text/css">
	.image-produk {
		width: 60px;
		height: 60px;
		object-fit: cover;
		display: block;
		margin-left: auto;
		margin-right: auto;
		border: 1px solid #f0f0f0;
		border-radius: 5px;
	}
	.form-group .select2-container { position: relative; z-index: 2; float: left; width: 100%; margin-bottom: 0; display: table; table-layout: fixed;} 
</style>
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Checkout</h4>
                    <div class="breadcrumb__links">
						<a href="<?php echo base_url(); ?>">Beranda</a>
						<a href="<?php echo base_url('keranjang'); ?>">Keranjang</a>
                        <span>Checkout</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->
<div class="container container-240">
    <div class="row shop-colect">
    	<div class="col-md-12 col-sm-12 col-xs-12 collection-list">
            <div class="e-product">
                <div class="pd-top" style="padding: 20px 0;">
                    <h1 class="title"></h1>
                </div>
                <div class="row">
                	<form id="checkout-form" class="clearfix">
						
						<?php if($data_user === null){?>
							<div class="col-md-12" style="margin-bottom: 20px;">
								<div class="shopping-cart bd-7">
									<table class="table" width="100%">
										<thead>
											<tr><th>Informasi Penerima</th></tr>
										</thead>
										<tbody>
											<tr>
												<td>
													<label for="exampleInputEmail1">Email </label>
													<input type="email" class="form-control" id="email_anon" name="email_anon" aria-describedby="emailHelp" placeholder="Email Penerima">
												</td>
											</tr>
											<tr>
												<td>
													<label for="exampleInputEmail1">Nama Penerima </label>
													<input type="text" class="form-control" id="nama_anon" name="nama_anon" aria-describedby="emailHelp" placeholder="Nama Penerima">
												</td>
											</tr>
											<tr>
												<td>
													<label for="exampleInputEmail1">No Telp </label>
													<input type="text" class="form-control" id="no_telp_anon" name="no_telp_anon" aria-describedby="emailHelp" onkeypress="return Angkasaja(event)" placeholder="083111111***">
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						<?} ?>
                		<div class="col-md-12" style="margin-bottom: 20px;">
                			<div class="shopping-cart bd-7">
                				<table class="table" width="100%">
									<thead>
										<tr><th>Alamat Pengiriman</th></tr>
									</thead>
									<tbody>
										<tr>
											<td>
												<div class="nama_alamat">
													<input type="hidden" name="id_alamat" value="" id="id_alamat" value="">
												</div>
											</td>
										</tr>
									</tbody>
									<tfoot>
										<tr>
											<td>
												<button type="button" onclick="pilih_alamat();" class="btn" style="font-size: 12px;padding: 5px 10px; text-transform: none;">Pilih Alamat Lain</button>
											</td>
										</tr>
									</tfoot>
								</table>
								<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value='<?php echo $this->security->get_csrf_hash(); ?>'>
								<input type="hidden" name="type" value="checkout">
								<input type="hidden" id="data_user" name="data_user" value="<?= ($data_user == '') ? 'kosong' : 'ada';?>">

                			</div>
                		</div>

                		<div class="col-md-12" id="detail_bayar">
                			<?php $this->load->view('bayar_detail',$detail_bayar); ?>
                		</div>
                	</form>
				</div>
			</div>
        </div>
    </div>

    <?php $this->load->view('terakhir_dilihat'); ?>
</div>

<!-- <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-I6-gbAMFndGtup5U"></script> -->
<!-- <script src="https://app.midtrans.com/snap/snap.js" data-client-key="Mid-client-4uYv68mbQD3CkMvY"></script> -->
<?php
	$this->load->view('bayar_js');
	$this->load->view('bayar_modal');
?>