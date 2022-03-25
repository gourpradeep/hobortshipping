<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ticket extends Common_Back_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('smtp_email');
        $this->load->library('twilio');
        $this->load->library('dynamic_link');
    }

    public function index() {
        $this->check_admin_user_session();
        $data['page_title'] = "Tickets";
        $this->load->admin_render('ticket/list', $data);
    }

    //get_ticket_list
    public function get_ticket_list(){
        $this->load->model('Ticket_model');

        $status = $this->input->post('ticketStatus');
        if($status!=""){
            $this->Ticket_model->set_data(array('tickets.status'=>$status));
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
                    $row[] = '<p id="badge" class="badge bg-warning">Pending</p>';
                    break;
                case '1':
                    $row[] = '<p id="badge" class="badge bg-info">In Review</p>';
                    break;
                case '2':
                    $row[] = '<p id="badge" class="badge bg-success">Completed</p>';
                    break;    
            }
            // $row[] = ($ticket->status=='1')? '<p id="badge" class="badge bg-warning">Pending</p>' : '<p id="badge" class="badge bg-success">Completed</p>';
            $row[] = date('d M Y',strtotime($ticket->created_at));

            $detail = base_url().'admin/ticket/ticket_detail/'.$encoded;

            $action = '<span class="detail-icon"><a href="'.$detail.'"><i class="fa fa-eye "></i></a></span>';
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
        $this->check_admin_user_session();
        $id = $this->uri->segment(4);
        if($id){
            $this->load->model('Ticket_model');

            $id = decoding($id);
            $data['page_title'] = 'Ticket Detail';
            $data['detail'] = $this->Ticket_model->ticket_detail($id);

            // pr($data['detail']);
            $this->load->admin_render('admin/ticket/detail', $data);
        }else{
            redirect('ticket');
        }
    }

    public function add_comment(){
        $this->check_admin_ajax_auth();
        $this->form_validation->set_rules('ticket_id', 'Ticket Id', 'trim|required');

        if($this->input->post('is_comment_text')=='1'){
            $this->form_validation->set_rules('comment', 'Comment', 'trim|required');
        }

        if ($this->form_validation->run($this) == FALSE) {
            $messages = (validation_errors()) ? validation_errors() : '';
            $response = array('status' => 0, 'message' => $messages);
            echo json_encode($response);die();
        }

        // check status
        $checkTicket= $this->common_model->is_data_exists(TICKETS,array('ticketID'=>$this->input->post('ticket_id')));
        //pr($checkTicket);

        $checkStatus = $this->common_model->is_data_exists(TICKET_COMMENTS,array('ticket_id'=>$this->input->post('ticket_id')));
        //pr($checkStatus);

        $checkUser = $this->common_model->is_data_exists(USERS,array('userID'=>$checkTicket->created_by_id));
        //pr($checkUser);

        if($checkStatus==false){

            if($checkTicket->status=='0'){

                
                $this->common_model->updateFields(TICKETS,array('status'=>1),array('ticketID'=>$this->input->post('ticket_id')));

            }
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

        $datainsert = array(
            'commented_by_id'=> NULL,
            'ticket_id'=> $this->input->post('ticket_id'),
            'comment'=> ($this->input->post('is_comment_text')=='0') ? NULL : $this->input->post('comment'),
            'created_at'=> datetime(),
            'updated_at'=> datetime()
        );
        $checkTicketCommit = $this->common_model->is_data_exists(TICKETS,array('ticketID'=>$this->input->post('ticket_id')));

        $checkUser = $this->common_model->is_data_exists(USERS,array('userID'=>$checkTicketCommit->created_by_id));
        $insert_id = $this->common_model->insertData(TICKET_COMMENTS, $datainsert);
        $encoded = encoding($checkTicket->ticketID);
        $link = base_url().'ticket/ticket_detail/'.$encoded;
        //$link = $this->dynamic_link->create_dynamic_link($dynamic_link);
        //pr($link->shortLink);
        //$text_message = $this->twilio->send_sms('+91'.$checkUser->phone_number,$datainsert['comment'].'.'.' You see this comment on website using this link :- '.$link->shortLink);

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
            //pr($datainsertAttechment['attachment_file']);

            $notification_email  =  $this->ticket_notification_email($checkUser->email,$checkUser->full_name,$checkTicket->ticketID ,$checkTicket->title,$datainsert['comment'],$datainsertAttechment['attachment_file'],$link);

            $data = array('status' => 1, 'message' => 'Ticket comment successfully added');
        }else{
            $data = array('status' => 0, 'message' => 'Ticket comment not added');
        }

        echo json_encode($data); die();
    }

    function comment_list_ajax(){

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
        $html_receive = $this->load->view('ticket/comments',$dataView,true);
        $response = array('status'=>1,'html_receive'=>$html_receive,'count'=>$dataView['total_count'],'is_next'=>$is_next,'new_offset'=>$new_offset);
        //flag for no record 
        $no_record=1;
        if(empty($dataView['comment_list'])){
            $no_record = 0;
        }
        $response['no_record'] = $no_record;
        echo json_encode($response);die;  
    }

    function ticket_status(){
        $this->check_admin_ajax_auth();
        $dataUpdate['status'] = $this->input->post('ticket_status');
        $dataUpdate['updated_at'] = datetime();
        $id = $this->input->post('ticket_id');

        $update_where = array('ticketID' => $id);
        $result = $this->common_model->updateFields(TICKETS, $dataUpdate, $update_where);

        $data = array('status' => 1, 'message' => 'Updated successfully');
        echo json_encode($data);

    }

    private function ticket_notification_email($email,$first_name,$ticket_id,$title,$comment,$image,$link) {
        if ($image == '') {
            $image_url = '';
        }
        else{
            $image_url = getenv('S3_COMMENT_ATTACHMENT_DIR') . $image;
        }
        $subject ='Ticket #'.$ticket_id.' - '.$title;
        $data['name'] = $first_name;
        $data['email'] = $email;
        $data['title'] = $title;
        $data['ticket_id'] = $ticket_id;
        $data['comment'] = $comment;
        $data['image'] = $image_url;
        $data['ticket_link'] = $link;
        //pr($data);
        $message = $this->load->view('emails/ticket_mail',$data,TRUE);
        $response = $this->smtp_email->send_mail($email,$subject,$message);
        return $response;
    }
}
