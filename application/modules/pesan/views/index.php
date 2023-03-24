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
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Pesan</h4>
                    <div class="breadcrumb__links">
						<a href="<?php echo base_url(); ?>">Beranda</a>
                        <span>Pesan Saya</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->
<div class="container container-240">

    <div class="row" style="margin-bottom: 20px;">
    	<div class="col-md-12">
    		<div class="cmt-title text-center abs">
                
            </div>

    		<button class="btn" style="float: right; margin-bottom: 10px; margin-top:20px;" onclick="refresh()">
				<i class="fa fa-refresh"></i> Refresh
			</button>
			<div class="messaging" style="margin-bottom: 30px;">
				<div class="inbox_msg">
					<div class="inbox_people">
						<div class="headind_srch">
							<div class="recent_heading">
								<h4 style="color: #000;">Pesan</h4>

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
												echo '<p style="color: #000; font-size: 11px;">Penjual</p>';
											}elseif($value['flag'] == 2){
												echo '<p style="color: #000; font-size: 11px;">Admin</p>';
											} 
											?>
											<h5>
												<?php 
												echo readMore(strtoupper($value['nama']),20); 
												echo '<span class="count-pesan-'.$value['id_group'].'">';
												if ($value['count_not_read'] > 0) {
													echo '<span style="background:#eb5050;" class="badge">'.$value['count_not_read'].'</span>';
												}
												echo '</span>';
												?> 
												<p style="font-size: 10px; font-weight: 500">
													<?php 
													if ($value['to_umkm']) {
														echo '<i style="color: #000">Ke : '.$value['to_umkm'].'</i><br>';
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
										<!-- <h3 style="color: #000">Selamat Datang di Fitur</h3> -->
										<h1 style="color: #000"><span>P</span><span>E</span><span>S</span><span>A</span><SPAN>N</SPAN></h1>
									</div>
									<h2 style="color: #000">Silakan memilih pesan untuk memulai percakapan</h2>
								</div>
							</div>
						</center>
					</div>
				</div>
			</div>
    	</div>
	</div>
</div>

<?php
	$this->load->view('js'); 
?>