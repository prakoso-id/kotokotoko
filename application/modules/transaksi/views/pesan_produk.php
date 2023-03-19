<div class="modal-body" style="height: 350px !important; overflow: scroll; overflow-x: hidden;">
	<div class="msg_history">
		<?php
		if(isset($pesan['getpesanmaster'])):
			foreach ($pesan['getpesanmaster'] as $value):
				?>
				<?php
				if($value['username'] == $this->session->identity): //jika sama dengan identity
					?>
					<div class="outgoing_msg">
						<div class="sent_msg">
							<?php
							if($value['id_produk'] != null AND $value['id_produk'] != 0):
							?>
								<div class="row" style="margin-bottom: 10px;">
									<div class="col-md-4 col-sm-12 col-xs-12" style="margin-bottom: 5px;">
										<a href="<?php echo base_url('list-produk/produk/'.short($value['kode_produk'])) ?>"><img src="<?php echo $value['foto']; ?>" alt="" class="img-reponsive img-produk-msg"></a>
									</div>
									<div class="col-md-8 col-sm-12 col-xs-12" >
										<h6 class="product-title"><a href="<?php echo base_url('list-produk/produk/'.short($value['kode_produk'])) ?>"><?php echo readMore($value['nama_produk'],50); ?></a></h6>
									</div>
								</div>
							<?php
							elseif($value['id_transaksi'] != null AND $value['id_transaksi'] != 0):
								$transaksi = pesan_transaksi($value['id_transaksi']);
							?>
								<div class="row" style="margin-bottom: 10px;">
									<div class="col-md-4 col-sm-12 col-xs-12" style="margin-bottom: 5px;">
										<a href="<?php echo base_url('list-produk/produk/'.short($transaksi->kode_produk)) ?>"><img src="<?php echo $transaksi->foto; ?>" alt="" class="img-reponsive img-produk-msg"></a>
									</div>
									<div class="col-md-8 col-sm-12 col-xs-12" >
										<h6 class="product-title"><?php echo strtoupper($transaksi->nama_status); ?></h6>
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
				else:  //jika beda dengan identity
					?>
					<div class="incoming_msg">
						<div class="received_msg">
							<div class="received_withd_msg">
								<?php
								if($value['id_produk'] != null AND $value['id_produk'] != 0):
								?>
									<div class="row" style="margin-bottom: 10px;">
										<div class="col-md-4 col-sm-12 col-xs-12" style="margin-bottom: 5px;">
											<a href="<?php echo base_url('list-produk/produk/'.short($value['kode_produk'])) ?>"><img src="<?php echo $value['foto']; ?>" alt="" class="img-reponsive img-produk-msg"></a>
										</div>
										<div class="col-md-8 col-sm-12 col-xs-12" >
											<h6 class="product-title"><a href="<?php echo base_url('list-produk/produk/'.short($value['kode_produk'])) ?>"><?php echo readMore($value['nama_produk'],50); ?></a></h6>
										</div>
									</div>
								<?php
								elseif($value['id_transaksi'] != null AND $value['id_transaksi'] != 0):
									$transaksi = pesan_transaksi($value['id_transaksi']);
								?>
									<div class="row" style="margin-bottom: 10px;">
										<div class="col-md-4 col-sm-12 col-xs-12" style="margin-bottom: 5px;">
											<a href="<?php echo base_url('list-produk/produk/'.short($transaksi->kode_produk)) ?>"><img src="<?php echo $transaksi->foto; ?>" alt="" class="img-reponsive img-produk-msg"></a>
										</div>
										<div class="col-md-8 col-sm-12 col-xs-12" >
											<h6 class="product-title"><a href="<?php echo base_url('list-produk/produk/'.short($transaksi->kode_produk)) ?>"><?php echo strtoupper($transaksi->nama_status); ?></a></h6>
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
			endforeach;
		else:
		?>
		<center>Belum ada pesan...</center>
		<?php endif;
		?>
	</div>
	<div style="height: 20px;" id="scrollHeightReference"></div>
</div>

<div class="modal-footer">
	<div class="type_msg" style="border-top: 0px; width: 100%">
		<?php if($produk): ?>
			<div class="produk_preview_hapus">
				<div class="produk_preview ">
					<div class="product product-single" style="width: 100%">
						<div class="row" style="padding-bottom: 10px;">
							<div class="col-md-3" style="padding-bottom: 10px;">
	                           	<img src="<?php echo $produk->foto; ?>" alt="" class="img-reponsive img-produk-attach">
	                       	</div>
	                       	<div class="col-md-9">
                                <h6 class="product-title"><?php echo strtoupper($produk->nama_status); ?></h6>
                                <div class="product-price v2"><span><?php echo $produk->no_invoice; ?></span></div>
                                <div class="product-price v2"><span>Rp. <?php echo rp($produk->total); ?></span></div>
	                        </div>
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
				<i class="fa fa-paper-plane" aria-hidden="true"></i>
			</button>
		</div>
	</div>
</div>
<script type="text/javascript">
	$('.modal-body').animate({
		scrollTop: $("#scrollHeightReference").offset().top
	}, 2000);
</script>