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
							<div class="form-group col-md-6">
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
				            <div class="form-group col-md-6">
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
						<h4>Ringkasan Statistik</h4>
	      				<span>Rutin pantau perkembangan toko untuk tingkatkan penjualanmu.</span>

			          	<div class="row">
				            <div class="col-md-4">
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
				            <div class="col-md-4">
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
				            <div class="col-md-4">
				              <div class="card card-statistic-1">
				                <div class="card-icon bg-danger">
				                  <i class="fas fa-clipboard-list"></i>
				                </div>
				                <div class="card-wrap">
				                  <div class="card-header">
				                    <h4>Pesanan Baru</h4>
				                  </div>
				                  <div class="card-body">
				                    <span class="jum_pesanan_baru">0</span>
				                  </div>
				                </div>
				              </div>
				            </div>                  
				        </div>
					</div>     
		      	</div>

		      	<div class="card card-danger">
	      			<div class="card-body">
						<h4>Jumlah Pendapatan</h4>
	      				<span>Cek pendapatan toko untuk atur strategi penjualan.</span>

			          	<div class="row">
				            <div class="col-md-6">
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
				        </div>

				        <div class="row">
				        	<div id="grafik_pendapatan_bersih_baru" class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="height: 500px;"></div>
				        </div>
					</div>     
		      	</div>
		    </div>
	  	</div>

	  	<div class="row">
	      	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	      		<div class="card card-danger">
		      		<div class="card-header">
		      			<h4>Tren Produk Dilihat</h4>
		      			<div class="card-header-action">
	                      <button type="button" class="btn btn-danger">
	                        <span class="jum_produk_dilihat">0</span>
	                      </button>
	                    </div>
		      		</div>
	      			<div class="card-body">
				        <div class="row">
				        	<div id="grafik_produk_dilihat" class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="height: 500px;"></div>
				        </div>
					</div>     
		      	</div>
	      	</div>
      	</div>

      	<div class="row">
      		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	      		<div class="card card-danger">
	      			<div class="card-body">
				        <h4>Performa Pesanan</h4>
	      				<span>Perkembangan pesanan yang berhasil di bayar oleh pembeli.</span>

	      				<div class="row">
	      					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
	      						<div class="card">
						      		<div class="card-header">
						      			<h4>Tren Pesanaan</h4>
						      			<div class="card-header-action">
					                      <button type="button" class="btn btn-danger">
					                        <span class="jum_pesanan_baru">0</span> Pesanan
					                      </button>
					                    </div>
						      		</div>
					      			<div class="card-body">
								        <div class="row">
								        	<div id="grafik_pesanan_baru" class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="height: 500px;"></div>
								        </div>
									</div>     
						      	</div>
	      					</div>

	      					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
	      						<div class="card">
						      		<div class="card-header">
						      			<h4>Tipe Pembatalan</h4>
						      			<div class="card-header-action">
					                      <button type="button" class="btn btn-danger">
					                        <span class="jum_pesanan_batal">0</span> Pesanan
					                      </button>
					                    </div>
						      		</div>
					      			<div class="card-body">
								        <div class="row">
								        	<div class="row">
									        	<div id="grafik_tipe_pembatalan" class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="height: 500px; width: 600px;"></div>
									        </div>
								        </div>
									</div>     
						      	</div>
	      					</div>
	      				</div>

	      				<div class="row">
	      					<div class="col-md-6">
				              <div class="card card-statistic-1">
				                <div class="card-icon bg-danger">
				                  <i class="fas fa-dollar-sign"></i>
				                </div>
				                <div class="card-wrap">
				                  <div class="card-header">
				                    <h4>Rata - Rata Transaksi</h4>
				                  </div>
				                  <div class="card-body">
				                    <span class="jum_rata2_transaksi" style="font-size:14px;">Rp. 0,00</span>
				                  </div>
				                </div>
				              </div>
				            </div>

				            <div class="col-md-6">
				              <div class="card card-statistic-1">
				                <div class="card-icon bg-danger">
				                  <i class="fas fa-box"></i>
				                </div>
				                <div class="card-wrap">
				                  <div class="card-header">
				                    <h4>Rata - Rata Jumlah Barang</h4>
				                  </div>
				                  <div class="card-body">
				                    <span class="jum_rata2_barang">0</span>
				                  </div>
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

<script type="text/javascript">
	var table;
	$(document).ready(function() {
		$('.daterange-cus').daterangepicker({
		  locale: {format: 'YYYY-MM-DD'},
		  drops: 'down',
		  opens: 'right',
		}).change(function (e) {
			rekap();
			grafik('grafik_pendapatan_bersih_baru');
			grafik('grafik_produk_dilihat');
			grafik('grafik_pesanan_baru');
			grafik('grafik_tipe_pembatalan');
		});

		rekap();
		grafik('grafik_pendapatan_bersih_baru');
		grafik('grafik_produk_dilihat');
		grafik('grafik_pesanan_baru');
		grafik('grafik_tipe_pembatalan');
	});

	$("#filter_umkm").change(function(){
		rekap();
		grafik('grafik_pendapatan_bersih_baru');
		grafik('grafik_produk_dilihat');
		grafik('grafik_pesanan_baru');
		grafik('grafik_tipe_pembatalan');
	});

	function rekap() {
		 $.ajax({
            url : "<?php echo base_url('statistik/ajax_data')?>",
            type: "POST",
            data : {
                <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>',
                type : 'rekap_perform_toko',
                id_umkm : $('#filter_umkm').val(),
                tanggal : $('#filter_tanggal').val(),
            },
            dataType: "JSON",
            success: function(data){
            	$('.jum_pendapatan_bersih_baru').text(data.pendapatan_bersih_baru);
            	$('.jum_produk_dilihat').text(data.produk_dilihat);
            	$('.jum_pesanan_baru').text(data.pesanan_baru);
            	$('.jum_pesanan_batal').text(data.pesanan_batal);
            	$('.jum_rata2_transaksi').text(data.rata2_transaksi);
            	$('.jum_rata2_barang').text(data.rata2_barang_terjual);
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
                tanggal : $('#filter_tanggal').val(),
            },
            dataType: "JSON",
            success : function(data) {
            	var title = '';
            	var yAxisTittle = '';
            	if (type == 'grafik_pendapatan_bersih_baru') {
            		var title = 'Grafik Pendapatan Bersih Baru';
            		var yAxisTittle = 'Pendapatan Bersih';
            	}else if (type == 'grafik_produk_dilihat') {
            		var title = 'Grafik Tren Produk Dilihat';
            		var yAxisTittle = 'Produk Dilihat';
            	}else if (type == 'grafik_pesanan_baru') {
            		var title = 'Grafik Tren Pesanan';
            		var yAxisTittle = 'Pesanan';
            	}else if (type == 'grafik_tipe_pembatalan') {
            		var title = 'Grafik Tipe Pembatalan';
            		var yAxisTittle = 'Pesanan';
            	}

                if (type != 'grafik_tipe_pembatalan') {
                	Highcharts.chart(type, {
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
								text: yAxisTittle
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
                }else{
                	Highcharts.chart(type, {
					    chart: {
					        type: 'column'
					    },
					    title: {
					        text: title
					    },
					    subtitle: {
							text: 'Periode ' + $('#filter_tanggal').val()
						},
					    xAxis: {
					        categories: ['']//data.data.dataLineXaxis
					    },
					    yAxis: {
					        min: 0,
					        title: {
					            text: yAxisTittle
					        }
					    },
					    tooltip: {
					        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
					        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
					            '<td style="padding:0"><b>{point.y:.f} Pesanan</b></td></tr>',
					        footerFormat: '</table>',
					        shared: true,
					        useHTML: true
					    },
					    plotOptions: {
					        column: {
					            pointPadding: 0.2,
					            borderWidth: 0,
					            dataLabels: {
					                enabled: true
					            }
					        }
					    },
					    series: data.data.dataBar
					});
                }
            },
            error: function() {
                alert('Error get data from ajax');
            }
        });
    }
</script>