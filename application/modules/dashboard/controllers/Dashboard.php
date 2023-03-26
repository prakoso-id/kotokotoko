<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	public function __construct() {
		parent::__construct();
        if(!$this->user_model->is_login()){
            redirect(base_url());
        }
		$this->template->set_layout('templatesv2/backend');
        $this->load->model('model_dashboard');
	}

	public function index() {
		$this->template->add_title_segment('Dashboard');
		$this->template->add_meta_tag("description", "Yazeri Indonesia Moslem Clothes no 1 di indonesia");
		$this->template->add_meta_tag("keywords", "toko,muslim,moslem clothes,pakaian muslim,termurah");
        $this->template->add_css("assets/mytemplate_backend/modules/smart_wizard/css/smart_wizard_all.min.css");
        $this->template->add_css("assets/mytemplate_backend/modules/owlcarousel2/dist/assets/owl.carousel.min.css");
        $this->template->add_css("assets/mytemplate_backend/modules/owlcarousel2/dist/assets/owl.theme.default.min.css");
        $this->template->add_css("assets/plugins/jquery-image-viewer/jquery.magnify.css");
        $this->template->add_js("assets/mytemplate_backend/modules/smart_wizard/js/jquery.smartWizard.min.js",true);
        $this->template->add_js("assets/mytemplate_backend/modules/owlcarousel2/dist/owl.carousel.min.js",true);
        $this->template->add_js("assets/plugins/jquery-image-viewer/jquery.magnify.js",true);

        $pt = $this->model_dashboard->get_produk_terbaik();
        $produk_terbaik = array_filter(
            $pt,
            function ($e) {
                return $e->jum_terjual != null;
            }
        );

		$this->data = array(
			'active'	=> 'dashboard',
			'name'		=> $this->security->get_csrf_token_name(),
			'hash'		=> $this->security->get_csrf_hash(),
            'm_status'  => $this->query_model->getmStatus(),
            'title_beranda' => 'Dashboard',
            'produk_terbaik' => $produk_terbaik
		);

        // if ($this->user_model->is_umkm_admin() || $this->user_model->is_umkm_verifikator()) {
        //     $this->template->render("index_admin",$this->data);
        // }else{
        //     $this->template->render("index",$this->data);
        // }
        $this->template->render("index",$this->data);

	}

    public function ajax_confirm_eorder() {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://service-tlive.tangerangkota.go.id/services/eorder/home/set_transaksi");
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0");
        curl_setopt($ch, CURLOPT_POST, 1);
        $query_data = [
            'invoice_id' => $this->input->post('invoice_id'),
            'status' => $this->input->post('status'),
        ];
        $postfields = http_build_query($query_data);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, "r35t4p12:8540c5ef27b4afdb197405dc551ce5b5bfcb73bb2");
        $result = curl_exec($ch);
        $produkeroder = json_decode($result);
        $output = array(
            "status" => $produkeroder,
        );  
        echo json_encode($output);
    }

    public function ajax_show_invoice() {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://service-tlive.tangerangkota.go.id/services/eorder/home/get_invoice");
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0");
        curl_setopt($ch, CURLOPT_POST, 1);
        $query_data = [];
        // if ($this->input->get('search'))
        $query_data['invoice_id'] = $this->input->post('invoice_id');
        $postfields = http_build_query($query_data);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, "r35t4p12:8540c5ef27b4afdb197405dc551ce5b5bfcb73bb2");
        $result = curl_exec($ch);
        $output = json_decode($result);
        echo json_encode($output);
    }

	public function ajax_data(){
		$type = $this->input->post('type',true);
		switch ($type) {
			case 'cari_nik':
                $nik = $this->input->post('nik',true);
                if($nik == ''){
                    $message = array(
                        'success'   => false,
                        'message'   => 'NIK Tidak Boleh Kosong'
                    );
                    echo json_encode($message);
                    exit();
                }elseif (!is_numeric($nik)) {
                    $message = array(
                        'success'   => false,
                        'message'   => 'NIK Tidak Valid'
                    );
                    echo json_encode($message);
                    exit();
                }
				
				$useragent = 'Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0';
				$json_url = 'https://service-tlive.tangerangkota.go.id/services/tlive/profil/user';
				$ch = curl_init( $json_url );
				curl_setopt($ch, CURLOPT_USERAGENT, $useragent );
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS,"nik=".$nik);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_USERPWD, SERV_U . ':' . SERV_P);
				$result = json_decode(curl_exec($ch),true);

                if(!$result['success']){
                    if($result['message'] == ''){
                       $message = array(
                            'success'   => false,
                            'message'   => 'NIK Tidak Ditemukan'
                        );
                        echo json_encode($message);
                        exit(); 
                    }
                    
                }

				echo json_encode($result);	
			break;
            case 'cari_nip':
                $nip = $this->input->post('nip',true);
                $useragent = 'Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0';
                $json_url = 'https://opendatav2.tangerangkota.go.id/services/pegawai/pegawaibynip/nip/'.$_POST['nip'];
                $ch = curl_init( $json_url );
                curl_setopt($ch, CURLOPT_USERAGENT, $useragent );
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_USERPWD, REST_U . ':' . REST_P);
                $result = json_decode(curl_exec($ch),true);
                if(isset($result['nama_pegawai']))
                {   
                     $result['success']    = true;
                }   
                echo json_encode($result); 
            break;
            case 'data_pengguna':
                $query['select'] = '*';
                $query['table']  = 'm_pengguna';
                if($this->input->post('id',true))
                {
                    $query['where']  = 'id_pengguna = "'.(int)$this->input->post('id',true).'"';
                }else{
                    $query['where']  = 'id_pengguna = '.$this->session->user_id;
                }
                $data = $this->query_model->getRow($query);
                $data->nama_ibu = null;
                if (is_numeric($data->username) && strlen($data->username) == 16) {
                    $dt_cek_nik = cek_nik($data->username);
                    if ($dt_cek_nik['success']) {
                        $data->nama_ibu = $dt_cek_nik['decode'][0]['NAMA_LGKP_IBU'];
                    }
                }
                echo json_encode($data);
            break;
            case 'data_group':
                $query['select']    = '*';
                $query['table']     = 'm_group';
                if($this->input->post('id') == 'nip')
                {
                    $query['where'] = 'id_group != 2';    
                }else if($this->input->post('id') == 'all'){

                }else{
                    $query['where'] = 'id_group == 2';
                }
                $result = $this->query_model->getData($query);
                $option = '';
                foreach ($result as $value) {
                    if($this->input->post('id_group') == $value->id_group)
                    {
                        $option .= '<option selected value="'.$value->id_group.'">'.$value->nama.'</option>';

                    }else{
                        $option .= '<option value="'.$value->id_group.'">'.$value->nama.'</option>';

                    }
                }
                echo $option;
            break;
            case 'tags_produk':
                $result = explode(' , ',$this->input->post('data'));
                $option = '';
                foreach ($result as $key => $value) {
                    $option .= '<option selected value="'.$value.'">'.$value.'</option>';
                }
                echo $option;
            break;
            case 'jenis_usaha':
                $hasil = null;
                if($this->input->post('id_umkm'))
                {
                    $cek['select']  = 'id_jenis_usaha';
                    $cek['table']   = 'm_umkm';
                    $cek['where']   = 'id_umkm = "'.(int)$this->input->post('id_umkm',true).'"';
                    $hasil          = $this->query_model->getRow($cek);   
                }
                

                $query['select']    = '*';
                $query['table']     = 'm_jenis_usaha';

                if($hasil){
                    // $query['where']     = 'status = 1 AND id_jenis_usaha = '.$hasil->id_jenis_usaha;
                    $query['where']     = 'status = 1';
                    $id_jenis_usaha     = $hasil->id_jenis_usaha;
                }else{
                    $query['where']     = 'status = 1';
                    $id_jenis_usaha     = null;
                }
                
                $result = $this->query_model->getData($query);
                $option = '<option value="">--Pilih Jenis Usaha--</option>';
                foreach ($result as $value) {
                    if($this->input->post('id') == $value->id_jenis_usaha || $id_jenis_usaha == $value->id_jenis_usaha)
                    {
                        $option .= '<option selected value="'.$value->id_jenis_usaha.'">'.$value->nama_usaha.'</option>';
                    }
                    else{
                        $option .= '<option value="'.$value->id_jenis_usaha.'">'.$value->nama_usaha.'</option>';
                    }
                }
                echo $option;
            break;
            case 'data_umkm':
                $query['select']    = 'id_umkm,namausaha,id_status';
                $query['table']     = 'm_umkm';
                // $query['where']     = 'id_status = 1 AND username = "'.$this->session->identity.'"';
                $query['where']     = '(id_status = 1 OR id_status = 2) AND username = "'.$this->session->identity.'"';  
                $result = $this->query_model->getData($query);

                $option = '';
                foreach ($result as $value) {
                    if ($value->id_status == 1) {
                        $sts_verif = '&#10004;';
                    }else{
                        $sts_verif = '';
                    }
                    if($this->input->post('id') == $value->id_umkm)
                    {
                        $option .= '<option selected value="'.$value->id_umkm.'">'.$value->namausaha.'  '.$sts_verif.'</option>';
                    }
                    else{
                        $option .= '<option value="'.$value->id_umkm.'">'.$value->namausaha.'  '.$sts_verif.'</option>';
                    }
                }
                echo $option;
            break;
            case 'sarana_usaha':
                $query['select']    = '*';
                $query['table']     = 'm_sarana_usaha';
                $query['where']     = 'status = 1';
                $result = $this->query_model->getData($query);
                $option = '';
                foreach ($result as $value) {
                    if($this->input->post('id') == $value->id_sarana_usaha)
                    {
                        $option .= '<option selected value="'.$value->id_sarana_usaha.'">'.$value->nama_sarana.'</option>';
                    }else{
                        $option .= '<option value="'.$value->id_sarana_usaha.'">'.$value->nama_sarana.'</option>';
                    }
                }
                echo $option;
            break;
            case 'status_tempat':
                $query['select']    = '*';
                $query['table']     = 'm_status_tempat_usaha';
                $query['where']     = 'status = 1';
                $result = $this->query_model->getData($query);
                $option = '';
                foreach ($result as $value) {
                    if($this->input->post('id') == $value->id_status_tempat_usaha)
                    {
                        $option .= '<option selected value="'.$value->id_status_tempat_usaha.'">'.$value->nama_status_tempat_usaha.'</option>';
                    }else{
                        $option .= '<option value="'.$value->id_status_tempat_usaha.'">'.$value->nama_status_tempat_usaha.'</option>';
                    }
                }
                echo $option;
            break;
            case 'bahan_bakar':
                $query['select']    = '*';
                $query['table']     = 'm_bahan_bakar';
                $query['where']     = 'status = 1';
                $result = $this->query_model->getData($query);
                $option = '';
                foreach ($result as $value) {
                    if($this->input->post('id') == $value->id_bahan_bakar)
                    {
                        $option .= '<option selected value="'.$value->id_bahan_bakar.'">'.$value->nama_bahan_bakar.'</option>';
                    }else{
                        $option .= '<option value="'.$value->id_bahan_bakar.'">'.$value->nama_bahan_bakar.'</option>';
                    }
                }
                echo $option;
            break;
            case 'lainnya':
                $query['select']    = '*';
                $query['table']     = 'm_lainnya';
                $query['where']     = 'status = 1';
                $result = $this->query_model->getData($query);
                $option = '<option value="0">--Pilih salah satu--</option>';
                foreach ($result as $value) {
                    if($this->input->post('id') == $value->id_lainnya)
                    {
                        $option .= '<option selected value="'.$value->id_lainnya.'">'.$value->nama_lainnya.'</option>';
                    }else{
                        $option .= '<option value="'.$value->id_lainnya.'">'.$value->nama_lainnya.'</option>';
                    }
                }
                echo $option;
            break;
            case 'bentuk_usaha':
                $query['select']    = '*';
                $query['table']     = 'm_bentuk_usaha';
                $query['where']     = 'status = 1';
                $query['order']     = 'id_bentuk_usaha desc';
                $result = $this->query_model->getData($query);
                $option = '';
                foreach ($result as $value) {
                    if($this->input->post('id') == $value->id_bentuk_usaha)
                    {
                        $option .= '<option selected value="'.$value->id_bentuk_usaha.'">'.$value->nama_bentuk_usaha.'</option>';
                    }else{
                        $option .= '<option value="'.$value->id_bentuk_usaha.'">'.$value->nama_bentuk_usaha.'</option>';
                    }
                }
                echo $option;
            break;
            case 'sektor_usaha':
                $query['select']    = '*';
                $query['table']     = 'm_sektor_usaha';
                $query['where']     = 'status = 1';
                $result = $this->query_model->getData($query);
                $option = '';
                foreach ($result as $value) {
                    if ($this->input->post('id')) { //from edit function
                        $data = option_sarana_usaha($this->input->post('id'));
                        if(in_array($value->id_sektor_usaha,$data)){
                            $option .= '<option selected value="'.$value->id_sektor_usaha.'">'.$value->nama_sektor_usaha.'</option>';
                        }else{
                            $option .= '<option value="'.$value->id_sektor_usaha.'">'.$value->nama_sektor_usaha.'</option>';
                        }
                    }elseif ($this->input->post('id_jenis_usaha')) {
                        $arr_jenis_usaha = explode(',', $value->id_jenis_usaha);
                        if(in_array($this->input->post('id_jenis_usaha'),$arr_jenis_usaha)){
                            $option .= '<option selected value="'.$value->id_sektor_usaha.'">'.$value->nama_sektor_usaha.'</option>';
                        }else{
                            $option .= '<option value="'.$value->id_sektor_usaha.'">'.$value->nama_sektor_usaha.'</option>';
                        }
                    }else{
                        $option .= '<option value="'.$value->id_sektor_usaha.'">'.$value->nama_sektor_usaha.'</option>';                        
                    }
                    
                }
                echo $option;
            break;
            case 'modal_luar':
                $query['select']    = '*';
                $query['table']     = 'm_modal_luar';
                $query['where']     = 'status = 1';
                $result = $this->query_model->getData($query);
                $option = '<option value="0">--Pilih salah satu--</option>';
                foreach ($result as $value) {
                    if($this->input->post('id') == $value->id_modal_luar)
                    {
                        $option .= '<option selected value="'.$value->id_modal_luar.'">'.$value->nama_modal_luar.'</option>';
                    }else{
                        $option .= '<option value="'.$value->id_modal_luar.'">'.$value->nama_modal_luar.'</option>';
                    }
                }
                echo $option;
            break;
            case 'skala_usaha':
                $query['select']    = '*';
                $query['table']     = 'm_skala_usaha';
                $query['where']     = 'status = 1';
                $result = $this->query_model->getData($query);
                $option = '<option value="0">-- Skala Usaha --</option>';
                foreach ($result as $value) {
                    if($this->input->post('id') == $value->id_skala_usaha)
                    {
                        $option .= '<option selected value="'.$value->id_skala_usaha.'">'.$value->nama_skala.'</option>';
                    }else{
                        $option .= '<option value="'.$value->id_skala_usaha.'">'.$value->nama_skala.'</option>';
                    }
                }
                echo $option;
            break;
            case 'detail_umkm':
                $query['select']    = 'a.*,b.*,b.alamat as alamat_pengguna,b.email as email_pengguna, b.no_kab as no_kab_pengguna, b.no_prop as no_prop_pengguna, b.kode_pos as kode_pos_pengguna ,c.*,c.no_prop as no_prop_umkm, c.no_kab as no_kab_umkm, c.kode_pos as kode_pos_umkm ,d.*,e.nama_usaha,f.nama_bentuk_usaha, g.nama_sektor_usaha, h.nama_modal_luar,i.nama_sarana as nama_sarana_usaha,j.nama_status_tempat_usaha,k.nama_bahan_bakar,l.nama_lainnya';
                $query['table']     = 'm_umkm a';
                $query['join'][0]   = array('m_pengguna b','b.username = a.username','left');
                $query['join'][1]   = array('m_umkm_alamat c','c.id_umkm = a.id_umkm','left');
                $query['join'][2]   = array('m_umkm_berkas d','d.id_umkm = a.id_umkm','left');
                $query['join'][3]   = array('m_jenis_usaha e','a.id_jenis_usaha = e.id_jenis_usaha','left');
                $query['join'][4]   = array('m_bentuk_usaha f','f.id_bentuk_usaha = a.id_bentuk_usaha','left');
                $query['join'][5]   = array('m_sektor_usaha g','g.id_sektor_usaha = a.id_sektor_usaha','left');
                $query['join'][6]   = array('m_modal_luar h','h.id_modal_luar = a.id_modal_luar','left');
                $query['join'][7]   = array('m_sarana_usaha i','i.id_sarana_usaha = a.id_sarana_usaha','left');
                $query['join'][8]   = array('m_status_tempat_usaha j','j.id_status_tempat_usaha = a.id_status_tempat_usaha','left');
                $query['join'][9]   = array('m_bahan_bakar k','k.id_bahan_bakar = a.id_bahan_bakar','left');
                $query['join'][10]  = array('m_lainnya l','l.id_lainnya = a.id_lainnya','left');

                if($this->input->post('status'))
                {
                    $query['where']     = 'a.id_status = 1 AND a.username = "'.(int)$this->input->post('id',true).'"';
                }else{
                    $query['where']     = 'a.id_umkm = "'.(int)$this->input->post('id',true).'"';
                }

                $result = $this->query_model->getRow($query);   
                             
                $result->nama_sektor_usaha    =     @get_sektor_usaha($result->id_sektor_usaha);
                $result->nama_kurir           =     @get_nama_kurir($result->id_kurir);
                if($result->domisili == 'Luar Kota')
                {
                    $prop = $result->domisili_prop;
                    $kota = $result->domisili_kota;
                    $result->nama_domisili_prop  = @get_propinsi($prop);
                    $result->nama_domisili_kota  = @get_kota($prop,$kota);
                }

                $result->nama_prop_pengguna = @get_propinsi($result->no_prop_pengguna);
                $result->nama_kab_pengguna  = @get_kota($result->no_prop_pengguna,$result->no_kab_pengguna);
                $result->nama_kec_pengguna  = @get_kec($result->no_prop_pengguna,$result->no_kab_pengguna,$result->no_kec);
                $result->nama_kel_pengguna  = @get_kel($result->no_prop_pengguna,$result->no_kab_pengguna,$result->no_kec,$result->no_kel);


                $result->nama_prop          = @get_propinsi($result->no_prop);
                $result->nama_kab           = @get_kota($result->no_prop,$result->no_kab);
                $result->nama_kec           = @get_kec($result->no_prop,$result->no_kab,$result->id_kec);
                $result->nama_kel           = @get_kel($result->no_prop,$result->no_kab,$result->id_kec,$result->id_kel);

                $query1['select']           = '*';
                $query1['table']            = 'm_umkm_izin_usaha';
                $query1['where']            = 'id_umkm = "'.$result->id_umkm.'"';
                $result->nama_izin_usaha    = $this->query_model->getData($query1);
                

                echo json_encode($result);
            break;
            case 'data_propinsi':
                $useragent = 'Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0';
                $json_url = 'https://opendatav2.tangerangkota.go.id/services/wilayah/propinsi_all';
                $ch = curl_init( $json_url );
                curl_setopt($ch, CURLOPT_USERAGENT, $useragent );
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_USERPWD, REST_U . ':' . REST_P);
                $result = json_decode(curl_exec($ch),true);
                $option = '<option value="0">-- DATA PROPINSI --</option>';
                foreach ($result['data'] as $value) {
                    if(isset($_POST['id']))
                    {
                        if($_POST['id'] == $value['NO_PROP'])
                        {
                            $option .= '<option selected value="'.$value['NO_PROP'].'">'.$value['NAMA_PROP'].'</option>';
                        }else{
                            $option .= '<option value="'.$value['NO_PROP'].'">'.$value['NAMA_PROP'].'</option>';
                        }
                    }else{
                        $option .= '<option value="'.$value['NO_PROP'].'">'.$value['NAMA_PROP'].'</option>';
                    }
                    
                }
                echo $option;
            break;
            case 'data_kota':
                $useragent = 'Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0';
                if($this->input->post('data_propinsi'))
                {
                    $json_url = 'https://opendatav2.tangerangkota.go.id/services/wilayah/kabupaten/no_prop/'.$this->input->post('data_propinsi',true);
                }else{
                    $json_url = 'https://opendatav2.tangerangkota.go.id/services/wilayah/kabupaten/no_prop/36';
                }
                $ch = curl_init( $json_url );
                curl_setopt($ch, CURLOPT_USERAGENT, $useragent );
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_USERPWD, REST_U . ':' . REST_P);
                $result = json_decode(curl_exec($ch),true);
                $option = '<option value="0">-- DATA KOTA / KABUPATEN --</option>';
                foreach ($result['data'] as $value) {
                    if(isset($_POST['id']))
                    {
                        if($_POST['id'] == $value['NO_KAB'])
                        {
                            $option .= '<option selected value="'.$value['NO_KAB'].'">'.$value['NAMA_KAB'].'</option>';
                        }else{
                            $option .= '<option value="'.$value['NO_KAB'].'">'.$value['NAMA_KAB'].'</option>';
                        }
                    }else{
                        $option .= '<option value="'.$value['NO_KAB'].'">'.$value['NAMA_KAB'].'</option>';
                    }
                }
                echo $option;
            break;
            case 'data_kecamatan':
                if($this->input->post('data_propinsi'))
                {
                    $json_url = 'https://opendatav2.tangerangkota.go.id/services/wilayah/kecamatan/no_prop/'.$this->input->post('data_propinsi',true).'/no_kab/'.$this->input->post('data_kota',true);
                }else{
                    $json_url = 'https://opendatav2.tangerangkota.go.id/services/wilayah/kecamatan/no_prop/36/no_kab/71';
                }
                $useragent = 'Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0';
                $ch = curl_init( $json_url );
                curl_setopt($ch, CURLOPT_USERAGENT, $useragent );
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_USERPWD, REST_U . ':' . REST_P);
                $result = json_decode(curl_exec($ch),true);
                $option = '<option value="0">-- DATA KECAMATAN --</option>';
                foreach ($result['data'] as $value) {
                    if(isset($_POST['id']))
                    {
                        if($_POST['id'] == $value['NO_KEC'])
                        {
                            $option .= '<option selected value="'.$value['NO_KEC'].'">'.$value['NAMA_KEC'].'</option>';
                        }else{
                            $option .= '<option value="'.$value['NO_KEC'].'">'.$value['NAMA_KEC'].'</option>';
                        }
                    }else{
                        $option .= '<option value="'.$value['NO_KEC'].'">'.$value['NAMA_KEC'].'</option>';                        
                    }
                }
                echo $option;
            break;
            case 'data_kelurahan':
                $useragent = 'Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0';
                if($this->input->post('data_propinsi'))
                {
                    $json_url = 'https://opendatav2.tangerangkota.go.id/services/wilayah/kelurahan/no_prop/'.$this->input->post('data_propinsi',true).'/no_kab/'.$this->input->post('data_kota',true).'/no_kec/'.$this->input->post('data_kec',true);                    
                }else{
                    $json_url = 'https://opendatav2.tangerangkota.go.id/services/wilayah/kelurahan/no_prop/36/no_kab/71/no_kec/'.$this->input->post('data_kec',true);
                }
                
                $ch = curl_init( $json_url );
                curl_setopt($ch, CURLOPT_USERAGENT, $useragent );
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_USERPWD, REST_U . ':' . REST_P);
                $result = json_decode(curl_exec($ch),true);
                $option = '<option value="0">-- DATA KELURAHAN --</option>';
                foreach ($result['data'] as $value) {
                    if(isset($_POST['id_kel']))
                    {
                        if($_POST['id_kel'] == $value['NO_KEL'])
                        {
                            $option .= '<option selected value="'.$value['NO_KEL'].'">'.$value['NAMA_KEL'].'</option>';
                        }else{
                            $option .= '<option value="'.$value['NO_KEL'].'">'.$value['NAMA_KEL'].'</option>';
                        }
                    }
                    else if(isset($_POST['id']))
                    {
                        if($_POST['id'] == $value['NO_KEL'])
                        {
                            $option .= '<option selected value="'.$value['NO_KEL'].'">'.$value['NAMA_KEL'].'</option>';
                        }else{
                            $option .= '<option value="'.$value['NO_KEL'].'">'.$value['NAMA_KEL'].'</option>';
                        }
                    } 
                    else{
                        $option .= '<option value="'.$value['NO_KEL'].'">'.$value['NAMA_KEL'].'</option>';
                    }
                }
                echo $option;
            break;
            case 'data_kode_pos':
                $no_prop = $this->input->post('no_prop',true);
                $no_kab = $this->input->post('no_kab',true);
                $no_kec = $this->input->post('no_kec',true);
                $no_kel = $this->input->post('no_kel',true);

                $query['select']    = 'kode_pos';
                $query['table']     = 'm_kode_pos';
                $query['where']     = 'id_provinsi = '.(int)$no_prop.' AND id_kabkota = '.(int)$no_kab.' AND id_kecamatan = '.(int)$no_kec.' AND id_kelurahan = '.(int)$no_kel ;
                $result = $this->query_model->getRow($query);
                echo json_encode($result);
            break;
            case 'tambah_izin_usaha':
                $this->data = array(
                    'no'    => $this->input->post('count'),
                    'data'  => $this->input->post('data')
                );
                $this->load->view('customer/umkm/tambah_izin_usaha',$this->data);
            break;
            case 'detail_rekap_umkm':
                if ($this->input->post('sumber')) {
                    $sumber = $this->input->post('sumber',true);
                }else{
                    $sumber = null;
                }
                $data = $this->model_dashboard->detail_rekap_umkm($sumber);
                echo json_encode(array('status' => true, 'data' => $data));
            break;
            case 'detail_rekap_produk_by_status':
                $data = $this->model_dashboard->detail_rekap_produk_by_status();
                echo json_encode(array('status' => true, 'data' => $data));
            break;
            case 'detail_rekap_produk_by_kategori':
                $data_by_kategori = $this->model_dashboard->detail_rekap_produk_by_kategori();
                $kategori = $this->query_model->getKategori();
                $jum_kat = count($kategori);
                $split = ($jum_kat / 3) + 1;

                $arr_kat = array_chunk($kategori,(int)$split);

                $html = '';
                foreach ($arr_kat as $k) {
                    $html .= '<div class="col-md-4">
                            <div class="list-group">';
                    foreach ($k as $val) {
                        $jum = 0;
                        foreach ($data_by_kategori as $kat) {
                            if ($kat->id_jenis_usaha == $val->id_jenis_usaha) {
                                $jum = $kat->jum;
                            }
                        }
                        $html .= '<a href="javascript:void(0);" onclick="list_produk('.$val->id_jenis_usaha.',`'.$val->nama_usaha.'`)" class="list-group-item list-group-item-action">
                                    '.$val->nama_usaha.'
                                    <span class="badge badge-danger badge-pill jum_kategori_'.$val->id_jenis_usaha.'" style="float:right;">'.$jum.'</span>
                                </a>';
                        
                    }
                    $html .= '</div>
                            </div>';
                }
                
                echo $html;
            break;
            case 'detail_rekap_transaksi':
                $data = $this->model_dashboard->detail_rekap_transaksi();

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "https://service-tlive.tangerangkota.go.id/services/eorder/home/get_rekap_transaksi");
                curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0");
                curl_setopt($ch, CURLOPT_POST, 1);
                $query_data = [];
                $query_data['id_umkm'] = $this->session->umkm_id;
                if (isset($this->input->post('filter')['status']))
                    $query_data['status'] = $this->input->post('filter')['status'];
                $postfields = http_build_query($query_data);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_USERPWD, "r35t4p12:8540c5ef27b4afdb197405dc551ce5b5bfcb73bb2");
                $result = curl_exec($ch);
                $countingeorder = json_decode($result);
                if ($countingeorder->success)
                    $data = (object) array_merge((array) $data, (array) $countingeorder->data);

                echo json_encode(array('status' => true, 'data' => $data));
            break;
			case 'data_ecommerce':
                $query['select']    = 'situs_web,sosmed';
                $query['table']     = 'm_umkm';
                $query['where']     = 'id_umkm = "'.(int)$this->input->post('id_umkm',true).'"';  
                $result = $this->query_model->getRow($query);

                $form = '';
                if (isJSON($result->situs_web)) {
                    $array_web = json_decode($result->situs_web);
                    $lastElement = end($array_web);
                    foreach ($array_web as $key => $row) {
                        $form .= '<div class="position-relative row form-group">
                                    <label class="col-sm-3 col-form-label" style="font-weight:600">'.$row->nama_ecommerce.'</label>
                                    <input type="hidden" name="nama_ecommerce[]" value="'.$row->nama_ecommerce.'" id="'.$row->nama_ecommerce.'">
                                    <div class="col-lg-9">
                                        <input type="text" name="link_produk[]" class="form-control" id="link_'.$row->nama_ecommerce.'" placeholder="Link Produk" value="">
                                        <span class="help-block"></span>
                                    </div>
                                </div>';
                        if ($row == $lastElement) {
                            $form .= '<hr>';
                        }
                    }
                }

                if (isJSON($result->sosmed)) {
                    $array_sosmed = json_decode($result->sosmed);
                    $lastElement = end($array_sosmed);
                    foreach ($array_sosmed as $row) {
                        $form .= '<div class="position-relative row form-group">
                                    <label class="col-sm-3 col-form-label" style="font-weight:600">'.$row->nama_medsos.'</label>
                                    <input type="hidden" name="nama_medsos[]" value="'.$row->nama_medsos.'" id="'.$row->nama_medsos.'">
                                    <div class="col-lg-9">
                                        <input type="text" name="link_produk_medsos[]" class="form-control" id="link_'.$row->nama_medsos.'" placeholder="Link Produk" value="">
                                        <span class="help-block"></span>
                                    </div>
                                </div>';
                        if ($row == $lastElement) {
                            $form .= '<hr>';
                        }
                    }
                }
                echo $form;
            break;
            case 'master_bank':
                $json_url = 'https://service-tlive.tangerangkota.go.id/services/tlive/sigacor/get_bank';
                $useragent = 'Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0';
                $ch = curl_init( $json_url );
                curl_setopt($ch, CURLOPT_USERAGENT, $useragent );
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS,"a=1");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_USERPWD, SERV_U . ':' . SERV_P);
                $result = json_decode(curl_exec($ch),true);
                $option = '<option value="0">-- DATA BANK --</option>';
                if ($result['success']) {
                    foreach ($result['data'] as $row) {
                        if ($this->input->post('id_bank')) {
                            if ($this->input->post('id_bank') == $row['id_bank']) {
                                $selected = 'selected';
                            }else{
                                $selected = '';
                            }

                            $option .= '<option value="'.$row['id_bank'].'#'.$row['kode_bank'].'#'.$row['nama_bank'].'" '.$selected.'>'.$row['nama_bank'].' ( '.$row['kode_bank'].' )</option>';
                        }else{
                            $option .= '<option value="'.$row['id_bank'].'#'.$row['kode_bank'].'#'.$row['nama_bank'].'">'.$row['nama_bank'].' ( '.$row['kode_bank'].' )</option>';
                        }
                        
                    }
                }
                echo $option;
            break;
            case 'cek_status_verif_umkm':
                $id_umkm = $this->input->post('id_umkm',true);
                $query['select']    = 'id_status';
                $query['table']     = 'm_umkm';
                $query['where']     = 'id_umkm = "'.(int)$id_umkm.'"';  
                $result = $this->query_model->getRow($query);
                $message = '';
                if ($result->id_status != 1) {
                    $query2['select']    = 'count(id_produk) as jum_produk';
                    $query2['table']     = 'm_produk';
                    $query2['where']     = 'id_umkm = "'.(int)$id_umkm.'"';  
                    $result2 = $this->query_model->getRow($query2);
                    $sisa = 10-$result2->jum_produk;
                    $message = '<strong>Peringatan !</strong> <br> 
                                UMKM yang Anda pilih belum terverifikasi, Anda hanya bisa menambahkan maksimal 10 produk. <br>
                                Produk yang sudah anda tambahkan sebanyak <b>'.$result2->jum_produk.' produk </b>. Anda bisa menambahkan <b>'.$sisa.' produk</b> lagi. <br>
                                Jika status verifikasi di tolak oleh admin maka produk yang sudah Anda tambahkan akan di nonaktifkan / unpublish.';
                }

                echo json_encode(array('status_verif' => $result->id_status,'message' => $message));
            break;
            case 'detail_umkm_sidata':
                $nik = $this->input->post('nik',true);
                if (!is_numeric($nik)) {
                    $dt['status'] = false;
                    $dt['message'] = 'NIK tidak valid';
                }else{
                    $query['select']    = '*';
                    $query['table']     = 't_data_umkm';
                    $query['where']     = 'nik = "'.$nik.'" AND statusdidata = 1';  
                    $result = $this->query_model->getRow($query);
                    if ($result) {
                        $dt['status'] = true;
                        $dt['message'] = 'Data ditemukan';
                        $dt['data'] = $result;
                    }else{
                        $dt['status'] = false;
                        $dt['message'] = 'Data tidak ditemukan';
                    }
                }

                echo json_encode($dt);
            break;
            case 'count_umkm_pendataan':
                $useragent = 'Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0';
                $json_url = URL_SERV_TLIVE_UMKM.'/dashboard/countumkm';
                $ch = curl_init( $json_url );
                curl_setopt($ch, CURLOPT_USERAGENT, $useragent );
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_USERPWD, SERV_U . ':' . SERV_P);
                $result = json_decode(curl_exec($ch),true);
                if ($result['success']) {
                    $data['success'] = true;
                    $data['data'] = $result['data'];
                }else{
                    $data['success'] = false;
                }
                echo json_encode($data);  
            break;
            case 'rekap_umkm_pendataan_by_jenis':
                $useragent = 'Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0';
                $json_url = URL_SERV_TLIVE_UMKM.'/dashboard/countumkmbyjenis';
                $ch = curl_init( $json_url );
                curl_setopt($ch, CURLOPT_USERAGENT, $useragent );
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_USERPWD, SERV_U . ':' . SERV_P);
                $result = json_decode(curl_exec($ch),true);
                if ($result['success']) {
                    $list = '';
                    foreach ($result['data'] as $key => $r) {
                        $list .= '<tr>
                                    <td width="10%">'.$r['nama_kec'].'</td>
                                    <td align="center">
                                        <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-primary" onclick="list_umkm_pendataan('.$r['no_kec'].',`PKL`,`Laki-Laki`)">
                                            <i class="fas fa-mars"></i><br>
                                            '.rp($r['jum_l_pkl']).'
                                        </a>
                                        <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-primary" onclick="list_umkm_pendataan('.$r['no_kec'].',`PKL`,`Perempuan`)">
                                            <i class="fas fa-venus"></i><br>
                                            '.rp($r['jum_p_pkl']).'
                                        </a>
                                        <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-primary" onclick="list_umkm_pendataan('.$r['no_kec'].',`PKL`,`x`)">
                                            <i class="fas fa-times"></i><br>
                                            '.rp($r['jum_x_pkl']).'
                                        </a>
                                        <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-primary" onclick="list_umkm_pendataan('.$r['no_kec'].',`PKL`)">
                                            <i class="fas fa-users"></i><br>
                                            '.rp($r['jum_pkl']).'
                                        </a>
                                    </td>
                                    <td align="center">
                                        <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-primary" onclick="list_umkm_pendataan('.$r['no_kec'].',`UMKM`,`Laki-Laki`)">
                                            <i class="fas fa-mars"></i><br>
                                            '.rp($r['jum_l_ukm']).'
                                        </a>
                                        <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-primary" onclick="list_umkm_pendataan('.$r['no_kec'].',`UMKM`,`Perempuan`)">
                                            <i class="fas fa-venus"></i><br>
                                            '.rp($r['jum_p_ukm']).'
                                        </a>
                                        <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-primary" onclick="list_umkm_pendataan('.$r['no_kec'].',`UMKM`,`x`)">
                                            <i class="fas fa-times"></i><br>
                                            '.rp($r['jum_x_ukm']).'
                                        </a>
                                        <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-primary" onclick="list_umkm_pendataan('.$r['no_kec'].',`UMKM`)">
                                            <i class="fas fa-users"></i><br>
                                            '.rp($r['jum_ukm']).'
                                        </a>
                                    </td>
                                    <td align="center">
                                        <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-primary" onclick="list_umkm_pendataan('.$r['no_kec'].',`lain`,`Laki-Laki`)">
                                            <i class="fas fa-mars"></i><br>
                                            '.rp($r['jum_l_lain']).'
                                        </a>
                                        <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-primary" onclick="list_umkm_pendataan('.$r['no_kec'].',`lain`,`Perempuan`)">
                                            <i class="fas fa-venus"></i><br>
                                            '.rp($r['jum_p_lain']).'
                                        </a>
                                        <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-primary" onclick="list_umkm_pendataan('.$r['no_kec'].',`lain`,`x`)">
                                            <i class="fas fa-times"></i><br>
                                            '.rp($r['jum_x_lain']).'
                                        </a>
                                        <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-primary" onclick="list_umkm_pendataan('.$r['no_kec'].',`lain`)">
                                            <i class="fas fa-users"></i><br>
                                            '.rp($r['jum_lain']).'
                                        </a>
                                    </td>
                                    <td align="center">
                                        <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-warning" onclick="list_umkm_pendataan('.$r['no_kec'].',null,`Laki-Laki`)">
                                            <i class="fas fa-mars"></i><br>
                                            '.rp($r['jum_l']).'
                                        </a>
                                        <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-warning" onclick="list_umkm_pendataan('.$r['no_kec'].',null,`Perempuan`)">
                                            <i class="fas fa-venus"></i><br>
                                            '.rp($r['jum_p']).'
                                        </a>
                                        <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-warning" onclick="list_umkm_pendataan('.$r['no_kec'].',null,`x`)">
                                            <i class="fas fa-times"></i><br>
                                            '.rp($r['jum_x']).'
                                        </a>
                                        <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-warning" onclick="list_umkm_pendataan('.$r['no_kec'].')">
                                            <i class="fas fa-users"></i><br>
                                            '.rp($r['jum_kec']).'
                                        </a>
                                    </td>
                                </tr>';
                    }

                    $list .= '<tr>
                                <td align="center">Total</td>
                                <td  align="center">
                                    <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-warning" onclick="list_umkm_pendataan(null,`PKL`,`Laki-Laki`)">
                                        <i class="fas fa-mars"></i><br>
                                        '.rp($result['rekap']['tot_l_pkl']).'
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-warning" onclick="list_umkm_pendataan(null,`PKL`,`Perempuan`)">
                                        <i class="fas fa-venus"></i><br>
                                        '.rp($result['rekap']['tot_p_pkl']).'
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-warning" onclick="list_umkm_pendataan(null,`PKL`,`x`)">
                                        <i class="fas fa-times"></i><br>
                                        '.rp($result['rekap']['tot_x_pkl']).'
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-warning" onclick="list_umkm_pendataan(null,`PKL`)">
                                        <i class="fas fa-users"></i><br>
                                        '.rp($result['rekap']['tot_pkl']).'
                                    </a>
                                </td>
                                <td  align="center">
                                     <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-warning" onclick="list_umkm_pendataan(null,`UMKM`,`Laki-Laki`)">
                                        <i class="fas fa-mars"></i><br>
                                        '.rp($result['rekap']['tot_l_ukm']).'
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-warning" onclick="list_umkm_pendataan(null,`UMKM`,`Perempuan`)">
                                        <i class="fas fa-venus"></i><br>
                                        '.rp($result['rekap']['tot_p_ukm']).'
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-warning" onclick="list_umkm_pendataan(null,`UMKM`,`x`)">
                                        <i class="fas fa-times"></i><br>
                                        '.rp($result['rekap']['tot_x_ukm']).'
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-warning" onclick="list_umkm_pendataan(null,`UMKM`)">
                                        <i class="fas fa-users"></i><br>
                                        '.rp($result['rekap']['tot_ukm']).'
                                    </a>
                                </td>
                                <td  align="center">
                                    <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-warning" onclick="list_umkm_pendataan(null,`lain`,`Laki-Laki`)">
                                        <i class="fas fa-mars"></i><br>
                                        '.rp($result['rekap']['tot_l_lain']).'
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-warning" onclick="list_umkm_pendataan(null,`lain`,`Perempuan`)">
                                        <i class="fas fa-venus"></i><br>
                                        '.rp($result['rekap']['tot_p_lain']).'
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-warning" onclick="list_umkm_pendataan(null,`lain`,`x`)">
                                        <i class="fas fa-times"></i><br>
                                        '.rp($result['rekap']['tot_x_lain']).'
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-warning" onclick="list_umkm_pendataan(null,`lain`)">
                                        <i class="fas fa-users"></i><br>
                                        '.rp($result['rekap']['tot_lain']).'
                                    </a>
                                </td>
                                <td  align="center">
                                    <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-danger" onclick="list_umkm_pendataan(null,null,`Laki-Laki`)">
                                        <i class="fas fa-mars"></i><br>
                                        '.rp($result['rekap']['tot_l']).'
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-danger" onclick="list_umkm_pendataan(null,null,`Perempuan`)">
                                        <i class="fas fa-venus"></i><br>
                                        '.rp($result['rekap']['tot_p']).'
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-danger" onclick="list_umkm_pendataan(null,null,`x`)">
                                        <i class="fas fa-times"></i><br>
                                        '.rp($result['rekap']['tot_x']).'
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-danger" onclick="list_umkm_pendataan()">
                                        <i class="fas fa-users"></i><br>
                                        '.rp($result['rekap']['tot']).'
                                    </a>
                                </td>
                            </tr>';

                    $data['success'] = true;
                    $data['data'] = $list;
                }else{
                    $data['success'] = false;
                }
                echo json_encode($data);  
            break;
            case 'rekap_umkm_pendataan_by_umur':
                $useragent = 'Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0';
                $json_url = URL_SERV_TLIVE_UMKM.'/dashboard/countumkmbyumur';
                $ch = curl_init( $json_url );
                curl_setopt($ch, CURLOPT_USERAGENT, $useragent );
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_USERPWD, SERV_U . ':' . SERV_P);
                $result = json_decode(curl_exec($ch),true);
                if ($result['success']) {
                    $list = '';
                    foreach ($result['data'] as $key => $r) {

                        $list .= '<tr style="font-size:10px;">
                                    <td width="5%">'.$r['nama_kec'].'</td>
                                    <td align="center">
                                        <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-primary" onclick="list_umkm_pendataan('.$r['no_kec'].',null,`Laki-Laki`,`1_15`)">
                                            <i class="fas fa-mars"></i><br>
                                            '.rp($r['jum_l_1_15']).'
                                        </a>
                                        <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-primary" onclick="list_umkm_pendataan('.$r['no_kec'].',null,`Perempuan`,`1_15`)">
                                            <i class="fas fa-venus"></i><br>
                                            '.rp($r['jum_p_1_15']).'
                                        </a>
                                        <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-primary" onclick="list_umkm_pendataan('.$r['no_kec'].',null,`x`,`1_15`)">
                                            <i class="fas fa-times"></i><br>
                                            '.rp($r['jum_x_1_15']).'
                                        </a>
                                        <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-primary" onclick="list_umkm_pendataan('.$r['no_kec'].',null,null,`1_15`)">
                                            <i class="fas fa-users"></i><br>
                                            '.rp($r['jum_1_15']).'
                                        </a>
                                    </td>
                                    <td align="center">
                                        <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-primary" onclick="list_umkm_pendataan('.$r['no_kec'].',null,`Laki-Laki`,`16_30`)">
                                            <i class="fas fa-mars"></i><br>
                                            '.rp($r['jum_l_16_30']).'
                                        </a>
                                        <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-primary" onclick="list_umkm_pendataan('.$r['no_kec'].',null,`Perempuan`,`16_30`)">
                                            <i class="fas fa-venus"></i><br>
                                            '.rp($r['jum_p_16_30']).'
                                        </a>
                                        <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-primary" onclick="list_umkm_pendataan('.$r['no_kec'].',null,`x`,`16_30`)">
                                            <i class="fas fa-times"></i><br>
                                            '.rp($r['jum_x_16_30']).'
                                        </a>
                                        <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-primary" onclick="list_umkm_pendataan('.$r['no_kec'].',null,null,`16_30`)">
                                            <i class="fas fa-users"></i><br>
                                            '.rp($r['jum_16_30']).'
                                        </a>
                                    </td>
                                    <td align="center">
                                        <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-primary" onclick="list_umkm_pendataan('.$r['no_kec'].',null,`Laki-Laki`,`31_45`)">
                                            <i class="fas fa-mars"></i><br>
                                            '.rp($r['jum_l_31_45']).'
                                        </a>
                                        <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-primary" onclick="list_umkm_pendataan('.$r['no_kec'].',null,`Perempuan`,`31_45`)">
                                            <i class="fas fa-venus"></i><br>
                                            '.rp($r['jum_p_31_45']).'
                                        </a>
                                        <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-primary" onclick="list_umkm_pendataan('.$r['no_kec'].',null,`x`,`31_45`)">
                                            <i class="fas fa-times"></i><br>
                                            '.rp($r['jum_x_31_45']).'
                                        </a>
                                        <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-primary" onclick="list_umkm_pendataan('.$r['no_kec'].',null,null,`31_45`)">
                                            <i class="fas fa-users"></i><br>
                                            '.rp($r['jum_31_45']).'
                                        </a>
                                    </td>
                                    <td align="center">
                                        <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-primary" onclick="list_umkm_pendataan('.$r['no_kec'].',null,`Laki-Laki`,`46_60`)">
                                            <i class="fas fa-mars"></i><br>
                                            '.rp($r['jum_l_46_60']).'
                                        </a>
                                        <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-primary" onclick="list_umkm_pendataan('.$r['no_kec'].',null,`Perempuan`,`46_60`)">
                                            <i class="fas fa-venus"></i><br>
                                            '.rp($r['jum_p_46_60']).'
                                        </a>
                                        <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-primary" onclick="list_umkm_pendataan('.$r['no_kec'].',null,`x`,`46_60`)">
                                            <i class="fas fa-times"></i><br>
                                            '.rp($r['jum_x_46_60']).'
                                        </a>
                                        <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-primary" onclick="list_umkm_pendataan('.$r['no_kec'].',null,null,`46_60`)">
                                            <i class="fas fa-users"></i><br>
                                            '.rp($r['jum_46_60']).'
                                        </a>
                                    </td>
                                    <td align="center">
                                        <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-primary" onclick="list_umkm_pendataan('.$r['no_kec'].',null,`Laki-Laki`,`60`)">
                                            <i class="fas fa-mars"></i><br>
                                            '.rp($r['jum_l_60']).'
                                        </a>
                                        <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-primary" onclick="list_umkm_pendataan('.$r['no_kec'].',null,`Perempuan`,`60`)">
                                            <i class="fas fa-venus"></i><br>
                                            '.rp($r['jum_p_60']).'
                                        </a>
                                        <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-primary" onclick="list_umkm_pendataan('.$r['no_kec'].',null,`x`,`60`)">
                                            <i class="fas fa-times"></i><br>
                                            '.rp($r['jum_x_60']).'
                                        </a>
                                        <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-primary" onclick="list_umkm_pendataan('.$r['no_kec'].',null,null,`60`)">
                                            <i class="fas fa-users"></i><br>
                                            '.rp($r['jum_60']).'
                                        </a>
                                    </td>
                                    <td align="center">
                                        <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-primary" onclick="list_umkm_pendataan('.$r['no_kec'].',null,`Laki-Laki`,`lain`)">
                                            <i class="fas fa-mars"></i><br>
                                            '.rp($r['jum_l_lain']).'
                                        </a>
                                        <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-primary" onclick="list_umkm_pendataan('.$r['no_kec'].',null,`Perempuan`,`lain`)">
                                            <i class="fas fa-venus"></i><br>
                                            '.rp($r['jum_p_lain']).'
                                        </a>
                                        <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-primary" onclick="list_umkm_pendataan('.$r['no_kec'].',null,`x`,`lain`)">
                                            <i class="fas fa-times"></i><br>
                                            '.rp($r['jum_x_lain']).'
                                        </a>
                                        <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-primary" onclick="list_umkm_pendataan('.$r['no_kec'].',null,null,`lain`)">
                                            <i class="fas fa-users"></i><br>
                                            '.rp($r['jum_lain']).'
                                        </a>
                                    </td>
                                    <td align="center">
                                        <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-warning" onclick="list_umkm_pendataan('.$r['no_kec'].',null,`Laki-Laki`)">
                                            <i class="fas fa-mars"></i><br>
                                            '.rp($r['jum_l']).'
                                        </a>
                                        <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-warning" onclick="list_umkm_pendataan('.$r['no_kec'].',null,`Perempuan`)">
                                            <i class="fas fa-venus"></i><br>
                                            '.rp($r['jum_p']).'
                                        </a>
                                        <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-warning" onclick="list_umkm_pendataan('.$r['no_kec'].',null,`x`)">
                                            <i class="fas fa-times"></i><br>
                                            '.rp($r['jum_x']).'
                                        </a>
                                        <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-warning" onclick="list_umkm_pendataan('.$r['no_kec'].')">
                                            <i class="fas fa-users"></i><br>
                                            '.rp($r['jum_kec']).'
                                        </a>
                                    </td>
                                </tr>';
                    }

                    $list .= '<tr>
                                <td align="center">Total</td>
                                <td  align="center">
                                    <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-warning" onclick="list_umkm_pendataan(null,null,`Laki-Laki`,`1_15`)">
                                        <i class="fas fa-mars"></i><br>
                                        '.rp($result['rekap']['tot_l_1_15']).'
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-warning" onclick="list_umkm_pendataan(null,null,`Perempuan`,`1_15`)">
                                        <i class="fas fa-venus"></i><br>
                                        '.rp($result['rekap']['tot_p_1_15']).'
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-warning" onclick="list_umkm_pendataan(null,null,`x`,`1_15`)">
                                        <i class="fas fa-times"></i><br>
                                        '.rp($result['rekap']['tot_x_1_15']).'
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-warning" onclick="list_umkm_pendataan(null,null,null,`1_15`)">
                                        <i class="fas fa-users"></i><br>
                                        '.rp($result['rekap']['tot_1_15']).'
                                    </a>
                                </td>
                                <td  align="center">
                                     <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-warning" onclick="list_umkm_pendataan(null,null,`Laki-Laki`,`16_30`)">
                                        <i class="fas fa-mars"></i><br>
                                        '.rp($result['rekap']['tot_l_16_30']).'
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-warning" onclick="list_umkm_pendataan(null,null,`Perempuan`,`16_30`)">
                                        <i class="fas fa-venus"></i><br>
                                        '.rp($result['rekap']['tot_p_16_30']).'
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-warning" onclick="list_umkm_pendataan(null,null,`x`,`16_30`)">
                                        <i class="fas fa-times"></i><br>
                                        '.rp($result['rekap']['tot_x_16_30']).'
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-warning" onclick="list_umkm_pendataan(null,null,null,`16_30`)">
                                        <i class="fas fa-users"></i><br>
                                        '.rp($result['rekap']['tot_16_30']).'
                                    </a>
                                </td>
                                <td  align="center">
                                     <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-warning" onclick="list_umkm_pendataan(null,null,`Laki-Laki`,`31_45`)">
                                        <i class="fas fa-mars"></i><br>
                                        '.rp($result['rekap']['tot_l_31_45']).'
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-warning" onclick="list_umkm_pendataan(null,null,`Perempuan`,`31_45`)">
                                        <i class="fas fa-venus"></i><br>
                                        '.rp($result['rekap']['tot_p_31_45']).'
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-warning" onclick="list_umkm_pendataan(null,null,`x`,`31_45`)">
                                        <i class="fas fa-times"></i><br>
                                        '.rp($result['rekap']['tot_x_31_45']).'
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-warning" onclick="list_umkm_pendataan(null,null,null,`31_45`)">
                                        <i class="fas fa-users"></i><br>
                                        '.rp($result['rekap']['tot_31_45']).'
                                    </a>
                                </td>
                                <td  align="center">
                                     <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-warning" onclick="list_umkm_pendataan(null,null,`Laki-Laki`,`46_60`)">
                                        <i class="fas fa-mars"></i><br>
                                        '.rp($result['rekap']['tot_l_46_60']).'
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-warning" onclick="list_umkm_pendataan(null,null,`Perempuan`,`46_60`)">
                                        <i class="fas fa-venus"></i><br>
                                        '.rp($result['rekap']['tot_p_46_60']).'
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-warning" onclick="list_umkm_pendataan(null,null,`x`,`46_60`)">
                                        <i class="fas fa-times"></i><br>
                                        '.rp($result['rekap']['tot_x_46_60']).'
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-warning" onclick="list_umkm_pendataan(null,null,null,`46_60`)">
                                        <i class="fas fa-users"></i><br>
                                        '.rp($result['rekap']['tot_46_60']).'
                                    </a>
                                </td>
                                <td  align="center">
                                     <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-warning" onclick="list_umkm_pendataan(null,null,`Laki-Laki`,`60`)">
                                        <i class="fas fa-mars"></i><br>
                                        '.rp($result['rekap']['tot_l_60']).'
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-warning" onclick="list_umkm_pendataan(null,null,`Perempuan`,`60`)">
                                        <i class="fas fa-venus"></i><br>
                                        '.rp($result['rekap']['tot_p_60']).'
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-warning" onclick="list_umkm_pendataan(null,null,`x`,`60`)">
                                        <i class="fas fa-times"></i><br>
                                        '.rp($result['rekap']['tot_x_60']).'
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-warning" onclick="list_umkm_pendataan(null,null,null,`60`)">
                                        <i class="fas fa-users"></i><br>
                                        '.rp($result['rekap']['tot_60']).'
                                    </a>
                                </td>
                                <td  align="center">
                                    <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-warning" onclick="list_umkm_pendataan(null,null,`Laki-Laki`,`lain`)">
                                        <i class="fas fa-mars"></i><br>
                                        '.rp($result['rekap']['tot_l_lain']).'
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-warning" onclick="list_umkm_pendataan(null,null,`Perempuan`,`lain`)">
                                        <i class="fas fa-venus"></i><br>
                                        '.rp($result['rekap']['tot_p_lain']).'
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-warning" onclick="list_umkm_pendataan(null,null,`x`,`lain`)">
                                        <i class="fas fa-times"></i><br>
                                        '.rp($result['rekap']['tot_x_lain']).'
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-warning" onclick="list_umkm_pendataan(null,null,null,`lain`)">
                                        <i class="fas fa-users"></i><br>
                                        '.rp($result['rekap']['tot_lain']).'
                                    </a>
                                </td>
                                <td  align="center">
                                    <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-danger" onclick="list_umkm_pendataan(null,null,`Laki-Laki`)">
                                        <i class="fas fa-mars"></i><br>
                                        '.rp($result['rekap']['tot_l']).'
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-danger" onclick="list_umkm_pendataan(null,null,`Perempuan`)">
                                        <i class="fas fa-venus"></i><br>
                                        '.rp($result['rekap']['tot_p']).'
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-danger" onclick="list_umkm_pendataan(null,null,`x`)">
                                        <i class="fas fa-times"></i><br>
                                        '.rp($result['rekap']['tot_x']).'
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-danger" onclick="list_umkm_pendataan()">
                                        <i class="fas fa-users"></i><br>
                                        '.rp($result['rekap']['tot']).'
                                    </a>
                                </td>
                            </tr>';

                    $data['success'] = true;
                    $data['data'] = $list;
                }else{
                    $data['success'] = false;
                }
                echo json_encode($data); 
            break;
            case 'rekap_umkm_pendataan_by_jenis_usaha':
                $useragent = 'Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0';
                $json_url = URL_SERV_TLIVE_UMKM.'/dashboard/countumkmbyjenisusaha';
                $ch = curl_init( $json_url );
                curl_setopt($ch, CURLOPT_USERAGENT, $useragent );
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_USERPWD, SERV_U . ':' . SERV_P);
                $result = json_decode(curl_exec($ch),true);
                if ($result['success']) {
                    $list = '<table class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Kecamatan</th>';
                                        foreach ($result['data']['m_jenis_usaha'] as $key => $j) {
                                            $tot[$j['id_jenis_usaha']] =  $tot_l[$j['id_jenis_usaha']] =  $tot_p[$j['id_jenis_usaha']] = $tot_x[$j['id_jenis_usaha']] = 0;
                                            $list .= '<th style="min-width:150px;">'.strtoupper($j['nama_usaha']).'</th>';
                                        }
                    $list .=            '<th style="min-width:150px;">Jumlah</th>
                                    </tr>
                                <thead>
                                <tbody>';
                                $tot_l_all = $tot_p_all = $tot_x_all = $tot_all = 0;
                                foreach ($result['data']['rekap'] as $k => $r) {
                                    $jum_kec = $jum_l = $jum_p = $jum_x = 0;

                                    $list .= '<tr>
                                                  <td>'.$r['nama_kec'].'</td>';
                                                  foreach ($result['data']['m_jenis_usaha'] as $i => $j) {
                                                    $jum[$j['id_jenis_usaha']] = $r['jum_l_'.$j['id_jenis_usaha']] + $r['jum_p_'.$j['id_jenis_usaha']] + $r['jum_x_'.$j['id_jenis_usaha']];

                                                      $list .= '<td>
                                                                    <a href="javascript:void(0);" onclick="list_umkm_pendataan('.$r['no_kec'].',null,`Laki-Laki`,null,'.$j['id_jenis_usaha'].')"><span><i class="fas fa-mars"></i> : '.rp($r['jum_l_'.$j['id_jenis_usaha']]).'</a></span><br>
                                                                    <a href="javascript:void(0);" onclick="list_umkm_pendataan('.$r['no_kec'].',null,`Perempuan`,null,'.$j['id_jenis_usaha'].')"><span><i class="fas fa-venus"></i> : '.rp($r['jum_p_'.$j['id_jenis_usaha']]).'</a></span><br>
                                                                    <a href="javascript:void(0);" onclick="list_umkm_pendataan('.$r['no_kec'].',null,`x`,null,'.$j['id_jenis_usaha'].')"><span><i class="fas fa-times"></i> : '.rp($r['jum_x_'.$j['id_jenis_usaha']]).'</span></a><br>
                                                                    <a href="javascript:void(0);" onclick="list_umkm_pendataan('.$r['no_kec'].',null,null,null,'.$j['id_jenis_usaha'].')"><span><i class="fas fa-users"></i> : '.rp($jum[$j['id_jenis_usaha']]).'</span></a><br>
                                                                </td>';
                                                    $jum_l = $jum_l + $r['jum_l_'.$j['id_jenis_usaha']];
                                                    $jum_p = $jum_p + $r['jum_p_'.$j['id_jenis_usaha']];
                                                    $jum_x = $jum_x + $r['jum_x_'.$j['id_jenis_usaha']];
                                                    $jum_kec = $jum_kec + $jum[$j['id_jenis_usaha']];

                                                    $tot_l[$j['id_jenis_usaha']] =  $tot_l[$j['id_jenis_usaha']] + $r['jum_l_'.$j['id_jenis_usaha']];
                                                    $tot_p[$j['id_jenis_usaha']] =  $tot_p[$j['id_jenis_usaha']] + $r['jum_p_'.$j['id_jenis_usaha']];
                                                    $tot_x[$j['id_jenis_usaha']] =  $tot_x[$j['id_jenis_usaha']] + $r['jum_x_'.$j['id_jenis_usaha']];
                                                    $tot[$j['id_jenis_usaha']] =  $tot[$j['id_jenis_usaha']] + $jum[$j['id_jenis_usaha']];
                                                  }
                                    $list .=      '<td>
                                                        <a href="javascript:void(0);" onclick="list_umkm_pendataan('.$r['no_kec'].',null,`Laki-Laki`)"><span><i class="fas fa-mars"></i> : '.rp($jum_l).'</span></a><br>
                                                        <a href="javascript:void(0);" onclick="list_umkm_pendataan('.$r['no_kec'].',null,`Perempuan`)"><span><i class="fas fa-venus"></i> : '.rp($jum_p).'</span></a><br>
                                                        <a href="javascript:void(0);" onclick="list_umkm_pendataan('.$r['no_kec'].',null,`x`)"><span><i class="fas fa-times"></i> : '.rp($jum_x).'</span></a><br>
                                                        <a href="javascript:void(0);" onclick="list_umkm_pendataan('.$r['no_kec'].')"><span><i class="fas fa-users"></i> : '.rp($jum_kec).'</span></a><br>
                                                  </td>
                                              </tr>';
                                    $tot_l_all = $tot_l_all + $jum_l;
                                    $tot_p_all = $tot_p_all + $jum_p;
                                    $tot_x_all = $tot_x_all + $jum_x;
                                    $tot_all = $tot_all + $jum_kec;
                                }
                    $list .=    '<tbody>
                                 <tfoot>
                                        <tr>
                                            <td align="center">TOTAL</td>';
                                            foreach ($result['data']['m_jenis_usaha'] as $i => $j) {
                                                $list .= '<td>
                                                            <a href="javascript:void(0);" onclick="list_umkm_pendataan(null,null,`Laki-Laki`,null,'.$j['id_jenis_usaha'].')"><span><i class="fas fa-mars"></i> : '.rp($tot_l[$j['id_jenis_usaha']]).'</span></a><br>
                                                            <a href="javascript:void(0);" onclick="list_umkm_pendataan(null,null,`Perempuan`,null,'.$j['id_jenis_usaha'].')"><span><i class="fas fa-venus"></i> : '.rp($tot_p[$j['id_jenis_usaha']]).'</span></a><br>
                                                            <a href="javascript:void(0);" onclick="list_umkm_pendataan(null,null,`x`,null,'.$j['id_jenis_usaha'].')"><span><i class="fas fa-times"></i> : '.rp($tot_x[$j['id_jenis_usaha']]).'</span></a><br>
                                                            <a href="javascript:void(0);" onclick="list_umkm_pendataan(null,null,null,null,'.$j['id_jenis_usaha'].')"><span><i class="fas fa-users"></i> : '.rp($tot[$j['id_jenis_usaha']]).'</span></a><br>
                                                        </td>';
                                            }
                               $list .=     '<td>
                                                <a href="javascript:void(0);" onclick="list_umkm_pendataan(null,null,`Laki-Laki`)"><span><i class="fas fa-mars"></i> : '.rp($tot_l_all).'</span></a><br>
                                                <a href="javascript:void(0);" onclick="list_umkm_pendataan(null,null,`Perempuan`)"><span><i class="fas fa-venus"></i> : '.rp($tot_p_all).'</span></a><br>
                                                <a href="javascript:void(0);" onclick="list_umkm_pendataan(null,null,`x`)"><span><i class="fas fa-times"></i> : '.rp($tot_x_all).'</span></a><br>
                                                <a href="javascript:void(0);" onclick="list_umkm_pendataan()"><span><i class="fas fa-users"></i> : '.rp($tot_all).'</span></a><br>
                                            </td>
                                        </tr>
                                 </tfoot>
                            </table>';
                    $data['success'] = true;
                    $data['data'] = $list;
                }else{
                    $data['success'] = false;
                }
               
                echo json_encode($data); 
            break;
			default:
				# code...
				break;
		}
	}

	public function ajax_save(){
		$type = $this->input->post('type',true);
        switch ($type) {
            case 'data_pengguna':
                $this->_validate($type);
                // cek username
                $query['select']    = 'a.id_pengguna,a.username,a.status';
                $query['table']     = 'm_pengguna a';
                $query['where']     = 'a.username = '.$this->input->post('username',true);
                $cek                = $this->query_model->getRow($query);
                if ($cek) {
                    echo json_encode(['success' => false, 'message' => 'Data gagal ditambahkan, nik sudah terdaftar di sistem !','status' => TRUE]);
                    exit();
                }

                if($this->input->post('gender',true) == 'l'){
                    $gender = 'Laki-Laki';
                }else{
                    $gender = 'Perempuan';
                }

                $nip = $this->input->post('nip');
                $useragent = 'Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0';
                $json_url = 'https://opendatav2.tangerangkota.go.id/services/unor/get_unor_by_kode/kode_unor/'.substr($this->input->post('kode_unor',true), 0, 5);;
                $ch = curl_init( $json_url );
                curl_setopt($ch, CURLOPT_USERAGENT, $useragent );
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_USERPWD, REST_U . ':' . REST_P);
                $result = json_decode(curl_exec($ch),true);

                $data = array(
                    'id_group'      => $this->input->post('id_group',true),
                    'username'      => $this->input->post('username',true),
                    'nama'          => $this->input->post('nama_lengkap',true),
                    'jenis_kelamin' => $gender,
                    'tempat_lahir'  => $this->input->post('tmpt_lahir',true),
                    'tanggal_lahir' => $this->input->post('tgl_lahir',true),
                    'kode_unor'     => $this->input->post('kode_unor',true),
                    'instansi'      => $result['nama_unor'],
                    'jabatan'       => $this->input->post('jabatan',true),
                    'created_at'    => date('Y-m-d H:i:s'),
                    'status'        => 1
                );

                $insert = $this->query_model->insert('m_pengguna',$data);
                if (!$insert){
                    echo json_encode(['success' => false, 'message' => 'Data gagal ditambahkan','status' => TRUE]);
                }else {
                    echo json_encode(['success' => true, 'message' => 'Data Berhasil ditambahkan','status' => TRUE]);
                }
            break;
            case 'data_umkm':
                $this->_validate($type);
                $data = array(
                    'id_kategori'      => $this->input->post('id_kategori',true),
                    'id_pengguna'      => $this->input->post('id_pengguna',true),
                    'nama_perusahaan'  => $this->input->post('nama_perusahaan',true),
                    'nama_izin_usaha'   => $this->input->post('nama_izin_usaha',true),
                    'npwp'          => $this->input->post('npwp',true),
                    'tanggal_mulai_usaha' => $this->input->post('tanggal_mulai_usaha',true),
                    'kelurahan'     => get_kelurahan($this->input->post('id_kec',true),$this->input->post('id_kel',true)),
                    'kecamatan'     => get_kecamatan($this->input->post('id_kec',true)),
                    'alamat'        => $this->input->post('alamat',true),
                    'id_kel'        => $this->input->post('id_kel',true),
                    'id_kec'        => $this->input->post('id_kec',true),
                    'lat'           => $this->input->post('lat',true), 
                    'lng'           => $this->input->post('long',true),
                    'kode_pos'      => $this->input->post('kode_pos',true),
                    'no_hp'         => $this->input->post('no_hp',true),
                    'email'         => $this->input->post('email',true),
                    'website'       => $this->input->post('website',true),
                    'created_at'    => date('Y-m-d H:i:s'),
                    'verifikasi'    => 0,
                    'status'        => 1
                );

                $insert = $this->query_model->insert('m_umkm',$data);
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
            case 'data_pengguna':
                $data = array(
                    'id_group'      => $this->input->post('id_group',true),
                    'updated_at'    => date('Y-m-d H:i:s'),
                );

                $insert = $this->query_model->update('m_pengguna',array('id_pengguna' => $this->input->post('id',true)), $data);
                if (!$insert){
                    echo json_encode(['success' => false, 'message' => 'Data gagal diubah','status' => TRUE]);
                }else {
                    echo json_encode(['success' => true, 'message' => 'Data Berhasil diubah','status' => TRUE]);
                }
            break;
            case 'konfirmasi_umkm':
                $this->_validate($type);
                $data = array(
                    'id_status'         => $this->input->post('status',true),
                    'alasan'            => $this->input->post('alasan',true),
                    'id_verifikator'    => $this->session->user_id,
                );

                $insert = $this->query_model->update('m_umkm',array('id_umkm' => $this->input->post('id',true)), $data);

                if (!$insert){
                    echo json_encode(['success' => false, 'message' => 'Gagal menyimpan data verifikasi','status' => TRUE]);
                }else {
                    if($this->input->post('status') == 3){
                        //non aktifkan semua produk di umkm yg di non aktifkan
                        nonaktifkan_produk_by_umkm($this->input->post('id',true));
                        kirim_email_tolak($this->input->post('id',true));
                    }else if($this->input->post('status') == 1){
                        // $this->proses_amanbersama($this->input->post('id',true));
                        //aktifkan kembali semua produk pada umkm
                        aktifkan_produk_by_umkm($this->input->post('id',true));
                        kirim_email_terima($this->input->post('id',true));
                    }

                    echo json_encode(['success' => true, 'message' => 'Berhasil menyimpan data verifikasi','status' => TRUE]);
                }
            break;
        }
    }

    public function proses_amanbersama($id)
    {
       ;
        $query['select']    = 'a.*,b.username,b.nama,b.no_telp,c.*,d.*,e.nama_usaha';
        $query['table']     = 'm_umkm a';
        $query['join'][0]   = array('m_pengguna b','b.id_pengguna = a.id_pengguna','left');
        $query['join'][1]   = array('m_umkm_alamat c','c.id_umkm = a.id_umkm','left');
        $query['join'][2]   = array('m_umkm_berkas d','d.id_umkm = a.id_umkm','left');
        $query['join'][3]   = array('m_jenis_usaha e','a.id_jenis_usaha = e.id_jenis_usaha','left');
        $query['where']     = 'a.id_umkm = "'.(int)$id.'"';
        $data               = $this->query_model->getRow($query);

        $kode_verifikasi    = $this->query_model->cek_kodeverifikasi();
        $kode               = $this->query_model->cek_kodebarcode($data->username,$data->namausaha);

        $this->load->library('ciqrcode');
 
        $config['cacheable']    = true;
        $config['cachedir']     = realpath($_SERVER["DOCUMENT_ROOT"].'/assets/');
        $config['errorlog']     = realpath($_SERVER["DOCUMENT_ROOT"].'/assets/');
        $config['imagedir']     = 'assets/qrcode/';
        $config['quality']      = true;
        $config['size']         = '1024';
        $config['black']        = array(224,255,255);
        $config['white']        = array(70,130,180);
        $this->ciqrcode->initialize($config);
 
        $image_name=$kode.'.png';
        
        $url = base_url('toko/'.short($data->id_umkm).'/'.get_url($data->namausaha));

        $params['data'] = $kode;
        $params['level'] = 'H';
        $params['size'] = 10;
        $params['savename'] = $_SERVER["DOCUMENT_ROOT"].'/'.$config['imagedir'].$image_name;
        $this->ciqrcode->generate($params);
        
        $this->surat($kode,$kode_verifikasi,$data->namausaha);

        $pdf = $image_name;

        $array  = array(
                    'nama_toko'         => $data->namausaha,
                    'id_kategori'       => 2,
                    'no_hp'             => $data->no_telp,
                    'alamat'            => $data->alamat,
                    'kode'              => $kode,
                    'kode_verifikasi'   => $kode_verifikasi,
                    'barcode'           => $kode,
                    'pdf'               => base_url('assets/qrcode/'.$kode.'.pdf'),
                    'latitude'          => $data->lat,
                    'longitude'         => $data->long,
                    'created_at'        => date('Y-m-d H:i:s'),
                    'created_by'        => 1,
                    'is_verifikasi'     => 1,
                    'sumber'            => 'UMKM',
                    'url'               => $url,
                );
        $input = $this->query_model->insert_aman('m_penyedia',$array);

        $verifikasii = array(
                    'kode_verifikasi'   => $kode_verifikasi,
                    'kode'              => $kode,
                );

        $insert = $this->query_model->update('m_umkm',array('id_umkm' => $this->input->post('id')), $verifikasii);

        return $input;
    }

    private function surat($kode,$kode_verifikasi,$namausaha)
    {
        $this->data = array(
            'kode'              => $kode,
            'kode_verifikasi'   => $kode_verifikasi,
            'namausaha'         => $namausaha,
        );

        
        $html = $this->load->view('kode_barcode',$this->data,true);
        
        $this->load->library('Pdf');

        $this->pdf->set_paper("a5", 'portrait');
        $this->pdf->load_html($html);
        $this->pdf->render();
        //$this->pdf->stream('data.pdf', array('Attachment' => 0,'isRemoteEnabled' => true));
        $output =  $this->pdf->output();
        file_put_contents($_SERVER["DOCUMENT_ROOT"].'/assets/qrcode/'.$kode.'.pdf', $output);
        return true;
    }

	private function _validate($type){

        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        switch ($type) {
            case 'data_pengguna':
                if($this->input->post('username',true) == '')
                {
                    $data['inputerror'][] = 'username';
                    $data['error_string'][] = 'Username Tidak Boleh Kosong';
                    $data['status'] = FALSE;
                }

                if($this->input->post('nama_lengkap',true) == '')
                {
                    $data['inputerror'][] = 'nama_lengkap';
                    $data['error_string'][] = 'Nama Lengkap Tidak Boleh Kosong';
                    $data['status'] = FALSE;
                }

                if($this->input->post('jabatan',true) == '')
                {
                    $data['inputerror'][] = 'jabatan';
                    $data['error_string'][] = 'Jabatan Tidak Boleh Kosong';
                    $data['status'] = FALSE;
                }

                if($this->input->post('tmpt_lahir',true) == '')
                {
                    $data['inputerror'][] = 'tmpt_lahir';
                    $data['error_string'][] = 'Tempat Lahir Tidak Boleh Kosong';
                    $data['status'] = FALSE;
                }

                if($this->input->post('tgl_lahir',true) == '')
                {
                    $data['inputerror'][] = 'tgl_lahir';
                    $data['error_string'][] = 'Tanggal Lahir Tidak Boleh Kosong';
                    $data['status'] = FALSE;
                }

                if($this->input->post('id_group',true) == '')
                {
                    $data['inputerror'][] = 'grup';
                    $data['error_string'][] = 'Group Tidak Boleh Kosong';
                    $data['status'] = FALSE;
                }
               
                if($data['status'] === FALSE)
                {
                    echo json_encode($data);
                    exit();
                }
            break;
            case 'konfirmasi_umkm':
                if($this->input->post('status',true) == '3')
                {
                    if($this->input->post('alasan',true) == '')
                    {
                        $data['inputerror'][] = 'alasan';
                        $data['error_string'][] = 'Data Tidak Boleh Kosong';
                        $data['status'] = FALSE;
                    }
                }
                
                if($data['status'] === FALSE)
                {
                    echo json_encode($data);
                    exit();
                }
            break;
            case 'data_umkm':
                if($this->input->post('nama_perusahaan',true) == '')
                {
                    $data['inputerror'][] = 'nama_perusahaan';
                    $data['error_string'][] = 'Nama Perusahaan Tidak Boleh Kosong';
                    $data['status'] = FALSE;
                }

                if($this->input->post('nama_izin_usaha',true) == '')
                {
                    $data['inputerror'][] = 'nama_izin_usaha';
                    $data['error_string'][] = 'Nama Izin Usaha Tidak Boleh Kosong';
                    $data['status'] = FALSE;
                }

                if($this->input->post('npwp',true) == '')
                {
                    $data['inputerror'][] = 'npwp';
                    $data['error_string'][] = 'NPWP Tidak Boleh Kosong';
                    $data['status'] = FALSE;
                }

                if($this->input->post('no_hp',true) == '')
                {
                    $data['inputerror'][] = 'no_hp';
                    $data['error_string'][] = 'Nomor Tidak Boleh Kosong';
                    $data['status'] = FALSE;
                }

                if($this->input->post('email',true) == '')
                {
                    $data['inputerror'][] = 'email';
                    $data['error_string'][] = 'Alamat Email Tidak Boleh Kosong';
                    $data['status'] = FALSE;
                }else if(!filter_var($this->input->post('email'), FILTER_VALIDATE_EMAIL)){
                    $data['inputerror'][] = 'email';
                    $data['error_string'][] = 'Format Email Salah';
                    $data['status'] = FALSE;
               }

                if($this->input->post('id_kategori',true) == '0')
                {
                    $data['inputerror'][] = 'kategori';
                    $data['error_string'][] = 'Kategori Tidak Boleh Kosong';
                    $data['status'] = FALSE;
                }

                if($this->input->post('id_kec',true) == 0)
                {
                    $data['inputerror'][] = 'kecamatan';
                    $data['error_string'][] = 'Kecamatan Tidak Boleh Kosong';
                    $data['status'] = FALSE;
                }

                if($this->input->post('id_kel',true) == 0)
                {
                    $data['inputerror'][] = 'kelurahan';
                    $data['error_string'][] = 'Kelurahan Tidak Boleh Kosong';
                    $data['status'] = FALSE;
                }

                if($this->input->post('alamat',true) == '')
                {
                    $data['inputerror'][] = 'alamat';
                    $data['error_string'][] = 'Alamat Tidak Boleh Kosong';
                    $data['status'] = FALSE;
                }

                if($this->input->post('lat',true) == '' OR $this->input->post('long',true) == '')
                {
                    $data['inputerror'][] = 'alamat';
                    $data['error_string'][] = 'Titik Alamat Harus dipilih';
                    $data['status'] = FALSE;
                }

                if($this->input->post('kode_pos',true) == '')
                {
                    $data['inputerror'][] = 'kode_pos';
                    $data['error_string'][] = 'Kode Pos Tidak Boleh Kosong';
                    $data['status'] = FALSE;
                }

                if($this->input->post('id_pengguna',true) == '')
                {
                    $data['inputerror'][] = 'pengguna';
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

    public function nik($nik){
        $useragent = 'Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0';
        $json_url = 'https://service-tlive.tangerangkota.go.id/services/tlive/profil/user';
        $ch = curl_init( $json_url );
        curl_setopt($ch, CURLOPT_USERAGENT, $useragent );
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,"nik=".$nik);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, SERV_U . ':' . SERV_P);
        $result = json_decode(curl_exec($ch),true);
          

         if(!$result['success']){
            if($result['message'] == ''){
               $message = array(
                    'success'   => false,
                    'message'   => 'Data Tidak Ditemukan'
                );
                echo json_encode($message);
                exit(); 
            }
            
        }
        echo json_encode($result);
    }

    function ajax_list(){
        $type = $this->input->post('type');
        if ($type == 'umkm') {
            $list = $this->model_dashboard->get_datatables();
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $l) {
                $no++;
                $row = array();
                $row[] = $no;
                $row[] = $l->namausaha;
                $row[] = $l->nama_pemilik;
                $row[] = $l->nama_usaha;
                $row[] = $l->status;
                $row[] = strtoupper($l->sumber);
                if ($l->id_izin_usaha) {
                    $row[] = 'Punya';
                }else{
                    $row[] = 'Belum Punya';
                }

                //add html for action
                $row[] = '<a href="javascript:void(0);" onclick="lihat_data('.$l->id_umkm.')" title="Lihat Detail UMKM" class="btn btn-success"><i class="fa fa-eye"></i></a>';
                $data[] = $row;
            }
     
            $output = array("draw" => $_POST['draw'],
                            "recordsTotal" => $this->model_dashboard->count_all(),
                            "recordsFiltered" => $this->model_dashboard->count_filtered(),
                            "data" => $data,
                        );
            //output to json format
            echo json_encode($output);
        }else{
            $data   = array();
            $sort   = isset($_POST['columns'][$_POST['order'][0]['column']]['data']) ? strval($_POST['columns'][$_POST['order'][0]['column']]['data']) : 'nama';
            $order  = isset($_POST['order'][0]['dir']) ? strval($_POST['order'][0]['dir']) : 'asc';
            $no     = $this->input->post('start');

            switch ($type) {
                case 'transaksi':
                    $list = $this->m_table->get_datatables('data_penjualan',$sort,$order);
                    foreach ($list as $l) {
                        $data_pengguna = $this->get_pengguna_by_username($l->username);

                        if($data_pengguna==null){
                            $data_pengguna = $this->get_data_visitor($l->username);
                        }
                        $no++;
                        $l->no = $no;
                        $l->created_transaksi = indonesian_date($l->created_transaksi);
                        $l->nama = text($data_pengguna->nama);
                        $l->namausaha = text($l->namausaha);
                        $l->total = 'Rp. '.rp($l->total);
                        $l->aksi = '<button class="btn btn-sm btn-info" title="Detail Transaksi" onclick="detail_transaksi('.$l->id_transaksi.')"><i class="fa fa-fw fa-eye"></i></button>'; 
                        $data[] = $l;
                    }
                    $output = array(
                        "draw"              => $_POST['draw'],
                        "recordsTotal"      => $this->m_table->count_all('data_penjualan',$sort,$order),
                        "recordsFiltered"   => $this->m_table->count_filtered('data_penjualan',$sort,$order),
                        "data"              => $data,
                    );  
                    echo json_encode($output);  
                break;
                case 'transaksi_e':
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, "https://service-tlive.tangerangkota.go.id/services/eorder/home/get_transaksi");
                    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0");
                    curl_setopt($ch, CURLOPT_POST, 1);
                    $query_data = [];
                        $query_data['id_umkm'] = $this->session->umkm_id;
                    if (isset($this->input->post('filter')['status']))
                        $query_data['status'] = $this->input->post('filter')['status'];
                    if ($this->input->post('ket')=='Sedang Dikirim')
                        $query_data['status'] = 3;
                    if ($this->input->post('ket')=='Pembayaran & Selesai')
                        $query_data['status'] = 5;
                    $postfields = http_build_query($query_data);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_USERPWD, "r35t4p12:8540c5ef27b4afdb197405dc551ce5b5bfcb73bb2");
                    $result = curl_exec($ch);
                    $produkeroder = json_decode($result);
                    if ($produkeroder->success) {
                        foreach ($produkeroder->data as $pe) {
                            $no++;
                            $pe->no = $no;
                            $pe->no_invoice = '<a href="javascript:void(0);" onclick="show_invoice('.$pe->id_eorder.')">'.$pe->no_invoice.'</a>';
                            $pe->created_transaksi = indonesian_date($pe->tanggal_pemesanan);
                            $pe->nama = text($pe->pembeli);
                            $pe->namausaha = text($pe->penjual);
                            $pe->total = 'Rp. '.rp($pe->total_belanja);
                            switch ($pe->status_trx) {
                                case 1:
                                $pe->nama_status = 'Menunggu Konfirmasi';
                                $pe->aksi = '<button class="btn btn-sm btn-info mb-1" title="Lihat Pesanan" onclick="show_invoice('.$pe->id_eorder.')"><i class="fa fa-fw fa-receipt"></i></button><br><button class="btn btn-sm btn-success mx-1" title="Terima Pesanan e-Order" onclick="detail_transaksi_e('.$pe->id_eorder.',2)"><i class="fa fa-fw fa-check"></i></button><button class="btn btn-sm btn-danger mx-1" title="Tolak Pesanan e-Order" onclick="detail_transaksi_e('.$pe->id_eorder.',7)"><i class="fa fa-fw fa-times"></i></button>'; 
                                    break;
                                case 2:
                                $pe->nama_status = 'Pesanan Diproses';
                                $pe->aksi = '<button class="btn btn-sm btn-info mx-1" title="Lihat Pesanan" onclick="show_invoice('.$pe->id_eorder.')"><i class="fa fa-fw fa-receipt"></i></button><button onclick="detail_transaksi_e('.$pe->id_eorder.',3)" class="btn btn-sm btn-warning mx-1" title="Kirim Pesanan"><i class="fa fa-fw fa-truck"></i></button>'; 
                                    break;
                                case 3:
                                $pe->nama_status = 'Pesanan Dikirim';
                                $pe->aksi = '<button class="btn btn-sm btn-info mx-1" title="Lihat Pesanan" onclick="show_invoice('.$pe->id_eorder.')"><i class="fa fa-fw fa-receipt"></i></button><button class="btn btn-sm btn-secondary mx-1" title="Pesanan telah dikirim, menunggu pesanan diterima PPK"><i class="fa fa-fw fa-truck"></i></button>'; 
                                    break;
                                case 4:
                                $pe->nama_status = 'Pesanan Diterima';
                                $pe->aksi = '<button class="btn btn-sm btn-info mx-1" title="Lihat Pesanan" onclick="show_invoice('.$pe->id_eorder.')"><i class="fa fa-fw fa-receipt"></i></button><button class="btn btn-sm btn-success mx-1" title="Pesanan telah diterima, menunggu pembayaran dari Bendahara"><i class="fa fa-fw fa-handshake"></i></button>'; 
                                    break;
                                case 5:
                                $pe->nama_status = 'Pesanan Selesai';
                                $pe->aksi = '<button class="btn btn-sm btn-info mx-1" title="Lihat Pesanan" onclick="show_invoice('.$pe->id_eorder.')"><i class="fa fa-fw fa-receipt"></i></button><button class="btn btn-sm btn-secondary mx-1" title="Pesanan telah dibayar dan selesai"><i class="fa fa-fw fa-credit-card"></i></button>'; 
                                    break;
                                case 7:
                                $pe->nama_status = 'Pesanan Dibatalkan';
                                $pe->aksi = '<button class="btn btn-sm btn-info mx-1" title="Lihat Pesanan" onclick="show_invoice('.$pe->id_eorder.')"><i class="fa fa-fw fa-receipt"></i></button><button class="btn btn-sm btn-danger mx-1" title="Pesanan Dibatalkan"><i class="fa fa-fw fa-window-close"></i></button>'; 
                                    break;
                                default:
                                $pe->nama_status = '-';
                                $pe->aksi = ''; 
                                    break;
                            }
                            $data[] = $pe;
                        }
                    }

                    $output = array(
                        "draw"              => $_POST['draw'],
                        "recordsTotal"      => 0,//$this->m_table->count_all('data_penjualan',$sort,$order),
                        "recordsFiltered"   => 0,//$this->m_table->count_filtered('data_penjualan',$sort,$order),
                        "data"              => $data,
                        "debug" => $this->session->umkm_id,
                    );  
                    echo json_encode($output);  
                break;
                case 'produk':
                    $list = $this->m_table->get_datatables('data_produk',$sort,$order);
                    foreach ($list as $l) {
                        $no++;
                        $l->no = $no;
                        $l->namausaha = text($l->namausaha);
                        $l->nama_usaha = text($l->nama_usaha);
                        $l->harga = "Rp. ".rp($l->harga);
                        $l->stok = rp($l->stok);

                        $btn_edit = '';
                        if ($this->user_model->is_umkm_penjual()) {
                            if ($l->status != 3) {
                                $btn_edit = '<a href="javascript:void(0);" onclick="lihat_produk('.$l->id_produk.',`edit`)" title="Edit Produk" class="btn btn-primary"><i class="fa fa-pen"></i></a>';
                            }
                        }

                        if($l->status == 1){
                            $l->status = 'Aktif';
                        }elseif ($l->status == 3) {
                            $l->status = 'Dinonaktifkan '.(!empty($l->alasan)?'karena '.$l->alasan:'');
                        }else{
                            $l->status = 'Tidak Aktif';
                        }

                        // $l->aksi = '<a href="'.base_url('list-produk/produk/'.short($l->kode_produk)).'" target="_blank" title="Detail Produk" class="btn btn-success"><i class="fa fa-eye"></i></a>';
                        $l->aksi = '<a href="javascript:void(0);" onclick="lihat_produk('.$l->id_produk.',`detail`)" title="Detail Produk" class="btn btn-success"><i class="fa fa-eye"></i></a> '.$btn_edit;


                        $data[] = $l;
                    }
                    $output = array(
                                "draw"              => $_POST['draw'],
                                "recordsTotal"      => $this->m_table->count_all('data_produk',$sort,$order),
                                "recordsFiltered"   => $this->m_table->count_filtered('data_produk',$sort,$order),
                                "data"              => $data,
                            );  
                    echo json_encode($output); 
                break;

                case 'umkm_pendataan':
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, URL_SERV_TLIVE_UMKM."/dashboard/list_umkm_pendataan");
                    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0");
                    curl_setopt($ch, CURLOPT_POST, 1);
                    $query_data['limit'] = $_POST['length'];
                    $query_data['offset'] = $_POST['start'];
                    $query_data['search'] = $_POST['search']['value'];
                    $query_data['id_kecamatan'] = $_POST['filter']['id_kecamatan'];
                    $query_data['kategori_usaha'] = $_POST['filter']['kategori_usaha'];
                    $query_data['jeniskelamin'] = $_POST['filter']['jeniskelamin'];
                    $query_data['range_umur'] = $_POST['filter']['range_umur'];
                    $query_data['id_jenis_usaha'] = $_POST['filter']['id_jenis_usaha'];
                    if($_POST['order'][0]['column'] != 0){
                        $query_data['order'] = $order;
                        $query_data['sort'] = $sort;
                    }
                    
                    $postfields = http_build_query($query_data);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_USERPWD, SERV_U . ':' . SERV_P);
                    $result = json_decode(curl_exec($ch),true);
                    // var_dump($query_data); die();
                    if ($result['success']) {
                        $l = array();

                        foreach ($result['data'] as $key => $d) {
                            $no++;
                            $l['no'] = $no;
                            $l['nik'] = $d['nik'];
                            $l['nama'] = $d['nama'];

                            $jenis_usaha = $d['jenis_usaha'];
                            if ($d['id_jenis_usaha'] == 13) {
                                if ($d['jenis_usaha_lainnya']) {
                                    $jenis_usaha = $d['jenis_usaha'].' ('.$d['jenis_usaha_lainnya'].')';
                                }
                            }elseif ($d['id_jenis_usaha'] == null) {
                                $jenis_usaha = 'Lainnya ('.$d['jenis_usaha'].')';
                            }

                            $l['jenis_usaha'] = $jenis_usaha;
                            $l['alamat'] = $d['alamat'];
                            $l['no_rt'] = $d['no_rt'];
                            $l['no_rw'] = $d['no_rw'];
                            $l['kelurahan'] = $d['kelurahan'];
                            $l['kecamatan'] = $d['kecamatan'];
                            $l['jenis_pendataan'] = $d['jenis_pendataan'];
                            if ($d['latitude'] && $d['longitude']) {
                                $l['lokasi_usaha'] = '<a href="https://maps.google.com/?q='.$d['latitude'].','.$d['longitude'].'" target="_blank">Lihat Lokasi</a>';
                            }else{
                                $l['lokasi_usaha'] = '';
                            }
                            
                            $data[] = $l;
                        }

                        $output = array(
                                "draw"              => $_POST['draw'],
                                "recordsTotal"      => $result['count_all'],
                                "recordsFiltered"   => $result['count_filtered'],
                                "data"              => $data,
                            );  
                        echo json_encode($output); 
                    }
                break;
                case 'umkm_bpum':
                    if (!empty($_POST['param']['ket']))
                        $ket = $_POST['param']['ket'];
                    
                    $nik = $_POST['cari']['nik'];

                    // $no_kec = $_POST['where']['kecamatan'];
                    // $no_kel = $_POST['where']['kelurahan'];
                    
                     if (!empty($_POST['filter']['nik']))
                        $filter['nik'] = $_POST['filter']['nik'];
                    
                    if (!empty($_POST['filter']['nama_usaha']))
                        $filter['bidang_usaha'] = $_POST['filter']['bidang_usaha'];
                    
                    if (!empty($_POST['filter']['nama_pemilik']))
                        $filter['nama_pemilik'] = $_POST['filter']['nama_pemilik'];

                    if (!empty($_POST['filter']['alamat']))
                        $filter['alamat'] = $_POST['filter']['alamat'];

                    if (!empty($_POST['filter']['no_rw']))
                        $filter['no_rw'] = $_POST['filter']['no_rw'];

                    if (!empty($_POST['filter']['no_rt']))
                        $filter['no_rt'] = $_POST['filter']['no_rt'];
                    
                    $start  = isset($_POST['start']) ? intval($_POST['start']) : 1;
                    $length = isset($_POST['length']) ? intval($_POST['length']) : 10;
                    $sort   = isset($_POST['order']) ? $_POST['columns'][$_POST['order'][0]['column']]['data'] : null;
                    $order  = isset($_POST['order']) ? $_POST['order'][0]['dir'] : null;
                    $draw   = $_POST['draw'];
                    $filter = isset($_POST['filter']) ? $_POST['filter'] : null;
                    
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, "https://service-tlive.tangerangkota.go.id/services/daftarumkm/umkm/getDetailUmkmWebV2");
                    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0");
                    curl_setopt($ch, CURLOPT_POST, 1);
                    $query_data['start'] = $start;
                    $query_data['length'] = $length;
                    $query_data['sort'] = $sort;
                    $query_data['order'] = $order;
                    $query_data['draw'] = $draw;
                    $query_data['ket'] = $ket;
                    // $query_data['no_kec'] = $no_kec;
                    // $query_data['no_kel'] = $no_kel;
                    $query_data['nik'] = $nik;
                    $query_data['filter'] = $filter;
                    $postfields = http_build_query($query_data);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_USERPWD, SERV_U . ':' . SERV_P);
                    $dataUmkm = json_decode(curl_exec($ch),true);
                    
                    if (!$dataUmkm['success']) {
                        echo json_encode(array('status' => FALSE));
                        exit();
                    }
                    
                    $d = array();
                    foreach ($dataUmkm['data']['data'] as $key => $d) {
                        $foto_1 = str_replace('onclick="previewImage(this)"', '', $d['foto_1']);
                        $d['foto_1'] = '<a data-magnify="gallery" data-caption="Foto UMKM - '.$d['nama_pemilik'].' ('.$d['nik'].')" data-group="'.$d['id_umkm'].'" href="'.$d['url_foto_1'].'">'.$foto_1.'</a>';
                        $foto_2 = str_replace('onclick="previewImage(this)"', '', $d['foto_2']);
                        $d['foto_2'] = '<a data-magnify="gallery" data-caption="Foto UMKM - '.$d['nama_pemilik'].' ('.$d['nik'].')" data-group="'.$d['id_umkm'].'" href="'.$d['url_foto_2'].'">'.$foto_2.'</a>';
                        $foto_3 = str_replace('onclick="previewImage(this)"', '', $d['foto_3']);
                        $d['foto_3'] = '<a data-magnify="gallery" data-caption="Foto UMKM - '.$d['nama_pemilik'].' ('.$d['nik'].')" data-group="'.$d['id_umkm'].'" href="'.$d['url_foto_3'].'">'.$foto_3.'</a>';
                        $foto_4 = str_replace('onclick="previewImage(this)"', '', $d['foto_4']);
                        $d['foto_4'] = '<a data-magnify="gallery" data-caption="Foto UMKM - '.$d['nama_pemilik'].' ('.$d['nik'].')" data-group="'.$d['id_umkm'].'" href="'.$d['url_foto_4'].'">'.$foto_4.'</a>';
                        $foto_5 = str_replace('onclick="previewImage(this)"', '', $d['foto_5']);
                        $d['foto_5'] = '<a data-magnify="gallery" data-caption="Foto UMKM - '.$d['nama_pemilik'].' ('.$d['nik'].')" data-group="'.$d['id_umkm'].'" href="'.$d['url_foto_5'].'">'.$foto_5.'</a>';
                        $list[] = $d;
                    }

                    $data['draw'] = $dataUmkm['data']['draw'];
                    $data['recordsTotal'] = $dataUmkm['data']['recordsTotal'];
                    $data['recordsFiltered'] = $dataUmkm['data']['recordsFiltered'];
                    $data['data'] = $list;
                    
                    echo json_encode($data);
                break;

                case 'umkm_bsmum':
                    if (!empty($_POST['param']['ket']))
                        $ket = $_POST['param']['ket'];
                    
                    $nik    = $_POST['where']['nik'];
                    $no_kk  = $_POST['where']['no_kk'];
                    
                    $no_kec = '';
                    $no_kel = '';

                    if (!empty($_POST['filter']['nama']))
                        $filter['nama'] = $_POST['filter']['nama'];
                    
                    if (!empty($_POST['filter']['email']))
                        $filter['email'] = $_POST['filter']['email'];
                    
                    if (!empty($_POST['filter']['no_tlp']))
                        $filter['no_tlp'] = $_POST['filter']['no_tlp'];

                    if (!empty($_POST['filter']['bidang_usaha']))
                        $filter['bidang_usaha'] = $_POST['filter']['bidang_usaha'];

                    if (!empty($_POST['filter']['alamat_usaha']))
                        $filter['alamat_usaha'] = $_POST['filter']['alamat_usaha'];
                    
                    if (!empty($_POST['filter']['rw_usaha']))
                        $filter['rw_usaha'] = $_POST['filter']['rw_usaha'];
                    
                    if (!empty($_POST['filter']['rt_usaha']))
                        $filter['rt_usaha'] = $_POST['filter']['rt_usaha'];
                    
                    $start  = isset($_POST['start']) ? intval($_POST['start']) : 1;
                    $length = isset($_POST['length']) ? intval($_POST['length']) : 10;
                    $sort   = isset($_POST['order']) ? $_POST['columns'][$_POST['order'][0]['column']]['data'] : null;
                    $order  = isset($_POST['order']) ? $_POST['order'][0]['dir'] : null;
                    $draw   = $_POST['draw'];
                    $filter = isset($_POST['filter']) ? $_POST['filter'] : null;

                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, "https://service-tlive.tangerangkota.go.id/services/pendataan_bsmpum/bsmpum/getDetailBsmumWeb");
                    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0");
                    curl_setopt($ch, CURLOPT_POST, 1);
                    $query_data['start'] = $start;
                    $query_data['length'] = $length;
                    $query_data['sort'] = $sort;
                    $query_data['order'] = $order;
                    $query_data['draw'] = $draw;
                    $query_data['ket'] = @$ket;
                    $query_data['no_kec'] = $no_kec;
                    $query_data['no_kel'] = $no_kel;
                    $query_data['nik'] = $nik;
                    $query_data['no_kk'] = $no_kk;
                    $query_data['filter'] = $filter;
                    $postfields = http_build_query($query_data);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_USERPWD, SERV_U . ':' . SERV_P);
                    $dataBsmum = json_decode(curl_exec($ch),true);
                    
                    if (!$dataBsmum['success']) {
                        echo json_encode(array('status' => FALSE));
                        exit();
                    }
                    
                    $data = $dataBsmum['data'];
                    
                    echo json_encode($data);
                break;
                
                default:
                    # code...
                    break;
            }
        }
    }

    private function get_data_visitor($visitor_id){
        $query['select']    = 'a.*';
        $query['table']     = 'm_visitor_anon a';
        $query['where']     = 'a.visitor_id =  "'.$visitor_id.'"';
        $data               = $this->query_model->getRow($query);
        return $data;
    }

    private function get_pengguna_by_username($username){
        $query['select']    = 'a.*';
        $query['table']     = 'm_pengguna a';
        $query['where']     = 'a.username = "'.$username.'"';
        $data               = $this->query_model->getRow($query);
        return $data;
    }

}