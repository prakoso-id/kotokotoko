<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class List_umkm extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->template->set_layout('frontend/index');
		$this->load->model('umkm_model');
        $this->load->library('pagination');
	}

	private function _get_list_data($site_url,$type,$id_umkm=null){
		$this->template->add_title_segment('');
		$this->template->add_meta_tag("description", "Data UMKM Kota Tangerang");
		$this->template->add_meta_tag("keywords", "profil,toko,muslim,moslem clothes,pakaian muslim,termurah");

		$k = keranjangku();
        $data['keranjang'] = $k['keranjang'];
        $data['jml_keranjang'] = $k['jml_keranjang'];
		
		$data['kategori'] 	= $this->query_model->getKategori();

		//konfigurasi pagination
		$config['page_query_string'] = true;
		$config['reuse_query_string'] = true;
		$config['query_string_segment'] = 'page';
		$config['base_url'] = $site_url; //site url
        $config['total_rows'] = $this->umkm_model->get_count_all_data($type,$id_umkm); //total row

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
 
        $list_data = $this->umkm_model->getData($config["per_page"],$page,$type,$id_umkm);

        if ($type == 'umkm') {
	        if ($list_data) {
	        	$dt = array();
	        	foreach ($list_data as $l) {
	        		$produk = $this->umkm_model->get_produk_umkm($l->id_umkm);
	        		$dt[] = array('umkm' => $l, 'produk' => $produk);
	        	}

	        	$umkm = $dt;
	        }else{
	        	$umkm = $list_data;
	        }

	        $data['data'] = $umkm;
        }else{
        	$data['data'] = $list_data;
        }

        $data['pagination'] = $this->pagination->create_links();
        $data['count_all'] = $config['total_rows'];
        $data['count_filtered'] = count($data['data']);

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
		$dt = $this->_get_list_data(site_url('list-umkm'),'umkm');
		$this->data = array(
			'active'	=> 'list-umkm',
			'keranjang'	=> $dt['keranjang'],
			'kategori'	=> $dt['kategori'],
			'umkm'		=> $dt['data'],
			'jml_keranjang'	=> $dt['jml_keranjang'],
			'url_cari'	=> site_url('list-umkm'),
			'pagination' => $dt['pagination'],
			'title_beranda'	=> 'UMKM',
			'paling_dicari' => get_most_search(),
			'm_kecamatan' => get_list_kecamatan(),
			'count_all' => $dt['count_all'],
			'count_filtered' => $dt['count_filtered'],
			'count_s' => $dt['s'],
			'count_e' => $dt['e']
		);

		$this->template->render("index",$this->data);
	}

	public function detail($id)
	{
		$id_umkm = short($id,true);
		$data_umkm = $this->umkm_model->getdataUMKM($id_umkm);
		if(!$data_umkm){
			redirect(base_url('not-found'));
		}

		$this->template->add_title_segment('');
		$this->template->add_meta_tag("description", $data_umkm->namausaha);
		$this->template->add_meta_tag("keywords", "profil,toko,muslim,moslem clothes,pakaian muslim,termurah");
		$this->template->add_css('assets/css/pesan.css');
		$this->template->add_css('assets/mytemplate/css/profil_umkm.css');
		$this->template->add_css('assets/plugins/datatables/dataTables.bootstrap.css');
		$this->template->add_js(base_url().'assets/plugins/datatables/jquery.dataTables.min.js',true);
		$this->template->add_js(base_url().'assets/plugins/datatables/dataTables.bootstrap.min.js',true);

		$this->template->add_meta_tag("og:title", $data_umkm->namausaha." - ".$data_umkm->nama_kel.", ".$data_umkm->nama_kec." | Protal UMKM Kota Tangerang");
		$this->template->add_meta_tag("og:description", "Belanja online aman dan nyaman hanya di ".$data_umkm->namausaha);
		$this->template->add_meta_tag("og:url", "".base_url()."toko/".$id);
		$this->template->add_meta_tag("og:image", base_url()."resizer?src=".base_url()."assets/logo/".$data_umkm->logo_umkm);
		$this->template->add_meta_tag("og:image:type", "image/jpeg");
		$this->template->add_meta_tag("og:image:alt", $data_umkm->namausaha);
		$this->template->add_meta_tag("og:type", "article");

		$dt = $this->_get_list_data(site_url('toko/'.$id),'produk',$data_umkm->id_umkm);

		$this->data = array(
			'active' => 'list-umkm',
			'keranjang'	=> $dt['keranjang'],
			'jml_keranjang'	=> $dt['jml_keranjang'],
			'kategori' => $dt['kategori'],
			'umkm' => $data_umkm,
			'title_beranda'	=> $data_umkm->namausaha,
			'produk' => $dt['data'],
			'pagination' => $dt['pagination'],
			'paling_dicari' => get_most_search(),
			'count_all' => $dt['count_all'],
			'count_filtered' => $dt['count_filtered'],
			'count_s' => $dt['s'],
			'count_e' => $dt['e']
		);

		$this->template->render("detail",$this->data);
	}

	function ajax_list(){
		$type = $this->input->post('type',true);
		switch ($type) {
			case 'ulasan_umkm':
				$data   = array();
                $sort   = isset($_POST['columns'][$_POST['order'][0]['column']]['data']) ? strval($_POST['columns'][$_POST['order'][0]['column']]['data']) : 'nama';
                $order  = isset($_POST['order'][0]['dir']) ? strval($_POST['order'][0]['dir']) : 'asc';
                $no     = $this->input->post('start');

                $list = $this->m_table->get_datatables('ulasan_umkm',$sort,$order);
                foreach ($list as $l) {
                	if ($l->is_anonim == 1) {
                		$nama = substr($l->nama, 0, 1) . "*******" . substr($l->nama, -1, 1);
                	}else{
                		$nama = $l->nama;
                	}

                	$l->dt = '<div class="row">
                				<div class="col-md-1" style="margin-right:0px;">
                					<a href="'.base_url('list-produk/produk/'.short($l->kode_produk)).'" target="_blank">
                					<img style="width:50px;height:50px;object-fit:cover;border:1px solid #grey; border-radius:5px;" src="'.base_url('assets/produk/'.$l->id_umkm.'/'.$l->foto_produk).'">
                					<span style="font-size:8px;">'.readMore($l->nama_produk,50).'</span>
                					</a>
                				</div>
                				<div class="col-md-11">
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
									<div class="product-rating" style="display:block;">';
										
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
									<p>'.$l->deskripsi.'</p>
								</div>
							</div>';

 					$data[] = $l;
                }

                $output = array(
                    "draw"              => $_POST['draw'],
                    "recordsTotal"      => $this->m_table->count_all('ulasan_umkm',$sort,$order),
                    "recordsFiltered"   => $this->m_table->count_filtered('ulasan_umkm',$sort,$order),
                    "data"              => $data,
                );  
                echo json_encode($output);
			break;
			
			default:
				# code...
				break;
		}
	}

	public function form($id,$nama=null)
	{
		$umkm['select']		= 'a.id_umkm,a.id_pengguna, a.nama_perusahaan,a.namausaha,a.username,b.nama_kec,b.nama_kel,b.alamat,c.nama_usaha,a.kode_verifikasi,a.kode';
		$umkm['table']		= 'm_umkm a';
		$umkm['join'][0]	= array('m_umkm_alamat b','b.id_umkm = a.id_umkm','left');
		$umkm['join'][1]	= array('m_jenis_usaha c','c.id_jenis_usaha = a.id_jenis_usaha');
		$umkm['where']		= 'a.id_umkm = "'.short($id,true).'" AND a.id_status = 1';

		$data_umkm 			= $this->query_model->getRow($umkm);
		if(!$data_umkm){
			redirect(base_url('not-found'));
		}else if($data_umkm->kode == null){
			// redirect(base_url('toko/'.$id.'/'.$nama));
			redirect(base_url('toko/'.$id));
		}

		$this->template->add_title_segment('');
		$this->template->add_meta_tag("description", $data_umkm->nama_perusahaan);
		$this->template->add_meta_tag("keywords", "profil,toko,muslim,moslem clothes,pakaian muslim,termurah");

		if($this->user_model->is_login())
		{
			$keranjang 			= $this->query_model->keranjang('data');
			$jml_keranjang 		= $this->query_model->keranjang('jumlah');
		}else{
			$keranjang = null;
			$jml_keranjang = 0;
		}

		$this->data = array(
			'active'	=> 'list-umkm',
			'keranjang'	=> $keranjang,
			'kategori'	=> $this->query_model->getKategori(),
			'umkm'		=> $data_umkm,
			'jml_keranjang'	=> $jml_keranjang,
			'title_beranda'	=> 'REGISTRATION',
		);

		$this->template->render("form",$this->data);
	}

	public function ajax_save()
	{
		if($this->input->post('kode'))
		{
			$input = array(
				'kk'			=> $this->input->post('iskk',true),
				'tanggungan'	=> $this->input->post('tanggungan',true),
				'alamat_email'	=> $this->input->post('alamat_email',true),
				'nama'			=> $this->input->post('nama',true),
				'kode'			=> $this->input->post('kode',true),
				'nomor_kontak'	=> $this->input->post('nomor_kontak',true),
			);

			$useragent = 'Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0';
			$json_url = 'https://service-tlive.tangerangkota.go.id/services/tlive/register_customer/simpan_register';
			$ch = curl_init( $json_url );
			curl_setopt($ch, CURLOPT_USERAGENT, $useragent );
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($input));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_USERPWD, SERV_U . ':' . SERV_P);
			$result = json_decode(curl_exec($ch),true);
			// echo json_encode($result);
			// exit();
			if($result['success']){
				echo json_encode(['success' => true, 'message' => 'Data Berhasil ditambahkan','status' => TRUE]);
			}else{
				echo json_encode(['success' => false, 'message' => 'Data gagal ditambahkan','status' => TRUE]);
			}
		}else{
			redirect(base_url('not-found'));
		}
	}

	 public function ajax_cari_umkm(){
		$json = [];
        if(!empty($this->input->get("q"))){
            $json = $this->umkm_model->get_cari_umkm($this->input->get("q"));
        }else{
        	$json = $this->umkm_model->get_cari_umkm();
        }
        echo json_encode($json);
	}
}