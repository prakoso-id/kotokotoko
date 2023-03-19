<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Not_found extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->template->set_layout('templatesv2/frontend');
	}

	public function index()
	{
		$this->template->add_title_segment('Halaman Tidak Ditemukan');
		$k = keranjangku();
		$keranjang = $k['keranjang'];
        $jml_keranjang = $k['jml_keranjang'];

		$this->data = array(
			'active'	=> 'beranda',
			'keranjang'	=> $keranjang,
			'kategori'	=> $this->query_model->getKategori(),
			'jml_keranjang'	=> $jml_keranjang
		);

		$this->template->render("templatesv2/not_found",$this->data);	
	}

}