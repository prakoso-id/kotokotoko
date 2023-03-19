<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_notif extends CI_model
{
	public function __construct(){
        parent::__construct();
    }

    private function q_data($type=null){
        $this->db->select('a.id_notifikasi,a.username_pengirim,a.judul,a.message,a.tanggal,a.id_detail,a.modul,a.submodul');
        $this->db->from('m_notifikasi as a');
        $this->db->where('a.username_penerima',$this->session->identity);
        $this->db->where('is_read',0);
        if ($type == 'transaksi') {
            $this->db->where_in('a.modul',array('transaksi_penjualan','transaksi_pembelian'));
        }elseif ($type == 'update') {
            $this->db->where_not_in('a.modul',array('transaksi_penjualan','transaksi_pembelian'));
        }
        $this->db->order_by('a.tanggal','desc');
    }

	public function get_count_all_notif($type=null){
        $this->q_data($type);
        return $this->db->count_all_results();
    }

    public function get_list_notif($limit=null){
        $this->q_data();
        if ($limit) {
            $this->db->limit($limit);
        }
        return $this->db->get()->result();
    }
}
?>