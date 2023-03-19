<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daftar_alamat extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->template->set_layout('templates/backend');
        if(!$this->user_model->is_login())
        {
            redirect(base_url());
        }
        $this->session->set_tempdata('jenis_menu','user',300); 
	}

	public function index() {
		$this->template->add_title_segment('Daftar Alamat');
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

        if($this->user_model->is_login()){
            $keranjang          = $this->query_model->keranjang('data');
            $jml_keranjang      = $this->query_model->keranjang('jumlah');
        }else{
            $keranjang = null;
            $jml_keranjang = 0;
        }

		$this->data = array(
			'active'	=> 'alamat',
			'name'		=> $this->security->get_csrf_token_name(),
			'hash'		=> $this->security->get_csrf_hash(),
            'keranjang' => $keranjang,
            'jml_keranjang' => $jml_keranjang,
            'kategori' => $this->query_model->getKategori(),
            'title_beranda' => 'Biodata'
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
            $l->aksi = '
                <a href="javascript:void(0);" onclick="lihat_data('.$l->id_alamat.')" title="Lihat Data Alamat" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                <a href="javascript:void(0);" onclick="ubah_data('.$l->id_alamat.')" title="Ubah Data Alamat" class="btn btn-info"><i class="fa fa-pencil"></i></a>
                <a href="javascript:void(0);" onclick="hapus_data('.$l->id_alamat.')" title="Hapus Data Alamat" class="btn btn-danger"><i class="fa fa-trash"></i></a>
            '; 
            
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
                
                $data = array(
                    'utama'         => $this->input->post('utama',true),
                    'id_pengguna'   => $this->session->user_id,
                    'username'      => $this->session->identity,
                    'nama_alamat'   => $this->input->post('nama_alamat',true),
                    'id_prop'       => $this->input->post('id_prop',true),
                    'nama_prop'     => get_propinsi($this->input->post('id_prop',true)),
                    'id_kota'       => $this->input->post('id_kota',true),
                    'nama_kota'     => get_kota($this->input->post('id_prop',true),$this->input->post('id_kota',true)),
                    'id_kec'        => $this->input->post('id_kec',true),
                    'nama_kec'      => get_kec($this->input->post('id_prop',true),$this->input->post('id_kota',true),$this->input->post('id_kec',true)),
                    'id_kel'        => $this->input->post('id_kel',true),
                    'nama_kel'      => get_kel($this->input->post('id_prop',true),$this->input->post('id_kota',true),$this->input->post('id_kec',true),$this->input->post('id_kel',true)),
                    'alamat'        => $this->input->post('alamat',true),
                    'nama_penerima' => $this->input->post('nama_penerima',true),
                    'no_penerima'   => $this->input->post('no_penerima',true),
                    'created_at'    => date('Y-m-d H:i:s'),
                    'status'        => 'aktif',
                );

                $insert = $this->query_model->insert_id('m_alamat',$data);
                if($this->input->post('utama'))
                {
                    $data_reset = array(
                        'utama'         => 0,
                        'updated_at'    => date('Y-m-d H:i:s')
                    );

                    $this->query_model->update('m_alamat',null, $data_reset);

                    $data_utama = array(
                        'utama'         => 1,
                        'updated_at'    => date('Y-m-d H:i:s')
                    );

                    $this->query_model->update('m_alamat',array('id_alamat' => $insert), $data_utama);
                }

                if (!$insert)
                {
                    echo json_encode(['success' => false, 'message' => 'Data gagal ditambahkan','status' => TRUE]);
                }
                else 
                {
                    echo json_encode(['success' => true, 'message' => 'Data Berhasil ditambahkan','status' => TRUE]);
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
                $data = array(
                    'id_pengguna'   => $this->session->user_id,
                    'username'      => $this->session->identity,
                    'nama_alamat'   => $this->input->post('nama_alamat',true),
                    'id_prop'       => $this->input->post('id_prop',true),
                    'nama_prop'     => get_propinsi($this->input->post('id_prop',true)),
                    'id_kota'       => $this->input->post('id_kota',true),
                    'nama_kota'     => get_kota($this->input->post('id_prop',true),$this->input->post('id_kota',true)),
                    'id_kec'        => $this->input->post('id_kec',true),
                    'nama_kec'      => get_kec($this->input->post('id_prop',true),$this->input->post('id_kota',true),$this->input->post('id_kec',true)),
                    'id_kel'        => $this->input->post('id_kel',true),
                    'nama_kel'      => get_kel($this->input->post('id_prop',true),$this->input->post('id_kota',true),$this->input->post('id_kec',true),$this->input->post('id_kel',true)),
                    'alamat'        => $this->input->post('alamat',true),
                    'nama_penerima' => $this->input->post('nama_penerima',true),
                    'no_penerima'   => $this->input->post('no_penerima',true),
                    'updated_at'    => date('Y-m-d H:i:s')
                );



                $insert = $this->query_model->update('m_alamat',array('id_alamat' => $this->input->post('id',true)), $data);

                if($this->input->post('utama'))
                {
                    $data_reset = array(
                        'utama'         => 0,
                        'updated_at'    => date('Y-m-d H:i:s')
                    );

                    $this->query_model->update('m_alamat',null, $data_reset);

                    $data_utama = array(
                        'utama'         => 1,
                        'updated_at'    => date('Y-m-d H:i:s')
                    );

                    $this->query_model->update('m_alamat',array('id_alamat' =>  $this->input->post('id',true)), $data_utama);
                }

                if (!$insert)
                {
                    echo json_encode(['success' => false, 'message' => 'Data gagal diubah','status' => TRUE]);
                }
                else 
                {
                    echo json_encode(['success' => true, 'message' => 'Data Berhasil diubah','status' => TRUE]);
                }
            break;
        }
    }

    public function ajax_hapus()
    {

       $hapus  = $this->query_model->delete('m_alamat',array('id_alamat'=> $this->input->post('id',true)));
        if (!$hapus)
        {
            echo json_encode(['success' => false, 'message' => 'Gagal menghapus data!','status' => TRUE]);
        }
        else 
        {
            echo json_encode(['success' => true, 'message' => 'Data berhasil dihapus','status' => TRUE]);
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