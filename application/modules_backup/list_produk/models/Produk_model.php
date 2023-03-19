<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Produk_model extends CI_Model{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
    }

    private function _get_q_produk($cari=null,$where=null){
    	$this->db->select('a.kode_produk,a.nama_produk,a.harga,a.id_produk,a.diskon,a.ratting,b.nama_usaha,(select foto from m_produk_foto  WHERE id_produk = a.id_produk LIMIT 1) as foto,d.id_umkm as username');
		$this->db->from('m_produk a');
		$this->db->join('m_jenis_usaha b','b.id_jenis_usaha = a.id_jenis_usaha','left');
		$this->db->join('m_umkm d','d.id_umkm = a.id_umkm');
		$this->db->join('m_umkm_alamat as e','e.id_umkm = d.id_umkm','left');
		$this->db->join('m_pengguna c','c.id_pengguna = d.id_pengguna','left');
		$this->db->where('a.status',1);
		$this->db->where_in('d.id_status',array(1,2));
		if($cari){
			$this->db->group_start();
			$this->db->like('a.nama_produk',''.$cari.'');
			$this->db->or_like('a.tags',''.$cari.'');
			$this->db->group_end();
		}
		if ($where) {
			$this->db->where($where);
		}
    }
	    
	public function getProduk($limit=null,$offset=null,$cari=null,$where=null)
	{
		$this->_get_q_produk($cari,$where);
		if ($limit) {
			$this->db->limit($limit,$offset);
		}
		$this->db->order_by('a.created_at DESC');
		$query = $this->db->get()->result();
		return $query;
	}

	public function get_count_all_produk($cari=null,$where=null){
		$this->_get_q_produk($cari,$where);
		return $this->db->count_all_results();
	}

	public function getdetailproduk($id)
	{
		$this->db->select('a.id_jenis_usaha,d.id_pengguna,d.namausaha, a.kode_produk, a.nama_produk, a.harga, a.stok, a.id_produk, a.diskon, a.ratting, b.nama_usaha,d.id_umkm as username,d.nama_perusahaan,a.deskripsi,a.dilihat, e.nama_kel, ( select count(z.id_transaksi_detail) from m_transaksi_detail z join m_transaksi x on x.id_transaksi = z.id_transaksi where z.id_produk = a.id_produk AND x.id_status_transaksi = 4) as terjual,d.username as nik,d.id_umkm,d.situs_web as situs_web_toko,d.sosmed as sosmed_toko,d.ojol as ojol_toko, d.no_hp');
		$this->db->from('m_produk a');
		$this->db->join('m_jenis_usaha b','b.id_jenis_usaha = a.id_jenis_usaha','left');
		$this->db->join('m_umkm d','d.id_umkm = a.id_umkm');
		$this->db->join('m_pengguna c','c.id_pengguna = d.id_pengguna','left');
		$this->db->join('m_umkm_alamat e','e.id_umkm = d.id_umkm','left');
		$this->db->where('a.status = 1 AND a.kode_produk = "'.(int)$id.'"');
		$this->db->where_in('d.id_status',array(1,2));
		$query = $this->db->get()->row();
		return $query;
	}
}
