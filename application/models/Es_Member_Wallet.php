<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Es_Member_Wallet
 *
 * @author User
 */
class Es_Member_Wallet extends My_Model{
    //put your code here
    public $table;
    public function __construct() {
        parent::__construct();
        $this->table="es_member_wallet";
    }
    
    public function new_mwalltet($us) {
        $data = array(
            'us_id'=>$us,
            'es_mem_amount'=>0
        );
        
        $rep = $this->add($this->table, $data);
        if(is_array($rep)){
            return TRUE;
        }
        
        return FALSE;
    }
    public function edit_wallet($usid,$amt) {
        $key = array(
            'us_id'=>$usid
        );
        $data = array(
            'es_mem_amount'=>$amt
        );
        
        $repl = $this->Update($this->table, $key, $data);
        if($repl){
            return TRUE;
        }
    }
    
    public function get_balance($usid) {
        $where = array(
            'us_id'=>$usid
        );
        
        $result  = $this->get_one($this->table, $where);
        if(is_array($result)){
            return $result;
        }
        return false;
    }
    
}
