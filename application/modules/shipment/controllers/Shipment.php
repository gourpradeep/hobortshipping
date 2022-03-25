<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Shipment extends Common_Front_Controller {

    function __construct() {
        parent::__construct();
    }

    /**
     * @method index
     * @description listing display
     * @return array
     */
    public function index() {
        $this->check_user_session();
        $data['page_title'] = "My Shipment";
        $this->load->front_render('shipment/shipment', $data);
    }
    public function details() {
        $this->check_user_session();
        $data['page_title'] = "My Shipment Detail";
        $this->load->front_render('shipment/shipment_details', $data);
    }

    // Add Shipper 
    function add_shipper_info(){

        $this->form_validation->set_rules('shipper_name', 'Shipper name', 'required');
        // $this->form_validation->set_rules('tracking_id', 'Tracking id', 'required');
        $this->form_validation->set_rules('origin', 'Origin', 'required');


        $concierge_exist_data = $this->common_model->is_data_exists(CONCIERGE_QUOTES,array('user_id'=>$_SESSION['app_user_sess']['userID'],'status<='=> 2));

        $is_already = $this->common_model->is_data_exists(ORDERS,array('user_id'=> $_SESSION['app_user_sess']['userID'],'status!='=>7));

            // if(!empty($is_already)  || !empty($concierge_exist_data)){
            //     echo json_encode(array('status'=>0,'message'=>'Unable to create quote. You already have a pending order'));die();
            // }

        if ($this->form_validation->run($this) == FALSE) {
            echo json_encode(array('status'=>0,'message'=>validation_errors()));
            die();
        }
        else{
        
            $this->load->library('dynamic_link');
            $track_id = getenv('TRACKING_PREFIX').get_random_id();

            $ids = $this->input->post('tracking_id');
            $result = array_filter($ids);                 

            $coma_seprated = implode(","." "."#", $result);


            if (empty($coma_seprated)) {
                $tracking_id = $this->input->post('req_tracking_id'); 
            }
            else{
                $tracking_id = $this->input->post('req_tracking_id').', #'.$coma_seprated; 
            }
            $dynamic_link = base_url().'home/track?tracking_id='.$track_id.'';
            $link = $this->dynamic_link->create_dynamic_link($dynamic_link);
            $make_json['shipped_by_customer_at'] = datetime();
            $date = json_encode($make_json);
            $add_shipper_info = array(                
                'user_id'                => $_SESSION['app_user_sess']['userID'],
                'shipper_name'           => $this->input->post('shipper_name'),
                'shipment_receiver_name' => $this->input->post('receiver_name'),
                'shipment_origin'        => $this->input->post('origin'),
                'shipper_description'    => $this->input->post('description'),
                'shipment_value'         => $this->input->post('total_value'),
                'service_type'           => '5',
                'dynamic_link'           =>  $link->shortLink,
                'status_updated_at'      =>  json_encode($make_json),
                'shipment_tracking_ids'  =>  $tracking_id,
                'tracking_id'            =>  $track_id,
                'updated_at'             =>  datetime(),
                'created_at'             =>  datetime(),
            );
//pr($add_shipper_info);
        $result = $this->common_model->insertData(ORDERS,$add_shipper_info);

            if (!empty($result)) {
                $data = array('status' => 1, 'message' => 'Shipment Added Sucessfully', 'url' => base_url('order/current_order'));
                        echo json_encode($data);

            }
        }
    }//end of function
}
