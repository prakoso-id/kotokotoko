<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wishlist extends MY_Controller {

	public function __construct() {
		parent::__construct();
		if(!$this->user_model->is_login()){
            redirect(base_url());
        }
        $this->template->set_layout('frontend/index');
        $this->load->model('wishlist_model');
        $this->load->library('pagination');
	}

	public function index() {
		// $this->session->set_tempdata('jenis_menu','user',300); 
		$this->template->add_title_segment('Produk Favorit Saya');
		$this->template->add_meta_tag("description", "Produk Favorit Saya Toko Muslimah no 1 di indonesia");
		$this->template->add_meta_tag("keywords", "Produk Favorit Saya, wishlist, product, umkm,portal umkm,kota tangerang,tangerang,portal");

		$k = keranjangku();
        $keranjang = $k['keranjang'];
        $jml_keranjang = $k['jml_keranjang'];

        //konfigurasi pagination
		$config['page_query_string'] = true;
		$config['reuse_query_string'] = true;
		$config['query_string_segment'] = 'page';
		$config['base_url'] = site_url('wishlist'); //site url
        $config['total_rows'] = $this->wishlist_model->get_count_all_produk(); //total row

        $limit = $this->input->get('limit',true);
        if ($limit == '' || $limit == null) {
        	$config['per_page'] = 16;  //show record per halaman
        }else{
        	$config['per_page'] = (int)$limit;  //show record per halaman
        }
        
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
        $config['cur_tag_open']     = '<li class="page-item"><span class="page-link active-menu">';
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
        
        if ($this->input->get('page') && $this->input->get('page') >= $config['per_page']) {
        	$page = $this->input->get('page');
        }else{
        	$page = 0;
        }
 
        //panggil function get_mahasiswa_list yang ada pada mmodel mahasiswa_model. 
        $produk = $this->wishlist_model->getProduk($config["per_page"], $page);           
        $pagination = $this->pagination->create_links();
        $count_all = $config['total_rows'];
        $count_filtered = count($produk);

        if ($count_filtered == 0) {
            $s = $e = 0;
        }else{
            if ($page > 0) {
                if ($page < $config['per_page']) {
                    $s = 1;
                    $e = $count_filtered;
                }else{
                    $s = $page+1;
                    $e = $page+$count_filtered;
                }
            }else{
                $s = 1;
                $e = $count_filtered;
            } 
        }

		$this->data = array(
			'active'	=> 'wishlist',
			'keranjang'	=> $keranjang,
			'kategori'	=> $this->query_model->getKategori(),
			'jml_keranjang'	=> $jml_keranjang,
			'wishlist'		=> $produk,
			'dilihat'		=> $this->query_model->terakhir_dilihat(4),
			'paling_dicari' => get_most_search(),
			'pagination' => $pagination,
			'count_all' => $count_all,
			'count_filtered' => $count_filtered,
			'count_s' => $s,
			'count_e' => $e
		);

		$this->template->render("index",$this->data);
	}
}