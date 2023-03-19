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
}
