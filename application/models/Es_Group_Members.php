<?php

class Es_Group_Members extends My_Model {

    public $table;

    public function __construct() {
        parent::__construct();
        $this->table = "es_grp_members";
    }

    public function new_member($grpid, $user) {
        $data = array(
            'es_grp_id' => $grpid,
            'us_id' => $user
        );

        $rep = $this->add($this->table, $data);
        if (is_array($rep)) {
            return TRUE;
        }

        return FALSE;
    }

    public function get_members($grpid) {
        $where = array(
            'es_grp_id' => $grpid
        );
        $this->join = array(
            'table' => 'users',
            'common' => 'users.us_id=es_grp_members.us_id'
        );
        $result = $this->get_where($this->table, $where);
        if (is_array($result)) {
            return $result;
        }
        return FALSE;
    }

    public function get_group_member($grpid, $usid) {
        $where = array(
            'es_grp_id' => $grpid,
            'us_id' => $usid
        );
        $this->join = array(
            'table' => 'users',
            'common' => 'users.us_id=es_grp_members.us_id'
        );
        $result = $this->get_where($this->table, $where);
        if (is_array($result)) {
            return $result;
        }
        return FALSE;
    }

    public function get_group_user($usid) {
        $where = array(
            'es_grp_members.us_id' => $usid
        );
        $this->join = array(
            array(
                'table' => 'users',
                'common' => 'users.us_id=es_grp_members.us_id'
            ),
            array(
                'table' => 'es_group',
                'common' => 'es_group.es_grp_id=es_grp_members.es_grp_id'
            ),
        );
        $this->multiple=1;
        $result = $this->get_where($this->table, $where);
        if (is_array($result)) {
            return $result;
        }
        return FALSE;
    }

    public function AddPosition($grpid, $position, $usid) {
        $key = array(
            'es_grp_id' => $grpid,
            'us_id' => $usid
        );

        $data = array(
            'coll_position' => $position
        );

        $rep = $this->Update($this->table, $key, $data);

        if ($rep) {
            return TRUE;
        }

        return FALSE;
    }

}
