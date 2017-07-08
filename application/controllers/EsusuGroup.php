<?php

class EsusuGroup extends MY_Controller{
    public $userdetails;
    public $type;
    public function __construct() {
        parent::__construct();
        $this->userdetails = $this->GetDetails();
        $this->type = $this->userdetails['type'];
        if($this->type ==VENDOR){
            $this->data['balance'] = $this->Wallet_model->Balance($this->userdetails['id']);
        }
        
        $this->load->model('Es_Group_model');
//        
        $this->data['type'] = $this->type;
        $this->data['uinfo'] = $this->userdetails;
    }
    public function index() {
        $this->body="esusu/es_index";
//        get all groups
        $result = $this->Es_Group_model->get_all_groups();
        if(is_array($result)){
            $this->data['esgroups']=$result;
        }
        $this->ShowView($this->type);
    }
    public function NewGroup() {
        $this->body="esusu/newesgroup";
        $this->ShowView($this->type);
    }
    public function PrcNewGroup() {
        if(isset($_POST)){
//            get values
            $name = $this->input->post('grpname');
            $amt = $this->input->post('grpamt');
            
            $reply  = $this->Es_Group_model->new_group($name,$amt);
            
            if($reply){
                redirect('EsusuGroup/index');
            }
            else{
                $this->data['newgroup']=array(
                    'name'=>$name,
                    'amount'=>$amt
                );
                redirect('EsusuGroup/NewGroup');
            }
        }
    }
    
    public function GroupDetails($grpid) {
        if($grpid !=NULL){
            
        }
    }
    
}
