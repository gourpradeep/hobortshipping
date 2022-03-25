<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class User extends Common_Front_Controller {
    function __construct() {
        parent::__construct();
        // $this->load->model('order_model');
        // $this->load->library('tracking_more');
        // $this->load->model('File_upload_model');
    }

    public function update_profile() {
        $this->check_user_session();
        $data['page_title'] = 'User-Profile';
        $user_id = $this->session->userdata()['app_user_sess']['userID'];
        $data['userData'] = $this->common_model->is_data_exists(USERS,array('userID'=>$user_id));
        // pr($data);
        $this->load->front_render('user/update_profile', $data);
        
    }//end of function


    //function for update user detail

    function update_user_detail(){
        // pr($_POST);
        $this->check_ajax_auth();
        $this->form_validation->set_rules('name', 'name', 'trim|required');
        $this->form_validation->set_rules('phone', 'Phone number', 'trim|required');
        $this->form_validation->set_rules('dial_code', 'Dial code', 'trim|required');
        $this->form_validation->set_rules('country_code', 'Country code', 'trim|required');
        if ($this->form_validation->run($this) == FALSE) {
            $messages = (validation_errors()) ? validation_errors() : '';
            $response = array('status' => 0, 'msg' => $messages);
            echo json_encode($response);die();
        }


        // if(!empty($_FILES['profileImages']['name'])){
        //     $this->load->model('Image_model');
        //     $folder = 'avatar';
        //     $image['image_name'] = $this->Image_model->upload_image('profileImages', $folder); //upload media of
        //     if(!empty($image['image_name']['error'])){

        //      echo json_encode(array('status' => 0,  "msg"=> $image['image_name']['error'])); die; 
        //     }
        // $data['avatar'] = $image['image_name'];
        // }

        
        $dial_code = trim($this->input->post('dial_code'),"+");
        $data['full_name'] = $this->input->post('name');
        $data['phone_number'] = $this->input->post('phone');
        $data['phone_dial_code'] = '+'.$dial_code;
        $data['country_code'] = $this->input->post('country_code');
        $data['updated_at'] = datetime();
        $user_id = $this->input->post('user_id');
        // echo "string";die();
        $update = $this->common_model->updateFields(USERS,$data,array('userID'=>$user_id));
       // lq();
        // pr($update);
        if($update!=TRUE){
            $response = array('status' => 0, 'msg' => 'Problem in updation');
            echo json_encode($response);die();
        }
        $response = array('status' => 1, 'msg' => 'User detail updated successfully');
        echo json_encode($response);die();

    }//end of function

    //update password
    function change_password(){
        $this->check_ajax_auth();
        $this->form_validation->set_rules('old_password', 'Old password', 'trim|required');
        $this->form_validation->set_rules('new_password', 'New password', 'trim|required');
        $this->form_validation->set_rules('confirm_password', 'Confirm password', 'trim|required');
        if ($this->form_validation->run($this) == FALSE) {
            $messages = (validation_errors()) ? validation_errors() : '';
            $response = array('status' => 0, 'msg' => $messages);
            echo json_encode($response);die();
        }
        if($this->input->post('new_password')!=$this->input->post('confirm_password')){
            $response = array('status' => 0, 'msg' => 'New password and confirm password does not match');
            echo json_encode($response);die();
        }

        $user_id = $this->input->post('user_id');

        $userdata = $this->common_model->is_data_exists(USERS,array('userID'=>$user_id));
        if(empty($userdata)){
             $response = array('status' => 0, 'msg' => 'Invalid user');
            echo json_encode($response);die();
        }

        $password = $userdata->password;
        if (!password_verify($this->input->post('old_password'), $password)) {
            $response = array('status' => 0, 'msg' => 'Invalid old password');
            echo json_encode($response);die();
        }

        $data['password'] =  password_hash(sanitize_input_text($this->input->post('new_password')), PASSWORD_DEFAULT);
        // $data['password'] = $this->input->post('old_password');
        $data['updated_at'] = datetime();
        // echo "string";die();
        $update = $this->common_model->updateFields(USERS,$data,array('userID'=>$user_id));
        // pr($update);
        if($update!=TRUE){
            $response = array('status' => 0, 'msg' => 'Problem in updation');
            echo json_encode($response);die();
        }
        $response = array('status' => 1, 'msg' => 'Password changed successfully');
        echo json_encode($response);die();

    }//end of function


    function upload_id(){
        // pr($_POST);
        $this->check_ajax_auth();
        $id = $_POST['user_id'];
        $is_data = $this->common_model->is_data_exists(USERS,array('userID'=>$id));

        if(empty($is_data)){
            echo json_encode(array('status'=>0,'message'=>'User is not exist'));die();
        }

        if(empty($_FILES['file_name'])){
            echo json_encode(array('status'=>0,'message'=>'Please select a file to upload'));die();
        }
        $ext = pathinfo($_FILES['file_name']['name']);

        $this->load->model('Image_model');
        $this->load->model('File_model');
        $folder = 'idproof';
        // pr($ext['extension']);
        $res['image_name'] = $this->Image_model->upload_image('file_name', $folder); //upload media of
        // if(in_array($ext['extension'], imageExtension())){
        //     // echo "string";die();
        //     $res['image_name'] = $this->Image_model->upload_image('file_name', $folder); //upload media of
        // }else{
        //     // echo "string";die();

        //     $res['image_name'] = $this->File_upload_model->upload_file_to_s3('file_name', $folder,$file_names='','doc'); //upload media of
        // }
        // $res['image_name'] = $this->File_model->upload_image('file_name', $folder); //upload media of
        // pr($res['image_name']);
        if(!empty($res['image_name']['error'])){

         echo json_encode(array('status' => 0, "msg"=> $res['image_name']['error'])); die; 
        }

        $data['id_proof_status'] = 1;
        $data['id_proof'] = $res['image_name'];
        $data['updated_at'] = datetime();

        $is_update = $this->common_model->updateFields(USERS,$data,array('userID'=>$id));

        if($is_update!=TRUE){
            echo json_encode(array('status'=>0,'message'=>'Problem in query'));die();
        }


        $for_image_data = $this->common_model->is_data_exists(USERS,array('userID'=>$id));

        $receipt_file = getenv('S3_ID_PROOF_MEDIUM').$for_image_data->id_proof;
        // $header_images = getenv('APP_FRONT_ASSETS_IMAGES') . 'header';
        // $content_images = getenv('APP_FRONT_ASSETS_IMAGES') . 'content';
        // if(!empty($for_image_data->receipt_file)){
        //     if(in_array($for_image_data->receipt_file_extension, imageExtension())){
        //         $receipt_file = getenv('S3_USER_RECEIPT_THUMB').$for_image_data->receipt_file;
        //     }elseif(in_array($for_image_data->receipt_file_extension, fileExtension())) {
        //         $receipt_file = $content_images.'/doc.png';
        //     }else{  
        //         $receipt_file = $content_images.'/pdf.png';
        //     }
        // }

        // $image_path = getenv('S3_USER_RECEIPT_DIR').$res['image_name'];
        echo json_encode(array('status'=>1,'message'=>'Id proof uploaded!','image'=>$receipt_file,'image_name'=>$res['image_name']));die();
    }//end of funtoion

    //function for delete id proof
    function delete_id(){
       $id = $this->input->post('id');
       
       $userdata = $this->common_model->is_data_exists(USERS,array('userID'=>$id));
       if(empty($userdata)){
             echo json_encode(array('status'=>0,'message'=>'Id proof not exist'));die();
       }

        $data['id_proof_status'] = 0;
        $data['id_proof'] = '';
        $is_update = $this->common_model->updateFields(USERS,$data,array('userID'=>$id));
        if($is_update!=TRUE){
            echo json_encode(array('status'=>0,'message'=>'Problem in query'));die();
        }

        echo json_encode(array('status'=>1,'message'=>'Id proof deleted!'));die();
    }//end of function


     function upload_id_new(){
        // pr($_POST);
        $this->check_ajax_auth();
        $id = $_POST['user_id'];
        $is_data = $this->common_model->is_data_exists(USERS,array('userID'=>$id));

        if(empty($is_data)){
            echo json_encode(array('status'=>0,'msg'=>'User is not exist'));die();
        }

        if(empty($_FILES['file_name'])){
            echo json_encode(array('status'=>0,'msg'=>'Please select a file to upload'));die();
        }
        $ext = pathinfo($_FILES['file_name']['name']);

        $this->load->model('Image_model');
        $this->load->model('File_model');
        $folder = 'idproof';
        // pr($ext['extension']);
        //image exist or not
        if (!empty($is_data->id_proof)) {
            // Delete image from folder
            $delete_image = $this->Image_model->delete_image('idproof', $is_data->id_proof);
        }
        $res['image_name'] = $this->Image_model->upload_image('file_name', $folder); //upload 
        if(!empty($res['image_name']['error'])){

         echo json_encode(array('status' => 0, "msg"=> $res['image_name']['error'])); die; 
        }

        $data['id_proof_status'] = 1;
        $data['id_proof'] = $res['image_name'];
        $data['updated_at'] = datetime();

        $is_update = $this->common_model->updateFields(USERS,$data,array('userID'=>$id));

        if($is_update!=TRUE){
            echo json_encode(array('status'=>0,'msg'=>'Problem in query'));die();
        }


        $for_image_data = $this->common_model->is_data_exists(USERS,array('userID'=>$id));

        $receipt_file = getenv('S3_ID_PROOF_MEDIUM').$for_image_data->id_proof;

        $response = array('status' => 1, 'msg' => 'Id proof uploaded!');
        echo json_encode($response);die();
        //echo json_encode(array('status'=>1,'message'=>'Id proof uploaded!','image'=>$receipt_file,'image_name'=>$res['image_name']));die();
    }//end of funtoion

}//end of class
