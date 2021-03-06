<?php
    class Post_model extends CI_Model{
        
        public function __construct(){
            $this->load->database();
        }

        public function get_posts($slug = FALSE, $limit = FALSE, $offset = FALSE){
            if($limit){
                $this->db->limit($limit, $offset);
            }
            if($slug === FALSE){
                $this->db->order_by('posts.id', 'DESC');
                $this->db->join('categories', 'categories.id = posts.category_id');
                $query = $this->db->get('posts');
                return $query->result_array();
            }

            $query = $this->db->get_where('posts', array('slug'=> $slug));
            return $query->row_array();
        }

        public function get_active_posts($slug = FALSE, $limit = FALSE, $offset = FALSE){
            if($limit){
                $this->db->limit($limit, $offset);
            }
            if($slug === FALSE){
                $this->db->order_by('posts.id', 'DESC');
                $this->db->join('categories', 'categories.id = posts.category_id');
                $query = $this->db->get_where('posts', array('state' => TRUE));
                return $query->result_array();
            }

            $query = $this->db->get_where('posts', array('slug'=> $slug));
            return $query->row_array();
        }

        public function get_post($id){
            $this->db->order_by('posts.created_at', 'ASC');
            $query = $this->db->get_where('posts', array('id'=> $id));
            return $query->row_array();
        }

        public function get_user_posts($id){
            $data = array(
                'user_id' => $id
            );
            $query = $this->db->get_where('posts', $data);
            return $query->result_array();
        }

        public function get_post_by_slug($slug){
            $query = $this->db->get_where('posts', array('slug'=> $slug));
            return $query->row_array();
        }

        public function get_posts_by_category($category_id){
            $this->db->order_by('posts.id', 'DESC');
            $this->db->join('categories', 'categories.id = posts.category_id');
            $query = $this->db->get_where('posts', array('category_id'=> $category_id));
            return $query->result_array();
        }

        public function get_posts_by_user($user_id){
            $this->db->order_by('posts.id', 'DESC');
            $this->db->join('users', 'users.id = posts.user_id');
            $this->db->join('categories', 'categories.id = posts.category_id');
            $query = $this->db->get_where('posts', array('posts.user_id'=> $user_id));
            return $query->result_array();
        }

        public function get_posts_by_tag($tag_id){
            $in_array = $this->tag_model->get_post_id($tag_id);
            if(!empty($in_array)){
                $this->db->select('*');
                $this->db->where_in("id",$in_array);
                $query =$this->db->get('posts');
                return $query->result_array();
            }
            else if($in_array === FALSE){
                return FALSE;
            }
            else
                return array();
        }

        public function create_post($post_image){
            $slug = url_title($this->input->post('title'));
            $data = array(
                'title' => $this->input->post('title'),
                'slug' => $slug,
                'body' => $this->input->post('body'),
                'category_id' => $this->input->post('category_id'),
                'user_id' => $this->session->userdata('user_id'),
                'post_image' => $post_image,
                
            );
            $this->db->insert('posts', $data);
            return $this->db->insert_id();
        }

        public function toogle_post($id, $state){
            $post = $this->post_model->get_post($id);
            
            $state = ($state == 1 ? 0 : 1);
            $data = array(
                 'state' => $state 
            );       
            $this->db->where('id', $id);
            return $this->db->update('posts', $data);
        }

        public function update_post(){
            $slug = url_title($this->input->post('title'));
            $data = array(
                'title' => $this->input->post('title'),
                'slug' => $slug,
                'body' => $this->input->post('body'),
                'category_id' => $this->input->post('category_id')
            );
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('posts', $data);
            return $slug;
        }

        public function update_post_image($post_id,$post_image){
            $data = array(
                'post_image' => $post_image
            );
            $this->db->where('id', $post_id);
            return $this->db->update('posts', $data);
        }

        public function get_categories(){
            $this->db->order_by('name');
            $query = $this->db->get('categories');
            return $query->result_array();
        }

        public function get_all_images(){
            $this->db->distinct('post_image');
            $this->db->select('post_image');
            $query = $this->db->get('posts');
            return $query->result_array();
        }
    }