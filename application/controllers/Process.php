<?php
ini_set("date.timezone", "Africa/Lagos");
require APPPATH . '/libraries/Moryield_Server.php';

use ServerGenerator\Libraries\Moryield_Server;
defined('BASEPATH') OR exit('No direct script access allowed');

class Process extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Merchant_model');
        $this->load->model('Account_model');
        $this->load->model('Wallet_model');
        $this->load->library('encrypt');
        $this->load->library('mailer');
        $this->load->model('Package_model');
        $this->load->model('Databundle_model');
        $this->load->model('Service_model');
        $this->load->model('Pack_commission_model');

        $this->load->library('form_validation');
    }

    /*
      public function DataService() {
      $params = array(array(
      'ser_name' => "MTN DATA",
      'ser_code' => "DATA0001",
      'cat_id' => 4,
      'api_code' => 2,
      'api_comm' => 4,
      ),
      array(
      'ser_name' => "GLO DATA",
      'ser_code' => "DATA0002",
      'cat_id' => 4,
      'api_code' => 3,
      'api_comm' => 6,
      ),
      array(
      'ser_name' => "Airtel DATA",
      'ser_code' => "DATA0003",
      'cat_id' => 4,
      'api_code' => 1,
      'api_comm' => 6,
      ),
      array(
      'ser_name' => "Etisalat DATA",
      'ser_code' => "DATA0004",
      'cat_id' => 4,
      'api_code' => 4,
      'api_comm' => 6,
      ),
      );

      $service_id = $this->Service_model->add_services($params);

      // add service to packages
      // get packages
      $pack = $this->Package_model->get_all_packages();
      if (is_array($pack)) {
      foreach ($pack as $value) {
      $comm = array(
      array(
      'pack_id' => $value['pack_id'],
      'ser_code' => "DATA0001",
      'is_percent' => 1,
      'comm_per' => 0,
      'fixedaoumt' => 0,
      ),
      array(
      'pack_id' => $value['pack_id'],
      'ser_code' => "DATA0002",
      'is_percent' => 1,
      'comm_per' => 0,
      'fixedaoumt' => 0,
      ),
      array(
      'pack_id' => $value['pack_id'],
      'ser_code' => "DATA0003",
      'is_percent' => 1,
      'comm_per' => 0,
      'fixedaoumt' => 0,
      ),
      array(
      'pack_id' => $value['pack_id'],
      'ser_code' => "DATA0004",
      'is_percent' => 1,
      'comm_per' => 0,
      'fixedaoumt' => 0,
      ),
      );

      $this->Pack_commission_model->add_pack_commission_batch($comm);
      }
      }
      }
     */

    public function DoRegister() {
        if (array_key_exists('submit', $_POST)) {
//            $this->form_validation->set_rules('name', 'Vendor Name', 'required');
////        $this->form_validation->set_rules('lastname', 'Last Name', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('password2', 'Retype Password', 'required|matches[password]');
//        $this->form_validation->set_rules('email', 'Email Address', 'required|valid_email');
//        $this->form_validation->set_rules('phone', 'Phone Number', 'required|regex_match[/^[0-9]{11}$/]');

            if ($this->form_validation->run() == FALSE) {
                $myerrors = $this->form_validation->error_array();


                $this->session->set_userdata('myerror', $myerrors);
//                $this->session_userdata('error',"Email or Phone Number already exist");
                redirect("Home/Register/2");
            }

            $params = array(
                'us_name' => $this->input->post('name'),
                'us_email' => $this->input->post('email'),
                'us_phone' => $this->input->post('phone'),
                'created' => date('Y-m-d H:i:s'),
            );
//            if (!$this->User_model->CheckRegister($this->input->post('phone'))) {
            $user_id = $this->User_model->add_user($params);

            $params2 = array(
                'acc_ps' => $this->Account_model->Hash($this->input->post('password')),
                'us_id' => $user_id,
                'acc_email' => $this->input->post('email'),
                'acc_status' => ACCOUNT_ACTIVE,
                'acc_type' => VENDOR,
                'pack_id' => $this->input->post('pack'),
                'acc_username' => $this->input->post('username'),
            );





            if ($this->Account_model->add_account($params2)) {
                // send a maill
                $this->mailer->welcome($this->input->post('email'), $this->input->post('name'));
//                wallet details
                $wallet = array(
                    'us_id' => $user_id,
                    'balance' => 0,
                    'wal_date' => date('Y-m-d H:i:s')
                );
                $this->Wallet_model->add_wallet($wallet);
                redirect("Home/Regsuccess");
            }
//            } else {
//                $this->session->set_userdata('error', "Email or Phone Number already exist");
////                $this->session_userdata('error',"Email or Phone Number already exist");
//                redirect("Home/Register/1");
//            }
        } else {
            redirect("Home/Register");
        }
    }

    public function DoForgot() {
        
    }

    public function DoLogin() {
        if (array_key_exists('submit', $_POST)) {
            $email = $this->input->post('email');
            $pass = $this->input->post('password');

            $response = $this->Account_model->Login($email, $pass);
            
            if (count($response) > 0) {
                $type = $response['acc_type'];



//                $auser = array(
//                    'name' => $userdetails['us_name'],
//                    'id' => $userdetails['us_id'],
//                    'type' => $userdetails['acc_type'],
//                    'pack' => $userdetails['pack_id'],
//                    'email' => $userdetails['acc_email'],
//                    'acc_id'=>$userdetails['acc_id'],
//                );


                if ($type == VENDOR) {
//                    $balance = $this->Credit->Balance($userdetails['id']);
                    $user = $this->User_model->get_user($response['us_id'],$type);
                    
                    $auser = array(
                        'name' => $user['us_name'],
                        'id' => $user['us_id'],
                        'type' => $user['acc_type'],
                        'pack' => $user['pack_id'],
                        'email' => $user['acc_email'],
                        'acc_id' => $user['acc_id'],
                        'status' => $user['acc_status']
                    );
               
                    $this->session->set_userdata('userdetails', $auser);
                    
                   
                    redirect('/Vendor');
                } elseif ($type == ADMIN) {
                    //$balance = $this->Credit->Balance($userdetails['id']);
                    $user = $this->User_model->get_user($response['us_id'],$type);
                    $auser = array(
                        'name' => $user['us_name'],
                        'id' => $user['us_id'],
                        'type' => $response['acc_type'],
                        'pack' => $user['pack_id'],
                        'email' => $user['acc_email'],
                        'acc_id' => $user['acc_id'],
                        'status' => $user['acc_status']
                    );
                    $this->session->set_userdata('admindetails', $auser);
                    redirect('/Admin');
                } elseif ($type == MERCHANT) {
                    //$balance = $this->Credit->Balance($userdetails['id']);
                    $user = $this->Merchant_model->get_merchant_id($response['us_id']);
                    
                    $auser = array(
                        'name' => $user['mer_name'],
                        'id' => $user['mer_id'],
                        'type' => $response['acc_type'],
                        'code'=>$user['mer_code'],
                        'email' => $user['mer_email'],
                        'acc_id' => $response['acc_id'],
                        'status' => $response['acc_status'],
                        'reg_by'=>$user['us_id']
                    );
                    $this->session->set_userdata('merdetails', $auser);
                    
                   
                    redirect('/Seller');
                }
            } else {
                redirect('/Home/Login/0');
            }
        }
    }

    /*
      public function LoadAdmin() {
      $params = array(
      'us_name' => "Millions Recharge",
      'us_email' => "admin@millionsachievers.com",
      'us_phone' => "",
      'created' => date('Y-m-d H:i:s'),
      );
      if (!$this->User_model->CheckRegister($params['us_email'], $params['us_phone'])) {
      $user_id = $this->User_model->add_user($params);

      $params2 = array(
      'acc_ps' => $this->Account_model->Hash("Password_a2b-"),
      'us_id' => $user_id,
      'acc_email' => $params['us_email'],
      'acc_status' => ACCOUNT_ACTIVE,
      'acc_type' => ADMIN,
      'pack_id' => 0,
      );





      if ($this->Account_model->add_account($params2)) {
      // send a maill
      //                $this->mailer->welcome($this->input->post('email'),$this->input->post('name'));
      //                wallet details
      $wallet = array(
      'us_id' => $user_id,
      'balance' => 0,
      'wal_date' => date('Y-m-d H:i:s')
      );
      $this->Wallet_model->add_wallet($wallet);
      redirect("Home/Login");
      }
      }



      $comm = array(
      'pack_id' => $pack_id,
      'ser_code' => $this->input->post('ser_code'),
      'is_percent' => 1,
      'comm_per' => 0,
      'fixedaoumt' => 0,
      );
      }

      public function DataBundles() {
      $params = array(
      array(
      'data_desc' => "",
      'ser_code' => "DATA0001",
      'data_size' => "30MB",
      'data_price' => 100,
      ),
      array(
      'data_desc' => "",
      'ser_code' => "DATA0001",
      'data_size' => "100MB",
      'data_price' => 200,
      ),
      array(
      'data_desc' => "",
      'ser_code' => "DATA0001",
      'data_size' => "750MB",
      'data_price' => 500,
      ),
      array(
      'data_desc' => "",
      'ser_code' => "DATA0001",
      'data_size' => "1.5GB",
      'data_price' => 1000,
      ),
      array(
      'data_desc' => "",
      'ser_code' => "DATA0001",
      'data_size' => "3.5GB",
      'data_price' => 2000,
      ),
      );

      $this->Databundle_model->add_databundle_bulk($params);

      $params2 = array(
      array(
      'data_desc' => "",
      'ser_code' => "DATA0003",
      'data_size' => "50MB",
      'data_price' => 100,
      ),
      array(
      'data_desc' => "",
      'ser_code' => "DATA0003",
      'data_size' => "200MB",
      'data_price' => 200,
      ),
      array(
      'data_desc' => "",
      'ser_code' => "DATA0003",
      'data_size' => "750MB",
      'data_price' => 500,
      ),
      array(
      'data_desc' => "",
      'ser_code' => "DATA0003",
      'data_size' => "1.5GB",
      'data_price' => 1000,
      ),
      array(
      'data_desc' => "",
      'ser_code' => "DATA0003",
      'data_size' => "350MB",
      'data_price' => 300,
      ),
      );

      $this->Databundle_model->add_databundle_bulk($params2);


      $params3 = array(
      array(
      'data_desc' => "",
      'ser_code' => "DATA0004",
      'data_size' => "50MB",
      'data_price' => 100,
      ),
      array(
      'data_desc' => "",
      'ser_code' => "DATA0004",
      'data_size' => "200MB",
      'data_price' => 200,
      ),
      array(
      'data_desc' => "",
      'ser_code' => "DATA0004",
      'data_size' => "500MB",
      'data_price' => 500,
      ),
      array(
      'data_desc' => "",
      'ser_code' => "DATA0003",
      'data_size' => "1GB",
      'data_price' => 1000,
      ),
      array(
      'data_desc' => "",
      'ser_code' => "DATA0004",
      'data_size' => "1.5GB",
      'data_price' => 1200,
      ),
      array(
      'data_desc' => "",
      'ser_code' => "DATA0004",
      'data_size' => "2.5GB",
      'data_price' => 2000,
      ),
      array(
      'data_desc' => "",
      'ser_code' => "DATA0004",
      'data_size' => "3.5GB",
      'data_price' => 2500,
      ),
      array(
      'data_desc' => "",
      'ser_code' => "DATA0004",
      'data_size' => "5GB",
      'data_price' => 3500,
      ),
      );

      $this->Databundle_model->add_databundle_bulk($params3);
      }
     */
    
    public function GenerateCode() {
        $this->load->model('GenCode');
//        $code = Moryield_Server::MerchantCode();
//        foreach ($code as $value) {
//            $allcode[]=array(
//                'code'=>$value,
//                'used'=>0
//            );
//        }
//        $this->GenCode->NewCode($allcode);
//        
        $d  = $this->GenCode->get_code();
        
        print_r($d);
        
    }
}
