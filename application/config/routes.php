<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'welcome';
$route['(?i)signup/failed'] = 'userManagement/accessAccount/signup';
$route['(?i)signup'] = 'userManagement/accessAccount/signup';
$route['(?i)login/failed'] = 'userManagement/accessAccount/login';
$route['(?i)login'] = 'userManagement/accessAccount/login';
$route['(?i)category/(:any)'] = 'contentManagement/getQuestions/questionForTopic/$1';
$route['questions/(:any)/(:num)/(:any)'] = 'contentManagement/getQuestions/ShowContents/$1/$2/$3';
$route['(:any)/myContents/UploadSuccess'] = 'userManagement/profile/userQuestionList';
$route['(:any)/myContents/editContent/(:any)/(:num)/(:any)'] = 'userManagement/profile/editContent/$2/$3/$4';
$route['(:any)/myContents'] = 'userManagement/profile/userQuestionList';
$route['(:any)/UploadFailed'] = 'userManagement/profile/dashboard';
$route['(:any)/dashboard'] = 'userManagement/profile/dashboard';
$route['(:any)'] = 'userManagement/profile/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
