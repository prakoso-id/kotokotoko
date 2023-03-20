<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class List_produk extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->template->set_layout('frontend/index');
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
		$this->template->add_css(base_url().'assets/mytemplate/css/bootstrap-slider.css');
		$this->template->add_js(base_url().'assets/mytemplate/js/bootstrap-slider.min.js',true);
		
		$dt = $this->_get_list_produk(site_url('list-produk'));
        
        $this->data = array(
			'active'	=> 'list-produk',
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

		// var_dump($this->data);die;
        
		$this->template->render("list_produk",$this->data);
	}

	public function produk($kode, $diskon = null) {
		$this->template->add_title_segment('Produk');
		$this->template->add_meta_tag("description", "Produk Portal UMKM Kota Tangerang");
		$this->template->add_meta_tag("keywords", "list product,product,umkm,portal umkm,kota tangerang,tangerang,portal");
		$this->template->add_css(base_url().'assets/css/pesan.css');
		$this->template->add_css(base_url().'assets/plugins/datatables/dataTables.bootstrap.css');
		$this->template->add_css(base_url().'assets/mytemplate/css/detail_produk.css');
		$this->template->add_css(base_url().'assets/mytemplate/css/jquery.fancybox.min.css');
		$this->template->add_js(base_url().'assets/plugins/datatables/jquery.dataTables.min.js',true);
		$this->template->add_js(base_url().'assets/plugins/datatables/dataTables.bootstrap.min.js',true);
		$this->template->add_js(base_url().'assets/mytemplate/js/jquery.fancybox.min.js',true);

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
			$meta_foto = !empty($gallery) ? $gallery[0]->foto : '';

			$this->template->add_meta_tag("og:image", base_url()."resizer?src=".base_url()."assets/produk/".$produk->username."/".$meta_foto."");
			$this->template->add_meta_tag("og:image:type", "image/jpeg");
			// $this->template->add_meta_tag("og:image:width", "400");
			// $this->template->add_meta_tag("og:image:height", "300");
			$this->template->add_meta_tag("og:image:alt", $produk->nama_produk);
			$this->template->add_meta_tag("og:type", "article");

			if ($diskon == null) {
				$active = 'list-produk';
			} else {
				$active = 'diskon';
			}

			$this->data = array(
				'active'		=> $active,
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

	public function ajax_list()
    {
        $type = $this->input->post('type',true);
        switch ($type) {
            case 'diskusi_produk':
                $data   = array();
                $sort   = isset($_POST['columns'][$_POST['order'][0]['column']]['data']) ? strval($_POST['columns'][$_POST['order'][0]['column']]['data']) : 'nama';
                $order  = isset($_POST['order'][0]['dir']) ? strval($_POST['order'][0]['dir']) : 'asc';
                $no     = $this->input->post('start');

				$id_umkm = $this->input->post('id_umkm',true);
                $list = $this->m_table->get_datatables('diskusi_produk',$sort,$order);
                foreach ($list as $l) {
                    $l->dt = '<div class="single-review" style="align:left;">
		                        <div class="review-heading">
		                            <div>
		                                <a style="color: #1F3DB0;font-size: 12px;" href="javascript:void(0);"><i class="fa fa-user"></i> &nbsp;&nbsp;'.$l->nama.'</a>
		                            </div>
		                            <div><a style="font-size: 11px;color: #c1c1c1;" href="javascript:void(0);"><i class="fa fa-clock-o"></i> &nbsp;&nbsp;'.indonesian_date($l->created_at).'</a></div>
		                        </div>
		                        <div class="review-body">
		                            '.xss($l->pesan).'
		                        </div>'; 

		                        $balasan = $this->produk_model->get_balasan_diskusi($l->id_diskusi,$id_umkm);

		                        if ($balasan) {
		                        	foreach ($balasan as $b) {
		                        		if($this->input->post('pemilik',true) == $b->username)
	                                    {
	                                        $l->dt .= '<div class="single-review" style="margin-left: 40px;margin-top: 20px; align:left;">
			                                                <div class="review-heading">
			                                                    <div>
																<a style="color: #1F3DB0;font-size: 12px;" href="javascript:void(0);"><i class="fa fa-user"></i> &nbsp;&nbsp;'.$b->namausaha.'</a> &nbsp;&nbsp;&nbsp; <label style="color:#e95a5c;font-size:11px">PENJUAL</label>
			                                                    </div>
			                                                    <div><a style="font-size: 11px;color: #c1c1c1;" href="javascript:void(0);"><i class="fa fa-clock-o"></i> &nbsp;&nbsp;'.indonesian_date($b->created_at).'</a></div>
			                                                </div>
			                                                <div class="review-body">
			                                                    '.xss($b->pesan).'
			                                                </div>
			                                            </div>';
	                                    }else{
	                                        $l->dt .= '<div class="single-review" style="margin-left: 40px;margin-top: 20px; align:left;">
			                                                <div class="review-heading">
			                                                    <div>
			                                                        <a style="color: #1F3DB0;font-size: 12px;" href="javascript:void(0);"><i class="fa fa-user"></i> &nbsp;&nbsp;'.$b->nama.'</a>
			                                                    </div>
			                                                    <div><a style="font-size: 11px;color: #c1c1c1;" href="javascript:void(0);"><i class="fa fa-clock-o"></i> &nbsp;&nbsp;'.indonesian_date($b->created_at).'</a></div>
			                                                </div>
			                                                <div class="review-body">
			                                                    '.xss($b->pesan).'
			                                                </div>
			                                            </div>';
	                                    }
		                        	}
		                        }

		                        if ($this->user_model->is_login()) {
		                        	$l->dt .= '<div class="text-center">
									<a onclick="balas_diskusi('.$l->id_diskusi.',`'.$l->username.'`)" class="btn btn-xs btn-blue" href="javascript:void(0);">Balas Diskusi</a>
		                              		</div>';
		                        }
		                        
		                        $l->dt .= '</div>';

                    
                    $data[] = $l;
                }

                $output = array(
                    "draw"              => $_POST['draw'],
                    "recordsTotal"      => $this->m_table->count_all('diskusi_produk',$sort,$order),
                    "recordsFiltered"   => $this->m_table->count_filtered('diskusi_produk',$sort,$order),
                    "data"              => $data,
                );  
                echo json_encode($output);
            break;
            case 'ulasan_produk':
            	$data   = array();
                $sort   = isset($_POST['columns'][$_POST['order'][0]['column']]['data']) ? strval($_POST['columns'][$_POST['order'][0]['column']]['data']) : 'nama';
                $order  = isset($_POST['order'][0]['dir']) ? strval($_POST['order'][0]['dir']) : 'asc';
                $no     = $this->input->post('start');

                $list = $this->m_table->get_datatables('ulasan_produk',$sort,$order);
                foreach ($list as $l) {
					if ($l->is_anonim == 1) {
                		$nama = substr($l->nama, 0, 1) . "*******" . substr($l->nama, -1, 1);
                	}else{
                		$nama = $l->nama;
                	}

                	$l->dt = '<div class="single-review">
								<div class="review-heading">
									<div>
										<a href="javascript:void(0);" style="color: #1F3DB0;font-size: 12px;">
											<i class="fa fa-user"></i>
											'.$nama.'
										</a>
									</div>
									<div>
										<a href="javascript:void(0)" style="font-size: 11px;color: #c1c1c1;">
											<i class="fa fa-clock-o"></i>
											'.indonesian_date($l->created_at).'
										</a>
									</div>
									<div class="product-rating pull-right" style="display:block;">';
										
											$jumlah = 5 - $l->ratting; 
											for($i=0; $i<$l->ratting; $i++)
											{
												$l->dt .= '<i class="fa fa-star star"></i>';
											}

											for($i=0; $i<$jumlah; $i++)
											{
												$l->dt .= '<i class="fa fa-star-o star"></i>';
											}
										
							$l->dt .= '
									</div>
								</div>
								<div class="review-body">
									<p>'.$l->deskripsi.'</p>
								</div>
							</div>';

 					$data[] = $l;
                }

                $output = array(
                    "draw"              => $_POST['draw'],
                    "recordsTotal"      => $this->m_table->count_all('ulasan_produk',$sort,$order),
                    "recordsFiltered"   => $this->m_table->count_filtered('ulasan_produk',$sort,$order),
                    "data"              => $data,
                );  
                echo json_encode($output);
            break;

            default:
        		# code...
        		break;
        }
    }

	public function kategori($id) {
		$this->template->add_css(base_url().'assets/mytemplate/css/bootstrap-slider.css');
		$this->template->add_js(base_url().'assets/mytemplate/js/bootstrap-slider.min.js',true);

		$id = htmlentities($id, ENT_QUOTES, 'UTF-8');
		$nama_usaha = str_replace('-',' ',strtolower($id));

		$sql = "SELECT * FROM m_jenis_usaha WHERE nama_usaha = ?";
		$data 	= $this->db->query($sql, array($nama_usaha))->row();
		if($data){
			$id_jenis_usaha = $data->id_jenis_usaha;
		}else{
			$id_jenis_usaha = null;
		}

		$dt = $this->_get_list_produk(site_url('list-produk/kategori/'.$nama_usaha),$id_jenis_usaha);

		$this->data = array(
			'active'	=> 'list-produk',
			'keranjang'	=> $dt['keranjang'],
			'kategori'	=> $dt['kategori'],
			'jml_keranjang'	=> $dt['jml_keranjang'],
			'produk'	=> $dt['produk'],
			'pagination' => $dt['pagination'],
			'title_beranda'	=> $nama_usaha,
			'paling_dicari' => get_most_search(),
			'm_kecamatan' => get_list_kecamatan(),
			'count_all' => $dt['count_all'],
			'count_filtered' => $dt['count_filtered'],
			'count_s' => $dt['s'],
			'count_e' => $dt['e']
		);

		$this->template->render("index",$this->data);
	}

	public function pesan($id,$id_produk=null,$type=null)
    {
        $useragent = 'Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0';
        $json_url = URL_SERV_TLIVE_UMKM.'/loaddata/get_headerdetail';
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
        $src  = base_url().base_url().'assets/'.$path;
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

    public function ajax_cari_produk(){
		$json = [];
        if(!empty($this->input->get("q"))){
        	$q = $this->input->get("q");
        }else{
        	$q = null;
        }

        if (!empty($this->input->get("limit"))) {
    		$limit = $this->input->get("limit");
    	}else{
    		$limit = null;
    	}

        $json = $this->produk_model->get_cari_produk($q,$limit);
        echo json_encode($json);
	}

	public function ajax_cari_produk_umkm(){
		$json = [];
        if(!empty($this->input->get("q"))){
        	$q = $this->input->get("q");
        }else{
        	$q = null;
        }

        if (!empty($this->input->get("limit"))) {
    		$limit = $this->input->get("limit");
    	}else{
    		$limit = null;
    	}

        $json = $this->produk_model->get_cari_produk_umkm($q,$limit);
        echo json_encode($json);
	}
}
?>