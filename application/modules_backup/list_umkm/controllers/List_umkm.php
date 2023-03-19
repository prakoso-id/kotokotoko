<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class List_umkm extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->template->set_layout('templates/frontend');
		$this->load->model('umkm_model');
		//load libary pagination
        $this->load->library('pagination');
	}

	private function _get_list_umkm($site_url,$where=null){
		$this->template->add_title_segment('UMKM');
		$this->template->add_meta_tag("description", "Data UMKM Kota Tangerang");
		$this->template->add_meta_tag("keywords", "profil,umkm,portal umkm,kota tangerang,tangerang,portal");
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
        $config['total_rows'] = $this->umkm_model->get_count_all_umkm($cari,$where); //total row
        $config['per_page'] = 21;  //show record per halaman
        $config["uri_segment"] = 3;  // uri parameter
        $choice = $config["total_rows"] / $config["per_page"];
        // $config["num_links"] = floor($choice);
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
        $data['umkm'] = $this->umkm_model->getUmkm($config["per_page"], $page, $cari, $where);           
        $data['pagination'] = $this->pagination->create_links();

        return $data;
	}

	public function index() {
		$dt = $this->_get_list_umkm(site_url('list-umkm'));
		$this->data = array(
			'active'	=> 'list-umkm',
			'keranjang'	=> $dt['keranjang'],
			'kategori'	=> $dt['kategori'],
			'umkm'		=> $dt['umkm'],
			'jml_keranjang'	=> $dt['jml_keranjang'],
			'url_cari'	=> site_url('list-umkm'),
			'pagination' => $dt['pagination'],
			'title_beranda'	=> 'UMKM'
		);

		$this->template->render("index",$this->data);
	}

	public function kategori($id) {
		$id = str_replace('-',' ',strtolower($id));

		$sql = "SELECT * FROM m_jenis_usaha WHERE nama_usaha = ?";
		$data 	= $this->db->query($sql, array($id))->row();
		if($data)
		{
			$id_jenis_usaha = $data->id_jenis_usaha;
		}else{
			$id_jenis_usaha = null;
		}

		$dt = $this->_get_list_umkm(site_url('list-umkm/kategori/'.$id),array('a.id_jenis_usaha' => $id_jenis_usaha));

		$this->data = array(
			'active'	=> 'list-umkm',
			'keranjang'	=> $dt['keranjang'],
			'kategori'	=> $dt['kategori'],
			'umkm'		=> $dt['umkm'],
			'jml_keranjang'	=> $dt['jml_keranjang'],
			'url_cari'	=> site_url('list-umkm/kategori/'.$id),
			'pagination' => $dt['pagination'],
			'title_beranda'	=> $data->nama_usaha,
		);

		$this->template->render("index",$this->data);
		
	}

	public function detail($id,$nama=null,$keyword=null)
	{
		$data_umkm 		= $this->umkm_model->getdataUMKM(short($id,true));
		if(!$data_umkm){
			redirect(base_url('not-found'));
		}

		$this->template->add_title_segment('UMKM');
		$this->template->add_meta_tag("description", $data_umkm->nama_perusahaan);
		$this->template->add_meta_tag("keywords", "profil,umkm,portal umkm,kota tangerang,tangerang,portal");

		$k = keranjangku();
        $keranjang = $k['keranjang'];
        $jml_keranjang = $k['jml_keranjang'];

		$this->data = array(
			'active'	=> 'list-umkm',
			'keranjang'	=> $keranjang,
			'kategori'	=> $this->query_model->getKategori(),
			'umkm'		=> $data_umkm,
			'jml_keranjang'	=> $jml_keranjang,
			'produk'	=> $this->umkm_model->getdataProduk($data_umkm->id_umkm,$this->input->get(),$keyword),
			'title_beranda'	=> $data_umkm->namausaha,
		);

		$this->template->render("detail",$this->data);
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

		$this->template->add_title_segment('UMKM');
		$this->template->add_meta_tag("description", $data_umkm->nama_perusahaan);
		$this->template->add_meta_tag("keywords", "profil,umkm,portal umkm,kota tangerang,tangerang,portal");

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

}