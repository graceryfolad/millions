<?php

class ReqBatch_model extends My_Model{
    public $table;
    public function __construct() {
        parent::__construct();
        $this->table="req_batch";
    }
    
    public function newbatch($params) {
        $result = $this->add($this->table, $params);
        if(is_array($result)){
            return $result['id'];
        }
    }
}

