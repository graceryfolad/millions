<?php

class Es_Group_model extends My_Model{
    public  $table;
    
    public function __construct() {
        parent::__construct();
        $this->table = 'es_group';
    }
    public function new_group($name,$amount,$total,$freq,$user) {
        $data = array(
            'es_grp_name'=>$name,
            'es_grp_amount'=>$amount,
            'es_grp_status'=>GROUP_OPEN,
            'es_grp_total'=>$total,
            'es_grp_freq'=>$freq,
            'us_id'=>$user
        );
        $result = $this->add($this->table, $data);
        if(is_array($result)){
            return $result['id'];
        }
        
        return FALSE;
    }
    public function get_all_groups() {
        $result = $this->get_all($this->table);
        if(is_array($result)){
            return $result;
        }
        return FALSE;
    }
    public function get_a_group($grpid) {
        $where = array(
            'es_grp_id'=>$grpid
        );
        $this->join = array(
            'table'=>'users',
            'common'=>'users.us_id=es_group.us_id'
        );
        $result = $this->get_one($this->table, $where);
        if(is_array($result)){
            return $result;
        }
        
        return FALSE;
    }
    
    public function get_running() {
        $where = array(
            'es_grp_status'=>GROUP_RUNNING
        );
        $result = $this->get_where($this->table, $where);
        
        if(is_array($result) && count($result)>0){
            return $result;
        }
        return FALSE;
        
    }
    
    public function get_user($user) {
        $where = array(
            'es_group.us_id'=>$user
        );
        $this->join = array(
            'table'=>'users',
            'common'=>'users.us_id=es_group.us_id'
        );
        $result = $this->get_where($this->table, $where);
        if(is_array($result)){
            return $result;
        }
        
        return FALSE;
    }
    
}
