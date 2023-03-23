<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Query_model extends CI_Model{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
     }
     
	    
	public function insert($table,$data)
	{
		$this->db->insert($table,$data);
		return true;
	}

	public function insert_id($table,$data)
	{
		$this->db->insert($table,$data);
		return $this->db->insert_id();
	}

	public function insert_batch($table,$data)
	{
		$this->db->insert_batch($table,$data);
		return true;
	}

	public function update($table,$where,$data)
	{
		$this->db->update($table, $data, $where);
		return $this->db->affected_rows();
		return true;
	}

	public function delete($table,$where)
	{
		$this->db->delete($table, $where);
		return true;
	}

	public function getData($value='') {
		$this->db->select($value['select']);
		$this->db->from($value['table']);

		if (isset($value['where'])) {
			$this->db->where($value['where']);
		}

		if (isset($value['like'])) {
			$this->db->like($value['like']);
		}

		if (isset($value['join'])) {
			foreach ($value['join'] as $join) {
				if (isset($join['2'])) {
					$this->db->join($join['0'],$join['1'],$join['2']);
				}else{
					$this->db->join($join['0'],$join['1']);
				}
			}
		}

		if (isset($value['group'])) {
			$this->db->group_by($value['group']);
		}

		if (isset($value['limit'])) {
			$this->db->limit($value['limit']);
		}
		if (isset($value['having'])) {
			$this->db->having($value['having']);
		}
		if (isset($value['order'])) {
			$this->db->order_by($value['order']);
		}
		
		$result = $this->db->get()->result();
		return $result;
	}

	public function getRow($value='')
	{
		$this->db->select($value['select']);
		$this->db->from($value['table']);

		if (isset($value['where'])) {
			$this->db->where($value['where']);
		}

		if (isset($value['join'])) {
			foreach ($value['join'] as $join) {
				$this->db->join($join['0'],$join['1'],(isset($join['2'])?$join['2']:null));
			}
		}

		if (isset($value['group'])) {
			$this->db->group_by($value['group']);
		}

		if (isset($value['limit'])) {
			$this->db->limit($value['limit']);
		}
		if (isset($value['order'])) {
			$this->db->order_by($value['order']);
		}
		
		$result = $this->db->get()->row();
		return $result;
	}

	public function getRows($value='')
	{
		$this->db->select($value['select']);
		$this->db->from($value['table']);

		if (isset($value['where'])) {
			$this->db->where($value['where']);
		}

		if (isset($value['join'])) {
			foreach ($value['join'] as $join) {
				if (isset($join['2'])) {
					$this->db->join($join['0'],$join['1'],$join['2']);
				}else{
					$this->db->join($join['0'],$join['1']);
				}
			}
		}

		if (isset($value['group'])) {
			$this->db->group_by($value['group']);
		}

		if (isset($value['limit'])) {
			$this->db->limit($value['limit']);
		}
		if (isset($value['order'])) {
			$this->db->order_by($value['order']);
		}
		
		$result = $this->db->get()->row();
		return $result;
	}

	public function getNum($value='')
	{
		$this->db->select($value['select']);
		$this->db->from($value['table']);

		if (isset($value['where'])) {
			$this->db->where($value['where']);
		}

		if (isset($value['join'])) {
			foreach ($value['join'] as $join) {
				if (isset($join['2'])) {
					$this->db->join($join['0'],$join['1'],$join['2']);
				}else{
					$this->db->join($join['0'],$join['1']);
				}
			}
		}

		if (isset($value['group'])) {
			$this->db->group_by($value['group']);
		}

		if (isset($value['limit'])) {
			$this->db->limit($value['limit']);
		}
		if (isset($value['order'])) {
			$this->db->order_by($value['order']);
		}
		
		$result = $this->db->get()->num_rows();
		return $result;
	}

	public function insert_multiple($table,$data){
     	$this->db->insert_batch($table, $data);
    	} 

	public function getID($value='')
	{
		if (isset($value['select'])) {
			$this->db->select($value['select']);
		}
		$this->db->from($value['table']);

		if (isset($value['where'])) {
			$this->db->where($value['where']);
		}

		$result = $this->db->get()->row();
		return $result;
	}

	public function keranjang($type,$limit=null,$sort=null,$order=null)
	{
		$this->db->select('a.id_keranjang,a.quantity,a.is_checked,a.size,(select stok from m_produk_stok  WHERE id_produk = a.id_produk AND ukuran = a.size LIMIT 1) as stok,b.harga,b.diskon,b.diskon_nominal,b.nama_produk,b.berat,b.id_kurir as id_kurir_produk,
			b.id_umkm as username,c.namausaha as nama_umkm,c.username as username_umkm, c.id_kurir as id_kurir_umkm, c.id_status,
			d.id_kel as id_kel_umkm, d.id_kec as id_kec_umkm, d.no_kab as no_kab_umkm, 
			d.no_prop as no_prop_umkm, d.kode_pos as kode_pos_umkm, d.alamat as alamat_umkm, d.nama_kel, d.nama_kec,
			a.id_produk,b.kode_produk,(select foto from m_produk_foto  WHERE id_produk = a.id_produk LIMIT 1) as foto,e.id_wishlist');
		$this->db->from('m_keranjang a');
		$this->db->join('m_produk b','b.id_produk = a.id_produk');
		// $this->db->join('m_produk_stok stoks','stoks.id_produk = b.id_produk');
		$this->db->join('m_umkm c','c.id_umkm = b.id_umkm');
		$this->db->join('m_umkm_alamat as d','d.id_umkm = c.id_umkm','left');
		$this->db->join('m_wishlist e', 'e.id_produk = a.id_produk AND e.status = "like" AND e.username = "'.$this->session->identity.'"','left');
		$this->db->where('b.status',1);
		$this->db->where('a.status', 'simpan');
		$this->db->where('a.username', $this->session->identity);
		$this->db->where_in('c.id_status',array(1,2,4));
		if ($limit) {
			$this->db->limit($limit);
		}
		if ($sort) {
			$this->db->order_by('b.id_umkm','ASC');
		}
		$this->db->order_by('a.id_keranjang','DESC');
		

		if($type == 'jumlah'){
			$result = $this->db->get()->num_rows();
		}else if($type == 'data'){
			$result = $this->db->get()->result();
		}else if($type == 'datas'){
			$this->db->get();
			echo $this->db->last_query();
			die;
		}
		return $result;
	}

	public function terakhir_dilihat($limit=null)
	{
		$this->db->select('a.kode_produk,a.nama_produk,a.harga,a.stok,a.id_produk,a.diskon,a.diskon_nominal,a.ratting,b.nama_usaha,(select foto from m_produk_foto  WHERE id_produk = a.id_produk LIMIT 1) as foto,(select COUNT(id_ulasan) from m_ulasan where id_produk = a.id_produk) as jumlah_ulasan,d.id_umkm as username,d.username as nik,d.namausaha,e.nama_kec,e.nama_kel,f.id_wishlist,(SELECT COUNT(id_wishlist) FROM m_wishlist WHERE id_produk = a.id_produk) as jum_wishlist,( select sum(z.quantity) from m_transaksi_detail z join m_transaksi x on x.id_transaksi = z.id_transaksi where z.id_produk = a.id_produk AND x.id_status_transaksi = 4) as jum_terjual');
		$this->db->from('m_history h');
		$this->db->join('m_produk a','a.id_produk = h.id_produk');
		$this->db->join('m_jenis_usaha b','b.id_jenis_usaha = a.id_jenis_usaha','left');
		$this->db->join('m_umkm d','d.id_umkm = a.id_umkm');
		$this->db->join('m_umkm_alamat as e','e.id_umkm = d.id_umkm','left');
		$this->db->join('m_wishlist f', 'f.id_produk = a.id_produk AND f.status = "like" AND f.username = "'.$this->session->identity.'"','left');
		$this->db->where('h.username',$this->session->identity);
		$this->db->where('a.status',1);
		$this->db->where_in('d.id_status',array(1,2));
		if($limit)
		{
			$this->db->limit($limit);
		}
		$this->db->group_by('h.id_produk');
		$this->db->order_by('a.created_at DESC');
		$result = $this->db->get()->result();
		return $result;
	}

	public function getKategori()
	{
		$this->db->select('id_jenis_usaha,nama_usaha,is_show_home,banner,icon');
		$this->db->from('m_jenis_usaha');
		$this->db->where('status',1);
		$query = $this->db->get()->result();
		return $query;
	}

	public function getmStatus(){
		$this->db->select('*');
		$this->db->from('m_status');
		$query = $this->db->get()->result();
		return $query;
	}

	public function getumkm()
	{
		$this->db->select('id_umkm,namausaha,id_status');
		$this->db->from('m_umkm');
		$this->db->where_in('id_umkm',$this->session->umkm_id);
		$this->db->where('username', $this->session->identity);
		$this->db->group_start();
		$this->db->where_in('id_status',array(1,2,4));
		$this->db->group_end();
		return $this->db->get()->result();
	}

	public function cek_status_verif_umkm($id_umkm)
	{
		$this->db->select('id_status');
		$this->db->from('m_umkm');
		$this->db->where('id_umkm',(int)$id_umkm);
		$umkm = $this->db->get()->row();
		if ($umkm->id_status == 1) {
			return true;
		}else{
			return false;
		}
	}

	public function cek_count_produk($id_umkm){
		$this->db->select('count(id_produk) as jum_produk');
		$this->db->from('m_produk');
		$this->db->where('id_umkm',(int)$id_umkm);
		return $this->db->get()->row();
	}

	// public function cek_kodeverifikasi()
	// {
	// 	$keyHash = '';
	//     do {
	//         $uniqid = md5(uniqid(rand(), true));
	// 		$keyHash = substr($uniqid, 0, 4);
	        
	//         ->select('kode_verifikasi');
	//         $this->aman->from('m_penyedia');
	//         $this->aman->where('kode_verifikasi',$keyHash);
	//         $data = $this->aman->get()->num_rows();
	//     }while ($data >= 1);

	//     return $keyHash;
	// }

	// public function insert_aman($table,$data)
	// {
	// 	$this->aman->insert($table,$data);
	// 	return true;
	// }

	// public function cek_kodebarcode($id,$nama)
	// {
    //     $keyHash = sha1($id.'_'.$nama);
        
    //     $this->aman->select('kode_verifikasi');
    //     $this->aman->from('m_penyedia');
    //     $this->aman->where('kode_verifikasi',$keyHash);
    //     $data = $this->aman->get()->num_rows();

	//     return $keyHash;
	// }


}
