<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends MY_Controller {

    public function __construct() {
        parent::__construct();
        if(!$this->user_model->is_login()){
            redirect(base_url());
        }
        $this->load->model('transaksi_model');
    }

    public function customer() {
        $this->template->set_layout('templatesv2/frontend');
        $this->template->add_title_segment('Daftar Transaksi Pembelian');

        $this->template->add_css('assets/transaksi.css');
        $this->template->add_css('assets/css/pesan.css');

        $this->template->add_css('assets/rating/css/star-rating.css');
        $this->template->add_css('assets/rating/css/bootstrap.css');
        $this->template->add_js('assets/rating/js/star-rating.js',true);
        $this->template->add_css('assets/plugins/datatables/dataTables.bootstrap.css');
        $this->template->add_js('assets/plugins/datatables/jquery.dataTables.min.js',true);
        $this->template->add_js('assets/plugins/datatables/dataTables.bootstrap.min.js',true);

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
            'title_beranda' => 'Transaksi Pembelian',
            'id_transaksi' => @$this->input->post('id_transaksi'),
            'va' => @$this->input->post('va'),
            'submodul' => @$this->input->post('submodul')
        );

        $this->template->render("customer/index",$this->data);
    }

    public function penjual() {
        if (!$this->user_model->is_umkm_penjual()) {
            redirect(base_url());
        }

        $this->template->set_layout('templatesv2/backend');
        $this->template->add_title_segment('Daftar Transaksi Penjualan');

        $this->template->add_css('assets/transaksi.css');
        $this->template->add_css('assets/css/pesan.css');

        $this->template->add_css('assets/rating/css/star-rating.css');
        $this->template->add_css('assets/rating/css/bootstrap.css');
        $this->template->add_js(base_url().'assets/rating/js/star-rating.js',true);

        $this->data = array(
            'active'    => 'transaksi_penjual',
            'name'      => $this->security->get_csrf_token_name(),
            'hash'      => $this->security->get_csrf_hash(),
            'option_umkm'   => $this->query_model->getumkm(),
            'master_status_transaksi' => $this->transaksi_model->get_m_status_transaksi(),
            'title_beranda' => 'Transaksi Penjualan',
            'id_transaksi' => @$this->input->post('id_transaksi'),
            'submodul' => @$this->input->post('submodul')
        );

        $this->template->render("penjual/index",$this->data);
    }

    public function admin(){
        if(!$this->user_model->is_umkm_admin()){
            redirect(base_url());
        }
        $this->template->set_layout('templatesv2/backend');
        $this->template->add_title_segment('Daftar Transaksi');

        $this->template->add_css('assets/transaksi.css');
        $this->template->add_css('assets/css/pesan.css');

        $this->template->add_css('assets/rating/css/star-rating.css');
        $this->template->add_css('assets/rating/css/bootstrap.css');
        $this->template->add_js(base_url().'assets/rating/js/star-rating.js',true);

        $this->data = array(
            'active'    => 'transaksi_admin',
            'name'      => $this->security->get_csrf_token_name(),
            'hash'      => $this->security->get_csrf_hash(),
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
                                                <a href="javascript:void(0);" onclick="lihat_ulasan('.$l->id_transaksi.')">
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
                                            <button class="btn btn-gradient-2" style="margin-bottom:10px;">
                                                <span>
                                                    Beli Lagi
                                                </span>
                                            </button>
                                        </div>';
                    }

                    if ($l->id_status_transaksi == 0 && $l->metode_bayar == 'bank_transfer') { //jika status menunggu pembayaran
                        $btn_upload_pembayaran = '<div class="css-1v0ixe8">
                                                    <a href="javascript:void(0);" onclick="upload_bukti_bayar('.$l->id_transaksi.')" style="color: #5cb85c;">
                                                        <span class="fa fa-upload" style="font-size: 14px;margin-top: -5px;margin-right: 10px;"></span>
                                                        <span>Upload Bukti Pembayaran</span>
                                                    </a>
                                                </div>';
                    }elseif ($l->id_status_transaksi == 0 && $l->metode_bayar == 'va') {
                        $btn_upload_pembayaran = '<div class="css-1v0ixe8">
                                                    <a href="javascript:void(0);" onclick="lihat_pembayaran(null,'.$l->va_full.')" style="color: #5cb85c;">
                                                        <span class="fa fa-money" style="font-size: 14px;margin-top: -5px;margin-right: 10px;"></span>
                                                        <span>Bayar Sekarang</span>
                                                    </a>
                                                </div>';
                    }

                    if ($l->id_status_transaksi == 0 && $l->metode_bayar == 'va') {
                        $l->dt = '
                        <section class="order-bom css-1mlqw8x-unf-card e16a7sp70">
                            <div class="flex flex--between padding border--bottom">
                                <div style="margin-right: auto;" class="font__size--m font--ellipsis css-1e6gctp-unf-link edi449x0" font-size="12">
                                        '.indonesian_date($l->created_at).'
                                    </div>
                                <div class="order-bom__label"></div>
                            </div>
                            <div class="header flex">
                                <div class="trx-info trx-info--with-32" style="width:60%">
                                    <a href="javascript:void(0);" class="font__size--m font--bold font--ellipsis css-1e6gctp-unf-link edi449x0 text-color-1" font-size="12">
                                        Nomor Virtual Account
                                    </a>
                                    <span data-testid="txtBomInvoiceNumber-425371452" class="font--ellipsis">
                                        '.$l->va_full.'
                                    </span>
                                </div>
                                <div class="trx-info trx-info--with-32" style="width:40%">
                                    <a href="javascript:void(0);" class="font__size--m font--ellipsis css-1e6gctp-unf-link edi449x0" font-size="12">
                                        Status
                                    </a>
                                    <span data-testid="txtBomInvoiceNumber-425371452" class="font--ellipsis font--bold">
                                        '.$l->nama_status.'
                                    </span>
                                </div>
                                <div class="trx-info trx-info--with-32" style="width:20%">
                                    <a href="javascript:void(0);" class="font__size--m font--ellipsis css-1e6gctp-unf-link edi449x0" font-size="12">
                                        Total Belanja
                                    </a>
                                    <span data-testid="txtBomInvoiceNumber-425371452" class="font__type--trx font--bold" style="font-size:16px;">
                                        Rp. '.rp($l->jumlah_bayar_va).'
                                    </span>
                                </div>
                            </div>
                            <div class="body flex">
                                <div class="content">
                                    <div>
                                        <div class="product__item bom">
                                            <a href="'.base_url('list-produk/produk/'.short($l->kode_produk)).'" target="_blank" font-size="12" class="css-1e6gctp-unf-link edi449x0 foto_produk" style="background:url('.base_url('assets/produk/'.$l->id_umkm.'/'.$l->foto).')">
                                               
                                            </a>
                                            
                                            <a class="product__item__desc css-1e6gctp-unf-link edi449x0 text-color-1" font-size="12" href="'.base_url('list-produk/produk/'.short($l->kode_produk)).'" target="_blank" style="width:50% !important; max-width:50% !important;">
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

                                            <div class="trx-info trx-info--with-32" style="justify-content:flex-start !important;">
                                                <a href="javascript:void(0);" class="font__size--m font--ellipsis css-1e6gctp-unf-link edi449x0" font-size="12">
                                                    Total Harga Produk
                                                </a>
                                                <span data-testid="txtBomInvoiceNumber-425371452" class="font__type--trx font--bold" style="font-size:14px;">
                                                    Rp. '.rp($l->jumlah_harga).'
                                                </span>
                                            </div>

                                        </div>
                                    </div>
                                    '.($l->jumlah_barang > 1 ? '<div class="showmore" onclick="detail_pesanan_belum_bayar_va('.$l->va_full.')">
                                        <span>
                                            Lihat '.($l->jumlah_barang - 1).' Produk Lainnya
                                        </span></div>':'').'
                                </div>
                                <div class="footer flex font__size--m" style="margin:0;">
                                    <div class="flex flex--center">
                                        '.$btn_upload_pembayaran.'
                                        <div class="css-gcemtj">
                                            <a href="javascript:void(0);" onclick="detail_pesanan_belum_bayar_va('.$l->va_full.')">
                                                <span class="fa fa-eye" style="font-size: 14px;margin-top: -5px;margin-right: 10px;"></span>
                                                <span>Lihat Detail Pesanan</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>'; 
                    }else{
                        $l->dt = '
                        <section class="order-bom css-1mlqw8x-unf-card e16a7sp70">
                            <div class="flex flex--between padding border--bottom">
                                <div style="margin-right: auto;" class="font__size--m font--ellipsis css-1e6gctp-unf-link edi449x0" font-size="12">
                                        '.indonesian_date($l->created_at).'
                                    </div>
                                <div class="order-bom__label"></div>
                            </div>
                            <div class="header flex">
                                <div class="trx-info trx-info--with-32" style="width:60%">
                                    <a target="_blank" href="'.base_url('list-umkm/umkm/'.short($l->id_umkm)).'" class="font__size--m font--bold font--ellipsis css-1e6gctp-unf-link edi449x0 text-color-1" font-size="12">
                                        '.$l->namausaha.'
                                    </a>
                                    <span data-testid="txtBomInvoiceNumber-425371452" class="font--ellipsis">
                                        '.$l->no_invoice.'
                                    </span>
                                </div>
                                <div class="trx-info trx-info--with-32" style="width:40%">
                                    <a href="javascript:void(0);" class="font__size--m font--ellipsis css-1e6gctp-unf-link edi449x0" font-size="12">
                                        Status
                                    </a>
                                    <span data-testid="txtBomInvoiceNumber-425371452" class="font--ellipsis font--bold">
                                        '.$l->nama_status.'
                                    </span>
                                </div>
                                <div class="trx-info trx-info--with-32" style="width:20%">
                                    <a href="javascript:void(0);" class="font__size--m font--ellipsis css-1e6gctp-unf-link edi449x0" font-size="12">
                                        Total Belanja
                                    </a>
                                    <span data-testid="txtBomInvoiceNumber-425371452" class="font__type--trx font--bold" style="font-size:16px;">
                                        Rp. '.rp($l->total).'
                                    </span>
                                </div>
                            </div>
                            <div class="body flex">
                                <div class="content">
                                    <div>
                                        <div class="product__item bom">
                                            <a href="'.base_url('list-produk/produk/'.short($l->kode_produk)).'" target="_blank" font-size="12" class="css-1e6gctp-unf-link edi449x0 foto_produk" style="background:url('.base_url('assets/produk/'.$l->id_umkm.'/'.$l->foto).')">
                                               
                                            </a>
                                            
                                            <a class="product__item__desc css-1e6gctp-unf-link edi449x0 text-color-1" font-size="12" href="'.base_url('list-produk/produk/'.short($l->kode_produk)).'" target="_blank" style="width:50% !important; max-width:50% !important;">
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

                                            <div class="trx-info trx-info--with-32" style="justify-content:flex-start !important;">
                                                <a href="javascript:void(0);" class="font__size--m font--ellipsis css-1e6gctp-unf-link edi449x0" font-size="12">
                                                    Total Harga Produk
                                                </a>
                                                <span data-testid="txtBomInvoiceNumber-425371452" class="font__type--trx font--bold" style="font-size:14px;">
                                                    Rp. '.rp($l->jumlah_harga).'
                                                </span>
                                            </div>

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
                    }

                    
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
                            <div style="margin-right: auto;" class="font__size--m font--ellipsis css-1e6gctp-unf-link edi449x0" font-size="12">
                                    '.indonesian_date($l->created_at).'
                            </div>
                            <div class="font__size--m font--ellipsis css-1e6gctp-unf-link edi449x0" font-size="12">
                                    Status : '.$l->nama_status.'
                            </div>
                            <div class="order-bom__label"></div>
                        </div>
                        <div class="header flex">
                            <div class="trx-info trx-info--with-32" style="width:60%">
                                <span class="font__size--m font--bold font--ellipsis css-1e6gctp-unf-link edi449x0" font-size="12">
                                    No. Invoice
                                </span>
                                <span data-testid="txtBomInvoiceNumber-425371452" class="font--ellipsis text-color-1">
                                    '.$l->no_invoice.'
                                </span>
                            </div>
                            <div class="trx-info trx-info--with-32" style="width:40%">
                                <span class="font__size--m font--ellipsis font--bold css-1e6gctp-unf-link edi449x0" font-size="12">
                                    Penjual
                                </span>
                                <span data-testid="txtBomInvoiceNumber-425371452" class="font--ellipsis text-color-1">
                                    <a target="_blank" href="'.base_url('list-umkm/umkm/'.short($l->id_umkm)).'" font-size="12">
                                        '.$l->namausaha.'
                                    </a>
                                </span>
                            </div>
                            <div class="trx-info trx-info--with-32" style="width:40%">
                                <span class="font__size--m font--ellipsis font--bold css-1e6gctp-unf-link edi449x0" font-size="12">
                                    Pembeli
                                </span>
                                <span data-testid="txtBomInvoiceNumber-425371452" class="font--ellipsis text-color-1">
                                    '.$l->nama.'
                                </span>
                            </div>
                            <div class="trx-info trx-info--with-32" style="width:20%;text-align:right;">
                                <span class="font__size--m font--ellipsis css-1e6gctp-unf-link edi449x0" font-size="12">
                                    Total Belanja
                                </span>
                                <span data-testid="txtBomInvoiceNumber-425371452" class="font__type--trx font--bold" style="font-size:16px;">
                                    Rp. '.rp($l->total).'
                                </span>
                            </div>
                        </div>
                        <div class="body flex">
                            <div class="content">
                                <div>
                                    <div class="product__item bom">
                                        <a href="'.base_url('list-produk/produk/'.short($l->kode_produk)).'" target="_blank" font-size="12" class="css-1e6gctp-unf-link edi449x0 foto_produk" style="background:url('.base_url('assets/produk/'.$l->id_umkm.'/'.$l->foto).')">
                                           
                                        </a>
                                        
                                        <a class="product__item__desc css-1e6gctp-unf-link edi449x0 text-color-1" font-size="12" href="'.base_url('list-produk/produk/'.short($l->kode_produk)).'" target="_blank" style="width:50% !important; max-width:50% !important;">
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

                                        <div class="trx-info trx-info--with-32" style="justify-content:flex-start !important;">
                                            <a href="javascript:void(0);" class="font__size--m font--ellipsis css-1e6gctp-unf-link edi449x0" font-size="12">
                                                Total Harga Produk
                                            </a>
                                            <span data-testid="txtBomInvoiceNumber-425371452" class="font__type--trx font--bold" style="font-size:14px;">
                                                Rp. '.rp($l->jumlah_harga).'
                                            </span>
                                        </div>

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
                            <div style="margin-right: auto;" class="font__size--m font--ellipsis css-1e6gctp-unf-link edi449x0" font-size="12">
                                    '.indonesian_date($l->created_at).'
                            </div>
                            <div class="font__size--m font--ellipsis css-1e6gctp-unf-link edi449x0" font-size="12">
                                    Status : '.$l->nama_status.'
                            </div>
                            <div class="order-bom__label"></div>
                        </div>
                        <div class="header flex">
                            <div class="trx-info trx-info--with-32" style="width:60%">
                                <span class="font__size--m font--bold font--ellipsis css-1e6gctp-unf-link edi449x0" font-size="12">
                                    No. Invoice
                                </span>
                                <span data-testid="txtBomInvoiceNumber-425371452" class="font--ellipsis text-color-1">
                                    '.$l->no_invoice.'
                                </span>
                            </div>
                            <div class="trx-info trx-info--with-32" style="width:40%">
                                <span class="font__size--m font--ellipsis font--bold css-1e6gctp-unf-link edi449x0" font-size="12">
                                    Penjual
                                </span>
                                <span data-testid="txtBomInvoiceNumber-425371452" class="font--ellipsis text-color-1">
                                    <a target="_blank" href="'.base_url('list-umkm/umkm/'.short($l->id_umkm)).'" font-size="12">
                                        '.$l->namausaha.'
                                    </a>
                                </span>
                            </div>
                            <div class="trx-info trx-info--with-32" style="width:40%">
                                <span class="font__size--m font--ellipsis font--bold css-1e6gctp-unf-link edi449x0" font-size="12">
                                    Pembeli
                                </span>
                                <span data-testid="txtBomInvoiceNumber-425371452" class="font--ellipsis text-color-1">
                                    '.$l->nama.'
                                </span>
                            </div>
                            <div class="trx-info trx-info--with-32" style="width:20%;text-align:right;">
                                <span class="font__size--m font--ellipsis css-1e6gctp-unf-link edi449x0" font-size="12">
                                    Total Belanja
                                </span>
                                <span data-testid="txtBomInvoiceNumber-425371452" class="font__type--trx font--bold" style="font-size:16px;">
                                    Rp. '.rp($l->total).'
                                </span>
                            </div>
                        </div>
                        <div class="body flex">
                            <div class="content">
                                <div>
                                    <div class="product__item bom">
                                        <a href="'.base_url('list-produk/produk/'.short($l->kode_produk)).'" target="_blank" font-size="12" class="css-1e6gctp-unf-link edi449x0 foto_produk" style="background:url('.base_url('assets/produk/'.$l->id_umkm.'/'.$l->foto).')">
                                           
                                        </a>
                                        
                                        <a class="product__item__desc css-1e6gctp-unf-link edi449x0 text-color-1" font-size="12" href="'.base_url('list-produk/produk/'.short($l->kode_produk)).'" target="_blank" style="width:50% !important; max-width:50% !important;">
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

                                        <div class="trx-info trx-info--with-32" style="justify-content:flex-start !important;">
                                            <a href="javascript:void(0);" class="font__size--m font--ellipsis css-1e6gctp-unf-link edi449x0" font-size="12">
                                                Total Harga Produk
                                            </a>
                                            <span data-testid="txtBomInvoiceNumber-425371452" class="font__type--trx font--bold" style="font-size:14px;">
                                                Rp. '.rp($l->jumlah_harga).'
                                            </span>
                                        </div>

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
                $id_transaksi = (int)$this->input->post('id',true);
                $data         = $this->transaksi_model->detail_pesanan($id_transaksi);
                if ($data) {
                    $data->kode_umkm        = short($data->id_umkm);
                    $data->created_at_datetime = $data->created_at;
                    $data->created_at       = indonesian_date($data->created_at);
                    $data->tgl_pembayaran   = indonesian_date($data->tgl_pembayaran);
                    $data->tgl_konfirmasi   = indonesian_date($data->tgl_konfirmasi);
                    $data->tgl_kirim2       = $data->tgl_kirim;
                    $data->tgl_kirim        = indonesian_date($data->tgl_kirim);
                    $data->tgl_sampai       = indonesian_date($data->tgl_sampai);

                    $produk                 = $this->transaksi_model->get_produk_transaksi($id_transaksi);
                    $data->produk           = $produk;

                    $kode_produk = array();
                    foreach ($produk as $p) {
                        $kode_produk[] = short($p->kode_produk);
                    }
                    $data->kode_produk = $kode_produk;

                    if ($data->metode_bayar == 'bank_transfer') {
                        $data->pembayaran  = $this->transaksi_model->detail_pembayaran($id_transaksi);
                    }

                    echo json_encode(array('status' => true, 'data' => $data));
                }else{
                    echo json_encode(array('status' => false));
                }
            break;
            case 'detail_pesanan_belum_bayar_va':
                $data = array();
                $va = (int)$this->input->post('va',true);
                $data = $this->transaksi_model->detail_pesanan_belum_bayar_va($va);
                if ($data) {
                    $data->created_at_datetime = $data->created_at;
                    $data->created_at = indonesian_date($data->created_at);
                    $transaksi = $this->transaksi_model->get_transaksi_va($va);
                    
                    $data_produk = array();
                    $kode_produk = array();
                    foreach ($transaksi as $key => $p) {
                        $data_produk[$p->id_transaksi] = $this->transaksi_model->get_produk_transaksi($p->id_transaksi);
                        foreach ($data_produk[$p->id_transaksi] as $pr) {
                            $kode_produk[$pr->id_produk] = short($pr->kode_produk);
                        }
                        $transaksi[$key]->kode_umkm = short($p->id_umkm);
                    }

                    $data->transaksi = $transaksi;
                    $data->produk = $data_produk;
                    $data->kode_produk = $kode_produk;
                    echo json_encode(array('status' => true, 'data' => $data));
                }else{
                    echo json_encode(array('status' => false));
                }
            break;
            case 'ratting_ulasan':
                $id_transaksi = (int)$this->input->post('id',true);
                $data = $this->transaksi_model->ratting_ulasan($id_transaksi);
                echo json_encode($data);
            break;
            case 'data_ratting':
                $id_transaksi = (int)$this->input->post('id',true);
                $data = $this->transaksi_model->data_ratting($id_transaksi);
                echo json_encode($data);
            break;
            case 'tambah_ulasan':
                $id_transaksi = (int)$this->input->post('id',true);
                $produk = $this->transaksi_model->tambah_ulasan($id_transaksi);
                $data  = array('produk'=> $produk);
                $this->load->view('customer/ulasan_tambah',$data);
            break;
            case 'view_ulasan':
                $id_transaksi = (int)$this->input->post('id',true);
                $produk = $this->transaksi_model->view_ulasan($id_transaksi);
                $data  = array('produk'=> $produk);
                $this->load->view('customer/ulasan_view',$data);
            break;
            case 'detail_pembayaran':
                if ($this->input->post('no_va')) {
                    $no_va = (int)$this->input->post('no_va');
                    $data  = $this->transaksi_model->detail_pembayaran_va($no_va);
                    $data->expired_virtual_account = indonesian_date($data->expired_virtual_account);
                    $data->cara_bayar = $this->_caraBayarVa();
                }else{
                    $id_transaksi = (int)$this->input->post('id',true);
                    $data  = $this->transaksi_model->detail_pembayaran($id_transaksi);
                }
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
                $hasil = $this->transaksi_model->get_m_kurir();
                $kurir_umkm = null;
                if ($this->input->post('is_kurir_umkm') != null) {
                    $id_umkm = (int)$this->input->post('id_umkm',true);
                    $data_kurir_umkm = $this->transaksi_model->get_kurir_umkm($id_umkm);
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
                    $jenis = 'kirim';
                    $judul = 'Pesanan '.$this->input->post('no_invoice',true).' sudah dikirim penjual';
                    $message = 'Klik disini untuk melihat detail pesanan';

                    $data2 = array(
                        'no_resi'               => $this->input->post('no_resi',true),
                        'tgl_kirim'             => date('Y-m-d H:i:s'),
                    );

                    // ketika dikirm maka kurangi stok produk
                    // $query_penjual['select']    = 'a.id_produk,a.quantity,b.stok';
                    // $query_penjual['table']     = 'm_transaksi_detail a';
                    // $query_penjual['join'][0]   = array('m_produk b','b.id_produk = a.id_produk');
                    // $query_penjual['where']     = 'a.id_transaksi = '.(int)$this->input->post('id',true);
                    // $hasil_query                = $this->query_model->getData($query_penjual);
                    // foreach ($hasil_query as $key => $value) {
                    //     $stok = $value->stok - $value->quantity;
                    //     $quantity = array(
                    //         'stok'          => $stok,
                    //         'updated_at'    => date('Y-m-d H:i:s')
                    //     );
                    //     $this->query_model->update('m_produk',array('id_produk' => $value->id_produk), $quantity);
                    // }
                }elseif ($status_transaksi == 2) { //jika status = proses
                    $jenis = 'proses';
                    $judul = 'Pesanan '.$this->input->post('no_invoice',true).' sedang diproses penjual';
                    $message = 'Klik disini untuk melihat detail pesanan';

                    $data2 = array('tgl_konfirmasi'  => date('Y-m-d H:i:s'));
                }elseif ($status_transaksi == 5) { //jika status = batal
                    $jenis = 'batal';
                    $judul = 'Pesanan '.$this->input->post('no_invoice',true).' dibatalkan penjual';
                    $message = 'Alasan penjual : '.$this->input->post('pesan_batal',true);

                    $data2 = array('tgl_konfirmasi'  => date('Y-m-d H:i:s'),
                                   'pesan_batal'     => $this->input->post('pesan_batal',true),
                             );
                }elseif($status_transaksi == 4){ //jika status = sampai
                    $jenis = 'sampai';
                    $judul = 'Pesanan '.$this->input->post('no_invoice',true).' sudah diterima pembeli';
                    $message = 'Klik disini untuk melihat detail pesanan';

                    $data2 = array('tgl_sampai'  => date('Y-m-d H:i:s'));
                }

                $data = array_merge($data1,$data2);
                $insert = $this->query_model->update('m_transaksi',array('id_transaksi' => $this->input->post('id',true)), $data);
                if (!$insert){
                    echo json_encode(['success' => false, 'message' => 'Data transaksi gagal diubah','status' => TRUE]);
                }else{
                    // send notif ke pembeli
                    $username_pengirim = $this->session->identity;
                    $username_penerima = $this->input->post('username_pembeli',true);
                    $send = send_notif($username_pengirim,$username_penerima,$judul,$message,'transaksi_pembelian','detail_transaksi',$this->input->post('id',true),$jenis);

                    // if($status_transaksi == 3){
                    //     kirim_email_transaksi_pengiriman($this->input->post('id',true));
                    // }else{
                    //     kirim_email_transaksi_status($this->input->post('id',true));
                    // }

                    echo json_encode(['success' => true, 'message' => 'Data transaksi berhasil diubah','status' => TRUE]);
                }
            break;
            case 'transaksi_admin':
                $data = array(
                    'id_status_transaksi'   => 4, //status sampai tujuan
                    'updated_at'            => date('Y-m-d H:i:s'),
                    'tgl_sampai'            => date('Y-m-d H:i:s'),
                    'updated_by'            => $this->session->identity
                );
                
                $insert = $this->query_model->update('m_transaksi',array('id_transaksi' => $this->input->post('id',true)), $data);
                if (!$insert){
                    echo json_encode(['success' => false, 'message' => 'Data transaksi gagal diubah','status' => TRUE]);
                }else{
                    // send notif ke penjual
                    $judul = 'Pesanan '.$this->input->post('no_invoice',true).' sudah diterima pembeli';
                    $message = 'Klik disini untuk melihat detail pesanan';
                    $username_pengirim = $this->session->identity;
                    $username_penerima = $this->input->post('username_umkm',true);
                    $send = send_notif($username_pengirim,$username_penerima,$judul,$message,'transaksi_penjualan','detail_transaksi',$this->input->post('id',true),'sampai');

                    // kirim_email_transaksi_sampai($this->input->post('id',true));
                    echo json_encode(['success' => true, 'message' => 'Data transaksi berhasil diubah','status' => TRUE]);
                }
            break;
            case 'tambah_ulasan':
                $this->_validate($type);
                $data_ulasan = array();
                foreach ($this->input->post('ratting_produk',true) as $key => $value) {
                    if ($this->input->post('is_anonim',true)[$key]) {
                        $is_anonim = 1;
                    }else{
                        $is_anonim = 0;
                    }

                    $data_ulasan[] = array(
                        'id_transaksi'          => $this->input->post('id_transaksi',true),
                        'id_transaksi_detail'   => $this->input->post('id_transaksi_detail',true)[$key],
                        'id_produk'             => $this->input->post('id_produk',true)[$key],
                        'id_umkm'               => $this->input->post('id_umkm',true),
                        'username_toko'         => $this->input->post('username_toko',true),
                        'username'              => $this->session->identity,
                        'ratting'               => $value,
                        'ratting_toko'          => $this->input->post('ratting',true),
                        'deskripsi'             => $this->input->post('ulasan',true)[$key],
                        'is_anonim'             => $is_anonim, 
                        'created_at'            => date('Y-m-d H:i:s')
                    );    
                }

                $insert = $this->query_model->insert_batch('m_ulasan', $data_ulasan);

                if (!$insert){
                    echo json_encode(['success' => false, 'message' => 'Data ulasan gagal disimpan','status' => TRUE]);
                }else {
                    update_ratting_produk($this->input->post('id_produk',true));
                    update_ratting_toko($this->input->post('id_umkm',true));

                    // send notif ke penjual
                    $judul = '1 ulasan baru';
                    $message = $this->input->post('ulasan',true)[0];
                    $username_pengirim = $this->session->identity;
                    $username_penerima = $this->input->post('username_umkm',true);
                    $send = send_notif($username_pengirim,$username_penerima,$judul,$message,'transaksi_penjualan','ulasan',$this->input->post('id_transaksi',true),'ulasan');

                    echo json_encode(['success' => true, 'message' => 'Data ulasan berhasil disimpan','status' => TRUE]);
                }
            break;
            case 'bukti_bayar':
                $this->_validate($type);
                $data = array('bukti_pembayaran'    => $this->input->post('nama_file_bukti_bayar',true),
                              'tgl_pembayaran'      => date('Y-m-d H:i:s'),
                              'id_status_transaksi' => 1,
                              'updated_by'          => $this->session->identity,
                        );
                $this->query_model->update('m_transaksi',array('id_transaksi' => $this->input->post('id_transaksi',true)), $data);

                // send notif ke penjual
                $judul = 'Pesanan '.$this->input->post('no_invoice',true).' berhasil dibayar';
                $message = 'Silahkan Cek Pembayaran dan proses pesanan';
                $username_pengirim = $this->session->identity;
                $username_penerima = $this->input->post('username_umkm',true);
                $send = send_notif($username_pengirim,$username_penerima,$judul,$message,'transaksi_penjualan','detail_transaksi',$this->input->post('id_transaksi',true),'sukses_bayar');
                // kirim_email_transaksi_admin($this->input->post('id_transaksi',true));
                echo json_encode(['success' => true, 'message' => 'Data bukti pembayaran berhasil disimpan','status' => TRUE]);
            break;
            default:
                # code...
            break;
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
        $json_url = URL_SERV_TLIVE_UMKM.'/loaddata/get_headerdetail';
        $ch = curl_init( $json_url );
        curl_setopt($ch, CURLOPT_USERAGENT, $useragent );
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,"id_group=".(int)$id);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, SERV_U . ':' . SERV_P);
        $pesan = json_decode(curl_exec($ch),true);
        // echo json_encode($pesan);
        // exit();

        if($type == 'hapus'){
            $produk = null;
        }else{
            $produk  = pesan_transaksi($id_transaksi);
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

    private function _caraBayarVa()
    {
        return array(
            array(
                "channel" => "Teller",
                "cara" => array(
                    "Pelanggan/Konsumen membawa nomor virtual account",
                    "Teller bank bjb akan menginput 16 digit numeric nomor virtual account",
                    "Pelanggan/konsumen mendapatkan bukti bayar dan status tagihan di Biller/Institusi akan otomatis berubah menjadi terbayar."
                )
            ),
            array(
                "channel" => "ATM",
                "cara" => array(
                    "Pelanggan/Konsumen membawa nomor virtual account",
                    "Pilih bahasa",
                    "Masukkan PIN",
                    "Pilih menu \"Transaksi Lainnya\"",
                    "Pilih menu \"Virtual Account\"",
                    "Pilih Jenis Rekening",
                    "Masukkan nomor virtual account",
                    "Akan muncul konfirmasi pembayaran, pilih tombol Ya",
                    "Simpan struk sebagai bukti bayar"
                )
            ),
            array(
                "channel" => "bjb Mobile",
                "cara" => array(
                    "Login pada aplikasi bjb Mobile",
                    "Pilih menu \"Virtual Account\"",
                    "Masukkan nomor virtual account",
                    "Cek data tagihan yang muncul, lalu masukkan m-PIN bjb Mobile",
                    "Transaksi selesai, simpan bukti bayar"
                )
            ),
            array(
                "channel" => "bjb Net",
                "cara" => array(
                    "Login pada aplikasi bjb Net",
                    "Pilih menu \"bjb VIRTUAL ACCOUNT\"",
                    "Masukkan nomor virtual account",
                    "Cek data tagihan yang muncul, lalu pilih tombol Lanjut",
                    "Transaksi selesai, simpan bukti bayar"
                )
            ),
            array(
                "channel" => "Bank Lain",
                "cara" => array(
                    "Pilih channel bank lain (Teller, ATM, atau Internet Banking)",
                    "Gunakan menu transfer antar bank untuk melakukan pembayaran",
                    "Di menu transfer antar bank, masukkan kode bank bjb (110) + No Virtual Account (16 digit) atau pilih nama bank tujuan (bank bjb) lalu input no va 16 digit pada kolom no rekening",
                    "Sistem menampilkan identitas dari nomor Virtual Account",
                    "Transaksi selesai, simpan bukti bayar"
                )
            ),
            array(
                "channel" => "Transfer antar bank (Dompet Digital)",
                "cara" => array(
                    "Pada Layanan Dompet Digital, masuk ke menu transfer bank",
                    "Masukkan kode bank dan nomor virtual account 16 digit",
                    "Sistem menampilkan identitas dari nomor Virtual Account",
                    "Transaksi selesai, simpan bukti bayar"
                )
            )

        );
    }
}