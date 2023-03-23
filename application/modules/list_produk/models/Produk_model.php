<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Produk_model extends CI_Model{
	
	public function __construct()
	{
		parent::__construct();
    }

    private function _get_q_produk($kategori=null){
    	$this->db->select('a.kode_produk,a.nama_produk,a.harga,a.id_produk,a.diskon,a.diskon_nominal,a.ratting,b.nama_usaha,(select foto from m_produk_foto  WHERE id_produk = a.id_produk LIMIT 1) as foto,(select COUNT(id_ulasan) from m_ulasan where id_produk = a.id_produk) as jumlah_ulasan,d.id_umkm as username,d.username as nik,
    		d.namausaha,d.cara_pembayaran,e.nama_kec,e.nama_kel,f.id_wishlist,(SELECT COUNT(id_wishlist) FROM m_wishlist WHERE id_produk = a.id_produk) as jum_wishlist,( select sum(z.quantity) from m_transaksi_detail z join m_transaksi x on x.id_transaksi = z.id_transaksi where z.id_produk = a.id_produk AND x.id_status_transaksi = 4) as jum_terjual');
		$this->db->from('m_produk a');
		$this->db->join('m_jenis_usaha b','b.id_jenis_usaha = a.id_jenis_usaha','left');
		$this->db->join('m_umkm d','d.id_umkm = a.id_umkm');
		$this->db->join('m_umkm_alamat as e','e.id_umkm = d.id_umkm','left');
		$this->db->join('m_wishlist f', 'f.id_produk = a.id_produk AND f.status = "like" AND f.username = "'.$this->session->identity.'"','left');
		$this->db->where('a.status',1);
		$this->db->where_in('d.id_status',array(1,2));
		$this->db->where('a.stok >',0);

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
		}elseif ($kategori && is_numeric($kategori)) {
			$this->db->where('a.id_jenis_usaha',$kategori);
		}

		$kec = $this->input->get('kec',true);
		if ($kec && is_numeric($kec)) {
			$this->db->where('e.id_kec',$kec);
		}

		$filter_price = htmlentities($this->input->get('filter_price',true), ENT_QUOTES, 'UTF-8');
		if ($filter_price) {
			$p = explode(',', $filter_price);
			$this->db->where('a.harga >=',(int)$p[0]);
			$this->db->where('a.harga <=',(int)$p[1]);
		}
    }
	    
	public function getProduk($limit=null,$offset=null,$kategori=null)
	{
		$this->_get_q_produk($kategori);
		if ($limit) {
			$this->db->limit($limit,$offset);
		}

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
		
		$query = $this->db->get()->result();
		// var_dump($this->db->last_query()); die();
		return $query;
	}

	public function get_count_all_produk($kategori=null){
		$this->_get_q_produk($kategori);
		return $this->db->count_all_results();
	}

	public function getdetailproduk($id)
	{
		$this->db->select('a.id_jenis_usaha,d.id_pengguna,d.namausaha,d.id_status,a.kode_produk, a.nama_produk, a.harga, a.stok, a.id_produk, a.diskon,a.diskon_nominal, a.ratting,a.tags,a.link_eksternal,a.link_sosmed,a.link_video,b.nama_usaha,d.id_umkm as username,d.nama_perusahaan,d.cara_pembayaran,a.deskripsi,a.dilihat, e.nama_kel, ( select sum(z.quantity) from m_transaksi_detail z join m_transaksi x on x.id_transaksi = z.id_transaksi where z.id_produk = a.id_produk AND x.id_status_transaksi = 4) as terjual,(select COUNT(id_ulasan) from m_ulasan where id_produk = a.id_produk) as jumlah_ulasan,d.username as nik,d.id_umkm,d.situs_web as situs_web_toko,d.sosmed as sosmed_toko,d.ojol as ojol_toko, d.no_hp,d.ratting as ratting_toko,f.id_wishlist,g.logo_umkm,c.last_login');
		$this->db->from('m_produk a');
		$this->db->join('m_jenis_usaha b','b.id_jenis_usaha = a.id_jenis_usaha','left');
		$this->db->join('m_umkm d','d.id_umkm = a.id_umkm');
		$this->db->join('m_pengguna c','c.username = d.username','left');
		$this->db->join('m_umkm_alamat e','e.id_umkm = d.id_umkm','left');
		$this->db->join('m_umkm_berkas g','g.id_umkm = d.id_umkm','left');
		$this->db->join('m_wishlist f', 'f.id_produk = a.id_produk AND f.status = "like" AND f.username = "'.$this->session->identity.'"','left');
		$this->db->where('a.status = 1 AND a.kode_produk = "'.(int)$id.'"');
		$this->db->where_in('d.id_status',array(1,2));
		$query = $this->db->get()->row();
		// var_dump($this->db->last_query()); die();
		return $query;
	}

	function get_foto_produk($id_produk){
		$result = $this->db->get_where('m_produk_foto',array('id_produk' => $id_produk))->result();
		return $result;
	}

	function get_stok_ukuran_produk($id_produk){
		$result = $this->db->get_where('m_produk_stok',array('id_produk' => $id_produk))->result();
		return $result;
	}
	function get_produk_rekomendasi($id_jenis_usaha,$id_produk){
		$this->db->select('a.kode_produk,a.nama_produk,a.harga,a.id_produk,a.diskon,a.diskon_nominal,a.ratting,b.nama_usaha,(select foto from m_produk_foto  WHERE id_produk = a.id_produk LIMIT 1) as foto,(select COUNT(id_ulasan) from m_ulasan where id_produk = a.id_produk) as jumlah_ulasan,d.id_umkm as username,d.username as nik,d.namausaha,e.nama_kec,e.nama_kel,f.id_wishlist');
		$this->db->from('m_produk a');
		$this->db->join('m_jenis_usaha b','b.id_jenis_usaha = a.id_jenis_usaha','left');
		$this->db->join('m_umkm d','d.id_umkm = a.id_umkm');
		$this->db->join('m_umkm_alamat e','e.id_umkm = d.id_umkm','left');
		$this->db->join('m_wishlist f','f.id_produk = a.id_produk AND f.status = "like" AND f.username = "'.$this->session->identity.'"','left');
		$this->db->where('a.status',1);
		$this->db->where('a.stok >',0);
		$this->db->where('a.id_jenis_usaha',$id_jenis_usaha);
		$this->db->where('a.id_produk !=',$id_produk);
		$this->db->group_by('a.id_produk');
		$this->db->order_by('rand()');
		$this->db->limit(12);
		$result = $this->db->get()->result();
		return $result;
	}

	function get_produk_lain($id_umkm,$id_produk){
		$this->db->select('a.kode_produk,a.nama_produk,a.harga,a.id_produk,a.diskon,a.diskon_nominal,a.ratting,b.nama_usaha,(select foto from m_produk_foto  WHERE id_produk = a.id_produk LIMIT 1) as foto,(select COUNT(id_ulasan) from m_ulasan where id_produk = a.id_produk) as jumlah_ulasan,d.id_umkm as username,d.username as nik,d.namausaha,e.nama_kec,e.nama_kel,f.id_wishlist');
		$this->db->from('m_produk a');
		$this->db->join('m_jenis_usaha b','b.id_jenis_usaha = a.id_jenis_usaha','left');
		$this->db->join('m_umkm d','d.id_umkm = a.id_umkm');
		$this->db->join('m_umkm_alamat e','e.id_umkm = d.id_umkm','left');
		$this->db->join('m_wishlist f','f.id_produk = a.id_produk AND f.status = "like" AND f.username = "'.$this->session->identity.'"','left');
		$this->db->where('a.status',1);
		$this->db->where('a.stok >',0);
		$this->db->where('a.id_umkm',$id_umkm);
		$this->db->where('a.id_produk !=',$id_produk);
		$this->db->group_by('a.id_produk');
		$this->db->order_by('rand()');
		$this->db->limit(12);
		$result = $this->db->get()->result();
		return $result;
	}

	function get_balasan_diskusi($id_diskusi,$id_umkm){
		$this->db->select('b.nama,b.username,a.*,c.namausaha');
        $this->db->from('m_diskusi_balasan as a');
        $this->db->join('m_pengguna as b','b.username = a.username');
        $this->db->join('m_umkm as c','c.username = a.username AND c.id_umkm ='.$id_umkm,'left');
        $this->db->where('a.id_diskusi',$id_diskusi);
        $this->db->order_by('a.created_at','asc');
        $result = $this->db->get()->result();
		return $result;
	}

	function get_produk_populer(){
		$this->db->select('a.kode_produk,a.nama_produk,a.harga,a.id_produk,a.diskon,a.diskon_nominal,a.ratting,b.nama_usaha,(select foto from m_produk_foto  WHERE id_produk = a.id_produk LIMIT 1) as foto,(select COUNT(id_ulasan) from m_ulasan where id_produk = a.id_produk) as jumlah_ulasan,d.id_umkm as username,d.username as nik,
			d.namausaha,d.cara_pembayaran,e.nama_kec,e.nama_kel,f.id_wishlist,(SELECT COUNT(id_wishlist) FROM m_wishlist WHERE id_produk = a.id_produk) as jum_wishlist');
		$this->db->from('m_produk a');
		$this->db->join('m_jenis_usaha b','b.id_jenis_usaha = a.id_jenis_usaha','left');
		$this->db->join('m_umkm d','d.id_umkm = a.id_umkm');
		$this->db->join('m_umkm_alamat e','e.id_umkm = d.id_umkm','left');
		$this->db->join('m_wishlist f','f.id_produk = a.id_produk AND f.status = "like" AND f.username = "'.$this->session->identity.'"','left');
		$this->db->where('a.status',1);
		$this->db->where('a.stok >',0);
		$this->db->group_by('a.id_produk');
		$this->db->order_by('jum_wishlist','desc');
		$this->db->limit(12);
		$result = $this->db->get()->result();
		return $result;
	}

	function get_produk_terbaru(){
		$this->db->select('a.kode_produk,a.nama_produk,a.harga,a.id_produk,a.diskon,a.diskon_nominal,a.ratting,b.nama_usaha,(select foto from m_produk_foto  WHERE id_produk = a.id_produk LIMIT 1) as foto,(select COUNT(id_ulasan) from m_ulasan where id_produk = a.id_produk) as jumlah_ulasan,d.id_umkm as username,d.username as nik,
			d.namausaha,d.cara_pembayaran,e.nama_kec,e.nama_kel,f.id_wishlist');
		$this->db->from('m_produk a');
		$this->db->join('m_jenis_usaha b','b.id_jenis_usaha = a.id_jenis_usaha','left');
		$this->db->join('m_umkm d','d.id_umkm = a.id_umkm');
		$this->db->join('m_umkm_alamat e','e.id_umkm = d.id_umkm','left');
		$this->db->join('m_wishlist f','f.id_produk = a.id_produk AND f.status = "like" AND f.username = "'.$this->session->identity.'"','left');
		$this->db->where('a.status',1);
		$this->db->where('a.stok >',0);
		$this->db->group_by('a.id_produk');
		$this->db->order_by('a.created_at','desc');
		$this->db->limit(12);
		$result = $this->db->get()->result();
		return $result;
	}

	function get_cari_produk($q=null,$limit=null){
        $this->db->select('a.kode_produk,a.nama_produk,a.id_produk,a.id_umkm,(select foto from m_produk_foto  WHERE id_produk = a.id_produk LIMIT 1) as foto');
		$this->db->from('m_produk a');
		$this->db->join('m_umkm d','d.id_umkm = a.id_umkm');
		$this->db->where('a.status',1);
		$this->db->where('a.stok >',0);

        if($q != null){
            $this->db->like('a.nama_produk', $q);
            if ($limit) {
            	$this->db->limit($limit); 
            }else{
            	$this->db->limit(100); 
            }
        }else{
            $this->db->limit(20);
        }

		$this->db->order_by('a.created_at','desc');
        $data = $this->db->get()->result();
        return $data;
    }

    function get_cari_umkm($q=null,$limit=null){
    	$this->db->select('a.id_umkm,a.namausaha,a.username,a.ratting,a.id_status,b.nama_kec,b.nama_kel,b.alamat,c.nama_usaha,
    		d.logo_umkm');
		$this->db->from('m_umkm a');
		$this->db->join('m_umkm_alamat b','b.id_umkm = a.id_umkm','left');
		$this->db->join('m_jenis_usaha c','c.id_jenis_usaha = a.id_jenis_usaha','left');
		$this->db->join('m_umkm_berkas d','d.id_umkm = a.id_umkm','left');
		$this->db->where_in('a.id_status',array(1,2,4));

		if($q != null){
            $this->db->like('a.namausaha', $q);
        }

        if ($limit) {
        	$this->db->limit($limit); 
        }else{
        	$this->db->limit(20); 
        }

		$this->db->order_by('a.created_at','desc');
        $data = $this->db->get()->result();
        return $data;
    }

    function get_cari_produk_umkm($q=null,$limit=null){
    	$data['produk'] = $this->get_cari_produk($q,$limit);
    	
    	if ($data['produk']) {
    		$product_unique_code = array();
    		foreach ($data['produk'] as $value) {
    			$product_unique_code[] = short($value->kode_produk);
    		}

    		$data['product_unique_code'] = $product_unique_code;
    	}


    	$data['umkm'] = $this->get_cari_umkm($q,$limit);

    	if ($data['umkm']) {
    		$umkm_unique_code = array();
    		foreach ($data['umkm'] as $value) {
    			$umkm_unique_code[] = short($value->id_umkm);
    		}

    		$data['umkm_unique_code'] = $umkm_unique_code;
    	}

    	return $data;
	}
}