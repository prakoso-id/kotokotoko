<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dasar_hukum_model extends CI_Model{
	
	public function __construct()
	{
		parent::__construct();
    }

    private function _q_dasar_hukum(){
    	$this->db->select('a.*');
		$this->db->from('m_dasar_hukum a');
		$this->db->where('a.status','aktif');

    }

    private function _get_dasar_hukum(){
    	$this->_q_dasar_hukum();
		$cari = htmlentities($this->input->get('cari_berita',true), ENT_QUOTES, 'UTF-8'); 
		if($cari){
			$this->db->like('a.judul',''.$cari.'');
		}
	}
     
	public function getDasarHukum($limit=null,$offset=null)
	{
		$this->_get_dasar_hukum();
		if ($limit) {
			$this->db->limit($limit,$offset);
		}
		$this->db->order_by('a.created_at DESC');
		return $this->db->get()->result();
	}

	public function get_count_all_dasar_hukum(){
		$this->_get_dasar_hukum();
		return $this->db->count_all_results();
	}

	function get_detail_dasar_hukum($kode){
		$this->_q_dasar_hukum();
		$this->db->where('a.kode_dasar_hukum',(int)$kode);
		$result = $this->db->get()->row();
		return $result;
	}

	function get_dasar_hukum_lain($kode){
		$this->_q_dasar_hukum();
		$this->db->where('a.kode_dasar_hukum !=',(int)$kode);
		$this->db->limit(5);
		$this->db->order_by('rand(id_dasar_hukum)');
		$result = $this->db->get()->result();
	}
}
?>