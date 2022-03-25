<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Current_order_model  extends CI_Model {
    //var $table , $column_order, $column_search , $order =  '';
    var $table = ORDERS;
    var $column_order = array('orders.tracking_id', 'orders.service_type', 'orders.service_id','orders.price','orders.created_at','sea.title as sea_title','courier.title as courier_title','order_item.title as air_title','orders.orderID','orders.receipt_file','orders.concierge_quote_id','orders.status'); 
    // var $column_order2 = array('concierge_quotes.conciergeQuoteID',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
    //set column field database for datatable orderable
    var $column_search = array('orders.tracking_id', 'orders.price','orders.service_type','sea.title','courier.title ','order_item.title'); //set column field database for datatable searchable
    var $order = array('orders.orderID' => 'DESC'); // default order
    var $where = array();
    var $group_by = 'orders.orderID';
    public function __construct() {
        parent::__construct();
    }

    public function set_data($where = '') {
        $this->where = $where;
    }

    private function _get_query() {
        $sel_fields = array_filter($this->column_order);

        $this->db->select($sel_fields);
        $this->db->from(ORDERS .' as orders');
        $this->db->join(SEA_FREIGHT_SERVICES.' as sea', 'orders.service_id = sea.seaFreightServiceID AND orders.service_type=2','left');
        $this->db->join(COURIER_SERVICES.' as courier', 'orders.service_id = courier.courierServiceID AND orders.service_type=3','left');
        $this->db->join(AIR_FREIGHT_ORDER_INFO.' as order_info', 'orders.orderID = order_info.order_id','left');
        $this->db->join(AIR_FREIGHT_ITEMS.' as order_item', 'order_item.airFreightItemID = order_info.item_id AND orders.service_type=1','left');
        // $this->db->join(CONCIERGE_QUOTES.' as cq', 'orders.concierge_quote_id = cq.conciergeQuoteID','right');
        $this->db->where('orders.status!=' ,7);
        $this->db->where('orders.service_type!=' ,4);
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
        // $query1 = '('.$this->db->get_compiled_select().')'; //lq();

        // $this->db->select('"" as tracking_id, "" as service_type, "" as service_id,"" as price,"" as created_at,"" as sea_title,"" as courier_title,"" as air_title,"" as orderID,"" as receipt_file,conciergeQuoteID as concierge_quote_id');
        // $this->db->from(CONCIERGE_QUOTES .' as concierge_quotes');
        // $this->db->where('status <=' ,2);
        // $this->db->where($this->where);
        // // $this->db->distinct('concierge_quote_id');

        // $query2 = '('.$this->db->get_compiled_select().')'; //lq();

        // $final = 'SELECT  DISTINCT concierge_quote_id, tracking_id, service_type, service_id,price,created_at, sea_title, courier_title, air_title,orderID,receipt_file FROM ('.$query1 . ' UNION ' . $query2.') as t';

        // $final_query = $this->db->query($final);
        $result = $query->result();
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
