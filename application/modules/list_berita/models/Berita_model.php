<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Berita_model extends CI_Model{
	
	public function __construct()
	{
		parent::__construct();
    }

    private function _q_berita(){
    	$this->db->select('a.*,MONTH(a.created_at) as bulan,DAY(a.created_at) as tanggal,DATE(a.created_at) as date,b.nama as nama_pengguna');
		$this->db->from('m_berita as a');
		$this->db->join('m_pengguna as b','b.username = a.username','left');
		$this->db->where('a.status_berita','aktif');
    }

    private function _get_berita(){
    	$this->_q_berita();
		$cari = htmlentities($this->input->get('cari_berita',true), ENT_QUOTES, 'UTF-8'); 
		if($cari){
			$this->db->like('a.judul',''.$cari.'');
		}
	}
     
	public function getBerita($limit=null,$offset=null)
	{
		$this->_get_berita();
		if ($limit) {
			$this->db->limit($limit,$offset);
		}
		$this->db->order_by('a.created_at DESC');
		return $this->db->get()->result();
	}

	public function get_count_all_berita(){
		$this->_get_berita();
		return $this->db->count_all_results();
	}

	function get_detail_berita($kode_berita){
		$this->_q_berita();
		$this->db->where('a.kode_berita',(int)$kode_berita);
		$result = $this->db->get()->row();
		return $result;
	}

	function get_berita_lain($kode_berita){
		$this->_q_berita();
		$this->db->where('a.kode_berita !=',(int)$kode_berita);
		$this->db->limit(5);
		$this->db->order_by('rand(id_berita)');
		$result = $this->db->get()->result();
		return $result;
	}

	function get_berita_terbaru(){
		$this->_q_berita();
		$this->db->order_by('a.created_at','desc');
		$this->db->limit(6);
		$result = $this->db->get()->result();
		return $result;
	}

	function get_cari_berita($q=null){
		$this->db->select('a.id_berita,a.kode_berita,a.judul');
		$this->db->from('m_berita a');
		$this->db->where('a.status_berita','aktif');

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