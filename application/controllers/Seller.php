<?php

class Seller extends MY_Controller {

    public $userdetails;
    public $type;

    public function __construct() {
        parent::__construct();

        $this->load->model('Wallet_model');
        $this->load->model('Merchant_model');
        $this->load->model('Account_model');
        $this->load->model('User_model');
        $this->load->library('form_validation');
        
        $this->userdetails = $this->GetDetails();
        $this->type = $this->userdetails['type'];
        $this->data['uinfo'] = $this->userdetails;
    }

    public function index() {
        $this->body = "seller/index";

        $this->merchantlayout();
    }

    public function VerifybyPhone() {
        if ($_POST) {
            $phone = $this->input->post('phone');
            if (strlen($phone) > 2) {
                $data = array('acc_username' => $phone, 'acc_type' => VENDOR);
//                get user user id from account table
                $user_acc = $this->Account_model->get_account_any($data);
//                get the user now
               
                if (is_array($user_acc) && count($user_acc) > 0) {
                    $userid = $user_acc['us_id'];
                    $user = $this->User_model->get_user($userid, VENDOR);
                    if (is_array($user)) {
                        $this->data['memdet'] = $user;
                        $vm = $this->load->view('seller/mem_det', $this->data, TRUE);
                        echo $vm;
                    }
                } else {
                    echo "<p>Invalid Username</p>";
                }
            }
        } else {
            echo "what is wrong";
        }
    }
    
    public function Services($serv = NULL) {
//        get all the services offered by this merchant to members
    }

}
