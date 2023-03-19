<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Slider extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->template->set_layout('templates/backend');
        if(!$this->user_model->is_umkm_admin())
        {
            redirect(base_url());
        }
	}

	public function index() {
		$this->template->add_title_segment('Slider UMKM');
		$this->template->add_meta_tag("description", "Portal UMKM Kota Tangerang");
		$this->template->add_meta_tag("keywords", "umkm,portal umkm,kota tangerang,tangerang,portal");

        $this->template->add_css('assets/css/css_admin.css');
		// $this->template->add_css('assets/css.css');
		// $this->template->add_js('assets/js.js');
		$this->template->add_js('https://cdn.ckeditor.com/4.9.2/standard-all/ckeditor.js');
		$this->template->add_js('assets/ckfinder/ckfinder.js');
		$this->template->add_js('assets/plugins/tables/datatables/datatables.min.js');
		$this->template->add_js('assets/plugins/tables/datatables/extensions/fixed_columns.min.js');
		$this->template->add_js('assets/plugins/forms/selects/select2.min.js');
		$this->template->add_js('assets/plugins/notifications/sweet_alert.min.js');
        // $this->template->add_js('assets/.js');
        $k = keranjangku();
        $keranjang = $k['keranjang'];
        $jml_keranjang = $k['jml_keranjang'];

        $this->data = array(
            'kategori'  => $this->query_model->getKategori(),
			'active'	=> 'slider',
			'name'		=> $this->security->get_csrf_token_name(),
			'hash'		=> $this->security->get_csrf_hash(),
            'keranjang' => $keranjang,
            'jml_keranjang' => $jml_keranjang,
            'title_beranda' => 'Slider',
		);

		$this->template->render("index",$this->data);
	}

	public function ajax_list()
	{
		$data   = array();
        $sort	= isset($_POST['columns'][$_POST['order'][0]['column']]['data']) ? strval($_POST['columns'][$_POST['order'][0]['column']]['data']) : 'nama';
        $order	= isset($_POST['order'][0]['dir']) ? strval($_POST['order'][0]['dir']) : 'asc';
        $no 	= $this->input->post('start');

		$list = $this->m_table->get_datatables('slider',$sort,$order);
        foreach ($list as $l) {
            $no++;
            $l->no = $no;
            $l->created_at = indonesian_date($l->created_at);
            if($l->status == 'aktif')
            {
                $l->aksi = '
                    <a href="javascript:void(0);" onclick="ubah_data('.$l->id_slider.')" title="Ubah Slider" class="btn btn-info"><i class="fa fa-pencil"></i></a>
                    <a href="javascript:void(0);" onclick="hapus_data('.$l->id_slider.')" title="Nonaktifkan Slider" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                '; 
            }else{
                $l->aksi = '
                    <a href="javascript:void(0);" onclick="ubah_data('.$l->id_slider.')" title="Ubah Slider" class="btn btn-info"><i class="fa fa-pencil"></i></a>
                    <a href="javascript:void(0);" onclick="restore_data('.$l->id_slider.')" title="Aktifkan Slider" class="btn btn-primary"><i class="fa fa-undo"></i></a>
                ';
            }
            $l->status = text($l->status);
            
            $data[] = $l;
        }

        $output = array(
            "draw"              => $_POST['draw'],
            "recordsTotal"      => $this->m_table->count_all('slider',$sort,$order),
            "recordsFiltered"   => $this->m_table->count_filtered('slider',$sort,$order),
            "data"              => $data,
        );  
        echo json_encode($output);  
	}

    public function ajax_save()
    {
        $this->_validate();
        $data = array(
            'foto'              => $this->input->post('file_berita',true),
            'judul'             => $this->input->post('judul',true),
            'status'            => 'aktif',
            'created_at'        => date('Y-m-d H:i:s')

        );

        $insert = $this->query_model->insert('m_slider',$data);

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
            'foto'              => $this->input->post('file_berita',true),
            'judul'             => $this->input->post('judul',true),
            'updated_at'        => date('Y-m-d H:i:s')

        );

        $insert = $this->query_model->update('m_slider',array('id_slider' => $this->input->post('id',true)), $data);

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
            'status' => 'nonaktif',
            'updated_at'    => date('Y-m-d H:i:s'),
        );

        $insert = $this->query_model->update('m_slider',array('id_slider' => $this->input->post('id',true)), $data);

        if (!$insert)
        {
            echo json_encode(['success' => false, 'message' => 'Slider gagal di nonaktifkan','status' => TRUE]);
        }
        else 
        {
            echo json_encode(['success' => true, 'message' => 'Slider berhasil di nonaktifkan','status' => TRUE]);
        }
    }

    public function ajax_restore(){
        $data = array(
            'status' => 'aktif',
            'updated_at'    => date('Y-m-d H:i:s'),
        );

        $insert = $this->query_model->update('m_slider',array('id_slider' => $this->input->post('id',true)), $data);

        if (!$insert)
        {
            echo json_encode(['success' => false, 'message' => 'Slider gagal diaktifkan','status' => TRUE]);
        }
        else 
        {
            echo json_encode(['success' => true, 'message' => 'Slider berhasil diaktifkan','status' => TRUE]);
        }
    }

    public function ajax_data()
    {
        $type = $this->input->post('type');
        switch ($type) {
            case 'slider':
                $query['select']    = '*';
                $query['table']     = 'm_slider';
                $query['where']     = 'id_slider = '.(int)$this->input->post('id');
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
            $config['upload_path'] = './assets/images/slider';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['encrypt_name'] = TRUE;
            $config['overwrite'] = TRUE;
            $this->upload->initialize($config);
            $this->upload->initialize($config);

            if($this->upload->do_upload("file"))
            {    
                $name = $this->upload->data();
                $foto_berita  = $name['file_name'];
                echo json_encode([ 'error' => 0,'file' => $foto_berita,'url' => base_url('assets/images/slider/'.$foto_berita),'message' => $this->upload->display_errors() ]);
            }
            else
            {
                echo json_encode(['error' => 1, 'message' => $this->upload->display_errors()]);
                exit();
            }
        }
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('file_berita',true) == '')
        {
            $data['inputerror'][] = 'file_berita';
            $data['error_string'][] = 'Data Harus Diisi';
            $data['status'] = FALSE;
        }

        if($this->input->post('judul',true) == '')
        {
            $data['inputerror'][] = 'judul';
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