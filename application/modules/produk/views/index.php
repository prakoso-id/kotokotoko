<style type="text/css">
	.progress {
		width: 100%;
		height: 30px !important;
	}
	.progress-bar {
		height: 20px;
	}
	.media {
		display: table;
    	margin-bottom: 30px;
    	border-bottom: 1px solid #ccc;
	}
	.media-body{
		padding-bottom: 20px;
	}

	.bootstrap-tagsinput {
		width: 100%;
	}
</style>

<section class="section">
  	<div class="section-header">
	    <h1><?php echo $title_beranda; ?></h1>
	    <div class="section-header-breadcrumb">
	      	<div class="breadcrumb-item "><a href="<?php echo base_url('dashboard'); ?>">Dashboard</a></div>
	      	<div class="breadcrumb-item active"><?php echo $title_beranda; ?></div>
	    </div>
  	</div>

	<div class="section-body">
	  	<div class="row">
		    <div class="col-12 col-sm-12 col-lg-12">
		      	<div class="card card-danger">
		      		<div class="card-header">
		      			<h4>Data Produk</h4>
		        		<div class="card-header-action">
				        	<a class="btn btn-icon btn-secondary" href="javascript:void(0);" onclick="table_data();" title="Refresh"><i class="fas fa-sync"></i></a>
			            <a data-collapse="#card-produk" class="btn btn-icon btn-danger" href="#"><i class="fas fa-minus"></i></a>
			          	</div>
		      		</div>
		      		<div class="collapse show" id="card-produk">
		      			<div class="card-body">
		        			<div class="row" style="margin-bottom: 10px;">
			      				<div class="col-md-12">
			      					<?php 
			      					
			      					if ($this->user_model->is_umkm_admin() ) {
			      						echo '<button type="button" class="btn btn-danger button_action" onclick="tambah_data()">
												<i class="fa fa-plus"></i> &nbsp; Tambah
											</button>';
			      					}
			      					?>
									<button type="button" class="btn btn-secondary" onclick="table_data()">
										<i class="fa fa-undo"></i> &nbsp; Refresh
									</button>
			      				</div>
			      			</div>

			      			<div class="form-row">
			      				<?php 
			      				if(!$this->user_model->is_umkm_admin()){ ?>
			      					<!-- <div class="form-group col-md-3">
					              		<label for="filter_umkm">UMKM</label>
					              		<select class="form-control select2 filter_umkm" name="filter_umkm" id="filter_umkm" style="width: 100%;">
											<option value="">--Semua--</option>
											<?php
												foreach ($option_umkm as $key => $value) {
													if ($value->id_status == '1') {
														$sts_verif = '&#10004;';
													}else{
														$sts_verif = '';
													}
													echo "<option value='".$value->id_umkm."'>".text($value->namausaha)."  ".$sts_verif."</option>";
												}
											?>
										</select>
									</div>
									<input type="hidden" class="form-control filter_nama_umkm" name="filter_nama_umkm"> -->
			      				<?php }else{
			      					// echo '<input type="hidden" class="form-control filter_umkm" name="filter_umkm">';
			      					// echo '<div class="form-group col-md-3">
					              	// 			<label for="filter_nama_umkm">Nama UMKM</label>
					              	// 			<input type="text" name="filter_nama_umkm" id="filter_nama_umkm" placeholder="Nama UMKM" required="" class="filter_nama_umkm form-control" maxlength="20">
									// 	  </div>';
			      				} ?>
					           
					            <div class="form-group col-md-4">
					              	<label for="filter_produk">Nama Produk</label>
					              	<input type="text" name="filter_produk" id="filter_produk" placeholder="Nama produk" required="" class="filter_produk form-control" maxlength="20">
					            </div>
					            <div class="form-group col-md-4">
					              	<label for="filter_status">Status</label>
					              	<select class="form-control select2 filter_status" name="filter_status" id="filter_status">
										<option value="">-- Status Produk --</option>
										<option value="1">Aktif</option>
										<option value="2">Tidak Aktif</option>
									</select>
					            </div>
					            <div class="form-group col-md-4">
					              	<label for="filter_kategori">Kategori</label>
					              	<select class="form-control select2 filter_kategori" name="filter_kategori" id="filter_kategori">
										<option value="">-- Semua Kategori --</option>
										<?php 
										foreach ($kategori as $value) {
											echo '<option value="'.$value->id_jenis_usaha.'">'.$value->nama_usaha.'</option>';
										}
										?>
									</select>
					            </div>
				          	</div>

			      			<div class="table-responsive">
			      				<table class="table table-hover tabel" id="tabel" width="100%">
									<thead>
										<tr>
											<th> </th>
											<th>Foto</th>
											<th>Nama Produk</th>
											<th>Kategori</th>
											<th>Nama UMKM</th>
											<th width="10%">Stok</th>
											<th>Harga</th>
											<th width="10%">Status</th>
											<th class="text-center" width="8%">Aksi</th>
										</tr>
									</thead>
									<tbody>

									</tbody>
								</table>
			      			</div>
		      			</div>
		      		</div>     
		      	</div>
		    </div>
	  	</div>
	</div>
</section>

<?php
	$this->load->view('modal');
	$this->load->view('js');
?>

