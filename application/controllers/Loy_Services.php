<?php

class Loy_Services extends MY_Controller {

    public $userdetails;
    public $type;

    public function __construct() {
        parent::__construct();
        $this->userdetails = $this->GetDetails();
        $this->type = $this->userdetails['type'];

        $this->load->model('Account_model');
        $this->load->model('Wallet_model');
        $this->load->model('Mer_Service_model');


        if ($this->type == VENDOR) {
            $this->data['balance'] = $this->Wallet_model->Balance($this->userdetails['id']);
        }

//        

        $this->data['uinfo'] = $this->userdetails;
    }

    public function index() {
//        get the list of service for merchant
//        $ser_list = $this->Mer_Service_model->get_all_mer_services($this->userdetails['code']);
//        $this->data['mer_ser_list'] = $ser_list;
        $this->body = "loy_services/loy_ser_index";
        $this->ShowView($this->type);
    }

    public function add_service() {
        if ($this->type == MERCHANT) {
            if (isset($_POST) && count($_POST) > 0) {
//                get the count of services of a merchant
                $serv = $this->Mer_Service_model->get_all_mer_services($this->userdetails['code']);
                $count  = count($serv) + 1;
                $data = array(
                    'loy_ser_id'=>"{$this->userdetails['code']}-{$count}",
                    'loy_ser_name'=>  $this->input->post('sname'),
                    'loy_ser_desc'=>$this->input->post('sdesc'),
                    'loy_ser_per'=>$this->input->post('sper'),
                    'loy_ser_min_amount'=>$this->input->post('samt'),
                    'loy_status'=>1,
                    'mer_code'=>  $this->userdetails['code'],
                );
                
                if(is_array($data)){
                    if($this->Mer_Service_model->add_mer_service($data)){
                        echo "done";
                    }
                    else{
                        echo "there was error";
                    }
                }
            }
        }
    }

    public function update_service() {
        if (isset($_POST) && count($_POST) > 0) {
//                get the count of services of a merchant
                
               
                $data = array(
                   
                    'loy_ser_name'=>  $this->input->post('sname'),
                    'loy_ser_desc'=>$this->input->post('sdesc'),
                    'loy_ser_per'=>$this->input->post('sper'),
                    'loy_ser_min_amount'=>$this->input->post('samt'),
                    
                    
                );
                
                if(is_array($data)){
                    if($this->Mer_Service_model->update_mer_service($this->input->post('sid'),$data)){
                        echo "done";
                    }
                    else{
                        echo "there was error";
                    }
                }
            }
    }

    public function remove_service() {
        
    }
    public function mer_service() {
        $ser_list = $this->Mer_Service_model->get_all_mer_services($this->userdetails['code']);
        $data['services'] = $ser_list;
        $vm = $this->load->view('loy_services/loy_mer_services',$data,TRUE);
        
        echo $vm;
    }

    public function get_service($ser_id) {
        $aservice = $this->Mer_Service_model->get_mer_service($ser_id);
        if(is_array($aservice)){
            $this->data['aservice']=$aservice;
        }
        $this->body = "loy_services/loy_ser_details";
        $this->ShowView($this->type);
    }
}
