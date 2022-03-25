<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Order_model  extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function is_quote_exists($id){

        $this->db->select('cq.*,o.shipper_name,o.shipper_tracking_id,o.shipper_company_name,u.full_name,u.avatar,u.userID');
        $this->db->from(CONCIERGE_QUOTES .' as cq');
        $this->db->join(USERS.' as u','u.userID = cq.user_id','left');
        $this->db->join(ORDERS.' as o','o.user_id = cq.user_id','left');
        $this->db->where($id);
        $qry = $this->db->get();
        $result = $qry->row();
        return $result; 
    }
    public function is_concierge_exists($where){
        $this->db->select('*');
        $this->db->from(CONCIERGE_QUOTES);
        $this->db->where($where);
        $this->db->order_by("conciergeQuoteID", "desc");
        $query = $this->db->get();
        $rowcount = $query->num_rows();
        if($rowcount==0){
            return FALSE; //record not found
        }
        else {
            return $query->row();
        }
    }
    public function last_record($where){ 
        $this->db->select('*');
        $this->db->from(ORDERS);
        $this->db->where(array('status >='=>'2'));
        $this->db->order_by("orderID", "desc");
        $this->db->limit(1);
        $qry = $this->db->get();
        $result = $qry->row();
        //lq();
        return $result;
    }
}


