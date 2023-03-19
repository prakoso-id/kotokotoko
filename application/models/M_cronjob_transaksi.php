<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_cronjob_transaksi extends CI_Model
{
    public function __construct()
	{
		parent::__construct();
    }

    public function batal_otomatis(){
    	$sekarang = date('Y-m-d H:i:s');
    	$date = new DateTime();
		$date->sub(new DateInterval('P1D'));
		$kemarin = $date->format('Y-m-d H:i:s'); //24 jam

        //get data transaksi belum bayar dan created_at nya lebih dari 24 jam
        $this->db->select('id_transaksi');
        $this->db->from('m_transaksi');
        $this->db->where('id_status_transaksi',0);
        $this->db->where('created_at <=',$kemarin);
        $transaksi_batal = $this->db->get()->result();

        //proses update tbl m_transaksi
    	$data = array('id_status_transaksi' => 6,
    				  'updated_at'          => date('Y-m-d H:i:s'),
    				  'tgl_konfirmasi'  	=> date('Y-m-d H:i:s')
    			);
    	$this->db->where('id_status_transaksi',0);
    	$this->db->where('created_at <=',$kemarin);
    	$this->db->update('m_transaksi', $data);
		$update = $this->db->affected_rows();
        if ($update) {
            foreach ($transaksi_batal as $row) {
                kirim_email_transaksi_status($row->id_transaksi);
            }
        }

        return $update;
    }
}
?>
