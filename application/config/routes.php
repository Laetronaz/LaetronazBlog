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

$route['default_controller'] = 'posts';

$route['posts/index'] = 'posts/index';
$route['posts/userindex'] = 'posts/userindex';
$route['posts/update'] = 'posts/update';
$route['posts/update_image'] = 'posts/update_image';
$route['posts/create'] = 'posts/create';
//$route['posts/toggle'] = 'posts/toggle';
$route['posts'] = 'posts/index';
$route['posts/(:any)'] = 'posts/view/$1';

$route['categories/create'] = 'categories/create';
$route['categories/update'] = 'categories/update';
$route['categories/posts/(:any)'] = 'categories/posts/$1';
$route['categories'] = 'categories/index';

$route['subcategories'] = 'subcategories/index';
$route['subcategories/create'] = 'subcategories/create';
$route['subcategories/posts/(:any)'] = 'subcategories/posts/$1';

$route['users/register'] = 'users/register';
$route['users/update'] = 'users/update';
$route['users/change-password'] = 'users/change_password';
$route['users/change-password/(:any)'] = 'users/change_password/$1';
$route['users/logout'] = 'users/logout';
$route['users/login'] = 'users/login';
$route['users/edit'] = 'users/edit';
$route['users/password-reset'] = 'users/request_password_reset_form';
$route['users/password-expired'] = 'users/password_token_expired';
$route['users/validation-expired'] = 'users/validation_token_expired';
$route['users/requestpassword'] = 'users/forgotten_password';

//Mail function links
$route['users/resetpassword/(:any)'] = 'users/change_password_form/$1';
$route['users/verifyemail/(:any)'] = 'users/verify_email/$1';


$route['404_override'] = '';
$route['(:any)'] = 'pages/view/$1';
$route['translate_uri_dashes'] = FALSE;
