<div class="col-lg-12">
	<div class="row">
		<?php
		foreach ($produk as $key => $value):
		?>
			<div class="content">
				<div>
					<div class="product__item bom" style="display: flex !important;">
						<a href="<?php echo base_url('list-produk/produk/'.short($value->kode_produk)) ?>">
						<div font-size="12" class="css-1e6gctp-unf-link edi449x0 foto_produk" style="background:url('<?php echo base_url('/assets/produk/'.$value->id_umkm.'/'.$value->foto);?>">

						</div>
						</a>
						<div class="product__item__desc css-1e6gctp-unf-link edi449x0" font-size="12" style="margin-left: 25px;">
							<div class="font__size--m font--bold ellipsis-two-line">
								<div class="nama_produk" style="font-size: 14px;">
									<a href="<?php echo base_url('list-produk/produk/'.short($value->kode_produk)) ?>"><?php echo $value->nama_produk; ?></a>
									<input type="hidden" name="id_produk[]" value="<?php echo $value->id_produk; ?>">
									<input type="hidden" name="id_transaksi_detail[]" value="<?php echo $value->id_transaksi_detail; ?>">
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
					<input class="rating-produk" type="text" title="" name="ratting_produk[]">
				</div>
			</div>
			<div class="position-relative row form-group">
				<div class="col-lg-12" style="text-align: center;">
					<span>Suka barang ini? Berikan ulasan dan rekomendasikan barang ini ke pembeli lain</span>
					<br>
					<input type="hidden" name="data_ratting_produk">

					<span class="help"></span>
					<br>
				</div>
				<div class="col-lg-12" style="text-align: center;">
					<textarea class="form-control" style="resize: none;" rows="5" name="ulasan[]" placeholder="Ulasan"></textarea>
					<input type="hidden" name="data_ulasan" style="text-align:center; font-size:15px;margin-top:20px">
					<span class="help"></span>
					<br>
				</div>
				<div class="col-lg-12">
					<div class="form-check">
					  <input class="form-check-input" type="checkbox" value="1" id="is_anonim_<?= $key; ?>" name="is_anonim[]">
					  <label class="form-check-label" for="is_anonim_<?= $key; ?>">
					    Berikan penilaian tanpa username. Username yang akan ditampilkan adalah <?php echo substr($this->session->nama_lengkap, 0, 1) . "*******" . substr($this->session->nama_lengkap, -1, 1); ?>
					  </label>
					</div>
				</div>
			</div>
			<hr>
		<?php
		endforeach;
		?>
	</div>
</div>