<?php
    class FileUpload_model extends CI_Model{
        //ERROR FILTERING CONST
        private const ERROR_FILTER = 'You did not select a file to upload.';
        //You did not select a file to upload.
        //You did not select a file to upload.
        
        public function upload_image($image_path){
            $config = $this->get_image_config($image_path,$_FILES['userfile']['name']);
            $this->load->library('upload', $config);
            if(!$this->upload->do_upload()){
                $this->session->set_flashdata('error', array(
                    'type' => 'alert-danger',
                    'value' => $this->upload->display_errors('','')
                ));
                redirect($_SERVER['HTTP_REFERER']);
            }
            else{
                $data = array('upload_data' => $this->upload->data());
                $image = $data['upload_data']['file_name'];
            }
            return $image;
        }

        public function clean_unlinked_uploaded_image($filepath){
            $this->load->helper('directory');
            $map = directory_map($filepath);
            $saved_images = '';
            vdebug($map);
        }

        private function get_image_config($upload_path){
            $config['upload_path'] = $upload_path;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['file_name'] = $this->create_file_name();
            $config['max_size'] = '2048';
            $config['overwrite'] =  TRUE;
            $config['remove_spaces'] = TRUE;
            return $config;
        }

        private function create_file_name(){ 
            $file_name = date('Tmd').'_'.md5( $_FILES['userfile']['name']. microtime());
            return $file_name;
        }        
    }