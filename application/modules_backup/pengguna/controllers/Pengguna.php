<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->template->set_layout('templates/backend');
        if(!$this->user_model->is_umkm_admin())
        {
            redirect(base_url());
        }
	}

	public function index() {
		$this->template->add_title_segment('Data Pengguna');
		$this->template->add_meta_tag("description", "Portal UMKM Kota Tangerang");
		$this->template->add_meta_tag("keywords", "umkm,portal umkm,kota tangerang,tangerang,portal");

		// $this->template->add_css('assets/css.css');
		// $this->template->add_js('assets/js.js');
		$this->template->add_js('https://cdn.ckeditor.com/4.9.2/standard-all/ckeditor.js');
		$this->template->add_js('assets/ckfinder/ckfinder.js');
		$this->template->add_js('assets/plugins/tables/datatables/datatables.min.js');
		$this->template->add_js('assets/plugins/tables/datatables/extensions/fixed_columns.min.js');
		$this->template->add_js('assets/plugins/forms/selects/select2.min.js');
		$this->template->add_js('assets/plugins/notifications/sweet_alert.min.js');

        $k = keranjangku();
        $keranjang = $k['keranjang'];
        $jml_keranjang = $k['jml_keranjang'];

		$this->data = array(
            'kategori'  => $this->query_model->getKategori(),
			'active'	=> 'pengguna',
			'name'		=> $this->security->get_csrf_token_name(),
			'hash'		=> $this->security->get_csrf_hash(),
            'keranjang' => $keranjang,
            'jml_keranjang' => $jml_keranjang,
            'title_beranda' => 'Pengguna'
		);

		$this->template->render("index",$this->data);
	}

	public function ajax_list()
	{
		$data   = array();
        $sort	= isset($_POST['columns'][$_POST['order'][0]['column']]['data']) ? strval($_POST['columns'][$_POST['order'][0]['column']]['data']) : 'nama';
        $order	= isset($_POST['order'][0]['dir']) ? strval($_POST['order'][0]['dir']) : 'asc';
        $no 	= $this->input->post('start');

		$list = $this->m_table->get_datatables('data_pengguna',$sort,$order);
        foreach ($list as $l) {
            $no++;
            $l->no = $no;
            $l->last_login = indonesian_date($l->last_login);
            if($l->status)
            {
                $l->status = 'Aktif';
                $l->aksi = '
                    <a href="javascript:void(0);" onclick="lihat_data('.$l->id_pengguna.')" title="Lihat Detail Pengguna" class="btn btn-success"><i class="fa fa-eye"></i></a>
                    <a href="javascript:void(0);" onclick="ubah_data('.$l->id_pengguna.')" title="Ubah Group" class="btn btn-info"><i class="fa fa-pencil"></i></a>
                    <a href="javascript:void(0);" onclick="hapus_data('.$l->id_pengguna.')" title="Nonaktifkan Data Pengguna" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                '; 
            }else{
                $l->status = 'Tidak Aktif';
                $l->aksi = '
                    <a href="javascript:void(0);" onclick="lihat_data('.$l->id_pengguna.')" title="Lihat Detail Pengguna" class="btn btn-success"><i class="fa fa-eye"></i></a>
                    <a href="javascript:void(0);" onclick="ubah_data('.$l->id_pengguna.')" title="Ubah Group" class="btn btn-info"><i class="fa fa-pencil"></i></a>
                    <a href="javascript:void(0);" onclick="aktif_data('.$l->id_pengguna.')" title="Aktifkan Data Pengguna" class="btn btn-primary"><i class="fa fa-undo"></i></a>
                '; 
            }
            
            
            $data[] = $l;
        }

        $output = array(
            "draw"              => $_POST['draw'],
            "recordsTotal"      => $this->m_table->count_all('data_pengguna',$sort,$order),
            "recordsFiltered"   => $this->m_table->count_filtered('data_pengguna',$sort,$order),
            "data"              => $data,
        );  
        echo json_encode($output);  
	}

    public function ajax_lihat()
    {
        $query['select']    = 'a.*,a.status';
        $query['table']     = 'm_pengguna a';
        $query['where']     = 'a.id_pengguna = '.(int)$this->input->post('id');
        $data               = $this->query_model->getRow($query);
        echo json_encode($data);
    }

    public function ajax_hapus(){
        $data = array(
            'status'        => 0,
        );

        $insert = $this->query_model->update('m_pengguna',array('id_pengguna' => $this->input->post('id',true)), $data);

        if (!$insert)
        {
            echo json_encode(['success' => false, 'message' => 'Akun gagal dinon aktifkan','status' => TRUE]);
        }
        else 
        {
            echo json_encode(['success' => true, 'message' => 'Akun berhasil dinon aktifkan','status' => TRUE]);
        }
    }

    public function ajax_restore(){
        $data = array(
            'status'        => 1,
        );

        $insert = $this->query_model->update('m_pengguna',array('id_pengguna' => $this->input->post('id',true)), $data);

        if (!$insert)
        {
            echo json_encode(['success' => false, 'message' => 'Akun gagal diaktifkan','status' => TRUE]);
        }
        else 
        {
            echo json_encode(['success' => true, 'message' => 'Akun berhasil diaktifkan','status' => TRUE]);
        }
    }

}