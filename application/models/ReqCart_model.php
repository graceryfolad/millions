<?php

class ReqCart_model extends My_Model{
    public $table;
            
    public function __construct() {
        parent::__construct();
        $this->table="req_cart";
    }
    
    public function addcart($param) {
        $result = $this->add($this->table,$param);
        if(is_array($result)){
            return TRUE;
        }
    }
    public function get_a_req($param) {
         $this->join=array(
            'table'=>'pin_denominations',
            'common'=>'pin_denominations.pin_code=req_cart.pin_code'
        );
        $result = $this->get_where($this->table, $param);
        if(is_array($result)){
            return $result;
        }
        
        return FALSE;
    }
}

