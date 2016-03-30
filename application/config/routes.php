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
$route['default_controller'] = 'sellhouse';
$route['sellhouse/(:num)'] = 'sellhouse/index/$1';
$route['renthouse/(:num)'] = 'renthouse/index/$1';

$route['login'] = 'personal/login';
$route['login/(:any)'] = 'personal/login_$1';
$route['register'] = 'personal/register';
$route['register/(:any)'] = 'personal/register_$1';
$route['login_vercode'] = 'personal/login_vercode';
$route['register_vercode'] = 'personal/register_vercode';
$route['logout'] = 'personal/logout';

$route['other/(:any)/(:any)'] = 'other/$1_$2';
$route['other/(:any)/(:any)'] = 'other/$1_$2';
// $route['(.+)'] = 'welcome/redirect';



$route['admin/(:any)/(:any)'] = 'admin/$1_$2';
$route['adminuser/(:any)/(:any)'] = 'adminuser/$1_$2';
$route['adminhouse/(:any)/(:any)'] = 'adminhouse/$1_$2';
$route['admincommon/(:any)/(:any)'] = 'admincommon/$1_$2';
$route['admincommon/(:any)/(:any)/(:any)'] = 'admincommon/$1_$2_$3';


$route['q0p1w2o3e4i5r6u7t8y9_/(.+)'] = 'q0p1w2o3e4i5r6u7t8y9_';





$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
