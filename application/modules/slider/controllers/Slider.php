<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Slider extends MY_Controller {

	public function __construct() {
		parent::__construct();
        if(!$this->user_model->is_umkm_admin()){
            redirect(base_url());
        }
        $this->template->set_layout('templatesv2/backend');
	}

	public function index() {
		$this->template->add_title_segment('Slider UMKM');
		$this->template->add_meta_tag("description", "Toko Muslimah no 1 di indonesia");
		$this->template->add_meta_tag("keywords", "umkm,portal umkm,kota tangerang,tangerang,portal");

        $this->template->add_css('assets/css/css_admin.css');
        $this->data = array(
			'active'	=> 'slider',
			'name'		=> $this->security->get_csrf_token_name(),
			'hash'		=> $this->security->get_csrf_hash(),
            'title_beranda' => 'Slider',
		);

		$this->template->render("index",$this->data);
	}

	public function ajax_list(){
        $type = $this->input->post('type');
        $data   = array();
        $sort   = isset($_POST['columns'][$_POST['order'][0]['column']]['data']) ? strval($_POST['columns'][$_POST['order'][0]['column']]['data']) : 'nama';
        $order  = isset($_POST['order'][0]['dir']) ? strval($_POST['order'][0]['dir']) : 'asc';
        $no     = $this->input->post('start');

        if ($type == 'slider') {
            $list = $this->m_table->get_datatables($type,$sort,$order);
            foreach ($list as $l) {
                $no++;
                $l->no = $no;
                if ($l->status == '1') {
                    $l->status = 'Aktif';
                    $l->aksi = '<a href="javascript:void(0);" onclick="ubah_data('.$l->id_banner.',`'.$l->jenis.'`,'.$l->id_jenis.')" title="Ubah Slider" class="btn btn-info"><i class="fa fa-pen"></i></a>
                        <a href="javascript:void(0);" onclick="hapus_data('.$l->id_banner.')" title="Nonaktifkan Slider" class="btn btn-danger"><i class="fa fa-trash"></i></a>'; 
                }else{
                    $l->status = 'Non Aktif';
                    $l->aksi = '<a href="javascript:void(0);" onclick="ubah_data('.$l->id_banner.',`'.$l->jenis.'`,'.$l->id_jenis.')" title="Ubah Slider" class="btn btn-info"><i class="fa fa-pen"></i></a>
                        <a href="javascript:void(0);" onclick="restore_data('.$l->id_banner.')" title="Aktifkan Slider" class="btn btn-primary"><i class="fa fa-undo"></i></a>';
                }

                $l->jenis = text($l->jenis);
                
                $data[] = $l;
            }

            $output = array(
                "draw"              => $_POST['draw'],
                "recordsTotal"      => $this->m_table->count_all($type,$sort,$order),
                "recordsFiltered"   => $this->m_table->count_filtered($type,$sort,$order),
                "data"              => $data,
            );  
            echo json_encode($output); 
        }elseif($type == 'banner_produk'){
            $list = $this->m_table->get_datatables($type,$sort,$order);
            foreach ($list as $l) {
                $no++;
                $l->no = $no;
                $l->aksi = '<a href="javascript:void(0);" onclick="ubah_data_banner_produk('.$l->id_banner_produk.')" title="Ubah Banner" class="btn btn-info"><i class="fa fa-pen"></i></a>';
                
                $data[] = $l;
            }

            $output = array(
                "draw"              => $_POST['draw'],
                "recordsTotal"      => $this->m_table->count_all($type,$sort,$order),
                "recordsFiltered"   => $this->m_table->count_filtered($type,$sort,$order),
                "data"              => $data,
            );  
            echo json_encode($output); 
        } 
	}

    public function ajax_save(){
        $type = $this->input->post('type');
        switch ($type) {
            case 'slider':
                $this->_validate($type);
                $data = $this->_data_insert_update();
                $data['status'] = '1';
                $data['created_at'] = date('Y-m-d H:i:s');
                $data['created_by'] = $this->session->identity;
                $insert = $this->query_model->insert('m_banner',$data);
                if (!$insert){
                    echo json_encode(['success' => false, 'message' => 'Data gagal ditambahkan','status' => TRUE]);
                }else {
                    echo json_encode(['success' => true, 'message' => 'Data Berhasil ditambahkan','status' => TRUE]);
                }
            break;
        }
        
    }

    public function ajax_ubah(){
        $type = $this->input->post('type');
        switch ($type) {
            case 'slider':
                $this->_validate($type);
                $data = $this->_data_insert_update();
                $data['updated_at'] = date('Y-m-d H:i:s');
                $data['updated_by'] = $this->session->identity;
                $insert = $this->query_model->update('m_banner',array('id_banner' => $this->input->post('id',true)), $data);
                if (!$insert){
                    echo json_encode(['success' => false, 'message' => 'Data gagal diubah','status' => TRUE]);
                }else{
                    echo json_encode(['success' => true, 'message' => 'Data Berhasil diubah','status' => TRUE]);
                }
            break;
            
            case 'banner_produk':
                $this->_validate($type);
                $id = $this->input->post('id_produk',true);
                $expld = explode('#', $id);
                $id_produk = $expld[0];
                $url = base_url('list-produk/produk/'.short($expld[1]));
                $data = array(
                    'title'             => $this->input->post('title',true),
                    'image'             => $this->input->post('file_banner_produk',true),
                    'id_produk'         => $id_produk,
                    'url'               => $url
                );
                $insert = $this->query_model->update('m_banner_produk',array('id_banner_produk' => $this->input->post('id_banner_produk',true)), $data);
                if (!$insert){
                    echo json_encode(['success' => false, 'message' => 'Data gagal diubah','status' => TRUE]);
                }else{
                    echo json_encode(['success' => true, 'message' => 'Data Berhasil diubah','status' => TRUE]);
                }
            break;
        }
        
    }

    private function _data_insert_update(){
        $jenis = $this->input->post('jenis',true);
        $url = $id_jenis =  null;
        if ($jenis == 'produk') {
            $id = $this->input->post('id_produk',true);
            $expld = explode('#', $id);
            $id_jenis = $expld[0];
            $url = base_url('list-produk/produk/'.short($expld[1]));
        }elseif ($jenis == 'umkm') {
             $id_jenis = $this->input->post('id_umkm',true);
             $url =base_url().'toko/'.short($id_jenis);
        }elseif ($jenis == 'agenda') {
            $id = $this->input->post('id_agenda',true);
            $expld = explode('#', $id);
            $id_jenis = $expld[0];
            $url = base_url('agenda/detail/'.short($expld[1]));
        }elseif ($jenis == 'berita') {
            $id = $this->input->post('id_berita',true);
            $expld = explode('#', $id);
            $id_jenis = $expld[0];
            $url = base_url('list-berita/berita/'.short($expld[1]));
        }else{
            $url = $this->input->post('url',true);
        }

        $data = array(
            'title'             => $this->input->post('title',true),
            'image'             => $this->input->post('file_berita',true),
            'jenis'             => $jenis,
            'url'               => $url,
            'id_jenis'          => $id_jenis,
        );
        return $data;
    }


    public function ajax_hapus(){
        $data = array('status' => '0',
                      'updated_at' => date('Y-m-d H:i:s'),
                      'updated_by' => $this->session->identity
                );

        $insert = $this->query_model->update('m_banner',array('id_banner' => $this->input->post('id',true)), $data);
        if (!$insert){
            echo json_encode(['success' => false, 'message' => 'Slider gagal di nonaktifkan','status' => TRUE]);
        }else {
            echo json_encode(['success' => true, 'message' => 'Slider berhasil di nonaktifkan','status' => TRUE]);
        }
    }

    public function ajax_restore(){
        $data = array('status' => '1',
                     'updated_at' => date('Y-m-d H:i:s'),
                     'updated_by' => $this->session->identity
                );
        $insert = $this->query_model->update('m_banner',array('id_banner' => $this->input->post('id',true)), $data);
        if (!$insert){
            echo json_encode(['success' => false, 'message' => 'Slider gagal diaktifkan','status' => TRUE]);
        }else {
            echo json_encode(['success' => true, 'message' => 'Slider berhasil diaktifkan','status' => TRUE]);
        }
    }

    public function ajax_data(){
        $type = $this->input->post('type');
        switch ($type) {
            case 'slider':
                $jenis = $this->input->post('jenis');
                $id_jenis = $this->input->post('id_jenis');

                if ($jenis == 'produk') {
                    $query['select']   = 'a.*,b.kode_produk as kode_jenis, b.nama_produk as nama_jenis';
                    $query['join'][0]  = array('m_produk b','b.id_produk = a.id_jenis');
                }elseif ($jenis == 'umkm') {
                    $query['select']   = 'a.*,b.namausaha as nama_jenis';
                    $query['join'][0]  = array('m_umkm b','b.id_umkm = a.id_jenis');
                }elseif ($jenis == 'agenda') {
                    $query['select']   = 'a.*,b.kode_agenda as kode_jenis, b.judul as nama_jenis';
                    $query['join'][0]  = array('m_agenda b','b.id_agenda = a.id_jenis');
                }elseif ($jenis == 'berita') {
                    $query['select']  = 'a.*,b.kode_berita as kode_jenis, b.judul as nama_jenis';
                    $query['join'][0]  = array('m_berita b','b.id_berita = a.id_jenis');
                }else{
                    $query['select']  = 'a.*';
                }

                $query['table']     = 'm_banner a';
                $query['where']     = 'a.id_banner = '.(int)$this->input->post('id');
                $data               = $this->query_model->getRow($query);
                echo json_encode($data);    
            break;
            case 'banner_produk':
                $query['select']    = 'a.*,b.nama_produk,b.kode_produk';
                $query['table']     = 'm_banner_produk a';
                $query['join'][0]   = array('m_produk b','b.id_produk = a.id_produk');
                $query['where']     = 'a.id_banner_produk = '.(int)$this->input->post('id');
                $data               = $this->query_model->getRow($query);
                echo json_encode($data);   
            break;
            default:
                # code...
                break;
        }
    }

    public function ajax_upload()
    {
        if($_FILES['file']['name'] != '')
        {
            $type = $this->input->post('type');
            if ($type == 'slider') {
                $folder = 'slider';
            }elseif($type == 'banner_produk'){
                $folder = 'banner_produk';
            }else{
                echo json_encode(['error' => 1, 'message' => 'unkown type']);
                exit();
            }
            $config['upload_path'] = './assets/images/'.$folder;
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['encrypt_name'] = TRUE;
            $config['overwrite'] = TRUE;
            $this->upload->initialize($config);
            $this->upload->initialize($config);

            if($this->upload->do_upload("file")){    
                $name = $this->upload->data();
                $foto_berita  = $name['file_name'];
                echo json_encode([ 'error' => 0,'file' => $foto_berita,'url' => base_url('assets/images/'.$folder.'/'.$foto_berita),'message' => $this->upload->display_errors() ]);
            }else{
                echo json_encode(['error' => 1, 'message' => $this->upload->display_errors()]);
                exit();
            }
        }
    }

    private function _validate($type){
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('title',true) == ''){
            $data['inputerror'][] = 'title';
            $data['error_string'][] = 'Data Harus Diisi';
            $data['status'] = FALSE;
        }

        if ($type == 'slider') {
            if($this->input->post('jenis',true) == ''){
                $data['inputerror'][] = 'nm_jenis';
                $data['error_string'][] = 'Data Harus Diisi';
                $data['status'] = FALSE;
            }else{
                if ($this->input->post('jenis',true) == 'produk') {
                    if ($this->input->post('id_produk') == '') {
                        $data['inputerror'][] = 'nm_produk';
                        $data['error_string'][] = 'Data Harus Diisi';
                        $data['status'] = FALSE;
                    }
                }elseif ($this->input->post('jenis',true) == 'umkm') {
                     if ($this->input->post('id_umkm') == '') {
                        $data['inputerror'][] = 'nm_umkm';
                        $data['error_string'][] = 'Data Harus Diisi';
                        $data['status'] = FALSE;
                    }
                }elseif ($this->input->post('jenis',true) == 'berita') {
                     if ($this->input->post('id_berita') == '') {
                        $data['inputerror'][] = 'nm_berita';
                        $data['error_string'][] = 'Data Harus Diisi';
                        $data['status'] = FALSE;
                    }
                }elseif ($this->input->post('jenis',true) == 'agenda') {
                     if ($this->input->post('id_agenda') == '') {
                        $data['inputerror'][] = 'nm_agenda';
                        $data['error_string'][] = 'Data Harus Diisi';
                        $data['status'] = FALSE;
                    }
                }else{
                    if ($this->input->post('url') == '') {
                        $data['inputerror'][] = 'url';
                        $data['error_string'][] = 'Data Harus Diisi';
                        $data['status'] = FALSE;
                    }elseif (filter_var($this->input->post('url'), FILTER_VALIDATE_URL) === FALSE) {
                        $data['inputerror'][] = 'url';
                        $data['error_string'][] = 'Url tidak valid';
                        $data['status'] = FALSE;
                    }
                }
            }

            if($this->input->post('file_berita',true) == '')
            {
                $data['inputerror'][] = 'file_berita';
                $data['error_string'][] = 'Data Harus Diisi';
                $data['status'] = FALSE;
            }     
        }elseif ($type == 'banner_produk') {
            if ($this->input->post('id_produk') == '') {
                $data['inputerror'][] = 'nm_produk';
                $data['error_string'][] = 'Data Harus Diisi';
                $data['status'] = FALSE;
            }

            if($this->input->post('file_banner_produk',true) == '')
            {
                $data['inputerror'][] = 'file_banner_produk';
                $data['error_string'][] = 'Data Harus Diisi';
                $data['status'] = FALSE;
            }  
        }
        
        
        if($data['status'] === FALSE){
            echo json_encode($data);
            exit();
        }
    }
}