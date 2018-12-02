<?php
    class Users extends CI_Controller{
         //TITLES CONST
         private const REGISTER_TITLE = 'Sign Up';
         private const LOGIN_TITLE = 'Sign In';
         private const INDEX_TITLE = 'User List';
         private const VIEW_TITLE = 'User Profile';
         private const EDIT_TITLE = 'User Profile';

         //REGISTER ERRORS
         private const EMAIL_TAKEN = 'This email is already used. Please choose a different one.';
         private const USERNAME_TAKEN = 'This username is already taken. Please choose a different one.';

        //register user
        public function register(){
            // Check login
            if($this->session->userdata('user_type') != 'Admin' ){
                $message = $this->message_model->get_unauthorized_access();
                $this->session->set_flashdata($message['name'], $message);
                redirect($this->const_model::USERS_LOGIN);
            }

            $data['title'] = $this::REGISTER_TITLE;
            $data['types'] = $this->user_model->get_users_type();

            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]', array(
                'is_unique' => $this::USERNAME_TAKEN)
            );
            $this->form_validation->set_rules('email', 'Email', 'required|is_unique[users.email]', array(
                'is_unique' => $this::EMAIL_TAKEN
            ));
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('password2', 'Confirm Password', 'matches[password]');


            if($this->form_validation->run() === FALSE){
                $this->load->view($this->const_model::HEADER);
                $this->load->view($this->const_model::USERS_REGISTER, $data);
                $this->load->view($this->const_model::FOOTER);
            }
            else{
                $enc_password = $this->encrypt_password($this->input->post('password'));
                $user_id = $this->user_model->register($enc_password);
                //SEND VERIFICATION EMAIL HERE
                
                $recipient = $this->input->post('email');
                $subject = $this->const_model::WEBSITE_NAME.' verify your email';
                $html_content = file_get_contents(base_url().$this->const_model::VERIFICATION_EMAIL);

                //CREATE TOKEN
                $token = bin2hex(random_bytes(78));
                $validation_token = $this->user_model->create_verification_request($token, $user_id);
                //REPLACE CONTENT
                $html_content = str_replace('$1',$this->input->post('name'),$html_content);
                $html_content = str_replace('$2', $this->const_model::WEBSITE_NAME,$html_content);
                $html_content = str_replace('$3', base_url().$this->const_model::USERS_VALIDATE_EMAIL.'/'.$token,$html_content);
                $html_content = str_replace('$4', $validation_token['expiration_time'],$html_content);
                $this->sendEmail($recipient, $subject, $html_content);

                // Set message
                $message = $this->message_model->get_message('user_registered');
                $this->session->set_flashdata($message['name'], $message);
                redirect($this->const_model::POSTS_PATH);
            }
        }

        //login user
        public function login(){
            $data['title'] = $this::LOGIN_TITLE;

            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');


            if($this->form_validation->run() === FALSE){
                $this->load->view($this->const_model::HEADER);
                $this->load->view($this->const_model::USERS_LOGIN, $data);
                $this->load->view($this->const_model::FOOTER);
            }
            else{
                // Get Username
                $username = $this->input->post('username');
                $password = $this->input->post('password');
                
                // Login user
                $user_datas = $this->user_model->login($username);
                $user_id = $user_datas['id'];
                $hashed_password = $user_datas['password'];
                $user_type = $user_datas['user_type'];
                if($user_datas['user_state'] != 3){//state which cannot log in.
                    switch ($user_datas['user_state']) {
                        case 1:
                            $message = $this->message_model->get_message('user_waiting');
                            $message['value'] .= " <a href='".base_url()."users/resendverification/".$user_id."'> Resend email</a>";
                            break;
                        case 2:
                            $message = $this->message_model->get_message('user_lockedout');
                            break;
                        case 4:
                            $message = $this->message_model->get_message('user_inactive');
                            break;
                    }
                    $this->session->set_flashdata($message['name'], $message);
                    redirect('');
                }

                if(!($user_id === FALSE)){
                    //Verify the password currently : CRYPT_BLOWFISH
                    if(!$this->validate_password($user_id, $password)){
                        $this->user_model->augment_attempts($user_id);
                        $this->login_failed();
                    }

                    // Create session
                    $user_data = array(
                        'user_id' => $user_id,
                        'username' => $username,
                        'logged_in' => true,
                        'user_type' => $user_type
                    );
                    $this->session->set_userdata($user_data);
                    //reset attempts on successful login
                    if($user_datas['connection_attempts'] != 0){
                        $this->user_model->reset_attempts($user_id);
                    }
                    

                    // Set message
                    $message = $this->message_model->get_message('user_loggedin');
                    $this->session->set_flashdata($message['name'], $message);
                    redirect($this->const_model::POSTS_PATH);
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
            $this->session->unset_userdata('user_type');

            // Set message
            $message = $this->message_model->get_message('user_loggedout');
            $this->session->set_flashdata($message['name'], $message);
            redirect($this->const_model::USERS_LOGIN);
        }


        private function login_failed(){
            // Set message
            $message = $this->message_model->get_message('login_failed');
            $this->session->set_flashdata($message['name'], $message);
            redirect($this->const_model::USERS_LOGIN);
        }

        public function index(){
            $data['title'] = $this::INDEX_TITLE;
            $data['users'] = $this->user_model->get_users();
            foreach($data['users'] as $key => $user){//set style data
                switch($user['user_state']){
                    case 1:
                        $data['users'][$key]['style'] = "state-waiting";
                        break;
                    case 2:
                        $data['users'][$key]['style'] = "state-lockedout";
                        break;
                    case 3:
                        $data['users'][$key]['style'] = "state-active";
                        break;
                    case 4:
                        $data['users'][$key]['style'] = "state-inactive";
                        break;
                }
            }
            

            $this->load->view($this->const_model::HEADER);
            $this->load->view($this->const_model::USERS_INDEX, $data);
            $this->load->view($this->const_model::FOOTER);
        }

        public function toggle($id){
            // Check login
            if($this->session->userdata('user_type') != 'Admin' ){
                $message = $this->message_model->get_unauthorized_access();
                $this->session->set_flashdata($message['name'], $message);
                redirect($this->const_model::USERS_LOGIN);
            }
            $user = $this->user_model->get_user($id);
            $this->user_model->toggle_user($id, $user['user_state']);

            //set flash_messages
            if($user['user_state'] == 3){
                $message = $this->message_model->get_message('user_disabled');
            }
            else{
                $message = $this->message_model->get_message('user_enabled');
            }
            $this->session->set_flashdata($message['name'], $message);
            redirect($this->const_model::USERS);
        }

        public function view($id){
            $data['user'] = $this->user_model->get_user($id);

            if(empty($data['user'])){
                show_404();
            }

            $data['title'] = $this::VIEW_TITLE;
            $data['types'] = $this->user_model->get_users_type();
                switch($data['user']['user_state']){
                    case 1:
                        $data['user']['style'] = "state-waiting";
                        break;
                    case 2:
                        $data['user']['style'] = "state-lockedout";
                        break;
                    case 3:
                        $data['user']['style'] = "state-active";
                        break;
                    case 4:
                        $data['user']['style'] = "state-inactive";
                        break;
                }
            $data['user']['state_name'] = $this->user_model->get_user_state($data['user']['user_state']);

            $this->load->view($this->const_model::HEADER);
            $this->load->view($this->const_model::USERS_VIEW, $data);
            $this->load->view($this->const_model::FOOTER);
        }

        public function edit($id){
            if($this->session->userdata('user_type') != 'Admin' ){
                $message = $this->message_model->get_unauthorized_access();
                $this->session->set_flashdata($message['name'], $message);
                redirect($this->const_model::USERS_LOGIN);
            }

            $data['user'] = $this->user_model->get_user($id);
            $data['types'] = $this->user_model->get_users_type();
            
            
            if(empty($data['user'])){
                show_404();
            }

            $data['title'] = $this::EDIT_TITLE;

            $this->load->view($this->const_model::HEADER);
            $this->load->view($this->const_model::USERS_EDIT, $data);
            $this->load->view($this->const_model::FOOTER);
        }

        public function update(){
            // Check login
            if(!$this->session->userdata('logged_in')){
                redirect($this->const_model::USERS_LOGIN);
            }
            $this->user_model->update_user();
            $message = $this->message_model->get_message('user_updated');
            $this->session->set_flashdata($message['name'], $message);
            redirect($this->const_model::USERS_VIEW.'/'.$this->input->post('id'));
        }


        //======================================PASSWORD=================================================
        public function change_password($user_id = FALSE){
            // Check login
            $new_password = $this->input->post('password');
            if($user_id != FALSE){
                $this->user_model->update_password($this->encrypt_password($new_password),$user_id);
                $token = $this->password_model->get_current_token($user_id);
                $this->password_model->use_token($token['token']);

                $message = $this->message_model->get_message('password_changed_success');
            }
            else if($this->validate_password($this->input->post('id'),$new_password)){//User change the user by himself
                //set flash_message
                 $message = $this->message_model->get_message('password_same');
             }
            else if($this->session->userdata('user_type') == 'Admin'){
                $this->user_model->update_password($this->encrypt_password($new_password));
                $message = $this->message_model->get_message('password_changed_success');
            }
            else{
                $message = $this->message_model->get_message('password_changed_failed');
            }
            $this->session->set_flashdata($message['name'], $message);
            
            if($user_id != FALSE){
                redirect('users/login');
            }
            else{
                redirect($this->const_model::USERS_EDIT.'/'.$this->input->post('id'));
            }
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

        public function request_password_reset_form(){//For where user enter his email.
            $data['title'] = $this::EDIT_TITLE;

            $this->load->view($this->const_model::HEADER);
            $this->load->view($this->const_model::USERS_FORGOTTEN_PASSWORD, $data);
            $this->load->view($this->const_model::FOOTER);
        }

        public function request_password_reset(){
            $user = $this->user_model->get_user_by_email();
            if(!empty($user)){
                $token = $this->password_model->get_current_token($user['id']);
                //CREATE TOKEN AND SEND EMAIL
                if(empty($token)){//if not on an active token
                    $recipient = $this->input->post('email');
                    $subject = 'Your '.$this->const_model::WEBSITE_NAME.' account password reset';
                    $html_content = file_get_contents(base_url().'assets/emails/password_recovery.html');

                    $token = bin2hex(random_bytes(78));//create it
                    $this->password_model->create_password_request($token, $user['id']);
                    $password_token = $this->password_model->get_current_token($user['id']);
                    //REPLACE CONTENT
                    $html_content = str_replace('$1',$user['name'],$html_content);
                    $html_content = str_replace('$2', $this->const_model::WEBSITE_NAME,$html_content);
                    $html_content = str_replace('$3', base_url().'users/resetpassword/'.$token,$html_content);
                    $html_content = str_replace('$4', $password_token['expiration_time'],$html_content);

                    $this->sendEmail($recipient, $subject, $html_content);

                    //CREATE MESSAGE
                    $message = $this->message_model->get_message('password_reset');
                    $this->session->set_flashdata($message['name'], $message);
                    redirect('users/login');
                }
                //SHOW MESSAGE WITH A RESEND LINK
                else{
                    $message = $this->message_model->get_message('resend_password');
                    $message['value'] .= "<a href='".base_url()."users/resend_password/".$user['id']."'> Resend email</a>";
                    $this->session->set_flashdata($message['name'], $message);
                    redirect('');
                }
            }
            else{
                //CREATE MESSAGE
                $message = $this->message_model->get_message('inexisting_user');
                $this->session->set_flashdata($message['name'], $message);
                redirect('');
            } 
        }

        public function change_password_form($token){
            $reset_request = $this->password_model->get_password_resquest_by_token($token);
            if(!empty($reset_request)){//if token is valid
                $current_date = date('Y-m-d H:i:s',time());
                if($current_date > $reset_request['creation_time'] && $current_date < $reset_request['expiration_time'] && $reset_request['used'] == 0){
                    $data['user_id'] = $reset_request['user_id'];
                    $this->load->view($this->const_model::HEADER);
                    $this->load->view($this->const_model::USERS_CHANGE_PASSWORD,$data);
                    $this->load->view($this->const_model::FOOTER);
                }
                else{
                    //SET MESSAGE
                    $message = $this->message_model->get_message('password_expired');
                    $message['value'] .= "<a href='".base_url()."users/password-reset'>Forgot my password</a>";
                    $this->session->set_flashdata($message['name'], $message);
                    redirect('');
                }
            }
            else{
               //SET MESSAGE
               $message = $this->message_model->get_message('invalid_password_token');
               $this->session->set_flashdata($message['name'], $message);
               redirect('');
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
                    $message = $this->message_model->get_message('email_verified');
                    $this->session->set_flashdata($message['name'], $message);
                    redirect('');
                }
                else{//is expired
                    $message = $this->message_model->get_message('confirmation_expired');
                    $message['value'] .= " <a href='".base_url()."users/resendverification/".$user['id']."'> Resend email</a>";
                    $this->session->set_flashdata($message['name'], $message);
                    redirect('');
                }
            }
            else{// is not an existing token
                $message = $this->message_model->get_message('invalid_verification_token');
                $this->session->set_flashdata($message['name'], $message);
                redirect('');
            } 
        }

        //===========================================EMAIL===========================================
        private function sendEmail($recipient,$subject ,$html_content){
            //LOAD LIBRARY
            $this->load->library('email');
            //EMAIL CONTENT
            $this->email->to($recipient);
            $this->email->from('laetronaz@gmail.com','Laetronaz Automatic MailSender');
            $this->email->subject($subject);
            $this->email->message($html_content);
            
            //SEND EMAIL
            $sent_email =$this->email->send();
        }

        public function verify_email($token){        

            $data['title'] = $this::EDIT_TITLE;

            $this->load->view($this->const_model::HEADER);
            $this->load->view($this->const_model::USERS_FORGOTTEN_PASSWORD, $data);
            $this->load->view($this->const_model::FOOTER);

            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('verifypassword', 'Confirm Password', 'matches[password]');
        }

        public function resend_password_recovery_email($user_id){
            $user = $this->user_model->get_user($user_id);
            $recipient = $user['email'];
            $token =$this->password_model->get_current_token($user_id);
            
            $subject = $this->const_model::WEBSITE_NAME.' account password reset';
            $html_content = file_get_contents(base_url().'assets/emails/password_recovery.html');
            //REPLACE CONTENT
            $html_content = str_replace('$1',$user['name'],$html_content);
            $html_content = str_replace('$2', $this->const_model::WEBSITE_NAME,$html_content);
            $html_content = str_replace('$3', base_url().'users/resetpassword/'.$token['token'],$html_content);
            $html_content = str_replace('$4', $token['expiration_time'],$html_content);

            $this->sendEmail($recipient,$subject,$html_content);
            //SET MESSAGE
            $message = $this->message_model->get_message('password_reset_resent');
            $this->session->set_flashdata($message['name'], $message);
            redirect('');
        }

        public function resend_verification_email($user_id){
            $user = $this->user_model->get_user($user_id);
            $recipient = $user['email'];

            //create new token if no token are currently active.
            $token = $this->user_model->get_current_token($user_id);  
            if(empty($token)){
                $token_string = bin2hex(random_bytes(78));//create it
                $this->user_model->create_verification_request($token_string, $user_id);
                $token = $this->user_model->get_verification_resquest($token_string);        
            }
            
            $subject = 'Your '.$this->const_model::WEBSITE_NAME.' verify your email';
            $html_content = file_get_contents(base_url().$this->const_model::VERIFICATION_EMAIL);
            //REPLACE CONTENT
            $html_content = str_replace('$1',$user['name'],$html_content);
            $html_content = str_replace('$2', $this->const_model::WEBSITE_NAME,$html_content);
            $html_content = str_replace('$3', base_url().$this->const_model::USERS_VALIDATE_EMAIL.'/'.$token['token'],$html_content);
            $html_content = str_replace('$4', $token['expiration_time'],$html_content);
            
            $this->sendEmail($recipient,$subject,$html_content);
            //SET MESSAGE
            $message = $this->message_model->get_message('password_reset_resent');
            $this->session->set_flashdata($message['name'], $message);
            redirect('');
        }
    }