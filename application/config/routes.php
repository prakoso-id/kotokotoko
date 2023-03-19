<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] 			= 'beranda';
$route['404_override'] 					= 'not_found';
$route['translate_uri_dashes'] 			= FALSE;
$route['keluar'] 						= 'login/keluar';
$route['customer/daftar-alamat'] 		= 'customer/daftar_alamat';

$route['list-produk'] 					= 'list_produk';
$route['list-produk/produk/(:any)'] 	= 'list_produk/produk/$1';
$route['list-produk/produk/(:any)/(:any)'] = 'list_produk/produk/$1/$2';
$route['list-produk/kategori/(:any)']	= 'list_produk/kategori/$1';

$route['list-berita/berita/(:any)'] 	= 'list_berita/berita/$1';

$route['list-umkm']						= 'list_umkm';
$route['list-berita']					= 'list_berita';
$route['not-found'] 					= 'not_found';
// $route['keranjang/(:any)'] 				= 'keranjang/bayar';
$route['dasar-hukum'] 					= 'dasar_hukum';

$route['list-umkm/umkm/(:any)'] 		= 'list_umkm/detail/$1';
$route['list-umkm/kategori/(:any)'] 	= 'list_umkm/kategori/$1';
$route['toko/(:any)']					= 'list_umkm/detail/$1';
$route['toko/(:any)/(:any)']			= 'list_umkm/detail/$1/$2';
$route['toko/(:any)/(:any)/form']		= 'list_umkm/form/$1/$2';
$route['toko/(:any)/(:any)/(:any)']		= 'list_umkm/detail/$1/$2/$3';
$route['toko/ajax_save']				= 'list_umkm/ajax_save';
