<?php

if (!defined('BASEPATH'))    exit('No direct script access allowed');

if (!function_exists('split_token')) {

    function split_token($token) {
        $a = substr($token, 0, 4);
        $b = substr($token, 4, 4);
        $c = substr($token, 8, 4);
        $d = substr($token, 12, 4);
        $e = substr($token, 0, 4);
        return "{$a}-{$b}-{$c}-{$d}-{$e}";
    }

}

if (!function_exists('SendMail')) {

    function SendMail($to,$message) {
        $from_email = "your@example.com"; 
         $to_email = $this->input->post('email'); 
   
         //Load email library 
         $this->load->library('email'); 
   
         $this->email->from($from_email, 'Your Name'); 
         $this->email->to($to_email);
         $this->email->subject('Email Test'); 
         $this->email->message('Testing the email class.'); 
   
         //Send mail 
         if($this->email->send()) 
         $this->session->set_flashdata("email_sent","Email sent successfully."); 
         else 
         $this->session->set_flashdata("email_sent","Error in sending Email."); 
         $this->load->view('email_form'); 
    }

}
