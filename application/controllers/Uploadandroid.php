<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/ImageResize.php';
#require APPPATH . '/libraries/REST_Controller.php';
use Gumlet\ImageResize;

class Uploadandroid extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('session');
	}

	public function hapus_foto()
    {
        $path_to_file = 'assets/produk/'.$this->input->post('nik').'/'.$this->input->post('namafoto');
		if(file_exists($path_to_file)){
			//echo json_encode(['success' => true, 'message' => 'file ada','status' => TRUE]);
			if(unlink($path_to_file)) {
				echo json_encode(['success' => true, 'message' => 'Foto berhasil dihapus','status' => TRUE]);
			}
			else {
				echo json_encode(['success' => false, 'message' => 'Foto Gagal Dihapus','status' => TRUE]); 
			}	
		}else{
			echo json_encode(['success' => false, 'message' => 'file tidak ada','status' => TRUE]);
			die;
			
		}
        
    }
	public function upload()
	{
		$type = $this->input->post('type');
		$nik = $this->input->post('nik');
		switch ($type) {
			case 'upload_umkm':
				if (!is_dir('assets/media/'.$nik)) {
		            mkdir('assets/media/'.$nik);
		        }

				if (!is_dir('assets/media/'.$nik.'/umkm')) {
		            mkdir('assets/media/'.$nik.'/umkm');
		        }

		        if($_FILES['file']['name'] != '')
		        {
		            $config['upload_path'] = './assets/media/'.$nik.'/umkm';
		            $config['allowed_types'] = 'jpg|jpeg|png';
		            $config['encrypt_name'] = TRUE;
		            $config['overwrite'] = TRUE;
		            $this->upload->initialize($config);
		            $this->upload->initialize($config);

		            if($this->upload->do_upload("file"))
		            {    
		                $data_umkm = $this->upload->data();

		                $this->resize($data_umkm);
		                $surat_iumkm  = $data_umkm['file_name'];
		                echo json_encode([ 'error' => 0,'file' => $surat_iumkm,'url' => base_url('assets/media/'.$nik.'/umkm/'.$surat_iumkm),'message' => $this->upload->display_errors() ]);
		            }
		            else
		            {
		                echo json_encode(['error' => 1, 'message' => $this->upload->display_errors()]);
		                exit();
		            }
		        }
			break;
			case 'upload_npwp':
				if (!is_dir('assets/media/'.$nik)) {
		            mkdir('assets/media/'.$nik);
		        }

				if (!is_dir('assets/media/'.$nik.'/npwp')) {
		            mkdir('assets/media/'.$nik.'/npwp');
		        }

		        if($_FILES['file']['name'] != '')
		        {
		            $config['upload_path'] = './assets/media/'.$nik.'/npwp';
		            $config['allowed_types'] = 'jpg|jpeg|png';
		            $config['encrypt_name'] = TRUE;
		            $config['overwrite'] = TRUE;
		            $this->upload->initialize($config);

		            if($this->upload->do_upload("file"))
		            {    
		                $data_npwp = $this->upload->data();
		                
		              	$this->resize($data_npwp);

		                $surat_npwp  = $data_npwp['file_name'];
		                echo json_encode([ 'error' => 0,'file' => $surat_npwp,'url' => base_url('assets/media/'.$nik.'/npwp/'.$surat_npwp),'message' => $this->upload->display_errors() ]);
		            }
		            else
		            {
		                echo json_encode(['error' => 1, 'message' => $this->upload->display_errors()]);
		                exit();
		            }
		        }
			break;
			case 'upload_ktp':
				if (!is_dir('assets/media/'.$nik)) {
		            mkdir('assets/media/'.$nik);
		        }

				if (!is_dir('assets/media/'.$nik.'/ktp')) {
		            mkdir('assets/media/'.$nik.'/ktp');
		        }

		        if($_FILES['file']['name'] != '')
		        {
		            $config['upload_path'] = './assets/media/'.$nik.'/ktp';
		            $config['allowed_types'] = 'jpg|jpeg|png';
		            $config['encrypt_name'] = TRUE;
		            $config['overwrite'] = TRUE;
		            $this->upload->initialize($config);

		            if($this->upload->do_upload("file"))
		            {    
		                $data_ktp = $this->upload->data();
		                $this->resize($data_ktp);
		                $surat_ktp  = $data_ktp['file_name'];
		                echo json_encode([ 'error' => 0,'file' => $surat_ktp,'url' => base_url('assets/media/'.$nik.'/ktp/'.$surat_ktp),'message' => $this->upload->display_errors() ]);
		            }
		            else
		            {
		                echo json_encode(['error' => 1, 'message' => $this->upload->display_errors()]);
		                exit();
		            }
		        }
			break;
			case 'upload_kk':
				if (!is_dir('assets/media/'.$nik)) {
		            mkdir('assets/media/'.$nik);
		        }

				if (!is_dir('assets/media/'.$nik.'/kk')) {
		            mkdir('assets/media/'.$nik.'/kk');
		        }

		        if($_FILES['file']['name'] != '')
		        {
		            $config['upload_path'] = './assets/media/'.$nik.'/kk';
		            $config['allowed_types'] = 'jpg|jpeg|png';
		            $config['encrypt_name'] = TRUE;
		            $config['overwrite'] = TRUE;
		            $this->upload->initialize($config);

		            if($this->upload->do_upload("file"))
		            {    
		                $data_kk = $this->upload->data();
		                $this->resize($data_kk);
		                $surat_kk  = $data_kk['file_name'];
		                echo json_encode([ 'error' => 0,'file' => $surat_kk,'url' => base_url('assets/media/'.$nik.'/kk/'.$surat_kk),'message' => $this->upload->display_errors() ]);
		            }
		            else
		            {
		                $result = array(['success'=>false, 'total'=>0, 'data'=> NULL, 'message'=>$this->upload->display_errors()]);
						echo json_encode(['error' => 1, 'message' => $this->upload->display_errors()]);
		                exit();
		            }
		        }
			break;
			case 'upload_foto':
				if (!is_dir('assets/media/'.$nik)) {
		            mkdir('assets/media/'.$nik);
		        }

				if (!is_dir('assets/media/'.$nik.'/foto')) {
		            mkdir('assets/media/'.$nik.'/foto');
		        }

		        if($_FILES['file']['name'] != '')
		        {
		            $config['upload_path'] = './assets/media/'.$nik.'/foto';
		            $config['allowed_types'] = 'jpg|jpeg|png';
		            $config['encrypt_name'] = TRUE;
		            $config['overwrite'] = TRUE;
		            $this->upload->initialize($config);

		            if($this->upload->do_upload("file"))
		            {    
		                $data_foto = $this->upload->data();
		                $this->resize($data_foto);
		                $surat_foto  = $data_foto['file_name'];
		                echo json_encode([ 'error' => 0,'file' => $surat_foto,'url' => base_url('assets/media/'.$nik.'/foto/'.$surat_foto),'message' => $this->upload->display_errors() ]);
		            }
		            else
		            {
		                echo json_encode(['error' => 1, 'message' => $this->upload->display_errors()]);
		                exit();
		            }
		        }
			break;
			case 'upload_produk':
			
				if (!is_dir('assets/produk/'.$nik)) {
		            mkdir('assets/produk/'.$nik);
		        }

		        if($_FILES['file']['name'] != '')
		        {
		            $config['upload_path'] = './assets/produk/'.$nik;
		            $config['allowed_types'] = 'jpg|jpeg|png';
		            $config['encrypt_name'] = TRUE;
		            $config['overwrite'] = TRUE;
		            $this->upload->initialize($config);

		            if($this->upload->do_upload("file"))
		            {    
		                $data_foto = $this->upload->data();
		                $this->resize($data_foto);
		                $surat_foto  = $data_foto['file_name'];
		                echo json_encode([ 'error' => 0,'file' => $surat_foto,'url' => base_url('assets/produk/'.$nik."/".$surat_foto),'message' => $this->upload->display_errors() ]);
		            }
		            else
		            {
		                echo json_encode(['error' => 1, 'message' => $this->upload->display_errors()]);
		                exit();
		            }
		        }
			break;
		}    
	}

	public function resize($upload_data)
    {
        try {
            ini_set ('gd.jpeg_ignore_warning', 1);
            $image = new ImageResize($upload_data['full_path']);
            $image->resizeToBestFit(1920, 1080);
            $image->save($upload_data['full_path']);
            clearstatcache();
            $upload_data['file_size'] = round(filesize($upload_data['full_path'])/1000, 3);
            $upload_data['public_path'] = $upload_data['file_path'];
            $upload_data['url'] = base_url($upload_data['public_path'].$upload_data['file_name']);
            chmod($upload_data['file_path'].$upload_data['file_name'] ,0644);
        } catch (\Exception $e) {
            return false;
        }

        return $upload_data;
    }

    public function email()
    {
    	$type = $this->input->post('type');
    	switch ($type) {
    		case 'pemberitahuan_daftar_umkm':
    			$data = kirim_email_pemberitahuan($this->input->post('id_umkm'));
    			if($data)
	            {    
	                echo json_encode([ 'error' => 0,'message' => 'Pengiriman email berhasil' ]);
	                
	            }
	            else
	            {
	                echo json_encode(['error' => 1, 'message' => 'Pengiriman email gagal']);
	            }
    		break;
    		case 'pemberitahuan_daftar_umkm_ditolak':
    			$data = kirim_email_tolak($this->input->post('id_umkm'));
    			if($data)
	            {    
	                echo json_encode([ 'error' => 0,'message' => 'Pengiriman email berhasil' ]);
	                
	            }
	            else
	            {
	                echo json_encode(['error' => 1, 'message' => 'Pengiriman email gagal']);
	            }
    		break;
    		case 'pemberitahuan_daftar_umkm_diterima':
    			$data = kirim_email_terima($this->input->post('id_umkm'));
    			if($data)
	            {    
	                echo json_encode([ 'error' => 0,'message' => 'Pengiriman email berhasil' ]);
	                
	            }
	            else
	            {
	                echo json_encode(['error' => 1, 'message' => 'Pengiriman email gagal']);
	            }
    		break;
    		case 'pemberitahuan_transaksi_diproses':
    			$data = kirim_email_transaksi_sukses($this->input->post('id_transaksi'));
    			if($data)
	            {    
	                echo json_encode([ 'error' => 0,'message' => 'Pengiriman email berhasil' ]);
	                
	            }
	            else
	            {
	                echo json_encode(['error' => 1, 'message' => 'Pengiriman email gagal']);
	            }
    		break;
    		case 'pemberitahuan_transaksi_diproses_admin':
    			$data = kirim_email_transaksi_admin($this->input->post('id_transaksi'));
    			if($data)
	            {    
	                echo json_encode([ 'error' => 0,'message' => 'Pengiriman email berhasil' ]);
	                
	            }
	            else
	            {
	                echo json_encode(['error' => 1, 'message' => 'Pengiriman email gagal']);
	            }
    		break;
    		case 'pemberitahuan_transaksi_status':
    			$data = kirim_email_transaksi_status($this->input->post('id_transaksi_detail'));
    			if($data)
	            {    
	                echo json_encode([ 'error' => 0,'message' => 'Pengiriman email berhasil' ]);
	                
	            }
	            else
	            {
	                echo json_encode(['error' => 1, 'message' => 'Pengiriman email gagal']);
	            }
    		break;
    		case 'pemberitahuan_transaksi_pengiriman':
    			$data = kirim_email_transaksi_pengiriman($this->input->post('id_transaksi_detail'));
    			if($data)
	            {    
	                echo json_encode([ 'error' => 0,'message' => 'Pengiriman email berhasil' ]);
	                
	            }
	            else
	            {
	                echo json_encode(['error' => 1, 'message' => 'Pengiriman email gagal']);
	            }
    		break;
    		case 'pemberitahuan_transaksi_sampai':
    			$data = kirim_email_transaksi_sampai($this->input->post('id_transaksi_detail'));
    			if($data)
	            {    
	                echo json_encode([ 'error' => 0,'message' => 'Pengiriman email berhasil' ]);
	                
	            }
	            else
	            {
	                echo json_encode(['error' => 1, 'message' => 'Pengiriman email gagal']);
	            }
    		break;
    		

    		
    		default:
    			
    		break;
    	}
    }

}