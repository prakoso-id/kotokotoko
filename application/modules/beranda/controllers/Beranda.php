<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->template->set_layout('frontend/index');
		$this->load->model('list_produk/produk_model');
		$this->load->model('list_berita/berita_model');
	}

	public function index() {
		$this->template->add_title_segment('Beranda');
		$this->template->add_meta_tag("description", "Yazeri Indonesia Moslem Clothes no 1 di indonesia");
		$this->template->add_meta_tag("keywords", "toko,muslim,moslem clothes,pakaian muslim,termurah");

		$populer = $this->produk_model->get_produk_populer();
		$terbaru = $this->produk_model->get_produk_terbaru();
		$diskon = $this->produk_model->get_produk_diskontertinggi();

		$k = keranjangku();
		$keranjang = $k['keranjang'];
        $jml_keranjang = $k['jml_keranjang'];

		$slider['select']	= '*';
		$slider['table']	= 'm_banner';
		$slider['where']	= 'status = "1"';
		$slider['order']	= 'created_at desc';
		$slider['limit']	= 10;
		$data_slider = $this->query_model->getData($slider);

		$banner_produk['select']= '*';
		$banner_produk['table']	= 'm_banner_produk';
		$banner_produk['where']	= 'status = "1"';
		$banner_produk['order']	= 'created_at desc';
		$banner_produk['limit']	= 2;
		$data_banner_produk = $this->query_model->getData($banner_produk);

		$data_berita = $this->berita_model->get_berita_terbaru();

		$this->data = array(
			'active'	=> 'beranda',
			'populer'	=> $populer,
			'terbaru'	=> $terbaru,
			'diskon'	=> $diskon,
			'keranjang'	=> $keranjang,
			'kategori'	=> $this->query_model->getKategori(),
			'slider'	=> $data_slider,
			'banner_produk' => $data_banner_produk,
			'berita'	=> $data_berita,
			'jml_keranjang'	=> $jml_keranjang,
			'paling_dicari' => get_most_search()
		);

		$this->template->render("index",$this->data);
	}
}