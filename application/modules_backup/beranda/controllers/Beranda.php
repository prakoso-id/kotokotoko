<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->template->set_layout('frontend/index');
	}

	public function index() {
		$this->template->add_title_segment('Beranda');
		$this->template->add_meta_tag("description", "Portal UMKM Kota Tangerang");
		$this->template->add_meta_tag("keywords", "umkm,portal umkm,kota tangerang,tangerang,portal");

		// $this->template->add_css('assets/css.css');
		// $this->template->add_js('assets/plugins/tables/datatables/datatables.min.js');

		$query['select']	= 'a.kode_produk,a.nama_produk,a.harga,a.id_produk,a.diskon,a.ratting,b.nama_usaha,(select foto from m_produk_foto  WHERE id_produk = a.id_produk LIMIT 1) as foto,d.id_umkm as username';
		$query['table']		= 'm_produk a';
		$query['join'][0]	= array('m_jenis_usaha b','b.id_jenis_usaha = a.id_jenis_usaha');
		$query['join'][1]	= array('m_umkm d','d.id_umkm = a.id_umkm');
		$query['join'][2]	= array('m_pengguna c','c.id_pengguna = d.id_pengguna');
		$query['join'][3]	= array('m_umkm_alamat e','e.id_umkm = d.id_umkm');
		$query['where']		= 'a.status = 1';
		$query['order']		= 'a.dilihat DESC';
		$query['limit']		= '4';
		$populer = $this->query_model->getData($query);

		$query1['select']	= 'a.kode_produk,a.nama_produk,a.harga,a.id_produk,a.diskon,a.ratting,b.nama_usaha,(select foto from m_produk_foto  WHERE id_produk = a.id_produk LIMIT 1) as foto,d.id_umkm as username';
		$query1['table']		= 'm_produk a';
		$query1['join'][0]	= array('m_jenis_usaha b','b.id_jenis_usaha = a.id_jenis_usaha');
		$query1['join'][1]	= array('m_umkm d','d.id_umkm = a.id_umkm');
		$query1['join'][2]	= array('m_pengguna c','c.id_pengguna = d.id_pengguna');
		$query1['join'][3]	= array('m_umkm_alamat e','e.id_umkm = d.id_umkm');
		$query1['where']		= 'a.status = 1';
		$query1['order']		= 'a.created_at DESC';
		$query1['limit']		= '8';
		$terbaru = $this->query_model->getData($query1);

		if($this->user_model->is_login())
		{
			$keranjang 			= $this->query_model->keranjang('data');
			$jml_keranjang 		= $this->query_model->keranjang('jumlah');
		}else{
			$keranjang = null;
			$jml_keranjang = 0;
		}

		$slider['select']	= '*';
		$slider['table']	= 'm_slider';
		$slider['where']	= 'status = "aktif"';
		$data_slider 		= $this->query_model->getData($slider);

		$berita['select']	= '*';
		$berita['table']	= 'm_berita';
		$berita['order']	= 'dilihat desc';
		$berita['where']	= 'status_berita = "aktif"';
		$berita['limit']	= '3';
		$data_berita 		= $this->query_model->getData($berita);

		$this->data = array(
			'active'	=> 'beranda',
			'populer'	=> $populer,
			'terbaru'	=> $terbaru,
			'keranjang'	=> $keranjang,
			'kategori'	=> $this->query_model->getKategori(),
			'slider'	=> $data_slider,
			'berita'	=> $data_berita,
			'jml_keranjang'	=> $jml_keranjang
		);

		$this->template->render("index",$this->data);
	}

}