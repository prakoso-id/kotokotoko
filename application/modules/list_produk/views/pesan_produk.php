<div class="modal-body" style="height: 350px !important; overflow: scroll; overflow-x: hidden;">
	<div class="msg_history">
		<?php
		if(isset($pesan['getpesanmaster'])):
			foreach ($pesan['getpesanmaster'] as $value):
				?>
				<?php
				if($value['username'] == $this->session->identity): //jika sama dengan identity
					?>
					<div class="outgoing_msg">
						<div class="sent_msg">
							<?php
							if($value['id_produk'] != null AND $value['id_produk'] != 0):
							?>
								<div class="row" style="margin-bottom: 10px;">
									<div class="col-md-4 col-sm-12 col-xs-12" style="margin-bottom: 5px;">
										<a href="<?php echo base_url('list-produk/produk/'.short($value['kode_produk'])) ?>"><img src="<?php echo $value['foto']; ?>" alt="" class="img-reponsive img-produk-msg"></a>
									</div>
									<div class="col-md-8 col-sm-12 col-xs-12" >
										<h3 class="product-title"><a href="<?php echo base_url('list-produk/produk/'.short($value['kode_produk'])) ?>"><?php echo readMore($value['nama_produk'],50); ?></a></h3>
									</div>
								</div>
							<?php
							elseif($value['id_transaksi'] != null AND $value['id_transaksi'] != 0):
								$transaksi = pesan_transaksi($value['id_transaksi']);
							?>
								<div class="row" style="margin-bottom: 10px;">
									<div class="col-md-4 col-sm-12 col-xs-12" style="margin-bottom: 5px;">
										<a href="<?php echo base_url('list-produk/produk/'.short($transaksi->kode_produk)) ?>"><img src="<?php echo $transaksi->foto; ?>" alt="" class="img-reponsive img-produk-msg"></a>
									</div>
									<div class="col-md-8 col-sm-12 col-xs-12" >
										<h3 class="product-title"><?php echo strtoupper($transaksi->nama_status); ?></h3>
										<div class="product-price v2"><span><?php echo $transaksi->no_invoice; ?></span></div>
	                                		<div class="product-price v2"><span>Rp. <?php echo rp($transaksi->total); ?></span></div>
									</div>
								</div>
							<?php
							endif;
							?>
							<p> 
								<?php echo $value['pesan']; ?>
							</p>
							<span class="time_date"> <?php echo indonesian_date($value['created_at']); ?></span>
							<span class="time_date"> <?php echo ($value['read_at'])?'Dibaca':''; ?></span>
						</div>
					</div>
					<?php
				else:  //jika beda dengan identity
					?>
					<div class="incoming_msg">
						<div class="received_msg">
							<div class="received_withd_msg">
								<?php
								if($value['id_produk'] != null AND $value['id_produk'] != 0):
								?>
									<div class="row" style="margin-bottom: 10px;">
										<div class="col-md-4 col-sm-12 col-xs-12" style="margin-bottom: 5px;">
											<a href="<?php echo base_url('list-produk/produk/'.short($value['kode_produk'])) ?>"><img src="<?php echo $value['foto']; ?>" alt="" class="img-reponsive img-produk-msg"></a>
										</div>
										<div class="col-md-8 col-sm-12 col-xs-12" >
											<h3 class="product-title"><a href="<?php echo base_url('list-produk/produk/'.short($value['kode_produk'])) ?>"><?php echo readMore($value['nama_produk'],50); ?></a></h3>
										</div>
									</div>
								<?php
								elseif($value['id_transaksi'] != null AND $value['id_transaksi'] != 0):
									$transaksi = pesan_transaksi($value['id_transaksi']);
								?>
									<div class="row" style="margin-bottom: 10px;">
										<div class="col-md-4 col-sm-12 col-xs-12" style="margin-bottom: 5px;">
											<a href="<?php echo base_url('list-produk/produk/'.short($transaksi->kode_produk)) ?>"><img src="<?php echo $transaksi->foto; ?>" alt="" class="img-reponsive img-produk-msg"></a>
										</div>
										<div class="col-md-8 col-sm-12 col-xs-12" >
											<h3 class="product-title"><a href="<?php echo base_url('list-produk/produk/'.short($transaksi->kode_produk)) ?>"><?php echo strtoupper($transaksi->nama_status); ?></a></h3>
											<div class="product-price v2"><span><?php echo $transaksi->no_invoice; ?></span></div>
		                                		<div class="product-price v2"><span>Rp. <?php echo rp($transaksi->total); ?></span></div>
										</div>
									</div>
								<?php
								endif;
								?>
								<p> 
									<?php echo $value['pesan']; ?>
								</p>
								<span class="time_date"> <?php echo indonesian_date($value['created_at']); ?></span>
							</div>
						</div>
					</div>
					
					<?php
				endif;
			endforeach;
		else:
		?>
		<center>Belum ada pesan...</center>
		<?php endif;
		?>
	</div>
	<div style="height: 20px;" id="scrollHeightReference"></div>
</div>
<div class="modal-footer">
	<div class="type_msg" style="border-top: 0px">
		<?php if($produk): ?>
			<div class="produk_preview_hapus">
				<div class="produk_preview ">
					<div class="product product-single" style="width: 100%">
						<div class="e-category" style="padding-bottom: 10px;">
							<div class="cate-item">
	                            <div class="product-img">
	                                <a href="<?php echo base_url('list-produk/produk/'.short($produk->kode_produk)) ?>"><img src="<?php echo $produk->foto; ?>" alt="" class="img-reponsive" style="width: 120px; height: 120px; object-fit:cover; display: block;margin-left: auto; margin-right: auto;"></a>
	                            </div>
	                            <div class="product-info">
	                                <h3 class="product-title"><a href="<?php echo base_url('list-produk/produk/'.short($produk->kode_produk)) ?>"><?php echo $produk->nama_produk; ?></a></h3>
	                                <div class="product-price v2"><span>Rp. <?php echo rp($produk->harga); ?></span></div>
	                                <div class="product-price v2"><span>Stok : <?php echo $produk->stok; ?></span></div>
	                            </div>
	                        </div>
                        </div>
					</div>
				</div>
				<button class="btn btn-danger button_hapus" type="button" onclick="hapus()">
					<i class="fa fa-times" aria-hidden="true"></i>
				</button>
			</div>

		<?php endif; ?>
		<div class="input_msg_write">
			<button type="button" class="btn btn-sm btn-msg-auto" data-msg="Hai ! Apakah produk ini masih tersedia ?">Hai ! Apakah produk ini masih tersedia ?</button> 
			<button type="button" class="btn btn-sm btn-msg-auto" data-msg="Terima kasih !">Terima kasih !</button>

			<input type="hidden" name="id_produk" value="<?php echo @$produk->id_produk; ?>">
			<input type="hidden" name="username" value="<?php echo $this->session->identity; ?>">
			<input type="text" name="pesan_chat" class="write_msg" placeholder="Tulis pesan anda disini." />
			<button class="msg_send_btn" type="button" onclick="kirim_pesan(<?php echo $id_group; ?>)">
				<i class="fa fa-paper-plane-o" aria-hidden="true"></i>
			</button>
		</div>
	</div>
</div>
<script type="text/javascript">
	$('.modal-body').animate({
		scrollTop: $("#scrollHeightReference").offset().top
	}, 2000);

	function kirim_pesan(id_group) {
		$.ajax({
			url : "<?php echo base_url('ajax/ajax_save/')?>",
			type: "POST",
			data : {
				type : 'simpan_pesan',
				<?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>',
				id_produk : $('[name="id_produk"]').val(),
				username : $('[name="username"]').val(),
				pesan : $('[name="pesan_chat"]').val(),
				id_group : id_group,
			},
			dataType: "JSON",
			success: function(data){
				if(data.status)
				{
					detail_chat(id_group,data.id_produk,'hapus');
					$('[name="id_produk"]').val('');
				}else{
					swal.fire({
	        			title: "Perhatian",
	        			text: "Pesan tidak boleh kosong",
	        			type: "warning",
					});
				}
			},
			error: function (jqXHR, textStatus, errorThrown){
				alert('Error get data from ajax');
			}
		});
	}

	function hapus(){
		$('.produk_preview_hapus').empty('');
		$('[name="id_produk"]').val('');
	}

	$('.btn-msg-auto').click(function(event) {
		var text = $(this).attr('data-msg'); 
		var old = $('[name="pesan_chat"]').val();
		$('[name="pesan_chat"]').val(old+' '+text);
	});
</script>