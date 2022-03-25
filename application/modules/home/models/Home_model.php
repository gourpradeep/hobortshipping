<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    //function for get freight item
    function getAllItem($table,$where){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($where);
        $q = $this->db->get();
        return $q->result(); //return multiple records
    }//end of function

    //get range data 
    function getPrice($value){
        $this->db->select("*");

        $this->db->group_start();
        $this->db->where('weight_from <=', (int)$value);
        $this->db->where('weight_to >=', (int)$value);
        $this->db->group_end();

        $this->db->or_group_start();
        $this->db->where('weight_from <=', (int)$value);
        $this->db->where('weight_to',NULL);
        $this->db->group_end();

        $this->db->where('status',1);
        $q = $this->db->get(AIR_FREIGHT_SERVICES);
        return $q->row(); //return multiple records
    }//end of function


    function insertData($table, $dataInsert) {
        $this->db->select('email');
        $this->db->from($table);
        $this->db->where('email',$dataInsert['email']);
        $query = $this->db->get();
        $res = $query->result();
        if($res){
            return false;
        }else{
        $this->db->insert($table, $dataInsert);
            return true;
        }
    }
    

}//end of class