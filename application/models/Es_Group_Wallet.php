<?php

class Es_Group_Wallet extends My_Model{
    public $table;
    public function __construct() {
        parent::__construct();
        $this->table="es_wallet";
    }
    
    public function new_wallet($grpid) {
        $data = array(
            'es_grp_id'=>$grpid,
            'es_wal_amt'=>0
        );
        
        $rep = $this->add($this->table, $data);
        if(is_array($rep)){
            return TRUE;
        }
        
        return FALSE;
    }
    
    public function get_es_wallet($grpid) {
        $where = array(
            'es_grp_id'=>$grpid
        );
        $result = $this->get_one($this->table, $where);
        if(is_array($result)){
            return $result;
        }
    }
    
    public function edit_wallet($id,$amt) {
        $key = array(
            'es_grp_id'=>$id
        );
        $data = array(
            'es_wal_amt'=>$amt
        );
        
        $repl = $this->Update($this->table, $key, $data);
        if($repl){
            return TRUE;
        }
    }
    
    public function get_balance($grpid) {
        $where = array(
            'es_grp_id'=>$grpid
        );
        
        $result  = $this->get_one($this->table, $where);
        if(is_array($result)){
            return $result;
        }
        return false;
    }
}


