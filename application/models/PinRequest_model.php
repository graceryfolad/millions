<?php

class PinRequest_model extends My_Model{
    public $table;
    public function __construct() {
        parent::__construct();
        $this->table = "pin_orders";
    }
    public function addrequest($params) {
        $result = $this->add($this->table, $params);
        if(is_array($result)){
            return TRUE;
        }
        
        return FALSE;
    }
    public function get_a_request($param) {
        $this->join=array(
            'table'=>'users',
            'common'=>'users.us_id=pin_orders.us_id'
        );
        $result= $this->get_where($this->table, $param);
        if(is_array($result) && count($result) > 0){
            return $result;
        }
        
        
    }
    
    public function get_by_user($param) {
        $this->join=array(
            'table'=>'users',
            'common'=>'users.us_id=pin_orders.us_id'
        );
        $result= $this->get_where($this->table, $param);
        if(is_array($result) && count($result) > 0){
            return $result;
        }
    }
    
    public function UpdateRequest() {
        
    }
}

