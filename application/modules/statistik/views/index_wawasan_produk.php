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
		      			<h4>Filter</h4>
		      		</div>
	      			<div class="card-body">
	      				<div class="form-row">
							<div class="form-group col-md-4">
				              	<label for="filter_umkm">Toko</label>
				              	<select class="form-control select2 filter_umkm" name="filter_umkm" id="filter_umkm">
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
				            <div class="form-group col-md-4">
				              	<label for="filter_kategori">Kategori Produk</label>
				              	<select class="filter_kategori select2 form-control" id="filter_kategori">
									<option value="">--Semua--</option>
									<?php 
									foreach ($kategori as $k) {
										echo '<option value="'.$k->id_jenis_usaha.'">'.$k->nama_usaha.'</option>';
									}
									?>
								</select>
				            </div>
				            <div class="form-group col-md-4">
				              	<label for="filter_tanggal">Tanggal</label>
			                    <div class="input-group">
			                        <div class="input-group-prepend">
			                          <div class="input-group-text">
			                            <i class="fas fa-calendar"></i>
			                          </div>
			                        </div>
			                        <input type="text" class="form-control daterange-cus" name="filter_tanggal" id="filter_tanggal" value="<?php echo date('Y-m-d', strtotime('-30 days')) ?> - <?php echo date('Y-m-d') ?>">
			                    </div>
				            </div>
			          	</div>
					</div>
		      	</div>
		    </div>
	  	</div>

	  	<div class="row">
		    <div class="col-12 col-sm-12 col-lg-12">
		      	<div class="card card-danger">
	      			<div class="card-body">
						<h4>Tingkatkan performa produkmu</h4>
	      				<span>Rutin pantau perkembangan produk-produk di tokomu.</span>

			          	<div class="row">
				            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
				              <div class="card card-statistic-1">
				                <div class="card-icon bg-danger">
				                  <i class="fas fa-dollar-sign"></i>
				                </div>
				                <div class="card-wrap">
				                  <div class="card-header">
				                    <h4>Pendapatan Bersih Baru</h4>
				                  </div>
				                  <div class="card-body">
				                    <span class="jum_pendapatan_bersih_baru" style="font-size:14px;">Rp. 0,00</span>
				                  </div>
				                </div>
				              </div>
				            </div>
				            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
				              <div class="card card-statistic-1">
				                <div class="card-icon bg-danger">
				                  <i class="far fa-share-square"></i>
				                </div>
				                <div class="card-wrap">
				                  <div class="card-header">
				                    <h4>Produk Terjual</h4>
				                  </div>
				                  <div class="card-body">
				                    <span class="jum_produk_terjual">0</span>
				                  </div>
				                </div>
				              </div>
				            </div>
				            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
				              <div class="card card-statistic-1">
				                <div class="card-icon bg-danger">
				                  <i class="far fa-eye"></i>
				                </div>
				                <div class="card-wrap">
				                  <div class="card-header">
				                    <h4>Produk Dilihat</h4>
				                  </div>
				                  <div class="card-body">
				                    <span class="jum_produk_dilihat">0</span>
				                  </div>
				                </div>
				              </div>
				            </div>
				            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
				              <div class="card card-statistic-1">
				                <div class="card-icon bg-danger">
				                  <i class="fas fa-shopping-cart"></i>
				                </div>
				                <div class="card-wrap">
				                  <div class="card-header">
				                    <h4>Keranjang</h4>
				                  </div>
				                  <div class="card-body">
				                    <span class="jum_produk_keranjang">0</span>
				                  </div>
				                </div>
				              </div>
				            </div>                  
				        </div>

				        <div class="row">
				        	<div id="grafik_pendapatan_bersih_baru" class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="height: 500px;"></div>
				        </div>
					</div>     
		      	</div>

		      	<div class="card card-danger">
	      			<div class="card-body">
      					<h4>Performa produkmu</h4>
      					<span>Lihat performa produk di tokomu menggunakan pilihan filter.</span>

      					<div class="float-right"><button type="button" onclick="cetak_excel_produk()" class="btn btn-icon icon-left btn-danger" style="text-align:right;"><i class="fas fa-file-excel"></i> Cetak Excel</button></div>
	      				<br><br>
	      				<h4>Daftar Produk</h4>
			    
		          		<div class="table-responsive">
		          			<table class="table table-hover table-striped table-bordered" id="tabel_produk" width="100%">
		          				<thead>
		          					<tr>
		          						<th width="5%">No</th>
		          						<th width="20%">Nama Produk</th>
		          						<th>Kode Produk</th>
		          						<th width="20%">Pendapatan</th>
		          						<th>Terjual</th>
		          						<th>Dilihat</th>
		          						<th>Keranjang</th>
		          						<th>Favorit</th>
		          						<th>Pesanan</th>
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
</section>
<script type="text/javascript">
	var table;
	$(document).ready(function() {
		$('.daterange-cus').daterangepicker({
		  locale: {format: 'YYYY-MM-DD'},
		  drops: 'down',
		  opens: 'right',
		}).change(function (e) {
			rekap_produk();
			grafik('grafik_pendapatan_bersih_baru');
			table_data();
		});

		rekap_produk();
		grafik('grafik_pendapatan_bersih_baru');

		//datatables
        table = $('#tabel_produk').DataTable({ 
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            "width" : '100%',
   
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('statistik/ajax_list')?>",
                "type": "POST",
                "data": function ( data ) {
                    data.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
                    data.type = 'daftar_produk';
                    data.id_umkm = $('#filter_umkm').val();
	                data.id_jenis_usaha = $('#filter_kategori').val();
	                data.tanggal = $('#filter_tanggal').val();
                }
            },
   
            //Set column definition initialisation properties.
            "columnDefs": [
            	{ "targets": [ 0,2,4,5,6,7 ],"className": "text-center"},
            	{ "targets": [ 3 ],"className": "text-right"},
            ],
        });
	});

	function table_data(){
		table.ajax.reload(null,true);
	}

	$("#filter_umkm").change(function(){
		rekap_produk();
		grafik('grafik_pendapatan_bersih_baru');
		table_data();
	});

	$("#filter_kategori").change(function(){
		rekap_produk();
		grafik('grafik_pendapatan_bersih_baru');
		table_data();
	});

	function rekap_produk() {
		 $.ajax({
            url : "<?php echo base_url('statistik/ajax_data')?>",
            type: "POST",
            data : {
                <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>',
                type : 'rekap_perform_produk',
                id_umkm : $('#filter_umkm').val(),
                id_jenis_usaha : $('#filter_kategori').val(),
                tanggal : $('#filter_tanggal').val(),
            },
            dataType: "JSON",
            success: function(data){
            	$('.jum_pendapatan_bersih_baru').text(data.pendapatan_bersih_baru);
            	$('.jum_produk_terjual').text(data.produk_terjual);
            	$('.jum_produk_dilihat').text(data.produk_dilihat);
                $('.jum_produk_keranjang').text(data.produk_keranjang);
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert('Error get data from ajax');
            }
        });
	}

	function grafik(type){
        $.ajax({
            url : "<?php echo base_url('statistik/ajax_grafik')?>",
            type: "POST",
            data : {
                <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>',
                type : type,
                id_umkm : $('#filter_umkm').val(),
                id_jenis_usaha : $('#filter_kategori').val(),
                tanggal : $('#filter_tanggal').val(),
            },
            dataType: "JSON",
            success : function(data) {
            	var title = '';
            	if (type == 'grafik_pendapatan_bersih_baru') {
            		var title = 'Grafik Pendapatan Bersih Baru';
            	}

                var line = Highcharts.chart(type, {
					chart: {
						type: 'spline',
						zoomType: 'x'
					},
					title: {
						text: title
					},
					subtitle: {
						text: 'Periode ' + $('#filter_tanggal').val()
					},
					xAxis: {
						categories: data.data.dataLineXaxis
					},
					yAxis: {
						title: {
							text: 'Pendapatan Bersih'
						}
					},
					tooltip: {
						crosshairs: true,
						shared: true
					},
			        plotOptions: {
			        spline: {
			            dataLabels: {
			                enabled: true
			                }
			            }
			        },
					series: data.data.dataLine
				}); 
            },
            error: function() {
                alert('Error get data from ajax');
            }
        });
    }

    function cetak_excel_produk() {
        $.redirect("<?php echo site_url('statistik/cetak_excel_produk'); ?>", {
            id_umkm : $('#filter_umkm').val(),
            id_jenis_usaha : $('#filter_kategori').val(),
            tanggal : $('#filter_tanggal').val(),
            <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>',
        }, 'target', '_blank');
    }
</script>