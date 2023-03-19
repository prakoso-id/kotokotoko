<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Agenda_model extends CI_Model{
	
	public function __construct()
	{
		parent::__construct();
    }

    private function _get_q_agenda($cari=null,$where=null){
    	$this->db->select('a.*');
		$this->db->from('m_agenda a');
		$this->db->where('a.status','aktif');
		if($cari){
			$this->db->like('a.judul',''.$cari.'');
		}
		if ($where){
			$this->db->where($where);
		}
	}
     
	public function getAgenda($limit=null,$offset=null,$cari=null,$where=null)
	{
		$this->_get_q_agenda($cari,$where);
		if ($limit) {
			$this->db->limit($limit,$offset);
		}
		$this->db->order_by('a.created_at DESC');
		return $this->db->get()->result();
	}

	public function get_count_all_agenda($cari=null,$where=null){
		$this->_get_q_agenda($cari,$where);
		return $this->db->count_all_results();
	}
}
?>