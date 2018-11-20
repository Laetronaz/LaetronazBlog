<?php
    class Tag_model extends CI_Model{
        public function __construct(){
            $this->load->database();
        }

        public function get_tags_list(){
            $query = $this->db->get('tags');
            return $query->result_array();
        }

        public function create_tag($tag_title){
            $data = array(
                'title' => $tag_title
            );
            return $this->db->insert('tags', $data);
        }

        public function link_post_to_tag($post_id, $tag_id){
            $data = array(
                'post_id' => $post_id,
                'tag_id' => $tag_id
            );
            return $this->db->insert('tagpost',$data);
        }

        public function unlink_post_from_tag($post_id, $tag_id){
            $data = array(
                'post_id' => $post_id,
                'tag_id' => $tag_id
            );
            $this->db->delete('tagpost',$data);
        }

        public function get_tag_by_title($title){
            $query = $this->db->get_where('tags', array('title'=> $title));
            return $query->row_array();
        }

        public function get_tag($id){
            $query = $this->db->get_where('tags', array('id'=> $id));
            return $query->row_array();
        }
        
        public function get_relationship($post_id, $tag_id){
            $data = array(
                'post_id' => $post_id,
                'tag_id' => $tag_id
            );
            $query = $this->db->get_where('tagpost', $data);
            return $query->row_array();
        }

        public function get_relationships($post_id){
            $data = array(
                'post_id' => $post_id
            );
            $query = $this->db->get_where('tagpost', $data);
            return $query->result_array();
        }

        public function get_post_tags($id){
            $data = array(
                'post_id' =>$id
            );
            $query = $this->db->get_where('tagpost',$data);
            return $query->result_array();
        }
    }