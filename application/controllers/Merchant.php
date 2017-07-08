<?php

require APPPATH . '/libraries/Moryield_Server.php';

use ServerGenerator\Libraries\Moryield_Server;

class Merchant extends MY_Controller {

    public $userdetails;
    private $type;

    function __construct() {
        parent::__construct();
        $this->load->model('Wallet_model');
        $this->load->model('Merchant_model');
        $this->load->model('Account_model');
        $this->load->library('form_validation');
        $this->load->model('Incentive_model');
//        $this->load->library('generator');

        if (isset($_SESSION['admindetails'])) {
            $this->userdetails = $this->session->userdata('admindetails');
            $this->type = $this->userdetails['type'];
        } elseif (isset($_SESSION['userdetails'])) {
            $this->userdetails = $this->session->userdata('userdetails');
            $this->type = $this->userdetails['type'];
        } elseif (isset($_SESSION['merdetails'])) {
            $this->userdetails = $this->session->userdata('merdetails');
            $this->type = $this->userdetails['type'];
        }

//        $this->data['balance'] = $this->Wallet_model->Balance($this->userdetails['id']);
//        

        $this->data['uinfo'] = $this->userdetails;
    }

    public function New_Merchant() {
//        process new merchant
        if ($_POST) {
            $this->form_validation->set_rules('mname', 'Merchant Name', 'required|min_length[10]');
            $this->form_validation->set_rules('maddress', 'Merchant Address', 'required|min_length[10]');
            $this->form_validation->set_rules('memail', 'Merchant email Address', 'required|valid_email|min_length[10]');
            $this->form_validation->set_rules('mphone', 'Merchant Phone Number', 'required|min_length[11]');

            if ($this->form_validation->run()) {
//                generate merchant code
                $this->load->model('GenCode');
                $code = $this->GenCode->get_code();
                $params = array(
                    'mer_code' => $code['code'],
                    'mer_name' => $this->input->post('mname'),
                    'mer_email' => $this->input->post('memail'),
                    'mer_address' => $this->input->post('maddress'),
                    'mer_phone' => $this->input->post('mphone'),
                    'mer_desc' => $this->input->post('mdesc'),
                    'mer_status' => MERCHANT_DECLINED,
                    'date_created' => date('Y-m-d'),
                    'us_id' => $this->userdetails['id'],
                );

                $mer_id = $this->Merchant_model->New_merchant($params);
                if ($mer_id > 0) {
                    $this->GenCode->update($code['id'], array('used'=>1));
                    $account = array(
                        'acc_ps' => $this->Account_model->Hash("Password_1"),
                        'us_id' => $mer_id,
                        'acc_email' => $params['mer_email'],
                        'acc_status' => ACCOUNT_INACTIVE,
                        'acc_type' => MERCHANT,
                        'pack_id' => 0,
                    );
                    if ($this->Account_model->add_account($account)) {
                        redirect('/Loyalty/AllMerchants');
                    }
                }
            } else {
                $myerrors = $this->form_validation->error_array();
                $this->session->set_flashdata('verror', $myerrors);
                redirect('/Loyalty/NewMerchant');
            }
        } else {
            redirect('/Loyalty/AllMerchants');
        }
    }

    public function Approve($mer_code) {
//        approve a merchant


        $status = $this->Merchant_model->approve_merchant($mer_code);
        if ($status) {
//            add incentives
            $data = array(
                'mer_code' => $mer_code,
                'inc_per' => 0,
                'inc_min_amt' => 0
            );
            $this->Incentive_model->add_incentive($data);
            redirect("/Loyalty/AMerchant/{$mer_code}");
        } else {
            redirect("/Loyalty/AMerchant/{$mer_code}");
        }
    }

    public function Reject($mer_code) {
        $status = $this->Merchant_model->reject_merchant($mer_code);

        redirect("/Loyalty/AMerchant/{$mer_code}");
    }

}
