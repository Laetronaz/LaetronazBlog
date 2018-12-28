<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class File_upload {
    //ERROR FILTERING CONST
    private const ERROR_FILTER = 'You did not select a file to upload.';
    
    public function __construct(){
        $this->CI =& get_instance();
        $this->CI->load->library('session');
        $this->CI->load->helper('directory');
    }

    //UPLOAD the images on the data files using the image_path
    public function upload_image($image_path){
        $config = $this->get_image_config($image_path,$_FILES['userfile']['name']);
        $this->CI->load->library('upload', $config);
        if(!$this->CI->upload->do_upload()){
            $this->CI->session->set_flashdata('error', array(
                'type' => 'alert-danger',
                'value' => $this->CI->upload->display_errors('','')
            ));
            redirect($_SERVER['HTTP_REFERER']);
        }
        else{
            $data = array('upload_data' => $this->CI->upload->data());
            $image = $data['upload_data']['file_name'];
        }
        return $image;
    }
    //Delete all images which aren't in $image_list array
    public function clean_unlinked_images($filepath, $image_list){
        $map = directory_map($filepath);
        foreach ($map as $key => $value) {
            if(!in_array($value, $image_list)){
                unlink($filepath.'/'.$value);
            }
        }
    }
    //CREATE the configuration to upload an image
    private function get_image_config($upload_path){
        $config['upload_path'] = $upload_path;
        $config['allowed_types'] = 'gif|jpg|png';
        $config['file_name'] = $this->create_file_name();
        $config['max_size'] = '2048';
        $config['overwrite'] =  TRUE;
        $config['remove_spaces'] = TRUE;
        return $config;
    }

    //CREATE the name of the file to be uploaded
    private function create_file_name(){ 
        $file_name = date('Tmd').'_'.md5( $_FILES['userfile']['name']. microtime());
        return $file_name;
    }  
}