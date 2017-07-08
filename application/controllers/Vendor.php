<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor extends MY_Controller {

    private $userdets;

    function __construct() {
        parent::__construct();
        $this->load->model('Account_model');
        $this->load->model('Category_model');
        $this->load->model('Wallet_model');
        $this->load->model('Topup_wallet_model');
        $this->load->model('Service_model');
        $this->load->model('Order_model');
        $this->load->library('airvend');



        $this->userdets = $this->GetDetails();
        $this->data['balance'] = $this->Wallet_model->Balance($this->userdets['id']);
//        

        $this->data['uinfo'] = $this->userdets;
    }

    public function Index() {
        $this->body = "vendor/dashboard";

        $this->userlayout();
    }

    public function Profile() {
        $this->body = "vendor/profile";
        // get the packages
        $this->load->model('Package_model');
        $packs = $this->Package_model->get_all_packages();

        $this->data['packs'] = $packs;
        $this->userlayout();
    }

    public function LogOut() {
        $this->session->sess_destroy();
        redirect('/Home/Login');
    }

    public function Commissions() {
        $this->body = "vendor/commissions";
        $this->userlayout();
    }

    public function Changep() {
        $this->body = "vendor/chps";
        $this->userlayout();
    }

    public function Transactions() {
        $this->userdets = $this->GetDetails();
        $this->body = "vendor/trans";
        $trans = $this->Order_model->get_order_by_vendor($this->userdets['id']);
        if (is_array($trans)) {
            $this->data['trans'] = $trans;
        }

        $this->userlayout();
    }

    public function Services($cat) {
        if ($cat != NULL) {
//            $service = 
            $services = $this->Service_model->get_service_category($cat);
//            $this->data['services'] = $services;
            switch ($cat) {
                case 1:
                    $this->data['services'] = $services;
//                    var_dump($services);
//                    exit();
                    $this->data['cat'] = 1;
                    $this->body = "vendor/airtime";
                    break;
                case 2:
                    $this->data['services'] = $services;
                    $this->data['cat'] = 2;
                    $this->body = "vendor/tvs";
                    break;
                case 3:
                    $this->data['services'] = $services;
                    $this->data['cat'] = 3;
                    $this->body = "vendor/electric";
                    break;
                case 4:
                    $this->data['services'] = $services;
                    $this->data['cat'] = 4;
                    $this->body = "vendor/data";
                    break;
                case 5:
                    // get the amount f

                    $this->data['scode'] = $services[0]['ser_code'];
                    $this->data['cat'] = 5;
                    $this->body = "vendor/educ";

//                    var_dump($services);
//                    exit();
                    break;
                case 7:
//                    $this->data['scode'] = $services[0]['ser_code'];
                    $this->data['cat'] = 7;
                    $this->data['services'] = $services;
                    $this->body = "vendor/smile";
            }
        } else {
//            get all services
            $allservices = $this->Service_model->get_all_services();
            $this->data['allservices'] = $allservices;
        }


        $this->userlayout();
    }

    public function Reports($dat = NULL) {

        $this->body = "vendor/reports";
        $this->userlayout();
    }

    public function Transfer($msg = NULL) {
        if ($msg != NULL) {
            if ($msg == 0) {
                $this->data['trfund_error'] = "Insufficient Balance";
            } else {
                $this->data['trfund_msg'] = "Fund Transfer was successful";
            }
        }
        $this->body = "vendor/transfer";
        $this->userlayout();
    }

    public function SmileVerify() {
        if (isset($_POST) && count($_POST)) {
//            get the service details
            $code = $this->input->post('stype');
            $acctnum = $this->input->post('acctnum');
            $service = $this->Service_model->get_service($code);
            $name = $service['ser_name'];
            $arr = explode(" ", $name);
            $verify = $this->airvend->VerifySmile(API_EMAIL, API_PASSWORD, $acctnum);
//            var_dump($verify);
            $this->data['smverify'] = $verify;
            $this->data['custnum'] = $acctnum;
            $this->data['network'] = $code;
            if (in_array('Bundle', $arr)) {
//               get the bundle list

                $bundle = $this->airvend->SmileBundleList(API_EMAIL, API_PASSWORD, $acctnum);
               
                $this->data['bundles'] = $bundle;
            } elseif (in_array('Recharge', $arr)) {
                
            }

            $this->body = "vendor/smverify";
            $this->userlayout();
        }
    }

}
