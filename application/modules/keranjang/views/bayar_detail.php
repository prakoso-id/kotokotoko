<div class="col-md-8 col-sm-8 col-xs-12" style="margin-bottom: 20px; padding-left:0px !important;">
	<div class="shopping-cart bd-7">
	<?php
	$i=0; 
	foreach ($detail_bayar['data'] as $u){ ?>
	<input type="hidden" name="id_umkm[<?= $u['id_umkm']; ?>]" id="id_umkm_<?= $u['id_umkm']; ?>" value="<?= $u['id_umkm']; ?>">
	<input type="hidden" name="username_umkm[<?= $u['id_umkm']; ?>]" id="username_umkm_<?= $u['id_umkm']; ?>" value="<?= $u['username_umkm']; ?>">
	<table class="table table-hover table-striped" width="100%">
		<thead>
			<tr>
				<th colspan="5">
					<a href="<?php echo base_url('toko/'.short($u['id_umkm'])); ?>" target="_blank">
						<i class="fa fa-shopping-cart"></i> <?php echo $u['nama_umkm']; echo ($u['is_verify_umkm'] == 1) ? ' <i class="fa fa-check-circle fa-gradient"></i>' : ''; ?>
					</a>
					<br>
					<span style="font-size:10px;color:#999999;"><i class="fa fa-map-marker"></i> <?php echo $u['nama_kel_umkm']; ?></span>
				</th>
			</tr>
			<tr>
				<th width="10%">Produk</th>
				<th width="30%"></th>
				<th width="25%" class="text-center">Harga</th>
				<th width="10%" class="text-center">Jumlah</th>
				<th width="25%" class="text-center">Total</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			foreach ($u['produk'] as $p) { ?>
				<tr>
					<td class="thumb"><img src="<?php echo $p['foto_produk']; ?>" alt="" class="img-reponsive image-produk"></td>
					<td class="details">
						<a href="<?php echo base_url('list-produk/produk/'.short($p['kode_produk'])); ?>" target="_blank">
							<?php echo $p['nama_produk']; ?> 
							<br>
							<small>ukuran : <?php echo $p['size']; ?> </small>
						</a>
						<ul>
							<li>
								<input type="hidden" name="id_produk[<?php echo $i; ?>]" value="<?php echo $p['id_produk']; ?>">
								<input type="hidden" name="quantity[<?php echo $i; ?>]" value="<?php echo $p['quantity']; ?>">
								<input type="hidden" name="size[<?php echo $i; ?>]" value="<?php echo $p['size']; ?>">

								<input type="hidden" name="harga[<?php echo $i; ?>]" value="<?php echo $p['harga'] - intval($p['diskon']); ?>">
								<input type="hidden" name="berat[<?php echo $i; ?>]" value="<?php echo $p['berat']; ?>">
								<textarea name="catatan[<?php echo $i; ?>]" class="form-control" placeholder="Tulis Catatan untuk Toko" style="resize: none;"></textarea>
								<input type="hidden" name="<?= $u['id_umkm']; ?>[<?php echo $i; ?>]" value="<?php echo $u['id_umkm']; ?>">
							</li>
						</ul>
					</td>
					<td class="price text-right">
						<?php if ($p['diskon_persen'] > 0) { ?>
							<strong>Rp. <?php echo rp($p['harga'] - intval($p['diskon'])); ?></strong> <span style="font-size: 10px; margin-left:10px;text-decoration:line-through;">Rp. <?php echo rp($p['harga']); ?></span>
						<?php }else{ ?>
							<strong>Rp. <?php echo rp($p['harga']); ?></strong>
						<?php } ?>
					</td>
					<td class="qty text-center">
						<strong><?php echo rp($p['quantity']); ?></strong><br>
						<span style="font-size:10px;color:#999999;">Berat : <?php echo $p['jumlah_berat_barang'].' Kg.' ?></span>
					</td>
					<td class="total text-right"><strong>Rp. <?php echo rp($p['jumlah_harga_barang'] - $p['jumlah_diskon_barang']); ?></strong></td>
				</tr>
			<?php 
			$i++;
			}
			?>
		</tbody>
		<tfoot>
			<tr>
				<th colspan="2">
					Biaya Pengiriman
					<br>
					<span style="font-size:10px;color:#999999;">Jumlah Berat Barang : <?php echo $u['jumlah_berat_barang'].' Kg.' ?></span>
				</th>
				<th colspan="2"> 
					<input type="hidden" name="id_kel_umkm[<?= $u['id_umkm']; ?>]" id="id_kel_umkm_<?= $u['id_umkm']; ?>" value="<?= $u['id_kel_umkm']; ?>">
					<input type="hidden" name="id_kec_umkm[<?= $u['id_umkm']; ?>]" id="id_kec_umkm_<?= $u['id_umkm']; ?>" value="<?= $u['id_kec_umkm']; ?>">
					<input type="hidden" name="no_kab_umkm[<?= $u['id_umkm']; ?>]" id="no_kab_umkm_<?= $u['id_umkm']; ?>" value="<?= $u['no_kab_umkm']; ?>">
					<input type="hidden" name="no_prop_umkm[<?= $u['id_umkm']; ?>]" id="no_prop_umkm_<?= $u['id_umkm']; ?>" value="<?= $u['no_prop_umkm']; ?>">

					Pilih Kurir :
					<div class="row form-group">
						<div class="col-sm-12">
							<select name="id_kurir[<?= $u['id_umkm']; ?>]" id="id_kurir_<?= $u['id_umkm']; ?>" class="form-control select2" onchange="get_ongkir(<?= $u['id_umkm']; ?>)">
								<option value="">--Pilih Kurir--</option>
								<?php 
								foreach ($u['kurir'] as $k) {
									echo '<option value="'.$k['id_kurir'].'#'.$k['kode_kurir'].'">'.$k['nama_kurir'].'</option>';
								}
								?>
							</select>
							<input type="hidden" name="nama_kurir[<?= $u['id_umkm']; ?>]" id="nama_kurir_<?= $u['id_umkm']; ?>">
							<span class="help"></span>
						</div>
					</div>

					Pilih Service :
					<div class="row form-group">
						<div class="col-sm-12">
							<select name="kurir_service[<?= $u['id_umkm']; ?>]" id="kurir_service_<?= $u['id_umkm']; ?>" class="form-control select2" onchange="set_ongkir(<?= $u['id_umkm']; ?>)">
								<option value="">--Pilih Service--</option>
							</select>
							<input type="hidden" name="nama_service[<?= $u['id_umkm']; ?>]" id="nama_service_<?= $u['id_umkm']; ?>">
							<span class="help"></span>
						</div>
					</div>
				</th>
				<th class="text-right">Rp. <span class="sub_total_ongkir_umkm_<?= $u['id_umkm']; ?>"><?= rp(0); ?></span></th>
			</tr>
			<tr>
				<th class="empty" colspan="2"></th>
				<th colspan="2">Total Pesanan (<?= $u['jumlah_produk']; ?> Barang)</th>
				<th class="sub_total_pesanan text-right">
					<strong class="primary-color"> Rp. <span class="sub_total_pesanan_<?= $u['id_umkm']; ?>"><?php echo rp($u['jumlah_harga_barang'] - $u['jumlah_diskon_barang']); ?></span></strong>
					<input type="hidden" name="sub_total_berat_barang_umkm[<?= $u['id_umkm']; ?>]" id="sub_total_berat_barang_umkm_<?= $u['id_umkm']; ?>" value="<?= $u['jumlah_berat_barang']; ?>">
					<input type="hidden" name="sub_total_harga_barang_umkm[<?= $u['id_umkm']; ?>]" id="sub_total_harga_barang_umkm_<?= $u['id_umkm']; ?>" value="<?= $u['jumlah_harga_barang']; ?>">
					<input type="hidden" name="sub_total_diskon_barang_umkm[<?= $u['id_umkm']; ?>]" id="sub_total_diskon_barang_umkm_<?= $u['id_umkm']; ?>" value="<?= $u['jumlah_diskon_barang']; ?>">
					<input type="hidden" name="sub_total_ongkir_umkm[<?= $u['id_umkm']; ?>]" id="sub_total_ongkir_umkm_<?= $u['id_umkm']; ?>">
					<!-- sub_total_harga_barang_umkm + ongkir_umkm -->
					<input type="hidden" name="sub_total_pesanan[<?= $u['id_umkm']; ?>]" id="sub_total_pesanan_<?= $u['id_umkm']; ?>" value="<?= $detail_bayar['sub_total_harga_barang'] - $detail_bayar['jumlah_diskon']; ?>">
				</th>
			</tr>
		</tfoot>
		</table>
	<?php 
	}
	?>
	</div>
</div>

<div class="col-md-4 col-sm-4 col-xs-12" style="margin-bottom: 20px; padding-right:0px !important;">
	<div class="cart-total bd-7">
		<div class="table-responsive">
	        <table class="shop_table">
	        	<thead>
	        		<tr><th colspan="2"><h4>Metode Pembayaran</h4></th></tr>
	        	</thead>
	            <tbody>
	                <tr class="cart-subtotal">
						<th width="100%">
							<div class="row form-group">
								<div class="col-sm-12">
									<select name="pilih_pembayaran" id="pilih_pembayaran" class="form-control select2">
										<!-- <option value="">--Pilih Pembayaran--</option>
										<option value="tf">Transfer Bank</option>
										<option value="va">BJB Virtual Account</option> -->
										<option value="mid" selected>Midtrans</option>
									</select>
									<input type="hidden" name="pilih_pembayaran_hidden" id="pilih_pembayaran_hidden">
									<span class="help"></span>
								</div>
							</div>
						</th>
					</tr>
	            </tbody>
	        </table>
	    </div>
	</div>
</div>

<div class="col-md-4 col-sm-4 col-xs-12" style="margin-bottom: 20px; padding-right:0px !important;">
	<div class="cart-total bd-7">
		<div class="table-responsive">
	        <table class="shop_table">
	        	<thead>
	        		<tr><th colspan="2"><h4>Ringkasan Belanja</h4></th></tr>
	        	</thead>
	            <tbody>
	                <tr class="cart-subtotal">
						<th width="40%">Sub Total Harga Barang</th>
						<td width="60%" class="text-right">Rp. <span class="sub_total_harga_barang"><?= rp($detail_bayar['sub_total_harga_barang'] - $detail_bayar['jumlah_diskon']); ?></span></td>
						<input type="hidden" name="sub_total_harga_barang" id="sub_total_harga_barang" value="<?= $detail_bayar['sub_total_harga_barang'] - $detail_bayar['jumlah_diskon']; ?>">
						<input type="hidden" name="total_diskon_barang" id="total_diskon_barang" value="<?= $detail_bayar['jumlah_diskon']; ?>">
					</tr>
					<tr class="cart-subtotal">
						<th>Sub Total Pengiriman</th>
						<td class="text-right">Rp. <span class="sub_total_ongkir"><?= rp(0); ?></span></td>
						<input type="hidden" name="sub_total_ongkir" id="sub_total_ongkir" value="">
						<input type="hidden" name="total_diskon_ongkir" id="total_diskon_ongkir" value="0">
					</tr>
					<tr class="order-total">
						<th>Total Pembayaran</th>
						<td class="text-right"><strong class="primary-color" style="font-size: 20px; color:rgb(250, 89, 29);">Rp. <span class="total_pesanan"><?= rp($detail_bayar['sub_total_harga_barang'] - $detail_bayar['jumlah_diskon']); ?></span></strong></td>
						<!-- sub_total_harga_barang + ongkir -->
						<input type="hidden" name="total_pesanan" id="total_pesanan" value="<?= $detail_bayar['sub_total_harga_barang'] - $detail_bayar['jumlah_diskon']; ?>">
					</tr>
	            </tbody>
	        </table>
	    </div>
	    <div class="cart-total-bottom" style="margin-bottom:20px;">
	        <button type="button" class="btn-gradient btn-checkout" id="proses_data" onclick="proses()">Proses</button>
	    </div>
	</div>
</div>