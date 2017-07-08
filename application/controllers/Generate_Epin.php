<?php

require APPPATH . '/libraries/Moryield_Server.php';

use ServerGenerator\Libraries\Moryield_Server;

class Generate_Epin extends MY_Controller {

    public $userdetails;
    public $type;

    public function __construct() {
        parent::__construct();
        $this->load->model('PinBatch_model');
        $this->load->model('PinCart_model');
        $this->load->model('PinCategory_model');

        $this->load->model('PinDetail_model');

        $this->userdetails = $this->GetDetails();
        $this->type = $this->userdetails['type'];
        if ($this->type == VENDOR) {
            $this->data['balance'] = $this->Wallet_model->Balance($this->userdetails['id']);
        }

//        
        $this->data['type'] = $this->type;
        $this->data['uinfo'] = $this->userdetails;
    }

    public function index() {
//        get used pin batches 
        $this->body = "epin/gpin_index";
        $used = $this->PinBatch_model->get_all_used_batches();
        if (is_array($used) && count($used) > 0) {
            $this->data['used'] = $used;
        }

        $this->ShowView($this->type);
    }

    public function getbatch() {
        if (isset($_POST)) {
            $batch = $this->PinBatch_model->get_a_batch();
            if (is_array($batch)) {
                redirect("Generate_Epin/pincart/{$batch['bat_code']}");
            }
        }
    }

    public function pincart($batch) {
//        get the data in the cart for this batch number
        $this->body = "epin/pcart";
        $cart = $this->PinCart_model->get_cart($batch);
        if (is_array($cart)) {
            $this->data['cart'] = $cart;
        }
//        get pin denominations
        $denom = $this->PinCategory_model->get_all_denominations();
        if (is_array($denom) && count($denom) > 0) {
            $this->data['denom'] = $denom;
        }

        $this->data['batch'] = $batch;
        $this->ShowView($this->type);
    }

    public function addcart() {
        if (isset($_POST) && count($_POST) > 0) {
            $date = date('Y-m-d H:i:s');
            $data = array(
                'bat_code' => $this->input->post('batch'),
                'pin_code' => $this->input->post('pcode'),
                'pin_count' => $this->input->post('pnum'),
                'created' => $date
            );
            if ($this->PinCart_model->add_cart($data)) {
                $this->PinBatch_model->update_batch($data['bat_code']);
            }
            redirect("Generate_Epin/pincart/{$data['bat_code']}");
        }
    }

    public function generate() {
        if (isset($_POST) && count($_POST) > 0) {
            $batch = $this->input->post('batch');
            $cart = $this->PinCart_model->get_cart($batch);

            $pins = array();
            foreach ($cart as $value) {
                $arr1 = str_split($batch);
                $start = "{$arr1[count($arr1) - 1]}{$arr1[count($arr1) - 2]}";
                $pins[] = Moryield_Server::GeneratePin(100, $start, $value['pin_count'], $value['pin_code']);
            }

            if (is_array($pins)) {
                shuffle($pins);
                $all = array();
                foreach ($pins as $value) {
                    foreach ($value as $row) {
                        $all[] = array(
                            'pin_code' => $row['code'],
                            'pin_number' => $row['pin'],
                            'pin_serial' => $row['serial'],
                            'pin_batch' => $batch,
                            'pin_created' => date('Y-m-d H:i:s'),
                            'pin_status' => 1,
                        );
                    }
                }


//               save pins to table
                $this->PinDetail_model->save_pins($all);
                redirect("/Generate_Epin/pin_batch/{$batch}");
            }
        }
    }

    public function pin_batch($batch) {
//        get the pin details of a batch
        $pins = $this->PinDetail_model->get_pin_batch($batch);
        if (is_array($pins)) {
            $this->data['pins'] = $pins;
        }
        $this->body="epin/view_pins";
        $this->ShowView($this->type);
    }

}
