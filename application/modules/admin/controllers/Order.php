<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Order extends Common_Back_Controller {
    function __construct() {
        parent::__construct();
        $this->load->library('smtp_email');
        $this->load->library('twilio');
        $this->load->library('dynamic_link');
    }

    //new order
    public function new_orders() {
        $this->check_admin_user_session();
        $data['page_title'] = "New Orders";
        $this->load->admin_render('order/new_order', $data);
    }

    //New orders List
    public function new_order_list() {
        $this->load->model('new_order_list_model');
        $list = $this->new_order_list_model->get_list();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $user) {
            //pr($user);
            $action = '';
            $no++;
            $row = array();
            $row[] = $no;

            if($user->service_type==1){
               $service_type = 'Air Freight';
            }elseif ($user->service_type==2) {
                $service_type = 'Sea Freight';
            }elseif ($user->service_type==3) {
                $service_type = 'Courier & Express Services';
            }elseif ($user->service_type==4) {
                $service_type = 'Concierge Shipping ';
            }else{
                $service_type = 'My Shipment';
            }

            $encoded = encoding($user->orderID);
            $old_date = date($user->created_at);
            $date = date('d F y', strtotime($old_date));
            $time = date('H:i A', strtotime($old_date));
            $row[] = display_placeholder_text($service_type);
            $row[] = display_placeholder_text('$'.$user->price);
            //$row[] = display_placeholder_text(nl2br($date).",". " ".($time));
            $row[]= nl2br("$date\n $time");
 
            $action = '<div class="btn-group actionBtn">
                    <a class="btn btn-secondary dropdown-toggle drop-btn" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                 Select</a>
            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDivider">'; 

            $action.= '<a href="' . admin_url('order/new_order_details?id=') . $encoded . '"  class="dropdown-item">View</a>';

            $clk_edit =  "viewFn('/order','Approve','$user->orderID');" ;


            $action.= '<a class="dropdown-item" href="javascript:void(0)" onclick="'.$clk_edit.'" type="button" class="btn btn-primary">Approve</a>';
            
            '</div>
            </ul>
            </div>';
            $row[] = $action;
            $data[] = $row;
        }
        $output = array("draw" => $_POST['draw'], "recordsTotal" => $this->new_order_list_model->count_all(), "recordsFiltered" => $this->new_order_list_model->count_filtered(), "data" => $data,);
        //output to json format
        echo json_encode($output);
    }

    //approve 
    public function Approve(){
        $this->check_admin_user_session();
        $id = $_POST['id'];
        $where= array('orderID'=>$id);
        $data['order']=$this->common_model->is_data_exists(ORDERS, $where);
        $this->load->view('order/approve_from',$data);
    }

    //approve  form
    public function approved_form() {
        //validate ajax request
        $this->check_admin_ajax_auth();
        $this->load->model('order_model');
        $id = $_POST['id'];
        $this->form_validation->set_rules('item_drop_location', 'Item Drop Location', 'required');
        if ($this->form_validation->run($this) == FALSE) {
            $messages = (validation_errors()) ? validation_errors() : '';
            $data = array('status' => 0, 'msg' => $messages);
        } else {
            //$dynamic_link = "https://dev.hobortshipping.com/home/track?tracking_id=as23456789";
            //;
            //pr($link->shortLink);
            $is_order =  $this->common_model->is_data_exists(ORDERS, array('orderID'=>$id));            
            $track_id = getenv('TRACKING_PREFIX').get_random_id();
            $where_id = array('orderID'=>$id);
            $update['tracking_id'] = $track_id;

            $dynamic_link = base_url().'home/track?tracking_id='.$update['tracking_id'].'';
            $link = $this->dynamic_link->create_dynamic_link($dynamic_link);

            // if( $is_order->created_by == 1 ) {
            //     $update['status'] = 3;
            // }else {
            //     $update['status'] = 2;
            // }

            $update['status'] = 2;
            $update['drop_location'] = $this->input->post('item_drop_location');
            $update['dynamic_link'] = $link->shortLink;
            $make_json['approved_at'] = datetime();
            $update['status_updated_at'] = json_encode($make_json);
            $update['updated_at'] = datetime();

            $is_user =  $this->common_model->is_data_exists(USERS, array('userID'=>$is_order->user_id));
            $result =  $this->common_model->updateFields(ORDERS,$update,$where_id);

            if (!empty($result)) {

                $data = array('status' => 1, 'msg' => 'Approved successfully', 'url' => admin_url('order/new_orders'));
                $notification_email  =  $this->notification_email($is_user->full_name,$is_user->email,$update['tracking_id'],$update['status'],$is_order->service_type,$is_order->orderID);
                $status_type= get_status_type($update['status']);
                $text = get_order_tracking_email_subject($update['status'],$is_order->service_type);

                $dial_phone = $is_user->phone_dial_code.$is_user->phone_number;
                $text_message = $this->twilio->send_sms($dial_phone,$status_type.$text.'.'.' Track order:'.' '.$link->shortLink);

            } else {
                $data = array('status' => 0, 'msg' => 'Order not exist');
            }
        }
             echo json_encode($data);
    }

    public function new_order_details() {
        $this->load->model('order_model');
        $this->check_admin_user_session();
        $id = (decoding($_GET['id']));
        //pr($id);
        $where = array('orderID' => $id);
        $where_order = array('order_id' =>$id);
        $data['page_title'] = "New Orders Detail";
        $data['orderexist'] = $this->common_model->is_data_exists(ORDERS, $where);
        if (!empty($data['orderexist'])) {

            $data['title'] = "New Orders Detail";

            if ($data['orderexist']->service_type==1) {
                
         
                $where_air = array('order_id' =>$data['orderexist']->orderID );
                $data['air'] = $this->common_model->is_data_exists(AIR_FREIGHT_ORDER_INFO, $where_air);

                $where = array('airFreightItemID' =>$data['air']->item_id);
                $data['air_title'] = $this->common_model->is_data_exists(AIR_FREIGHT_ITEMS, $where);
            }
            if ($data['orderexist']->service_type==2) {
                $where_sea = array('seaFreightServiceID' =>$data['orderexist']->service_id );
                $data['sea'] = $this->common_model->is_data_exists(SEA_FREIGHT_SERVICES, $where_sea);
            }

            if($data['orderexist']->service_type==3){

                $where_courier = array('courierServiceID' =>$data['orderexist']->service_id );
                $data['courier']=$this->common_model->is_data_exists(COURIER_SERVICES, $where_courier);
            }
            if($data['orderexist']->service_type==4){
                    
                
                $where_concierge = array('conciergeQuoteID' =>$data['orderexist']->concierge_quote_id);

                $data['concierge']=$this->common_model->is_data_exists(CONCIERGE_QUOTES,$where_concierge);
            }
            $this->load->admin_render('order/new_order_details', $data);

          
        } else {
            $this->load->admin_render('order/new_order', $data);
        }
    }

    //Pending order
    public function pending_orders() {
        $this->check_admin_user_session();
        $data['page_title'] = "Pending Orders";
        $this->load->admin_render('order/pending_order', $data);
    }

    //list 
    public function pending_order_list() {
        $this->load->model('pending_order_list_model');
        $list = $this->pending_order_list_model->get_list();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $user) {
            //pr($_POST['status']);
            $action = '';
            $no++;
            $row = array();
            $row[] = $no;
            
            if($user->service_type==1){
               $service_type = 'Air Freight';
            }elseif ($user->service_type==2) {
                $service_type = 'Sea Freight';
            }else{
                $service_type = 'My Shipment';
            }

            // elseif ($user->service_type==3) {
            //     $service_type = 'Courier & Express Services';
            // }elseif ($user->service_type==4) {
            //     $service_type = 'Concierge Shipping ';
            // }

            // status 
            if ($user->status==2) {
                $status = '<p id="badge" class="badge bg-warning">Pending</p>';
            }
            if ($user->status==3) {
                $status = '<p id="badge" class="badge bg-primary">Package Received at our warehouse</p>';
            }
            if ($user->status==4) {
                $status = '<p id="badge" class="badge bg-info">Package preparing to ship</p>';
            }
            if ($user->status==5) {
                $status = '<p id="badge" class="badge bg-secondary">Shipment dropped off at Atlanta Airport</p> ';
            }
            if ($user->status==6) {
                $status = '<p id="badge" class="badge bg-danger">Shipment in Transit</p> ';
            }
            if ($user->status==7) {
                $status = '<p id="badge" class="badge bg-success">Shipment Arrived in Accra</p> ';
            }
            if ($user->status==8) {
                $status = '<p id="badge" class="badge bg-danger">Customs Clearance Started</p> ';
            }
            if ($user->status==9) {
                $status = '<p id="badge" class="badge bg-success">Shipment Cleared</p> ';
            }

            $encoded = encoding($user->orderID);

            $changeStatus = "viewFn('/order','open_status_modal',".$user->orderID.")";
            $old_date = date($user->created_at);
            $date = date('d F y', strtotime($old_date));
            $time = date('H:i A', strtotime($old_date));
            $row[] = '<a href="' . admin_url('order/pending_order_details?id=') . $encoded . '"  class="on-default edit-row table_action" title="Order Detail">' . display_placeholder_text('#'.$user->tracking_id) . '</a>';

            $row[] = display_placeholder_text($service_type);
            $row[]= nl2br("$date\n $time");
            $row[] = display_placeholder_text($status);

            $action = '<div class="btn-group actionBtn">
                    <a class="btn btn-secondary dropdown-toggle drop-btn" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                 Select</a>
            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDivider">'; 

            $action.= '<a href="' . admin_url('order/pending_order_details?id=') . $encoded . '"  class="dropdown-item">View</a>';
            $action.= '<a class="dropdown-item" href="javascript:void(0)" onclick="'.$changeStatus.'" type="button" class="btn btn-primary">Change Status</a>';
            
            '</div>
            </ul>
            </div>';
            $row[] = $action;
            $data[] = $row;
        }
        $output = array("draw" => $_POST['draw'], "recordsTotal" => $this->pending_order_list_model->count_all(), "recordsFiltered" => $this->pending_order_list_model->count_filtered(), "data" => $data,);
        //output to json format
        echo json_encode($output);
    }

    //function for open modal for status
    function open_status_modal(){
        $id = $_POST['id'];
        $data['orderData'] = $this->common_model->is_data_exists(ORDERS,array('orderID'=>$id));
        $this->load->view('order/pending_order_status',$data);
    }//end of cuntion

    //status change of order
    function status_change(){
        $this->check_admin_ajax_auth();
        $this->form_validation->set_rules('status', 'Status', 'required');
        $this->form_validation->set_rules('order_id', 'order Id', 'required');
        if ($this->form_validation->run($this) == FALSE) {

            $messages = (validation_errors()) ? validation_errors() : '';
            $data = array('status' => 0, 'message' => $messages);
            echo json_encode($data);die();
        }
        $order_id = $this->input->post('order_id');
        $status = $this->input->post('status');
        // pr($status);
        $is_order = $this->common_model->is_data_exists(ORDERS,array('orderID'=>$order_id));

        $is_user = $this->common_model->is_data_exists(USERS,array('userID'=>$is_order->user_id));
        //lq();
        
        if(empty($is_order)){
            $data = array('status' => 0, 'message' => 'Invalid order id');
            echo json_encode($data);die();
        }

        if($is_order->status+1 != $status){
            $data = array('status' => 0, 'message' => 'Invalid status, Please make sure status is in sequence');
            echo json_encode($data);die();
        }

        $status_json = $is_order->status_updated_at;

        // if($status==3){
        //     $text = 'shipped_by_customer_at';
        // }elseif ($status==4) {
        //     $text = 'received_from_customer_at';
        // }elseif ($status==5) {
        //     $text = 'packed_at';
        // }elseif ($status==6) {
        //     $text = 'on_the_way_at';
        // }else{
        //     $text = 'delivered_at';
        // }

        if($status==3){
            $text = 'package_received_at_our_warehouse';
        }elseif ($status==4) {
            $text = 'package_preparing_to_ship';
        }elseif ($status==5) {
            $text = 'shipment_dropped_off_at_atlanta_airport';
        }elseif ($status==6) {
            $text = 'shipment_in_transit';
        }elseif ($status==7) {
            $text = 'ahipment_arrived_in_accra';
        }elseif ($status==8) {
            $text = 'customs_clearance_started';
        }else{
            $text = 'shipment_cleared';
        }

        if(empty($status_json)){
            $make_json[$text] = datetime();
            $updateData['status_updated_at'] = json_encode($make_json);

        }else{
            $status_json_text = json_decode($is_order->status_updated_at);
            $make_json[$text] = datetime();
            // array_push($status_json_text,$make_json);
            $status_json_text->$text = datetime();
            $updateData['status_updated_at'] = json_encode($status_json_text);
        }

        $updateData['status'] = $status;
        $updateData['updated_at'] = datetime();

        $update = $this->common_model->updateFields(ORDERS,$updateData,array('orderID'=>$order_id));

        $updateOrderShipments = $this->common_model->updateFields(OS,$updateData,array('order_id'=>$order_id));

        if($update==TRUE){
            $data = array('status' => 1, 'message' => 'Status changed successfully');
            $notification_email  =  $this->notification_email($is_user->full_name,$is_user->email,$is_order->tracking_id,$status,$is_order->service_type,$is_order->orderID);

            $status_type = get_status_type($status);

            $text = get_order_tracking_email_subject($status,$is_order->service_type);

            $text_message = $this->twilio->send_sms('+91'.$is_user->phone_number,$status_type.$text.'.'.'Track order:'.' '.$is_order->dynamic_link);

            echo json_encode($data);die();
        }
    }//end of function

    //status change of order
    function change_shipment_status(){
    
        $this->form_validation->set_rules('status', 'Status', 'required');
        $this->form_validation->set_rules('shipment_id', 'Shipment Id', 'required');

        if ($this->form_validation->run($this) == FALSE) {
            $messages = (validation_errors()) ? validation_errors() : '';
            $data = array('status' => 0, 'message' => $messages);
            echo json_encode($data);die();
        }

        $shipment_id = $this->input->post('shipment_id');
        $status = $this->input->post('status');
        // pr($status);
        $is_order = $this->common_model->is_data_exists(OS,array('og_id'=>$shipment_id));
        
        if(empty($is_order)){
            $data = array('status' => 0, 'message' => 'Invalid shipment id');
            echo json_encode($data);die();
        }

        if($is_order->status+1 != $status){
            $data = array('status' => 0, 'message' => 'Invalid status, Please make sure status is in sequence');
            echo json_encode($data);die();
        }

        // $orderData = $this->common_model->is_data_exists(ORDERS,array('orderID'=>$is_order->order_id));

        $status_json = $is_order->status_updated_at;

        if($status==3){
            $text = 'Package Received at our warehouse';
        }elseif ($status==4) {
            $text = 'Package preparing to ship';
        }elseif ($status==5) {
            $text = 'Shipment dropped off at Atlanta Airport';
        }elseif ($status==6) {
            $text = 'Shipment in Transit';
        }elseif ($status==7) {
            $text = 'Shipment Arrived in Accra';
        }elseif ($status==8) {
            $text = 'Customs Clearance Started';
        }else{
            $text = 'Shipment Cleared';
        }

        if(empty($status_json)){
            $make_json[$text] = datetime();
            $updateData['status_updated_at'] = json_encode($make_json);

        }else{
            $status_json_text = json_decode($is_order->status_updated_at);
            $make_json[$text] = datetime();
            // array_push($status_json_text,$make_json);
            $status_json_text->$text = datetime();
            $updateData['status_updated_at'] = json_encode($status_json_text);
        }

        $updateData['status'] = $status;
        $updateData['updated_at'] = datetime();

        // if( $status == 3 && $orderData->status < 3 ) {
        //     $updateOrder = $this->common_model->updateFields(ORDERS,$updateData,array('orderID'=>$is_order->order_id));
        // }

        $update = $this->common_model->updateFields(OS,$updateData,array('og_id'=>$shipment_id));
        
        if($update==TRUE){
            $data = array('status' => 1, 'message' => 'Status changed successfully');
            // $notification_email  =  $this->notification_email($is_user->full_name,$is_user->email,$is_order->tracking_id,$status,$is_order->service_type,$is_order->orderID);

            // $status_type = get_status_type($status);

            // $text = get_order_tracking_email_subject($status,$is_order->service_type);


            // $text_message = $this->twilio->send_sms('+91'.$is_user->phone_number,$status_type.$text.'.'.'Track order:'.' '.$is_order->dynamic_link);

            echo json_encode($data);die();
        }
    }//end of function

    //Pending order Details
    public function pending_order_details() {

        $this->check_admin_user_session();
        //pr($_GET);
        $id = (decoding($_GET['id']));
        //pr($id);
        $where = array('orderID' => $id);
        $where_order = array('order_id' =>$id);
        $data['page_title'] = "Pending Orders Detail";
        $data['orderexist'] = $this->common_model->is_data_exists(ORDERS, $where);
        $data['ordersipments'] = $this->common_model->getTotalRecords(OS, $where_order);
        
    
        if (!empty($data['orderexist'])) {
            $data['userdetail'] = $this->common_model->is_data_exists(USERS,array('userID'=>$data['orderexist']->user_id));
            $data['title'] = "Pending Orders Detail";

            if ($data['orderexist']->service_type==1) {
                $where_air = array('order_id' =>$data['orderexist']->orderID );
                $data['air'] = $this->common_model->is_data_exists(AIR_FREIGHT_ORDER_INFO, $where_air);
            
                $where = array('airFreightItemID' =>$data['air']->item_id);
                $data['air_title'] = $this->common_model->is_data_exists(AIR_FREIGHT_ITEMS, $where);
            }

            if ($data['orderexist']->service_type==2) {
                $data['sea_freight_item'] = $this->common_model->getTotalRecords(SEA_FREIGHT_SERVICES,array('status'=>1));
                $where_sea = array('seaFreightServiceID' =>$data['orderexist']->service_id );
                $data['sea'] = $this->common_model->is_data_exists(SEA_FREIGHT_SERVICES, $where_sea);
            }

            // if($data['orderexist']->service_type==3){
            //     $where_courier = array('courierServiceID' =>$data['orderexist']->service_id );
            //     $data['courier']=$this->common_model->is_data_exists(COURIER_SERVICES, $where_courier);
            // }

            // if($data['orderexist']->service_type==4){
            //     $where_concierge = array('conciergeQuoteID' =>$data['orderexist']->concierge_quote_id);
            //     $data['concierge']=$this->common_model->is_data_exists(CONCIERGE_QUOTES, $where_concierge);
            // }

            $this->load->admin_render('order/pending_orders_detail.php', $data);
          
        }else {
            $this->load->admin_render('order/pending_order', $data);
        }
    }

    //completed order
    public function completed_orders() {
        $this->check_admin_user_session();
        $data['page_title'] = "Completed Orders";
        $this->load->admin_render('order/completed_order', $data);
    }

    //list
    public function completed_order_list() {
        $this->load->model('completed_order_list_model');
        $list = $this->completed_order_list_model->get_list();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $completed_order) {
            $action = '';
            $no++;
            $row = array();
            $row[] = $no;
            //pr($_POST['status']);

            if($completed_order->service_type==1){
               $service_type = 'Air Freight';
            }elseif ($completed_order->service_type==2) {
                $service_type = 'Sea Freight';
            }elseif ($completed_order->service_type==3) {
                $service_type = 'Courier & Express Services';
            }elseif ($completed_order->service_type==4) {
                $service_type = 'Concierge Shipping ';
            }else{
            $service_type = 'My Shipment';
            }
            $encoded = encoding($completed_order->orderID);
            $old_date = date($completed_order->created_at);
            $date = date('d F y', strtotime($old_date));
            $time = date('H:i A', strtotime($old_date));           
            $row[] = '<a href="' . admin_url('order/completed_order_details?id=') . $encoded . '"  class="on-default edit-row table_action" title="Order Detail">' . display_placeholder_text('#'.$completed_order->tracking_id) . '</a>';

            $row[] = display_placeholder_text($service_type);
            $row[] = display_placeholder_text('$'.$completed_order->price);
            $row[]= nl2br("$date\n $time");
            $action = '<div class="btn-group actionBtn">
                    <a class="btn btn-secondary dropdown-toggle drop-btn" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                 Select</a>
            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDivider">'; 

            $action.= '<a href="' . admin_url('order/completed_order_details?id=') . $encoded . '"  class="dropdown-item">View</a>';
            '</div>
            </ul>
            </div>';
            $row[] = $action;
            $data[] = $row;
        }
        $output = array("draw" => $_POST['draw'], "recordsTotal" => $this->completed_order_list_model->count_all(), "recordsFiltered" => $this->completed_order_list_model->count_filtered(), "data" => $data,);
        //output to json format
        echo json_encode($output);
    }

    public function completed_order_details() {
        $this->load->model('order_model');
        $this->check_admin_user_session();
        $id = (decoding($_GET['id']));
        //pr($id);
        $where = array('orderID' => $id);
        $where_order = array('order_id' =>$id);
        $data['page_title'] = "Completed Orders Detail";
        $data['orderexist'] = $this->common_model->is_data_exists(ORDERS, $where);
        $data['ordersipments'] = $this->common_model->getTotalRecords(OS, $where_order);
        if (!empty($data['orderexist'])) {
            $data['userdetail'] = $this->common_model->is_data_exists(USERS,array('userID'=>$data['orderexist']->user_id));
            $data['title'] = "Completed Orders Detail";

            if ($data['orderexist']->service_type==1) {
                
         
                $where_air = array('order_id' =>$data['orderexist']->orderID );
                $data['air'] = $this->common_model->is_data_exists(AIR_FREIGHT_ORDER_INFO, $where_air);

                $where = array('airFreightItemID' =>$data['air']->item_id);
                $data['air_title'] = $this->common_model->is_data_exists(AIR_FREIGHT_ITEMS, $where);
            }
            if ($data['orderexist']->service_type==2) {
                $where_sea = array('seaFreightServiceID' =>$data['orderexist']->service_id );
                $data['sea'] = $this->common_model->is_data_exists(SEA_FREIGHT_SERVICES, $where_sea);
            }

            // if($data['orderexist']->service_type==3){

            //     $where_courier = array('courierServiceID' =>$data['orderexist']->service_id );
            //     $data['courier']=$this->common_model->is_data_exists(COURIER_SERVICES, $where_courier);
            // }
            // if($data['orderexist']->service_type==4){
                    
                
            //     $where_concierge = array('conciergeQuoteID' =>$data['orderexist']->concierge_quote_id);

            //     $data['concierge']=$this->common_model->is_data_exists(CONCIERGE_QUOTES,$where_concierge);
            // }
            $this->load->admin_render('order/completed_orders_detail', $data);

          
        } else {
            $this->load->admin_render('order/completed_order', $data);
        }
    }

    // public function completed_order_details() {

    //     $this->check_admin_user_session();
    //     $id = (decoding($_GET['id']));
    //     $where = array('orderID' => $id);
    //     $where_order = array('order_id' =>$id);
    //     $data['page_title'] = "Completed Orders Detail";
    //     $data['orderexist'] = $this->common_model->is_data_exists(ORDERS, $where);
    //     if (!empty($data['orderexist'])) {

    //         $data['title'] = " Orders Detail";

    //         if ($data['orderexist']->service_type==1) {
            
         
    //             $where_air = array('order_id' =>$data['orderexist']->orderID );
    //             $data['air'] = $this->common_model->is_data_exists(AIR_FREIGHT_ORDER_INFO, $where_air);
                
    //             $where = array('airFreightItemID' =>$data['air']->item_id);
    //             $data['air_title'] = $this->common_model->is_data_exists(AIR_FREIGHT_ITEMS, $where);
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
    //         $this->load->admin_render('order/completed_order_details.php', $data);

          
    //     } else {
    //         $this->load->admin_render('order/completed_order', $data);
    //     }
    // }

    private function notification_email($first_name,$email,$tracking_id,$status,$delivery_type,$orderID) {

        $subject = get_order_tracking_email_subject($status,$delivery_type);
        $data['name'] = $first_name;
        $data['email'] = $email;
        $data['id'] = $tracking_id;
        $data['status'] = $status;
        $data['orderID'] = $orderID;
        $data['subject'] = get_order_tracking_email_subject($status,$delivery_type);

        $where = array('orderID' => $orderID);

        $data['orderexist'] = $this->common_model->is_data_exists(ORDERS, $where);

        if (!empty($data['orderexist'])) {

            if ($data['orderexist']->service_type==1) {
    
                $where_air = array('order_id' =>$data['orderexist']->orderID );
                $data['air'] = $this->common_model->is_data_exists(AIR_FREIGHT_ORDER_INFO, $where_air);

                $where = array('airFreightItemID' =>$data['air']->item_id);
                $data['air_title'] = $this->common_model->is_data_exists(AIR_FREIGHT_ITEMS, $where);
            }

            if ($data['orderexist']->service_type==2) {
                $where_sea = array('seaFreightServiceID' =>$data['orderexist']->service_id );
                $data['sea'] = $this->common_model->is_data_exists(SEA_FREIGHT_SERVICES, $where_sea);
            }

            // if($data['orderexist']->service_type==3){

            //     $where_courier = array('courierServiceID' =>$data['orderexist']->service_id );
            //     $data['courier']=$this->common_model->is_data_exists(COURIER_SERVICES, $where_courier);
            // }

            // if($data['orderexist']->service_type==4){
                    
                
            //     $where_concierge = array('conciergeQuoteID' =>$data['orderexist']->concierge_quote_id);

            //     $data['concierge']=$this->common_model->is_data_exists(CONCIERGE_QUOTES,$where_concierge);
            // }
            //pr($data);
        }

        $message = $this->load->view('emails/notification_mail',$data,TRUE);
        $response = $this->smtp_email->send_mail($email,$subject,$message);
        return $response;
    }
}
