<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Concierge_order_model  extends CI_Model {
    //var $table , $column_order, $column_search , $order =  '';
    var $table = CONCIERGE_QUOTES;
    var $column_order = array('orders.tracking_id', 'orders.service_type', 'orders.service_id','orders.price','orders.created_at','orders.orderID','orders.receipt_file','orders.concierge_quote_id','cq.conciergeQuoteID','orders.status','cq.description','cq.offer_price','cq.status as cqstatus' ,'cq.created_at as cqcreated_at'); 
    // var $column_order2 = array('concierge_quotes.conciergeQuoteID',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
    //set column field database for datatable orderable
    var $column_search = array('orders.tracking_id', 'orders.price','orders.service_type','cq.description'); //set column field database for datatable searchable
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
        $sel_fields = array_filter($this->column_order);

        $this->db->select($sel_fields);
        $this->db->from(CONCIERGE_QUOTES .' as cq');
        $this->db->join(ORDERS.' as orders', 'orders.concierge_quote_id = cq.conciergeQuoteID','left');
        // $this->db->where('orders.status!=' ,7);
        // $this->db->distinct('concierge_quote_id');
        // $this->db->where('cq.status!=' ,4);

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
                    $this->db->where('orders.service_type', $value);
                } else {
                    $this->db->or_where('orders.service_type', $value);
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
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        // lq();
        $result = $query->result();
        if(!empty($result)){
            foreach ($result as $key => $value) {
                if($value->status==7){
                    unset($result[$key]);
                }
            }
        }
        // pr($result);
        return $result;
    }

    function count_filtered() {
        $this->_get_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all() {
        $this->db->from($this->table);
        $this->db->where('status', 1);
        return $this->db->count_all_results();
    }

    function ticket_detail($id){
        $where = array('tickets.ticketID'=>$id);

        $this->db->select('
            tickets.ticketID,
            tickets.created_by_id,
            tickets.title,
            tickets.description,
            tickets.status,
            tickets.created_at,
            ');
        $this->db->from(TICKETS.' as tickets');
        $this->db->Where($where);
        $query = $this->db->get();
        return $query->row();
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
