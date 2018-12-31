<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config = array(
    'category' => array(
            array(
                'field' => 'name',
                'label' => 'Category Name',
                'rules' => 'trim|required|min_length[3]|max_length[50]'
            )
    ),
    'post' => array(
            array(
                'field' => 'title',
                'label' => 'Post Title',
                'rules' => 'trim|alpha_numeric_spaces|min_length[3]|max_length[50]|required'
            ),
            array(
                'field' => 'body',
                'label' => 'Post Body',
                'rules' => 'trim|min_length[3]|required'
            ),
            array(
                'field' => 'category_id',
                'label' => 'Category',
                'rules' => 'trim|required|integer'
            ),
            array(
                'field' => 'tagsinput',
                'label' => 'Tag Field',
                'rules' => 'trim|min_length[3]'
            )
    ),
    'user_register' => array(
        array(
            'field' => 'first-name',
            'label' => 'First Name',
            'rules' => 'trim|required|max_length[255]'
        ),
        array(
            'field' => 'last-name',
            'label' => 'Last Name',
            'rules' => 'trim|required|max_length[255]'
        ),
        array(
            'field' => 'username',
            'label' => 'Username',
            'rules' => 'trim|required|is_unique[users.username]|min_length[5]|max_length[50]',
            'errors' => array('is_unique' => 'This username is already taken. Please choose a different one.')
        ),
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'trim|required|is_unique[users.email]|valid_email',
            'errors' => array('is_unique' => 'This email is already used. Please choose a different one.')
        ),
        array(
            'field' => 'usertype',
            'label' => 'User Rights',
            'rules' => 'trim|required|integer'
        ),
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'password2',
            'label' => 'Confirm password',
            'rules' => 'trim|required|matches[password]'
        )
    ),
    'user_edit' => array(
        array(
            'field' => 'first-name',
            'label' => 'First Name',
            'rules' => 'trim|required|max_length[255]'
        ),
        array(
            'field' => 'last-name',
            'label' => 'Last Name',
            'rules' => 'trim|required|max_length[255]'
        ),
        array(
            'field' => 'usertype',
            'label' => 'User Type',
            'rules' => 'trim|required|integer'
        )
    ),
    'login' => array(
        array(
            'field' => 'username',
            'label' => 'Username',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'trim|required'
        )
    ),
    'request_password' => array(
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'trim|required|valid_email'
        ),
    ),
    'password_reset' => array(
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'password2',
            'label' => 'Password Confirmation',
            'rules' => 'trim|required|matches[password]'
        )
    ),  
    'password_change' => array(
        array(
            'field' => 'new-password',
            'label' => 'Password',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'new-password2',
            'label' => 'Password Confirmation',
            'rules' => 'trim|required|matches[new-password]'
        )
    ),
    'username_change' => array(
        array(
            'field' => 'new-username',
            'label' => 'Username',
            'rules' => 'trim|required|is_unique[users.username]|min_length[5]|max_length[50]',
            'errors' => array('is_unique' => 'This username is already taken. Please choose a different one.')
        )
    ),
    'email_change' => array(
        array(
            'field' => 'new-email',
            'label' => 'Email',
            'rules' => 'trim|required|is_unique[users.email]|valid_email',
            'errors' => array('is_unique' => 'This email is already used. Please choose a different one.')
        )
    ),
    'search' => array(
        array(
            'field' => 'search',
            'label' => 'Search',
            'rules' => 'trim|required'
        )
    ),
    'role' => array(
        array(
            'field' => 'name',
            'label' => 'Role name',
            'rules' => 'trim|required|alpha|min_length[5]|max_length[50]'
        ),
        array(
            'field' => 'Admin',
            'label' => 'Admin Right',
            'rules' => 'trim|integer'
        ),
        array(
            'field' => 'manage_categories',
            'label' => 'Categories Management',
            'rules' => 'trim|integer'
        ),
        array(
            'field' => 'manage_own_posts',
            'label' => 'Personal Posts Management',
            'rules' => 'trim|integer'
        ),
        array(
            'field' => 'manage_users',
            'label' => 'Users Management',
            'rules' => 'trim|integer'
        ),
        array(
            'field' => 'manage_roles',
            'label' => 'Roles Management',
            'rules' => 'trim|integer'
        ),
        array(
            'field' => 'manage_all_posts',
            'label' => 'Posts Management',
            'rules' => 'trim|integer'
        )
    )
);