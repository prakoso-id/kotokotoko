<div class="modal-body" style="height: 350px !important; overflow: scroll; overflow-x: hidden;">
	<div class="msg_history">
		<?php
		if(isset($pesan['getpesanmaster'])):
			foreach ($pesan['getpesanmaster'] as $value):
				?>
				<?php
				if($value['username'] == $this->session->identity):
					?>
					<div id="test_pesan" class=" outgoing_msg">
						<div class="sent_msg">
							<?php
							if($value['id_produk'] != null AND $value['id_produk'] != 0):
							?>
								<div class="product product-single">
									<div class="product-thumb">
										<a target="blank" href="<?php echo base_url('list-produk/produk/'.short($value['kode_produk'])) ?>" class="main-btn quick-view">
											<i class="fa fa-search-plus"></i> Lihat
										</a> 
										<div class="produk-foto" style="background:url('<?php echo $value['foto']; ?>');margin: 0 auto; width: 200px !important;">

										</div>
									</div>
									<div class="product-body">
										<h3 class="product-price" style="font-size: 16px;">
											Rp. <?php echo rp($value['harga']); ?>
										</h3>
										<h2 class="product-name">
											<a target="blank" href="<?php echo base_url('list-produk/produk/'.short($value['kode_produk'])) ?>">
												<?php echo $value['nama_produk']; ?>
											</a>
										</h2>
									</div>
								</div>
							<?php
							elseif($value['id_transaksi'] != null AND $value['id_transaksi'] != 0):
								$transaksi = pesan_transaksi($value['id_transaksi']);
							?>
								<div class="product product-single" style="width: 100%;">
									<div class="product-thumb"> 
										<a target="blank" href="<?php echo base_url('list-produk/produk/'.short($transaksi->kode_produk)) ?>" class="main-btn quick-view">
											<i class="fa fa-search-plus"></i> Lihat
										</a> 
										<div class="produk-foto" style="background:url('<?php echo $transaksi->foto; ?>'); margin: 0 auto; width: 200px !important;">

										</div>
									</div>
									<div class="product-body">
										<h2 class="product-name">
											<?php echo strtoupper($transaksi->nama_status); ?>
										</h2>
										<h5 style="font-size: 11;font-weight: 400;"><?php echo $transaksi->no_invoice; ?></h5>
										<h3 class="product-price">
											Rp. <?php echo rp($transaksi->total_harga); ?>
										</h3>
									</div>
								</div>
							<?php
							endif;
							?>
							<p> 
								<?php echo $value['pesan']; ?>
							</p>
							<span class="time_date"> <?php echo indonesian_date($value['created_at']); ?></span>
						</div>
					</div>
					<?php
				else:
					?>
					<div id="test_pesan" class=" incoming_msg">
						<div class="received_msg">
							<div class="received_withd_msg">
								<?php
								if($value['id_produk'] != null AND $value['id_produk'] != 0):
								?>
									<div class="product product-single">
										<div class="product-thumb">
											<a target="blank" href="<?php echo base_url('list-produk/produk/'.short($value['kode_produk'])) ?>" class="main-btn quick-view">
												<i class="fa fa-search-plus"></i> Lihat
											</a> 
											<div class="produk-foto" style="background:url('<?php echo $value['foto']; ?>');margin: 0 auto; width: 200px !important;">

											</div>
										</div>
										<div class="product-body">
											<h3 class="product-price" style="font-size: 16px;">
												Rp. <?php echo rp($value['harga']); ?>
											</h3>
											<h2 class="product-name">
												<a target="blank" href="<?php echo base_url('list-produk/produk/'.short($value['kode_produk'])) ?>">
													<?php echo $value['nama_produk']; ?>
												</a>
											</h2>
										</div>
									</div>
								<?php
								elseif($value['id_transaksi'] != null AND $value['id_transaksi'] != 0):
									$transaksi = pesan_transaksi($value['id_transaksi']);
								?>
									<div class="product product-single" style="width: 100%;">
										<div class="product-thumb"> 
											<a target="blank" href="<?php echo base_url('list-produk/produk/'.short($transaksi->kode_produk)) ?>" class="main-btn quick-view">
												<i class="fa fa-search-plus"></i> Lihat
											</a> 
											<div class="produk-foto" style="background:url('<?php echo $transaksi->foto; ?>'); margin: 0 auto; width: 200px !important;">

											</div>
										</div>
										<div class="product-body">
											<h2 class="product-name">
												<?php echo strtoupper($transaksi->nama_status); ?>
											</h2>
											<h5 style="font-size: 11;font-weight: 400;"><?php echo $transaksi->no_invoice; ?></h5>
											<h3 class="product-price">
												Rp. <?php echo rp($transaksi->total_harga); ?>
											</h3>
										</div>
									</div>
								<?php
								endif;
								?>
								<p> 
									<?php echo $value['pesan']; ?>
								</p>
								<span class="time_date"> <?php echo indonesian_date($value['created_at']); ?></span>
							</div>
						</div>
					</div>
					
					<?php
				endif;
				?>

				<?php
			endforeach;
		endif;
		?>
	</div>
	<div style="height: 20px;" id="scrollHeightReference"></div>
</div>
<div class="modal-footer">
	<div class="type_msg" style="border-top: 0px">
		<?php if($produk): ?>
			<div class="produk_preview_hapus">
				
				<div class="produk_preview ">
					<div class="product product-single" style="width: 100%">
						<div class="product-thumb" style="float: left;"> 
							<div class="produk-foto" style="background:url('<?php echo $produk->foto; ?>');">

							</div>
						</div>
						<div class="product-body">
							<h2 class="product-name">
								<?php echo strtoupper($produk->nama_status); ?>
							</h2>
							<p><?php echo $produk->no_invoice; ?></p>
							<h3 class="product-price">
								Rp. <?php echo rp($produk->total_harga); ?>
							</h3>
							
						</div>
					</div>
					<button class="btn btn-danger button_hapus" type="button" onclick="hapus()">
						<i class="fa fa-times" aria-hidden="true"></i>
					</button>
				</div>
			</div>

		<?php endif; ?>
		<div class="input_msg_write">
			<input type="hidden" name="id_transaksi_pesan" value="<?php echo @$produk->id_transaksi; ?>">
			<input type="hidden" name="username" value="<?php echo $this->session->identity; ?>">
			<input type="text" name="pesan_chat" class="write_msg" placeholder="Tulis pesan anda disini." />
			<button class="msg_send_btn" type="button" onclick="kirim_pesan(<?php echo $id_group; ?>)">
				<i class="fa fa-paper-plane-o" aria-hidden="true"></i>
			</button>
		</div>
	</div>
</div>
<script type="text/javascript">
	$('.modal-body').animate({
					scrollTop: $("#scrollHeightReference").offset().top
				}, 2000);
</script>