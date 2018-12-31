<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logs_builder {
    protected $CI;
    //USERS
    private const USER_REGISTER_LOG = "$1 has registered a new user '$2' with user_id '$3'.";
    private const USER_EDIT_LOG = "$1 has edited user '$2' with user_id '$3'.";
    private const USER_TOGGLE_LOG = "$1 has toggled user '$2' with user_id: '$3' from state '$4' to state '$5'.";
    private const USERNAME_CHANGE_LOG = "$1 has changed username from '$2' to '$3' of user '$4' with user id: $5.";
    private const EMAIL_CHANGE_LOG = "$1 has changed email from '$2' to '$3' of user '$4' with user_id: '$5'.";  
    private const PASSWORD_CHANGE_LOG = "$1 has changed password of user '$2' with user_id: '$3'.";
    private const CONFIRM_EMAIL_LOG = "$1 with user_id '$2' has confirmed his email.";  
    private const RESEND_CONFIRM_EMAIL_LOG = "$1 with user_id '$2' requested a new confirmation email.";  
    private const PASSWORD_RECOVERY_LOG = "$1 with user_id '$2' requested a password recovery.";
    private const RESEND_PASSWORD_RECOVERY_LOG = "$1 with user_id '$2' requested a new password recovery email.";  
    //CATEGORIES
    private const CATEGORY_CREATE_LOG = "$1 has created a new category '$2' with the category_id '$3'";
    private const CATEGORY_TOGGLE_LOG = "$1 has toggled categoriy '$2' with category_id: '$3' from state '$4' to state '$5'.";
    private const CATEGORY_EDIT_LOG = "$1 has edited category name from '$2' to '$3' with category_id: '$4'.";
    private const CATEGORY_UPDATE_IMAGE_LOG = "$1 has updated the category image of '$2' with category_id $3.";
    //POSTS
    private const POST_CREATE_LOG = "$1 has created a new post '$2' with the post_id '$3'.";
    private const POST_EDIT_LOG = "$1 has edited the post '$2' with the post_id '$3'.";
    private const POST_TOGGLE_LOG = "$1 has toggled the post '$2' from the state '$3' to '$4' with the post_id '$5'.";
    private const POST_UPDATE_IMAGE_LOG = "$1 has updated the thumbnail image of the post '$2' with post_id '$3'.";

    //TAGS
    private const TAG_CREATE_LOG = "$1 has created a new tag '$2' with the tag_id '$3'.";
    private const TAG_DELETE_LOG = "$1 has delete the tag '$2' with the tag_id '$3'.";
    private const TAG_ADDED_LOG = "$1 has added the tag '$2' with tag_id '$3' to the post '$4' with post_id '$5'.";
    private const TAG_REMOVED_LOG = "$1 has removed the tag '$2' with tag_id '$3' from the post '$4' with post_id '$5'.";
    
    //ROLES
    private const ROLE_CREATE_LOG = "$1 has created a new role '$2' with the role_id '$3'.";
    private const ROLE_DELETE_LOG = "$1 has deleted the role '$2' with the role_id '$3'.";
    private const ROLE_EDIT_LOG = "$1 has edited the role name '$2' to '$3' with the role_id '$4'.";
    private const ROLE_ATTEMPT_LOG = "$1 has attempted to deleted the role '$2' with the role_id '$3' but failed.";
    private const NEW_RIGHT_LOG = "$1 has added the right '$2' with the right_id '$3'to the role '$4' with the role_id '$5.'";
    private const REMOVED_RIGHT_LOG = "$1 has removed the right '$2' with the right_id '$3' from the role '$4' with the role_id '$5.'";

    public function __construct(){
        $this->CI =& get_instance();
        $this->CI->load->library('session');
    }
    //==============================================USERS===================================
    public function user_register_logging($new_user_id){
        //DATAS NEEDED
        $registerd_user = $this->CI->user_model->get_user($new_user_id);
        $active_user = $this->CI->user_model->get_user($this->CI->session->userdata('user_id'));
        //BUILDING THE MESSAGE
        $log_entry = $this::USER_REGISTER_LOG;
        $log_entry = str_replace('$1', $active_user['username'],$log_entry);
        $log_entry = str_replace('$2', $registerd_user['username'],$log_entry);
        $log_entry = str_replace('$3', $registerd_user['id'],$log_entry);
        return $log_entry;
    }

    public function user_edit_logging($edited_user_id){
        //DATAS NEEDED
        $edited_user = $this->CI->user_model->get_user($edited_user_id);
        $active_user = $this->CI->user_model->get_user($this->CI->session->userdata('user_id'));
        //BUILDING THE MESSAGE
        $log_entry = $this::USER_EDIT_LOG;
        $log_entry = str_replace('$1', $active_user['username'],$log_entry);
        $log_entry = str_replace('$2', $edited_user['username'],$log_entry);
        $log_entry = str_replace('$3', $edited_user['id'],$log_entry);
        return $log_entry;
    }

    public function user_toggle_logging($modified_user_id,$former_state_id){
        //DATAS NEEDED
        $modified_user = $this->CI->user_model->get_user($modified_user_id);
        $active_user = $this->CI->user_model->get_user($this->CI->session->userdata('user_id'));
        $previous_state = $this->CI->user_model->get_user_state($former_state_id);
        $new_state = $this->CI->user_model->get_user_state($modified_user['user_state']);
        //BUILDING THE MESSAGE
        $log_entry = $this::USER_TOGGLE_LOG;
        $log_entry = str_replace('$1', $active_user['username'],$log_entry);
        $log_entry = str_replace('$2', $modified_user['username'],$log_entry);
        $log_entry = str_replace('$3', $modified_user['id'],$log_entry);
        $log_entry = str_replace('$4', $previous_state,$log_entry);
        $log_entry = str_replace('$5', $new_state,$log_entry);
        return $log_entry;
    }

    public function username_change_logging($edited_user_id,$previous_username,$new_username){
        //DATAS NEEDED
        $edited_user = $this->CI->user_model->get_user($edited_user_id);
        $active_user = $this->CI->user_model->get_user($this->CI->session->userdata('user_id'));
        //BUILDING THE MESSAGE
        $log_entry = $this::USERNAME_CHANGE_LOG;
        $log_entry = str_replace('$1', $active_user['username'],$log_entry);
        $log_entry = str_replace('$2', $previous_username,$log_entry);
        $log_entry = str_replace('$3', $new_username,$log_entry);
        $log_entry = str_replace('$4', $edited_user['username'],$log_entry);
        $log_entry = str_replace('$5', $edited_user_id,$log_entry);
        return $log_entry;
    }

    public function email_change_logging($edited_user_id, $previous_email, $new_email){
        //DATAS NEEDED
        $edited_user = $this->CI->user_model->get_user($edited_user_id);
        $active_user = $this->CI->user_model->get_user($this->CI->session->userdata('user_id'));
        //BUILDING THE MESSAGE
        $log_entry = $this::EMAIL_CHANGE_LOG;
        $log_entry = str_replace('$1', $active_user['username'],$log_entry);
        $log_entry = str_replace('$2', $previous_email,$log_entry);
        $log_entry = str_replace('$3', $new_email,$log_entry);
        $log_entry = str_replace('$4', $edited_user['username'],$log_entry);
        $log_entry = str_replace('$5', $edited_user_id,$log_entry);
        return $log_entry;
    }

    public function password_change_logging($edited_user_id){
        //DATAS NEEDED
        $edited_user = $this->CI->user_model->get_user($edited_user_id);
        $active_user = $this->CI->user_model->get_user($this->CI->session->userdata('user_id'));
        //BUILDING THE MESSAGE
        $log_entry = $this::PASSWORD_CHANGE_LOG;
        $log_entry = str_replace('$1', $active_user['username'],$log_entry);
        $log_entry = str_replace('$2', $edited_user['username'],$log_entry);
        $log_entry = str_replace('$5', $edited_user_id,$log_entry);
        return $log_entry;
    }

    public function email_confirmed_logging($user_id){
        //DATAS NEEDED
        $edited_user = $this->CI->user_model->get_user($user_id);
        //BUILDING THE MESSAGE
        $log_entry = $this::CONFIRM_EMAIL_LOG;
        $log_entry = str_replace('$1', $edited_user['username'],$log_entry);
        $log_entry = str_replace('$2', $user_id,$log_entry);
        return $log_entry;
    }

    public function resend_email_confirmation_logging($user_id){
        //DATAS NEEDED
        $edited_user = $this->CI->user_model->get_user($user_id);
        //BUILDING THE MESSAGE
        $log_entry = $this::RESEND_CONFIRM_EMAIL_LOG;
        $log_entry = str_replace('$1', $edited_user['username'],$log_entry);
        $log_entry = str_replace('$2', $user_id,$log_entry);
        return $log_entry;
    }

    public function password_recovery_logging($user_id){
        //DATAS NEEDED
        $edited_user = $this->CI->user_model->get_user($user_id);
        //BUILDING THE MESSAGE
        $log_entry = $this::PASSWORD_RECOVERY_LOG;
        $log_entry = str_replace('$1', $edited_user['username'],$log_entry);
        $log_entry = str_replace('$2', $user_id,$log_entry);
        return $log_entry;
    }

    public function resend_password_recovery_logging($user_id){
        //DATAS NEEDED
        $edited_user = $this->CI->user_model->get_user($user_id);
        //BUILDING THE MESSAGE
        $log_entry = $this::RESEND_PASSWORD_RECOVERY_LOG;
        $log_entry = str_replace('$1', $edited_user['username'],$log_entry);
        $log_entry = str_replace('$2', $user_id,$log_entry);
        return $log_entry;
    }
    //==============================================CATEGORIES===================================
    public function categories_create_logging($category_id){
        //DATAS NEEDED
        $user = $this->CI->user_model->get_user($this->CI->session->userdata('user_id'));
        $category = $this->CI->category_model->get_category($category_id);
        //BUILDING THE MESSAGE
        $log_entry = $this::CATEGORY_CREATE_LOG;
        $log_entry = str_replace('$1', $user['username'],$log_entry);
        $log_entry = str_replace('$2', $category['name'],$log_entry);
        $log_entry = str_replace('$3', $category_id,$log_entry);
        return $log_entry;
    }
    public function categories_toggle_logging($category){
        //DATAS NEEDED
        $user = $this->CI->user_model->get_user($this->CI->session->userdata('user_id'));
        $new_state = ($category['active'] == 1 ? 0 : 1); 
        //BUILDING THE MESSAGE
        $log_entry = $this::CATEGORY_TOGGLE_LOG;
        $log_entry = str_replace('$1', $user['username'],$log_entry);
        $log_entry = str_replace('$2', $category['name'],$log_entry);
        $log_entry = str_replace('$3', $category['id'],$log_entry);
        $log_entry = str_replace('$4', $category['active'],$log_entry);
        $log_entry = str_replace('$5', $new_state,$log_entry);
        return $log_entry;
    }
    public function categories_edit_logging($category,$new_name){
        //DATAS NEEDED
        $user = $this->CI->user_model->get_user($this->CI->session->userdata('user_id'));
        //BUILDING THE MESSAGE
        $log_entry = $this::CATEGORY_EDIT_LOG;
        $log_entry = str_replace('$1', $user['username'],$log_entry);
        $log_entry = str_replace('$2', $category['name'],$log_entry);
        $log_entry = str_replace('$3', $new_name,$log_entry);
        $log_entry = str_replace('$4', $category['id'],$log_entry);
        return $log_entry;
    }
    public function categories_update_image_logging($category){
        //DATAS NEEDED
        $user = $this->CI->user_model->get_user($this->CI->session->userdata('user_id'));
        //BUILDING THE MESSAGE
        $log_entry = $this::CATEGORY_UPDATE_IMAGE_LOG;
        $log_entry = str_replace('$1', $user['username'],$log_entry);
        $log_entry = str_replace('$2', $category['name'],$log_entry);
        $log_entry = str_replace('$3', $category['id'],$log_entry);
        return $log_entry;
    }
    
    //==============================================ROLES===================================
    public function roles_create_logging($role_id){
        //DATAS NEEDED
        $role = $this->CI->role_model->get_role($role_id);
        $user = $this->CI->user_model->get_user($this->CI->session->userdata('user_id'));
        //BUILDING THE MESSAGE
        $log_entry = $this::ROLE_CREATE_LOG;
        $log_entry = str_replace('$1', $user['username'],$log_entry);
        $log_entry = str_replace('$2', $role['name'],$log_entry);
        $log_entry = str_replace('$3', $role['id'],$log_entry);
        return $log_entry;
    }
    public function roles_edit_logging($role,$new_name){
        //DATAS NEEDED
        $user = $this->CI->user_model->get_user($this->CI->session->userdata('user_id'));
        //BUILDING THE MESSAGE
        $log_entry = $this::ROLE_EDIT_LOG;
        $log_entry = str_replace('$1', $user['username'],$log_entry);
        $log_entry = str_replace('$2', $role['name'],$log_entry);
        $log_entry = str_replace('$3', $new_name,$log_entry);
        $log_entry = str_replace('$4', $role['id'],$log_entry);
        return $log_entry;
    }
    public function roles_delete_logging($role){
        //DATAS NEEDED
        $user = $this->CI->user_model->get_user($this->CI->session->userdata('user_id'));
        //BUILDING THE MESSAGE
        $log_entry = $this::ROLE_DELETE_LOG;
        $log_entry = str_replace('$1', $user['username'],$log_entry);
        $log_entry = str_replace('$2', $role['name'],$log_entry);
        $log_entry = str_replace('$3', $role['id'],$log_entry);
        return $log_entry;
    }

    public function roles_delete_attempt_logging($role,$new_name){
        //DATAS NEEDED
        $user = $this->CI->user_model->get_user($this->CI->session->userdata('user_id'));
        //BUILDING THE MESSAGE
        $log_entry = $this::ROLE_ATTEMPT_LOG;
        $log_entry = str_replace('$1', $user['username'],$log_entry);
        $log_entry = str_replace('$2', $role['name'],$log_entry);
        $log_entry = str_replace('$3', $new_name,$log_entry);
        $log_entry = str_replace('$4', $role['id'],$log_entry);
        return $log_entry;
    }

    public function right_added_logging($role,$right){
        //DATAS NEEDED
        $user = $this->CI->user_model->get_user($this->CI->session->userdata('user_id'));
        //BUILDING THE MESSAGE
        $log_entry = $this::NEW_RIGHT_LOG;
        $log_entry = str_replace('$1', $user['username'],$log_entry);
        $log_entry = str_replace('$2', $right['name'],$log_entry);
        $log_entry = str_replace('$3', $right['id'],$log_entry);
        $log_entry = str_replace('$4', $role['name'],$log_entry);
        $log_entry = str_replace('$5', $role['id'],$log_entry);
        return $log_entry;
    }

    public function right_removed_logging($role,$right){
        //DATAS NEEDED
        $user = $this->CI->user_model->get_user($this->CI->session->userdata('user_id'));
        //BUILDING THE MESSAGE
        $log_entry = $this::REMOVED_RIGHT_LOG;
        $log_entry = str_replace('$1', $user['username'],$log_entry);
        $log_entry = str_replace('$2', $right['name'],$log_entry);
        $log_entry = str_replace('$3', $right['id'],$log_entry);
        $log_entry = str_replace('$4', $role['name'],$log_entry);
        $log_entry = str_replace('$5', $role['id'],$log_entry);
        return $log_entry;
    }
    
    //==============================================TAGS===================================
    public function tags_create_logging($tag){// in posts
        //DATAS NEEDED
        $user = $this->CI->user_model->get_user($this->CI->session->userdata('user_id'));
        //BUILDING THE MESSAGE
        $log_entry = $this::TAG_CREATE_LOG;
        $log_entry = str_replace('$1', $user['username'],$log_entry);
        $log_entry = str_replace('$2', $tag['title'],$log_entry);
        $log_entry = str_replace('$3', $tag['id'],$log_entry);
        return $log_entry;
    }

    public function tags_delete_logging($tag){
        //DATAS NEEDED
        $user = $this->CI->user_model->get_user($this->CI->session->userdata('user_id'));
        //BUILDING THE MESSAGE
        $log_entry = $this::TAG_DELETE_LOG;
        $log_entry = str_replace('$1', $user['username'],$log_entry);
        $log_entry = str_replace('$2', $tag['title'],$log_entry);
        $log_entry = str_replace('$3', $tag['id'],$log_entry);
        return $log_entry;
    }
    //http://localhost/Laetronaz/LaetronazBlog/posts/edit/Lorem-Ipsum
    public function link_tag_to_post_logging($tag, $post){
        //DATAS NEEDED
        $user = $this->CI->user_model->get_user($this->CI->session->userdata('user_id'));
        //BUILDING THE MESSAGE
        $log_entry = $this::TAG_ADDED_LOG;
        $log_entry = str_replace('$1', $user['username'],$log_entry);
        $log_entry = str_replace('$2', $tag['title'],$log_entry);
        $log_entry = str_replace('$3', $tag['id'],$log_entry);
        $log_entry = str_replace('$4', $post['slug'],$log_entry);
        $log_entry = str_replace('$5', $post['id'],$log_entry);
        return $log_entry;
    }

    public function delink_tag_from_post_logging($tag, $post){
        //DATAS NEEDED
        $user = $this->CI->user_model->get_user($this->CI->session->userdata('user_id'));
        //BUILDING THE MESSAGE
        $log_entry = $this::TAG_REMOVED_LOG;
        $log_entry = str_replace('$1', $user['username'],$log_entry);
        $log_entry = str_replace('$2', $tag['title'],$log_entry);
        $log_entry = str_replace('$3', $tag['id'],$log_entry);
        $log_entry = str_replace('$4', $post['slug'],$log_entry);
        $log_entry = str_replace('$5', $post['id'],$log_entry);
        return $log_entry;
    }
    //==============================================POSTS===================================
    public function posts_create_logging($post){
        //DATAS NEEDED
        $user = $this->CI->user_model->get_user($this->CI->session->userdata('user_id'));
        //BUILDING THE MESSAGE
        $log_entry = $this::POST_CREATE_LOG;
        $log_entry = str_replace('$1', $user['username'],$log_entry);
        $log_entry = str_replace('$2', $post['slug'],$log_entry);
        $log_entry = str_replace('$3', $post['id'],$log_entry);
        return $log_entry;
    }

    public function posts_edit_logging($post){
        //DATAS NEEDED
        $user = $this->CI->user_model->get_user($this->CI->session->userdata('user_id'));
        //BUILDING THE MESSAGE
        $log_entry = $this::POST_EDIT_LOG;
        $log_entry = str_replace('$1', $user['username'],$log_entry);
        $log_entry = str_replace('$2', $post['slug'],$log_entry);
        $log_entry = str_replace('$3', $post['id'],$log_entry);
        return $log_entry;
    }

    public function posts_toggle_logging($post){
        //DATAS NEEDED
        $user = $this->CI->user_model->get_user($this->CI->session->userdata('user_id'));
        $new_state = $post['state'] == 1 ? 0 : 1;
        //BUILDING THE MESSAGE
        $log_entry = $this::POST_TOGGLE_LOG;
        $log_entry = str_replace('$1', $user['username'],$log_entry);
        $log_entry = str_replace('$2', $post['slug'],$log_entry);
        $log_entry = str_replace('$3', $post['state'],$log_entry);
        $log_entry = str_replace('$4', $new_state,$log_entry);
        $log_entry = str_replace('$5', $post['id'],$log_entry);
        return $log_entry;
    }

    public function posts_update_thumbnail_logging($post){
        //DATAS NEEDED
        $user = $this->CI->user_model->get_user($this->CI->session->userdata('user_id'));
        //BUILDING THE MESSAGE
        $log_entry = $this::POST_UPDATE_IMAGE_LOG;
        $log_entry = str_replace('$1', $user['username'],$log_entry);
        $log_entry = str_replace('$2', $post['slug'],$log_entry);
        $log_entry = str_replace('$3', $post['id'],$log_entry);
        return $log_entry;
    }
}