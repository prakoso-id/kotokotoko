<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function random_num($len) {
     $str = "";
     $chars = array_merge(range('a', 'z'), range(0, 9));
     for($i=0;$i<$len;$i++) {
          list($usec, $sec) = explode(' ', microtime());
          $seed = (float)$sec+((float)$usec*100000);
          mt_srand($seed);
          $str .= $chars[mt_rand(0, (count($chars)-1))];
     }
     return $str;  
}

function pesan_transaksi($id_transaksi)
{
     $CI                 = get_instance();
     $query_produk['select']     = "concat('".base_url()."assets/produk/',p.id_umkm, '/', (select foto from m_produk_foto  WHERE id_produk = p.id_produk LIMIT 1)) as foto,p.kode_produk,p.harga,p.nama_produk,p.id_produk,b.total_harga,b.total,c.nama_status,b.no_invoice,a.id_transaksi";
     $query_produk['table']      = 'm_transaksi_detail a';
     $query_produk['join'][0]    = array('m_transaksi b','b.id_transaksi = a.id_transaksi');
     $query_produk['join'][1]    = array('m_produk p','a.id_produk = p.id_produk');
     $query_produk['join'][2]    = array('m_status_transaksi c','c.id_status_transaksi = b.id_status_transaksi');
     $query_produk['order']      = 'a.id_transaksi_detail ASC';
     $query_produk['where']      = 'a.id_transaksi = '.(int)$id_transaksi;
     $produk                     = $CI->query_model->getRow($query_produk);
     return $produk;
}

function fungsi_menu_produk($produk,$url)
{
     $CI                 = get_instance();
     $tags = array();
     foreach ($produk as $key => $value) {
          $tags[] = $value->tags;
     }
     $hasil = array_values(explode(" , ",implode(" , ",$tags)));
     $hasil =  array_unique($hasil);
     sort($hasil);
     $option = '<li class="'.($url == uri_string()?'active':'').'"><a href="'.$url.'">Semua Produk</a></li>';
     foreach ($hasil as $key => $value) {
          if($value != '' AND $value != null)
          {
               $http = str_replace(" ","-",$value);
               $option .= '<li class="'.($CI->uri->segment(4) == $http?'active':'').'"><a href="'.base_url($url.'/'.$http).'">'.text($value).'</a></li>';     
          }
          
     }   
     
     return $option;
}

function get_url($url)
{
     $url = strtolower($url);
     $data = explode(' ',$url);
     return implode('-',$data);
}

function cek_kepemilikan($id_produk)
{
     $CI                 = get_instance();
     $cek['select']      = 'b.username';
     $cek['table']       = 'm_produk a';
     $cek['join'][0]     = array('m_umkm b','b.id_umkm = a.id_umkm');
     $cek['where']       = 'a.id_produk = '.(int)$id_produk;
     $data               = $CI->query_model->getRow($cek);

     if($this->session->identity){
          if($this->session->identity == $data->username)
          {
               return true;
          }else{
               return false;
          }
     }else{
          return false;
     }
}

function cek_foto($url)
{
     $ch = curl_init();
     curl_setopt($ch, CURLOPT_URL, $url);

     curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);

     $content = curl_exec ($ch);

     curl_close ($ch); 
     if($content != "200")
     {
          return false;
     }else{
          return true;
     }
}

function get_ratting_umkm($id)
{
     $CI = get_instance();
     $query['select']  = 'a.ratting_toko';
     $query['table']  = 'm_ulasan a';
     $query['join'][0]   = array('m_produk b','b.id_produk = a.id_produk');
     $query['join'][1]   = array('m_umkm c','c.id_umkm = b.id_umkm');
     $query['where']  = 'b.id_umkm = '.(int)$id;
     $jumlah = $CI->query_model->getNum($query);
     $total = $CI->query_model->getData($query);

     $hasil = 0;
     foreach ($total as $key => $value) {
         $hasil = $hasil + $value->ratting_toko; 
     }
     if($hasil)
     {
          return $hasil / $jumlah;
     }
     else{
          return 0;
     }
     
}

function get_jumlah_ulasan($id)
{
     $CI = get_instance();
     $query['select']  = 'a.ratting_toko';
     $query['table']  = 'm_ulasan a';
     $query['join'][0]   = array('m_produk b','b.id_produk = a.id_produk');
     $query['join'][1]   = array('m_umkm c','c.id_umkm = b.id_umkm');
     $query['where']  = 'b.id_umkm = '.(int)$id;
     $jumlah = $CI->query_model->getNum($query);
     return $jumlah;
}

function get_jumlah_diskusi($id)
{
      $CI = get_instance();
     $query['select']  = 'a.username';
     $query['table']  = 'm_diskusi a';
     $query['join'][0]   = array('m_produk b','b.id_produk = a.id_produk');
     $query['join'][1]   = array('m_umkm c','c.id_umkm = b.id_umkm');
     $query['where']  = 'b.id_umkm = '.(int)$id;
     $jumlah = $CI->query_model->getNum($query);
     return $jumlah;
}


function get_icon($nama)
{
     $nama = strtoupper(substr($nama,0,1));
     return "<div class='icon-foto btn-gradient'>
                    <span>".$nama."</span>
             </div>";
}

function cek_ulasan($id)
{
     $CI = get_instance();
     $query['select']  = '*';
     $query['table']  = 'm_ulasan';
     $query['where']  = 'id_transaksi = '.(int)$id;
     $result = $CI->query_model->getNum($query);
     return $result;
}


function get_propinsi($id_prop){
     $CI = get_instance();
     $link = 'https://opendatav2.tangerangkota.go.id/services/wilayah/propinsi/no_prop/'.$id_prop;
     $CI->curl->create($link); 
     $CI->curl->http_login(REST_U, REST_P);
     $result = json_decode($CI->curl->execute(), true);
     foreach ($result['data'] as $value) {
          $nama = $value['NAMA_PROP'];
     }
     return text($nama);
}

function update_ratting_produk($arr_id_produk)
{
     $CI = get_instance();
     //get rata2 rating produk dr m_ulasan
     $CI->db->select('id_produk,AVG(ratting) as avg_rating');
     $CI->db->from('m_ulasan');
     $CI->db->where_in('id_produk',$arr_id_produk);
     $CI->db->group_by('id_produk');
     $ulasan = $CI->db->get()->result();

     $data_rating_produk = array();
     foreach ($ulasan as $key => $u) {
          $data_rating_produk[] = array('id_produk' => $u->id_produk,
                                        'ratting' => $u->avg_rating,
                                        'updated_at'  => date('Y-m-d H:s:i')
                                   );
     }

     $CI->db->update_batch('m_produk', $data_rating_produk, 'id_produk');
     return true;
}

function update_ratting_toko($id_umkm){
     $CI = get_instance();

     $CI->db->select('AVG(ratting_toko) as avg_rating');
     $CI->db->from('m_ulasan');
     $CI->db->where('id_umkm',$id_umkm);
     $ulasan = $CI->db->get()->row();

     $data_rating_toko = array('ratting' => $ulasan->avg_rating);
     $where = array('id_umkm' => $id_umkm);
     $CI->db->update('m_umkm', $data_rating_toko, $where);
     return true;
}

function xss($var)
{
     return htmlentities($var, ENT_QUOTES, 'UTF-8');
}

function cetak($data)
{
     return htmlentities($data, ENT_QUOTES, 'UTF-8');
}

function url($data)
{
     return  $hasil = str_replace(' ','-',strtolower($data));
}

function update_dilihat($id_produk,$dilihat)
{
     $CI = get_instance();
     $jumlah = $dilihat + 1;
     $hasil = array('dilihat' => $jumlah);
     $CI->query_model->update('m_produk',array('id_produk' => $id_produk), $hasil);
     
     if($CI->session->identity){  
          $history = array(
               'id_produk'     => $id_produk,
               'username'      => $CI->session->identity,
               'created_at'    => date('Y-m-d H:s:i'),
          );


          $CI->query_model->insert('m_history',$history);
     }
     

     return true;
}

function short($in, $to_num = false, $pad_up = false, $pass_key = '')
{
     $out   =   '';
     $index = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
     $base  = strlen($index);

     if ($pass_key !== null) {
          for ($n = 0; $n < strlen($index); $n++) {
               $i[] = substr($index, $n, 1);
          }

          $pass_hash = hash('sha256',$pass_key);
          $pass_hash = (strlen($pass_hash) < strlen($index) ? hash('sha512', $pass_key) : $pass_hash);

          for ($n = 0; $n < strlen($index); $n++) {
               $p[] =  substr($pass_hash, $n, 1);
          }

          array_multisort($p, SORT_DESC, $i);
          $index = implode($i);
     }

     if ($to_num) {

          $len = strlen($in) - 1;

          for ($t = $len; $t >= 0; $t--) {
               $bcp = bcpow($base, $len - $t);
               $out = floatval($out) + floatval(strpos($index, substr($in, $t, 1))) * floatval($bcp);
          }

          if (is_numeric($pad_up)) {
               $pad_up--;

               if ($pad_up > 0) {
                    $out -= pow($base, $pad_up);
               }
          }
     } else {
          if (is_numeric($pad_up)) {
               $pad_up--;

               if ($pad_up > 0) {
                    $in += pow($base, $pad_up);
               }
          }

          for ($t = ($in != 0 ? floor(log($in, $base)) : 0); $t >= 0; $t--) {
               $bcp = bcpow($base, $t);
               $a   = floor($in / $bcp) % $base;
               $out = $out . substr($index, $a, 1);
               $in  = $in - ($a * $bcp);
          }
     }

     return $out;
}


function update_dilihat_berita($data)
{
     $CI = get_instance();
     $jumlah = $data->dilihat + 1;
     $hasil = array('dilihat' => $jumlah,);
     $CI->query_model->update('m_berita',array('id_berita' => $data->id_berita), $hasil);     
     return true;
}


function format_uang($id)
{
     if(!empty($id))
     {
          $data = explode(',',$id);
          return str_replace('.','',$data[0]);
     }else{
          return 0;
     }

}

function get_kota($id_prop,$id_kota){
     $CI = get_instance();
     $link = 'https://opendatav2.tangerangkota.go.id/services/wilayah/kabupatenbyidkab/no_prop/'.$id_prop.'/no_kab/'.$id_kota;
     $CI->curl->create($link); 
     $CI->curl->http_login(REST_U, REST_P);
     $result = json_decode($CI->curl->execute(), true);
     foreach ($result['data'] as $value) {
          $nama = $value['NAMA_KAB'];
     }
     return text($nama);
}

function get_kec($id_prop,$id_kota,$id_kec){
     $CI = get_instance();
     $link = 'https://opendatav2.tangerangkota.go.id/services/wilayah/kecamatanbyidkec/no_prop/'.$id_prop.'/no_kab/'.$id_kota.'/no_kec/'.$id_kec;
     $CI->curl->create($link); 
     $CI->curl->http_login(REST_U, REST_P);
     $result = json_decode($CI->curl->execute(), true);
     foreach ($result['data'] as $value) {
          $nama = $value['NAMA_KEC'];
     }
     return text($nama);
}

function get_kel($id_prop,$id_kota,$id_kec,$id_kel){
     $CI = get_instance();
     $link = 'https://opendatav2.tangerangkota.go.id/services/wilayah/kelurahanbyidkel/no_prop/'.$id_prop.'/no_kab/'.$id_kota.'/no_kec/'.$id_kec.'/no_kel/'.$id_kel;
     $CI->curl->create($link); 
     $CI->curl->http_login(REST_U, REST_P);
     $result = json_decode($CI->curl->execute(), true);
     foreach ($result['data'] as $value) {
          $nama = $value['NAMA_KEL'];
     }
     return text($nama);
}


function get_kecamatan($kecamatan){
     $CI = get_instance();
     $link = 'https://opendatav2.tangerangkota.go.id/services/wilayah/kecamatanbyidkec/no_prop/36/no_kab/71/no_kec/'.$kecamatan;
     $CI->curl->create($link); 
     $CI->curl->http_login(REST_U, REST_P);
     $result = json_decode($CI->curl->execute(), true);
     foreach ($result['data'] as $value) {
          $nama = $value['NAMA_KEC'];
     }
     return text($nama);
}

function get_kelurahan($kecamatan,$kelurahan){
     $CI = get_instance();
     $link = 'https://opendatav2.tangerangkota.go.id/services/wilayah/kelurahanbyidkel/no_prop/36/no_kab/71/no_kec/'.$kecamatan.'/no_kel/'.$kelurahan;
     $CI->curl->create($link); 
     $CI->curl->http_login(REST_U, REST_P);
     $result = json_decode($CI->curl->execute(), true);
     foreach ($result['data'] as $value) {
          $nama = $value['NAMA_KEL'];
     }
     return text($nama);
}



function text($data)
{
     return xss(ucwords(strtolower($data)));
}


function rp($data)
{
     if(!empty($data))
     {
        return number_format($data,0,',','.');
     }else{
        return 0;
     }
}

function get_foto($token){
     $useragent = 'Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0';
     $json_url = 'https://service-tlive.tangerangkota.go.id/services/tlive/avatar/my';
     $ch = curl_init( $json_url );
     curl_setopt($ch, CURLOPT_USERAGENT, $useragent );
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
     curl_setopt($ch, CURLOPT_HTTPHEADER, array('x-api-key:'.$token));
     curl_setopt($ch, CURLOPT_USERPWD, SERV_U . ':' . SERV_P);
     $result = json_decode(curl_exec($ch),true);
     if($result['success'])
     {
          return $result['data']['url'];
     }else{
          return null;
     }
}

function get_id_kecamatan($kecamatan){
     if($kecamatan == 'KARANGTENGAH')
     {
          $kecamatan = "KARANG TENGAH";
     }
     else if($kecamatan == 'BATUCEPER')
     {
          $kecamatan = "BATU CEPER";
     }


     $CI = get_instance();
     $query['select']    = 'b.nama_kec, b.no_kec';
     $query['table']     = 'm_kecamatan b';
     $query['where']     = 'b.nama_kec = "'.$kecamatan.'"';
     $data               = $CI->query_model->getRow($query);
     if(!empty($data))
     {
          return $data->no_kec;
     }else{
          return 0;
     }

}

function get_data_kecamatan($kecamatan){
     if($kecamatan == 'KARANGTENGAH')
     {
          $kecamatan = "KARANG TENGAH";
     }
     else if($kecamatan == 'BATUCEPER')
     {
          $kecamatan = "BATU CEPER";
     }


     return text($kecamatan);

}


function get_id_kelurahan($kecamatan,$kelurahan){
     if($kecamatan == 'KARANGTENGAH')
     {
          $kecamatan = "KARANG TENGAH";
     }
     else if($kecamatan == 'BATUCEPER')
     {
          $kecamatan = "BATU CEPER";
     }

     $CI = get_instance();
     $query['select']    = 'c.no_kel, c.nama_kel';
     $query['table']     = 'm_kecamatan b';
     $query['join'][0]   = array('m_kelurahan c','c.no_kec = b.no_kec');
     $query['where']     = 'b.nama_kec = "'.$kecamatan.'" AND c.nama_kel = "'.$kelurahan.'"';
     $data               = $CI->query_model->getRow($query);
     if(!empty($data))
     {
          return $data->no_kel;
     }else{
          return 0;
     }
}

function format_tanggal($data)
{
     $date = explode('/', $data);
     return $date[2].'-'.$date[1].'-'.$date[0];
}

function kode_kecamatan($id)
{
     $CI = get_instance();
     $query['select']    = '*';
     $query['table']     = 'm_kecamatan';
     $query['where']     = 'id_kabkota = 328 AND id_kecamatan = '.$id;
     $data               = $CI->query_model->getRow($query);
     if(!empty($data))
     {
          return $data->kode_kecamatan;
     }else{
          return '000';
     }
}

function kode_kelurahan($id)
{
     $CI = get_instance();
     $query['select']    = '*';
     $query['table']     = 'm_kelurahan';
     $query['where']     = 'id_kelurahan = '.$id;
     $data               = $CI->query_model->getRow($query);
     if(!empty($data))
     {
          return $data->kode_desa;
     }else{
          return '00';
     }
}

function get_list_kecamatan()
{
     $CI = get_instance();
     $query['select']    = '*';
     $query['table']     = 'm_kecamatan';
     $data               = $CI->query_model->getData($query);
     return $data;
}

function toDesc($data)
{
     $input = substr($data,0,-1);
     $values = explode(",",$input);
     $rest = '';
     foreach ($values as $key => $value) {
          $rest .= chr($value);
     }
     return $rest;
}

function cek_email($email)
{
     $cek = false;
     if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $cek = true;
     }
     return $cek;
}

function readMore($text, $length, $mode = 2)
{
     $text = strip_tags($text);
     $jumlah_kata = strlen($text);
     if($jumlah_kata <= $length)
     {
         return $text;
     }
     else{
          if ($mode != 1)
          {
               $char = $text{$length - 1};
               switch($mode)
               {
                    case 2: 
                    while($char != ' ') {
                         $char = $text{--$length};
                    }
                    case 3:
                    while($char != ' ') {
                         $char = $text{++$num_char};
                    }
               }
          }
          return substr($text, 0, $length).' ...';
     }

}

function get_sarana_usaha($data)
{
     $hasil = array();

     $CI = get_instance();
     $cek['select'] = '*';
     $cek['table'] = 'm_sarana_usaha';
     $cek['where'] = 'status = 1';
     $query = $CI->query_model->getData($cek);
     $result = unserialize($data);
     foreach ($result as $key) {
          foreach ($query as $value) {
               if($value->id_sarana_usaha == $key){
                    $hasil[] = $value->nama_sarana;
               }
          }
     }

     return implode(" , ",$hasil);
}

function get_sektor_usaha($data)
{
     $hasil = array();

     $CI = get_instance();
     $cek['select'] = '*';
     $cek['table'] = 'm_sektor_usaha';
     $cek['where'] = 'status = 1';
     $query = $CI->query_model->getData($cek);
     $result = unserialize($data);
     foreach ($result as $key) {
          foreach ($query as $value) {
               if($value->id_sektor_usaha == $key){
                    $hasil[] = $value->nama_sektor_usaha;
               }
          }
     }

     return implode(" , ",$hasil);
}

function get_nama_kurir($data){
     $hasil = array();

     $CI = get_instance();
     $cek['select'] = '*';
     $cek['table'] = 'm_kurir';
     $cek['where'] = 'status = 1';
     $query = $CI->query_model->getData($cek);
     $result = json_decode($data);
     foreach ($result as $key) {
          foreach ($query as $value) {
               if($value->id_kurir == $key){
                    $hasil[] = $value->nama_kurir;
               }
          }
     }

     return implode(" , ",$hasil);
}

function get_kurir($where=null,$where_in=null){
     $CI = get_instance();
     $CI->db->select('*');
     $CI->db->from('m_kurir');
     $CI->db->where('status',1);
     if ($where) {
          $CI->db->where($where);
     }
     if ($where_in) {
          $CI->db->where_in('id_kurir',$where_in);
     }

     return $CI->db->get()->result_array();
}

function option_sarana_usaha($data=null)
{
     $hasil = array();
     if ($data) {
        $result = unserialize($data);
          foreach ($result as $key) {
               $hasil[] = $key;
          }
     }
     return $hasil;
}

function indonesian_date ($timestamp = '', $date_format = 'l, j F Y | H:i', $suffix = 'WIB') {

     if($timestamp)
     {
          if (trim ($timestamp) == '')
          {
             $timestamp = time ();
          }
          elseif (!ctype_digit ($timestamp))
          {
            $timestamp = strtotime ($timestamp);
          }

          $date_format = preg_replace ("/S/", "", $date_format);
          $pattern = array (
            '/Mon[^day]/','/Tue[^sday]/','/Wed[^nesday]/','/Thu[^rsday]/',
            '/Fri[^day]/','/Sat[^urday]/','/Sun[^day]/','/Monday/','/Tuesday/',
            '/Wednesday/','/Thursday/','/Friday/','/Saturday/','/Sunday/',
            '/Jan[^uary]/','/Feb[^ruary]/','/Mar[^ch]/','/Apr[^il]/','/May/',
            '/Jun[^e]/','/Jul[^y]/','/Aug[^ust]/','/Sep[^tember]/','/Oct[^ober]/',
            '/Nov[^ember]/','/Dec[^ember]/','/January/','/February/','/March/',
            '/April/','/June/','/July/','/August/','/September/','/October/',
            '/November/','/December/',
          );
          $replace = array ( 'Sen','Sel','Rab','Kam','Jum','Sab','Min',
            'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu',
            'Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des',
            'Januari','Februari','Maret','April','Juni','Juli','Agustus','Sepember',
            'Oktober','November','Desember',
          );
          $date = date ($date_format, $timestamp);
          $date = preg_replace ($pattern, $replace, $date);
          $date = "{$date} {$suffix}";
          return $date;
     }
     else{
          return null;
     }
} 

function indonesian_date_2 ($tanggal) {
     if($tanggal)
     {
          $hari = array ( 1 =>    'Senin',
               'Selasa',
               'Rabu',
               'Kamis',
               'Jumat',
               'Sabtu',
               'Minggu'
          );

          $bulan = array (1 =>   'Januari',
               'Februari',
               'Maret',
               'April',
               'Mei',
               'Juni',
               'Juli',
               'Agustus',
               'September',
               'Oktober',
               'November',
               'Desember'
          );
          $split      = explode('-', $tanggal);
          $tgl_indo = $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
          $num = date('N', strtotime($tanggal));
          return $hari[$num] . ', ' . $tgl_indo;
     }else{
          return null;
     }
}

function indonesian_date_5($tanggal, $cetak_hari = false,$singkat_hari = false, $singkat_bulan = false,$cetak_tahun = true){
    if ($singkat_hari) {
        $hari = array ( 1 => 'Sen','Sel','Rab','Kam','Jum','Sab','Min');
    }else{
        $hari = array ( 1 => 'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu');
    }
    
    if ($singkat_bulan) {
        $bulan = array (1 => 'Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des');
    }else{
        $bulan = array (1 => 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
    }
            
    $split    = explode('-', $tanggal);
    if ($cetak_tahun) {
          $tgl_indo = $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
    }else{
          $tgl_indo = $split[2] . ' ' . $bulan[ (int)$split[1] ];
    }
    
    if ($cetak_hari) {
        $num = date('N', strtotime($tanggal));
        return $hari[$num] . ', ' . $tgl_indo;
    }
    return $tgl_indo;
}

function getDayIndonesia($day)
{
   switch (strtolower($day)) {
       case "sun":
           return "Minggu";
       case "mon":
           return "Senin";
       case "tue":
           return "Selasa";
       case "wed":
           return "Rabu";
       case "thu":
           return "Kamis";
       case "fri":
           return "Jumat";
       case "sat":
           return "Sabtu";
       default:
           return $day;
   }
}

function unggah_berkas($path, $nama_file, $type) {

     $CI = get_instance();
     $config['upload_path'] = './assets/uploads/'.$path.'/';
     $config['allowed_types'] = $type;
     $config['max_size']	= '262144';	
     $config['file_name'] = $nama_file;
     $config['overwrite'] = TRUE;

     $CI->upload->initialize($config);

     return $config['file_name'];
}


function jumlah_total($n, $precision = 1 ) {
     if ($n < 900) {
         // 0 - 900
         $n_format = number_format($n, $precision);
         $suffix = '';
     } else if ($n < 900000) {
         // 0.9k-850k
         $n_format = number_format($n / 1000, $precision);
         $suffix = 'K';
     } else if ($n < 900000000) {
         // 0.9m-850m
         $n_format = number_format($n / 1000000, $precision);
         $suffix = 'M';
     } else if ($n < 900000000000) {
         // 0.9b-850b
         $n_format = number_format($n / 1000000000, $precision);
         $suffix = 'B';
     } else {
         // 0.9t+
         $n_format = number_format($n / 1000000000000, $precision);
         $suffix = 'T';
     }
   // Remove unecessary zeroes after decimal. "1.0" -> "1"; "1.00" -> "1"
   // Intentionally does not affect partials, eg "1.50" -> "1.50"
     if ( $precision > 0 ) {
         $dotzero = '.' . str_repeat( '0', $precision );
         $n_format = str_replace( $dotzero, '', $n_format );
     }
     return $n_format . $suffix;
 }

function tampil_bulan ($x) {
     if ($x == 1 ) {
          $bulan = "Jan"; }
          if ($x == 2 ) {
               $bulan = "Feb"; }
               if ($x == 3 ) {
                    $bulan = "Mar"; }
                    if ($x == 4 ) {
                         $bulan = "Apr"; }
                         if ($x == 5 ) {
                              $bulan = "Mei"; }
                              if ($x == 6 ) {
                                   $bulan = "Jun"; }
                                   if ($x == 7 ) {
                                        $bulan = "Jul"; }
                                        if ($x == 8 ) {
                                             $bulan = "Agu"; }
                                             if ($x == 9 ) {
                                                  $bulan = "Sep"; }
                                                  if ($x == 10) {
                                                       $bulan = "Okt"; }
                                                       if ($x == 11) {
                                                            $bulan = "Nov"; }
                                                            if ($x == 12) {
                                                               $bulan = "Des"; }
                                                               return $bulan;
}

function cek_nik($nik){
     $useragent = 'Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0';
     $json_url = 'https://service-tlive.tangerangkota.go.id/services/tlive/ceknik/cek_nik/'.$nik;
     $ch = curl_init( $json_url );
     curl_setopt($ch, CURLOPT_USERAGENT, $useragent );
     curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
     curl_setopt($ch, CURLOPT_USERPWD, SERV_U . ':' . SERV_P);
     $result = json_decode(curl_exec($ch),true);
     return $result;
}

function get_nama_izin_usaha(){
     $data = array('IUMK','SIUP','SKDU','SKU','PIRT','HALAL','LAINNYA');
     return $data;
}

function get_jenis_toko_online(){
     $data = array('Tokopedia','Bukalapak','Lazada','Shopee','Blibli','Zalora','JDID','OLX','Lainnya');
     return $data;
}

function get_jenis_ojol(){
     $data = array('Gojek','Grab');
     return $data;
}

function get_jenis_medsos(){
     $data = array('Facebook','Instagram','Twitter','Whatsapp','Lainnya');
     return $data;
}

function isJSON($string){
   return is_string($string) && is_array(json_decode($string, true)) && (json_last_error() == JSON_ERROR_NONE) ? true : false;
}

function nonaktifkan_produk_by_umkm($id_umkm){
     $CI = get_instance();
     $data_produk = array('status' => 3,'alasan' => 'Status Verifikasi UMKM di Tolak');
     $CI->query_model->update('m_produk',array('id_umkm' => $id_umkm,'status !=' => '2'), $data_produk);
}

function aktifkan_produk_by_umkm($id_umkm){
     $CI = get_instance();
     $data_produk = array('status' => 1);
     $CI->query_model->update('m_produk',array('id_umkm' => $id_umkm,'status !=' => '2'), $data_produk);
}

function keranjangku(){
     $CI = get_instance();
     // if($CI->user_model->is_login())
     // {
     //      $data['keranjang']     = $CI->query_model->keranjang('data',5);
     //      $data['jml_keranjang'] = $CI->query_model->keranjang('jumlah');
     // }else{
     //      $data['keranjang'] = null;
     //      $data['jml_keranjang'] = 0;
     // }
     $data['keranjang']     = $CI->query_model->keranjang('data',5);
     $data['jml_keranjang'] = $CI->query_model->keranjang('jumlah');

     return $data;
}

function get_most_search()
{
     $CI = get_instance();
     $CI->db->select('id_produk,kode_produk,nama_produk');
     $CI->db->from('m_produk');
     $CI->db->where('status','1');
     $CI->db->order_by('dilihat','desc');
     $CI->db->limit(5);
     $res = $CI->db->get()->result();
     return $res;
}

function card_berita($data,$class=''){
     $html = '<div class="blog__item">
               <div class="blog__item__pic set-bg" data-setbg="'.base_url('assets/images/berita/').$data->foto.'"></div>
               <div class="blog__item__text">
               <span><img src="img/icon/calendar.png" alt=""> '.indonesian_date($data->created_at).'</span>
               <h5>'.$data->judul.'</h5>
               <a href="'.base_url('list-berita/berita/'.short($data->kode_berita)).'">Read More</a>
               </div>
          </div>';
     return $html;
}

function card_agenda($data,$class=''){
     $html = '<div class="'.$class.' blog-post-item">
                  <div class="blog-img">
                      <a href="'.base_url('agenda/detail/'.short($data->kode_agenda)).'" class="hover-images"><img style="width: 440px; height: 345px; object-fit:cover; display: block;margin-left: auto;margin-right: auto;" src="'.base_url('assets/images/agenda/').$data->foto.'" alt="" class="img-reponsive"></a>
                      <div class="blog-post-date e-gradient abs">
                          <span class="b-date">'.$data->day.'</span>
                          <span class="b-month">'.tampil_bulan($data->bulan).'</span>
                      </div>
                  </div>
                  <div class="blog-info">
                      <h3 class="blog-post-title" title="<?php echo $data->judul; ?>"><a href="'.base_url('agenda/detail/'.short($data->kode_agenda)).'">'.readMore($data->judul,50).'</a></h3>
                      <div><i class="fa fa-calendar"></i> '.indonesian_date_2($data->tanggal).'</div>
                      <div><i class="fa fa-map-marker"></i> '.$data->lokasi.'</div>

                      <p class="blog-post-desc" style="margin-top: 10px; margin-bottom: 0px !important;">'.readMore($data->keterangan,200).'</p>
                  </div>
              </div>';
     return $html;
}

function card_dasarhukum($data,$class=''){
     $html =   '<div class="'.$class.' blog-post-item">
                    <div class="blog-info" style="padding: 10px 12px 10px 24px;">
                       <h3 style="margin-bottom:10px;" class="blog-post-title" title="'.$data->judul.'"><a href="'.base_url('dasar_hukum/detail/'.short($data->kode_dasar_hukum)).'">'.readMore($data->judul,50).'</a></h3>
                       <div style="margin-bottom:10px;"><i class="fa fa-clock-o"></i> '.indonesian_date($data->created_at).'</div>
                       <p class="blog-post-desc">'.readMore($data->keterangan,200).'</p>
                    </div>
               </div>';
     return $html;
}

function card_produk($data,$class='', $diskon = null){
     // echo $data
     $CI = get_instance();
     
     $jum_ulasan = ($data->jumlah_ulasan)? $data->jumlah_ulasan : "Belum Ada";

     if ($data->id_wishlist) {
          $icon_love = '<i class="fa fa-heart wish-'.$data->id_produk.'" style="color:#e95a5c;"></i>';
     }else{
          $icon_love = '<i class="fa fa-heart-o wish-'.$data->id_produk.'"></i>';
     }
     $sale='';


     $jumlah = 5 - $data->ratting;
     $icon_star = ''; 
     for($i=0; $i<$data->ratting; $i++){
          $icon_star .= '<i class="fa fa-star star"></i>';
     }

     for($i=0; $i<$jumlah; $i++){
          $icon_star .= '<i class="fa fa-star-o star"></i>';
     }

     $ribbon_price = '';
     
     if ($data->nik) {
          if($CI->session->identity == $data->nik){
               $btn_keranjang = '<span></span>';
          }
     }else{
          $btn_keranjang = '<a href="javascript:void(0)" class="add-cart" data-id="'.$data->id_produk.'" title="Tambahkan ke Keranjang">+ Add To Cart</a>';
     }

     if (isset($data->cara_pembayaran)) {
          if ($data->cara_pembayaran == 'langsung') {
               $btn_keranjang = '<span></span>';
          }
     }

     if (isset($data->stok) && $data->stok <= 0) {
          $ribbon_price = '<div class="ribbon-price grey"><span>Habis</span></div>';
          $btn_keranjang = '<span></span>';
     }
     

     if ($data->diskon > 0) {
          $ribbon_price = '<span class="label">' . round($data->diskon, 1) . '%</span>';
          $sale='sale';
          $price = '
               <div class="product-price">
                    <span class="red">Rp. '.rp($data->harga - $data->diskon_nominal).'</span>
                    <span class="old">Rp. '.rp($data->harga).'</span>
               </div>
          ';
     } else {

          $price = '<div class="product-price"><span>Rp. '.rp($data->harga).'</span></div>';
     }

     if ($diskon == null) {
          $parameter = short($data->kode_produk);
     } else {
          $parameter = short($data->kode_produk) . '/diskon';
     }


     $html = '
     <div class="product__item '.$sale.'">
          
               <div>
                    <div class="product__item__pic set-bg" data-setbg="'.base_url('assets/produk/'.$data->username.'/'.$data->foto).'" style="background-image : url('.base_url('assets/produk/'.$data->username.'/'.$data->foto).')">
                              '.$ribbon_price.'
                         <ul class="product__hover">
                              <li>
                                   <a href="javascript:void(0)" style="background-color:#fff; font-size:20px;" class="btn btn-icon" title="Tambahkan ke Favorit" onclick="wishlist('.$data->id_produk.')">'.$icon_love.'
                                   </a>
                              </li>
                              <li><a class="btn btn-icon" style="background-color:#fff; font-size:20px;" href="'.base_url('list-produk/produk/'.$parameter).'"><i class="fa fa-eye"></i></a></li>

                         </ul>
                    </div>
               </div>
          <div class="product__item__text product-info">
               <h6>  
               <a  href="'.base_url('list-produk/produk/'.$parameter).'">'.readMore($data->nama_produk,50).'</a>
                    
               </h6>
               <div class="rating">
                    '.$icon_star.'
               </div>
               <h5>'.$price.'</h5>
               <div class="number-rating">( '.$jum_ulasan.' Ulasan )</div>
          </div>
     </div>
     
     ';

     return $html;
}

function card_umkm($data){
     if ($data['umkm']->logo_umkm) {
          $icon_umkm = '<img src="'.base_url().'assets/logo/'.$data['umkm']->logo_umkm.'" alt="" class="img-reponsive image-umkm">';
     }else{
          $icon_umkm = get_icon($data['umkm']->namausaha);
     }

     $icon_verify = '';
     if ($data['umkm']->id_status == 1) {
          $icon_verify = '<i class="fa fa-check-circle fa-gradient"></i>';
     }

     $jumlah = 5 - $data['umkm']->ratting;
     $icon_star = ''; 
     for($i=0; $i<$data['umkm']->ratting; $i++){
          $icon_star .= '<i class="fa fa-star star"></i>';
     }

     for($i=0; $i<$jumlah; $i++){
          $icon_star .= '<i class="fa fa-star-o star"></i>';
     }

     $produk = '';
     if ($data['produk']) {
          foreach ($data['produk'] as $p) {
               if ($p->diskon > 0) {
                    $price = '<span class="harga-produk">Rp. '.rp($p->harga - $p->diskon_nominal).'</span><br>
                              <span class="harga-produk-diskon">Rp. '.rp($p->harga).'</span>';
               }else{
                    $price = '<span class="harga-produk">Rp. '.rp($p->harga).'</span>';
               }
               
               $produk .= '<div class="product-img" style="width: 70px; display: block;margin-right: auto;">
                              <a href="'.base_url('list-produk/produk/'.short($p->kode_produk)).'" title="'.$p->nama_produk.'"><img src="'.base_url('assets/produk/'.$data['umkm']->id_umkm.'/'.$p->foto).'" alt="'.$p->nama_produk.'" class="img-reponsive image-produk"></a>
                              '.$price.'
                         </div>';
          } 
     }else{
          $produk = '<span class="product-cate" style="text-align: center;width: 100%;">Toko tidak memiliki produk</span>';
     }

     $html =   '<div class="col-xs-12 col-sm-6 col-md-4 product-item">
                    <div class="pd-bd product-inner v2" style="padding: 10px;">
                        <div class="flex align-center">
                            <div class="product-img" style="margin-right: 10px;width: 80px;">
                                <a href="'.base_url().'toko/'.short($data['umkm']->id_umkm).'">'.$icon_umkm.'</a>
                            </div>
                            <div class="product-info" style="margin-top: inherit;">
                                <div class="element-list element-list-middle"> 
                                    <h3 class="product-title" style="font-size: 12px;margin-bottom: 3px;">
                                        <a href="'.base_url().'toko/'.short($data['umkm']->id_umkm).'">'.text($data['umkm']->namausaha).' '.$icon_verify.'</a>
                                    </h3>
                                             <p class="product-cate" style="font-size: 9px;margin-bottom: 3px;">
                                                  <a href="'.base_url().'list-umkm?kat='.url($data['umkm']->nama_usaha).'">'.$data['umkm']->nama_usaha.'</a>
                                             </p>
                                             <p class="product-cate" style="font-size: 9px;margin-bottom: 3px;">
                                                  <i class="fa fa-map-marker"></i> '.$data['umkm']->nama_kel.'
                                             </p>
                                    <div class="product-bottom v2">
                                             <div class="product-rating bd-rating" style="display: block;font-size: 9px;">
                                                  '.$icon_star.'
                                             </div>         
                                    </div>
                                </div>
                                        <div class="product-button-group hidden-xs hidden-sm">
                                   <a href="'.base_url().'toko/'.short($data['umkm']->id_umkm).'" class="btn-icon" style="width: 100%;">Lihat Toko</a>
                               </div>
                            </div>
                        </div>
                              <div class="flex align-center" style="padding: 10px;height:110px;margin-bottom:7px;">
                                   '.$produk.'
                              </div>
                              <div class="product-button-group hidden-md hidden-lg" style="margin: 0px;">
                          <a href="'.base_url().'toko/'.short($data['umkm']->id_umkm).'" class="btn-icon" style="width: 100%;">Lihat Toko</a>
                      </div>
                    </div>
                </div>';
     return $html;
}

function cek_stok_produk($id_produk){
     $CI = get_instance();
     $CI->db->select('stok');
     $CI->db->from('m_produk');
     $CI->db->where('status',1);
     $CI->db->where('id_produk',(int)$id_produk);
     $data = $CI->db->get()->row();
     if ($data) {
          $res = $data->stok;
     }else{
          $res = null;
     }
     return $res;
}

function cek_stok_ukuran_produk($id_produk, $ukuran){
     $CI = get_instance();
     $CI->db->select('stok');
     $CI->db->from('m_produk_stok');
     $CI->db->where('id_produk',(int)$id_produk);
     $CI->db->where('ukuran',$ukuran);

     $data = $CI->db->get()->row();
     if ($data) {
          $res = $data->stok;
     }else{
          $res = null;
     }
     return $res;
}

function get_stok_ukuran_produk($id_produk){
     $CI = get_instance();
     $CI->db->select('*');
     $CI->db->from('m_produk_stok');
     $CI->db->where('id_produk',(int)$id_produk);
     $data = $CI->db->get()->result();
     if ($data) {
          $res = $data;
     }else{
          $res = null;
     }
     return $res;
}

if (!function_exists('pre')) {
     /**
      * prettify array
      *
      * @param array $data
      * @param string $type (var_dump, var_export) default = print_r
      *
      * @return string prettified array
     */
     function pre($data = '', $type = 'print_r')
     {
         echo '<pre>';
         $type($data);
         echo '</pre>';
         die;
     }
}

function get_payment_gateway()
{
     $data = [
          'doku'      => 'DOKU',
          'ipay88'    => 'iPay88',
          'ipaymu'    => 'iPaymu',
          'winpay'    => 'Winpay',
          'truemoney' => 'TrueMoney',
          'finpay'    => 'Finpay',
          'kaypay'    => 'KayPay',
          'firstpay'  => 'FirstPay',
          'xendit'    => 'Xendit',
          'duitku'    => 'Duitku',
          'paypal'    => 'PayPal'
     ];
     return $data;
}