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
			        	<h4>Data UMKM</h4>
			        	<div class="card-header-action">
				        	<a class="btn btn-icon btn-secondary" href="javascript:void(0);" onclick="table_data();" title="Refresh"><i class="fas fa-sync"></i></a>
			            	<a data-collapse="#card-umkm" class="btn btn-icon btn-danger" href="#"><i class="fas fa-minus"></i></a>
			          	</div>
			      	</div>
			      	<div class="collapse show" id="card-umkm">
				      	<div class="card-body">
				        	<div class="row" style="margin-bottom: 10px;">
			      				<div class="col-md-12">
									<button type="button" class="btn btn-secondary" onclick="table_data()">
										<i class="fa fa-undo"></i> &nbsp; Refresh
									</button>
									<!-- <a class="btn btn-primary button_action" href="<?php echo base_url('assets/umkm.xlsx'); ?>" target="_blank">
										<i class="fa fa-file-excel-o"></i> &nbsp; Template Upload Excel
									</a>
									<button class="btn btn-info button_action" onclick="upload_excel()">
										<i class="fa fa-file-excel-o"></i> &nbsp; Upload Excel
									</button> -->
			      				</div>
			      			</div>

			      			<div class="form-row">
					            <div class="form-group col-md-4">
					              	<label for="filter_iumkm">Status</label>
					              	<select class="form-control select2 filter_iumkm" name="filter_iumkm" id="filter_iumkm">
										<option value="">Semua Status</option>
										<?php foreach ($m_status as $sts) {
											echo '<option value="'.$sts->id_status.'">'.$sts->nama.'</option>';
										} ?>
									</select>
					            </div>
					            <div class="form-group col-md-4">
					              	<label for="filter_perusahaan">Nama Usaha</label>
					              	<input type="text" name="filter_perusahaan" id="filter_perusahaan" placeholder="Nama Usaha" required="" class="filter_perusahaan form-control" maxlength="20">
					            </div>
					            <div class="form-group col-md-4">
					              	<label for="filter_group">Jenis Usaha</label>
					              	<select class="form-control select2 filter_group" id="filter_group" name="filter_group">
										<option value="">Semua Jenis Usaha</option>
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
											<th>Nama Usaha</th>
											<th>Nama Pemilik</th>
											<th>Jenis Usaha</th>
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
	$this->load->view('dashboard/detail_umkm');
	$this->load->view('modal');
	$this->load->view('js');
?>