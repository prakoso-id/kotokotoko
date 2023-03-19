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

<div class="container container-240">
    <ul class="breadcrumb v3">
        <li><a href="<?php echo base_url(); ?>">Beranda</a></li>
        <li class="active">Pesan</li>
    </ul>
    <div class="row" style="margin-bottom: 20px;">
    	<div class="col-md-12">
    		<div class="cmt-title text-center abs">
                <h1 class="page-title v1">Pesan</h1>
            </div>

    		<button class="btn" style="float: right; margin-bottom: 10px;" onclick="refresh()">
				<i class="fa fa-refresh"></i> Refresh
			</button>
			<div class="messaging" style="margin-bottom: 30px;">
				<div class="inbox_msg">
					<div class="inbox_people">
						<div class="headind_srch">
							<div class="recent_heading">
								<h4 style="color: #AB2828;">Pesan</h4>

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
												echo '<p style="color: #AB2828; font-size: 11px;">Penjual</p>';
											}elseif($value['flag'] == 2){
												echo '<p style="color: #AB2828; font-size: 11px;">Admin</p>';
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
										<h3 style="color: #AB2828">Selamat Datang di Fitur</h3>
										<h1 style="color: #AB2828"><span>P</span><span>E</span><span>S</span><span>A</span><SPAN>N</SPAN></h1>
									</div>
									<h2 style="color: #AB2828">Silakan memilih pesan untuk memulai percakapan</h2>
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