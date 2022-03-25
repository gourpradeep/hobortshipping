<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class New_quote_concierge_list_model  extends CI_Model {
    //var $table , $column_order, $column_search , $order =  '';
    var $table = CONCIERGE_QUOTES;
    var $column_order = array(null, 'cq.conciergeQuoteID', 'cq.user_id', 'cq.description','cq.offer_price', 'cq.status','cq.updated_at','cq.created_at'); //set column field database for datatable orderable
    //pr($column_order);
    var $column_search = array('cq.offer_price', 'cq.description','u.full_name'); //set column field database for datatable searchable
    var $order = array('cq.conciergeQuoteID' => 'DESC'); // default order
    var $where = array();
    var $group_by = 'cq.conciergeQuoteID';
    public function __construct() {
        parent::__construct();
    }

    public function set_data($where = '') {
        $this->where = $where;
    }

    private function _get_query() {
        //$sel_fields = array_filter($this->column_order);
        //$where = "cq.status='1' OR cq.status='2'";
        $this->db->select('cq.* ,u.full_name, u.avatar , u.userID');
        $this->db->from(CONCIERGE_QUOTES .' as cq');
        $this->db->join(USERS.' as u','u.userID = cq.user_id','left');
        $this->db->where('cq.status <=','2');
        $i = 0;
        foreach ($this->column_search as $emp) // loop column
        {
            if (isset($_POST['search']['value']) && !empty($_POST['search']['value'])) {
                $_POST['search']['value'] = $_POST['search']['value'];
            } else $_POST['search']['value'] = '';
            if ($_POST['search']['value']) // if datatable send POST for search
            {
                if ($i === 0) // first loop
                {
                    $this->db->group_start();
                    $this->db->like(($emp), $_POST['search']['value']);
                } else {
                    $this->db->or_like(($emp), $_POST['search']['value']);
                }
                if (count($this->column_search) - 1 == $i) //last loop
                $this->db->group_end(); //close bracket
                
            }
            $i++;
        }
        if (!empty($this->where)) $this->db->where($this->where);
        if (!empty($this->group_by)) {
            $this->db->group_by($this->group_by);
        }
        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order) ]);
        }
    }

    function get_list() {
        $this->_get_query();
        if (isset($_POST['length']) && $_POST['length'] < 1) {
            $_POST['length'] = '10';
        } else $_POST['length'] = $_POST['length'];
        if (isset($_POST['start']) && $_POST['start'] > 1) {
            $_POST['start'] = $_POST['start'];
        }
        if (!empty($_POST['status'])) {
            //pr($_POST['status']);
            $this->db->group_start();
            if (!empty($_POST['status'])) {
             //pr($_POST['status']);
                $this->db->where('cq.status', $_POST['status']);
            } else {
                $this->db->where('cq.status', $_POST['status']);
            }
            $this->db->group_end();
        }
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get(); //lq();
        return $query->result();
    }

    function count_filtered() {
           if (!empty($_POST['status'])) {
            //pr($_POST['status']);
            $this->db->group_start();
            if (!empty($_POST['status'])) {
             //pr($_POST['status']);
                $this->db->where('cq.status', $_POST['status']);
            } else {
                $this->db->where('cq.status', $_POST['status']);
            }
            $this->db->group_end();
        }
        $this->_get_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all() {
        $this->db->from($this->table);
        $this->db->where('status', 1);
        return $this->db->count_all_results();
    }
}
