<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Customer extends Common_Back_Controller {
    function __construct() {
        parent::__construct();
    }
    //Customer view page
    public function index() {
        $this->check_admin_user_session();
        $data['page_title'] = "Customers";
        $this->load->admin_render('user/customer_list', $data);
    }

    public function customer_details() {
        $this->check_admin_user_session();
        $data['page_title'] = "Customer Details";
        $this->load->admin_render('user/customer_details', $data);
    }

    //Customer List
    public function customer_list() {
        $this->load->model('customer_list_model');
        $list = $this->customer_list_model->get_list();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $user) {
            $encoded = encoding($user->userID);
            $action = '';
            $no++;
            $row = array();
            $row[] = $no;

            if ($user->avatar) {
                $url = getenv('S3_USER_AVATAR_THUMB') . $user->avatar;
            } else {
                $url = getenv('S3_USER_PLACEHOLDER_AVATAR');
            }

            $row[] = '<a href="' . admin_url('customer/user_details?id=') . $encoded . '"  class="on-default edit-row table_action" title="user Details">' . ucfirst(display_placeholder_text($user->full_name)) . '</a>';
            // $row[] = '<a href="' . admin_url('customer/user_details?id=') . $encoded . '"  class="on-default edit-row table_action" title="user Details"><img src="' . $url . '" class="img-circle" width="10%" alt="User Image">&nbsp<a href="' . admin_url('customer/user_details?id=') . $encoded . '"  class="on-default edit-row table_action" title="user Details">' . ucfirst(display_placeholder_text($user->full_name)) . '</a>';
            $row[] = display_placeholder_text($user->email);

            $statuChange = "statuChange('/customer/change_user_status','$user->userID','$user->status');";

            if ($user->status == 1) {
                $row[] = '<span class="active-icon"><i class="typcn typcn-media-record"></i></span>Active';
            } else {
                $row[] = '<span class="inactive"><i class="typcn typcn-media-record"></i></span>Inactive';
            }
            
            $isAlready = $this->common_model->is_data_exists(ORDERS,array('user_id'=>$user->userID,'status!='=>9));

            $action = '<div class="btn-group actionBtn">
                    <a class="btn btn-secondary dropdown-toggle drop-btn" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                 Select</a>
                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDivider">';
                    if ($user->status == 0) {
                        $action.= '<li><a href="javascript:void(0)" onclick="' . $statuChange . '" class="dropdown-item"><i class="fa fa-edi" aria-hidden="true"></i>Active</a></li>';
                    } else {
                        $action.= '<li><a href="javascript:void(0)" onclick="' . $statuChange . '" class="dropdown-item"><i class="fa fa-edi" aria-hidden="true"></i>Inactive</a></li>';
                    }
                    if(empty($isAlready)){
                        $action.= '<a href="' . admin_url('customer/new_order?id=') . $encoded . '" class="dropdown-item">New Order</a>';
                    }else {
                        $action.= '<a href="javascript:void(0)" class="dropdown-item">New Order</a>';
                    }
                    $action.= '<a href="' . admin_url('customer/user_details?id=') . $encoded . '"  class="dropdown-item">Details</a>';
                    '</div>
                </ul>
            </div>';

            $row[] = $action;
            $data[] = $row;
        }

        // $action.= '<a href="customer/new_order" class="dropdown-item">New Order</a>';

        $output = array("draw" => $_POST['draw'], "recordsTotal" => $this->customer_list_model->count_all(), "recordsFiltered" => $this->customer_list_model->count_filtered(), "data" => $data,);
        //output to json format
        echo json_encode($output);
    }

    public function new_order() {
        $this->check_admin_user_session();
        $id = (decoding($_GET['id']));
        $where = array('userID' => $id);
        $data['sea_freight_item'] = $this->common_model->getTotalRecords(SEA_FREIGHT_SERVICES,array('status'=>1));
        $data['page_title'] = "New Order";
        $data['id'] = $id;
        $data['dataUser'] = $this->common_model->is_data_exists(USERS, $where);
        $this->load->admin_render('user/new_order', $data);
    }

    // user details
    public function user_details() {
        $this->check_admin_user_session();
        $id = (decoding($_GET['id']));
        $where = array('userID' => $id);
        $data['page_title'] = "Customer Detail";
        $data['dataexist'] = $this->common_model->is_data_exists(USERS, $where);
        if (!empty($data['dataexist'])) {
            $data['title'] = "Customer Details";
            $this->load->admin_render('user/customer_details', $data);
        } else {
            $this->load->admin_render('user/customer_list', $data);
        }
    }

    public function change_user_status() {
        $this->check_admin_ajax_auth();
        $user_id = sanitize_input_text($this->input->post('id'));
        $status = sanitize_input_text($this->input->post('status'));
        $where = array('userID' => $user_id);
        $update_status = 1;
        if ($status == 1) {
            $update_status = 0;
        }
        $update_userdata = $this->common_model->updateFields(USERS, array('status' => $update_status, 'updated_at' => datetime()), $where);
        if ($update_userdata) {
            echo json_encode(array("message" => get_response_message(110), "status" => SUCCESS));
        } else {
            echo json_encode(array("message" => get_response_message(107), "status" => FAIL));
        }
    }

    public function change_idproof_status() {
        $this->check_admin_ajax_auth();
        $user_id = sanitize_input_text($this->input->post('id'));
        $status = $_POST['status'];
        //pr($status);
        $idProof = array('id_proof_status' => $status);
        $where = array('userID' => $user_id);
        $update_id_proof = $this->common_model->updateFields(USERS, $idProof, $where);
    }

    //customer details list
     public function customer_details_list(){

      $this->load->model('customer_details_model');
        $id = $_POST['user_id'];
        //pr($_POST['status']);
        $where = array('user_id'=>$id);
        $this->customer_details_model->set_data($where);
        $list = $this->customer_details_model->get_list();
        //lq();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $customer) { 
        $action ='';
        $no++;
        $row = array();
        $row[] = $no;
        if($customer->service_type==1){
               $service_type = 'Air Freight';
        }elseif ($customer->service_type==2) {
            $service_type = 'Sea Freight';
        }elseif ($customer->service_type==3) {
            $service_type = 'Courier & Express Services';
        }elseif ($customer->service_type==4) {
            $service_type = 'Concierge Shipping ';
        }else{
            $service_type = 'My Shipment';


        }
        $encoded = encoding($customer->orderID);
        //pr($customer);
        if ($customer->tracking_id =="") {
            $tracking_id='NA';
        }
        else{
            $tracking_id='#'.$customer->tracking_id;
        }
        $old_date = date($customer->created_at);
        $date = date('d F yy', strtotime($old_date));
        $time = date('H:i A', strtotime($old_date));           
        $row[] = display_placeholder_text($tracking_id); 
        $row[] = display_placeholder_text($service_type); 
        //$row[] = display_placeholder_text('$'.$customer->price); 
        $row[]= nl2br("$date\n $time");
         switch ($customer->status) {
                case '1':
                    $row[] = '<p id="badge" class="badge bg-dark">New order</p>';
                    break;
                case '2':
                    $row[] = '<p id="badge" class="badge badge-warning">Approved</p>';
                    break;
                case '3':
                    $row[] = '<p id="badge" class="badge bg-primary">Package received at our warehouse</p>';
                    break; 
                case '4':
                    $row[] = '<p id="badge" class="badge bg-info">Package preparing to ship</p>';
                    break; 
                case '5':
                    $row[] = '<p id="badge" class="badge bg-secondary">Shipment dropped off at Atlanta Airport</p>';
                    break;  
                case '6':
                    $row[] = '<p id="badge" class="badge bg-danger">Shipment in Transit</p> ';
                    break;  
                case '7':
                    $row[] = '<p id="badge" class="badge bg-success">Shipment arrived in accra</p> ';
                    break;
                case '8':
                    $row[] = '<p id="badge" class="badge badge-warning">Customs clearance started</p>';
                    break;
                case '9':
                    $row[] = '<p id="badge" class="badge bg-success">Shipment cleared</p>';
                    break;     
            }
        //$row[] = display_placeholder_text($customer->status); 
        $action = '<div class="btn-group actionBtn">
                    <a class="btn btn-secondary dropdown-toggle drop-btn" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                 Select</a>
            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDivider">'; 
        $action.= '<a href="' . admin_url('customer/order_details?id=') . $encoded . '"  class="dropdown-item">View</a>';
        if ($customer->status!=7) {
            $changeStatus = "viewFn('/order','open_status_modal',".$customer->orderID.")";
            $action.= '<a class="dropdown-item" href="javascript:void(0)" onclick="'.$changeStatus.'" type="button" class="btn btn-primary">Change Status</a>';
        }
        '</div>
            </ul>
            </div>';
                 
        $row[] = $action;
         $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->customer_details_model->count_all(),
            "recordsFiltered" => $this->customer_details_model->count_filtered(),
            "data" => $data,
        );

        //output to json format
       echo json_encode($output);
    }// End function

    public function order_details() {
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
            if ($data['orderexist']->status == 1 && $data['orderexist']->service_type != 5){
                $this->load->admin_render('order/new_order_details', $data);
            }
            elseif ($data['orderexist']->status == 1 && $data['orderexist']->service_type == 5){
                $data['shipment_request'] = $this->common_model->is_data_exists(ORDERS,array('orderID' =>$data['orderexist']->orderID));
                $data['shipment_user_info'] = $this->common_model->is_data_exists(USERS,array('userID'=>$data['shipment_request']->user_id));

            $this->load->admin_render('shipment/shipment_details', $data);
            }

            
            elseif ($data['orderexist']->status >=2 && $data['orderexist']->status!= 7 ) {
                $this->load->admin_render('order/pending_order_details', $data);
            }

            elseif ($data['orderexist']->status == 7) {
                $this->load->admin_render('order/completed_order_details', $data);
            }

            else {
                $this->load->admin_render('user/customer_list', $data);
            }
        }
    }
}