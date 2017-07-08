<?php

class PinBatch_model extends CI_Model{
    public $table;
    public function __construct() {
        parent::__construct();
        $this->table="pin_batches";
        
    }
    
    public function add_batch($params) {
        if(is_array($params)){
            if($this->db->insert_batch($this->table,$params)){
                return TRUE;
            }
            
            return FALSE;
        }
    }
    public function get_all_batches() {
        return $this->db->get($this->table)->result_array();
    }
    public function get_a_batch() {
        return $this->db->get_where(
                $this->table,array('bat_status'=>1)
                )
//                ->limit(1)
                ->row_array();
    }
    
    public function get_all_used_batches() {
        return $this->db->get_where($this->table,array('bat_status'=>BATCH_USED))->result_array();
    }
    public function update_batch($code) {
        $this->db->where('bat_code', $code);
        
        $response = $this->db->update($this->table, array('bat_status'=>BATCH_USED));
        if ($response) {
            return TRUE;
        } else {
            return FALSE;
        }
        
        
        
    }
}
