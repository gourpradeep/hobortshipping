<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends Common_Front_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('auth_model');
        $this->load->library('smtp_email');
    }

    public function signup() {
        $data['page_title'] = 'Signup';
        $this->load->model('option_model');
        $data['signup'] = $this->common_model->getAll(USERS);
        $data['terms'] = $this->option_model->get_option('terms_content');
        $data['jsonData'] = !empty($_GET)?key_pair($_GET):'';
        $this->load->front_render('signup', $data);
    }

    public function login() {
        $data['page_title'] = 'Login';
        // pr($_GET);
        $data['jsonData'] = !empty($_GET)?key_pair($_GET):'';
        $this->load->front_render('login', $data);
    }

    public function signout() {
        $this->logout();
    }

    public function user_signup() {
        
        $this->form_validation->set_rules('name', 'name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        //$this->form_validation->set_rules('phone', 'Phone no ', 'trim|required');
        //$this->form_validation->set_rules('idproof', 'ID Proof', 'trim|required');

        if ($this->form_validation->run($this) == FALSE) {
            $messages = (validation_errors()) ? validation_errors() : '';
            $response = array('status' => 0, 'msg' => $messages);
            echo json_encode($response);die();
        }
        if (!isset($_POST['check'])) {
            $data = array('status' => 0, 'msg' => 'Please accept Terms & Conditions');
            echo json_encode($data);die();
        }

        $datainsert['full_name'] = sanitize_input_text($this->input->post('name'));
        $datainsert['email'] = strtolower($this->input->post('email'));
        $datainsert['password'] = password_hash(sanitize_input_text($this->input->post('password')), PASSWORD_DEFAULT);

        $datainsert['country_code'] = sanitize_input_text($this->input->post('country_code'));

        $datainsert['phone_dial_code'] = sanitize_input_text('+'.$this->input->post('dial_code'));

        $datainsert['phone_number'] = sanitize_input_text($this->input->post('phone'));

        //for email unique or not
        $where_email = array('email' => $datainsert['email']);
        $email_exists = $this->common_model->is_data_exists(USERS, $where_email);
        if (!empty($email_exists)) {
            $data = array('status' => 0, 'msg' => 'Email already exist');
            echo json_encode($data);die();
        }

        //for phone unique or not
        $where_phone = array( 'phone_dial_code' =>$datainsert['phone_dial_code']   , 'phone_number' => $datainsert['phone_number']);
        $phone_exists = $this->common_model->is_data_exists(USERS, $where_phone);

        if (!empty($phone_exists)) {
           $data = array('status' => 0, 'msg' => 'Phone number already exist');
           echo json_encode($data); die();
        }
        $user_count = $this->common_model->get_total_count(USERS);

        if ($user_count <= 100) {

            $datainsert['promo_applicable'] = 1;
        }
        if (!empty($_FILES['avatar']['name'])) {
            $this->load->model('Image_model');
            $folder = 'avatar';
            $image['image_name'] = $this->Image_model->upload_image('avatar', $folder); //upload media of
            if(!empty($image['image_name']['error'])){

             echo json_encode(array('status' => 0,  "msg"=> " Profile image should be proper in size")); die; 
            }
        }
        if (!empty($_FILES['idproof']['name'])) {
            $this->load->model('Image_model');
            $folder = 'idproof';
            $idproof['image_name'] = $this->Image_model->upload_image('idproof', $folder); //upload media of
            
            if(!empty($idproof['image_name']['error'])){

             echo json_encode(array('status' => 0, "msg"=> "ID proof image should be proper in size")); die; 
            }
        }

        $datainsert['avatar'] = $image['image_name'];
        $datainsert['id_proof'] = $idproof['image_name'];
        $datainsert['id_proof_status'] = 1;
        $datainsert['created_at'] = datetime();
        $datainsert['updated_at'] = datetime();
        $datainsert['last_login_at'] = datetime();
        //pr($where_phone);
        $insert_id = $this->common_model->insertData('users', $datainsert);
        //pr($_SESSION);

        if(!empty($this->input->post('jsonData'))){

            $data = array('status' => 1, 'msg' => 'Account created successfully', 'url' => base_url('order/current_order?'.$this->input->post('jsonData')));
        }else{
            $data = array('status' => 1, 'msg' => 'Account created successfully', 'url' => base_url('order/current_order'));

        }
        $this->auth_model->session_create($insert_id);
        echo json_encode($data);
    }

    public function user_login() {
        // $this->check_user_session();
        // pr($this->input->post('jsonData'));
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
            $isLogin = $this->auth_model->isUserLogin($email, $password, USERS);
            // pr($isLogin);
            if($isLogin==='UI'){

                $data = array('status' => 0, 'msg' => 'Your account is deactivated. Please contact admin.');
                echo json_encode($data);die();
            }

            if ($isLogin == TRUE) {
                $update_where = array('email' => $email);
                $update_data['last_login_at'] = datetime();
                $this->common_model->updateFields(USERS, $update_data, $update_where);
                // pr($this->input->post('jsonData'));
                if(!empty($this->input->post('jsonData'))){
                    $data = array('status' => 1, 'msg' => 'Logged in successfully. Redirecting...', 'url' => base_url('order/current_order?'.$this->input->post('jsonData')));
                    

                }else{

                    $data = array('status' => 1, 'msg' => 'Logged in successfully. Redirecting...', 'url' => base_url('order/current_order'));
                }
            } else {
                $data = array('status' => 0, 'msg' => 'Invalid email address or password');
            }
            echo json_encode($data);
            
        }
    }//end of function

    function forgot_password(){
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        if ($this->form_validation->run($this) == FALSE) {
            echo json_encode(array('status'=>0,'msg'=>validation_errors()));
            die();
        }

        $email = $this->input->post('email');
        $is_exist = $this->common_model->is_data_exists(USERS,array('email'=>$email));

        //condition check for email exists or not
        if(empty($is_exist)){
            echo json_encode(array('status'=>0,'msg'=>'Email is not exists'));
            die();
        }

        $password = get_password();
        $data['password'] = $password;
        $data['name'] = $is_exist->full_name;

        $to = $email;
        $subject = 'Reset Password';
        $message = $this->load->view('emails/reset_password',$data,TRUE);
        $is_send = $this->smtp_email->send_mail($to, $subject, $message);

        if($is_send!=TRUE){
            echo json_encode(array('status'=>0,'msg'=>'Problem in sending mail'));
            die();
        }

        $insertData['password'] = password_hash($password,PASSWORD_DEFAULT);
        $insertData['updated_at'] = datetime();

        $dataAdded = $this->common_model->updateFields(USERS,$insertData,array('email'=>$email));

        if(empty($dataAdded)){
            echo json_encode(array('status'=>0,'msg'=>'Problem in update password'));
            die();
        }

        echo json_encode(array('status'=>1,'msg'=>'Password successfully sent on your registered email.'));

    }//end of function

    function email_verification_page(){
        $data['page_title'] = 'Email Verification';
        $user_data = $this->common_model->is_data_exists(USERS,array('userID'=>decoding($_GET['user_id'])));
        $data['email'] = $user_data->email;
        $data['name'] = $user_data->full_name;

        // $data['link'] = base_url('auth/email_auth');
        if(!empty($_GET['qoute']) && $_GET['qoute']=='true'){

            $data['link'] = base_url('auth/email_verification?user_id='.$_GET['user_id'].'&email='.$data['email'].'&'.key_pair($_GET));
        }else{
            $data['link'] = base_url('auth/email_verification?user_id='.$_GET['user_id'].'&email='.$data['email']);
        }
        // pr($data['link']);
        $to = $user_data->email;
        $subject = getenv('APP_NAME').' | Confirm your email address';
        $message = $this->load->view('emails/email_verify',$data,TRUE);

        if(!empty($this->session->userdata()['email_verified_check']) && empty($user_data->email_verification_token)){
            
            $is_send = $this->smtp_email->send_mail($to, $subject, $message);

            if($is_send==TRUE){
                $this->common_model->updateFields(USERS,array('email_verification_token'=>1),array('userID'=>decoding($_GET['user_id'])));
            }

            $this->session->unset_userdata('email_verified_check');
        }
        // pr($is_send);
        if($user_data->is_email_verified==1){
            redirect('order/current_order?'.key_pair($_GET));

        }else{

            $this->load->front_render('email_verification',$data);
        }
        // $this->load->front_render('emails/email_verify',$data);
    }//end of cuntion

    function email_verification(){
        if(!empty($_GET['user_id'])){
            $user_id = decoding($_GET['user_id']);
            $email = $_GET['email'];
            
            $updated = $this->common_model->updateFields(USERS,array('is_email_verified'=>1),array('email'=>$email,'userID'=>$user_id));
        }
        $_SESSION['verified_success'] = 1;
        if(!empty($_GET['qoute']) && $_GET['qoute']=='true'){
            redirect('order/current_order?'.key_pair($_GET));
        }else{
            redirect('order/current_order');

        }
    }//end of function


    function resend_email(){
        // pr($_POST['email']);
        if(empty($_POST['email'])){
            echo json_encode(array('status'=>0,'msg'=>'Email not found'));
            die();
        }

        $data['email'] = $_POST['email'];
        $data['link'] = $_POST['link'];
        $data['name'] = $_POST['name'];
        // pr($_POST);
        $to = $_POST['email'];
        $subject = getenv('APP_NAME').' | Confirm your email address';
        $message = $this->load->view('emails/email_verify',$data,TRUE);
        $is_send = $this->smtp_email->send_mail($to, $subject, $message);

        if($is_send!=TRUE){
             echo json_encode(array('status'=>0,'msg'=>'Problem in sending mail'));
            die();
        }
         echo json_encode(array('status'=>1,'msg'=>'Mail successfully resent on your registered email address'));
            die();
    }
}//end of class