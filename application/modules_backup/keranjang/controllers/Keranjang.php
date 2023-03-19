<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Keranjang extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->template->set_layout('templates/frontend');
		$this->session->set_tempdata('jenis_menu','user',300); 
	}

	public function index() {
		$this->template->add_title_segment('Keranjang');
		$this->template->add_meta_tag("description", "Keranjang Belanja Portal UMKM Kota Tangerang");
		$this->template->add_meta_tag("keywords", "keranjang produk, product, umkm,portal umkm,kota tangerang,tangerang,portal");

		// $this->template->add_css('assets/css.css');
		// $this->template->add_js('assets/plugins/tables/datatables/datatables.min.js');

		if($this->user_model->is_login())
		{
			$keranjang 			= $this->query_model->keranjang('data');
			$jml_keranjang 		= $this->query_model->keranjang('jumlah');
		}else{
			$keranjang = null;
			$jml_keranjang = 0;
		}

		$this->data = array(
			'active'	=> 'keranjang',
			'keranjang'	=> $keranjang,
			'kategori'	=> $this->query_model->getKategori(),
			'jml_keranjang'	=> $jml_keranjang,
			'title_beranda'	=> 'Keranjang',
			'dilihat'		=> $this->query_model->terakhir_dilihat(4),
		);

		$this->template->render("index",$this->data);
	}

	public function bayar()
	{
		$this->template->add_title_segment('Checkout');
		$this->template->add_meta_tag("description", "Checkout Portal UMKM Kota Tangerang");
		$this->template->add_meta_tag("keywords", "Checkout produk, product, umkm,portal umkm,kota tangerang,tangerang,portal");

		// $this->template->add_js('assets/plugins/tables/datatables/datatables.min.js');
		// $this->template->add_js('assets/plugins/tables/datatables/extensions/fixed_columns.min.js');
		$this->template->add_js('assets/plugins/forms/selects/select2.min.js');
		$this->template->add_js('assets/plugins/notifications/sweet_alert.min.js');
		$this->template->add_css('assets/plugins/select2/select2.css');
		// $this->template->add_css('assets/css.css');
		// $this->template->add_js('assets/plugins/tables/datatables/datatables.min.js');

		if(!$this->user_model->is_login()){
			// $keranjang = null;
			// $jml_keranjang = 0;
			redirect(base_url('keranjang'));
		}else{
			$keranjang 			= $this->query_model->keranjang('data');
			$jml_keranjang 		= $this->query_model->keranjang('jumlah');
		}

		$dt = array();
		$sub_total_harga_barang=0;

		if(!$this->session->tempdata('code') or !$this->input->post()){
			redirect(base_url('keranjang'));
		}else{
			$data_post = $this->input->post();
			$arr_id_umkm = array_unique($data_post['id_umkm']);
			//looping umkm
			foreach ($arr_id_umkm as $key_u => $u){
				if(isset($data_post['is_checked'][$key_u]) && $data_post['is_checked'][$key_u] == 'on'){
					//looping produk per umkm
					$produk = array();
					$jum_produk_per_umkm = $jum_harga_barang_umkm = $jum_berat_barang_umkm = 0;
					foreach ($data_post['id_produk'] as $key_p => $p) {
						if((isset($data_post['is_checked'][$key_p]) && $data_post['is_checked'][$key_p] == 'on') && ($data_post['id_umkm'][$key_p] == $u)){
							$jum_harga_barang = (int)$data_post['quantity'][$key_p] * (int)$data_post['harga'][$key_p];
							$jum_berat_barang = (int)$data_post['quantity'][$key_p] * (float)$data_post['berat'][$key_p];
							$produk[] = array('id_produk' => $data_post['id_produk'][$key_p], 
											  'nama_produk' => $data_post['nama_produk'][$key_p],
											  'foto_produk' => $data_post['foto_produk'][$key_p],
											  'quantity' => $data_post['quantity'][$key_p],
											  'harga' => $data_post['harga'][$key_p],
											  'berat' => $data_post['berat'][$key_p],
											  'jumlah_harga_barang' => $jum_harga_barang,
											  'jumlah_berat_barang' => $jum_berat_barang,
										);
							$jum_produk_per_umkm = $jum_produk_per_umkm + $data_post['quantity'][$key_p];
							$jum_harga_barang_umkm = $jum_harga_barang_umkm + $jum_harga_barang;
							$jum_berat_barang_umkm = $jum_berat_barang_umkm + $jum_berat_barang;
						}
					}

					$arr_id_kurir = json_decode($data_post['id_kurir_umkm'][$key_u]);
					$kurir = get_kurir(null,$arr_id_kurir);

					$dt[] = array('id_umkm' => $data_post['id_umkm'][$key_u],
								  'nama_umkm' => $data_post['nama_umkm'][$key_u],
								  'id_kel_umkm' => $data_post['id_kel_umkm'][$key_u],
								  'id_kec_umkm' => $data_post['id_kec_umkm'][$key_u],
								  'no_kab_umkm' => $data_post['no_kab_umkm'][$key_u],
								  'no_prop_umkm' => $data_post['no_prop_umkm'][$key_u],
								  'produk' => $produk,
								  'jumlah_produk' => $jum_produk_per_umkm,
								  'jumlah_harga_barang' => $jum_harga_barang_umkm,
								  'jumlah_berat_barang' => round($jum_berat_barang_umkm),
								  'kurir' => $kurir,
							);
					$sub_total_harga_barang = $sub_total_harga_barang + $jum_harga_barang_umkm;
				}
			}
		}

		$detail_bayar = array('data' => $dt, 'sub_total_harga_barang' => $sub_total_harga_barang);

		$this->data = array(
			'name'		=> $this->security->get_csrf_token_name(),
			'hash'		=> $this->security->get_csrf_hash(),
			'active'	=> '',
			'keranjang'	=> $keranjang,
			'kategori'	=> $this->query_model->getKategori(),
			'jml_keranjang'	=> $jml_keranjang,
			'title_beranda'	=> 'Checkout',
			'dilihat'		=> $this->query_model->terakhir_dilihat(4),
			'detail_bayar'  => $detail_bayar
		);

		$this->template->render("bayar",$this->data);
	}
}