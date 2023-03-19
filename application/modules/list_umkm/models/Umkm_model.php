<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Umkm_model extends CI_Model{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
    }

    private function _get_q_data($type,$id_umkm=null){
    	if ($type == 'umkm') {
    		$this->db->select('a.id_umkm,a.namausaha,a.username,a.ratting,a.id_status,a.cara_pembayaran,b.nama_kec,b.nama_kel,b.alamat,c.nama_usaha,
    		d.logo_umkm');
			$this->db->from('m_umkm a');
			$this->db->join('m_umkm_alamat b','b.id_umkm = a.id_umkm','left');
			$this->db->join('m_jenis_usaha c','c.id_jenis_usaha = a.id_jenis_usaha','left');
			$this->db->join('m_umkm_berkas d','d.id_umkm = a.id_umkm','left');
			$this->db->where_in('a.id_status',array(1,2,4));

			$cari = htmlentities($this->input->get('cari',true), ENT_QUOTES, 'UTF-8'); 
			if($cari){
				$this->db->like('a.namausaha',$cari);
			}

			$kat = htmlentities($this->input->get('kat',true), ENT_QUOTES, 'UTF-8');
			if ($kat) {
				$nama_usaha = str_replace('-',' ',strtolower($kat));
				$this->db->where('c.nama_usaha',$nama_usaha);
			}

			$kec = $this->input->get('kec',true);
			if ($kec && is_numeric($kec)) {
				$this->db->where('b.id_kec',$kec);
			}
    	}else{
    		$this->db->select('a.kode_produk,a.nama_produk,a.harga,a.id_produk,a.diskon,a.diskon_nominal,a.ratting,b.nama_usaha,(select foto from m_produk_foto  WHERE id_produk = a.id_produk LIMIT 1) as foto,(select COUNT(id_ulasan) from m_ulasan where id_produk = a.id_produk) as jumlah_ulasan,d.id_umkm as username,d.username as nik,
    			d.namausaha,d.cara_pembayaran,e.nama_kec,e.nama_kel,f.id_wishlist,(SELECT COUNT(id_wishlist) FROM m_wishlist WHERE id_produk = a.id_produk) as jum_wishlist,( select sum(z.quantity) from m_transaksi_detail z join m_transaksi x on x.id_transaksi = z.id_transaksi where z.id_produk = a.id_produk AND x.id_status_transaksi = 4) as jum_terjual,a.stok');
			$this->db->from('m_produk a');
			$this->db->join('m_jenis_usaha b','b.id_jenis_usaha = a.id_jenis_usaha','left');
			$this->db->join('m_umkm d','d.id_umkm = a.id_umkm');
			$this->db->join('m_umkm_alamat as e','e.id_umkm = d.id_umkm','left');
			$this->db->join('m_wishlist f', 'f.id_produk = a.id_produk AND f.status = "like" AND f.username = "'.$this->session->identity.'"','left');
			$this->db->where('a.status',1);
			$this->db->where_in('d.id_status',array(1,2,4));
			// $this->db->where('a.stok >',0);
			$this->db->where('a.is_eorder !=',1);
			$this->db->where('a.id_umkm',(int)$id_umkm);

			$cari = htmlentities($this->input->get('cari',true), ENT_QUOTES, 'UTF-8'); 
			if($cari){
				$this->db->group_start();
				$this->db->like('a.nama_produk',$cari);
				$this->db->or_like('a.tags',$cari);
				$this->db->group_end();
			}

			$kat = htmlentities($this->input->get('kat',true), ENT_QUOTES, 'UTF-8');
			if ($kat) {
				$nama_usaha = str_replace('-',' ',strtolower($kat));
				$this->db->where('b.nama_usaha',$nama_usaha);
			}
    	}
	}
     
	public function getData($limit=null,$offset=null,$type,$id_umkm=null)
	{
		$this->_get_q_data($type,$id_umkm);
		if ($limit) {
			$this->db->limit($limit,$offset);
		}
		if ($type == 'umkm') {
			$this->db->order_by('a.created_at DESC');
		}else{
			$ob = $this->input->get('ob',true);

			if ($ob == 'Terfavorit') {
				$this->db->order_by('jum_wishlist DESC');
			}elseif ($ob == 'Penjualan_Terbaik') {
				$this->db->order_by('a.ratting DESC');
				$this->db->order_by('jumlah_ulasan DESC');
			}elseif ($ob == 'Harga,_termahal-termurah') {
				$this->db->order_by('a.harga DESC');
			}elseif ($ob == 'Harga,_termurah-termahal') {
				$this->db->order_by('a.harga ASC');
			}elseif ($ob == 'Abjad,_Z-A') {
				$this->db->order_by('a.nama_produk DESC');
			}elseif ($ob == 'Abjad,_A-Z') {
				$this->db->order_by('a.nama_produk ASC');
			}elseif ($ob == 'Tanggal,_terlama-terbaru') {
				$this->db->order_by('a.created_at ASC');
			}else{
				$this->db->order_by('a.created_at DESC');
			}
		}
		
		return $this->db->get()->result();
	}

	public function get_count_all_data($type,$id_umkm=null){
		$this->_get_q_data($type,$id_umkm);
		return $this->db->count_all_results();
	}

	function get_produk_umkm($id_umkm){
		$this->db->select('a.id_produk,a.id_umkm,a.kode_produk,a.nama_produk,a.harga,a.diskon,a.diskon_nominal,
		(select foto from m_produk_foto  WHERE id_produk = a.id_produk LIMIT 1) as foto,a.created_at');
		$this->db->from('m_produk as a');
		$this->db->where('a.id_umkm',$id_umkm);
		$this->db->limit(3);
		$this->db->order_by('a.created_at DESC');
		$result = $this->db->get()->result();
		return $result;
	}

	public function getdataUMKM($id)
	{
		$this->db->select('a.id_umkm,a.id_status,a.nama_perusahaan,a.namausaha,a.username,a.situs_web,a.sosmed,a.ojol,a.ratting,a.cara_pembayaran,b.nama_kec,b.nama_kel,b.alamat,c.nama_usaha,d.last_login,(select count(id_ulasan) from m_ulasan where id_umkm = a.id_umkm) as jum_ulasan,
			( select sum(z.quantity) from m_transaksi_detail z join m_transaksi x on x.id_transaksi = z.id_transaksi where x.id_umkm = a.id_umkm AND x.id_status_transaksi = 4) as jum_produk_terjual,e.logo_umkm');
		$this->db->from('m_umkm a');
		$this->db->join('m_umkm_alamat b','b.id_umkm = a.id_umkm','left');
		$this->db->join('m_jenis_usaha c','c.id_jenis_usaha = a.id_jenis_usaha','left');
		$this->db->join('m_pengguna d','d.username = a.username','left');
		$this->db->join('m_umkm_berkas e','e.id_umkm = a.id_umkm','left');
		$this->db->where('a.id_umkm',(int)$id);
		$this->db->where_in('a.id_status',array(1,2,4));
		$query = $this->db->get()->row();
		return $query;
	}

	function get_cari_umkm($q=null){
		$this->db->select('a.id_umkm,a.namausaha');
		$this->db->from('m_umkm a');
		$this->db->where_in('a.id_status',array(1,2,4));

        if($q != null){
            $this->db->like('a.namausaha', $q);
            $this->db->limit(100); 
        }else{
            $this->db->limit(20);
        }

		$this->db->order_by('a.created_at','desc');
        $data = $this->db->get()->result();
        return $data;
	}
}
