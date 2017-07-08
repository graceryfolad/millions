<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mailer{
    private $config;
    public function __construct() {
        $this->config = Array(
            'protocol' => 'sendmail',
            'smtp_host' => 'mail.millionsachievers.com',
            'smtp_port' => 465,
            'smtp_user' => 'noreply@millionsachievers.com',
            'smtp_pass' => 'no-reply@1',
            'smtp_timeout' => '4',
            'mailtype' => 'html',
            'charset' => 'iso-8859-1'
        );
        
//        $ci->load->helper('form');
        
    }
    public function Welcome($user_email,$name) {
       $ci = & get_instance();
        $ci->load->library('email', $this->config);
        
        $ci->email->set_newline("\r\n");

        $ci->email->from('noreply@millionsachievers.com', 'Millions Achiever Recharge');
        $data = array(
            'userName' => $name
        );
        $ci->email->to($user_email);  // replace it with receiver mail id
        $ci->email->subject("Welcome to Millions Achievers Recharge"); // replace it with relevant subject 

        $body = $ci->load->view('guest/email.php', $data, TRUE);
        $ci->email->message($body);
        $ci->email->send();
    }
    
    public function Order($email,$message) {
        $ci = & get_instance();
        $ci->load->library('email');
        
        $ci->email->set_newline("\r\n");

        $ci->email->from('noreply@millionsachievers.com', 'Millions Achiever Recharge');
        
        $ci->email->to($email);  // replace it with receiver mail id
        $ci->email->subject("Transaction Alert"); // replace it with relevant subject 

       
        $ci->email->message($message);
        $ci->email->send();
    }

}
