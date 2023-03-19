<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_dashboard extends CI_Model
{
    public function __construct(){
		parent::__construct();
		$this->load->database();
    }

    var $column_order = array(null, 'a.namausaha','e.nama','c.nama_usaha','b.nama','a.sumber','f.id_izin_usaha'); 
    var $column_search = array('a.namausaha','e.nama','c.nama_usaha','b.nama','a.sumber'); 
    var $order =  array('a.id_umkm' => 'DESC');

	private function _get_datatables_query()
    {
        $this->db->select('a.*,b.nama as status,c.nama_usaha,e.nama as nama_pemilik,f.id_izin_usaha');
        $this->db->from('m_umkm a');
        $this->db->join('m_status b','b.id_status = a.id_status');
        $this->db->join('m_jenis_usaha c','c.id_jenis_usaha = a.id_jenis_usaha','left');
        $this->db->join('m_pengguna e','e.username = a.username','left');
        $this->db->join('m_umkm_izin_usaha f','f.id_umkm = a.id_umkm','left');
        $sumber = $this->input->post('sumber',true);
        if ($sumber=='sidata') {
    		$this->db->where('a.sumber','sidata');
    	}elseif($sumber == 'umkm'){
            $this->db->group_start();
    		$this->db->where('a.sumber !=','sidata');
    		$this->db->or_where('a.sumber IS NULL');
            $this->db->group_end();
    	}

        $iumk = $this->input->post('iumk',true);
        if ($iumk == 'punya') {
            $this->db->where('f.id_izin_usaha IS NOT NULL');
        }elseif($iumk == 'belum_punya'){
            $this->db->where('f.id_izin_usaha IS NULL');
        }

        $status_verif = $this->input->post('status_verif',true);
        if ($status_verif) {
            $this->db->where('a.id_status',$status_verif);
        }

        $i = 0;
     
        foreach ($this->column_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
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
 
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }

        // $this->db->group_by('a.id_umkm');
    }

     public function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    public function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->_get_datatables_query();
        return $this->db->count_all_results();
    }

    function detail_rekap_umkm($sumber=null){
    	$this->db->select("count(a.id_umkm) as jum_umkm_all,
    					  count( CASE WHEN a.id_status = 1 THEN 1 ELSE NULL END ) AS jum_verif_diterima,
    					  count( CASE WHEN a.id_status = 2 THEN 1 ELSE NULL END ) AS jum_verif_menunggu");
    	$this->db->from('m_umkm as a');
        $this->db->join('m_umkm_izin_usaha f','f.id_umkm = a.id_umkm','left');
    	if ($sumber=='sidata') {
    		$this->db->where('a.sumber','sidata');
    	}elseif($sumber == 'umkm'){
    		$this->db->group_start();
            $this->db->where('a.sumber !=','sidata');
            $this->db->or_where('a.sumber IS NULL');
            $this->db->group_end();
    	}

        $iumk = $this->input->post('iumk',true);
        if ($iumk == 'punya') {
            $this->db->where('f.id_izin_usaha IS NOT NULL');
        }elseif($iumk == 'belum_punya'){
            $this->db->where('f.id_izin_usaha IS NULL');
        }
    	return $this->db->get()->row();
    }

    function detail_rekap_produk_by_status(){
        $this->db->select("count(a.id_produk) as jum_produk,
                           count( CASE WHEN a.status = 1 THEN 1 ELSE NULL END ) AS jum_aktif,
                           count( CASE WHEN a.status != 1 THEN 1 ELSE NULL END ) AS jum_nonaktif,
                           count( CASE WHEN a.stok >= 1 THEN 1 ELSE NULL END ) AS jum_tersedia,
                           count( CASE WHEN a.stok < 1 THEN 1 ELSE NULL END ) AS jum_habis");
        $this->db->from('m_produk as a');
        $this->db->join('m_umkm c','c.id_umkm = a.id_umkm');
        $this->db->join('m_pengguna e','c.username = e.username');
        if(!$this->user_model->is_umkm_admin() && !$this->user_model->is_umkm_verifikator()){
            $this->db->where('e.username',$this->session->identity);
        }
        return $this->db->get()->row();
    }

    function get_produk_terbaik(){
        $this->db->select('a.id_umkm,a.kode_produk,a.nama_produk,a.harga,a.id_produk,a.ratting,b.nama_usaha,(select foto from m_produk_foto  WHERE id_produk = a.id_produk LIMIT 1) as foto,c.namausaha,( select sum(z.quantity) from m_transaksi_detail z join m_transaksi x on x.id_transaksi = z.id_transaksi where z.id_produk = a.id_produk AND x.id_status_transaksi = 4) as jum_terjual');
        $this->db->from('m_produk as a');
        $this->db->join('m_jenis_usaha b','b.id_jenis_usaha = a.id_jenis_usaha','left');
        $this->db->join('m_umkm c','c.id_umkm = a.id_umkm');
        $this->db->join('m_pengguna e','c.username = e.username');
        if(!$this->user_model->is_umkm_admin() && !$this->user_model->is_umkm_verifikator()){
            $this->db->where('e.username',$this->session->identity);
        }
        $this->db->order_by('a.ratting','desc');
        $this->db->order_by('jum_terjual','desc');
        $this->db->limit(6);
        return $this->db->get()->result();
    }

    function detail_rekap_produk_by_kategori(){
        $this->db->select("a.id_jenis_usaha,count(a.id_produk) as jum");
        $this->db->from('m_produk as a');
        $this->db->join('m_umkm c','c.id_umkm = a.id_umkm');
        $this->db->join('m_pengguna e','c.username = e.username');
        $this->db->group_by('a.id_jenis_usaha');
        return $this->db->get()->result();
    }

    function detail_rekap_transaksi(){
        $this->db->select("count(a.id_transaksi) as jum_transaksi,
                            count( CASE WHEN a.id_status_transaksi = 0 THEN 1 ELSE NULL END ) AS jum_menunggu_pembayaran,
                            count( CASE WHEN a.id_status_transaksi = 1 THEN 1 ELSE NULL END ) AS jum_menunggu_konfirmasi,
                            count( CASE WHEN a.id_status_transaksi = 2 THEN 1 ELSE NULL END ) AS jum_diproses,
                            count( CASE WHEN a.id_status_transaksi = 3 THEN 1 ELSE NULL END ) AS jum_dikirim,
                            count( CASE WHEN a.id_status_transaksi = 4 THEN 1 ELSE NULL END ) AS jum_sampai,
                            count( CASE WHEN a.id_status_transaksi = 5 THEN 1 ELSE NULL END ) AS jum_batal");
        $this->db->from('m_transaksi as a');
        $this->db->join('m_umkm e','e.id_umkm = a.id_umkm');
        $this->db->join('m_pengguna f','f.username = a.username');
        if (!$this->user_model->is_umkm_admin() && !$this->user_model->is_umkm_verifikator()) {
            $this->db->where('e.username',$this->session->identity);
        }
        return $this->db->get()->row();
    }
}
?>