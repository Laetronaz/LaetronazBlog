<?php
    class Category_model extends CI_Model{
        public function __construct(){
            $this->load->database();
        }

        public function create_category($category_image){
            $data = array(
                'name' => $this->input->post('name'),
                'user_id' => $this->session->userdata('user_id'),
                'category_icon' => $category_image
            );
            return $this->db->insert('categories', $data);
        }

        public function get_categories(){
            $this->db->order_by('name');
            $query = $this->db->get('categories');
            return $query->result_array();
        }

        public function get_category($id){
            $query = $this->db->get_where('categories', array('id'=> $id));
            return $query->row_array();
        }

        public function update_category($category_image){
            $data = array();
            if(!is_null($category_image)){
                $data = array(
                    'name' => $this->input->post('name'),
                    'category_icon' => $category_image
                );
            }
            else{
                $data = array(
                    'name' => $this->input->post('name')
                );
            }
            
            $this->db->where('id', $this->input->post('id'));
            return $this->db->update('categories', $data);
        }

        public function toogle_category($id, $active){
            $active = ($active == 1 ? 0 : 1);
            $data = array(
                 'active' => $active 
            );       
            $this->db->where('id', $id);
            return $this->db->update('categories', $data);
        }
    }