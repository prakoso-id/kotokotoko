<div class="chat_list">
	<div class="chat_people">
		<div class="chat_img" style="width: 3.5%;">
			<?php
				echo get_icon($nama);
			?>
		</div>
		<div class="chat_ib" style="margin-top: 5px;margin-bottom: 5px;">
			<?php 
			if($flag == 1){
				echo '<p style="color: #AB2828; font-size: 11px;">Penjual</p>';
			}elseif($flag == 2){
				echo '<p style="color: #AB2828; font-size: 11px;">Admin</p>';
			} 
			?>
			<h5>
				<?php echo strtoupper($nama); ?>
			</h5>
		</div>
	</div>
</div>

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
									<div class="row" style="margin-bottom: 10px;">
										<div class="col-md-3 col-sm-12 col-xs-12" style="margin-bottom: 5px;">
											<a href="<?php echo base_url('list-produk/produk/'.short($value['kode_produk'])) ?>"><img src="<?php echo $value['foto']; ?>" alt="" class="img-reponsive img-produk-msg"></a>
										</div>
										<div class="col-md-9 col-sm-12 col-xs-12" >
											<h5 class="product-title"><a href="<?php echo base_url('list-produk/produk/'.short($value['kode_produk'])) ?>"><?php echo readMore($value['nama_produk'],50); ?></a></h5>
										</div>
									</div>
								<?php
								elseif($value['id_transaksi'] != null AND $value['id_transaksi'] != 0):
									$transaksi = pesan_transaksi($value['id_transaksi']);
								?>
									<div class="row" style="margin-bottom: 10px;">
										<div class="col-md-3 col-sm-12 col-xs-12" style="margin-bottom: 5px;">
											<a href="<?php echo base_url('list-produk/produk/'.short($transaksi->kode_produk)) ?>"><img src="<?php echo $transaksi->foto; ?>" alt="" class="img-reponsive img-produk-msg"></a>
										</div>
										<div class="col-md-9 col-sm-12 col-xs-12" >
											<h5 class="product-title"><?php echo strtoupper($transaksi->nama_status); ?></h5>
											<div class="product-price v2"><span><?php echo $transaksi->no_invoice; ?></span></div>
		                                		<div class="product-price v2"><span>Rp. <?php echo rp($transaksi->total); ?></span></div>
										</div>
									</div>
								<?php
								endif;
								?>
								<p> 
									<?php echo $value['pesan']; ?>
								</p>
								<span class="time_date"> <?php echo indonesian_date($value['created_at']); ?></span>
								<span class="time_date"> <?php echo ($value['read_at'])?'Dibaca':''; ?></span>
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
										<div class="row" style="margin-bottom: 10px;">
											<div class="col-md-3 col-sm-12 col-xs-12" style="margin-bottom: 5px;">
												<a href="<?php echo base_url('list-produk/produk/'.short($value['kode_produk'])) ?>"><img src="<?php echo $value['foto']; ?>" alt="" class="img-reponsive img-produk-msg"></a>
											</div>
											<div class="col-md-9 col-sm-12 col-xs-12" >
												<h5 class="product-title"><a href="<?php echo base_url('list-produk/produk/'.short($value['kode_produk'])) ?>"><?php echo readMore($value['nama_produk'],50); ?></a></h5>
											</div>
										</div>
									<?php
									elseif($value['id_transaksi'] != null AND $value['id_transaksi'] != 0):
										$transaksi = pesan_transaksi($value['id_transaksi']);
									?>
										<div class="row" style="margin-bottom: 10px;">
											<div class="col-md-3 col-sm-12 col-xs-12" style="margin-bottom: 5px;">
												<a href="<?php echo base_url('list-produk/produk/'.short($transaksi->kode_produk)) ?>"><img src="<?php echo $transaksi->foto; ?>" alt="" class="img-reponsive img-produk-msg"></a>
											</div>
											<div class="col-md-9 col-sm-12 col-xs-12" >
												<h5 class="product-title"><a href="<?php echo base_url('list-produk/produk/'.short($transaksi->kode_produk)) ?>"><?php echo strtoupper($transaksi->nama_status); ?></a></h5>
												<div class="product-price v2"><span><?php echo $transaksi->no_invoice; ?></span></div>
			                                		<div class="product-price v2"><span>Rp. <?php echo rp($transaksi->total); ?></span></div>
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
		<button type="button" class="btn btn-sm btn-msg-auto" data-msg="Hai ! Apakah produk ini masih tersedia ?">Hai ! Apakah produk ini masih tersedia ?</button> 
		<button type="button" class="btn btn-sm btn-msg-auto" data-msg="Terima kasih !">Terima kasih !</button>

		<input type="hidden" name="id_produk" value="0">
		<input type="hidden" name="username" value="<?php echo $this->session->identity; ?>">
		<input type="hidden" name="id_group" value="<?php echo $id_group; ?>">
		<input type="text" name="pesan_chat" class="write_msg" placeholder="Tulis pesan anda disini..." />
		<button class="msg_send_btn" type="button" id="btn_send_msg">
			<i class="fa fa-paper-plane" aria-hidden="true"></i>
		</button>
	</div>
</div>