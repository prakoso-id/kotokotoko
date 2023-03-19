<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class List_produk extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->template->set_layout('templates/frontend');
		$this->load->model('produk_model');
		//load libary pagination
        $this->load->library('pagination');
	}

	private function _get_list_produk($site_url,$where=null){
		$this->template->add_title_segment('Produk');
		$this->template->add_meta_tag("description", "List Produk Portal UMKM Kota Tangerang");
		$this->template->add_meta_tag("keywords", "list produk, product, umkm,portal umkm,kota tangerang,tangerang,portal");
		// $this->template->add_css('assets/css.css');
		// $this->template->add_js('assets/plugins/tables/datatables/datatables.min.js');

		$k = keranjangku();
        $data['keranjang'] = $k['keranjang'];
        $data['jml_keranjang'] = $k['jml_keranjang'];
		
		$data['kategori'] 	= $this->query_model->getKategori();

		$cari = htmlentities($this->input->get('cari',true), ENT_QUOTES, 'UTF-8');

		//konfigurasi pagination
		$config['page_query_string'] = true;
		$config['reuse_query_string'] = true;
		$config['query_string_segment'] = 'page';
		$config['base_url'] = $site_url; //site url
        $config['total_rows'] = $this->produk_model->get_count_all_produk($cari,$where); //total row
        $config['per_page'] = 24;  //show record per halaman
        $config["uri_segment"] = 3;  // uri parameter
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = 5;
 
        // Membuat Style pagination untuk BootStrap v4
      	$config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
 
        $this->pagination->initialize($config);
        $page = ($this->input->get('page')) ? $this->input->get('page') : 0;
 
        //panggil function get_mahasiswa_list yang ada pada mmodel mahasiswa_model. 
        $data['produk'] = $this->produk_model->getProduk($config["per_page"], $page, $cari, $where);           
        $data['pagination'] = $this->pagination->create_links();

        return $data;
	}

	public function index() {
		$dt = $this->_get_list_produk(site_url('list-produk'));
        $this->data = array(
			'active'	=> 'list-produk',
			'keranjang'	=> $dt['keranjang'],
			'kategori'	=> $dt['kategori'],
			'jml_keranjang'	=> $dt['jml_keranjang'],
			'url_cari'	=> site_url('list-produk'),
			'produk'	=> $dt['produk'],
			'pagination' => $dt['pagination'],
			'title_beranda'	=> 'Produk'
		);

		$this->template->render("index",$this->data);
	}

	public function produk($kode) {
		$this->template->add_title_segment('Produk');
		$this->template->add_meta_tag("description", "Produk Portal UMKM Kota Tangerang");
		$this->template->add_meta_tag("keywords", "list product,product,umkm,portal umkm,kota tangerang,tangerang,portal");
		$this->template->add_css('assets/css/pesan.css');

		$id = short($kode,true);
		$produk = $this->produk_model->getdetailproduk($id);

		if($produk)
		{
			$cek['select']	= 'foto';
			$cek['table']	= 'm_produk_foto';
			$cek['where']	= 'id_produk = '.$produk->id_produk;
			$gallery 		= $this->query_model->getData($cek);

			$query2['select']	= 'a.kode_produk,a.nama_produk,a.harga,a.id_produk,a.diskon,a.ratting,b.nama_usaha,(select foto from m_produk_foto  WHERE id_produk = a.id_produk LIMIT 1) as foto,d.id_umkm as username';
			$query2['table']	= 'm_produk a';
			$query2['join'][0]	= array('m_jenis_usaha b','b.id_jenis_usaha = a.id_jenis_usaha');
			$query2['join'][1]	= array('m_umkm d','d.id_umkm = a.id_umkm');
			$query2['join'][2]	= array('m_pengguna c','c.id_pengguna = d.id_pengguna');
			$query2['where']	= 'a.status = 1 AND a.id_jenis_usaha = '.$produk->id_jenis_usaha.' AND a.id_produk != '.$produk->id_produk;
			$query2['order']	= 'rand()';
			$query2['limit']	= '4';
			$rekomendasi = $this->query_model->getData($query2);

			$query3['select']	= 'a.username,a.ratting,a.deskripsi,a.created_at,b.nama';
			$query3['table']	= 'm_ulasan a';
			$query3['join'][0]	= array('m_pengguna b','b.username = a.username');
			$query3['where']	= 'a.id_produk = '.$produk->id_produk;
			$query3['order']	= 'a.created_at DESC';
			$ulasan 			= $this->query_model->getData($query3);

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
		
			update_dilihat($id);

			$this->data = array(
				'active'		=> 'list-produk',
				'produk'		=> $produk,
				'gallery'		=> $gallery,
				'rekomendasi'	=> $rekomendasi,
				'ulasan'		=> $ulasan,
				'keranjang'		=> $keranjang,
				'kategori'		=> $this->query_model->getKategori(),
				'jml_keranjang'	=> $jml_keranjang,
				'title_beranda'	=> $produk->nama_produk
			);

			$this->template->render("detail",$this->data);
		}
		else{
			redirect(base_url('not-found'));
		}
	}

	public function kategori($id) {
		$nama_usaha = str_replace('-',' ',strtolower($id));

		$sql = "SELECT * FROM m_jenis_usaha WHERE nama_usaha = ?";
		$data 	= $this->db->query($sql, array($nama_usaha))->row();
		if($data){
			$id_jenis_usaha = $data->id_jenis_usaha;
		}else{
			$id_jenis_usaha = null;
		}

		$dt = $this->_get_list_produk(site_url('list-produk/kategori/'.$nama_usaha),array('a.id_jenis_usaha' => $id_jenis_usaha));

		$this->data = array(
			'active'	=> 'list-produk',
			'keranjang'	=> $dt['keranjang'],
			'kategori'	=> $dt['kategori'],
			'jml_keranjang'	=> $dt['jml_keranjang'],
			'url_cari'	=> site_url('list-produk/kategori/'.$id),
			'produk'	=> $dt['produk'],
			'pagination' => $dt['pagination'],
			'title_beranda'	=> $nama_usaha
		);

		$this->template->render("index",$this->data);
	}

	public function pesan($id,$id_produk=null,$type=null)
    {
        $useragent = 'Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0';
        $json_url = 'https://service-tlive.tangerangkota.go.id/services/umkm/loaddata/get_headerdetail';
        $ch = curl_init( $json_url );
        curl_setopt($ch, CURLOPT_USERAGENT, $useragent );
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,"id_group=".$id);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, SERV_U . ':' . SERV_P);
        $pesan = json_decode(curl_exec($ch),true);
        // echo json_encode($pesan);
        // exit();

        if($type == 'hapus' OR $id_produk == 'hapus')
        {
        	$produk = null;
        }else{
        	$query_produk['select']    = "concat('".base_url()."assets/produk/',p.id_umkm, '/', (select foto from m_produk_foto  WHERE id_produk = p.id_produk LIMIT 1)) as foto,p.kode_produk,p.harga,p.nama_produk,p.id_produk,p.stok";
	        $query_produk['table']     = 'm_produk p';
	        $query_produk['where']     = 'p.id_produk = '.$id_produk;
	        $produk             = $this->query_model->getRow($query_produk);	
        }
        
        $this->data = array(
            'pesan'     => $pesan,
            'id_group'  => $id,
            'produk'	=> $produk,
        );
        $this->load->view('list_produk/pesan_produk',$this->data);
    }

    public function make_thumbnail($filename,$path)
    {   
        //source image asli
        $src  = base_url().'assets/'.$path;
        $imageurl = $src.$filename;
        $dest = $_SERVER['DOCUMENT_ROOT'] . '/assets/'.$path;
		
		$ch = curl_init($imageurl);    
		curl_setopt($ch, CURLOPT_NOBODY, true);
		curl_exec($ch);
		$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		// var_dump($code);
		if($code == 200){
		   $status = true;
		}else{
		  $status = false;
		}
		curl_close($ch);
		// echo $status;
		if($status){
			$width = 300;
			$height = true;
			$image = ImageCreateFromString(file_get_contents($imageurl));
			$height = $height === true ? (ImageSY($image) * $width / ImageSX($image)) : $height;
			// create image 
			$output = ImageCreateTrueColor($width, $height);
			ImageCopyResampled($output, $image, 0, 0, 0, 0, $width, $height, ImageSX($image), ImageSY($image));

			// save image
			$expld_name = explode('.', $filename);
			$name = $expld_name[0].'_thumb.'.$expld_name[1];
			ImageJPEG($output, $dest . $name, 95);

			return $name; 
		}else{
			return null;
		}
    }
}