<div class="container container-240">
    <div class="single-product-detail product-bundle product-aff" style="margin-bottom: 30px;">
        <ul class="breadcrumb">
            <li><a href="<?php echo base_url() ?>">Beranda</a></li>
			<li><a href="<?php echo base_url('list-produk') ?>">Produk</a></li>
			<li><a href="<?php echo base_url('list-produk/kategori/'.url($produk->nama_usaha)) ?>"><?php echo $produk->nama_usaha; ?></a>
			</li>
			<li class="active"><?php echo text($produk->nama_produk); ?></li>
        </ul>
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="flex product-img-slide" style="height: 449px !important;">
                    <div class="product-images" style="height: 449px !important;">
                        <div class="main-img js-product-slider">
                        	<?php 
                        	foreach ($gallery as $value) {
                        		echo '<a data-fancybox="photo_produk" href="'.base_url('assets/produk/'.$produk->username.'/'.$value->foto).'" class="hover-images effect"><img src="'.base_url('assets/produk/'.$produk->username.'/'.$value->foto).'" alt="photo" class="img-reponsive" style="height: 449px !important;object-fit: cover;"></a>';
                        	}
                        	?>
                        </div>
                        <?php 
                        if ($produk->ojol_toko) {
                        	if (isJSON($produk->ojol_toko)) {
								$array_ojol_toko = json_decode($produk->ojol_toko);
								$ojol = "<ol>";
								foreach ($array_ojol_toko as $row) {
									$ojol .= "<li><b>".$row->nama_ojol."</b><br><a href='".$row->keterangan_ojol."' target='_blank'>".$row->keterangan_ojol."</a></li>";
								}
								$ojol .= "</ol>";

	                        	echo '<div class="e-product-button" title="Link Ojek Online" tabindex="0" role="button" data-html="true" data-trigger="focus" data-toggle="popover" data-placement="bottom" data-content="'.$ojol.'">
				                        <img src="'.base_url().'assets/mytemplate/img/icon_ojol.png" alt="icon">
				                      </div>';
							}
                        }

                        if ($produk->link_eksternal) {
                        	if (isJSON($produk->link_eksternal)) {
								$array_link_eksternal = json_decode($produk->link_eksternal);
								$link_eksternal = "<ol>";
								foreach ($array_link_eksternal as $row) {
									$link_eksternal .= "<li><b>".$row->nama_ecommerce."</b><br><a href='".$row->link_produk."' target='_blank'>".$row->link_produk."</a></li>";
								}
								$link_eksternal .= "</ol>";

				                echo '<div class="e-product-button" title="Link Eksternal" tabindex="0" role="button" data-html="true" data-trigger="focus" data-toggle="popover" data-placement="bottom" data-content="'.$link_eksternal.'">
			                        	<img src="'.base_url().'assets/mytemplate/img/icon_ol_shop.png" alt="icon">
			                        </div>';
							}
                        }

                        if ($produk->link_sosmed) {
                            if (isJSON($produk->link_sosmed)) {
                                $array_link_sosmed = json_decode($produk->link_sosmed);
                                $link_sosmed = "<ol>";
                                foreach ($array_link_sosmed as $row) {
                                    $link_sosmed .= "<li><b>".$row->nama_medsos."</b><br><a href='".$row->link_produk."' target='_blank'>".$row->link_produk."</a></li>";
                                }
                                $link_sosmed .= "</ol>";

                                echo '<div class="e-product-button" title="Link Sosmed" tabindex="0" role="button" data-html="true" data-trigger="focus" data-toggle="popover" data-placement="bottom" data-content="'.$link_sosmed.'">
                                        <i class="fa fa-instagram" style="color: #1F3DB0;"></i>
                                    </div>';
                            }
                        }

                        if ($produk->link_video) {
                            if (isJSON($produk->link_video)) {
                                $array_link_video = json_decode($produk->link_video);
                                for ($i=0; $i < count($array_link_video); $i++) { 
                                    if ($i === 0) {
                                        echo '<div class="e-product-button" data-fancybox="video_produk" href="'.$array_link_video[$i].'"><i class="fa fa-video-camera" style="color: #1F3DB0;"></i></div>';
                                    }else{
                                        echo '<a data-fancybox="video_produk" href="'.$array_link_video[$i].'" style="display:none;"></a>';
                                    }
                                }
                            }
                        }
                        ?>
                    </div>
                    <div class="multiple-img-list-ver2 js-click-product">
                    	<?php 
                    	foreach ($gallery as $value) {
                    		echo '<div class="product-col">
		                            <div class="img active">
		                                <img src="'.base_url('assets/produk/'.$produk->username.'/'.$value->foto).'" alt="photo" class="img-reponsive" style="width: 70px;height: 70px;object-fit: cover;">
		                            </div>
		                        </div>';
                    	}
                    	?>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="single-flex">
                    <div class="single-product-info product-info product-grid-v2 s-50">
                        <p class="product-cate">
                        	<a href="<?php echo base_url('list-produk/kategori/'.url($produk->nama_usaha)) ?>">
                        		<?php echo $produk->nama_usaha; ?>
                        	</a>
                        </p>
                        <div class="product-rating">
                            <?php
	                            $jumlah = 5 - $produk->ratting; 
	                            for($i=0; $i<$produk->ratting; $i++)
	                            {
	                                echo '<i class="fa fa-star star"></i>';
	                            }

	                            for($i=0; $i<$jumlah; $i++)
	                            {
	                                echo '<i class="fa fa-star-o star"></i>';
	                            }
	                        ?>
                            <div class="number-rating">( <?php echo ($produk->jumlah_ulasan)? $produk->jumlah_ulasan : 'Belum Ada'; ?> Ulasan )</div>
                        </div>
                        <h3 class="product-title"><a href="<?php echo base_url('list-produk/produk/'.short($produk->kode_produk)) ?>"><?php echo $produk->nama_produk; ?> </a></h3>
                        <div class="product-price">
							<?php if ($produk->diskon > 0) : ?>
								<span style="color: #fec252;">Rp. <?php echo rp($produk->harga - $produk->diskon_nominal); ?></span>
								<span class="old">Rp. <?php echo rp($produk->harga); ?></span>
							<?php else : ?>
                            	<span style="color: #fec252;"><?php echo "Rp. ".rp($produk->harga);?></span>
							<?php endif; ?>
                        </div>
                        <div style="margin-bottom: 5px;">
                            <label>Terjual :</label><span> <?php echo ($produk->terjual) ? $produk->terjual.' produk' : '-'; ?></span>
                        </div>
                        <div style="margin-bottom: 5px;">
                            <label>Dilihat :</label><span> <?php echo $produk->dilihat.' kali'; ?></span>
                        </div>
                        <div style="margin-bottom: 5px;">
                            <label>Stok :</label><span> <?php echo $produk->stok.' produk'; ?></span>
                        </div>

                        <div class="single-product-button-group" style="margin-top: 10px;">
                        	<?php if ($produk->stok > 0 && $produk->cara_pembayaran != 'langsung') { 
                        		if ($this->session->identity != $produk->nik) { ?>
                        			<div class="e-btn cart-qtt btn-gradient">
		                                <div class="e-quantity">
		                                  <input type="number" maxlength="3" step="1" min="1" max="<?php echo $produk->stok; ?>" name="quantity" id="quantity" value="1" title="Qty" class="qty input-text js-number form-control" size="4" onkeypress="return Angkasaja(event)">
		                               </div>
		                               <a href="javascript:void(0)" onclick="add_to_chart(<?php echo $produk->id_produk; ?>,'add_chart')" class="btn-add-cart" style="font-size: 11px;">+ Keranjang <span class="icon-bg icon-cart v2"></span></a>
		                            </div>
                        		<?php } ?>
							<?php } elseif ($produk->cara_pembayaran == 'langsung') { ?>
                        		<div class="e-btn cart-qtt no-qtt">
                                   <a href="javascript:void(0)" class="btn-add-cart btn-outofstock">Pembayaran Langsung</a>
                                </div>
                        	<?php }else{ ?>
                        		<div class="e-btn cart-qtt no-qtt">
                                   <a href="javascript:void(0)" class="btn-add-cart btn-outofstock">Stok Habis</a>
                                </div>
                        	<?php } ?>
                            
                            <a href="javascript:void(0)" class="e-btn btn-icon" title="Tambahkan ke Favorit" onclick="wishlist('<?php echo $produk->id_produk ?>')">
                            	<?php 
                            	if ($produk->id_wishlist) {
                            		echo '<i class="fa fa-heart wish-'.$produk->id_produk.'" style="color:#e95a5c;"></i>';
                            	}else{
                            		echo '<i class="fa fa-heart-o fa-gradient2 wish-'.$produk->id_produk.'"></i>';
                            	} 
                            	?>
                            </a>
                            <?php 

       //                      if($this->user_model->is_login()){
							// 	if($this->session->identity != $produk->nik){
							// 		echo '<a href="javascript:void(0)" class="e-btn btn-icon" title="Hubungi Penjual" onclick="hubungi_pesan('.$produk->id_produk.','.$produk->username.')">
							// 				<i class="fa fa-comments-o fa-gradient2"></i>
							// 			</a> ';
							// 	}					
							// }
						
                            $html_bagikan = "<div class='a2a_kit a2a_kit_size_32 a2a_default_style row' style='margin:2px;'>
												<a class='a2a_button_facebook' style='padding:2px;'></a>
												<a class='a2a_button_twitter' style='padding:2px;'></a>
												<a class='a2a_button_email' style='padding:2px;'></a>
												<a class='a2a_button_whatsapp' style='padding:2px;'></a>
												<a class='a2a_button_line' style='padding:2px;'></a>
												<a class='a2a_button_copy_link' style='padding:2px;'></a>
											</div>
											<script async src='https://static.addtoany.com/menu/page.js'></script>";
							echo '<a href="javascript:void(0)" tabindex="0" class="e-btn btn-icon" role="button" data-html="true" data-trigger="focus" data-toggle="popover" title="Bagikan" data-placement="bottom" data-content="'.$html_bagikan.'">
									<i class="fa fa-share-alt fa-gradient2" title="Bagikan"></i>
								</a>';
                             ?>
                        </div>

                        <div class="product-tags">
                            <label>Tags :</label>
                            <?php 
                            if ($produk->tags) {
                            	$arr_tags = explode(' , ', $produk->tags);
                            	foreach ($arr_tags as $t) {
                            		echo '<a href="'.base_url().'list-produk?cari='.$t.'">'.$t.'</a> . ';
                            	}
                            }else{
                            	echo "-";
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    	<div class="single-product-tab bd-7">
            <div class="cmt-title text-center abs">
                <ul class="nav nav-tabs text-center v3">
                    <li class="active"><a data-toggle="pill" href="#desc">Deskripsi</a></li>
                    <li><a data-toggle="pill" href="#review">Ulasan</a></li>
                    <li><a data-toggle="pill" href="#discus">Diskusi</a></li>
                </ul>
            </div>
	        <div class="tab-content" style="min-height: 500px; overflow: auto;">
	            <div id="desc" class="tab-pane fade in active">
	                <div class="entry-content">
                        <div class="entry-inside">
                        	<div class="row">
                            <?php echo $produk->deskripsi; ?>
                        	</div>
                        </div>
	                </div>
	            </div>
	            <div id="review" class="tab-pane fade in">
	            	<div class="entry-content">
                        <div class="entry-inside">
			            	<div class="row">
			            		<div class="col-md-12">
			            			<table class="table table-hover" id="tabel-ulasan" width="100%">
										<tbody>

										</tbody>
									</table>
			            		</div>
			            	</div>
			            </div>
			        </div>
	            </div>
	            <div id="discus" class="tab-pane fade in">
	                <div class="entry-content">
                        <div class="entry-inside">
                            <div class="row">
								<div class="col-md-8">
									<table class="table table-hover" id="tabel-diskusi" width="100%">
										<tbody>

										</tbody>
									</table>
								</div>
								<div class="col-md-4">
									<?php
										if($this->user_model->is_login()):
									?>
											<h4 class="text-uppercase">
												Beri Pertanyaan
											</h4>
											<p>Ada pertanyaan ? Diskusikan dengan penjual atau pengguna lain</p>
											<form id="form-diskusi">
												<div class="form-group">
													<input type="hidden" name="id_produk" value="<?php echo $produk->id_produk; ?>">
                                                    <input type="hidden" name="username_umkm" value="<?php echo $produk->nik; ?>">
													<textarea style="resize: none; height: 150px;color: #000;" class="form-control" name="pesan_diskusi" placeholder="Apa yang ingin anda tanyakan mengenai produk ini?"></textarea>
													<input type="hidden" name="pesan">
													<span class="help"></span>
												</div>
												<button class="button_mini btn btn-gradient" type="button" onclick="simpan_diskusi()">Kirim</button>
											</form>
									<?php
										else:
									?>
										<p>Harap <a href="javascript:void(0);" onclick="login_ulasan()" style="color: #1F3DB0"> login </a> terlebih dahulu sebelum mengajukan pertanyaan. </p>		
									<?php
										endif;
									?>
								</div>
							</div>
                        </div>
	                </div>
	            </div>

	        </div>
    	</div>
    </div>
    <div class="bestseller">
        <div class="ecome-heading style5v3 spc5v3" style="margin-bottom: 0px;">
            <h1>Lainnya di toko ini</h1>
            <a href="<?php echo base_url('toko/'.short($produk->id_umkm)) ?>" class="btn-show">Lihat Semua<i class="ion-ios-arrow-forward"></i></a>
        </div>
        <div class="owl-carousel owl-theme owl-cate v2 js-owl-cate">
        	<?php
        	if ($produk_lain) {
        		foreach ($produk_lain as $value) { 
                    echo card_produk($value,'product-grid product-grid-v2');
                }
            }else{
        		echo 'Tidak ditemukan produk lainnya dari toko ini';
        	} ?>
        </div>
    </div>
    <div class="bestseller">
        <div class="ecome-heading style5v3 spc5v3" style="margin-bottom: 0px;">
            <h1>Rekomendasi Produk</h1>
            <a href="<?php echo base_url('list-produk/kategori/'.url($produk->nama_usaha)) ?>" class="btn-show">Lihat Semua<i class="ion-ios-arrow-forward"></i></a>
        </div>
        <div class="owl-carousel owl-theme owl-cate v2 js-owl-cate">
        	<?php
        	if ($rekomendasi) {
        		foreach ($rekomendasi as $value) { 
                    echo card_produk($value,'product-grid product-grid-v2');
                }
            }else{
        		echo 'Tidak ditemukan produk rekomendasi';
        	} ?>
        </div>
    </div>

    <!-- profil umkm -->
    <div class="container profile-container">
    	<div class="profile-env">
			<header class="row">
	            <div class="col-md-1 col-sm-1 col-xs-2">
	                <a href="javascript:void(0)" class="profile-picture">
	                	<?php if ($produk->logo_umkm) { ?>
	                    	<img src="<?php echo base_url('assets/logo/'.$produk->logo_umkm) ?>" class="img-responsive img-circle">
	                	<?php }else{ 
	                		$i = strtoupper(substr($produk->namausaha,0,1));
	                		echo '<div class="img-circle icon-foto-umkm btn-gradient"><span>'.$i.'</span></div>';
	                	} ?>
	                </a>
	            </div>
	            <div class="col-md-11 col-sm-11 col-xs-10">
	                <div class="row profile-info-sections">
	                    
	                        <div class="profile-name" style="margin-left: -10px;">
	                            <strong>
	                                <a href="<?php echo base_url('toko/'.short($produk->id_umkm)); ?>">
	                                	<?php 
	                                	echo ($produk->id_status == 1) ? readMore($produk->namausaha,50).' <i class="fa fa-check-circle fa-gradient" title="Terverifikasi"></i>' : readMore($produk->namausaha,50);

	                                	?>		
	                                </a>
	                            </strong>
	                            <span>
	                                <i class="fa fa-star star"></i> <?php echo (($produk->ratting_toko) ? $produk->ratting_toko : 0) ; ?> rating toko | <i class="fa fa-map-marker"></i> <?php echo $produk->nama_kel; ?>
	                            </span>
                            	<span style="display: inline;font-size: 8px; color: #999;">
                            	Terakhir dilihat : <?php echo ($produk->last_login) ? indonesian_date($produk->last_login) : 'Belum Pernah Login'; ?>
                            	</span>
	                        
	                    
	                        	<span style="float: right;margin: -20px 0px;">
	                            	<?php 
                            		if ($produk->no_hp && $this->session->identity != $produk->nik) {
                            			$explode_no = explode(',', $produk->no_hp); //jika no hp nya banyak
										$no_wa1 = substr($explode_no[0], 1,12);
										$text_wa = base_url().'list-produk/produk/'.$this->uri->segment(3).'%0a Hai *'.trim($produk->namausaha).'* apakah produk *'.trim($produk->nama_produk).'* masih tersedia ?';
										echo  '<button type="button" title="Hubungi Penjual Via Whatsapp" onclick="hubungi_wa(`+62'.$no_wa1.'`,`'.$text_wa.'`)" class="btn btn-submit" style="color: #fff;background-color: #27ae60;"><i class="fa fa-whatsapp"></i> <font class="hidden-xs">Whatsapp</font></button>';
									}

									if($this->user_model->is_login() && $this->session->identity != $produk->nik){
										echo '<button title="Hubungi Penjual" onclick="hubungi_pesan('.$produk->id_produk.','.$produk->username.')" type="button" class="btn btn-submit" style="color: #AB2828;background-color: #fff;"><i class="fa fa-comments-o"></i> <font class="hidden-xs">Chat Penjual</font></button>';
									}
							 		?>
								</span>
							</div>
	                </div>
	            </div>
	        </header>
		</div>
	</div>

</div>

<!-- modal -->
<div id="modal_tambah" class="modal fade" data-backdrop="false">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle"></h5>
			</div>
			<form action="" id="add_tambah">
				<div class="modal-body" style="min-height: 200px !important;">
					<input type="hidden" name=" <?php echo $this->security->get_csrf_token_name(); ?>" value='<?php echo $this->security->get_csrf_hash(); ?>' />
					<input type="hidden" name="id">
                    <input type="hidden" name="username_penanya">
					<input type="hidden" name="type" value="balas_diskusi">
					<div class="form-group">
						<textarea class="form-control" style="resize: none; height: 150px;" name="pesan_diskusi" placeholder="Apa yang ingin anda tanyakan mengenai produk ini?"></textarea>
						<input type="hidden" name="pesan_balasan">
						<span class="help"></span>
					</div>
				</div>

				<div class="modal-footer">
					<button type="button" data-dismiss="modal" class="btn btn-sm" data-dismiss="modal">Tutup</button>
					<button type="button" onclick="simpan_data()" id="btnSave" class="btn btn-sm btn-gradient">
						Simpan
					</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div id="modal_chat" class="modal fade" data-backdrop="false">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">
					
				</h5>
				<center><span style="font-size: 11px;color: #c1c1c1;" class="last_login"></span></center>
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="data_pesan">
					
			</div>
		</div>
	</div>
</div>

<?php 
// if ($produk->no_hp || ($this->user_model->is_login() && $this->session->identity != $produk->nik)) {
// 	echo '<div class="btn-group btn-float" role="group" style="display: block;bottom: 10px;" aria-label="Basic example">';
// 			if ($produk->no_hp) {
// 				$explode_no = explode(',', $produk->no_hp); //jika no hp nya banyak
// 				$no_wa1 = substr($explode_no[0], 1,12);
// 				$text_wa = base_url().'list-produk/produk/'.$this->uri->segment(3).'%0a Hai *'.trim($produk->namausaha).'* apakah produk *'.trim($produk->nama_produk).'* masih tersedia ?';
// 				echo  '<button title="Hubungi Penjual Via Whatsapp" onclick="hubungi_wa(`+62'.$no_wa1.'`,`'.$text_wa.'`)" type="button" class="btn btn-secondary" style="color: #27ae60"><i class="fa fa-whatsapp"></i> Whatsapp</button>';
// 			}

// 		  	if($this->user_model->is_login()){
// 				if($this->session->identity != $produk->nik){
// 					echo '<button title="Hubungi Penjual" onclick="hubungi_pesan('.$produk->id_produk.','.$produk->username.')" type="button" class="btn btn-secondary" style="color: #1F3DB0"><i class="fa fa-comments-o"></i> Chat Penjual</button>';
// 				}
// 			}
		  	
// 	echo '</div>';
// }
$this->load->view('js');
?>
