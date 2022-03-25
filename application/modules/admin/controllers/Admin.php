<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends Common_Back_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('login_model');
        $this->load->library('dynamic_link');
    }

    // Admin Login page
    public function index() {
        $this->check_admin_user_session();
        $data['page_title']  = "Login | HobortShippingDev- Admin";
        $this->load->view('auth/login', $data);
    }

    // Admin Dashboard
    public function dashboard() {
        
        $this->check_admin_user_session();

        $data['page_title'] = "Dashboard";
        $where_status = array('status' => 1);
        $where = "status='1' OR status='2'";
        $data['air_freight'] = $this->common_model->get_total_count(AIR_FREIGHT_SERVICES, $where_status);
        $data['sea_freight'] = $this->common_model->get_total_count(SEA_FREIGHT_SERVICES, $where_status); 
        $data['courier_service'] = $this->common_model->get_total_count(COURIER_SERVICES, $where_status); 
        $data['air_freight_item'] = $this->common_model->get_total_count(AIR_FREIGHT_ITEMS, $where_status); 
        $data['customer'] = $this->common_model->get_total_count(USERS); 
        $data['new_order'] = $this->common_model->get_total_count(ORDERS,$where); 
        $data['new_quote'] = $this->common_model->get_total_count(CONCIERGE_QUOTES,$where); 
        $data['completed_orders'] = $this->common_model->get_total_count(ORDERS,array('status'=>7)); 
         $data['pending_orders'] = $this->common_model->get_total_count(ORDERS,array('status<'=>7,'status>'=>1)); 
         $data['my_shipment'] = $this->common_model->get_total_count(ORDERS,array('service_type'=>5,'status'=>1)); 
        $this->load->admin_render('dashboard/dashboard', $data);
    }

    //Admin profile 
    public function admin_profile() {
        $this->check_admin_user_session();
        $data['page_title'] = "Admin-Profile";
        $this->load->admin_render('dashboard/admin_profile', $data);
    }

    //logout
    public function logout() {
        $this->admin_logout();
    }

    //Admin login 
    public function login() {
        $data['title'] = 'Admin login';
        if (!isset($_POST['email']) || !isset($_POST['password'])) {
            redirect('admin/login');
        }
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $errors = validation_errors();
            $this->session->set_flashdata('login_err', $errors);
            $this->load->view('login', $data);
        } else {
            $email = sanitize_input_text($this->input->post('email'));
            $password = sanitize_input_text($this->input->post('password'));
            $isLogin = $this->login_model->isLogin($email, $password, ADMIN_USERS);
            if ($isLogin == TRUE) {
                $data = array('status' => 1, 'msg' => 'Logged in successfully. Redirecting...', 'url' => base_url() . 'admin/dashboard');
            } else {
                $data = array('status' => 0, 'msg' => 'Invalid email address or password');
            }
            echo json_encode($data);
        }
    }

    // Admin Update
    public function admin_update() {
       // pr($_SESSION);
        $this->check_admin_user_session();
        $this->form_validation->set_rules('name', 'name', 'trim|required');
        $this->form_validation->set_rules('email', 'email', 'trim|required');
        if ($this->form_validation->run($this) == FALSE) {
            $messages = (validation_errors()) ? validation_errors() : '';
            $response = array('status' => 0, 'message' => $messages);
        } else {
            $update_data = array();
            $image = array();
            $where_id = $this->input->post('adminUserID');
            $existing_img = $this->common_model->is_data_exists(ADMIN_USERS,array('adminUserID'=>$where_id));
    
            if (!empty($_FILES['avatar']['name'])) {
                $this->load->model('Image_model');
                $folder = 'profile';
                $image['image_name'] = $this->Image_model->upload_image('avatar', $folder); //upload media of
              //pr($image);
                if (array_key_exists("error", $image) && !empty($image['error'])) {
                    $response = array('status' => 0, 'message' => $image['error']);
                    echo json_encode($response);
                    die;
                }
                
                if(!empty($existing_img->avatar)){
                    $this->load->model('Image_model');                
                     $asd = $this->Image_model->delete_image($folder, $existing_img->avatar);
                }
                    $update_data['avatar'] =  $image['image_name'];
            }

            $set = array('name', 'email');
                foreach ($set as $key => $val) {
                    $post = $this->input->post($val);
                    $update_data[$val] = (isset($post) && !empty($post)) ? $post : '';
                }            $update_where = array('adminUserID' => $where_id);
            $userId = $this->common_model->updateFields(ADMIN_USERS, $update_data, $update_where);
            $u_id = $_SESSION[ADMIN_USER_SESS_KEY]['adminUserID'];
            $user = $this->common_model->getsingle(ADMIN_USERS, array('adminUserID' => $u_id));
            $user->avatar = getenv('S3_ADMIN_AVATAR_THUMB').$user->avatar;
            //update session
            $_SESSION[ADMIN_USER_SESS_KEY]['name'] = $user->name;
            $_SESSION[ADMIN_USER_SESS_KEY]['emailId'] = $user->email;

            $_SESSION[ADMIN_USER_SESS_KEY]['avatar'] = $user->avatar;
            $_SESSION[ADMIN_USER_SESS_KEY]['isLogin'] = TRUE;
            //pr($_SESSION);
            $response = array('status' => 1, 'msg' => 'Successfully Updated', 'url' => base_url('admin/admin_profile'));
        }
        echo json_encode($response);
        die;
    }

    function add_new_order(){
        // pr($_POST);
        $item = array();
        $concierge_exist_data = array();
        $uid = $this->input->post('id');

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
                $item['item_value'] = $this->input->post('item_value');
                $item['height'] = $this->input->post('height');

                $data['service_type'] = $this->input->post('delivery_type');
                $data['quantity'] = $this->input->post('quantity');

                $price = $this->input->post('totalValue');
                
                //check promo Applicable
                $promo_applicable_check = $this->common_model->is_data_exists(USERS,array('userID'=> $uid ));

                // if(!empty($_SESSION['app_user_sess'])){

                    if($promo_applicable_check->promo_applicable == 1){
                        $price = calculate_promo_discount($price);
                        $promo_update['promo_applicable'] = 0;
                        $this->common_model->updateFields(USERS,$promo_update,array('userID'=> $uid));
                    }
                // }

                $data['price'] = $price;

                $urlParam = 'length='.urlencode($item['length']).'&width='.urlencode($item['width']).'&weight='.urlencode($item['weight']).'&area_total='.urlencode($item['volumetric_weight']).'&item_value='.urlencode($item['item_value']).'&height='.urlencode($item['height']).'&service_type='.urlencode($data['service_type']).'&quantity='.urlencode($data['quantity']).'&price='.urlencode($data['price']);
            }

        }else {

            $this->form_validation->set_rules('item_sea', 'Item', 'required');
            $this->form_validation->set_rules('quantity_sea', 'Quantity', 'required');
            if ($this->form_validation->run($this) == FALSE) {
                echo json_encode(array('status'=>0,'message'=>validation_errors()));
                die();
            }else{
                $sea_service_id = $this->input->post('service_id_sea');
                $data['service_type'] = $this->input->post('delivery_type');
                $data['service_id'] = $sea_service_id;
                $data['quantity'] = $this->input->post('quantity_sea');

                $priceData = $this->common_model->is_data_exists(SEA_FREIGHT_SERVICES,array('seaFreightServiceID'=> $sea_service_id));
                $price = '0.00';

                if(!empty($priceData)){
                    $price = $priceData->price;
                }

                $tota_price = $price * $data['quantity'];

                //check promo Applicable
                $promo_applicable_check = $this->common_model->is_data_exists(USERS,array('userID'=>$uid));

                // if(!empty($_SESSION['app_user_sess'])){

                    if($promo_applicable_check->promo_applicable == 1){
                        $tota_price = calculate_promo_discount($tota_price);
                        $promo_update['promo_applicable'] = 0;
                        $this->common_model->updateFields(USERS,$promo_update,array('userID'=>$uid));
                    }
                // }
               
                $data['price'] = $tota_price;

                // $urlParam = 'service_type='.urlencode($_POST['delivery_type']).'&service_id='.urlencode($data['service_id']).'&quantity='.urlencode($data['quantity']).'&price='.urlencode($data['price']);
                // pr($data['price'])
            }
        }
        // else if($_POST['delivery_type']==3){

        //     $this->form_validation->set_rules('item_courier', 'Item', 'required');
        //     $this->form_validation->set_rules('quantity_courier', 'Quantity', 'required');
        //     if ($this->form_validation->run($this) == FALSE) {
        //         echo json_encode(array('status'=>0,'message'=>validation_errors()));
        //         die();
        //     }else{
        //         $data['service_type'] = $this->input->post('delivery_type');
        //         $data['service_id'] = $this->input->post('id1');
        //         $data['quantity'] = $this->input->post('quantity_courier');
                
        //         $priceData = $this->common_model->is_data_exists(COURIER_SERVICES,array('courierServiceID'=>$this->input->post('id1')));
        //         $price = '0.00';
        //         if(!empty($priceData)){
        //             $price = $priceData->price;
        //         }
        //         $tota_price = $price * $data['quantity'];

        //         //check promo Applicable
        //         $promo_applicable_check = $this->common_model->is_data_exists(USERS,array('userID'=>$_SESSION['app_user_sess']['userID']));

        //         if(!empty($_SESSION['app_user_sess'])){

        //             if($promo_applicable_check->promo_applicable == 1){
        //                 $tota_price = calculate_promo_discount($tota_price);
        //                 $promo_update['promo_applicable'] = 0;
        //                 $this->common_model->updateFields(USERS,$promo_update,array('userID'=>$_SESSION['app_user_sess']['userID']));
        //             }
        //         }
        //         $data['price'] = $tota_price;
               
        //         $urlParam = 'service_type='.urlencode($_POST['delivery_type']).'&service_id='.urlencode($data['service_id']).'&quantity='.urlencode($data['quantity']).'&price='.urlencode($data['price']);
        //     }
        
        // }

        $track_id = getenv('TRACKING_PREFIX').get_random_id();
        $data['tracking_id'] = $track_id;

        $dynamic_link = base_url().'home/track?tracking_id='.$data['tracking_id'].'';
        $link = $this->dynamic_link->create_dynamic_link($dynamic_link);
        // pr($link->shortLink);
        $data['dynamic_link'] = $link->shortLink;

        // $data['status_updated_at'] = json_encode($make_json);

        $data['created_by'] = 1;

        // $jsonData = json_encode($_POST);
        // pr($this->session->userdata()['app_user_sess']);
        // if(!empty($this->session->userdata()['app_user_sess'])){
            $data['user_id'] = $uid;
            $data['status'] = 3;
            $text = 'package_received_at_our_warehouse';
            $make_json[$text] = datetime();
            $data['status_updated_at'] = json_encode($make_json);
            // $data['shipper_name'] = $this->session->userdata()['app_user_sess']['name'];
            $data['updated_at'] = datetime();
            $data['created_at'] = datetime();

            // $concierge_exist_data = $this->common_model->is_data_exists(CONCIERGE_QUOTES,array('user_id'=>$data['user_id'],'status<='=> 2));

            $is_already = $this->common_model->is_data_exists(ORDERS,array('user_id'=>$data['user_id'],'status!='=>9));

            if(!empty($is_already)){
                echo json_encode(array('status'=>0,'message'=>'Unable to create quote. You already have a pending order'));die();
            }

            if($data){
                $orderInsert = $this->common_model->insertData(ORDERS,$data);

                if(!empty($item)){
                    $item['order_id'] = $orderInsert;
                    $itemInsert = $this->common_model->insertData(AIR_FREIGHT_ORDER_INFO,$item);
                }
            }

            $url = base_url().'admin/customer';

            echo json_encode(array('status'=>1,'url'=>$url,'message'=>'New order added successfully'));
        // }else{
        //     $url = base_url().'auth/login?qoute=true&'.$urlParam;
        //     echo json_encode(array('status'=>1,'url'=>$url,'flag'=>1));
        // }
    }

    function add_shipment(){
        // pr($_POST);
        $oid = $this->input->post('oid');
        $order_data = $this->common_model->is_data_exists(ORDERS,array('orderID'=>$oid));
        
        if($order_data->service_type==1){
            $this->form_validation->set_rules('carrier', 'Carrier Name', 'required');
            $this->form_validation->set_rules('content', 'Description', 'required');
            $this->form_validation->set_rules('length', 'Length', 'required');
            $this->form_validation->set_rules('width', 'Width', 'required');
            $this->form_validation->set_rules('weight', 'Weight', 'required');
            $this->form_validation->set_rules('height', 'Height', 'required');
            $this->form_validation->set_rules('item_value', 'Item value', 'required');
            $this->form_validation->set_rules('totalValue', 'Total price', 'required',array('required'=>'Sorry, we are not able to find quote with given details.'));
            $this->form_validation->set_rules('quantity', 'Quantity', 'required');

            if ($this->form_validation->run($this) == FALSE) {
                echo json_encode(array('status'=>0,'message'=>validation_errors()));
                die();
            }else{
                $data['order_id'] = $oid;
                $data['track_number'] = $oid;
                $data['ship_quantity'] = $this->input->post('quantity');
                $data['carrier_name'] = $this->input->post('carrier');
                $data['content'] = $this->input->post('content');
                $data['length'] = $this->input->post('length');
                $data['height'] = $this->input->post('height');
                $data['width'] = $this->input->post('width');
                $data['weight'] = $this->input->post('weight');
                $data['item_value'] = $this->input->post('item_value');

                $price = $this->input->post('totalValue');
                
                //check promo Applicable
                $promo_applicable_check = $this->common_model->is_data_exists(USERS,array('userID'=> $order_data->user_id ));

                if($promo_applicable_check->promo_applicable == 1){
                    $price = calculate_promo_discount($price);
                    $promo_update['promo_applicable'] = 0;
                    $this->common_model->updateFields(USERS,$promo_update,array('userID'=> $order_data->user_id));
                }

                $data['ship_price'] = $price;

                $order_info_data = $this->common_model->is_data_exists(AIR_FREIGHT_ORDER_INFO,array('order_id'=>$oid));
                

                $itemData['item_value'] = $order_info_data->item_value + $data['item_value'];
                $updateOrderInfo = $this->common_model->updateFields(AIR_FREIGHT_ORDER_INFO,$itemData,array('order_id'=>$oid));

            }

        }else {
            $this->form_validation->set_rules('item_sea', 'Item', 'required');
            $this->form_validation->set_rules('quantity_sea', 'Quantity', 'required');

            if ($this->form_validation->run($this) == FALSE) {
                echo json_encode(array('status'=>0,'message'=>validation_errors()));
                die();
            }else{
                $sea_service_id = $this->input->post('service_id_sea');
                $sea_title = $this->input->post('title_sea');
                $sea_type = $this->input->post('type_sea');
                // $data['service_type'] = $this->input->post('delivery_type');
                // $data['service_id'] = $sea_service_id;
                $data['order_id'] = $oid;
                $data['track_number'] = $oid;
                $data['ship_quantity'] = $this->input->post('quantity_sea');
                $data['carrier_name'] = $this->input->post('carrier');
                $data['content'] = $this->input->post('content');
                $data['sea_title'] = $sea_title;
                $data['sea_type'] = $sea_type;
                $data['sea_price'] = $this->input->post('item_sea');

                $priceData = $this->common_model->is_data_exists(SEA_FREIGHT_SERVICES,array('seaFreightServiceID'=> $sea_service_id));
                $price = '0.00';

                if(!empty($priceData)){
                    $price = $priceData->price;
                }

                $tota_price = $price * $data['ship_quantity'];

                //check promo Applicable
                $promo_applicable_check = $this->common_model->is_data_exists(USERS,array('userID'=>$order_data->user_id));

                if($promo_applicable_check->promo_applicable == 1){
                    $tota_price = calculate_promo_discount($tota_price);
                    $promo_update['promo_applicable'] = 0;
                    $this->common_model->updateFields(USERS,$promo_update,array('userID'=>$order_data->user_id));
                }
               
                $data['ship_price'] = $tota_price;
            }
        }

        $data['track_number'] = $this->input->post('tracking_numbers');
        $make_json[$text] = datetime();
        $data['status'] = 2;
        $data['status_updated_at'] = json_encode($make_json);
        $data['updated_at'] = datetime();
        $data['created_at'] = datetime();

        $orderInsert = $this->common_model->insertData(OS,$data);

        $updateOrderData['quantity'] = $order_data->quantity + $data['ship_quantity'];
        $updateOrderData['price'] = $order_data->price + $data['ship_price'];
        $updateOrderData['updated_at'] = datetime();

        $updateOrder = $this->common_model->updateFields(ORDERS,$updateOrderData,array('orderID'=>$oid));

        $encoded = encoding($oid);

        $url = base_url().'admin/order/pending_order_details?id='.$encoded;

        echo json_encode(array('status'=>1,'url'=>$url,'message'=>'Shipment added successfully.'));

    }
    
    //chanege password
    public function changePassword() {
        $this->check_admin_user_session();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('password', 'password', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('npassword', 'new password', 'trim|required|matches[rnpassword]|min_length[6]');
        $this->form_validation->set_rules('rnpassword', 'confirm new password ', 'trim|required|min_length[6]');
        if ($this->form_validation->run($this) == FALSE) {
            $messages = (validation_errors()) ? validation_errors() : '';
            $response = array('status' => 0, 'msg' => $messages);
        } else {
            $password = $this->input->post('password');
            $npassword = $this->input->post('npassword');
            $select = "password";
            $where = array('adminUserID' => $_SESSION[ADMIN_USER_SESS_KEY]['adminUserID']);
            $admin = $this->common_model->getsingle(ADMIN_USERS, $where, 'password');
            if (password_verify($password, $admin->password)) {
                $set = array('password' => password_hash($this->input->post('npassword'), PASSWORD_DEFAULT));
                $update = $this->common_model->updateFields(ADMIN_USERS, $set, $where);
                if ($update) {
                    $res = array();
                    if ($update) {
                        $response = array('status' => 1, 'msg' => 'Password Changed Successfully', 'url' => base_url('admin/admin_profile'));
                    } else {
                        $response = array('status' => 0, 'msg' => 'Failed! Please try again', 'url' => base_url('admin/admin_profile'));
                    }
                }
            } else {
                $response = array('status' => 0, 'msg' => 'Your Current Password is Wrong !', 'url' => base_url('admin/admin_profile'));
            }
        }
        echo json_encode($response);
        die;
    } //End Function
} //End of class

