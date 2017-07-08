<?php

class Es_Group_Position extends My_Model{
    public $table;
    public function __construct() {
        parent::__construct();
        $this->table="";
    }
}