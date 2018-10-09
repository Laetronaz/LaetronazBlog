<?php
    class Subcategory_model extends CI_Model{
        public function __construct(){
            $this->load->database();
        }

        public function get_subcategory($id){
            $query = $this->db->get_where('subcategories', array(
                'id' => $id
            ));
            return $query->row();
        }

        public function create_subcategory($subcategory_image){
            $data = array(
                'name' => $this->input->post('name'),
                'user_id' => $this->session->userdata('user_id'),
                'category_id' => $this->input->post('category_id'),
                'subcategory_icon' => $subcategory_image
            );
            return $this->db->insert('subcategories', $data);
        }

        public function get_subcategories(){
            $this->db->order_by('category_id');
            $query = $this->db->get('subcategories');
            return $query->result_array();
        }

        public function get_subcategories_by_categoryId($category_id){
            $this->db->order_by('name');
            $query = $this->db->get_where('subcategories', array(
                'category_id' => $category_id
            ));
            return $query->result_array();
        }
    }