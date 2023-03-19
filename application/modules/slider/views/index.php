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
		      			<h4>Data Slider</h4>
		      			<div class="card-header-action">
				        	<a class="btn btn-icon btn-secondary" href="javascript:void(0);" onclick="table_data();" title="Refresh"><i class="fas fa-sync"></i></a>
			            	<a data-collapse="#card-slider" class="btn btn-icon btn-danger" href="#"><i class="fas fa-minus"></i></a>
			          	</div>
		      		</div>
		      		<div class="collapse show" id="card-slider">
		      			<div class="card-body">
		      				<div class="row" style="margin-bottom: 10px;">
		      					<div class="col-md-12">
									<button type="button" class="btn btn-danger button_action" onclick="tambah_data()">
										<i class="fa fa-plus"></i> &nbsp; Tambah Slider
									</button>
									<button type="button" class="btn btn-secondary button_action" onclick="table_data()">
										<i class="fa fa-undo"></i> &nbsp; Refresh
									</button>
		      					</div>
		      				</div>

		      				<div class="form-row">
								<div class="form-group col-md-6">
					              	<label for="filter_berita">Judul</label>
					              	<input type="text" name="filter_berita" id="filter_berita" placeholder="Cari judul.." required="" class="filter_berita form-control" maxlength="20">
					            </div>
					            <div class="form-group col-md-6">
					              	<label for="filter_status">Status</label>
					              	<select class="form-control select2 filter_status" name="filter_status" id="filter_status">
										<option value="">Semua Status</option>
										<option value="aktif">Aktif</option>
										<option value="nonaktif">Non Aktif</option>
									</select>
					            </div>
							</div>

							<div class="table-responsive">
								<table class="table table-hover tabel" id="tabel" width="100%">
									<thead>
										<tr>
											<th width="5%"> </th>
											<th>Judul</th>
											<th width="10%">Jenis</th>
											<th>Url</th>
											<th width="10%">Status</th>
											<th align="center" width="10%">Aksi</th>
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
		      			<h4>Data Banner Produk</h4>
		      			<div class="card-header-action">
				        	<a class="btn btn-icon btn-secondary" href="javascript:void(0);" onclick="table_data_banner_produk();" title="Refresh"><i class="fas fa-sync"></i></a>
			            	<a data-collapse="#card-banner-produk" class="btn btn-icon btn-danger" href="#"><i class="fas fa-minus"></i></a>
			          	</div>
		      		</div>
		      		<div class="collapse show" id="card-banner-produk">
		      			<div class="card-body">
							<div class="table-responsive">
								<table class="table table-hover tabel_banner_produk" id="tabel_banner_produk" width="100%">
									<thead>
										<tr>
											<th width="5%"> </th>
											<th>Judul</th>
											<th>Produk</th>
											<th>Url</th>
											<th align="center" width="10%">Aksi</th>
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