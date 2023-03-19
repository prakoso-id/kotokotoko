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
			        	<h4>Daftar Toko </h4>
			        	<div class="card-header-action">
			            	<a data-collapse="#card-umkm" class="btn btn-icon btn-danger" href="#"><i class="fas fa-minus"></i></a>
			          	</div>
			      	</div>
			      	<div class="collapse show" id="card-umkm">
				      	<div class="card-body">
				      		<div class="row">
				      			<div class="col-md-12">
				      				<div class="alert alert-warning">
				                      <div class="alert-title">Perhatian !</div>
				                      Halaman ini diperuntukan bagi pelaku usaha yang  memiliki produk dan ingin menjual produknya melalui portal UMKM. Apakah anda sudah memiliki IUMK?
				                    </div>
				      			
				      				<button type="button" class="btn btn-primary" onclick="button_sudah(1)">
										<i class="fas fa-check-circle"></i> &nbsp; Sudah
									</button>
									<button type="button" class="btn btn-danger" onclick="button_sudah(0)">
										<i class="fas fa-times-circle"></i> &nbsp; Belum
									</button>
				      			</div>
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