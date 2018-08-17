<?php
    class Users extends CI_Controller{

        //register user
        public function register(){
            // Check login
            if($this->session->userdata('user_type') != 'Admin' ){
                $this->session->set_flashdata('unautorized_access', 'Only admininstrators have access to this page');
                redirect('users/login');
            }


            $data['title'] = 'Sign Up';
            $data['types'] = $this->user_model->get_users_type();

            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]', array(
                'is_unique' => 'This username is already taken. Please choose a different one.')
            );
            $this->form_validation->set_rules('email', 'Email', 'required|is_unique[users.email]', array(
                'is_unique' => 'This email is already used. Please choose a different one.'
            ));
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('password2', 'Confirm Password', 'matches[password]');


            if($this->form_validation->run() === FALSE){
                $this->load->view('templates/header');
                $this->load->view('users/register', $data);
                $this->load->view('templates/footer');
            }
            else{
                // ENCRYPT password currently using: CRYPT_BLOWFISH
                
                $enc_password = password_hash($this->input->post('password'),PASSWORD_BCRYPT);
                $this->user_model->register($enc_password);

                // Set message
                $this->session->set_flashdata('user_registered', 'You are now registered and can log in');
            
                redirect('posts');
            }
        }

        //login user
        public function login(){
            $data['title'] = 'Sign In';

            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');


            if($this->form_validation->run() === FALSE){
                $this->load->view('templates/header');
                $this->load->view('users/login', $data);
                $this->load->view('templates/footer');
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
                    if(!password_verify($password, $hashed_password)){
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
                     $this->session->set_flashdata('user_loggedin', 'You are now logged in');
                     redirect('posts');
                }
                else{
                    login_failed();
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
            $this->session->set_flashdata('user_loggedout', 'You are now logged out');
            redirect('users/login');
        }


        private function login_failed(){
             // Set message
            $this->session->set_flashdata('login_failed', 'The username or password you have entered is invalid.'.$hashed_password);
            redirect('users/login');
        }
    }