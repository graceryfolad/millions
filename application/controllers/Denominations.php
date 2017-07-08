<?php

class Denominations extends MY_Controller{
    public $userdetails;
    public $type;

    function __construct() {
        parent::__construct();
        $this->load->model('Wallet_model');
        $this->load->model('PinCategory_model');
        $this->load->model('Incentive_model');
        
//      
        $this->userdetails =  $this->GetDetails();
        $this->type = $this->userdetails['type'];
        $this->data['balance'] = $this->Wallet_model->Balance($this->userdetails['id']);
//        
         $this->data['type']=  $this->type;
        $this->data['uinfo'] = $this->userdetails;
    }
    
    public function index() {
//        view all denomination
        $this->body = "denom/den_index";
        $pins = $this->PinCategory_model->get_all_denominations();
        if(is_array($pins)){
            $this->data['pcat']=$pins;
        }
        $this->ShowView($this->type);
    }
    
    public function add() {
        if(isset($_POST) && count($_POST) >0){
            if($this->type==ADMIN){
//                process the value as admin
                $data = array(
                    'pin_code'=>  $this->input->post('pncode'),
                    'pin_value'=>  $this->input->post('pnval'),
                    'pin_status'=>1
                );
                $resp = $this->PinCategory_model->add_denomination($data);
                if($resp){
                   redirect('Denominations/index/1');
                }
                else{
                    redirect('Denominations/index/0');
                }
            }
            else{
                redirect('Denominations/index');
            }
        }
        else{
            redirect('Denominations/index');
        }
        
        $this->ShowView($this->type);
    }
    

}

