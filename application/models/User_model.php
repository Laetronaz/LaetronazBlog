<?php
    class User_model extends CI_Model {
        public function __construct(){
            $this->load->database();
        }
        
        public function register($enc_password){
            //user data array
            $data = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'username' => $this->input->post('username'),
                'password' => $enc_password,
                'zipcode' => $this->input->post('zipcode'),
                'user_type' => $this->input->post('usertype')
            );
            //insert user
            return $this->db->insert('users', $data);
        }

        public function login($username){
            //Validate
            $this->db->where('username', $username);
            $result = $this->db->get('users');
            if($result->num_rows() == 1){
                $user_data = array(
                    'id' => $result->row(0)->id,
                    'password' => $result->row(0)->password,
                    'user_type' => $this->get_user_type($result->row(0)->user_type)
                );
                return $user_data;
            }
            else{
                return false;
            }
        }

        private function get_user_type($id){
            $this->db->where('id', $id);
            $result = $this->db->get('users_type');
            if($result->num_rows() == 1){
                return $result->row(0)->name;
            }
            else{
                return false;
            }
        }

        public function get_users_type(){
            $this->db->order_by('id');
            $query = $this->db->get('users_type');
            return $query->result_array();
        }

        public function get_users(){
            $this->db->order_by('id');
            $query = $this->db->get('users');
            return $query->result_array();
        }

        public function get_user($id){
            $query = $this->db->get_where('users', array('id'=> $id));
            return $query->row_array();
        }

        public function update_user(){
            $data = array(
                'name' => $this->input->post('name'),
                'zipcode' => $this->input->post('zipcode'),
                'email' => $this->input->post('email'),
                'username' => $this->input->post('username'),
                'user_type'=> $this->input->post('usertype')
            );
            $this->db->where('id', $this->input->post('id'));
            return $this->db->update('users', $data);
        }

        public function toggle_user($id, $active){
            $active = ($active == 1 ? 0 : 1);
            $data = array(
                 'active' => $active 
            );       
            $this->db->where('id', $id);
            return $this->db->update('users', $data);
        }

        public function update_password($crypted_password){
            $data = array(
                'password' => $crypted_password
            );
            $this->db->where('id', $this->input->post('id'));
            return $this->db->update('users', $data);
        }

        public function get_password($id){
            $this->db->select('password');
            $query = $this->db->get_where('users', array('id' => $id));
            return $query->row_array();
        }

    }
    