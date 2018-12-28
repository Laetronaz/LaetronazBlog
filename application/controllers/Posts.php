<?php
    class Posts extends CI_Controller{
        //IMAGES CONST
        private const IMAGE_PATH = './assets/images/posts';
        public const DEFAULT_IMAGE = 'noimage.jpg';

        //TITLES CONST
        private const INDEX_TITLE = 'Latest Posts';
        private const CREATE_TITLE = 'Create Post';
        private const EDIT_TITLE = 'Edit Post';
        private const USER_INDEX_TITLE = 'Manage Posts';

        //====================================CRUD====================================
        public function index($offset = 0){
            //Pagination config
            $config = $this->create_pagination_config(base_url().$this->const_model::POSTS_INDEX);
            //Init Pagination
            $this->pagination->initialize($config);

            $data['title'] = $this::INDEX_TITLE;
            $data['posts'] = $this->post_model->get_active_posts(FALSE, $config['per_page'], $offset);
            //$data['posts'] = $this->post_model->get_posts(FALSE, $config['per_page'], $offset);

            $this->load->view($this->const_model::HEADER);
            $this->load->view($this->const_model::POSTS_INDEX, $data);
            $this->load->view($this->const_model::FOOTER);
        }

        public function user_index(){
            //check user access
            $this->load->library('access_control');
            $this->access_control->verify_access_posts('user_index');

            //Pagination config
            $config = $this->create_pagination_config(base_url().$this->const_model::POSTS_INDEX);
            //Init Pagination
            $this->pagination->initialize($config);
            $data['posts'] = $this->post_model->get_user_posts($this->session->userdata('user_id'));
            $data['title'] = $this::USER_INDEX_TITLE;
            $data['categories'] = $this->post_model->get_categories();

            foreach($data['posts'] as $key => $post){//set style data
                switch($post['state']){
                    case 1:
                        $data['posts'][$key]['style'] = "state-active";
                        break;
                    case 0:
                        $data['posts'][$key]['style'] = "state-inactive";
                        break;
                }
            }

            $this->load->view($this->const_model::HEADER);
            $this->load->view($this->const_model::POSTS_USER_INDEX, $data);
            $this->load->view($this->const_model::FOOTER);
        }

        public function all_index(){
            //check user access
            $this->load->library('access_control');
            $this->access_control->verify_access_posts('all_index');
            //Pagination config
            $config = $this->create_pagination_config(base_url().$this->const_model::POSTS_INDEX);
            //Init Pagination
            $this->pagination->initialize($config);
            $data['posts'] = $this->post_model->get_posts();
            $data['title'] = $this::USER_INDEX_TITLE;
            $data['categories'] = $this->post_model->get_categories();

            foreach($data['posts'] as $key => $post){//set style data
                switch($post['state']){
                    case 1:
                        $data['posts'][$key]['style'] = "state-active";
                        break;
                    case 0:
                        $data['posts'][$key]['style'] = "state-inactive";
                        break;
                }
            }

            $this->load->view($this->const_model::HEADER);
            $this->load->view($this->const_model::POSTS_USER_INDEX, $data);
            $this->load->view($this->const_model::FOOTER);
        }


        public function view($slug = NULL){
            $data['post'] = $this->post_model->get_posts($slug);
            $post_id = $data['post']['id'];
            $data['post_tags'] = $this->get_post_tags($post_id);

            if(empty($data['post'])){
                show_404();
            }

            $data['title'] = $data['post']['title'];
            $data['tags'] =  $this->tag_model->get_tags_from_list(array_column($this->tag_model->get_post_tags($post_id),'tag_id'));

            $this->load->view($this->const_model::HEADER);
            $this->load->view($this->const_model::POSTS_VIEW, $data);
            $this->load->view($this->const_model::FOOTER);
        }

        public function create(){
            //check user access
            $this->load->library('access_control');
            $this->access_control->verify_access_posts('create');

            $data['title'] = $this::CREATE_TITLE;
            $data['categories'] = $this->post_model->get_categories();

            if ($this->form_validation->run('post') === FALSE) {
                $this->load->view($this->const_model::HEADER);
                $this->load->view($this->const_model::POSTS_CREATE, $data);
                $this->load->view($this->const_model::FOOTER);  
            }
            else{
                //CREATE THE POST
                $post_image = $this::DEFAULT_IMAGE;
                $post_id = $this->post_model->create_post($post_image);

                //CREATE THE TAGS
                $post_tags = $this->create_tags_array();
                $this->update_relationships($post_id,$post_tags); 

                // Set message
                $message = $this->message_model->get_message('post_created');
                $this->session->set_flashdata($message['name'], $message);

                redirect($this->const_model::POSTS_EDIT.'/'.url_title($this->input->post('title')));
            }
        }

        public function toggle($id){
            $post = $this->post_model->get_post($id);

            //check user access
            $this->load->library('access_control');
            $this->access_control->verify_access_posts('post');        
            
            $this->post_model->toogle_post($id, $post['state']);

            // Set message
            if($post['state'] == TRUE){
                $message = $this->message_model->get_message('post_disabled');
            }
            else{
                $message = $this->message_model->get_message('post_enabled');
            }
            $this->session->set_flashdata($message['name'], $message);
            redirect($_SERVER['HTTP_REFERER']);
        }

        public function edit($slug){
            $data['post'] = $this->post_model->get_posts($slug);
            $data['categories'] = $this->post_model->get_categories();
            $data['post_tags'] = $this->get_post_tags($data['post']['id']);
            
            //check user access
            $this->load->library('access_control');
            $this->access_control->verify_access_posts('edit');

            if(empty($data['post'])){
                show_404();
            }
            
            $data['title'] = $data['post']['title'];
            if ($this->form_validation->run('post') === FALSE) {
                $this->load->view($this->const_model::HEADER);
                $this->load->view($this->const_model::POSTS_EDIT, $data);
                $this->load->view($this->const_model::FOOTER);
            }
            else {
                $post_tags = $this->create_tags_array();
                $this->post_model->update_post();
                $this->update_relationships($this->input->post('id'),$post_tags); 
                
                // Set message
                $message = $this->message_model->get_message('post_updated');
                $this->session->set_flashdata($message['name'], $message);
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
        

        //======================================IMAGES======================================
        public function update_image(){
            //check user access
            $this->load->library('access_control');
            $this->access_control->verify_access_posts('update_image');

            //Upload Image
            $this->load->library('file_upload');
            
            $post_image = $this->file_upload->upload_image($this::IMAGE_PATH);
            if(!is_null($post_image)){  
                $this->post_model->update_post_image($post_image);
                // Set message
                $message = $this->message_model->get_message('post_updated');
                $this->session->set_flashdata($message['name'], $message);
                
                $this->clean_images();
            }
            else{
                // Set message
                $message = $this->message_model->get_message('image_update_failed');
                $this->session->set_flashdata($message['name'], $message);
            }
            $post = $this->post_model->get_post($this->input->post('id'));
            redirect($this->const_model::POSTS_EDIT.'/'.$post['slug']);  
        }

        //Remove all images that aren't linked to a post
        private function clean_images(){
            //SETUP the list
            $image_list = array();           
            foreach($this->post_model->get_all_images() as $key => $value){
                array_push($image_list, $value['post_image']);
            }
            $image_list[count($image_list)] = $this::DEFAULT_IMAGE;
            $this->load->library('file_upload');
            $this->file_upload->clean_unlinked_images($this::IMAGE_PATH,array_values($image_list));
        }

        //======================================TAGS====================================== 
        //create a list of tag from the input string
        private function create_tags_array(){
            return array_map('trim',explode(",",$this->input->post('tagsinput')));
        }

        private function update_relationships($post_id, $current_tags_list){
            $db_tags_list = $this->get_post_tags($post_id);
            $relationships = $this->tag_model->get_relationships($post_id);
            $all_tags_list = array_column($this->tag_model->get_tags_list(),'title');
            
            //Check for differences between the DB tags and the local tags for a post
            $array_db_diff = array_diff(array_column($db_tags_list,'title'),$current_tags_list);
            //Check for differences between the local tags and the DB tags for a post
            $array_current_diff = array_diff($current_tags_list,array_column($db_tags_list,'title'));
            
            if(!empty($array_db_diff)){//if there's a tag was removed from the list
                foreach($array_db_diff as $tag){
                    $key = array_search($tag, array_column($db_tags_list,'title'));//key of the tag to remove
                    $this->tag_model->unlink_post_from_tag($post_id,$db_tags_list[$key]['id']);//remove the tag
                }
            }
            if(!empty($array_current_diff)){//if there's a new tag added to the list
                foreach($array_current_diff as $tag){//for each tag
                    $existing_tag = $this->tag_model->get_tag_by_title($tag);
                    if(empty($existing_tag)){//if tag does not exists
                        //create the tag
                        $this->tag_model->create_tag($tag);
                        $existing_tag = $this->tag_model->get_tag_by_title($tag);
                    }
                    $id = $existing_tag['id'];//get the tag_id
                    $this->tag_model->link_post_to_tag($post_id, $id);//then link the tag to the post
                }
            }
        }
        //Get all tag linked to a single post and format it so only the title is left
        private function get_post_tags($id){
            $tags = array();
            foreach($this->tag_model->get_post_tags($id) as $value){ 
                array_push($tags,$this->tag_model->get_tag($value['tag_id']));
            }
            return $tags;
        }

        //======================================CONFIGS====================================== 
        private function create_pagination_config($base_url){   
            //Pagination Config
            $config['base_url'] = $base_url;
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

            return $config;
        }
    }