<?php

class MAEpin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('PinDetail_model');
    }

    public function verify() {
        if (isset($_POST)) {
            $pnum = $this->input->post('p_num');
            $result = $this->PinDetail_model->Verify_pin($pnum);

//                header('Content-type: application/json');
//                echo print_r($json);

            if (is_array($result)) {
                if ($result['pin_used'] == 1) {
                    $return = array(
                        'status' => 'Pin already used',
                        'code'=>101
                    );
                    $json = json_encode($return);
                    header('Content-type: application/json');
                    echo $json;
                } else {
                    $return = array(
                        'status' => 'Pin Ok',
                        'value'=>$result['pin_value'],
                        'pinid'=>$result['pin_id'],
                        'code'=>100
                    );
                    $json = json_encode($return);
                    header('Content-type: application/json');
                    echo $json;
                }
            } else {
                $res = array(
                    'status' => 'Invalid Pin',
                    'code'=>99
                );
                $json = json_encode($res);
                header('Content-type: application/json');
                echo $json;
            }
        }
    }

    
    public function LoadPin() {
        if(isset($_POST)){
            $id = $this->input->post('pid');
            
            
        }
    }
}
