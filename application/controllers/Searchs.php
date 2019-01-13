<?php
    class Searchs extends CI_Controller{
       
        public function search(){
            if($this->form_validation->run('search') === TRUE){
                $search_string = $this->input->post('search');
                $data['title'] = "Search result for: ".$search_string;
                $data['posts'] = $this->search_model->search_posts_titles($search_string);
                $data['categories'] = $this->search_model->search_categories_names($search_string);
                $data['tags'] = $this->search_model->search_tags_names($search_string);
                $data['users'] = $this->search_model->search_users_usernames($search_string);
                $data['research'] = $search_string;
                $this->load->view(TEMPLATE_HEADER_VIEW);
                $this->load->view(SEARCH_PATH, $data);
                $this->load->view(TEMPLATE_FOOTER_VIEW);
            }
            else{
                if(is_null($_SERVER['HTTP_REFERER']) || $_SERVER['HTTP_REFERER'].SEARCH_FUNC){
                    redirect('');
                }
                else{
                    redirect($_SERVER['HTTP_REFERER']);//redirect to the page where the search was sent.
                }
            }
        }
    }