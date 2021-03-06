<?php
    class Posts extends CI_Controller{
        //IMAGES CONST
        private const IMAGE_PATH = './assets/images/posts';
        public const DEFAULT_IMAGE = 'noimage.jpg';

        //TITLES CONST
        private const INDEX_TITLE = 'Latest Posts';
        private const CREATE_TITLE = 'Create Post';
        private const EDIT_TITLE = 'Edit Post: ';
        private const USER_INDEX_TITLE = 'Manage All Posts';
        private const USER_POSTS_INDEX_TITLE = 'Manage My Posts';

        //====================================CRUD====================================
        public function index($offset = 0){
            //Pagination config
            $config = $this->create_pagination_config(base_url());
            //Init Pagination
            $this->pagination->initialize($config);
            $data['title'] = $this::INDEX_TITLE;
            $data['posts'] = $this->post_model->get_active_posts(FALSE, $config['per_page'], $offset);

            $this->load->view(TEMPLATE_HEADER_VIEW);
            $this->load->view(POSTS_INDEX_VIEW,$data);
            $this->load->view(TEMPLATE_FOOTER_VIEW);
        }

        public function user_index(){
            //check user access
            $this->load->library('access_control');
            $this->access_control->verify_access_posts('user_index');
            $data['title'] = $this::USER_POSTS_INDEX_TITLE;
            $data['categories'] = $this->post_model->get_categories();
            $data['posts'] = $this->post_model->get_user_posts($this->session->userdata('user_id'));
            foreach($data['posts'] as $key => $post){//set style data
                switch($post['state']){
                    case 1:
                        $data['posts'][$key]['style'] = STATE_ACTIVE;
                        break;
                    case 0:
                        $data['posts'][$key]['style'] = STATE_INACTIVE;
                        break;
                }
            }

            $this->load->view(TEMPLATE_HEADER_VIEW);
            $this->load->view(POSTS_USERINDEX_VIEW, $data);
            $this->load->view(TEMPLATE_FOOTER_VIEW);
        }

        public function all_index(){
            //check user access
            $this->load->library('access_control');
            $this->access_control->verify_access_posts('all_index');
            $data['posts'] = $this->post_model->get_posts();
            $data['title'] = $this::USER_INDEX_TITLE;
            $data['categories'] = $this->post_model->get_categories();

            foreach($data['posts'] as $key => $post){//set style data
                switch($post['state']){
                    case 1:
                        $data['posts'][$key]['style'] = STATE_ACTIVE;
                        break;
                    case 0:
                        $data['posts'][$key]['style'] = STATE_INACTIVE;
                        break;
                }
            }

            $this->load->view(TEMPLATE_HEADER_VIEW);
            $this->load->view(POSTS_USERINDEX_VIEW, $data);
            $this->load->view(TEMPLATE_FOOTER_VIEW);
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

            $this->load->view(TEMPLATE_HEADER_VIEW);
            $this->load->view(POSTS_VIEW, $data);
            $this->load->view(TEMPLATE_FOOTER_VIEW);
        }

        public function create(){
            //check user access
            $this->load->library('access_control');
            $this->access_control->verify_access_posts('create');

            $data['title'] = $this::CREATE_TITLE;
            $data['categories'] = $this->post_model->get_categories();

            if ($this->form_validation->run('post') === FALSE) {
                $this->load->view(TEMPLATE_HEADER_VIEW);
                $this->load->view(POSTS_CREATE_VIEW, $data);
                $this->load->view(TEMPLATE_FOOTER_VIEW);  
            }
            else{
                //CREATE THE POST
                $post_image = $this::DEFAULT_IMAGE;
                $post_id = $this->post_model->create_post($post_image);
                $post = $this->post_model->get_post($post_id);
                //MANAGE THE TAGS
                $post_tags = $this->create_tags_array();
                $this->update_relationships($post_id,$post_tags); 

                //LOG ACTIVITY
                $this->load->library('rat');
                $this->load->library('logs_builder');
                $this->rat->log($this->logs_builder->posts_create_logging($post), POSTS_LEVEL);

                // Set message
                $message = $this->message_model->get_message('post_created');
                $this->session->set_flashdata($message['name'], $message);

                redirect(POSTS_VIEW_PATH.url_title($this->input->post('title')));
            }
        }

        public function toggle($id){
            $post = $this->post_model->get_post($id);

            //check user access
            $this->load->library('access_control');
            $this->access_control->verify_access_posts('post');        
            
            $this->post_model->toogle_post($id, $post['state']);
            
            //LOG ACTIVITY
            $this->load->library('rat');
            $this->load->library('logs_builder');
            $this->rat->log($this->logs_builder->posts_toggle_logging($post), POSTS_LEVEL);

            // Set message
            $message = ($post['state'] == TRUE) ? $this->message_model->get_message('post_disabled'): $this->message_model->get_message('post_enabled');
            
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
            
            $data['title'] = $this::EDIT_TITLE.$data['post']['title'];
            if ($this->form_validation->run('post') === FALSE) {
                $this->load->view(TEMPLATE_HEADER_VIEW);
                $this->load->view(POSTS_EDIT_VIEW, $data);
                $this->load->view(TEMPLATE_FOOTER_VIEW);
            }
            else {
                $post_tags = $this->create_tags_array();
                $new_slug = $this->post_model->update_post();

                //LOG ACTIVITY
                $this->load->library('rat');
                $this->load->library('logs_builder');
                $this->rat->log($this->logs_builder->posts_edit_logging($data['post']), POSTS_LEVEL);

                $this->update_relationships($this->input->post('id'),$post_tags); 
                
                // Set message
                $message = $this->message_model->get_message('post_updated');
                $this->session->set_flashdata($message['name'], $message);
                redirect(base_url().POSTS_EDIT_PATH.$new_slug);
            }
        }
        

        //======================================IMAGES======================================
        public function update_image($post_id){
            //check user access
            $this->load->library('access_control');
            $this->access_control->verify_access_posts('update_image');

            //Upload Image
            $this->load->library('file_upload');
            $post = $this->post_model->get_post($post_id);
            $post_image = $this->file_upload->upload_image($this::IMAGE_PATH);
            if(!is_null($post_image)){  
                $this->post_model->update_post_image($post_id,$post_image);

                //LOG ACTIVITY
                $this->load->library('rat');
                $this->load->library('logs_builder');
                $this->rat->log($this->logs_builder->posts_update_thumbnail_logging($post), POSTS_LEVEL);

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
            $post = $this->post_model->get_post($post_id);
            redirect(POSTS_EDIT_PATH.$post['slug']);  
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
            $post = $this->post_model->get_post($post_id);
            $db_tags_list = $this->get_post_tags($post_id);
            $relationships = $this->tag_model->get_relationships($post_id);
            $all_tags_list = array_column($this->tag_model->get_tags_list(),'title');
            
            //Check for differences between the DB tags and the local tags for a post
            $array_db_diff = array_diff(array_column($db_tags_list,'title'),$current_tags_list);
            //Check for differences between the local tags and the DB tags for a post
            $array_current_diff = array_diff($current_tags_list,array_column($db_tags_list,'title'));
            
            if(!empty($array_db_diff)){//if there's a tag was removed from the list
                foreach($array_db_diff as $tag){
                    if(!empty($tag)){
                        $key = array_search($tag, array_column($db_tags_list,'title'));//key of the tag to remove
                        $this->tag_model->unlink_post_from_tag($post_id,$db_tags_list[$key]['id']);//remove the tag
                        //LOG ACTIVITY
                        $this->load->library('rat');
                        $this->load->library('logs_builder');
                        $this->rat->log($this->logs_builder->delink_tag_from_post_logging($db_tags_list[$key],$post), TAGS_LEVEL);
                    }
                }
            }
            if(!empty($array_current_diff)){//if there's a new tag added to the list
                foreach($array_current_diff as $tag){//for each tag
                    $existing_tag = $this->tag_model->get_tag_by_title($tag);
                    if(empty($existing_tag)){//if tag does not exists
                        //create the tag
                        $this->tag_model->create_tag($tag);
                        $existing_tag = $this->tag_model->get_tag_by_title($tag);

                        //LOG ACTIVITY
                        $this->load->library('rat');
                        $this->load->library('logs_builder');
                        $this->rat->log($this->logs_builder->tags_create_logging($existing_tag), TAGS_LEVEL);
                    }
                    $id = $existing_tag['id'];//get the tag_id
                    $this->tag_model->link_post_to_tag($post_id, $id);//then link the tag to the post
                
                    //LOG ACTIVITY
                    $this->load->library('rat');
                    $this->load->library('logs_builder');
                    $this->rat->log($this->logs_builder->link_tag_to_post_logging($existing_tag,$post), TAGS_LEVEL);
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
            $config['use_page_numbers'] = TRUE;
            $config['per_page'] = 10;
            $config['uri_segment'] = 1;

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