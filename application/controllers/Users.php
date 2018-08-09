<?php
    class Users extends CI_Controller{

        //register user
        public function register(){
            $data['title'] = 'Sign Up';

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
                $this->session->set_flashdata('user_registered', 'You are now registered and con log in');
            
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

                // Login user
                 $user_id = $this->user_model->login($username, $this->input->post('password'));

                 if(!($user_id === FALSE)){
                       // Create session
                    $user_data = array(
                        'user_id' => $user_id,
                        'username' => $username,
                        'logged_in' => true
                    );

                    $this->session->set_userdata($user_data);

                    // Set message
                     $this->session->set_flashdata('user_loggedin', 'You are now logged in');
                     redirect('posts');
                }
                else{
                    // Set message
                    $this->session->set_flashdata('login_failed', 'Login is invalid'.$hashed_password);
                    redirect('users/login');
                }    
            }
        }

        public function logout(){
            // Unset user data
            $this->session->unset_userdata('logged_in');
            $this->session->unset_userdata('user_id');
            $this->session->unset_userdata('username');

            // Set message
            $this->session->set_flashdata('user_loggedout', 'You are now logged out');
            redirect('users/login');
        }
    }