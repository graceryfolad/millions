<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller {

    public $userdetails;

    function __construct() {
        parent::__construct();
        $this->load->model('Account_model');
        $this->load->model('Category_model');
        $this->load->model('Wallet_model');
        $this->load->model('User_model');
        $this->load->model('Order_model');
        $this->load->model('Topup_wallet_model');
        $this->load->model('Service_model');
        $this->load->model('User_model');
        $this->load->model('Package_model');
        $this->load->model('Pack_commission_model');

        $this->userdetails = $this->session->userdata('admindetails');
//        $this->data['balance'] = $this->Wallet_model->Balance($this->userdetails['id']);
//        

        $this->data['uinfo'] = $this->userdetails;
    }

    public function Index() {

        $this->body = "admin/addashboard";
        $this->adminlayout();
    }

    public function Profile() {
        $this->body = "admin/profile";
        // get the packages
        $this->load->model('Package_model');
        $packs = $this->Package_model->get_all_packages();

        $this->data['packs'] = $packs;
        $this->adminlayout();
    }

    public function LogOut() {
        $this->session->sess_destroy();
        redirect('/Home/Login');
    }

    public function Packages($pack_id = null) {
        $this->body = "admin/adpacks";
        if ($pack_id != NULL) {
            $comm = $this->Pack_commission_model->get_pack_commission($pack_id);
            if (is_array($comm)) {
                $this->data['packs_comm'] = $comm;
            }


//            get package info
            $info = $this->Package_model->get_package($pack_id);

//            var_dump($comm);
            $this->data['pinfo'] = $info;


//exit();
            $this->body = "admin/adpacks_comm";
        } else {
            //        get all packages
            $packs = $this->Package_model->get_all_packages();
            if (is_array($packs)) {
                if (count($packs) > 0) {
                    $this->data['packs'] = $packs;
                } else {
                    //            get all services
                    $allservices = $this->Service_model->get_all_services();
                    $this->data['all_ser'] = $allservices;

                    $package = array(
                        'pack_name' => "Agent 1"
                    );
                    $pack_id = $this->Package_model->add_package($package);

                    foreach ($allservices as $serv) {
                        $comm[] = array(
                            'pack_id' => $pack_id,
                            'ser_code' => $serv['ser_code'],
                            'is_percent' => 1,
                            'comm_per' => 0,
                            'fixedaoumt' => 0,
                        );
                    }

                    $this->Pack_commission_model->add_pack_commission_batch($comm);

                    $packs = $this->Package_model->get_all_packages();

                    if (count($packs) > 0) {
                        $this->data['packs'] = $packs;
                    }
                }
            }
            $this->body = "admin/adpacks";
        }
//        var_dump($this->data);
        $this->adminlayout();
    }

    public function Changep($status = NULL) {
        $this->body = "admin/adpwd";
        if ($status != NULL) {
            if ($status == 0) {
                $this->data['status'] = "Password Change Failed";
            } elseif ($status == 1) {
                $this->data['status'] = "Password Change was Successful";
            }
        }
//        var_dump($this->data);
//        exit();
        $this->adminlayout();
    }

    public function Services($scode = NULL) {
        $this->body = "admin/adservices";
        if ($scode != NULL) {
            if ($scode == 1) {
                redirect('Service/add_service');
            } else {
                $aservice = $this->Service_model->get_service($scode);
                if (is_array($aservice)) {
                    $this->data['aservice'] = $aservice;
                }
            }
        }

        $services = $this->Service_model->get_all_services();
        if (is_array($services)) {
            $this->data['services'] = $services;
        }
        $this->adminlayout();
    }

    public function Bundles($status = NULL) {
        $this->body = "admin/adbundles";
        if ($status != NULL) {
            if ($status == 0) {
                $this->data['status'] = "Password Change Failed";
            } elseif ($status == 1) {
                $this->data['status'] = "Password Change was Successful";
            }
        }
//        var_dump($this->data);
//        exit();
        $this->adminlayout();
    }

    public function Vendors($vendorid = NULL) {
        if ($vendorid != NULL) {
//            get vendor details
            $this->body = "admin/advenddet";
            $vendors = $this->User_model->get_user($vendorid, VENDOR);
            $pack = $this->Package_model->get_package($vendors['pack_id']);
            $this->data['vpack'] = $pack;
            $this->data['vendordet'] = $vendors;

//            get the transactions of this vendor
            $trans = $this->Order_model->get_order_by_vendor($vendorid);
            $this->data['trans'] = $trans;
        } else {
            $this->body = "admin/advendors";
            $vendors = $this->User_model->get_all_users();
            $this->data['vendors'] = $vendors;
        }

        $this->adminlayout();
    }

    public function Transactions() {
        $this->body = "admin/adtrans";
        $trans = $this->Order_model->get_all_orders();
        $this->data['alltrans'] = $trans;

        $this->adminlayout();
    }

    public function Reports() {
        $this->body = "admin/adreports";
        $trans = $this->Order_model->get_all_orders();
        $this->data['alltrans'] = $trans;

        $this->adminlayout();
    }

    public function Topup() {
//        get all top up
        
    }
}
