<style type="text/css">
	.dataTable thead .sorting_desc:after{
		content: ' ' !important;
	}
</style>
<div class="container container-240 shop-collection">
    <ul class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>">Beranda</a></li>
        <li><a href="<?php echo base_url('list-umkm'); ?>">Toko</a></li>
        <li class="active"><?php echo $umkm->namausaha; ?></li>
    </ul>

    <div class="container profile-container">
    	<div class="profile-env">
			<header class="row">
	            <div class="col-sm-2">
	                <a href="javascript:void(0)" class="profile-picture">
	                	<?php if ($umkm->logo_umkm) { ?>
	                    	<img src="<?php echo base_url('assets/logo/'.$umkm->logo_umkm) ?>" class="img-responsive img-circle">
	                	<?php }else{ 
	                		$i = strtoupper(substr($umkm->namausaha,0,1));
	                		echo '<div class="img-circle icon-foto-umkm btn-gradient"><span>'.$i.'</span></div>';
	                	} ?>
	                </a>
	            </div>
	            <div class="col-sm-10">
	                <div class="profile-info-sections">
	                    <div class="col-md-6 col-sm-6 col-xs-12">
	                        <div class="profile-name">
	                        	<div class="col-md-12 col-sm-12 col-xs-12">
		                            <strong>
		                                <a href="javascript:void(0)">
		                                	<?php 
		                                	echo ($umkm->id_status == 1) ? $umkm->namausaha.' <i class="fa fa-check-circle fa-gradient" title="Terverifikasi"></i>' : $umkm->namausaha;

		                                	?>		
		                                </a>
		                            </strong>
		                            <span>
		                                <i class="fa fa-map-marker"></i> <?php echo $umkm->nama_kel; ?>
		                            </span>
		                            <span>
		                            	<span class="label label-info" style="display: inline;font-size: 10px;">
		                            	Terakhir dilihat : <?php echo ($umkm->last_login) ? indonesian_date($umkm->last_login) : 'Belum Pernah Login'; ?>
		                            	</span>
		                            </span>
		                            <span>
		                            	<?php 
		                            	if($this->user_model->is_login()){
											if($this->session->identity != $umkm->username){
												echo '<button type="button" class="btn btn-submit btn-gradient2"  onclick="hubungi_pesan('.$umkm->id_umkm.')">Chat Penjual</button>';
											}					
										}
								 		?>
		                            	<button type="button" class="btn btn-submit btn-info-toko" data-toggle="modal" data-target="#exampleModal">Info Toko</button>
									</span>
								</div>
	                        </div>
	                    </div>
	                    <div class="col-md-6 col-sm-6 col-xs-12">
	                        <div class="profile-name">
	                        	<div class="col-md-12 col-sm-12 col-xs-12">
	                        		<span style=" margin-bottom: 0px;">Produk Terjual</span>
		                            <?php echo ($umkm->jum_produk_terjual) ? '<span style="font-size: 25px; font-weight: 700;">'.rp($umkm->jum_produk_terjual).'</span>' : '<span style="font-size: 12px; font-weight: 500;">Belum ada produk terjual</span>'; ?>
		                            
	                        	</div>
	                            
	                        	<div class="col-md-12 col-sm-12 col-xs-12">
	                        		 <span style="margin-bottom: 0px;">Nilai Kualitas Produk</span>
	                           
									<div class="product-rating bd-rating" style="display: block;font-size: 25px;">
							            <?php 
							            $jumlah = 5 - $umkm->ratting;
									    $icon_star = ''; 
									    for($i=0; $i<$umkm->ratting; $i++){
									        echo '<i class="fa fa-star star"></i>';
									    }

									    for($i=0; $i<$jumlah; $i++){
									        echo '<i class="fa fa-star-o star"></i>';
									    }
							            ?>
							        </div>  
		                            <span style="font-size: 12px; display: inline;">
		                                (<?php echo ($umkm->jum_ulasan) ? rp($umkm->jum_ulasan).' Ulasan' : 'Belum ada ulasan'; ?>)
		                            </span>
		                            <span style="float: right;">
		                            <?php 
	                        		$html_bagikan = "<div class='a2a_kit a2a_kit_size_32 a2a_default_style row' style='margin:2px;'>
														<a class='a2a_button_facebook'></a>
														<a class='a2a_button_twitter'></a>
														<a class='a2a_button_email'></a>
														<a class='a2a_button_whatsapp'></a>
														<a class='a2a_button_line'></a>
														<a class='a2a_button_copy_link'></a>
													</div>
													<script async src='https://static.addtoany.com/menu/page.js'></script>";
									echo '<a href="javascript:void(0)" style="display:flex !important;" tabindex="0" class="my-btn-icon btn-icon" role="button" data-html="true" data-trigger="focus" data-toggle="popover" title="Bagikan" data-placement="bottom" data-content="'.$html_bagikan.'">
											<i class="fa fa-share-alt fa-gradient2" title="Bagikan"></i>
										</a>';
	                        		?>
	                        		</span>
	                        	</div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </header>
		</div>
	</div>

  	<ul class="product-tab-sw2 my-tab">
    	<li class="tab-produk active"><a data-toggle="tab" href="#produk" aria-expanded="false">Produk</a></li>
    	<li class="tab-ulasan"><a data-toggle="tab" href="#ulasan" aria-expanded="false">Ulasan</a></li>
  	</ul>

	<!-- Tab panes -->
	<div class="tab-content">
	    <div id="produk" class="tab-pane fade active in">
	    	<div class="filter-collection-left hidden-lg hidden-md" style="margin-top: 20px;">
		      <a class="btn btn-gradient">Filter</a>
		    </div>
		    <div class="row shop-colect" style="margin-top: 20px;">
		        <div class="col-md-3 col-sm-3 col-xs-12 col-left collection-sidebar" id="filter-sidebar">
		            <div class="close-sidebar-collection hidden-lg hidden-md">
		                <span>filter</span><i class="icon_close ion-close"></i>
		            </div>

		            <div class="filter filter-cate">
		            	<h1 class="widget-blog-title" style="padding-top: 17px;">Kategori Produk</h1>
		                <ul class="wiget-content v2">
		                    <?php 
		                    $kat = htmlentities($this->input->get('kat',true), ENT_QUOTES, 'UTF-8');
		                    if (!$kat) {
		                        $class = 'active-menu';
		                    }else{
		                        $class = '';
		                    }

		                    echo '<li class="active"><a href="javascript:void(0);" onclick="set_url(`kat`,``,`'.$kat.'`)" class="'.$class.'">Semua Kategori</a></li>';

		                    foreach ($kategori as $value) {
		                        $url_kat = url($value->nama_usaha);
		                        if ($kat === $url_kat) {
		                            $class = 'active-menu';
		                        }else{
		                            $class = '';
		                        }
		                        echo '<li class="active">
		                                <a href="javascript:void(0);" onclick="set_url(`kat`,`'.$url_kat.'`,`'.$kat.'`)" class="'.$class.'"><img src="'.base_url().'assets/images/kategori/'.$value->icon.'" style="width:20px;" alt="icon"> '.$value->nama_usaha.'</a>
		                              </li>';
		                    }
		                    ?>
		                </ul>
		            </div>
				</div>

		        <div class="col-md-9 col-sm-12 col-xs-12 collection-list">
		            <div class="e-product">
		                <div class="pd-top">
		                    <h1 class="title">Semua Produk</h1>
		                    <div class="show-element"><span><?= 'Menampilkan '.rp($count_s).'-'.rp($count_e).' dari '.rp($count_all).' data'; ?></span></div>
		                </div>

		                <div class="pd-middle">
		                    <div class="view-mode col-md-4" style="margin-bottom: 15px;">
		                        <div class="input-group col-md-12 col-sm-12 col-xs-12" style="">
		                        	<?php $cari = htmlentities($this->input->get('cari',true), ENT_QUOTES, 'UTF-8'); ?>
		                            <input type="hidden" class="form-control" id="cari_produk_kategori_old" value="<?php echo $cari; ?>">
		                            <input type="text" class="form-control" id="cari_produk_kategori" placeholder="Cari produk di toko ini" value="<?php echo $cari; ?>" style="border-radius: 20px;">
		                            <div class="input-group-btn" style="">
		                              <button class="btn btn-blue" id="btn_cari_produk_kategori" type="button" style="border-radius: 20px;">
		                                <i class="glyphicon glyphicon-search"></i>
		                              </button>
		                            </div>
		                        </div>
		                    </div>
		                    <div class="pd-sort">
		                        <div class="filter-sort">
		                            <div class="dropdown">
		                              <button class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
		                                    <?php 
		                                    $ob = htmlentities($this->input->get('ob',true), ENT_QUOTES, 'UTF-8');
		                                    if ($ob != '') {
		                                        echo '<span class="dropdown-label">'.str_replace('_', ' ', $ob).'</span>';
		                                    }else{
		                                        echo '<span class="dropdown-label">Urutkan</span>';
		                                    }
		                                    ?>
		                              </button>
		                              <ul class="dropdown-menu">
		                                  <li><a href="javascript:void(0);"onclick="set_url(`ob`,`Terfavorit`,`<?php echo $ob; ?>`)">Terfavorit</a></li>   
		                                  <li><a href="javascript:void(0);"onclick="set_url(`ob`,`Penjualan_Terbaik`,`<?php echo $ob; ?>`)">Penjualan Terbaik</a></li>
		                                  <li><a href="javascript:void(0);"onclick="set_url(`ob`,`Abjad,_A-Z`,`<?php echo $ob; ?>`)">Abjad, A-Z</a></li>
		                                  <li><a href="javascript:void(0);"onclick="set_url(`ob`,`Abjad,_Z-A`,`<?php echo $ob; ?>`)">Abjad, Z-A</a></li>
		                                  <li><a href="javascript:void(0);"onclick="set_url(`ob`,`Harga,_termahal-termurah`,`<?php echo $ob; ?>`)">Harga, termahal - termurah</a></li>
		                                  <li><a href="javascript:void(0);"onclick="set_url(`ob`,`Harga,_termurah-termahal`,`<?php echo $ob; ?>`)">Harga, termurah - termahal</a></li>
		                                  <li><a href="javascript:void(0);"onclick="set_url(`ob`,`Tanggal,_terlama-terbaru`,`<?php echo $ob; ?>`)">Tanggal, terlama - terbaru</a></li>
		                                  <li><a href="javascript:void(0);"onclick="set_url(`ob`,`Tanggal,_terbaru-terlama`,`<?php echo $ob; ?>`)">Tanggal, terbaru - terlama</a></li>
		                              </ul>
		                            </div>
		                        </div>
		                        <div class="filter-show">
		                            <div class="dropdown">
		                                  <button class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
		                                      Menampilkan
		                                        <?php
		                                        $limit = htmlentities($this->input->get('limit',true), ENT_QUOTES, 'UTF-8'); 
		                                        if ($limit != '') {
		                                            echo '<span class="dropdown-label">'.$limit.'</span>';
		                                        }else{
		                                            echo '<span class="dropdown-label">12</span>';
		                                        } ?>
		                                  </button>
		                                  <ul class="dropdown-menu">
		                                      <li><a href="javascript:void(0);" onclick="set_url('limit','12','<?php echo $limit; ?>')">12</a></li>   
		                                      <li><a href="javascript:void(0);" onclick="set_url('limit','24','<?php echo $limit; ?>')">24</a></li>
		                                      <li><a href="javascript:void(0);" onclick="set_url('limit','36','<?php echo $limit; ?>')">36</a></li>
		                                      <li><a href="javascript:void(0);" onclick="set_url('limit','48','<?php echo $limit; ?>')">48</a></li>
		                                  </ul>
		                            </div>
		                        </div>
		                    </div>
		                </div>

		                <div class="row engoc-equal-row">
		                	<?php 
		                	if ($produk) {
		                		foreach ($produk as $value) {
		                			echo card_produk($value,'col-xs-12 col-sm-6 col-md-4 product-grid product-grid-v2');
		                		}
		                	}else{
		                		if ($cari !== '' || $kat !== '') {
		                		 	$msg = 'Produk tidak ditemukan !';
		                		}else{
		                			$msg = 'Toko tidak memiliki produk !';
		                		} 
		                	?>
		                		<div class="col-xs-12 col-sm-12 col-md-12">
			                		<div class="shopping-cart v2 bd-7">
				                        <div class="cmt-title text-center abs">
				                            <h1 class="page-title v4">Oppss..</h1>
				                            <div class="w-empty">
				                                <p><?php echo $msg; ?></p>
				                            </div>
				                        </div>
				                    </div>
			                	</div>
		                	<?php } ?>
						</div>

		                <div class="pd-middle space-v1">
		                    <!--Tampilkan pagination-->
		                    <?php echo $pagination; ?>
		                </div>
		            </div>
		        </div>
		    </div>
	    </div>
	    <div id="ulasan" class="tab-pane fade">
	    	<div class="row shop-colect" style="margin-top: 20px;">
	    		<div class="col-md-12 col-sm-12 col-xs-12">
	    			<table class="table table-hover" id="tabel-ulasan" width="100%">
						<tbody>

						</tbody>
					</table>
	    		</div>
	    	</div>
	    </div>
	</div>
	
</div>
<!-- /section -->


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="exampleModalLabel"><?php echo text($umkm->namausaha); ?></h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class='col-md-6 col-sm-6 col-xs-12'>
		                <div class='form-group'>
	                    	<label>Nama Usaha</label> <br>
	                    	<span><?php echo text($umkm->namausaha); ?></span>
	                  	</div>

	                  	<div class='form-group'>
	                    	<label>Kategori</label> <br>
	                    	<span><?php echo ($umkm->nama_usaha) ? $umkm->nama_usaha : '-';?></span>
	                  	</div>

	                  	<div class='form-group'>
	                    	<label>Kelurahan</label> <br>
	                    	<span><?php echo ($umkm->nama_kel) ? text($umkm->nama_kel) : '-'; ?></span>
	                  	</div>

	                  	<div class='form-group'>
	                    	<label>Kecamatan</label> <br>
	                    	<span><?php echo ($umkm->nama_kec) ? text($umkm->nama_kec) : '-'; ?></span>
	                  	</div>

	                  	<div class='form-group'>
	                    	<label>Alamat</label> <br>
	                    	<span><?php echo ($umkm->alamat) ? $umkm->alamat : '-'; ?></span>
	                  	</div>

	                  	<div class='form-group'>
	                    	<label>Ratting</label> <br>
	                    	<span>
	                    		<div class="product-rating bd-rating" style="display: block;font-size: 20px;">
						            <?php 
						            $jumlah = 5 - $umkm->ratting;
								    $icon_star = ''; 
								    for($i=0; $i<$umkm->ratting; $i++){
								        echo '<i class="fa fa-star star"></i>';
								    }

								    for($i=0; $i<$jumlah; $i++){
								        echo '<i class="fa fa-star-o star"></i>';
								    }
						            ?>
						        </div> 
						        <p>(<?php echo ($umkm->jum_ulasan) ? rp($umkm->jum_ulasan).' Ulasan' : 'Belum ada ulasan'; ?>)</p> 
	                    	</span>
	                  	</div>
					</div>
					<div class='col-md-6 col-sm-6 col-xs-12'>
						<div class='form-group'>
	                    	<label>Toko Online</label> <br>
	                    	<span>
	                    		<?php 
	                           	$toko_online = '-';
	                           	if ($umkm->situs_web) {
	                           		if (isJSON($umkm->situs_web)) {
										$array_situs_web = json_decode($umkm->situs_web);
										$toko_online = '';
										foreach ($array_situs_web as $row) {
											$toko_online .= '<b>'.$row->nama_ecommerce.'</b><br><a href="'.$row->keterangan_ecommerce.'">'.$row->keterangan_ecommerce.'</a><br>';
										}
									}
	                           	}

	                           	echo $toko_online;
	                           	?>
	                    	</span>
	                  	</div>

	                  	<div class='form-group'>
	                    	<label>Ojek Online</label> <br>
	                    	<span>
	                    		<?php 
	                           	$ojol = '-';
	                           	if ($umkm->ojol) {
	                           		if (isJSON($umkm->ojol)) {
										$array_ojol = json_decode($umkm->ojol);
										$ojol = '';
										foreach ($array_ojol as $row) {
											$ojol .= '<b>'.$row->nama_ojol.'</b><br><a href="'.$row->keterangan_ojol.'">'.$row->keterangan_ojol.'</a><br>';
										}
									}
	                           	}

	                           	echo $ojol;
	                           	?>
	                    	</span>
	                  	</div>

	                  	<div class='form-group'>
	                    	<label>Sosial Media</label> <br>
	                    	<span>
	                    		<?php 
	                           	$sosmed = '-';
	                           	if ($umkm->sosmed) {
	                           		if (isJSON($umkm->sosmed)) {
										$array_sosmed = json_decode($umkm->sosmed);
										$sosmed = '';
										foreach ($array_sosmed as $row) {
											$sosmed .= '<b>'.$row->nama_medsos.'</b><br><a href="'.$row->keterangan_medsos.'">'.$row->keterangan_medsos.'</a><br>';
										}
									}
	                           	}

	                           	echo $sosmed;
	                           	?>
							</span>
	                  	</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
			</div>
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

<script type="text/javascript">
	var table;
    $(document).ready(function() {
      	$('[data-toggle="popover"]').popover();
    });

    $(".my-tab .tab-produk").click(function(){
    	set_tabs_height('produk');
	});

    var c = 0;
    $(".my-tab .tab-ulasan").click(function(){
    	if (c>0) {
    		$('#tabel-ulasan').DataTable().destroy();
    	}
    	c=1;

		table = $('#tabel-ulasan').DataTable( {
            paginationType:'full_numbers',
            processing: true,
            serverSide: true,
            filter: false,
            autoWidth:false,
            scrollX: true,
            width:'100%',
            aLengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
            ajax: {
                url: '<?php echo base_url('list_umkm/ajax_list')?>',
                type: 'POST',
                async:false,
                data: function (data) {
                    data.filter = {
                        'id_umkm' : '<?php echo $umkm->id_umkm; ?>',
                    };
                    data.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
                    data.type = 'ulasan_umkm';
                },
            },
            language: {
                sProcessing: 'Sedang memproses...',
                sLengthMenu: 'Tampilkan _MENU_ entri',
                sZeroRecords: 'Tidak ada ulasan',
                sInfo: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ entri',
                sInfoEmpty: 'Menampilkan 0 sampai 0 dari 0 entri',
                sInfoFiltered: '(disaring dari _MAX_ entri keseluruhan)',
                sInfoPostFix: '',
                sSearch: 'Cari:',
                sUrl: '',
                oPaginate: {
                    sFirst: '<<',
                    sPrevious: '<',
                    sNext: '>',
                    sLast: '>>'
                }
            },
            order: [0, 'desc'],
            columns: [
                {'data':'dt','orderable':false,className: "text-left"},
            ],
        });
		
		set_tabs_height('ulasan');

		$('#tabel-ulasan').on( 'length.dt', function ( e, settings, len ) {
		    set_tabs_height('ulasan');
		});
	});

	function set_tabs_height(param=null){
     	if (param) {
     		var maxHeight= $('#'+param+' .shop-colect').outerHeight() + 50;
     	}else{
     		var maxHeight=0;
     	}
	
		$(".tab-content .tab-pane .shop-colect").each(function(){
		   	var height = $(this).height();
		    maxHeight = height==maxHeight?height:maxHeight;
		});
		
		$(".tab-content").height(maxHeight);
	}

    $('#btn_cari_produk_kategori').click(function() {
        var cari = $('#cari_produk_kategori').val();
        var cari_old = $('#cari_produk_kategori_old').val();
        set_url('cari',cari,cari_old);
    });

    $('#cari_produk_kategori').keyup(function(e){
        if(e.keyCode == 13){
            var cari = $('#cari_produk_kategori').val();
            var cari_old = $('#cari_produk_kategori_old').val();
            set_url('cari',cari,cari_old);
        }
    });

    function set_url(param,new_value='',old_value=null) {
        if(document.location.href.includes('?')) {
            var separator = '&';
        }else{
            var separator = '?';
        }

        if (document.location.href.includes(param)) {
            var url = document.location.href.replace(param+"="+encodeURIComponent(old_value), param+"="+encodeURIComponent(new_value));
        }else{
            var url = document.location.href+""+separator+""+param+"="+encodeURIComponent(new_value);
        }

        document.location = url;
    }

    function hubungi_pesan(id_umkm)
    {
        $.ajax({
            url : '<?php echo site_url("ajax/ajax_data"); ?>',
            type: 'post',
            data: {
                type        : 'buka_pesan',
                id_umkm     : id_umkm,
                <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            success: function (res) {
                var obj = JSON.parse(res);
                if(obj.status)
                {
                    $('#modal_chat').modal('show');
                    var nama = obj.umkm.namausaha;
                    $('#modal_chat .modal-title').text('TOKO '+nama.toUpperCase());
                    $('#modal_chat .last_login').text('Terakhir dilihat : '+(obj.umkm.last_login) ? obj.umkm.last_login : 'Belum pernah dilihat');
                    $('.data_pesan').empty('');
                    $('.data_pesan').load('<?=base_url('list_produk/pesan/');?>'+obj.id_group+'/hapus', function(data, status){});
                } else {
                    Swal.fire({
                        type: 'error',
                        text: 'Pengambilan data pesan gagal, silahkan coba beberapa saat lagi',
                        title : '',
                        button: true,
                        timer: 3000
                    });
                }
            }
        });
    }

    function detail_chat(id_group,id=null)
    {
        $('.data_pesan').empty('');
        $('.data_pesan').load('<?=base_url('list_produk/pesan/');?>'+id_group+'/'+id+'/hapus', function(data, status){});
    }
</script>