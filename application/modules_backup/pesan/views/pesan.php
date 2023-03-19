<div class="pesaaann">
	<div class="msg_history">
		<?php
			if(isset($pesan['getpesanmaster'])):
			foreach ($pesan['getpesanmaster'] as $value):
				?>
					<?php
					if($value['username'] == $this->session->identity):
						?>
						<div class="outgoing_msg">
							<div class="sent_msg">
								<?php
								if($value['id_produk'] != null AND $value['id_produk'] != 0):
								?>
									<div class="product product-single" style="width: 100%;">
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
											<h5 style="font-size: 11px;font-weight: 400;"><?php echo $transaksi->no_invoice; ?></h5>
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
						<div class="incoming_msg">
							<div class="received_msg">
								<div class="received_withd_msg">
									<?php
									if($value['id_produk'] != null AND $value['id_produk'] != 0):
									?>
										<div class="product product-single" style="width: 100%;">
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
												<h5 style="font-size: 11px;font-weight: 400;"><?php echo $transaksi->no_invoice; ?></h5>
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
		<div style="height: 20px;" id="scrollHeightReference"></div>
	</div>
		
</div>

<div class="type_msg">
	<div class="input_msg_write">
		<input type="hidden" name="id_produk" value="0">
		<input type="hidden" name="username" value="<?php echo $this->session->identity; ?>">
		<input type="hidden" name="id_group" value="<?php echo $id_group; ?>">
		<input type="text" name="pesan_chat" class="write_msg" placeholder="Tulis pesan anda disini." />
		<button class="msg_send_btn" type="button" id="btn_send_msg">
			<i class="fa fa-paper-plane-o" aria-hidden="true"></i>
		</button>
	</div>
</div>