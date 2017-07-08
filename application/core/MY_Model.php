<?php

class My_Model extends CI_Model {

    public $join;
    public $limit;
    public $order;
    public $multiple;

    function __construct() {
        parent::__construct();
        $this->multiple = 0;
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
        if ($this->limit > 0) {
            $this->db->limit($this->limit);
        }
        $this->db->select('*');
        $this->db->from($table);

        $this->SetJoin();



        $cp = $this->db->get_compiled_select();

//echo $cp;
//exit();
        $query = $this->db->query($cp);



//        $query = $this->db->get();
        $qy = $query->result_array();

        return $qy;
    }

    public function get_one($table, $key) {
//        if (is_array($this->join) && count($this->join) > 0) {
//            $this->db->join($this->join['table'], $this->join['common']);
//        }

        $this->SetJoin();
        $this->db->select();
        $this->db->from($table);
        $this->db->where($key);

//        $query = $this->db->get();
        $cp = $this->db->get_compiled_select();


        $query = $this->db->query($cp);
        $qy = $query->row_array();
        return $qy;
    }

    public function get_where($table, $where) {
//
//        if (is_array($this->join) && count($this->join) > 0) {
//            $this->db->join($this->join['table'], $this->join['common'], 'inner');
//        }
        if ($this->limit > 0) {
            $this->db->limit($this->limit);
        }
        $this->db->select();
        $this->db->from($table);
        $this->db->where($where);
        $this->SetJoin();
        $cp = $this->db->get_compiled_select();


        $query = $this->db->query($cp);
//        $query = $this->db->get();
        $qy = $query->result_array();

        return $qy;
    }

    public function get_query($sql) {
        
    }

    private function SetJoin() {
        if (is_array($this->join) && count($this->join) > 1) {
            if ($this->multiple == 1) {
                foreach ($this->join as $value) {
                    $vx = $value['table'];
                    $cm = $value['common'];

                    $this->db->join($vx, "{$cm}");
                }
            } elseif ($this->multiple == 0) {
                $this->db->join($this->join['table'], $this->join['common']);
            }
        }
    }

}
