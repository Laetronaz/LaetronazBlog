<?php
    class Categories extends CI_Controller{
        public function create(){
             // Check login
            if($this->session->userdata('user_type') != 'Admin' ){
                $message = $this->message_model->get_unauthorized_access();
                $this->session->set_flashdata($message['name'], $message);
                redirect('users/login');
            }

            $data['title'] = 'Create Category';
            $this->form_validation->set_rules('name', 'Name', 'required');
            if ($this->form_validation->run() === FALSE){
                $this->load->view('templates/header');
                $this->load->view('categories/create', $data);
                $this->load->view('templates/footer');
            } 
            else{
                 //Upload Image
                 $config['upload_path'] = './assets/images/categories';
                 $config['allowed_types'] = 'gif|jpg|png';
                 $config['max_size'] = '2048';
                 $config['max_width'] = '75';
                 $config['max_height'] = '75';
 
                 $this->load->library('upload', $config);
 
                 if(!$this->upload->do_upload()){
                     $errors = array('error' => $this->upload->display_errors());
                     $category_image = 'noimage.jpg';
                 }
                 else{
                     $data = array('upload_data' => $this->upload->data());
                     $category_image = $_FILES['userfile']['name'];
                 }



                $this->category_model->create_category($category_image);

                 // Set message
                 $message = $this->message_model->get_message('category_created');
                 $this->session->set_flashdata($message['name'], $message);

                redirect('categories');
            }
        }

        public function index(){
            $data['title'] = 'Categories';
            $data['categories'] = $this->category_model->get_categories();

            $this->load->view('templates/header');
            $this->load->view('categories/index', $data);
            $this->load->view('templates/footer');
        }

        public function posts($id){
            $data['title'] = $this->category_model->get_category($id)->name;
            $data['posts'] = $this->post_model->get_posts_by_category($id);

            $this->load->view('templates/header');
            $this->load->view('posts/index', $data);
            $this->load->view('templates/footer');
        }

        public function delete($id){
            // Check login
            if($this->session->userdata('user_type') != 'Admin' ){
                $message = $this->message_model->get_unauthorized_access();
                $this->session->set_flashdata($message['name'], $message);
                redirect('users/login');
            }
            $category = $this->category_model->get_category($id);
            $this->category_model->toogle_category($id, $category['active']);
            $posts = $this->post_model->get_posts_by_category($id);
            foreach($posts as $post){
                $this->post_model->toogle_post($post['id'], $category['active']);
            }

            // Set flash_message
            if($category['active'] == TRUE){
                $message = $this->message_model->get_message('category_disabled');
            }
            else{
                $message = $this->message_model->get_message('category_enabled');
            }
            $this->session->set_flashdata($message['name'], $message);
            redirect('categories');
        }

        public function edit($id){
            // Check login
            if($this->session->userdata('user_type') != 'Admin' ){
                $message = $this->message_model->get_unauthorized_access();
                $this->session->set_flashdata($message['name'], $message);
                redirect('users/login');
            }

            $data['category'] = $this->category_model->get_category($id);
            
            if(empty($data['category'])){
                show_404();
            }

            $data['title'] = 'Edit Category';

            $this->load->view('templates/header');
            $this->load->view('categories/edit', $data);
            $this->load->view('templates/footer');
        }


        public function update(){
            // Check login
            if($this->session->userdata('user_type') != 'Admin' ){
                $message = $this->message_model->get_unauthorized_access();
                $this->session->set_flashdata($message['name'], $message);
                redirect('users/login');
            }


            //Upload Image
            $config['upload_path'] = './assets/images/categories';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '2048';
            $config['max_width'] = '75';
            $config['max_height'] = '75';

            $this->load->library('upload', $config);

            if(!$this->upload->do_upload()){
                $errors = array('error' => $this->upload->display_errors());
                $category_image = 'noimage.jpg';
            }
            else{
                $data = array('upload_data' => $this->upload->data());
                $category_image = $_FILES['userfile']['name'];
            }

            $this->category_model->update_category($category_image);

             // Set message
             $message = $this->message_model->get_message('category_updated');
             $this->session->set_flashdata($message['name'], $message);

            redirect('categories');
        }
    }