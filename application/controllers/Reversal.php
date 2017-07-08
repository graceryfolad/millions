<?php

class Reversal extends MY_Controller {

    public $userdetails;
    public $type;

    public function __construct() {
        parent::__construct();

        $this->load->model('Order_model');
        $this->load->model('Wallet_model');
        $this->load->model('Account_model');
        $this->load->model('Pack_commission_model');


        $this->userdetails = $this->GetDetails();

        $this->type = $this->userdetails['type'];
        $this->data['uinfo'] = $this->userdetails;
        $this->data['type'] = $this->type;
    }

    public function index($status = NULL) {
        if ($status != NULL) {
            if ($status == 1) {
                $this->data['status'] = "Reversal Successful";
            } else {
                $this->data['status'] = "Reversal not Successful";
            }
        }
        $this->body = "reversal/index";

        $this->ShowView($this->type);
    }

    public function GetInfo() {
        if ($_POST && count($_POST) > 0) {
            $id = $this->input->post('orderid');

            $order = $this->Order_model->get_order_details($id);
            if (is_array($order) && count($order) > 0) {
                $this->data['orderinfo'] = $order;
                $vm = $this->load->view('reversal/orderdet', $this->data, TRUE);

                echo $vm;
            } else {
                echo "<p class=\"alert danger\">Order ID does not exist</p>";
            }
        }
    }

    public function Reverse() {
        if ($_POST && count($_POST) > 0) {
            $id = $this->input->post('orid');
            $order = $this->Order_model->get_order_details($id);
            $balance = $this->Wallet_model->balance($order['us_id']);

            if ($order['ord_status'] == ORDER_SUCCESS) {
                $remove_comm = $balance - $order['ord_comm'];
                $add_amt = $remove_comm + $order['amount'];

//                update the balance
                if ($this->Wallet_model->update_wallet($order['us_id'], array('balance' => $add_amt))) {

//                update the order status
                    $update = array('ord_status' => ORDER_FAILED, 'ord_comm' => NULL);

                    $this->Order_model->update_order($order['ord_id'], $update);
                    redirect("/Reversal/index/{$id}");
                }
            } elseif ($order['ord_status'] == ORDER_FAILED) {
//                get the pack of user and calculate the commission
                $data = array('us_id' => $order['us_id'], 'acc_type' => VENDOR);
                $acct = $this->Account_model->get_account_any($data);
                $pack_comm = $this->Pack_commission_model->get_pack_commission_service($order['ser_code'], $acct['pack_id']);

                if ($pack_comm['is_percent'] == 1) {

                    $comm_earned = ($pack_comm['comm_per'] / 100) * $order['amount'];
                } elseif ($pack_comm['is_percent'] == 2) {
                    $comm_earned = 0;
                }


                $add_comm = $balance + $comm_earned;
                $new_bal = $add_comm - $order['amount'];
                try {
                    $this->Order_model->update_order($order['ord_id'], array('ord_status' => ORDER_SUCCESS, 'ord_comm' => $comm_earned));
                    $this->Wallet_model->update_wallet($order['us_id'], array('balance' => $new_bal));

                    redirect("/Reversal/index/1");
                } catch (Exception $ex) {
                    redirect("/Reversal/index/0");
                }
            }
        }
    }

}
