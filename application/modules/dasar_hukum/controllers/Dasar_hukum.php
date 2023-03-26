<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dasar_hukum extends MY_Controller {

	public function __construct() {
		parent::__construct();
        $this->load->model('dasar_hukum_model');
	}

    public function index()
    {
        $this->load->library('pagination');
        $this->template->set_layout('frontend/index');

        $this->template->add_title_segment('Dasar Hukum');
        $this->template->add_meta_tag("description", "Dasar Hukum UMKM Kota Tangerang");
        $this->template->add_meta_tag("keywords", "dasar hukum, dasar hukum,news,umkm,portal umkm,kota tangerang,tangerang,portal");

        $k = keranjangku();
        $keranjang = $k['keranjang'];
        $jml_keranjang = $k['jml_keranjang'];

        //konfigurasi pagination
        $config['page_query_string'] = true;
        $config['reuse_query_string'] = true;
        $config['query_string_segment'] = 'page';
        $config['base_url'] = site_url('dasar-hukum'); //site url
        $config['total_rows'] = $this->dasar_hukum_model->get_count_all_dasar_hukum(); //total row

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
 
        $data_berita = $this->dasar_hukum_model->getDasarHukum($config["per_page"], $page);           
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
            'active'        => 'list-hukum',
            'keranjang'     => $keranjang,
            'kategori'      => $this->query_model->getKategori(),
            'berita'        => $data_berita,
            'jml_keranjang' => $jml_keranjang,
            'pagination'    => $pagination,
            'count_all' => $count_all,
            'count_filtered' => $count_filtered,
            'count_s' => $s,
            'count_e' => $e,
            'title_beranda' => 'Dasar Hukum'
        );

        $this->template->render("dasar_hukum",$this->data);
    }

    public function detail($id){
        $kode = short($id,true);
        $data_berita = $this->dasar_hukum_model->get_detail_dasar_hukum($kode);
        if(!$data_berita){
            redirect(base_url('not-found'));
        }

        $this->template->set_layout('frontend/index');
        $this->template->add_title_segment('Dasar Hukum');
        $this->template->add_meta_tag("description", "Dasar Hukum UMKM Kota Tangerang");
        $this->template->add_meta_tag("keywords", "dasar hukum, dasar hukum,news,umkm,portal umkm,kota tangerang,tangerang,portal");

        $k = keranjangku();
        $keranjang = $k['keranjang'];
        $jml_keranjang = $k['jml_keranjang'];

        $data_berita_list = $this->dasar_hukum_model->get_dasar_hukum_lain($kode);

        $this->data = array(
            'active'        => 'detail-hukum',
            'keranjang'     => $keranjang,
            'kategori'      => $this->query_model->getKategori(),
            'berita'        => $data_berita,
            'jml_keranjang' => $jml_keranjang,
            'list_berita'   => $data_berita_list,
            'title_beranda' => 'Dasar Hukum'
        );

        $this->template->render("dasar_hukum_detail",$this->data);
    }

	public function data() {
        if(!$this->user_model->is_umkm_admin()){
            redirect(base_url());
        }
        $this->template->set_layout('templatesv2/backend');

		$this->template->add_title_segment('Dasar Hukum UMKM');
		$this->template->add_meta_tag("description", "Toko Muslimah no 1 di indonesia");
		$this->template->add_meta_tag("keywords", "umkm,portal umkm,kota tangerang,tangerang,portal");

        $this->template->add_css('assets/css/css_admin.css');
        $this->template->add_js('https://cdn.ckeditor.com/4.9.2/standard-all/ckeditor.js');
        $this->template->add_js('assets/ckfinder/ckfinder.js');

        $this->data = array(
			'active'	=> 'dasar_hukum',
			'name'		=> $this->security->get_csrf_token_name(),
			'hash'		=> $this->security->get_csrf_hash(),
            'title_beranda' => 'Dasar Hukum',
		);

		$this->template->render("index",$this->data);
	}

	public function ajax_list()
	{
		$data   = array();
        $sort	= isset($_POST['columns'][$_POST['order'][0]['column']]['data']) ? strval($_POST['columns'][$_POST['order'][0]['column']]['data']) : 'nama';
        $order	= isset($_POST['order'][0]['dir']) ? strval($_POST['order'][0]['dir']) : 'asc';
        $no 	= $this->input->post('start');

		$list = $this->m_table->get_datatables('dasar_hukum',$sort,$order);
        foreach ($list as $l) {
            $no++;
            $l->no = $no;
            $l->created_at = indonesian_date_2($l->created_at);
            if($l->status == 'aktif')
            {
                $l->aksi = '
                    <a href="javascript:void(0);" onclick="ubah_data('.$l->id_dasar_hukum.')" title="Ubah Dasar Hukum" class="btn btn-info"><i class="fa fa-pen"></i></a>
                    <a href="javascript:void(0);" onclick="hapus_data('.$l->id_dasar_hukum.')" title="Nonaktifkan Dasar Hukum" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                '; 
            }else{
                $l->aksi = '
                    <a href="javascript:void(0);" onclick="ubah_data('.$l->id_dasar_hukum.')" title="Ubah Dasar Hukum" class="btn btn-info"><i class="fa fa-pen"></i></a>
                    <a href="javascript:void(0);" onclick="restore_data('.$l->id_dasar_hukum.')" title="Aktifkan Dasar Hukum" class="btn btn-primary"><i class="fa fa-undo"></i></a>
                ';
            }
            $l->status = text($l->status);
            
            $data[] = $l;
        }

        $output = array(
            "draw"              => $_POST['draw'],
            "recordsTotal"      => $this->m_table->count_all('dasar_hukum',$sort,$order),
            "recordsFiltered"   => $this->m_table->count_filtered('dasar_hukum',$sort,$order),
            "data"              => $data,
        );  
        echo json_encode($output);  
	}

    public function ajax_save()
    {
        $this->_validate();
        $data = array(
            'kode_dasar_hukum'  => time(),
            'judul'             => $this->input->post('judul',true),
            'keterangan'        => toDesc($this->input->post('deskripsi')),
            'status'            => 'aktif',
            'created_at'        => date('Y-m-d H:i:s')

        );

        $insert = $this->query_model->insert('m_dasar_hukum',$data);

        if (!$insert)
        {
            echo json_encode(['success' => false, 'message' => 'Data gagal ditambahkan','status' => TRUE]);
        }
        else 
        {
            echo json_encode(['success' => true, 'message' => 'Data Berhasil ditambahkan','status' => TRUE]);
        }
    }

    public function ajax_ubah()
    {
        $this->_validate();
        $data = array(
            'judul'             => $this->input->post('judul',true),
            'keterangan'        => toDesc($this->input->post('deskripsi')),
            'updated_at'        => date('Y-m-d H:i:s')

        );

        $insert = $this->query_model->update('m_dasar_hukum',array('id_dasar_hukum' => $this->input->post('id')), $data);

        if (!$insert)
        {
            echo json_encode(['success' => false, 'message' => 'Data gagal diubah','status' => TRUE]);
        }
        else 
        {
            echo json_encode(['success' => true, 'message' => 'Data Berhasil diubah','status' => TRUE]);
        }
    }


    public function ajax_hapus(){
        $data = array(
            'status'        => 'nonaktif',
            'updated_at'    => date('Y-m-d H:i:s'),
        );

        $insert = $this->query_model->update('m_dasar_hukum',array('id_dasar_hukum' => $this->input->post('id',true)), $data);

        if (!$insert)
        {
            echo json_encode(['success' => false, 'message' => 'Dasar Hukum gagal di nonaktifkan','status' => TRUE]);
        }
        else 
        {
            echo json_encode(['success' => true, 'message' => 'Dasar Hukum berhasil di nonaktifkan','status' => TRUE]);
        }
    }

    public function ajax_restore(){
        $data = array(
            'status' => 'aktif',
            'updated_at'    => date('Y-m-d H:i:s'),
        );

        $insert = $this->query_model->update('m_dasar_hukum',array('id_dasar_hukum' => $this->input->post('id',true)), $data);

        if (!$insert)
        {
            echo json_encode(['success' => false, 'message' => 'Dasar Hukum gagal diaktifkan','status' => TRUE]);
        }
        else 
        {
            echo json_encode(['success' => true, 'message' => 'Dasar Hukum berhasil diaktifkan','status' => TRUE]);
        }
    }

    public function ajax_data()
    {
        $type = $this->input->post('type');
        switch ($type) {
            case 'dasar_hukum':
                $query['select']    = '*';
                $query['table']     = 'm_dasar_hukum';
                $query['where']     = 'id_dasar_hukum= '.(int)$this->input->post('id');
                $data               = $this->query_model->getRow($query);
                echo json_encode($data);    
            break;
            
            default:
                # code...
                break;
        }
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('judul',true) == '')
        {
            $data['inputerror'][] = 'judul';
            $data['error_string'][] = 'Data Harus Diisi';
            $data['status'] = FALSE;
        }       

        if($this->input->post('deskripsi',true) == '')
        {
            $data['inputerror'][] = 'data_deskripsi';
            $data['error_string'][] = 'Data Harus Diisi';
            $data['status'] = FALSE;
        }
        
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

}