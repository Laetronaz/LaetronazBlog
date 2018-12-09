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

//VIEW
defined('TAGS_VIEW_FUNC') OR define('TAGS_VIEW_FUNC', 'tags/view/$1');
//FILTER
defined('TAGS_FILTER_FUNC') OR define('TAGS_FILTER_FUNC','tags/filter');
defined('CATEGORIES_FILTER_FUNC') OR define('CATEGORIES_FILTER_FUNC','categories/filter');
defined('USERS_FILTER_FUNC') OR define('USERS_FILTER_FUNC','users/filter');
//POSTS
defined('USERS_POSTS_FUNC') OR define('USERS_POSTS_FUNC','users/posts/$1');


//====================================ROUTES=====================================

//INDEX

//VIEW
defined('TAGS_VIEW_ROUTE') OR define('TAGS_VIEW_ROUTE','tags/(:any)');

//FILTER
defined('TAGS_FILTER_ROUTE') OR define('TAGS_FILTER_ROUTE','tags/filter');
defined('CATEGORIES_FILTER_ROUTE') OR define('CATEGORIES_FILTER_ROUTE','categories/filter');
defined('USERS_FILTER_ROUTE') OR define('USERS_FILTER_ROUTE','users/filter');
//POSTS
defined('USERS_POSTS_ROUTE') OR define('USERS_POSTS_ROUTE','users/posts/(:any)');

//====================================PATHS=====================================

//VIEW
defined('TAGS_VIEW_PATH') OR define('TAGS_VIEW_PATH', 'tags/view');

//INDEX
defined('CATEGORIES_INDEX_PATH') OR define('CATEGORIES_INDEX_PATH', 'categories');


//POSTS
defined('CATEGORIES_POSTS_PATH') OR define('CATEGORIES_POSTS_PATH','categories/posts/');
defined('TAGS_POSTS_PATH') OR define('TAGS_POSTS_PATH','tags/');
defined('USERS_POSTS_PATH') OR define('USERS_POSTS_PATH','users/posts/');

//FILTERS
defined('TAGS_FILTER_PATH') OR define('TAGS_FILTER_PATH','tags/filter');
defined('CATEGORIES_FILTER_PATH') OR define('CATEGORIES_FILTER_PATH','categories/filter');
defined('USERS_FILTER_PATH') OR define('USERS_FILTER_PATH','users/filter');