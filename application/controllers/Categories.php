<?php
    class Categories extends CI_Controller{
        public function create(){
             // Check login
            if($this->session->userdata('user_type') != 'Admin' ){
                $this->session->set_flashdata('unautorized_access', 'Only admininstrators have access to this page');
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
                 $this->session->set_flashdata('category_created', 'Your category has been created.');

                redirect('categories');
            }
        }

        public function index(){
            $data['title'] = 'Categories';
            $data['categories'] = $this->category_model->get_categories();
            $data['subcategories'] = $this->subcategory_model->get_subcategories();

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
                $this->session->set_flashdata('unautorized_access', 'Only admininstrators have access to this page');
                redirect('users/login');
            }

            $this->category_model->delete_category($id);

            // Set message
            $this->session->set_flashdata('category_deleted', 'Your category has been deleted.');

            redirect('categories');
        }

        public function edit($slug){
            // Check login
            if($this->session->userdata('user_type') != 'Admin' ){
                $this->session->set_flashdata('unautorized_access', 'Only admininstrators have access to this page');
                redirect('users/login');
            }

            $data['category'] = $this->post_model->get_category($slug);
            $data['subcategories'] = $this->subcategory_model->get_subcategories_by_categoryId($data['category']['id']);

            if(empty($data['category'])){
                show_404();
            }

            $data['title'] = 'Edit Category';

            $this->load->view('templates/header');
            $this->load->view('category/edit', $data);
            $this->load->view('templates/footer');
        }

        public function update(){
            // Check login
            if($this->session->userdata('user_type') != 'Admin' ){
                $this->session->set_flashdata('unautorized_access', 'Only admininstrators have access to this page');
                redirect('users/login');
            }


            $this->category_model->update_category();

             // Set message
             $this->session->set_flashdata('category_updated', 'Your category has been updated.');

            redirect('categories');
        }
    }