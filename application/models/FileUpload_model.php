<?php
    class FileUpload_model extends CI_Model{
        public function upload_image($config){
            $this->load->library('upload', $config);

            if(!$this->upload->do_upload()){
                $errors = array('error' => $this->upload->display_errors());
                $image = NULL;
                //TODO: FILE UPLOAD ERROR GESTION
            }
            else{
                $data = array('upload_data' => $this->upload->data());
                $path = $_FILES['userfile']['name'];
                $image = preg_replace("/\s+/", "_", $config['file_name'].".".pathinfo($path, PATHINFO_EXTENSION));
            }
            return $image;
        }

        public function clean_unlinked_uploaded_image(){

        }
        //TODO: ADAPT function to others path
        public function delete_post($id){
            $image_file_name = $this->db->select('post_image')->get_where('posts', array('id' => $id))->row()->post_image;
            $cwd = getcwd(); // save current working directory
            $image_file_path= $cwd."\\assets\\images\\posts\\";
            chdir($image_file_path);
            unlink($image_file_name);
            chdir($cwd); //Restore previous working directory
            $this->db->where('id', $id);
            $this->db->delete('posts');
            return TRUE;
        }

        public function rename_uploaded_image($old_image, $image){
            rename ($old_image, $image);
        }

        public function get_image_config($upload_path, $file_name){
            $config['upload_path'] = $upload_path;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['file_name'] = $file_name;
            $config['max_size'] = '100';
            $config['overwrite'] =  TRUE;
            $config['remove_spaces'] = TRUE;
            return $config;
        }

        public function file_error_management($errors){

        }
    }