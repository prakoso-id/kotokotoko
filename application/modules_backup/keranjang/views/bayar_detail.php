<script type="text/javascript" src="<?php echo base_url('assets/plugins/forms/selects/select2.min.js') ?>"></script>
<div class="order-summary clearfix">
	<div class="section-title">
		<h4 class="title">Barang</h4>
	</div>
	
	<?php
	$i=0; 
	foreach ($detail_bayar['data'] as $u){ ?>
	<input type="hidden" name="id_umkm[<?= $u['id_umkm']; ?>]" id="id_umkm_<?= $u['id_umkm']; ?>" value="<?= $u['id_umkm']; ?>">
	<table class="shopping-cart-table table" width="100%">
		<thead>
			<tr>
				<th colspan="5"><a href="javascript:void('0');"><i class="fa fa-shopping-cart"></i> <?= $u['nama_umkm']; ?></a></th>
			</tr>
			<tr>
				<th width="10%">Produk</th>
				<th width="30%"></th>
				<th width="20%" class="text-center">Harga</th>
				<th width="20%" class="text-center">Jumlah</th>
				<th width="20%" class="text-center">Total</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			foreach ($u['produk'] as $p) { ?>
				<tr>
					<td class="thumb"><img src="<?php echo $p['foto_produk']; ?>" alt=""></td>
					<td class="details">
						<a href="javascript:void('0');">
							<?php echo $p['nama_produk']; ?>
						</a>
						<ul>
							<li>
								<input type="hidden" name="id_produk[<?php echo $i; ?>]" value="<?php echo $p['id_produk']; ?>">
								<input type="hidden" name="quantity[<?php echo $i; ?>]" value="<?php echo $p['quantity']; ?>">
								<input type="hidden" name="harga[<?php echo $i; ?>]" value="<?php echo $p['harga']; ?>">
								<input type="hidden" name="berat[<?php echo $i; ?>]" value="<?php echo $p['berat']; ?>">
								<textarea name="catatan[<?php echo $i; ?>]" class="form-control" placeholder="Tulis Catatan untuk Toko" style="resize: none;"></textarea>
								<input type="hidden" name="<?= $u['id_umkm']; ?>[<?php echo $i; ?>]" value="<?php echo $u['id_umkm']; ?>">
							</li>
						</ul>
					</td>
					<td class="price text-center"><strong>Rp. <?php echo rp($p['harga']); ?></strong></td>
					<td class="qty text-center"><strong><?php echo rp($p['quantity']); ?></strong></td>
					<td class="total text-right"><strong>Rp. <?php echo rp($p['jumlah_harga_barang']); ?></strong></td>
				</tr>
			<?php 
			$i++;
			}
			?>
		</tbody>
		<tfoot>
			<tr>
				<th colspan="2">Biaya Pengiriman</th>
				<th colspan="2"> 
					<input type="hidden" name="id_kel_umkm[<?= $u['id_umkm']; ?>]" id="id_kel_umkm_<?= $u['id_umkm']; ?>" value="<?= $u['id_kel_umkm']; ?>">
					<input type="hidden" name="id_kec_umkm[<?= $u['id_umkm']; ?>]" id="id_kec_umkm_<?= $u['id_umkm']; ?>" value="<?= $u['id_kec_umkm']; ?>">
					<input type="hidden" name="no_kab_umkm[<?= $u['id_umkm']; ?>]" id="no_kab_umkm_<?= $u['id_umkm']; ?>" value="<?= $u['no_kab_umkm']; ?>">
					<input type="hidden" name="no_prop_umkm[<?= $u['id_umkm']; ?>]" id="no_prop_umkm_<?= $u['id_umkm']; ?>" value="<?= $u['no_prop_umkm']; ?>">

					Pilih Kurir :
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

					Pilih Service :
					<select name="kurir_service[<?= $u['id_umkm']; ?>]" id="kurir_service_<?= $u['id_umkm']; ?>" class="form-control select2" onchange="set_ongkir(<?= $u['id_umkm']; ?>)">
						<option value="">--Pilih Service--</option>
					</select>
					<input type="hidden" name="nama_service[<?= $u['id_umkm']; ?>]" id="nama_service_<?= $u['id_umkm']; ?>">
					<span class="help"></span>
				</th>
				<th class="text-right">Rp. <span class="sub_total_ongkir_umkm_<?= $u['id_umkm']; ?>"><?= rp(0); ?></span></th>
			</tr>
			<tr>
				<th class="empty" colspan="2"></th>
				<th colspan="2">Total Pesanan (<?= $u['jumlah_produk']; ?> Produk)</th>
				<th class="sub_total_pesanan text-right">
					<strong class="primary-color"> Rp. <span class="sub_total_pesanan_<?= $u['id_umkm']; ?>"><?php echo rp($u['jumlah_harga_barang']); ?></span></strong>
					<input type="hidden" name="sub_total_berat_barang_umkm[<?= $u['id_umkm']; ?>]" id="sub_total_berat_barang_umkm_<?= $u['id_umkm']; ?>" value="<?= $u['jumlah_berat_barang']; ?>">
					<input type="hidden" name="sub_total_harga_barang_umkm[<?= $u['id_umkm']; ?>]" id="sub_total_harga_barang_umkm_<?= $u['id_umkm']; ?>" value="<?= $u['jumlah_harga_barang']; ?>">
					<input type="hidden" name="sub_total_ongkir_umkm[<?= $u['id_umkm']; ?>]" id="sub_total_ongkir_umkm_<?= $u['id_umkm']; ?>">
					<!-- sub_total_harga_barang_umkm + ongkir_umkm -->
					<input type="hidden" name="sub_total_pesanan[<?= $u['id_umkm']; ?>]" id="sub_total_pesanan_<?= $u['id_umkm']; ?>" value="<?= $detail_bayar['sub_total_harga_barang']; ?>">
				</th>
			</tr>
		</tfoot>
		</table>
	<?php 
	}
	?>

	<table class="shopping-cart-table table">
		<tfoot>
			<tr>
				<th>Sub Total Harga Barang</th>
				<th class="text-right">Rp. <span class="sub_total_harga_barang"><?= rp($detail_bayar['sub_total_harga_barang']); ?></span></th>
				<input type="hidden" name="sub_total_harga_barang" id="sub_total_harga_barang" value="<?= $detail_bayar['sub_total_harga_barang']; ?>">
			</tr>
			<tr>
				<th>Sub Total Pengiriman</th>
				<th class="text-right">Rp. <span class="sub_total_ongkir"><?= rp(0); ?></span></th>
				<input type="hidden" name="sub_total_ongkir" id="sub_total_ongkir" value="">
			</tr>
			<tr>
				<th>Total Pembayaran</th>
				<th class="text-right"><strong class="primary-color" style="font-size: 30px;">Rp. <span class="total_pesanan"><?= rp($detail_bayar['sub_total_harga_barang']); ?></span></strong></th>
				<!-- sub_total_harga_barang + ongkir -->
				<input type="hidden" name="total_pesanan" id="total_pesanan" value="<?= $detail_bayar['sub_total_harga_barang']; ?>">
			</tr>
		</tfoot>
	</table>
	<div class="pull-right">
		<button type="button" class="primary-btn" id="proses_data" onclick="proses()">Proses</button>
	</div>
</div>