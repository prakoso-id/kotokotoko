<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->template->set_layout('templates/backend');
        if(!$this->user_model->is_umkm_penjual() AND !$this->user_model->is_umkm_admin() )
        {
            redirect(base_url());
        }
        $this->session->set_tempdata('jenis_menu','admin',300); 
	}

	public function index() {
		$this->template->add_title_segment('Data Produk');
		$this->template->add_meta_tag("description", "Portal UMKM Kota Tangerang");
		$this->template->add_meta_tag("keywords", "umkm,portal umkm,kota tangerang,tangerang,portal");
        
        if(!$this->user_model->is_umkm_admin())
        {
            $this->template->add_css('assets/css/css_umkm.css');
        }
        
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
            'active'	=> 'produk',
            'name'		=> $this->security->get_csrf_token_name(),
            'hash'		=> $this->security->get_csrf_hash(),
            'keranjang' => $keranjang,
            'jml_keranjang' => $jml_keranjang,
            'option_umkm'   => $this->query_model->getumkm(),
            'title_beranda' => 'Daftar Produk',
        );

        $this->template->render("index",$this->data);
	}

    public function ajax_save()
    {
        $this->_validate();
        $this->_cek_sts_verif_umkm();
        $data = $this->_data_insert_update();
        $data['created_at'] = date('Y-m-d H:i:s');
        $insert = $this->query_model->insert_id('m_produk',$data);
        if (!$insert){
            echo json_encode(['success' => false, 'message' => 'Data gagal ditambahkan','status' => TRUE]);
        }else{
            //insert foto produk
            $gallery = array();
            foreach ($this->input->post('file',true) as $key => $value) {
               $gallery[] = array(
                    'id_produk' => $insert,
                    'foto'      => $this->input->post('file',true)[$key]
               ); 
            }

            if ($gallery) {
                $this->query_model->insert_batch('m_produk_foto',$gallery);
            }

            echo json_encode(['success' => true, 'message' => 'Data Berhasil ditambahkan','status' => TRUE]);
        }
    }

    public function ajax_ubah()
    {
        $this->_validate();
        $data = $this->_data_insert_update();
        $data['updated_at'] = date('Y-m-d H:i:s');
        $update = $this->query_model->update('m_produk',array('id_produk' => $this->input->post('id',true)), $data);
        if (!$update){
            echo json_encode(['success' => false, 'message' => 'Data gagal diubah','status' => TRUE]);
        }else{
            //delete foto produk
            $this->query_model->delete('m_produk_foto',array('id_produk'=> $this->input->post('id',true)));
            //insert foro produk
            $gallery = array();
            foreach ($this->input->post('file',true) as $key => $value) {
               $gallery[] = array(
                    'id_produk' => $this->input->post('id',true),
                    'foto'      => $this->input->post('file',true)[$key]
               ); 
            }

            if ($gallery) {
                $this->query_model->insert_batch('m_produk_foto',$gallery);
            }
            echo json_encode(['success' => true, 'message' => 'Data Berhasil diubah','status' => TRUE]);
        }
    }

    private function _data_insert_update(){
        if (!empty($this->input->post('tags',true))) {
            $tags = implode(" , ",$this->input->post('tags',true));
        }else{
            $tags = null;
        }

        $json_link_eksternal = $this->_get_json_link_eksternal();
        $json_id_kurir = $this->_get_json_kurir();

        $data = array(
            'kode_produk'       => time(),
            'id_umkm'           => $this->input->post('id_umkm',true),
            'id_jenis_usaha'    => $this->input->post('id_jenis_usaha',true),
            'nama_produk'       => $this->input->post('nama_produk',true),
            'tags'              => $tags,
            'harga'             => format_uang($this->input->post('harga',true)),
            'stok'              => format_uang($this->input->post('stok',true)),
            'berat'             => $this->input->post('berat',true),
            'id_kurir'          => $json_id_kurir,
            'deskripsi'         => toDesc($this->input->post('deskripsi',true)),
            'status'            => 1,
            'link_eksternal'    => $json_link_eksternal,
        );
        return $data;
    }

    private function _cek_sts_verif_umkm(){
        $id_umkm = $this->input->post('id_umkm',true);
        $cek_verif = $this->query_model->cek_status_verif_umkm($id_umkm);
        if (!$cek_verif) { //jika umkm belum diverif atau ditolak verifnya 
            $produk = $this->query_model->cek_count_produk($id_umkm);
            if ($produk->jum_produk >= 10) {
                echo json_encode(['success' => false, 'message' => 'Data gagal ditambahkan, UMKM yang anda pilih belum Terverifikasi, jumlah produk yang boleh di input hanya 10 produk !','status' => TRUE]);
                exit();
            }
        }else{
            return true;
        }
    }

    private function _get_json_link_eksternal(){
        $link_eksternal = array();
        if (!empty($this->input->post('nama_ecommerce',true))) {
            foreach ($this->input->post('nama_ecommerce',true) as $key => $value) {
                $link_eksternal[] = array('nama_ecommerce' => $value,
                                          'link_produk'    => $this->input->post('link_produk',true)[$key]
               ); 
            }
        }

        if ($link_eksternal) {
            $json_link_eksternal = json_encode($link_eksternal);
        }else{
            $json_link_eksternal = null;
        }

        return $json_link_eksternal;
    }

    private function _get_json_kurir(){
        $id_kurir = $this->input->post('id_kurir',true);
        $arr = array();
        if ($id_kurir) {
            foreach ($id_kurir as $key => $value) {
                $arr[] = $value;
            }
        }
        $json = null;
        if ($arr) {
            $json = json_encode($arr);
        }

        return $json;
    }

	public function ajax_list()
	{
		$data   = array();
        $sort	= isset($_POST['columns'][$_POST['order'][0]['column']]['data']) ? strval($_POST['columns'][$_POST['order'][0]['column']]['data']) : 'nama';
        $order	= isset($_POST['order'][0]['dir']) ? strval($_POST['order'][0]['dir']) : 'asc';
        $no 	= $this->input->post('start');

		$list = $this->m_table->get_datatables('data_produk',$sort,$order);
        foreach ($list as $l) {
            $no++;
            $l->no = $no;
            $l->created_at = indonesian_date($l->created_at);
            $l->namausaha = text($l->namausaha);
            $l->harga = "Rp. ".rp($l->harga);
            $l->stok = rp($l->stok);

            if(!$this->user_model->is_umkm_admin()){
                if($l->status == 1)
                {
                    $l->status = 'Aktif';
                    $l->aksi = '
                        <a href="javascript:void(0);" onclick="ubah_data('.$l->id_produk.')" title="Ubah Data Produk" class="btn btn-info"><i class="fa fa-pencil"></i></a>
                        <a href="javascript:void(0);" onclick="hapus_data('.$l->id_produk.')" title="Nonaktifkan Data Produk" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                    '; 
                }
                else if($l->status == 3)
                {
                    $l->status = 'Dinonaktifkan '.(!empty($l->alasan)?'karena '.$l->alasan:'');
                    $l->aksi = '
                        
                    ';
                }
                else{
                    $l->status = 'Tidak Aktif';
                    $l->aksi = '
                        <a href="javascript:void(0);" onclick="ubah_data('.$l->id_produk.')" title="Ubah Data Produk" class="btn btn-info"><i class="fa fa-pencil"></i></a>
                        <a href="javascript:void(0);" onclick="aktif_data('.$l->id_produk.')" title="Aktifkan Data Produk" class="btn btn-primary"><i class="fa fa-undo"></i></a>
                    '; 
                }
            }else{
                if($l->status == 1)
                {
                    $l->status = 'Aktif';
                    $l->aksi = '
                        <a href="javascript:void(0);" onclick="lihat_data('.$l->id_produk.')" title="Lihat Data Produk" class="btn btn-success"><i class="fa fa-eye"></i></a>
                        <a href="javascript:void(0);" onclick="hapus_data('.$l->id_produk.')" title="Nonaktifkan Data Produk" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                    '; 
                }else{
                    $l->status = 'Tidak Aktif';
                    $l->aksi = '
                        <a href="javascript:void(0);" onclick="lihat_data('.$l->id_produk.')" title="Lihat Data Produk" class="btn btn-success"><i class="fa fa-eye"></i></a>
                        <a href="javascript:void(0);" onclick="aktif_data('.$l->id_produk.')" title="Aktifkan Data Produk" class="btn btn-primary"><i class="fa fa-undo"></i></a>
                    '; 
                }
            }
            
            $data[] = $l;
        }

        $output = array(
            "draw"              => $_POST['draw'],
            "recordsTotal"      => $this->m_table->count_all('data_produk',$sort,$order),
            "recordsFiltered"   => $this->m_table->count_filtered('data_produk',$sort,$order),
            "data"              => $data,
        );  
        echo json_encode($output);  
	}

    public function ajax_lihat()
    {
        $data = array();

        $query1['select']    = 'a.id_jenis_usaha,a.nama_produk,a.tags,a.harga,a.stok,a.deskripsi,a.link_eksternal,a.id_kurir,a.berat,b.id_umkm as username';
        $query1['table']     = 'm_produk a';
        $query1['join'][0]  = array('m_umkm b','a.id_umkm = b.id_umkm');
        $query1['where']     = 'a.id_produk = '.(int)$this->input->post('id');
        $produk               = $this->query_model->getRow($query1);

        $query['select']    = '*';
        $query['table']     = 'm_produk_foto';
        $query['where']     = 'id_produk = '.(int)$this->input->post('id');
        $gallery            = $this->query_model->getData($query);

        $data['gallery']    = $gallery;
        $data['produk']     = $produk;

        echo json_encode($data);
    }

    public function ajax_hapus(){

        if(!$this->user_model->is_umkm_admin()){
            $status = 2; //di non aktifkan oleh user
        }else{
            $status = 3; //di non aktifkan oleh admin
        }

        $data = array(
            'alasan'        => $this->input->post('data',true),
            'status'        => $status,
            'updated_at'    => date('Y-m-d H:i:s')
        );

        $update = $this->query_model->update('m_produk',array('id_produk' => $this->input->post('id',true)), $data);

        if (!$update)
        {
            echo json_encode(['success' => false, 'message' => 'Produk gagal dinon aktifkan','status' => TRUE]);
        }
        else 
        {
            echo json_encode(['success' => true, 'message' => 'Produk berhasil dinon aktifkan','status' => TRUE]);
        }
    }

    public function ajax_hapus_foto()
    {
        $path_to_file = 'assets/produk/'.$this->input->post('id_umkm').'/'.$this->input->post('nama');
        if(unlink($path_to_file)) {
            echo json_encode(['success' => true, 'message' => 'Foto berhasil dihapus','status' => TRUE]);
        }
        else {
            echo json_encode(['success' => false, 'message' => 'Foto Gagal Dihapus','status' => TRUE]); 
        }
    }

    public function ajax_restore(){
        $data = array(
            'status'        => 1,
            'updated_at'    => date('Y-m-d H:i:s')
        );

        $insert = $this->query_model->update('m_produk',array('id_produk' => $this->input->post('id',true)), $data);

        if (!$insert)
        {
            echo json_encode(['success' => false, 'message' => 'Produk gagal diaktifkan','status' => TRUE]);
        }
        else 
        {
            echo json_encode(['success' => true, 'message' => 'Produk berhasil  di aktifkan','status' => TRUE]);
        }
    }

    public function ajax_upload()
    {
        header('Content-type:application/json;charset=utf-8');
        try {
            if (
                !isset($_FILES['file']['error']) ||
                is_array($_FILES['file']['error'])
            ) {
                throw new RuntimeException('Invalid parameters.');
            }

            switch ($_FILES['file']['error']) {
                case UPLOAD_ERR_OK:
                    break;
                case UPLOAD_ERR_NO_FILE:
                    throw new RuntimeException('No file sent.');
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    throw new RuntimeException('Exceeded filesize limit.');
                default:
                    throw new RuntimeException('Unknown errors.');
            }
            $filename = $_FILES['file']['name'];

            if (!is_dir('assets/produk/'.$this->input->post('id_umkm'))) {
                mkdir('assets/produk/'.$this->input->post('id_umkm'), 0777, TRUE);
            }
            $file_ext = substr($filename, strripos($filename, '.'));
            $filepath = sprintf('assets/produk/'.$this->input->post('id_umkm').'/%s%s', md5($filename), $file_ext);
            

            if (!move_uploaded_file(
                $_FILES['file']['tmp_name'],
                $filepath
            )) {
                throw new RuntimeException('Failed to move uploaded file.');
            }

            // All good, send the response
            echo json_encode([
                'status' => 'ok',
                'path' => $filepath
            ]);

        } catch (RuntimeException $e) {
            // Something went wrong, send the err message as JSON
            http_response_code(400);

            echo json_encode([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if(empty($this->input->post('file',true)))
        {
            $data['inputerror'][] = 'data_produk';
            $data['error_string'][] = 'Data Produk Boleh Kosong';
            $data['status'] = FALSE;
        }

        if($this->input->post('nama_produk',true) == '')
        {
            $data['inputerror'][] = 'nama_produk';
            $data['error_string'][] = 'Data Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if($this->input->post('id_jenis_usaha',true) == 0)
        {
            $data['inputerror'][] = 'jenis_usaha';
            $data['error_string'][] = 'Data Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if($this->input->post('harga',true) == '' or $this->input->post('harga',true) == 0)
        {
            $data['inputerror'][] = 'harga';
            $data['error_string'][] = 'Data Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if($this->input->post('stok',true) == '' or $this->input->post('stok',true) == 0)
        {
            $data['inputerror'][] = 'stok';
            $data['error_string'][] = 'Data Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if($this->input->post('berat',true) == '' or $this->input->post('berat',true) == 0)
        {
            $data['inputerror'][] = 'berat';
            $data['error_string'][] = 'Data Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if($this->input->post('id_kurir',true) == '')
        {
            $data['inputerror'][] = 'nama_kurir';
            $data['error_string'][] = 'Data Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if($this->input->post('deskripsi',true) == '')
        {
            $data['inputerror'][] = 'data_deskripsi';
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