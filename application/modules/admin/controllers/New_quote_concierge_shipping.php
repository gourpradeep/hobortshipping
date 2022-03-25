<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class New_quote_concierge_shipping extends Common_Back_Controller {
    function __construct() {
        parent::__construct();
        $this->load->library('smtp_email');
        $this->load->library('twilio');
        $this->load->library('dynamic_link');

    }
    //New_quote_concierge_shipping
    public function index() {
        $this->check_admin_user_session();
        $data['page_title'] = "New Concierge Quote";
        $this->load->admin_render('order/new_quote_concierge_shipping', $data);
    }

    //New_quote_concierge_shipping List
    public function new_quote_concierge_list() {
        $this->load->model('new_quote_concierge_list_model');
        $list = $this->new_quote_concierge_list_model->get_list();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $user) {
            $action = '';
            $no++;
            $row = array();
            $row[] = $no;
            $encoded_userID = encoding($user->userID);
            $encoded = encoding($user->conciergeQuoteID);
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
            $row[] = mb_strimwidth(display_placeholder_text($user->description), 0, 20, "..."); 


            $row[] = display_placeholder_text($status);
            $row[]= nl2br("$date\n $time");
            $action = '<div class="btn-group actionBtn">
                    <a class="btn btn-secondary dropdown-toggle drop-btn" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                 Select</a>
            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDivider">';
            $action.= '<a href="' . admin_url('new_quote_concierge_shipping/new_quote_details?id=') . $encoded . '"  class="dropdown-item">View</a>';
            //$clk_delete = "deleteFn('" . CONCIERGE_QUOTES . "','Delete','$user->conciergeQuoteID','/new_quote_concierge_shipping/','delete_new_quote');";
            //$action.= '<li><a href="javascript:void(0)" onclick="' . $clk_delete . '" class="dropdown-item"><i class="" aria-hidden="true"></i> Delete</a></li>';
            '</div>
            </ul>
            </div>';
            $row[] = $action;
            $data[] = $row;
        }
        $output = array("draw" => $_POST['draw'], "recordsTotal" => $this->new_quote_concierge_list_model->count_all(), "recordsFiltered" => $this->new_quote_concierge_list_model->count_filtered(), "data" => $data,);
        //output to json format
        echo json_encode($output);
    }

    //Delete  New Quote
    public function delete_new_quote() {
        $this->check_admin_ajax_auth();
        $id = $_POST['id'];
        $where = array('conciergeQuoteID' => $id);
        $dataexist = $this->common_model->is_data_exists(CONCIERGE_QUOTES, $where);
        if (!empty($dataexist)) {
            $delete = $this->common_model->deleteData(CONCIERGE_QUOTES, $where);
            $data = array('status' => 1, 'url' => '', 'message' => 'Deleted successfully.');
            echo json_encode($data);
        } else {
            $data = array('status' => 0, 'message' => ' Air Freight not exist');
            echo json_encode($data);
        }
    }

    public function new_quote_details() {
        $this->check_admin_user_session();
        $this->load->model('order_model');
        $id = (decoding($_GET['id']));
        $where = array('conciergeQuoteID' => $id);
        $data['page_title'] = "New Concierge Quote Details";
        $data['new_quote_user'] = $this->common_model->is_data_exists(CONCIERGE_QUOTES,$where);
        $data['promo_applicable_check'] = $this->common_model->is_data_exists(USERS,array('userID'=>$data['new_quote_user']->user_id));
        if (!empty($data['new_quote_user'])) {
            $data['page_title'] = "New Concierge Quote Details";
            $this->load->admin_render('order/new_quote_details', $data);
        } else {
            $this->load->admin_render('order/new_quote_concierge_shipping', $data);
        }
    }

    public function add_offer_price() {
        $this->check_admin_ajax_auth();
        $id = $_POST['id'];
    //pr($_POST);
        $this->form_validation->set_rules('cost_of_order', 'Cost of order', 'required');
        $this->form_validation->set_rules('concierge_fee', 'Concierge Fee', 'required');
        if ($this->form_validation->run($this) == FALSE) {
            $messages = (validation_errors()) ? validation_errors() : '';
            $data = array('status' => 0, 'msg' => $messages);
        } else {
            $where_id = array('conciergeQuoteID' => $id);
            $update['order_cost'] = $this->input->post('cost_of_order');
            $update['concierge_fee'] = $this->input->post('concierge_fee');
            $update['offer_price'] = $this->input->post('total');
            $update['status'] = 2;
            $update['updated_at'] = datetime();
            //pr($update);die();

            $is_order = $this->common_model->is_data_exists(CONCIERGE_QUOTES,array('conciergeQuoteID'=>$id));
            //pr($is_order);

            $is_user = $this->common_model->is_data_exists(USERS,array('userID'=>$is_order->user_id));

            $result = $this->common_model->updateFields(CONCIERGE_QUOTES, $update, $where_id);
            $promo_update['promo_applicable'] = 0;
            $promo_applicable = $this->common_model->updateFields(USERS, $promo_update, array('userID' =>$is_order->user_id));
          
            $order = $this->common_model->is_data_exists(CONCIERGE_QUOTES,$where_id);
            if (!empty($result)) {
               
                $concierge_link_sms = getenv('CURRENT_ORDER_DYNAMIC_LINK');       
                $text = " Offer: You've got an offer for Concierge Shipping order. Track order: ".$concierge_link_sms;
                //pr($text);
                $dial_phone = $is_user->phone_dial_code.$is_user->phone_number;
                $text_message = $this->twilio->send_sms($dial_phone,$text);
                $notification_email  =  $this->offer_notification_email($is_user->full_name,$is_user->email,$order->offer_price,$order->order_cost,$order->concierge_fee);  
                $data = array('status' => 1, 'msg' => 'Offer sent successfully', 'url' => admin_url('new_quote_concierge_shipping'));
               
            } else {
                    $data = array('status' => 0, 'msg' => 'Price not exist');
            }
        }

        echo json_encode($data);
    }

    private function offer_notification_email($first_name,$email,$price,$cost_of_order,$concierge_fees) {
        
        $subject = get_concierge_email_subject(); 
        $concierge_link = getenv('CURRENT_ORDER_DYNAMIC_LINK');       
        $data['name'] = $first_name;
        $data['email'] = $email;
        $data['price'] = $price;
        $data['cost_of_order'] = $cost_of_order;
        $data['concierge_fees'] = $concierge_fees;
        $data['concierge_link'] = $concierge_link;
        $message = $this->load->view('emails/offer_mail',$data,TRUE);
        $response = $this->smtp_email->send_mail($email,$subject,$message);
        return $response;
    }

    // Discount for concierge shipping
     public function concierge_calculation() {
        
        $id = $_POST['userID'];
        $price = $_POST['total'];
        $tota_price = $price ;

        //check promo Applicable
        $promo_applicable_check = $this->common_model->is_data_exists(USERS,array('userID'=>$id));


        if($promo_applicable_check->promo_applicable == 1){
            $tota_price = calculate_promo_discount($tota_price);
        }
    
        echo json_encode(array('status'=>1,'amount'=>$tota_price,'userID'=>$id,'promo_applicable'=>$promo_applicable_check->promo_applicable));
    }//end of function
}
