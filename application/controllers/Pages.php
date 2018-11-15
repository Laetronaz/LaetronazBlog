<?php
    class Pages extends CI_Controller{
        public function view($page = 'home'){
            if(!file_exists(APPPATH.'views/pages/'.$page.'.php')){
                show_404();
            }

            $data['title'] = ucfirst($page);

            $this->load->view($this->const_model::HEADER);
            $this->load->view($this->const_model::PAGES.$page, $data);
            $this->load->view($this->const_model::FOOTER);
        }
    }