<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User_model extends CI_Model
{
     public function __construct()
	{
		parent::__construct();
		$this->load->database();
     }
     
     public function cek_login($username)
     {
          $this->db->select('*');
          $this->db->from('m_pengguna');
          $this->db->where('username',$username);
		$data = $this->db->get()->row();
          return $data;
     }

     public function cek_login_pass($username,$password)
     {
          $this->db->select('*');
          $this->db->from('m_pengguna');
          $this->db->where('username',$username);
          $this->db->where('password',hash( "sha256", $password ));
		$data = $this->db->get()->row();
          return $data;
     }

     public function set_session($data){ //set session user pegawai simasn
          $session = array(
               HASH		               => true,
               'identity'               => $data->username,
               'email'                  => '',
               'nama_lengkap'           => $data->nama,
               'user_id'                => $data->id_pengguna,
               'old_last_login'         => $data->last_login,
               'group_id'               => $data->id_group,

          );
          $this->session->set_userdata($session);
          return true;
     }

     public function is_login()
     {
          if($this->is_umkm_admin()  OR $this->is_umkm_user() )
          {
               return true;
          }else{
               return false;
          }
     }

     public function is_umkm_admin()
     {
          if(isset($_SESSION[HASH]))
          {
               if($_SESSION[HASH] == true AND $this->session->group_id == 1)
               {
                    return true;
               }
               else{
                    return false;
               }
          }
     }

     public function is_umkm_verifikator()
     {
          if(isset($_SESSION[HASH]))
          {
               if($_SESSION[HASH] == true AND $this->session->group_id == 3)
               {
                    return true;
               }
               else{
                    return false;
               }
          }
     }

     public function is_umkm_user()
     {
          if($this->session->user_umkm_login == true)
          {
               return true;
          }else{
               return false;
          }
     }

     public function is_umkm_penjual()
     {
          if($this->session->penjual_umkm_login == true)
          {
               return true;
          }else{
               return false;
          }
     }

     public function is_verif_tlive()
     {
          if($this->session->verif_tlive == true)
          {
               return true;
          }else{
               return false;
          }
     }

     public function cek_user($data){
          //cek by nik
          $this->db->select('id_pengguna,username,status,nama');
          $this->db->from('m_pengguna');
          $this->db->where('username',$data['data']['user']['nik']);
          $query    = $this->db->get();
          $cek      = $query->num_rows();
          $hasil    = $query->row();
          
          if($cek == 0){ //jika nik belum terdaftar di m_pengguna maka insert
               if (isset($data['data']['user']['nama'])) { //jika akun tlive sudah verif
                    $data_post = $this->_data_insert_update_user($data);
                    $data_post['id_pengguna'] = $data['data']['user']['id_user'];
                    $data_post['created_at'] = date('Y-m-d H:i:s');
                    $data_post['status'] = 1;
                    $this->db->insert('m_pengguna',$data_post);
                    $id_pengguna = $this->db->insert_id();   
                    return array('success' => true, 'id_pengguna' => $id_pengguna,'nama' => $data['data']['user']['nama']);
               }else{
                    return array('success' => true, 'id_pengguna' => null);
               }
          }elseif ($cek == 1) { //jika nik sudah terdaftar di m_pengguna maka update
               if ($hasil->status) { //jik status aktif
                    if (isset($data['data']['user']['nama'])) { //jika akun tlive sudah verif
                         $data_post = $this->_data_insert_update_user($data);
                         $this->db->update('m_pengguna', $data_post,array('username' => $data['data']['user']['nik']));
                         $nama = $data['data']['user']['nama'];
                    }else{
                         $nama =  $hasil->nama;
                    }
                    return array('success' => true, 'id_pengguna' => $hasil->id_pengguna,'nama' => $nama);
               }else{ //jika status tidak aktif
                    return array('success' => false, 'message' => 'Maaf username anda tidak aktif silahkan hubungi adminstrator');
               }
          }else{ //jika nik duplikat
               return array('success' => false, 'message' => 'Username duplikat sebanyak '.$cek.' kali, silahkan hubungi Administrator !');
          }
     }

     private function _data_insert_update_user($data){
          $dt = array('id_group'        => 2,
                    'username'          => $data['data']['user']['nik'],
                    'nama'              => $data['data']['user']['nama'],
                    'jenis_kelamin'     => $data['data']['user']['jenis_kelamin'],
                    'tempat_lahir'      => $data['data']['user']['tempat_lahir'],
                    'tanggal_lahir'     => $data['data']['user']['tanggal_lahir'],
                    'alamat'            => $data['data']['user']['alamat'],
                    'email'             => $data['data']['user']['email'],
                    'domisili'          => $data['data']['user']['domisili'],
                    'no_rt'             => $data['data']['user']['no_rt'],
                    'no_rw'             => $data['data']['user']['no_rw'],
                    'no_kel'            => $data['data']['user']['no_kel'],
                    'no_kec'            => $data['data']['user']['no_kec'],
                    'no_kab'            => $data['data']['user']['no_kab'],
                    'no_prop'           => $data['data']['user']['no_prop'],
                    'domisili_kota'     => $data['data']['user']['no_kab'],
                    'domisili_prop'     => $data['data']['user']['no_prop'],
                    'no_telp'           => $data['data']['user']['no_telp'],
                    'kode_pos'          => $data['data']['user']['kode_pos'],
                    'agama'             => $data['data']['user']['agama'],
                    'verif_tlive'       => '1',
               );
          return $dt;
     }

     public function get_data_umkm($username){
          $this->db->select('id_umkm');
          $this->db->from('m_umkm');
          $this->db->where('username',$username);
          $this->db->where_in('id_status',array(1,2,4));
          $result = $this->db->get()->result();
          return $result;
     }

     public function cek_status_umkm()
     {
          $this->db->select('id_status');
          $this->db->from('m_umkm');
          $this->db->where('username',$this->session->identity);
          $data = $this->db->get()->num_rows();
          return $data;
     }    
}
?>