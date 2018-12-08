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

//CONTROLLERS FUNCTIONS 
defined('TAGS_INDEX_FUNC') OR define('TAGS_INDEX_FUNC','tags/index');
defined('TAGS_VIEW_FUNC') OR define('TAGS_VIEW_FUNC', 'tags/view/$1');

//ROUTE used to name the route
defined('TAGS_INDEX_ROUTE') OR define('TAGS_INDEX_ROUTE','tags');
defined('TAGS_VIEW_ROUTE') OR define('TAGS_VIEW_ROUTE','tag/(:any)');

//PATH used in the views or controller to redirect or access differents pages
defined('TAGS_INDEX_PATH') OR define('TAGS_INDEX_PATH','tags/index');
defined('TAGS_VIEW_PATH') OR define('TAGS_VIEW_PATH', 'tags/view');
defined('CATEGORIES_INDEX_PATH') OR define('CATEGORIES_INDEX_PATH', 'categories');