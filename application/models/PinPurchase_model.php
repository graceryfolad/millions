<?php

class PinPurchase_model extends My_Model {

    public $table;

    public function __construct() {
        parent::__construct();
        $this->table = "pin_purchases";
        $this->join = array(
            array(
                'table' => 'pin_details',
                'common' => 'pin_details.pin_id=pin_purchases.pin_id'
            ),
            array(
                'table' => 'pin_denominations',
                'common' => 'pin_details.pin_code=pin_denominations.pin_code'
            ),
            array(
                'table' => 'users',
                'common' => 'users.us_id=pin_purchases.pur_by'
            ),
        );
    }

    public function new_purchase($usid, $pinid) {
        $data = array(
            'pin_id' => $pinid,
            'pur_by' => $usid,
            'pur_date' => date('Y-m-d H:i:s')
        );

        $result = $this->add($this->table, $data);
        if (is_array($result)) {
            return TRUE;
        }
    }

    public function get_all_pur() {
        $this->multiple=1;
        $result = $this->get_all($this->table);
        if(is_array($result))
        {
            return $result;
        }
    }

    public function get_pur_user($usid) {
        $this->multiple=1;
        $data = array(
            'pin_purchases.pur_by'=>$usid
        );
        $result = $this->get_where($this->table,$data);
        if(is_array($result))
        {
            return $result;
        }
    }

}
