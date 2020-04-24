<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'welcome';
$route['(?i)signup'] = 'userManagement/accessAccount/signup';
$route['(?i)login'] = 'userManagement/accessAccount/login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
