<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pending_order_list_model extends CI_Model {
    //var $table , $column_order, $column_search , $order =  '';
    var $table = ORDERS;
    var $column_order = array(null, 'o.orderID', 'o.user_id', 'o.service_type', 'o.service_id', 'o.quantity', 'o.price', 'o.tracking_id', 'o.drop_location', 'o.shipper_name', 'o.shipper_tracking_id', 'o.shipper_company_name', 'o.shipper_description', 'o.status', 'o.updated_at', 'o.created_at'); //set column field database for datatable orderable
    //pr($column_order);
    var $column_search = array('o.tracking_id', 'o.price', 'o.service_type'); //set column field database for datatable searchable
    var $order = array('o.orderID' => 'DESC'); // default order
    var $where = array();
    var $group_by = 'o.orderID';
    public function __construct() {
        parent::__construct();
    }

    public function set_data($where = '') {
        $this->where = $where;
    }

    private function _get_query() {
        $sel_fields = array_filter($this->column_order);
        $this->db->select($sel_fields);
        $this->db->from(ORDERS . ' as o');
        $this->db->where('status >=','2');
        $this->db->where('STATUS !=' , 9);

        if (isset($_POST['search']['value']) && !empty($_POST['search']['value'])) {
            $this->db->group_start();
        }
        $i = 0;
        foreach ($this->column_search as $emp) // loop column
        {
            $array_del = getAllDeliveryCustom();
            // pr($array_del);
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
                // pr($id);
                
            }
            // pr($_POST['search']['value']);
            $i++;
        }
        $id = $this->searchForId($_POST['search']['value'], $array_del);
        if (count($id) > 0) {
            $this->db->or_group_start();
            foreach ($id as $key => $value) {
                if ($key = 0) {
                    $this->db->where('o.service_type', $value);
                } else {
                    $this->db->or_where('o.service_type', $value);
                }
            }
            $this->db->group_end();
        }
        if (isset($_POST['search']['value']) && !empty($_POST['search']['value'])) {
            $this->db->group_end();
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

        
        if (!empty($_POST['service_type'])) {
            //pr($_POST['status']);
            $this->db->group_start();
            if (!empty($_POST['service_type'])) {
             //pr($_POST['status']);
                $this->db->where_in('service_type', $_POST['service_type']);
            } else {
                $this->db->or_where('service_type', $_POST['service_type']);
            }
            $this->db->group_end();
        }
        if (!empty($_POST['status'])) {
            //pr($_POST['status']);
            $this->db->group_start();
            if (!empty($_POST['status'])) {
             //pr($_POST['status']);
                $this->db->where_in('o.status', $_POST['status']);
            } else {
                $this->db->or_where('o.status', $_POST['status']);
            }
            $this->db->group_end();
        }
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered() {

       if (!empty($_POST['service_type'])) {
            //pr($_POST['status']);
            $this->db->group_start();
            if (!empty($_POST['service_type'])) {
             //pr($_POST['status']);
                $this->db->where_in('service_type', $_POST['service_type']);
            } else {
                $this->db->or_where('service_type', $_POST['service_type']);
            }
            $this->db->group_end();
        }
        if (!empty($_POST['status'])) {
            //pr($_POST['status']);
            $this->db->group_start();
            if (!empty($_POST['status'])) {
             //pr($_POST['status']);
                $this->db->where_in('o.status', $_POST['status']);
            } else {
                $this->db->or_where('o.status', $_POST['status']);
            }
            $this->db->group_end();
        }
        $this->db->limit($_POST['length'], $_POST['start']);
        $this->_get_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all() {
        $this->db->from($this->table);
        $this->db->where('status', 1);
        return $this->db->count_all_results();
    }
    
    function searchForId($id, $array) {
        $store = array();
        $result = array_filter($array, function ($item) use ($id) {
            if (stripos($item, $id) !== false) {
                return true;
            }
            return $result;
        });
        return array_keys($result);
    }
}
