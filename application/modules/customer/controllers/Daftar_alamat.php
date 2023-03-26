<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daftar_alamat extends MY_Controller {

	public function __construct() {
		parent::__construct();
        if(!$this->user_model->is_login()){
            redirect(base_url());
        }
        $this->template->set_layout('frontend/index');
	}

	public function index() {
		$this->template->add_title_segment('Daftar Alamat');
		$this->template->add_meta_tag("description", "Toko Muslimah no 1 di indonesia");
		$this->template->add_meta_tag("keywords", "umkm,portal umkm,kota tangerang,tangerang,portal");

        $this->template->add_css(base_url().'assets/plugins/datatables/dataTables.bootstrap.css');
        $this->template->add_js(base_url().'assets/plugins/datatables/jquery.dataTables.min.js',true);
        $this->template->add_js(base_url().'assets/plugins/datatables/dataTables.bootstrap.min.js',true);

        $k = keranjangku();
        $keranjang = $k['keranjang'];
        $jml_keranjang = $k['jml_keranjang'];

		$this->data = array(
			'active'	=> 'alamat',
			'name'		=> $this->security->get_csrf_token_name(),
			'hash'		=> $this->security->get_csrf_hash(),
            'keranjang' => $keranjang,
            'jml_keranjang' => $jml_keranjang,
            'kategori' => $this->query_model->getKategori(),
            'title_beranda' => 'Alamat'
		);

		$this->template->render("alamat/index",$this->data);
	}

	public function ajax_list()
	{
		$data   = array();
        $sort	= isset($_POST['columns'][$_POST['order'][0]['column']]['data']) ? strval($_POST['columns'][$_POST['order'][0]['column']]['data']) : 'nama';
        $order	= isset($_POST['order'][0]['dir']) ? strval($_POST['order'][0]['dir']) : 'asc';
        $no 	= $this->input->post('start');

		$list = $this->m_table->get_datatables('data_alamat',$sort,$order);
        foreach ($list as $l) {
            $no++;
            $l->no = $no;
            $l->nama_alamat = $l->nama_alamat.' <span style="color:#d9534f;font-size:11px;">'.($l->utama?'Utama':'').'</span>';
            $l->aksi = '<div style="text-align:center;">
            <a href="javascript:void(0);" onclick="lihat_data('.$l->id_alamat.')" title="Lihat Data Alamat" class="btn btn-sm btn-default"><i class="fa fa-eye"></i></a>
                <a href="javascript:void(0);" onclick="ubah_data('.$l->id_alamat.')" title="Ubah Data Alamat" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i></a>
                <a href="javascript:void(0);" onclick="hapus_data('.$l->id_alamat.')" title="Hapus Data Alamat" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                </div>'; 
                        
            $data[] = $l;
        }

        $output = array(
            "draw"              => $_POST['draw'],
            "recordsTotal"      => $this->m_table->count_all('data_alamat',$sort,$order),
            "recordsFiltered"   => $this->m_table->count_filtered('data_alamat',$sort,$order),
            "data"              => $data,
        );  
        echo json_encode($output);  
	}

	public function ajax_lihat()
    {
        $query['select']    = '*';
        $query['table']     = 'm_alamat';
        $query['where']     = 'id_alamat = '.(int)$this->input->post('id',true);
        $data               = $this->query_model->getRow($query);
        echo json_encode($data);
    }

    public function ajax_save(){
        $type = $this->input->post('type',true);
        switch ($type) {
            case 'data_alamat':
                $this->_validate($type);
                $data = $this->_data_insert_update_alamat();
                $data['status'] = 'aktif';
                $data['created_at'] = date('Y-m-d H:i:s');
                $insert = $this->query_model->insert_id('m_alamat',$data);
                if (!$insert){
                    echo json_encode(['success' => false, 'message' => 'Data gagal ditambahkan','status' => TRUE]);
                }else {
                    if($this->input->post('utama')){
                        $this->_update_alamat_utama($insert);
                    }

                    echo json_encode(['success' => true, 'message' => 'Data berhasil ditambahkan','status' => TRUE]);
                }
            break;
            default:
                # code...
            break;
        }
    }

    public function ajax_ubah(){
        $type = $this->input->post('type',true);
        switch ($type) {
            case 'data_alamat':
                $this->_validate($type);
                $data = $this->_data_insert_update_alamat();
                $data['updated_at'] = date('Y-m-d H:i:s');

                $insert = $this->query_model->update('m_alamat',array('id_alamat' => $this->input->post('id',true)), $data);
                if (!$insert){
                    echo json_encode(['success' => false, 'message' => 'Data gagal diubah','status' => TRUE]);
                }else{
                    if($this->input->post('utama')){
                        $this->_update_alamat_utama($this->input->post('id',true));
                    }

                    echo json_encode(['success' => true, 'message' => 'Data berhasil diubah','status' => TRUE]);
                }
            break;
        }
    }

    private function _data_insert_update_alamat(){
        $data = array(
                    'utama'         => $this->input->post('utama',true),
                    'id_pengguna'   => $this->session->user_id,
                    'username'      => $this->session->identity,
                    'nama_alamat'   => $this->input->post('nama_alamat',true),
                    'id_prop'       => $this->input->post('id_prop',true),
                    'nama_prop'     => $this->input->post('nama_prop',true),
                    'id_kota'       => $this->input->post('id_kota',true),
                    'nama_kota'     => $this->input->post('nama_kota',true),
                    'id_kec'        => $this->input->post('id_kec',true),
                    'nama_kec'      => $this->input->post('nama_kec',true),
                    'id_kel'        => $this->input->post('id_kel',true),
                    'nama_kel'      => $this->input->post('nama_kel',true),
                    'alamat'        => $this->input->post('alamat',true),
                    'nama_penerima' => $this->input->post('nama_penerima',true),
                    'no_penerima'   => $this->input->post('no_penerima',true),
                );
        return $data;
    }

    private function _update_alamat_utama($id_alamat){
        $data_reset = array('utama' => 0,'updated_at' => date('Y-m-d H:i:s'));
        $this->query_model->update('m_alamat',null, $data_reset);

        $data_utama = array('utama' => 1,'updated_at' => date('Y-m-d H:i:s'));
        $this->query_model->update('m_alamat',array('id_alamat' => $id_alamat), $data_utama);
    }

    public function ajax_hapus(){
       $update  = $this->query_model->update('m_alamat',array('id_alamat'=> $this->input->post('id',true)),array('status' => 'nonaktif'));
        if (!$update){
            echo json_encode(['success' => false, 'message' => 'Gagal menghapus data!','status' => TRUE]);
        }else {
            echo json_encode(['success' => true, 'message' => 'Berhasil menghapus data','status' => TRUE]);
        }
    }

    private function _validate($type){
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        switch ($type) {
            case 'data_alamat':
                if($this->input->post('nama_alamat',true) == '')
                {
                    $data['inputerror'][] = 'nama_alamat';
                    $data['error_string'][] = 'Data Tidak Boleh Kosong';
                    $data['status'] = FALSE;
                }

                if($this->input->post('nama_penerima',true) == '')
                {
                    $data['inputerror'][] = 'nama_penerima';
                    $data['error_string'][] = 'Data Tidak Boleh Kosong';
                    $data['status'] = FALSE;
                }

                if($this->input->post('no_penerima',true) == '')
                {
                    $data['inputerror'][] = 'no_penerima';
                    $data['error_string'][] = 'Data Tidak Boleh Kosong';
                    $data['status'] = FALSE;
                }

                if($this->input->post('id_prop',true) == 0)
                {
                    $data['inputerror'][] = 'nama_prop';
                    $data['error_string'][] = 'Data Tidak Boleh Kosong';
                    $data['status'] = FALSE;
                }

                if($this->input->post('id_kota',true) == 0)
                {
                    $data['inputerror'][] = 'nama_kota';
                    $data['error_string'][] = 'Data Tidak Boleh Kosong';
                    $data['status'] = FALSE;
                }

                if($this->input->post('id_kec',true) == 0)
                {
                    $data['inputerror'][] = 'nama_kec';
                    $data['error_string'][] = 'Data Tidak Boleh Kosong';
                    $data['status'] = FALSE;
                }

                if($this->input->post('id_kel',true) == 0)
                {
                    $data['inputerror'][] = 'nama_kel';
                    $data['error_string'][] = 'Data Tidak Boleh Kosong';
                    $data['status'] = FALSE;
                }

                if($this->input->post('alamat',true) == '')
                {
                    $data['inputerror'][] = 'data_alamat';
                    $data['error_string'][] = 'Data Tidak Boleh Kosong';
                    $data['status'] = FALSE;
                }
                
                if($data['status'] === FALSE)
                {
                    echo json_encode($data);
                    exit();
                }
            break;
            
            default:
                # code...
            break;
        }
    }
}