<!DOCTYPE html>
<html lang="en">
<head>
	<title>LOGIN - BORONG SAY Kota Tangerang</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="<?php echo base_url('assets/images/borongsayiconsmall.png') ?>"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/login/vendor/bootstrap/css/bootstrap.min.css') ?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css') ?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/login/fonts/iconic/css/material-design-iconic-font.min.css') ?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/login/vendor/animate/animate.css') ?>">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/login/vendor/css-hamburgers/hamburgers.min.css') ?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/login/vendor/animsition/css/animsition.min.css') ?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/login/vendor/select2/select2.min.css') ?>">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/login/vendor/daterangepicker/daterangepicker.css') ?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/login/css/util.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/login/css/main.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/sweetalert/sweetalert.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/mytemplate_backend/modules/datepicker/css/bootstrap-datepicker.css') ?>">
<!--===============================================================================================-->
</head>
<style type="text/css">
	.container-login100{
		background: url('<?php echo base_url('assets/images/bg_login_page_borongsay.jpg') ?>');
	    position: absolute;
	    top: 0;
	    left: 0;
	    width: 100%;
	    background-repeat: no-repeat;
	    background-size: cover;
	    background-position: center;
	}
	.wrap-login100-form-btn > a:hover{
		color: #fff;
	}
	#loading {
		position:   fixed;
		z-index:    9000;
		top:        0;
		left:       0;
		height:     100%;
		width:      100%;
		background: rgba( 255, 255, 255, 1 )
		url('<?php echo base_url('assets/mytemplate/img/loader.gif'); ?>')
		50% 50%
		no-repeat;
		opacity: 0.5;
	}
</style>
<body>
	<div id="loading"></div>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-l-20 p-r-20 p-t-20 p-b-20">
				<span class="login100-form-title p-b-20">
					<a href="<?php echo base_url('') ?>"> 
						<img src="<?php echo base_url('assets/images/borongsaylogomedium.png'); ?>" alt="" style="width: 250px;">
					</a>
					<br>
					<a href="<?php echo base_url('') ?>" style="font-size:24px"> 
						<span id="form-lable">LOGIN</span>
						<!-- <p>BORONG SAY Kota Tangerang.</p> -->
					</a>
				</span>

				<form class="login100-form validate-form" id="form-login" action="" method="post">
					<input type="hidden" name="redirurl" value="<?php echo @$_SERVER['HTTP_REFERER']; ?>" />
					<div class="wrap-input100 validate-input m-b-23" data-validate = "Username Tidak Boleh Kosong">
						<span class="label-input100">Username</span>
						<input type="hidden" name="<?=$name;?>" value="<?=$hash;?>" />
						<input class="input100" type="text" name="username" placeholder="NIK atau Email" value="<?php echo @$this->session->flashdata('username'); ?>">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Password Tidak Boleh Kosong">
						<span class="label-input100">Password</span>
						<input class="input100" type="password" name="pass" placeholder="Password">
						<span class="focus-input100" data-symbol="&#xf190;"></span>
					</div>
					
					<div class="container-login100-form-btn" style="margin-top:20px;">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button type="button" class="login100-form-btn" onclick="login()">
								Login
							</button>
						</div>
						<div class="wrap-login100-form-btn" style="margin-top: 20px;">
							<div class="login100-form-bgbtn"></div>
							<a href="https://tlive.tangerangkota.go.id/registrasi/umkm" target="_blank" class="login100-form-btn">
								Daftar
							</a>
						</div>
						<a href="javascript:void(0);" onclick="get_form('reset_password')" style="margin-top: 20px;">Lupa Password</a>
					</div>
				</form>

				<form class="login100-form validate-form-reset" id="form-reset-password" action="" method="post" style="display: none;">
					<div class="wrap-input100 validate-input-reset m-b-23" data-validate = "NIK / Email Tidak Boleh Kosong">
						<span class="label-input100">NIk / Email</span>
						<input type="hidden" name="<?=$name;?>" value="<?=$hash;?>" />
						<input class="input100" type="text" name="nik" placeholder="NIK / Email">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>
					<div class="container-login100-form-btn" style="margin-top:20px;">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button type="button" class="login100-form-btn" onclick="reset_password()">
								Reset Password
							</button>
						</div>
						<a href="javascript:void(0);" onclick="get_form('login')" style="margin-top: 20px;">Login</a>
					</div>
				</form>

				<form class="login100-form validate-form-lengkapi" id="form-lengkapi" action="" method="post" style="display: none;">
					<div class="row">
						<div class="col-md-12">
							<label style="font-size: 14px; color:red ;margin-top: 20px; text-align: center;"> Akun Tangerang LIVE Anda sedang menunggu Verifikasi, silahkan untuk melengkapi data - data berikut ini.</label>
						</div>
					</div>

					<input type="hidden" name="redirurl" value="<?php echo @$_SERVER['HTTP_REFERER']; ?>" />
					<input type="hidden" name="<?=$name;?>" value="<?=$hash;?>" />
					<input type="hidden" name="nik"/>
					<input type="hidden" name="email"/>
					<input type="hidden" name="no_telp"/>
					<input type="hidden" name="username"/>
					<input type="hidden" name="pass"/>

					<div class="row">
						<div class="col-md-6">
							<div class="wrap-input100 validate-input m-b-23" data-validate = "Nama Lengkap Tidak Boleh Kosong">
								<span class="label-input100">Nama Lengkap</span>
								<input class="input100" type="text" name="nama" placeholder="Nama Lengkap">
							</div>
						</div>
						<div class="col-md-6">
							<div class="wrap-input100 validate-input m-b-23" data-validate = "Jenis Kelamin Tidak Boleh Kosong">
								<span class="label-input100">Jenis Kelamin</span>
								<div class="row col-md-12">
									<div class="form-check col-md-6">
									  <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin1" value="Laki-Laki" checked>
									  <label class="form-check-label" for="jenis_kelamin1">
									    Laki - Laki
									  </label>
									</div>
									<div class="form-check col-md-6">
									  <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin2" value="Perempuan">
									  <label class="form-check-label" for="jenis_kelamin2">
									    Perempuan
									  </label>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-6">
							<div class="wrap-input100 validate-input m-b-23" data-validate = "Tempat Lahir Tidak Boleh Kosong">
								<span class="label-input100">Tempat Lahir</span>
								<input class="input100" type="text" name="tempat_lahir" placeholder="Tempat Lahir">
							</div>
						</div>
						<div class="col-md-6">
							<div class="wrap-input100 validate-input m-b-23" data-validate = "Tanggal Lahir Tidak Boleh Kosong">
								<span class="label-input100">Tanggal Lahir</span>
								<input class="input100" type="text" name="tanggal_lahir" id="tanggal_lahir" placeholder="Tanggal Lahir">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<div class="wrap-input100 validate-input m-b-23" data-validate="Domisili Tidak Boleh Kosong">
								<span class="label-input100">Domisili</span>
								<div class="row col-md-12">
									<div class="form-check col-md-6">
									  <input class="form-check-input domisili" type="radio" name="domisili" id="domisili1" value="Dalam Kota" checked>
									  <label class="form-check-label" for="domisili1">
									    Dalam Kota
									  </label>
									</div>
									<div class="form-check col-md-6">
									  <input class="form-check-input domisili" type="radio" name="domisili" id="domisili2" value="Luar Kota">
									  <label class="form-check-label" for="domisili2">
									    Luar Kota
									  </label>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="wrap-input100 validate-input m-b-23" data-validate="Provinsi Tidak Boleh Kosong">
								<span class="label-input100">Provinsi</span>
								<select name="prop" id="prop" class="input100" onchange="get_kab()">
									<option value="36">BANTEN</option>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="wrap-input100 validate-input m-b-23" data-validate="Kabupaten / Kota Tidak Boleh Kosong">
								<span class="label-input100">Kabupaten / Kota</span>
								<select name="kab" id="kab" class="input100" onchange="get_kec()">
									<option value="71">KOTA TANGERANG</option>
								</select>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="wrap-input100 validate-input m-b-23" data-validate="Kecamatan Tidak Boleh Kosong">
								<span class="label-input100">Kecamatan</span>
								<select name="kec" id="kec" class="input100" onchange="get_kel()">
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="wrap-input100 validate-input m-b-23" data-validate="Kelurahan Tidak Boleh Kosong">
								<span class="label-input100">Kelurahan</span>
								<select name="kel" id="kel" class="input100">
								</select>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="wrap-input100 validate-input m-b-23" data-validate = "RT Tidak Boleh Kosong">
								<span class="label-input100">RT</span>
								<input class="input100" type="text" name="no_rt" onkeypress="return Angkasaja(event)" maxlength="3" placeholder="RT">
							</div>
						</div>
						<div class="col-md-6">
							<div class="wrap-input100 validate-input m-b-23" data-validate = "RW Tidak Boleh Kosong">
								<span class="label-input100">RW</span>
								<input class="input100" type="text" name="no_rw" onkeypress="return Angkasaja(event)" maxlength="3" placeholder="RW">
							</div>
						</div>
					</div>

					
					<div class="row">
						<div class="col-md-12">
							<div class="wrap-input100 validate-input m-b-23" data-validate = "Alamat Tidak Boleh Kosong">
								<span class="label-input100">Alamat</span>
								<textarea class="input100" name="alamat" placeholder="Alamat" rows="3"></textarea>
							</div>
						</div>
					</div>

					<input type="hidden" name="kode_pos"/>
					<input type="hidden" name="agama"/>

					<div class="container-login100-form-btn" style="margin-top:20px;">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button type="button" class="login100-form-btn" onclick="login_lengkapi()">
								Login
							</button>
						</div>
						<div class="wrap-login100-form-btn" style="margin-top: 20px;">
							<div class="login100-form-bgbtn"></div>
							<a href="https://tlive.tangerangkota.go.id/registrasi/umkm" target="_blank" class="login100-form-btn">
								Daftar
							</a>
						</div>
					</div>
				</form>
				
				<div class="container-login100-form-btn">
					<label for="" style="font-size: 12px;margin-top: 20px; text-align: center;">
						Untuk login BORONG SAY menggunakan email dan nik yang terdaftar di Tangerang Live, Aplikasi Tangerang LIVE dapat di download: <a href="https://play.google.com/store/apps/details?id=id.go.tangerangkota.tangeranglive" target="_blank">Google Play Store</a>
					</label>
				</div>
			</div>
		</div>
	</div>
	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="<?php echo base_url('assets/login/vendor/jquery/jquery-3.2.1.min.js')?>"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url('assets/login/vendor/animsition/js/animsition.min.js')?>"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url('assets/login/vendor/bootstrap/js/popper.js')?>"></script>
	<script src="<?php echo base_url('assets/login/vendor/bootstrap/js/bootstrap.min.js')?>"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url('assets/login/vendor/select2/select2.min.js')?>"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url('assets/login/vendor/daterangepicker/moment.min.js')?>"></script>
	<script src="<?php echo base_url('assets/login/vendor/daterangepicker/daterangepicker.js')?>"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url('assets/login/vendor/countdowntime/countdowntime.js')?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/plugins/notifications/sweet_alert.min.js') ?>"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url('assets/login/js/main.js')?>"></script>
	<script src="<?php echo base_url('assets/plugins/jQuery/purify.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/mytemplate_backend/modules/datepicker/js/bootstrap-datepicker.js'); ?>"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#tanggal_lahir').datepicker({
	            autoclose: true,
	            format: 'yyyy-mm-dd',
	            endDate: new Date()  
	        });
		});

		$(window).on('load', function () {
            $("#loading").fadeOut("fast");
        });

		<?php
			if($this->session->flashdata('notif')):
		?>
		swal({
			text: "<span style='color:#f44336'><?php echo $this->session->flashdata('notif'); ?></span>",
			title: "",
			type: "error",
			html: true,
			confirmButtonText: 'Close',
  			confirmButtonColor: '#f44336',
		});
		<?php
			endif;
		?>

		function Angkasaja(evt) 
        {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }

		function get_form(param){
			if (param == 'login') {
				$('#form-login').show();
				$('#form-reset-password').hide();
				$('#form-lable').text('LOGIN');
			}else{
				$('#form-login').hide();
				$('#form-reset-password').show();
				$('#form-lable').text('RESET PASSWORD');
			}
		}

		function login(){
			var stat = true;
			var username = $('[name="username"]');
			if($(username).val().trim() == ''){
				var thisAlert = $(username).parent();
        		$(thisAlert).addClass('alert-validate');
                var stat = false;
            }
            var pass = $('[name="pass"]');
            if($(pass).val().trim() == ''){
				var thisAlert = $(pass).parent();
        		$(thisAlert).addClass('alert-validate');
                var stat = false;
            }

            if (stat == false) {
            	return false;
            }

            $('#loading').show();

            var form = $('#form-login')[0];
          	var data = new FormData(form);

            $.ajax({ 
               	url: "<?php echo base_url('login/ajax_proses') ?>",
               	method:"POST",
               	data: data,
               	dataType: "json",
               	processData: false,
    			contentType: false,
    			cache:false,   
               	success: function(data){
               		$('#loading').hide();
               		if (data.status) {
               			// swal({type: 'success',title: 'Sukses',text: 'Berhasil Login'});
               			if (data.redirect) {
               				window.location.href = data.redirect;
               			}else{
               				$('.wrap-login100').css('width', '1000px');
               				$('#form-login').hide();
							$('#form-lengkapi').show();
							$('#form-lengkapi [name="username"]').val(username.val());
							$('#form-lengkapi [name="pass"]').val(pass.val());
							$('#form-lengkapi [name="nik"]').val(data.data.nik);
							$('#form-lengkapi [name="email"]').val(data.data.email);
							$('#form-lengkapi [name="no_telp"]').val(data.data.no_telp);
							get_kec();
							if (data.data.ceknik) {
								$('#form-lengkapi [name="nama"]').val(data.data.ceknik.NAMA_LGKP);
								$("#form-lengkapi input[name=jenis_kelamin][value="+data.data.ceknik.JENIS_KLMIN+"]").prop('checked', true);
								$('#form-lengkapi [name="tempat_lahir"]').val(data.data.ceknik.TMPT_LHR);
								$('#form-lengkapi [name="tanggal_lahir"]').val(data.data.ceknik.TGL_LHR);
								$('#form-lengkapi [name="kec"]').val(data.data.ceknik.NO_KEC);
								get_kel();
								$('#form-lengkapi [name="kel"]').val(data.data.ceknik.NO_KEL);
								$('#form-lengkapi [name="no_rt"]').val(data.data.ceknik.NO_RT);
								$('#form-lengkapi [name="no_rw"]').val(data.data.ceknik.NO_RW);
								$('#form-lengkapi [name="alamat"]').val(data.data.ceknik.ALAMAT);
								$('#form-lengkapi [name="kode_pos"]').val(data.data.ceknik.KODE_POS);
								$('#form-lengkapi [name="agama"]').val(data.data.ceknik.AGAMA);
							}
							
               			}
               		}else{
               			if (data.inputerror) {
	               			for (var i = 0; i < data.inputerror.length; i++) {
	                            $('[name="'+data.inputerror[i]+'"]').parent().addClass('alert-validate');
	                        }
               			}

               			if (data.message) {
               				swal({type: 'error',title: 'Error',text: data.message});
               			}
               		}
				},
				error: function (jqXHR, textStatus, errorThrown){
					$('#loading').hide();
	                swal({type: 'error',title: 'Error',text: 'Terjadi Kesalahan !'});
	            }  
          	});
		}

		function reset_password(){
			var nik = $('[name="nik"]');
			if($(nik).val().trim() == ''){
				var thisAlert = $(nik).parent();
        		$(thisAlert).addClass('alert-validate');
                return false;
            }

            $('#loading').show();

            var form = $('#form-reset-password')[0];
          	var data = new FormData(form);

            $.ajax({ 
               	url: "<?php echo base_url('login/ajax_reset_pass') ?>",
               	method:"POST",
               	data: data,
               	dataType: "json",
               	processData: false,
    			contentType: false,
    			cache:false,   
               	success: function(data){
               		$('#loading').hide();
               		if (data.success) {
               			swal({type: 'success',title: 'Sukses',text: 'Berhasil Mereset Password, silahkan cek email anda'});
               			get_form('login');
               		}else{
               			swal({type: 'error',title: 'Error',text: data.message});
               		}
				},
				error: function (jqXHR, textStatus, errorThrown){
					$('#loading').hide();
	                swal({type: 'error',title: 'Error',text: 'Terjadi Kesalahan !'});
	            }  
          	});
		}

		$('.domisili').click(function(event) {
			get_prop();
		});

		function get_prop(){
			if ($('#domisili1').is(':checked')) {
				$('[name="prop"]').html('<option value="36">BANTEN</option>');
				$('[name="kab"]').html('<option value="71">KOTA TANGERANG</option>');
				get_kec();
			}else{
		    	$.ajax({
					url : '<?php echo base_url("ajax/ajax_data"); ?>',
					type: 'post',
					dataType:'html',
					async:false,
					data: {
						type : 'data_propinsi',
						<?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
					},
					success: function (data) {
						$('[name="prop"]').html(DOMPurify.sanitize( data, { SAFE_FOR_JQUERY: true } ));
						$('[name="kab"]').html('');
						$('[name="kec"]').html('');
						$('[name="kel"]').html('');
					}
				});
			}
	    }

	    function get_kab(){
	    	var id_prop = $('[name="prop"]').val();
	    	$.ajax({
				url : '<?php echo base_url("ajax/ajax_data"); ?>',
				type: 'post',
				dataType:'html',
				async:false,
				data: {
					data_propinsi: id_prop,
					type : 'data_kota',
					<?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
				},
				success: function (data) {
					if (id_prop == 0) {
						$('[name="kab"]').html('');
						$('[name="kec"]').html('');
						$('[name="kel"]').html('');
					}else{
						$('[name="kab"]').html(DOMPurify.sanitize( data, { SAFE_FOR_JQUERY: true } ));
						$('[name="kec"]').html('');
						$('[name="kel"]').html('');
					}
				}
			});
	    }

	    function get_kec(){
	    	var id_prop = $('[name="prop"]').val();
	    	var id_kota = $('[name="kab"]').val();

	    	$.ajax({
				url : '<?php echo base_url("ajax/ajax_data"); ?>',
				type: 'post',
				dataType:'html',
				async:false,
				data: {
					data_propinsi: id_prop,
					data_kota : id_kota,
					type : 'data_kecamatan',
					<?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
				},
				success: function (data) {
					if(id_kota == 0)
					{
						$('[name="kec"]').html('');
						$('[name="kel"]').html('');
					}else{
						$('[name="kec"]').html(DOMPurify.sanitize( data, { SAFE_FOR_JQUERY: true } ));	
						$('[name="kel"]').html('');				
					}
				}
			});
	    }

	    function get_kel(){
	    	var id_prop = $('[name="prop"]').val();
	    	var id_kota = $('[name="kab"]').val();
	    	var id_kec = $('[name="kec"]').val();

	    	$.ajax({
				url : '<?php echo base_url("ajax/ajax_data"); ?>',
				type: 'post',
				dataType:'html',
				async:false,
				data: {
					data_propinsi: id_prop,
					data_kota : id_kota,
					data_kec : id_kec,
					type : 'data_kelurahan',
					<?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
				},
				success: function (data) {
					if(id_kec == 0)
					{
						$('[name="kel"]').html('');
					}else{
						$('[name="kel"]').html(DOMPurify.sanitize( data, { SAFE_FOR_JQUERY: true } ));					
					}
				}
			});
	    }

		function login_lengkapi(){
			$('#loading').show();

            var form = $('#form-lengkapi')[0];
          	var data = new FormData(form);

            $.ajax({ 
               	url: "<?php echo base_url('login/ajax_proses_lengkapi') ?>",
               	method:"POST",
               	data: data,
               	dataType: "json",
               	processData: false,
    			contentType: false,
    			cache:false,   
               	success: function(data){
               		$('#loading').hide();
               		if (data.status) {
               			window.location.href = data.redirect;
               		}else{
               			if (data.inputerror) {
	               			for (var i = 0; i < data.inputerror.length; i++) {
	                            $('[name="'+data.inputerror[i]+'"]').parent().addClass('alert-validate');
	                        }
               			}

               			if (data.message) {
               				swal({type: 'error',title: 'Error',text: data.message});
               			}
               		}
				},
				error: function (jqXHR, textStatus, errorThrown){
					$('#loading').hide();
	                swal({type: 'error',title: 'Error',text: 'Terjadi Kesalahan !'});
	            }  
          	});
		}
	</script>
</body>
</html>