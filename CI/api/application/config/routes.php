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
$route['default_controller'] = 'notice';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// $route['v5/member_used'] = 'member_used';

/*
| -------------------------------------------------------------------------
| Sample REST API Routes
| -------------------------------------------------------------------------
*/
//$route['(:any)/(:any)/(:any)/(:any)'] = '$1/$2/$3/id/$4'; // Example 4
// $route['v1/example/users/(:num)(\.)([a-zA-Z0-9_-]+)(.*)'] = 'v1/example/users/id/$1/format/$3$4'; // Example 8


// $route["vi/members/used/(:any)"] = "v1/members/used/index/type/$1";
// $route['v1/members/used/(:num)'] = 'v1/members/used/index/id/$1'; // Example 4
// $route['v1/members/used/(:num)(\/)([a-zA-Z0-9_-]+)'] = 'v1/members/used/id/$1$2date$2$3'; // Example 4
// $route['v1/members/used/(:num)(\/)([a-zA-Z0-9_-]+)(\.)([a-zA-Z0-9_-]+)(.*)'] = 'v1/member_used/index/id/$1$2date$2$3/format/$5$6'; // Example 8

/*
$route['v1/([a-z]+)/([a-z]+)/'] = 'v1/$1_$2/index/'; // Example 4
$route['v1/([a-z]+)/([a-z]+)/(:any)/(:any)/(:any)'] = 'v1/$1_$2/index/type/$3/date/$4/id/$5'; // Example 4
$route['v1/([a-z]+)/([a-z]+)/(:any)/(:any)/(:any)(\.)([a-zA-Z0-9_-]+)(.*)'] = 'v1/member_used/index/type/$1/date/$2/id/$3/format/$4$5'; // Example 4
*/


// $route['v1/example/users/(:num)'] = 'v1/example/users/id/$1'; // Example 4
// $route['v1/example/users/(:num)(\.)([a-zA-Z0-9_-]+)(.*)'] = 'v1/example/users/id/$1/format/$3$4'; // Example 8
// $route['member_used/used/(:any)/(:any)'] = 'member_used/used/id/$1/date/$2'; // Example 4
// $route['v5/member_used/used/(:any)/(:any)'] = 'member_used/used/id/$1/date/$2'; // Example 4

/*
$route['v5/(:any)'] = '$1'; // Example 4
$route['v5/(:any)/(:any)'] = '$1/$2'; // Example 4
$route['v5/(:any)/(:any)/(:any)/(:any)'] = 'v5/$1/$2/id/$3/date/$4'; // Example 4

$route['example/v1/users/(:num)'] = 'example/v1/users/index/id/$1'; // Example 4

*/
