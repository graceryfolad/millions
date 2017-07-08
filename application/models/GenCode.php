<?php

class GenCode extends CI_Model {

    private $table;

    public function __construct() {
        parent::__construct();
        $this->table = "generate_code";
    }

    public function NewCode($params) {
        
        $this->db->insert_batch($this->table, $params);
    }

    public function get_all_code() {
        $this->db->select();
        $this->db->from($this->table);
        return $this->db->get()->result_array();
        
        
    }
    
    public function get_code() {
        $this->db->select();
        $this->db->where('used',0);
        $this->db->from($this->table);
        return $this->db->get()->row_array();
        
        
    }

    public function update($cid, $params) {
        $this->db->where('id', $cid);
        if ($this->db->update($this->table, $params)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
