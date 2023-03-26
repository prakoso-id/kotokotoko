<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function index() {
		// if($this->user_model->is_login()){
		// 	redirect(base_url());
		// }

		
		// echo hash( "sha256", '27Nov2003_');die;
		$this->data = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);
		$this->load->view("index",$this->data);
	}

	public function ajax_proses() {
		// if($this->user_model->is_login()){
		// 	echo json_encode(array('status' => true, 'redirect' => base_url()));
		// }

		$this->_validate();
		$username 	= $this->input->post('username',true);
		$pass 		= $this->input->post('pass',true);

		if(strtolower($username) == 'walikota'){
			$username = 'walikota';
		}elseif(strtolower($username) == 'wakilwalikota'){
			$username 	= 'wakilwalikota';
		}

		$cek = $this->user_model->cek_login($username);
		if(!$cek){
			echo json_encode(array('status' => false, 'message' => 'username tidak ada'));
			return;
	   }

		$ready = $this->user_model->cek_login_pass($username, $pass);
		if(!$ready){
			 echo json_encode(array('status' => false, 'message' => 'username atau password salah'));
			 return;
		}
		// //get data umkm yg dimiliki user
		$data_umkm = $this->user_model->get_data_umkm($cek->username);
		$umkm = array();
		if ($data_umkm) {
			foreach ($data_umkm as $key => $value) {
				$umkm[] = $value->id_umkm;
			}
		}
		
		if($cek->id_group !== 1){
			$status = false;
			$user_group = 'Customer';
			$umkm_id = 0;
		}else{
			$status = true;
			$user_group = 'UMKM';
			$umkm_id = $umkm;
		}

		//set session
		$session = array(
			'penjual_umkm_login'=> $status,
			'user_umkm_login' 	=> true,
			'identity'          => $cek->username,
			'email'             => $cek->email,
			'nama_lengkap'      => $cek->nama,
			'umkm_id'			=> $umkm_id,
			'user_id'           => $cek->id_pengguna,
			'old_last_login'    => date('Y-m-d H:i:s'),
			'user_group'		=> $user_group,
		);
		$this->session->set_userdata($session);
		$this->user_model->set_session($cek);
		
		$data_login = array('last_login' => date('Y-m-d H:i:s'));
		$this->query_model->update('m_pengguna',array('id_pengguna' => $this->session->user_id), $data_login);

		
		if($this->input->post('redirurl',true))  {
			echo json_encode(array('status' => true, 'redirect' => $this->input->post('redirurl',true)));
		}else{
			echo json_encode(array('status' => true, 'redirect' => base_url()));
		}
		
		//cek login pegawai  dg akun simasn
		// $this->curl->create('http://opendatav2.tangerangkota.go.id/services/auth/login_v2/uid/'.($username).'/pid/'.($pass).'/format/json');
		// $this->curl->http_login(REST_U, REST_P);
		// $result = json_decode($this->curl->execute(), true);
		// if ($result['success']) { //jika berhasil login pegawai
		// 	$cek = $this->user_model->cek_login($username); //cek data user di m_pengguna 
		// 	if($cek){ //jika terdaftar di m_pengguna
		// 		if($cek->status){ //jika status user aktif
		// 			//set session
		// 			$this->user_model->set_session($cek);
		// 			//update last login
		// 			$data_login = array('last_login' => date('Y-m-d H:i:s'));
		// 			$this->query_model->update('m_pengguna',array('id_pengguna' => $cek->id_pengguna), $data_login);
		// 			echo json_encode(array('status' => true, 'redirect' => base_url('dashboard')));
		// 			exit();
		// 		}else{ //jika status user tidak aktif
		// 			echo json_encode(array('status' => false, 'message' => 'Maaf username anda tidak aktif silahkan hubungi adminstrator'));
		// 			exit();
		// 		}
		// 	}else{ //jika tidak terdaftar di m_pengguna
		// 		echo json_encode(array('status' => false, 'message' => 'Maaf username anda tidak terdaftar disistem'));
		// 		exit();
		// 	}
		// }else{ //jika bukan pegawai
		// 	//cek login akun tlive
		// 	$plat = 'Portal-UMKM';
		// 	$useragent = 'Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0';
		// 	// $json_url = 'https://service-tlive.tangerangkota.go.id/services/tlive/auth/login';
		// 	$json_url = 'https://service-tlive.tangerangkota.go.id/services/tlive/auth/login_umkm';
		// 	$ch = curl_init( $json_url );
		// 	curl_setopt($ch, CURLOPT_USERAGENT, $useragent );
		// 	curl_setopt($ch, CURLOPT_POST, 1);
		// 	curl_setopt($ch, CURLOPT_POSTFIELDS,"user=".$username."&password=".$pass."&platform=".$plat);
		// 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// 	curl_setopt($ch, CURLOPT_USERPWD, SERV_U . ':' . SERV_P);
		// 	$result = json_decode(curl_exec($ch),true);

		// 	// echo json_encode($result);
		// 	// exit();
		// 	if($result['success']){ //jika sukses login akun tlive
		// 		$cek = $this->user_model->cek_user($result); //cek user di m_pengguna
		// 		if (!$cek['success']) { //jika gagal
		// 			echo json_encode(array('status' => false, 'message' => $cek['message']));
		// 			exit();
		// 		}else{
		// 			if (!$cek['id_pengguna']) { //jika akun tlive belum dic=verifikasi dan belum ada di m_pengguna
		// 				$dt = array('nik' => $result['data']['user']['nik'],
		// 							'email' => $result['data']['user']['email'],
		// 							'no_telp' => $result['data']['user']['no_telp']
		// 							);
		// 				$ceknik = cek_nik($result['data']['user']['nik']);
		// 				if ($ceknik['success']) {
		// 					$dt['ceknik'] = $ceknik['decode'][0];
		// 				}
		// 				echo json_encode(array('status' => true, 'message' => 'Akun Tangerang Live Belum diverifikasi','data' => $dt));
		// 				exit();
		// 			}

		// 			//get foto pengguna
		// 			$foto = get_foto($result['data']['token']);
		// 			//get data umkm yg dimiliki user
		// 			$data_umkm = $this->user_model->get_data_umkm($result['data']['user']['nik']);
		// 			$umkm = array();
		// 			if ($data_umkm) {
		// 				foreach ($data_umkm as $key => $value) {
		// 					$umkm[] = $value->id_umkm;
		// 				}
		// 			}
					
		// 			if(empty($umkm)){
		// 				$status = false;
		// 				$user_group = 'Customer';
		// 				$umkm_id = 0;
		// 			}else{
		// 				$status = true;
		// 				$user_group = 'UMKM';
		// 				$umkm_id = $umkm;
		// 			}

		// 			//set session
		// 			$session = array(
		// 				'penjual_umkm_login'=> $status,
		// 				'user_umkm_login' 	=> true,
		// 				'identity'          => $result['data']['user']['nik'],
		// 				'email'             => $result['data']['user']['email'],
		// 				'no_telp'           => $result['data']['user']['no_telp'],
		// 				'nama_lengkap'      => $cek['nama'],
		// 				'umkm_id'			=> $umkm_id,
		// 				'user_id'           => $cek['id_pengguna'],
		// 				'old_last_login'    => date('Y-m-d H:i:s'),
		// 				'token'             => $result['data']['token'],
		// 				'user_group'		=> $user_group,
		// 				'foto'				=> $foto,
		// 				'verif_tlive'		=> true
		// 			);
		// 			$this->session->set_userdata($session);
					
		// 			$data_login = array('last_login' => date('Y-m-d H:i:s'),
		// 								'foto'  => $foto);
		// 			$this->query_model->update('m_pengguna',array('id_pengguna' => $this->session->user_id), $data_login);
		// 			if($this->input->post('redirurl',true))  {
		// 				echo json_encode(array('status' => true, 'redirect' => $this->input->post('redirurl',true)));
		// 			}else{
		// 				echo json_encode(array('status' => true, 'redirect' => base_url()));
		// 			}
		// 		}
		// 	}else{
		// 		//user non tlive
		// 		if ($username == 'hypermartkarawaci' && $pass == 'pass123') {
		// 			$cek = $this->user_model->cek_login($username);
		// 			//get data umkm yg dimiliki user
		// 			$data_umkm = $this->user_model->get_data_umkm($cek->username);
		// 			$umkm = array();
		// 			if ($data_umkm) {
		// 				foreach ($data_umkm as $key => $value) {
		// 					$umkm[] = $value->id_umkm;
		// 				}
		// 			}
					
		// 			if(empty($umkm)){
		// 				$status = false;
		// 				$user_group = 'Customer';
		// 				$umkm_id = 0;
		// 			}else{
		// 				$status = true;
		// 				$user_group = 'UMKM';
		// 				$umkm_id = $umkm;
		// 			}

		// 			//set session
		// 			$session = array(
		// 				'penjual_umkm_login'=> $status,
		// 				'user_umkm_login' 	=> true,
		// 				'identity'          => $cek->username,
		// 				'email'             => $cek->email,
		// 				'nama_lengkap'      => $cek->nama,
		// 				'umkm_id'			=> $umkm_id,
		// 				'user_id'           => $cek->id_pengguna,
		// 				'old_last_login'    => date('Y-m-d H:i:s'),
		// 				'user_group'		=> $user_group,
		// 				'verif_tlive'		=> true
		// 			);
		// 			$this->session->set_userdata($session);
					
		// 			$data_login = array('last_login' => date('Y-m-d H:i:s'));
		// 			$this->query_model->update('m_pengguna',array('id_pengguna' => $this->session->user_id), $data_login);
		// 			if($this->input->post('redirurl',true))  {
		// 				echo json_encode(array('status' => true, 'redirect' => $this->input->post('redirurl',true)));
		// 			}else{
		// 				echo json_encode(array('status' => true, 'redirect' => base_url()));
		// 			}
		// 		}else{
		// 			if ($result['message']) {
		// 				$msg = $result['message'];
		// 			}else{
		// 				$msg = 'Username atau Password Salah, silahkan ulangi lagi';
		// 			}

		// 			echo json_encode(array('status' => false, 'message' => $msg));
		// 		}
		// 	}
		// }
	}

	private function _validate(){

        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('username',true) == '')
        {
            $data['inputerror'][] = 'username';
            $data['error_string'][] = 'Username Harus Diisi';
            $data['status'] = FALSE;
        }

        if($this->input->post('pass',true) == '')
        {
            $data['inputerror'][] = 'pass';
            $data['error_string'][] = 'Password Harus Diisi';
            $data['status'] = FALSE;
        }
        
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

	public function keluar()
	{
		$data = array(
			'last_login'	=> date('Y-m-d H:i:s'),
			// 'token_notif_web' => null
		);
		$this->query_model->update('m_pengguna',array('id_pengguna' => $this->session->user_id), $data);
		$this->session->sess_destroy();
		redirect(base_url());
	}

	public function ajax_proses_daftar()
	{
		$username = $this->input->post('username_daftar',true);
		$cek = $this->user_model->cek_login($username);
		if($cek){
			echo json_encode(array('status' => false, 'message' => 'username '.$username.' sudah ada'));
			return;
	   	}
		$data = array(
			'id_group'			=>2,
			'nama'				=>$this->input->post('nama_daftar',true),
			'username'			=> 		$username,
			'password'			=>		hash( "sha256", $this->input->post('pass_daftar',true)),
			'created_at'        => date('Y-m-d H:i:s'),
			'status'            => 1,
			
		);

		// var_dump($data);die;
		$this->query_model->insert('m_pengguna',$data);
		echo json_encode(array('status' => true, 'redirect' => $this->input->post('redirurl',true)));

	}

	function ajax_reset_pass(){
		$nik = $this->input->post('nik',true);
		if ($nik == '') {
			echo json_encode(array('success' => false,'message' => 'NIK / Email tidak boleh kosong !'));
			exit();
		}

		$useragent = 'Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0';
		$json_url = 'https://service-tlive.tangerangkota.go.id/services/tlive/auth/reset_password_web';
		$ch = curl_init( $json_url );
		curl_setopt($ch, CURLOPT_USERAGENT, $useragent );
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,"user=".$nik);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_USERPWD, SERV_U . ':' . SERV_P);
		$result = json_decode(curl_exec($ch),true);
		echo json_encode($result);
	}


	
}