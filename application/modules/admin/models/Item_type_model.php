<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Item_type_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    function add_item_type($table, $dataInsert) {
        $where = array('title' => $dataInsert['title'], 'status' => 1);
        $this->db->select('*');
        $this->db->from(AIR_FREIGHT_ITEMS);
        $this->db->where($where);
        $query = $this->db->get();
        $res = $query->row();
        if ($res) {
            return false;
        } else {
            $this->db->insert($table, $dataInsert);
            return true;
        }
    }
}
