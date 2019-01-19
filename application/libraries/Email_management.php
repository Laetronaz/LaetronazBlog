<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email_management {

    //EMAIL PATH CONST
    private const VERIFICATION_EMAIL = 'assets/emails/verify_email.html';
    private const PASSWORD_RECOVERY_EMAIL = 'assets/emails/password_recovery.html';
    private const PASSWORD_RECOVERY_SUBJECT = WEBSITE_NAME." account password reset";
    private const MAIL_VERIFICATION_SUBJECT = "Your ".WEBSITE_NAME." mail verification";

    protected $CI;
        
    public function __construct(){
        $this->CI =& get_instance();
        $this->CI->load->library('email');
    }

    public function password_recovery_email($username, $recipient, $token){
        $subject = $this::PASSWORD_RECOVERY_SUBJECT;
        $html_content = file_get_contents(base_url().$this::PASSWORD_RECOVERY_EMAIL);

        //REPLACE CONTENT
        $html_content = str_replace('$1', $username,$html_content);
        $html_content = str_replace('$2', WEBSITE_NAME,$html_content);
        $html_content = str_replace('$3', base_url().EMAIL_RESET_PASSWORD_PATH.$token['token'],$html_content);
        $html_content = str_replace('$4', $token['expiration_time'],$html_content);
        
        $this->sendEmail($recipient,$subject,$html_content);
        
        //TODO: add log use sendEmail return values as a verification
    }

    public function mail_verification_email($username, $recipient, $token){
        $subject = $this::MAIL_VERIFICATION_SUBJECT;
        $html_content = file_get_contents(base_url().$this::VERIFICATION_EMAIL);

        //REPLACE CONTENT
        $html_content = str_replace('$1', $username,$html_content);
        $html_content = str_replace('$2', WEBSITE_NAME,$html_content);
        $html_content = str_replace('$3', base_url().EMAIL_CONFiRM_EMAIL_PATH.$token['token'],$html_content);
        $html_content = str_replace('$4', $token['expiration_time'],$html_content);
        
        $this->sendEmail($recipient,$subject,$html_content);

        //TODO: add log use sendEmail return values as a verification
    }

    private function sendEmail($recipient,$subject ,$html_content){
        //LOAD LIBRARY
        $this->CI->load->library('email');
        $this->CI->config->load('email');
        //EMAIL CONTENT
        $this->CI->email->to($recipient);
        $this->CI->email->from($this->CI->config->item('smtp_user'),EMAIL_SENDER_NAME);
        $this->CI->email->subject($subject);
        $this->CI->email->message($html_content);
        
        //SEND EMAIL
        return $this->CI->email->send();
    }

    
}