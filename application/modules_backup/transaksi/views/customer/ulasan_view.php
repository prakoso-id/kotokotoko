<div class="col-lg-12">
	<?php
		foreach ($produk as $key => $value):
	?>
		<div class="content">
			<div>
				<div class="product__item bom" style="display: flex !important;">
					<div font-size="12" class="css-1e6gctp-unf-link edi449x0 foto_produk" style="background:url('<?php echo base_url('/assets/produk/'.$value->id_umkm.'/'.$value->foto);?>">

					</div>
					<div class="product__item__desc css-1e6gctp-unf-link edi449x0" font-size="12" style="margin-top: 30px; margin-left: 25px;">
						<div class="font__size--m font--bold ellipsis-two-line">
							<div class="nama_produk" style="font-size: 14px;">
								<?php echo $value->nama_produk; ?>
								<input type="hidden" name="id_produk[]" value="<?php echo $value->id_produk; ?>">
								<input type="hidden" name="username_toko" value="<?php echo $value->username_toko; ?>">
							</div>
						</div>
						<div>
							<span class="harga_produk font__type--trx" style="font-size:13px !important;">
								<?php echo "Rp. ".rp($value->harga); ?>
							</span>
							<span class="stok_produk css-1n5r376 padding--left" style="font-size:13px !important; margin-left: 20px;">
								(<?php echo rp($value->quantity); ?>)
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="position-relative row form-group">
			<div class="col-lg-12 data_ratting_produk">
				<div class="rating-container rating-sm rating-animate">
					<div class="rating-stars">
						<span class="empty-stars">
							<span class="star">
								<i class="glyphicon glyphicon-star-empty"></i>
							</span>
							<span class="star">
								<i class="glyphicon glyphicon-star-empty"></i>
							</span>
							<span class="star">
								<i class="glyphicon glyphicon-star-empty"></i>
							</span>
							<span class="star">
								<i class="glyphicon glyphicon-star-empty"></i>
							</span>
							<span class="star">
								<i class="glyphicon glyphicon-star-empty"></i>
							</span>
						</span>
						<?php
							$jumlah = $value->ratting * 20;
						?>
						<span class="filled-stars data_toko" style="width: <?php echo $jumlah; ?>%">
							<span class="star">
								<i class="glyphicon glyphicon-star"></i>
							</span>
							<span class="star">
								<i class="glyphicon glyphicon-star"></i>
							</span>
							<span class="star">
								<i class="glyphicon glyphicon-star"></i>
							</span>
							<span class="star">
								<i class="glyphicon glyphicon-star"></i>
							</span>
							<span class="star">
								<i class="glyphicon glyphicon-star"></i>
							</span>
						</span>
					</div>
				</div>
			</div>
		</div>
		<div class="position-relative row form-group">
			
			<div class="col-lg-12" style="text-align: center;">
				<span><?php echo text($value->deskripsi); ?></span>
			</div>
		</div>
	<?php
	endforeach;
	?>
</div>
