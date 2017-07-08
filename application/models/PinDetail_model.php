<?php

class PinDetail_model extends My_Model {

    public $table;

    public function __construct() {
        parent::__construct();
        $this->table = "pin_details";
    }

    public function save_pins($param) {
        $ret = $this->add_batch($this->table, $param);
        if (is_array($ret)) {
            return TRUE;
        }

        return FALSE;
    }

    public function get_pin_batch($batch) {
        $where = array(
            'pin_batch' => $batch
        );
        $this->join = array(
            'table' => 'pin_denominations',
            'common' => 'pin_denominations.pin_code=pin_details.pin_code'
        );
        $pins = $this->get_where($this->table, $where);
        if (is_array($pins) && count($pins) > 0) {
            return $pins;
        }

        return FALSE;
    }

    public function buy_pins($usid, $pcode, $limit) {
        $this->limit = $limit;
        $data = array(
            'pin_code' => $pcode,
            'pin_status' => 1
        );

        $pins = $this->get_where($this->table, $data);
        if (is_array($pins) && count($pins) > 0) {

//            update

            return $pins;
        }
    }

    public function UpdatePin($key, $data) {
        $result = $this->Update($this->table, $key, $data);
        if ($result) {
            return TRUE;
        }
        return FALSE;
    }

    public function get_pins($req_id, $pcode) {
        $data = array(
            'pin_details.req_id' => $req_id,
            'pin_details.pin_code' => $pcode,
//            'pin_details.pin_status'=>2
        );

        $this->join = array(
            'table' => 'pin_denominations',
            'common' => 'pin_denominations.pin_code=pin_details.pin_code'
        );

        $result = $this->get_where($this->table, $data);
        if (is_array($result) && count($result) > 0) {
            return $result;
        }
    }

    public function sell_pins($pcode, $qty, $botby) {
        $data = array(
            'pin_code' => $pcode,
            'pin_status' => 2,
            'pin_botby' => $botby
        );
        $this->limit = $qty;
        $result = $this->get_where($this->table, $data);
        if (is_array($result)) {
//            update the pin

            foreach ($result as $value) {
                $datax = array(
                    'pin_status' => 3
                );
                $key = array(
                    'pin_id' => $value['pin_id']
                );

                $xx = $this->Update($this->table, $key, $datax);
            }

            return $result;
        }
    }

    public function sold_pins($usid) {
        $where = array(
            'pin_details.pin_status' => 3,
            'pin_details.pin_botby' => $usid
        );
        $this->join = array(
            array(
                'table' => 'pin_denominations',
                'common' => 'pin_denominations.pin_code=pin_details.pin_code'
            ),
            array(
                'table' => 'pin_purchases',
                'common' => 'pin_purchases.pin_id=pin_details.pin_id'
            ),
            array(
                'table' => 'users',
                'common' => 'pin_purchases.pur_by=users.us_id'
            )
        );
        $this->multiple = 1;
        $result = $this->get_where($this->table, $where);
        if (is_array($result)) {
            return $result;
        }

        return FALSE;
    }

    public function Verify_pin($pin) {
        $data = array(
            'pin_number' => $pin,
        );
        $this->join = array(
                    'table' => 'pin_denominations',
                    'common' => 'pin_denominations.pin_code=pin_details.pin_code'
        );
        $result = $this->get_one($this->table, $data);
        if (is_array($result)) {
           
            return $result;
          
        }
        return FALSE;
    }

    
}
