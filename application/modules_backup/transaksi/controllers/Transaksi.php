<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->template->set_layout('templates/backend');
        $this->load->model('transaksi_model');
        if(!$this->user_model->is_login())
        {
            redirect(base_url());
        }
       
    }

    public function customer() {
        $this->session->set_tempdata('jenis_menu','user',300); 
        $this->template->add_title_segment('Daftar Transaksi Pembelian');

        $this->template->add_css('assets/transaksi.css');
        $this->template->add_css('assets/css/pesan.css');
        // $this->template->add_js('assets/js.js');

        $this->template->add_js('https://cdn.ckeditor.com/4.9.2/standard-all/ckeditor.js');
        $this->template->add_js('assets/ckfinder/ckfinder.js');
        $this->template->add_js('assets/rating/js/star-rating.js');
        $this->template->add_js('assets/plugins/tables/datatables/datatables.min.js');
        $this->template->add_js('assets/plugins/tables/datatables/extensions/fixed_columns.min.js');
        $this->template->add_js('assets/plugins/forms/selects/select2.min.js');
        $this->template->add_js('assets/plugins/notifications/sweet_alert.min.js');

        $k = keranjangku();
        $keranjang = $k['keranjang'];
        $jml_keranjang = $k['jml_keranjang'];

        $this->data = array(
            'active'    => 'transaksi_customer',
            'name'      => $this->security->get_csrf_token_name(),
            'hash'      => $this->security->get_csrf_hash(),
            'keranjang' => $keranjang,
            'jml_keranjang' => $jml_keranjang,
            'kategori' => $this->query_model->getKategori(),
            'master_status_transaksi' => $this->transaksi_model->get_m_status_transaksi(),
            'title_beranda' => 'Transaksi Pembelian'
        );

        $this->template->render("customer/index",$this->data);
    }

    public function penjual() {
        $this->session->set_tempdata('jenis_menu','admin',300); 
        $this->template->add_title_segment('Daftar Transaksi Penjualan');

        $this->template->add_css('assets/transaksi.css');
        $this->template->add_css('assets/css/css_umkm.css');
        $this->template->add_css('assets/css/pesan.css');
        // $this->template->add_js('assets/js.js');

        $this->template->add_js('https://cdn.ckeditor.com/4.9.2/standard-all/ckeditor.js');
        $this->template->add_js('assets/ckfinder/ckfinder.js');
        $this->template->add_js('assets/rating/js/star-rating.js');
        $this->template->add_js('assets/plugins/tables/datatables/datatables.min.js');
        $this->template->add_js('assets/plugins/tables/datatables/extensions/fixed_columns.min.js');
        $this->template->add_js('assets/plugins/forms/selects/select2.min.js');
        $this->template->add_js('assets/plugins/notifications/sweet_alert.min.js');

        $k = keranjangku();
        $keranjang = $k['keranjang'];
        $jml_keranjang = $k['jml_keranjang'];

        $this->data = array(
            'active'    => 'transaksi_penjual',
            'kategori'  => $this->query_model->getKategori(),
            'name'      => $this->security->get_csrf_token_name(),
            'hash'      => $this->security->get_csrf_hash(),
            'keranjang' => $keranjang,
            'jml_keranjang' => $jml_keranjang,
            'option_umkm'   => $this->query_model->getumkm(),
            'master_status_transaksi' => $this->transaksi_model->get_m_status_transaksi(),
            'title_beranda' => 'Transaksi Penjualan'
        );

        $this->template->render("penjual/index",$this->data);
    }

    public function admin(){
        if(!$this->user_model->is_umkm_admin()){
            redirect(base_url());
        }

        $this->session->set_tempdata('jenis_menu','admin',300); 
        $this->template->add_title_segment('Daftar Transaksi');

        $this->template->add_css('assets/transaksi.css');
        $this->template->add_css('assets/css/css_umkm.css');
        $this->template->add_css('assets/css/pesan.css');
        // $this->template->add_js('assets/js.js');

        $this->template->add_js('https://cdn.ckeditor.com/4.9.2/standard-all/ckeditor.js');
        $this->template->add_js('assets/ckfinder/ckfinder.js');
        $this->template->add_js('assets/rating/js/star-rating.js');
        $this->template->add_js('assets/plugins/tables/datatables/datatables.min.js');
        $this->template->add_js('assets/plugins/tables/datatables/extensions/fixed_columns.min.js');
        $this->template->add_js('assets/plugins/forms/selects/select2.min.js');
        $this->template->add_js('assets/plugins/notifications/sweet_alert.min.js');

        $k = keranjangku();
        $keranjang = $k['keranjang'];
        $jml_keranjang = $k['jml_keranjang'];

        $this->data = array(
            'active'    => 'transaksi_admin',
            'kategori'  => $this->query_model->getKategori(),
            'name'      => $this->security->get_csrf_token_name(),
            'hash'      => $this->security->get_csrf_hash(),
            'keranjang' => $keranjang,
            'jml_keranjang' => $jml_keranjang,
            'option_umkm'   => $this->query_model->getumkm(),
            'master_status_transaksi' => $this->transaksi_model->get_m_status_transaksi(),
            'title_beranda' => 'Transaksi',
            'id_transaksi' => @$this->input->post('id_transaksi')
        );

        $this->template->render("admin/index",$this->data);
    }

    public function ajax_list()
    {
        $type = $this->input->post('type');
        $data   = array();
        $sort   = isset($_POST['columns'][$_POST['order'][0]['column']]['data']) ? strval($_POST['columns'][$_POST['order'][0]['column']]['data']) : 'nama';
        $order  = isset($_POST['order'][0]['dir']) ? strval($_POST['order'][0]['dir']) : 'asc';
        $no     = $this->input->post('start');
        switch ($type) {
            case 'customer':
                $list = $this->m_table->get_datatables('data_pembelian',$sort,$order);
                foreach ($list as $l) {
                    $btn_ulasan = $btn_upload_pembayaran = $btn_beli_lagi = '';
                    if($l->id_status_transaksi == 4){ //jika status = sampai tujuan
                        $cek = cek_ulasan($l->id_transaksi);
                        if($cek){
                            $btn_ulasan = '<div class="css-1v0ixe8">
                                                <a href="javascript:void(0);" onclick="lihat_ulasan('.$l->id_transaksi.')" style="color: #5cb85c;">
                                                    <span class="fa fa-eye" style="font-size: 14px;margin-top: -5px;margin-right: 10px;"></span>
                                                    <span>Lihat Ulasan</span>
                                                </a>
                                            </div>';
                        }else{
                            $btn_ulasan = '<div class="css-1v0ixe8">
                                                <a href="javascript:void(0);" onclick="tambah_ulasan('.$l->id_transaksi.')" style="color: #5cb85c;">
                                                    <span class="fa fa-plus" style="font-size: 14px;margin-top: -5px;margin-right: 10px;"></span>
                                                    <span>Tambah Ulasan</span>
                                                </a>
                                            </div>';
                        } 

                        $btn_beli_lagi = '<div style="margin-top:10px;">
                                            <button class="css-duvvqm-unf-btn e7i7yvm0" style="margin-bottom:10px;">
                                                <span>
                                                    Beli Lagi
                                                </span>
                                            </button>
                                        </div>';
                    }

                    if ($l->id_status_transaksi == 0) { //jika status menunggu pembayaran
                        $btn_upload_pembayaran = '<div class="css-1v0ixe8">
                                                    <a href="javascript:void(0);" onclick="upload_bukti_bayar('.$l->id_transaksi.')" style="color: #5cb85c;">
                                                        <span class="fa fa-upload" style="font-size: 14px;margin-top: -5px;margin-right: 10px;"></span>
                                                        <span>Upload Bukti Pembayaran</span>
                                                    </a>
                                                </div>';
                    }

                    $l->dt = '
                    <section class="order-bom css-1mlqw8x-unf-card e16a7sp70">
                        <div class="flex flex--between padding border--bottom">
                            <a style="margin: 0 auto;" href="javascript:void(0);" class="font__size--m font--bold font--ellipsis css-1e6gctp-unf-link edi449x0" font-size="12">
                                    '.$l->nama_status.'
                                </a>
                            <div class="order-bom__label"></div>
                        </div>
                        <div class="header flex">
                            <div class="trx-info trx-info--with-32">
                                <a target="_blank" href="'.base_url('list-umkm/umkm/'.short($l->id_umkm)).'" class="font__size--m font--bold font--ellipsis css-1e6gctp-unf-link edi449x0" font-size="12">
                                    '.$l->namausaha.'
                                </a>
                                <span data-testid="txtBomInvoiceNumber-425371452" class="font--ellipsis">
                                    '.$l->no_invoice.'
                                </span>
                            </div>
                            <div class="trx-info trx-info--with-32">
                                <a href="javascript:void(0);" class="font__size--m font--bold font--ellipsis css-1e6gctp-unf-link edi449x0" font-size="12">
                                    Tanggal Pemesanan
                                </a>
                                <span data-testid="txtBomInvoiceNumber-425371452" class="font--ellipsis">
                                    '.indonesian_date($l->created_at).'
                                </span>
                            </div>
                            <div class="trx-info trx-info--with-32">
                                <a href="javascript:void(0);" class="font__size--m font--bold font--ellipsis css-1e6gctp-unf-link edi449x0" font-size="12">
                                    Total Belanja
                                </a>
                                <span data-testid="txtBomInvoiceNumber-425371452" class="font--ellipsis">
                                    Rp. '.rp($l->total).'
                                </span>
                            </div>
                        </div>
                        <div class="body flex">
                            <div class="content">
                                <div>
                                    <div class="product__item bom">
                                        <a font-size="12" class="css-1e6gctp-unf-link edi449x0 foto_produk" style="background:url('.base_url('assets/produk/'.$l->id_umkm.'/'.$l->foto).')">
                                           
                                        </a>
                                        <a class="product__item__desc css-1e6gctp-unf-link edi449x0" font-size="12" href="'.base_url('list-produk/produk/'.short($l->kode_produk)).'" target="_blank">
                                            <div class="font__size--m font--bold ellipsis-two-line">
                                                <div data-testid="lnkBomProductName-425371452">
                                                    '.$l->nama_produk.'
                                                </div>
                                            </div>
                                            <div>
                                                <span data-testid="txtBomProductDetailPrice-425371452" class="font__type--trx" style="font-size:13px !important;">
                                                    Rp '.rp($l->harga).'
                                                </span>
                                                <span data-testid="txtBomProductDetailQtyWeight-425371452" class="css-1n5r376 padding--left" style="font-size:13px !important;">
                                                    '.$l->quantity.' Produk
                                                </span>
                                                '.$btn_beli_lagi.'
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                '.($l->jumlah_barang > 1 ? '<div class="showmore" onclick="detail_pesanan('.$l->id_transaksi.')">
                                    <span>
                                        Lihat '.($l->jumlah_barang - 1).' Produk Lainnya
                                    </span></div>':'').'
                            </div>
                            <div class="footer flex font__size--m" style="margin:0;">
                                <div class="flex flex--center">
                                    '.$btn_ulasan.'
                                    '.$btn_upload_pembayaran.'
                                    <div class="css-gcemtj">
                                        <a href="javascript:void(0);" onclick="detail_pesanan('.$l->id_transaksi.')">
                                            <span class="fa fa-eye" style="font-size: 14px;margin-top: -5px;margin-right: 10px;"></span>
                                            <span>Lihat Detail Pesanan</span>
                                        </a>
                                    </div>
                                    <div class="css-gcemtj">
                                        <div class="css-1jyc08">
                                            <a href="javascript:void(0);" onclick="hubungi_pesan('.$l->id_transaksi.','.$l->id_umkm.')">
                                                <span class="fa fa-comments" style="font-size: 14px;margin-top: -5px;margin-right: 10px;"></span>
                                                <span>Hubungi Penjual</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>'; 
                    
                    $data[] = $l;
                }

                $output = array(
                    "draw"              => $_POST['draw'],
                    "recordsTotal"      => $this->m_table->count_all('data_pembelian',$sort,$order),
                    "recordsFiltered"   => $this->m_table->count_filtered('data_pembelian',$sort,$order),
                    "data"              => $data,
                );  
                echo json_encode($output);  
            break;
            case 'penjual':
                $list = $this->m_table->get_datatables('data_penjualan',$sort,$order);
                foreach ($list as $l) {
                    $btn_ulasan = '';
                    if($l->id_status_transaksi == 4){ //jika status = sampai tujuan
                        $cek = cek_ulasan($l->id_transaksi);
                        if($cek){
                            $btn_ulasan = '<div class="css-1v0ixe8">
                                                <a href="javascript:void(0);" onclick="lihat_ulasan('.$l->id_transaksi.')" style="color: #5cb85c;">
                                                    <span class="fa fa-eye" style="font-size: 14px;margin-top: -5px;margin-right: 10px;"></span>
                                                    <span>Lihat Ulasan</span>
                                                </a>
                                            </div>'; 
                        }
                    }

                    $l->dt = '
                    <section class="order-bom css-1mlqw8x-unf-card e16a7sp70">
                        <div class="flex flex--between padding border--bottom">
                            <a style="margin: 0 auto;" href="javascript:void(0);" class="font__size--m font--bold font--ellipsis css-1e6gctp-unf-link edi449x0" font-size="12">
                                    '.$l->nama_status.' | Pembeli '.text($l->nama).'
                                </a>
                            <div class="order-bom__label"></div>
                        </div>
                        <div class="header flex">
                            <div class="trx-info trx-info--with-32">
                                <a href="javascript:void(0);" class="font__size--m font--bold font--ellipsis css-1e6gctp-unf-link edi449x0" font-size="12">
                                    Tanggal Pemesanan
                                </a>
                                <span data-testid="txtBomInvoiceNumber-425371452" class="font--ellipsis">
                                    '.indonesian_date($l->created_at).'
                                </span>
                            </div>
                            
                             <div class="trx-info trx-info--with-32">
                                <a href="javascript:void(0);" class="font__size--m font--bold font--ellipsis css-1e6gctp-unf-link edi449x0" font-size="12">
                                    Nomor Invoice
                                </a>
                                <span data-testid="txtBomInvoiceNumber-425371452" class="font--ellipsis">
                                    '.$l->no_invoice.'
                                </span>
                            </div>
                            <div class="trx-info trx-info--with-32">
                                <a href="javascript:void(0);" class="font__size--m font--bold font--ellipsis css-1e6gctp-unf-link edi449x0" font-size="12">
                                    Total Belanja
                                </a>
                                <span data-testid="txtBomInvoiceNumber-425371452" class="font--ellipsis">
                                    Rp. '.rp($l->total).'
                                </span>
                            </div>
                        </div>
                        <div class="body flex">
                            <div class="content">
                                <div>
                                    <div class="product__item bom">
                                        <a font-size="12" class="css-1e6gctp-unf-link edi449x0 foto_produk" style="background:url('.base_url('assets/produk/'.$l->id_umkm.'/'.$l->foto).')">
                                           
                                        </a>
                                        <a class="product__item__desc css-1e6gctp-unf-link edi449x0" font-size="12" href="'.base_url('list-produk/produk/'.short($l->kode_produk)).'" target="_blank">
                                            <div class="font__size--m font--bold ellipsis-two-line">
                                                <div data-testid="lnkBomProductName-425371452">
                                                    '.$l->nama_produk.'
                                                </div>
                                            </div>
                                            <div>
                                                <span data-testid="txtBomProductDetailPrice-425371452" class="font__type--trx" style="font-size:13px !important;">
                                                    Rp '.rp($l->harga).'
                                                </span>
                                                <span data-testid="txtBomProductDetailQtyWeight-425371452" class="css-1n5r376 padding--left" style="font-size:13px !important;">
                                                    '.$l->quantity.' Produk
                                                </span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                '.($l->jumlah_barang > 1 ? '<div class="showmore" onclick="detail_pesanan('.$l->id_transaksi.')">
                                    <span>
                                        Lihat '.($l->jumlah_barang - 1).' Produk Lainnya
                                    </span></div>':'').'
                            </div>
                            <div class="footer flex font__size--m" style="margin:0;">
                                <div class="flex flex--center">
                                    '.$btn_ulasan.'
                                    <div class="css-gcemtj">
                                        <a href="javascript:void(0);" onclick="detail_pesanan('.$l->id_transaksi.')">
                                            <span class="fa fa-eye" style="font-size: 14px;margin-top: -5px;margin-right: 10px;"></span>
                                            <span>Lihat Detail Pesanan</span>
                                        </a>
                                    </div>
                                    <div class="css-gcemtj">
                                        <div class="css-1jyc08">
                                            <a href="javascript:void(0);" onclick="hubungi_pesan('.$l->id_transaksi.','.$l->id_umkm.')">
                                                <span class="fa fa-comments" style="font-size: 14px;margin-top: -5px;margin-right: 10px;"></span>
                                                <span>Hubungi '.text($l->nama).'</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>'; 
                    
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

            case 'admin':
                $list = $this->m_table->get_datatables('data_penjualan',$sort,$order);
                foreach ($list as $l) {
                    $btn_ulasan = '';
                    if($l->id_status_transaksi == 4){ //jika status = sampai tujuan
                        $cek = cek_ulasan($l->id_transaksi);
                        if($cek){
                            $btn_ulasan = '<div class="css-1v0ixe8">
                                                <a href="javascript:void(0);" onclick="lihat_ulasan('.$l->id_transaksi.')" style="color: #5cb85c;">
                                                    <span class="fa fa-eye" style="font-size: 14px;margin-top: -5px;margin-right: 10px;"></span>
                                                    <span>Lihat Ulasan</span>
                                                </a>
                                            </div>'; 
                        }
                    }

                    $l->dt = '
                    <section class="order-bom css-1mlqw8x-unf-card e16a7sp70">
                        <div class="flex flex--between padding border--bottom">
                            <a style="margin: 0 auto;" href="javascript:void(0);" class="font__size--m font--bold font--ellipsis css-1e6gctp-unf-link edi449x0" font-size="12">
                                    '.$l->nama_status.' | Pembeli '.text($l->nama).' | Penjual '.text($l->namausaha).'
                                </a>
                            <div class="order-bom__label"></div>
                        </div>
                        <div class="header flex">
                            <div class="trx-info trx-info--with-32">
                                <a href="javascript:void(0);" class="font__size--m font--bold font--ellipsis css-1e6gctp-unf-link edi449x0" font-size="12">
                                    Tanggal Pemesanan
                                </a>
                                <span data-testid="txtBomInvoiceNumber-425371452" class="font--ellipsis">
                                    '.indonesian_date($l->created_at).'
                                </span>
                            </div>
                            
                             <div class="trx-info trx-info--with-32">
                                <a href="javascript:void(0);" class="font__size--m font--bold font--ellipsis css-1e6gctp-unf-link edi449x0" font-size="12">
                                    Nomor Invoice
                                </a>
                                <span data-testid="txtBomInvoiceNumber-425371452" class="font--ellipsis">
                                    '.$l->no_invoice.'
                                </span>
                            </div>
                            <div class="trx-info trx-info--with-32">
                                <a href="javascript:void(0);" class="font__size--m font--bold font--ellipsis css-1e6gctp-unf-link edi449x0" font-size="12">
                                    Total Belanja
                                </a>
                                <span data-testid="txtBomInvoiceNumber-425371452" class="font--ellipsis">
                                    Rp. '.rp($l->total).'
                                </span>
                            </div>
                        </div>
                        <div class="body flex">
                            <div class="content">
                                <div>
                                    <div class="product__item bom">
                                        <a font-size="12" class="css-1e6gctp-unf-link edi449x0 foto_produk" style="background:url('.base_url('assets/produk/'.$l->id_umkm.'/'.$l->foto).')">
                                           
                                        </a>
                                        <a class="product__item__desc css-1e6gctp-unf-link edi449x0" font-size="12" href="'.base_url('list-produk/produk/'.short($l->kode_produk)).'" target="_blank">
                                            <div class="font__size--m font--bold ellipsis-two-line">
                                                <div data-testid="lnkBomProductName-425371452">
                                                    '.$l->nama_produk.'
                                                </div>
                                            </div>
                                            <div>
                                                <span data-testid="txtBomProductDetailPrice-425371452" class="font__type--trx" style="font-size:13px !important;">
                                                    Rp '.rp($l->harga).'
                                                </span>
                                                <span data-testid="txtBomProductDetailQtyWeight-425371452" class="css-1n5r376 padding--left" style="font-size:13px !important;">
                                                    '.$l->quantity.' Produk
                                                </span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                '.($l->jumlah_barang > 1 ? '<div class="showmore" onclick="detail_pesanan('.$l->id_transaksi.')">
                                    <span>
                                        Lihat '.($l->jumlah_barang - 1).' Produk Lainnya
                                    </span></div>':'').'
                            </div>
                            <div class="footer flex font__size--m" style="margin:0;">
                                <div class="flex flex--center">
                                    '.$btn_ulasan.'
                                    <div class="css-gcemtj">
                                        <a href="javascript:void(0);" onclick="detail_pesanan('.$l->id_transaksi.')">
                                            <span class="fa fa-eye" style="font-size: 14px;margin-top: -5px;margin-right: 10px;"></span>
                                            <span>Lihat Detail Pesanan</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>'; 
                    
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
            
            default:
                # code...
             break;
        }        
    }

    public function ajax_lihat()
    {
        $type = $this->input->post('type',true);
        switch ($type) {
            case 'detail_pesanan':
                $data = array();
                $query['select']    = 'a.id_transaksi,b.nama_status, a.created_at,
                a.no_invoice,a.id_status_transaksi,a.total_harga,a.total, c.nama_kurir,a.kurir_service,c.kode_kurir,a.no_resi,d.nama_penerima,d.no_penerima,d.alamat,d.nama_prop,d.nama_kota,d.nama_kec,d.nama_kel,a.ongkir,e.namausaha,a.bukti_pembayaran, a.tgl_pembayaran,a.tgl_konfirmasi,a.tgl_kirim,a.tgl_sampai,a.pesan_batal';
                $query['table']     = 'm_transaksi a';
                $query['join'][0]   = array('m_status_transaksi b','b.id_status_transaksi = a.id_status_transaksi');
                $query['join'][1]   = array('m_kurir c','c.id_kurir = a.id_kurir');
                $query['join'][2]   = array('m_alamat d','d.id_alamat = a.id_alamat');
                $query['join'][3]   = array('m_umkm e','e.id_umkm = a.id_umkm');
                $query['where']     = 'a.id_transaksi = '.(int)$this->input->post('id',true);
                $data               = $this->query_model->getRows($query);
                $data->created_at   = indonesian_date($data->created_at);
                $data->tgl_pembayaran   = indonesian_date($data->tgl_pembayaran);
                $data->tgl_konfirmasi   = indonesian_date($data->tgl_konfirmasi);
                $data->tgl_kirim        = indonesian_date($data->tgl_kirim);
                $data->tgl_sampai       = indonesian_date($data->tgl_sampai);

                $query1['select']   = 'a.quantity,a.harga,a.catatan, b.id_umkm,b.nama_produk,b.kode_produk,(select foto from m_produk_foto  WHERE id_produk = a.id_produk LIMIT 1) as foto';
                $query1['table']    = 'm_transaksi_detail a';
                $query1['join'][0]  = array('m_produk b','b.id_produk = a.id_produk');
                $query1['where']    = 'a.id_transaksi = '.(int)$this->input->post('id',true);
                $data->produk       = $this->query_model->getData($query1);

                echo json_encode($data);
            break;
            case 'ratting_ulasan':
                $query['select'] = 'b.nama_produk, a.harga,a.quantity, a.id_transaksi_detail, c.namausaha, d.nama_kel, e.logo_umkm, (select foto from m_produk_foto  WHERE id_produk = a.id_produk LIMIT 1) as foto, b.id_umkm as username ,b.id_produk,a.id_transaksi';
                $query['table'] = 'm_transaksi_detail a';
                $query['join'][0] = array('m_produk b','b.id_produk = a.id_produk');
                $query['join'][1] = array('m_umkm c','c.id_umkm = b.id_umkm');
                $query['join'][2] = array('m_umkm_alamat d','d.id_umkm = c.id_umkm','left');
                $query['join'][3] = array('m_umkm_berkas e','e.id_umkm = c.id_umkm','left');
                $query['join'][4] = array('m_pengguna f','f.username = c.username');
                $query['where']     = 'a.id_transaksi = '.(int)$this->input->post('id',true);
                $data               = $this->query_model->getRow($query);
                echo json_encode($data);
            break;
            case 'data_ratting':
                $query['select']    = '*';
                $query['table']     = 'm_ulasan';
                $query['where']     = 'id_transaksi = '.(int)$this->input->post('id',true);
                $data               = $this->query_model->getRow($query);
                echo json_encode($data); 
            break;
            case 'tambah_ulasan':
                $query1['select']   = 'a.quantity,a.harga,a.catatan, b.id_umkm,b.nama_produk,b.kode_produk,(select foto from m_produk_foto  WHERE id_produk = a.id_produk LIMIT 1) as foto,a.id_produk,c.username as username_toko,a.id_transaksi_detail';
                $query1['table']    = 'm_transaksi_detail a';
                $query1['join'][0]  = array('m_produk b','b.id_produk = a.id_produk');
                $query1['join'][1]  = array('m_umkm c','c.id_umkm = b.id_umkm');
                $query1['where']    = 'a.id_transaksi = '.(int)$this->input->post('id',true);
                $this->data         = array(
                                        'produk'    => $this->query_model->getData($query1)
                                    );

                $this->load->view('customer/ulasan_tambah',$this->data);
            break;
            case 'view_ulasan':
                $query1['select']   = 'a.quantity,a.harga,a.catatan, b.id_umkm,b.nama_produk,b.kode_produk,(select foto from m_produk_foto  WHERE id_produk = a.id_produk LIMIT 1) as foto,a.id_produk,c.username as username_toko,m.ratting, m.deskripsi';
                $query1['table']    = 'm_ulasan m';
                $query1['join'][0]  = array('m_transaksi_detail a','a.id_transaksi_detail = m.id_transaksi_detail');
                $query1['join'][1]  = array('m_produk b','b.id_produk = a.id_produk');
                $query1['join'][2]  = array('m_umkm c','c.id_umkm = b.id_umkm');
                $query1['where']    = 'a.id_transaksi = '.(int)$this->input->post('id',true);
                $this->data         = array(
                                        'produk'    => $this->query_model->getData($query1)
                                    );

                $this->load->view('customer/ulasan_view',$this->data);
            break;
            case 'detail_pembayaran':
                $query['select']    = 'a.id_transaksi,a.total,a.total_harga,a.ongkir,b.namausaha,b.no_rekening,b.an_rekening,b.nama_bank';
                $query['table']     = 'm_transaksi a';
                $query['join'][0]   = array('m_umkm b','b.id_umkm = a.id_umkm');
                $query['where']     = 'a.id_transaksi = '.(int)$this->input->post('id',true);
                $data               = $this->query_model->getRows($query);
                echo json_encode($data);
            break;
            default:
                # code...
                break;
        }
    }

    public function ajax_data()
    {
        $type = $this->input->post('type',true);
        switch ($type) {
            case 'status_transaksi':
                $hasil              = $this->transaksi_model->getStatusTransaksi($this->input->post('id',true));
                $option='<option value="0">-- Pilih Status --</option>';
                foreach ($hasil as $value) {
                    $option .= '<option value='.$value->id_status_transaksi.'>'.$value->nama_status.'</option>';
                }
                echo $option;
            break;
            case 'data_kurir':
                $query['select'] = '*';
                $query['table'] = 'm_kurir';
                $query['where'] = 'status = 1';
                $hasil = $this->query_model->getData($query);

                $kurir_umkm = null;
                if ($this->input->post('is_kurir_umkm') != null) {
                    $query2['select'] = 'id_kurir';
                    $query2['table'] = 'm_umkm';
                    $query2['where'] = 'id_umkm = '.(int)$this->input->post('id_umkm',true);
                    $data_kurir_umkm = $this->query_model->getRow($query2);
                    if ($data_kurir_umkm) {
                        $kurir_umkm = json_decode($data_kurir_umkm->id_kurir);
                    }
                }

                $option='';
                foreach ($hasil as $value) {
                    if ($kurir_umkm) {
                        if (in_array($value->id_kurir, $kurir_umkm)) {
                            $selected = 'selected';
                        }else{
                            $selected = '';
                        }
                        $option .= '<option value='.$value->id_kurir.' '.$selected.'>'.$value->nama_kurir.'</option>';
                    }else{
                        $option .= '<option value='.$value->id_kurir.'>'.$value->nama_kurir.'</option>';
                    }
                }
                echo $option;
            break;
            
            default:
                # code...
                break;
        }
    }

    public function ajax_save(){
        $type = $this->input->post('type',true);
        switch ($type) {
            case 'ubah_transaksi':
                $this->_validate($type);

                $status_transaksi = $this->input->post('status_transaksi',true);
                $data1 = array(
                        'id_status_transaksi'   => $status_transaksi,
                        'updated_at'            => date('Y-m-d H:i:s'),
                        'updated_by'            => $this->session->identity
                    );

                if($status_transaksi == 3){ //jika status = dikirim
                    $data2 = array(
                        'no_resi'               => $this->input->post('no_resi',true),
                        'tgl_kirim'             => date('Y-m-d H:i:s'),
                    );

                    $query_penjual['select']    = 'a.id_produk,a.quantity,b.stok';
                    $query_penjual['table']     = 'm_transaksi_detail a';
                    $query_penjual['join'][0]   = array('m_produk b','b.id_produk = a.id_produk');
                    $query_penjual['where']     = 'a.id_transaksi = '.(int)$this->input->post('id',true);
                    $hasil_query                = $this->query_model->getData($query_penjual);
                    foreach ($hasil_query as $key => $value) {
                        $stok = $value->stok - $value->quantity;
                        $quantity = array(
                            'stok'          => $stok,
                            'updated_at'    => date('Y-m-d H:i:s')
                        );
                        $this->query_model->update('m_produk',array('id_produk' => $value->id_produk), $quantity);
                    }

                }elseif ($status_transaksi == 2) { //jika status = proses
                    $data2 = array('tgl_konfirmasi'  => date('Y-m-d H:i:s'));
                }elseif ($status_transaksi == 5) { //jika status = batal
                    $data2 = array('tgl_konfirmasi'  => date('Y-m-d H:i:s'),
                                   'pesan_batal'     => $this->input->post('pesan_batal',true),
                             );
                }elseif($status_transaksi == 4){ //jika status = sampai
                    $data2 = array('tgl_sampai'  => date('Y-m-d H:i:s'));
                }

                $data = array_merge($data1,$data2);
                $insert = $this->query_model->update('m_transaksi',array('id_transaksi' => $this->input->post('id',true)), $data);
                if (!$insert){
                    echo json_encode(['success' => false, 'message' => 'Data transaksi gagal diubah','status' => TRUE]);
                }else{
                    if($status_transaksi == 3){
                        kirim_email_transaksi_pengiriman($this->input->post('id',true));
                    }else{
                        kirim_email_transaksi_status($this->input->post('id',true));
                    }
                    echo json_encode(['success' => true, 'message' => 'Data transaksi berhasil diubah','status' => TRUE]);
                }
            break;
            case 'transaksi_admin':
                $data = array(
                    'id_status_transaksi'   => 4, //status sampai tujuan
                    'updated_at'            => date('Y-m-d H:i:s'),
                    'tgl_sampai'            => date('Y-m-d H:i:s'),
                );
                
                $insert = $this->query_model->update('m_transaksi',array('id_transaksi' => $this->input->post('id',true)), $data);
                if (!$insert){
                    echo json_encode(['success' => false, 'message' => 'Data transaksi gagal diubah','status' => TRUE]);
                }else{
                    kirim_email_transaksi_sampai($this->input->post('id',true));
                    echo json_encode(['success' => true, 'message' => 'Data transaksi berhasil diubah','status' => TRUE]);
                }
            break;
            case 'tambah_ulasan':
                $this->_validate($type);

                foreach ($this->input->post('ratting_produk',true) as $key => $value) {
                    $data = array(
                        'id_transaksi'          => $this->input->post('id_transaksi',true),
                        'id_transaksi_detail'   => $this->input->post('id_transaksi_detail',true)[$key],
                        'id_produk'             => $this->input->post('id_produk',true)[$key],
                        'username_toko'         => $this->input->post('username_toko',true),
                        'username'              => $this->session->identity,
                        'ratting'               => $value,
                        'ratting_toko'          => $this->input->post('ratting',true),
                        'deskripsi'             => $this->input->post('ulasan',true)[$key],   
                        'created_at'            => date('Y-m-d H:i:s')
                    );
                    
                    $insert = $this->query_model->insert('m_ulasan', $data);
                    tambah_ratting_produk($this->input->post('id_produk')[$key]);    
                }
                

                if (!$insert){
                    echo json_encode(['success' => false, 'message' => 'Data ulasan gagal disimpan','status' => TRUE]);
                }else {
                    echo json_encode(['success' => true, 'message' => 'Data ulasan berhasil disimpan','status' => TRUE]);
                }
            break;
            case 'bukti_bayar':
                $this->_validate($type);
                $data = array('bukti_pembayaran' => $this->input->post('nama_file_bukti_bayar',true),
                              'tgl_pembayaran' => date('Y-m-d H:i:s'),
                              'id_status_transaksi' => 1,
                        );
                $this->query_model->update('m_transaksi',array('id_transaksi' => $this->input->post('id_transaksi',true)), $data);
                kirim_email_transaksi_admin($this->input->post('id_transaksi',true),1);
                echo json_encode(['success' => true, 'message' => 'Data bukti pembayaran berhasil disimpan','status' => TRUE]);
            break;
            default:
                # code...
            break;
        }
    }

    public function ajax_ubah(){
        $type = $this->input->post('type',true);
        switch ($type) {
            case 'data_alamat':
                $this->_validate($type);
                $data = array(
                    'id_pengguna'   => $this->session->user_id,
                    'username'      => $this->session->identity,
                    'nama_alamat'   => $this->input->post('nama_alamat',true),
                    'id_prop'       => $this->input->post('id_prop',true),
                    'nama_prop'     => get_propinsi($this->input->post('id_prop',true)),
                    'id_kota'       => $this->input->post('id_kota',true),
                    'nama_kota'     => get_kota($this->input->post('id_prop',true),$this->input->post('id_kota',true)),
                    'id_kec'        => $this->input->post('id_kec',true),
                    'nama_kec'      => get_kec($this->input->post('id_prop',true),$this->input->post('id_kota',true),$this->input->post('id_kec',true)),
                    'id_kel'        => $this->input->post('id_kel',true),
                    'nama_kel'      => get_kel($this->input->post('id_prop',true),$this->input->post('id_kota',true),$this->input->post('id_kec',true),$this->input->post('id_kel',true)),
                    'alamat'        => $this->input->post('alamat',true),
                    'nama_penerima' => $this->input->post('nama_penerima',true),
                    'no_penerima'   => $this->input->post('no_penerima',true),
                    'updated_at'    => date('Y-m-d H:i:s')
                );



                $insert = $this->query_model->update('m_alamat',array('id_alamat' => $this->input->post('id',true)), $data);

                if($this->input->post('utama'))
                {
                    $data_reset = array(
                        'utama'         => 0,
                        'updated_at'    => date('Y-m-d H:i:s')
                    );

                    $this->query_model->update('m_alamat',null, $data_reset);

                    $data_utama = array(
                        'utama'         => 1,
                        'updated_at'    => date('Y-m-d H:i:s')
                    );

                    $this->query_model->update('m_alamat',array('id_alamat' =>  $this->input->post('id',true)), $data_utama);
                }

                if (!$insert)
                {
                    echo json_encode(['success' => false, 'message' => 'Data gagal diubah','status' => TRUE]);
                }
                else 
                {
                    echo json_encode(['success' => true, 'message' => 'Data Berhasil diubah','status' => TRUE]);
                }
            break;
        }
    }

    public function ajax_hapus()
    {
         $data = array(
            'status'        => 'dihapus',
            'updated_at'    => date('Y-m-d H:i:s')
        );

       $hapus  = $this->query_model->update('m_alamat',array('id_alamat'=> $this->input->post('id',true)), $data);
        if (!$hapus)
        {
            echo json_encode(['success' => false, 'message' => 'Gagal menghapus data!','status' => TRUE]);
        }
        else 
        {
            echo json_encode(['success' => true, 'message' => 'Data berhasil dihapus','status' => TRUE]);
        }
    }

    private function _validate($type){

        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        switch ($type) {
            case 'ubah_transaksi':
                if($this->input->post('status_transaksi',true) == 0)
                {
                    $data['inputerror'][] = 'id_status_transksi';
                    $data['error_string'][] = 'Status Tidak Boleh Kosong';
                    $data['status'] = FALSE;
                }

                if ($this->input->post('status_transaksi',true) == 3 && $this->input->post('no_resi',true) == '') {
                    $data['inputerror'][] = 'no_resi';
                    $data['error_string'][] = 'No Resi Tidak Boleh Kosong';
                    $data['status'] = FALSE;
                }

                if ($this->input->post('status_transaksi',true) == 5 && $this->input->post('pesan_batal',true) == '') {
                    $data['inputerror'][] = 'pesan_batal';
                    $data['error_string'][] = 'Pesan Tidak Boleh Kosong';
                    $data['status'] = FALSE;
                }
                
                if($data['status'] === FALSE)
                {
                    echo json_encode($data);
                    exit();
                }
            break;
            case 'tambah_ulasan':
                if($this->input->post('ratting',true) == 0 or $this->input->post('ratting',true) == '')
                {
                    $data['inputerror'][] = 'data_ratting';
                    $data['error_string'][] = 'Ratting Harus Diisi';
                    $data['status'] = FALSE;
                }

                foreach ($this->input->post('ratting_produk',true) as $key => $value) {
                    if($value == 0 or $value == '')
                    {
                        $data['inputerror'][] = 'data_ratting_produk';
                        $data['error_string'][] = 'Ratting Harus Diisi';
                        $data['status'] = FALSE;
                    }
                }

                foreach ($this->input->post('ulasan',true) as $key => $value) {
                    if($value == '')
                    {
                        $data['inputerror'][] = 'data_ulasan';
                        $data['error_string'][] = 'Ulasan Harus Diisi';
                        $data['status'] = FALSE;
                    }
                }
                
                if($data['status'] === FALSE)
                {
                    echo json_encode($data);
                    exit();
                }
            break;
            case 'bukti_bayar':
                if($this->input->post('nama_file_bukti_bayar',true) == '')
                {
                    $data['inputerror'][] = 'nama_file_bukti_bayar';
                    $data['error_string'][] = 'File Tidak Boleh Kosong';
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

    public function pesan($id,$id_transaksi=null,$type=null)
    {
        $useragent = 'Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0';
        $json_url = 'https://service-tlive.tangerangkota.go.id/services/umkm/loaddata/get_headerdetail';
        $ch = curl_init( $json_url );
        curl_setopt($ch, CURLOPT_USERAGENT, $useragent );
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,"id_group=".(int)$id);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, SERV_U . ':' . SERV_P);
        $pesan = json_decode(curl_exec($ch),true);
        // echo json_encode($pesan);
        // exit();

        if($type == 'hapus')
        {
            $produk = null;
        }else{
            $query_produk['select']     = "concat('".base_url()."assets/produk/',p.id_umkm, '/', (select foto from m_produk_foto  WHERE id_produk = p.id_produk LIMIT 1)) as foto,p.kode_produk,p.harga,p.nama_produk,p.id_produk,b.total_harga,c.nama_status,b.no_invoice,a.id_transaksi";
            $query_produk['table']      = 'm_transaksi_detail a';
            $query_produk['join'][0]    = array('m_transaksi b','b.id_transaksi = a.id_transaksi');
            $query_produk['join'][1]    = array('m_produk p','a.id_produk = p.id_produk');
            $query_produk['join'][2]    = array('m_status_transaksi c','c.id_status_transaksi = b.id_status_transaksi');
            $query_produk['order']      = 'a.id_transaksi_detail ASC';
            $query_produk['where']      = 'a.id_transaksi = '.(int)$id_transaksi;
            $produk                     = $this->query_model->getRow($query_produk);
        }
        

        $this->data = array(
            'pesan'     => $pesan,
            'id_group'  => $id,
            'produk'    => $produk,
        );
        $this->load->view('pesan_produk',$this->data);
    }

    function upload_bukti_bayar(){
        if(!empty($_FILES['file']['name'])){
            $config['upload_path']          = './assets/bukti_pembayaran';
            $config['allowed_types']        = 'jpg|png|jpeg';
            $config['max_size']             = 2048; //11MB set max size allowed in Kilobyte
            $config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp for unique name
    
            // $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if(!$this->upload->do_upload('file')) //upload and validate
            {
                $data['inputerror'][] = 'file';
                $data['error_string'][] = 'Terjadi kesalahan : '.$this->upload->display_errors('',''); //show ajax error
                $data['status'] = FALSE;
                echo json_encode($data);
                exit();
            }
            else {
                $data['status'] = TRUE;
                $data['file'] = $this->upload->data('file_name');       
            }
        }else{
            $data['error_string'][] = 'Terjadi kesalahan : Tidak ada file yang dipilih ! '; //show ajax error
            $data['status'] = FALSE;
        }

        echo json_encode($data);
    }
}