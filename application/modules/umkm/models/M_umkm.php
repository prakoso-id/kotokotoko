<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_umkm extends CI_model
{
	public function __construct()
    {
        parent::__construct();
    }

	public function get_pengguna($q)
    {
        $this->db->select("*");
        $this->db->from('m_pengguna');

        $this->db->like('username', ''.$q.'');
        $this->db->or_like('nama_lengkap', ''.$q.'');
        $this->db->where('id_group',2);
        $this->db->order_by('id_pengguna', 'desc');
        $this->db->limit(100);

        $result = array();
        $data = $this->db->get()->result();
        foreach ($data as $key => $value) {
            $result[$key]['id']       = $value->id_pengguna;
            $result[$key]['text']     = $value->username;
        }
        return $result;
    }

    public function cek_user($data){
          $this->db->select('id_pengguna,username');
          $this->db->from('m_pengguna');
          $this->db->where('username',$data['result'][0]['nik']);
          $query    = $this->db->get();
          $cek      = $query->num_rows();
          $hasil    = $query->row();
          
          if($cek == 0){
            foreach ($data['result'] as $value) {
                $hasil = array(
                    'id_group'          => 2,
                    'id_pengguna'       => $value['id_user'],
                    'username'          => $value['nik'],
                    'nama'              => $value['nama'],
                    'jenis_kelamin'     => $value['jenis_kelamin'],
                    'tempat_lahir'      => $value['tempat_lahir'],
                    'tanggal_lahir'     => $value['tanggal_lahir'],
                    'alamat'            => $value['alamat'],
                    'email'             => $value['email'],
                    'domisili'          => $value['domisili'],
                    'no_rt'             => $value['no_rt'],
                    'no_rw'             => $value['no_rw'],
                    'no_kel'            => $value['no_kel'],
                    'no_kec'            => $value['no_kec'],
                    'no_kab'            => $value['no_kab'],
                    'no_prop'           => $value['no_prop'],
                    'no_telp'           => $value['no_telp'],
                    'kode_pos'          => $value['kode_pos'],
                    'agama'             => $value['agama'],
                    'status'            => 1,
                    'created_at'        => date('Y-m-d H:i:s'),
               );
            }
            $this->db->insert('m_pengguna',$hasil);
            return true;
          }else{
            return true;
          }
     }
    
}
