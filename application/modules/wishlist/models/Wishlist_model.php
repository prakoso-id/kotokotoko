<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Wishlist_model extends CI_Model{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
    }

    private function _get_q_produk(){
    	$this->db->select('a.kode_produk,a.nama_produk,a.harga,a.stok,a.id_produk,a.diskon,a.diskon_nominal,a.ratting,b.nama_usaha,(select foto from m_produk_foto  WHERE id_produk = a.id_produk LIMIT 1) as foto,(select COUNT(id_ulasan) from m_ulasan where id_produk = a.id_produk) as jumlah_ulasan,d.id_umkm as username,d.username as nik, d.namausaha,e.nama_kec,e.nama_kel,x.id_wishlist');
		$this->db->from('m_wishlist x');
		$this->db->join('m_produk a','a.id_produk = x.id_produk');
		$this->db->join('m_jenis_usaha b','b.id_jenis_usaha = a.id_jenis_usaha','left');
		$this->db->join('m_umkm d','d.id_umkm = a.id_umkm');
		$this->db->join('m_umkm_alamat as e','e.id_umkm = d.id_umkm','left');
		$this->db->where('a.status',1);
		$this->db->where('x.status','like');
		$this->db->where('x.username',$this->session->identity);
		$this->db->where_in('d.id_status',array(1,2));

		$cari = htmlentities($this->input->get('cari',true), ENT_QUOTES, 'UTF-8'); 
		if($cari){
			$this->db->group_start();
			$this->db->like('a.nama_produk',$cari);
			$this->db->or_like('a.tags',$cari);
			$this->db->group_end();
		}
    }
	    
	public function getProduk($limit=null,$offset=null)
	{
		$this->_get_q_produk();
		if ($limit) {
			$this->db->limit($limit,$offset);
		}
		$this->db->order_by('x.created_at DESC');
		$query = $this->db->get()->result();
		// var_dump($this->db->last_query()); die();
		return $query;
	}

	public function get_count_all_produk(){
		$this->_get_q_produk();
		return $this->db->count_all_results();
	}
}
?>