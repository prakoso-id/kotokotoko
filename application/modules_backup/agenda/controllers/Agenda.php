<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agenda extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('agenda_model');
        $this->load->library('pagination');
	}

    public function index()
    {
        $this->template->set_layout('templates/frontend');
        $this->template->add_title_segment('Agenda');
        $this->template->add_meta_tag("description", "Agenda UMKM Kota Tangerang");
        $this->template->add_meta_tag("keywords", "agenda, agenda,news,umkm,portal umkm,kota tangerang,tangerang,portal");
        // $this->template->add_css('assets/css.css');
        // $this->template->add_js('assets/plugins/tables/datatables/datatables.min.js');

        $k = keranjangku();
        $keranjang = $k['keranjang'];
        $jml_keranjang = $k['jml_keranjang'];

        $cari = htmlentities($this->input->get('cari',true), ENT_QUOTES, 'UTF-8');

        //konfigurasi pagination
        $config['page_query_string'] = true;
        $config['reuse_query_string'] = true;
        $config['query_string_segment'] = 'page';
        $config['base_url'] = site_url('agenda'); //site url
        $config['total_rows'] = $this->agenda_model->get_count_all_agenda($cari); //total row
        $config['per_page'] = 20;  //show record per halaman
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
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
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
        $page = ($this->input->get('page')) ? $this->input->get('page') : 0;
 
        $data_berita = $this->agenda_model->getAgenda($config["per_page"], $page, $cari);           
        $pagination = $this->pagination->create_links();

        $this->data = array(
            'active'        => 'list-agenda',
            'keranjang'     => $keranjang,
            'kategori'      => $this->query_model->getKategori(),
            'berita'        => $data_berita,
            'jml_keranjang' => $jml_keranjang,
            'pagination'    => $pagination,
            'title_beranda' => 'Daftar Agenda'
        );

        $this->template->render("agenda",$this->data);
    }

    public function detail($id)
    {
        $kode_agenda = short($id,true);
        
        $berita['select']   = '*';
        $berita['table']    = 'm_agenda';
        $berita['where']    = 'kode_agenda = '.(int)$kode_agenda;
        $berita['order']    = 'id_agenda desc';
        $data_berita        = $this->query_model->getRow($berita);

        if(empty($data_berita))
        {
            redirect(base_url('not-found'));
        }
        $this->template->set_layout('templates/frontend');

        $this->template->add_title_segment('Agenda');
        $this->template->add_meta_tag("description", "Agenda UMKM Kota Tangerang");
        $this->template->add_meta_tag("keywords", "agenda, agenda,news,umkm,portal umkm,kota tangerang,tangerang,portal");
        // $this->template->add_css('assets/css.css');
        // $this->template->add_js('assets/plugins/tables/datatables/datatables.min.js');

        $k = keranjangku();
        $keranjang = $k['keranjang'];
        $jml_keranjang = $k['jml_keranjang'];

        $list_berita['select']  = '*';
        $list_berita['table']   = 'm_agenda';
        $list_berita['limit']   = '5';
        $list_berita['where']   = 'kode_agenda != '.(int)$kode_agenda;
        $list_berita['order']   = 'rand(id_agenda)';
        $data_berita_list       = $this->query_model->getData($list_berita);

        $this->data = array(
            'active'        => 'detail-agenda',
            'keranjang'     => $keranjang,
            'kategori'      => $this->query_model->getKategori(),
            'berita'        => $data_berita,
            'jml_keranjang' => $jml_keranjang,
            'list_berita'   => $data_berita_list,
            'title_beranda' => 'Agenda'
        );

        $this->template->render("agenda_detail",$this->data);
    }
    

	public function data() {
        $this->template->set_layout('templates/backend');
        if(!$this->user_model->is_umkm_admin())
        {
            redirect(base_url());
        }

		$this->template->add_title_segment('Agenda UMKM');
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
        if($this->user_model->is_login())
          {
               $keranjang          = $this->query_model->keranjang('data');
               $jml_keranjang      = $this->query_model->keranjang('jumlah');
          }else{
               $keranjang = null;
               $jml_keranjang = 0;
          }

          $this->data = array(
            'kategori'  => $this->query_model->getKategori(),
			'active'	=> 'agenda',
			'name'		=> $this->security->get_csrf_token_name(),
			'hash'		=> $this->security->get_csrf_hash(),
            'keranjang' => $keranjang,
            'jml_keranjang' => $jml_keranjang,
            'title_beranda' => 'Agenda'
		);

		$this->template->render("index",$this->data);
	}

	public function ajax_list()
	{
		$data   = array();
        $sort	= isset($_POST['columns'][$_POST['order'][0]['column']]['data']) ? strval($_POST['columns'][$_POST['order'][0]['column']]['data']) : 'nama';
        $order	= isset($_POST['order'][0]['dir']) ? strval($_POST['order'][0]['dir']) : 'asc';
        $no 	= $this->input->post('start');

		$list = $this->m_table->get_datatables('agenda',$sort,$order);
        foreach ($list as $l) {
            $no++;
            $l->no = $no;
            $l->tanggal = indonesian_date_2($l->tanggal);

            if($l->status == 'aktif')
            {
                $l->aksi = '
                    <a href="javascript:void(0);" onclick="ubah_data('.$l->id_agenda.')" title="Ubah Agenda" class="btn btn-info"><i class="fa fa-pencil"></i></a>
                    <a href="javascript:void(0);" onclick="hapus_data('.$l->id_agenda.')" title="Nonaktifkan Agenda" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                '; 
            }else{
                $l->aksi = '
                    <a href="javascript:void(0);" onclick="ubah_data('.$l->id_agenda.')" title="Ubah Agenda" class="btn btn-info"><i class="fa fa-pencil"></i></a>
                    <a href="javascript:void(0);" onclick="restore_data('.$l->id_agenda.')" title="Aktifkan Agenda" class="btn btn-primary"><i class="fa fa-undo"></i></a>
                ';
            }
            
            $data[] = $l;
        }

        $output = array(
            "draw"              => $_POST['draw'],
            "recordsTotal"      => $this->m_table->count_all('agenda',$sort,$order),
            "recordsFiltered"   => $this->m_table->count_filtered('agenda',$sort,$order),
            "data"              => $data,
        );  
        echo json_encode($output);  
	}

    public function ajax_save()
    {
        $this->_validate();
        $data = array(
            'kode_agenda'       => time(),
            'username'          => $this->session->identity,
            'foto'              => $this->input->post('file_berita',true),
            'judul'             => $this->input->post('judul',true),
            'keterangan'        => toDesc($this->input->post('deskripsi')),
            'tanggal'           => $this->input->post('tanggal',true),
            'long'              => $this->input->post('long',true),
            'lat'               => $this->input->post('lat',true),
            'lokasi'            => $this->input->post('alamat',true),
            'status'            => 'aktif',
            'created_at'        => date('Y-m-d H:i:s')

        );

        $insert = $this->query_model->insert('m_agenda',$data);

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
            'username'          => $this->session->identity,
            'foto'              => $this->input->post('file_berita',true),
            'judul'             => $this->input->post('judul',true),
            'keterangan'        => toDesc($this->input->post('deskripsi')),
            'tanggal'           => $this->input->post('tanggal',true),
            'long'              => $this->input->post('long',true),
            'lat'               => $this->input->post('lat',true),
            'lokasi'            => $this->input->post('alamat',true),
            'updated_at'        => date('Y-m-d H:i:s')

        );

        $insert = $this->query_model->update('m_agenda',array('id_agenda' => $this->input->post('id')), $data);

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
            'updated_at' => date('Y-m-d H:i:s'),
        );

        $insert = $this->query_model->update('m_agenda',array('id_agenda' => $this->input->post('id',true)), $data);

        if (!$insert)
        {
            echo json_encode(['success' => false, 'message' => 'Agenda gagal di nonaktifkan','status' => TRUE]);
        }
        else 
        {
            echo json_encode(['success' => true, 'message' => 'Agenda berhasil di nonaktifkan','status' => TRUE]);
        }
    }

    public function ajax_restore(){
        $data = array(
            'status' => 'aktif',
            'updated_at' => date('Y-m-d H:i:s'),
        );

        $insert = $this->query_model->update('m_agenda',array('id_Agenda' => $this->input->post('id',true)), $data);

        if (!$insert)
        {
            echo json_encode(['success' => false, 'message' => 'Agenda gagal diaktifkan','status' => TRUE]);
        }
        else 
        {
            echo json_encode(['success' => true, 'message' => 'Agenda berhasil diaktifkan','status' => TRUE]);
        }
    }

    public function ajax_data()
    {
        $type = $this->input->post('type');
        switch ($type) {
            case 'agenda':
                $query['select']    = '*';
                $query['table']     = 'm_agenda';
                $query['where']     = 'id_agenda = '.(int)$this->input->post('id');
                $data = $this->query_model->getRow($query);
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
            $config['upload_path'] = './assets/images/agenda';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['encrypt_name'] = TRUE;
            $config['overwrite'] = TRUE;
            $this->upload->initialize($config);
            $this->upload->initialize($config);

            if($this->upload->do_upload("file"))
            {    
                $name = $this->upload->data();
                $foto_berita  = $name['file_name'];
                echo json_encode([ 'error' => 0,'file' => $foto_berita,'url' => base_url('assets/images/agenda/'.$foto_berita),'message' => $this->upload->display_errors() ]);
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

        if($this->input->post('deskripsi',true) == '')
        {
            $data['inputerror'][] = 'data_deskripsi';
            $data['error_string'][] = 'Data Harus Diisi';
            $data['status'] = FALSE;
        }

        if($this->input->post('tanggal',true) == '')
        {
            $data['inputerror'][] = 'tanggal';
            $data['error_string'][] = 'Data Harus Diisi';
            $data['status'] = FALSE;
        }

        if($this->input->post('alamat',true) == '')
        {
            $data['inputerror'][] = 'alamat';
            $data['error_string'][] = 'Data Harus Diisi';
            $data['status'] = FALSE;
        }

        if($this->input->post('lat',true) == '' OR $this->input->post('long',true) == '')
        {
            $data['inputerror'][] = 'alamat';
            $data['error_string'][] = 'Titik Alamat Harus dipilih';
            $data['status'] = FALSE;
        }
        
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

}