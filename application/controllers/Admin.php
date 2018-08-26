<?php
     class Admins extends CI_Controller{
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
    }