<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Diskon extends MY_Controller {
    public function __construct() {
		parent::__construct();
		$this->template->set_layout('templatesv2/frontend');
		$this->load->model('produk_model');
		//load libary pagination
        $this->load->library('pagination');
    }

    private function _get_list_produk($site_url,$kategori=null){
		$this->template->add_title_segment('Produk');
		$this->template->add_meta_tag("description", "List Produk Portal UMKM Kota Tangerang");
		$this->template->add_meta_tag("keywords", "list produk, product, umkm,portal umkm,kota tangerang,tangerang,portal");

		$k = keranjangku();
        $data['keranjang'] = $k['keranjang'];
        $data['jml_keranjang'] = $k['jml_keranjang'];
		
		$data['kategori'] 	= $this->query_model->getKategori();

		//konfigurasi pagination
		$config['page_query_string'] = true;
		$config['reuse_query_string'] = true;
		$config['query_string_segment'] = 'page';
		$config['base_url'] = $site_url; //site url
        $config['total_rows'] = $this->produk_model->get_count_all_produk($kategori); //total row

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
 
        //panggil function get_mahasiswa_list yang ada pada mmodel mahasiswa_model. 
        $data['produk'] = $this->produk_model->getProduk($config["per_page"], $page, $kategori);           
        $data['pagination'] = $this->pagination->create_links();
        $data['count_all'] = $config['total_rows'];
        $data['count_filtered'] = count($data['produk']);

        if ($data['count_filtered'] == 0) {
        	$data['s'] = $data['e'] = 0;
        }else{
        	 if ($page > 0) {
	        	if ($page < $config['per_page']) {
	        		$data['s'] = 1;
	            	$data['e'] = $data['count_filtered'];
	        	}else{
	        		$data['s'] = $page+1;
	            	$data['e'] = $page+$data['count_filtered'];
	        	}
	        }else{
	            $data['s'] = 1;
	            $data['e'] = $data['count_filtered'];
	        } 
        }
        return $data;
	}
    
    public function index() {
		$this->template->add_css('assets/mytemplate/css/bootstrap-slider.css');
		$this->template->add_js('assets/mytemplate/js/bootstrap-slider.min.js',true);
		
		$dt = $this->_get_list_produk(site_url('diskon'));
        $this->data = array(
			'active'	=> 'diskon',
			'keranjang'	=> $dt['keranjang'],
			'kategori'	=> $dt['kategori'],
			'jml_keranjang'	=> $dt['jml_keranjang'],
			'produk'	=> $dt['produk'],
			'pagination' => $dt['pagination'],
			'title_beranda'	=> 'Produk',
			'paling_dicari' => get_most_search(),
			'm_kecamatan' => get_list_kecamatan(),
			'count_all' => $dt['count_all'],
			'count_filtered' => $dt['count_filtered'],
			'count_s' => $dt['s'],
			'count_e' => $dt['e']
		);

		$this->template->render("list_produk",$this->data);
    }
    
    public function produk($kode) {
		$this->template->add_title_segment('Produk');
		$this->template->add_meta_tag("description", "Produk Portal UMKM Kota Tangerang");
		$this->template->add_meta_tag("keywords", "list product,product,umkm,portal umkm,kota tangerang,tangerang,portal");
		$this->template->add_css('assets/css/pesan.css');
		$this->template->add_css('assets/plugins/datatables/dataTables.bootstrap.css');
		$this->template->add_css('assets/mytemplate/css/detail_produk.css');
		$this->template->add_css('assets/mytemplate/css/jquery.fancybox.min.css');
		$this->template->add_js('assets/plugins/datatables/jquery.dataTables.min.js',true);
		$this->template->add_js('assets/plugins/datatables/dataTables.bootstrap.min.js',true);
		$this->template->add_js('assets/mytemplate/js/jquery.fancybox.min.js',true);

		$id = short($kode,true);
		$produk = $this->produk_model->getdetailproduk($id);

		if($produk){
			$gallery = $this->produk_model->get_foto_produk($produk->id_produk);
			$rekomendasi = $this->produk_model->get_produk_rekomendasi($produk->id_jenis_usaha,$produk->id_produk);
			$produk_lain = $this->produk_model->get_produk_lain($produk->id_umkm,$produk->id_produk);
			update_dilihat($produk->id_produk,$produk->dilihat);

			$k = keranjangku();
	        $keranjang = $k['keranjang'];
	        $jml_keranjang = $k['jml_keranjang'];

	        $this->template->add_meta_tag("og:title", "Jual ".$produk->nama_produk." - ".text($produk->namausaha)." - ".text($produk->nama_kel)." | Protal UMKM Kota Tangerang");
			$this->template->add_meta_tag("og:description", "Jual ".$produk->nama_produk." dengan harga Rp. ".rp($produk->harga)." dari UMKM ".text($produk->namausaha).", ".text($produk->nama_kel).". Cari produk lainnya di Protal UMKM Kota Tangerang. Jual beli online aman dan nyaman hanya di Protal UMKM Kota Tangerang");
			$this->template->add_meta_tag("og:url", "".base_url()."list-produk/produk/".$kode);
			//make img thumbnail
			// $img_thumbnail = $this->make_thumbnail($gallery[0]->foto,"produk/".$produk->username."/");
			// if ($img_thumbnail) {
			// 	$thumbnail = $img_thumbnail;
			// }else{
			// 	$thumbnail = $gallery[0]->foto;
			// }
			$this->template->add_meta_tag("og:image", base_url()."resizer?src=".base_url()."assets/produk/".$produk->username."/".$gallery[0]->foto."");
			$this->template->add_meta_tag("og:image:type", "image/jpeg");
			// $this->template->add_meta_tag("og:image:width", "400");
			// $this->template->add_meta_tag("og:image:height", "300");
			$this->template->add_meta_tag("og:image:alt", $produk->nama_produk);
			$this->template->add_meta_tag("og:type", "article");

			$this->data = array(
				'active'		=> 'diskon',
				'produk'		=> $produk,
				'gallery'		=> $gallery,
				'rekomendasi'	=> $rekomendasi,
				'produk_lain'	=> $produk_lain,
				'keranjang'		=> $keranjang,
				'kategori'		=> $this->query_model->getKategori(),
				'jml_keranjang'	=> $jml_keranjang,
				'title_beranda'	=> $produk->nama_produk,
				'paling_dicari' => get_most_search(),
			);

			$this->template->render("detail",$this->data);
		}
		else{
			redirect(base_url('not-found'));
		}
	}
}