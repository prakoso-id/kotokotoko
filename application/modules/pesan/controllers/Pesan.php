<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesan extends MY_Controller {

	public function __construct() {
		parent::__construct();
        if(!$this->user_model->is_login())
        {
            redirect(base_url());
        }
        $this->load->model('m_pesan');
	}

    private function _data(){
        $useragent = 'Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0';
        $json_url = URL_SERV_TLIVE_UMKM.'/loaddata/get_headerpesan';
        $ch = curl_init( $json_url );
        curl_setopt($ch, CURLOPT_USERAGENT, $useragent );
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,"username_penerima=".$this->session->identity);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, SERV_U . ':' . SERV_P);
        $pesan = json_decode(curl_exec($ch),true);
        return $pesan;
    }

	public function index(){
        $this->template->set_layout('templatesv2/frontend');
        $this->template->add_title_segment('Pesan');
        $this->template->add_css('assets/css/pesan.css');

        $k = keranjangku();
        $keranjang = $k['keranjang'];
        $jml_keranjang = $k['jml_keranjang'];
        $pesan = $this->_data();
        $this->data = array(
            'active'    => 'pesan',
            'name'      => $this->security->get_csrf_token_name(),
            'hash'      => $this->security->get_csrf_hash(),
            'kategori'  => $this->query_model->getKategori(),
            'keranjang' => $keranjang,
            'jml_keranjang' => $jml_keranjang,
            'pesan'         => $pesan,
            'title_beranda' => 'Pesan'
        );

		$this->template->render("index",$this->data);
	}
    public function penjual(){
        $this->template->set_layout('templatesv2/backend');
        $this->template->add_title_segment('Pesan');
        $this->template->add_css('assets/css/pesan.css');
        $pesan = $this->_data();
        $this->data = array(
            'active'    => 'pesan',
            'name'      => $this->security->get_csrf_token_name(),
            'hash'      => $this->security->get_csrf_hash(),
            'pesan'         => $pesan,
            'title_beranda' => 'Pesan'
        );

        $this->template->render("indexv2",$this->data);
    }

    public function detail_pesan()
    {
        $id = $this->input->post('id',true);
        $useragent = 'Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0';
        $json_url = URL_SERV_TLIVE_UMKM.'/loaddata/get_headerdetail';
        $ch = curl_init( $json_url );
        curl_setopt($ch, CURLOPT_USERAGENT, $useragent );
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,"id_group=".(int)$id."&username=".$this->session->identity);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, SERV_U . ':' . SERV_P);
        $pesan = json_decode(curl_exec($ch),true);
        // echo json_encode($pesan);
        // exit();
        $this->data = array(
            'pesan'     => $pesan,
            'id_group'  => $id,
            'nama'      => @$this->input->post('nama',true),
            'flag'      => @$this->input->post('flag',true)
        );
        $this->load->view('pesan/pesan',$this->data);
    }
}