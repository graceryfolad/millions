<?php

class Incentive_model extends CI_Model
{
    private $table;
    public function __construct() {
        parent::__construct();
        $this->table="loy_incentives";
    }
    public function add_incentive($param) {
        $this->db->insert($this->table,$param);
        return $this->db->insert_id();
    }
    
    public function get_all_incentives() {
        $this->db->select();
        $this->db->from($this->table);
        $this->db->join('merchants', 'loy_incentives.mer_code=merchants.mer_code', 'LEFT');
        $query = $this->db->get()->result_array();
                
        return $query;      
    }
    public function get_incentive($mer_code) {
        $this->db->select();
        $this->db->from($this->table);
        $this->db->where('mer_code',$mer_code);
        $this->db->join('merchants', 'loy_incentives.mer_code=merchants.mer_code', 'LEFT');
        $query = $this->db->get()->row_array();
                
        return $query; 
    }
    public function update_incentive($inc_id,$param) {
        $this->db->where('inc_id',$inc_id);
        if ($this->db->update($this->table,$param)){
            return TRUE;
        }
        return FALSE;
    }
}

