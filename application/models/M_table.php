<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_table extends CI_model
{
	public function __construct()
    {
        parent::__construct();
    }

	private function _get_datatables_query($type=null,$sort=null,$order=null)
    {
        $filter   = @$_POST['filter'];
        switch ($type) {
            case 'data_pengguna':
                $this->db->select('a.*,b.nama as nama_group');
                $this->db->from('m_pengguna a');
                $this->db->join('m_group b','b.id_group = a.id_group');
                $this->db->where('a.status !=',3);

                if(@$filter['nama']) $this->db->like('a.nama', $filter['nama']);
                if(@$filter['username']) $this->db->like('a.username', $filter['username']);
                if(@$filter['group']) $this->db->where('a.id_group', $filter['group']);

                if($_POST['order'][0]['column'] == 0){
                     $this->db->order_by('a.id_pengguna',$order);
                }else{
                     $this->db->order_by($sort,$order);
                }
            break;
            case 'status_umkm':
                $this->db->select('a.*,b.nama as status,c.nama_usaha,e.nama as nama_pemilik');
                $this->db->from('m_umkm a');
                $this->db->join('m_status b','b.id_status = a.id_status');
                $this->db->join('m_jenis_usaha c','c.id_jenis_usaha = a.id_jenis_usaha','left');
                $this->db->join('m_pengguna e','e.username = a.username','left');
                if(!$this->user_model->is_umkm_admin() && !$this->user_model->is_umkm_verifikator()){
                    $this->db->where('a.username',$this->session->identity);
                }

                if(@$filter['nama']) $this->db->like('a.namausaha', $filter['nama']);
                if(@$filter['group']) $this->db->where('a.id_jenis_usaha', $filter['group']);
                if($filter['iumkm'] != ''){
                    if(@$filter['iumkm']) $this->db->where('a.id_status', $filter['iumkm']);
                }

                if($_POST['order'][0]['column'] == 0){
                     $this->db->order_by('a.id_umkm',$order);
                }else{
                     $this->db->order_by($sort,$order);
                }
            break;
             case 'data_alamat':
                $this->db->select('*');
                $this->db->from('m_alamat ');
                $this->db->where('username =',$this->session->identity);
                $this->db->where('status','aktif');
            
                if(@$filter['nama']) $this->db->like('nama_alamat', $filter['nama']);

                if($_POST['order'][0]['column'] == 0){
                    $this->db->order_by('id_alamat',$order);
                }else{
                    $this->db->order_by($sort,$order);
                }
                $this->db->order_by('utama','DESC');
            break;
            case 'data_umkm':
                $this->db->select('a.*,b.nama_lengkap,c.nama_kategori');
                $this->db->from('m_umkm a');
                $this->db->join('m_pengguna b','b.id_pengguna = a.id_pengguna');
                $this->db->join('m_kategori c','c.id_kategori = a.id_kategori');

                if(@$filter['nama']) $this->db->like('nama_perusahaan', $filter['nama']);
                if(@$filter['nama']) $this->db->or_like('nama_lengkap', $filter['nama']);
                if(@$filter['group']) $this->db->where('a.id_kategori', $filter['group']);
                if(@$filter['iumkm']) $this->db->where('verifikasi', $filter['iumkm']);

                if($_POST['order'][0]['column'] == 0){
                     $this->db->order_by('a.id_pengguna',$order);
                }else{
                     $this->db->order_by($sort,$order);
                }
            break;
            case 'data_produk':
                $column_search = array('a.nama_produk','c.namausaha','b.nama_usaha','a.stok','a.harga'); 
                $filter   = $_POST['filter'];
                $this->db->select('a.id_produk,a.kode_produk,a.nama_produk,a.harga,a.stok,a.status,a.is_eorder,a.created_at,a.dilihat,a.ratting,(select foto from m_produk_foto  WHERE id_produk = a.id_produk LIMIT 1) as foto,b.nama_usaha,c.namausaha,a.alasan,e.nama as nama_pemilik,c.id_umkm');
                $this->db->from('m_produk a');
                $this->db->join('m_jenis_usaha b','b.id_jenis_usaha = a.id_jenis_usaha','left');
                $this->db->join('m_umkm c','c.id_umkm = a.id_umkm');
                $this->db->join('m_pengguna e','c.username = e.username');

                if(!$this->user_model->is_umkm_admin() && !$this->user_model->is_umkm_verifikator()){
                    $this->db->where('c.username',$this->session->identity);
                }

                if(@$filter['nama']) $this->db->like('a.nama_produk', $filter['nama']);
                if(@$filter['id_umkm']) $this->db->where('a.id_umkm', $filter['id_umkm']);
                if(@$filter['nama_umkm']) $this->db->like('c.namausaha', $filter['nama_umkm']);
                if(@$filter['group']) $this->db->where('a.id_jenis_usaha', $filter['group']);
                
                if(@$filter['status']) {
                    if (@$filter['status'] != 1) {
                         $this->db->where('a.status !=', 1);
                    }else{
                        $this->db->where('a.status', 1);
                    }
                }

                if(@$filter['stok']) {
                    if (@$filter['stok'] == 'tersedia') {
                         $this->db->where('a.stok >=', 1);
                    }else{
                        $this->db->where('a.stok <', 1);
                    }
                }

                if($_POST['order'][0]['column'] == 0){
                     $this->db->order_by('a.id_produk',$order);
                }else{
                     $this->db->order_by($sort,$order);
                }
            break;
            case 'berita':
                $this->db->select('*');
                $this->db->from('m_berita');

                if(@$filter['nama']) $this->db->like('judul', $filter['nama']);
                if(@$filter['status']) $this->db->where('status_berita', $filter['status']);
                
                if($_POST['order'][0]['column'] == 0){
                     $this->db->order_by('id_berita',$order);
                }else{
                     $this->db->order_by($sort,$order);
                }
            break;
            case 'agenda':
                $this->db->select('*');
                $this->db->from('m_agenda');

                if(@$filter['nama']) $this->db->like('judul', $filter['nama']);
                if(@$filter['status']) $this->db->where('status', $filter['status']);
                
                if($_POST['order'][0]['column'] == 0){
                     $this->db->order_by('id_agenda',$order);
                }else{
                     $this->db->order_by($sort,$order);
                }
            break;
            case 'slider':
                $this->db->select('*');
                $this->db->from('m_banner');

                if(@$filter['nama']) $this->db->like('title', $filter['nama']);
                if(@$filter['status']){
                    if ($filter['status'] == 'aktif') {
                        $this->db->where('status', '1');
                    }else{
                        $this->db->where('status', '0');
                    }
                }
                
                if($_POST['order'][0]['column'] == 0){
                     $this->db->order_by('id_banner',$order);
                }else{
                     $this->db->order_by($sort,$order);
                }
            break;
            case 'banner_produk':
                $this->db->select('a.*,b.nama_produk');
                $this->db->from('m_banner_produk as a');
                $this->db->join('m_produk as b','b.id_produk = a.id_produk');
                if($_POST['order'][0]['column'] == 0){
                     $this->db->order_by('id_banner_produk',$order);
                }else{
                     $this->db->order_by($sort,$order);
                }
            break;
            case 'dasar_hukum':
                $this->db->select('*');
                $this->db->from('m_dasar_hukum');
                
                if(@$filter['nama']) $this->db->like('judul', $filter['nama']);
                if(@$filter['status']) $this->db->where('status', $filter['status']);
                
                if($_POST['order'][0]['column'] == 0){
                     $this->db->order_by('id_dasar_hukum',$order);
                }else{
                     $this->db->order_by($sort,$order);
                }
            break;
            case 'data_pembelian':
                // $this->db->select('b.no_invoice, a.quantity,a.harga, d.nama_produk,(select foto from m_produk_foto  WHERE id_produk = a.id_produk LIMIT 1) as foto, e.username, c.nama_status, a.created_at , a.id_transaksi_detail,b.id_status_transaksi,d.kode_produk');

                $this->db->select('b.*,a.harga,a.quantity,a.jumlah_harga,d.nama_produk,(select foto from m_produk_foto  WHERE id_produk = a.id_produk LIMIT 1) as foto, c.nama_status, d.kode_produk,a.id_transaksi_detail,count(b.no_invoice) as jumlah_barang,e.namausaha');
                $this->db->from('m_transaksi b');
                $this->db->join('m_transaksi_detail a','b.id_transaksi = a.id_transaksi');
                $this->db->join('m_status_transaksi c','c.id_status_transaksi = b.id_status_transaksi');
                $this->db->join('m_produk d','d.id_produk = a.id_produk');
                $this->db->join('m_umkm e','e.id_umkm = d.id_umkm');
                // $this->db->join('pembayaran_VA f','f.no_virtual_acount = b.va and b.id_status_transaksi = 0','left');
            
                $this->db->where('b.username',$this->session->identity);

                if(@$filter['invoice']) $this->db->like('b.no_invoice', $filter['invoice']);
                if(@$filter['nama']) $this->db->like('d.nama_produk', $filter['nama']);
                if(@$filter['status']) $this->db->where('b.id_status_transaksi', $filter['status']);
                if(@$filter['status'] == '0') $this->db->where('b.id_status_transaksi', 0);

                $this->db->group_by("case when b.id_status_transaksi = '0' then b.va else b.no_invoice end");
                // $this->db->get();
                // echo $this->db->last_query();die;

                if($_POST['order'][0]['column'] == 0)
                {
                     $this->db->order_by('b.created_at',$order);
                }else{
                     $this->db->order_by($sort,$order);
                }
            break;

            case 'data_penjualan':
                $column_search = array('a.created_at','b.no_invoice','f.nama','e.namausaha','b.total','c.nama_status'); 
                $this->db->select('b.*,a.harga,a.quantity,a.jumlah_harga,d.nama_produk,(select foto from m_produk_foto  WHERE id_produk = a.id_produk LIMIT 1) as foto, c.nama_status, a.created_at as created_transaksi,d.kode_produk,a.id_transaksi_detail,count(b.no_invoice) as jumlah_barang,e.namausaha,f.nama');
                $this->db->from('m_transaksi b');
                $this->db->join('m_transaksi_detail a','b.id_transaksi = a.id_transaksi');
                $this->db->join('m_status_transaksi c','c.id_status_transaksi = b.id_status_transaksi');
                $this->db->join('m_produk d','d.id_produk = a.id_produk');
                $this->db->join('m_umkm e','e.id_umkm = d.id_umkm');
                $this->db->join('m_pengguna f','f.username = b.username');

                if(!$this->user_model->is_umkm_admin() && !$this->user_model->is_umkm_verifikator()){
                    $this->db->where('e.username',$this->session->identity);
                }

                if(@$filter['id_umkm']) $this->db->where('b.id_umkm', $filter['id_umkm']);
                if(@$filter['invoice']) $this->db->like('b.no_invoice', $filter['invoice']);
                if(@$filter['nama']) $this->db->like('d.nama_produk', $filter['nama']);
                if(@$filter['status']) $this->db->where('b.id_status_transaksi', $filter['status']);
                if(@$filter['status'] == '0') $this->db->where('b.id_status_transaksi', 0);
                if(@$filter['nama_umkm']) $this->db->like('e.namausaha', $filter['nama_umkm']);
                if(@$filter['nama_pembeli']) $this->db->like('f.nama', $filter['nama_pembeli']);

                $this->db->group_by('b.no_invoice');
                if($_POST['order'][0]['column'] == 0)
                {
                     $this->db->order_by('a.id_transaksi_detail',$order);
                }else{
                     $this->db->order_by($sort,$order);
                }
            break;

            case 'diskusi_produk':
                $this->db->select('b.nama,a.*');
                $this->db->from('m_diskusi as a');
                $this->db->join('m_pengguna as b','b.username = a.username');
                if(@$filter['id']) $this->db->where('a.id_produk', $filter['id']);

                if($_POST['order'][0]['column'] == 0)
                {
                     $this->db->order_by('a.created_at',$order);
                }else{
                     $this->db->order_by($sort,$order);
                }
            break;

            case 'ulasan_produk':
                $this->db->select('a.username,a.ratting,a.deskripsi,a.created_at,a.is_anonim,b.nama');
                $this->db->from('m_ulasan as a');
                $this->db->join('m_pengguna as b','b.username = a.username');
                if(@$filter['id']) $this->db->where('a.id_produk', $filter['id']);

                if($_POST['order'][0]['column'] == 0)
                {
                     $this->db->order_by('a.created_at',$order);
                }else{
                     $this->db->order_by($sort,$order);
                }
            break;

            case 'ulasan_umkm':
                $this->db->select('a.username,a.ratting,a.deskripsi,a.created_at,a.is_anonim,a.id_umkm,b.nama,a.id_produk,c.nama_produk,
                    c.kode_produk,(select foto from m_produk_foto  WHERE id_produk = a.id_produk LIMIT 1) as foto_produk');
                $this->db->from('m_ulasan as a');
                $this->db->join('m_pengguna as b','b.username = a.username');
                $this->db->join('m_produk as c','c.id_produk = a.id_produk');
                if(@$filter['id_umkm']) $this->db->where('a.id_umkm', $filter['id_umkm']);

                if($_POST['order'][0]['column'] == 0)
                {
                     $this->db->order_by('a.created_at',$order);
                }else{
                     $this->db->order_by($sort,$order);
                }
            break;
            
            case 'notif_transaksi':
                $this->db->select('a.*');
                $this->db->from('m_notifikasi as a');
                $this->db->where('a.username_penerima',$this->session->identity);
                $this->db->where_in('a.modul',array('transaksi_penjualan','transaksi_pembelian'));

                if(@$filter['is_read']){
                    if ($filter['is_read'] == '1') {
                        $this->db->where('a.is_read', 1);
                    }else{
                        $this->db->where('a.is_read', 0);
                    }
                }

                if(@$filter['jenis_transaksi']){
                    $this->db->where('a.modul', $filter['jenis_transaksi']);
                }

                if($_POST['order'][0]['column'] == 0)
                {
                     $this->db->order_by('a.tanggal',$order);
                }else{
                     $this->db->order_by($sort,$order);
                }
            break;

            case 'notif_update':
                $this->db->select('a.*');
                $this->db->from('m_notifikasi as a');
                $this->db->where('a.username_penerima',$this->session->identity);
                $this->db->where_not_in('a.modul',array('transaksi_penjualan','transaksi_pembelian'));

                if(@$filter['is_read']){
                    if ($filter['is_read'] == '1') {
                        $this->db->where('a.is_read', 1);
                    }else{
                        $this->db->where('a.is_read', 0);
                    }
                }
                
                if($_POST['order'][0]['column'] == 0)
                {
                    $this->db->order_by('a.tanggal',$order);
                }else{
                    $this->db->order_by($sort,$order);
                }
            break;
            default:
                # code...
            break;
        }

        if (isset($column_search)) {
            $i = 0;
            foreach ($column_search as $item) // loop column 
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
     
                    if(count($column_search) - 1 == $i) //last loop
                        $this->db->group_end(); //close bracket
                }
                $i++;
            }
        }
    }
 
    function get_datatables($type=null,$sort=null,$order=null)
    {
        $this->_get_datatables_query($type,$sort,$order);

        if($_POST['length'] != -1){
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
            return $query->result();
        }

    function count_filtered($type=null)
    {
        $this->_get_datatables_query($type);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all($type=null)
    {
        $this->_get_datatables_query($type);
        return $this->db->count_all_results();
    }
}
