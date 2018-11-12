<?php
    class Posts extends CI_Controller{
        // "Constant" definitions
        //IMAGES CONST
        private const IMAGE_PATH = './assets/images/posts';
        private const DEFAULT_IMAGE = 'noimage.jpg';

        //TITLES CONST
        private const INDEX_TITLE = 'Latest Posts';
        private const CREATE_TITLE = 'Create Post';
        private const EDIT_TITLE = 'Edit Post';

        

        //MESSAGES CONST
        



        public function index($offset = 0){
            //Pagination Config
            $config['base_url'] = base_url().$this->const_model::POSTS_INDEX;
            $config['total_rows'] = $this->db->count_all('posts');
            $config['per_page'] = 10;
            $config['uri_segment'] = 3;

            //Current Page Style
            $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
            $config['cur_tag_close'] = '</a></li>';

            //Digit Style
            $config['num_tag_open'] = '<li class="page-item">';
            $config['num_tag_close'] = '</li>';

            //Element styles
            $config['attributes'] = array('class' => 'page-link');

            $config['prev_link'] = '«';
            $config['next_link'] = '»';

            //Init Pagination
            $this->pagination->initialize($config);

            $data['title'] = $this::INDEX_TITLE;

            $data['posts'] = $this->post_model->get_posts(FALSE, $config['per_page'], $offset);

            $this->load->view($this->const_model::HEADER);
            $this->load->view($this->const_model::POSTS_INDEX, $data);
            $this->load->view($this->const_model::FOOTER);
        }

        public function view($slug = NULL){
            $data['post'] = $this->post_model->get_posts($slug);
            $post_id = $data['post']['id'];

            if(empty($data['post'])){
                show_404();
            }

            $data['title'] = $data['post']['title'];

            $this->load->view($this->const_model::HEADER);
            $this->load->view($this->const_model::POSTS_VIEW, $data);
            $this->load->view($this->const_model::FOOTER);
        }

        public function create(){
            // Check login
            if(!$this->session->userdata('logged_in')){
                redirect($this->const_model::USERS_LOGIN);
            }

            $data['title'] = $this::CREATE_TITLE;

            $data['categories'] = $this->post_model->get_categories();

            $this->form_validation->set_rules('title', 'Title', 'required');           
            $this->form_validation->set_rules('body', 'Body', 'required');

            if ($this->form_validation->run() === FALSE) {
                $this->load->view($this->const_model::HEADER);
                $this->load->view($this->const_model::POSTS_CREATE, $data);
                $this->load->view($this->const_model::FOOTER);  
            }
            else{

                //Upload Image
                $config = $this->fileupload_model->get_image_config($this::IMAGE_PATH,$this->input->post('title'));
                $post_image = $this->fileupload_model->upload_image($config);
                
                //Only need on the creation
                if(is_null($post_image)){
                    $post_image = $this::DEFAULT_IMAGE;
                }

                $this->post_model->create_post($post_image);

                // Set message
                $message = $this->message_model->get_message('post_created');
                $this->session->set_flashdata($message['name'], $message);

                redirect($this->const_model::POSTS);
            }
        }

        public function delete($id){
            // Check login
            if(!$this->session->userdata('logged_in')){
                redirect($this->const_model::USERS_LOGIN);
            }
            $post = $this->post_model->get_post($id);
            $this->post_model->toogle_post($id, $post['active']);

            // Set message
            if($post['active'] == TRUE){
                $message = $this->message_model->get_message('post_disabled');
            }
            else{
                $message = $this->message_model->get_message('post_enabled');
            }
            $this->session->set_flashdata($message['name'], $message);

            redirect($this->const_model::POSTS);
        }

        public function edit($slug){
            // Check login
            if(!$this->session->userdata('logged_in')){
                redirect($this->const_model::USERS_LOGIN);
            }

            // Check user
            if($this->session->userdata('user_id') != $this->post_model->get_posts($slug)['user_id']){
                redirect($this->const_model::POSTS);
            }

            $data['post'] = $this->post_model->get_posts($slug);
            $data['categories'] = $this->post_model->get_categories();

            if(empty($data['post'])){
                show_404();
            }

            $data['title'] = $this::EDIT_TITLE;

            $this->load->view($this->const_model::HEADER);
            $this->load->view($this->const_model::POSTS_EDIT, $data);
            $this->load->view($this->const_model::FOOTER);
        }

        public function update(){
            // Check login
            if(!$this->session->userdata('logged_in')){
                redirect($this->const_model::USERS_LOGIN);
            }

            //Upload Image
            $config = $this->fileupload_model->get_image_config('./assets/images/posts',$this->input->post('title'));
            $post_image = $this->fileupload_model->upload_image($config);
            $old_post = $this->post_model->get_post($this->input->post('id'));
            $old_image = $old_post['post_image'];
            if($post_image != $old_image){

            }

            $this->post_model->update_post($post_image);

             // Set message
             $message = $this->message_model->get_message('post_updated');
             $this->session->set_flashdata($message['name'], $message);

            redirect($this->const_model::POSTS);
        }

    }