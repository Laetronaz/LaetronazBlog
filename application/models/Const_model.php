<?php
    class Const_model extends CI_Model{
       //REDIRECT PATH CONST 
        public const LOGIN = '';
        public const POSTS = '';
        public const HEADER = 'templates/header';
        public const FOOTER = 'templates/footer';

        //POSTS PATH CONST
        public const POSTS_INDEX = 'posts/index';
        public const POSTS_VIEW = 'posts/view';
        public const POSTS_CREATE = 'posts/create';
        public const POSTS_EDIT = 'posts/edit';
        public const POSTS_PATH = 'posts';

        //USERS PATH CONST
        public const USERS_LOGIN = 'users/login';
        public const USER_REGISTER = 'users/register';

        //CATEGORIES PATH CONST
        public const CATEGORIES = 'categories';
        public const CATEGORIES_INDEX = 'categories/index';
        public const CATEGORIES_CREATE = 'categories/create';
        public const CATEGORIES_EDIT = 'categories/edit';

        //PAGES PATH CONST
        public const PAGES = 'pages/';
        
    }