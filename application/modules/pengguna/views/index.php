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
			        	<h4>Data Pengguna</h4>
			        	<div class="card-header-action">
				        	<a class="btn btn-icon btn-secondary" href="javascript:void(0);" onclick="table_data();" title="Refresh"><i class="fas fa-sync"></i></a>
			            <a data-collapse="#card-pengguna" class="btn btn-icon btn-danger" href="#"><i class="fas fa-minus"></i></a>
			          	</div>
			      	</div>
			      	<div class="collapse show" id="card-pengguna">
			      		<div class="card-body">
			      			<div class="row" style="margin-bottom: 10px;">
			      				<div class="col-md-12">
									<button type="button" class="btn btn-danger tambah_data">
										<i class="fa fa-plus"></i> &nbsp; Tambah
									</button>
									<button type="button" class="btn btn-secondary" onclick="table_data()">
										<i class="fa fa-undo"></i> &nbsp; Refresh
									</button>
			      				</div>
			      			</div>
			        		<div class="form-row">
					            <div class="form-group col-md-4">
					              	<label for="filter_group">Group</label>
					              	<select class="form-control select2 filter_group" name="filter_group">
										<option value="0">-- Semua Group --</option>
										<option value="1">Administrator</option>
										<option value="3">Verifikator</option>
										<option value="2">Pengguna</option>
									</select>
					            </div>
					            <div class="form-group col-md-4">
					              	<label for="filter_username">NIK / NIP</label>
					              	<input type="text" name="filter_username" id="filter_username" placeholder="Cari NIK / NIP" required="" class="filter_username form-control" maxlength="20">
					            </div>
					            <div class="form-group col-md-4">
					              	<label for="filter_nama">Nama Lengkap</label>
					              	<input type="text" name="filter_nama" id="filter_nama" placeholder="Cari Nama Lengkap" required="" class="filter_nama form-control" maxlength="20">
					            </div>
				          	</div>

				          	<div class="table-responsive">
					          	<table class="table table-hover tabel" id="tabel" width="100%">
									<thead>
										<tr>
											<th> </th>
											<th>Nama</th>
											<th>Group</th>
											<th>Terakhir Login</th>
											<th>Status</th>
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
	    	</div>
	  	</div>
	</div>
</section>
<?php
	$this->load->view('pengguna/modal');
	$this->load->view('pengguna/js');
?>
