<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends MY_Controller {

	public function __construct() {
		parent::__construct();
        if(!$this->user_model->is_umkm_penjual() AND !$this->user_model->is_umkm_admin() ){
            redirect(base_url());
        }
        $this->template->set_layout('templatesv2/backend'); 
	}

	public function index() {
		$this->template->add_title_segment('Data Produk');
		$this->template->add_meta_tag("description", "Portal UMKM Kota Tangerang");
		$this->template->add_meta_tag("keywords", "umkm,portal umkm,kota tangerang,tangerang,portal");
        
        $this->template->add_css('assets/css/upload.css');
        $this->template->add_css('assets/css/jquery.dm-uploader.min.css');
        $this->template->add_css('assets/mytemplate_backend/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css');
		$this->template->add_js('https://cdn.ckeditor.com/4.9.2/standard-all/ckeditor.js');
		$this->template->add_js('assets/ckfinder/ckfinder.js');
        $this->template->add_js('assets/js/jquery.dm-uploader.min.js');
        $this->template->add_js('assets/js/ui-main.js');
        $this->template->add_js('assets/js/ui-multiple.js');
        $this->template->add_js('assets/mytemplate_backend/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js');

        $this->data = array(
            'kategori'  => $this->query_model->getKategori(),
            'active'	=> 'produk',
            'name'		=> $this->security->get_csrf_token_name(),
            'hash'		=> $this->security->get_csrf_hash(),
            'option_umkm'   => $this->query_model->getumkm(),
            'title_beranda' => 'Daftar Produk',
            'id_produk' => @$this->input->post('id_produk'),
            'type' => @$this->input->post('type')
        );

        $this->template->render("index",$this->data);
	}

    public function ajax_save()
    {
        $this->_validate();
        $this->_cek_sts_verif_umkm();
        $data = $this->_data_insert_update();
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['status'] = 1;
        $data['sumber'] = 'borongsay web';
        $insert = $this->query_model->insert_id('m_produk',$data);
        if (!$insert){
            echo json_encode(['success' => false, 'message' => 'Data gagal ditambahkan','status' => TRUE]);
        }else{

            //insert stok produk
            $data_stok_ukuran=array();
            if (!empty($this->input->post('ukuran',true))) {
                foreach ($this->input->post('ukuran',true) as $key => $value) {
                    if ($this->input->post('stok',true)[$key] != '') {
                        $data_stok_ukuran[] = array(
                            'id_produk' => $insert,
                            'ukuran' => $value,
                            'stok' => format_uang($this->input->post('stok',true)[$key])
                        );
                    }
                }
            }

            


            if ($data_stok_ukuran) {
                $this->query_model->insert_batch('m_produk_stok', $data_stok_ukuran);
            }


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
        $json_link_sosmed = $this->_get_json_link_sosmed();
        $json_link_video = $this->_get_json_link_video();
        $json_id_kurir = $this->_get_json_kurir();
        $json_ukuran_stok = $this->_get_json_stok_ukuran();


        $data = array(
            'kode_produk'       => time(),
            'id_umkm'           => $this->input->post('id_umkm',true),
            'id_jenis_usaha'    => $this->input->post('id_jenis_usaha',true),
            'nama_produk'       => $this->input->post('nama_produk',true),
            'tags'              => $tags,
            'harga'             => format_uang($this->input->post('harga',true)),
            // 'stok'              => format_uang($this->input->post('stok',true)),
            'stok'              => $json_ukuran_stok['stok'],
            'berat'             => $this->input->post('berat',true),
            'diskon'            => $this->input->post('diskon',true),
            'diskon_nominal'    => format_uang($this->input->post('diskon_nominal',true)),
            'is_eorder'         => $this->input->post('is_eorder')=='on'?1:0,
            'id_kurir'          => $json_id_kurir,
            'deskripsi'         => toDesc($this->input->post('deskripsi',true)),
            'link_eksternal'    => $json_link_eksternal,
            'link_sosmed'       => $json_link_sosmed,
            'link_video'        => $json_link_video,
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
                if ($this->input->post('link_produk',true)[$key] != '') {
                    $link_eksternal[] = array('nama_ecommerce' => $value,
                                              'link_produk'    => $this->input->post('link_produk',true)[$key]);
                }
                 
            }
        }

        if ($link_eksternal) {
            $json_link_eksternal = json_encode($link_eksternal);
        }else{
            $json_link_eksternal = null;
        }

        return $json_link_eksternal;
    }

     private function _get_json_link_sosmed(){
        $link_eksternal = array();
        if (!empty($this->input->post('nama_medsos',true))) {
            foreach ($this->input->post('nama_medsos',true) as $key => $value) {
                if ($this->input->post('link_produk_medsos',true)[$key] != '') {
                    $link_eksternal[] = array('nama_medsos' => $value,
                                              'link_produk' => $this->input->post('link_produk_medsos',true)[$key]);
                }
            }
        }

        if ($link_eksternal) {
            $json_link_eksternal = json_encode($link_eksternal);
        }else{
            $json_link_eksternal = null;
        }

        return $json_link_eksternal;
    }

    private function _get_json_stok_ukuran(){
        $stok = 0;
        if (!empty($this->input->post('ukuran',true))) {
            foreach ($this->input->post('ukuran',true) as $key => $value) {
                if ($this->input->post('stok',true)[$key] != '') {
                    $stok += $this->input->post('stok',true)[$key];
                }
            }
        }

        if ($stok > 0) {
            $json_data_stok_ukuran['stok'] = $stok;
        }else{
            $json_data_stok_ukuran['stok'] = 0;

        }

        return $json_data_stok_ukuran;
    }

    private function _get_json_link_video(){
        $link_eksternal = array();
        if (!empty($this->input->post('link_video',true))) {
            foreach ($this->input->post('link_video',true) as $key => $value) {
                if ($this->input->post('link_video',true)[$key] != '') {
                    $link_eksternal[] = $this->input->post('link_video',true)[$key];
                }
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
            if ($l->foto) {
                $l->foto = '<img style="width: 50px; display: block;" src="'.base_url('assets/produk/'.$l->id_umkm.'/'.$l->foto).'" alt="" class="img-reponsive">';
            }else{
                $l->foto = '';
            }
            $l->created_at = indonesian_date($l->created_at);
            $l->namausaha = text($l->namausaha);
            $l->harga_produk = "Rp. ".rp($l->harga);
            $l->stok = rp($l->stok);

            if($this->user_model->is_umkm_admin()){
                if($l->status == 1)
                {
                    $l->status = 'Aktif';
                    $l->aksi = '
                        <a href="javascript:void(0);" onclick="ubah_data('.$l->id_produk.')" title="Ubah Data Produk" class="btn btn-sm btn-info"><i class="fa fa-pen"></i></a>
                        <a href="javascript:void(0);" onclick="hapus_data('.$l->id_produk.')" title="Nonaktifkan Data Produk" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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
                        <a href="javascript:void(0);" onclick="ubah_data('.$l->id_produk.')" title="Ubah Data Produk" class="btn btn-sm btn-info"><i class="fa fa-pen"></i></a> <a href="javascript:void(0);" onclick="aktif_data('.$l->id_produk.')" title="Aktifkan Data Produk" class="btn btn-sm btn-primary"><i class="fa fa-undo"></i></a>
                    '; 
                }
            }else{
                if($l->status == 1)
                {
                    $l->status = 'Aktif';
                    $l->aksi = '
                        <a href="javascript:void(0);" onclick="lihat_data('.$l->id_produk.')" title="Lihat Data Produk" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                        <a href="javascript:void(0);" onclick="hapus_data('.$l->id_produk.')" title="Nonaktifkan Data Produk" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                    '; 
                }else{
                    $l->status = 'Tidak Aktif';
                    $l->aksi = '
                        <a href="javascript:void(0);" onclick="lihat_data('.$l->id_produk.')" title="Lihat Data Produk" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                        <a href="javascript:void(0);" onclick="aktif_data('.$l->id_produk.')" title="Aktifkan Data Produk" class="btn btn-sm btn-primary"><i class="fa fa-undo"></i></a>
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

        $query1['select']    = 'a.id_jenis_usaha,c.nama_usaha,a.nama_produk,a.tags,a.harga,a.diskon,a.diskon_nominal,a.stok,a.deskripsi,a.link_eksternal,a.link_sosmed,a.link_video,
        a.id_kurir,a.berat,a.is_eorder,b.id_umkm as username,b.namausaha';
        $query1['table']     = 'm_produk a';
        $query1['join'][0]  = array('m_umkm b','a.id_umkm = b.id_umkm');
        $query1['join'][1]  = array('m_jenis_usaha c','c.id_jenis_usaha = a.id_jenis_usaha');
        $query1['where']     = 'a.id_produk = '.(int)$this->input->post('id');
        $produk               = $this->query_model->getRow($query1);

        $query['select']    = '*';
        $query['table']     = 'm_produk_foto';
        $query['where']     = 'id_produk = '.(int)$this->input->post('id');
        $gallery            = $this->query_model->getData($query);

        $query['select']    = '*';
        $query['table']     = 'm_produk_stok';
        $query['where']     = 'id_produk = '.(int)$this->input->post('id');
        $stok            = $this->query_model->getData($query);

        $data['gallery']    = $gallery;
        $data['stok']    = $stok;
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

        if (!$update){
            echo json_encode(['success' => false, 'message' => 'Produk gagal dinon aktifkan','status' => TRUE]);
        }else {
            echo json_encode(['success' => true, 'message' => 'Produk berhasil dinon aktifkan','status' => TRUE]);
        }
    }

    public function ajax_hapus_foto()
    {
        $path_to_file = 'assets/produk/'.$this->input->post('id_umkm').'/'.$this->input->post('nama');
        if(unlink($path_to_file)) {
            echo json_encode(['success' => true, 'message' => 'Foto berhasil dihapus','status' => TRUE]);
        }else {
            echo json_encode(['success' => false, 'message' => 'Foto Gagal Dihapus','status' => TRUE]); 
        }
    }

    public function ajax_restore(){
        $data = array(
            'status'        => 1,
            'updated_at'    => date('Y-m-d H:i:s')
        );

        $insert = $this->query_model->update('m_produk',array('id_produk' => $this->input->post('id',true)), $data);

        if (!$insert){
            echo json_encode(['success' => false, 'message' => 'Produk gagal diaktifkan','status' => TRUE]);
        }else{
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
                mkdir('assets/produk/'.$this->input->post('id_umkm'), 0755, TRUE);
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

        if($this->input->post('is_eorder') != 'on' && ($this->input->post('stok',true) == ''))
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

        if($this->input->post('is_eorder') != 'on' && $this->input->post('id_kurir',true) == '')
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