<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Shipment extends Common_Back_Controller {

    function __construct() {
        parent::__construct();
        $this->check_admin_user_session();
    }

    /**
     * @method index
     * @description listing display
     * @return array
     */
    public function index() {
        $this->check_admin_user_session();
        $data['page_title'] = "My Shipment";
        $this->load->admin_render('shipment/request_list', $data);
    }

    //New_quote_concierge_shipping List
    public function shipment_request_list() {
        $this->load->model('Shipment_request_list_model');
        $list = $this->Shipment_request_list_model->get_list();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $user) {
            $action = '';
            $no++;
            $row = array();
            $row[] = $no;
            //pr($user);
            $encoded_userID = encoding($user->userID);
            $encoded = encoding($user->orderID);
            if ($user->avatar) {
                $url = getenv('S3_USER_AVATAR_THUMB') . $user->avatar;
            } else {
                $url = getenv('S3_USER_PLACEHOLDER_AVATAR');
            }

            if ($user->status==1) {
                $status = '<p id="badge" class= "badge bg-warning">Pending</p>';
            }
            if ($user->status==2) {
                $status = '<p id="badge" class= "badge bg-success">Offer Sent</p>';
            }
            $old_date = date($user->created_at);
            $date = date('d F yy', strtotime($old_date));
            $time = date('H:i A', strtotime($old_date));
            $row[] = '<a href="' . admin_url('customer/user_details?id=') . $encoded_userID . '"  class="on-default edit-row table_action" title="user Details"><img src="' . $url . '" class="img-circle" width="10%" alt="User Image">&nbsp<a href="' . admin_url('customer/user_details?id=') . $encoded_userID . '"  class="on-default edit-row table_action" title="user Details">' . ucfirst(display_placeholder_text($user->full_name)) . '</a>';
            $row[] = display_placeholder_text($user->shipment_receiver_name);
            $row[] = display_placeholder_text($user->shipment_value);
            // $row[] = mb_strimwidth(display_placeholder_text($user->description), 0, 20, "..."); 


            $row[]= nl2br("$date\n $time");
            $action = '<div class="btn-group actionBtn">
                    <a class="btn btn-secondary dropdown-toggle drop-btn" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                 Select</a>
            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDivider">';
            $action.= '<a href="' . admin_url('shipment/details?id=') . $encoded . '"  class="dropdown-item">View</a>';
            '</div>
            </ul>
            </div>';
            $row[] = $action;
            $data[] = $row;
        }
        $output = array("draw" => $_POST['draw'], "recordsTotal" => $this->Shipment_request_list_model->count_all(), "recordsFiltered" => $this->Shipment_request_list_model->count_filtered(), "data" => $data,);
        //output to json format
        echo json_encode($output);
    }
    public function details() {
        $this->check_admin_user_session();
        $id = (decoding($_GET['id']));
        $where = array('orderID' => $id);
        $data['page_title']= 'Shipment Details';
        $data['shipment_request'] = $this->common_model->is_data_exists(ORDERS,$where);
        $data['shipment_user_info'] = $this->common_model->is_data_exists(USERS,array('userID'=>$data['shipment_request']->user_id));
        //pr($data);
        if (!empty($data['shipment_request'])) {
        $data['page_title']= 'Shipment Detail';
            $this->load->admin_render('shipment/shipment_details', $data);
        }else {
            $this->load->admin_render('shipment/request_list', $data);
        }
    }
    public function add_shipper_info(){
        $this->check_admin_ajax_auth();
        $id = $_POST['id'];
        $this->form_validation->set_rules('shipment_weight', 'Totalmweight', 'required');
        $this->form_validation->set_rules('total_price', 'Price', 'required');
        if ($this->form_validation->run($this) == FALSE) {
            $messages = (validation_errors()) ? validation_errors() : '';
            $data = array('status' => 0, 'msg' => $messages);
        } else {
            $is_order = $this->common_model->is_data_exists(ORDERS,array('orderID'=>$id));
            $status_json = $is_order->status_updated_at;
            $text = 'received_from_customer_at';

            if(empty($status_json)){
            $make_json[$text] = datetime();
            $update['status_updated_at'] = json_encode($make_json);

            }else{
            $status_json_text = json_decode($is_order->status_updated_at);
            $make_json[$text] = datetime();
            // array_push($status_json_text,$make_json);
            $status_json_text->$text = datetime();
            $update['status_updated_at'] = json_encode($status_json_text);

            }
            $where_id = array('orderID' => $id);
            $update['shipment_weight'] = $this->input->post('shipment_weight');
            $update['price'] = $this->input->post('total_price');
            $update['status'] = 4;
            $update['updated_at'] = datetime();
            $result = $this->common_model->updateFields(ORDERS, $update, $where_id);
            if (!empty($result)) {
                $data = array('status' => 1, 'msg' => 'Successfully added', 'url' => admin_url('shipment'));
            }

            else {
                    $data = array('status' => 0, 'msg' => 'User not exist');
            }
        }

        echo json_encode($data);
    }
}



