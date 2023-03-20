<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Keranjang extends MY_Controller {

	public function __construct() {
		parent::__construct();
		if(!$this->user_model->is_login()){
            redirect(base_url());
        }
		$this->template->set_layout('frontend/index'); 
	}

	public function index() {
		$this->session->set_tempdata('code',random_num(20),60);
		$this->template->add_title_segment('Keranjang');
		$this->template->add_meta_tag("description", "Keranjang Belanja Portal UMKM Kota Tangerang");
		$this->template->add_meta_tag("keywords", "keranjang produk, product, umkm,portal umkm,kota tangerang,tangerang,portal");

		$k = keranjangku();
        $keranjang = $k['keranjang'];
        $jml_keranjang = $k['jml_keranjang'];

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

	public function ajax_list(){
		$keranjang = $this->query_model->keranjang('data',null,'id_umkm');
		
		if ($keranjang) {

			$filterKeranjang_0 = array_filter(
			    $keranjang,
			    function ($e) {
			        return $e->is_checked == 0;
			    }
			);

			if ($filterKeranjang_0) {
				$is_checked_all = '';
			}else{
				$is_checked_all = 'checked';
			}

			$html = '<form id="checkout-form" class="clearfix" method="post" action="'.base_url('keranjang/bayar/'.$this->session->tempdata('code')).'">
					<div class="col-md-8 col-sm-8 col-xs-12" style="margin-bottom:20px;">
						<div class="shopping-cart bd-7">
						<input type="hidden" name="'.$this->security->get_csrf_token_name().'" value="'.$this->security->get_csrf_hash().'">
						<table class="table table-hover table-striped table-bordered" width="100%">
							<thead>
								<tr>
									<th>
										<div class="form-check" style="float:left;margin-right:10px;">
										    <input type="checkbox" class="form-check-input" id="cek_all" '.$is_checked_all.'>
										    <label class="form-check-label" for="cek_all"> Pilih Semua Barang</label>
										</div>
										<div class="btn_del_all">
											<i class="fa fa-trash" title="Hapus item terpilih"></i>
										</div>
									</th>
								</tr>
							</thead>
							<tbody>';

							$i=0;
							$id_umkm = null;
							$total_diskon = 0;
							foreach ($keranjang as $value) {
								$jumlah_diskon = 0;
								$product_code = short($value->kode_produk);

								if ($value->diskon > 0) {
									$sub_total_harga_barang = ($value->harga - $value->diskon_nominal) * $value->quantity;
									$jumlah_diskon += ($value->diskon_nominal * $value->quantity);
                                    if ($value->is_checked) {
                                        $total_diskon += ($value->diskon_nominal * $value->quantity);
                                    }
								} else {
									$sub_total_harga_barang = $value->harga * $value->quantity;
								}

								if ($value->id_wishlist) {
							          $icon_love = '<i class="fa fa-heart wish-'.$value->id_produk.'" style="color:#e95a5c;"></i>';
							    }else{
							          $icon_love = '<i class="fa fa-heart-o wish-'.$value->id_produk.' style="color:#bfbfbf;""></i>';
							    }

							    if ($value->is_checked) {
							    	$is_checked = "checked";
							    }else{
							    	$is_checked = "";
							    }
							    
							    $check_class ='check-item chek-item-umkm-'.$value->username;
							    $is_disabled = $msg = '';
							    if ($value->stok == 0) {
							    	$is_disabled = 'disabled';
							    	$is_checked = $check_class = '';
							    	$msg = 'Stok Habis';
							    }else{
								    if ($value->stok < $value->quantity) {
								    	$msg = 'Maks. beli '.$value->stok.' barang';
								    } 
								}

								if ($id_umkm != $value->username) {
									$icon_verify = '';
								    if ($value->id_status == 1) {
								        $icon_verify = '<i class="fa fa-check-circle fa-gradient"></i>';
								    }

									$row_toko = '<div class="row" style="margin-bottom:30px;">
													<div class="col-md-12 col-sm-12 col-xs-12">
														<input style="float:left;" class="check-umkm-all" name="is_checked_umkm['.$value->username.']" id="check_umkm_'.$value->username.'" type="checkbox" data-id="'.$value->username.'" value="'.$value->username.'">
														<div class="info-produk">
														<h4><a href="'.base_url().'toko/'.short($value->username).'" target="_blank">'.text($value->nama_umkm).' '.$icon_verify.'</a></h4>
														<span style="font-size:10px;color:#999999;"><i class="fa fa-map-marker"></i> '.$value->nama_kel.'</span>
														</div>
													</div>
												</div>';
								}else{
									$row_toko = '';
								}

								if ($value->diskon > 0) {
									$harga = '<span>Rp. '.rp($value->harga - $value->diskon_nominal).'</span><span style="margin-left:50px;text-decoration:line-through;">Rp. ' . rp($value->harga) . '</span><br>';
								} else {
									$harga = '<span>Rp. '.rp($value->harga).'</span><br>';
								}

								$html .= '<tr>
											<td width="100%">
												'.$row_toko.'
												<div class="row">
													<div class="col-md-12 col-sm-12 col-xs-12">
														<input style="float:left;" name="is_checked['.$i.']" id="is_checked_'.$i.'" class="'.$check_class.'" type="checkbox" '.$is_checked.' value="'.$value->id_produk.'" '.$is_disabled.' data-i="'.$i.'" data-id_umkm="'.$value->username.'">
														<div class="div-img-produk">
															<a href="'.base_url('list-produk/produk/'.$product_code).'" target="_blank">
																<img src="'.base_url('assets/produk/'.$value->username.'/'.$value->foto).'" class="img-reponsive image-produk">
															</a>
														</div>
														<div class="info-produk">
															<h5><a href="'.base_url('list-produk/produk/'.$product_code).'" target="_blank">'.$value->nama_produk.'</a></h5>
															' . $harga . '
															<span style="font-size:10px;">Stok : '.(($value->stok) ? $value->stok : '<font color="red">Habis</font>').'</span>
														</div>
													</div>
													<div class="col-md-12">
														<div class="col-md-6 col-sm-6 col-xs-12" style="float:right">
															<div class="row" style="float:right;">
																<div class="col-md-1 col-sm-1 col-xs-1 btn_love love-produk" data-id="'.$value->id_produk.'" title="Tambahkan ke favorit">
										                         '.$icon_love.'   
										                        </div>
																<div class="col-md-1 col-sm-1 col-xs-1 btn_del hapus-produk" data-id="'.$value->id_produk.'" title="Hapus dari keranjang">
																	<i class="fa fa-trash"></i>
																</div>
																<div class="col-md-6 col-sm-6 col-xs-6 input_quantity">
																	<div class="input-group">
																		<span class="input-group-btn" style="position:relative !important;display:table-cell !important;">
																			<button type="button" class="btn btn-blue btn-number btn-number-'.$i.'" id="minus-'.$i.'" data-type="minus" data-i="'.$i.'" data-field="data_quantity_'.$i.'">
																				<span class="glyphicon glyphicon-minus"></span>
																			</button>
																		</span>
																		<input type="text" name="quantity['.$i.']" id="data_quantity_'.$i.'" class="form-control input-number input-number-'.$i.'" data-i="'.$i.'" data-id_keranjang="'.$value->id_keranjang.'" data-id_produk="'.$value->id_produk.'" value="'.$value->quantity.'" min="1" max="'.$value->stok.'">
																		<span class="input-group-btn" style="position:relative !important;display:table-cell !important;">
																			<button type="button" class="btn btn-blue btn-number btn-number-'.$i.'" data-type="plus" data-i="'.$i.'" data-field="data_quantity_'.$i.'" id="plus-'.$i.'">
																				<span class="glyphicon glyphicon-plus"></span>
																			</button>
																		</span>
																	</div>
																	<span class="help help-'.$i.'" style="font-size:10px;" >'.$msg.'</span>
																</div>
															</div>
														</div>
													</div>
												</div>
												<input type="hidden" name="id_produk['.$i.']" value="'.$value->id_produk.'">
												<input type="hidden" name="kode_produk['.$i.']" value="'.$value->kode_produk.'">
												<input type="hidden" name="foto_produk['.$i.']" value="'.base_url('assets/produk/'.$value->username.'/'.$value->foto).'">
												<input type="hidden" name="nama_produk['.$i.']" value="'.$value->nama_produk.'">
												<input type="hidden" name="harga['.$i.']" id="harga_'.$i.'" value="'. $value->harga.'">
												<input type="hidden" name="berat['.$i.']" id="berat_'.$i.'" value="'.$value->berat.'">
												<input type="hidden" name="diskon['.$i.']" id="diskon_'.$i.'" value="'.$value->diskon_nominal.'">
												<input type="hidden" name="diskon_persen['.$i.']" id="diskon_persen_'.$i.'" value="'.$value->diskon.'">
												
												<input type="hidden" name="sub_total_harga_barang['.$i.']" id="sub_total_harga_'.$i.'" value="'.$sub_total_harga_barang.'">
												<input type="hidden" name="jumlah_diskon['.$i.']" id="jumlah_diskon_'.$i.'" value="'.$jumlah_diskon.'">
												<input type="hidden" name="id_umkm['.$i.']" id="id_umkm_'.$i.'" value="'.$value->username.'">
												<input type="hidden" name="username_umkm['.$i.']" id="username_umkm_'.$i.'" value="'.$value->username_umkm.'">
												<input type="hidden" name="nama_umkm['.$i.']" id="nama_umkm_'.$i.'" value="'.$value->nama_umkm.'">
												<input type="hidden" name="is_verify_umkm['.$i.']" id="is_verify_umkm_'.$i.'" value="'.$value->id_status.'">
												<input type="hidden" name="id_kel_umkm['.$i.']" id="id_kel_umkm_'.$i.'" value="'.$value->id_kel_umkm.'">
												<input type="hidden" name="nama_kel_umkm['.$i.']" id="nama_kel_umkm_'.$i.'" value="'.$value->nama_kel.'">
												<input type="hidden" name="id_kec_umkm['.$i.']" id="id_kec_umkm_'.$i.'" value="'.$value->id_kec_umkm.'">
												<input type="hidden" name="no_kab_umkm['.$i.']" id="no_kab_umkm_'.$i.'" value="'.$value->no_kab_umkm.'">
												<input type="hidden" name="no_prop_umkm['.$i.']" id="no_prop_umkm_'.$i.'" value="'.$value->no_prop_umkm.'">
												<input type="hidden" name="id_kurir_umkm['.$i.']" id="id_kurir_umkm_'.$i.'" value="'.htmlspecialchars($value->id_kurir_umkm).'">
											</td>
										  </tr>';
								$i++;
								$id_umkm = $value->username;
							}

							$html .= '<input type="hidden" name="jumlah_diskon" value="' . $total_diskon . '">';

				if ($total_diskon > 0) {
					$total_harga = '
						<tr class="order-total">
							<th>Total Harga</th>
							<td align="right" class="total_harga" style="color:rgb(250, 89, 29);"></td>
						</tr>
						<tr class="order-diskon">
							<th>Anda hemat</th>
							<td align="right" class="total_diskon" style="color:rgb(250, 89, 29);">Rp. ' . rp($total_diskon) . '</td>
						</tr>
					';
				} else {
					$total_harga = '
						<tr class="order-total">
							<th>Total Harga</th>
							<td align="right" class="total_harga" style="color:rgb(250, 89, 29);"></td>
						</tr>
						<tr class="order-diskon" style="display:none">
							<th>Anda hemat</th>
							<td align="right" class="total_diskon" style="color:rgb(250, 89, 29);"></td>
						</tr>
					';
				}
								
				$html .= '</tbody>
						  </table>
						  </div>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-12">
						<input type="hidden" name="total_harga">
						<div class="cart-total bd-7">
                            <div class="table-responsive">
                                <table class="shop_table">
                                	<thead>
                                		<tr><th colspan="2"><h4>Ringkasan Belanja</h4></th></tr>
                                	</thead>
                                    <tbody>
                                        ' . $total_harga . '
                                    </tbody>
                                </table>
                            </div>
                            <div class="cart-total-bottom" style="margin-bottom:20px;">
                                <button type="submit" class="btn-gradient btn-checkout">Beli &nbsp;<span class="total_quantity"></span></button>
                            </div>
                        </div>
					</div>
					</form>';
		}else{
			$html = '<div class="col-md-12">
						<div class="error-page bd-7 text-center">
						    <div class="error-img">
						        <img src="'.base_url().'assets/mytemplate/img/empty_cart.png" alt="" width="100px;">
						    </div>
						    <h3 class="error-title">Wah, keranjang belanjaanmu kosong..</h3>
						  
						    <a href="'.base_url('list_produk').'" class="btn-back btn-gradient">Mulai Belanja Sekarang<i class="ion-ios-arrow-forward"></i></a>
						</div>
					</div>';
		}

		echo json_encode(array('status' => true, 'data' => $html));
	}

	public function bayar($code){
		$this->template->add_title_segment('Checkout');
		$this->template->add_meta_tag("description", "Checkout Portal UMKM Kota Tangerang");
		$this->template->add_meta_tag("keywords", "Checkout produk, product, umkm,portal umkm,kota tangerang,tangerang,portal");

		$this->template->add_css('assets/plugins/datatables/dataTables.bootstrap.css');
        $this->template->add_js('assets/plugins/datatables/jquery.dataTables.min.js',true);
        $this->template->add_js('assets/plugins/datatables/dataTables.bootstrap.min.js',true);

		if(!$this->user_model->is_login()){
			redirect(base_url());
		}else{
			$keranjang = $this->query_model->keranjang('data',5);
			$jml_keranjang = $this->query_model->keranjang('jumlah');
		}

		$dt = array();
		$sub_total_harga_barang=0;

		if(!$this->session->tempdata('code') or !$this->input->post() or ($code != $this->session->tempdata('code'))){
			redirect(base_url('keranjang'));
		}else{
			$data_post = $this->input->post();
			$arr_id_umkm = array_unique($data_post['id_umkm']);

			//looping umkm
			foreach ($arr_id_umkm as $key_u => $u){
				if(isset($data_post['is_checked'][$key_u])){
					//looping produk per umkm
					$produk = array();
					$jum_produk_per_umkm = $jum_harga_barang_umkm = $jum_berat_barang_umkm = $jum_diskon_barang_umkm = 0;
					foreach ($data_post['id_produk'] as $key_p => $p) {
						if((isset($data_post['is_checked'][$key_p])) && ($data_post['id_umkm'][$key_p] == $u)){
							$jum_harga_barang = (int)$data_post['quantity'][$key_p] * (int)$data_post['harga'][$key_p];
							$jum_diskon_barang = (int)$data_post['quantity'][$key_p] * (int)$data_post['diskon'][$key_p];
							$jum_berat_barang = (int)$data_post['quantity'][$key_p] * (float)$data_post['berat'][$key_p];
							$produk[] = array('id_produk' => $data_post['id_produk'][$key_p],
											  'kode_produk' => $data_post['kode_produk'][$key_p], 
											  'nama_produk' => $data_post['nama_produk'][$key_p],
											  'foto_produk' => $data_post['foto_produk'][$key_p],
											  'quantity' => $data_post['quantity'][$key_p],
											  'harga' => $data_post['harga'][$key_p],
											  'diskon' => $data_post['diskon'][$key_p], //jumlah diskon
											  'diskon_nominal' => $data_post['diskon'][$key_p], //nominal diskon
											  'diskon_persen' => $data_post['diskon_persen'][$key_p],
											  'berat' => $data_post['berat'][$key_p],
											  'jumlah_harga_barang' => $jum_harga_barang,
											  'jumlah_diskon_barang' => $jum_diskon_barang,
											  'jumlah_berat_barang' => $jum_berat_barang,
										);
							$jum_produk_per_umkm = $jum_produk_per_umkm + $data_post['quantity'][$key_p];
							$jum_harga_barang_umkm = $jum_harga_barang_umkm + $jum_harga_barang;
							$jum_diskon_barang_umkm = $jum_diskon_barang_umkm + $jum_diskon_barang;
							$jum_berat_barang_umkm = $jum_berat_barang_umkm + $jum_berat_barang;
						}
					}

					$arr_id_kurir = json_decode($data_post['id_kurir_umkm'][$key_u]);
					$kurir = get_kurir(null,$arr_id_kurir);

					$dt[] = array('id_umkm' => $data_post['id_umkm'][$key_u],
								  'username_umkm' => $data_post['username_umkm'][$key_u],
								  'nama_umkm' => $data_post['nama_umkm'][$key_u],
								  'is_verify_umkm' => $data_post['is_verify_umkm'][$key_u],
								  'id_kel_umkm' => $data_post['id_kel_umkm'][$key_u],
								  'nama_kel_umkm' => $data_post['nama_kel_umkm'][$key_u],
								  'id_kec_umkm' => $data_post['id_kec_umkm'][$key_u],
								  'no_kab_umkm' => $data_post['no_kab_umkm'][$key_u],
								  'no_prop_umkm' => $data_post['no_prop_umkm'][$key_u],
								  'produk' => $produk,
								  'jumlah_produk' => $jum_produk_per_umkm,
								  'jumlah_harga_barang' => $jum_harga_barang_umkm,
								  'jumlah_diskon_barang' => $jum_diskon_barang_umkm,
								  'jumlah_berat_barang' => round($jum_berat_barang_umkm),
								  'kurir' => $kurir,
							);
					$sub_total_harga_barang = $sub_total_harga_barang + $jum_harga_barang_umkm;
				}
			}
		}

		$jumlah_diskon = $data_post['jumlah_diskon'];

		$detail_bayar = array('data' => $dt, 'sub_total_harga_barang' => $sub_total_harga_barang, 'jumlah_diskon' => $jumlah_diskon);

		// var_dump(json_encode($detail_bayar)); die();

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