<style type="text/css">
	.select2-results__option[aria-selected=true] { display: none;}
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
		      	<div class="card card-danger card-index">
			      	<div class="card-header">
			        	<h4>Data Toko</h4>
			        	<div class="card-header-action">
			            	<a data-collapse="#card-umkm" class="btn btn-icon btn-danger" href="#"><i class="fas fa-minus"></i></a>
			          	</div>
			      	</div>
			      	<div class="collapse show" id="card-umkm">
				      	<div class="card-body">
				      		<div class="row">
				      			<div class="col-md-12">
				      				<!-- <button type="button" class="btn btn-danger button_action" onclick="button_sudah(1)">
										<i class="fa fa-plus"></i> &nbsp; Tambah Toko
									</button> -->
				      			</div>
				      		</div>

				      		<div class="form-row" style="display: none;">
								<div class="form-group col-md-6">
					              	<label for="filter_nama">Nama Toko</label>
					              	<input type="text" name="filter_nama" id="filter_nama" placeholder="Nama Usaha" required="" class="filter_perusahaan form-control" maxlength="20">
					            </div>

					            <div class="form-group col-md-6">
					            	<label for="filter_status">Status</label>
					            	<select name="status" id="filter_status" class="filter_status select2 form-control">
										<option value="">Semua Status</option>
										<?php foreach ($m_status as $sts) {
											echo '<option value="'.$sts->id_status.'">'.$sts->nama.'</option>';
										} ?>
									</select>
								</div>
							</div>

							<div class="table-responsive">
								<table class="table table-striped row-border table-hover tabel" id="tabel">
									<thead>
										<tr>
											<th> </th>
											<th>Nama Usaha</th>
											<th>Kategori Usaha</th>
											<th>Ratting</th>
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
	$this->load->view('modal');
	$this->load->view('js');
	$this->load->view('dashboard/detail_umkm');
?>