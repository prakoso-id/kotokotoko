<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_pesan extends CI_model
{
	public function __construct()
    {
        parent::__construct();
    }

	public function get_list_pesan()
    {
        $this->db->select("a.pesan, a.created_at,b.id_group,b.username_penerima,b.username_pengirim,c.nama_perusahaan,c.username, d.logo_umkm");
        $this->db->from('m_pesan_detail a');
        $this->db->join('m_pesan b','b.id_group = a.id_group');
        $this->db->join('m_umkm c','c.username = b.username_pengirim and c.id_status = 1');
        $this->db->join('m_umkm_berkas d','d.id_umkm = c.id_umkm');
        $this->db->group_by('b.username_penerima');
        $this->db->where('b.username_penerima',$this->session->identity);
        $this->db->order_by('a.id_pesan_detail', 'desc');
        $result = $this->db->get()->result();
        return $result;
    } 
}
?>