<div id="modal_data" class="modal fade" data-backdrop="false">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLongTitle"></h5>
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
			</div>
			<form action="" id="add_modal">
				<div class="modal-body">
					<?php require_once APPPATH.'modules/transaksi/views/timeline.php'; ?>
					<div class="row">
						<div class="position-relative form-group">
							<input type="hidden" name="id">
							<input type="hidden" name="type" value="transaksi_admin">
							<input type="hidden" name="<?=$name;?>" value="<?=$hash;?>" />
							<label class="col-md-3 col-form-label" style="font-weight:700">Status</label>
							<label class="col-md-9 col-form-label nama_status" style="font-weight:500"></label>
						</div>
						<div class="position-relative form-group">
							<label class="col-md-3 col-form-label" style="font-weight:700">Tanggal Pembelian</label>
							<label class="col-md-9 col-form-label tgl_pembelian" style="font-weight:500"></label>
						</div>
						<div class="position-relative form-group">
							<label class="col-md-3 col-form-label" style="font-weight:700">No Invoice</label>
							<label class="col-md-9 col-form-label invoice" style="font-weight:500"></label>
						</div>
						<div class="position-relative form-group">
							<label class="col-md-3 col-form-label" style="font-weight:700">Alamat Pengiriman</label>
							<label class="col-md-9 col-form-label alamat_pengiriman" style="font-weight:500"></label>
						</div>
						<div class="position-relative form-group data_kurir">
							<label class="col-md-3 col-form-label" style="font-weight:700">Layanan Pengiriman</label>
							<label class="col-md-9 col-form-label kurir" style="font-weight:500"></label>
						</div>
						<div class="position-relative form-group data_ongkir">
							<label class="col-md-3 col-form-label" style="font-weight:700">Biaya Pengiriman</label>
							<label class="col-md-9 col-form-label ongkir" style="font-weight:500"></label>
						</div>
						<div class="position-relative form-group data_resi">
							<label class="col-md-3 col-form-label" style="font-weight:700">Nomor Resi</label>
							<label class="col-md-9 col-form-label no_resi" style="font-weight:500"></label>
							<input type="text" style="display: none;" class="form-control" id="no_resi" width="30px" readonly>
						</div>
					</div>
					<hr>
					<div class="section-title">
						<h5 class="title">Rincian Pesanan</h5>
					</div>
					<div class="content" style="margin-bottom: 30px;">
						<i class="fa fa-shopping-cart"></i> <b><span class="nama_toko"></span></b>
                        <div class="dataa-produk">
                       		
                        </div>
                    </div>
				</div>

				<div class="modal-footer">
					<div class="simpan_data" style="display: contents;">
						
					</div>
					
					<button type="button"  class="btn btn-danger" data-dismiss="modal">Tutup</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div id="modal_tambah" class="modal fade" data-backdrop="false">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLongTitle"></h5>
			</div>
			<form action="" id="add_tambah">
				<input type="hidden" name="id_transaksi">
				<input type="hidden" name="type" value="tambah_ulasan">
				<input type="hidden" name="<?=$name;?>" value="<?=$hash;?>" />
				<div class="modal-body">
					<div class="position-relative row form-group">
						<div class="col-lg-12" style="text-align: center;">
							<div class='icon-foto' style="display: inline-block !important;margin-bottom: 10px;">
								<span class="logo_toko"></span>
							</div>
							<br>
							<span style="font-weight: 800" class="nama_toko"></span>
							<br>
							<span style="font-weight: 800" class="alamat_toko"></span>
							<br><br><br>
							<span> Penilaian Untuk Toko Kami</span>
							<br>
							<input type="hidden" name="data_ratting">
							<span class="help"></span>
						</div>
					</div>
					<div class="position-relative row form-group">
						<div class="col-lg-12 data_ratting">
							<input class="rating-input" type="text" title="" name="ratting">
						</div>
					</div>
					<hr>
					<h4>
						Daftar Produk
					</h4>
					<div id="ulasan-produk" style="display: flex;">
							
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
					<button type="button" class="btn btn-success" id="btnSaveUlasan" onclick="simpan_ulasan()">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div id="modal_ulasan" class="modal fade" data-backdrop="false">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLongTitle"></h5>
			</div>
			<form action="" id="add_ulasan">
				<div class="modal-body">
					<div class="position-relative row form-group">
						<div class="col-lg-12" style="text-align: center;">
							<div class='icon-foto' style="display: inline-block !important;margin-bottom: 10px;">
								<span class="logo_toko"></span>
							</div>
							<br>
							<span style="font-weight: 800" class="nama_toko"></span>
							<br>
							<span style="font-weight: 800" class="alamat_toko"></span>
							<br><br><br>
							<span> Penilaian Untuk Toko Kami</span>
						</div>
					</div>
					<div class="position-relative row form-group">
						<div class="col-lg-12 data_ratting">
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
									<span class="filled-stars data_toko">
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
					<hr>
					<h4>
						Daftar Produk
					</h4>
					<div id="ulasan-tampil" style="display: flex;"></div>
				</div>

				<div class="modal-footer">
					<button type="button"  class="btn btn-danger" data-dismiss="modal">Tutup</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div id="modal_chat" class="modal fade" data-backdrop="false">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">
					
				</h5>
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="data_pesan">
					
			</div>
		</div>
	</div>
</div>

<div id="modal_upload_bukti_bayar" class="modal fade" data-backdrop="false">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">
					
				</h5>
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
			</div>
			<form action="" id="form_upload_bukti_bayar">
			<div class="modal-body">

				<div class="col-lg-12" style="margin-bottom: 10px;">
					<p style="text-align: justify;">Silahkan lakukan pembayaran dengan melakukan transfer langsung ke nomor rekening UMKM. Pesanan Anda tidak akan dikirim sampai Anda telah menyelesaikan dan mengupload bukti pembayaran.</p>
					<label>Detail Pembayaran</label>
					<ul>
                      <li>Nama Bank: <strong class="nama_bank"></strong></li>
                      <li>Nama Pemilik: <strong class="an_rekening"></strong></li>
                      <li>Nomor Rekening: <strong class="no_rekening"></strong></li>
                      <li>Jumlah yang harus dibayar: <strong class="total_pembayaran"></strong></li>
                    </ul>	
				</div>

				<div class="col-lg-12">
					<input type="hidden" name="id_transaksi">
					<input type="hidden" name="type" value="bukti_bayar">
					<input type="hidden" name="<?=$name;?>" value="<?=$hash;?>">
					<div class="form-group">
					    <label for="file_bukti_bayar">File Bukti Pembayaran</label>
					    <input type="file" class="form-control-file" name="file_bukti_bayar" id="file_bukti_bayar" onchange="uploadFile()" accept=".jpg, .jpeg, .png">
					    <input type="hidden" name="nama_file_bukti_bayar" id="nama_file_bukti_bayar">
					    <span class="help"></span>
					    <span>Tipe File : JPG,JPEG,PNG | Ukuran File Maksimal : 2 MB</span>
					</div>
				</div>
				
				<div class="col-lg-12 preview-upload-file-bukti-bayar">
					
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
				<button type="button" class="btn btn-success" id="btnSaveBuktiBayar" onclick="simpan_bukti_bayar()">Simpan</button>
			</div>
			</form>
		</div>
	</div>
</div>