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
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/sweetalert/sweetalert.css') ?>">


	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- Google Font: Source Sans Pro -->
<style type="text/css">
	#home .home-wrap {
		margin-left: 320px;
	}
	.dropdown.side-dropdown>.custom-menu{
		width: 0 !important;
	}
	.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
		vertical-align: middle !important;
	}
    .btn {
        margin-top: 5px !important;
        margin-bottom: 5px !important;
    }

    .active p {
        color: #000 !important;
    }
</style>
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

				<!-- /category nav -->

				<?php
					$this->load->view('templates/menu');
				?>
			</div>
		</div>
		<!-- /container -->
	</div>
	<!-- /NAVIGATION -->
	<!-- HOME -->
    <div id="navigation-banner">
        <!-- container -->
        <div class="container">
            <div id="responsive-nav">
                <!-- category nav -->
                <div class="category-nav">
                    <span class="category-header" style="background:none !important;">
                        <?php echo @$title_beranda; ?>
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
    <div id="breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>">Beranda</a></li>
                <li class="active"><?php echo @$title_beranda; ?></li>
            </ul>
        </div>
    </div>
	<div id="home" style="margin-top: 40px;min-height: 600px">
		<!-- container -->
		<div class="container">
			<!-- home wrap -->
            <div class="row">
                <div id="aside" class="col-md-3">
                    <div id="responsive-nav" class="aside">
                        <div class="category-nav" style="float: none !important; width: auto;">
                            <span class="category-header">MENU <i class="fa fa-list"></i></span>
                            <ul class="category-list" style="position: relative !important; width: auto;">
                                <?php
                                if($this->user_model->is_umkm_admin())
                                {
                                    echo '
                                        <li class="'.($active == 'dashboard'?'active':'').'"><a href="'.base_url('dashboard').'">Dashboard</a></li>
                                        <li class="'.($active == 'pengguna'?'active':'').'"><a href="'.base_url('pengguna').'">Pengguna</a></li>
                                        <li class="'.($active == 'umkm'?'active':'').'"><a href="'.base_url('umkm').'">Verifikasi UMKM</a></li>
                                        <li class="'.($active == 'produk'?'active':'').'"><a href="'.base_url('produk').'">Produk</a></li>
                                        <li class="'.($active == 'transaksi_admin'?'active':'').'"><a href="'.base_url('transaksi/admin').'">Transaksi</a></li>
                                        <li class="'.($active == 'slider'?'active':'').'"><a href="'.base_url('slider').'">Slider</a></li>
                                        <li class="'.($active == 'agenda'?'active':'').'"><a href="'.base_url('agenda/data').'">Agenda</a></li>
                                        <li class="'.($active == 'dasar_hukum'?'active':'').'"><a href="'.base_url('dasar_hukum/data').'">Dasar Hukum</a></li>
                                    ';
                                }
                                else if($this->user_model->is_umkm_verifikator())
                                {
                                    echo '
                                        <li class="'.($active == 'dashboard'?'active':'').'"><a href="'.base_url('dashboard').'">Dashboard</a></li>
                                        <li class="'.($active == 'umkm'?'active':'').'"><a href="'.base_url('umkm').'">Verifikasi UMKM</a></li>
                                    ';
                                }
                                else if($this->user_model->is_umkm_penjual())
                                {
                                    if($this->session->tempdata('jenis_menu') == 'user')
                                    {
                                        echo '
                                            <li class="'.($active == 'biodata'?'active':'').'"><a href="'.base_url('customer/biodata').'">Biodata</a></li>
                                            <li class="'.($active == 'alamat'?'active':'').'"><a href="'.base_url('customer/daftar-alamat').'">Daftar Alamat</a></li>
                                            <li class="'.($active == 'transaksi_customer'?'active':'').'"><a href="'.base_url('transaksi/customer').'">Transaksi Pembelian</a></li>
                                            <li class="'.($active == 'wishlist'?'active':'').'"><a href="'.base_url('wishlist').'">Wishlist</a></li>
                                        ';    
                                    }
                                    
                                    if($this->session->tempdata('jenis_menu') == 'admin')
                                    {
                                        echo '
                                            <li class="'.($active == 'dashboard'?'active':'').'"><a href="'.base_url('dashboard').'">Dashboard</a></li>
                                            <li class="'.($active == 'umkm'?'active':'').'"><a href="'.base_url('customer/umkm').'">Data UMKM</a></li>
                                            <li class="'.($active == 'logo_umkm'?'active':'').'"><a href="'.base_url('logo_umkm').'">Logo UMKM</a></li>
                                            <li class="'.($active == 'produk'?'active':'').'"><a href="'.base_url('produk').'">Produk</a></li>
                                            <li class="'.($active == 'transaksi_penjual'?'active':'').'"><a href="'.base_url('transaksi/penjual').'">Transaksi Penjualan</a></li>
                                        ';
                                    }
                                }
                                else if($this->user_model->is_umkm_user())
                                {
                                    echo '
                                        <li class="'.($active == 'biodata'?'active':'').'"><a href="'.base_url('customer/biodata').'">Biodata</a></li>
                                        <li class="'.($active == 'alamat'?'active':'').'"><a href="'.base_url('customer/daftar-alamat').'">Daftar Alamat</a></li>
                                        <li class="'.($active == 'transaksi_customer'?'active':'').'"><a href="'.base_url('transaksi/customer').'">Transaksi Pembelian</a></li>
                                        <li class="'.($active == 'wishlist'?'active':'').'"><a href="'.base_url('wishlist').'">Wishlist</a></li>
                                    ';
                                    $status = $this->user_model->cek_status_umkm();
                                    if($status)
                                    {
                                        echo '<li class="'.($active == 'umkm'?'active':'').'"><a style="font-weight:700" href="'.base_url('customer/umkm').'">STATUS UMKM</a></li>';
                                    }
                                    else{
                                        echo '<li class="'.($active == 'umkm'?'active':'').'"><a style="font-weight:700" href="'.base_url('customer/umkm').'">DAFTAR UMKM</a></li>';
                                    }

                                }
                                ?>
                            </ul>
                        </div>
                    </div>

                    <?php if($this->user_model->is_umkm_admin() != true and $this->user_model->is_umkm_verifikator() != true): ?>
                    <div class="aside">
                        <h3 class="aside-title">Pencarian Produk:</h3>
                        <div class="row">
                            <form action="<?php echo base_url('list-produk') ?>" method="get">
                                <div class="col-sm-12">
                                    <div class="input-group" style="display: flex;">
                                        <input type="text" name="cari" class="form-control" placeholder="Search..." value="<?php echo htmlentities($this->input->get('cari',true), ENT_QUOTES, 'UTF-8') ?>">
                                        <div class="input-group-append" style="top: -5px;position: relative;">
                                            <button type="submit" class="btn primary-btn" style="border-radius: 0px; padding: 7px 15px;">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /aside widget -->

                    <!-- aside widget -->
                    <div class="aside">
                        <h3 class="aside-title">Kategori Produk :</h3>
                        <ul class="list-links">
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
                    <div class="aside">
                        <h3 class="aside-title">Kategori UMKM : </h3>
                        <ul class="list-links">
                            <?php
                            $url = $this->uri->segment(3);
                            foreach ($kategori as $value) {
                                if($url == url($value->nama_usaha))
                                {
                                    echo '
                                        <li  class="active"><a href="'.base_url('list-umkm/kategori/'.url($value->nama_usaha)).'">'.$value->nama_usaha.'</a></li>
                                    ';
                                }else{
                                    echo '
                                        <li><a href="'.base_url('list-umkm/kategori/'.url($value->nama_usaha)).'">'.$value->nama_usaha.'</a></li>
                                    ';
                                }
                             } 
                            ?>
                        </ul>
                    </div>
                    <?php endif; ?>
                </div>
                <div id="main" class="col-md-9">
                    <div class="home-wrap" style="margin-left: 0px;">
                        <?php echo $content; ?>
                    </div>
                </div>
            </div>
			<!-- /home wrap -->
		</div>
		<!-- /container -->
	</div>
	<!-- /HOME -->

	<script src="<?php echo base_url('assets/plugins/notifications/sweet_alert.min.js');?>"></script>
    <script src="<?php echo base_url('assets/plugins/sweetalert2/sweetalert2.min.js');?>"></script>
     <!-- Toastr -->
     <script src="<?php echo base_url('assets/plugins/toastr/toastr.min.js');?>"></script>
	<?php
		$this->load->view('templates/footer');
	?>
    <script type="text/javascript">
        $(window).on('load', function () {
            $("#loading").fadeOut("fast");
        });
        
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

		function Angkasaja(evt) 
		{
			var charCode = (evt.which) ? evt.which : event.keyCode
			if (charCode > 31 && (charCode < 48 || charCode > 57))
				return false;
			return true;
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
                            if(data.jml_keranjang == 0)
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
                                login();
                            }
                        });
                    }
                },
                error: function (jqXHR, textStatus, errorThrown){
                    alert('Error get data from ajax');
                }
            });
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
                rupiah = 0;
            }
            

            return rupiah;
        }
        
        function hapus_rp(data)
        {
            return data.split('.').join('');
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

        function text(str){
            if(str == null || str == '')
            {
                return str;
            }else{
                return str.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});    
            }
            
        }

        function tanggal_indo(data)
        {
             var tgl = data.split("-");
             return tgl[2]+' '+get_bulan(tgl[1])+' '+tgl[0];
        }

        function get_bulan(data){
            var id = parseInt(data);
            switch(id) {
                case 1: { return 'Januari'; break; }
                case 2: { return 'Februari'; break; }
                case 3: { return 'Maret'; break; }
                case 4: { return 'April'; break; }
                case 5: { return 'Mei'; break; }
                case 6: { return 'Juni'; break; }  
                case 7: { return 'Juli'; break; }
                case 8: { return 'Agustus'; break; }
                case 9: { return 'September'; break; }
                case 10: { return 'Oktober'; break; }
                case 11: { return 'November'; break; }
                case 12: { return 'Desember'; break; }
            }
        }
	</script>
	<script src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>
	<script src="<?php echo base_url('assets/js/slick.min.js');?>"></script>
	<script src="<?php echo base_url('assets/js/nouislider.min.js');?>"></script>
	<script src="<?php echo base_url('assets/js/jquery.zoom.min.js');?>"></script>
	<script src="<?php echo base_url('assets/js/main.js');?>"></script>
	<script src="<?php echo base_url('assets/plugins/notifications/sweet_alert.min.js');?>"></script>
    <script src="<?php echo base_url('assets/js/jquery.redirect.js'); ?>"></script>
    <script src="<?php echo base_url('assets/plugins/jQuery/purify.min.js'); ?>"></script>
<?php 
if($active == 'umkm' OR $active == 'agenda'):
?>
<link rel="stylesheet" href="https://js.arcgis.com/4.8/esri/css/main.css">
<script src="https://js.arcgis.com/4.8/"></script>
<script>
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
                
            }
        ); 
</script>
<?php
endif;
?>




	<?php
	// echo "<script src='".'https://cdn.ckeditor.com/4.9.2/standard-all/ckeditor.js'."'></script>";
	// echo "<script src='".base_url('assets/ckfinder/ckfinder.js')."'></script>";
	// echo "<script src='".base_url('assets/core/libraries/jquery.min.js')."'></script>";
	// echo "<script src='".base_url('assets/core/libraries/bootstrap.min.js')."'></script>";
	// echo "<script src='".base_url('assets/plugins/loaders/blockui.min.js')."'></script>";
	// echo "<script src='".base_url('assets/plugins/forms/styling/uniform.min.js')."'></script>";
	// echo "<script src='".base_url('assets/plugins/forms/styling/switchery.min.js')."'></script>";
	// echo "<script src='".base_url('assets/plugins/forms/styling/switch.min.js')."'></script>";
	// echo "<script src='".base_url('assets/plugins/tables/datatables/datatables.min.js')."'></script>";
	// echo "<script src='".base_url('assets/plugins/tables/datatables/extensions/fixed_columns.min.js')."'></script>";
	// echo "<script src='".base_url('assets/plugins/forms/selects/select2.min.js')."'></script>";
	// echo "<script src='".base_url('assets/plugins/notifications/sweet_alert.min.js')."'></script>";
	?>

	<?php echo $scripts_footer; ?>
</body>
</html>