<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wishlist extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->template->set_layout('templates/frontend');
		if(!$this->user_model->is_login())
        {
            redirect(base_url());
        }
	}

	public function index() {
		$this->session->set_tempdata('jenis_menu','user',300); 
		$this->template->add_title_segment('Wishlist '.$this->session->nama);
		$this->template->add_meta_tag("description", "Wishlist Belanja Portal UMKM Kota Tangerang");
		$this->template->add_meta_tag("keywords", "Wishlist produk, product, umkm,portal umkm,kota tangerang,tangerang,portal");

		// $this->template->add_css('assets/css.css');
		// $this->template->add_js('assets/plugins/tables/datatables/datatables.min.js');

		if($this->user_model->is_login())
		{
			$keranjang 			= $this->query_model->keranjang('data');
			$jml_keranjang 		= $this->query_model->keranjang('jumlah');
		}else{
			$keranjang = null;
			$jml_keranjang = 0;
		}

		$query4['select']	= 'b.stok,b.harga,b.nama_produk,b.id_umkm as username,a.id_produk,b.kode_produk,(select foto from m_produk_foto  WHERE id_produk = a.id_produk LIMIT 1) as foto';
		$query4['table']	= 'm_wishlist a';
		$query4['join'][0]	= array('m_produk b','b.id_produk = a.id_produk');
		$query4['join'][1]	= array('m_umkm c','c.id_umkm = b.id_umkm');
		$query4['where']    = 'a.status = "like" AND a.username = "'.$this->session->identity.'"';
		$wishlist 			= $this->query_model->getData($query4);

		$this->data = array(
			'active'	=> 'wishlist',
			'keranjang'	=> $keranjang,
			'kategori'	=> $this->query_model->getKategori(),
			'jml_keranjang'	=> $jml_keranjang,
			'wishlist'		=> $wishlist,
			'dilihat'		=> $this->query_model->terakhir_dilihat(4),
		);

		$this->template->render("index",$this->data);
	}




}