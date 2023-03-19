<style type="text/css">
	.notfound .notfound-404 h1{
		font-size: 160px !important;
	}
	.msg_history {
	    overflow: hidden;
	    height: 595px;
	    overflow-y: scroll;
	}
	.produk-foto {
		background-size: cover !important;
   		height: 100px !important;
	}
	.product-name, .product-price  {
		font-size: 12px !important;
	}
</style>
<div class="product-body">
	<button class="btn btn-success" style="float: right; margin-bottom: 10px;" onclick="refresh()">
		<i class="fa fa-refresh"></i> Refresh
	</button>
	<div class="messaging" style="margin-bottom: 30px;">
		<div class="inbox_msg">
			<div class="inbox_people">
				<div class="headind_srch">
					<div class="recent_heading">
						<h4 style="color: #e95a5c;">Pesan</h4>

					</div>
				</div>
				<div class="inbox_chat">
					<?php
						if(isset($pesan['review'])):
						foreach ($pesan['review'] as $value):
					?>
						<div class="chat_list" onclick="detail_chat(<?php echo $value['id_group'] ?>,<?php echo $value['count_not_read'] ?>)" title="<?php echo $value['nama'] ?>">
							<div class="chat_people">
								<div class="chat_img">
									<?php
										echo get_icon($value['nama']);
									?>
								</div>
								<div class="chat_ib">
									<?php if($value['flag']):?>
										<p style="color: #e95a5c; font-size: 11px;">penjual</p>
									<?php endif; ?>
									<h5>
										<?php 
										echo readMore(strtoupper($value['nama']),20); 
										echo '<span class="count-pesan-'.$value['id_group'].'">';
										if ($value['count_not_read'] > 0) {
											echo '<span style="background:#e95a5c;" class="badge">'.$value['count_not_read'].'</span>';
										}
										echo '</span>';
										?> 
										<p style="font-size: 10px; font-weight: 500">
											<?php echo indonesian_date($value['created_at']); ?>
										</p>
									</h5>
								</div>
							</div>
						</div>
					<?php 
						endforeach;
						endif;
					?>
					
				</div>
			</div>
			<div class="mesgs">
				<center>
					<div id="notfound" style="top: 120px;position: relative;">
						<div class="notfound">
							<div class="notfound-404">
								<h3 style="color: #e95a5c">Selamat Datang di Fitur</h3>
								<h1 style="color: #e95a5c"><span>P</span><span>E</span><span>S</span><span>A</span><SPAN>N</SPAN></h1>
							</div>
							<h2 style="color: #e95a5c">Silakan memilih pesan untuk memulai percakapan</h2>
						</div>
					</div>
				</center>
			</div>
		</div>

	</div>
</div>
<?php
	$this->load->view('js'); 
?>
