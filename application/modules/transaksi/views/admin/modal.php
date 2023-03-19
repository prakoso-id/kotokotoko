<div id="modal_data" class="modal fade">
	<div class="modal-dialog modal-xl">
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
							<div class='col-md-12 col-sm-12 col-xs-12'>
								<div class='form-group'>
			                    	<span>Nomor Invoice</span> <br>
			                    	<span class="inv text-color-1" style="font-weight: 700;"></span>
			                  	</div>

			                  	<div class='form-group'>
			                    	<span>Status</span> <br>
			                    	<span class="nama_status" style="font-weight: 700;"></span>
			                  	</div>

			                  	<div class='form-group'>
			                    	<span>Nama Toko</span> <br>
			                    	<span class="nama_toko" style="font-weight: 700;"></span>
			                  	</div>

			                  	<div class='form-group'>
			                    	<span>Tanggal Pembelian</span> <br>
			                    	<span class="tgl_pembelian" style="font-weight: 700;"></span>
			                  	</div>
			                </div>

			                <hr>

							<div class="col-md-12">
								<h4>Daftar Produk</h4>
								<div class="dataa-produk" style="margin-top: 10px;">
	                       		
	                        	</div>
							</div>

							<hr>
	
							<div class="col-md-12">
								<h4 style="margin-bottom: 10px;">Pengiriman</h4>
								<div class='form-group data_kurir'>
			                    	<span>Layanan Pengiriman</span> <br>
			                    	<span class="kurir" style="font-weight: 700;"></span>
			                  	</div>
			                  	<div class='form-group data_resi'>
			                    	<span>No. Resi</span> <br>
			                    	<span class="no_resi" style="font-weight: 700;"></span>
			                    	<input type="text" style="display: none;" class="form-control" id="no_resi" width="30px" readonly>
			                  	</div>
			                  	<div class='form-group'>
			                    	<span class="alamat_pengiriman"></span>
			                  	</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="col-md-12">
								<h4 style="margin-bottom: 10px;">Pembayaran</h4>
								<table class="table table-striped" width="100%">
									<tr>
										<td width="50%">Total Harga <span class="total_barang"></span></td>
										<td width="50%" class="total_harga" align="right"></td>
									</tr>
									<tr>
										<td>Total Ongkos Kirim <span class="total_berat"></span></td>
										<td class="total_ongkir" align="right"></td>
									</tr>
									<tr>
										<td>Total Bayar</td>
										<td class="total_bayar text-color-2" style="font-size:16px; font-weight: 700;" align="right"></td>
									</tr>
								</table>

								<table class="table table-striped" width="100%">
									<tr>
										<td width="30%">Tanggal Pembayaran</td>
										<td class="tgl_pembayaran" width="70%" align="right"></td>
									</tr>
									<tr>
										<td colspan="2">Bukti Pembayaran</td>
									</tr>
									<tr>
										<td colspan="2">
											<div class="bukti_pembayaran" style="margin-bottom: 10px;"></div>
										</td>
									</tr>
								</table>
							</div>
						</div>
					</div>
				</div>

				<div class="modal-footer">
					<button type="button"  class="btn btn-danger btn-icon icon-left" data-dismiss="modal"><i class="fas fa-times"></i> Tutup</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div id="modal_ulasan" class="modal fade">
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
							<span> Penilaian Untuk Toko</span>
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
					<button type="button"  class="btn btn-danger btn-icon icon-left" data-dismiss="modal"><i class="fas fa-times"></i> Tutup</button>
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
				<center><span style="font-size: 11px;color: #c1c1c1;" class="last_login"></span></center>
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="data_pesan">
					
			</div>
		</div>
	</div>
</div>