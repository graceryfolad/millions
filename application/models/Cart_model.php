<?php

class Cart_model extends CI_Model{
    private $table;
            function __construct()
    {
        parent::__construct();
        $this->table="Carts";
    }
    
    public function add_cart($param) {
        try {
            $this->db->insert($this->table, $param);
            return TRUE;
        } catch (Exception $ex) {
            return FALSE;
        }
    }
    public function get_cart_merchant($uid,$mcode) {
        return $this->db->get_where($this->table,array('mer_code'=>$mcode,'us_id'=>$uid))->result_array();
    }
    public function remove_cart($param) {
        
    }
}
