<?php
    class Const_model extends CI_Model{
       //REDIRECT PATH CONST 
        public const LOGIN = '';
        public const POSTS = '';
        public const HEADER = 'templates/header';
        public const FOOTER = 'templates/footer';

        //POSTS PATH CONST
        public const POSTS_INDEX = 'posts/index';
        public const POSTS_USER_INDEX = '/posts/userindex';
        public const POSTS_VIEW = 'posts/view';
        public const POSTS_CREATE = 'posts/create';
        public const POSTS_EDIT = 'posts/edit';
        public const POSTS_PATH = 'posts';

        //CATEGORIES PATH CONST
        public const CATEGORIES = 'categories';
        public const CATEGORIES_INDEX = 'categories/index';
        public const CATEGORIES_CREATE = 'categories/create';
        public const CATEGORIES_EDIT = 'categories/edit';

        //USERS PATH CONST
        public const USERS = 'users';
        public const USERS_INDEX = 'users/index';
        public const USERS_LOGIN = 'users/login';
        public const USERS_LOGOUT = 'users/logout';
        public const USERS_REGISTER = 'users/register';
        public const USERS_EDIT = 'users/edit';
        public const USERS_VIEW = 'users/view';
        public const USERS_FORGOTTEN_PASSWORD = 'users/forgotpassword';
        public const USERS_CHANGE_PASSWORD = 'users/resetpassword';
        public const USERS_VALIDATE_EMAIL = 'users/verifyemail';
        public const PASSWORD_TOKEN_EXPIRED = 'users/password-expired';
        public const VALIDATION_TOKEN_EXPIRED = 'users/validation-expired';

        public const WEBSITE_NAME = 'Laetronaz Blog';

        //PAGES PATH CONST
        public const PAGES = 'pages/';

        //EMAIL PATH CONST
        public const EMAIL = 'email/sendEmail';
        public const VERIFICATION_EMAIL = 'assets/emails/verify_email.html';
        
    }