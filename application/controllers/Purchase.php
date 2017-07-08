<?php

class Purchase extends MY_Controller{
    public $userdetails;
    public $type;
    
    public function __construct() {
        parent::__construct();
        
        $this->load->model('Wallet_model');
        $this->load->model('Merchant_model');
        $this->load->model('Account_model');
        $this->load->model('User_model');
        $this->load->model('Mer_Service_model');
        $this->load->model('Cart_model');
        
        $this->userdetails = $this->GetDetails();
        $this->type = $this->userdetails['type'];
        $this->data['uinfo'] = $this->userdetails;
    }
    
    public function member_add($us_id) {
        $this->body="purchase/add";
//        get user by id
        $user = $this->User_model->get_user($us_id, VENDOR);
        $this->data['memdet'] = $user;
//        get the list of services of merchant
        $services  = $this->Mer_Service_model->get_all_mer_services($this->userdetails['code']);
        
        $this->data['services']=$services;
        $this->ShowView($this->type);
    }
    public function index() {
        $this->body="purchase/pur_index";
        $this->ShowView($this->type);
    }
    
    public function addCart() {
        if($this->type ==MERCHANT){
            if(isset($_POST) && count($_POST)>0){
//                add to cart table
               $data =array(
                   'mer_code'=> $this->userdetails['code'],
                   'loy_ser_id'=>  $this->input->post('sid'),
                   'us_id'=>  $this->input->post('uid'),
                   'amount'=>  $this->input->post('amt'),
                   'date'=>  date('Y-m-d H:i:s'),
               );
               
               if($this->Cart_model->add_cart($data)){
                   echo "done";
               }
               else{
                   echo "Failed";
               }
            }
        }
    }
    
    public function GetCart() {
        
    }
}

