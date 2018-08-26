<?php
    class Admin_model extends CI_Model{
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
    }