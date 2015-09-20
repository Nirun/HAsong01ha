<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "home";
$route['404_override'] = '';

$route['member/login'] = 'register/user/member_login';//member login
$route['member/logout'] = 'register/user/member_logout';//member login
$route['member/index'] = 'register/user/member_index';//member login
$route['member/forgot'] = 'register/user/member_forgot';//member forgot
$route['member/change'] = 'register/user/change_name';
$route['member/doc'] = 'register/user/member_doc';
$route['member/change_save'] = 'register/user/change_save';
$route['member/forgot/send'] = 'register/user/member_forgot_send';//
$route['member/apply'] = 'register/user/apply';//
$route['member/main'] = 'register/user/apply_main';
$route['member/detail'] = 'register/user/apply_detail';
$route['member/course/(:any)'] = 'register/user/apply_course_view/$1';
$route['member/course_detail/(:any)'] = 'register/user/apply_course_detail/$1';
$route['member/course_result'] = 'register/user/apply_course_result';
$route['member/course_receipt/(:any)'] = 'register/user/apply_course_receipt/$1';
$route['member/course_remove/(:any)'] = 'register/user/apply_course_remove/$1';
$route['member/save_edit'] = 'register/user/apply_save_edit';
$route['member/popup_payment/(:any)'] = 'register/user/popup_payment/$1';
$route['member/popup_reserve'] = 'register/user/popup_reserve';
$route['member/popup_reserve/(:any)'] = 'register/user/popup_reserve/$1'; // new reserve
$route['member/mail'] = 'register/user/apply_mail';
$route['member/mail/view/(:any)'] = 'register/user/apply_mail_view/$1';
$route['member/mail/delete/(:any)'] = 'register/user/apply_mail_delete/$1';
$route['member/apply/save'] = 'register/user/apply_save';
$route['member/register/save'] = 'register/user/register_save';
$route['member/register/paid'] = 'register/user/register_paid';
$route['member/register/exists'] = 'register/user/register_exists';


$route['register/user'] = "register/user/index"; // trainees
$route['register/user/(:any)'] = "register/user/$1";
$route['register/confirm/queue/(:any)'] = "register/user/confirm_queue/$1"; // confirm Queue

$route['register/admin'] = "register/admin/index"; // admin
$route['register/admin/(:any)'] = "register/admin/$1";

$route['register/mail'] = "register/mail/index"; // mail
$route['register/mail/(:any)'] = "register/mail/$1";

$route['register/course'] = "register/course/index"; // course
$route['register/course/(:any)'] = "register/course/$1";

$route['register/nametag'] = "register/nametag/index";// tag
$route['register/nametag/(:any)'] = "register/nametag/$1";

$route['register/certificate'] = "register/certificate/index";//certificate
$route['register/certificate/(:any)'] = "register/certificate/$1";

$route['register/payment'] = "register/payment/index";//payment
$route['register/payment/(:any)'] = "register/payment/$1";

$route['register/reports'] = "register/reports/index"; //report
$route['register/reports/(:any)'] = "register/reports/$1";

$route['register'] = "register/main";
$route['register/(:any)'] = "register/main/$1";

$route['search'] = "search/index";
$route['search/(:any)'] = "search/index/$1";

// update 2014
$route['manage/cert'] = "register/certificate/get_template";
$route['manage/nametag'] = "register/certificate/get_template_nametag";
$route['manage/cert/save'] = "register/certificate/save_tp";
$route['manage/nametag/save'] = "register/certificate/save_tp_nametag";
$route['report/filter/course/(:any)'] = "register/reports/filter/course/$1";
$route['member/register/remind_waiting'] = 'register/user/getRemindEmail';

/* End of file routes.php */
/* Location: ./application/config/routes.php */