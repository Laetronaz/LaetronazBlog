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
                $this->user_model->register($enc_password);

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

                 if(!($user_id === FALSE)){
                    //Verify the password currently : CRYPT_BLOWFISH
                    if(!$this->validate_password($user_id, $password)){
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
            $this->user_model->toggle_user($id, $user['active']);

            //set flash_messages
            if($user['active'] == TRUE){
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

        public function change_password(){
            // Check login
            if(!$this->session->userdata('logged_in')){
                redirect($this->const_model::USERS_LOGIN);
            }
            $new_password = $this->input->post('password');
            if($this->session->userdata('user_type') == 'Admin' && $this->input->post('id') != $this->session->userdata('user_id')){
                $this->user_model->update_password($this->encrypt_password($new_password));
                $message = $this->message_model->get_message('password_changed_success');
            }
            else if($this->validate_password($this->input->post('id'),$new_password)){
                vdebug('validated');
                $this->user_model->update_password($this->encrypt_password($new_password)); 
                //set flash_message
                $message = $this->message_model->get_message('password_changed_success');
            }
            else{
                vdebug('validation failed');
                $message = $this->message_model->get_message('password_changed_failed');
            }
            $this->session->set_flashdata($message['name'], $message);
            redirect($this->const_model::USERS_EDIT.'/'.$this->input->post('id'));
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
    }