<?php
    class User_model extends CI_Model {
        public function register($enc_password){
            //user data array
            $data = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'username' => $this->input->post('username'),
                'password' => $enc_password,
                'zipcode' => $this->input->post('zipcode')
            );

            //insert user
            return $this->db->insert('users', $data);
        }

        public function login($username, $password){
            //Validate
            $this->db->where('username', $username);
            $result = $this->db->get('users');

            if($result->num_rows() == 1){
                //Verify the password currently : CRYPT_BLOWFISH
                if(password_verify($password, $result->row(0)->password)){
                    return $result->row(0)->id;
                }
                return false;
            }
            else{
                return false;
            }
        }
    }
    