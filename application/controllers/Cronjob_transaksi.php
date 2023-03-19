<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cronjob_transaksi extends MY_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('input');
        // is_cli_request() is provided by default input library of codeigniter
        if(!$this->input->is_cli_request()){
            echo "You dont have access";
            die();
        }
        
        $this->load->model('m_cronjob_transaksi');
    }

    public function batal_otomatis()
    {            
        $aff_row = $this->m_cronjob_transaksi->batal_otomatis();
        echo $aff_row.' data berhasil di update';
    }
}
?>