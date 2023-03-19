<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<base href="<?php echo base_url(); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<link rel="shortcut icon" href="assets/images/logo.png">
	<?php echo $meta_tag; ?>
	<title><?php echo $site_title; ?></title>
	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Hind:400,700" rel="stylesheet">

	<!-- Bootstrap -->
	<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css');?>" />

	<!-- Slick -->
	<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/css/slick.css');?>" />
	<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/css/slick-theme.css');?>" />

	<!-- nouislider -->
	<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/css/nouislider.min.css');?>" />

	<!-- Font Awesome Icon -->
	<link rel="stylesheet" href="<?php echo base_url('assets/css/font-awesome.min.cs');?>s">

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/css/style.css');?>" />
	<link rel="stylesheet" href="<?php echo base_url('assets/css/icons/icomoon/styles.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/components.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/colors.css');?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/wtf-forms.css');?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/select2/select2.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/sweetalert2/sweetalert2.css') ?>">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- Google Font: Source Sans Pro -->
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
<?php echo $styles; ?>
<!-- todo: pindah ke bawah lg -->
<script src="<?php echo base_url('assets/js/jquery.min.js');?>"></script>
<!-- //todo: sementaun -->
<?php echo $scripts_header; ?>
</head>
<style type="text/css">
	#loading {
			position:   fixed;
			z-index:    9000;
			top:        0;
			left:       0;
			height:     100%;
			width:      100%;
			background: rgba( 255, 255, 255, 1 )
			url('<?php echo base_url('assets/images/loader.gif'); ?>')
			50% 50%
			no-repeat;
			opacity: 0.5;
		}
	.active p {
		color: #000 !important;
	}
</style>
<body>
	<div id="loading"></div>
	<?php
		$this->load->view('templates/header');
	?>
	<!-- NAVIGATION -->
	<div id="navigation">
		<!-- container -->
		<div class="container">
			<div id="responsive-nav">
				<!-- category nav -->
				<div class="category-nav show-on-click">
					<span class="category-header">Kategori <i class="fa fa-list"></i></span>
					<ul class="category-list">
						<?php
						$url = $this->uri->segment(3);
						foreach ($kategori as $value) {
							if($url == url($value->nama_usaha))
							{
								echo '
							 		<li  class="active"><a href="'.base_url('list-produk/kategori/'.url($value->nama_usaha)).'">'.$value->nama_usaha.'</a></li>
							 	';
							}else{
								echo '
							 		<li><a href="'.base_url('list-produk/kategori/'.url($value->nama_usaha)).'">'.$value->nama_usaha.'</a></li>
							 	';
							}
						 } 
						?>
					</ul>
				</div>
				<!-- /category nav -->

				<?php
					echo $this->load->view('templates/menu');
				?>
			</div>
		</div>
		<!-- /container -->
	</div>
	<!-- /NAVIGATION -->

	<?php 
	if(!isset($slider)):
	?>
	<!-- NAVIGATION -->
	<div id="navigation-banner">
		<!-- container -->
		<div class="container">
			<div>
				<!-- category nav -->
				<div class="category-nav">
					<span class="category-header">
						<h3 style="color: white;"><?php echo @$title_beranda; ?></h3>
						<?php
						if(isset($umkm->namausaha))
						{
							?>
							<span style="display: block;font-size: 14px;">
								<i class="fa fa-map-marker"></i> &nbsp;&nbsp;<?php echo text($umkm->nama_kel); ?>
							</span>
							<div class="product-rating" style="font-size: 12px; margin-left: 20px; font-weight: 500">
								<?php
									$ratting = get_ratting_umkm($umkm->id_umkm);
									$jumlah = 5 - $ratting; 
									for($i=0; $i<$ratting; $i++)
									{
										echo '<i class="fa fa-star"></i>';
									}

									for($i=0; $i<$jumlah; $i++)
									{
										echo '<i class="fa fa-star-o"></i>';
									}
								?>
								<p>(<?php echo get_jumlah_ulasan($umkm->id_umkm); ?> Ulasan & <?php echo get_jumlah_diskusi($umkm->id_umkm); ?> Diskusi)</p>
								<button class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">Info Toko</button>
							</div>
							<?php
						}
						?>
					</span>
					
				</div>
			</div>
			<!-- menu nav -->
			<div class="menu-nav">
				<div class="menu-list" style="background-image: url('<?php echo base_url('assets/images/banner.png') ?>');">

				</div>
			</div>
			<!-- menu nav -->
		</div>
		<!-- /container -->
	</div>
	<!-- /NAVIGATION -->
	<?php
	endif; 
	?>

	<?php echo $content; ?>

	<?php
		$this->load->view('templates/footer');
	?>
	<div id="modal_login" class="modal fade" data-backdrop="false">
		<div class="modal-dialog modal-login">
			<div class="modal-content">
				<form id="form_login">
					<div class="modal-header">	
						<h5 class="modal-title" id="exampleModalLongTitle"> Form Login</h5>			
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
						<span class="login100-form-title p-b-49" style="text-align: center;display: block;">
							<img src="<?php echo base_url('assets/images/logo.png') ?>" style="width:70px" alt="">
							<br>
							<a href="javascript:void(0);" style="font-size:24px"> 
								LOGIN
								<p>UMKM Kota Tangerang.</p>
							</a>
						</span>
						<div class="form-group">
							<label>Username</label>
							<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
							<input type="text" class="form-control" name="username">
							<span class="help"></span>
						</div>
						<div class="form-group">
							<div class="clearfix">
								<label>Password</label>
							</div>
							<input type="password" name="pass" class="form-control">
							<span class="help"></span>
						</div>
						<div class="form-group">
							<div class="clearfix">
								<label>
									Untuk login UMKM Kota Tangerang menggunakan akun yang terdaftar di Tangerang Live, Aplikasi Tangerang LIVE dapat di download: <a href="https://play.google.com/store/apps/details?id=id.go.tangerangkota.tangeranglive" target="_blank">Google Play Store</a>
								</label>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button onclick="proses_login();" type="button" class="btn btn-primary button_login" style="width: 100%">Login</button>
						<a target="_blank" href="https://tlive.tangerangkota.go.id/registrasi" class="btn btn-info" style="width: 100%;margin-top: 10px;">Daftar Tangerang Live</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(window).on('load', function () {
        	$("#loading").fadeOut("fast");
        });

		function history(id)
		{
			$.ajax({
				url : '<?php echo base_url("dashboard/ajax_ubah"); ?>',
				type: 'post',
				data: {
					id: id,
					type : 'history',
					<?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
				},

				success: function (res) {
					var obj = JSON.parse(res);
					
				}
			});
		}

		function wishlist(id)
		{	
			$.ajax({
				url : "<?php echo base_url('ajax/ajax_data/')?>",
				type: "POST",
				data : {
					type : 'wishlist',
					<?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>',
					id : id
				},
				dataType: "JSON",
				success: function(data){
					if(data.success)
					{
						
						if(data.status == 'like')
						{
							$('.'+id).attr('style','color:#e95a5c');
							notif_sukses('wishlist','tambah');
						}else{
							$('.'+id).removeAttr('style','color:#e95a5c');
							notif_sukses('wishlist','hapus');
							location.reload();
						}
					}else{

						swal.fire({
		        			title: "Perhatian",
		        			text: "Untuk Wishlist Produk, Harap Login Terlebih dahulu.",
		        			type: "error",
		        			confirmButtonText: "Login"
						}).then((result) => {
                        	if (result.value) {
                        		// login();
                        		window.location.href = "<?php echo base_url('login'); ?>";
                        	}
                        });
					}
				},
				error: function (jqXHR, textStatus, errorThrown){
					alert('Error get data from ajax');
				}
			});
		}

		function add_chart(id,type)
		{	
			$.ajax({
				url : "<?php echo base_url('ajax/ajax_data/')?>",
				type: "POST",
				data : {
					status : type,
					type : 'add_chart',
					<?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>',
					id : id
				},
				dataType: "JSON",
				success: function(data){
					if(data.success)
					{
						if(data.status == 'simpan')
						{
							if(data.jml_keranjang == 1)
                            {
                                $('.shopping-cart-list').html('');
                                $('.shopping-cart-list').append(data.keranjang);
                            }else{
                                $('.shopping-cart-list').append(data.keranjang);
                            }
							$('.jumlah_keranjang').text(data.jml_keranjang);
							notif_sukses('keranjang','tambah');
						}else if(data.status == 'hapus')
						{
							$('.shopping-cart-list > .'+id).remove();
							$('.jumlah_keranjang').text(data.jml_keranjang);
							notif_sukses('keranjang','hapus');
						}

					}else{
						swal.fire({
		        			title: "Perhatian",
		        			text: "Untuk Menambahkan Ke Keranjang, Harap Login Terlebih dahulu.",
		        			type: "error",
		        			confirmButtonText: "Login"
						}).then((result) => {
                        	if (result.value) {
                        		// login();
                        		window.location.href = "<?php echo base_url('login'); ?>";
                        	}
                        });
					}
				},
				error: function (jqXHR, textStatus, errorThrown){
					alert('Error get data from ajax');
				}
			});
		}

		function beli_chart(id,type)
		{	
			$.ajax({
				url : "<?php echo base_url('ajax/ajax_data/')?>",
				type: "POST",
				data : {
					status : type,
					type : 'beli_chart',
					<?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>',
					id : id
				},
				dataType: "JSON",
				success: function(data){
					if(data.success)
					{
						$('.shopping-cart-list').append(data.keranjang);
						$('.jumlah_keranjang').text(data.jml_keranjang);
						window.location.href = "<?php echo base_url('keranjang'); ?>";
					}else{
						swal.fire({
		        			title: "Perhatian",
		        			text: "Untuk Menambahkan Ke Keranjang, Harap Login Terlebih dahulu.",
		        			type: "error",
		        			confirmButtonText: "Login"
						}).then((result) => {
                        	if (result.value) {
                        		// login();
                        		window.location.href = "<?php echo base_url('login'); ?>";
                        	}
                        });
					}
				},
				error: function (jqXHR, textStatus, errorThrown){
					alert('Error get data from ajax');
				}
			});
		}

		function login()
		{
			$('#modal_login').modal('show');
		}

		function proses_login()
	    {
	        $('.button_login').text('sedang memproses...'); //change button text
	        $('.button_login').attr('disabled',true); //set button disable
	        $('.form-group').removeClass('has-error');
	        $('.help').empty();
	                
	        var form = $('#form_login')[0];
	        var data = new FormData(form);

	        var url = '<?php echo base_url("login/ajax_proses"); ?>';
	        $.ajax({
                url: url,
                type: 'post',
                data: data,
                processData:false,
                contentType:false,
                cache:false,
                success: function (res) {
                    var obj = JSON.parse(res);
                    if(obj.status)
                    {
                        if (obj.success !== true) {
                            swal.fire({
                                text: obj.message,
                                title: "",
                                type: "error",
                                button: true,
                                timer: 3000
                            });
                        }
                        else {
                            swal.fire({
                                text: obj.message,
                                title: "",
                                type: "success",
                                button: true,
                            }).then((result) => {
                        		if (result.value) {
                                    $('#modal_pendaftaran').modal('hide');
                                    location.reload();
                                }
                            });
                        }
                        $('.button_login').text('Login'); //change button text
                        $('.button_login').attr('disabled',false); //set button enable
                    }
                    else {
                        for (var i = 0; i < obj.inputerror.length; i++) 
                        {
                            $('[name="'+obj.inputerror[i]+'"]').parent().parent().addClass('has-error');
                            $('[name="'+obj.inputerror[i]+'"]').next().text(obj.error_string[i]); 
                        }
                        swal.fire({
                            type: 'error',
                            text: 'Proses Simpan Gagal, Silahkan Melengkapi Data Yang Harus Diisi',
                            title : '',
                            button: true,
                            timer: 3000
                        });
                        $('.button_login').text('Login'); //change button text
                        $('.button_login').attr('disabled',false); //set button enable
                    }
                }
            });
	    }

	    function rp(bilangan)
        {
            if(bilangan != null)
            {
                var number_string = bilangan.toString(),
                sisa    = number_string.length % 3,
                rupiah  = number_string.substr(0, sisa),
                ribuan  = number_string.substr(sisa).match(/\d{3}/g);
                        
                if (ribuan) {
                    separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }
            }else{
                rupiah = '';
            }
            

            return rupiah;
        }

	</script>
	<script src="<?php echo base_url('assets/js/jquery.min.js');?>"></script>
	<script src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>
	<script src="<?php echo base_url('assets/js/slick.min.js');?>"></script>
	<script src="<?php echo base_url('assets/js/nouislider.min.js');?>"></script>
	<script src="<?php echo base_url('assets/js/jquery.zoom.min.js');?>"></script>
	<script src="<?php echo base_url('assets/js/main.js');?>"></script>

	<script src="<?php echo base_url('assets/plugins/notifications/sweet_alert.min.js');?>"></script>
	<script src="<?php echo base_url('assets/plugins/sweetalert2/sweetalert2.min.js');?>"></script>
    <!-- Toastr -->
    <script src="<?php echo base_url('assets/plugins/toastr/toastr.min.js');?>"></script>
    <script src="<?php echo base_url('assets/plugins/jQuery/purify.min.js'); ?>"></script>

	<?php echo $scripts_footer; ?>
	<script type="text/javascript">
		const Toast = Swal.mixin({
               toast: true,
               position: 'top-end',
               showConfirmButton: false,
               timer:5000
          });

			function notif_sukses(data,type)
			{	
				if(data == 'wishlist')
				{
					if(type == 'tambah')
					{
						Toast.fire({
							type : 'success',
							title: 'Anda Berhasil Menambah Wishlist',
							text: '',
							timer : 1000
			         	});
					}else if(type == 'hapus')
					{
						Toast.fire({
							type : 'success',
							title: 'Anda Berhasil Menghapus Wishlist',
							text: '',
							timer : 1000
			         	});
					}
				}else if(data == 'keranjang')
				{
					if(type == 'tambah')
					{
						<?php
			         		$url = $this->uri->segment(1);
			         		if($url == 'keranjang')
			         		{
			         	?>
			         			location.reload();
			         	<?php
			         		}
			         	?>
						Toast.fire({
							type : 'success',
							title: 'Anda Berhasil Menambah Keranjang',
							text: '',
							timer : 1000
			         	});
			         	
					}else if(type == 'hapus')
					{
						Toast.fire({
							type : 'success',
							title: 'Anda Berhasil Menghapus Keranjang',
							text: '',
							timer : 1000
			         	});
					}
				}
				
			}
          
	</script>
	<script type="text/javascript">
		function htmlEncode(str){
          return String(str).replace(/[^\w. ]/gi, function(c){
             return '&#'+c.charCodeAt(0)+';';
          });
        }

		function Angkasaja(evt) 
		{
			var charCode = (evt.which) ? evt.which : event.keyCode
			if (charCode > 31 && (charCode < 48 || charCode > 57))
				return false;
			return true;
		}

        function format_uang(bilangan)
        {
            if(bilangan != null)
            {
                var number_string = bilangan.toString(),
                sisa    = number_string.length % 3,
                rupiah  = number_string.substr(0, sisa),
                ribuan  = number_string.substr(sisa).match(/\d{3}/g);
                        
                if (ribuan) {
                    separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }
            }else{
                rupiah = '';
            }
            

            return rupiah;
        }

        $("input[data-type='currency']").on({
            keyup: function() {
                formatCurrency($(this));
            },
            blur: function() { 
                formatCurrency($(this), "blur");
            }
        });
        function formatNumber(n) {
            return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        }
        function formatCurrency(input, blur) {
            var input_val = input.val().replace(/^0+/, '');
            if (input_val === "") { return; }
            var original_len = input_val.length;
            var caret_pos = input.prop("selectionStart");

            if (input_val.indexOf(",") >= 0) {
                var decimal_pos = input_val.indexOf(",");
                var left_side = input_val.substring(0, decimal_pos);
                var right_side = input_val.substring(decimal_pos);

                // add commas to left side of number
                left_side = formatNumber(left_side);

                // validate right side
                right_side = formatNumber(right_side);
                
                // On blur make sure 2 numbers after decimal
                if (blur === "blur") {
                right_side += "";
                }
                
                // Limit decimal to only 2 digits
                right_side = right_side.substring(0, 2);

                // join number by .
                input_val = left_side + "" + right_side;

            } 
            else {
                input_val = formatNumber(input_val);
                input_val = input_val;
                if (blur === "blur") {
                    input_val += "";
                }
            }
            
            input.val(input_val);

            var updated_len = input_val.length;
            caret_pos = updated_len - original_len + caret_pos;
            input[0].setSelectionRange(caret_pos, caret_pos);
        }
	</script>
	<?php 
	if($active == 'detail-agenda'):
	?>
	<link rel="stylesheet" href="https://js.arcgis.com/4.8/esri/css/main.css">
	<script src="https://js.arcgis.com/4.8/"></script>
	<script type="text/javascript">
	    require([
	            "esri/Map",
	            "esri/Graphic", //
	            "esri/views/MapView",
	            "esri/tasks/Locator",
	            "esri/layers/MapImageLayer",
	            "esri/layers/GraphicsLayer", //
	            "esri/widgets/Search",
	            "esri/geometry/Point", //
	            "esri/symbols/SimpleMarkerSymbol", //
	            "dojo/dom",
	            "dojo/on",
	            "dojo/domReady!"
	            ], function(
	              Map,
	              Graphic,
	              MapView,
	              Locator,
	              MapImageLayer,
	              GraphicsLayer,
	              Search,
	              Point,
	              SimpleMarkerSymbol,
	              dom,
	              on
	            ){
	                var TngImageryLyr = new MapImageLayer({
	                    url: "https://maps.tangerangkota.go.id/arcgis/rest/services/Imagery/TangerangImagery/MapServer",
	                    // url: "https://maps.tangerangkota.go.id/arcgis/rest/services/Batas_Adminsitratif/batas_kec_poligon/FeatureServer/0"
	                    id : "tngImagery"
	                });
	                var mapLayer = new GraphicsLayer();
	                var lat = '<?php echo @$berita->lat; ?>';
	                var lng = '<?php echo @$berita->long; ?>'
	                // var lat = +$('[name="lat"]').val();
	                // var lng = +$('[name="long"]').val();
	                if ( ((lat == "")&&(lng == "")) || ((lat == null)&&(lng == null)) || ((lat == 0)&&(lng == 0)) ) {
	                    // Gedung Cisadane
	                    lat = -6.166623799999999;
                    	lng = 106.63083849999998;
	                }
	                map = new Map({
	                    basemap: "osm",
	                    layers: [TngImageryLyr]
	                });

	                view = new MapView({
	                    container: "mapsss",  // Reference to the scene div created in step 5
	                    map: map,  // Reference to the map object created before the scene
	                    zoom: 15,  // Sets zoom level based on level of detail (LOD)
	                    center: [lng,lat]  // Sets center point of view using longitude,latitude
	                });

	                var search = new Search({
	                    sources: [{
	                        locator: new Locator({ url: "https://maps.tangerangkota.go.id/arcgis/rest/services/Locator/tngkota_locators/GeocodeServer"}),
	                        country:"Tangerang",
	                        singleLineFieldName: "SingleLine",
	                        name: "Custom Geocoding Service",
	                        localSearchOptions: {
	                            minScale: 3000,
	                            distance: 500
	                        },
	                        placeholder: "Cari Alamat",
	                        maxResults: 3,
	                        maxSuggestions: 6,
	                        suggestionsEnabled: true,
	                        minSuggestCharacters: 0
	                    }],
	                    view: view,
	                    includeDefaultSources: false
	                });

	                console.log(search);

	                view.ui.add(search, "top-right");

	                view.on("click", function(evt){
	                    search.clear();
	                    view.popup.clear();
	                    if (search.activeSource) {
	                        var geocoder = search.activeSource.locator; // World geocode service
	                        geocoder.locationToAddress(evt.mapPoint)
	                        .then(function(response) { // Show the address found
	                            console.log(JSON.stringify(response));
	                            // console.log("LAT : "+evt.mapPoint.latitude);
	                            // console.log("LNG : "+evt.mapPoint.longitude);
	                            var address = response.address;
	                            var arrAlamat = address.split(', ');
	                            $("#lat").val(evt.mapPoint.latitude);
	                            $("#long").val(evt.mapPoint.longitude);
	                            $("#alamat").val(response.address);
	                            // $("#nama_kel").val(arrAlamat[1]);
	                            // find_kel(arrAlamat[1]);
	                            // $("#nama_kec").val(arrAlamat[2]);
	                            // find_kec(arrAlamat[2]);
	                            showPopup(address, evt.mapPoint);
	                        }, function(err) { // Show no address found
	                            showPopup("No address found.", evt.mapPoint);
	                        });
	                    }
	                });

	                function showPopup(address, pt) {
	                    remarker(point,pt);
	                    view.popup.open({
	                        title:  + Math.round(pt.longitude * 100000)/100000 + "," + Math.round(pt.latitude * 100000)/100000,
	                        content: address,
	                        location: pt
	                    });
	                }

	                function remarker(ptOld,ptNew) {
	                    // Last
	                    mapLayer.graphics.remove(marker);

	                    // New
	                    point.latitude = ptNew.latitude;
	                    point.longitude = ptNew.longitude;
	                    marker = new Graphic({
	                        geometry: point,
	                        symbol: markerSymbol
	                    });
	                    mapLayer.graphics.add(marker);
	                    map.add(mapLayer);
	                }


	                // $.each(lokasi_lapak,function(index,elm){
	                    var point = {
	                        type: "point",  // autocasts as new Point()
	                        longitude: lng,
	                        latitude: lat
	                    };
	                    var markerSymbol = {
	                        type: "picture-marker",  // autocasts as new SimpleMarkerSymbol()
	                        url: 'https://cdn0.iconfinder.com/data/icons/small-n-flat/24/678111-map-marker-512.png',
	                        // url: '<?php echo base_url('assets/images/Sapi.png') ?>',
	                        // url: 'assets/images/Sapi.png',
	                        width: "60px",
	                        height: "60px"
	                    };
	                    var marker = new Graphic({
	                        geometry: point,
	                        symbol: markerSymbol
	                    });
	                    mapLayer.graphics.add(marker);
	                    // mapLayer.graphics.remove(marker);
	                // });

	                map.add(mapLayer);
	            }
	        ); 
	</script>
	<?php
	endif;
	?>
</body>
</html>