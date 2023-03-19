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
    <link rel="stylesheet" type="text/css" href="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/wtf-forms.css">
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
</style>
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
<?php echo $styles; ?>
<!-- todo: pindah ke bawah lg -->
<script src="<?php echo base_url('assets/js/jquery.min.js');?>"></script>
<!-- //todo: sementaun -->
<?php echo $scripts_header; ?>
</head>
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
                <div class="category-nav">
                    <span class="category-header">Menu <i class="fa fa-list"></i></span>
                    <ul class="category-list">
                        <?php
                        if($this->user_model->is_umkm_user()): 
                        ?>
                           <!--  <li class="menu-header">
                               Pembeli
                            </li>
                            <li class="<?php echo ($active == 'biodata'?'active':'') ?>">
                                <a href="<?php echo base_url('customer/biodata') ?>">Biodata</a>
                            </li>
                            <li class="<?php echo ($active == 'alamat'?'active':'') ?>">
                                <a href="<?php echo base_url('customer/daftar-alamat') ?>">Daftar Alamat</a>
                            </li>
                            <li class="<?php echo ($active == 'transaksi_customer'?'active':'') ?>">
                                <a href="<?php echo base_url('transaksi/customer') ?>">Transaksi Pembelian</a>
                            </li>
                            <li class="menu-header">
                               UMKM
                            </li>
                            <li class="<?php echo ($active == 'umkm'?'active':'') ?>">
                                <a href="<?php echo base_url('customer/umkm') ?>">
                                    <?php
                                        if($this->user_model->is_umkm_penjual())
                                        {
                                            echo "Data UMKM";
                                        }else{
                                            echo "Daftar UMKM";
                                        }
                                    ?>
                                    
                                </a>
                            </li> -->
                            <?php
                            if($this->user_model->is_umkm_penjual()):
                            ?>
                               <!--  <li class="<?php echo ($active == 'logo_umkm'?'active':'') ?>">
                                    <a href="<?php echo base_url('logo_umkm') ?>">Logo UMKM</a>
                                </li> -->
                                <!-- <li class="<?php echo ($active == 'produk'?'active':'') ?>">
                                    <a href="<?php echo base_url('produk') ?>">Produk</a>
                                </li>
                                <li class="<?php echo ($active == 'transaksi_penjual'?'active':'') ?>">
                                    <a href="<?php echo base_url('transaksi/penjual') ?>">Transaksi Penjualan</a>
                                </li> -->
                            <?php
                            endif;
                            ?>
                        <?php
                        endif;
                        ?>
                        <?php
                        if($this->user_model->is_umkm_admin()):
                        ?>
                          <!--   <li class="<?php echo ($active == 'dashboard'?'active':'') ?>">
                                <a href="<?php echo base_url('dashboard') ?>">  Dashboard</a>
                            </li>
                            <li class="<?php echo ($active == 'pengguna'?'active':'') ?>">
                                <a href="<?php echo base_url('pengguna') ?>">Pengguna</a>
                            </li>
                            <li class="<?php echo ($active == 'umkm'?'active':'') ?>">
                                <a href="<?php echo base_url('umkm') ?>">Verifikasi UMKM</a>
                            </li>
                             <li class="<?php echo ($active == 'produk'?'active':'') ?>">
                                <a href="<?php echo base_url('produk') ?>">Produk</a>
                            </li>
                            <li class="<?php echo ($active == 'berita'?'active':'') ?>">
                                <a href="<?php echo base_url('berita') ?>">Berita</a>
                            </li>
                            <li class="<?php echo ($active == 'agenda'?'active':'') ?>">
                                <a href="<?php echo base_url('agenda/data') ?>">Agenda</a>
                            </li>
                            <li class="<?php echo ($active == 'slider'?'active':'') ?>">
                                <a href="<?php echo base_url('slider') ?>">Slider</a>
                            </li>
                            <li class="<?php echo ($active == 'dasar_hukum'?'active':'') ?>">
                                <a href="<?php echo base_url('dasar_hukum/data') ?>">Dasar Hukum</a>
                            </li> -->
                        <?php
                        endif;
                        ?>
                        <?php
                        if($this->user_model->is_umkm_verifikator()):
                        ?>
                            <!-- <li class="<?php echo ($active == 'dashboard'?'active':'') ?>">
                                <a href="<?php echo base_url('dashboard') ?>">  Dashboard</a>
                            </li>
                            <li class="<?php echo ($active == 'umkm'?'active':'') ?>">
                                <a href="<?php echo base_url('umkm') ?>">UMKM</a>
                            </li> -->
                        <?php
                        endif;
                        ?>
                        
                    </ul>
                </div>
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
    <div id="home" style="margin-top: 40px;min-height: 600px">
        <!-- container -->
        <div class="container">
            <!-- home wrap -->
            <div class="home-wrap">
                <?php echo $content; ?>
            </div>
            <!-- /home wrap -->
        </div>
        <!-- /container -->
    </div>
    <!-- /HOME -->

    
    <?php
        $this->load->view('templates/footer');
    ?>
    <script type="text/javascript">
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
            return str.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
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