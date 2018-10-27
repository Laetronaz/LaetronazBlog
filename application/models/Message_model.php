<?php
    class Message_model extends CI_Model{
        public function __construct(){
            $this->load->database();
        }
        //get all the message from the DB
        public function get_messages(){
            $this->db->order_by('type');
            $query = $this->db->get('messages');
            return $query->result_array();
        }
        //Get Specific message from DB
        public function get_message($message_name){
            $query = $this->db->get_where('messages', array('name'=> $message_name));
            return $query->row_array();
        }
        //Get the Unauthorized access Message from the DB
        //This message is used a lot in the code so it has it's own function
        public function get_unauthorized_access(){
            $message_name = 'unautorized_access';
            $query = $this->db->get_where('messages', array('name'=> $message_name));
            return $query->row_array();
        }
    }