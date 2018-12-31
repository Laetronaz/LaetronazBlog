<?php
    class Categories extends CI_Controller{

        //IMAGES CONST
        private const IMAGE_PATH = './assets/images/categories';
        public const DEFAULT_IMAGE = 'noimage.jpg';

        //TITES CONST
        private const INDEX_TITLE = 'Search by Categories';
        private const MANAGE_TITLE = 'Manage Categories';
        private const CREATE_TITLE = 'Create Category';

        public function create(){
            $this->load->library('access_control');
            $this->access_control->verify_access_categories();

            $data['title'] = $this::CREATE_TITLE;
            if ($this->form_validation->run('category') === FALSE){
                $this->load->view($this->const_model::HEADER);
                $this->load->view($this->const_model::CATEGORIES_CREATE, $data);
                $this->load->view($this->const_model::FOOTER);
                $this->form_validation->reset_validation();
            } 
            else{
                $category_image = $this::DEFAULT_IMAGE;
                $category_id = $this->category_model->create_category($category_image);

                //LOG ACTIVITY
                $this->load->library('rat');
                $this->load->library('logs_builder');
                $this->rat->log($this->logs_builder->categories_create_logging($category_id), CATEGORIES_LEVEL);

                // Set message
                $message = $this->message_model->get_message('category_created');
                $this->session->set_flashdata($message['name'], $message);
                $category = $this->category_model->get_category_by_name($this->input->post('name'));
                redirect($this->const_model::CATEGORIES_EDIT.'/'.$category['id']);
            }
        }

        public function index(){//Admin only
            $this->load->library('access_control');
            $this->access_control->verify_access_categories();
            $data['title'] = $this::MANAGE_TITLE;
            $data['categories'] = $this->category_model->get_categories();
            foreach($data['categories'] as $key => $category){//set style data
                switch($category['active']){
                    case 1:
                        $data['categories'][$key]['style'] = "state-active";
                        break;
                    case 0:
                        $data['categories'][$key]['style'] = "state-inactive";
                        break;
                }
            }

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

        public function filter(){//Open for everyone
            $data['title'] = $this::INDEX_TITLE;
            $data['categories'] = $this->build_alphabetical_categories_list($this->category_model->get_categories());
            $this->load->view($this->const_model::HEADER);
            $this->load->view(CATEGORIES_FILTER_PATH, $data);
            $this->load->view($this->const_model::FOOTER);
        }

        public function delete($id){
            $this->load->library('access_control');
            $this->access_control->verify_access_categories();

            $category = $this->category_model->get_category($id);
            $this->category_model->toogle_category($id, $category['active']);
            $posts = $this->post_model->get_posts_by_category($id);

            //LOG ACTIVITY
            $this->load->library('rat');
            $this->load->library('logs_builder');
            $this->rat->log($this->logs_builder->categories_toggle_logging($category), CATEGORIES_LEVEL);

            foreach($posts as $post){
                $this->post_model->toogle_post($post['id'], $category['active']);

                //LOG ACTIVITY
                $this->load->library('rat');
                $this->load->library('logs_builder');
                $this->rat->log($this->logs_builder->posts_toggle_logging($post), CATEGORIES_LEVEL);
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
            $this->load->library('access_control');
            $this->access_control->verify_access_categories();

            $data['category'] = $this->category_model->get_category($id);
            if(empty($data['category'])){
                show_404();
            }

            $data['title'] = $data['category']['name'];
            
            if ($this->form_validation->run('category') === FALSE){
                $this->load->view($this->const_model::HEADER);
                $this->load->view($this->const_model::CATEGORIES_EDIT, $data);
                $this->load->view($this->const_model::FOOTER);
            }
            else{
                $category = $this->category_model->get_category($id);
                $new_name = $this->input->post('name');
                $this->category_model->update_category();

                //LOG ACTIVITY
                $this->load->library('rat');
                $this->load->library('logs_builder');
                $this->rat->log($this->logs_builder->categories_edit_logging($category, $new_name), CATEGORIES_LEVEL);

                // Set message
                $message = $this->message_model->get_message('category_updated');
                $this->session->set_flashdata($message['name'], $message);
                redirect($this->const_model::CATEGORIES);
            }
        }

        public function update_image(){//TODO signature should be modified to take the category_id
            $this->load->library('access_control');
            $this->access_control->verify_access_categories();

            //Upload Image
            $this->load->library('file_upload');
            $category_image =$this->file_upload->upload_image($this::IMAGE_PATH);
            if(!is_null($category_image)){
                $category = $this->category_model->get_category($this->input->post('id'));
                $this->category_model->update_category_icon($category_image);
                $this->clean_images();

                //LOG ACTIVITY
                $this->load->library('rat');
                $this->load->library('logs_builder');
                $this->rat->log($this->logs_builder->categories_update_image_logging($category), CATEGORIES_LEVEL);

                // Set message
                $message = $this->message_model->get_message('category_updated');
                $this->session->set_flashdata($message['name'], $message);
            }
            else{
                vdebug('enter here');
                // Set message
                $message = $this->message_model->get_message('image_update_failed');
                $this->session->set_flashdata($message['name'], $message);
            }
            redirect($this->const_model::CATEGORIES_EDIT.'/'.$this->input->post('id'));
        }
        //============================================= PRIVATE ========================================

        //delete all image that aren't linked to a category
        private function clean_images(){
            //SETUP the list
            $image_list = array();           
            foreach($this->category_model->get_all_icons() as $key => $value){
                array_push($image_list, $value['category_icon']);
            }
            $image_list[count($image_list)] = $this::DEFAULT_IMAGE;
            $this->load->library('file_upload');
            $this->file_upload->clean_unlinked_images($this::IMAGE_PATH,array_values($image_list));
        }

        private function build_alphabetical_categories_list($categories_list){
            $alpha_list = array();
            foreach (range('A', 'Z') as $char){
                $alpha_list[$char] = $this->category_start_with($char, $categories_list);   
            }
            return $alpha_list;
        }

        private function category_start_with($char, $categories_list){
            $category_starting_with_char = array();
            foreach(array_column($categories_list,'name') as $key => $name){
                if(strtoupper(trim(substr($name,0,1))) == $char){
                    array_push($category_starting_with_char,$categories_list[$key]);
                }
            }
            return $category_starting_with_char;
        }
    }