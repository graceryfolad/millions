<?php

class PinCategory_model extends CI_Model{
    private $table;
    public function __construct() {
        parent::__construct();
        $this->table="pin_denominations";
        
    }
    
    public function add_denomination($params) {
        if(is_array($params)){
            if($this->db->insert($this->table,$params)){
                return true;
            }
            return FALSE;
        }
    }
    public function get_all_denominations() {
        return $this->db->get($this->table)->result_array();
    }
    
    public function edit_denomination($pcode,$param) {
        $this->db->where('pin_code',$pcode);
        $response = $this->db->update($this->table,$param);
        if($response)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
}

