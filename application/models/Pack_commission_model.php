<?php
/* 
 * Generated by CRUDigniter v3.0 Beta 
 * www.crudigniter.com
 */
 
class Pack_commission_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get pack_commission by pack id
     */
    function get_pack_commission($pk_id)
    {
        $this->db->select();
        $this->db->where('pack_commission.pack_id',$pk_id);
        $this->db->join('services','services.ser_code=pack_commission.ser_code');
//        $this->db->join('services','services.ser_code=pack_commission.ser_code');
        
        return $this->db->get('pack_commission')->result_array();
    }
    
    /*
     * Get all pack_commission
     */
    function get_all_pack_commission_vendor($pk_id)
    {
        return $this->db->get_where('pack_commission',array('pack_id'=>$pk_id))->result_array();
    }
    
    function get_pack_commission_service($ser_code,$pk_id)
    {
        return $this->db->get_where('pack_commission',array('pack_id'=>$pk_id,'ser_code'=>$ser_code))->row_array();
    }
    /*
     * function to add new pack_commission
     */
    function add_pack_commission($params)
    {
        $this->db->insert('pack_commission',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update pack_commission
     */
    function update_pack_commission($pk_id,$serv,$params)
    {
        $this->db->where('pack_id',$pk_id);
        $this->db->where('ser_code',$serv);
        $response = $this->db->update('pack_commission',$params);
        if($response)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    
    /*
     * function to delete pack_commission
     */
    function delete_pack_commission($pk_id)
    {
        $response = $this->db->delete('pack_commission',array('pk_id'=>$pk_id));
        if($response)
        {
            return "pack_commission deleted successfully";
        }
        else
        {
            return "Error occuring while deleting pack_commission";
        }
    }
    
    function add_pack_commission_batch($params)
    {
        $this->db->insert_batch('pack_commission',$params);
        return $this->db->insert_id();
    }
}
