<div id="modal_data" class="modal fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLongTitle"></h5>
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
			</div>
			<form action="" id="add_modal">
				<input type="hidden" name="id">
				<input type="hidden" name="no_invoice">
				<input type="hidden" name="username_umkm">
				<input type="hidden" name="type" value="transaksi_admin">
				<input type="hidden" name="<?=$name;?>" value="<?=$hash;?>" />
				<div class="modal-body">
					<?php $this->load->view('transaksi/timeline'); ?>
					<div class="row">
						<div class='col-md-12 col-sm-12 col-xs-12' style="float: right;">
							<div class="col-md-3" style="float: right;">
                                <a class="btn btn-block btn-default btn-tanya" href="javascript:void(0);" style="margin-bottom:10px;"><i class="fa fa-comments"></i> Tanya Penjual</a>
                            </div>
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12 perintah_pembayaran" style="display: none;">
							<div class="alert alert-warning" role="alert">
							  <h4 class="alert-heading">Perhatian !</h4>
							  <p style="text-align: justify;">Silahkan lakukan pembayaran dengan melakukan transfer langsung ke nomor rekening UMKM. Pesanan Anda tidak akan dikirim sampai Anda telah menyelesaikan dan mengupload bukti pembayaran.</p>

							  <p class="mb-0">Jika anda tidak melakukan pembayaran dalam waktu 24 jam, maka pesanan anda akan di batalkan secara otomatis oleh sistem.</p>

							  <p class="mb-0">
							  	Batas waktu melakukan pembayaran 
							  	<strong style="color: red;" class="batas_waktu_pembayaran"></strong>
                			  </p>
							</div>
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12 estimasi_pengiriman" style="display: none;">
							<div class="alert alert-warning" role="alert">
							  <h4 class="alert-heading">Perkiraan waktu pesanan sampai : <strong style="color: red;" class="estimasi_waktu_pengiriman"></strong></h4>
							  <p style="text-align: justify;">Pesananan bisa sampai lebih cepat atau lebih lambat dari perkiraan.</p>
							</div>
						</div>
						<div class='col-md-6 col-sm-12 col-xs-12'>
		                  	<div class='form-group'>
		                    	<span>Nomor Invoice</span> <br>
		                    	<span class="invoice text-color-1" style="font-weight: 700;"></span>
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

		                <div class='col-md-6 col-sm-12 col-xs-12 detail_pembayaran'>
		                	<label>Detail Pembayaran</label>
							<table class="table">
								<tr>
									<td width="30%">Nama Bank</td>
									<td width="2%"> : </td>
									<td width="68%"><strong class="nama_bank"></strong></td>
								</tr>
								<tr>
									<td>Nama Pemilik</td>
									<td> : </td>
									<td><strong class="an_rekening"></strong></td>
								</tr>
								<tr>
									<td>Nomor Rekening</td>
									<td> : </td>
									<td><strong class="no_rekening"></strong></td>
								</tr>
								<tr>
									<td>Jumlah yang harus dibayar</td>
									<td> : </td>
									<td><strong class="total_pembayaran"></strong></td>
								</tr>
							</table>
		                </div>
					</div>

					<hr>

					<div class="row">
						<h4>Daftar Produk</h4>
						<div class="col-md-12">
							<div class="dataa-produk" style="margin-top: 10px;">
                       		
                        	</div>
						</div>
					</div>

					<hr>

					<div class="row">
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

					<hr>

					<div class="row">
						<div class="col-md-12">
							<h4 style="margin-bottom: 10px;">Pembayaran</h4>
							<table class="table table-striped">
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
						</div>
					</div>
				</div>

				<div class="modal-footer">
					<div class="simpan_data" style="display: contents;"></div>	
					<button type="button"  class="btn" data-dismiss="modal">Tutup</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div id="modal_data_va" class="modal fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLongTitle"></h5>
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
			</div>
			<form action="" id="add_modal1">
				<div class="modal-body">
					<?php $this->load->view('transaksi/timeline'); ?>
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12 perintah_pembayaran">
							<div class="alert alert-warning" role="alert">
							  <h4 class="alert-heading">Perhatian !</h4>
							  <p style="text-align: justify;">Silahkan lakukan pembayaran dengan melakukan transfer langsung ke nomor Virtual Account Bank BJB. Pesanan Anda tidak akan dikirim sampai Anda telah menyelesaikan dan mengupload bukti pembayaran.</p>

							  <p class="mb-0">Jika anda tidak melakukan pembayaran dalam waktu 1 jam, maka pesanan anda akan di batalkan secara otomatis oleh sistem.</p>

							  <p class="mb-0">
							  	Batas waktu melakukan pembayaran 
							  	<strong style="color: red;" class="batas_waktu_pembayaran_va"></strong>
                			  </p>
							</div>
						</div>
						<div class='col-md-6 col-sm-12 col-xs-12'>
		                  	<div class='form-group'>
		                    	<span>Status</span> <br>
		                    	<span style="font-weight: 700;">Menunggu Pembayaran</span>
		                  	</div>

		                  	<div class='form-group'>
		                    	<span>Tanggal Pembelian</span> <br>
		                    	<span class="tgl_pembelian" style="font-weight: 700;"></span>
		                  	</div>
		                </div>

		                <div class='col-md-6 col-sm-12 col-xs-12'>
		                	<label>Detail Pembayaran</label>
							<table class="table">
								<tr>
									<td width="30%">Nama Bank</td>
									<td width="2%"> : </td>
									<td width="68%"><strong>BANK BJB</strong></td>
								</tr>
								<tr>
									<td>Nomor Virtual Account</td>
									<td> : </td>
									<td><strong class="no_va"></strong></td>
								</tr>
								<tr>
									<td>Jumlah yang harus dibayar</td>
									<td> : </td>
									<td><strong class="total_pembayaran"></strong></td>
								</tr>
							</table>
		                </div>
					</div>

					<hr>

					<div class="row">
						<h4>Daftar Produk</h4>
						<div class="col-md-12">
							<div class="dataa-produk" style="margin-top: 10px;">
                       		
                        	</div>
						</div>
					</div>

					<hr>

					<div class="row">
						<div class="col-md-12">
							<h4 style="margin-bottom: 10px;">Pengiriman</h4>
		                  	<div class='form-group'>
		                    	<span class="alamat_pengiriman"></span>
		                  	</div>
						</div>
					</div>

					<hr>

					<!-- <div class="row">
						<div class="col-md-12">
							<h4 style="margin-bottom: 10px;">Pembayaran</h4>
							<table class="table table-striped">
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
						</div>
					</div> -->
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-gradient-1 btn-bayar-sekarang">Bayar Sekarang</button>	
					<button type="button" class="btn" data-dismiss="modal">Tutup</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div id="modal_tambah" class="modal fade" data-backdrop="false">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLongTitle"></h5>
			</div>
			<form action="" id="add_tambah">
				<input type="hidden" name="<?=$name;?>" value="<?=$hash;?>" />
				<input type="hidden" name="id_transaksi">
				<input type="hidden" name="id_umkm">
				<input type="hidden" name="username_umkm">
				<input type="hidden" name="type" value="tambah_ulasan">
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
					<h4 style="margin-bottom: 10px !important;">
						Daftar Produk
					</h4>
					<div id="ulasan-produk" style="display: flex;">
							
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-gradient-1" id="btnSaveUlasan" onclick="simpan_ulasan()">Simpan</button>
					<button type="button" class="btn" data-dismiss="modal">Tutup</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div id="modal_ulasan" class="modal fade" data-backdrop="false">
	<div class="modal-dialog modal-lg">
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
										<span class="star-input">
											<i class="glyphicon glyphicon-star-empty"></i>
										</span>
										<span class="star-input">
											<i class="glyphicon glyphicon-star-empty"></i>
										</span>
										<span class="star-input">
											<i class="glyphicon glyphicon-star-empty"></i>
										</span>
										<span class="star-input">
											<i class="glyphicon glyphicon-star-empty"></i>
										</span>
										<span class="star-input">
											<i class="glyphicon glyphicon-star-empty"></i>
										</span>
									</span>
									<span class="filled-stars data_toko">
										<span class="star-input">
											<i class="glyphicon glyphicon-star"></i>
										</span>
										<span class="star-input">
											<i class="glyphicon glyphicon-star"></i>
										</span>
										<span class="star-input">
											<i class="glyphicon glyphicon-star"></i>
										</span>
										<span class="star-input">
											<i class="glyphicon glyphicon-star"></i>
										</span>
										<span class="star-input">
											<i class="glyphicon glyphicon-star"></i>
										</span>
									</span>
								</div>
							</div>
						</div>
					</div>
					<hr>
					<h4 style="margin-bottom: 10px !important;">
						Daftar Produk
					</h4>
					<div id="ulasan-tampil" style="display: flex;"></div>
				</div>

				<div class="modal-footer">
					<button type="button"  class="btn" data-dismiss="modal">Tutup</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div id="modal_chat" class="modal fade" data-backdrop="false">
	<div class="modal-dialog modal-lg">
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

<div id="modal_upload_bukti_bayar" class="modal fade" data-backdrop="false">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">
					
				</h5>
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
			</div>
			<form action="" id="form_upload_bukti_bayar">
			<div class="modal-body">

				<div class="col-lg-12" style="margin-bottom: 10px;">
					<p style="text-align: justify; margin-bottom: 10px;margin-top: 10px;">Silahkan lakukan pembayaran dengan melakukan transfer langsung ke nomor rekening UMKM. Pesanan Anda tidak akan dikirim sampai Anda telah menyelesaikan dan mengupload bukti pembayaran.</p>

					<label>Detail Pembayaran</label>
					<table class="table">
						<tr>
							<td width="30%">Nama Bank</td>
							<td width="2%"> : </td>
							<td width="68%"><strong class="nama_bank"></strong></td>
						</tr>
						<tr>
							<td>Nama Pemilik</td>
							<td> : </td>
							<td><strong class="an_rekening"></strong></td>
						</tr>
						<tr>
							<td>Nomor Rekening</td>
							<td> : </td>
							<td><strong class="no_rekening"></strong></td>
						</tr>
						<tr>
							<td>Jumlah yang harus dibayar</td>
							<td> : </td>
							<td><strong class="total_pembayaran"></strong></td>
						</tr>
					</table>
				</div>

				<div class="col-lg-12">
					<input type="hidden" name="id_transaksi">
					<input type="hidden" name="no_invoice">
					<input type="hidden" name="username_umkm">
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
				<button type="button" class="btn btn-gradient-1" id="btnSaveBuktiBayar" onclick="simpan_bukti_bayar()">Simpan</button>
				<button type="button" class="btn " data-dismiss="modal">Tutup</button>
			</div>
			</form>
		</div>
	</div>
</div>