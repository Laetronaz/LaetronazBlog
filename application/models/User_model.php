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
            $this->db->insert('users', $data);
            //return userid
            return $this->db->insert_id();
        }

        public function login($username){//TODO: rework the session data
            //Validate
            $this->db->where('username', $username);
            $result = $this->db->get('users');
            if($result->num_rows() == 1){
                $user_data = array(
                    'id' => $result->row(0)->id,
                    'password' => $result->row(0)->password,
                    'user_type' => $this->get_user_type($result->row(0)->user_type),
                    'user_state' => $result->row(0)->user_state
                );
                return $user_data;
            }
            else{
                return false;
            }
        }

        private function get_user_type($id){//TODO: get rid of this function
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

        public function get_users_states(){
            $query = $this->db->get('users_state');
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
            $active = ($active == 3 ? 4 : 3);
            $data = array(
                 'active' => $active 
            );       
            $this->db->where('id', $id);
            return $this->db->update('users', $data);
        }

        public function update_password($crypted_password,$id = -1){
            if($id == -1){
                $id = $this->input->post('id');
            }
            $data = array(
                'password' => $crypted_password
            );
            
            $this->db->where('id', $id);
            return $this->db->update('users', $data);
        }

        public function get_password($id){
            $this->db->select('password');
            $query = $this->db->get_where('users', array('id' => $id));
            return $query->row_array();
        }

        public function get_user_by_email(){
            $data = array('email'=>$this->input->post('email'));
            $query = $this->db->get_where('users',$data);
            return $query->row_array();
        }
        //=================================================USER VERIFICATION================================================
        public function create_verification_request($token, $user_id){
            $data = array(
                'token' => $token,
                'creation_time' => date('Y-m-d H:i:s',time()),
                'expiration_time' => date('Y-m-d H:i:s', strtotime('+1 day', time())),
                'user_id' => $user_id
            );
            return $this->db->insert('email_verification', $data);
        }

        public function get_verification_resquest($token){
            $query = $this->db->get_where('email_verification', array('token'=> $token));
            return $query->row_array();
            
        }

        public function get_current_token($user_id){
            $where =  "TIMESTAMP('".date('Y-m-d H:i:s',time())."') BETWEEN creation_time AND expiration_time AND user_id = $user_id";
            $query = $this->db->where($where)->get('email_verification');
            return $query->row_array();
        }

        public function set_user_active($user_id){
            $data = array(
                'user_state'=> 3
            );
            $this->db->where('id', $user_id);
            return $this->db->update('users', $data);
        }
    }
    