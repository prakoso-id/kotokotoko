<style type="text/css">
	.notfound .notfound-404 h1{
		font-size: 160px !important;
	}
	.msg_history {
	    overflow: hidden;
	    height: 595px;
	    overflow-y: scroll;
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
		      			<h4>Data Pesan</h4>
		      		</div>
	      			<div class="card-body">
	      				<button class="btn" style="float: right; margin-bottom: 10px;" onclick="refresh()">
						<i class="fas fa-sync"></i> Refresh
						</button>
						<div class="messaging" style="margin-bottom: 30px;">
							<div class="inbox_msg">
								<div class="inbox_people">
									<div class="headind_srch">
										<div class="recent_heading">
											<h4 style="color: #ab2828;">Pesan</h4>

										</div>
									</div>
									<div class="inbox_chat">
										<?php
											if(isset($pesan['review'])):
											foreach ($pesan['review'] as $value):
										?>
											<div class="chat_list" onclick="detail_chat(<?php echo $value['id_group'] ?>,<?php echo $value['count_not_read'] ?>,'<?php echo $value['nama'] ?>',<?php echo $value['flag']; ?>)" title="<?php echo $value['nama'] ?>">
												<div class="chat_people">
													<div class="chat_img">
														<?php
															echo get_icon($value['nama']);
														?>
													</div>
													<div class="chat_ib">
														<?php 
														if($value['flag'] == 1){
															echo '<p style="color: #ab2828; font-size: 11px;">Penjual</p>';
														}elseif($value['flag'] == 2){
															echo '<p style="color: #ab2828; font-size: 11px;">Admin</p>';
														} 
														?>
														<h5>
															<?php 
															echo readMore(strtoupper($value['nama']),20); 
															echo '<span class="count-pesan-'.$value['id_group'].'">';
															if ($value['count_not_read'] > 0) {
																echo '<span style="background:#eb5050;color:#fff;" class="badge">'.$value['count_not_read'].'</span>';
															}
															echo '</span>';
															?> 
															<p style="font-size: 10px; font-weight: 500">
																<?php 
																	if ($value['to_umkm']) {
																		echo '<i style="color: #ab2828">Ke : '.$value['to_umkm'].'</i><br>';
																	}
																	echo indonesian_date($value['created_at']); 
																?>
															</p>
														</h5>
													</div>
												</div>
											</div>
										<?php 
											endforeach;
											else:
												echo '<div style="text-align: center;">Tidak ada pesan</div>';
											endif;
										?>
										
									</div>
								</div>
								<div class="mesgs">
									<center>
										<div id="notfound" style="top: 120px;position: relative;">
											<div class="notfound">
												<div class="notfound-404">
													<h3 style="color: #ab2828">Selamat Datang di Fitur</h3>
													<h1 style="color: #ab2828"><span>P</span><span>E</span><span>S</span><span>A</span><SPAN>N</SPAN></h1>
												</div>
												<h2 style="color: #ab2828">Silakan memilih pesan untuk memulai percakapan</h2>
											</div>
										</div>
									</center>
								</div>
							</div>
						</div>
					</div>     
		      	</div>
		    </div>
	  	</div>
	</div>
</section>
<?php $this->load->view('js'); ?>