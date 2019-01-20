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
defined('CATEGORIES_INDEX_FUNC') OR define('CATEGORIES_INDEX_FUNC', 'categories/index');
defined('ROLES_INDEX_FUNC') OR define('ROLES_INDEX_FUNC','roles/index');
defined('USERS_INDEX_FUNC') OR define('USERS_INDEX_FUNC','users/index');
defined('POSTS_INDEX_FUNC') OR define('POSTS_INDEX_FUNC','posts/index');
defined('POSTS_PAGINATION_INDEX_FUNC') OR define('POSTS_PAGINATION_INDEX_FUNC','posts/index/$1');
defined('POSTS_USERINDEX_FUNC') OR define('POSTS_USERINDEX_FUNC','posts/user_index');
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
defined('USERS_VIEW_FUNC') OR define('USERS_VIEW_FUNC','users/view/$1');
defined('POSTS_VIEW_FUNC') OR define('POSTS_VIEW_FUNC','posts/view/$1');
//FILTER
defined('TAGS_FILTER_FUNC') OR define('TAGS_FILTER_FUNC','tags/filter');
defined('CATEGORIES_FILTER_FUNC') OR define('CATEGORIES_FILTER_FUNC','categories/filter');
defined('USERS_FILTER_FUNC') OR define('USERS_FILTER_FUNC','users/filter');
//POSTS
defined('USERS_POSTS_FUNC') OR define('USERS_POSTS_FUNC','users/posts/$1');
defined('CATEGORIES_POSTS_FUNC') OR define('CATEGORIES_POSTS_FUNC','categories/posts/$1');
//CREATE
defined('ROLES_CREATE_FUNC') OR define('ROLES_CREATE_FUNC','roles/create');
defined('POSTS_CREATE_FUNC') OR define('POSTS_CREATE_FUNC','posts/create');
defined('CATEGORIES_CREATE_FUNC') OR define('CATEGORIES_CREATE_FUNC','categories/create');
//EDIT
defined('ROLES_EDIT_FUNC') OR define('ROLES_EDIT_FUNC','roles/edit/$1');
defined('CATEGORIES_EDIT_FUNC') OR define('CATEGORIES_EDIT_FUNC','categories/edit/$1');
defined('USERS_EDIT_FUNC') OR define('USERS_EDIT_FUNC','users/edit/$1');
defined('USERS_CHANGE_PASSWORD_FUNC') OR define('USERS_CHANGE_PASSWORD_FUNC','users/change_password_form/$1');
defined('POSTS_EDIT_FUNC') OR define('POSTS_EDIT_FUNC','posts/edit/$1');
//UPDATE IMAGE
defined('CATEGORIES_UPDATE_IMAGE_FUNC') OR define('CATEGORIES_UPDATE_IMAGE_FUNC','categories/update_image/$1');
defined('POSTS_UPDATE_IMAGE_FUNC') OR define('POSTS_UPDATE_IMAGE_FUNC','posts/update_image/$1');
//UPDATE VARIABLE
defined('USERS_UPDATE_USERNAME_FUNC') OR define('USERS_UPDATE_USERNAME_FUNC','users/change_username/$1');
defined('USERS_UPDATE_EMAIL_FUNC') OR define('USERS_UPDATE_EMAIL_FUNC','users/change_email/$1');
defined('USERS_UPDATE_PASSWORD_FUNC') OR define('USERS_UPDATE_PASSWORD_FUNC','users/change_password/$1');
//DELETE
defined('ROLES_DELETE_FUNC') OR define('ROLES_DELETE_FUNC','roles/delete/$1');
//TOGGLE
defined('CATEGORIES_TOGGLE_FUNC') OR define('CATEGORIES_TOGGLE_FUNC','categories/toggle/$1');
defined('POSTS_TOGGLE_FUNC') OR define('POSTS_TOGGLE_FUNC','posts/toggle/$1');
defined('USERS_TOGGLE_FUNC') OR define('USERS_TOGGLE_FUNC','users/toggle/$1');
//SEARCH
defined('SEARCH_FUNC') OR define('SEARCH_FUNC','searchs/search');
//LOGIN
defined('USERS_LOGIN_FUNC') OR define('USERS_LOGIN_FUNC','users/login');
//LOGOUT
defined('USERS_LOGOUT_FUNC') OR define('USERS_LOGOUT_FUNC','users/logout');
//REGISTER
defined('USERS_REGISTER_FUNC') OR define('USERS_REGISTER_FUNC','users/register');
//MAILS
defined('EMAIL_PASSWORD_RESET_FUNC') OR define('EMAIL_PASSWORD_RESET_FUNC','users/request_password_reset');
defined('EMAIL_CONFiRM_EMAIL_FUNC') OR define('EMAIL_CONFiRM_EMAIL_FUNC','users/confirm_email/$1');
defined('EMAIL_RESET_PASSWORD_FUNC') OR define('EMAIL_RESET_PASSWORD_FUNC','users/change_password_form/$1');
defined('EMAIL_RESEND_RESET_PASSWORD_FUNC') OR define('EMAIL_RESEND_RESET_PASSWORD_FUNC','users/resend_password_recovery_email/$1');
defined('EMAIL_RESEND_RESET_CONFIRM_EMAIL_FUNC') OR define('EMAIL_RESEND_RESET_CONFIRM_EMAIL_FUNC','users/resend_verification_email/$1');
//OTHERS
defined('ABOUT_FUNC') OR define('ABOUT_FUNC','/pages/view/about');
//====================================ROUTES=====================================
//INDEX
defined('CATEGORIES_INDEX_ROUTE') OR define('CATEGORIES_INDEX_ROUTE', 'categories');
defined('ROLES_INDEX_ROUTE') OR define('ROLES_INDEX_ROUTE','roles');
defined('POSTS_INDEX_ROUTE') OR define('POSTS_INDEX_ROUTE','posts');
defined('POSTS_PAGINATION_INDEX_ROUTE') OR define('POSTS_PAGINATION_INDEX_ROUTE','posts/index/(:any)');
defined('USERS_INDEX_ROUTE') OR define('USERS_INDEX_ROUTE','users');
defined('POSTS_USERINDEX_ROUTE') OR define('POSTS_USERINDEX_ROUTE','posts/me');
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
defined('USERS_VIEW_ROUTE') OR define('USERS_VIEW_ROUTE','users/view/(:any)');
defined('POSTS_VIEW_ROUTE') OR define('POSTS_VIEW_ROUTE','posts/view/(:any)');
//FILTER
defined('TAGS_FILTER_ROUTE') OR define('TAGS_FILTER_ROUTE','tags/filter');
defined('CATEGORIES_FILTER_ROUTE') OR define('CATEGORIES_FILTER_ROUTE','categories/filter');
defined('USERS_FILTER_ROUTE') OR define('USERS_FILTER_ROUTE','users/filter');
//POSTS
defined('USERS_POSTS_ROUTE') OR define('USERS_POSTS_ROUTE','users/posts/(:any)');
defined('CATEGORIES_POSTS_ROUTE') OR define('CATEGORIES_POSTS_ROUTE','categories/posts/(:any)');
//CREATE
defined('ROLES_CREATE_ROUTE') OR define('ROLES_CREATE_ROUTE','roles/create');
defined('POSTS_CREATE_ROUTE') OR define('POSTS_CREATE_ROUTE','posts/create');
defined('CATEGORIES_CREATE_ROUTE') OR define('CATEGORIES_CREATE_ROUTE','categories/create');
//EDIT
defined('ROLES_EDIT_ROUTE') OR define('ROLES_EDIT_ROUTE','roles/edit/(:any)');
defined('CATEGORIES_EDIT_ROUTE') OR define('CATEGORIES_EDIT_ROUTE','categories/edit/(:any)');
defined('USERS_EDIT_ROUTE') OR define('USERS_EDIT_ROUTE','users/edit/(:any)');
defined('POSTS_EDIT_ROUTE') OR define('POSTS_EDIT_ROUTE','posts/edit/(:any)');
defined('USERS_CHANGE_PASSWORD_ROUTE') OR define('USERS_CHANGE_PASSWORD_ROUTE','users/change_password_form/(:any)');
//UPDATE IMAGE
defined('POSTS_UPDATE_IMAGE_ROUTE') OR define('POSTS_UPDATE_IMAGE_ROUTE','posts/update_image/(:any)');
defined('CATEGORIES_UPDATE_IMAGE_ROUTE') OR define('CATEGORIES_UPDATE_IMAGE_ROUTE','categories/update_image/(:any)');
//UPDATE VARIABLE
defined('USERS_UPDATE_USERNAME_ROUTE') OR define('USERS_UPDATE_USERNAME_ROUTE','users/change-username/(:any)');
defined('USERS_UPDATE_EMAIL_ROUTE') OR define('USERS_UPDATE_EMAIL_ROUTE','users/change-email/(:any)');
defined('USERS_UPDATE_PASSWORD_ROUTE') OR define('USERS_UPDATE_PASSWORD_ROUTE','users/change-password/(:any)');
//DELETE
defined('ROLES_DELETE_ROUTE') OR define('ROLES_DELETE_ROUTE','roles/delete/(:any)');
//TOGGLE
defined('CATEGORIES_TOGGLE_ROUTE') OR define('CATEGORIES_TOGGLE_ROUTE','categories/toggle/(:any)');
defined('POSTS_TOGGLE_ROUTE') OR define('POSTS_TOGGLE_ROUTE','posts/toggle/(:any)');
defined('USERS_TOGGLE_ROUTE') OR define('USERS_TOGGLE_ROUTE','users/toggle/(:any)');
//SEARCH
defined('SEARCH_ROUTE') OR define('SEARCH_ROUTE','search');
//LOGIN
defined('USERS_LOGIN_ROUTE') OR define('USERS_LOGIN_ROUTE','users/login');
//LOGOUT
defined('USERS_LOGOUT_ROUTE') OR define('USERS_LOGOUT_ROUTE','users/logout');
//REGISTER
defined('USERS_REGISTER_ROUTE') OR define('USERS_REGISTER_ROUTE','users/register');
//MAILS

defined('EMAIL_PASSWORD_RESET_ROUTE') OR define('EMAIL_PASSWORD_RESET_ROUTE','users/password-reset');
defined('EMAIL_CONFiRM_EMAIL_ROUTE') OR define('EMAIL_CONFiRM_EMAIL_ROUTE','users/verifyemail/(:any)');
defined('EMAIL_RESET_PASSWORD_ROUTE') OR define('EMAIL_RESET_PASSWORD_ROUTE','users/resetpassword/(:any)');
defined('EMAIL_RESEND_RESET_PASSWORD_ROUTE') OR define('EMAIL_RESEND_RESET_PASSWORD_ROUTE','users/resend_password/(:any)');
defined('EMAIL_RESEND_RESET_CONFIRM_EMAIL_ROUTE') OR define('EMAIL_RESEND_RESET_CONFIRM_EMAIL_ROUTE','users/resendverification/(:any)');
//OTHERS
defined('ABOUT_ROUTE') OR define('ABOUT_ROUTE','about');
//====================================PATHS=====================================
//INDEX
defined('CATEGORIES_INDEX_PATH') OR define('CATEGORIES_INDEX_PATH', 'categories');
defined('ROLES_INDEX_PATH') OR define('ROLES_INDEX_PATH','roles');
defined('USERS_INDEX_PATH') OR define('USERS_INDEX_PATH','users');
defined('POSTS_INDEX_PATH') OR define('POSTS_INDEX_PATH','');
defined('POSTS_PAGINATION_INDEX_PATH') OR define('POSTS_PAGINATION_INDEX_PATH','/');
defined('POSTS_USERINDEX_PATH') OR define('POSTS_USERINDEX_PATH','posts/me');
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
defined('USERS_VIEW_PATH') OR define('USERS_VIEW_PATH','users/view/');
defined('POSTS_VIEW_PATH') OR define('POSTS_VIEW_PATH','posts/view/');
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
defined('CATEGORIES_EDIT_PATH') OR define('CATEGORIES_EDIT_PATH','categories/edit/');
defined('USERS_EDIT_PATH') OR define('USERS_EDIT_PATH','users/edit/');
defined('USERS_CHANGE_PASSWORD_PATH') OR define('USERS_CHANGE_PASSWORD_PATH','users/change_password_form/');
//UPDATE_IMAGE
defined('CATEGORIES_UPDATE_IMAGE_PATH') OR define('CATEGORIES_UPDATE_IMAGE_PATH','categories/update_image/');
defined('POSTS_UPDATE_IMAGE_PATH') OR define('POSTS_UPDATE_IMAGE_PATH','posts/update_image/');
//UPDATE VARIABLE
defined('USERS_UPDATE_USERNAME_PATH') OR define('USERS_UPDATE_USERNAME_PATH','users/change-username/');
defined('USERS_UPDATE_EMAIL_PATH') OR define('USERS_UPDATE_EMAIL_PATH','users/change-email/');
defined('USERS_UPDATE_PASSWORD_PATH') OR define('USERS_UPDATE_PASSWORD_PATH','users/change-password/');
//DELETE
defined('ROLES_DELETE_PATH') OR define('ROLES_DELETE_PATH','roles/delete/');
//TOGGLE
defined('POSTS_TOGGLE_PATH') OR define('POSTS_TOGGLE_PATH','posts/toggle/');
defined('CATEGORIES_TOGGLE_PATH') OR define('CATEGORIES_TOGGLE_PATH','categories/toggle/');
defined('USERS_TOGGLE_PATH') OR define('USERS_TOGGLE_PATH','users/toggle/');
//SEARCH
defined('SEARCH_PATH') OR define('SEARCH_PATH','searchs/search');
//LOGIN
defined('USERS_LOGIN_PATH') OR define('USERS_LOGIN_PATH','users/login');
//LOGOUT
defined('USERS_LOGOUT_PATH') OR define('USERS_LOGOUT_PATH','users/logout');
//REGISTER
defined('USERS_REGISTER_PATH') OR define('USERS_REGISTER_PATH','users/register');
//MAILS
defined('EMAIL_PASSWORD_RESET_PATH') OR define('EMAIL_PASSWORD_RESET_PATH','users/password-reset');
defined('EMAIL_CONFiRM_EMAIL_PATH') OR define('EMAIL_CONFiRM_EMAIL_PATH','users/verifyemail/');
defined('EMAIL_RESET_PASSWORD_PATH') OR define('EMAIL_RESET_PASSWORD_PATH','users/resetpassword/');
defined('EMAIL_RESEND_RESET_CONFIRM_EMAIL_PATH') OR define('EMAIL_RESEND_RESET_CONFIRM_EMAIL_PATH','users/resendverification/');
defined('EMAIL_RESEND_RESET_PASSWORD_PATH') OR define('EMAIL_RESEND_RESET_PASSWORD_PATH','users/resend_password/');
defined('EMAIL_SENDER_NAME') OR define('EMAIL_SENDER_NAME','Laetronaz Automatic MailSender');
//OTHERS 
defined('ABOUT_PATH') OR define('ABOUT_PATH','about');


//====================================LOGS LEVELS=====================================

//used codes for the RAT library
defined('USERS_LEVEL') OR define('USERS_LEVEL', 0);
defined('ROLES_LEVEL') OR define('ROLES_LEVEL', 1);
defined('POSTS_LEVEL') OR define('POSTS_LEVEL', 2);
defined('CATEGORIES_LEVEL') OR define('CATEGORIES_LEVEL', 3);
defined('TAGS_LEVEL') OR define('TAGS_LEVEL', 4);
defined('SYSTEM_LEVEL') OR define('SYSTEM_LEVEL', 5);

//====================================WEBSITE CONSTANTS=====================================
defined('WEBSITE_NAME') OR define('WEBSITE_NAME', 'Laetronaz Blog');

//====================================FUNCTIONS VIEWS===============================
defined('LOGS_INDEX_VIEW') OR define('LOGS_INDEX_VIEW','logs/index');

defined('CATEGORIES_INDEX_VIEW') OR define('CATEGORIES_INDEX_VIEW','categories/index');
defined('CATEGORIES_CREATE_VIEW') OR define('CATEGORIES_CREATE_VIEW','categories/create');
defined('CATEGORIES_EDIT_VIEW') OR define('CATEGORIES_EDIT_VIEW','categories/edit');
defined('CATEGORIES_FILTER_VIEW') OR define('CATEGORIES_FILTER_VIEW','categories/filter');

defined('PAGES_VIEW') OR define('PAGES_VIEW','pages/');

defined('ROLES_INDEX_VIEW') OR define('ROLES_INDEX_VIEW','roles/index');

defined('TAGS_FILTER_VIEW') OR define('TAGS_FILTER_VIEW','tags/filter');
defined('TAGS_VIEW') OR define('TAGS_VIEW','tags/view');

defined('POSTS_INDEX_VIEW') OR define('POSTS_INDEX_VIEW','posts/index');
defined('POSTS_CREATE_VIEW') OR define('POSTS_CREATE_VIEW','posts/create');
defined('POSTS_EDIT_VIEW') OR define('POSTS_EDIT_VIEW','posts/edit');
defined('POSTS_USERINDEX_VIEW') OR define('POSTS_USERINDEX_VIEW','posts/userindex');
defined('POSTS_VIEW') OR define('POSTS_VIEW','posts/view');

defined('USERS_INDEX_VIEW') OR define('USERS_INDEX_VIEW','users/index');
defined('USERS_EDIT_VIEW') OR define('USERS_EDIT_VIEW','users/edit');
defined('USERS_FILTER_VIEW') OR define('USERS_FILTER_VIEW','users/filter');
defined('USERS_FORGOTPASSWORD_VIEW') OR define('USERS_FORGOTPASSWORD_VIEW','users/forgotpassword');
defined('USERS_LOGIN_VIEW') OR define('USERS_LOGIN_VIEW','users/login');
defined('USERS_REGISTER_VIEW') OR define('USERS_REGISTER_VIEW','users/register');
defined('USERS_RESETPASSWORD_VIEW') OR define('USERS_RESETPASSWORD_VIEW','users/resetpassword');
defined('USERS_VIEW') OR define('USERS_VIEW','users/view');

//TEMPLATES
defined('TEMPLATE_HEADER_VIEW') OR define('TEMPLATE_HEADER_VIEW','templates/header');
defined('TEMPLATE_FOOTER_VIEW') OR define('TEMPLATE_FOOTER_VIEW','templates/footer');

//STATES
defined('STATE_ACTIVE') OR define('STATE_ACTIVE','state-active');
defined('STATE_INACTIVE') OR define('STATE_INACTIVE','state-inactive');
defined('STATE_LOCKOUT') OR define('STATE_LOCKOUT','state-lockedout');
defined('STATE_WAITING') OR define('STATE_WAITING','state-waiting');

//ASSETS
defined('JAVASCRIPT_FOLDER') OR define('JAVASCRIPT_FOLDER','assets/javascript/');
defined('CSS_FOLDER') OR define('CSS_FOLDER','assets/css/');

defined('CATEGORIES_IMAGES_FOLDER') OR define('CATEGORIES_IMAGES_FOLDER','assets/images/categories/');
defined('POSTS_IMAGES_FOLDER') OR define('POSTS_IMAGES_FOLDER','assets/images/posts/');

defined('EMAILS_FOLDER') OR define('EMAILS_FOLDER','assets/emails/');
defined('VERIFY_EMAIL_TEMPLATE') OR define('VERIFY_EMAIL_TEMPLATE','verify_email.html');
defined('PASSWORD_RECOVERY_TEMPLATE') OR define('PASSWORD_RECOVERY_TEMPLATE','password_recovery.html');



defined('JS_IMAGEVIEWER') OR define('JS_IMAGEVIEWER','ImageViewer.js');
defined('JS_DISQUS') OR define('JS_DISQUS','disqus.js');
defined('JS_ROLES') OR define('JS_ROLES','roles.js');
defined('JS_FOOTER') OR define('JS_FOOTER','footer.js');
defined('CSS_TAGSINPUT') OR define('CSS_TAGSINPUT','tagsinput.css');
defined('JS_TAGSINPUT') OR define('JS_TAGSINPUT','tagsinput.js');
defined('CSS_DEFAULT_FONT') OR define('CSS_DEFAULT_FONT','defaultFont.css');
defined('CSS_LOGIN_FORM') OR define('CSS_LOGIN_FORM','loginForm.css');
defined('JS_LOGS') OR define('JS_LOGS','logs.js');
