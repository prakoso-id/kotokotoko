<?php
	$this->session->set_tempdata('code',random_num(20),60);
?>
<style type="text/css">
	button[disabled]{
	color: #eee;
    background-color: #ffffff;
    border:1px solid #eee;
	}
</style>
<!-- BREADCRUMB -->
<div id="breadcrumb">
	<div class="container">
		<ul class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>">Beranda</a></li>
			<li class="active">Keranjang</li>
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

			<form id="checkout-form" class="clearfix" method="post" action="<?php echo base_url('keranjang/'.$this->session->tempdata('code')) ?>">
				<div class="col-md-9">
					<div class="order-summary clearfix">
						<div class="section-title">
							<h3 class="title">
								<div class="form-group">
									<div class="input-checkbox">
										<input class="check_semua" type="checkbox" checked="true">
										<label class="font-weak" for="" style="color: #30323A;margin: 0 0 0 20px;font-weight: 700;font-size: 16px;"> Pilih Semua</label>
									</div>
								</div>
							</h3>
						</div>
						<?php
							if($keranjang):
						?>
								<table class="shopping-cart-table table">
									<thead>
										<tr>
											<th></th>
											<th>Produk</th>
											<th></th>
											<th class="text-center">Harga</th>
											<th class="text-center">Jumlah</th>
											<th class="text-center">Total</th>
											<th class="text-right"></th>
										</tr>
									</thead>
									<tbody>
										<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
										<?php
										$i=0;
										foreach ($keranjang as $value):
										?>
												<tr id="list-data-<?php echo $value->id_produk; ?>">
													<td>
														<div class="form-group">
															<div class="input-checkbox">
																<input type="hidden" name="id_produk[<?php echo $i; ?>]" value="<?php echo $value->id_produk; ?>">
																<input name="is_checked[<?php echo $i; ?>]" class="check_<?php echo $i; ?>" type="checkbox" checked="true">
															</div>
														</div>
													</td>
													<td><div class="product-thumb" style="height: 150px;width: 150px; background:url('<?php echo base_url('assets/produk/'.$value->username.'/'.$value->foto);?>');">
														<input type="hidden" name="foto_produk[<?php echo $i; ?>]" value="<?php echo base_url('assets/produk/'.$value->username.'/'.$value->foto);?>">
													</div>
														</td>
													<td class="details">
														<a href="<?php echo base_url('list-produk/produk/'.short($value->kode_produk)) ?>"><?php echo $value->nama_produk; ?></a>
														<input type="hidden" name="nama_produk[<?php echo $i; ?>]" value="<?php echo $value->nama_produk; ?>">
														<ul>
															<li><span>Stok : <?php echo $value->stok; ?></span></li>
														</ul>
													</td>
													<td class="price text-center">
														<strong>Rp. <?php echo rp($value->harga); ?></strong>
														<input type="hidden" name="harga[<?php echo $i; ?>]" id="harga_<?php echo $i; ?>" value="<?php echo $value->harga; ?>">
														<input type="hidden" name="berat[<?php echo $i; ?>]" id="berat_<?php echo $i; ?>" value="<?php echo $value->berat; ?>">
													</td>
													<td class="qty text-center" width="120px">
														<div class="input-group">
															<span class="input-group-btn">
																<button type="button" class="btn btn-default btn-number-<?php echo $i; ?>" id="minus-<?php echo $i; ?>" data-type="minus" data-field="data_quantity_<?php echo $i; ?>">
																	<span class="glyphicon glyphicon-minus"></span>
																</button>
															</span>
															<input type="text" name="quantity[<?php echo $i; ?>]" id="data_quantity_<?php echo $i; ?>" class="form-control input-number-<?php echo $i; ?>" value="<?php echo $value->quantity; ?>" min="1" max="<?php echo $value->stok; ?>">
															<span class="input-group-btn">
																<button type="button" class="btn btn-default btn-number-<?php echo $i; ?>" data-type="plus" data-field="data_quantity_<?php echo $i; ?>" id="plus-<?php echo $i; ?>">
																	<span class="glyphicon glyphicon-plus"></span>
																</button>
															</span>
														</div>
													</td>
													<td class="total text-center"><strong class="total_<?php echo $i; ?> primary-color">
														<?php
															$total = $value->harga * $value->quantity; 
															echo "Rp. ".rp($total);
														?>
														
													</strong>
												<input type="hidden" name="sub_total_harga_barang[<?php echo $i; ?>]" id="total_<?php echo $i; ?>" value="<?php echo $total; ?>">
												<input type="hidden" name="id_umkm[<?php echo $i; ?>]" id="id_umkm_<?php echo $i; ?>" value="<?php echo $value->username; ?>">
												<input type="hidden" name="nama_umkm[<?php echo $i; ?>]" id="nama_umkm_<?php echo $i; ?>" value="<?php echo $value->nama_umkm; ?>">
												<input type="hidden" name="id_kel_umkm[<?php echo $i; ?>]" id="id_kel_umkm_<?php echo $i; ?>" value="<?php echo $value->id_kel_umkm; ?>">
												<input type="hidden" name="id_kec_umkm[<?php echo $i; ?>]" id="id_kec_umkm_<?php echo $i; ?>" value="<?php echo $value->id_kec_umkm; ?>">
												<input type="hidden" name="no_kab_umkm[<?php echo $i; ?>]" id="no_kab_umkm_<?php echo $i; ?>" value="<?php echo $value->no_kab_umkm; ?>">
												<input type="hidden" name="no_prop_umkm[<?php echo $i; ?>]" id="no_prop_umkm_<?php echo $i; ?>" value="<?php echo $value->no_prop_umkm; ?>">
												<input type="hidden" name="id_kurir_umkm[<?php echo $i; ?>]" id="id_kurir_umkm_<?php echo $i; ?>" value='<?php echo $value->id_kurir_umkm; ?>'>
											</td>

													<td class="text-right">
														<button type="button" class="main-btn icon-btn hapus-produk-<?php echo $i; ?>">
															<i class="fa fa-trash"></i>
														</button>
													</td>
												</tr>
										<?php
										$i++;
										endforeach;
										?>
									</tbody>
									<tfoot>
										<tr>
											<th class="empty" colspan="4"></th>
											<th>TOTAL
												<input type="hidden" name="total_harga">
											</th>
											<th colspan="2" class="total total_harga">
												Rp
												
											</th>
										</tr>
									</tfoot>
								</table>
								<div class="pull-right">
									<button type="submit" class="primary-btn bayar_semua">
										Selanjutnya
									</button>
								</div>
						<?php
							else:
						?>
							<table class="shopping-cart-table table" style="margin-bottom: 450px">
								<thead>
									<tr>
										<th style="border-bottom: 0px !important">
											Tidak ada produk di keranjang.
										</th>
									</tr>
								</thead>
							</table>
						<?php
							endif;
						?>
					</div>

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
	$this->load->view('js');
?>