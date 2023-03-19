<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Statistik_model extends CI_Model{
	
	public function __construct()
	{
		parent::__construct();
    }

    private function _get_datatables_query($type,$is_filter=null)
    {
        switch ($type) {
        	case 'daftar_produk':
        		$column_order = array(null,'a.nama_produk','a.kode_produk','jum_pendapatan','jum_terjual','jum_dilihat','jum_keranjang','jum_favorit','jum_pesanan'); 
			    $column_search = array('a.nama_produk','a.kode_produk'); 
			    $order =  array('jum_pendapatan' => 'DESC');
		    	
			    $this->db->select('a.nama_produk,a.kode_produk,b.namausaha as nama_toko,c.nama_usaha as kategori_produk');
			    $where_tanggal = "";
			    if ($this->input->post('tanggal')) {
		            $t = explode(' - ', $this->input->post('tanggal'));
		            $tanggal_awal = $t[0];
		            $tanggal_akhir = $t[1];

		            $where_tanggal .= " AND DATE(x.created_at) >= '$tanggal_awal'";
		            $where_tanggal .= " AND DATE(x.created_at) <= '$tanggal_akhir'";
		        }

			    $this->db->select("(SELECT SUM(x.jumlah_harga) FROM m_transaksi_detail as x JOIN m_transaksi as t ON x.id_transaksi = t.id_transaksi WHERE t.id_status_transaksi = 4 AND x.id_produk = a.id_produk  $where_tanggal) as jum_pendapatan");
			    $this->db->select("(SELECT SUM(x.quantity) FROM m_transaksi_detail as x JOIN m_transaksi as t ON x.id_transaksi = t.id_transaksi WHERE t.id_status_transaksi = 4  AND x.id_produk = a.id_produk  $where_tanggal) as jum_terjual");
			    $this->db->select("(SELECT count(x.id_history) FROM m_history as x WHERE x.id_produk = a.id_produk $where_tanggal) as jum_dilihat");
			    $this->db->select("(SELECT count(x.id_keranjang) FROM m_keranjang as x WHERE x.id_produk = a.id_produk $where_tanggal) as jum_keranjang");
			    $this->db->select("(SELECT count(x.id_wishlist) FROM m_wishlist as x WHERE x.id_produk = a.id_produk $where_tanggal) as jum_favorit");
			    $this->db->select("(SELECT SUM(x.quantity) FROM m_transaksi_detail as x JOIN m_transaksi as t ON x.id_transaksi = t.id_transaksi WHERE t.id_status_transaksi IN(0,1,2,3) AND x.id_produk = a.id_produk  $where_tanggal) as jum_pesanan");
			    $this->db->from('m_produk as a');
			    $this->db->join('m_umkm as b','b.id_umkm = a.id_umkm');
			    $this->db->join('m_jenis_usaha as c','c.id_jenis_usaha = a.id_jenis_usaha','left');
			    $this->db->where('b.username',$this->session->identity);

			    if ($is_filter) {
			    	if ($this->input->post('id_umkm')) {
				    	$this->db->where('a.id_umkm', (int)$this->input->post('id_umkm'));
				    }
				    if ($this->input->post('id_jenis_usaha')) {
				    	$this->db->where('a.id_jenis_usaha', (int)$this->input->post('id_jenis_usaha'));
				    }
			    }
        	break;
        }

        if ($is_filter) {
        	$i = 0;
	        foreach ($column_search as $item) // loop column 
	        {
	            if(isset($_POST['search']['value'])) // if datatable send POST for search
	            {
	                 
	                if($i===0) // first loop
	                {
	                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
	                    $this->db->like($item, $_POST['search']['value']);
	                }
	                else
	                {
	                    $this->db->or_like($item, $_POST['search']['value']);
	                }
	 
	                if(count($column_search) - 1 == $i) //last loop
	                    $this->db->group_end(); //close bracket
	            }
	            $i++;
	        }
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($order))
        {
            $order = $order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function get_datatables($type)
    {
        $this->_get_datatables_query($type,1);
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    public function count_filtered($type)
    {
        $this->_get_datatables_query($type,1);
        return $this->db->count_all_results();
    }
 
    public function count_all($type)
    {
        $this->_get_datatables_query($type);
        return $this->db->count_all_results();
    }

    function pendapatan_bersih_baru($id_umkm=null,$id_jenis_usaha=null,$tanggal_awal=null,$tanggal_akhir=null,$tanggal=null){
    	$this->db->select('SUM(a.jumlah_harga) as jum');
    	$this->db->from('m_transaksi_detail as a');
    	$this->db->join('m_transaksi as d','d.id_transaksi = a.id_transaksi');
    	$this->db->join('m_produk as b','b.id_produk = a.id_produk');
    	$this->db->join('m_umkm as c','c.id_umkm = b.id_umkm');
    	$this->db->where('c.username',$this->session->identity);
    	$this->db->where('d.id_status_transaksi',4);
    	if ($id_umkm) {
    		$this->db->where('c.id_umkm',$id_umkm);
    	}
    	if ($id_jenis_usaha) {
    		$this->db->where('b.id_jenis_usaha',$id_jenis_usaha);
    	}
    	if ($tanggal_awal) {
    		$this->db->where('DATE(a.created_at) >=',$tanggal_awal);
    	}
    	if ($tanggal_akhir) {
    		$this->db->where('DATE(a.created_at) <=',$tanggal_akhir);
    	}
    	if ($tanggal) {
    		$this->db->where('DATE(a.created_at)',$tanggal);
    	}
    	$data = $this->db->get()->row();
    	// var_dump($this->db->last_query()); die();
    	return $data->jum;
    }

    function produk_terjual($id_umkm=null,$id_jenis_usaha=null,$tanggal_awal=null,$tanggal_akhir=null){
    	$this->db->select('SUM(a.quantity) as jum');
    	$this->db->from('m_transaksi_detail as a');
    	$this->db->join('m_transaksi as d','d.id_transaksi = a.id_transaksi');
    	$this->db->join('m_produk as b','b.id_produk = a.id_produk');
    	$this->db->join('m_umkm as c','c.id_umkm = b.id_umkm');
    	$this->db->where('c.username',$this->session->identity);
    	$this->db->where('d.id_status_transaksi',4);
    	if ($id_umkm) {
    		$this->db->where('c.id_umkm',$id_umkm);
    	}
    	if ($id_jenis_usaha) {
    		$this->db->where('b.id_jenis_usaha',$id_jenis_usaha);
    	}
    	if ($tanggal_awal) {
    		$this->db->where('DATE(a.created_at) >=',$tanggal_awal);
    	}
    	if ($tanggal_akhir) {
    		$this->db->where('DATE(a.created_at) <=',$tanggal_akhir);
    	}
    	$data = $this->db->get()->row();
    	// var_dump($this->db->last_query()); die();
    	return $data->jum;
    }

    function produk_dilihat($id_umkm=null,$id_jenis_usaha=null,$tanggal_awal=null,$tanggal_akhir=null){
    	$this->db->select('count(a.id_history) as jum');
    	$this->db->from('m_history as a');
    	$this->db->join('m_produk as b','b.id_produk = a.id_produk');
    	$this->db->join('m_umkm as c','c.id_umkm = b.id_umkm');
    	$this->db->where('c.username',$this->session->identity);
    	if ($id_umkm) {
    		$this->db->where('c.id_umkm',$id_umkm);
    	}
    	if ($id_jenis_usaha) {
    		$this->db->where('b.id_jenis_usaha',$id_jenis_usaha);
    	}
    	if ($tanggal_awal) {
    		$this->db->where('DATE(a.created_at) >=',$tanggal_awal);
    	}
    	if ($tanggal_akhir) {
    		$this->db->where('DATE(a.created_at) <=',$tanggal_akhir);
    	}
    	$data = $this->db->get()->row();
    	// var_dump($this->db->last_query()); die();
    	return $data->jum;
    }

    function produk_keranjang($id_umkm=null,$id_jenis_usaha=null,$tanggal_awal=null,$tanggal_akhir=null){
    	$this->db->select('count(a.id_keranjang) as jum');
    	$this->db->from('m_keranjang as a');
    	$this->db->join('m_produk as b','b.id_produk = a.id_produk');
    	$this->db->join('m_umkm as c','c.id_umkm = b.id_umkm');
    	$this->db->where('c.username',$this->session->identity);
    	if ($id_umkm) {
    		$this->db->where('c.id_umkm',$id_umkm);
    	}
    	if ($id_jenis_usaha) {
    		$this->db->where('b.id_jenis_usaha',$id_jenis_usaha);
    	}
    	if ($tanggal_awal) {
    		$this->db->where('DATE(a.created_at) >=',$tanggal_awal);
    	}
    	if ($tanggal_akhir) {
    		$this->db->where('DATE(a.created_at) <=',$tanggal_akhir);
    	}
    	$data = $this->db->get()->row();
    	// var_dump($this->db->last_query()); die();
    	return $data->jum;
    }

    function pendapatan_bersih_baru_tgl($id_umkm=null,$id_jenis_usaha=null,$tanggal_awal=null,$tanggal_akhir=null){
    	$this->db->select('SUM(a.jumlah_harga) as jum,DATE(a.created_at) as tgl');
    	$this->db->from('m_transaksi_detail as a');
    	$this->db->join('m_transaksi as d','d.id_transaksi = a.id_transaksi');
    	$this->db->join('m_produk as b','b.id_produk = a.id_produk');
    	$this->db->join('m_umkm as c','c.id_umkm = b.id_umkm');
    	$this->db->where('c.username',$this->session->identity);
    	$this->db->where('d.id_status_transaksi',4);
    	if ($id_umkm) {
    		$this->db->where('c.id_umkm',$id_umkm);
    	}
    	if ($id_jenis_usaha) {
    		$this->db->where('b.id_jenis_usaha',$id_jenis_usaha);
    	}
    	if ($tanggal_awal) {
    		$this->db->where('DATE(a.created_at) >=',$tanggal_awal);
    	}
    	if ($tanggal_akhir) {
    		$this->db->where('DATE(a.created_at) <=',$tanggal_akhir);
    	}
    	$this->db->group_by('DATE(a.created_at)');
    	$data = $this->db->get()->result();
    	// var_dump($this->db->last_query()); die();
    	return $data;
    }

    function pesanan_baru($id_umkm=null,$tanggal_awal=null,$tanggal_akhir=null,$is_batal=null,$id_status_transaksi=null){
    	$this->db->select('COUNT(a.id_transaksi) as jum');
    	$this->db->from('m_transaksi as a');
    	$this->db->join('m_umkm as b','b.id_umkm = a.id_umkm');
    	$this->db->where('b.username',$this->session->identity);
    	if ($id_status_transaksi) {
    		$this->db->where('a.id_status_transaksi',$id_status_transaksi);
    	}else{
    		if ($is_batal) {
	    		$this->db->where_in('a.id_status_transaksi',array('5','6'));
	    	}else{
	    		$this->db->where_in('a.id_status_transaksi',array('0','1','2','3'));
	    	}
    	}
    	
    	if ($id_umkm) {
    		$this->db->where('a.id_umkm',$id_umkm);
    	}
    	if ($tanggal_awal) {
    		$this->db->where('DATE(a.created_at) >=',$tanggal_awal);
    	}
    	if ($tanggal_akhir) {
    		$this->db->where('DATE(a.created_at) <=',$tanggal_akhir);
    	}
    	$data = $this->db->get()->row();
    	return $data->jum;
    }

    function pesanan_baru_tgl($id_umkm=null,$tanggal_awal=null,$tanggal_akhir=null){
    	$this->db->select('COUNT(a.id_transaksi) as jum,DATE(a.created_at) as tgl');
    	$this->db->from('m_transaksi as a');
    	$this->db->join('m_umkm as b','b.id_umkm = a.id_umkm');
    	$this->db->where('b.username',$this->session->identity);
    	$this->db->where_in('a.id_status_transaksi',array('0','1','2','3'));
    	if ($id_umkm) {
    		$this->db->where('a.id_umkm',$id_umkm);
    	}
    	if ($tanggal_awal) {
    		$this->db->where('DATE(a.created_at) >=',$tanggal_awal);
    	}
    	if ($tanggal_akhir) {
    		$this->db->where('DATE(a.created_at) <=',$tanggal_akhir);
    	}
    	$this->db->group_by('DATE(a.created_at)');
    	$data = $this->db->get()->result();
    	return $data;
    }

    function produk_dilihat_tgl($id_umkm=null,$tanggal_awal=null,$tanggal_akhir=null){
    	$this->db->select('count(a.id_history) as jum,DATE(a.created_at) as tgl');
    	$this->db->from('m_history as a');
    	$this->db->join('m_produk as b','b.id_produk = a.id_produk');
    	$this->db->join('m_umkm as c','c.id_umkm = b.id_umkm');
    	$this->db->where('c.username',$this->session->identity);
    	if ($id_umkm) {
    		$this->db->where('c.id_umkm',$id_umkm);
    	}
    	if ($tanggal_awal) {
    		$this->db->where('DATE(a.created_at) >=',$tanggal_awal);
    	}
    	if ($tanggal_akhir) {
    		$this->db->where('DATE(a.created_at) <=',$tanggal_akhir);
    	}
    	$this->db->group_by('DATE(a.created_at)');
    	$data = $this->db->get()->result();
    	// var_dump($this->db->last_query()); die();
    	return $data;
    }
}
?>