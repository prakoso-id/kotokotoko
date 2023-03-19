<style type="text/css">
	.badge {
		float: right;
	}
</style>
<section class="section">
	<div class="section-header">
		<h1><?php echo $title_beranda; ?></h1>
		<div class="section-header-breadcrumb">
			<div class="breadcrumb-item active"><?php echo $title_beranda; ?></div>
		</div>
	</div>

	<?=$this->session->flashdata('message')?>

	<div class="section-body">
		<div class="row">
			<div class="col-12 col-sm-12 col-lg-12">
				<div class="card card-danger">
					<div class="card-header">
						<h4>DATA UMKM PENDATAAN</h4>
						<div class="card-header-action">
							<a class="btn btn-icon btn-secondary" href="javascript:void(0);" onclick="refresh_umkm_pendataan()" title="Refresh"><i class="fas fa-sync"></i></a>
							<a data-collapse="#card-umkm-pendataan" class="btn btn-icon btn-danger" href="#"><i class="fas fa-minus"></i></a>
						</div>
					</div>
					<div class="collapse show" id="card-umkm-pendataan">
						<div class="card-body">
							<div class="row">
								<div class="col-lg-4 col-md-6 col-sm-6 col-12">
									<div class="card card-statistic-1" onclick="list_umkm_pendataan()" style="cursor: pointer;">
										<div class="card-icon bg-primary">
											<i class="far fa-list-alt"></i>
										</div>
										<div class="card-wrap">
											<div class="card-header">
												<h4>Total UMKM</h4>
											</div>
											<div class="card-body jum_umkm_pendataan_all">0</div>
										</div>
									</div>
								</div>

								<div class="col-lg-2 col-md-6 col-sm-6 col-12">
									<div class="card card-statistic-1" onclick="list_bpum(1)" style="cursor: pointer;">
										<div class="card-icon bg-success">
											<i class="far fa-file-alt"></i>
										</div>
										<div class="card-wrap">
											<div class="card-header">
												<h4>BPUM 1</h4>
											</div>
											<div class="card-body jum_bpum1">0</div>
										</div>
									</div>
								</div>

								<div class="col-lg-2 col-md-6 col-sm-6 col-12">
									<div class="card card-statistic-1" onclick="list_bpum(2)" style="cursor: pointer;">
										<div class="card-icon bg-warning">
											<i class="far fa-file-alt"></i>
										</div>
										<div class="card-wrap">
											<div class="card-header">
												<h4>BPUM 2</h4>
											</div>
											<div class="card-body jum_bpum2">0</div>
										</div>
									</div>
								</div>

								<div class="col-lg-2 col-md-6 col-sm-6 col-12">
									<div class="card card-statistic-1" onclick="list_bsmum()" style="cursor: pointer;">
										<div class="card-icon bg-danger">
											<i class="far fa-file-alt"></i>
										</div>
										<div class="card-wrap">
											<div class="card-header">
												<h4>BSMUM</h4>
											</div>
											<div class="card-body jum_bsmum">0</div>
										</div>
									</div>
								</div>

								<div class="col-lg-2 col-md-6 col-sm-6 col-12">
									<div class="card card-statistic-1" onclick="list_tangerangbisa()" style="cursor: pointer;">
										<div class="card-icon bg-info">
											<i class="far fa-file-alt"></i>
										</div>
										<div class="card-wrap">
											<div class="card-header">
												<h4>Tangerang Bisa</h4>
											</div>
											<div class="card-body jum_tangerang_bisa">0</div>
										</div>
									</div>
								</div>
							</div>

							<hr>

							<div class="row">
								<div class="col-md-12" style="margin-bottom: 10px;">
									<strong>UMKM Berdasarkan Jenis</strong>
								</div>

								<div class="col-md-12">
									<div class="table-responsive">
										<table class="table table-bordered table-striped table-hover" width="100%" id="t_umkm_by_jenis">
											<thead>
												<tr>
													<th>Kecamatan</th>
													<th>PKL</th>
													<th>UKM</th>
													<th>Lainnya</th>
													<th>Jumlah</th>
												</tr>
											</thead>
											<tbody>
												
											</tbody>
										</table>
									</div>
								</div>
							</div>

							<hr>

							<div class="row">
								<div class="col-md-12" style="margin-bottom: 10px;">
									<strong>UMKM Berdasarkan Umur</strong>
								</div>

								<div class="col-md-12">
									<div class="table-responsive">
										<table class="table table-bordered table-striped table-hover" width="100%" id="t_umkm_by_umur">
											<thead>
												<tr>
													<th>Kecamatan</th>
													<th style="min-width:250px;">1 - 15</th>
													<th style="min-width:250px;">16 - 30</th>
													<th style="min-width:250px;">31 - 45</th>
													<th style="min-width:250px;">46 - 60</th>
													<th style="min-width:250px;">> 60</th>
													<th style="min-width:250px;">Umur Tidak Diketahui</th>
													<th style="min-width:250px;">Jumlah</th>
												</tr>
											</thead>
											<tbody>
												
											</tbody>
										</table>
									</div>
								</div>
							</div>

							<hr>

							<div class="row">
								<div class="col-md-12" style="margin-bottom: 10px;">
									<strong>UMKM Berdasarkan Jenis Usaha</strong>
								</div>

								<div class="col-md-12">
									<div class="table-responsive" id="t_umkm_by_jenis_usaha">
										
									</div>
								</div>
							</div>
						</div>
					</div>  
				</div>

				<div class="card card-danger">
					<div class="card-header">
						<h4>DATA UMKM</h4>
						<div class="card-header-action">
							<a class="btn btn-icon btn-secondary" href="javascript:void(0);" onclick="refresh_umkm();" title="Refresh"><i class="fas fa-sync"></i></a>
							<a data-collapse="#card-umkm" class="btn btn-icon btn-danger" href="#"><i class="fas fa-minus"></i></a>
						</div>
					</div>
					<div class="collapse show" id="card-umkm">
						<div class="card-body">

							<div class="form-row">
								<div class="form-group col-md-4">
									<label for="filter_sumber">Sumber Data</label>
									<select class="form-control select2" name="filter_sumber" id="filter_sumber">
										<option value="">--Semua--</option>
										<option value="sidata">SIDATA</option>
										<option value="umkm">UMKM</option>
									</select>
								</div>
								<div class="form-group col-md-4">
									<label for="filter_iumk">IUMK</label>
									<select class="form-control select2" name="filter_iumk" id="filter_iumk">
										<option value="">--Semua--</option>
										<option value="punya">Punya</option>
										<option value="belum_punya">Belum Punya</option>
									</select>
								</div>
								<div class="form-group col-md-4">
									<label for="filter_status_verif">Status Verif</label>
									<select class="form-control select2" name="filter_status_verif" id="filter_status_verif">
										<option value="">--Semua--</option>
										<?php foreach ($m_status as $sts) {
											echo '<option value="'.$sts->id_status.'">'.$sts->nama.'</option>';
										} ?>
									</select>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-4 col-md-6 col-sm-6 col-12">
									<div class="card card-statistic-1">
										<div class="card-icon bg-primary">
											<i class="far fa-list-alt"></i>
										</div>
										<div class="card-wrap">
											<div class="card-header">
												<h4>Total UMKM</h4>
											</div>
											<div class="card-body jum_umkm_all">

											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-4 col-md-6 col-sm-6 col-12">
									<div class="card card-statistic-1">
										<div class="card-icon bg-success">
											<i class="far fa-check-square"></i>
										</div>
										<div class="card-wrap">
											<div class="card-header">
												<h4>Sudah Terverifikasi</h4>
											</div>
											<div class="card-body jum_verif_diterima">

											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-4 col-md-6 col-sm-6 col-12">
									<div class="card card-statistic-1">
										<div class="card-icon bg-warning">
											<i class="fas fa-hourglass-half"></i>
										</div>
										<div class="card-wrap">
											<div class="card-header">
												<h4>Belum Terverifikasi</h4>
											</div>
											<div class="card-body jum_verif_menunggu">

											</div>
										</div>
									</div>
								</div>                  
							</div>

							<div class="table-responsive">
								<table class="table table-hover tabel" id="tabel">
									<thead>
										<tr>
											<th>No</th>
											<th>Nama Usaha</th>
											<th>Nama Pemilik</th>
											<th>Jenis Usaha</th>
											<th>Status</th>
											<th>Sumber</th>
											<th>IUMK</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>

									</tbody>
								</table>
							</div>

						</div>
					</div>  
				</div>

				<div class="card card-danger">
					<div class="card-header">
						<h4>DATA PRODUK</h4>
						<div class="card-header-action">
							<a class="btn btn-icon btn-secondary" href="javascript:void(0);" onclick="refresh_produk();" title="Refresh"><i class="fas fa-sync"></i></a>
							<a data-collapse="#card-produk" class="btn btn-icon btn-danger" href="#"><i class="fas fa-minus"></i></a>
						</div>
					</div>
					<div class="collapse show" id="card-produk">
						<div class="card-body">

							<div class="row">
								<div class="col-lg-4 col-md-6 col-sm-6 col-12">
									<div class="card card-statistic-1" onclick="list_produk(null,'Semua Produk',null,null)" style="cursor: pointer;">
										<div class="card-icon bg-primary">
											<i class="far fa-list-alt"></i>
										</div>
										<div class="card-wrap">
											<div class="card-header">
												<h4>Total Produk</h4>
											</div>
											<div class="card-body jum_produk_all">

											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-4 col-md-6 col-sm-6 col-12">
									<div class="card card-statistic-1" onclick="list_produk(null,'Aktif',1,null)" style="cursor: pointer;">
										<div class="card-icon bg-success">
											<i class="far fa-check-square"></i>
										</div>
										<div class="card-wrap">
											<div class="card-header">
												<h4>Aktif</h4>
											</div>
											<div class="card-body jum_produk_aktif">

											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-4 col-md-6 col-sm-6 col-12">
									<div class="card card-statistic-1" onclick="list_produk(null,'Tidak Aktif',2,null)" style="cursor: pointer;">
										<div class="card-icon bg-danger">
											<i class="far fa-window-close"></i>
										</div>
										<div class="card-wrap">
											<div class="card-header">
												<h4>Tidak Aktif</h4>
											</div>
											<div class="card-body jum_produk_nonaktif">

											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-4 col-md-6 col-sm-6 col-12">
									<div class="card card-statistic-1" onclick="list_produk(null,'Stok Tersedia',null,'tersedia')" style="cursor: pointer;">
										<div class="card-icon bg-success">
											<i class="fas fa-boxes"></i>
										</div>
										<div class="card-wrap">
											<div class="card-header">
												<h4>Stok Tersedia</h4>
											</div>
											<div class="card-body jum_produk_tersedia">

											</div>
										</div>
									</div>
								</div> 

								<div class="col-lg-4 col-md-6 col-sm-6 col-12">
									<div class="card card-statistic-1" onclick="list_produk(null,'Stok Habis',null,'habis')" style="cursor: pointer;">
										<div class="card-icon bg-danger">
											<i class="fas fa-box-open"></i>
										</div>
										<div class="card-wrap">
											<div class="card-header">
												<h4>Stok Habis</h4>
											</div>
											<div class="card-body jum_produk_habis">

											</div>
										</div>
									</div>
								</div>                 
							</div>

							<div class="row">
								<div class="col-md-12">
									<div class="card">
										<div class="card-header">
											<h4>Produk Terbaik</h4>
										</div>
										<div class="card-body">
											<?php 
											if ($produk_terbaik) { 
												echo '<div class="owl-carousel owl-theme" id="products-carousel">';
												foreach ($produk_terbaik as $value) {
													$jumlah = 5 - $value->ratting;
													$icon_star = ''; 
													for($i=0; $i<$value->ratting; $i++){
														$icon_star .= '<i class="fa fa-star"></i>';
													}

													for($i=0; $i<$jumlah; $i++){
														$icon_star .= '<i class="fa fa-star" style="color:#dfdfdf;"></i>';
													}
													echo '<div>
													<div class="product-item pb-3">
													<div class="product-image">
													<img alt="image" src="'.base_url('assets/produk/'.$value->id_umkm.'/'.$value->foto).'" class="img-fluid">
													</div>
													<div class="product-details">
													<div class="product-name">'.readMore($value->nama_produk,20).'</div>
													<div class="product-review">
													'.$icon_star.'
													</div>
													<div class="text-muted text-small">'.$value->jum_terjual.' Terjual</div>
													<div class="product-cta">
													<a href="javascript:void(0);" onclick="lihat_produk('.$value->id_produk.',`detail`)" class="btn btn-danger">Detail</a>
													</div>
													</div>  
													</div>
													</div>';
												}
												echo '</div>';
											}else{
												echo '<span>Belum ada produk yang terjual...</span>';
											} 
											?>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-12" style="margin-bottom: 10px;">
									<strong>Produk Berdasarkan Kategori</strong>
								</div>
								<div class="col-md-12">
									<div class="row data-produk-kategori">
									</div>
								</div>
							</div>

						</div>
					</div>   
				</div>

				<div class="card card-danger">
					<div class="card-header">
						<h4>DATA TRANSAKSI</h4>
						<div class="card-header-action">
							<a class="btn btn-icon btn-secondary" href="javascript:void(0);" onclick="get_rekap_transaksi();" title="Refresh"><i class="fas fa-sync"></i></a>
							<a data-collapse="#card-transaksi" class="btn btn-icon btn-danger" href="#"><i class="fas fa-minus"></i></a>
						</div>
					</div>
					<div class="collapse show" id="card-transaksi">
						<div class="card-body">
							<div class="row" style="margin-bottom: 10px; margin-top: 10px;">
								<div class="col-md-6">
									<div class="list-group">
										<a href="javascript:void(0);" onclick="list_transaksi()" class="list-group-item list-group-item-action">
											<i class="fa fa-th-list"></i> 
											Total Transaksi
											<span class="badge badge-danger badge-pill jum_transaksi">0</span>
										</a>
										<a href="javascript:void(0);" onclick="list_transaksi(0,'Menunggu Pembayaran')" class="list-group-item list-group-item-action">
											<i class="fa fa-credit-card"></i> 
											Menunggu Pembayaran
											<span class="badge badge-danger badge-pill jum_menunggu_pembayaran">0</span>
										</a>
										<a href="javascript:void(0);" onclick="list_transaksi(1,'Menunggu Konfirmasi')" class="list-group-item list-group-item-action">
											<i class="fa fa-hourglass-start"></i> 
											Menunggu Konfirmasi
											<span class="badge badge-danger badge-pill jum_menunggu_konfirmasi">0</span>
										</a>
										<a href="javascript:void(0);" onclick="list_transaksi(2,'Pesanan Diproses')" class="list-group-item list-group-item-action">
											<i class="fa fa-check-square"></i> 
											Pesanan Diproses
											<span class="badge badge-danger badge-pill jum_diproses">0</span>
										</a>
									</div>
								</div>
								<div class="col-md-6">
									<div class="list-group">
										<a href="javascript:void(0);" onclick="list_transaksi(2,'Sedang Dikirim')" class="list-group-item list-group-item-action">
											<i class="fa fa-truck"></i> 
											Sedang Dikirim
											<span class="badge badge-danger badge-pill jum_dikirim">0</span>
										</a>
										<a href="javascript:void(0);" onclick="list_transaksi(4,'Sampai Tujuan & Selesai')" class="list-group-item list-group-item-action">
											<i class="fa fa-check"></i> 
											Sampai Tujuan & Selesai
											<span class="badge badge-danger badge-pill jum_sampai">0</span>
										</a>
										<a href="javascript:void(0);" onclick="list_transaksi(5,'Dibatalkan')" class="list-group-item list-group-item-action">
											<i class="fa fa-window-close"></i> 
											Dibatalkan
											<span class="badge badge-danger badge-pill jum_batal">0</span>
										</a>
									</div>
								</div>
							</div>
						</div> 
					</div>    
				</div>

			</div>
		</div>
	</div>
</section>


<!-- Modal -->
<div id="modal_produk" class="modal fade" data-backdrop="false">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Daftar Produk <span class="ket_title_produk"></span></h5>
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table id="table_produk" class="table table-bordered table-striped table-hover">
						<thead>
							<tr>
								<th width="2%">No</th>
								<th>Nama Produk</th>
								<th>Nama UMKM</th>
								<th>Stok</th>
								<th>Harga</th>
								<th>Ketegori</th>
								<th>Status</th>
								<th width="2%">Aksi</th>
							</tr>
						</thead>
						<tbody>

						</tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button"  class="btn btn-icon icon-left btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Tutup</button>
			</div>
		</div>
	</div>
</div>

<div id="modal_transaksi" class="modal fade" data-backdrop="false">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Daftar Transaksi <span class="ket_title_transaksi"></span></h5>
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table id="table_transaksi" class="table table-bordered table-striped table-hover">
						<thead>
							<tr>
								<th width="2%">No</th>
								<th>Tanggal Pemesanan</th>
								<th>Nomor Invoice</th>
								<th>Pembeli</th>
								<th>Penjual</th>
								<th>Total Belanja</th>
								<th>Status</th>
								<th width="2%">Aksi</th>
							</tr>
						</thead>
						<tbody>

						</tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button"  class="btn btn-icon icon-left btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Tutup</button>
			</div>
		</div>
	</div>
</div>

<div id="modal_umkm_pendataan" class="modal fade" data-backdrop="false">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Daftar UMKM Pendataan</h5>
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table id="table_umkm_pendataan" class="table table-bordered table-striped table-hover">
						<thead>
							<tr>
								<th width="2%">No</th>
								<th>NIK</th>
								<th>Nama</th>
								<th>Bidang Usaha</th>
								<th>Alamat</th>
								<th>RT</th>
								<th>RW</th>
								<th>Kelurahan</th>
								<th>Kecamatan</th>
								<th>Ket</th>
								<th>Lokasi Usaha</th>
							</tr>
						</thead>
						<tbody>

						</tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button"  class="btn btn-icon icon-left btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Tutup</button>
			</div>
		</div>
	</div>
</div>

<div id="modal_bpum" class="modal fade" data-backdrop="false">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">BPUM <span class="periode_bpum"></span></h5>
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table id="table_bpum" class="table table-bordered table-striped table-hover">
						<thead>
                            <tr>
								<th></th>
								<th><input type="number" id="ifilter_nik" class="form-control" style="width:100%"></th>
								<th><input type="text" id="ifilter_nama_pemilik" class="form-control" style="width:100%"></th>
								<th><input type="text" id="ifilter_bidang_usaha" class="form-control" style="width:100%"></th>
								<th><input type="text" id="ifilter_alamat" class="form-control" style="width:100%"></th>
                                <th></th>
                                <th></th>
								<th><input type="text" id="ifilter_rw" class="form-control" style="width:100%"></th>
								<th><input type="text" id="ifilter_rt" class="form-control" style="width:100%"></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
								<th></th>
				            </tr>
                            <tr>
                                <th>No</th>
                                <th>NIK</th>
                                <th>Pemilik</th>
                                <th>Bidang Usaha</th>
                                <th>Alamat</th>
                                <th>Kecamatan</th>
                                <th>Kelurahan</th>
                                <th>RW</th>
                                <th>RT</th>
                                <th>Foto</th>
                                <th>Foto</th>
                                <th>Foto</th>
                                <th>Foto</th>
                                <th>Foto</th>
                                <th>Tanggal Pengajuan</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button"  class="btn btn-icon icon-left btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Tutup</button>
			</div>
		</div>
	</div>
</div>

<div id="modal_bsmum" class="modal fade" data-backdrop="false">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">BSMUM</h5>
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table id="table_bsmum" class="table table-bordered table-striped table-hover">
						<thead>
                            <tr>
								<th></th>
								<th><input type="number" id="ifilter_nik" class="form-control" style="width:100%"></th>
								<th><input type="number" id="ifilter_no_kk" class="form-control" style="width:100%"></th>
								<th><input type="text" id="ifilter_nama" class="form-control" style="width:100%"></th>
								<th><input type="text" id="ifilter_email" class="form-control" style="width:100%"></th>
								<th><input type="number" id="ifilter_no_tlp" class="form-control" style="width:100%"></th>
								<th><input type="text" id="ifilter_bidang_usaha" class="form-control" style="width:100%"></th>
                                <th><input type="text" id="ifilter_alamat_usaha" class="form-control" style="width:100%"></th>
                                <th></th>
								<th></th>
								<th><input type="number" id="ifilter_rw_usaha" class="form-control" style="width:100%"></th>
                                <th><input type="number" id="ifilter_rt_usaha" class="form-control" style="width:100%"></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
				            </tr>
                            <tr>
                                <th>No</th>
                                <th>NIK</th>
                                <th>No KK</th>
                                <th>Nama Pemilik</th>
                                <th>Email</th>
                                <th>No Telp</th>
                                <th>Bidang Usaha</th>
                                <th>Alamat Usaha</th>
                                <th>Kecamatan Usaha</th>
                                <th>Kelurahan Usaha</th>
                                <th>RW Usaha</th>
                                <th>RT Usaha</th>
                                <th>Foto KTP</th>
                                <th>Foto KK</th>
                                <th>Foto Surat Pernyataan</th>
                                <th>Status</th>
                                <th>Tanggal Permohonan</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button"  class="btn btn-icon icon-left btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Tutup</button>
			</div>
		</div>
	</div>
</div>

<div id="modal_tangerangbisa" class="modal fade" data-backdrop="false">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Tangerang Bisa</h5>
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table id="table_tangerangbisa" class="table table-bordered table-striped table-hover">
						<thead>
							<tr>
								<th width="2%">No</th>
								<th>NIK</th>
								<th>Nama</th>
								<th>Bidang Usaha</th>
								<th>Alamat</th>
								<th>RT</th>
								<th>RW</th>
								<th>Kelurahan</th>
								<th>Kecamatan</th>
								<th>Lokasi Usaha</th>
							</tr>
						</thead>
						<tbody>

						</tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button"  class="btn btn-icon icon-left btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Tutup</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	var table;
	var dataTable;
	$(document).ready(function(){
		$('.select2').select2();

		$("#products-carousel").owlCarousel({
			items: 6,
			margin: 10,
			autoplay: true,
			autoplayTimeout: 5000,
			loop: false,
			responsive: {
				0: {
					items: 2
				},
				768: {
					items: 4
				},
				1200: {
					items: 6
				}
			}
		});

		get_count_umkm_pendataan();
		get_umkm_by_jenis();
		get_umkm_by_umur();
		get_umkm_by_jenis_usaha();

		get_detail_rekap();

		//datatables
		table = $('#tabel').DataTable({ 
	        "processing": true, //Feature control the processing indicator.
	        "serverSide": true, //Feature control DataTables' server-side processing mode.
	        "order": [], //Initial no order.
	        "width" : '100%',

	        // Load data for the table's content from an Ajax source
	        "ajax": {
	        	"url": "<?php echo site_url('dashboard/ajax_list')?>",
	        	"type": "POST",
	        	"data": function ( data ) {
	        		data.sumber = $('[name="filter_sumber"]').val();
	        		data.iumk = $('[name="filter_iumk"]').val();
	        		data.status_verif = $('[name="filter_status_verif"]').val();
	        		data.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
	        		data.type = 'umkm';
	        	}
	        },

	        //Set column definition initialisation properties.
	        "columnDefs": [
	        { "targets": [ 0,7 ],"orderable": false},
	        ],
	    });

		get_rekap_produk_by_status();
		get_rekap_produk_by_kategori();
		get_rekap_transaksi();

		$("#filter_sumber").change(function(){
			get_detail_rekap();
			reload_table();
		});

		$("#filter_iumk").change(function(){
			get_detail_rekap();
			reload_table();
		});

		$("#filter_status_verif").change(function(){
			reload_table();
		});

		//reload table tipe input
		$('[id^="ifilter_"]').keyup(function(event){
			if (event.keyCode == 13)
			dataTable.ajax.reload();
		});
		//reload table tipe dropdown
		$('[id^="dfilter_"]').change(function(){
			dataTable.ajax.reload();
		});
	});

	function refresh_umkm(){
		get_detail_rekap();
		reload_table();
	}

	function refresh_produk(){
		get_rekap_produk_by_status();
		get_rekap_produk_by_kategori();
	}

	function reload_table(){
		table.ajax.reload(null,false);
	}

	function refresh_umkm_pendataan(){
		get_count_umkm_pendataan();
		get_umkm_by_jenis();
		get_umkm_by_umur();
		get_umkm_by_jenis_usaha();
	}

	function get_detail_rekap(){
		var sumber = $('[name="filter_sumber"]').val();
		var iumk = $('[name="filter_iumk"]').val();
		$.ajax({ 
			url: "<?php echo base_url('dashboard/ajax_data') ?>",
			method:"POST",
			data : {
				sumber : sumber,
				iumk : iumk,
				type : 'detail_rekap_umkm',
				<?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
			},
			dataType: "json",
			success: function(data) {
				$('.jum_umkm_all').text((data.data.jum_umkm_all == null) ? "0" : format_uang(data.data.jum_umkm_all));
				$('.jum_verif_diterima').text((data.data.jum_verif_diterima == null) ? "0" : format_uang(data.data.jum_verif_diterima));
				$('.jum_verif_menunggu').text((data.data.jum_verif_menunggu == null) ? "0" : format_uang(data.data.jum_verif_menunggu));
			}   
		});
	}

	function get_rekap_produk_by_status(){
		$.ajax({ 
			url: "<?php echo base_url('dashboard/ajax_data') ?>",
			method:"POST",
			data : {
				type : 'detail_rekap_produk_by_status',
				<?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
			},
			dataType: "json",
			success: function(data) {
				var data = data.data;
				$('.jum_produk_all').text(data.jum_produk);
				$('.jum_produk_aktif').text(data.jum_aktif);
				$('.jum_produk_nonaktif').text(data.jum_nonaktif); 
				$('.jum_produk_tersedia').text(data.jum_tersedia);
				$('.jum_produk_habis').text(data.jum_habis);   
			}   
		});
	}

	function get_rekap_produk_by_kategori(){
		$.ajax({ 
			url: "<?php echo base_url('dashboard/ajax_data') ?>",
			method:"POST",
			data : {
				type : 'detail_rekap_produk_by_kategori',
				<?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
			},
			dataType: "html",
			success: function(data) {
				$('.data-produk-kategori').html(data);
			}   
		});
	}

	function get_rekap_transaksi(){
		$.ajax({ 
			url: "<?php echo base_url('dashboard/ajax_data') ?>",
			method:"POST",
			data : {
				type : 'detail_rekap_transaksi',
				<?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
			},
			dataType: "json",
			success: function(data) {
				var data = data.data;
				$('.jum_transaksi').text(data.jum_transaksi);
				$('.jum_menunggu_pembayaran').text(data.jum_menunggu_pembayaran);
				$('.jum_menunggu_konfirmasi').text(data.jum_menunggu_konfirmasi);
				$('.jum_diproses').text(data.jum_diproses);
				$('.jum_dikirim').text(data.jum_dikirim);
				$('.jum_sampai').text(data.jum_sampai);
				$('.jum_batal').text(data.jum_batal);
			}   
		});
	}

	var datatable = '';

	function list_transaksi(id_status_transaksi=null,ket=null){
		$('#table_transaksi').DataTable().destroy();
		dataTable = $('#table_transaksi').DataTable( {
			paginationType:'full_numbers',
			processing: true,
			serverSide: true,
		// filter: false,
		autoWidth:false,
		aLengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
		ajax: {
			url: '<?php echo base_url('dashboard/ajax_list')?>',
			type: 'POST',
			data: function (data) {
				data.filter = {
					'status' : id_status_transaksi,
				};
				data.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
				data.type = 'transaksi';
			},
		},
		language: {
			sProcessing: 'Sedang memproses...',
			sLengthMenu: 'Tampilkan _MENU_ entri',
			sZeroRecords: 'Tidak ditemukan data yang sesuai',
			sInfo: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ entri',
			sInfoEmpty: 'Menampilkan 0 sampai 0 dari 0 entri',
			sInfoFiltered: '(disaring dari _MAX_ entri keseluruhan)',
			sInfoPostFix: '',
			sSearch: 'Cari:',
			sUrl: '',
			oPaginate: {
				sFirst: '<<',
				sPrevious: '<',
				sNext: '>',
				sLast: '>>'
			}
		},
		order: [0, 'desc'],
		columns: [
		{'data':'no','orderable':false,"className": "text-center"},
		{'data':'created_transaksi'},
		{'data':'no_invoice'},
		{'data':'nama'},
		{'data':'namausaha'},
		{'data':'total',"className": "text-right"},
		{'data':'nama_status'},
		{'data':'aksi','orderable':false,"className": "text-center"},
		],
	});

		if (ket) {
			$('.ket_title_transaksi').text('('+ket+')');
		}
		$('#modal_transaksi').modal('show');
	}

	function detail_transaksi(id_transaksi){
		$.redirect(
			'<?php echo base_url(); ?>transaksi/admin',
			{
				id_transaksi:id_transaksi,
				<?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
			}
			);
	}

	function list_produk(id_jenis_usaha=null,ket=null,status=null,stok=null){
		$('#table_produk').DataTable().destroy();
		dataTable = $('#table_produk').DataTable( {
			paginationType:'full_numbers',
			processing: true,
			serverSide: true,
		// filter: false,
		autoWidth:false,
		aLengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
		ajax: {
			url: '<?php echo base_url('dashboard/ajax_list')?>',
			type: 'POST',
			data: function (data) {
				data.filter = {
					'group' : id_jenis_usaha,
					'status' : status,
					'stok' : stok,
				};
				data.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
				data.type = 'produk';
			},
		},
		language: {
			sProcessing: 'Sedang memproses...',
			sLengthMenu: 'Tampilkan _MENU_ entri',
			sZeroRecords: 'Tidak ditemukan data yang sesuai',
			sInfo: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ entri',
			sInfoEmpty: 'Menampilkan 0 sampai 0 dari 0 entri',
			sInfoFiltered: '(disaring dari _MAX_ entri keseluruhan)',
			sInfoPostFix: '',
			sSearch: 'Cari:',
			sUrl: '',
			oPaginate: {
				sFirst: '<<',
				sPrevious: '<',
				sNext: '>',
				sLast: '>>'
			}
		},
		order: [0, 'desc'],
		columns: [
		{'data':'no','orderable':false,"className": "text-center"},
		{'data':'nama_produk'},
		{'data':'namausaha'},
		{'data':'stok',"className": "text-center"},
		{'data':'harga',"className": "text-right"},
		{'data':'nama_usaha'},
		{'data':'status',"className": "text-center"},
		{'data':'aksi','orderable':false,"className": "text-center"},
		],
	});

		if (ket) {
			$('.ket_title_produk').text('('+ket+')');
		}
		$('#modal_produk').modal('show');
	}

	function lihat_produk(id_produk,type='detail'){
		$.redirect(
			'<?php echo base_url(); ?>produk',
			{
				id_produk:id_produk,
				type:type,
				<?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
			}
			);
	}

	function get_count_umkm_pendataan(){
		$.ajax({ 
			url: "<?php echo base_url('dashboard/ajax_data') ?>",
			method:"POST",
			data : {
				type : 'count_umkm_pendataan',
				<?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
			},
			dataType: "json",
			success: function(data) {
				if (data.success) {
					var data = data.data;
					$('.jum_umkm_pendataan_all').text(format_uang(data.totalsemua));
					$('.jum_bpum1').text(format_uang(data.bpum1));
					$('.jum_bpum2').text(format_uang(data.bpum2));
					$('.jum_bsmum').text(format_uang(data.bsmum));
					$('.jum_tangerang_bisa').text(format_uang(data.tangerangbisa));
				}
			}   
		});
	}

	function get_umkm_by_jenis(){
		$.ajax({ 
			url: "<?php echo base_url('dashboard/ajax_data') ?>",
			method:"POST",
			data : {
				type : 'rekap_umkm_pendataan_by_jenis',
				<?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
			},
			dataType: "json",
			success: function(data) {
				if (data.success) {
					$('#t_umkm_by_jenis tbody').html(data.data);
				}else{
					$('#t_umkm_by_jenis tbody').html('<tr><td colspan="5" align="center">Data tidak ditemukan !</td></tr>');
				}
			}   
		});
	}

	function get_umkm_by_umur(){
		$.ajax({ 
			url: "<?php echo base_url('dashboard/ajax_data') ?>",
			method:"POST",
			data : {
				type : 'rekap_umkm_pendataan_by_umur',
				<?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
			},
			dataType: "json",
			success: function(data) {
				if (data.success) {
					$('#t_umkm_by_umur tbody').html(data.data);
				}else{
					$('#t_umkm_by_umur tbody').html('<tr><td colspan="8" align="center">Data tidak ditemukan !</td></tr>');
				}
			}   
		});
	}

	function get_umkm_by_jenis_usaha(){
		$.ajax({ 
			url: "<?php echo base_url('dashboard/ajax_data') ?>",
			method:"POST",
			data : {
				type : 'rekap_umkm_pendataan_by_jenis_usaha',
				<?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
			},
			dataType: "json",
			success: function(data) {
				if (data.success) {
					$('#t_umkm_by_jenis_usaha').html(data.data);
				}else{
					$('#t_umkm_by_jenis_usaha').html('<center><span>Data Tidak Ditemukan !</span></center>');
				}
			}   
		});
	}

	function list_bpum(periode){
		if (periode == 1) {
			$('.periode_bpum').text('Periode 1');
			var param = 'periode1';
		}else{
			$('.periode_bpum').text('Periode 2');
			var param = 'tahap2';
		}

		$('[id^="ifilter_"]').val('');
		$('[id^="dfilter_"]').val('');

		$('#table_bpum').DataTable().destroy();
		dataTable = $('#table_bpum').DataTable({
			paginationType: "full_numbers",
            autoWidth: true,
			processing: true,
			serverSide: true,
			searching: false,
			bLengthChange: false,
			scrollX: true,
			ajax: {
				url: '<?php echo site_url('dashboard/ajax_list')?>',
				type: 'post',
				data: function (data) {
                    data.param = {
                        'ket': param,
                    };
                    // data.where = {
                    //     'kecamatan' : $('#id_kecamatan').val(),
                    //     'kelurahan' : $('#id_kelurahan').val(),
                    // };
                    data.cari = {
                        'nik': $('#ifilter_nik').val(),
                    };
					data.filter = {
                        'nama_pemilik': $('#ifilter_nama_pemilik').val(),
                        'bidang_usaha': $('#ifilter_bidang_usaha').val(),
						'alamat': $('#ifilter_alamat').val(),
						'no_rw': $('#ifilter_rw').val(),
						'no_rt': $('#ifilter_rt').val(),
					};
					data.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
					data.type = 'umkm_bpum';
				}
			},
            language: {
                sProcessing: '<i class="fa fa-spinner fa-pulse"></i> memuat data...',
                sLengthMenu: 'Tampilkan _MENU_ entri',
                sZeroRecords: 'Tidak ada data',
                sInfo: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ entri',
                sInfoEmpty: 'Menampilkan 0 sampai 0 dari 0 entri',
                sInfoFiltered: '',
                sInfoPostFix: '',
                sSearch: 'Cari :',
                sUrl: '',
                oPaginate: {
                    sFirst: '<i class="fa fa-fast-backward"></i>',
                    sPrevious: '<i class="fa fa-backward"></i>',
                    sNext: '<i class="fa fa-forward"></i>',
                    sLast: '<i class="fa fa-fast-forward"></i>'
                }
            },
            order: [0, 'asc'],
			columns: [
				{
					data: 'no',
					orderable: false
				},
				{data: 'nik'},
				{data: 'nama_pemilik'},
				{data: 'bidang_usaha'},
				{data: 'alamat'},
				{data: 'kecamatan'},
				{data: 'kelurahan'},
				{data: 'no_rw'},
				{data: 'no_rt'},
				{data: 'foto_1'},
				{data: 'foto_2'},
				{data: 'foto_3'},
				{data: 'foto_4'},
				{data: 'foto_5'},
				{data: 'created_at'},
			]
		});

		$('#modal_bpum').modal('show');
	}

	function list_bsmum(param='')
    {    
    	$('[id^="ifilter_"]').val('');
		$('[id^="dfilter_"]').val('');
    	$('#table_bsmum').DataTable().destroy();
        dataTable = $('#table_bsmum').DataTable({
			paginationType: "full_numbers",
            autoWidth: true,
			processing: true,
			serverSide: true,
			searching: false,
			bLengthChange: false,
			scrollX: true,
			ajax: {
				url: '<?php echo site_url('dashboard/ajax_list')?>',
				type: 'post',
				data: function (data) {
                    data.param = {
                        'ket': param,
                    };
                    data.where = {
                        'nik': $('#ifilter_nik').val(),
                        'no_kk': $('#ifilter_no_kk').val(),
                    };
					data.filter = {
                        'nama': $('#ifilter_nama').val(),
                        'email': $('#ifilter_email').val(),
						'bidang_usaha': $('#ifilter_bidang_usaha').val(),
						'alamat_usaha': $('#ifilter_alamat_usaha').val(),
						'no_tlp': $('#ifilter_no_tlp').val(),
						'rw_usaha': $('#ifilter_rw_usaha').val(),
						'rt_usaha': $('#ifilter_rt_usaha').val(),
					};
					data.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
					data.type = 'umkm_bsmum';
				}
			},
            language: {
                sProcessing: '<i class="fa fa-spinner fa-pulse"></i> memuat data...',
                sLengthMenu: 'Tampilkan _MENU_ entri',
                sZeroRecords: 'Tidak ada data',
                sInfo: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ entri',
                sInfoEmpty: 'Menampilkan 0 sampai 0 dari 0 entri',
                sInfoFiltered: '',
                sInfoPostFix: '',
                sSearch: 'Cari :',
                sUrl: '',
                oPaginate: {
                    sFirst: '<i class="fa fa-fast-backward"></i>',
                    sPrevious: '<i class="fa fa-backward"></i>',
                    sNext: '<i class="fa fa-forward"></i>',
                    sLast: '<i class="fa fa-fast-forward"></i>'
                }
            },
            order: [0, 'asc'],
			columns: [
				{
					data: 'no',
					orderable: false
				},
				{data: 'nik'},
				{data: 'no_kk'},
				{data: 'nama'},
				{data: 'email'},
				{data: 'no_tlp'},
				{data: 'bidang_usaha'},
				{data: 'alamat_usaha'},
				{data: 'kecamatan_usaha'},
				{data: 'kelurahan_usaha'},
				{data: 'rw_usaha'},
				{data: 'rt_usaha'},
				{data: 'foto_ktp'},
				{data: 'foto_kk'},
				{data: 'foto_super'},
				{data: 'statusdidata'},
				{data: 'created_at'}
			]
		});

	    $('#modal_bsmum').modal('show');
    }

	function list_tangerangbisa(){
		$('#modal_tangerangbisa').modal('show');
	}

	function list_umkm_pendataan(id_kecamatan=null,kategori_usaha=null,jeniskelamin=null,range_umur=null,id_jenis_usaha=null){
		$('#table_umkm_pendataan').DataTable().destroy();
		dataTable = $('#table_umkm_pendataan').DataTable( {
			paginationType:'full_numbers',
			processing: true,
			serverSide: true,
			// filter: false,
			autoWidth:false,
			aLengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
			ajax: {
				url: '<?php echo base_url('dashboard/ajax_list')?>',
				type: 'POST',
				data: function (data) {
					data.filter = {
						'id_kecamatan' : id_kecamatan,
						'kategori_usaha' : kategori_usaha,
						'jeniskelamin' : jeniskelamin,
						'range_umur' : range_umur,
						'id_jenis_usaha' : id_jenis_usaha
					};
					data.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
					data.type = 'umkm_pendataan';
				},
			},
			language: {
				sProcessing: 'Sedang memproses...',
				sLengthMenu: 'Tampilkan _MENU_ entri',
				sZeroRecords: 'Tidak ditemukan data yang sesuai',
				sInfo: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ entri',
				sInfoEmpty: 'Menampilkan 0 sampai 0 dari 0 entri',
				sInfoFiltered: '(disaring dari _MAX_ entri keseluruhan)',
				sInfoPostFix: '',
				sSearch: 'Cari:',
				sUrl: '',
				oPaginate: {
					sFirst: '<<',
					sPrevious: '<',
					sNext: '>',
					sLast: '>>'
				}
			},
			// order: [0, 'desc'],
			columns: [
			{'data':'no','orderable':false,"className": "text-center"},
			{'data':'nik'},
			{'data':'nama'},
			{'data':'jenis_usaha'},
			{'data':'alamat'},
			{'data':'no_rt',"className": "text-center"},
			{'data':'no_rw',"className": "text-center"},
			{'data':'kelurahan'},
			{'data':'kecamatan'},
			{'data':'jenis_pendataan'},
			{'data':'lokasi_usaha','orderable':false,"className": "text-center"},
			],
		});
		$('#modal_umkm_pendataan').modal('show');
	}
</script>

<?php $this->load->view('detail_umkm'); ?>