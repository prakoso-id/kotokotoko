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
<div class="container container-240">
    <ul class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>">Beranda</a></li>
        <li><a href="<?php echo base_url('keranjang'); ?>">Keranjang</a></li>
		<li class="active">Checkout</li>
    </ul>
    <div class="row shop-colect">
    	<div class="col-md-12 col-sm-12 col-xs-12 collection-list">
            <div class="e-product">
                <div class="pd-top" style="padding: 20px 0;">
                    <h1 class="title">Checkout</h1>
                </div>
                <div class="row">
                	<form id="checkout-form" class="clearfix">
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

<?php
	$this->load->view('bayar_js');
	$this->load->view('bayar_modal');
?>