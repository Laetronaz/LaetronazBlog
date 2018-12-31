<?php
    class Logs extends CI_Controller{
        private const INDEX_TITLE = "Application Logs";

        public function index(){
            //check user access
            $this->load->library('access_control');
            $this->access_control->verify_access_logs();
 
             $data['title'] = $this::INDEX_TITLE;
             $this->load->library('rat');
             $data['logs'] = $this->rat->get_log($user_id = NULL, $code = NULL, $date = NULL, $order_by = NULL, $limit = NULL);

             $this->load->view($this->const_model::HEADER);
             $this->load->view(LOGS_INDEX_VIEW, $data);
             $this->load->view($this->const_model::FOOTER);
         }

         public function index_users(){
            //check user access
            $this->load->library('access_control');
            $this->access_control->verify_access_logs();
 
             $data['title'] = $this::INDEX_TITLE;
             $this->load->library('rat');
             $data['logs'] = $this->rat->get_log($user_id = NULL, USERS_LEVEL, $date = NULL, $order_by = NULL, $limit = NULL);

             $this->load->view($this->const_model::HEADER);
             $this->load->view(LOGS_INDEX_VIEW, $data);
             $this->load->view($this->const_model::FOOTER);
         }

         public function index_categories(){
            //check user access
            $this->load->library('access_control');
            $this->access_control->verify_access_logs();
 
             $data['title'] = $this::INDEX_TITLE;
             $this->load->library('rat');
             $data['logs'] = $this->rat->get_log($user_id = NULL, CATEGORIES_LEVEL, $date = NULL, $order_by = NULL, $limit = NULL);

             $this->load->view($this->const_model::HEADER);
             $this->load->view(LOGS_INDEX_VIEW, $data);
             $this->load->view($this->const_model::FOOTER);
         }

         public function index_roles(){
            //check user access
            $this->load->library('access_control');
            $this->access_control->verify_access_logs();
 
             $data['title'] = $this::INDEX_TITLE;
             $this->load->library('rat');
             $data['logs'] = $this->rat->get_log($user_id = NULL, ROLES_LEVEL, $date = NULL, $order_by = NULL, $limit = NULL);

             $this->load->view($this->const_model::HEADER);
             $this->load->view(LOGS_INDEX_VIEW, $data);
             $this->load->view($this->const_model::FOOTER);
         }

         public function index_posts(){
            //check user access
            $this->load->library('access_control');
            $this->access_control->verify_access_logs();
 
             $data['title'] = $this::INDEX_TITLE;
             $this->load->library('rat');
             $data['logs'] = $this->rat->get_log($user_id = NULL, POSTS_LEVEL, $date = NULL, $order_by = NULL, $limit = NULL);

             $this->load->view($this->const_model::HEADER);
             $this->load->view(LOGS_INDEX_VIEW, $data);
             $this->load->view($this->const_model::FOOTER);
         }

         public function index_tags(){
            //check user access
            $this->load->library('access_control');
            $this->access_control->verify_access_logs();
 
             $data['title'] = $this::INDEX_TITLE;
             $this->load->library('rat');
             $data['logs'] = $this->rat->get_log($user_id = NULL, TAGS_LEVEL, $date = NULL, $order_by = NULL, $limit = NULL);

             $this->load->view($this->const_model::HEADER);
             $this->load->view(LOGS_INDEX_VIEW, $data);
             $this->load->view($this->const_model::FOOTER);
         }
    }