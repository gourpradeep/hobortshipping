<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Common_Front_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('home_model');
        $this->load->model('option_model');
    }

    public function index() {
        $data['page_title'] = 'Home';

        $data['air_freight_item'] = $this->home_model->getAllItem(AIR_FREIGHT_ITEMS,array('status'=>1));
        $data['sea_freight_item'] = $this->home_model->getAllItem(SEA_FREIGHT_SERVICES,array('status'=>1));
        // $data['courier_freight_item'] = $this->home_model->getAllItem(COURIER_SERVICES,array('status'=>1));
        $data['calculation'] = $this->common_model->is_data_exists(USERS,array('userID'=>$_SESSION['app_user_sess']['userID']));
        $this->load->front_render('home', $data);
        //pr($data);
    }

    public function calculation() {
        $session = 0;
        
        if(!empty($_SESSION['app_user_sess'])){
            $session = 1;
        }

        $length = !empty($_POST['length'])?$_POST['length']:0;
        $weight = !empty($_POST['weight'])?$_POST['weight']:0;
        $height = !empty($_POST['height'])?$_POST['height']:0;
        $width = !empty($_POST['width'])?$_POST['width']:0;

        $quantity = $_POST['quantity'];
       
        $area_totald = $length*$height*$width;
        // pr($area_totald);
        $area_total = $area_totald/366;
        $area_total = feet_to_cm($area_total);
        // pr($area_total);
        // pr($area_total);
        // echo $area_total;die();
        $final_weight = $area_total;

        if($weight > $area_total){
            $final_weight = $weight;
        }

        $price = $this->home_model->getPrice($final_weight);
        // pr($price);
        if(empty($price)){
            echo json_encode(array('status'=>0,'amount'=>$price)); die();
        }

        $airFreightServiceID = $price->airFreightServiceID;
        $price = $price->price*(float)$quantity;

        //check promo Applicable
        $promo_applicable_check = $this->common_model->is_data_exists(USERS,array('userID'=>$_SESSION['app_user_sess']['userID']));
        if(!empty($_SESSION['app_user_sess'])){

            if($promo_applicable_check->promo_applicable == 1){
                $price = calculate_promo_discount($price);
            }
        }
        
        echo json_encode(array('status'=>1,'amount'=>$price,'session'=>$session,'area_total'=>$area_total,'service_id'=>$airFreightServiceID));
    }//end of function

    function add_air_freight(){
        // pr($_POST);
        $item = array();
        $concierge_exist_data = array();

        if($_POST['delivery_type']==1){
            // $this->form_validation->set_rules('title', 'Title', 'required');
            $this->form_validation->set_rules('length', 'Length', 'required');
            $this->form_validation->set_rules('width', 'Width', 'required');
            $this->form_validation->set_rules('weight', 'Weight', 'required');
            $this->form_validation->set_rules('height', 'Height', 'required');
            // $this->form_validation->set_rules('item', 'Item', 'required');
            $this->form_validation->set_rules('item_value', 'Item value', 'required');
            $this->form_validation->set_rules('totalValue', 'Total price', 'required',array('required'=>'Sorry, we are not able to find quote with given details.'));
            // $this->form_validation->set_message('totalValue', 'Sorry, we are not able to find quote with given details.');
            $this->form_validation->set_rules('quantity', 'Quantity', 'required');
            if ($this->form_validation->run($this) == FALSE) {
                echo json_encode(array('status'=>0,'message'=>validation_errors()));
                die();
            }else{
                $item['length'] = $this->input->post('length');
                $item['width'] = $this->input->post('width');
                $item['weight'] = $this->input->post('weight');
                $item['volumetric_weight'] = $this->input->post('area_total');
                // $item['item_id'] = $this->input->post('item');
                $item['item_value'] = $this->input->post('item_value');
                $item['height'] = $this->input->post('height');

                $data['service_type'] = $this->input->post('delivery_type');
                // $data['service_id'] = $this->input->post('service_id');
                $data['quantity'] = $this->input->post('quantity');
                // $data['price'] = $this->input->post('totalValue');

                // $area_totald = $item['length']*$item['height']*$item['width'];
                // $area_total = $area_totald/366;
                // $area_total = feet_to_cm($area_total);
                // $final_weight = $area_total;

                // if($item['weight'] > $area_total){
                //     $final_weight = $item['weight'];
                // }

                // $priceData = $this->home_model->getPrice($final_weight);

                // pr($price);
                // if(empty($priceData)){
                //     echo json_encode(array('status'=>0,'amount'=>$price,'Sorry, we are not able to find quote with given details.')); die();
                // }
                // pr($priceData->price);
                // $airFreightServiceID = $priceData->airFreightServiceID;
                // $price = $priceData->price*(float)$data['quantity'];

                $price = $this->input->post('totalValue');
                
                //check promo Applicable
                $promo_applicable_check = $this->common_model->is_data_exists(USERS,array('userID'=>$_SESSION['app_user_sess']['userID']));

                if(!empty($_SESSION['app_user_sess'])){

                    if($promo_applicable_check->promo_applicable == 1){
                        $price = calculate_promo_discount($price);
                        $promo_update['promo_applicable'] = 0;
                        $this->common_model->updateFields(USERS,$promo_update,array('userID'=>$_SESSION['app_user_sess']['userID']));
                    }
                }

                $data['price'] = $price;

                // $urlParam = 'length='.urlencode($item['length']).'&width='.urlencode($item['width']).'&weight='.urlencode($item['weight']).'&area_total='.urlencode($item['volumetric_weight']).'&item='.urlencode($item['item_id']).'&item_value='.urlencode($item['item_value']).'&height='.urlencode($item['height']).'&service_type='.urlencode($data['service_type']).'&service_id='.urlencode($data['service_id']).'&quantity='.urlencode($data['quantity']).'&price='.urlencode($data['price']);
                $urlParam = 'length='.urlencode($item['length']).'&width='.urlencode($item['width']).'&weight='.urlencode($item['weight']).'&area_total='.urlencode($item['volumetric_weight']).'&item_value='.urlencode($item['item_value']).'&height='.urlencode($item['height']).'&service_type='.urlencode($data['service_type']).'&quantity='.urlencode($data['quantity']).'&price='.urlencode($data['price']);
                // pr($price);
            }

        }else if($_POST['delivery_type']==2){

            
            $this->form_validation->set_rules('item_sea', 'Item', 'required');
            $this->form_validation->set_rules('quantity_sea', 'Quantity', 'required');
            if ($this->form_validation->run($this) == FALSE) {
                echo json_encode(array('status'=>0,'message'=>validation_errors()));
                die();
            }else{
                $data['service_type'] = $this->input->post('delivery_type');
                $data['service_id'] = $this->input->post('id');
                $data['quantity'] = $this->input->post('quantity_sea');
                // $data['price'] = $this->input->post('totalValue_sea');

                $priceData = $this->common_model->is_data_exists(SEA_FREIGHT_SERVICES,array('seaFreightServiceID'=>$this->input->post('id')));
                $price = '0.00';
                if(!empty($priceData)){
                    $price = $priceData->price;
                }
                $tota_price = $price * $data['quantity'];

                //check promo Applicable
                $promo_applicable_check = $this->common_model->is_data_exists(USERS,array('userID'=>$_SESSION['app_user_sess']['userID']));

                if(!empty($_SESSION['app_user_sess'])){

                    if($promo_applicable_check->promo_applicable == 1){
                        $tota_price = calculate_promo_discount($tota_price);
                        $promo_update['promo_applicable'] = 0;
                        $this->common_model->updateFields(USERS,$promo_update,array('userID'=>$_SESSION['app_user_sess']['userID']));
                    }
                }
               
                $data['price'] = $tota_price;

                $urlParam = 'service_type='.urlencode($_POST['delivery_type']).'&service_id='.urlencode($data['service_id']).'&quantity='.urlencode($data['quantity']).'&price='.urlencode($data['price']);
                // pr($data['price'])
            }
        }else if($_POST['delivery_type']==3){

            $this->form_validation->set_rules('item_courier', 'Item', 'required');
            $this->form_validation->set_rules('quantity_courier', 'Quantity', 'required');
            if ($this->form_validation->run($this) == FALSE) {
                echo json_encode(array('status'=>0,'message'=>validation_errors()));
                die();
            }else{
                $data['service_type'] = $this->input->post('delivery_type');
                $data['service_id'] = $this->input->post('id1');
                $data['quantity'] = $this->input->post('quantity_courier');
                // $data['price'] = $this->input->post('totalValue_courier');
                $priceData = $this->common_model->is_data_exists(COURIER_SERVICES,array('courierServiceID'=>$this->input->post('id1')));
                $price = '0.00';
                if(!empty($priceData)){
                    $price = $priceData->price;
                }
                $tota_price = $price * $data['quantity'];

                //check promo Applicable
                $promo_applicable_check = $this->common_model->is_data_exists(USERS,array('userID'=>$_SESSION['app_user_sess']['userID']));

                if(!empty($_SESSION['app_user_sess'])){

                    if($promo_applicable_check->promo_applicable == 1){
                        $tota_price = calculate_promo_discount($tota_price);
                        $promo_update['promo_applicable'] = 0;
                        $this->common_model->updateFields(USERS,$promo_update,array('userID'=>$_SESSION['app_user_sess']['userID']));
                    }
                }
                $data['price'] = $tota_price;
                // pr($data['price']);
                $urlParam = 'service_type='.urlencode($_POST['delivery_type']).'&service_id='.urlencode($data['service_id']).'&quantity='.urlencode($data['quantity']).'&price='.urlencode($data['price']);
            }
             //pr($urlParam); 
        }

        // if($_POST['delivery_type']==4){

            
        //     $this->form_validation->set_rules('concierge_detail', 'Concierge Detail', 'required');
        //     if ($this->form_validation->run($this) == FALSE) {
        //         echo json_encode(array('status'=>0,'message'=>validation_errors()));
        //         die();
        //     }else{
        //         // $data['service_type'] = $this->input->post('delivery_type');
        //         $data['description'] = $this->input->post('concierge_detail');
                
        //         $urlParam = 'service_type='.urlencode($_POST['delivery_type']).'&description='.urlencode($data['description']);

        //     }
        // }

        // $jsonData = json_encode($_POST);
        // pr($this->session->userdata()['app_user_sess']);
        if(!empty($this->session->userdata()['app_user_sess'])){
            $data['user_id'] = $this->session->userdata()['app_user_sess']['userID'];
            // $data['shipper_name'] = $this->session->userdata()['app_user_sess']['name'];
            $data['updated_at'] = datetime();
            $data['created_at'] = datetime();

            // $concierge_exist_data = $this->common_model->is_data_exists(CONCIERGE_QUOTES,array('user_id'=>$data['user_id'],'status<='=> 2));

            $is_already = $this->common_model->is_data_exists(ORDERS,array('user_id'=>$data['user_id'],'status!='=>9));

            if(!empty($is_already)){
                echo json_encode(array('status'=>0,'message'=>'Unable to create quote. You already have a pending order'));die();
            }

            if($data){
                // if($_POST['delivery_type']==4){
                //     $orderInsert = $this->common_model->insertData(CONCIERGE_QUOTES,$data);
                // }else{
                //     $orderInsert = $this->common_model->insertData(ORDERS,$data);
                // }

                $orderInsert = $this->common_model->insertData(ORDERS,$data);

                if(!empty($item)){
                    $item['order_id'] = $orderInsert;
                    $itemInsert = $this->common_model->insertData(AIR_FREIGHT_ORDER_INFO,$item);
                }
            }

            // if($_POST['delivery_type']==4){

            //     $url = base_url().'order/concierge_order';  
            // }else{
            //     $url = base_url().'order/current_order';
            // }

            $url = base_url().'order/current_order';

            echo json_encode(array('status'=>1,'url'=>$url,'message'=>'Qoute added successfully'));
        }else{
            $url = base_url().'auth/login?qoute=true&'.$urlParam;
            echo json_encode(array('status'=>1,'url'=>$url,'flag'=>1));
        }
    }

    public function services(){
        if ($this->uri->segment(1) === 'home') {
            redirect('/services','location',301);
        }
        $data['page_title'] =  'Services'  ;
        $this->load->front_render('services',$data);
    }

    public function about(){
        if ($this->uri->segment(1) === 'home') {
            redirect('/about','location',301);
        }
        $data['page_title'] =  'About Us' ;
        $this->load->front_render('about_us',$data);
    }

    public function contactUs(){

        if ($this->uri->segment(1) === 'home') {
            redirect('/contact-us','location',301);
        }
        $data['page_title'] =  'Contact-us' ;
        $this->load->front_render('contact_us',$data);
    }

    public function create_contact(){

        $this->load->library('smtp_email');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('subject', 'Subject', 'trim|required');
        $this->form_validation->set_rules('message', 'Message', 'trim|required');

        if ($this->form_validation->run($this) == FALSE) {
            $messages = (validation_errors()) ? validation_errors() : '';
            $response = array('status' => 0, 'msg' => $messages);
            echo json_encode($response);
        }else{
            $datainsert['full_name'] = sanitize_input_text($this->input->post('name'));
            $datainsert['email'] = strtolower($this->input->post('email'));
            $datainsert['subject'] = $this->input->post('subject');
            $datainsert['message'] = $this->input->post('message');
            $datainsert['created_at'] = datetime();

            $insert_id = $this->common_model->insertData(INQUIRIES, $datainsert);
            if (!empty($insert_id)) {
                
                $notification_email  =  $this->contact_mail($datainsert['email'],$datainsert['message'],$datainsert['full_name'], $datainsert['subject']); 
                $response = array('status' => 1, 'msg' => 'Your request is submitted successfully. We will get back to you soon.', 'url' => base_url('order/current_order'));

            }
            else{
            $response = array('status' => 0, 'msg' => 'Something went Wrong', 'url' => base_url());
            }
        }
        echo json_encode($response);
    }

    public function terms() {
        if ($this->uri->segment(1) === 'home') {
            redirect('/terms','location',301);
        }
        $data['page_title'] = 'Terms & Conditions';
        $data['terms'] = $this->option_model->get_option('terms_content');
    	$this->load->front_render('terms', $data);
    }

    public function privacy_policy(){
        if ($this->uri->segment(1) === 'home') {
            redirect('/privacy-policy','location',301);
        }
        $data['page_title'] =  'Privacy Policy'  ;
        $data['privacy'] = $this->option_model->get_option('privacy_content');
        $this->load->front_render('privacy',$data);
    }

    public function track() {

        if(empty($this->input->get('tracking_id'))){
            redirect(base_url());
        }
                
        $id =$this->input->get('tracking_id');
        $where = array('tracking_id' =>$id);
        $data['page_title'] = "Tracking Detail";
        $data['orderexist'] = $this->common_model->is_data_exists(ORDERS, $where);
        $where_order = array('order_id' => $data['orderexist']->orderID);
        $data['ordersipments'] = $this->common_model->getTotalRecords(OS, $where_order);

        if (!empty($data['orderexist'])) {
            $data['userdetail'] = $this->common_model->is_data_exists(USERS,array('userID'=>$data['orderexist']->user_id));
            $data['title'] = "Order Details";

            if ($data['orderexist']->service_type==1) {
                $where_air = array('order_id' =>$data['orderexist']->orderID );
                $data['air'] = $this->common_model->is_data_exists(AIR_FREIGHT_ORDER_INFO, $where_air);

                $where = array('airFreightItemID' =>$data['air']->item_id);
                $data['air_title'] = $this->common_model->is_data_exists(AIR_FREIGHT_ITEMS, $where);

                // $data['air_price'] = $this->common_model->is_data_exists(AIR_FREIGHT_SERVICES,array('airFreightServiceID'=>$data['orderexist']->service_id));
            }
            if ($data['orderexist']->service_type==2) {
                $where_sea = array('seaFreightServiceID' =>$data['orderexist']->service_id );
                $data['sea'] = $this->common_model->is_data_exists(SEA_FREIGHT_SERVICES, $where_sea);
            }

            $this->load->front_render('home/trackings.php', $data);
          
        } else {
            $this->load->front_render('home/trackings.php', $data);
        }
    }

    // public function track(){
    //     //pr($_GET);
    //     if(empty($this->input->get('tracking_id'))){
    //         redirect(base_url());
    //     }
        
    //     $id =$this->input->get('tracking_id');
    //     $where = array('tracking_id' =>$id);
    //     $data['page_title'] = "Tracking Detail";
    //     $data['orderexist'] = $this->common_model->is_data_exists(ORDERS, $where);
    //     if (!empty($data['orderexist'])) {

    //         $data['title'] = "Tracking Detail";

    //         if ($data['orderexist']->service_type==1) {
                
    //             $where_air = array('order_id' =>$data['orderexist']->orderID );
    //             $data['air'] = $this->common_model->is_data_exists(AIR_FREIGHT_ORDER_INFO, $where_air);
    //             $where = array('airFreightItemID' =>$data['air']->item_id);
    //             $data['air_title'] = $this->common_model->is_data_exists(AIR_FREIGHT_ITEMS, $where);

    //             $data['air_price'] = $this->common_model->is_data_exists(AIR_FREIGHT_SERVICES,array('airFreightServiceID'=>$data['orderexist']->service_id));
    //         }
    //         if ($data['orderexist']->service_type==2) {
    //             $where_sea = array('seaFreightServiceID' =>$data['orderexist']->service_id );
    //             $data['sea'] = $this->common_model->is_data_exists(SEA_FREIGHT_SERVICES, $where_sea);
    //         }

    //         if($data['orderexist']->service_type==3){

    //             $where_courier = array('courierServiceID' =>$data['orderexist']->service_id );
    //             $data['courier']=$this->common_model->is_data_exists(COURIER_SERVICES, $where_courier);
    //         }
    //         if($data['orderexist']->service_type==4){

    //             $where_concierge = array('conciergeQuoteID' =>$data['orderexist']->concierge_quote_id);

    //             $data['concierge']=$this->common_model->is_data_exists(CONCIERGE_QUOTES, $where_concierge);
    //         }
    //         //pr($data);
    //         $this->load->front_render('home/tracking.php', $data);

          
    //     } else {
    //         $this->load->front_render('home/tracking.php', $data);
    //     }
    // }//end of function

    public function newslatter(){

        $this->load->model('home_model');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            if($this->form_validation->run($this) == FALSE){
               $msg = (validation_errors()) ? validation_errors() : '';
               $response = array('status' => 0, 'message' => $msg);
            }
            else {
                $email =strtolower($this->input->post('email'));
              
                $dataInsert['email']    = $email;
                $dataInsert['created_at']= datetime();
                $result = $this->home_model->insertData(NEWSLETTERS,$dataInsert);
                $response = array('status'=>1,'message'=>'Subscribed successfully.','url'=>base_url());
            }
            echo json_encode($response);
    }

    private function contact_mail($email,$msg,$name,$subject) {
        $subject = 'HobortShipping'.'-'. $subject;
        $data['name'] = $name;
        $data['email'] = $email;
        $data['message'] = $msg;
        $message = $this->load->view('emails/contact',$data,TRUE);
        $response = $this->smtp_email->send_mail('info@hobortshipping.com',$subject,$message);
        return $response;
    }

    // function dynamic_link(){
    //     $link = "https://dev.hobortshipping.com/home/track?tracking_id=as23456789";
    //     $this->load->library('Dynamic_link');
    //     $this->dynamic_link->create_dynamic_link($link);
    // }//end of function
}