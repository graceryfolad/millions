<?php

class Account_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /*
     * Get account by acc_email
     */

    function get_account($acc_email,$id) {
        return $this->db->get_where('accounts', array('acc_email' => $acc_email,'us_id'=>$id))->row_array();
    }

    /*
     * Get all accounts
     */

    function get_all_accounts() {
        return $this->db->get('accounts')->result_array();
    }

    /*
     * function to add new account
     */

    function add_account($params) {
        try {
            $this->db->insert('accounts', $params);
            return TRUE;
        } catch (Exception $ex) {
            return FALSE;
        }
    }

    /*
     * function to update account
     */

    function update_account($acc_id, $params) {
        $this->db->where('acc_id', $acc_id);
        $response = $this->db->update('accounts', $params);
        if ($response) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /*
     * function to delete account
     */

    function delete_account($acc_email) {
        $response = $this->db->delete('accounts', array('acc_email' => $acc_email));
        if ($response) {
            return "account deleted successfully";
        } else {
            return "Error occuring while deleting account";
        }
    }

    public function Login($email, $pass) {
        if (!empty($email) && !empty($pass)) {

            $this->db->select();
            $this->db->from('accounts');
            $this->db->where('acc_email', $email);

            $this->db->where('acc_ps', $this->Hash($pass));
//            $this->db->join('users', 'users.us_id=accounts.us_id', 'LEFT');
            $this->db->limit(1);

            $query = $this->db->get()->row_array();
            if(is_array($query)){
                $data=array('last_login'=>date('Y-m-d H:i:s'));
                $this->update_account($query['acc_id'], $data);
            }
            return $query;
        }
    }

    public function Hash($text) {

        return md5($text);
    }

    public function LogOut($params,$acc_id) {
        $this->db->where('acc_id',$acc_id);
        if($this->db->update('accounts',$params))
        {
            return TRUE;
        }
        return FALSE;
    }

    public function CheckUsername($username) {
        return $this->db->get_where('accounts', array('acc_username' => $username))->row_array();
    }
    
    function get_account_any($paraams) {
//        $this->db->join('users', 'users.us_id=accounts.us_id', 'LEFT');
        return $this->db->get_where('accounts', $paraams)->row_array();
    }
}
