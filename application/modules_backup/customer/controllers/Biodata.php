<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Biodata extends MY_Controller {

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
          $this->template->add_title_segment('Biodata');
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

          $query['select']    = '*';
          $query['table']     = 'm_pengguna';
          $query['where']     = 'username = '.$this->session->identity;
          $data               = $this->query_model->getRow($query);

          if($this->user_model->is_login()){
               $keranjang          = $this->query_model->keranjang('data');
               $jml_keranjang      = $this->query_model->keranjang('jumlah');
          }else{
               $keranjang = null;
               $jml_keranjang = 0;
          }

          $this->data = array(
               'active' => 'biodata',
               'data' => $data,
               'kategori' => $this->query_model->getKategori(),
               'name' => $this->security->get_csrf_token_name(),
               'hash' => $this->security->get_csrf_hash(),
               'keranjang' => $keranjang,
               'jml_keranjang' => $jml_keranjang,
               'title_beranda' => 'Biodata'
          );

          $this->template->render("biodata/index",$this->data);
     }

     public function ajax_ubah(){
          $type = $this->input->post('type');
          switch ($type) {
               case 'update_biodata':
               $nik = $this->session->identity;
               $useragent = 'Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0';
               $json_url = 'https://service-tlive.tangerangkota.go.id/services/tlive/profil/user';
               $ch = curl_init( $json_url );
               curl_setopt($ch, CURLOPT_USERAGENT, $useragent );
               curl_setopt($ch, CURLOPT_POST, 1);
               curl_setopt($ch, CURLOPT_POSTFIELDS,"nik=".$nik);
               curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
               curl_setopt($ch, CURLOPT_USERPWD, SERV_U . ':' . SERV_P);
               $result = json_decode(curl_exec($ch),true);

               $data = array(
                    'username'      => $result['result'][0]['nik'],
                    'nama'          => $result['result'][0]['nama'],
                    'jenis_kelamin' => $result['result'][0]['jenis_kelamin'],
                    'tempat_lahir'  => $result['result'][0]['tempat_lahir'],
                    'tanggal_lahir' => $result['result'][0]['tanggal_lahir'],
                    'alamat'        => $result['result'][0]['alamat'],
                    'email'         => $result['result'][0]['email'],
                    'domisili'      => $result['result'][0]['domisili'],
                    'no_telp'       => $result['result'][0]['no_telp'],
                    'updated_at'    => date('Y-m-d H:i:s'),
               );

               $insert = $this->query_model->update('m_pengguna',array('username' => $this->session->identity), $data);
               if (!$insert)
               {
                    echo json_encode(['success' => false, 'message' => 'Data Gagal Disinkron, Silahkan Ulangi Lagi','status' => TRUE]);
               }
               else 
               {
                    echo json_encode(['success' => true, 'message' => 'Data Berhasil Disinkron','status' => TRUE]);
               }
               break;
          }
     }

}