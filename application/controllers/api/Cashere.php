<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Cashere extends REST_Controller
{
    private $path_testing = 'http://103.50.218.58/umkm/assets/';
    private $path_upload_testing = '/home/devtesting/webs/public_html/devtesting.tangerangkota.go.id.site/umkm/assets/';
    private $path_tlive = 'https://service-tlive.tangerangkota.go.id/assets/kasir/';
    private $path_upload_tlive = '/webs/public_html/t-live.tangerangkota.go.id.site/assets/kasir/';
    private $currentDate = null;

    function __construct()
    {
        parent::__construct();
        setlocale(LC_ALL, 'id-ID', 'id_ID'); // locate untuk date format php
        date_default_timezone_set("Asia/Jakarta"); // waktu php
    }

    function index_get()
    {
        echo "index gess";
    }
}
