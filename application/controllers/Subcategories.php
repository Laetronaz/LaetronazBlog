<?php
    class Subcategories extends CI_Controller{
        public function create(){
             // Check login
             if($this->session->userdata('user_type') != 'Admin' ){
                $this->session->set_flashdata('unautorized_access', 'Only admininstrators have access to this page');
                redirect('users/login');
            }

            $data['title'] = 'Create Subcategory';
            $data['categories'] = $this->category_model->get_categories();
            $this->form_validation->set_rules('name', 'Name', 'required');
            if ($this->form_validation->run() === FALSE){
                $this->load->view('templates/header');
                $this->load->view('subcategories/create', $data);
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
                     $subcategory_image = 'noimage.jpg';
                 }
                 else{
                     $data = array('upload_data' => $this->upload->data());
                     $subcategory_image = $_FILES['userfile']['name'];
                 }



                $this->subcategory_model->create_subcategory($subcategory_image);

                 // Set message
                 $this->session->set_flashdata('category_created', 'Your category has been created.');

                redirect('categories');
            }
        }

        public function edit($id){
            // Check login
            if($this->session->userdata('user_type') != 'Admin' ){
                $this->session->set_flashdata('unautorized_access', 'Only admininstrators have access to this page');
                redirect('users/login');
            }

            $data['subcategory'] = $this->subcategory_model->get_subcategory($id);
            $data['categories'] = $this->category_model->get_categories();

            if(empty($data['subcategory'])){
                show_404();
            }

            $data['title'] = 'Edit Sub Category';

            $this->load->view('templates/header');
            $this->load->view('subcategories/edit', $data);
            $this->load->view('templates/footer');
        }


        public function update(){
            // Check login
            if($this->session->userdata('user_type') != 'Admin' ){
                $this->session->set_flashdata('unautorized_access', 'Only admininstrators have access to this page');
                redirect('users/login');
            }


            //Upload Image
            $config['upload_path'] = './assets/images/subcategories';
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

            $this->subcategory_model->update_subcategory($category_image);

             // Set message
             $this->session->set_flashdata('subcategory_updated', 'Your subcategory has been updated.');

            redirect('categories');
        }
        public function posts($id){
            $data['title'] = $this->category_model->get_subcategory($id)->name;
            $data['posts'] = $this->post_model->get_posts_by_subcategory($id);

            $this->load->view('templates/header');
            $this->load->view('posts/index', $data);
            $this->load->view('templates/footer');
        }

        public function delete($id){
            // Check login
            if(!$this->session->userdata('logged_in')){
                redirect('users/login');
            }
            $subcategory = $this->subcategory_model->get_subcategory($id);
            $this->subcategory_model->toogle_subcategory($id, $subcategory['active']);

            // Set message
            $this->session->set_flashdata('subcategory_deleted', 'Your category has been deleted.');

            redirect('categories');
        }


    }