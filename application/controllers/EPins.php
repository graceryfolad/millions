<?php

require APPPATH . '/libraries/Moryield_Server.php';

use ServerGenerator\Libraries\Moryield_Server;

class EPins extends MY_Controller {

    public $userdetails;
    public $type;

    function __construct() {
        parent::__construct();
        $this->load->model('Wallet_model');
        $this->load->model('PinBatch_model');
        $this->load->model('ReqCart_model');
        $this->load->model('ReqBatch_model');
        $this->load->model('PinRequest_model');
        $this->load->model('PinDetail_model');
        $this->load->model('PinCategory_model');
        $this->load->model('PinPurchase_model');
         $this->load->model('Topup_wallet_model');
        $this->load->model('Account_model');
        
//      
        $this->userdetails = $this->GetDetails();
        $this->type = $this->userdetails['type'];
        $this->data['balance'] = $this->Wallet_model->Balance($this->userdetails['id']);
//        
        $this->data['type'] = $this->type;
        $this->data['uinfo'] = $this->userdetails;
    }

    public function index() {
        $this->body = "epin/epin_index";
        $batches = $this->PinBatch_model->get_all_batches();
        if (is_array($batches)) {
            $this->data['batches'] = $batches;
        }
        $this->ShowView($this->type);
    }

    public function NewBatch() {
        if ($this->type == ADMIN) {
            if (isset($_POST)) {
                $count = $this->input->post('bnum');
                $code = Moryield_Server::GenerateBatch($count);

                foreach ($code as $value) {
                    $bat[] = array(
                        'bat_code' => $value,
                        'bat_status' => BATCH_ACTIVE
                    );
                }
                $batches = $this->PinBatch_model->add_batch($bat);
                if ($batches) {
                    redirect('/Epins/index/1');
                }
                redirect('/EPins/index/0');
            }
        }
    }

    public function reqcart($id = NULL) {
        $this->body = "epin/buycart";
        if ($id != NULL) {
//            get the cart id info from request table
            $data = array(
                'req_id' => $id
            );
            $req = $this->ReqCart_model->get_a_req($data);
            if (is_array($req)) {
                $this->data['reqs'] = $req;
            }
        }
//        get pin denominations
        $denom = $this->PinCategory_model->get_all_denominations();
        if (is_array($denom) && count($denom) > 0) {
            $this->data['denom'] = $denom;
        }
        $this->data['reqid'] = $id;
        $this->ShowView($this->type);
    }

    public function viewpins($req_id = NULL, $code = NULL) {

        if ($req_id != NULL) {

            if ($code != NULL) {
//                get the pins of this pin code
            }
            $this->data['rid'] = $req_id;
            $data = array(
                'req_id' => $req_id
            );
            $req = $this->ReqCart_model->get_a_req($data);
            if (is_array($req)) {
                $this->data['reqinfo'] = $req;
            }

            $this->body = "epin/reqinfo";
        } else {
//            get all request by user
            $this->body = "epin/vpins";
            $data = array(
                'pin_orders.us_id' => $this->userdetails['id']
            );
            $reqs = $this->PinRequest_model->get_by_user($data);


            if (is_array($reqs)) {
                $this->data['requests'] = $reqs;
            }
        }
        $this->data['reqid'] = $req_id;
        $this->ShowView($this->type);
    }

    public function SellPins() {
//        get the available denominations
        $denom = $this->PinCategory_model->get_all_denominations();
        if (is_array($denom) && count($denom) > 0) {
            $this->data['denom'] = $denom;
        }
        
//        get all the pins sold
        $result = $this->PinDetail_model->sold_pins($this->userdetails['id']);
        if(is_array($result))
        {
            $this->data['soldpins']=$result;
        }
        $this->body = "epin/sellpins";
        $this->ShowView($this->type);
    }

    public function buypins() {
//        create a pin batch in table
        if ($this->type == VENDOR) {
            $data = array(
                'us_id' => $this->userdetails['id']
            );
            $id = $this->ReqBatch_model->newbatch($data);

            redirect("/EPins/reqcart/{$id}");
        }
    }

    public function ProcSell() {
        if($this->type == VENDOR){
        if(isset($_POST))
        {
            $usnam = $this->input->post('username');
            $qty = $this->input->post('qty');
            $pcode = $this->input->post('pcode');
            
//            check username
             $data = array('acc_username' => $usnam, 'acc_type' => VENDOR);
            $user_acc = $this->Account_model->get_account_any($data);
            
            if(is_array($user_acc)){
//                update the 
                
//                get the pins 
                $result = $this->PinDetail_model->sell_pins($pcode,$qty, $this->userdetails['id']);
                
                if(is_array($result))
                {
//                    print_r($result);
                    
                    foreach ($result as $value) {
                        $key = array(
                            'pin_id'=>$value['pin_id']
                        );
                        $data = array(
                            'pin_status'=>3
                        );
                        $this->PinDetail_model->UpdatePin($key,$data);  // update the pin to ready for used
                        $this->PinPurchase_model->new_purchase($user_acc['us_id'], $value['pin_id']);
                        
                    }
                    
//                    $this->session->set_userdata('sellpins',$result);
                    redirect('EPins/SellPins');
                }
            }
            
        }
        }
    }
    public function PinPurchase() {
//        get all the pin bought by this user
        $result = $this->PinPurchase_model->get_pur_user($this->userdetails['id']);
        if(is_array($result))
        {
            $this->data['ppurchases']=$result;
        }
        
        $this->body = "epin/pinpurchase";
        $this->ShowView($this->type);
    }

    public function SaleFinish() {
        if(isset($_SESSION['sellpins']))
        {
            $pin = $this->session->userdata('sellpins');
            print_r($pin);
        }
    }


    public function addcart() {
        if ($this->type == VENDOR) {
            $id = $this->input->post('reqid');
            $data = array(
                'req_id' => $id,
                'pin_code' => $this->input->post('pcode'),
                'pin_count' => $this->input->post('pnum'),
                'us_id' => $this->userdetails['id']
            );

            $this->ReqCart_model->addcart($data);
            redirect("EPins/reqcart/{$id}");
        }
    }

    public function CompleteReq() {
        if ($this->type == VENDOR) {
            $id = $this->input->post('reqid');
            $data = array(
                'req_id' => $id
            );
            $cart = $this->ReqCart_model->get_a_req($data);
            if (is_array($cart) && count($cart) > 0) {
                $sum = 0;
                foreach ($cart as $value) {
                    $pval = $value['pin_value'];
                    $qty = $value['pin_count'];
                    $amt = $pval * $qty;

                    $sum += $amt;
                }

                $data = array(
                    'req_id' => $id,
                    'us_id' => $this->userdetails['id'],
                    'req_amt' => $sum,
                    'req_date' => date('Y-m-d H:i:s'),
                    'req_status' => PIN_REQUEST_PENDING,
                    'req_yr' => date('Y'),
                    'req_mn' => date('m'),
                    'req_dy' => date('d'),
                );

                if ($this->data['balance'] >= $sum) {
//                     add the info to request table
                    $result = $this->PinRequest_model->addrequest($data);
                    if ($result) {
//                        deduct sum from the wallet
                        $oldbal = $this->data['balance'];
                        $newbal = $oldbal - $sum;
                        $this->Wallet_model->update_wallet($this->userdetails['id'], array('balance' => $newbal));
//                        get the pins
                        foreach ($cart as $value) {
                            $pcode = $value['pin_code'];
                            $limit = $value['pin_count'];
                            $thepins = $this->PinDetail_model->buy_pins($this->userdetails['id'], $pcode, $limit);
                            $rid = $value['req_id'];
//                            update the pins
                            foreach ($thepins as $apin) {
                                $key = array(
                                    'pin_id' => $apin['pin_id']
                                );
                                $data = array(
                                    'pin_bot' => 1,
                                    'pin_botby' => $this->userdetails['id'],
                                    'pin_botdate' => date('Y-m-d H:i:s'),
                                    'req_id' => $rid,
                                    'pin_status' => 2
                                );

                                $this->PinDetail_model->UpdatePin($key, $data);
                            }
                        }


                        redirect("EPins/viewpins/{$id}");
                    }
                } else {
                    redirect('');
                }
            }
        }
    }

    public function ShowPins($req_id, $pcode) {
        $result = $this->PinDetail_model->get_pins($req_id, $pcode);
        if (is_array($result)) {
            $this->data['mypins'] = $result;
        }
        $this->body = "epin/thepins";
        $this->ShowView($this->type);
    }
    
    public function LoadPin() {
        if(isset($_POST))
        {
            $pinid = $this->input->post('pid');
            $pvalue = $this->input->post('pvalue');
            
//            update the pin detail
            $key = array(
                'pin_id'=>$pinid
            );
            $data = array(
                'pin_used'=>1,
                'pin_usedby'=> $this->userdetails['id'],
                'pin_useddate'=>date('Y-m-d H:i:s')
            );
            $result = $this->PinDetail_model->UpdatePin($key,$data);
            if($result)
            {
//                update the member wallet
                $balance = $this->Wallet_model->Balance($this->userdetails['id']);
                $newbalance = $pvalue + $balance;
                $params = array(
//					'us_id' => $this->input->post('vendor'),
                    'balance' => $newbalance,
                    'wal_date' => date('Y-m-d H:i:s'),
                );
                $this->Wallet_model->update_wallet($this->userdetails['id'],$params);
                $topup = array(
                        'us_id' => $this->userdetails['id'],
                        'amount' => $pvalue,
                        'created' => date('Y-m-d H:i:s'),
                        'tp_status' => 1,
                        'tp_from' => $this->userdetails['id']
                    );

                    $this->Topup_wallet_model->add_topup_wallet($topup);
                redirect('Topup_wallet/index/1');
            }
        }
    }

}
