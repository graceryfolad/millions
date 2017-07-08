<?php
class PinCart_model extends My_Model{
     public $table;
    public function __construct() {
        parent::__construct();
        $this->table="pin_cart";
        
    }
    
    public function add_cart($params) {
        $ret = $this->add($this->table,$params);
        if(is_array($ret)){
            return TRUE;
        }
        
        return FALSE;
    }
    
    public function get_cart($batch) {
        $data= array(
            'bat_code'=>$batch
        );
        
        $cart = $this->get_where($this->table,$data);
        if(is_array($cart) && count($cart)>0){
            return $cart;
        }
        
        return FALSE;
    }
    public function update_cart($batch) {
        $data= array(
            'bat_status'=>BATCH_USED
        );
        
        $key = array(
            'bat_code'=>$batch
        );
        $response = $this->update($this->table,$key,$data);
        if($response)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}