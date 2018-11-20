<?php
    class Categories extends CI_Controller{

        //IMAGES CONST
        private const IMAGE_PATH = './assets/images/categories';
        public const DEFAULT_IMAGE = 'noimage.jpg';

        //TITES CONST
        private const INDEX_TITLE = 'Search by Categories';
        private const CREATE_TITLE = 'Create Category';

        public function create(){
             // Check login
            if($this->session->userdata('user_type') != 'Admin' ){
                $message = $this->message_model->get_unauthorized_access();
                $this->session->set_flashdata($message['name'], $message);
                redirect($this->const_model::USERS_LOGIN);
            }

            $data['title'] = $this::CREATE_TITLE;
            $this->form_validation->set_rules('name', 'Name', 'required');
            if ($this->form_validation->run() === FALSE){
                $this->load->view($this->const_model::HEADER);
                $this->load->view($this->const_model::CATEGORIES_CREATE, $data);
                $this->load->view($this->const_model::FOOTER);
            } 
            else{
                $category_image = $this::DEFAULT_IMAGE;
                $this->category_model->create_category($category_image);

                // Set message
                $message = $this->message_model->get_message('category_created');
                $this->session->set_flashdata($message['name'], $message);
                $category = $this->category_model->get_category_by_name($this->input->post('name'));
                redirect($this->const_model::CATEGORIES_EDIT.'/'.$category['id']);
            }
        }

        public function index(){
            $data['title'] = $this::INDEX_TITLE;
            $data['categories'] = $this->category_model->get_categories();

            $this->load->view($this->const_model::HEADER);
            $this->load->view($this->const_model::CATEGORIES_INDEX, $data);
            $this->load->view($this->const_model::FOOTER);
        }

        public function posts($id){
            $data['title'] = $this->category_model->get_category($id)['name'];
            $data['posts'] = $this->post_model->get_posts_by_category($id);

            $this->load->view($this->const_model::HEADER);
            $this->load->view($this->const_model::POSTS_INDEX, $data);
            $this->load->view($this->const_model::FOOTER);
        }

        public function delete($id){
            // Check login
            if($this->session->userdata('user_type') != 'Admin' ){
                $message = $this->message_model->get_unauthorized_access();
                $this->session->set_flashdata($message['name'], $message);
                redirect($this->const_model::USERS_LOGIN);
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
            redirect($this->const_model::CATEGORIES);
        }

        public function edit($id){
            // Check login
            if($this->session->userdata('user_type') != 'Admin' ){
                $message = $this->message_model->get_unauthorized_access();
                $this->session->set_flashdata($message['name'], $message);
                redirect($this->const_model::USERS_LOGIN);
            }

            $data['category'] = $this->category_model->get_category($id);
            
            if(empty($data['category'])){
                show_404();
            }

            $data['title'] = $data['category']['name'];

            $this->load->view($this->const_model::HEADER);
            $this->load->view($this->const_model::CATEGORIES_EDIT, $data);
            $this->load->view($this->const_model::FOOTER);
        }


        public function update(){
            // Check login
            if($this->session->userdata('user_type') != 'Admin' ){
                $message = $this->message_model->get_unauthorized_access();
                $this->session->set_flashdata($message['name'], $message);
                redirect($this->const_model::USERS_LOGIN);
            }
            $this->category_model->update_category();

             // Set message
             $message = $this->message_model->get_message('category_updated');
             $this->session->set_flashdata($message['name'], $message);
            
            redirect($this->const_model::CATEGORIES);
        }

        public function update_image(){
            // Check login
            if(!$this->session->userdata('logged_in')){
                redirect($this->const_model::USERS_LOGIN);
            }
            
            //Upload Image
            $category_image = $this->fileupload_model->upload_image($this::IMAGE_PATH);
            $this->category_model->update_category_icon($category_image);
            // Set message
            $message = $this->message_model->get_message('category_updated');
            $this->session->set_flashdata($message['name'], $message);

            $this->clean_images();
            redirect($this->const_model::CATEGORIES_EDIT.'/'.$this->input->post('id'));
        }

        //delete all image that aren't linked to a category
        private function clean_images(){
            //SETUP the list
            $image_list = array();           
            foreach($this->category_model->get_all_icons() as $key => $value){
                array_push($image_list, $value['category_icon']);
            }
            $image_list[count($image_list)] = $this::DEFAULT_IMAGE;
            $this->fileupload_model->clean_unlinked_images($this::IMAGE_PATH,array_values($image_list));
        }
    }