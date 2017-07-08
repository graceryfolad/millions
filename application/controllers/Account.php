<?php
//ini_set("date.timezone", "Africa/Lagos");
class Account extends My_Controller {

    public $userdetails;
    public $type;

    function __construct() {
        parent::__construct();
        $this->load->model('Account_model');
        $this->load->model('Wallet_model');
        $this->userdetails = $this->GetDetails();
        $this->data['balance'] = $this->Wallet_model->Balance($this->userdetails['id']);
//        
        $this->type = $this->userdetails['type'];
        $this->data['uinfo'] = $this->userdetails;
    }

    /*
     * Listing of accounts
     */

    function index($status = NULL) {
        $this->body = "account/chps";
        if ($status != NULL) {
            if ($status == 0) {
                $this->data['status'] = "Password Change Failed";
            } elseif ($status == 1) {
                $this->data['status'] = "Password Change was Successful";
            } elseif ($status == 2) {
                $this->data['status'] = "Old password is wrong";
            } elseif ($status == 3) {
                $this->data['status'] = "Password Mismatch";
            }
        }
        $this->ShowView($this->type);
    }

    /*
     * Adding a new account
     */

    function ChangePS() {
        if (isset($_POST) && count($_POST) > 0) {
//            get user details

            $det = $this->Account_model->get_account($this->userdetails['email'],  $this->userdetails['id']);


            $old = $this->input->post('oldps');
            $newps = $this->input->post('newps');
            $retype = $this->input->post('retype');

            if (strcmp($newps, $retype) == 0) {
                $hashold = $this->Account_model->Hash($old);

                if ($det['acc_ps'] == $hashold) {
                    $params = array(
                        'acc_ps' => $this->Account_model->Hash($newps),
                    );

                    $status = $this->Account_model->update_account($this->userdetails['acc_id'], $params);

                    if ($status == FALSE) {
                        redirect('Account/index/0');
                    } else {
                        redirect('Account/index/1');
                    }
                } else {
                    redirect('Account/index/2');
                }
            } else {
                redirect('Account/index/3');
            }
        }
    }

    /*
     * Editing a account
     */

    function edit($acc_email) {
        // check if the account exists before trying to edit it
        $data['account'] = $this->Account_model->get_account($acc_email);

        if (isset($data['account']['acc_email'])) {
            if (isset($_POST) && count($_POST) > 0) {
                $params = array(
                    'acc_ps' => $this->input->post('acc_ps'),
                    'us_id' => $this->input->post('us_id'),
                    'acc_status' => $this->input->post('acc_status'),
                    'acc_type' => $this->input->post('acc_type'),
                    'pack_id' => $this->input->post('pack_id'),
                );

                $this->Account_model->update_account($acc_email, $params);
                redirect('account/index');
            } else {
                $this->load->model('User_model');
                $data['all_users'] = $this->User_model->get_all_users();

                $this->load->model('Package_model');
                $data['all_packages'] = $this->Package_model->get_all_packages();

                $data['_view'] = 'account/edit';
                $this->load->view('layouts/main', $data);
            }
        } else
            show_error('The account you are trying to edit does not exist.');
    }

    public function LogOut() {
        $data = array(
            'last_logout' => date('Y-m-d H:i:s'),
        );
        $user = $this->GetDetails();
        $this->Account_model->update_account($user['acc_id'], $data);

        $this->session->sess_destroy();


        redirect('/Home/Login');
    }

    public function AdChangePW() {
        if ($this->type == ADMIN) {
            if (isset($_POST) && count($_POST) > 0) {
                $password1 = $this->input->post('password1');
                $password2 = $this->input->post('password2');
                $ac_id = $this->input->post('acc_id');
                if (strcmp($password1, $password2) == 0) {
                    $data = array('acc_ps'=>  $this->Account_model->Hash($password1));
                    if($this->Account_model->update_account($ac_id, $data))
                    {
                        echo "Password has been changed successfully";
                    }
                    else{
                        echo "Password Not set";
                    }
                }
            }
        }
        else{
            redirect('/');
        }
    }

}
