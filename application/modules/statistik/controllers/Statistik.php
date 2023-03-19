<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Statistik extends MY_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->user_model->is_umkm_penjual()) {
            redirect(base_url());
        }
        $this->load->model('statistik_model');
        $this->template->set_layout('templatesv2/backend');
    }

    public function wawasan_toko(){
        $this->template->add_title_segment('Wawasan Toko');
        $this->template->add_js('https://code.highcharts.com/highcharts.src.js',true);
        $this->template->add_js('https://code.highcharts.com/modules/series-label.js',true);
        $this->template->add_js('https://code.highcharts.com/modules/exporting.js',true);
        $this->template->add_js('https://code.highcharts.com/modules/export-data.js',true);
        
        $this->data = array(
            'active'    => 'statistik',
            'name'      => $this->security->get_csrf_token_name(),
            'hash'      => $this->security->get_csrf_hash(),
            'title_beranda' => 'Wawasan Toko',
            'option_umkm'   => $this->query_model->getumkm(),
        );
        $this->template->render("statistik/index_wawasan_toko",$this->data);
    }

    public function wawasan_produk(){
        $this->template->add_title_segment('Wawasan Produk');
        $this->template->add_js('https://code.highcharts.com/highcharts.src.js',true);
        $this->template->add_js('https://code.highcharts.com/modules/series-label.js',true);
        $this->template->add_js('https://code.highcharts.com/modules/exporting.js',true);
        $this->template->add_js('https://code.highcharts.com/modules/export-data.js',true);
        
        $this->data = array(
            'active'    => 'statistik',
            'name'      => $this->security->get_csrf_token_name(),
            'hash'      => $this->security->get_csrf_hash(),
            'title_beranda' => 'Wawasan Produk',
            'option_umkm'   => $this->query_model->getumkm(),
            'kategori' => $this->query_model->getKategori(),
        );
        $this->template->render("statistik/index_wawasan_produk",$this->data);
    }

    public function ajax_data(){
        $type = $this->input->post('type');
        switch ($type) {
            case 'rekap_perform_produk':
            case 'rekap_perform_toko':
                if ($this->input->post('id_umkm')) {
                    $id_umkm = (int) $this->input->post('id_umkm');
                }else{
                    $id_umkm = null;
                }

                if ($this->input->post('id_jenis_usaha')) {
                    $id_jenis_usaha = (int) $this->input->post('id_jenis_usaha');
                }else{
                    $id_jenis_usaha = null;
                }

                if ($this->input->post('tanggal')) {
                    $t = explode(' - ', $this->input->post('tanggal'));
                    $tanggal_awal = $t[0];
                    $tanggal_akhir = $t[1];
                }else{
                    $tanggal_awal = $tanggal_akhir = null;
                }

                $pendapatan_bersih_baru = $this->statistik_model->pendapatan_bersih_baru($id_umkm,$id_jenis_usaha,$tanggal_awal,$tanggal_akhir);
                $produk_dilihat = $this->statistik_model->produk_dilihat($id_umkm,$id_jenis_usaha,$tanggal_awal,$tanggal_akhir);
                $produk_terjual = $this->statistik_model->produk_terjual($id_umkm,$id_jenis_usaha,$tanggal_awal,$tanggal_akhir);

                $data['pendapatan_bersih_baru'] = 'Rp. '.number_format($pendapatan_bersih_baru,2,",",".");
                $data['produk_dilihat'] = number_format($produk_dilihat,0,".",".");
                $data['produk_terjual'] = number_format($produk_terjual,0,".",".");

                if ($type == 'rekap_perform_produk') {
                    $produk_keranjang = $this->statistik_model->produk_keranjang($id_umkm,$id_jenis_usaha,$tanggal_awal,$tanggal_akhir);
                    $data['produk_keranjang'] = number_format($produk_keranjang,0,".",".");
                }elseif($type == 'rekap_perform_toko'){
                    $pesanan_baru = $this->statistik_model->pesanan_baru($id_umkm,$tanggal_awal,$tanggal_akhir);
                    $pesanan_batal = $this->statistik_model->pesanan_baru($id_umkm,$tanggal_awal,$tanggal_akhir,'batal');
                    $pesanan_selesai = $this->statistik_model->pesanan_baru($id_umkm,$tanggal_awal,$tanggal_akhir,null,4);

                    $rata2_transaksi = $rata2_barang_terjual = 0;
                    if ($pesanan_selesai) {
                        $rata2_transaksi = $pendapatan_bersih_baru / $pesanan_selesai;
                        $rata2_barang_terjual = $produk_terjual / $pesanan_selesai;
                    }
                    
                    $data['pesanan_baru'] = number_format($pesanan_baru,0,".",".");
                    $data['pesanan_batal'] = number_format($pesanan_batal,0,".",".");
                    $data['pesanan_selesai'] = number_format($pesanan_selesai,0,".",".");
                    $data['rata2_transaksi'] = 'Rp. '.number_format($rata2_transaksi,2,",",".");
                    $data['rata2_barang_terjual'] = number_format($rata2_barang_terjual,0,".",".");
                }
                echo json_encode($data);
            break;
        }
    }

    public function ajax_list(){
        $type = $this->input->post('type');
        switch ($type) {
            case 'daftar_produk':
                $list = $this->statistik_model->get_datatables($type);
                // var_dump($this->db->last_query()); die();
                $data = array();
                $no = $_POST['start'];
                foreach ($list as $l) {
                    $no++;
                    $row = array();
                    $row[] = $no;
                    $row[] = $l->nama_produk;
                    $row[] = $l->kode_produk;
                    $row[] = 'Rp. '.number_format($l->jum_pendapatan,2,",",".");
                    $row[] = number_format($l->jum_terjual,0,".",".");
                    $row[] = number_format($l->jum_dilihat,0,".",".");
                    $row[] = number_format($l->jum_keranjang,0,".",".");
                    $row[] = number_format($l->jum_favorit,0,".",".");
                    $row[] = number_format($l->jum_pesanan,0,".",".");

                    $data[] = $row;
                }
         
                $output = array("draw" => $_POST['draw'],
                                "recordsTotal" => $this->statistik_model->count_all($type),
                                "recordsFiltered" => $this->statistik_model->count_filtered($type),
                                "data" => $data,
                            );
                //output to json format
                echo json_encode($output);
            break;
        }
    }

    public function ajax_grafik(){
        $type = $this->input->post('type');
        switch ($type) {
            case 'grafik_pendapatan_bersih_baru':
                if ($this->input->post('id_umkm')) {
                    $id_umkm = (int) $this->input->post('id_umkm');
                }else{
                    $id_umkm = null;
                }

                if ($this->input->post('id_jenis_usaha')) {
                    $id_jenis_usaha = (int) $this->input->post('id_jenis_usaha');
                }else{
                    $id_jenis_usaha = null;
                }

                if ($this->input->post('tanggal')) {
                    $t = explode(' - ', $this->input->post('tanggal'));
                    $tanggal_awal = $t[0];
                    $tanggal_akhir = $t[1];
                }else{
                    $tanggal_awal = date('Y-m-d', strtotime('-30 days'));
                    $tanggal_akhir = date("Y-m-d");
                }

                $dt = $this->statistik_model->pendapatan_bersih_baru_tgl($id_umkm,$id_jenis_usaha,$tanggal_awal,$tanggal_akhir);

                $date_now = new DateTime($tanggal_akhir); 
                $date_now->modify('+1 day');
                $date_now = $date_now->format('Y-m-d');
                
                $period = new DatePeriod(
                             new DateTime($tanggal_awal),
                             new DateInterval('P1D'),
                             new DateTime($date_now)
                        );

                foreach ($period as $key => $value) {
                    $tanggal = $value->format('Y-m-d');   
                    $jum = 0;
                    foreach ($dt as $d) {
                        if ($d->tgl == $tanggal) {
                            $jum = (int)$d->jum;
                        }   
                    }

                    $periodeIni[] = array($jum);
                    
                    $tanggalX[] = indonesian_date_5($tanggal,false,true,true,false);
                    
                    $Graph = array(
                                    'label' => $tanggalX,
                                    'dataline' =>
                                                    array(
                                                            array( 
                                                                    'name' => 'Periode Ini',
                                                                    'color' => '#AB2828',
                                                                    'data' => $periodeIni
                                                                ),
                                                        )
                                    );
                }
                
                $data['dataLine']         = $Graph['dataline'];
                $data['dataLineXaxis']    = $Graph['label'];

                echo json_encode(array('data' => $data));
            break;
            
            case 'grafik_produk_dilihat':
                if ($this->input->post('id_umkm')) {
                    $id_umkm = (int) $this->input->post('id_umkm');
                }else{
                    $id_umkm = null;
                }

                if ($this->input->post('tanggal')) {
                    $t = explode(' - ', $this->input->post('tanggal'));
                    $tanggal_awal = $t[0];
                    $tanggal_akhir = $t[1];
                }else{
                    $tanggal_awal = date('Y-m-d', strtotime('-30 days'));
                    $tanggal_akhir = date("Y-m-d");
                }

                $dt = $this->statistik_model->produk_dilihat_tgl($id_umkm,$tanggal_awal,$tanggal_akhir);

                $date_now = new DateTime($tanggal_akhir); 
                $date_now->modify('+1 day');
                $date_now = $date_now->format('Y-m-d');
                
                $period = new DatePeriod(
                             new DateTime($tanggal_awal),
                             new DateInterval('P1D'),
                             new DateTime($date_now)
                        );

                foreach ($period as $key => $value) {
                    $tanggal = $value->format('Y-m-d'); 
                    $jum = 0;
                    foreach ($dt as $d) {
                        if ($d->tgl == $tanggal) {
                            $jum = (int)$d->jum;
                        }   
                    }

                    $periodeIni[] = array($jum);
                    
                    $tanggalX[] = indonesian_date_5($tanggal,false,true,true,false);
                    
                    $Graph = array(
                                    'label' => $tanggalX,
                                    'dataline' =>
                                                    array(
                                                            array( 
                                                                    'name' => 'Produk dilihat',
                                                                    'color' => '#AB2828',
                                                                    'data' => $periodeIni
                                                                ),
                                                        )
                                    );     
                }
                
                $data['dataLine']         = $Graph['dataline'];
                $data['dataLineXaxis']    = $Graph['label'];

                echo json_encode(array('data' => $data));
            break;

            case 'grafik_pesanan_baru':
                if ($this->input->post('id_umkm')) {
                    $id_umkm = (int) $this->input->post('id_umkm');
                }else{
                    $id_umkm = null;
                }

                if ($this->input->post('tanggal')) {
                    $t = explode(' - ', $this->input->post('tanggal'));
                    $tanggal_awal = $t[0];
                    $tanggal_akhir = $t[1];
                }else{
                    $tanggal_awal = date('Y-m-d', strtotime('-30 days'));
                    $tanggal_akhir = date("Y-m-d");
                }

                $dt = $this->statistik_model->pesanan_baru_tgl($id_umkm,$tanggal_awal,$tanggal_akhir);

                $date_now = new DateTime($tanggal_akhir); 
                $date_now->modify('+1 day');
                $date_now = $date_now->format('Y-m-d');
                
                $period = new DatePeriod(
                             new DateTime($tanggal_awal),
                             new DateInterval('P1D'),
                             new DateTime($date_now)
                        );

                foreach ($period as $key => $value) {
                    $tanggal = $value->format('Y-m-d');  
                    $jum = 0;
                    foreach ($dt as $d) {
                        if ($d->tgl == $tanggal) {
                            $jum = (int)$d->jum;
                        }   
                    }

                    $periodeIni[] = array($jum);
                    
                    $tanggalX[] = indonesian_date_5($tanggal,false,true,true,false);
                    
                    $Graph = array(
                                    'label' => $tanggalX,
                                    'dataline' =>
                                                    array(
                                                            array( 
                                                                    'name' => 'Pesnan baru',
                                                                    'color' => '#AB2828',
                                                                    'data' => $periodeIni
                                                                ),
                                                        )
                                    );    
                }
                
                $data['dataLine']         = $Graph['dataline'];
                $data['dataLineXaxis']    = $Graph['label'];

                echo json_encode(array('data' => $data));
            break;

            case 'grafik_tipe_pembatalan':
                if ($this->input->post('id_umkm')) {
                    $id_umkm = (int) $this->input->post('id_umkm');
                }else{
                    $id_umkm = null;
                }

                if ($this->input->post('tanggal')) {
                    $t = explode(' - ', $this->input->post('tanggal'));
                    $tanggal_awal = $t[0];
                    $tanggal_akhir = $t[1];
                }else{
                    $tanggal_awal = date('Y-m-d', strtotime('-30 days'));
                    $tanggal_akhir = date("Y-m-d");
                }

                $dt_batal_otomatis = $this->statistik_model->pesanan_baru($id_umkm,$tanggal_awal,$tanggal_akhir,'batal',6);
                $dt_batal_penjual = $this->statistik_model->pesanan_baru($id_umkm,$tanggal_awal,$tanggal_akhir,'batal',5);
                
                $batal_otomatis = array((int)$dt_batal_otomatis);
                $batal_penjual = array((int)$dt_batal_penjual);
                $batal_pembeli = array(0);
                
                $Bar = array(               
                            array( 
                                    'name' => 'Dibatalkan Otomatis', 
                                    'color' => '#AB2828',
                                    'data' => $batal_otomatis
                                ),
                            array( 
                                    'name' => 'Dibatalkan Penjual',
                                    'color' => '#7baade',
                                    'data' => $batal_penjual
                                ),
                            array( 
                                    'name' => 'Dibatalkan Pembeli',
                                    'color'=> '#ceba7d',
                                    'data' => $batal_pembeli
                                )
                    );
                
                $data['dataBar'] = $Bar;
                $data['dataLineXaxis']  = array('Dibatalkan Otomatis','Dibatalkan Penjual','Dibatalkan Pembeli');
                echo json_encode(array('data' => $data));
            break;
        }
    }

    public function cetak_excel_produk(){
        if ($this->input->post('id_umkm')) {
            $id_umkm = (int) $this->input->post('id_umkm');
        }else{
            $id_umkm = null;
        }

        if ($this->input->post('id_jenis_usaha')) {
            $id_jenis_usaha = (int) $this->input->post('id_jenis_usaha');
        }else{
            $id_jenis_usaha = null;
        }

        if ($this->input->post('tanggal')) {
            $t = explode(' - ', $this->input->post('tanggal'));
            $tanggal_awal = $t[0];
            $tanggal_akhir = $t[1];
        }else{
            $tanggal_awal = $tanggal_akhir = null;
        }

        ini_set("memory_limit", "9999M");
        ini_set("max_execution_time", "9999");

        $_POST['length'] = -1;
        $list = $this->statistik_model->get_datatables('daftar_produk');
        if (!$list) {
            echo "Data Produk Tidak Ditemukan !";
            exit();
        }

        // load library PHPExcel
        require_once APPPATH . '/third_party/PHPExcel.php';

        // Create new PHPExcel object
        $objPHPExcel = new PHPExcel();

        //set Sheet yang akan diolah
        $objPHPExcel->setActiveSheetIndex(0);

        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(30);

        $styleHeader = [
            'font' => ['bold'  => true,'size'  => 14,'name'  => 'Arial'],
            'alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER],
        ];

        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'DAFTAR PRODUK');
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:K1');
        if ($this->input->post('tanggal')) {
            $objPHPExcel->getActiveSheet()->setCellValue('A2', 'Periode : '.indonesian_date_5($tanggal_awal,false,false,true).' s/d '.indonesian_date_5($tanggal_akhir,false,false,true));
            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A2:K2');
        }
        if ($id_umkm) {
            $objPHPExcel->getActiveSheet()->setCellValue('A3', 'Toko : '.$list[0]->nama_toko);
            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A3:K3');
        }
        if ($id_jenis_usaha) {
            $objPHPExcel->getActiveSheet()->setCellValue('A4', 'Kategori Produk : '.$list[0]->kategori_produk);
            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A4:K4');
        }
        
        $objPHPExcel->getActiveSheet()->getStyle('A1:K4')->applyFromArray($styleHeader);

        //Thead
        $styleThead = [
            'font' => ['bold'  => true,'size'  => 8,'name'  => 'Arial'],
            'alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,'wrap' => true],
            'borders'   => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN]],
        ];

       //Tbody
        $styleTbody = [
            'font' => ['size'  => 8,'name'  => 'Arial'],
            'borders'   => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN]],
        ];

        $styleTbodyCenter = [
            'alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER]
        ];
        $styleTbodyRight = [
            'alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT]
        ];

        $objPHPExcel->getActiveSheet()->setCellValue('A5', 'No.');
        $objPHPExcel->getActiveSheet()->setCellValue('B5', 'Nama Produk');
        $objPHPExcel->getActiveSheet()->setCellValue('C5', 'Kode Produk');
        $objPHPExcel->getActiveSheet()->setCellValue('D5', 'Kategori Produk');
        $objPHPExcel->getActiveSheet()->setCellValue('E5', 'Toko');
        $objPHPExcel->getActiveSheet()->setCellValue('F5', 'Pendapatan');
        $objPHPExcel->getActiveSheet()->setCellValue('G5', 'Terjual');
        $objPHPExcel->getActiveSheet()->setCellValue('H5', 'Dilihat');
        $objPHPExcel->getActiveSheet()->setCellValue('I5', 'Keranjang');
        $objPHPExcel->getActiveSheet()->setCellValue('J5', 'Favorit');
        $objPHPExcel->getActiveSheet()->setCellValue('K5', 'Pesanan');

        $objPHPExcel->getActiveSheet()->getStyle('A5:K5')->applyFromArray($styleThead);

        $no =1;
        $cell=6;
        $tot_pendapatan = $tot_terjual = $tot_dilihat = $tot_keranjang = $tot_favorit = $tot_pesanan = 0;
        foreach ($list as $d) {
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $cell, $no);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$cell)->applyFromArray($styleTbodyCenter);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $cell, $d->nama_produk);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $cell, $d->kode_produk);
            $objPHPExcel->getActiveSheet()->getStyle('C'.$cell)->applyFromArray($styleTbodyCenter);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $cell, $d->kategori_produk);
            $objPHPExcel->getActiveSheet()->setCellValue('E' . $cell, $d->nama_toko);
            $objPHPExcel->getActiveSheet()->setCellValue('F'.$cell, $d->jum_pendapatan);
            $objPHPExcel->getActiveSheet()->getStyle('F'.$cell)->applyFromArray($styleTbodyRight)->getNumberFormat()->setFormatCode('_(""* #,##0.00_);_(""* \(#,##0.00\);_(""* "0"??_);_(@_)');
            $objPHPExcel->getActiveSheet()->setCellValue('G' . $cell, $d->jum_terjual);
            $objPHPExcel->getActiveSheet()->setCellValue('H' . $cell, $d->jum_dilihat);
            $objPHPExcel->getActiveSheet()->setCellValue('I' . $cell, $d->jum_keranjang);
            $objPHPExcel->getActiveSheet()->setCellValue('J' . $cell, $d->jum_favorit);
            $objPHPExcel->getActiveSheet()->setCellValue('K' . $cell, $d->jum_pesanan);
            
            $tot_pendapatan = $tot_pendapatan + $d->jum_pendapatan;
            $tot_terjual = $tot_terjual + $d->jum_terjual;
            $tot_dilihat = $tot_dilihat + $d->jum_dilihat;
            $tot_keranjang = $tot_keranjang + $d->jum_keranjang;
            $tot_favorit = $tot_favorit + $d->jum_favorit;
            $tot_pesanan = $tot_pesanan + $d->jum_pesanan;

            $no++;
            $cell++;
        }

        $objPHPExcel->getActiveSheet()->setCellValue('A' . $cell, 'TOTAL');
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A'.$cell.':E'.$cell);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$cell.':E'.$cell)->applyFromArray($styleTbodyCenter);
        $objPHPExcel->getActiveSheet()->setCellValue('F'.$cell, $tot_pendapatan);
        $objPHPExcel->getActiveSheet()->getStyle('F'.$cell)->applyFromArray($styleTbodyRight)->getNumberFormat()->setFormatCode('_(""* #,##0.00_);_(""* \(#,##0.00\);_(""* "0"??_);_(@_)');
        $objPHPExcel->getActiveSheet()->setCellValue('G' . $cell, $tot_terjual);
        $objPHPExcel->getActiveSheet()->setCellValue('H' . $cell, $tot_dilihat);
        $objPHPExcel->getActiveSheet()->setCellValue('I' . $cell, $tot_keranjang);
        $objPHPExcel->getActiveSheet()->setCellValue('J' . $cell, $tot_favorit);
        $objPHPExcel->getActiveSheet()->setCellValue('K' . $cell, $tot_pesanan);
    
        $objPHPExcel->getActiveSheet()->getStyle('A6:K'.$cell)->applyFromArray($styleTbody);

        //set title pada sheet (me rename nama sheet)
        $objPHPExcel->getActiveSheet()->setTitle('Daftar Produk');

        //properties
        $objPHPExcel->getProperties()
                    ->setCreator(base_url())
                    ->setLastModifiedBy($this->session->identity.'_'.$this->session->nama_lengkap)
                    ->setTitle("Daftar Produk")
                    ->setDescription("Daftar Produk")
                    ->setSubject("Daftar Produk")
                    ->setKeywords("Produk");
                    //->setCategory("Test result file");

        //mulai menyimpan excel format xlsx, kalau ingin xls ganti Excel2007 menjadi Excel5
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

        //sesuaikan headernya
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        header('Cache-Control: no-store, no-cache, must-revalidate');
        header('Cache-Control: post-check=0, pre-check=0', false);
        header('Pragma: no-cache');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        //ubah nama file saat diunduh
        header('Content-Disposition: attachment;filename="DAFTAR_PRODUK.xlsx"');
        //unduh file
        $objWriter->save('php://output');
    }
}
?>