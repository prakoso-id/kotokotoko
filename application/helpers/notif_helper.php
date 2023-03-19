<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function send_notif($username_pengirim,$username_penerima,$judul,$message,$modul,$submodul,$id_detail,$jenis=null){
    $ci =& get_instance();
    $useragent = 'Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0';
    $json_url = URL_SERV_TLIVE_UMKM.'/notifikasi/sendNotif';
    $post = array('username_pengirim' => $username_pengirim,
                  'username_penerima' => $username_penerima,
                  'judul' => $judul,
                  'message' => $message,
                  'modul' => $modul,
                  'submodul' => $submodul,
                  'id_detail' => $id_detail,
                  'jenis' => $jenis,
            );
    $params = http_build_query($post);
    $ch = curl_init( $json_url );
    curl_setopt($ch, CURLOPT_USERAGENT, $useragent );
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,$params);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERPWD, SERV_U . ':' . SERV_P);
    $data = json_decode(curl_exec($ch),true);
    // var_dump($data); die();
    return $data;
}

/////////// FUNCTION KIRIM EMAIL TIDAK DIPAKAI KARNA SUDAH INCLUDE DI SERVICE NOTIF T-LIVE ///////////

// email pendaftaran umkm
function kirim_email_pemberitahuan($id){
    $CI = get_instance();
    $query['select']    = 'a.nama_perusahaan,b.nama,b.email';
    $query['table']     = 'm_umkm a';
    $query['join'][0]   = array('m_pengguna b','b.id_pengguna = a.id_pengguna');
    $query['where']     = 'a.id_umkm = '.(int)$id;
    $data               = $CI->query_model->getRow($query);

    $CI->email->from('noreply@tangerangkota.go.id', 'UMKM Kota Tangerang'); 
    $CI->email->to($data->email);
    $CI->email->subject('Pemberitahuan Konfirmasi UMKM '.$data->nama_perusahaan.' - '.indonesian_date(date('Y-m-d H:s:i')));
    $CI->email->message('
        <html>
        <head>
        <title>Data anda berhasil dikirim</title>
        </head>
        <body>
        <style type="text/css">
        h3 {
            font-family:HelveticaNeue-Light,arial,sans-serif; font-size:16px; line-height: 30px; font-weight:bold;margin:0; padding:0
        }
        </style>
        <table align="center" width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#eeeeee" style="padding: 30px;">
        <tbody>
        <td>
        <table align="center" border="0" width="100%" cellspacing="0" cellpadding="0">
        <tr>
        <td bgcolor="#e95a5c" style="padding: 15px; color: #fff; text-align: center;">
        <img src="https://i1.wp.com/abouttng.com/wp-content/uploads/2015/08/Lambang-Kota-Tangerang.png" style="width: 60px; margin-bottom: 10px;">
        <h3>UMKM KOTA TANGERANG</h3>
        </td>
        </tr>
        <tr>
        <td bgcolor="#fff" style="padding: 20px">
        <p style="text-align: justify; color:#000;font-weight:400">
        Hai <b>'.ucfirst(strtolower($data->nama)).'</b>, Terima kasih sudah menggunakan aplikasi ini, proses pengajuan pendaftaran UMKM <b>'.$data->nama_perusahaan.'</b>, berhasil dikirim dan akan segera kami proses untuk ditindaklanjuti, harap menunggu balasan email dari kami untuk proses lebih lanjut.
        </p>
        <p style="text-align: justify; color:#000;font-weight:400">
        Demikian disampaikan, atas perhatian Bapak/Ibu kami ucapkan terima kasih.
        </p>
        <p style="color:#000;font-weight:400;margin:0">
        Salam, 
        </p>
        <p style="color:#000;font-weight:400;margin:0">
        UMKM Kota Tangerang
        </p>
        </td>
        </tr>
        </table>
        </td>
        </tbody>
        </table>
        </body>
        </html>     
        ');
    $CI->email->set_mailtype('html');
    $CI->email->send();
}

function kirim_email_tolak($id){
    $CI = get_instance();
    $query['select']    = 'a.nama_perusahaan,a.alasan,b.nama,b.email,c.nama as nama_status,a.namausaha';
    $query['table']     = 'm_umkm a';
    $query['join'][0]   = array('m_pengguna b','b.id_pengguna = a.id_pengguna');
    $query['join'][1]   = array('m_status c','c.id_status = a.id_status');
    $query['where']     = 'a.id_umkm = '.(int)$id;
    $data               = $CI->query_model->getRow($query);


    $CI->email->from('noreply@tangerangkota.go.id', 'UMKM Kota Tangerang'); 
    $CI->email->to($data->email);
    $CI->email->subject('Proses '.$data->nama_status.' - '.indonesian_date(date('Y-m-d H:s:i')));
    $CI->email->message('
        <html>
        <head>
        <title>Data anda berhasil dikirim</title>
        </head>
        <body>
        <style type="text/css">
        h3 {
            font-family:HelveticaNeue-Light,arial,sans-serif; font-size:16px; line-height: 30px; font-weight:bold;margin:0; padding:0
        }
        </style>
        <table align="center" width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#eeeeee" style="padding: 30px;">
        <tbody>
        <td>
        <table align="center" border="0" width="100%" cellspacing="0" cellpadding="0">
        <tr>
        <td bgcolor="#e95a5c" style="padding: 15px; color: #fff; text-align: center;">
        <img src="https://i1.wp.com/abouttng.com/wp-content/uploads/2015/08/Lambang-Kota-Tangerang.png" style="width: 60px; margin-bottom: 10px;">
        <h3>UMKM KOTA TANGERANG</h3>
        </td>
        </tr>
        <tr>
        <td bgcolor="#fff" style="padding: 20px">
        <p style="text-align: justify; color:#000;font-weight:400">
        Hai <b>'.ucfirst(strtolower($data->nama)).'</b>, Terima kasih sudah menggunakan aplikasi ini, maaf proses <b>'.$data->nama_status.' </b> dengan nama usaha <b>'.$data->namausaha.'</b> karena <b>'.$data->alasan.'</b>.
        </p>
        <p style="text-align: justify; color:#000;font-weight:400">
        Demikian disampaikan, atas perhatian Bapak/Ibu kami ucapkan terima kasih.
        </p>
        <p style="color:#000;font-weight:400;margin:0">
        Salam, 
        </p>
        <p style="color:#000;font-weight:400;margin:0">
        UMKM Kota Tangerang
        </p>
        </td>
        </tr>
        </table>
        </td>
        </tbody>
        </table>
        </body>
        </html>     
        ');
    $CI->email->set_mailtype('html');
    $CI->email->send();
}

function kirim_email_non($id){
    $CI = get_instance();
    $query['select']    = 'a.nama_perusahaan,a.alasan,b.nama,b.email,c.nama as nama_status,a.namausaha';
    $query['table']     = 'm_umkm a';
    $query['join'][0]   = array('m_pengguna b','b.id_pengguna = a.id_pengguna');
    $query['join'][1]   = array('m_status c','c.id_status = a.id_status');
    $query['where']     = 'a.id_umkm = '.(int)$id;
    $data               = $CI->query_model->getRow($query);


    $CI->email->from('noreply@tangerangkota.go.id', 'UMKM Kota Tangerang'); 
    $CI->email->to($data->email);
    $CI->email->subject('Akun UMKM Dinonaktifkan Karena '.$data->alasan.' - '.indonesian_date(date('Y-m-d H:s:i')));
    $CI->email->message('
        <html>
        <head>
        <title>Data anda berhasil dikirim</title>
        </head>
        <body>
        <style type="text/css">
        h3 {
               font-family:HelveticaNeue-Light,arial,sans-serif; font-size:16px; line-height: 30px; font-weight:bold;margin:0; padding:0
        }
	    </style>
	    <table align="center" width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#eeeeee" style="padding: 30px;">
	    <tbody>
	    <td>
	    <table align="center" border="0" width="100%" cellspacing="0" cellpadding="0">
	    <tr>
	    <td bgcolor="#e95a5c" style="padding: 15px; color: #fff; text-align: center;">
	    <img src="https://i1.wp.com/abouttng.com/wp-content/uploads/2015/08/Lambang-Kota-Tangerang.png" style="width: 60px; margin-bottom: 10px;">
	    <h3>UMKM KOTA TANGERANG</h3>
	    </td>
	    </tr>
	    <tr>
	    <td bgcolor="#fff" style="padding: 20px">
	    <p style="text-align: justify; color:#000;font-weight:400">
	    Hai <b>'.ucfirst(strtolower($data->nama)).'</b>, Terima kasih sudah menggunakan aplikasi ini, maaf UMKM dengan nama usaha <b>'.$data->namausaha.'</b> di nonaktifkan karena <b>'.$data->alasan.'</b>.
	    </p>
	    <p style="text-align: justify; color:#000;font-weight:400">
	    Demikian disampaikan, atas perhatian Bapak/Ibu kami ucapkan terima kasih.
	    </p>
	    <p style="color:#000;font-weight:400;margin:0">
	    Salam, 
	    </p>
	    <p style="color:#000;font-weight:400;margin:0">
	    UMKM Kota Tangerang
	    </p>
	    </td>
	    </tr>
	    </table>
	    </td>
	    </tbody>
	    </table>
	    </body>
	    </html>     
	    ');
    $CI->email->set_mailtype('html');
    $CI->email->send();
}

function kirim_email_terima($id){
    $CI = get_instance();
    $query['select']    = 'a.nama_perusahaan,a.alasan,b.nama,b.email,c.nama as nama_status,a.namausaha';
    $query['table']     = 'm_umkm a';
    $query['join'][0]   = array('m_pengguna b','b.id_pengguna = a.id_pengguna');
    $query['join'][1]   = array('m_status c','c.id_status = a.id_status');
    $query['where']     = 'a.id_umkm = '.(int)$id;
    $data               = $CI->query_model->getRow($query);


    $CI->email->from('noreply@tangerangkota.go.id', 'UMKM Kota Tangerang'); 
    $CI->email->to($data->email);
    $CI->email->subject('Proses '.$data->nama_status.' - '.indonesian_date(date('Y-m-d H:s:i')));
    $CI->email->message('
        <html>
        <head>
        <title>Data anda berhasil dikirim</title>
        </head>
        <body>
        <style type="text/css">
        h3 {
               font-family:HelveticaNeue-Light,arial,sans-serif; font-size:16px; line-height: 30px; font-weight:bold;margin:0; padding:0
        }
        </style>
        <table align="center" width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#eeeeee" style="padding: 30px;">
        <tbody>
        <td>
        <table align="center" border="0" width="100%" cellspacing="0" cellpadding="0">
        <tr>
        <td bgcolor="#e95a5c" style="padding: 15px; color: #fff; text-align: center;">
        <img src="https://i1.wp.com/abouttng.com/wp-content/uploads/2015/08/Lambang-Kota-Tangerang.png" style="width: 60px; margin-bottom: 10px;">
        <h3>UMKM KOTA TANGERANG</h3>
        </td>
        </tr>
        <tr>
        <td bgcolor="#fff" style="padding: 20px">
        <p style="text-align: justify; color:#000;font-weight:400">
        Hai <b>'.ucfirst(strtolower($data->nama)).'</b>, Terima kasih sudah menggunakan aplikasi ini, proses <b>'.$data->nama_status.' </b> dengan nama usaha <b>'.$data->namausaha.'</b>, Silahkan login dan kemudian logout kembali untuk menggunakan aplikasi.
        </p>
        <p style="text-align: justify; color:#000;font-weight:400">
        Demikian disampaikan, atas perhatian Bapak/Ibu kami ucapkan terima kasih.
        </p>
        <p style="color:#000;font-weight:400;margin:0">
        Salam, 
        </p>
        <p style="color:#000;font-weight:400;margin:0">
        UMKM Kota Tangerang
        </p>
        </td>
        </tr>
        </table>
        </td>
        </tbody>
        </table>
        </body>
        </html>     
        ');
    $CI->email->set_mailtype('html');
    $CI->email->send();
}

function kirim_email_aktif($id){
    $CI = get_instance();
    $query['select']    = 'a.nama_perusahaan,a.alasan,b.nama,b.email,c.nama as nama_status,a.namausaha';
    $query['table']     = 'm_umkm a';
    $query['join'][0]   = array('m_pengguna b','b.id_pengguna = a.id_pengguna');
    $query['join'][1]   = array('m_status c','c.id_status = a.id_status');
    $query['where']     = 'a.id_umkm = '.(int)$id;
    $data               = $CI->query_model->getRow($query);


    $CI->email->from('noreply@tangerangkota.go.id', 'UMKM Kota Tangerang'); 
    $CI->email->to($data->email);
    $CI->email->subject('Akun UMKM sudah diaktifkan kembali - '.indonesian_date(date('Y-m-d H:s:i')));
    $CI->email->message('
        <html>
        <head>
        <title>Data anda berhasil dikirim</title>
        </head>
        <body>
        <style type="text/css">
        h3 {
               font-family:HelveticaNeue-Light,arial,sans-serif; font-size:16px; line-height: 30px; font-weight:bold;margin:0; padding:0
        }
        </style>
        <table align="center" width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#eeeeee" style="padding: 30px;">
        <tbody>
        <td>
        <table align="center" border="0" width="100%" cellspacing="0" cellpadding="0">
        <tr>
        <td bgcolor="#e95a5c" style="padding: 15px; color: #fff; text-align: center;">
        <img src="https://i1.wp.com/abouttng.com/wp-content/uploads/2015/08/Lambang-Kota-Tangerang.png" style="width: 60px; margin-bottom: 10px;">
        <h3>UMKM KOTA TANGERANG</h3>
        </td>
        </tr>
        <tr>
        <td bgcolor="#fff" style="padding: 20px">
        <p style="text-align: justify; color:#000;font-weight:400">
        Hai <b>'.ucfirst(strtolower($data->nama)).'</b>, akun UMKM dengan nama <b>'.$data->namausaha.'</b>, sudah diaktifkan kembali. Silahkan login dan kemudian logout kembali untuk menggunakan aplikasi.
        </p>
        <p style="text-align: justify; color:#000;font-weight:400">
        Demikian disampaikan, atas perhatian Bapak/Ibu kami ucapkan terima kasih.
        </p>
        <p style="color:#000;font-weight:400;margin:0">
        Salam, 
        </p>
        <p style="color:#000;font-weight:400;margin:0">
        UMKM Kota Tangerang
        </p>
        </td>
        </tr>
        </table>
        </td>
        </tbody>
        </table>
        </body>
        </html>     
        ');
    $CI->email->set_mailtype('html');
    $CI->email->send();
}

// email transaksi penjualan dan pembelian

// function kirim_email_transaksi_sukses($id){
//     $CI = get_instance();
//     $query['select']    = 'd.id_transaksi,a.no_invoice,e.nama_produk,d.harga,d.quantity,a.total_harga,a.total,a.ongkir,c.nama,c.email,b.nama_alamat,b.nama_prop,b.nama_kota,b.nama_kec,b.nama_kel,b.alamat,b.nama_penerima,b.no_penerima,a.created_at,f.nama_status,a.id_status_transaksi,g.namausaha,g.no_rekening,g.an_rekening,g.nama_bank';
//     $query['table']     = 'm_transaksi_detail d';
//     $query['join'][0]   = array('m_transaksi a','a.id_transaksi = d.id_transaksi');
//     $query['join'][1]   = array('m_alamat b','b.id_alamat = a.id_alamat');
//     $query['join'][2]   = array('m_pengguna c','c.username = a.username');
//     $query['join'][3]   = array('m_produk e','e.id_produk = d.id_produk');
//     $query['join'][4]   = array('m_status_transaksi f','f.id_status_transaksi = a.id_status_transaksi');
//     $query['join'][5]   = array('m_umkm g','g.id_umkm = a.id_umkm');
//     $query['where']     = 'a.id_transaksi = '.(int)$id;
//     $data               = $CI->query_model->getData($query);


//     $CI->email->from('noreply@tangerangkota.go.id', 'UMKM Kota Tangerang'); 
//     $CI->email->to($data[0]->email);
//     $CI->email->subject('Pesanan dengan nomor invoice '.$data[0]->no_invoice.' - '.$data[0]->nama_status);

//     if ($data[0]->id_status_transaksi == 0) {
//           $msg = '<p style="text-align: justify; color:#000;font-weight:400">
//                     Lakukan pembayaran langsung ke rekening UMKM. Silahkan transfer sesuai dengan nominal total pemesanan. Pesanan Anda tidak akan dikirim sampai Anda telah menyelesaikan pembayaran.
//                   </p>';
//           if ($data[0]->no_rekening) {
//                $msg .= '<h4>Detail Pembayaran</h4>
//                         <ul>
//                               <li>Nama Bank: <strong>'.$data[0]->nama_bank.'</strong></li>
//                               <li>Nama Pemilik: <strong>'.strtoupper($data[0]->an_rekening).'</strong></li>
//                               <li>Nomor Rekening: <strong>'.$data[0]->no_rekening.'</strong></li>
//                         </ul>';
//           }
//     }else{
//           $msg = '';
//     }

//     $CI->email->message('
//           <html>
//           <head>
//           <title>Transaksi anda berhasil</title>
//           </head>
//           <body>
//           <style type="text/css">
//           h3 {
//                font-family:HelveticaNeue-Light,arial,sans-serif; font-size:16px; line-height: 30px; font-weight:bold;margin:0; padding:0
//           }
//           </style>
//           <table align="center" width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#eeeeee" style="padding: 30px;">
//           <tbody>
//           <td>
//           <table align="center" border="0" width="100%" cellspacing="0" cellpadding="0">
//           <tr>
//           <td bgcolor="#e95a5c" style="padding: 15px; color: #fff; text-align: center;">
//           <img src="https://i1.wp.com/abouttng.com/wp-content/uploads/2015/08/Lambang-Kota-Tangerang.png" style="width: 60px; margin-bottom: 10px;">
//           <h3>UMKM KOTA TANGERANG</h3>
//           </td>
//           </tr>
//           <tr>
//           <td bgcolor="#fff" style="padding: 20px">
//           <p style="text-align: justify; color:#000;font-weight:400">
//           Hai <b>'.ucfirst(strtolower($data[0]->nama)).'</b>, Terima kasih sudah menggunakan Portal UMKM, pesanan dengan nomor invoice <b>'.$data[0]->no_invoice.' </b> saat ini <b>'.$data[0]->nama_status.'</b> dengan pengiriman ke <b>'.text($data[0]->nama_penerima).', '.$data[0]->alamat.' '.text(@$data[0]->nama_prop).', '.text(@$data[0]->nama_kota).', '.text(@$data[0]->nama_kec).', '.text(@$data[0]->nama_kel).'</b>, Telp : <b>'.$data[0]->no_penerima.'</b>
//           </p>
//           '.$msg.'
//           <p style="text-align: justify; color:#000;font-weight:400">
//           Dengan rincian produk
//           </p>
//           '.list_produk($data).'
//           <p style="text-align: justify; color:#000;font-weight:400">
//           Demikian disampaikan, atas perhatian Bapak/Ibu kami ucapkan terima kasih.
//           </p>
//           <p style="color:#000;font-weight:400;margin:0">
//           Salam, 
//           </p>
//           <p style="color:#000;font-weight:400;margin:0">
//           UMKM Kota Tangerang
//           </p>
//           </td>
//           </tr>
//           </table>
//           </td>
//           </tbody>
//           </table>
//           </body>
//           </html>     
//           ');
//      $CI->email->set_mailtype('html');
//      $CI->email->send();
// }

// function kirim_email_transaksi_admin($id){
//     $CI = get_instance();
//     $query['select']    = 'd.id_transaksi,a.id_status_transaksi,a.no_invoice,e.nama_produk,d.harga,d.quantity,a.total_harga,a.total,a.ongkir,c.nama,h.email,b.nama_alamat,b.nama_prop,b.nama_kota,b.nama_kec,b.nama_kel,b.alamat,b.nama_penerima,b.no_penerima,a.created_at,f.nama_status,g.namausaha';
//     $query['table']     = 'm_transaksi_detail d';
//     $query['join'][0]   = array('m_transaksi a','a.id_transaksi = d.id_transaksi');
//     $query['join'][1]   = array('m_alamat b','b.id_alamat = a.id_alamat');
//     $query['join'][2]   = array('m_pengguna c','c.username = a.username');
//     $query['join'][3]   = array('m_produk e','e.id_produk = d.id_produk');
//     $query['join'][4]   = array('m_umkm g','g.id_umkm = e.id_umkm');
//     $query['join'][5]   = array('m_pengguna h','h.username = g.username');
//     $query['join'][6]   = array('m_status_transaksi f','f.id_status_transaksi = a.id_status_transaksi');
//     $query['where']     = 'a.id_transaksi = '.(int)$id;
//     $data               = $CI->query_model->getData($query);


//     $CI->email->from('noreply@tangerangkota.go.id', 'UMKM Kota Tangerang'); 
//     $CI->email->to($data[0]->email);
//     $CI->email->subject('Pesanan dengan nomor invoice '.$data[0]->no_invoice.' - '.$data[0]->nama_status);

//     if ($data[0]->id_status_transaksi == 1) { //jika status = menunggu konfirmasi
//           $pesan_proses = '<b>Harap segera memproses pesanan tersebut.</b>';
//     }else{
//           $pesan_proses = '';
//     }

//      $CI->email->message('
//           <html>
//           <head>
//           <title>Transaksi anda berhasil</title>
//           </head>
//           <body>
//           <style type="text/css">
//           h3 {
//                font-family:HelveticaNeue-Light,arial,sans-serif; font-size:16px; line-height: 30px; font-weight:bold;margin:0; padding:0
//           }
//           </style>
//           <table align="center" width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#eeeeee" style="padding: 30px;">
//           <tbody>
//           <td>
//           <table align="center" border="0" width="100%" cellspacing="0" cellpadding="0">
//           <tr>
//           <td bgcolor="#e95a5c" style="padding: 15px; color: #fff; text-align: center;">
//           <img src="https://i1.wp.com/abouttng.com/wp-content/uploads/2015/08/Lambang-Kota-Tangerang.png" style="width: 60px; margin-bottom: 10px;">
//           <h3>UMKM KOTA TANGERANG</h3>
//           </td>
//           </tr>
//           <tr>
//           <td bgcolor="#fff" style="padding: 20px">
//           <p style="text-align: justify; color:#000;font-weight:400">
//           Hai <b>'.ucfirst(strtolower($data[0]->namausaha)).'</b>, produk kamu saat ini sedang dipesan oleh <b>'.$data[0]->nama.'</b>  dengan nomor invoice <b>'.$data[0]->no_invoice.' </b>  dengan pengiriman ke <b>'.text($data[0]->nama_penerima).', '.$data[0]->alamat.' '.text(@$data[0]->nama_prop).', '.text(@$data[0]->nama_kota).', '.text(@$data[0]->nama_kec).', '.text(@$data[0]->nama_kel).'</b>, Telp : <b>'.$data[0]->no_penerima.'</b>.
//           '.$pesan_proses.'
//           </p>
//           <p style="text-align: justify; color:#000;font-weight:400">
//           Dengan rincian produk
//           </p>
//           '.list_produk($data).'
//           <p style="text-align: justify; color:#000;font-weight:400">
//           Demikian disampaikan, atas perhatian Bapak/Ibu kami ucapkan terima kasih.
//           </p>
//           <p style="color:#000;font-weight:400;margin:0">
//           Salam, 
//           </p>
//           <p style="color:#000;font-weight:400;margin:0">
//           UMKM Kota Tangerang
//           </p>
//           </td>
//           </tr>
//           </table>
//           </td>
//           </tbody>
//           </table>
//           </body>
//           </html>     
//           ');
//      $CI->email->set_mailtype('html');
//      $CI->email->send();
// }

// function kirim_email_transaksi_status($id){
//     $CI = get_instance();
//     $query['select']    = 'd.id_transaksi,a.no_invoice,e.nama_produk,d.harga,d.quantity,a.total_harga,a.total,a.ongkir,c.nama,c.email,b.nama_alamat,b.nama_prop,b.nama_kota,b.nama_kec,b.nama_kel,b.alamat,b.nama_penerima,b.no_penerima,a.created_at,a.id_status_transaksi,f.nama_status,a.pesan_batal';
//     $query['table']     = 'm_transaksi_detail d';
//     $query['join'][0]   = array('m_transaksi a','a.id_transaksi = d.id_transaksi');
//     $query['join'][1]   = array('m_alamat b','b.id_alamat = a.id_alamat');
//     $query['join'][2]   = array('m_pengguna c','c.username = a.username');
//     $query['join'][3]   = array('m_produk e','e.id_produk = d.id_produk');
//     $query['join'][4]   = array('m_status_transaksi f','f.id_status_transaksi = a.id_status_transaksi');
//     $query['where']     = 'd.id_transaksi = '.(int)$id;
//     $data               = $CI->query_model->getData($query);
//     $CI->email->from('noreply@tangerangkota.go.id', 'UMKM Kota Tangerang'); 
//     $CI->email->to($data[0]->email);
//     $CI->email->subject('Pesanan dengan nomor invoice '.$data[0]->no_invoice.' - '.$data[0]->nama_status);

//     if ($data[0]->id_status_transaksi == 5) {
//           $sts = 'dibatalkan';
//           $msg = 'Hai <b>'.ucfirst(strtolower($data[0]->nama)).'</b>, Terima kasih sudah menggunakan Portal UMKM, pesanan dengan nomor invoice <b>'.$data[0]->no_invoice.' </b> <b>Dibatalkan</b> dengan alasan "<i>'.$data[0]->pesan_batal.'</i>"';
//     }elseif ($data[0]->id_status_transaksi == 6) {
//           $sts = 'dibatalkan otomatis';
//           $msg = 'Hai <b>'.ucfirst(strtolower($data[0]->nama)).'</b>, Terima kasih sudah menggunakan Portal UMKM, pesanan dengan nomor invoice <b>'.$data[0]->no_invoice.' </b> <b>Dibatalkan</b> secara otomatis oleh sistem karena Pembeli tidak melakukan pembayaran tepat waktu';
//     }else{
//           $sts = 'berhasil';
//           $msg = 'Hai <b>'.ucfirst(strtolower($data[0]->nama)).'</b>, Terima kasih sudah menggunakan Portal UMKM, pesanan dengan nomor invoice <b>'.$data[0]->no_invoice.' </b> saat ini <b>'.$data[0]->nama_status.'</b> dengan pengiriman ke <b>'.text($data[0]->nama_penerima).', '.$data[0]->alamat.' '.text(@$data[0]->nama_prop).', '.text(@$data[0]->nama_kota).', '.text(@$data[0]->nama_kec).', '.text(@$data[0]->nama_kel).'</b>, Telp : <b>'.$data[0]->no_penerima.'</b>';
//     }

//     $CI->email->message('
//           <html>
//           <head>
//           <title>Transaksi anda '.$sts.'</title>
//           </head>
//           <body>
//           <style type="text/css">
//           h3 {
//                font-family:HelveticaNeue-Light,arial,sans-serif; font-size:16px; line-height: 30px; font-weight:bold;margin:0; padding:0
//           }
//           </style>
//           <table align="center" width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#eeeeee" style="padding: 30px;">
//           <tbody>
//           <td>
//           <table align="center" border="0" width="100%" cellspacing="0" cellpadding="0">
//           <tr>
//           <td bgcolor="#e95a5c" style="padding: 15px; color: #fff; text-align: center;">
//           <img src="https://i1.wp.com/abouttng.com/wp-content/uploads/2015/08/Lambang-Kota-Tangerang.png" style="width: 60px; margin-bottom: 10px;">
//           <h3>UMKM KOTA TANGERANG</h3>
//           </td>
//           </tr>
//           <tr>
//           <td bgcolor="#fff" style="padding: 20px">
//           <p style="text-align: justify; color:#000;font-weight:400">
//           '.$msg.'
//           </p>
//           <p style="text-align: justify; color:#000;font-weight:400">
//           Dengan rincian produk
//           </p>
//           '.list_produk($data).'
//           <p style="text-align: justify; color:#000;font-weight:400">
//           Demikian disampaikan, atas perhatian Bapak/Ibu kami ucapkan terima kasih.
//           </p>
//           <p style="color:#000;font-weight:400;margin:0">
//           Salam, 
//           </p>
//           <p style="color:#000;font-weight:400;margin:0">
//           UMKM Kota Tangerang
//           </p>
//           </td>
//           </tr>
//           </table>
//           </td>
//           </tbody>
//           </table>
//           </body>
//           </html>     
//           ');
//      $CI->email->set_mailtype('html');
//      $CI->email->send();
// }

// function kirim_email_transaksi_pengiriman($id){
//     $CI = get_instance();
//     $query['select']    = 'd.id_transaksi,a.no_invoice,e.nama_produk,d.harga,d.quantity,a.total_harga,a.total,a.ongkir,c.nama,c.email,b.nama_alamat,b.nama_prop,b.nama_kota,b.nama_kec,b.nama_kel,b.alamat,b.nama_penerima,b.no_penerima,a.created_at,f.nama_status, g.nama_kurir,a.no_resi,a.kurir_service,a.ket_ongkir';
//     $query['table']     = 'm_transaksi_detail d';
//     $query['join'][0]   = array('m_transaksi a','a.id_transaksi = d.id_transaksi');
//     $query['join'][1]   = array('m_alamat b','b.id_alamat = a.id_alamat');
//     $query['join'][2]   = array('m_pengguna c','c.username = a.username');
//     $query['join'][3]   = array('m_produk e','e.id_produk = d.id_produk');
//     $query['join'][4]   = array('m_status_transaksi f','f.id_status_transaksi = a.id_status_transaksi');
//     $query['join'][5]   = array('m_kurir g','g.id_kurir = a.id_kurir');
//     $query['where']     = 'd.id_transaksi = '.(int)$id;
//     $data               = $CI->query_model->getData($query);
//     if ($data) {
//         $CI->email->from('noreply@tangerangkota.go.id', 'UMKM Kota Tangerang'); 
//         $CI->email->to($data[0]->email);
//         $CI->email->subject('Pesanan dengan nomor invoice '.$data[0]->no_invoice.' - '.$data[0]->nama_status);
//         $CI->email->message('
//                <html>
//                <head>
//                <title>Transaksi anda berhasil</title>
//                </head>
//                <body>
//                <style type="text/css">
//                h3 {
//                     font-family:HelveticaNeue-Light,arial,sans-serif; font-size:16px; line-height: 30px; font-weight:bold;margin:0; padding:0
//                }
//                </style>
//                <table align="center" width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#eeeeee" style="padding: 30px;">
//                <tbody>
//                <td>
//                <table align="center" border="0" width="100%" cellspacing="0" cellpadding="0">
//                <tr>
//                <td bgcolor="#e95a5c" style="padding: 15px; color: #fff; text-align: center;">
//                <img src="https://i1.wp.com/abouttng.com/wp-content/uploads/2015/08/Lambang-Kota-Tangerang.png" style="width: 60px; margin-bottom: 10px;">
//                <h3>UMKM KOTA TANGERANG</h3>
//                </td>
//                </tr>
//                <tr>
//                <td bgcolor="#fff" style="padding: 20px">
//                <p style="text-align: justify; color:#000;font-weight:400">
//                Hai <b>'.ucfirst(strtolower($data[0]->nama)).'</b>, Terima kasih sudah menggunakan Portal UMKM, pesanan dengan nomor invoice <b>'.$data[0]->no_invoice.' </b> saat ini <b>'.$data[0]->nama_status.'</b> dengan pengiriman menggunakan <b> '.@text($data[0]->nama_kurir).' ('.@$data[0]->kurir_service.') </b> dengan nomor resi <b>'.@text($data[0]->no_resi).'</b> dan akan dikirim ke <b>'.text(@$data[0]->nama_penerima).', '.$data[0]->alamat.' '.text(@$data[0]->nama_prop).', '.text(@$data[0]->nama_kota).', '.text(@$data[0]->nama_kec).', '.text(@$data[0]->nama_kel).'</b>, Telp : <b>'.$data[0]->no_penerima.'</b>
//                </p>
//                <p style="text-align: justify; color:#000;font-weight:400">
//                Dengan rincian produk
//                </p>
//                '.list_produk($data).'
//                <p style="text-align: justify; color:#000;font-weight:400">
//                Demikian disampaikan, atas perhatian Bapak/Ibu kami ucapkan terima kasih.
//                </p>
//                <p style="color:#000;font-weight:400;margin:0">
//                Salam, 
//                </p>
//                <p style="color:#000;font-weight:400;margin:0">
//                UMKM Kota Tangerang
//                </p>
//                </td>
//                </tr>
//                </table>
//                </td>
//                </tbody>
//                </table>
//                </body>
//                </html>     
//                ');
//         $CI->email->set_mailtype('html');
//         $CI->email->send();
//     }
// }

// function kirim_email_transaksi_sampai($id){
//     $CI = get_instance();
//     $query['select']    = 'd.id_transaksi,a.id_status_transaksi,a.no_invoice,e.nama_produk,d.harga,d.quantity,a.total_harga,a.total,a.ongkir,c.nama,h.email,b.nama_alamat,b.nama_prop,b.nama_kota,b.nama_kec,b.nama_kel,b.alamat,b.nama_penerima,b.no_penerima,a.created_at,f.nama_status,g.namausaha';
//     $query['table']     = 'm_transaksi_detail d';
//     $query['join'][0]   = array('m_transaksi a','a.id_transaksi = d.id_transaksi');
//     $query['join'][1]   = array('m_alamat b','b.id_alamat = a.id_alamat');
//     $query['join'][2]   = array('m_pengguna c','c.username = a.username');
//     $query['join'][3]   = array('m_produk e','e.id_produk = d.id_produk');
//     $query['join'][4]   = array('m_umkm g','g.id_umkm = e.id_umkm');
//     $query['join'][5]   = array('m_pengguna h','h.username = g.username');
//     $query['join'][6]   = array('m_status_transaksi f','f.id_status_transaksi = a.id_status_transaksi');
//     $query['where']     = 'a.id_transaksi = '.(int)$id;
//     $data               = $CI->query_model->getData($query);

//     $CI->email->from('noreply@tangerangkota.go.id', 'UMKM Kota Tangerang'); 
//     $CI->email->to($data[0]->email);
//     $CI->email->subject('Pesanan dengan nomor invoice '.$data[0]->no_invoice.' - '.$data[0]->nama_status);
//     $CI->email->message('
//           <html>
//           <head>
//           <title>Transaksi anda berhasil</title>
//           </head>
//           <body>
//           <style type="text/css">
//           h3 {
//                font-family:HelveticaNeue-Light,arial,sans-serif; font-size:16px; line-height: 30px; font-weight:bold;margin:0; padding:0
//           }
//           </style>
//           <table align="center" width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#eeeeee" style="padding: 30px;">
//           <tbody>
//           <td>
//           <table align="center" border="0" width="100%" cellspacing="0" cellpadding="0">
//           <tr>
//           <td bgcolor="#e95a5c" style="padding: 15px; color: #fff; text-align: center;">
//           <img src="https://i1.wp.com/abouttng.com/wp-content/uploads/2015/08/Lambang-Kota-Tangerang.png" style="width: 60px; margin-bottom: 10px;">
//           <h3>UMKM KOTA TANGERANG</h3>
//           </td>
//           </tr>
//           <tr>
//           <td bgcolor="#fff" style="padding: 20px">
//           <p style="text-align: justify; color:#000;font-weight:400">
//           Hai <b>'.ucfirst(strtolower($data[0]->namausaha)).'</b>, Pesanan dengan nomor invoice <b>'.$data[0]->no_invoice.' </b>
//           </p>
//           <p style="text-align: justify; color:#000;font-weight:400">
//           Dengan rincian produk
//           </p>
//           '.list_produk($data).'
//           <p style="text-align: justify; color:#000;font-weight:400">
//                Sudah sampai dan diterima oleh pembeli, terima kasih sudah menggunakan Portal UMKM.
//           </p>
//           <p style="text-align: justify; color:#000;font-weight:400">
//           Demikian disampaikan, atas perhatian Bapak/Ibu kami ucapkan terima kasih.
//           </p>
//           <p style="color:#000;font-weight:400;margin:0">
//           Salam, 
//           </p>
//           <p style="color:#000;font-weight:400;margin:0">
//           UMKM Kota Tangerang
//           </p>
//           </td>
//           </tr>
//           </table>
//           </td>
//           </tbody>
//           </table>
//           </body>
//           </html>     
//           ');
//     $CI->email->set_mailtype('html');
//     $CI->email->send();
// }

// function list_produk($data){
//     $table = "
//      <table style=' border: 1px solid #ddd; border-collapse: collapse;width: 100%;'>
//      <tr>
//      <th style='border: 1px solid #ddd; padding: 15px;'> # </th>
//      <th style='border: 1px solid #ddd; padding: 15px;'> Nama Produk </th>
//      <th style='border: 1px solid #ddd; padding: 15px;'> Jumlah </th>
//      <th style='border: 1px solid #ddd; padding: 15px;'> Harga</th>
//      </tr>
//      ";
//      $i=1;
//      foreach ($data as $key) {
//           $table .= "  
//           <tr>
//           <td style='border: 1px solid #ddd; padding: 15px;' align='center'>".$i."</td>
//           <td style='border: 1px solid #ddd; padding: 15px;'>".$key->nama_produk."</td>
//           <td style='border: 1px solid #ddd; padding: 15px;' align='center'>".rp($key->quantity)."</td>
//           <td style='border: 1px solid #ddd; padding: 15px;' align='right'>Rp. ".rp($key->harga)."</td>
//           </tr>
//           ";
//           $i++;
//      }
//      $table .= "
//      <tr>
//      <th style='border: 1px solid #ddd; padding: 15px;' colspan='3'>Subtotal Harga Produk</th>
//      <th  style='border: 1px solid #ddd; padding: 15px;' align='right'>Rp. ".rp($data[0]->total_harga)."</th>
//      </tr>
//      <tr>
//      <th style='border: 1px solid #ddd; padding: 15px;' colspan='3'>Biaya Pengiriman</th>
//      <th  style='border: 1px solid #ddd; padding: 15px;' align='right'>Rp. ".rp($data[0]->ongkir)."</th>
//      </tr>
//      <tr>
//      <th style='border: 1px solid #ddd; padding: 15px;' colspan='3'>Total Harga</th>
//      <th  style='border: 1px solid #ddd; padding: 15px;' align='right'>Rp. ".rp($data[0]->total)."</th>
//      </tr>
//      </table>
//      ";

//      return $table;
// }
?>