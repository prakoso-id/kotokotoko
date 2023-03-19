<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Umkm extends MY_Controller {

     public function __construct() {
          parent::__construct();
          $this->template->set_layout('templates/backend');
          $this->load->model('m_umkm');
          if(!$this->user_model->is_umkm_admin() AND !$this->user_model->is_umkm_verifikator())
          {
               redirect(base_url());
          }
     }

     public function index() {
          $this->template->add_title_segment('Data UMKM');
          $this->template->add_meta_tag("description", "Portal UMKM Kota Tangerang");
          $this->template->add_meta_tag("keywords", "umkm,portal umkm,kota tangerang,tangerang,portal");

          $this->template->add_css('assets/css/css_admin.css');
          // $this->template->add_css('assets/css.css');
          // $this->template->add_js('assets/js.js');
          $this->template->add_js('https://cdn.ckeditor.com/4.9.2/standard-all/ckeditor.js');
          $this->template->add_js('assets/ckfinder/ckfinder.js');
          $this->template->add_js('assets/plugins/tables/datatables/datatables.min.js');
          $this->template->add_js('assets/plugins/tables/datatables/extensions/fixed_columns.min.js');
          $this->template->add_js('assets/plugins/forms/selects/select2.min.js');
          $this->template->add_js('assets/plugins/notifications/sweet_alert.min.js');
          $this->template->add_js('assets/plugins/input-mask/jquery.inputmask.js');
          // $this->template->add_js('assets/.js');
          if($this->user_model->is_login())
          {
               $keranjang          = $this->query_model->keranjang('data');
               $jml_keranjang      = $this->query_model->keranjang('jumlah');
          }else{
               $keranjang = null;
               $jml_keranjang = 0;
          }

          $this->data = array(
               'kategori' => $this->query_model->getKategori(),
               'active'	=> 'umkm',
               'name'	=> $this->security->get_csrf_token_name(),
               'hash'	=> $this->security->get_csrf_hash(),
               'keranjang' => $keranjang,
               'jml_keranjang' => $jml_keranjang,
               'm_status' => $this->query_model->getmStatus(),
               'title_beranda' => 'Verifikasi UMKM'
          );

          $this->template->render("index",$this->data);
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
               $l->namausaha = text($l->namausaha);
               $l->nama_pemilik = text($l->nama_pemilik);

               if($l->id_status == 2){ //menunggu
                    $l->aksi = '
                    <a href="javascript:void(0);" onclick="verifikasi_data('.$l->id_umkm.')" title="Verifikasi UMKM" class="btn btn-info"><i class="fa fa-check"></i></a>
                    ';
               }else if($l->id_status == 3){ //ditolak
                    $l->aksi = '
                    <a href="javascript:void(0);" onclick="lihat_data('.$l->id_umkm.')" title="Lihat Detail UMKM" class="btn btn-success"><i class="fa fa-eye"></i></a>
                    <a href="javascript:void(0);" onclick="aktif_data('.$l->id_umkm.')" title="Aktifkan Data UMKM" class="btn btn-primary"><i class="fa fa-undo"></i></a>
                    '; 
               }elseif ($l->id_status == 1) { //diterima
                    $l->aksi = '
                    <a href="javascript:void(0);" onclick="lihat_data('.$l->id_umkm.')" title="Lihat Detail UMKM" class="btn btn-success"><i class="fa fa-eye"></i></a>
                    
                    <a href="javascript:void(0);" onclick="hapus_data('.$l->id_umkm.')" title="Nonaktifkan Data UMKM" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                    '; 
                    // <a href="javascript:void(0);" onclick="ubah_data('.$l->id_umkm.')" title="Ubah Data UMKM" class="btn btn-info"><i class="fa fa-pencil"></i></a>
               }else{ //belum lengkap
                    $l->aksi = '<a href="javascript:void(0);" onclick="lihat_data('.$l->id_umkm.')" title="Lihat Detail UMKM" class="btn btn-success"><i class="fa fa-eye"></i></a>'; 
               }

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

     public function ajax_lihat()
     {
          $query['select']    = 'a.*,b.nama as nama_status';
          $query['table']     = 'm_pengguna a';
          $query['join'][0]   = array('m_status b','b.id_status = a.id_status');
          $query['where']     = 'a.id_pengguna = '.(int)$this->input->post('id',true);
          $data               = $this->query_model->getRow($query);
          echo json_encode($data);
     }


     public function ajax_hapus(){
          $data = array(
               'alasan'        => $this->input->post('data',true),
               'id_status'     => 3,
               'updated_at'    => date('Y-m-d H:i:s')
          );

          $insert = $this->query_model->update('m_umkm',array('id_umkm' => $this->input->post('id',true)), $data);

          if (!$insert)
          {    
               echo json_encode(['success' => false, 'message' => 'Data UMKM gagal dinon aktifkan','status' => TRUE]);
          }
          else 
          {
               //non aktifkan semua produk di umkm yg di non aktifkan
               nonaktifkan_produk_by_umkm($this->input->post('id',true));
               //kirim email
               kirim_email_tolak($this->input->post('id',true));
               echo json_encode(['success' => true, 'message' => 'Data UMKM berhasil dinon aktifkan','status' => TRUE]);
          }
     }

     public function ajax_tolak(){
          $data = array(
               'alasan'        => $this->input->post('data',true),
               'id_status'     => 3,
               'updated_at'    => date('Y-m-d H:i:s')
          );

          $insert = $this->query_model->update('m_umkm',array('id_umkm' => $this->input->post('id',true)), $data);

          if (!$insert)
          {    
               echo json_encode(['success' => false, 'message' => 'Data UMKM gagal dinon aktifkan','status' => TRUE]);
          }
          else 
          {
               //non aktifkan semua produk di umkm yg di non aktifkan
               nonaktifkan_produk_by_umkm($this->input->post('id',true));
               //kirim email
               kirim_email_non($this->input->post('id',true));
               echo json_encode(['success' => true, 'message' => 'Data UMKM berhasil dinon aktifkan','status' => TRUE]);
          }
     }

     public function ajax_restore(){
          $data = array(
               'id_status'     => 1,
               'updated_at'    => date('Y-m-d H:i:s')
          );

          $insert = $this->query_model->update('m_umkm',array('id_umkm' => $this->input->post('id',true)), $data);

          if (!$insert)
          {
               echo json_encode(['success' => false, 'message' => 'Data UMKM gagal diaktifkan','status' => TRUE]);
          }
          else 
          {
               //aktifkan kembali semua produk pada umkm
               aktifkan_produk_by_umkm($this->input->post('id',true));
               //kirim email
               kirim_email_aktif($this->input->post('id',true));
               echo json_encode(['success' => true, 'message' => 'Data UMKM berhasil  di aktifkan','status' => TRUE]);
          }
     }

     public function ajax_pengguna()
     {
          $json = [];

          if(!empty($this->input->get("q"))){
               $json = $this->m_umkm->get_pengguna($this->input->get("q"));
          }

          echo json_encode($json);
     }

     public function ajax_upload(){

          $config['upload_path'] = './assets/images/umkm';
          $config['allowed_types'] = 'xlsx|xls';
          $config['encrypt_name'] = TRUE;
          $config['overwrite'] = TRUE;
          $this->upload->initialize($config);
          $insert = true;
          if($this->upload->do_upload("excel"))
          {    
               $name = $this->upload->data();
               $name_foto  = $name['file_name'];

               /** Include PHPExcel */
               require_once APPPATH."/third_party/PHPExcel.php";
               //require_once base_url(). 'application/libraries/PHPExcel.php';
          
               // Create new PHPExcel object
               // echo EOL;
               // echo date('H:i:s') , " Create new PHPExcel object" , EOL;
               $objPHPExcel = new PHPExcel();

               $loadexcel = PHPExcel_IOFactory::load('./assets/images/umkm/'.$name_foto); // Load file yang telah diupload ke folder excel
               $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
               
               // Buat sebuah variabel array untuk menampung array data yg akan kita insert ke database
               $data = array();
               
               $numrow = 1;
               $id=0;
               foreach($sheet as $row){
                    
                    
                    if($numrow == 2)
                    {
                         if($row['A'] != 'upload_data')
                         {
                              echo json_encode(['success' => false, 'message' => 'Data excel tidak sesuai','status' => TRUE]);
                              exit();
                         }
                    }

                    if($numrow > 3){
                         // Kita push (add) array data ke variabel data
                         if(!empty($row['B']) AND is_numeric($row['B']))
                         {
                              
                              $useragent = 'Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0';
                              $json_url = 'https://service-tlive.tangerangkota.go.id/services/tlive/profil/user';
                              $ch = curl_init( $json_url );
                              curl_setopt($ch, CURLOPT_USERAGENT, $useragent );
                              curl_setopt($ch, CURLOPT_POST, 1);
                              curl_setopt($ch, CURLOPT_POSTFIELDS,"nik=".$row['B']);
                              curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                              curl_setopt($ch, CURLOPT_USERPWD, SERV_U . ':' . SERV_P);
                              $result = json_decode(curl_exec($ch),true);

                              if($result['success']){
                                   $this->m_umkm->cek_user($result);
                                   $id = $result['result'][0]['id_user'];
                              }else{
                                   $pengguna = array(
                                        'id_group'          => 2,
                                        'username'          => $row['B'],
                                        'nama'              => $row['C'],
                                        'jenis_kelamin'     => $row['E'],
                                        'tempat_lahir'      => $row['F'],
                                        'tanggal_lahir'     => format_tanggal($row['G']),
                                        'email'             => $row['H'],
                                        'no_telp'           => $row['D'],
                                        'created_at'        => date('Y-m-d H:i:s'),
                                   );
                                   $id = $this->query_model->insert_id('m_pengguna',$pengguna);
                              }
                              

                              $id_kecamatan  = get_id_kecamatan($row['T']);
                              $id_kelurahan  = get_id_kelurahan($row['T'],$row['U']);

                              $umkm = array(
                                   'id_pengguna'       => $id,
                                   'username'          => $row['B'],
                                   'nama_perusahaan'   => $row['I'],
                                   'no_surat'          => $row['J'],
                                   'id_jenis_usaha'    => $this->getData('m_jenis_usaha',$row['K']),
                                   'tgl_usaha'         => format_tanggal($row['M']),
                                   'jml_modal_awal'    => $row['N'],
                                   'jml_pegawai'       => $row['O'],
                                   'jml_omset'         => $row['P'],
                                   'jml_asset'         => $row['Q'],
                                   'id_skala_usaha'    => $this->getData('m_skala_usaha',$row['R']),
                                   'npwp'              => $row['L'],
                                   'situs_web'         => $row['S'],
                                   'created_at'        => date('Y-m-d H:i:s'),
                                   'id_status'         => 1
                              );
                              $id_umkm = $this->query_model->insert_id('m_umkm',$umkm);

                              $alamat = array(
                                   'id_umkm'           => $id_umkm,
                                   'id_kec'            => $id_kecamatan,
                                   'nama_kec'          => get_data_kecamatan($row['T']),
                                   'id_kel'            => $id_kelurahan,
                                   'nama_kel'          => text($row['U']),
                                   'alamat'            => $row['W'],
                                   'kode_pos'          => $row['V'],
                                   'lat'               => $row['Y'],
                                   'long'              => $row['X'],
                              );
                              
                              $this->query_model->insert('m_umkm_alamat',$alamat);


                              $berkas = array(
                                   'id_umkm'           => $id_umkm,
                              );
                              
                              $this->query_model->insert('m_umkm_berkas',$berkas);

                         }
                    }

                    $numrow++; // Tambah 1 setiap kali looping
               }
           
               if (!$id)
               {
                    echo json_encode(['success' => false, 'message' => 'Data umkm gagal ditambahkan','status' => TRUE]);
               }
               else 
               {
                    echo json_encode(['success' => true, 'message' => 'Data umkm Berhasil ditambahkan','status' => TRUE]);
               }
          }
          else
          {
               echo json_encode(['success' => false, 'message' => $this->upload->display_errors(),'status' => TRUE]);
          }

     }

     private function getData($table,$data)
     {
          $query['select']    = '*';
          $query['table']     = $table;
          switch ($table) {
               case 'm_jenis_usaha':
                    $query['where']     = 'nama_usaha = "'.$data.'"';
                    $data = $this->query_model->getRow($query);
                    return $data->id_jenis_usaha;
               break;
               case 'm_skala_usaha':
                    $query['where']     = 'nama_skala = "'.$data.'"';
                    $data = $this->query_model->getRow($query);
                    return $data->id_skala_usaha;
               break;
               
               default:
                    
               break;
          }
     }


}