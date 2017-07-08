<?php

class My_Model1 extends CI_Model {

    public $join;
    public $limit;
    public $order;
            function __construct() {
        parent::__construct();
    }

    public function add($table, $params) {
        if ($this->db->insert($table, $params)) {
            $id = $this->db->insert_id();
            $ret = array(
                'status' => TRUE,
                'id' => $id
            );

            return $ret;
        }
        return FALSE;
    }

    public function add_batch($table, $params) {
        if ($this->db->insert_batch($table, $params)) {
            $id = $this->db->insert_id();
            $ret = array(
                'status' => TRUE,
                'id' => $id
            );

            return $ret;
        }
        return FALSE;
    }

    public function Update($table, $key, $params) {
        $this->db->where($key);
        $response = $this->db->update($table, $params);
        if ($response) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function Delete($table, $key) {
        $response = $this->db->delete($table, $key);
        if ($response) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function get_all($table) {
        return $this->db->get($table)->result_array();
    }

    public function get_one($table, $key) {
        if (is_array($this->join) && count($this->join) > 0) {
            $this->db->join($this->join['table'], $this->join['common']);
        }

        $this->db->select();
        $this->db->from($table);
        $this->db->where($key);

        $query = $this->db->get();
        $qy = $query->row_array();
        return $qy;
    }

    public function get_where($table, $where) {

        if (is_array($this->join) && count($this->join) > 0) {
            $this->db->join($this->join['table'], $this->join['common']);
        }
        if($this->limit > 0){
            $this->db->limit($this->limit);
        }
        $this->db->select();
        $this->db->from($table);
        $this->db->where($where);

        $query = $this->db->get();
        $qy = $query->result_array();
        return $qy;
    }

}
