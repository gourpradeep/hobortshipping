<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Service_model  extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function check_air_freight($dataInsert, $exclude_ids=array()) {

        $start_point = (float) $dataInsert['weight_from'];
        $end_point = ($dataInsert['weight_to'])? (float) $dataInsert['weight_to'] : '';

        $this->db->select('*');
        $this->db->from(AIR_FREIGHT_SERVICES);

        $this->db->group_start();
            $this->db->group_start();
                $this->db->where(array('weight_to !='=> NULL));
                $this->db->group_start();
                    $this->db->group_start();
                        $this->db->where("$start_point BETWEEN weight_from AND weight_to", null, false);
                    $this->db->group_end();
                    if(!empty($end_point)) {
                        $this->db->or_group_start();
                            $this->db->where("$end_point BETWEEN weight_from AND weight_to", null, false);
                        $this->db->group_end();
                    }
                    $this->db->or_group_start();
                        $this->db->or_where(
                            array('weight_from' => $start_point, 'weight_to' => $end_point)
                        );
                        $this->db->or_where(
                            array('weight_to' => $start_point, 'weight_from' => $end_point)
                        );
                    $this->db->group_end();
                $this->db->group_end();
            $this->db->group_end();

            $this->db->or_group_start();
                $this->db->where(array('weight_to'=> NULL));
                $this->db->group_start();
                    $this->db->where(array('weight_from <=' => $start_point));
                    $this->db->or_where(array('weight_from <=' => $end_point));
                $this->db->group_end();
            $this->db->group_end();
        $this->db->group_end();

        if(!empty($exclude_ids)) {
            $this->db->where_not_in('airFreightServiceID', $exclude_ids);
        }

        $this->db->where(array('status' => 1)); //active record only

        $query=$this->db->get(); //lq();
        $res = $query->row();

        if(!empty($res)) {
            return false;
        }

        return true;
    }

    function add_sea_freight($table,$dataInsert){
        $where = array('title'=>$dataInsert['title'],'type'=>$dataInsert['type'],'status'=>1);
        $this->db->select('*'); 
        $this->db->from(SEA_FREIGHT_SERVICES);
        $this->db->where($where);
        $query=$this->db->get();//lq();
        $res = $query->row();
        if($res){
            return false;
        }
        else{
        $this->db->insert($table, $dataInsert);
            return true;
        }
    }  

    function courier_service($table,$dataInsert){
        $where =array('title'=>$dataInsert['title'],'status'=>1);
        $this->db->select('*'); 
        $this->db->from(COURIER_SERVICES);
        $this->db->where($where);
        $query=$this->db->get();//lq();
        $res = $query->row();
        if($res){
            return false;
        }
        else{
        $this->db->insert($table, $dataInsert);
            return true;
        }
    }  
}