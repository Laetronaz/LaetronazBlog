<?php
    class Search_model extends CI_Model{
        public function __construct(){
            $this->load->database();
        }

        public function search_posts_titles($string){
            $this->db->order_by('created_at');
            $this->db->like('title', $string);
            $query = $this->db->get('posts');
            return $query->result_array();
        }

        public function search_categories_names($string){
            $this->db->order_by('name');
            $this->db->like('name', $string);
            $query = $this->db->get('categories');
            return $query->result_array();
        }

        public function search_tags_names($string){
            $this->db->order_by('title');
            $this->db->like('title', $string);
            $query = $this->db->get('tags');
            return $query->result_array();
        }

        public function search_users_usernames($string){
            $this->db->order_by('username');
            $this->db->like('username', $string);
            $query = $this->db->get('users');
            return $query->result_array();
        }
    }