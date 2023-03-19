<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function index() {
		if($this->user_model->is_umkm_admin() OR $this->user_model->is_umkm_user() OR $this->user_model->is_umkm_user())
		{
			redirect(base_url());
		}

		if($this->input->post('username'))
		{
			$username 	= $this->input->post('username',true);
			$pass 		= $this->input->post('pass',true);

			if(strtolower($username) == 'walikota')
			{
				$username = 'walikota';
			}elseif(strtolower($username) == 'wakilwalikota')
			{
				$username 	= 'wakilwalikota';
				$pas 		= 'tangerang2';
			}
			
			$this->curl->create('http://opendatav2.tangerangkota.go.id/services/auth/login_v2/uid/'.($username).'/pid/'.($pass).'/format/json');
			$this->curl->http_login(REST_U, REST_P);
			$result = json_decode($this->curl->execute(), true);
			if ($result) {
				$cek = $this->user_model->cek_login();
				if($cek)
				{
					if($cek->status)
					{
						$this->user_model->set_session($cek);
						$data_login = array(
							'last_login'	=> date('Y-m-d H:i:s')
						);
						$this->query_model->update('m_pengguna',array('id_pengguna' => $this->session->user_id), $data_login);
						redirect(base_url());	
					}
					else{
						$this->session->set_flashdata('notif','Maaf username anda tidak aktif silahkan hubungi adminstrator');
						$this->session->set_flashdata('username',$this->input->post('username'));
						redirect(base_url('login'));
					}
				}
				else{
					$this->session->set_flashdata('notif','Maaf username anda tidak terdaftar disistem');
					$this->session->set_flashdata('username',$this->input->post('username'));
					redirect(base_url('login'));
				}
				
			}
			else{
				$nik = $this->input->post('username');
				$pas = $this->input->post('pass');
				$plat = 'Portal-UMKM';

				$useragent = 'Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0';
				$json_url = 'https://service-tlive.tangerangkota.go.id/services/tlive/auth/login';
				$ch = curl_init( $json_url );
				curl_setopt($ch, CURLOPT_USERAGENT, $useragent );
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS,"user=".$nik."&password=".$pas."&platform=".$plat);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_USERPWD, SERV_U . ':' . SERV_P);
				$result = json_decode(curl_exec($ch),true);
				// echo json_encode($result);
				// exit();
				if($result['success'])
				{
					$id = $this->user_model->cek_user($result);
					if (!$id['success']) {
						$this->session->set_flashdata('notif',$id['message']);
						$this->session->set_flashdata('username',$this->input->post('username'));
						redirect(base_url('login'));
					}

					if($this->user_model->cek_status()){
						$foto = get_foto($result['data']['token']);
						$data_foto = array(
							'foto'   => $foto
						);
						$query['select']	= 'id_umkm';
						$query['table']		= 'm_umkm';
						$query['where']		= '(id_status = 1 OR id_status = 2 OR id_status = 4) AND username ='.$result['data']['user']['nik'];
						$data_umkm 			= $this->query_model->getData($query);
						$umkm = array();
						foreach ($data_umkm as $key => $value) {
							$umkm[] = $value->id_umkm;
						}
						
						if(empty($umkm)){
							$status = false;
							$user_group = 'Customer';
							$umkm_id = 0;
						}else{
							$status = true;
							$user_group = 'UMKM';
							$umkm_id = $umkm;
						}

						$session = array(
							'penjual_umkm_login'=> $status,
							'user_umkm_login' 	=> true,
							'identity'          => $result['data']['user']['nik'],
							'email'             => $result['data']['user']['email'],
							'nama_lengkap'      => $result['data']['user']['nama'],
							'umkm_id'			=> $umkm_id,
							'user_id'           => $id['id_pengguna'],
							'old_last_login'    => date('Y-m-d H:i:s'),
							'token'             => $result['data']['token'],
							'user_group'		=> $user_group,
							'foto'				=> $foto,
						);
						
						$this->session->set_userdata($session);

						$this->query_model->update('m_pengguna',array('id_pengguna' => $this->session->user_id), $data_foto);
						
						$data_login = array('last_login' => date('Y-m-d H:i:s'));
						$this->query_model->update('m_pengguna',array('id_pengguna' => $this->session->user_id), $data_login);

						redirect(base_url());
					}else{
						$this->session->set_flashdata('notif','Maaf username anda tidak aktif silahkan hubungi adminstrator');
						$this->session->set_flashdata('username',$this->input->post('username'));
						redirect(base_url('login'));
					}
				}else{
					$this->session->set_flashdata('notif','Username atau Password Salah, silahkan ulangi lagi');
					$this->session->set_flashdata('username',$this->input->post('username'));
					redirect(base_url('login'));
				}
			}
		}
		$this->data = array(
			'name'         => $this->security->get_csrf_token_name(),
			'hash'        => $this->security->get_csrf_hash(),
		);
		$this->load->view("index",$this->data);
	}

	public function ajax_proses() {
		$this->_validate();
		$nik = $this->input->post('username');
			$pas = $this->input->post('pass');
			$plat = 'Portal-UMKM';

			$useragent = 'Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0';
			$json_url = 'https://service-tlive.tangerangkota.go.id/services/tlive/auth/login';
			$ch = curl_init( $json_url );
			curl_setopt($ch, CURLOPT_USERAGENT, $useragent );
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS,"user=".$nik."&password=".$pas."&platform=".$plat);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_USERPWD, SERV_U . ':' . SERV_P);
			$result = json_decode(curl_exec($ch),true);
			// echo json_encode($result);
			// exit();
			if($result['success'])
			{
				$id = $this->user_model->cek_user($result);
				if (!$id['success']) {
					$this->session->set_flashdata('notif',$id['message']);
					$this->session->set_flashdata('username',$this->input->post('username'));
					redirect(base_url('login'));
				}
				if($this->user_model->cek_status())
				{
					$foto = get_foto($result['data']['token']);
					$data_foto = array(
						'foto'   => $foto
					);

					$query['select']	= 'id_umkm';
					$query['table']		= 'm_umkm';
					$query['where']		= '(id_status = 1 OR id_status = 2) AND username ='.$result['data']['user']['nik'];
					$data_umkm 			= $this->query_model->getData($query);
					$umkm = array();
					foreach ($data_umkm as $key => $value) {
						$umkm[] = $value->id_umkm;
					}

					if(empty($umkm)){
						$status = false;
						$user_group = 'Customer';
						$umkm_id = 0;
					}else{
						$status = true;
						$user_group = 'UMKM';
						$umkm_id = $umkm;
					}

					$session = array(
						'penjual_umkm_login'=> $status,
						'user_umkm_login' 	=> true,
						'identity'          => $result['data']['user']['nik'],
						'email'             => $result['data']['user']['email'],
						'nama_lengkap'      => $result['data']['user']['nama'],
						'umkm_id'			=> $umkm_id,
						'user_id'           => $id['id_pengguna'],
						'old_last_login'    => date('Y-m-d H:i:s'),
						'token'             => $result['data']['token'],
						'user_group'		=> $user_group,
						'foto'				=> $foto,

					);
					
					$this->session->set_userdata($session);

					$this->query_model->update('m_pengguna',array('id_pengguna' => $this->session->user_id), $data_foto);
					$data_login = array('last_login' => date('Y-m-d H:i:s'));
					$this->query_model->update('m_pengguna',array('id_pengguna' => $this->session->user_id), $data_login);

					echo json_encode(['success' => true, 'message' => 'Selamat login portal UMKM berhasil.','status' => TRUE]);
				}else{

					echo json_encode(['success' => false, 'message' => 'Maaf username anda tidak aktif silahkan hubungi adminstrator','status' => TRUE]);
				}
			}else{
				echo json_encode(['success' => false, 'message' => $result['message'],'status' => TRUE]);
			}
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
			'last_login'	=> date('Y-m-d H:i:s')
		);
		$this->query_model->update('m_pengguna',array('id_pengguna' => $this->session->user_id), $data);
		$this->session->sess_destroy();
		redirect(base_url());
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