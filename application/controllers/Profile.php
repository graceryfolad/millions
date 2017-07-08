<?php

class Profile extends MY_Controller{
    public $userdetails;
    public function __construct() {
        parent::__construct();
         $this->userdetails = $this->GetDetails();
        $this->data['balance'] = $this->Wallet_model->Balance($this->userdetails['id']);
//        

        $this->data['uinfo'] = $this->userdetails;
    }
    
    public function index() {
//        get the current user profile
        
    }
    
    public function UpdateProfile() {
        
    }
    
}
