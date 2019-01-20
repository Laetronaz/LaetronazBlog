<?php
    class Users extends CI_Controller{
        //TITLES CONST
        private const REGISTER_TITLE = 'Register User';
        private const LOGIN_TITLE = 'Sign In';
        private const INDEX_TITLE = 'Search by Authors';
        private const MANAGE_TITLE = 'Manage Users';
        private const VIEW_TITLE = 'User Profile';
        private const EDIT_TITLE = 'Edit User: ';

        private const FORGOT_PASSWORD_TEXT = 'Forgot my password';
        private const RESEND_EMAIL_TEXT =  'Resend Email';
        
        //register user
        public function register(){
            //check user access
            $this->load->library('access_control');
            $this->access_control->verify_access_users();

            $data['title'] = $this::REGISTER_TITLE;
            $data['types'] = $this->user_model->get_roles();

            if($this->form_validation->run('user_register') === FALSE){
                $this->load->view(TEMPLATE_HEADER_VIEW);
                $this->load->view(USERS_REGISTER_VIEW, $data);
                $this->load->view(TEMPLATE_FOOTER_VIEW);
            }
            else{
                $enc_password = $this->encrypt_password($this->input->post('password'));
                $user_id = $this->user_model->register($enc_password);

                //LOG ACTIVITY
                $this->load->library('rat');
                $this->load->library('logs_builder');
                $this->rat->log($this->logs_builder->user_register_logging($user_id), USERS_LEVEL);

                //CREATE TOKEN
                $this->user_model->create_verification_request(bin2hex(random_bytes(78)), $user_id);
                $token = $this->user_model->get_current_token($user_id);
                //SEND MAIL VERIFICATION EMAIL
                $this->load->library('email_management');
                $this->email_management->mail_verification_email($this->input->post('username'),$this->input->post('email'),$token);

                // Set message
                $message = $this->message_model->get_message('user_registered');
                $this->session->set_flashdata($message['name'], $message);
                redirect(POSTS_INDEX_PATH);
            }
        }

        //login user
        public function login(){
            $data['title'] = $this::LOGIN_TITLE;
            
            if($this->form_validation->run('login') === FALSE){
                $this->load->view(TEMPLATE_HEADER_VIEW);
                $this->load->view(USERS_LOGIN_VIEW, $data);
                $this->load->view(TEMPLATE_FOOTER_VIEW);
            }
            else{
                // Get Username
                $username = $this->input->post('username');
                $password = $this->input->post('password');
                
                // Login user
                $user = $this->user_model->login($username);
                $user_id = $user['id'];
                $hashed_password = $user['password'];
                if($user !== FALSE){
                    if($user['user_state'] != 3){//state which cannot log in.
                        switch ($user['user_state']) {
                            case 1:
                                $message = $this->message_model->get_message('user_waiting');
                                $message['value'] .= " <a href='".base_url().EMAIL_RESEND_RESET_CONFIRM_EMAIL_PATH.$user_id."'>".$this::RESEND_EMAIL_TEXT."</a>";
                                break;
                            case 2:
                                $message = $this->message_model->get_message('user_lockedout');
                                break;
                            case 4:
                                $message = $this->message_model->get_message('user_inactive');
                                break;
                        }
                        $this->session->set_flashdata($message['name'], $message); 
                        redirect(POSTS_INDEX_PATH);
                    }
                    
                    if(!($user_id === FALSE)){
                        //Verify the password currently : CRYPT_BLOWFISH
                        if(!$this->validate_password($user_id, $password)){
                            $this->user_model->augment_attempts($user_id);
                            $this->login_failed();
                        }
                        // Create session
                        $session = array(
                            'user_id' => $user_id,
                            'username' => $username,
                            'logged_in' => true,
                            'rights' => $this->role_model->get_role_rights($user['role'])
                        );
                        
                        $this->session->set_userdata($session);
                        //reset attempts on successful login
                        if($user['connection_attempts'] != 0){
                            $this->user_model->reset_attempts($user_id);
                        }
    
                        // Set message
                        $message = $this->message_model->get_message('user_loggedin');
                        $this->session->set_flashdata($message['name'], $message);
                        redirect(POSTS_INDEX_PATH);
                    }
                    else{
                        $this->login_failed();
                    }    
                }
                else{
                    $this->login_failed();
                }
                
            }
        }

        public function logout(){
            // Unset user data
            $this->session->unset_userdata('logged_in');
            $this->session->unset_userdata('user_id');
            $this->session->unset_userdata('username');
            $this->session->unset_userdata('rights');

            // Set message
            $message = $this->message_model->get_message('user_loggedout');
            $this->session->set_flashdata($message['name'], $message);
            redirect(POSTS_INDEX_PATH);
        }

        public function index(){
           //check user access
           $this->load->library('access_control');
           $this->access_control->verify_access_users();

            $data['title'] = $this::MANAGE_TITLE;
            $data['users'] = $this->user_model->get_users();
            foreach($data['users'] as $key => $user){//set style data
                switch($user['user_state']){
                    case 1:
                        $data['users'][$key]['style'] = STATE_WAITING;
                        break;
                    case 2:
                        $data['users'][$key]['style'] = STATE_LOCKOUT;
                        break;
                    case 3:
                        $data['users'][$key]['style'] = STATE_ACTIVE;
                        break;
                    case 4:
                        $data['users'][$key]['style'] = STATE_INACTIVE;
                        break;
                }
            }
            
            $this->load->view(TEMPLATE_HEADER_VIEW);
            $this->load->view(USERS_INDEX_VIEW, $data);
            $this->load->view(TEMPLATE_FOOTER_VIEW);
        }

        public function filter(){//Open for everyone
            $data['title'] = $this::INDEX_TITLE;
            $data['users'] = $this->build_alphabetical_users_list($this->user_model->get_users());
            $this->load->view(TEMPLATE_HEADER_VIEW);
            $this->load->view(USERS_FILTER_PATH, $data);
            $this->load->view(TEMPLATE_FOOTER_VIEW);
        }

        public function posts($id){
            $data['title'] = $this->user_model->get_user($id)['username'];
            $data['posts'] = $this->post_model->get_posts_by_user($id);
            $this->load->view(TEMPLATE_HEADER_VIEW);
            $this->load->view(POSTS_INDEX_VIEW, $data);
            $this->load->view(TEMPLATE_FOOTER_VIEW);
        }

        public function toggle($id){
            //check user access
            $this->load->library('access_control');
            $this->access_control->verify_access_users(); 
            $user = $this->user_model->get_user($id);
            $this->user_model->toggle_user($id, $user['user_state']);
            
            //LOG ACTIVITY
            $this->load->library('rat');
            $this->load->library('logs_builder');
            $this->rat->log($this->logs_builder->user_toggle_logging($id,$user['user_state']), USERS_LEVEL);

            //set flash_messages
            if($user['user_state'] == 3){
                $message = $this->message_model->get_message('user_disabled');
            }
            else{
                $message = $this->message_model->get_message('user_enabled');
            }
            $this->session->set_flashdata($message['name'], $message);
            redirect(USERS_INDEX_PATH);
        }

        public function view($id){
            //check user access
            $this->load->library('access_control');
            $this->access_control->verify_access_users();

            $data['user'] = $this->user_model->get_user($id);
            $this->load->library('rat');
            $data['logs'] = $this->rat->get_log($id, $code = NULL, $date = NULL, $order_by = NULL, $limit = NULL);

            if(empty($data['user'])){
                show_404();
            }

            $data['title'] = $this::VIEW_TITLE;
            $data['types'] = $this->user_model->get_roles();
            switch($data['user']['user_state']){
                case 1:
                    $data['user']['style'] = STATE_WAITING;
                    break;
                case 2:
                    $data['user']['style'] = STATE_LOCKOUT;
                    break;
                case 3:
                    $data['user']['style'] = STATE_ACTIVE;
                    break;
                case 4:
                    $data['user']['style'] = STATE_INACTIVE;
                    break;
            }
            $data['user']['state_name'] = $this->user_model->get_user_state($data['user']['user_state']);

            $this->load->view(TEMPLATE_HEADER_VIEW);
            $this->load->view(USERS_VIEW, $data);
            $this->load->view(TEMPLATE_FOOTER_VIEW);
        }

        public function edit($id){
            //check user access
            $this->load->library('access_control');
            $this->access_control->verify_access_users();

            $data['user'] = $this->user_model->get_user($id);
            $data['types'] = $this->user_model->get_roles();

            if(empty($data['user'])){
                show_404();
            }

            $data['title'] = $this::EDIT_TITLE;
            if($this->form_validation->run('user_edit') === FALSE){
                $this->load->view(TEMPLATE_HEADER_VIEW);
                $this->load->view(USERS_EDIT_VIEW, $data);
                $this->load->view(TEMPLATE_FOOTER_VIEW);
            }
            else{
                $this->user_model->update_user();

                //LOG ACTIVITY
                $this->load->library('rat');
                $this->load->library('logs_builder');
                $this->rat->log($this->logs_builder->user_edit_logging($id,$user['user_state']), USERS_LEVEL);

                //set flash_messages
                $message = $this->message_model->get_message('user_updated');
                $this->session->set_flashdata($message['name'], $message);
                redirect(USERS_VIEW_PATH.$this->input->post('id'));
            } 
        }

        public function change_username($user_id){
            $username = $this->input->post('new-username');
            $user = $this->user_model->get_user($user_id);
            if(!empty($user)){
                if(!$this->form_validation->run('username_change') === FALSE){
                    $update = $this->user_model->update_username($user_id, $username);
                    
                    //LOG ACTIVITY
                    $this->load->library('rat');
                    $this->load->library('logs_builder');
                    $this->rat->log($this->logs_builder->username_change_logging($user_id,$user['username'],$username), USERS_LEVEL);
                    
                    //SHOW MESSAGE
                    $message = $this->message_model->get_message('username_changed');
                    $this->session->set_flashdata($message['name'], $message);
                }
                redirect(USERS_EDIT_PATH.$user_id);
            }
            else{
                //SHOW MESSAGE
                $message = $this->message_model->get_message('inexisting_user_warning');
                $this->session->set_flashdata($message['name'], $message);
                redirect(POSTS_INDEX_PATH);
            }
            
        }

        public function change_email($user_id){
            $user = $this->user_model->get_user($user_id);
            if(!empty($user)){
                if(!$this->form_validation->run('email_change') === FALSE){
                    $email = $this->input->post('new-email');
                    $this->user_model->update_email($user_id, $email);

                    //LOG ACTIVITY
                    $this->load->library('rat');
                    $this->load->library('logs_builder');
                    $this->rat->log($this->logs_builder->email_change_logging($user_id, $user['email'], $email), USERS_LEVEL);

                    //SHOW MESSAGE
                    $message = $this->message_model->get_message('email_changed');
                    $this->session->set_flashdata($message['name'], $message);
                }
                redirect(USERS_EDIT_PATH.$user_id);
            }
            else{
                //SHOW MESSAGE
                $message = $this->message_model->get_message('inexisting_user_warning');
                $this->session->set_flashdata($message['name'], $message);
                redirect(POSTS_INDEX_PATH);
            }
        }

        //======================================PASSWORD=================================================
        public function change_password($user_id){
            // Check login
            $new_password = $this->input->post('new-password');
            if(!$this->form_validation->run('password_change') === FALSE){
                if(
                    !(array_search('manage users',array_column($this->session->userdata('rights'),'name')) === FALSE 
                    && array_search('admin',array_column($this->session->userdata('rights'),'name')) === FALSE)
                ){//HARCODED
                    $this->user_model->update_password($this->encrypt_password($new_password));

                    //LOG ACTIVITY
                    $this->load->library('rat');
                    $this->load->library('logs_builder');
                    $this->rat->log($this->logs_builder->password_change_logging($user_id), USERS_LEVEL);

                    $message = $this->message_model->get_message('password_changed_success');
                }
                else if($user_id != FALSE){
                    $this->user_model->update_password($this->encrypt_password($new_password),$user_id);
                    $token = $this->password_model->get_current_token($user_id);
                    $this->password_model->use_token($token['token']);
                    $message = $this->message_model->get_message('password_changed_success');
                }
                else if($this->validate_password($this->input->post('id'),$new_password)){//User change the user by himself
                    //set flash_message
                     $message = $this->message_model->get_message('password_same');
                 }
                else{
                    $message = $this->message_model->get_message('password_changed_failed');
                }
                $this->session->set_flashdata($message['name'], $message);
                
                if($user_id != FALSE){
                    redirect('users/login');
                }
                else{
                    redirect(USERS_EDIT_PATH.$this->input->post('id'));
                }
            }
            else{
                $message = $this->message_model->get_message('password_change_failed');
                $this->session->set_flashdata($message['name'], $message);
                redirect(USERS_EDIT_PATH.$user_id);
            }
        }

        public function request_password_reset(){//For where user enter his email.
            $data['title'] = $this::EDIT_TITLE;
            if($this->form_validation->run('request_password')===FALSE){
                $this->load->view(TEMPLATE_HEADER_VIEW);
                $this->load->view(USERS_FORGOTPASSWORD_VIEW, $data);
                $this->load->view(TEMPLATE_FOOTER_VIEW);
            }
            else{
                $user = $this->user_model->get_user_by_email();
            if(!empty($user)){
                $token = $this->password_model->get_current_token($user['id']);
                //CREATE TOKEN AND SEND EMAIL
                if(empty($token)){//if not on an active token
                    $this->password_model->create_password_request(bin2hex(random_bytes(78)), $user['id']);
                    $token = $this->user_model->get_current_token($user_id);

                    //SEND PASSWORD RECOVERY EMAIL
                    $this->load->library('email_management');
                    $this->email_management->password_recovery_email($this->input->post('username'),$this->input->post('email'),$token);

                    //LOG ACTIVITY
                    $this->load->library('rat');
                    $this->load->library('logs_builder');
                    $this->rat->log($this->logs_builder->password_recovery_logging($user['id']), USERS_LEVEL,$user['id']);

                    //CREATE MESSAGE
                    $message = $this->message_model->get_message('password_reset');
                    $this->session->set_flashdata($message['name'], $message);
                    redirect('users/login');
                }
                //SHOW MESSAGE WITH A RESEND LINK
                else{
                    $message = $this->message_model->get_message('resend_password');
                    $message['value'] .= "<a href='".base_url().EMAIL_RESEND_RESET_PASSWORD_PATH.$user['id']."'>".$this::RESEND_EMAIL_TEXT."</a>";
                    $this->session->set_flashdata($message['name'], $message);
                    redirect(POSTS_INDEX_PATH);
                }
            }
            else{
                //CREATE MESSAGE
                $message = $this->message_model->get_message('inexisting_user');
                $this->session->set_flashdata($message['name'], $message);
                redirect(POSTS_INDEX_PATH);
            } 
            }
            
        }

        public function change_password_form($token){
            $reset_request = $this->password_model->get_password_resquest_by_token($token);
            if(!empty($reset_request)){//if token is valid
                $current_date = date('Y-m-d H:i:s',time());
                if($current_date > $reset_request['creation_time'] && $current_date < $reset_request['expiration_time'] && $reset_request['used'] == 0){
                    $data['user_id'] = $reset_request['user_id'];
                    $data['token'] = $token;
                    if($this->form_validation->run('password_reset') === FALSE){
                        $this->load->view(TEMPLATE_HEADER_VIEW);
                        $this->load->view(USERS_RESETPASSWORD_VIEW,$data);
                        $this->load->view(TEMPLATE_FOOTER_VIEW);
                    }
                    else{
                        $user_id = $this->input->post('user_id');
                        $this->change_password($user_id);
                    }
                }
                else{
                    //SET MESSAGE
                    $message = $this->message_model->get_message('password_expired');
                    $message['value'] .= "<a href='".base_url().EMAIL_PASSWORD_RESET_PATH."'>".FORGOT_PASSWORD_TEXT."</a>";
                    $this->session->set_flashdata($message['name'], $message);
                    redirect(POSTS_INDEX_PATH);
                }
            }
            else{
               //SET MESSAGE
               $message = $this->message_model->get_message('invalid_password_token');
               $this->session->set_flashdata($message['name'], $message);
               redirect(POSTS_INDEX_PATH);
            }
        }
        //===========================================AUTHORIZATION===========================================
        public function confirm_email($token_string){
            $token = $this->user_model->get_verification_resquest($token_string);
            if(!empty($token)){
                $user = $this->user_model->get_user($token['user_id']);
                if($token === $this->user_model->get_current_token($user['id']) && $token['used'] == 0){
                    $this->user_model->set_user_active($user['id']);
                    $this->user_model->use_token($token['token']);

                     //LOG ACTIVITY
                     $this->load->library('rat');
                     $this->load->library('logs_builder');
                     $this->rat->log($this->logs_builder->email_confirmed_logging($user['id']), USERS_LEVEL,$user['id']);


                    $message = $this->message_model->get_message('email_verified');
                    $this->session->set_flashdata($message['name'], $message);
                    redirect(POSTS_INDEX_PATH);
                }
                else{//is expired
                    $message = $this->message_model->get_message('confirmation_expired');
                    $message['value'] .= " <a href='".base_url().EMAIL_RESEND_RESET_CONFIRM_EMAIL_PATH.$user['id']."'>".$this::RESEND_EMAIL_TEXT."</a>";
                    $this->session->set_flashdata($message['name'], $message);
                    redirect(POSTS_INDEX_PATH);
                }
            }
            else{// is not an existing token
                $message = $this->message_model->get_message('invalid_verification_token');
                $this->session->set_flashdata($message['name'], $message);
                redirect(POSTS_INDEX_PATH);
            } 
        }

        //===========================================RESEND MAILS===========================================
        public function resend_password_recovery_email($user_id){
            $user = $this->user_model->get_user($user_id);
            $token =$this->password_model->get_current_token($user_id);

            //SEND PASSWORD RECOVERY EMAIL
            $this->load->library('email_management');
            $this->email_management->password_recovery_email($user['username'],$user['email'],$token);

            //LOG ACTIVITY
            $this->load->library('rat');
            $this->load->library('logs_builder');
            $this->rat->log($this->logs_builder->resend_password_recovery_logging($token['user_id']), USERS_LEVEL,$token['user_id']);

            //SET MESSAGE
            $message = $this->message_model->get_message('password_recovery_resent');
            $this->session->set_flashdata($message['name'], $message);
            redirect(POSTS_INDEX_PATH);
        }

        public function resend_verification_email($user_id){
            $user = $this->user_model->get_user($user_id);

            //create new token if no token are currently active.
            $token = $this->user_model->get_current_token($user_id);  
            if(empty($token)){
                $token_string = bin2hex(random_bytes(78));//create it
                $this->user_model->create_verification_request($token_string, $user_id);
                $token = $this->user_model->get_verification_resquest($token_string);        
            }
            
            //SEND MAIL VERIFICATION EMAIL
            $this->load->library('email_management');
            $this->email_management->mail_verification_email($user['username'],$user['email'],$token);
            
            //LOG ACTIVITY
            $this->load->library('rat');
            $this->load->library('logs_builder');
            $this->rat->log($this->logs_builder->resend_email_confirmation_logging($token['user_id']), USERS_LEVEL,$token['user_id']);

            //SET MESSAGE
            $message = $this->message_model->get_message('password_reset_resent');
            $this->session->set_flashdata($message['name'], $message);
            redirect(POSTS_INDEX_PATH);
        }

        //========================================PRIVATE FUNCTIONS======================================
        private function login_failed(){
            // Set message
            $message = $this->message_model->get_message('login_failed');
            $this->session->set_flashdata($message['name'], $message);
            redirect(USERS_LOGIN_PATH);
        }

        private function encrypt_password($password){
            // ENCRYPT password currently using: CRYPT_BLOWFISH
            return password_hash($password, PASSWORD_BCRYPT);
        }

        private function validate_password($id, $password){
            $db_password = $this->user_model->get_password($id);
            if(password_verify($password, $db_password['password'])){
                return TRUE;
            }
            return FALSE;
        }

        private function build_alphabetical_users_list($users_list){
            $alpha_list = array();
            foreach (range('A', 'Z') as $char){
                $alpha_list[$char] = $this->user_start_with($char, $users_list);   
            }
            return $alpha_list;
        }

        private function user_start_with($char, $users_list){
            $user_starting_with_char = array();
            foreach(array_column($users_list,'username') as $key => $name){
                if(strtoupper(trim(substr($name,0,1))) == $char){
                    array_push($user_starting_with_char,$users_list[$key]);
                }
            }
            return $user_starting_with_char;
        }
    }