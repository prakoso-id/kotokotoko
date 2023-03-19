<div class="col-lg-12">
	<div class="row">
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
					<br><br>
				</div>
				<div class="col-lg-12" style="text-align: center;">
					<textarea class="form-control" style="resize: none;" rows="5" name="ulasan[]" placeholder="Ulasan"></textarea>
					<input type="hidden" name="data_ulasan" style="text-align:center; font-size:15px;margin-top:20px">
					<span class="help"></span>
				</div>
			</div>
		<?php
		endforeach;
		?>
	</div>
</div>
<script type="text/javascript">
	var $inpn = $('.rating-produk');
        
    //$inp.attr('value','5');
        
    $inpn.rating({
        min: 0,
        max: 5,
        step: 1,
        size: 'sm',
        showClear: false
    });
</script>