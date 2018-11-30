<?php
    class Password_model extends CI_Model{
        public function __construct(){
            $this->load->database();
        }
        public function get_password_resquest_by_token($token){
            $query = $this->db->get_where('password_reset', array('token'=> $token));
            return $query->row_array();
            
        }
        public function create_password_request($token, $user_id){
            $data = array(
                'token' => $token,
                'creation_time' => date('Y-m-d H:i:s',time()),
                'expiration_time' => date('Y-m-d H:i:s', strtotime('+1 day', time())),
                'user_id' => $user_id
            );
            return $this->db->insert('password_reset', $data);
        }

        public function get_current_token($user_id){
            $where =  "TIMESTAMP('".date('Y-m-d H:i:s',time())."') BETWEEN creation_time AND expiration_time AND user_id = $user_id";
            $query = $this->db->where($where)->get('password_reset');
            return $query->row_array();
        }

        public function use_token($token){
            $data = array(
                'used'=> TRUE
            );
            $this->db->where('token', $token);
            return $this->db->update('password_reset', $data);
        }
    }