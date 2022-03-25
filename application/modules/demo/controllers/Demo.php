<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Demo extends Common_Back_Controller {

  function __construct() {
    parent::__construct();
    
  }

  public function index(){

   $data['profile']= $this->common_model->getAll(IMAGE);
   //pr($data);
   $this->load->view('image',$data);

  }
  public function getInfo(){
       $this->load->library('Tracking_more');
       $tracking_number = '300403513351';
       $carrier_code = 'fedex';
       $res = $this->tracking_more->getTrackingInfo($tracking_number,$carrier_code);

    
	}
}

