<?php
    class User_model extends CI_Model {
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
    }
    