<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Agenda_model extends CI_Model{
	
	public function __construct()
	{
		parent::__construct();
    }

    private function _q_agenda(){
    	$this->db->select('a.*,MONTH(a.tanggal) as bulan,DAY(a.tanggal) as day');
		$this->db->from('m_agenda a');
		$this->db->where('a.status','aktif');
    }

    private function _get_agenda(){
    	$this->_q_agenda();
		$cari = htmlentities($this->input->get('cari_agenda',true), ENT_QUOTES, 'UTF-8'); 
		if($cari){
			$this->db->like('a.judul',''.$cari.'');
		}
	}
     
	public function getAgenda($limit=null,$offset=null)
	{
		$this->_get_agenda();
		if ($limit) {
			$this->db->limit($limit,$offset);
		}
		$this->db->order_by('a.created_at DESC');
		return $this->db->get()->result();
	}

	public function get_count_all_agenda(){
		$this->_get_agenda();
		return $this->db->count_all_results();
	}

	function get_detail_agenda($kode_agenda){
		$this->_q_agenda();
		$this->db->where('a.kode_agenda',(int)$kode_agenda);
		$result = $this->db->get()->row();
		return $result;
	}

	function get_agenda_lain($kode_agenda){
		$this->_q_agenda();
		$this->db->where('a.kode_agenda !=',(int)$kode_agenda);
		$this->db->limit(5);
		$this->db->order_by('rand(id_agenda)');
		$result = $this->db->get()->result();
		return $result;
	}

	function get_cari_agenda($q=null){
		$this->db->select('a.id_agenda,a.kode_agenda,a.judul');
		$this->db->from('m_agenda a');
		$this->db->where('a.status','aktif');

        if($q != null){
            $this->db->like('a.judul', $q);
            $this->db->limit(100); 
        }else{
            $this->db->limit(20);
        }

		$this->db->order_by('a.created_at','desc');
        $data = $this->db->get()->result();
        return $data;
	}
}
?>