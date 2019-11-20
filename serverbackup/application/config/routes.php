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
|	http://codeigniter.com/user_guide/general/routing.html
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

$route['default_controller'] = 'front';
$route['fantasy-login'] = 'frontPrediction/flogin';
$route['fantasy-signup'] = 'frontPrediction/fsignup';
$route['fantasy-profile/(:any)'] = 'frontPrediction/profile/$1';
$route['fantasy-profile-update'] = 'frontPrediction/profile_update';
$route['fantasy-logout'] = 'frontPrediction/logout';
$route['fantasy-auction'] = 'frontPrediction/auction';
$route['fantasy-forgot-password'] = 'frontPrediction/forgotPassword';
$route['fantasy-verify-account'] = 'frontPrediction/verifyuser';
$route['fantasy-reset-password/(:any)'] = 'frontPrediction/resetPassword/$1';
$route['site/authSiteAdmin'] = "pwfpanel/login";
$route['site/authVendorLogin'] = "pwfpanel/vendorLogin";
$route['fantasy-otp-process'] = 'frontPrediction/verifyOptProcess';
$route['fantasy-welcome'] = 'frontPrediction/welcome';
$route['fantasy-player-auction'] = 'frontPrediction/playerAuction';
$route['fantasy-player-auction/(:any)'] = 'frontPrediction/playerAuction/$1';
$route['fantasy-player-auction/(:any)/(:any)'] = 'frontPrediction/playerAuction/$1/$2';
$route['fantasy-my-prediction'] = 'frontPrediction/myAuction';
$route['fantasy-my-prediction/(:any)'] = 'frontPrediction/myAuction/$1';
$route['fantasy-my-prediction/(:any)/(:any)'] = 'frontPrediction/myAuction/$1/$2';
$route['fantasy-leaderboard'] = 'frontPrediction/leaderboard';
$route['fantasy-leaderboard/(:any)'] = 'frontPrediction/leaderboard/$1';
$route['fantasy-feed'] = 'frontPrediction/newsFeed';
$route['fantasy-account'] = 'frontPrediction/myAccount';
$route['fantasy-account/(:any)'] = 'frontPrediction/myAccount/$1';
$route['fantasy-account/(:any)/(:any)'] = 'frontPrediction/myAccount/$1/$2';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
