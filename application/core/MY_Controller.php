<?php
ini_set("date.timezone", "Africa/Lagos");
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    //set the class variable.
    public $template = array();
    public $data = array();
    public $userdetails = array();

    /* Loading the default libraries, helper, language */

    public function __construct() {
        parent::__construct();
//            $this->load->library(array('session'));
        $this->load->helper(array('form', 'language', 'url', 'html'));
    }

    /* Front Page Layout */

    public function guestlayout() {
        $this->template['header'] = $this->load->view('general/metro-header', $this->data, true);
        // $this->template['sidepanel']   = $this->load->view('general/header', $this->data, true);
        $this->template['body'] = $this->load->view($this->body, $this->data, true);
        $this->template['footer'] = $this->load->view('general/footer', $this->data, true);
        $this->load->view('guest/guestlayout_metro', $this->template);
    }

    public function userlayout() {
        if (is_array($this->session->userdata('userdetails'))) {

            
           
            $this->template['header'] = $this->load->view('general/metro-header', $this->data, true);
            //$this->template['sidepanel']   = $this->load->view('userlayout/sidebar', $this->data, true);
            $this->template['body'] = $this->load->view($this->body, $this->data, true);
            $this->template['footer'] = $this->load->view('general/footer', $this->data, true);
            $this->load->view('vendor/vendorlayout', $this->template);
        } else {
            redirect('/Home/Index');
        }
    }

    public function adminlayout() {
        if (is_array($this->session->userdata('admindetails'))) {

            
            $this->template['header'] = $this->load->view('general/metro-header', $this->data, true);
            //$this->template['sidepanel']   = $this->load->view('userlayout/sidebar', $this->data, true);
            $this->template['body'] = $this->load->view($this->body, $this->data, true);
            $this->template['footer'] = $this->load->view('general/footer', $this->data, true);
            $this->load->view('admin/adminlayout', $this->template);
        } else {
            redirect('/Home/Login');
        }
    }

    public function merchantlayout() {
        if (is_array($this->session->userdata('merdetails'))) {

            
            $this->template['header'] = $this->load->view('general/metro-header', $this->data, true);
            //$this->template['sidepanel']   = $this->load->view('userlayout/sidebar', $this->data, true);
            $this->template['body'] = $this->load->view($this->body, $this->data, true);
            $this->template['footer'] = $this->load->view('general/footer', $this->data, true);
            $this->load->view('seller/seller_layout', $this->template);
        } else {
            redirect('/Home/Index');
        }
    }

    public function GetDetails() {
        if (isset($_SESSION['userdetails'])) {
            return $this->session->userdata('userdetails');
        } elseif (isset($_SESSION['admindetails'])) {
            return $this->session->userdata('admindetails');
        } elseif (isset($_SESSION['merdetails'])) {
            return $this->session->userdata('merdetails');
        } else {
            redirect('/Home/Login');
        }
    }

    
    public function ShowView($type) {
        switch ($type) {
            case VENDOR:
                $this->userlayout();
                break;
            case ADMIN:
                $this->adminlayout();
                break;
            case MERCHANT:
                $this->merchantlayout();
                break;
        }
    }
}
