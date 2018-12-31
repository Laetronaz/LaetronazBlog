<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Access_control {
        private const IMAGE_PATH = 'logged_in';
        
        
        //ROLES 
        private const ADMIN = 'admin'; 
        private const MANAGE_CATEGORIES = 'manage categories';
        private const MANAGE_OWN_POSTS = 'manage own posts';
        private const MANAGE_ALL_POSTS = 'manage all posts';
        private const MANAGE_USERS = 'manage users';
        private const MANAGE_ROLES = 'manage roles';
        private const CONSULT_LOGS = 'consult logs';
        
        protected $CI;
        
        public function __construct(){
                $this->CI =& get_instance();
                $this->CI->load->library('session');
                $this->CI->load->model('message_model');
        }
        
        private function can_manage_categories(){
                if($this->is_logged()){
                        if($this->is_admin()){
                                return TRUE;
                        }
                        else if(array_search($this::MANAGE_CATEGORIES,array_column($this->CI->session->userdata('rights'),'name')) !== FALSE){
                                return TRUE;
                        }
                }
                return FALSE;
        }
        
        private function can_manage_own_posts(){
                if($this->is_admin()){
                        return TRUE;
                }
                else if(array_search($this::MANAGE_OWN_POSTS,array_column($this->CI->session->userdata('rights'),'name')) !== FALSE){
                        return TRUE;
                }
                return FALSE;
        }
        
        private function can_manage_all_posts(){
                if($this->is_admin()){
                        return TRUE;
                }
                else if(array_search($this::MANAGE_ALL_POSTS,array_column($this->CI->session->userdata('rights'),'name')) !== FALSE){
                        return TRUE;
                }
                return FALSE;
                
        }
        
        private function can_manage_users(){
                if($this->is_admin()){
                        return TRUE;
                }
                else if(array_search($this::MANAGE_USERS,array_column($this->CI->session->userdata('rights'),'name')) !== FALSE){
                        return TRUE;
                }
                return FALSE;
        }
        
        private function can_manage_roles(){
                
                if($this->is_admin()){
                        return TRUE;
                }
                else if(array_search($this::MANAGE_ROLES,array_column($this->CI->session->userdata('rights'),'name')) !== FALSE){
                        return TRUE;
                }
                return FALSE;
        }

        private function can_consult_logs(){
                if($this->is_admin()){
                        return TRUE;
                }
                elseif(array_search($this::CONSULT_LOGS,array_column($this->CI->session->userdata('rights'),'name')) !== FALSE){

                }
                return FALSE;
        }
        
        private function is_admin(){
                if(array_search($this::ADMIN,array_column($this->CI->session->userdata('rights'),'name')) === FALSE){
                        return FALSE;
                }
                return TRUE;
        }
        
        private function is_logged(){
                if(!$this->CI->session->userdata('logged_in')){
                        return FALSE;
                }
                return TRUE;
        }
        
        public function verify_access_users(){
                if($this->is_logged()){
                        if(!$this->can_manage_users()){
                                $message = $this->CI->message_model->get_message('access_refused');
                                $this->CI->session->set_flashdata($message['name'], $message);
                                redirect(USERS_FILTER_PATH);
                        }
                }
                else{
                        $message = $this->CI->message_model->get_message('not_logged_in');
                        $this->CI->session->set_flashdata($message['name'], $message);
                        redirect(USERS_LOGIN_PATH);
                }
        }
        
        public function verify_access_roles(){
                if($this->is_logged()){
                        if(!$this->can_manage_roles()){
                                $message = $this->CI->message_model->get_message('access_refused');
                                $this->CI->session->set_flashdata($message['name'], $message);
                                redirect(POSTS_INDEX_PATH);
                        }
                        //do nothing
                }
                else{
                        $message = $this->CI->message_model->get_message('not_logged_in');
                        $this->CI->session->set_flashdata($message['name'], $message);
                        redirect(USERS_LOGIN_PATH);
                }
        }
        
        public function verify_access_categories(){
                if($this->is_logged()){
                        if(!$this->can_manage_categories()){
                                $message = $this->CI->message_model->get_message('access_refused');
                                $this->CI->session->set_flashdata($message['name'], $message);
                                redirect(CATEGORIES_FILTER_PATH);
                        }
                }
                else{
                        $message = $this->CI->message_model->get_message('not_logged_in');
                        $this->CI->session->set_flashdata($message['name'], $message);
                        redirect(USERS_LOGIN_PATH);
                }
        }
        
        public function verify_access_posts($method_name){
                if($this->is_logged()){
                        switch ($method_name) {
                                case "user_index" :
                                case 'create' :
                                        if(!$this->can_manage_own_posts() && !$this->can_manage_all_posts()){
                                                $message = $this->CI->message_model->get_message('access_refused');
                                                $this->CI->session->set_flashdata($message['name'], $message);
                                                redirect(POSTS_INDEX_PATH);
                                        }
                                        break;
                                case "all_index" :
                                        if(!$this->can_manage_all_posts()){
                                                $message = $this->CI->message_model->get_message('access_refused');
                                                $this->CI->session->set_flashdata($message['name'], $message);
                                                redirect(POSTS_INDEX_PATH);
                                        }
                                        break;
                                default:
                                        if(!($this->can_manage_own_posts() && $this->CI->input->post('user_id') == $this->CI->session->userdata('user_id')) && !$this->can_manage_all_posts()){
                                                $message = $this->CI->message_model->get_message('access_refused');
                                                $this->CI->session->set_flashdata($message['name'], $message);
                                                redirect(POSTS_INDEX_PATH);
                                        }
                                        break;
                        }
                }
                else{
                        $message = $this->CI->message_model->get_message('not_logged_in');
                        $this->CI->session->set_flashdata($message['name'], $message);
                        redirect(USERS_LOGIN_PATH);
                } 
        }

        public function verify_access_logs(){
                if($this->is_logged()){
                        if(!$this->can_consult_logs()){
                                $message = $this->CI->message_model->get_message('access_refused');
                                $this->CI->session->set_flashdata($message['name'], $message);
                                redirect(POSTS_INDEX_PATH);
                        }
                }
                else{
                        $message = $this->CI->message_model->get_message('not_logged_in');
                        $this->CI->session->set_flashdata($message['name'], $message);
                        redirect(USERS_LOGIN_PATH);
                }
        }
        
}
