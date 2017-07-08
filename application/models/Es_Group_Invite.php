<?php

class Es_Group_Invite extends My_Model{
    public $table;
    public function __construct() {
        parent::__construct();
        $this->table="es_grp_invite";
    }
    
    public function new_invite($grpid,$username) {
        $data = array(
            'es_grp_id'=>$grpid,
            'us_id'=>$username,
            'inv_date'=>date('Y-m-d')
        );
        
        $rep = $this->add($this->table, $data);
        if(is_array($rep)){
            return TRUE;
        }
        
        return FALSE;
    }
    public function get_grp_invite($grpid) {
        $where = array(
            'es_grp_id'=>$grpid
        );
        $this->join = array(
            'table'=>'users',
            'common'=>'users.us_id=es_grp_invite.us_id'
        );
        $result = $this->get_where($this->table, $where);
        if(is_array($result)){
            return $result;
        }
        
        return FALSE;
    }
    
    public function get_invite_user($us_id) {
        $where = array(
            'es_grp_invite.us_id'=>$us_id
        );
        $this->join = array(
            array(
                'table' => 'users',
                'common' => 'users.us_id=es_grp_invite.us_id'
            ),
            array(
                'table' => 'es_group',
                'common' => 'es_group.es_grp_id=es_grp_invite.es_grp_id'
            ),
        );
        $this->multiple=1;
        $resultx = $this->get_where($this->table, $where);
        
        
        if(is_array($resultx)){
           
            
            return $resultx;
        }
        return FALSE;
    }
    public function delete_invite($usid,$grpid) {
        $key =array(
            'us_id'=>$usid,
            'es_grp_id'=>$grpid
        );
        
        if($this->Delete($this->table, $key)){
            return TRUE;
        }
        
        return FALSE;
    }
    
}
