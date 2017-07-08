<?php

class Test_model extends My_Model{
    
    public function get_a_batch() {
        $this->join=array(
            'table'=>'pin_denominations',
            'common'=>'pin_denominations.pin_code=pin_cart.pin_code'
        );
        
        $table ="pin_cart";
        $where = array(
            'bat_code'=>'X1004'
        );
        
        $result = $this->get_where($table, $where);
        return $result;
    }
}

