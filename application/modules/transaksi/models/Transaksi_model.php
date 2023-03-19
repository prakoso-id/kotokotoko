<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Transaksi_model extends CI_Model{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
    }
    
	public function getStatusTransaksi($id)
	{
		$this->db->select('*');
		$this->db->from('m_status_transaksi');
		$this->db->where_in('id_status_transaksi',array((int)$id+1,5));
		$this->db->limit('3');
		$query = $this->db->get()->result();
		return $query;
	}
	
	function get_m_status_transaksi(){
     	$this->db->select('*');
		$this->db->from('m_status_transaksi');
		return $this->db->get()->result();
	}

	function get_m_kurir(){
		$res = $this->db->get_where('m_kurir',array('status' => 1 ))->result();
		return $res;
	}

	function get_kurir_umkm($id_umkm){
		$this->db->select('id_kurir');
		$this->db->from('m_umkm');
		$this->db->where('id_umkm',$id_umkm);
		return $this->db->get()->row();
	}

	function detail_pesanan($id_transaksi){
		$this->db->select('a.id_transaksi,b.nama_status, a.created_at,a.id_umkm,a.username,a.no_invoice,a.id_status_transaksi,
			a.total_harga,a.total_berat,a.total,c.nama_kurir,a.kurir_service,c.kode_kurir,a.no_resi,d.nama_penerima,
			d.no_penerima,d.alamat,d.nama_prop,d.nama_kota,d.nama_kec,d.nama_kel,a.ongkir,e.namausaha,e.username as username_umkm,a.bukti_pembayaran,
			a.tgl_pembayaran,a.tgl_konfirmasi,a.tgl_kirim,a.tgl_sampai,a.pesan_batal,a.metode_bayar');
		$this->db->from('m_transaksi a');
		$this->db->join('m_status_transaksi b','b.id_status_transaksi = a.id_status_transaksi');
		$this->db->join('m_kurir c','c.id_kurir = a.id_kurir');
		$this->db->join('m_alamat d','d.id_alamat = a.id_alamat');
		$this->db->join('m_umkm e','e.id_umkm = a.id_umkm');
		$this->db->where('a.id_transaksi',$id_transaksi);
		$res = $this->db->get()->row();
		return $res;
	}

	function detail_pesanan_belum_bayar_va($va){
		$this->db->select('a.va,a.va_full,a.created_at,a.id_status_transaksi,b.jumlah_yg_dibayar as total_bayar,b.expired_virtual_account,
			d.nama_penerima,d.no_penerima,d.alamat,d.nama_prop,d.nama_kota,d.nama_kec,d.nama_kel');
		$this->db->from('m_transaksi as a');
		$this->db->join('pembayaran_VA as b','b.no_virtual_acount = a.va');
		$this->db->join('m_alamat as d','d.id_alamat = a.id_alamat');
		$this->db->where('a.id_status_transaksi','0');
		$this->db->where('a.va_full',$va);
		$this->db->group_by('a.va');
		$res = $this->db->get()->row();
		return $res;
	}

	function get_produk_transaksi($id_transaksi){
		$this->db->select('a.id_produk,a.quantity,a.harga,a.catatan,a.jumlah_berat,b.id_umkm,b.nama_produk,b.kode_produk,(select foto from m_produk_foto  WHERE id_produk = a.id_produk LIMIT 1) as foto');
		$this->db->from('m_transaksi_detail a');
		$this->db->join('m_produk b','b.id_produk = a.id_produk');
		$this->db->where('a.id_transaksi',$id_transaksi);
		$res = $this->db->get()->result();
		return $res;
	}

	function get_transaksi_va($va){
		$this->db->select('a.id_transaksi,a.id_status_transaksi,a.no_invoice,a.total_harga,a.ongkir,a.total,a.id_umkm,b.namausaha,b.username as nik_umkm');
		$this->db->from('m_transaksi a');
		$this->db->join('m_umkm as b','b.id_umkm = a.id_umkm');
		$this->db->where('a.va_full',$va);
		$res = $this->db->get()->result();
		return $res;
	}

	function ratting_ulasan($id_transaksi){
		$this->db->select('a.id_transaksi,a.id_umkm,c.namausaha,c.username as username_umkm,d.nama_kel, e.logo_umkm');
		$this->db->from('m_transaksi a');
		$this->db->join('m_umkm c','c.id_umkm = a.id_umkm');
		$this->db->join('m_umkm_alamat d','d.id_umkm = c.id_umkm','left');
		$this->db->join('m_umkm_berkas e','e.id_umkm = c.id_umkm','left');
		$this->db->where('a.id_transaksi',$id_transaksi);
		$res = $this->db->get()->row();
		return $res;
	}

	function data_ratting($id_transaksi){
		$res = $this->db->get_where('m_ulasan',array('id_transaksi' => $id_transaksi ))->row();
		return $res;
	}

	function tambah_ulasan($id_transaksi){
		$this->db->select('a.id_transaksi_detail,a.id_produk,a.quantity,a.harga,a.catatan,b.id_umkm,b.nama_produk,
                b.kode_produk,(select foto from m_produk_foto  WHERE id_produk = a.id_produk LIMIT 1) as foto,c.username as username_toko');
		$this->db->from('m_transaksi_detail a');
		$this->db->join('m_produk b','b.id_produk = a.id_produk');
		$this->db->join('m_umkm c','c.id_umkm = b.id_umkm');
		$this->db->where('a.id_transaksi',$id_transaksi);
		$res = $this->db->get()->result();
		return $res;
	}

	function view_ulasan($id_transaksi){
		$this->db->select('a.quantity,a.harga,a.catatan, b.id_umkm,b.nama_produk,b.kode_produk,(select foto from m_produk_foto  WHERE id_produk = a.id_produk LIMIT 1) as foto,a.id_produk,m.ratting, m.deskripsi');
		$this->db->from('m_ulasan m');
		$this->db->join('m_transaksi_detail a','a.id_transaksi_detail = m.id_transaksi_detail');
		$this->db->join('m_produk b','b.id_produk = a.id_produk');
		$this->db->where('a.id_transaksi',$id_transaksi);
		$res = $this->db->get()->result();
		return $res;
	}

	function detail_pembayaran($id_transaksi){
		$this->db->select('a.id_transaksi,a.no_invoice,a.total,a.total_harga,a.ongkir,a.va,b.namausaha,b.no_rekening,
                b.an_rekening,b.nama_bank,b.username');
		$this->db->from('m_transaksi a');
		$this->db->join('m_umkm b','b.id_umkm = a.id_umkm');
		$this->db->where('a.id_transaksi',$id_transaksi);
		$res = $this->db->get()->row();
		return $res;
	}

	function detail_pembayaran_va($no_va){
		$this->db->select('a.va_full as va,a.jumlah_yg_dibayar as total,a.expired_virtual_account');
		$this->db->from('pembayaran_VA as a');
		$this->db->where('a.va_full',$no_va);
		$res = $this->db->get()->row();
		return $res;
	}
}