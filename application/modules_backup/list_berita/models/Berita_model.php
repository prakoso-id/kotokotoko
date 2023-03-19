<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Berita_model extends CI_Model{
	
	public function __construct()
	{
		parent::__construct();
    }

    private function _get_q_berita($cari=null,$where=null){
    	$this->db->select('a.*');
		$this->db->from('m_berita a');
		$this->db->where('a.status_berita','aktif');
		if($cari){
			$this->db->like('a.judul',''.$cari.'');
		}
		if ($where){
			$this->db->where($where);
		}
	}
     
	public function getBerita($limit=null,$offset=null,$cari=null,$where=null)
	{
		$this->_get_q_berita($cari,$where);
		if ($limit) {
			$this->db->limit($limit,$offset);
		}
		$this->db->order_by('a.created_at DESC');
		return $this->db->get()->result();
	}

	public function get_count_all_berita($cari=null,$where=null){
		$this->_get_q_berita($cari,$where);
		return $this->db->count_all_results();
	}
}
?>