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
		      			<h4>Data Agenda</h4>
		        		<div class="card-header-action">
				        	<a class="btn btn-icon btn-secondary" href="javascript:void(0);" onclick="table_data();" title="Refresh"><i class="fas fa-sync"></i></a>
			            <a data-collapse="#card-agenda" class="btn btn-icon btn-danger" href="#"><i class="fas fa-minus"></i></a>
			          	</div>
		      		</div>
		      		<div class="collapse show" id="card-agenda">
		      			<div class="card-body">
		      				<div class="row" style="margin-bottom: 10px;">
			      				<div class="col-md-12">
			      					<button type="button" class="btn btn-danger" onclick="tambah_data()">
										<i class="fa fa-plus"></i> &nbsp; Tambah Agenda
									</button>
									<button type="button" class="btn btn-secondary" onclick="table_data()">
										<i class="fa fa-undo"></i> &nbsp; Refresh
									</button>
			      				</div>
			      			</div>

			      			<div class="form-row">
			      				<div class="form-group col-md-6">
					              	<label for="filter_agenda">Judul Agenda</label>
					              	<input type="text" name="filter_agenda" id="filter_agenda" placeholder="Cari judul agenda" required="" class="filter_agenda form-control" maxlength="20">
								</div>
			      				
								<div class="form-group col-md-6">
					              	<label for="filter_status">Status</label>
					              	<select class="form-control select2 filter_status" name="filter_status" id="filter_status">
										<option value="0">Semua Status</option>
										<option value="aktif">Aktif</option>
										<option value="nonaktif">Non Aktif</option>
									</select>
					            </div>
				          	</div>

				          	<div class="table-responsive">
				          		<table class="table table-hover tabel" id="tabel" width="100%">
									<thead>
										<tr>
											<th> </th>
											<th style="white-space: nowrap;">Foto</th>
											<th style="white-space: nowrap;">Judul</th>
											<th style="white-space: nowrap;">Lokasi</th>
											<th style="white-space: nowrap;">Tanggal Acara</th>
											<th style="white-space: nowrap;" class="text-center" width="10%">Aksi</th>
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

