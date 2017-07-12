<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BankDetail_model
 *
 * @author User
 */
class BankDetail_model extends My_Model {
    //put your code here
    public $table;
    public function __construct() {
        parent::__construct();
        $this->table="bank_detail";
    }
    
    public function new_bank($usid,$bank,$accname,$accnum) {
        $data = array(
            'us_id'=>$usid,
            'bank_name'=>$bank,
            'acct_num'=>$accnum,
            'acct_name'=>$accname
        );
        
        $rep = $this->add($this->table, $data);
        if(is_array($rep)){
            return TRUE;
        }
        
        return FALSE;
    }
    public function edit_bank($usid,$bank,$accname,$accnum) {
        $key = array(
           'us_id'=>$usid,
        );
        $data = array(
            
            'bank_name'=>$bank,
            'acct_num'=>$accnum,
            'acct_name'=>$accname
        );
        
         
        $repl = $this->Update($this->table, $key, $data);
        if($repl){
            return TRUE;
        }
    }
    public function get_bank($usid) {
        $where = array(
            'us_id'=>$usid
        );
        $result = $this->get_one($this->table, $where);
        if(is_array($result) && count($result)>0){
            return $result;
        }
        
        return FALSE;
    }
    
}
