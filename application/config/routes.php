<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'welcome';
$route['(?i)signup/failed'] = 'userManagement/accessAccount/signup';
$route['(?i)signup'] = 'userManagement/accessAccount/signup';
$route['(?i)login/failed'] = 'userManagement/accessAccount/login';
$route['(?i)login'] = 'userManagement/accessAccount/login';
// $route['(?i)uploadcontent'] = 'userManagement/profile/uploadContent';
$route['(:any)'] = 'userManagement/profile/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
