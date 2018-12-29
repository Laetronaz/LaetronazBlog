<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logs_builder {
    protected $CI;
    //USERS
    private const USER_REGISTER_LOG = "$1 has registered a new user '$2' with user id: $3";
    private const USER_EDIT_LOG = "$1 has edited user '$2' with user id: $3";
    private const USER_TOGGLE_LOG = "$1 has toggled user '$2' with user id: $3 from state '$4' to state '$5'";
    private const USERNAME_CHANGE_LOG = "$1 has changed username from '$2' to '$3' of user '$4' with user id: $5.";
    private const EMAIL_CHANGE_LOG = "$1 has changed email from '$2' to '$3' of user '$4' with user id: $5.";  
    private const PASSWORD_CHANGE_LOG = "$1 has changed password of user '$2' with user id: $3.";
    private const CONFIRM_EMAIL_LOG = "$1 with user id: $2 has confirm his email.";  
    private const RESEND_CONFIRM_EMAIL_LOG = "$1 with user id: $2 requested a new confirmation email.";  
    private const PASSWORD_RECOVERY_LOG = "$1 with user id: $2 requested a password recovery.";
    private const RESEND_PASSWORD_RECOVERY_LOG = "$1 with user id: $2 requested a new password recovery email.";  
    //CATEGORIES
    //POSTS
    //TAGS
    //ROLES

    public function __construct(){
        $this->CI =& get_instance();
        $this->CI->load->library('session');
    }
    //==============================================USERS===================================
    public function user_register_logging($new_user_id){
        //DATAS NEEDED
        $registerd_user = $this->CI->user_model->get_user($new_user_id);
        $active_user = $this->CI->user_model->get_user($this->CI->session->userdata('user_id'));
        //BUILDING THE MESSAGE
        $log_entry = $this::USER_REGISTER_LOG;
        $log_entry = str_replace('$1', $active_user['username'],$log_entry);
        $log_entry = str_replace('$2', $registerd_user['username'],$log_entry);
        $log_entry = str_replace('$3', $registerd_user['id'],$log_entry);
        return $log_entry;
    }

    public function user_edit_logging($edited_user_id){
        //DATAS NEEDED
        $edited_user = $this->CI->user_model->get_user($edited_user_id);
        $active_user = $this->CI->user_model->get_user($this->CI->session->userdata('user_id'));
        //BUILDING THE MESSAGE
        $log_entry = $this::USER_EDIT_LOG;
        $log_entry = str_replace('$1', $active_user['username'],$log_entry);
        $log_entry = str_replace('$2', $edited_user['username'],$log_entry);
        $log_entry = str_replace('$3', $edited_user['id'],$log_entry);
        return $log_entry;
    }

    public function user_toggle_logging($modified_user_id,$former_state_id){
        //IMPORTS NEEDED
        $this->CI->load->model('user_model');
        //DATAS NEEDED
        $modified_user = $this->CI->user_model->get_user($modified_user_id);
        $active_user = $this->CI->user_model->get_user($this->CI->session->userdata('user_id'));
        $previous_state = $this->CI->user_model->get_user_state($former_state_id);
        $new_state = $this->CI->user_model->get_user_state($modified_user['user_state']);
        //BUILDING THE MESSAGE
        $log_entry = $this::USER_TOGGLE_LOG;
        $log_entry = str_replace('$1', $active_user['username'],$log_entry);
        $log_entry = str_replace('$2', $modified_user['username'],$log_entry);
        $log_entry = str_replace('$3', $modified_user['id'],$log_entry);
        $log_entry = str_replace('$4', $previous_state,$log_entry);
        $log_entry = str_replace('$5', $new_state,$log_entry);
        return $log_entry;
    }

    public function username_change_logging($edited_user_id,$previous_username,$new_username){
        //DATAS NEEDED
        $edited_user = $this->CI->user_model->get_user($edited_user_id);
        $active_user = $this->CI->user_model->get_user($this->CI->session->userdata('user_id'));
        //BUILDING THE MESSAGE
        $log_entry = $this::USERNAME_CHANGE_LOG;
        $log_entry = str_replace('$1', $active_user['username'],$log_entry);
        $log_entry = str_replace('$2', $previous_username,$log_entry);
        $log_entry = str_replace('$3', $new_username,$log_entry);
        $log_entry = str_replace('$4', $edited_user['username'],$log_entry);
        $log_entry = str_replace('$5', $edited_user_id,$log_entry);
        return $log_entry;
    }

    public function email_change_logging($edited_user_id, $previous_email, $new_email){
        //DATAS NEEDED
        $edited_user = $this->CI->user_model->get_user($edited_user_id);
        $active_user = $this->CI->user_model->get_user($this->CI->session->userdata('user_id'));
        //BUILDING THE MESSAGE
        $log_entry = $this::EMAIL_CHANGE_LOG;
        $log_entry = str_replace('$1', $active_user['username'],$log_entry);
        $log_entry = str_replace('$4', $edited_user['username'],$log_entry);
        $log_entry = str_replace('$5', $edited_user_id,$log_entry);
        return $log_entry;
    }

    public function password_change_logging($edited_user_id){
        //DATAS NEEDED
        $edited_user = $this->CI->user_model->get_user($edited_user_id);
        $active_user = $this->CI->user_model->get_user($this->CI->session->userdata('user_id'));
        //BUILDING THE MESSAGE
        $log_entry = $this::PASSWORD_CHANGE_LOG;
        $log_entry = str_replace('$1', $active_user['username'],$log_entry);
        $log_entry = str_replace('$2', $edited_user['username'],$log_entry);
        $log_entry = str_replace('$5', $edited_user_id,$log_entry);
        return $log_entry;
    }

    public function email_confirmed_logging($user_id){
        //DATAS NEEDED
        $edited_user = $this->CI->user_model->get_user($user_id);
        //BUILDING THE MESSAGE
        $log_entry = $this::CONFIRM_EMAIL_LOG;
        $log_entry = str_replace('$1', $active_user['username'],$log_entry);
        $log_entry = str_replace('$2', $user_id,$log_entry);
        return $log_entry;
    }

    public function resend_email_confirmation_logging($user_id){
        //DATAS NEEDED
        $edited_user = $this->CI->user_model->get_user(user_id);
        //BUILDING THE MESSAGE
        $log_entry = $this::RESEND_CONFIRM_EMAIL_LOG;
        $log_entry = str_replace('$1', $active_user['username'],$log_entry);
        $log_entry = str_replace('$2', $user_id,$log_entry);
        return $log_entry;
    }

    public function password_recovery_logging($user_id){
        //DATAS NEEDED
        $edited_user = $this->CI->user_model->get_user(user_id);
        //BUILDING THE MESSAGE
        $log_entry = $this::PASSWORD_RECOVERY_LOG;
        $log_entry = str_replace('$1', $active_user['username'],$log_entry);
        $log_entry = str_replace('$2', $user_id,$log_entry);
        return $log_entry;
    }

    public function resend_password_recovery_logging($user_id){
        //DATAS NEEDED
        $edited_user = $this->CI->user_model->get_user(user_id);
        //BUILDING THE MESSAGE
        $log_entry = $this::RESEND_PASSWORD_RECOVERY_LOG;
        $log_entry = str_replace('$1', $active_user['username'],$log_entry);
        $log_entry = str_replace('$2', $user_id,$log_entry);
        return $log_entry;
    }
    //==============================================CATEGORIES===================================
    //==============================================ROLES===================================
    //==============================================TAGS===================================
    //==============================================POSTS===================================
}