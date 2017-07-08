<?php

class Report extends MY_Controller {

    public $userdetails;

    function __construct() {
        parent::__construct();
        $this->load->model('Wallet_model');
        $this->load->model('Order_model');

        if(isset($_SESSION['userdetails'])){
            $this->userdetails = $this->session->userdata('userdetails');
        }
        elseif (isset($_SESSION['admindetails'])) {
        $this->userdetails = $this->session->userdata('admindetails');
    }
        
        $this->data['balance'] = $this->Wallet_model->Balance($this->userdetails['id']);
//        

        $this->data['uinfo'] = $this->userdetails;
    }

    public function Today() {
        $this->data['rtitle'] = "Today's Report";
       
        if($this->userdetails['type'] == VENDOR){
               $rep = $this->Order_model->GetToday($this->userdetails['id'],VENDOR);
                
               $this->data['report'] = $rep;
               
               $this->load->view('vendor/reportall',  $this->data);
        }
        elseif($this->userdetails['type'] == ADMIN){
            $rep = $this->Order_model->GetToday($this->userdetails['id'],ADMIN);
            $this->data['report'] = $rep;
            
             $this->load->view('admin/reportall',  $this->data);
        }
        
        
    }

    public function ThisMonth() {
        $month = date('F');
        $this->data['rtitle'] = "{$month}'s Report";
        if($this->userdetails['type'] == VENDOR){
               $rep = $this->Order_model->GetMonth($this->userdetails['id'],VENDOR);
              $this->data['report'] = $rep;
            
             $this->load->view('admin/reportall',  $this->data);
        }
        elseif($this->userdetails['type'] == ADMIN){
            $rep = $this->Order_model->GetMonth($this->userdetails['id'],ADMIN);
             $this->data['report'] = $rep;
            
             $this->load->view('admin/reportall',  $this->data);
        }
    }

    public function Range() {
        
    }

}
