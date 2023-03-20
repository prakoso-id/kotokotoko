<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class List_berita extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->template->set_layout('frontend/index');
		$this->load->model('berita_model');
	}

	public function index() {
		$this->load->library('pagination');
		$this->template->add_title_segment('Berita');
		$this->template->add_meta_tag("description", "Berita UMKM Kota Tangerang");
		$this->template->add_meta_tag("keywords", "berita, berita,news,umkm,portal umkm,kota tangerang,tangerang,portal");

		$k = keranjangku();
        $keranjang = $k['keranjang'];
        $jml_keranjang = $k['jml_keranjang'];

		//konfigurasi pagination
		$config['page_query_string'] = true;
		$config['reuse_query_string'] = true;
		$config['query_string_segment'] = 'page';
		$config['base_url'] = site_url('list-berita'); //site url
        $config['total_rows'] = $this->berita_model->get_count_all_berita(); //total row

        $limit = $this->input->get('limit',true);
        if ($limit == '' || $limit == null) {
        	$config['per_page'] = 12;  //show record per halaman
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
 
        $data_berita = $this->berita_model->getBerita($config["per_page"], $page);           
        $pagination = $this->pagination->create_links();
        $count_all = $config['total_rows'];
        $count_filtered = count($data_berita);

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
			'active'	=> 'list-berita',
			'keranjang'	=> $keranjang,
			'kategori'	=> $this->query_model->getKategori(),
			'berita'	=> $data_berita,
			'jml_keranjang'	=> $jml_keranjang,
			'pagination' 	=> $pagination,
			'count_all' => $count_all,
			'count_filtered' => $count_filtered,
			'count_s' => $s,
			'count_e' => $e,
			'title_beranda'	=> 'Berita'
		);

		$this->template->render("index",$this->data);
	}

	public function berita($id) {
		$kode_berita = short($id,true);
		$data_berita 		= $this->berita_model->get_detail_berita($kode_berita);

		if (!$data_berita) {
			redirect(base_url('not-found'));
		}

		$this->template->add_title_segment('Berita');
		$this->template->add_meta_tag("description", $data_berita->judul);
		$this->template->add_meta_tag("keywords", "berita, list berita,news,umkm,portal umkm,kota tangerang,tangerang,portal");

		$this->template->add_meta_tag("og:title", $data_berita->judul." | Protal UMKM Kota Tangerang");
		$this->template->add_meta_tag("og:description", readMore($data_berita->berita,100));
		$this->template->add_meta_tag("og:url", "".base_url()."list-berita/berita/".$id);
		$this->template->add_meta_tag("og:image", base_url()."resizer?src=".base_url()."assets/images/berita/".$data_berita->foto);
		$this->template->add_meta_tag("og:image:type", "image/jpeg");
		$this->template->add_meta_tag("og:image:alt", $data_berita->judul);
		$this->template->add_meta_tag("og:type", "article");

		$k = keranjangku();
        $keranjang = $k['keranjang'];
        $jml_keranjang = $k['jml_keranjang'];

		$data_berita_list = $this->berita_model->get_berita_lain($kode_berita);

		update_dilihat_berita($data_berita);

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

	public function ajax_cari_berita(){
		$json = [];
        if(!empty($this->input->get("q"))){
            $json = $this->berita_model->get_cari_berita($this->input->get("q"));
        }else{
        	$json = $this->berita_model->get_cari_berita();
        }
        echo json_encode($json);
	}
}