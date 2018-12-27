<?php
    class Roles extends CI_Controller{
        public function create(){
            //check user access
            $this->load->library('access_control');
            $this->access_control->verify_access_roles();

            if (!$this->form_validation->run('role') === FALSE) {
                $role_id = $this->role_model->create_role($this->input->post('name'));
                foreach($this->input->post() as $right_name => $right_id){
                    if($right_name != "name"){
                        $this->role_model->add_role_rights($role_id,$right_id);
                    }
                }
                // Set message
                $message = $this->message_model->get_message('new_role_success');
                $this->session->set_flashdata($message['name'], $message);
                redirect(ROLES_INDEX_PATH);
            }
            else{
                $this->index();
            }
        }

        public function edit($id){
            //check user access
            $this->load->library('access_control');
            $this->access_control->verify_access_roles();

            if (!$this->form_validation->run('role') === FALSE) {
                if($id != 1){ //cannot edit admin at all
                    $initial_role =$this->role_model->get_role($id);
                    $sent_array = $this->input->post();
                    if(!empty($initial_role)){
                        $role_rights = $this->role_model->get_role_rights($id);
                        if ($initial_role['name'] != $sent_array['name']){
                            $this->role_model->update_role($id,$sent_array['name']);
                        }
                        unset($sent_array['name']);
                        $new_rights = array_diff($sent_array,array_column($role_rights,'id'));
                        if(!empty($new_rights)){//new rights added
                            foreach($new_rights as $right_id){
                                $this->role_model->add_role_rights($id, $right_id);
                            }
                        }
                        $removed_rights = array_diff(array_column($role_rights,'id'),$sent_array);
                        if(!empty($removed_rights)){//rights removed
                            foreach($removed_rights as $right_id){
                                $this->role_model->remove_role_rights($id,$right_id);
                            }
                        }
                        array_column($role_rights,'name');
                        $message = $this->message_model->get_message('role_change_success');
                        $this->session->set_flashdata($message['name'], $message);
                    }
                    else{
                        $message = $this->message_model->get_message('role_does_not_exists');
                        $this->session->set_flashdata($message['name'], $message);
                    }
                }
                else{
                    // Set message
                    $message = $this->message_model->get_message('role_admin');
                    $this->session->set_flashdata($message['name'], $message);
                }
                redirect(ROLES_INDEX_PATH);
            }
            else{
                $this->index();
            }
            
        }
        public function index(){
            //check user access
            $this->load->library('access_control');
            $this->access_control->verify_access_roles();

            $roles = $this->role_model->get_roles();
            $data['roles'] = $this->build_role_rights_array($roles);
            $data['rights'] = $this->role_model->get_rights();

            $this->load->view($this->const_model::HEADER);
            $this->load->view(ROLES_INDEX_FUNC, $data);
            $this->load->view($this->const_model::FOOTER);
        }

        public function delete($id){
            //check user access
            $this->load->library('access_control');
            $this->access_control->verify_access_roles();
            
            if(!empty($this->role_model->get_role($id))){
                $this->role_model->delete_role_rights($id);
                $this->role_model->delete_role($id);

                // Set message
                $message = $this->message_model->get_message('role_delete_success');
                $this->session->set_flashdata($message['name'], $message);
            }
            else{
                $message = $this->message_model->get_message('role_does_not_exists');
                $this->session->set_flashdata($message['name'], $message);
            }
            redirect(ROLES_INDEX_PATH);
        }

        private function build_role_rights_array($role_array){
            $role_rights = array();
            foreach($role_array as $key => $role){
                $role_array[$key]['rights'] = $this->role_model->get_role_rights($role['id']);
            }
            return $role_array;
        }

        
    }