<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notif extends MY_Controller {

	public function __construct() {
		parent::__construct();
        if(!$this->user_model->is_login()){
            redirect(base_url());
        }
        $this->load->model('m_notif');
	}

	public function index(){
		$this->template->set_layout('frontend/index');
        $this->template->add_title_segment('Notifikasi');
        $this->template->add_css('assets/plugins/datatables/dataTables.bootstrap.css');
		$this->template->add_js('assets/plugins/datatables/jquery.dataTables.min.js',true);
		$this->template->add_js('assets/plugins/datatables/dataTables.bootstrap.min.js',true);

        $k = keranjangku();
        $keranjang = $k['keranjang'];
        $jml_keranjang = $k['jml_keranjang'];
        $data = array(
            'active'    => 'notif',
            'name'      => $this->security->get_csrf_token_name(),
            'hash'      => $this->security->get_csrf_hash(),
            'kategori'  => $this->query_model->getKategori(),
            'keranjang' => $keranjang,
            'jml_keranjang' => $jml_keranjang,
            'title_beranda' => 'Notifikasi',
            'count_notif_transaksi' => $this->m_notif->get_count_all_notif('transaksi'),
            'count_notif_update' => $this->m_notif->get_count_all_notif('update'),
        );
        $this->template->render("index",$data);
	}

    public function penjual(){
        $this->template->set_layout('templatesv2/backend');
        $this->template->add_title_segment('Notifikasi');
        $this->template->add_css('assets/plugins/datatables/dataTables.bootstrap.css');
        $this->template->add_js('assets/plugins/datatables/jquery.dataTables.min.js',true);
        $this->template->add_js('assets/plugins/datatables/dataTables.bootstrap.min.js',true);

        $data = array(
            'active'    => 'notif',
            'name'      => $this->security->get_csrf_token_name(),
            'hash'      => $this->security->get_csrf_hash(),
            'title_beranda' => 'Notifikasi',
            'count_notif_transaksi' => $this->m_notif->get_count_all_notif('transaksi'),
            'count_notif_update' => $this->m_notif->get_count_all_notif('update'),
        );
        $this->template->render("indexv2",$data);
    }

	public function ajax_list(){
		$type = $this->input->post('type');
		switch ($type) {
			case 'transaksi':
				$data   = array();
                $sort   = isset($_POST['columns'][$_POST['order'][0]['column']]['data']) ? strval($_POST['columns'][$_POST['order'][0]['column']]['data']) : 'nama';
                $order  = isset($_POST['order'][0]['dir']) ? strval($_POST['order'][0]['dir']) : 'desc';
                $no     = $this->input->post('start');

                $list = $this->m_table->get_datatables('notif_transaksi',$sort,$order);
                foreach ($list as $l) {
                    if ($this->input->post('view') == 'penjual') {
                        if ($l->modul == 'transaksi_pembelian') {
                            $lable = '<span class="badge badge-primary">Pembelian</span>';
                        }else{
                            $lable = '<span class="badge badge-success">Penjualan</span>';
                        }
                    }else{
                        if ($l->modul == 'transaksi_pembelian') {
                            $lable = '<span class="label label-primary">Pembelian</span>';
                        }else{
                            $lable = '<span class="label label-success">Penjualan</span>';
                        }
                    }

                    $l->dt = '<div style="cursor:pointer;" onclick="detail_notif('.$l->id_notifikasi.','.$l->id_detail.',`'.$l->modul.'`,`'.$l->submodul.'`)">
                    		 <b>'.$l->judul.'</b> '.$lable.'
                             <br>'.$l->message.'
                             <br><span style="font-size:10px;">'.indonesian_date($l->tanggal).'<span>
                             </div>';
                    
                    $data[] = $l;
                }

                $output = array(
                    "draw"              => $_POST['draw'],
                    "recordsTotal"      => $this->m_table->count_all('notif_transaksi',$sort,$order),
                    "recordsFiltered"   => $this->m_table->count_filtered('notif_transaksi',$sort,$order),
                    "data"              => $data,
                );  
                echo json_encode($output);
			break;
			
			case 'update':
				$data   = array();
                $sort   = isset($_POST['columns'][$_POST['order'][0]['column']]['data']) ? strval($_POST['columns'][$_POST['order'][0]['column']]['data']) : 'nama';
                $order  = isset($_POST['order'][0]['dir']) ? strval($_POST['order'][0]['dir']) : 'desc';
                $no     = $this->input->post('start');

                $list = $this->m_table->get_datatables('notif_update',$sort,$order);
                foreach ($list as $l) {
                    $l->dt = '<div style="cursor:pointer;" onclick="detail_notif('.$l->id_notifikasi.','.$l->id_detail.',`'.$l->modul.'`,`'.$l->submodul.'`)">
                    		 <b>'.$l->judul.'</b>
                             <br>'.$l->message.'
                             <br><span style="font-size:10px;">'.indonesian_date($l->tanggal).'<span>
                             </div>';
                    
                    $data[] = $l;
                }

                $output = array(
                    "draw"              => $_POST['draw'],
                    "recordsTotal"      => $this->m_table->count_all('notif_update',$sort,$order),
                    "recordsFiltered"   => $this->m_table->count_filtered('notif_update',$sort,$order),
                    "data"              => $data,
                );  
                echo json_encode($output);
			break;
		}
	}

	public function ajax_data(){
		$type = $this->input->post('type');
		switch ($type) {
			case 'get_notif':
				if($this->user_model->is_login()){
					$count = $this->m_notif->get_count_all_notif();
					$data = $this->m_notif->get_list_notif(5);
				}else{
                    $count = 0;
                    $data = null;
                }
                echo json_encode(array('status' => TRUE, 'count' => $count,'data' => $data));
			break;
		}
	}

	public function read_notif(){
		$id_notifikasi = (int)$this->input->post('id_notifikasi',true);
		$this->db->update('m_notifikasi',array('is_read' => 1),array('id_notifikasi' => $id_notifikasi));
		echo json_encode(array('status' => true));
	}
}
?>