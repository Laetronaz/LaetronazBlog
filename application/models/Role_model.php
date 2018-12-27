<?php
    class Role_model extends CI_Model{
        
        public function __construct(){
            $this->load->database();
        }

        public function get_role($id){
            $query = $this->db->get_where('roles', array('id'=> $id));
            return $query->row_array();
        }

        public function get_roles(){
            $query = $this->db->get('roles');
            $this->db->order_by("id", "asc");
            return $query->result_array();
        }

        public function update_role($id,$name){
            $data = array(
                'name' => $name 
           );       
           $this->db->where('id', $id);
           return $this->db->update('roles', $data);
        }

        public function delete_role($id){
            $data = array(
                'id' => $id,
            );
            return $this->db->delete('roles',$data);
        }

        public function create_role($name){
            $data = array(
                'name' => $name
            );
            $this->db->insert('roles', $data);
            return $this->db->insert_id();
        }

        public function get_right($id){
            $query = $this->db->get_where('right', array('id'=> $id));
            return $query->row_array();
        }

        public function get_rights_id($role_id){
            if(is_null($this->get_role($role_id))){
                return FALSE;
            }
            else{
                $data = array(
                    'role_id' => $role_id
                );
                $this->db->select('right_id');
                $query = $this->db->get_where('role_right',$data);
                return array_column($query->result_array(),'right_id');
            }
        }

        public function get_rights(){
            $query = $this->db->get('rights');
            $this->db->order_by("id", "asc");
            return $query->result_array();
        }

        public function get_role_rights($role_id){
            $id_array= $this->get_rights_id($role_id); 
            if(!empty($id_array)){
                $this->db->where_in("id",$id_array);
                $query =$this->db->get('rights');
                
                return $query->result_array();
            }
            return array();
        }

        public function add_role_rights($role_id, $right_id){
            $data = array(
                'role_id' => $role_id,
                'right_id' => $right_id
            );
            return $this->db->insert('role_right',$data);
        }

        public function remove_role_rights($role_id,$right_id){
            $data = array(
                'role_id' => $role_id,
                'right_id' => $right_id
            );
            return $this->db->delete('role_right',$data);
        }

        public function delete_role_rights($role_id){
            $data = array(
                'role_id' => $role_id
            );
            return $this->db->delete('role_right',$data);
        }
    }