<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class List_berita extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->template->set_layout('templates/frontend');
		$this->load->model('berita_model');
        $this->load->library('pagination');
	}

	public function index() {
		$this->template->add_title_segment('Berita');
		$this->template->add_meta_tag("description", "Berita UMKM Kota Tangerang");
		$this->template->add_meta_tag("keywords", "berita, berita,news,umkm,portal umkm,kota tangerang,tangerang,portal");
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

		$cari = htmlentities($this->input->get('cari',true), ENT_QUOTES, 'UTF-8');

		//konfigurasi pagination
		$config['page_query_string'] = true;
		$config['reuse_query_string'] = true;
		$config['query_string_segment'] = 'page';
		$config['base_url'] = site_url('list-berita'); //site url
        $config['total_rows'] = $this->berita_model->get_count_all_berita($cari); //total row
        $config['per_page'] = 20;  //show record per halaman
        $config["uri_segment"] = 3;  // uri parameter
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = 5;
 
        // Membuat Style pagination untuk BootStrap v4
      	$config['first_link']       = '<<';
        $config['last_link']        = '>>';
        $config['next_link']        = 'Selanjutnya';
        $config['prev_link']        = 'Sebelumnya';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Selanjutnya</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
 
        $this->pagination->initialize($config);
        $page = ($this->input->get('page')) ? $this->input->get('page') : 0;
 
        $data_berita = $this->berita_model->getBerita($config["per_page"], $page, $cari);           
        $pagination = $this->pagination->create_links();

		$this->data = array(
			'active'	=> 'list-berita',
			'keranjang'	=> $keranjang,
			'kategori'	=> $this->query_model->getKategori(),
			'berita'	=> $data_berita,
			'jml_keranjang'	=> $jml_keranjang,
			'pagination' 	=> $pagination,
			'title_beranda'	=> 'Berita'
		);

		$this->template->render("index",$this->data);
	}

	public function berita($id) {

		$hasil = update_dilihat_berita($id);
		if(!$hasil)
		{
			redirect(base_url('not-found'));
		}

		$this->template->add_title_segment('Berita');
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

		$berita['select']	= '*';
		$berita['table']	= 'm_berita';
		$berita['where']	= 'kode_berita = '.short($id,true);
		$data_berita 		= $this->query_model->getRow($berita);

		$list_berita['select']	= '*';
		$list_berita['table']	= 'm_berita';
		$list_berita['limit']	= '5';
		$list_berita['where']	= 'kode_berita != '.short($id,true);
		$list_berita['order']	= 'rand(id_berita)';
		$data_berita_list 		= $this->query_model->getData($list_berita);
		
		$this->template->add_meta_tag("description", $data_berita->judul);
		$this->template->add_meta_tag("keywords", "berita, list berita,news,umkm,portal umkm,kota tangerang,tangerang,portal");

		$this->data = array(
			'active'		=> 'list-berita',
			'keranjang'		=> $keranjang,
			'kategori'		=> $this->query_model->getKategori(),
			'berita'		=> $data_berita,
			'jml_keranjang'	=> $jml_keranjang,
			'list_berita'	=> $data_berita_list,
			'title_beranda'	=> 'Berita',
		);

		$this->template->render("detail",$this->data);
	}

}