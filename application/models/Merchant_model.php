<?php

class Merchant_model extends CI_Model{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    public function New_merchant($params) {
        $this->db->insert('merchants',$params);
        return $this->db->insert_id();
    }
    
    public function get_all_merchants() {
        return $this->db->get('merchants')->result_array();
    }
    public function get_merchant($mer_id) {
        return $this->db->get_where('merchants',array('mer_code'=>$mer_id))->row_array();
    }
    public function approve_merchant($mer_code) {
        $this->db->where('mer_code',$mer_code);
        $params = array(
            'mer_status'=>MERCHANT_APPROVED,
            'date_approved'=>date('Y-m-d')
        );
        $response = $this->db->update('merchants',$params);
        if($response){
            return TRUE;
        }
        return FALSE;
    }
    public function reject_merchant($mer_code) {
        $this->db->where('mer_code',$mer_code);
        $params = array(
            'mer_status'=>MERCHANT_BLOCKED
        );
        $response = $this->db->update('merchants',$params);
        if($response){
            return TRUE;
        }
        return FALSE;
    }
    
    public function get_merchant_id($mer_id) {
        return $this->db->get_where('merchants',array('mer_id'=>$mer_id))
                
                ->row_array();
    }
}
