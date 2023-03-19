<!DOCTYPE html>
<html lang="en">
<head>
	<title>LOGIN - Portal UMKM Kota Tangerang</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="<?php echo base_url('assets/images/logo.png') ?>"/>
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
<!--===============================================================================================-->
</head>
<style type="text/css">
	.container-login100{
		background: url('<?php echo base_url('assets/images/bg-login.png') ?>');
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
</style>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
				<span class="login100-form-title p-b-49">
					<a href="<?php echo base_url('') ?>"> 
						<img src="<?php echo base_url('assets/images/logo.png'); ?>" style="width:70px" alt="">
					</a>
					<br>
					<a href="<?php echo base_url('') ?>" style="font-size:24px"> 
						<span id="form-lable">LOGIN</span>
						<p>UMKM Kota Tangerang.</p>
					</a>
				</span>

				<form class="login100-form validate-form" id="form-login" action="" method="post">
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
							<button type="submit" class="login100-form-btn">
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
				
				<div class="container-login100-form-btn">
					<label for="" style="font-size: 12px;margin-top: 20px; text-align: center;">
						Untuk login Portal UMKM menggunakan email dan nik yang terdaftar di Tangerang Live, Aplikasi Tangerang LIVE dapat di download: <a href="https://play.google.com/store/apps/details?id=id.go.tangerangkota.tangeranglive" target="_blank">Google Play Store</a>
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
	<script type="text/javascript">
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

		function reset_password(){
			var nik = $('[name="nik"]');
			if($(nik).val().trim() == ''){
				var thisAlert = $(nik).parent();
        		$(thisAlert).addClass('alert-validate');
                return false;
            }

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
               		if (data.success) {
               			swal({type: 'success',title: 'Sukses',text: 'Berhasil Mereset Password, silahkan cek email anda'});
               			get_form('login');
               		}else{
               			swal({type: 'error',title: 'Error',text: data.message});
               		}
				},
				error: function (jqXHR, textStatus, errorThrown){
	                swal({type: 'error',title: 'Error',text: 'Terjadi Kesalahan !'});
	            }  
          	});
		}
	</script>
</body>
</html>