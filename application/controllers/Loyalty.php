<?php
require APPPATH . '/libraries/Moryield_Server.php';

use ServerGenerator\Libraries\Moryield_Server;

class Loyalty extends MY_Controller {

    public $userdetails;
    private $type;

    function __construct() {
        parent::__construct();
        $this->load->model('Wallet_model');
        $this->load->model('Merchant_model');
        $this->load->model('Incentive_model');
        
//        if (isset($_SESSION['admindetails'])) {
//            $this->userdetails = $this->session->userdata('admindetails');
//            $this->type = $this->userdetails['type'];
//        } elseif (isset($_SESSION['userdetails'])) {
//            $this->userdetails = $this->session->userdata('userdetails');
//            $this->type = $this->userdetails['type'];
//        } elseif (isset($_SESSION['merdetails'])) {
//            $this->userdetails = $this->session->userdata('merdetails');
//            $this->type = $this->userdetails['type'];
//        }
        $this->userdetails =  $this->GetDetails();
        $this->type = $this->userdetails['type'];
        $this->data['balance'] = $this->Wallet_model->Balance($this->userdetails['id']);
//        
         $this->data['type']=  $this->type;
        $this->data['uinfo'] = $this->userdetails;
    }

    public function AllMerchants() {
//        everybody is allowed
        $this->body = "merchants/mer_list";
//        get the list of merchants
        $allmerchants = $this->Merchant_model->get_all_merchants();
        $this->data['type']=  $this->type;
        if(is_array($allmerchants) && count($allmerchants) > 0){
            $this->data['merchants'] = $allmerchants;
        }
        $this->show();
    }

    public function Purchases() {
//        everybody is allowed here
    }

    public function Reports() {
//        every body is allowed
    }
    
    public function Incentives() {
//        every body is allowed
    }

    public function NewMerchant() {
//        admin and vendor
        $this->body = "merchants/new_merchant";
//        get the list of merchants
        if(isset($_SESSION['verror'])){
            $this->data['verror']=  $this->session->flashdata('verror');
        }
        
        $this->show();
    }

    public function NewPurchase() {
//        Only merchant is allowed here
    }

    private function show() {
        switch ($this->type) {
            case VENDOR:
                $this->userlayout();
                break;
            case ADMIN:
                $this->adminlayout();
                break;
            case MERCHANT:
                $this->merchantlayout();
                break;
        }
    }
    
    public function AMerchant($mer_id) {
//        everybody is allowed
        $this->body = "merchants/mer_dets";
//        get the list of merchants
        $merchant = $this->Merchant_model->get_merchant($mer_id);
        if(is_array($merchant) && count($merchant) > 0){
//            $inc = $this->
            $this->data['merchant'] = $merchant;
        }
        $this->show();
    }
    
    
    
    
}
