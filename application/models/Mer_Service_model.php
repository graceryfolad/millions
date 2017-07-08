<?php
class Mer_Service_model extends CI_Model{
     private $table;
    public function __construct() {
        parent::__construct();
        $this->table="loy_services";
    }
    
    public function add_mer_service($param) {
        if($this->db->insert($this->table,$param))
        {
            return TRUE;
        }
        return FALSE;
    }
    
    public function get_all_mer_services($mer_code) {
        $this->db->select();
        $this->db->from($this->table);
        $this->db->where('loy_services.mer_code',$mer_code);
        $this->db->join('merchants', 'loy_services.mer_code=merchants.mer_code', 'LEFT');
        $query = $this->db->get()->result_array();
                
        return $query;      
    }
    public function get_mer_service($ser_id) {
        $this->db->select();
        $this->db->from($this->table);
        $this->db->where('loy_ser_id',$ser_id);
        $this->db->join('merchants', 'loy_services.mer_code=merchants.mer_code', 'LEFT');
        $query = $this->db->get()->row_array();
                
        return $query; 
    }
    public function update_mer_service($ser_id,$param) {
        $this->db->where('loy_ser_id',$ser_id);
        if ($this->db->update($this->table,$param)){
            return TRUE;
        }
        return FALSE;
    }
}

