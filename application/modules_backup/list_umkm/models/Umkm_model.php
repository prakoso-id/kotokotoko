<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Umkm_model extends CI_Model{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
    }

    private function _get_q_umkm($cari=null,$where=null){
    	$this->db->select('a.id_umkm,a.id_pengguna ,a.namausaha,a.username,b.nama_kec,b.nama_kel,b.alamat,c.nama_usaha,d.logo_umkm');
		$this->db->from('m_umkm a');
		$this->db->join('m_umkm_alamat b','b.id_umkm = a.id_umkm','left');
		$this->db->join('m_jenis_usaha c','c.id_jenis_usaha = a.id_jenis_usaha','left');
		$this->db->join('m_umkm_berkas d','d.id_umkm = a.id_umkm','left');
		$this->db->where_in('a.id_status',array(1,2,4));
		if($cari){
			$this->db->like('a.namausaha',''.$cari.'');
		}
		if ($where){
			$this->db->where($where);
		}
	}
     
	public function getUmkm($limit=null,$offset=null,$cari=null,$where=null)
	{
		$this->_get_q_umkm($cari,$where);
		if ($limit) {
			$this->db->limit($limit,$offset);
		}
		$this->db->order_by('a.created_at DESC');
		return $this->db->get()->result();
	}

	public function get_count_all_umkm($cari=null,$where=null){
		$this->_get_q_umkm($cari,$where);
		return $this->db->count_all_results();
	}

	public function getdataProduk($id,$keyword=null,$tags=null)
	{
		$this->db->select('a.kode_produk,a.nama_produk,a.harga,a.id_produk,a.diskon,a.ratting,b.nama_usaha,(select foto from m_produk_foto  WHERE id_produk = a.id_produk LIMIT 1) as foto,d.id_umkm as username,a.tags');
		$this->db->from('m_produk a');
		$this->db->join('m_jenis_usaha b','b.id_jenis_usaha = a.id_jenis_usaha','left');
		$this->db->join('m_umkm d','d.id_umkm = a.id_umkm');
		
		if(isset($keyword['cari']))
		{
			$this->db->group_start();
			$this->db->like('a.nama_produk',''.$keyword['cari'].'');
			$this->db->or_like('a.tags',''.$keyword['cari'].'');
			$this->db->group_end();
		}
		if(isset($tags))
		{
			$tags = str_replace("-"," ",$tags);
			$this->db->like('a.tags',''.$tags.'');
		}
		$this->db->where('a.id_umkm',(int)$id);
		$this->db->where('a.status',1);
		$this->db->order_by('a.created_at DESC');
		$query = $this->db->get()->result();
		return $query;
	}

	public function getdataUMKM($id)
	{
		$this->db->select('a.id_umkm,a.id_pengguna, a.nama_perusahaan,a.namausaha,a.username,a.situs_web,a.sosmed,a.ojol,b.nama_kec,b.nama_kel,b.alamat,c.nama_usaha');
		$this->db->from('m_umkm a');
		$this->db->join('m_umkm_alamat b','b.id_umkm = a.id_umkm','left');
		$this->db->join('m_jenis_usaha c','c.id_jenis_usaha = a.id_jenis_usaha','left');
		$this->db->where('a.id_umkm',(int)$id);
		$this->db->where_in('a.id_status',array(1,2,4));
		$query = $this->db->get()->row();
		if($query)
		{
			$this->db->select('tags');
			$this->db->from('m_produk');
			$this->db->where('id_umkm',$query->id_umkm);
			$this->db->where('status',1);
			$hasil = $this->db->get()->result();
			$query->produk = $hasil;
		}

		return $query;
	}
}
