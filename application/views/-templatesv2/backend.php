<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <link rel="shortcut icon" href="<?php echo base_url()?>assets/images/logo.png" type="image/png">
  <?php echo $meta_tag; ?>
  <title><?php echo $site_title; ?></title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/mytemplate_backend/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/mytemplate_backend/modules/fontawesome/css/all.min.css">
  <!-- CSS Libraries -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/mytemplate_backend/modules/datatables/datatables.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/mytemplate_backend/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/mytemplate_backend/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css">
  <!--Sweet Alert-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/sweetalert2/sweetalert2.css') ?>">
  <!-- select2 -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/mytemplate_backend/modules/select2/dist/css/select2.min.css'); ?>">
  <!-- Template CSS -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/mytemplate_backend/css/style.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/mytemplate_backend/css/components.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/mytemplate_backend/css/custom.css">
  <?php echo $styles; ?>
  <script src="<?php echo base_url(); ?>assets/mytemplate_backend/modules/jquery.min.js"></script>
  <?php echo $scripts_header; ?>
</head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg" style="background-color: #1F3DB0;"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
          </ul>
        </form>
        <ul class="navbar-nav navbar-right">
          <?php if ($this->user_model->is_umkm_penjual()) { ?>
            <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg"><i class="far fa-bell"></i> <span class="count-notif-all badge badge-danger" style="vertical-align: top;padding: 3px 5px;"></span></a>
              <div class="dropdown-menu dropdown-list dropdown-menu-right">
                <div class="dropdown-header">Notifikasi
                  <!-- <div class="float-right">
                    <a href="#">Mark All As Read</a>
                  </div> -->
                </div>
                <div class="dropdown-list-content dropdown-list-icons notif-list">
                  
                </div>
                <div class="dropdown-footer text-center">
                  <a href="<?php echo base_url('notif/penjual'); ?>">Lihat Semua <i class="fas fa-chevron-right"></i></a>
                </div>
              </div>
            </li>
          <?php } ?>
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="<?php echo base_url()?>assets/mytemplate/img/avatar-1.png" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block"><?php echo $this->session->nama_lengkap; ?></div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item has-icon text-danger" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-sign-out-alt"></i> Keluar
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="<?php echo base_url(); ?>" target="_blank">UMKM</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="<?php echo base_url(); ?>" target="_blank">UMKM</a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Menu Utama</li>
            <?php 
            if($this->user_model->is_umkm_admin()){
              echo '<li class="'.($active == 'dashboard'?'active':'').'"><a class="nav-link" href="'.base_url('dashboard').'"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a></li>
                  <li class="'.($active == 'pesan'?'active':'').'"><a class="nav-link" href="'.base_url('pesan/penjual').'"><i class="fas fa-envelope"></i> 
                    <span>Pesan  
                    <font class="count-pesan-all badge badge-danger"></font>
                    <input type="hidden" name="count_pesan_all" id="count_pesan_all" value="0"></span>
                    </a>
                  </li>
                  <li class="'.($active == 'pengguna'?'active':'').'"><a class="nav-link" href="'.base_url('pengguna').'"><i class="fas fa-users"></i> <span>Pengguna</span></a></li>
                  <li class="'.($active == 'umkm'?'active':'').'"><a class="nav-link" href="'.base_url('umkm').'"><i class="fas fa-check"></i> <span>Verifikasi UMKM</span></a></li>
                  <li class="'.($active == 'produk'?'active':'').'"><a class="nav-link" href="'.base_url('produk').'"><i class="fas fa-archive"></i> <span>Produk</span></a></li>
                  <li class="'.($active == 'transaksi_admin'?'active':'').'"><a class="nav-link" href="'.base_url('transaksi/admin').'"><i class="fas fa-clipboard-list"></i> <span>Transaksi</span></a></li>
                  <li class="'.($active == 'slider'?'active':'').'"><a class="nav-link" href="'.base_url('slider').'"><i class="fas fa-images"></i> <span>Slider & Banner</span></a></li>
                  <li class="'.($active == 'agenda'?'active':'').'"><a class="nav-link" href="'.base_url('agenda/data').'"><i class="fas fa-calendar"></i> <span>Agenda</span></a></li>
                  <li class="'.($active == 'berita'?'active':'').'"><a class="nav-link" href="'.base_url('berita').'"><i class="fas fa-newspaper"></i> <span>Berita</span></a></li>
                  <li class="'.($active == 'dasar_hukum'?'active':'').'"><a class="nav-link" href="'.base_url('dasar_hukum/data').'"><i class="fas fa-gavel"></i> <span>Dasar Hukum</span></a></li>';
            }elseif ($this->user_model->is_umkm_verifikator()) {
              echo '<li class="'.($active == 'dashboard'?'active':'').'"><a class="nav-link" href="'.base_url('dashboard').'"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a></li>
                    <li class="'.($active == 'umkm'?'active':'').'"><a class="nav-link" href="'.base_url('umkm').'"><i class="fas fa-check"></i> <span>Verifikasi UMKM</span></a></li>';
            }elseif($this->user_model->is_umkm_penjual()){
              echo '<li class="'.($active == 'dashboard'?'active':'').'"><a class="nav-link" href="'.base_url('dashboard').'"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a></li>
                    <li class="'.($active == 'notif'?'active':'').'"><a class="nav-link" href="'.base_url('notif/penjual').'"><i class="fas fa-bell"></i> 
                      <span>Notifikasi  
                      <font class="count-notif-all badge badge-danger"></font>
                      <input type="hidden" name="count_notif_all" id="count_notif_all" value="0"></span>
                      </a>
                    </li>
                    <li class="'.($active == 'pesan'?'active':'').'"><a class="nav-link" href="'.base_url('pesan/penjual').'"><i class="fas fa-envelope"></i> 
                      <span>Pesan  
                      <font class="count-pesan-all badge badge-danger"></font>
                      <input type="hidden" name="count_pesan_all" id="count_pesan_all" value="0"></span>
                      </a>
                    </li>
                    <li class="'.($active == 'umkm'?'active':'').'"><a class="nav-link" href="'.base_url('customer/umkm').'"><i class="fas fa-store"></i> <span>Data UMKM</span></a></li>
                    <li class="'.($active == 'logo_umkm'?'active':'').'"><a class="nav-link" href="'.base_url('logo_umkm').'"><i class="fas fa-image"></i> <span>Logo UMKM</span></a></li>
                    <li class="'.($active == 'produk'?'active':'').'"><a class="nav-link" href="'.base_url('produk').'"><i class="fas fa-archive"></i> <span>Produk</span></a></li>
                    <li class="'.($active == 'transaksi_penjual'?'active':'').'"><a class="nav-link" href="'.base_url('transaksi/penjual').'"><i class="fas fa-clipboard-list"></i> <span>Transaksi Penjualan</span></a></li>';
            }else{
              $status = $this->user_model->cek_status_umkm();
              if($status){
                echo '<li class="'.($active == 'customer/umkm'?'active':'').'"><a class="nav-link" href="'.base_url('customer/umkm').'"><i class="fas fa-clipboard-check"></i> <span>Status UMKM</span></a></li>';
              }else{
                echo '<li class="'.($active == 'customer/umkm'?'active':'').'"><a class="nav-link" href="'.base_url('customer/umkm').'"><i class="fas fa-file-signature"></i> <span>Daftar UMKM</span></a></li>';
              }
            }
            ?>
            <li><a class="nav-link" href="javascript:void(0);" data-toggle="modal" data-target="#logoutModal"><i class="fas fa-sign-out-alt"></i> <span>Keluar</span></a></li>
          </ul>
       </aside>
      </div>

      <!-- Main Content -->
      <div id="loading" style="display:none"></div>
      <div class="main-content">
        <?php echo $content; ?>
      </div>

      <footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; 2020 <div class="bullet"></div> Development By : RobDev
        </div>
        <div class="footer-right">
          
        </div>
      </footer>
    </div>
  </div>

   <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Logout ?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Apakah anda yakin ingin keluar dari aplikasi?</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Tidak</button>
          <a class="btn btn-primary" href="<?php echo base_url('keluar'); ?>">Ya</a>
        </div>
      </div>
    </div>
  </div>

<!-- General JS Scripts -->
<script src="<?php echo base_url(); ?>assets/mytemplate_backend/modules/popper.js"></script>
<script src="<?php echo base_url(); ?>assets/mytemplate_backend/modules/tooltip.js"></script>
<script src="<?php echo base_url(); ?>assets/mytemplate_backend/modules/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/mytemplate_backend/modules/nicescroll/jquery.nicescroll.min.js"></script>
<script src="<?php echo base_url(); ?>assets/mytemplate_backend/modules/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/mytemplate_backend/js/stisla.js"></script>
<!-- JS Libraies -->
<script src="<?php echo base_url(); ?>assets/mytemplate_backend/modules/datatables/datatables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/mytemplate_backend/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/mytemplate_backend/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
<script src="<?php echo base_url(); ?>assets/mytemplate_backend/modules/jquery-ui/jquery-ui.min.js"></script>
<script src="<?php echo base_url('assets/plugins/sweetalert2/sweetalert2.min.js');?>"></script>
<script src="<?php echo base_url('assets/mytemplate_backend/modules/select2/dist/js/select2.full.min.js');?>"></script>
<script src="<?php echo base_url('assets/plugins/toastr/toastr.min.js');?>"></script>
<script src="<?php echo base_url('assets/plugins/jQuery/purify.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.redirect.js'); ?>"></script>
<?php echo $scripts_footer; ?>
<!-- Page Specific JS File -->
<!-- Template JS File -->
<script src="<?php echo base_url(); ?>assets/mytemplate_backend/js/scripts.js"></script>
<script src="<?php echo base_url(); ?>assets/mytemplate_backend/js/custom.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    <?php if (!$this->user_model->is_umkm_verifikator()) { ?>
      get_count_pesan();
      // get_notif();
    <?php } ?>

    <?php if ($active == 'slider') { ?>
      $('.pilih-produk').select2({
        placeholder: "-- Cari Produk --",
        allowClear: true,
        ajax: {
            url: "<?php echo base_url('list_produk/ajax_cari_produk') ?>",
            dataType: 'JSON',
            delay: 250,
            processResults: function (data) {
                var results = [];
                $.each(data, function (index, produk) {
                    results.push({
                        id: produk.id_produk+'#'+produk.kode_produk,
                        text: produk.nama_produk
                    });
                });

                return {
                    results: results
                };
            },
            cache: true
        }
      });

      $('.pilih-umkm').select2({
        placeholder: "-- Cari UMKM --",
        allowClear: true,
        ajax: {
            url: "<?php echo base_url('list_umkm/ajax_cari_umkm') ?>",
            dataType: 'JSON',
            delay: 250,
            processResults: function (data) {
                var results = [];
                $.each(data, function (index, umkm) {
                    results.push({
                        id: umkm.id_umkm,
                        text: umkm.namausaha
                    });
                });

                return {
                    results: results
                };
            },
            cache: true
        }
      });

      $('.pilih-berita').select2({
        placeholder: "-- Cari Berita --",
        allowClear: true,
        ajax: {
            url: "<?php echo base_url('list_berita/ajax_cari_berita') ?>",
            dataType: 'JSON',
            delay: 250,
            processResults: function (data) {
                var results = [];
                $.each(data, function (index, berita) {
                    results.push({
                        id: berita.id_berita+'#'+berita.kode_berita,
                        text: berita.judul
                    });
                });

                return {
                    results: results
                };
            },
            cache: true
        }
      });

      $('.pilih-agenda').select2({
        placeholder: "-- Cari Agenda --",
        allowClear: true,
        ajax: {
            url: "<?php echo base_url('agenda/ajax_cari_agenda') ?>",
            dataType: 'JSON',
            delay: 250,
            processResults: function (data) {
                var results = [];
                $.each(data, function (index, agenda) {
                    results.push({
                        id: agenda.id_agenda+'#'+agenda.kode_agenda,
                        text: agenda.judul
                    });
                });

                return {
                    results: results
                };
            },
            cache: true
        }
      });    
    <?php } ?>
    
  });

  function get_count_pesan(){
      $.ajax({
          url : "<?php echo base_url('ajax/ajax_data')?>",
          type: "POST",
          data : {
              <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>',
              type : 'count_pesan_all',
          },
          dataType: "JSON",
          success: function(data){
              if (data.count > 0) {
                  $('.count-pesan-all').text(data.count);
              }else{
                  $('.count-pesan-all').text('');
              }
              $('#count_pesan_all').val(data.count);
          },
          error: function (jqXHR, textStatus, errorThrown){
              alert('Error get data from ajax');
          }
      });
  }

  // function get_notif(){
  //   $.ajax({
  //       url : "<?php echo base_url('notif/ajax_data')?>",
  //       type: "POST",
  //       data : {
  //           <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>',
  //           type : 'get_notif',
  //       },
  //       dataType: "JSON",
  //       success: function(data){
  //           if (data.count > 0) {
  //               var html_count_msg = '<span class="count cart-count">'+data.count+'</span>';
  //               $('.count-notif-all').html(DOMPurify.sanitize( html_count_msg, { SAFE_FOR_JQUERY: true } ));

  //               var html = '';
  //               $.each(data.data, function(i, val) {
  //                   var expld_tanggal = val.tanggal.split(" ");
  //                   html += `<a href="javascript:void(0)" onclick="detail_notif(`+val.id_notifikasi+`,`+val.id_detail+`,'`+val.modul+`','`+val.submodul+`')" class="dropdown-item dropdown-item-unread">
  //                             <div class="dropdown-item-desc">
  //                               <span style="font-size:12px;"><b>`+val.judul+`</b></span>
  //                               <br>
  //                               <span style="font-size:10px;">`+val.message+`</span>
  //                               <div class="time text-primary">`+tanggal_indo(expld_tanggal[0])+` `+expld_tanggal[1]+`</div>
  //                             </div>
  //                           </a>`;
  //               });
  //               $('.notif-list').html(html);
  //           }else{
  //               $('.count-notif-all').html('');
  //               $('.notif-list').html(`<a href="javascript:void(0)" class="dropdown-item dropdown-item-unread">
  //                                       <div class="dropdown-item-desc">
  //                                         <span style="font-size:12px;"><b>TIDAK ADA NOTIFIKASI YANG BELUM DIBACA.</b></span>
  //                                       </div>
  //                                     </a>`);
  //           }
  //           $('#count_notif_all').val(data.count);
  //       },
  //       error: function (jqXHR, textStatus, errorThrown){
  //           alert('Error get data from ajax');
  //       }
  //   });
  // }

  function detail_notif(id_notifikasi,id_detail=null,modul=null,submodul=null) {
    read_notif(id_notifikasi);
    if (modul === 'transaksi_penjualan') {
        $.redirect(
            '<?php echo base_url(); ?>transaksi/penjual',
            {
                id_transaksi:id_detail,
                submodul:submodul,
                <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
            }
        );
    }else if (modul === 'transaksi_pembelian') {
        $.redirect(
            '<?php echo base_url(); ?>transaksi/customer',
            {
                id_transaksi:id_detail,
                submodul:submodul,
                <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
            }
        );
    }
}

function read_notif(id_notifikasi){
    $.ajax({
    url : "<?php echo base_url(); ?>notif/read_notif",
        type: "POST",
        async:false,
        data: {
            id_notifikasi : id_notifikasi,
            <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
        },
        dataType: "JSON",
        success: function(data){
            
        },
        error: function (jqXHR, textStatus, errorThrown){
            Swal.fire({type: 'error',title: 'Oops...',text: 'Terjadi kesalahan !'});
        }
    });
}
</script>
<script type="text/javascript">
  const Toast = Swal.mixin({
     toast: true,
     position: 'top-end',
     showConfirmButton: false,
     timer : 3000
  });
  
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
</body>
</html>