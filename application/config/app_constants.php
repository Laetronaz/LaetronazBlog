<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Project Specifics Constants
|--------------------------------------------------------------------------
|
| Those constant are added and maintained my the project maintener to uses
| In diverses places in the code, those contain the application CONTROLLER FUNCTIONS,ROUTES,
| VIEWS PATH with their corresponding string.
| 
|
*/

//====================================FUNCTIONS=====================================
//INDEX
defined('ROLES_INDEX_FUNC') OR define('ROLES_INDEX_FUNC','roles/index');
defined('POSTS_ALLINDEX_FUNC') OR define('POSTS_ALLINDEX_FUNC','posts/all_index');
defined('LOGS_INDEX_FUNC') OR define('LOGS_INDEX_FUNC','logs/index');
defined('LOGS_INDEX_USERS_FUNC') OR define('LOGS_INDEX_USERS_FUNC','logs/index_users');
defined('LOGS_INDEX_CATEGORIES_FUNC') OR define('LOGS_INDEX_CATEGORIES_FUNC','logs/index_categories');
defined('LOGS_INDEX_ROLES_FUNC') OR define('LOGS_INDEX_ROLES_FUNC','logs/index_roles');
defined('LOGS_INDEX_POSTS_FUNC') OR define('LOGS_INDEX_POSTS_FUNC','logs/index_posts');
defined('LOGS_INDEX_TAGS_FUNC') OR define('LOGS_INDEX_TAGS_FUNC','logs/index_tags');
//VIEW
defined('TAGS_VIEW_FUNC') OR define('TAGS_VIEW_FUNC', 'tags/view/$1');
defined('ROLES_VIEW_FUNC') OR define('ROLES_VIEW_FUNC','roles/view/$1');
//FILTER
defined('TAGS_FILTER_FUNC') OR define('TAGS_FILTER_FUNC','tags/filter');
defined('CATEGORIES_FILTER_FUNC') OR define('CATEGORIES_FILTER_FUNC','categories/filter');
defined('USERS_FILTER_FUNC') OR define('USERS_FILTER_FUNC','users/filter');
//POSTS
defined('USERS_POSTS_FUNC') OR define('USERS_POSTS_FUNC','users/posts/$1');
//CREATE
defined('ROLES_CREATE_FUNC') OR define('ROLES_CREATE_FUNC','roles/create');
//EDIT
defined('ROLES_EDIT_FUNC') OR define('ROLES_EDIT_FUNC','roles/edit/$1');
defined('USERNAME_EDIT_FUNC') OR define('USERNAME_EDIT_FUNC','users/change_username/$1');
defined('EMAIL_EDIT_FUNC') OR define('EMAIL_EDIT_FUNC','users/change_email/$1');
//DELETE
defined('ROLES_DELETE_FUNC') OR define('ROLES_DELETE_FUNC','roles/delete/$1');
//SEARCH
defined('SEARCH_FUNC') OR define('SEARCH_FUNC','searchs/search');

//====================================ROUTES=====================================

//INDEX
defined('ROLES_INDEX_ROUTE') OR define('ROLES_INDEX_ROUTE','roles');
defined('POSTS_ALLINDEX_ROUTE') OR define('POSTS_ALLINDEX_ROUTE','posts/all');
defined('LOGS_INDEX_ROUTE') OR define('LOGS_INDEX_ROUTE','logs');
defined('LOGS_INDEX_USERS_ROUTE') OR define('LOGS_INDEX_USERS_ROUTE','logs/users');
defined('LOGS_INDEX_CATEGORIES_ROUTE') OR define('LOGS_INDEX_CATEGORIES_ROUTE','logs/categories');
defined('LOGS_INDEX_ROLES_ROUTE') OR define('LOGS_INDEX_ROLES_ROUTE','logs/roles');
defined('LOGS_INDEX_POSTS_ROUTE') OR define('LOGS_INDEX_POSTS_ROUTE','logs/posts');
defined('LOGS_INDEX_TAGS_ROUTE') OR define('LOGS_INDEX_TAGS_ROUTE','logs/tags');
//VIEW
defined('TAGS_VIEW_ROUTE') OR define('TAGS_VIEW_ROUTE','tags/(:any)');
defined('ROLES_VIEW_ROUTE') OR define('ROLES_VIEW_ROUTE','roles/view/(:any)');
//FILTER
defined('TAGS_FILTER_ROUTE') OR define('TAGS_FILTER_ROUTE','tags/filter');
defined('CATEGORIES_FILTER_ROUTE') OR define('CATEGORIES_FILTER_ROUTE','categories/filter');
defined('USERS_FILTER_ROUTE') OR define('USERS_FILTER_ROUTE','users/filter');
//POSTS
defined('USERS_POSTS_ROUTE') OR define('USERS_POSTS_ROUTE','users/posts/(:any)');
//CREATE
defined('ROLES_CREATE_ROUTE') OR define('ROLES_CREATE_ROUTE','roles/create');
//EDIT
defined('ROLES_EDIT_ROUTE') OR define('ROLES_EDIT_ROUTE','roles/edit/(:any)');
defined('USERNAME_EDIT_ROUTE') OR define('USERNAME_EDIT_ROUTE','users/change-username/(:any)');
defined('EMAIL_EDIT_ROUTE') OR define('EMAIL_EDIT_ROUTE','users/change-email/(:any)');
//DELETE
defined('ROLES_DELETE_ROUTE') OR define('ROLES_DELETE_ROUTE','roles/delete/(:any)');
//SEARCH
defined('SEARCH_ROUTE') OR define('SEARCH_ROUTE','search');

//====================================PATHS=====================================

//INDEX
defined('CATEGORIES_INDEX_PATH') OR define('CATEGORIES_INDEX_PATH', 'categories');
defined('ROLES_INDEX_PATH') OR define('ROLES_INDEX_PATH','roles');
defined('POSTS_INDEX_PATH') OR define('POSTS_INDEX_PATH','');
defined('POSTS_ALLINDEX_PATH') OR define('POSTS_ALLINDEX_PATH','posts/all');
defined('LOGS_INDEX_PATH') OR define('LOGS_INDEX_PATH','logs');
defined('LOGS_INDEX_USERS_PATH') OR define('LOGS_INDEX_USERS_PATH','logs/users');
defined('LOGS_INDEX_CATEGORIES_PATH') OR define('LOGS_INDEX_CATEGORIES_PATH','logs/categories');
defined('LOGS_INDEX_ROLES_PATH') OR define('LOGS_INDEX_ROLES_PATH','logs/roles');
defined('LOGS_INDEX_POSTS_PATH') OR define('LOGS_INDEX_POSTS_PATH','logs/posts');
defined('LOGS_INDEX_TAGS_PATH') OR define('LOGS_INDEX_TAGS_PATH','logs/tags');
//VIEW
defined('TAGS_VIEW_PATH') OR define('TAGS_VIEW_PATH', 'tags/view');
defined('ROLES_VIEW_PATH') OR define('ROLES_VIEW_PATH','roles/view/');
//FILTERS
defined('TAGS_FILTER_PATH') OR define('TAGS_FILTER_PATH','tags/filter');
defined('CATEGORIES_FILTER_PATH') OR define('CATEGORIES_FILTER_PATH','categories/filter');
defined('USERS_FILTER_PATH') OR define('USERS_FILTER_PATH','users/filter');
//POSTS
defined('CATEGORIES_POSTS_PATH') OR define('CATEGORIES_POSTS_PATH','categories/posts/');
defined('TAGS_POSTS_PATH') OR define('TAGS_POSTS_PATH','tags/');
defined('USERS_POSTS_PATH') OR define('USERS_POSTS_PATH','users/posts/');
//CREATE
defined('ROLES_CREATE_PATH') OR define('ROLES_CREATE_PATH','roles/create');
defined('POSTS_CREATE_PATH') OR define('POSTS_CREATE_PATH','posts/create');
defined('CATEGORIES_CREATE_PATH') OR define('CATEGORIES_CREATE_PATH','categories/create');
//EDIT
defined('ROLES_EDIT_PATH') OR define('ROLES_EDIT_PATH','roles/edit/');
defined('USERS_EDIT_PATH') OR define('USERS_EDIT_PATH','users/edit/');
defined('POSTS_EDIT_PATH') OR define('POSTS_EDIT_PATH','posts/edit/');


//DELETE
defined('ROLES_DELETE_PATH') OR define('ROLES_DELETE_PATH','roles/delete/');
//TOGGLE
defined('POSTS_TOGGLE_PATH') OR define('POSTS_TOGGLE_PATH','posts/toggle/');
//SEARCH
defined('SEARCH_PATH') OR define('SEARCH_PATH','searchs/search');


//LOGIN
defined('USERS_LOGIN_PATH') OR define('USERS_LOGIN_PATH','users/login');
//REGISTER
defined('USERS_REGISTER_PATH') OR define('USERS_REGISTER_PATH','users/register');

//====================================LOGS LEVELS=====================================

//used codes for the RAT library
defined('USERS_LEVEL') OR define('USERS_LEVEL', 0);
defined('ROLES_LEVEL') OR define('ROLES_LEVEL', 1);
defined('POSTS_LEVEL') OR define('POSTS_LEVEL', 2);
defined('CATEGORIES_LEVEL') OR define('CATEGORIES_LEVEL', 3);
defined('TAGS_LEVEL') OR define('TAGS_LEVEL', 4);



//====================================FUNCTIONS VIEWS===============================
defined('LOGS_INDEX_VIEW') OR define('LOGS_INDEX_VIEW','logs/index');