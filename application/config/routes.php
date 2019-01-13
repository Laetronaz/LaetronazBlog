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

$route['default_controller'] = POSTS_INDEX_ROUTE;

//posts
$route[POSTS_USERINDEX_ROUTE] = POSTS_USERINDEX_FUNC;
$route[POSTS_ALLINDEX_ROUTE] = POSTS_ALLINDEX_FUNC;
$route[POSTS_CREATE_ROUTE] = POSTS_CREATE_FUNC;
$route[POSTS_VIEW_ROUTE] = POSTS_VIEW_FUNC;
$route[POSTS_UPDATE_IMAGE_ROUTE] = POSTS_UPDATE_IMAGE_FUNC;
$route[POSTS_TOGGLE_ROUTE] = POSTS_TOGGLE_FUNC;
$route[POSTS_EDIT_ROUTE] = POSTS_EDIT_FUNC;
$route[POSTS_INDEX_ROUTE] = POSTS_INDEX_FUNC;

//categories
$route[CATEGORIES_CREATE_ROUTE] = CATEGORIES_CREATE_FUNC;
$route[CATEGORIES_EDIT_ROUTE] = CATEGORIES_EDIT_FUNC;
$route[CATEGORIES_FILTER_ROUTE] = CATEGORIES_FILTER_FUNC;
$route[CATEGORIES_POSTS_ROUTE] = CATEGORIES_POSTS_FUNC;
$route[CATEGORIES_TOGGLE_ROUTE] = CATEGORIES_TOGGLE_FUNC;
$route[CATEGORIES_UPDATE_IMAGE_ROUTE] = CATEGORIES_UPDATE_IMAGE_FUNC;
$route[CATEGORIES_INDEX_PATH] = CATEGORIES_INDEX_FUNC;

//tags
$route[TAGS_FILTER_ROUTE] = TAGS_FILTER_FUNC;
$route[TAGS_VIEW_ROUTE] = TAGS_VIEW_FUNC;

//roles
$route[ROLES_CREATE_ROUTE] = ROLES_CREATE_FUNC;
$route[ROLES_EDIT_ROUTE] = ROLES_EDIT_FUNC;  
$route[ROLES_DELETE_ROUTE] = ROLES_DELETE_FUNC;
$route[ROLES_INDEX_ROUTE] = ROLES_INDEX_FUNC;

//users
$route[USERS_REGISTER_ROUTE] = USERS_REGISTER_FUNC;
$route[USERS_LOGOUT_ROUTE] = USERS_LOGOUT_FUNC;
$route[USERS_LOGIN_ROUTE] = USERS_LOGIN_FUNC;
$route[USERS_TOGGLE_ROUTE] = USERS_TOGGLE_FUNC;
$route[USERS_VIEW_ROUTE] = USERS_VIEW_FUNC;
$route[USERS_EDIT_ROUTE] = USERS_EDIT_FUNC;
$route[USERS_UPDATE_USERNAME_ROUTE] = USERS_UPDATE_USERNAME_FUNC;
$route[USERS_UPDATE_EMAIL_ROUTE] = USERS_UPDATE_EMAIL_FUNC;
$route[USERS_UPDATE_PASSWORD_ROUTE] = USERS_UPDATE_PASSWORD_FUNC;
$route[USERS_CHANGE_PASSWORD_ROUTE] = USERS_CHANGE_PASSWORD_FUNC;
$route[USERS_FILTER_ROUTE] = USERS_FILTER_FUNC;
$route[USERS_POSTS_ROUTE] = USERS_POSTS_FUNC;
$route[USERS_INDEX_ROUTE] = USERS_INDEX_FUNC;

//search
$route[SEARCH_ROUTE] = SEARCH_FUNC;

//logs
$route[LOGS_INDEX_ROUTE] = LOGS_INDEX_FUNC;
$route[LOGS_INDEX_USERS_ROUTE] = LOGS_INDEX_USERS_FUNC;
$route[LOGS_INDEX_ROLES_ROUTE] = LOGS_INDEX_ROLES_FUNC;
$route[LOGS_INDEX_CATEGORIES_ROUTE] = LOGS_INDEX_CATEGORIES_FUNC;
$route[LOGS_INDEX_POSTS_ROUTE] = LOGS_INDEX_POSTS_FUNC;
$route[LOGS_INDEX_TAGS_ROUTE] = LOGS_INDEX_TAGS_FUNC;

//Mail function links
$route[EMAIL_RESET_PASSWORD_ROUTE] = EMAIL_RESET_PASSWORD_FUNC;
$route[EMAIL_CONFiRM_EMAIL_ROUTE] = EMAIL_CONFiRM_EMAIL_FUNC;
$route[EMAIL_RESEND_RESET_CONFIRM_EMAIL_ROUTE] = EMAIL_RESEND_RESET_CONFIRM_EMAIL_FUNC;
$route[EMAIL_RESEND_RESET_PASSWORD_ROUTE] = EMAIL_RESEND_RESET_PASSWORD_FUNC;

$route['404_override'] = '';
$route['(:any)'] = 'pages/view/$1';
$route['translate_uri_dashes'] = FALSE;