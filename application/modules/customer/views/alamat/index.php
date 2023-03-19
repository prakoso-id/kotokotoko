<style type="text/css">
	.select2-results__option[aria-selected=true] { display: none;}
</style>
<div class="container container-240">
    <ul class="breadcrumb v3">
        <li><a href="<?php echo base_url(); ?>">Beranda</a></li>
        <li class="active">Biodata</li>
    </ul>
    <div class="row" style="margin-bottom: 20px;">
        <div class="col-md-12">
            <div class="cmt-title text-center abs">
                <h1 class="page-title v1">Daftar Alamat</h1>
            </div>
            <div class="page-content">
            	<div class="row">
            		<div class="col-md-8 col-sm-6 col-xs-12">
            			<button type="button" class="btn btn-gradient tambah_data">
						<i class="fa fa-plus"></i> &nbsp; Tambah Alamat Baru
						</button>
                		<button type="button" class="btn" onclick="table_data()">
						<i class="fa fa-undo"></i> &nbsp; Refresh
						</button>
            		</div>
            		<div class="col-md-4 col-sm-6 col-xs-12">
            			<div class="form-group row">
						    <label for="filter_alamat" class="col-sm-3 col-form-label">Pencarian</label>
						    <div class="col-sm-9">
						      <input type="text" name="filter_alamat" id="filter_alamat" placeholder="Cari Alamat" class="filter_alamat form-control" maxlength="20">
						    </div>
						 </div>
            		</div>
            	</div>

            	<div class="col-md-12 table-responsive">
	            	<table class="table table-hover tabel" id="tabel" width="100%">
	            		<thead>
							<tr>
								<th> </th>
								<th>Nama Alamat</th>
								<th>Nama Penerima</th>
								<th>No Telp Penerima</th>
								<th>Propinsi</th>
								<th>Kota / Kabupaten</th>
								<th>Kecamatan</th>
								<th>Kelurahan</th>
								<th class="text-center">Aksi</th>
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
<?php
	$this->load->view('modal');
	$this->load->view('js');
?>
