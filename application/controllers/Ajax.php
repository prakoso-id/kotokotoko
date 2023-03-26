<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends MY_Controller {

	public function __construct() {
		parent::__construct();
        
	}

    public function ajax_list()
    {
        $type = $this->input->post('type');
        switch ($type) {
            case 'alamat':
                $data   = array();
                $sort   = isset($_POST['columns'][$_POST['order'][0]['column']]['data']) ? strval($_POST['columns'][$_POST['order'][0]['column']]['data']) : 'nama';
                $order  = isset($_POST['order'][0]['dir']) ? strval($_POST['order'][0]['dir']) : 'asc';
                $no     = $this->input->post('start');

                $list = $this->m_table->get_datatables('data_alamat',$sort,$order);
                foreach ($list as $l) {
                    $no++;
                    $l->no = '<input type="radio" class="id_data_alamat" name="id_data_alamat" value="'.$l->id_alamat.'">';
                    $l->nama_alamat = $l->nama_alamat.' <span style="color:#d9534f;font-size:11px;">'.($l->utama?'Utama':'').'</span>';
                    $l->aksi = '
                        <a href="javascript:void(0);" onclick="ubah_data('.$l->id_alamat.')" title="Ubah Data Alamat" class="btn btn-info"><i class="fa fa-pencil"></i></a>
                        <a href="javascript:void(0);" onclick="hapus_data('.$l->id_alamat.')" title="Hapus Data Alamat" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                    '; 
                    
                    $data[] = $l;
                }

                $output = array(
                    "draw"              => $_POST['draw'],
                    "recordsTotal"      => $this->m_table->count_all('data_alamat',$sort,$order),
                    "recordsFiltered"   => $this->m_table->count_filtered('data_alamat',$sort,$order),
                    "data"              => $data,
                );  
                echo json_encode($output);
            break;
        }
    }

	public function ajax_save(){
        if(!$this->user_model->is_login()){
            echo json_encode(['success' => false, 'message' => 'Silahkan login terlebih dahulu !']);
            exit();
        }

		$type = $this->input->post('type',true);
        switch ($type) {
            case 'simpan_pesan':
                 $this->_validate($type);
                if($this->input->post('id_transaksi'))
                {
                    $data = array(
                        'id_group'      => $this->input->post('id_group',true),
                        'id_transaksi'  => $this->input->post('id_transaksi',true),
                    );
                }
                else{
                    $data = array(
                        'id_group'      => $this->input->post('id_group',true),
                        'id_produk'     => $this->input->post('id_produk',true),
                    );
                }

                $data1 = array('username'      => $this->input->post('username',true),
                                'pesan'         => $this->input->post('pesan',true),
                                'created_at'    => date('Y-m-d H:i:s')
                            );
                $dt = array_merge($data,$data1);
                $insert = $this->query_model->insert('m_pesan_detail',$dt);
                if (!$insert){
                    echo json_encode(['success' => false, 'message' => 'Pesan gagal dikirim','status' => TRUE]);
                }else {
                    $this->db->select('a.*,if(b.namausaha is not null, b.namausaha, c.nama) as nama,
                        if(d.namausaha is not null, d.namausaha, e.nama) as nama_penerima, if(d.namausaha is not null, 1, if(e.id_group = 1, 2, 0)) as flag');
                    $this->db->from('m_pesan as a');
                    $this->db->join('m_umkm as b','a.id_umkm = b.id_umkm and b.username = a.username_pengirim','left');
                    $this->db->join('m_pengguna as c','c.username = a.username_pengirim','left');
                    $this->db->join('m_umkm as d','a.id_umkm = d.id_umkm and d.username = a.username_penerima','left');
                    $this->db->join('m_pengguna as e','e.username = a.username_penerima','left');
                    $this->db->where('a.id_group',$this->input->post('id_group',true));
                    $this->db->where('a.username_pengirim',$this->input->post('username',true));
                    $data_pesan = $this->db->get()->row();

                    $username_pengirim = $this->input->post('username',true);
                    $username_penerima = $data_pesan->username_penerima;
                    $judul = '1 Pesan Baru dari '.$data_pesan->nama;
                    $message = $this->input->post('pesan',true);
                    $id_detail = $data_pesan->id_pesan;

                    // send_notif($username_pengirim,$username_penerima,$judul,$message,'pesan','detail_pesan',$id_detail);
                    echo json_encode(['success' => true, 'message' => 'Pesan berhasil dikirim','status' => TRUE,'id_produk' => $this->input->post('id_produk'),'nama_penerima' => $data_pesan->nama_penerima,'flag' => $data_pesan->flag]);
                }
            break;
            case 'simpan_diskusi':
                $this->_validate($type);
                $data = array(
                    'id_produk'     => $this->input->post('id',true),
                    'username'      => $this->session->identity,
                    'pesan'         => $this->input->post('pesan',true),
                    'created_at'    => date('Y-m-d H:i:s'),
                );
                $insert = $this->query_model->insert_id('m_diskusi',$data);
                if (!$insert){
                    echo json_encode(['success' => false, 'message' => 'Pesan diskusi gagal ditambahkan','status' => TRUE]);
                }else {
                    //send notif
                    if ($this->session->identity != $this->input->post('username_umkm',true)) {
                        // send_notif($this->session->identity,$this->input->post('username_umkm',true),'1 Diskusi Baru',$this->input->post('pesan',true),'diskusi','detail_diskusi',$insert);
                    }
                    echo json_encode(['success' => true, 'message' => 'Pesan diskusi berhasil ditambahkan','status' => TRUE]);
                }
            break;
            case 'balas_diskusi':
                $this->_validate($type);
                $data = array(
                    'id_diskusi'     => $this->input->post('id',true),
                    'username'      => $this->session->identity,
                    'pesan'         => $this->input->post('pesan_diskusi',true),
                    'created_at'    => date('Y-m-d H:i:s'),
                );
                $insert = $this->query_model->insert_id('m_diskusi_balasan',$data);
                if (!$insert){
                    echo json_encode(['success' => false, 'message' => 'Pesan diskusi gagal ditambahkan','status' => TRUE]);
                }else{
                    if ($this->session->identity != $this->input->post('username_penanya',true)) {
                        // send_notif($this->session->identity,$this->input->post('username_penanya',true),'Balasan diskusi baru',$this->input->post('pesan_diskusi',true),'diskusi','detail_diskusi',$this->input->post('id',true));
                    }
                    
                    echo json_encode(['success' => true, 'message' => 'Pesan diskusi berhasil ditambahkan','status' => TRUE]);
                }
            break;
            case 'checkout':
                // echo json_encode($this->session);die;
                $data_post = $this->input->post();
                $this->_validate($type,$data_post['id_umkm']);
                
                //cek stok produk
                $this->db->select("a.id_produk,a.size, a.username AS nik, a.quantity AS jml, s.stok, b.nama_produk, b.id_umkm, b.harga, b.diskon, b.diskon_nominal, b.berat");
                $this->db->from("m_keranjang a");
                $this->db->join('m_produk as b','b.id_produk = a.id_produk');
                $this->db->join('m_produk_stok as s','s.id_produk = a.id_produk and s.ukuran = a.size');
                $this->db->where("a.username", $this->session->identity);
                $this->db->where("a.is_checked", "1");
                $keranjang = $this->db->get()->result_array();

                $this->db->trans_begin();

                foreach ($keranjang as $kr) {
                    if ($kr['stok'] < 1) {
                        $this->db->trans_rollback();
                        echo json_encode(['success' => false, 'message' => 'Stok '.$kr['nama_produk'].' kosong, silahkan update keranjang anda','status' => TRUE]);
                        exit();
                    }elseif ($kr['stok'] < $kr['jml']) {
                        $this->db->trans_rollback();
                        echo json_encode(['success' => false, 'message' => 'Pesanan produk '.$kr['nama_produk'].' melebihi stok yang tersedia, silahkan update keranjang anda','status' => TRUE]);
                        exit();
                    }else{
                        $this->db->set('stok', 'stok - '.$kr['jml'], FALSE);
                        $this->db->set('updated_at',date('Y-m-d H:i:s'));
                        $this->db->where('id_produk',$kr['id_produk']);
                        $this->db->update('m_produk');

                        $this->db->set('stok', 'stok - '.$kr['jml'], FALSE);
                        $this->db->where('id_produk',$kr['id_produk']);
                        $this->db->where('ukuran',$kr['size']);
                        $this->db->update('m_produk_stok');
                    }
                }

                    $metode_bayar = 'midtrans';
                    foreach ($data_post['id_umkm'] as $id_umkm) {
                        $kurir = $this->input->post('id_kurir',true)[$id_umkm];
                        $expld_kurir = explode('#', $kurir);
                        $service = $this->input->post('kurir_service',true)[$id_umkm];
                        $expld_service = explode('#', $service);

                        $no_invoice='INV/UMKM/'.$id_umkm.'/'.date('dmy').'/'.date('his');
                        
                        //insert ke m_transaksi
                        $data = array(
                            'id_umkm'               => $id_umkm,
                            'id_status_transaksi'   => 0, //menunggu pembayaran
                            'no_invoice'            => $no_invoice,
                            'id_alamat'             => $this->input->post('id_alamat',true),
                            'username'              => $this->session->identity,
                            'ongkir'                => $this->input->post('sub_total_ongkir_umkm',true)[$id_umkm],
                            'id_kurir'              => $expld_kurir[0],
                            'kurir_service'         => $expld_service[0],
                            'ket_ongkir'            => $expld_service[1],
                            'created_at'            => date('Y-m-d H:i:s'),
                            'source'                => 'web',
                            'metode_bayar'          => $metode_bayar,
                        );
                        $this->db->insert('m_transaksi',$data);
                        $insert_parrent = $this->db->insert_id();

                        $detail = array();
                        $arr_id_produk = array();
                        $total_harga = $total_berat = $total_diskon_produk = 0;
                        foreach ($data_post[$id_umkm] as $key => $p){
                            foreach ($keranjang as $kr) {
                                if ($this->input->post('id_produk',true)[$key] == $kr['id_produk']) {
                                    $quantity = $kr['jml'];
                                    $harga = $kr['harga'] - $kr['diskon_nominal'];
                                    $berat = $kr['berat'];
                                    $jum_berat = $berat * $quantity;
                                    $jum_harga = $harga * $quantity;
                                    $jum_harga_normal = $kr['harga'] * $quantity;
                                    $jum_nominal_diskon = $kr['diskon_nominal'] * $quantity;

                                    $detail[] = array(
                                        'id_transaksi'          => $insert_parrent,
                                        'id_produk'             => $this->input->post('id_produk',true)[$key],
                                        'quantity'              => $quantity,
                                        'harga'                 => $harga,
                                        'harga_normal'          => $kr['harga'],
                                        'diskon'                => $kr['diskon'],
                                        'size'                  => $kr['size'],
                                        'nominal_diskon'        =>($kr['diskon_nominal']?$kr['diskon_nominal']:'0'),
                                        'jumlah_nominal_diskon' => $jum_nominal_diskon,
                                        'berat'                 => $berat,
                                        'jumlah_berat'          => $jum_berat,
                                        'jumlah_harga'          => $jum_harga,
                                        'jumlah_harga_normal'   => $jum_harga_normal,
                                        'catatan'               => ($data_post['catatan'][$key]?$data_post['catatan'][$key]:'-'),
                                        'created_at'            => date('Y-m-d H:i:s'),
                                    );

                                    $arr_id_produk[] = $this->input->post('id_produk',true)[$key];

                                    $arr_size[] = $kr['size'];
                
                                    $total_harga = $total_harga + $jum_harga;
                                    $total_berat = $total_berat + $jum_berat;
                                    $total_diskon_produk = $total_diskon_produk + $jum_nominal_diskon;
                                    
                                }
                            }
                        }



                        if ($detail) {
                            //insert ke m_transaksi_detail
                            $insert = $this->db->insert_batch('m_transaksi_detail',$detail);
                            // echo json_encode($insert);die;

                            //delete data di m_keranjang
                            $this->db->where_in('id_produk',$arr_id_produk);
                            $this->db->where_in('size',$arr_size);
                            $this->db->where('username',$this->session->identity);
                            $this->db->where('is_checked','1');
                            $this->db->delete('m_keranjang');

                            //update ke m_transaksi
                            $data_transaksi = array('total_harga' => $total_harga,
                                                    'total_berat' => $total_berat,
                                                    'total' => ($total_harga + $expld_service[2]), //total harga barang + ongkir
                                                    'nominal_diskon_produk' => $total_diskon_produk,
                                                    'nominal_diskon_ongkir' => 0,
                                                    );
                            $this->db->update('m_transaksi', $data_transaksi, array('id_transaksi' => $insert_parrent));
                            // echo json_encode($insert);die;
                            if ($this->db->trans_status() === false) {
                                $this->db->trans_rollback();
                                echo json_encode(['success' => false, 'message' => 'Pesanan kamu gagal dibuat. Terjadi kesalahan, silahkan coba beberapa saat lagi !','status' => TRUE]);
                                exit();
                            } else {
                                $this->db->trans_commit();
                                //send notif ke pembeli
                                $judul = 'Pesanan '.$no_invoice.' berhasil dibuat';
                                $message = 'Silahkan melakukan pembayaran dan upload bukti pembayaran dalam waktu 1x24 jam.';
                                $username_pengirim = $this->input->post('username_umkm',true)[$id_umkm];
                                $username_penerima =  $this->session->identity;
                                // $send = send_notif($username_pengirim,$username_penerima,$judul,$message,'transaksi_pembelian','detail_transaksi',$insert,'checkout');
                                // kirim_email_transaksi_sukses($insert);

                                //send notif ke penjual
                                $judul = '1 pesanan baru '.$no_invoice;
                                $message = 'Klik disini untuk melihat detail pesanan';
                                $username_pengirim = $this->session->identity;
                                $username_penerima = $this->input->post('username_umkm',true)[$id_umkm];
                                // $send2 = send_notif($username_pengirim,$username_penerima,$judul,$message,'transaksi_penjualan','detail_transaksi',$insert,'checkout');
                                // kirim_email_transaksi_admin($insert);

                                // var_dump($send);
                                // var_dump($send2);
                                // die();
                            }
                        }else{
                            $this->db->trans_rollback();
                            echo json_encode(['success' => false, 'message' => 'Pesanan kamu gagal dibuat, tidak ada barang yang dibeli.','status' => TRUE]);
                            exit();
                        }
                    }

                    if($this->input->post('data_user',true) === 'kosong'){

                        $data_penerima = $this->get_data_penerima($this->session->identity);

                        $data_visitor = $this->get_data_visitor($this->session->identity);
                        if($data_visitor){
                            $data = array(
                                'email'                   => $this->input->post('email_anon',true),
                            );

                            $this->db->update('m_visitor_anon', $data, array('visitor_id' => $this->session->identity));
                        }else{
                            $data = array(
                                'visitor_id'              => $this->session->identity,
                                'email'                   => $this->input->post('email_anon',true),
                                'nama'                    =>$data_penerima->nama_penerima,
                                'no_telp'                 =>$data_penerima->no_penerima,
                            );
                            $this->db->insert('m_visitor_anon',$data);
                        }
                        
                    }
                   
                    echo json_encode(['success' => true, 'message' => 'Pesanan kamu telah berhasil dibuat. silahkan lanjutkan pembayaran','status' => TRUE]);

            break;
            default:
                # code...
            break;
        }
	}

    public function ajax_data(){
        $type = $this->input->post('type',true);
        switch ($type) {
            case 'session_no_login':
                if($this->user_model->is_login()){
                    $username= $this->session->identity;
                }else{
                    $session = array(
                        'identity'          => $this->input->post('fingerprint'),
                    );
                    $this->session->set_userdata($session);
                    $username= $this->session->identity;
                }
            break;
            case 'buka_pesan':
                $cek['select']   = 'a.id_group';
                $cek['table']    = 'm_pesan a';
                $cek['where']    = 'a.username_pengirim = "'.$this->session->identity.'" AND a.id_umkm = "'.(int)$this->input->post('id_umkm',true).'"';
                $query           = $this->query_model->getRow($cek);

                $umkm['select'] = 'a.username,a.namausaha,b.last_login';
                $umkm['table']  = 'm_umkm a';
                $umkm['where']  = 'a.id_umkm = "'.(int)$this->input->post('id_umkm',true).'"';
                $umkm['join'][0] = array('m_pengguna b','b.username = a.username');
                $data_umkm      = $this->query_model->getRow($umkm);
                $data_umkm->last_login = indonesian_date($data_umkm->last_login);

                if(!isset($query))
                {
                    $id_group = time();
                    $date     = date('Y-m-d H:i:s');
                    $data = array(
                        'username_pengirim' => $this->session->identity,
                        'username_penerima' => $data_umkm->username,
                        'id_group'          => $id_group,
                        'created_at'        => $date,
                        'id_umkm'           => (int)$this->input->post('id_umkm',true),
                    );
                    $insert1 = $this->query_model->insert('m_pesan',$data);

                    $data1 = array(
                        'username_pengirim' => $data_umkm->username,
                        'username_penerima' => $this->session->identity,
                        'id_group'          => $id_group,
                        'created_at'        => $date,
                        'id_umkm'           => (int)$this->input->post('id_umkm',true),
                    );

                    $insert2 = $this->query_model->insert('m_pesan',$data1);
                    if($insert1 AND $insert2)
                    {
                        $status = true;
                    }
                    else{
                        $status = false;
                    }
                }else{
                    $id_group = $query->id_group;
                    $status = true;
                }

                $result = array(
                    'id_group'  => $id_group,
                    'status'    => $status,
                    'umkm'      => $data_umkm
                );
                echo json_encode($result);
            break;
            case 'total_belanja':
                if($this->session->identity)
                {
                    $query['select']    = 'b.harga,a.quantity';
                    $query['table']     = 'm_keranjang a';
                    $query['join'][0]   = array('m_produk b','b.id_produk = a.id_produk');
                    $query['where']     = 'a.username = "'.$this->session->identity.'" AND a.status = "simpan"';
                    $data = $this->query_model->getData($query);
                    $jml_quantity = 0;
                    $total = 0;
                    foreach ($data as $value) {
                        $jml_quantity = $value->quantity * $value->harga;
                        $total = $total + $jml_quantity;
                    }
                }else{
                    $total = 0;
                }
                
                echo json_encode(['success' => true, 'total' => $total,'status' => TRUE]);
            break;
            case 'wishlist':
                if($this->user_model->is_login()){
                    $cek['select']  = 'status';
                    $cek['table']   = 'm_wishlist';
                    $cek['where']   = 'username = "'.$this->session->identity.'" AND id_produk = "'.(int)$this->input->post('id',true).'"';
                    $wishlist       = $this->query_model->getRow($cek);

                    if($wishlist){ //jika sudah ada di db maka hapus record 
                        $status = 'unlike';
                        $this->query_model->delete('m_wishlist',array('id_produk' => (int)$this->input->post('id',true), 'username' => $this->session->identity));
                    }else{ //jika belum ada di db maka insert
                        $status = 'like';
                        $data = array(
                            'id_produk'     => $this->input->post('id',true),
                            'username'      => $this->session->identity,
                            'created_at'    => date('Y-m-d H:i:s'),
                            'status'        => $status
                        );
                        $this->query_model->insert('m_wishlist',$data);
                    } 
                    echo json_encode(['success' => true,'status' => $status]);
                }else{
                    echo json_encode(['success' => false]);
                }
            break;
            case 'add_chart':
                // echo json_encode($this->input->post('fingerprint'));die;


                if($this->input->post('status') == 'hapus'){ //jika hapus
                    $post_size = $this->input->post('size',true);
                    $status = 'hapus';
                    $insert = $this->query_model->delete('m_keranjang',array('id_produk' => (int)$this->input->post('id',true), 'username' => $this->session->identity,'size'=>$post_size));

                    $jml_keranjang = $this->_get_jum_keranjang();

                    $data_keranjang = null;
                    if($jml_keranjang == 0){ //jika jumlah keranjang kosong
                        $data_keranjang = '<li class="item-cart">
                                                <span>
                                                    <h3 style="font-size: 14px;font-weight: 600;line-height: 1.5; color:black;">TIDAK ADA PRODUK DI KERANJANG.</h3>
                                                    <br>
                                                    <a href="'.base_url('list-produk').'" class="btn-banner">Belanja sekarang <i class="ion-ios-arrow-forward"></i></a>
                                                </span>
                                            </li>';
                    }
                }else{ //jika add_chart
                    $post_size = $this->input->post('size',true);
                    $keranjang  = $this->_cek_keranjang();
                    $cek_stok = cek_stok_produk((int)$this->input->post('id',true));
                    $cek_stok_ukuran = cek_stok_ukuran_produk((int)$this->input->post('id',true),$post_size);

                    // var_dump($keranjang);die;


                    if ($keranjang) { //jika sudah ada di db 
                        $status = 'update';
                        $quantity = $keranjang->quantity + 1;

                        if ($cek_stok < $quantity) {
                            echo json_encode(['success' => false,'login' => true,'message' => 'Stok barang yang tersedia tinggal '.$cek_stok.' pcs. Anda tidak dapat menambahkannya lagi ke dalam keranjang !']);
                            exit();
                        }
                        if ($cek_stok_ukuran < $quantity) {
                            echo json_encode(['success' => false,'login' => true,'message' => 'Stok barang yang tersedia untuk ukuran '.$post_size.' tinggal '.$cek_stok.' pcs. Harap kurangi kuantitas !']);
                            exit();
                        }

                        $data = array(
                            'status'        => 'simpan',
                            'quantity'      => $quantity,
                            'updated_at'    => date('Y-m-d H:i:s'),
                            'size'          => $post_size
                        );

                        $insert = $this->query_model->update('m_keranjang',array('id_produk' => (int)$this->input->post('id',true), 'username' => $this->session->identity),$data);
                    }else{ //jika tidak ada di db
                        $status = 'simpan';
                        $quantity = 1;

                        if ($cek_stok < $quantity) {
                            echo json_encode(['success' => false,'login' => true,'message' => 'Stok barang yang tersedia tinggal '.$cek_stok.' pcs. Anda tidak dapat menambahkannya lagi ke dalam keranjang !']);
                            exit();
                        }

                        if ($cek_stok_ukuran < $quantity) {
                            echo json_encode(['success' => false,'login' => true,'message' => 'Stok barang yang tersedia untuk ukuran '.$post_size.' tinggal '.$cek_stok.' pcs. Harap kurangi kuantitas !']);
                            exit();
                        }

                        $data = array(
                            'id_produk'     => (int)$this->input->post('id',true),
                            'username'      => $this->session->identity,
                            'created_at'    => date('Y-m-d H:i:s'),
                            'quantity'      => $quantity,
                            'status'        => $status,
                            'size'          => $post_size

                        );

                        $insert = $this->query_model->insert_id('m_keranjang',$data);
                    }

                    $data_keranjang = $this->_get_list_keranjang((int)$this->input->post('id',true));
                    $jml_keranjang = $this->_get_jum_keranjang();
                }

                echo json_encode(['success' => true,'status' => $status,'keranjang' => $data_keranjang,'jml_keranjang' => $jml_keranjang]);
            break;
            case 'get_ukuran_stok':
                // if($this->user_model->is_login()){
                //     $ukuran = get_stok_ukuran_produk((int)$this->input->post('id',true));
                //     echo json_encode(['success' => true,'data_ukuran' => $ukuran]);

                // }
                // else{
                //     echo json_encode(['success' => false,'login' => false]);
                // }
                $ukuran = get_stok_ukuran_produk((int)$this->input->post('id',true));
                echo json_encode(['success' => true,'data_ukuran' => $ukuran]);
            break;
            case 'beli_chart':
                if($this->user_model->is_login()){
                    $post_qty = $this->input->post('qty',true);
                    $post_size = $this->input->post('size',true);
                    $keranjang  = $this->_cek_keranjang();
                    $cek_stok = cek_stok_produk((int)$this->input->post('id',true));
                    $cek_stok_ukuran = cek_stok_ukuran_produk((int)$this->input->post('id',true),$post_size);

                    if($keranjang){ //jika ada di db
                        $quantity = $keranjang->quantity + $post_qty;

                        if ($quantity > $cek_stok) {
                            echo json_encode(['success' => false,'login' => true,'message' => 'Stok barang yang tersedia tinggal '.$cek_stok.' pcs. Harap kurangi kuantitas !']);
                            exit();
                        }
                        if ($quantity > $cek_stok_ukuran) {
                            echo json_encode(['success' => false,'login' => true,'message' => 'Stok barang yang tersedia untuk ukuran '.$post_size.' tinggal '.$cek_stok.' pcs. Harap kurangi kuantitas !']);
                            exit();
                        }
                        
                        $data = array(
                            'status'        => 'simpan',
                            'quantity'      => $quantity,
                            'updated_at'    => date('Y-m-d H:i:s'),
                            'size'          => $post_size
                        );
                        $insert = $this->query_model->update('m_keranjang',array('id_produk' => (int)$this->input->post('id',true), 'username' => $this->session->identity),$data);
                    }else{
                        if ($post_qty > $cek_stok) {
                            echo json_encode(['success' => false,'login' => true,'message' => 'Stok barang yang tersedia tinggal '.$cek_stok.' pcs. Harap kurangi kuantitas !']);
                            exit();
                        }

                        if ($post_qty > $cek_stok_ukuran) {
                            echo json_encode(['success' => false,'login' => true,'message' => 'Stok barang yang tersedia untuk ukuran '.$post_size.' tinggal '.$cek_stok.' pcs. Harap kurangi kuantitas !']);
                            exit();
                        }


                        $data = array(
                            'id_produk'     => (int)$this->input->post('id',true),
                            'username'      => $this->session->identity,
                            'created_at'    => date('Y-m-d H:i:s'),
                            'status'        => 'simpan',
                            'quantity'      => $post_qty,
                            'size'          => $post_size
                        );
                        $insert = $this->query_model->insert('m_keranjang',$data);
                    }

                    echo json_encode(['success' => true]);
                }
                else{
                    echo json_encode(['success' => false,'login' => false]);
                }
            break;
            case 'diskusi':
                $query_diskusi['select']    = 'b.nama,a.*';
                $query_diskusi['table']     = 'm_diskusi a';
                $query_diskusi['join'][0]   = array('m_pengguna b','b.username = a.username');
                $query_diskusi['where']     = 'a.id_produk = "'.(int)$this->input->post('id',true).'"';
                $query_diskusi['order']     = 'created_at DESC';
                $diskusi                    = $this->query_model->getData($query_diskusi);

                if($diskusi)
                {
                    foreach ($diskusi as $value) {
                        echo '
                            <div class="single-review">
                                <div class="review-heading">
                                    <div>
                                        <a style="color: #000;font-size: 12px;" href="javascript:void(0);"><i class="fa fa-user"></i> &nbsp;&nbsp;'.$value->nama.'</a>
                                    </div>
                                    <div><a style="font-size: 11px;color: #c1c1c1;" href="javascript:void(0);"><i class="fa fa-clock-o"></i> &nbsp;&nbsp;'.indonesian_date($value->created_at).'</a></div>
                                </div>
                                <div class="review-body">
                                    '.xss($value->pesan).'
                                </div>
                                ';
                                $query_balasan['select']    = 'b.nama,b.username,a.*';
                                $query_balasan['table']     = 'm_diskusi_balasan a';
                                $query_balasan['join'][0]   = array('m_pengguna b','b.username = a.username');
                                $query_balasan['where']     = 'a.id_diskusi = "'.(int)$value->id_diskusi.'"';
                                $query_balasan['order']     = 'created_at ASC';
                                $balasan                    = $this->query_model->getData($query_balasan);
                                foreach ($balasan as $key) {
                                    if($this->input->post('pemilik') == $key->username)
                                    {
                                        echo '
                                            <div class="single-review" style="margin-left: 40px;margin-top: 20px;">
                                                <div class="review-heading">
                                                    <div>
                                                        <a style="color: #000;font-size: 12px;" href="javascript:void(0);"><i class="fa fa-user-o"></i> &nbsp;&nbsp;'.$key->nama.'</a> &nbsp;&nbsp;&nbsp; <label style="color:#e95a5c;font-size:11px">PENJUAL</label>
                                                    </div>
                                                    <div><a style="font-size: 11px;color: #c1c1c1;" href="javascript:void(0);"><i class="fa fa-clock-o"></i> &nbsp;&nbsp;'.indonesian_date($key->created_at).'</a></div>
                                                </div>
                                                <div class="review-body">
                                                    '.xss($key->pesan).'
                                                </div>
                                            </div>
                                        ';
                                    }else{
                                        echo '
                                            <div class="single-review" style="margin-left: 40px;margin-top: 20px;">
                                                <div class="review-heading">
                                                    <div>
                                                        <a style="color: #000;font-size: 12px;" href="javascript:void(0);"><i class="fa fa-user"></i> &nbsp;&nbsp;'.$key->nama.'</a>
                                                    </div>
                                                    <div><a style="font-size: 11px;color: #c1c1c1;" href="javascript:void(0);"><i class="fa fa-clock-o"></i> &nbsp;&nbsp;'.indonesian_date($key->created_at).'</a></div>
                                                </div>
                                                <div class="review-body">
                                                    '.xss($key->pesan).'
                                                </div>
                                            </div>
                                        ';
                                    }
                                   
                                }

                        echo '
                                <div class="text-center">
                                    <a onclick="balas_diskusi('.$value->id_diskusi.')" class="btn btn-xs btn-blue" href="javascript:void(0);">Balas Diskusi</a>
                                </div>
                            </div>
                        ';
                    } 
                }else{
                    echo '
                        <p> Produk Belum Memiliki Diskusi.</p>
                    ';
                }
            break;
            case 'data_alamat':
                $query4['select']   = 'id_alamat,nama_alamat,nama_prop,nama_kota,nama_kec,nama_kel,alamat,nama_penerima,no_penerima,
                id_kel,id_kec,id_kota,id_prop';
                $query4['table']    = 'm_alamat';
                if(isset($_POST['id']))
                {
                     $query4['where']    = 'id_alamat = "'.(int)$this->input->post('id',true).'"';
                }else{
                    $query4['where']    = 'username = "'.$this->session->identity.'" AND utama = 1';
                }
                $alamat             = $this->query_model->getRow($query4);
                if($alamat)
                {
                    echo '
                        <label for="shipping-1">'.@xss(text($alamat->nama_penerima)).' - '.@xss(text($alamat->nama_alamat)).'</label>
                        <label style="font-weight: 500;display: block;">'.@xss($alamat->no_penerima).'</label>
                        <div class="caption">
                            <input type="hidden" name="id_alamat" value="'.@$alamat->id_alamat.'" id="id_alamat">
                            <input type="hidden" name="id_kel" value="'.@$alamat->id_kel.'" id="id_kel">
                            <input type="hidden" name="id_kec" value="'.@$alamat->id_kec.'" id="id_kec">
                            <input type="hidden" name="id_kab" value="'.@$alamat->id_kota.'" id="id_kab">
                            <input type="hidden" name="id_prop" value="'.@$alamat->id_prop.'" id="id_prop">
                            <label  style="font-weight: 500;display: block;">
                                '.text(@$alamat->nama_prop).', '.text(@$alamat->nama_kota).', '.text(@$alamat->nama_kec).', '.text(@$alamat->nama_kel).'
                            </label>
                            <label  style="font-weight: 500;display: block;">
                                '.@xss($alamat->alamat).'
                            <label>
                        </div>
                    ';
                }
                else{
                    echo '
                        <label for="shipping-1">Silahkan Pilih Alamat Pengiriman</label>
                        <br>
                        <input type="hidden" name="id_alamat" value="">
                        <label style="color:#a94441"></label>
                    ';
                }
            break;
            case 'tanggal_waktu':
                echo json_encode(indonesian_date($this->input->post('data')));
            break;
            case 'data_ongkir':
                $id_kurir = $this->input->post('id_kurir',true);
                $expld_kurir = explode('#', $id_kurir);
                $kode_kurir = $expld_kurir[1];
                
                if ($this->input->post('berat')) {
                    $berat = $this->input->post('berat');
                }else{
                    $berat = 1;
                }
                
                $berat_gram = (float)$berat * 1000;

                //get ID kota atau kabupaten asal
                $query['select']   = 'a.ID_CITY_ONGKIR';
                $query['table']    = 'master_kab a';
                $query['where']    = 'a.NO_KAB = "'.(int)$this->input->post('no_kab_umkm',true).'" AND a.NO_PROP = "'.(int)$this->input->post('no_prop_umkm',true).'"';
                $kota_asal         = $this->query_model->getRow($query);

                //get ID kota atau kabupaten tujuan
                $query['select']   = 'a.ID_CITY_ONGKIR';
                $query['table']    = 'master_kab a';
                $query['where']    = 'a.NO_KAB = "'.(int)$this->input->post('no_kab',true).'" AND a.NO_PROP = "'.(int)$this->input->post('no_prop',true).'"';
                $kota_tujuan         = $this->query_model->getRow($query);

                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://pro.rajaongkir.com/api/cost", //pro
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => "origin=".$kota_asal->ID_CITY_ONGKIR."&originType=city&destination=".$kota_tujuan->ID_CITY_ONGKIR."&destinationType=city&weight=".$berat_gram."&courier=".$kode_kurir, //pro
                    CURLOPT_HTTPHEADER => array(
                        "content-type: application/x-www-form-urlencoded",
                        "key: 3c032702205e15477235623ae743a1ed" //webdev tangkot (pro)
                    ),
                ));

                $response = json_decode(curl_exec($curl));
                $err = curl_error($curl);
                curl_close($curl);
                if ($err) {
                    echo json_encode(array('status' => FALSE, 'message' => $err));
                } else {
                    // var_dump(json_encode($response)); die();
                    if ($response->rajaongkir->status->code == 200) {
                        $service_option = '<option value="">--Pilih Service--</option>';
                        foreach ($response->rajaongkir->results as $r) {
                            foreach ($r->costs as $row) {
                                if ($row->cost[0]->etd == "") {
                                    $etd = '';
                                }else{
                                    if ($kode_kurir == 'pos') {
                                        $hari = '';
                                    }else{
                                        $hari = ' hari';
                                    }
                                    $etd = '(Estimasi pengiriman '.strtolower($row->cost[0]->etd).''.$hari.')';
                                }

                                $service_option .= '<option value="'.$row->service.'#'.$row->description.'#'.$row->cost[0]->value.'">'.$row->service.' (Rp. '.rp($row->cost[0]->value).') '.$etd.'</option>';
                            }
                        }
                        
                        echo json_encode(array('status' => TRUE, 'service_option' => $service_option));
                    }else{
                        echo json_encode(array('status' => FALSE, 'message' => $response->rajaongkir->status->description));
                    }
                }
            break;
            case 'count_pesan_all':
                if($this->user_model->is_login()){
                    $query['select']   = 'count(a.id_pesan_detail) as jum';
                    $query['table']    = 'm_pesan_detail a';
                    $query['join'][0]  = array('m_pesan b','b.id_group = a.id_group');
                    $query['where']    = 'b.username_penerima = "'.$this->session->identity.'" AND a.username != "'.$this->session->identity.'" AND (a.is_read IS NULL OR a.is_read = "0")';
                    $data = $this->query_model->getRow($query);
                    $count = $data->jum;
                }else{
                    $count = 0;
                }

                echo json_encode(array('status' => TRUE, 'count' => $count));
            break;
            case 'lacak_resi':
                $no_resi = $this->input->post('no_resi',true);
                $kode_kurir = $this->input->post('kode_kurir',true);
                $curl = curl_init();
                curl_setopt_array($curl, array(
                  CURLOPT_URL => "https://pro.rajaongkir.com/api/waybill",
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => "",
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 30,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => "POST",
                  CURLOPT_POSTFIELDS => "waybill=".$no_resi."&courier=".$kode_kurir,
                  CURLOPT_HTTPHEADER => array(
                    "content-type: application/x-www-form-urlencoded",
                    "key: 3c032702205e15477235623ae743a1ed"
                  ),
                ));

                $response = json_decode(curl_exec($curl));
                $err = curl_error($curl);
                curl_close($curl);
                if (!$response) {
                    echo json_encode(array('status' => FALSE, 'message' => 'Gagal menguhungi server, silahkan coba lagi !'));
                }elseif ($err) {
                    echo json_encode(array('status' => FALSE, 'message' => $err));
                }elseif ($response->rajaongkir->status->code != 200) {
                    echo json_encode(array('status' => FALSE, 'message' => $response->rajaongkir->status->description));
                }else {
                    $html = $this->load->view('transaksi/tracking_pengiriman',$response,true);
                    echo json_encode(array('status' => TRUE, 'data' => $html));
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
            case 'konfirmasi_umkm':
                $this->_validate($type);
                $data = array(
                    'id_status' => $this->input->post('status',true),
                    'alasan'    => $this->input->post('alasan',true)
                );

                $insert = $this->query_model->update('m_umkm',array('id_umkm' => $this->input->post('id',true)), $data);

                if (!$insert){
                    echo json_encode(['success' => false, 'message' => 'Pengajuan gagal diproses','status' => TRUE]);
                }else {
                    if($this->input->post('status') == 3){
                        kirim_email_tolak($this->input->post('id',true));
                    }else if($this->input->post('status') == 1){
                        kirim_email_terima($this->input->post('id',true));
                    }

                    echo json_encode(['success' => true, 'message' => 'Pengajuan Berhasil diproses','status' => TRUE]);
                }
            break;
             case 'quantity':
                if($this->user_model->is_login()){
                    $qty = (int)$this->input->post('jumlah',true);
                    $id_keranjang =  (int)$this->input->post('id_keranjang',true);
                    // $id_produk =  (int)$this->input->post('id_produk',true);

                    $data = array('updated_at'    => date('Y-m-d H:i:s'),
                                  'quantity'      => $qty);

                    $this->query_model->update('m_keranjang',array('id_keranjang' => $id_keranjang), $data);
                    echo json_encode(array('status' => true));
                }else{
                    echo json_encode(array('status' => false,'login' => false));
                }
            break;
            case 'delete_multiple_cart':
                if($this->user_model->is_login()){
                    $id_produk = $this->input->post('id',true);
                    if (is_array($id_produk)) {
                        $this->db->where_in('id_produk',$id_produk);
                        $this->db->where('username',$this->session->identity);
                        $this->db->delete('m_keranjang');
                        echo json_encode(array('status' => true));  
                    }else{
                        echo json_encode(array('status' => false,'login' => true));
                    }
                }else{
                    echo json_encode(array('status' => false,'login' => false));
                }
            break;
            case 'update_checked_multiple':
                if($this->user_model->is_login()){
                    $status = $this->input->post('status',true);
                    if ($status == 'checked') {
                        $data['is_checked'] = 1;
                    }else{
                        $data['is_checked'] = 0;
                    }

                    $data['updated_at'] = date('Y-m-d H:i:s');

                    $this->query_model->update('m_keranjang',array('username' => $this->session->identity), $data);
                    echo json_encode(array('status' => true));
                }else{
                    echo json_encode(array('status' => false,'login' => false));
                }
            break;
            case 'update_checked_multiple_umkm':
                if($this->user_model->is_login()){
                    $status = $this->input->post('status',true);
                    $id_produk = $this->input->post('id_produk',true);
                    if (is_array($id_produk)) {
                        if ($status == 'checked') {
                            $data['is_checked'] = 1;
                        }else{
                            $data['is_checked'] = 0;
                        }

                        $data['updated_at'] = date('Y-m-d H:i:s');

                        $this->db->where_in('id_produk',$id_produk);
                        $this->db->where('username',$this->session->identity);
                        $this->db->update('m_keranjang',$data);
                        echo json_encode(array('status' => true));
                    }else{
                        echo json_encode(array('status' => false,'login' => true));
                    }
                }else{
                    echo json_encode(array('status' => false,'login' => false));
                }
            break;
            case 'update_checked':
                if($this->user_model->is_login()){
                    $id_produk = (int)$this->input->post('id',true);
                    $status = $this->input->post('status',true);
                    if ($status == 'checked') {
                        $data['is_checked'] = 1;
                    }else{
                        $data['is_checked'] = 0;
                    }

                    $data['updated_at'] = date('Y-m-d H:i:s');

                    $this->query_model->update('m_keranjang',array('id_produk' => $id_produk, 'username' => $this->session->identity), $data);
                    echo json_encode(array('status' => true));
                }else{
                    echo json_encode(array('status' => false,'login' => false));
                }
            break;

            case 'subs_token':
                if($this->user_model->is_login()){
                    // update ke m_pengguna
                    $data = array('token_notif_web' => $this->input->post('token',true));
                    $this->query_model->update('m_pengguna', array('username' => $this->session->identity), $data);
                    // set session token firebase
                    $session = array('token_fcm' => $this->input->post('token',true));
                    $this->session->set_userdata($session);
                    echo json_encode(array('status' => true));
                }else{
                    echo json_encode(array('status' => false,'login' => false));
                }
            break;
        }
    }

	private function _validate($type,$data_umkm=null){

        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        switch ($type) {
            case 'checkout':
                if($this->input->post('id_alamat',true) == '')
                {
                    $data['inputerror'][] = 'id_alamat';
                    $data['error_string'][] = 'Alamat Tidak Boleh Kosong';
                    $data['status'] = FALSE;
                }

                foreach ($data_umkm as $key => $u) {
                    if($this->input->post('id_kurir',true)[$u] == '')
                    {
                        $data['inputerror'][] = 'nama_kurir['.$u.']';
                        $data['error_string'][] = 'Kurir Tidak Boleh Kosong';
                        $data['status'] = FALSE;
                    }

                    if($this->input->post('kurir_service',true)[$u] == '')
                    {
                        $data['inputerror'][] = 'nama_service['.$u.']';
                        $data['error_string'][] = 'Service Tidak Boleh Kosong';
                        $data['status'] = FALSE;
                    }
                }

                if($this->input->post('pilih_pembayaran',true) == '')
                {
                    $data['inputerror'][] = 'pilih_pembayaran_hidden';
                    $data['error_string'][] = 'Metode Pembayaran Tidak Boleh Kosong';
                    $data['status'] = FALSE;
                }
               
                if($data['status'] === FALSE)
                {
                    echo json_encode($data);
                    exit();
                }
            break;
            case 'simpan_diskusi':
                if($this->input->post('pesan',true) == '')
                {
                    $data['inputerror'][] = 'pesan';
                    $data['error_string'][] = 'Data Tidak Boleh Kosong';
                    $data['status'] = FALSE;
                }
               
                if($data['status'] === FALSE)
                {
                    echo json_encode($data);
                    exit();
                }
            break;
            case 'balas_diskusi':
                if($this->input->post('pesan_diskusi',true) == '')
                {
                    $data['inputerror'][] = 'pesan_balasan';
                    $data['error_string'][] = 'Data Tidak Boleh Kosong';
                    $data['status'] = FALSE;
                }
               
                if($data['status'] === FALSE)
                {
                    echo json_encode($data);
                    exit();
                }
            break;
            case 'simpan_pesan':
                if($this->input->post('pesan',true) == '')
                {
                    $data['inputerror'][] = 'pesan_chat';
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

    public function table_alamat()
    {
        $this->data = array(
            'name'      => $this->security->get_csrf_token_name(),
            'hash'      => $this->security->get_csrf_hash(),
        );
        $this->load->view('keranjang/table',$this->data);
    }

    public function ajax_services()
    {
        $type = $this->input->get('type');
        switch ($type) {
               case 'list_pesan':
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
                break;
               
               default:
                   # code...
                   break;
           }   
    }

    private function _cek_keranjang(){
        // echo $this->session->identity;die;
        $cek['select']  = 'a.status,a.quantity';
        $cek['table']   = 'm_keranjang a';
        $cek['where']   = 'a.username = "'.$this->session->identity.'"AND a.size ="'.$this->input->post('size',true).'" AND a.id_produk = "'.(int)$this->input->post('id',true).'"';
        $keranjang      = $this->query_model->getRow($cek);
        return $keranjang;
    }

    private function _get_jum_keranjang(){
        $query['select']    = 'a.status';
        $query['table']     = 'm_keranjang a';
        $query['join'][0]  = array('m_produk b','b.id_produk = a.id_produk');
        $query['join'][1]  = array('m_umkm c','c.id_umkm = b.id_umkm');
        $query['where']     = 'a.status = "simpan" AND a.username = "'.$this->session->identity.'" AND b.status = 1 AND c.id_status IN(1,2)';
        $jml_keranjang      = $this->query_model->getNum($query);
        return $jml_keranjang;
    }

    private function _get_list_keranjang($id_produk){
        $query2['select']   = 'b.harga,b.nama_produk,c.id_umkm as username,a.id_produk,a.quantity,b.kode_produk,(select foto from m_produk_foto  WHERE id_produk = a.id_produk LIMIT 1) as foto';
        $query2['table']    = 'm_keranjang a';
        $query2['join'][0]  = array('m_produk b','b.id_produk = a.id_produk');
        $query2['join'][1]  = array('m_umkm c','c.id_umkm = b.id_umkm');
        $query2['where']    = 'a.status = "simpan" AND a.username = "'.$this->session->identity.'" AND a.id_produk = '.$id_produk;
        $value              = $this->query_model->getRow($query2);

        $data_keranjang = '<li class="item-cart '.$value->id_produk.'">
                                <div class="product-img-wrap">
                                    <a href="'.base_url('list-produk/produk/'.short($value->kode_produk)).'"><img src="'.base_url('assets/produk/'.$value->username.'/'.$value->foto).'" alt="" class="img-reponsive"></a>
                                </div>
                                <div class="product-details">
                                    <div class="inner-left">
                                        <div class="product-name"><a href="'.base_url('list-produk/produk/'.short($value->kode_produk)).'">'.readMore($value->nama_produk,50).'</a></div>
                                        <div class="product-price">
                                            Rp. '.rp($value->harga).'<span>( x '.$value->quantity.')</span>
                                        </div>
                                    </div>
                                </div>
                                <div title="Hapus Produk dari Keranjang" class="e-del hapus-produk" data-id="'.$value->id_produk.'"><i class="fa fa-trash"></i></div>
                            </li>';

        return $data_keranjang;
    }

    private function get_uuid()
    {
        return sprintf(
            '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff)
        );
    }

    private function get_contact_user($user_id){
        $query['select']    = 'a.email,a.no_telp';
        $query['table']     = 'm_pengguna a';
        $query['where']     = 'a.id_pengguna = '.(int)$user_id;
        $data               = $this->query_model->getRow($query);
        return $data;
    }
    private function get_data_visitor($visitor_id){
        $query['select']    = 'a.*';
        $query['table']     = 'm_visitor_anon a';
        $query['where']     = 'a.visitor_id = '.$visitor_id;
        $data               = $this->query_model->getRow($query);
        return $data;
    }

    private function get_data_penerima($user_id){
        $query['select']    = 'a.nama_penerima,a.no_penerima';
        $query['table']     = 'm_alamat a';
        $query['where']     = 'a.username = '.$user_id;
        $data               = $this->query_model->getRow($query);
        return $data;
    }

   
}