<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('airvend');
    }

    public function Index() {
        $this->body = "guest/home";
        $this->guestlayout();
    }

    public function Register($error = NULL) {

        $this->body = "guest/register";
        // get the packages





        $this->guestlayout();
    }

    public function Forgot() {
        $this->body = "guest/forgot";
        $this->guestlayout();
    }

    public function Login() {
        $this->body = "guest/login";
        $this->guestlayout();
    }

    public function Regsuccess() {
        $this->body = "guest/regsuccess";
        $this->guestlayout();
    }

    public function VerifyUsername() {
        $this->load->model('Account_model');
        if (isset($_POST) && array_key_exists('username', $_POST)) {
            $username = $this->input->post('username');
            $det = $this->Account_model->CheckUsername($username);

            if (!is_array($det)) {
                $arr = $this->airvend->ValidateUsername($username);

                if ($arr !== FALSE) {
//                check theusername ffrom accounts

                    $this->data['matrix'] = $arr;

                    $this->load->model('Package_model');
                    $packs = $this->Package_model->get_all_packages();
                    $this->data['packs'] = $packs;

//                if ($error != NULL) {
//                    switch ($error) {
//                        case 1:
//                            $this->data['error'] = "Email or phone Number already exist";
//                            break;
//                        case 2:
//                            $err = $_SESSION['myerror'];
//                            $this->data['myerror'] = $err;
//                            break;
//                    }
//                }
                    $vm = $this->load->view('guest/new_register', $this->data, true);
                    echo $vm;
                } else {
                    echo "<p class=\"alert danger\">Invalid Username</p>";
                }
            } else {
                echo "<p class=\"alert danger\">Username already exist</p>";
            }
        }
    }

    public function About() {
        $this->body = "guest/about";
        $this->guestlayout();
    }

    public function Vendors() {
        $this->body = "guest/vendors";
        $this->guestlayout();
    }

    public function validate() {
        $arr = $this->airvend->ValidateUsername('digo');

        if (is_array($arr)) {
            $json = json_encode($arr);

            echo $json;
        }
    }

}
