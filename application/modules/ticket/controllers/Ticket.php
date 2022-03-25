<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Twilio\Rest\Client;

class Ticket extends Common_Front_Controller {
    function __construct() {
        parent::__construct();
        $this->load->library('tracking_more');
        $this->load->model('File_upload_model');
    }

    public function index() {
        $this->check_user_session();
        $data['page_title'] = 'Ticket';
        $this->load->front_render('ticket', $data);
    }

    public function add_ticket() {
        $this->check_user_session();
        $this->form_validation->set_rules('title', 'Title', 'trim|required');
        $this->form_validation->set_rules('description', 'Description', 'trim|required');

        if ($this->form_validation->run($this) == FALSE) {
            $messages = (validation_errors()) ? validation_errors() : '';
            $response = array('status' => 0, 'message' => $messages);
            echo json_encode($response);die();
        }

        $user_id = $this->session->userdata()['app_user_sess']['userID'];

        $datainsert = array(
            'created_by_id'=> $user_id,
            'title'=> $this->input->post('title'),
            'description'=> $this->input->post('description'),
            'created_at'=> datetime(),
            'updated_at'=> datetime()
        );

        $insert_id = $this->common_model->insertData(TICKETS, $datainsert);
       // pr($insert_id);

        if($insert_id){
            $data = array('status' => 1, 'message' => 'Ticket successfully generated', 'url' => base_url('ticket/ticket'));

        }else{
            $data = array('status' => 0, 'message' => 'Ticket not generated');


        }

        echo json_encode($data); die();
    }

    //get_ticket_list
    public function get_ticket_list(){
        $this->check_user_session();
        $user_id = $this->session->userdata()['app_user_sess']['userID'];
        $this->load->model('Ticket_model');

        $status = $this->input->post('ticketStatus');
        if($status!=""){
            $this->Ticket_model->set_data(array('created_by_id'=>$user_id,'tickets.status'=>$status));
        }else{
            $this->Ticket_model->set_data(array('created_by_id'=>$user_id));
        }

        $list = $this->Ticket_model->get_list();
        // pr($list);

        $data = array();
        $no = $_POST['start'];
        foreach ($list as $ticket) {
            $encoded = encoding($ticket->ticketID);
            $action = '';
            $no++;
            $row = array();
            $row[] = display_placeholder_text('#'.$ticket->ticketID);
            $row[] = display_placeholder_text($ticket->title);
            $row[] = the_excerpt($ticket->description);
            switch ($ticket->status) {
                case '0':
                    $row[] = '<span class="label label-warning">Pending</span>';
                    break;
                case '1':
                    $row[] = '<span class="label label-info">In Review</span>';
                    break;
                case '2':
                    $row[] = '<span class="label label-success">Completed</span>';
                    break;    
            }
            // $row[] = ($ticket->status=='1')? '<span class="label label-warning">Pending</span>' : '<span class="label label-success">Completed</span>';
            $row[] = date('d M Y',strtotime($ticket->created_at));

            $detail = base_url().'ticket/ticket_detail/'.$encoded;

            //$action = '<span class="detail-icon"><a href="'.$detail.'"><i class="fa fa-eye "></i></a></span>';
            $action = ' <td class="text-right">
                                        <div class="recHisAction">
                                            <a href="'.$detail.'" class="icView icCircle"><span data-toggle="tooltip" class="material-icons-outline md-visibility" title="Details"></span></a>
                                        </div>
                                    </td>';
            $row[] = $action;
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'], 
            "recordsTotal" => $this->Ticket_model->count_all(), 
            "recordsFiltered" => $this->Ticket_model->count_filtered(), 
            "data" => $data
        );
        //output to json format
        echo json_encode($output);
    }

    public function ticket_detail(){
        if(empty($this->session->userdata()['app_user_sess'])){
            redirect('auth/login');
        }
        $id = $this->uri->segment(3);
        if($id){
            $this->load->model('Ticket_model');

            $id = decoding($id);
            $data['page_title'] = 'Ticket Detail';
            $data['detail'] = $this->Ticket_model->ticket_detail($id);
            $this->load->front_render('ticket_detail', $data);
        }else{
            redirect('ticket/ticket');
        }
    }

    public function add_comment(){
        $this->check_ajax_auth();
        $this->form_validation->set_rules('ticket_id', 'Ticket Id', 'trim|required');

        if($this->input->post('is_comment_text')=='1'){
            $this->form_validation->set_rules('comment', 'Comment', 'trim|required');
        }

        if ($this->form_validation->run($this) == FALSE) {
            $messages = (validation_errors()) ? validation_errors() : '';
            $response = array('status' => 0, 'message' => $messages);
            echo json_encode($response);die();
        }

        if($this->input->post('is_comment_text')=='0'){

            if(!empty($_FILES['comment_attechment']['name'])){

                $mime_type = $_FILES['comment_attechment']['type'];
                $file_extension = pathinfo($_FILES['comment_attechment']['name'], PATHINFO_EXTENSION);

                if(in_array($file_extension,array('png','jpeg','jpg','gif'))){ // upload images

                    $this->load->model('image_model'); //Load image model
                    //if image not empty set it for image 
                    $upload_img = $this->image_model->upload_image('comment_attechment', 'comment_attechment');

                    //check for error
                    if( array_key_exists("error", $upload_img) && !empty($upload_img['error'])){

                        $data=array('status'=>0,'message'=>$upload_img['error']);
                        echo json_encode($data);die(); 
                    }
                    //check image name exist
                    if($upload_img){
                        $comment_attechment = $upload_img;
                    }

                }else{ // upload files

                    $this->load->model('file_upload_model');

                    $upload_file = $this->file_upload_model->upload_file_to_s3('comment_attechment', 'comment_attechment');

                    //check for error
                    if( array_key_exists("error", $upload_file) && !empty($upload_file['error'])){

                        $data=array('status'=>0,'message'=>$upload_file['error']);
                        echo json_encode($data);die(); 
                    }
                    //check image name exist
                    if($upload_file){
                        $comment_attechment = $upload_file;
                    }

                }

            }else{
                 $data=array('status'=>0,'message'=>'Comment attechment is required.');
                    echo json_encode($data);die(); 
            }

        }

        $user_id = $this->session->userdata()['app_user_sess']['userID'];

        $datainsert = array(
            'commented_by_id'=> $user_id,
            'ticket_id'=> $this->input->post('ticket_id'),
            'comment'=> ($this->input->post('is_comment_text')=='0') ? NULL : $this->input->post('comment'),
            'created_at'=> datetime(),
            'updated_at'=> datetime()
        );

        $insert_id = $this->common_model->insertData(TICKET_COMMENTS, $datainsert);

        if($insert_id){

             if($this->input->post('is_comment_text')=='0'){
                 $datainsertAttechment = array(
                    'ticket_comment_id'=> $insert_id,
                    'attachment_file'=> $comment_attechment,
                    'mime_type'=> $mime_type,
                    'file_extension'=> $file_extension,
                    'created_at'=> datetime()
                );

                $this->common_model->insertData(TICKET_COMMENT_ATTACHMENTS, $datainsertAttechment);
            }

            $data = array('status' => 1, 'message' => 'Ticket comment successfully added');
        }else{
            $data = array('status' => 0, 'message' => 'Ticket comment not added');
        }

        echo json_encode($data); die();
    }

    function comment_list_ajax(){

        $this->check_user_session();
        $this->load->model('comment_model');

        $limit    = 10;
        $is_next  = 0;
        //get offset
        $offset  = $this->input->post('offset');
        //set new offset
        $new_offset    = $limit+$offset; 
        //set limit and offset 
        $data['limit']   =  $limit;
        $data['offset']  =  $offset;
        $data['ticketId']  =  $this->input->post('ticketId');;
        // get total count
        $dataView['total_count'] = $this->comment_model->getCommentList($data,true);
        $dataView['comment_list'] = $this->comment_model->getCommentList($data,false);
        $dataView['admin'] = $this->comment_model->get_admin_detail();
        //check for load more btn

        // pr($dataView);
        if($dataView['total_count'] > $new_offset){
            $is_next =  1; 
        }

        //set view in key with data
        $html_receive = $this->load->view('comment_show',$dataView,true);
        $response = array('status'=>1,'html_receive'=>$html_receive,'count'=>$dataView['total_count'],'is_next'=>$is_next,'new_offset'=>$new_offset);
        //flag for no record 
        $no_record=1;
        if(empty($dataView['comment_list'])){
            $no_record = 0;
        }
        $response['no_record'] = $no_record;
        echo json_encode($response);die;  
    }   
}//end of class
