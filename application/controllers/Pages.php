<?php
    class Pages extends CI_Controller{
        public function view($page = 'home'){
            if(!file_exists(APPPATH.'views/pages/'.$page.'.php')){
                show_404();
            }

            $data['title'] = ucfirst($page);

            $this->load->view(TEMPLATE_HEADER_VIEW);
            $this->load->view(PAGES_VIEW.$page, $data);
            $this->load->view(TEMPLATE_FOOTER_VIEW);
        }
    }