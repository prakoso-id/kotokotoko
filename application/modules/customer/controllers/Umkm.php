<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Umkm extends MY_Controller {

	public function __construct() {
		parent::__construct();
        if(!$this->user_model->is_login()){
            redirect(base_url());
        }
		$this->template->set_layout('templatesv2/backend'); 
	}

	public function index() {
		$this->template->add_title_segment('UMKM');
		$this->template->add_meta_tag("description", "Toko Muslimah no 1 di indonesia");
		$this->template->add_meta_tag("keywords", "umkm,portal umkm,kota tangerang,tangerang,portal");
		// $this->template->add_css('assets/css/css_umkm.css');
        $this->template->add_css(base_url().'assets/css/css_admin.css');
        $this->template->add_css(base_url()."assets/mytemplate_backend/modules/smart_wizard/css/smart_wizard_all.min.css");
        $this->template->add_css('https://js.arcgis.com/4.8/esri/css/main.css');
        $this->template->add_css(base_url().'assets/mytemplate_backend/modules/datepicker/css/bootstrap-datepicker.css');
        $this->template->add_js(base_url()."assets/mytemplate_backend/modules/smart_wizard/js/jquery.smartWizard.min.js",true);
		$this->template->add_js(base_url().'assets/plugins/input-mask/jquery.inputmask.js',true);
        $this->template->add_js(base_url().'assets/mytemplate_backend/modules/datepicker/js/bootstrap-datepicker.js',true);
        $this->template->add_js('https://js.arcgis.com/4.8/',true);

		$data = $this->user_model->cek_status_umkm();
        // echo json_encode($this->session);die;
		if(!$data){
			$this->data = array(
				'active'	=> 'customer/umkm',
				'name'		=> $this->security->get_csrf_token_name(),
				'hash'		=> $this->security->get_csrf_hash(),
            	'title_beranda'	=> 'Daftar Toko'
			);

			$this->template->render("umkm/index",$this->data);
		}else{
			$this->data = array(
				'active'	=> 'umkm',
				'name'		=> $this->security->get_csrf_token_name(),
				'hash'		=> $this->security->get_csrf_hash(),
                'm_status'  => $this->query_model->getmStatus(),
        		'title_beranda'	=> 'Data Toko'
			);

			$this->template->render("umkm/status",$this->data);	
		}
	}

	public function cek_status(){
		$cek['select']	= 'id_umkm';
		$cek['table']	= 'm_umkm';
		$cek['where']	= 'id_status = 2 AND username = '.$this->session->identity;
		$data 			= $this->query_model->getData($cek);

		if(empty($data))
		{
			echo json_encode(array('status' => 'data_umkm'));

		}else{
			echo json_encode(array('status' => 'daftar_umkm'));
		}
		
	}

	public function ajax_list()
	{
		$data   = array();
        $sort	= isset($_POST['columns'][$_POST['order'][0]['column']]['data']) ? strval($_POST['columns'][$_POST['order'][0]['column']]['data']) : 'nama';
        $order	= isset($_POST['order'][0]['dir']) ? strval($_POST['order'][0]['dir']) : 'asc';
        $no 	= $this->input->post('start');

		$list = $this->m_table->get_datatables('status_umkm',$sort,$order);
        foreach ($list as $l) {
            $no++;
            $l->no = $no;
            if($l->id_status == 3){
            	$l->status = $l->alasan.' - '.$l->status;
            }

            $l->ratting = ($l->ratting?$l->ratting:0);

            $btn_ubah = '';
            if($l->id_status != 2){ //bukan menunggu
                if ($l->id_status == 3 || $l->id_status == 1) {
                    $title = 'Pengajuan Ulang';
                }else{
                    $title = 'Lengkapi Data';
                }
            	$btn_ubah = '
            		<button type="button" onclick="ubah_data('.$l->id_umkm.')" title="'.$title.'" class="btn btn-info">
						<i class="fa fa-pen"></i>
					</button>
	            '; 	
            }

            $l->aksi = '
                    <button type="button" onclick="lihat_data('.$l->id_umkm.')" title="Lihat Data" class="btn btn-primary">
                        <i class="fa fa-eye"></i>
                    </button>
                     '.$btn_ubah.'
                ';  
            
            
            $data[] = $l;
        }

        $output = array(
            "draw"              => $_POST['draw'],
            "recordsTotal"      => $this->m_table->count_all('status_umkm',$sort,$order),
            "recordsFiltered"   => $this->m_table->count_filtered('status_umkm',$sort,$order),
            "data"              => $data,
        );  
        echo json_encode($output);  
	}

	public function ajax_save(){
		$type = $this->input->post('type',true);
        switch ($type) {
            case 'daftar_umkm':
                $this->_validate($type);
                $data = $this->_data_insert_update_umkm();
                $data['created_at'] = date('Y-m-d H:i:s');
                $insert = $this->query_model->insert_id('m_umkm',$data);
                if (!$insert){
                    echo json_encode(['success' => false, 'message' => 'Data gagal ditambahkan','status' => TRUE]);
                    exit();
                }else {
                    //izin usaha
                    $this->_insert_izin_usaha($insert);
                    //alamat umkm
                    $alamat = $this->_data_insert_update_alamat_umkm($insert);
                    $this->query_model->insert('m_umkm_alamat',$alamat);
                    //berkas
                    $berkas = $this->_data_insert_update_berkas($insert);
                    $this->query_model->insert('m_umkm_berkas',$berkas);
                    //kirim email notification
                    // kirim_email_pemberitahuan($insert);
                    kirim_email_terima($insert);

                    // if(!$this->session->penjual_umkm_login){
                        //update session
                        $query['select']    = 'id_umkm';
                        $query['table']     = 'm_umkm';
                        $query['where']     = "(id_status = 1 OR id_status = 2) AND username = '".$this->session->identity."'";
                        $data_umkm          = $this->query_model->getData($query);
                        $umkm = array();
                        foreach ($data_umkm as $key => $value) {
                            $umkm[] = $value->id_umkm;
                        }
                        
                        if(empty($umkm)){
                            $status = false;
                            $user_group = 'Customer';
                            $umkm_id = 0;
                        }else{
                            $status = true;
                            $user_group = 'UMKM';
                            $umkm_id = $umkm;
                        }

                        $session = array(
                            'penjual_umkm_login'=> $status,
                            'user_umkm_login'   => true,
                            'umkm_id'           => $umkm_id,
                        );
                        
                        $this->session->set_userdata($session);
                    // }
                    echo json_encode(['success' => true, 'message' => 'Data Berhasil ditambahkan','status' => TRUE]);
                }
            break;
        }
	}

	public function ajax_ubah(){
		$type = $this->input->post('type',true);
        switch ($type) {
            case 'daftar_umkm':
                $this->_validate($type);
                $data = $this->_data_insert_update_umkm();
                $data['updated_at'] = date('Y-m-d H:i:s');
                $update = $this->query_model->update('m_umkm',array('id_umkm' => $this->input->post('id',true)),$data);
                if (!$update){
                    echo json_encode(['success' => false, 'message' => 'Data gagal diubah','status' => TRUE]);
                    exit();
                }else {
                    //izin usaha
                    if ($this->input->post('nama_izin_usaha')) {
                        //delete dulu data existing
                        $this->query_model->delete('m_umkm_izin_usaha',array('id_umkm' => $this->input->post('id',true)));
                        //insert data baru
                        $this->_insert_izin_usaha($this->input->post('id',true));
                    }

                    //alamat umkm
                    $query['select']    = 'id_umkm';
                    $query['table']     = 'm_umkm_alamat';
                    $query['where']     = 'id_umkm ='.$this->input->post('id',true);
                    $cek_alamat         = $this->query_model->getRow($query);

                    $alamat = $this->_data_insert_update_alamat_umkm($this->input->post('id',true));
                    if (!$cek_alamat) {
                        $this->query_model->insert('m_umkm_alamat',$alamat);
                    }else{
                        $this->query_model->update('m_umkm_alamat',array('id_umkm' => $this->input->post('id',true)),$alamat);
                    }
                    
                    //berkas
                    $query2['select']    = 'id_umkm';
                    $query2['table']     = 'm_umkm_berkas';
                    $query2['where']     = 'id_umkm ='.$this->input->post('id',true);
                    $cek_berkas          = $this->query_model->getRow($query);

                    $berkas = $this->_data_insert_update_berkas($this->input->post('id',true));
                    if (!$cek_berkas) {
                        $this->query_model->insert('m_umkm_berkas',$berkas);
                    }else{
                        $this->query_model->update('m_umkm_berkas',array('id_umkm' => $this->input->post('id',true)),$berkas);
                    }
                   
                    echo json_encode(['success' => true, 'message' => 'Data Berhasil diubah','status' => TRUE]);
                }
            break;
        }
	}

    private function _get_json_multiple_input($param='ecommerce'){
        //set json
        $nama = $this->input->post('nama_'.$param,true);
        $arr = array();
        if ($nama) {
            foreach ($nama as $key => $value) {
                if ($nama[$key] != '0'){
                    $arr[] = array('nama_'.$param => $value,
                                   'keterangan_'.$param => $this->input->post('keterangan_'.$param,true)[$key]);
                }
            }
        }
        $json = null;
        if ($arr) {
            $json = json_encode($arr);
        }

        return $json;
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

    private function _data_insert_update_umkm(){
        $pengguna = array(
            'no_telp'       => $this->input->post('no_hp',true),
            'nama_ibu'      => $this->input->post('nama_ibu',true),
            'kode_pos'      => $this->input->post('kode_pos_rumah',true),
        );

        $this->query_model->update('m_pengguna',array('username' => $this->session->identity), $pengguna);

        $json_ecommerce = $this->_get_json_multiple_input('ecommerce');
        $json_medsos = $this->_get_json_multiple_input('medsos');
        $json_ojol = $this->_get_json_multiple_input('ojol');
        $json_kurir = $this->_get_json_kurir();

        $no_rekening = $an_rekening =  $id_bank = $kode_bank = $nama_bank = null;
        if ($this->input->post('no_rekening')) {
            $no_rekening = $this->input->post('no_rekening',true);
            $an_rekening = $this->input->post('an_rekening',true);
            $bank = $this->input->post('id_bank',true);
            $exlpd_bank = explode('#', $bank);
            $id_bank = $exlpd_bank[0];
            $kode_bank = $exlpd_bank[1];
            $nama_bank = $exlpd_bank[2];
        }

        $data = array(
                'id_pengguna'               => $this->session->user_id,
                'username'                  => $this->session->identity,
                'nama_perusahaan'           => $this->input->post('nama_perusahaan',true),
                'namausaha'                 => $this->input->post('nama_usaha',true),
                'id_jenis_usaha'            => $this->input->post('id_jenis_usaha',true),
                'id_bentuk_usaha'           => $this->input->post('id_bentuk_usaha',true),
                'id_sarana_usaha'           => $this->input->post('id_sarana_usaha',true),
                'id_sektor_usaha'           => serialize($this->input->post('id_sektor_usaha',true)),
                'nama_sarana_usaha_lainnya' => ($this->input->post('id_sarana_usaha',true)==4?$this->input->post('nama_sarana_lainnya',true):null),
                'id_status_tempat_usaha'    => $this->input->post('id_status_tempat_usaha',true),
                'nama_status_tempat_lainnya'=> ($this->input->post('id_status_tempat_usaha',true)==4?$this->input->post('nama_status_lainnya',true):null),
                'tgl_usaha'                 => $this->input->post('tgl_usaha',true),
                'kegiatan_usaha_utama'      => $this->input->post('kegiatan_usaha_utama',true),
                'jml_pegawai'               => $this->input->post('jml_pegawai',true),
                'pegawai_laki'              => $this->input->post('pegawai_laki',true),
                'pegawai_perempuan'         => $this->input->post('pegawai_perempuan',true),
                'jml_omset_sebelumnya'      => format_uang($this->input->post('jml_omset_sebelumnya',true)),
                'jml_omset_sekarang'        => format_uang($this->input->post('jml_omset_sekarang',true)),
                'jml_modal_awal'            => format_uang($this->input->post('jml_modal_awal',true)),
                'id_modal_luar'             => $this->input->post('modal_luar',true),
                'nominal_modal_luar'        => format_uang($this->input->post('nominal_modal_luar',true)),
                'jml_asset'                 => format_uang($this->input->post('jml_asset',true)),
                'npwp'                      => $this->input->post('nomor_npwp',true),
                'id_status'                 => 1,
                'memiliki_surat_iumkm'      => $this->input->post('memiliki_iumk',true),
                'tahun_data'                => date('Y'),
                'situs_web'                 => $json_ecommerce,
                'sosmed'                    => $json_medsos,
                'ojol'                      => $json_ojol,
                'no_rumah'                  => $this->input->post('no_rumah',true),
                'no_kantor'                 => $this->input->post('no_kantor',true),
                'no_hp'                     => $this->input->post('no_hp',true),
                'email'                     => $this->input->post('email_toko',true),
                'id_bahan_bakar'            => $this->input->post('id_bahan_bakar',true),
                'id_lainnya'                => $this->input->post('lainnya',true),
                'no_rekening'               => $no_rekening,
                'an_rekening'               => $an_rekening,
                'id_bank'                   => $id_bank,
                'kode_bank'                 => $kode_bank,
                'nama_bank'                 => $nama_bank,
                'id_kurir'                  => $json_kurir,
                'cara_pembayaran'           => $this->input->post('cara_pembayaran',true),
        );

        return $data;
    }

    private function _insert_izin_usaha($id_umkm){
        $nama_izin_usaha = $this->input->post('nama_izin_usaha',true);
        $nama_izin_usaha_lain = $this->input->post('nama_izin_usaha_lain',true);
        $no_surat = $this->input->post('no_surat',true);
        $izin_usaha = array();
        foreach ($nama_izin_usaha as $key => $value) {
            if ($nama_izin_usaha[$key] != '0'){
                $izin_usaha[] = array(
                    'id_umkm'           => $id_umkm,
                    'nama_izin_usaha'   => $nama_izin_usaha[$key],
                    'nomor_izin_usaha'  => $no_surat[$key],
                    'nama_izin_lainnya' => ($nama_izin_usaha[$key]=='LAINNYA'?$nama_izin_usaha_lain[$key]:null)
                );
            }
        }
        if ($izin_usaha) {
            $this->query_model->insert_batch('m_umkm_izin_usaha',$izin_usaha);
        }
        return true;
    }

    private function _data_insert_update_alamat_umkm($id_umkm){
        if($this->input->post('alamat_sama'))
        {
            $prop = $this->input->post('id_prop');
            $kab = $this->input->post('id_kota');
            $kecamatan = get_kec($this->input->post('id_prop'),$this->input->post('id_kota'),$this->input->post('id_kec'));
            $kelurahan = get_kel($this->input->post('id_prop'),$this->input->post('id_kota'),$this->input->post('id_kec'),$this->input->post('id_kel'));
        }else{
            $prop = 36;
            $kab = 71;
            $kecamatan = get_kecamatan($this->input->post('id_kec'));
            $kelurahan = get_kelurahan($this->input->post('id_kec'),$this->input->post('id_kel'));
        }

        $alamat = array(
            'id_umkm'   => $id_umkm,
            'no_prop'   => $prop,
            'no_kab'    => $kab,
            'id_kec'    => $this->input->post('id_kec',true),
            'nama_kec'  => $kecamatan,
            'id_kel'    => $this->input->post('id_kel',true),
            'nama_kel'  => $kelurahan,
            'lat'       => $this->input->post('lat',true),
            'long'      => $this->input->post('long',true),
            'kode_pos'  => $this->input->post('kode_pos',true),
            'alamat'    => $this->input->post('alamat',true),
        );
        return $alamat;
    }

    private function _data_insert_update_berkas($id_umkm){
        $berkas = array(
            'id_umkm'       => $id_umkm,
            'surat_iumkm'   => $this->input->post('file_umkm',true),
            'foto_npwp'     => $this->input->post('file_npwp',true),
            'foto_ktp'      => $this->input->post('file_ktp',true),
            'foto_kk'       => $this->input->post('file_kk',true),
            'foto_pas'      => $this->input->post('file_foto',true),
            'logo_umkm'     => $this->input->post('file_logo',true),
        );
        return $berkas;
    }

	public function upload()
	{
		$type = $this->input->post('type');
		switch ($type) {
			case 'upload_umkm':
				if (!is_dir('assets/media/'.$_SESSION['identity'])) {
		            mkdir('assets/media/'.$_SESSION['identity'],0755);
		        }

				if (!is_dir('assets/media/'.$_SESSION['identity'].'/umkm')) {
		            mkdir('assets/media/'.$_SESSION['identity'].'/umkm',0755);
		        }

		        if($_FILES['file']['name'] != '')
		        {
		            $config['upload_path'] = './assets/media/'.$_SESSION['identity'].'/umkm';
		            $config['allowed_types'] = 'jpg|jpeg|png|pdf';
                    $config['max_size']      = 5120;
		            $config['encrypt_name']  = TRUE;
		            $config['overwrite']     = TRUE;
		            $this->upload->initialize($config);
		            $this->upload->initialize($config);

		            if($this->upload->do_upload("file"))
		            {    
		                $name = $this->upload->data();
		                $surat_iumkm  = $name['file_name'];
		                echo json_encode([ 'error' => 0,'file' => $surat_iumkm,'url' => base_url('assets/media/'.$_SESSION['identity'].'/umkm/'.$surat_iumkm),'message' => $this->upload->display_errors() ]);
		            }
		            else
		            {
		                echo json_encode(['error' => 1, 'message' => $this->upload->display_errors()]);
		                exit();
		            }
		        }
			break;
			case 'upload_npwp':
				if (!is_dir('assets/media/'.$_SESSION['identity'])) {
		            mkdir('assets/media/'.$_SESSION['identity'],0755);
		        }

				if (!is_dir('assets/media/'.$_SESSION['identity'].'/npwp')) {
		            mkdir('assets/media/'.$_SESSION['identity'].'/npwp',0755);
		        }

		        if($_FILES['file']['name'] != '')
		        {
		            $config['upload_path'] = './assets/media/'.$_SESSION['identity'].'/npwp';
		            $config['allowed_types'] = 'jpg|jpeg|png';
                    $config['max_size']      = 5120;
		            $config['encrypt_name'] = TRUE;
		            $config['overwrite'] = TRUE;
		            $this->upload->initialize($config);
		            $this->upload->initialize($config);

		            if($this->upload->do_upload("file"))
		            {    
		                $name = $this->upload->data();
		                $surat_npwp  = $name['file_name'];
		                echo json_encode([ 'error' => 0,'file' => $surat_npwp,'url' => base_url('assets/media/'.$_SESSION['identity'].'/npwp/'.$surat_npwp),'message' => $this->upload->display_errors() ]);
		            }
		            else
		            {
		                echo json_encode(['error' => 1, 'message' => $this->upload->display_errors()]);
		                exit();
		            }
		        }
			break;
			case 'upload_ktp':
				if (!is_dir('assets/media/'.$_SESSION['identity'])) {
		            mkdir('assets/media/'.$_SESSION['identity'],0755);
		        }

				if (!is_dir('assets/media/'.$_SESSION['identity'].'/ktp')) {
		            mkdir('assets/media/'.$_SESSION['identity'].'/ktp',0755);
		        }

		        if($_FILES['file']['name'] != '')
		        {
		            $config['upload_path'] = './assets/media/'.$_SESSION['identity'].'/ktp';
		            $config['allowed_types'] = 'jpg|jpeg|png';
                    $config['max_size']      = 5120;
		            $config['encrypt_name'] = TRUE;
		            $config['overwrite'] = TRUE;
		            $this->upload->initialize($config);
		            $this->upload->initialize($config);

		            if($this->upload->do_upload("file"))
		            {    
		                $name = $this->upload->data();
		                $surat_ktp  = $name['file_name'];
		                echo json_encode([ 'error' => 0,'file' => $surat_ktp,'url' => base_url('assets/media/'.$_SESSION['identity'].'/ktp/'.$surat_ktp),'message' => $this->upload->display_errors() ]);
		            }
		            else
		            {
		                echo json_encode(['error' => 1, 'message' => $this->upload->display_errors()]);
		                exit();
		            }
		        }
			break;
			case 'upload_kk':
				if (!is_dir('assets/media/'.$_SESSION['identity'])) {
		            mkdir('assets/media/'.$_SESSION['identity'],0755);
		        }

				if (!is_dir('assets/media/'.$_SESSION['identity'].'/kk')) {
		            mkdir('assets/media/'.$_SESSION['identity'].'/kk',0755);
		        }

		        if($_FILES['file']['name'] != '')
		        {
		            $config['upload_path'] = './assets/media/'.$_SESSION['identity'].'/kk';
		            $config['allowed_types'] = 'jpg|jpeg|png';
                    $config['max_size']      = 5120;
		            $config['encrypt_name'] = TRUE;
		            $config['overwrite'] = TRUE;
		            $this->upload->initialize($config);
		            $this->upload->initialize($config);

		            if($this->upload->do_upload("file"))
		            {    
		                $name = $this->upload->data();
		                $surat_kk  = $name['file_name'];
		                echo json_encode([ 'error' => 0,'file' => $surat_kk,'url' => base_url('assets/media/'.$_SESSION['identity'].'/kk/'.$surat_kk),'message' => $this->upload->display_errors() ]);
		            }
		            else
		            {
		                echo json_encode(['error' => 1, 'message' => $this->upload->display_errors()]);
		                exit();
		            }
		        }
			break;
			case 'upload_foto':
				if (!is_dir('assets/media/'.$_SESSION['identity'])) {
		            mkdir('assets/media/'.$_SESSION['identity'],0755);
		        }

				if (!is_dir('assets/media/'.$_SESSION['identity'].'/foto')) {
		            mkdir('assets/media/'.$_SESSION['identity'].'/foto',0755);
		        }

		        if($_FILES['file']['name'] != '')
		        {
		            $config['upload_path'] = './assets/media/'.$_SESSION['identity'].'/foto';
		            $config['allowed_types'] = 'jpg|jpeg|png';
                    $config['max_size']      = 5120;
		            $config['encrypt_name'] = TRUE;
		            $config['overwrite'] = TRUE;
		            $this->upload->initialize($config);
		            $this->upload->initialize($config);

		            if($this->upload->do_upload("file"))
		            {    
		                $name = $this->upload->data();
		                $surat_foto  = $name['file_name'];
		                echo json_encode([ 'error' => 0,'file' => $surat_foto,'url' => base_url('assets/media/'.$_SESSION['identity'].'/foto/'.$surat_foto),'message' => $this->upload->display_errors() ]);
		            }
		            else
		            {
		                echo json_encode(['error' => 1, 'message' => $this->upload->display_errors()]);
		                exit();
		            }
		        }
			break;
            case 'upload_logo':
                if($_FILES['file']['name'] != '')
                {
                    $config['upload_path'] = './assets/logo';
                    $config['allowed_types'] = 'jpg|jpeg|png';
                    $config['max_size']      = 5120;
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
                break;
		}
	}

	private function _validate($type){

        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        switch ($type) {
            case 'daftar_umkm':

               	if($this->input->post('nama_usaha',true) == '')
               	{
               		$data['inputerror'][] = 'nama_usaha';
            		$data['error_string'][] = 'Data harus diisi!';
            		$data['status'] = FALSE;
                }

                if ($this->input->post('id_bentuk_usaha',true) != 8) {
                    if($this->input->post('nama_perusahaan',true) == '')
                    {
                        $data['inputerror'][] = 'nama_perusahaan';
                        $data['error_string'][] = 'Data harus diisi!';
                        $data['status'] = FALSE;
                    }
                }

               	if(empty($this->input->post('id_sektor_usaha',true)))
               	{
               		$data['inputerror'][] = 'sektor_usaha';
               		$data['error_string'][] = 'Data Harus Diisi!';
               		$data['status'] = FALSE;
               	}

               	if($this->input->post('tgl_usaha',true) == '')
               	{
               		$data['inputerror'][] = 'tgl_usaha';
               		$data['error_string'][] = 'Data Harus Diisi!';
               		$data['status'] = FALSE;
               	}
                   
                if ($this->input->post('jenis_pembayaran', true) == 'pg') {
                    if (empty($this->input->post('payment_gateway', true))) {
                        // $data['inputerror'][]   = 'payment_gateway[]';
                        // $data['error_string'][] = 'Pilih minimal 1 pilihan!';
                        // $data['status']         = false;
                    }
                } else {
                    // if ($this->input->post('no_rekening', true) == '') {
                    //     $data['inputerror'][]   = 'no_rekening';
                    //     $data['error_string'][] = 'Data Harus Diisi!';
                    //     $data['status']         = false;
                    // }

                    // if ($this->input->post('id_bank', true) == '') {
                    //     $data['inputerror'][]   = 'id_bank';
                    //     $data['error_string'][] = 'Data Harus Diisi!';
                    //     $data['status']         = false;
                    // }

                    // if ($this->input->post('an_rekening', true) == '') {
                    //     $data['inputerror'][]   = 'an_rekening';
                    //     $data['error_string'][] = 'Data Harus Diisi!';
                    //     $data['status']         = false;
                    // }
                }

                if ($this->input->post('cara_pembayaran', true) == 'transfer') {
                    if ($this->input->post('no_rekening', true) == '') {
                        $data['inputerror'][]   = 'no_rekening';
                        $data['error_string'][] = 'Data Harus Diisi!';
                        $data['status']         = false;
                    }

                    if ($this->input->post('id_bank', true) == '') {
                        $data['inputerror'][]   = 'id_bank';
                        $data['error_string'][] = 'Data Harus Diisi!';
                        $data['status']         = false;
                    }

                    if ($this->input->post('an_rekening', true) == '') {
                        $data['inputerror'][]   = 'an_rekening';
                        $data['error_string'][] = 'Data Harus Diisi!';
                        $data['status']         = false;
                    }

                    if(empty($this->input->post('id_kurir',true))) {
                        $data['inputerror'][] = 'nama_kurir';
                        $data['error_string'][] = 'Data Harus Diisi!';
                        $data['status'] = FALSE;
                    }
                }

               	if($this->input->post('no_hp',true) == '')
               	{
               		$data['inputerror'][] = 'no_hp';
               		$data['error_string'][] = 'Data Harus Diisi!';
               		$data['status'] = FALSE;
               	}

               	if($this->input->post('id_sarana_usaha',true) == 4)
               	{
               		if($this->input->post('nama_sarana_lainnya') == '')
               		{
               			$data['inputerror'][] = 'nama_sarana_lainnya';
	               		$data['error_string'][] = 'Data Harus Diisi!';
	               		$data['status'] = FALSE;
               		}
               	}

               	if($this->input->post('id_status_tempat_usaha',true) == 4)
               	{
               		if($this->input->post('nama_status_lainnya') == '')
               		{
               			$data['inputerror'][] = 'nama_status_lainnya';
	               		$data['error_string'][] = 'Data Harus Diisi!';
	               		$data['status'] = FALSE;
               		}
               	}

               	if($this->input->post('id_status_tempat_usaha',true) == 4)
               	{
               		if($this->input->post('nama_status_lainnya') == '')
               		{
               			$data['inputerror'][] = 'nama_status_lainnya';
	               		$data['error_string'][] = 'Data Harus Diisi!';
	               		$data['status'] = FALSE;
               		}
               	}

               	if($this->input->post('id_kec',true) == 0)
               	{
               		$data['inputerror'][] = 'nama_kec';
               		$data['error_string'][] = 'Data Harus Diisi!';
               		$data['status'] = FALSE;
               	}

               	if($this->input->post('id_kel',true) == 0)
               	{
               		$data['inputerror'][] = 'nama_kel';
               		$data['error_string'][] = 'Data Harus Diisi!';
               		$data['status'] = FALSE;
               	}

               	if($this->input->post('alamat',true) == '')
               	{
               		$data['inputerror'][] = 'alamat';
               		$data['error_string'][] = 'Alamat Tidak Boleh Kosong!';
               		$data['status'] = FALSE;
               	}

               	if($this->input->post('lat',true) == '' OR $this->input->post('long',true) == '')
               	{
               		$data['inputerror'][] = 'alamat';
               		$data['error_string'][] = 'Titik Alamat Harus dipilih!';
               		$data['status'] = FALSE;
               	}

                if ($this->input->post('nomor_npwp',true) != '') {
                    if($this->input->post('file_npwp') == '')
                    {
                        $data['inputerror'][] = 'file_npwp';
                        $data['error_string'][] = 'Data Harus Diisi';
                        $data['status'] = FALSE;
                    }
                }

                if ($this->input->post('domisili',true) == 'Luar Kota') {
                    if($this->input->post('file_ktp') == '')
                    {
                        $data['inputerror'][] = 'file_ktp';
                        $data['error_string'][] = 'Data Harus Diisi';
                        $data['status'] = FALSE;
                    }
                }

                if ($this->input->post('no_surat',true)[0] != '') {
                    if($this->input->post('file_umkm') == '')
                    {
                        $data['inputerror'][] = 'file_umkm';
                        $data['error_string'][] = 'Data Harus Diisi';
                        $data['status'] = FALSE;
                    }
                }

                if ($this->input->post('nama_izin_usaha',true)) {
                    foreach ($_POST['nama_izin_usaha'] as $key => $value) {
                        if ($key == '0') {
                            if($_POST['nama_izin_usaha'][$key] == '0'){
                                if($this->input->post('no_surat')[$key] != '')
                                {
                                    $data['inputerror'][] = 'nm_izin_usaha[]';
                                    $data['error_string'][] = 'Nama Izin Usaha Harus Diisi!';
                                    $data['status'] = FALSE;
                                }
                            }else{
                                if($this->input->post('no_surat')[$key] == '')
                                {
                                    $data['inputerror'][] = 'no_surat[]';
                                    $data['error_string'][] = 'Nomor Surat Harus Diisi!';
                                    $data['status'] = FALSE;
                                }
                            }
                        }else{
                            if($this->input->post('nama_izin_usaha')[$key] == '0')
                            {
                                $data['inputerror'][] = 'nm_izin_usaha[]';
                                $data['error_string'][] = 'Nama Izin Usaha Harus Diisi!';
                                $data['status'] = FALSE;
                            }

                            if($this->input->post('no_surat')[$key] == '')
                            {
                                $data['inputerror'][] = 'no_surat[]';
                                $data['error_string'][] = 'Nomor Surat Harus Diisi!';
                                $data['status'] = FALSE;
                            }

                            if($this->input->post('nama_izin_usaha')[0] == '0')
                            {
                                $data['inputerror'][] = 'nm_izin_usaha[]';
                                $data['error_string'][] = 'Nama Izin Usaha Harus Diisi!';
                                $data['status'] = FALSE;
                            }

                            if($this->input->post('no_surat')[0] == '')
                            {
                                $data['inputerror'][] = 'no_surat[]';
                                $data['error_string'][] = 'Nomor Surat Harus Diisi!';
                                $data['status'] = FALSE;
                            }
                        }
                    }
                }
                
                if ($this->input->post('nama_ecommerce',true)) {
                    foreach ($_POST['nama_ecommerce'] as $key => $value) {
                        if ($key == '0') {
                            if($_POST['nama_ecommerce'][$key] == '0'){
                                if($this->input->post('keterangan_ecommerce')[$key] != '')
                                {
                                    $data['inputerror'][] = 'nm_ecommerce[]';
                                    $data['error_string'][] = 'Nama eCommerce Harus Diisi!';
                                    $data['status'] = FALSE;
                                }
                            }else{
                                if($this->input->post('keterangan_ecommerce')[$key] == '')
                                {
                                    $data['inputerror'][] = 'keterangan_ecommerce[]';
                                    $data['error_string'][] = 'Link / Url eCommerce Harus Diisi !';
                                    $data['status'] = FALSE;
                                }
                                if (filter_var($this->input->post('keterangan_ecommerce')[$key], FILTER_VALIDATE_URL) === FALSE) {
                                    $data['inputerror'][] = 'keterangan_ecommerce[]';
                                    $data['error_string'][] = 'Link / Url eCommerce Tidak Valid !';
                                    $data['status'] = FALSE;
                                }
                            }
                        }else{
                            if($this->input->post('nama_ecommerce')[$key] == '0')
                            {
                                $data['inputerror'][] = 'nm_ecommerce[]';
                                $data['error_string'][] = 'Nama eCommerce Harus Diisi!';
                                $data['status'] = FALSE;
                            }
                            if($this->input->post('keterangan_ecommerce')[$key] == '')
                            {
                                $data['inputerror'][] = 'keterangan_ecommerce[]';
                                $data['error_string'][] = 'Link / Url eCommerce Harus Diisi!';
                                $data['status'] = FALSE;
                            }
                            if (filter_var($this->input->post('keterangan_ecommerce')[$key], FILTER_VALIDATE_URL) === FALSE) {
                                $data['inputerror'][] = 'keterangan_ecommerce[]';
                                $data['error_string'][] = 'Link / Url eCommerce Tidak Valid !';
                                $data['status'] = FALSE;
                            }

                            if($this->input->post('nama_ecommerce')[0] == '0')
                            {
                                $data['inputerror'][] = 'nm_ecommerce[]';
                                $data['error_string'][] = 'Nama eCommerce Harus Diisi!';
                                $data['status'] = FALSE;
                            }
                            if($this->input->post('keterangan_ecommerce')[0] == '')
                            {
                                $data['inputerror'][] = 'keterangan_ecommerce[]';
                                $data['error_string'][] = 'Link / Url eCommerce Harus Diisi!';
                                $data['status'] = FALSE;
                            }
                            if (filter_var($this->input->post('keterangan_ecommerce')[0], FILTER_VALIDATE_URL) === FALSE) {
                                $data['inputerror'][] = 'keterangan_ecommerce[]';
                                $data['error_string'][] = 'Link / Url eCommerce Tidak Valid !';
                                $data['status'] = FALSE;
                            }
                        }
                    }
                }
                
                if ($this->input->post('nama_medsos',true)) {
                    foreach ($_POST['nama_medsos'] as $key => $value) {
                        if ($key == '0') {
                            if($_POST['nama_medsos'][$key] == '0'){
                                if($this->input->post('keterangan_medsos')[$key] != '')
                                {
                                    $data['inputerror'][] = 'nm_medsos[]';
                                    $data['error_string'][] = 'Nama Media Sosial Harus Diisi!';
                                    $data['status'] = FALSE;
                                }
                            }else{
                                if($this->input->post('keterangan_medsos')[$key] == '')
                                {
                                    $data['inputerror'][] = 'keterangan_medsos[]';
                                    $data['error_string'][] = 'Link / Url Media Sosial Harus Diisi!';
                                    $data['status'] = FALSE;
                                }
                                if (filter_var($this->input->post('keterangan_medsos')[$key], FILTER_VALIDATE_URL) === FALSE) {
                                    $data['inputerror'][] = 'keterangan_medsos[]';
                                    $data['error_string'][] = 'Link / Url Media Sosial Tidak Valid !';
                                    $data['status'] = FALSE;
                                }
                            }
                        }else{
                            if($this->input->post('nama_medsos')[$key] == '0')
                            {
                                $data['inputerror'][] = 'nm_medsos[]';
                                $data['error_string'][] = 'Nama Media Sosial Harus Diisi!';
                                $data['status'] = FALSE;
                            }
                            if($this->input->post('keterangan_medsos')[$key] == '')
                            {
                                $data['inputerror'][] = 'keterangan_medsos[]';
                                $data['error_string'][] = 'Link / Url Media Sosial Harus Diisi!';
                                $data['status'] = FALSE;
                            }
                            if (filter_var($this->input->post('keterangan_medsos')[$key], FILTER_VALIDATE_URL) === FALSE) {
                                $data['inputerror'][] = 'keterangan_medsos[]';
                                $data['error_string'][] = 'Link / Url Media Sosial Tidak Valid !';
                                $data['status'] = FALSE;
                            }

                            if($this->input->post('nama_medsos')[0] == '0')
                            {
                                $data['inputerror'][] = 'nm_medsos[]';
                                $data['error_string'][] = 'Nama Media Sosial Harus Diisi!';
                                $data['status'] = FALSE;
                            }
                            if($this->input->post('keterangan_medsos')[0] == '')
                            {
                                $data['inputerror'][] = 'keterangan_medsos[]';
                                $data['error_string'][] = 'Link / Url Media Sosial Harus Diisi!';
                                $data['status'] = FALSE;
                            }
                            if (filter_var($this->input->post('keterangan_medsos')[0], FILTER_VALIDATE_URL) === FALSE) {
                                $data['inputerror'][] = 'keterangan_medsos[]';
                                $data['error_string'][] = 'Link / Url Media Sosial Tidak Valid !';
                                $data['status'] = FALSE;
                            }
                        }
                    }
                }

                if($data['status'] === FALSE)
                {
                    echo json_encode($data);
                    exit();
                }
            break;
        }
    }

    public function maps(){
    	$this->load->view('umkm/maps');
    }
}