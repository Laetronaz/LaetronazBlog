<?php
    class Tags extends CI_Controller{
        private const INDEX_TITLE = "Search by Tags";


        public function filter(){
            $data['title'] = $this::INDEX_TITLE;
            $data['tags'] = $this->build_alphabetical_tags_list($this->tag_model->get_tags_list());
            $this->load->view($this->const_model::HEADER);
            $this->load->view(TAGS_FILTER_PATH, $data);
            $this->load->view($this->const_model::FOOTER);
        }
        
        public function view($tag_id){
            $tag = $this->tag_model->get_tag($tag_id);
            $posts = $this->post_model->get_posts_by_tag($tag_id);
            if($posts === FALSE){
                // Set message
                $message = $this->message_model->get_message('tag_invalid');
                $this->session->set_flashdata($message['name'], $message);
                redirect(TAGS_FILTER_ROUTE);
            }
            else{
                $data['title'] = $tag['title'];
                $data['posts'] = $posts;
                $data['uses'] = count($posts);
    
                $this->load->view($this->const_model::HEADER);
                $this->load->view(TAGS_VIEW_PATH, $data);
                $this->load->view($this->const_model::FOOTER);
            } 
        }

        
        private function build_alphabetical_tags_list($tags_list){
            $alpha_list = array();
            foreach (range('A', 'Z') as $char){
                $alpha_list[$char] = $this->tag_start_with($char, $tags_list);   
            }
            return $alpha_list;
        }

        private function tag_start_with($char, $tags_list){
            $tag_starting_with_char = array();
            foreach(array_column($tags_list,'title') as $key => $title){
                if(strtoupper(trim(substr($title,0,1))) == $char){
                    array_push($tag_starting_with_char,$tags_list[$key]);
                }
            }
            return $tag_starting_with_char;
        }
    }