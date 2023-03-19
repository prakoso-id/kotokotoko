<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class Arsip_testing extends REST_Controller {

    function __construct($config = 'rest2'){
        parent::__construct($config);
        $this->load->model('daftarumkm/m_arsip_testing','arsip');
        $this->dbkampungsiaga = $this->load->database('kampungsiaga',true);
    }

    // cron create account tlive 
    public function createTliveAccount_get() {
        $sidata = $this->arsip->getUmkmSidata();
        if ($sidata != null) {

            foreach ($sidata as $key) {
                $cek = $this->arsip->cekakunTlive($key->username);
                if ($cek == null) {
                    if ($key->email != '')
                        $email = $key->email;
                    else
                        $email = 'web_umkm@gmail.com';

                    $guest = $this->post_guest($email, 'Website');
                    $token = $this->arsip->cektokenTlive($guest->data->token);
                    // var_dump($guest);
                    // var_dump($guest->data->token);
                    // var_dump($token);
                    // die();
                    
                    $nik_username = trim($key->username);
                    $data_ = [
                        'token_id' => $token[0]->id,
                        'foto_ktp_id' => 0,
                        'foto_selfie_id' => 0,
                        'nik' => trim($key->username),
                        'email' => strtolower($key->email),
                        'password' => password_hash($nik_username, PASSWORD_BCRYPT),
                        'created_at' => date("Y-m-d H:i:s"),
                        'no_telp' => $key->no_hp,
                        'status' => 'Terverifikasi',
                        'sumber' => 'umkm',
                    ];

                    $verification_id = $this->arsip->insert_user_verification($data_);

                    if($key->username && is_numeric($key->username)){

                        $nik = $this->get_nik2(trim($key->username));
                        // var_dump($nik); var_dump($data_); die();

                        $domisili = "";
                        $no_kab = 0;
                        $no_prop = 0;

                        if(!array_key_exists('kesalahan', $nik)) {

                            $domisili = "Dalam Kota";
                            $no_prop = 36;
                            $no_kab = 71;

                            $data = [
                                'verification_id' => $verification_id,
                                'domisili' => 'Dalam Kota',
                                'nik' => $nik[0]->NIK,
                                'email' => $key->email,
                                'password' => password_hash($nik[0]->NIK, PASSWORD_BCRYPT),
                                'nama' => strtoupper($nik[0]->NAMA_LGKP),
                                'jenis_kelamin' => $nik[0]->JENIS_KLMIN,
                                'tempat_lahir' =>$nik[0]->TMPT_LHR,
                                'tanggal_lahir' => $nik[0]->TGL_LHR,
                                'alamat' => $nik[0]->ALAMAT,
                                'no_rt' => (int) $nik[0]->NO_RT,
                                'no_rw' => (int) $nik[0]->NO_RW,
                                'no_kel' => $nik[0]->NO_KEL,
                                'no_kec' => $nik[0]->NO_KEC,
                                'no_kab' => 71,
                                'no_prop' => 36,            
                                'agama' => $nik[0]->AGAMA,
                                'stat_kwn' => $nik[0]->STAT_KWN,
                                'stat_kerja' => $nik[0]->JENIS_PKRJN,
                                'gol_darah' => $nik[0]->GOL_DARAH,
                                'no_telp' => $key->no_hp,
                                'status' => 'Terverifikasi',
                                'created_at' => date("Y-m-d H:i:s")
                            ];
                            
                            $this->arsip->insert_user_tlive($data);

                            $data = [
                                'id_group' => 2,
                                'domisili' => $domisili,
                                'username' => $nik[0]->NIK,
                                'email' => $key->email,
                                'nama' => strtoupper($nik[0]->NAMA_LGKP),
                                'jenis_kelamin' => $nik[0]->JENIS_KLMIN,
                                'tempat_lahir' =>$nik[0]->TMPT_LHR,
                                'tanggal_lahir' => $nik[0]->TGL_LHR,
                                'alamat' => $nik[0]->ALAMAT,
                                'no_rt' => (int) $nik[0]->NO_RT,
                                'no_rw' => (int) $nik[0]->NO_RW,
                                'no_kel' => $nik[0]->NO_KEL,
                                'no_kec' => $nik[0]->NO_KEC,
                                'no_kab' => $no_ab,
                                'no_prop' => $no_prop,            
                                'agama' => $nik[0]->AGAMA,
                                'no_telp' => $key->no_hp,
                                'nama_ibu' => $nik[0]->NAMA_LGKP_IBU,
                                'status' => 1,
                                'created_at' => date("Y-m-d H:i:s")
                            ];
                            
                            $id_pengguna = $this->arsip->insert_umkm_pengguna($data);

                            $this->arsip->updatedataumkm_pengguna($key->id_umkm, $id_pengguna);

                        } else {
                            $domisili = "Luar Kota";
                            $alamat = $this->arsip->getUmkmAlamt($key->id_umkm);
                            $nik_username = trim($key->username);

                            $data = [
                                'verification_id' => $verification_id,
                                'domisili' => 'Luar Kota',
                                'nik' => trim($key->username),
                                'email' => $key->email,
                                'password' => password_hash($nik_username, PASSWORD_BCRYPT),
                                'nama' => strtoupper($key->nama_perusahaan),
                                // 'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                                // 'tempat_lahir' => $this->input->post('tempat_lahir'),
                                // 'tanggal_lahir' => date_create_from_format('d-m-Y', $this->input->post('tanggal_lahir'))->format('Y-m-d'),
                                'alamat' => $alamat[0]->alamat,
                                // 'no_rt' => (int) $this->input->post('no_rt'),
                                // 'no_rw' => (int) $this->input->post('no_rw'),
                                'no_kel' => $alamat[0]->id_kel,
                                'no_kec' => $alamat[0]->id_kec,
                                'no_kab' => $alamat[0]->no_kab,
                                'no_prop' => $alamat[0]->no_prop,    
                                // 'agama' => $this->input->post('agama'),
                                // 'stat_kwn' => $this->input->post('status_kawin'),
                                // 'stat_kerja' => $this->input->post('status_kerja'),
                                // 'gol_darah' => $this->input->post('gol_darah'),
                                'no_telp' => $key->no_hp,
                                'status' => 'Terverifikasi',
                                'created_at' => date("Y-m-d H:i:s")
                            ];
                            
                            $this->arsip->insert_user_tlive($data);

                            $data = [
                                'id_group' => 2,
                                'domisili' => $domisili,
                                'username' => trim($key->username),
                                'email' => $key->email,
                                'nama' => strtoupper($key->nama_perusahaan),
                                // 'jenis_kelamin' => $nik[0]->JENIS_KLMIN,
                                // 'tempat_lahir' =>$nik[0]->TMPT_LHR,
                                // 'tanggal_lahir' => $nik[0]->TGL_LHR,
                                'alamat' => $alamat[0]->alamat,
                                // 'no_rt' => (int) $nik[0]->NO_RT,
                                // 'no_rw' => (int) $nik[0]->NO_RW,
                                'no_kel' => $alamat[0]->id_kel,
                                'no_kec' => $alamat[0]->id_kec,
                                'no_kab' => $alamat[0]->no_kab,
                                'no_prop' => $alamat[0]->no_prop,              
                                // 'agama' => $nik[0]->AGAMA,
                                'no_telp' => $key->no_hp,
                                'nama_ibu' => '',
                                'status' => 1,
                                'created_at' => date("Y-m-d H:i:s")
                            ];
                            
                            $id_pengguna = $this->arsip->insert_umkm_pengguna($data);

                            $this->arsip->updatedataumkm_pengguna($key->id_umkm, $id_pengguna);
                        }

                    }

                    
                } else {
                    $data = [
                        'id_group' => 2,
                        'domisili' => $cek[0]->domisili,
                        'username' => $cek[0]->nik,
                        'email' => $cek[0]->email,
                        'nama' => strtoupper($cek[0]->nama),
                        'jenis_kelamin' => $cek[0]->jenis_kelamin,
                        'tempat_lahir' => $cek[0]->tempat_lahir,
                        'tanggal_lahir' => $cek[0]->tanggal_lahir,
                        'alamat' => $cek[0]->alamat,
                        'no_rt' => (int) $cek[0]->no_rt,
                        'no_rw' => (int) $cek[0]->no_rw,
                        'no_kel' => $cek[0]->no_kel,
                        'no_kec' => $cek[0]->no_kec,
                        'no_kab' => $cek[0]->no_kab,
                        'no_prop' => $cek[0]->no_prop,            
                        'agama' => $cek[0]->agama,
                        'no_telp' => $cek[0]->no_telp,
                        'status' => 1,
                        'created_at' => date("Y-m-d H:i:s")
                    ];
                    
                    $id_pengguna = $this->arsip->insert_umkm_pengguna($data);

                    $this->arsip->updatedataumkm_pengguna($key->id_umkm, $id_pengguna);
                }
            }

            return $this->response([
                'status' => true,
                'message' => 'Data berhasil simpan'
            ]);
        }
        
    }

    private function get_nik2($nik) {
        $username = 'dkcs_api';
        $password = 'AdminDkcs3671.';

        $json_url = 'http://202.58.217.37:8082/api-online/index.php/api/data/wni/nik/' . $nik;
        $ch = curl_init($json_url);
        $options = array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => array('Content-type: application/json'),
            CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13',
        );
        
        curl_setopt($ch, CURLOPT_USERPWD, $username . ':' . $password);
        curl_setopt_array($ch, $options); //Setting curl options
        $result = curl_exec($ch); //Getting jSON result string
        return json_decode($result);
    }

    private function post_guest($email=null, $platform=null) {
        $link = 'https://service-tlive.tangerangkota.go.id/services/tlive/auth/guest/';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$link);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,
        "email=$email&platform=$platform");

        curl_setopt($ch, CURLOPT_USERAGENT,"Mozilla/5.0 (Linux; Android 4.4.2; Nexus 4 Build/KOT49H) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/34.0.1847.114 Mobile Safari/537.36");
        curl_setopt($ch, CURLOPT_USERPWD, "r35t4p12:8540c5ef27b4afdb197405dc551ce5b5bfcb73bb2");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        // receive server response ...
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec ($ch);
        curl_close ($ch);

        $array = json_decode($server_output);

        return $array;
    }

    
    public function simpandata_post()
    {
       // var_dump($this->post());
        //die();
        $nama_usaha=$this->post('nama_usaha');
        $nama_pemilik=$this->post('nama_pemilik');
        $nik=$this->post('nik');
        $alamat=$this->post('alamat');
        $no_rt=$this->post('no_rt');
        $no_rw=$this->post('no_rw');
        $kelurahan=$this->post('kelurahan');
        $kecamatan=$this->post('kecamatan');
        $kota=$this->post('kota');
        $no_hp=$this->post('no_hp');
        $omset=$this->post('omset');
        $assets=$this->post('assets');
        $modal_sendiri=$this->post('modal_sendiri');
        $created_at=$this->post('created_at');
        $created_by=$this->post('created_by');
        $edited_at=$this->post('edited_at');
        $edited_by=$this->post('edited_by');
        $status=$this->post('status');
        $status_verifikasi=$this->post('status_verifikasi');
        $provinsitematik=$this->post('provinsitematik');
        $kotatematik=$this->post('kotatematik');
        $kecamataaantematik=$this->post('kecamataaantematik');
        $kelurahaantematik=$this->post('kelurahaantematik');
        $lokasikampungtematik=$this->post('lokasikampungtematik');
        $tempatlahir=$this->post('tempatlahir');
        $domisiliktp=$this->post('domisiliktp');
        $tanggallahir=$this->post('tanggallahir');
        $jeniskelamin=$this->post('jeniskelamin');
        $namaibukandung=$this->post('namaibukandung');
        $namaizinusaha=$this->post('namaizinusaha');
        $nosuratizinusaha=$this->post('nosuratizinusaha');
        $npwp=$this->post('npwp');
        $tanggalmulai=$this->post('tanggalmulai');
        $provinsiworkshop=$this->post('provinsiworkshop');
        $kotaworkshop=$this->post('kotaworkshop');
        $kecamatanworkshop=$this->post('kecamatanworkshop');
        $kelurahanworkshop=$this->post('kelurahanworkshop');
        $kodeposworkshop=$this->post('kodeposworkshop');
        $rtworkshop=$this->post('rtworkshop');
        $rwworkshop=$this->post('rwworkshop');
        $kodepos=$this->post('kodepos');
        $telpon=$this->post('telpon');
        $fax=$this->post('fax');
        $email=$this->post('email');
        $website=$this->post('website');
        $bentukusaha=$this->post('bentukusaha');
        $jenisusaha=$this->post('jenisusaha');
        $kegiatanutama=$this->post('kegiatanutama');
        $produkutama=$this->post('produkutama');
        $tahundata=$this->post('tahundata');
        $totalkariawanlakilaki=$this->post('totalkariawanlakilaki');
        $totaltenagakerjalakilaki=$this->post('totaltenagakerjalakilaki');
        $omzetawal=$this->post('omzetawal');
        $asset=$this->post('asset');
        $modalluar=$this->post('modalluar');
        $totalmodalluar=$this->post('totalmodalluar');
        $jenistempatusaha=$this->post('jenistempatusaha');
        $saranausaha=$this->post('saranausaha');
        $statussarana=$this->post('statussarana');
        $bahanbakar=$this->post('bahanbakar');
        $negaraexpor=$this->post('negaraexpor');
        $volumeexpor=$this->post('volumeexpor');
        $nominalexpor=$this->post('nominalexpor');
        $alamatworkshop=$this->post('alamatworkshop');
        $totaltenagakerjaperempuan=$this->post('totaltenagakerjaperempuan');
        $totalkariawanperempuan=$this->post('totalkariawanperempuan');
        $alamatsosialmedia=$this->post('sosmed');
        $json_kontak = $this->post('json_kontak');


        //tambahanandroidalwi
        $profesi_pemilik = $this->post('profesi_pemilik');
        $tempat_pemasaran = $this->post('tempat_pemasaran');
        $pemasaran_online = $this->post('pemasaran_online');

        if(isset($profesi_pemilik)){
            $profesi_pemilik = $this->post('profesi_pemilik');
        }else{
            $profesi_pemilik = "";
        }
        if(isset($tempat_pemasaran)){
            $tempat_pemasaran = $this->post('tempat_pemasaran');
        }else{
            $tempat_pemasaran = "";
        }
        if(isset($pemasaran_online)){
            $pemasaran_online = $this->post('pemasaran_online');
        }else{
            $pemasaran_online = "";
        }

        $latitud=$this->post('latitud');
        $longitud=$this->post('longitud');
        $fotoktp=$this->post('fotoktp');

        $photorumah =$this->post('photorumah');
        $photorumah = str_replace("[","", $photorumah);
        $photorumah = str_replace("]","", $photorumah);
        $photorumah = str_replace(" ","", $photorumah);
        $photorumah = explode(",",$photorumah);
        $arrphto = array();
        
        // start integrasi sidata to umkm

        // insert umkm
        $last_id = $this->arsip->getLastidumkm();
        $id_data = (int)$last_id->id_data + 1;
        $id_last_umkm = $this->arsip->insertumkm($alamatsosialmedia,$alamatworkshop,$longitud,$latitud,$fotoktp,$nama_usaha,$nama_pemilik,$nik,$alamat,$no_rt,$no_rw,$kelurahan,$kecamatan,$kota,$no_hp,$omset,$assets,$modal_sendiri,
            $created_at,$created_by,$edited_at,$edited_by,$status,$status_verifikasi,$provinsitematik,$kotatematik,
            $kecamataaantematik,$kelurahaantematik,$lokasikampungtematik,$tempatlahir,$domisiliktp,$tanggallahir,$jeniskelamin,
            $namaibukandung,$namaizinusaha,$nosuratizinusaha,$npwp,$tanggalmulai,$provinsiworkshop,$kotaworkshop,
            $kecamatanworkshop,$kelurahanworkshop,$kodeposworkshop,$rtworkshop,$rwworkshop,$kodepos,$telpon,$fax,$email,$website,$bentukusaha,$jenisusaha,$kegiatanutama,
            $produkutama,$tahundata,$totalkariawanlakilaki,$totaltenagakerjalakilaki,$omzetawal,$asset,$modalluar,$totalmodalluar,
            $jenistempatusaha,$saranausaha,$statussarana,$bahanbakar,$negaraexpor,$volumeexpor,$nominalexpor,$totaltenagakerjaperempuan,$totalkariawanperempuan, $json_kontak,$id_data);

        // insert umkm alamat
        $dataumkm = $this->arsip->insertumkm_alamat($alamatworkshop,$kecamatanworkshop,$kelurahanworkshop,$kodeposworkshop, $id_last_umkm);

        // insert umkm izin usaha
        $dataumkm = $this->arsip->insertumkm_izinusaha($namaizinusaha, $nosuratizinusaha, $id_last_umkm);

        // end integrasi sidata to umkm

        $dataizinusaha = $this->arsip->simpantdataumkm($alamatsosialmedia,$alamatworkshop,$longitud,$latitud,$fotoktp,$nama_usaha,$nama_pemilik,$nik,$alamat,$no_rt,$no_rw,$kelurahan,$kecamatan,$kota,$no_hp,$omset,$assets,$modal_sendiri,
            $created_at,$created_by,$edited_at,$edited_by,$status,$status_verifikasi,$provinsitematik,$kotatematik,
            $kecamataaantematik,$kelurahaantematik,$lokasikampungtematik,$tempatlahir,$domisiliktp,$tanggallahir,$jeniskelamin,
            $namaibukandung,$namaizinusaha,$nosuratizinusaha,$npwp,$tanggalmulai,$provinsiworkshop,$kotaworkshop,
            $kecamatanworkshop,$kelurahanworkshop,$kodeposworkshop,$rtworkshop,$rwworkshop,$kodepos,$telpon,$fax,$email,$website,$bentukusaha,$jenisusaha,$kegiatanutama,
            $produkutama,$tahundata,$totalkariawanlakilaki,$totaltenagakerjalakilaki,$omzetawal,$asset,$modalluar,$totalmodalluar,
            $jenistempatusaha,$saranausaha,$statussarana,$bahanbakar,$negaraexpor,$volumeexpor,$nominalexpor,$totaltenagakerjaperempuan,$totalkariawanperempuan, $json_kontak);


            //$profesi_pemilik, $tempat_pemasaran, $pemasaran_online

        // var_dump($this->dbkampungsiaga->last_query());
        // exit();
        
        for($a=0;$a<count($photorumah);$a++){
            $arrphto[]=array(
                "id_umkm"=>$dataizinusaha,
                "foto_rumah"=>$photorumah[$a]
            );
            // $this->m_absensi->simpanabsensi($this->guid(), $idpertemuan, $peserta_didik_id[$a], $STATUS[$a], $keterangan[$a]);   
        }
        $this->arsip->simpanfotorumah($arrphto);        
        if($dataizinusaha){
            return $this->response([
                'status' => true,
                'message' => 'berhasil disimpan'
            ]);
        }else{
            return $this->response([
                'status' => false,
                'message' => 'Data gagal simpan'
            ]);
        }
    }

    public function updatedata_post()
    {
       // var_dump($this->post());
        //die();
        $statusdidata=$this->post('statusdidata');
        $id_umkm=$this->post('idumkm');
        $nama_usaha=$this->post('nama_usaha');
        $nama_pemilik=$this->post('nama_pemilik');
        $nik=$this->post('nik');
        $alamat=$this->post('alamat');
        $no_rt=$this->post('no_rt');
        $no_rw=$this->post('no_rw');
        $kelurahan=$this->post('kelurahan');
        $kecamatan=$this->post('kecamatan');
        $kota=$this->post('kota');
        $no_hp=$this->post('no_hp');
        $omset=$this->post('omset');
        $assets=$this->post('assets');
        $modal_sendiri=$this->post('modal_sendiri');
        $created_at=$this->post('created_at');
        $created_by=$this->post('created_by');
        $edited_at=$this->post('edited_at');
        $edited_by=$this->post('edited_by');
        $status=$this->post('status');
        $status_verifikasi=$this->post('status_verifikasi');
        $provinsitematik=$this->post('provinsitematik');
        $kotatematik=$this->post('kotatematik');
        $kecamataaantematik=$this->post('kecamataaantematik');
        $kelurahaantematik=$this->post('kelurahaantematik');
        $lokasikampungtematik=$this->post('lokasikampungtematik');
        $tempatlahir=$this->post('tempatlahir');
        $domisiliktp=$this->post('domisiliktp');
        $tanggallahir=$this->post('tanggallahir');
        $jeniskelamin=$this->post('jeniskelamin');
        $namaibukandung=$this->post('namaibukandung');
        $namaizinusaha=$this->post('namaizinusaha');
        $nosuratizinusaha=$this->post('nosuratizinusaha');
        $npwp=$this->post('npwp');
        $tanggalmulai=$this->post('tanggalmulai');
        $provinsiworkshop=$this->post('provinsiworkshop');
        $kotaworkshop=$this->post('kotaworkshop');
        $kecamatanworkshop=$this->post('kecamatanworkshop');
        $kelurahanworkshop=$this->post('kelurahanworkshop');
        $kodeposworkshop=$this->post('kodeposworkshop');
        $rtworkshop=$this->post('rtworkshop');
        $rwworkshop=$this->post('rwworkshop');
        $kodepos=$this->post('kodepos');
        $telpon=$this->post('telpon');
        $fax=$this->post('fax');
        $email=$this->post('email');
        $website=$this->post('website');
        $bentukusaha=$this->post('bentukusaha');
        $jenisusaha=$this->post('jenisusaha');
        $kegiatanutama=$this->post('kegiatanutama');
        $produkutama=$this->post('produkutama');
        $tahundata=$this->post('tahundata');
        $totalkariawanlakilaki=$this->post('totalkariawanlakilaki');
        $totaltenagakerjalakilaki=$this->post('totaltenagakerjalakilaki');
        $omzetawal=$this->post('omzetawal');
        $asset=$this->post('asset');
        $modalluar=$this->post('modalluar');
        $totalmodalluar=$this->post('totalmodalluar');
        $jenistempatusaha=$this->post('jenistempatusaha');
        $saranausaha=$this->post('saranausaha');
        $statussarana=$this->post('statussarana');
        $bahanbakar=$this->post('bahanbakar');
        $negaraexpor=$this->post('negaraexpor');
        $volumeexpor=$this->post('volumeexpor');
        $nominalexpor=$this->post('nominalexpor');
        $alamatworkshop=$this->post('alamatworkshop');
        $totaltenagakerjaperempuan=$this->post('totaltenagakerjaperempuan');
        $totalkariawanperempuan=$this->post('totalkariawanperempuan');
        $alamatsosialmedia=$this->post('sosmed');
        $latitud=$this->post('latitud');
        $longitud=$this->post('longitud');
        $fotoktp=$this->post('fotoktp');
        $keterangan = $this->post('keterangan');
        $json_kontak = $this->post('json_kontak');

        //tambahanandroidalwi
        $profesi_pemilik = $this->post('profesi_pemilik');
        $tempat_pemasaran = $this->post('tempat_pemasaran');
        $pemasaran_online = $this->post('pemasaran_online');

        if(isset($profesi_pemilik)){
            $profesi_pemilik = $this->post('profesi_pemilik');
        }else{
            $profesi_pemilik = "";
        }
        if(isset($tempat_pemasaran)){
            $tempat_pemasaran = $this->post('tempat_pemasaran');
        }else{
            $tempat_pemasaran = "";
        }
        if(isset($pemasaran_online)){
            $pemasaran_online = $this->post('pemasaran_online'); 
        }else{
            $pemasaran_online = "";
        }

        $photorumah =$this->post('photorumah');
        $photorumah = str_replace("[","", $photorumah);
        $photorumah = str_replace("]","", $photorumah);
        $photorumah = str_replace(" ","", $photorumah);
        $photorumah = explode(",",$photorumah);
        $arrphto = array();
        
        if ($statusdidata=="1") {

            // start integrasi umkm

            // update umkm
            $id_data_umkm = $this->arsip->getIddataumkm($id_umkm);

            $dataumkm = $this->arsip->updatedataumkm($alamatsosialmedia, $alamatworkshop, $id_umkm, $statusdidata,$longitud,$latitud,$fotoktp,$nama_usaha,$nama_pemilik,$nik,$alamat,$no_rt,$no_rw,$kelurahan,$kecamatan,$kota,$no_hp,$omset,$assets,$modal_sendiri,
            $created_at,$created_by,$edited_at,$edited_by,$status,$status_verifikasi,$provinsitematik,$kotatematik,
            $kecamataaantematik,$kelurahaantematik,$lokasikampungtematik,$tempatlahir,$domisiliktp,$tanggallahir,$jeniskelamin,
            $namaibukandung,$namaizinusaha,$nosuratizinusaha,$npwp,$tanggalmulai,$provinsiworkshop,$kotaworkshop,
            $kecamatanworkshop,$kelurahanworkshop,$kodeposworkshop,$rtworkshop,$rwworkshop,$kodepos,$telpon,$fax,$email,$website,$bentukusaha,$jenisusaha,$kegiatanutama,
            $produkutama,$tahundata,$totalkariawanlakilaki,$totaltenagakerjalakilaki,$omzetawal,$asset,$modalluar,$totalmodalluar,
            $jenistempatusaha,$saranausaha,$statussarana,$bahanbakar,$negaraexpor,$volumeexpor,$nominalexpor,$totaltenagakerjaperempuan,$totalkariawanperempuan,$profesi_pemilik, $tempat_pemasaran,$pemasaran_online,$json_kontak, $id_data_umkm[0]->id_data);

            if ($this->arsip->checkUmkmalamat($id_umkm) != null) {
                // update umkm alamat
                $dataumkm = $this->arsip->updatedataumkm_alamat($alamatworkshop,$kecamatanworkshop,$kelurahanworkshop,$kodeposworkshop, $id_umkm);
            } else {
                // insert umkm alamat
                $dataumkm = $this->arsip->insertumkm_alamat($alamatworkshop,$kecamatanworkshop,$kelurahanworkshop,$kodeposworkshop, $id_umkm);
            }
            
            if ($this->arsip->checkUmkmIzinUsaha($id_umkm) != null) {
                // update umkm izin usaha
                $dataumkm = $this->arsip->updatedataumkm_izinusaha($namaizinusaha, $nosuratizinusaha, $id_umkm);
            } else {
                // insert umkm izin usaha
                $dataumkm = $this->arsip->insertumkm_izinusaha($namaizinusaha, $nosuratizinusaha, $id_umkm);
            }

            // end integrasi umkm

            $dataizinusaha = $this->arsip->updatedata($alamatsosialmedia, $alamatworkshop, $id_umkm, $statusdidata,$longitud,$latitud,$fotoktp,$nama_usaha,$nama_pemilik,$nik,$alamat,$no_rt,$no_rw,$kelurahan,$kecamatan,$kota,$no_hp,$omset,$assets,$modal_sendiri,
            $created_at,$created_by,$edited_at,$edited_by,$status,$status_verifikasi,$provinsitematik,$kotatematik,
            $kecamataaantematik,$kelurahaantematik,$lokasikampungtematik,$tempatlahir,$domisiliktp,$tanggallahir,$jeniskelamin,
            $namaibukandung,$namaizinusaha,$nosuratizinusaha,$npwp,$tanggalmulai,$provinsiworkshop,$kotaworkshop,
            $kecamatanworkshop,$kelurahanworkshop,$kodeposworkshop,$rtworkshop,$rwworkshop,$kodepos,$telpon,$fax,$email,$website,$bentukusaha,$jenisusaha,$kegiatanutama,
            $produkutama,$tahundata,$totalkariawanlakilaki,$totaltenagakerjalakilaki,$omzetawal,$asset,$modalluar,$totalmodalluar,
            $jenistempatusaha,$saranausaha,$statussarana,$bahanbakar,$negaraexpor,$volumeexpor,$nominalexpor,$totaltenagakerjaperempuan,$totalkariawanperempuan,$profesi_pemilik, $tempat_pemasaran,$pemasaran_online,$json_kontak);
        }else if ($statusdidata == "2") {

            // start integrasi umkm
            $id_data_umkm = $this->arsip->getIddataumkm($id_umkm);

            // var_dump($id_data_umkm); var_dump($id_umkm); die();

            // delete umkm
            $delete_umkm = $this->arsip->deleteUMKM($id_data_umkm[0]->id_data);
            $delete_alamat = $this->arsip->deleteUMKMAlamat($id_umkm);
            $delete_izin_usaha = $this->arsip->deleteUMKMIzinUsaha($id_umkm);
            // end integrasi umkm

            $where['id_umkm'] = $id_umkm;
            $data_update = array(

                "id_umkm"=>$id_umkm,
                "nik"=>$nik,
                "statusdidata"=>$statusdidata,
                "created_at"=>date("Y-m-d h:i:s"),
                "created_by"=>$created_by,
                "edited_at"=>date("Y-m-d h:i:s"),
                "edited_by"=>$edited_by

            );

            $dataizinusaha=$this->arsip->update("t_data_umkm",$data_update,$where);

            // 
        }
        
      

            //$profesi_pemilik, $tempat_pemasaran, $pemasaran_online

        $this->arsip->simpantdatahistory($id_umkm,$nik,$statusdidata,$keterangan,$latitud,$longitud,$alamat,$fotoktp,$created_at,$created_by,$edited_at,$edited_by,'','','');

        $sqlcekphoto = "SELECT * FROM t_data_gambar_umkm WHERE id_umkm=".$id_umkm;
        $rs = $this->dbkampungsiaga->query($sqlcekphoto);

        // var_dump($rs);
        // exit(); 
 
        if ($rs) {
            $sqldelete = "DELETE FROM t_data_gambar_umkm WHERE id_umkm=".$id_umkm;
            $this->dbkampungsiaga->query($sqldelete);
        }

        for($a=0;$a<count($photorumah);$a++){
            $arrphto[]=array(
                "id_umkm"=>$id_umkm,
                "foto_rumah"=>$photorumah[$a]
            );
            // $this->m_absensi->simpanabsensi($this->guid(), $idpertemuan, $peserta_didik_id[$a], $STATUS[$a], $keterangan[$a]);   
        }
        $this->arsip->simpanfotorumah($arrphto);    
        // if ($dataizinusaha) {
            return $this->response([
                'status' => true,
                'message' => 'berhasil disimpans'
            ]);
        // }else{
        //  return $this->response([
           //      'status' => false,
           //      'message' => 'gagal disimpans'
        //  ]);
        // }  
        
    }

    public function izinusaha_post()
    {
        $dataizinusaha = array("IUMK", "SIUP", "SKDU", "SKU", "PIRT", "HALAL","NIB","Belum Punya", "lainnya"); 
        $databentukusaha = array("PT.", "CV.", "Firma", "Perorangan", "Koperasi", "Yayasan", "lainnya");
        $datajenisusaha = array("Kuliner", "Fashion", "Kerajinan Alas Kaki", "Handricaft", "Pendidikan", "Jasa", "Internet", "Otomotif", "Agrobisnis", "lainnya");
        $datajenismarketplace = array("LAZADA", "SHOPEE", "TOKOPEDIA", "BLIBLICOM", "OLX", "ZALORA", "JDID", "BELANJACOM", "WHATSAPP", "FACEBOOK", "INSTAGRAM", "GOFOOD", "GRABFOOD", "lainnya");
        $datamarketpilih = array("Offline", "Online");
        $databahanbakar = array("LPG ≥ 12 KG", "LPG 5 KG", "LPG 3 KG", "Minyak Tanah", "Kayu Bakar", "Listrik");
        $datajenistempat = array("Berlokasi di Zona UKM", "Tempat Tinggal", "Berkeliling", "Pasar Tradisional", "Pasar Modern", "lainnya");
        $datasarana = array("Tempat Tinggal (Rumah)", "Kios", "Toko/Ruko", "Warung", "Gerobak Dorong", "lainnya");
        $datastatususaha = array("Milik Sendiri", "Kontrak", "Sewa", "lainnya");
        $dataprofesi = array("TNI/POLRI/PNS/BUMN/BUMD","Pegawai Swasta", "Serabutan (Ojek,Buruh)", "UMKM", "lainnya");
        if($dataizinusaha)
        {
            return $this->response([
                "dataizinusaha"          => $dataizinusaha,
                "databentukusaha"          => $databentukusaha,
                "datajenistempat"          => $datajenistempat,
                "datajenisusaha"          => $datajenisusaha,
                "datajenismarketplace"          => $datajenismarketplace,
                "datamarketpilih"          => $datamarketpilih,
                "datasarana"          => $datasarana,
                "datastatususaha"          => $datastatususaha,
                "dataprofesi"          => $dataprofesi,
                "databahanbakar"=>$databahanbakar,
                'success'        => true,
                'message'       => 'Data berhasil ditemukan'
            ]);
        }else{
            return $this->response([
                'success' => false,
                'message' => 'Data gagal ditemukan'
            ]);
        }
    }
    public function getCount_post()
    {
       $getDataCount = $this->arsip->getDataCount();
       $getDatasudahterdata = $this->arsip->getDatasudahterdata();
       $getDatatidakditemukan = $this->arsip->getDatatidakditemukan();
        if($getDataCount)
        {
            return $this->response([
                "getDataCount"=>$getDataCount,
                "getDatasudahterdata"=>$getDatasudahterdata,
                "getDatatidakditemukan"=>$getDatatidakditemukan,
                'success'        => true,
                'message'       => 'Data berhasil ditemukan'
            ]);
        }else{
            return $this->response([
                'success' => false,
                'message' => 'Data gagal ditemukan'
            ]);
        }
    }

    public function getHistory_post()
    {
        // $nik=$this->post('nik');
        $id_umkm=$this->post('id_umkm');
        $gethistory = $this->arsip->gethistory($id_umkm);
        if($gethistory)
        {
            return $this->response([
                "data"=>$gethistory,
                'success'        => true,
                'message'       => 'Data berhasil ditemukan'
            ]);
        }else{
            return $this->response([
                'success' => false,
                'message' => 'Data gagal ditemukan'
            ]);
        }
    }
    public function getdataumkm_post()
    {
        $idumkm=$this->post('idumkm');
       $getDatadataumkm = $this->arsip->getDatadataumkm($idumkm);
       $getDatafoto = $this->arsip->getDatafoto($idumkm);
        if($getDatadataumkm)
        {
            return $this->response([
                "data"          =>$getDatadataumkm,
                "datafoto"      =>$getDatafoto,
                'success'       => true,
                'message'       => 'Data berhasil ditemukan'
            ]);
        }else{
            return $this->response([
                'success' => false,
                'message' => 'Data gagal ditemukan'
            ]);
        }
    }

    public function getCountdetail_post()
    {
        $type=$this->post('type');
        $limit=$this->post('limit');
        $kecamatan=$this->post('kecamatan');
        $kelurahan=$this->post('kelurahan');
        $rt=$this->post('rt');
        $rw=$this->post('rw');
        $cari=$this->post('cari');
        $offset = $this->post('offset');

        

        $where ="";
        if (isset($kecamatan)&&$kecamatan!='semua'){
            $where = $where. " and g.kecamatan = '".$kecamatan."'";
        }

        if (isset($kelurahan)&&$kelurahan!='semua'){
            $where = $where. " and g.kelurahan = '".$kelurahan."'";
        }
        if (isset($rt)&&$rt!='semua'){
            $where = $where. " and g.no_rt = '".$rt."'";
        }
        if (isset($rw)&&$rw!='semua'){
            $where = $where." and g.no_rw = '".$rw."'";
        }

        $page = "";
        if (isset($limit)){ 
            // $where = $where." and g.id_umkm > '".$limit."'";
            $page = " limit ".$limit." offset ".$offset;
        }
        if (isset($cari)&&$cari!='semua'){
            $where = $where. " and (g.nama_usaha like '%".$cari."%' or g.nama_pemilik like '%".$cari."%' or g.nik like '%".$cari."%')";
        }

        // var_dump($page);
        // exit();

        
       
        if ($type=='semua'){
             // $getDataCount = $this->arsip->getDataCountall($where);
             $getDataCount = $this->arsip->getDataCountall($where, $page);
           
        }else  if ($type=='totaldata'){
            // $getDataCount = $this->arsip->getdatasudahdata($where);
            $getDataCount = $this->arsip->getdatasudahdata($where, $page);
        }else  if ($type=='belumdidata'){
            // $getDataCount = $this->arsip->getdatabelumdidata($where);
            $getDataCount = $this->arsip->getdatabelumdidata($where, $page);
        }else  if ($type=='ditemukan'){
            // $getDataCount = $this->arsip->getDataditemukandetail($where);
            $getDataCount = $this->arsip->getDataditemukandetail($where, $page);
        }else  if ($type=='tidakditemukan'){
            // $getDataCount = $this->arsip->getDatatidakditemukandetail($where);
            $getDataCount = $this->arsip->getDatatidakditemukandetail($where, $page);
        }
      
      
        if($getDataCount)
        {
            return $this->response([
                "data"=>$getDataCount,
                'success'        => true,
                'message'       => 'Data berhasil ditemukan'
            ]);
        }else{
            return $this->response([
                'success' => false,
                'message' => 'Data gagal ditemukan'
            ]);
        }
    }

    


}