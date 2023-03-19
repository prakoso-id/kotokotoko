<div id="modal_data" class="modal fade" data-backdrop="false">
	<div class="modal-dialog modal-full">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle"></h5>
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
			</div>
			<form action="" id="add_data">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<?php require_once APPPATH.'modules/transaksi/views/timeline.php'; ?>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="row">
								<div class="position-relative form-group">
									<label class="col-sm-3 col-form-label" style="font-weight:700">Status</label>
									<label class="col-sm-9 col-form-label nama_status" style="font-weight:500"></label>
								</div>
								<div class="position-relative form-group">
									<label class="col-sm-3 col-form-label" style="font-weight:700">Tanggal Pembelian</label>
									<label class="col-sm-9 col-form-label tgl_pembelian" style="font-weight:500"></label>
								</div>
								<div class="position-relative form-group">
									<label class="col-sm-3 col-form-label" style="font-weight:700">No Invoice</label>
									<label class="col-sm-9 col-form-label invoice" style="font-weight:500"></label>
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
						<div class="col-md-6">
							<div class="pembayaran">
								<div class="section-title">
									<h5 class="title">Pembayaran</h5>
								</div>
								<div class="position-relative form-group row">
									<label class="col-md-3 col-form-label" style="font-weight:700">Tanggal Pembayaran</label>
									<label class="col-md-9 col-form-label tgl_pembayaran" style="font-weight:500"></label>
								</div>
								<div class="position-relative form-group row">
									<label class="col-md-3 col-form-label" style="font-weight:700">Bukti Pembayaran</label>
									<div class="col-md-9">
										<div class="bukti_pembayaran" style="margin-bottom: 10px;">
                           
                    					</div>
									</div>
								</div>
							</div>
							<div class="f_status_transaksi" style="display: none;">
								<div class="section-title">
									<h5 class="title">Status Transaksi</h5>
								</div>
								<div class="position-relative row form-group f_status_transaksi">
									<label class="col-sm-3 col-form-label" style="font-weight:700">Status</label>
									<div class="col-sm-9">
										<input type="hidden" name="id">
										<input type="hidden" name="type" value="ubah_transaksi">
										<input type="hidden" name="<?=$name;?>" value="<?=$hash;?>" />
										<select class="form-control select2" name="status_transaksi">
											
										</select>
										<input type="hidden" name="id_status_transksi">
										<span class="help"></span>
									</div>
								</div>
								<div class="position-relative row form-group f_no_resi" style="display: none;">
									<label class="col-sm-3 col-form-label" style="font-weight:700">Nomor Resi</label>
									<div class="col-sm-9">
										<input type="text" name="no_resi" class="form-control">
										<span class="help"></span>
									</div>
								</div>
								<div class="position-relative row form-group f_pesan_batal" style="display: none;">
									<label class="col-sm-3 col-form-label" style="font-weight:700">Pesan</label>
									<div class="col-sm-9">
										<textarea name="pesan_batal" id="pesan_batal" cols="30" rows="10" class="form-control" placeholder="Masukkan pesan pembatalan"></textarea>
										<span class="help"></span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-success" id="btnSave" onclick="simpan_data()" style="display: none;"> Simpan</button>
					<button type="button"  class="btn btn-danger" data-dismiss="modal">Tutup</button>
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