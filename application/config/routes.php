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
$route['default_controller'] = 'Auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Preference
/* Menu management */
$route['preference/menu_administration'] = 'menu/admin';

/* User Administration */
$route['preference/user_administration/user_data'] = 'user/admin';
$route['preference/user_administration/user_bagian'] = 'bagian/admin';
$route['preference/user_administration/user_jabatan'] = 'jabatan/admin';
$route['preference/user_administration/user_level/otorisasi'] = 'level_otorisasi/admin';
$route['preference/user_administration/user_level'] = 'level_user/admin';
$route['preference/user_administration/user_role'] = 'role_user/admin';

$route['preference/introduction'] = 'introduction';
$route['preference/visi_misi_values'] = 'visi_misi';
$route['preference/title_management'] = 'title_management/admin';
$route['preference/change_password'] = 'change_password';

// Master Table
$route['master/finance_accounting/jenisbank'] = 'jenisbank';
$route['master/finance_accounting/bank'] = 'list_bank';
$route['master/finance_accounting/cashbank'] = 'cashbank';
$route['master/reference/cabang_bank'] = 'cabang_bank';
$route['master/class_business/type_cob'] = 'type_cob';
$route['master/class_business/field_sppa'] = 'field_sppa';
$route['master/class_business/entry_cob_lob'] = 'cob_lob';
$route['master/class_business/business_specifications'] = 'business_specifications';
$route['master/class_business/business_specifications/preview'] = 'business_specifications/showprevw';
$route['master/klaim/klasifikasi_klaim'] = 'klasifikasi_klaim';
$route['master/klaim/jenis_klaim'] = 'jenis_klaim';
$route['master/klaim/status_klaim'] = 'status_klaim';
$route['master/klaim/tipe_klaim'] = 'tipe_klaim';
$route['master/indikator'] = 'indikator';
$route['master/data_karyawan'] = 'karyawan';
$route['master/coverage'] = 'coverage';
$route['master/data_nasabah'] = 'nasabah';
$route['master/direct'] = 'direct';
$route['master/agent'] = 'agent';
$route['master/lost_adjuster'] = 'lost_adjuster';
$route['master/business_partner'] = 'business_partner';
$route['master/data_asuransi'] = 'asuransi';
$route['master/wilayah'] = 'wilayah';
$route['master/tipe_as'] = 'tipe_as';
$route['master/kategori_as'] = 'kategori_as';

//wilayah
$route['master/negara'] = 'negara';
$route['master/provinsi'] = 'provinsi';
$route['master/kota'] = 'kota';

// Transaction module
$route['transaction/incoming/entry'] = 'entry_sppa';
