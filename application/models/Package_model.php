<?php
/* 
 * Generated by CRUDigniter v3.0 Beta 
 * www.crudigniter.com
 */
 
class Package_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    /*
     * Get package by pack_id
     */
    function get_package($pack_id)
    {
        return $this->db->get_where('packages',array('pack_id'=>$pack_id))->row_array();
    }
    
    /*
     * Get all packages
     */
    function get_all_packages()
    {
        return $this->db->get('packages')->result_array();
    }
    
    /*
     * function to add new package
     */
    function add_package($params)
    {
        $this->db->insert('packages',$params);
        return $this->db->insert_id();
    }

    function add_packages($params)
    {
        try {
            $this->db->insert_batch('packages',$params);
        return TRUE;
        } catch (Exception $ex) {
            return FALSE;
        }
        
    }
    
    /*
     * function to update package
     */
    function update_package($pack_id,$params)
    {
        $this->db->where('pack_id',$pack_id);
        $response = $this->db->update('packages',$params);
        if($response)
        {
            return "package updated successfully";
        }
        else
        {
            return "Error occuring while updating package";
        }
    }
    
    /*
     * function to delete package
     */
    function delete_package($pack_id)
    {
        $response = $this->db->delete('packages',array('pack_id'=>$pack_id));
        if($response)
        {
            return "package deleted successfully";
        }
        else
        {
            return "Error occuring while deleting package";
        }
    }
}
