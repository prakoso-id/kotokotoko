<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logo_umkm extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->template->set_layout('templates/backend');
        if(!$this->user_model->is_umkm_penjual())
        {
            redirect(base_url());
        }
    }

    public function index() {
        $this->template->add_title_segment('Logo UMKM');
        $this->template->add_meta_tag("description", "Portal UMKM Kota Tangerang");
        $this->template->add_meta_tag("keywords", "umkm,portal umkm,kota tangerang,tangerang,portal");

        $this->template->add_css('assets/css/css_umkm.css');        
        $this->template->add_js('assets/plugins/forms/selects/select2.min.js');
        $this->template->add_js('assets/plugins/notifications/sweet_alert.min.js');
        // $this->template->add_js('assets/.js');
        $k = keranjangku();
        $keranjang = $k['keranjang'];
        $jml_keranjang = $k['jml_keranjang'];
        
        $this->data = array(
            'active'    => 'logo_umkm',
            'name'      => $this->security->get_csrf_token_name(),
            'hash'      => $this->security->get_csrf_hash(),
            'keranjang' => $keranjang,
            'jml_keranjang' => $jml_keranjang,
            'kategori'  => $this->query_model->getKategori(),
        );

        $this->template->render("index",$this->data);
    }

    public function ajax_data()
    {
        $cek['select']  = '*';
        $cek['table']   = 'm_umkm_berkas';
        $cek['where']   = 'id_umkm = '.(int)$this->input->post('id');
        $query          = $this->query_model->getRow($cek);
        $foto = $query->logo_umkm;
        if($query->logo_umkm)
        {
            $url = base_url('assets/logo/'.$query->logo_umkm);
        }else{
            $url = null;
        }

        echo json_encode(array('url' => $url,'foto' => $foto));
    }

    public function ajax_ubah()
    {
        $this->_validate();
        $data = array(
            'logo_umkm'      => $this->input->post('logo_umkm',true),
        );
        
        $this->query_model->update('m_umkm_berkas',array('id_umkm' => $this->input->post('id_umkm')), $data);

        $data_umkm = array(
            'updated_at'      => date('Y-m-d H:i:s'),
        );
        
        $insert = $this->query_model->update('m_umkm',array('id_umkm' => $this->input->post('id_umkm')), $data_umkm);
        if (!$insert)
        {
            echo json_encode(['success' => false, 'message' => 'Data Gagal Diubah, Silahkan Ulangi Lagi','status' => TRUE]);
        }
        else 
        {
            echo json_encode(['success' => true, 'message' => 'Data Berhasil Diubah','status' => TRUE]);
        }
    }

    public function ajax_upload()
    {
        // if (!is_dir('assets/media/'.$_SESSION['identity'])) {
        //     mkdir('assets/media/'.$_SESSION['identity']);
        // }

        // if (!is_dir('assets/media/'.$_SESSION['identity'].'/logo')) {
        //     mkdir('assets/media/'.$_SESSION['identity'].'/logo');
        // }

        if($_FILES['file']['name'] != '')
        {
            $config['upload_path'] = './assets/logo';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['encrypt_name'] = TRUE;
            $config['overwrite'] = TRUE;
            $this->upload->initialize($config);
            $this->upload->initialize($config);

            if($this->upload->do_upload("file"))
            {    
                $name = $this->upload->data();
                $surat_iumkm  = $name['file_name'];
                echo json_encode([ 'error' => 0,'file' => $surat_iumkm,'url' => base_url('assets/logo/'.$surat_iumkm),'message' => 'logo Berhasil diupload' ]);
            }
            else
            {
                echo json_encode(['error' => 1, 'message' => $this->upload->display_errors()]);
                exit();
            }
        }
    }

    private function _validate(){
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
        
        if($this->input->post('logo_umkm',true) == '')
        {
            $data['inputerror'][] = 'logo_umkm';
            $data['error_string'][] = 'Data Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if($this->input->post('id_umkm',true) == 0)
        {
            $data['inputerror'][] = 'umkm_id';
            $data['error_string'][] = 'Data Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
}