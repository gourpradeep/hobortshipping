<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Item extends Common_Back_Controller {
    function __construct() {
        parent::__construct();
    }
    //Item Type (Air Freight)
    public function item_type() {
        $this->check_admin_user_session();
        $data['page_title'] = "Item Type (Air Freight)";
        $this->load->admin_render('item/item_type', $data);
    }

    public function add_air_freight_item() {

        //validate ajax request
        $this->check_admin_ajax_auth();
        
        $this->load->model('item_type_model');
        $this->form_validation->set_rules('title', 'Title', 'required');
        if ($this->form_validation->run($this) == FALSE) {
            $messages = (validation_errors()) ? validation_errors() : '';
            $data = array('status' => 0, 'msg' => $messages);
        } else {
            $dataInsert['title'] = $this->input->post('title');
            $dataInsert['updated_at'] = datetime();
            $dataInsert['created_at'] = datetime();
            $result = $this->item_type_model->add_item_type(AIR_FREIGHT_ITEMS, $dataInsert);
            if ($result) {
                $data = array('status' => 1, 'msg' => 'Added successfully', 'url' => admin_url('item/item_type'));
            } else {
                $data = array('status' => 0, 'msg' => 'Item with this name is already added');
            }
        }
        echo json_encode($data);
    }
    
    public function air_freight_items_list() {
        $this->load->model('air_freight_items_list_model');
        //$id = $_POST['user_id'];
        $list = $this->air_freight_items_list_model->get_list();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $user) {
            $action = '';
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = display_placeholder_text($user->title);
            $action = '<div class="btn-group actionBtn">
                    <a class="btn btn-secondary dropdown-toggle drop-btn" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                 Select</a>
            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDivider">'; 
            $clk_edit =  "editFn('/item','edit_item_type','$user->airFreightItemID');" ;
             $action.= '<li><a href="javascript:void(0)" onclick="' . $clk_edit . '" class="dropdown-item"><i class="fa fa-edit text-default" aria-hidden="true"></i>Edit</a></li>';
            $clk_delete =  "deleteFn('".AIR_FREIGHT_ITEMS."','Delete','$user->airFreightItemID','/item/','delete_item_type');" ; 
            $action.= '<li><a href="javascript:void(0)" onclick="' . 
            $clk_delete . '" class="dropdown-item"><i class="fa fa-trash " aria-hidden="true"></i> Delete</a></li>';
            '</div>
                    </ul>
                    </div>';
            $row[] = $action;
            $data[] = $row;
        }
        $output = array("draw" => $_POST['draw'], "recordsTotal" => $this->air_freight_items_list_model->count_all(), "recordsFiltered" => $this->air_freight_items_list_model->count_filtered(), "data" => $data,);
        //output to json format
        echo json_encode($output);
    }

    //Delete Item Type
    public function delete_item_type() {

        $id = $_POST['id'];
        $where = array('airFreightItemID'=>$id);
        
        $dataexist = $this->common_model->is_data_exists(AIR_FREIGHT_ITEMS,$where);

        if(!empty($dataexist)){
            $data['status']=2;
            $delete = $this->common_model->updateFields(AIR_FREIGHT_ITEMS,$data,$where);
            $data=array('status'=>1,'url'=>'item/item_type','message'=>'Deleted successfully.');
            echo json_encode($data);
        }else{
            $data=array('status'=>0,'message'=>' Item not exist');
            echo json_encode($data);
        }
    }

    //Edit Item Type
    public function edit_item_type(){
        $id = $_POST['id'];
        $where= array('airFreightItemID'=>$id);
        $data['result']=$this->common_model->is_data_exists(AIR_FREIGHT_ITEMS, $where);
        $this->load->view('item/edit_item_type',$data);
    }

    //Edit Air Freight Item
    public function edit_air_freight_item() {

        //validate ajax request
        $this->check_admin_ajax_auth();

        $id = $_POST['id'];
        $this->form_validation->set_rules('title', 'Title', 'required');
        if ($this->form_validation->run($this) == FALSE) {
            $messages = (validation_errors()) ? validation_errors() : '';
            $data = array('status' => 0, 'msg' => $messages);
        } else {
           
            $where_id = array('airFreightItemID'=>$id);
            $update['title'] = $this->input->post('title');
            $update['updated_at'] = datetime();
            $where = array('title' => $update['title'], 'status' => 1,'airFreightItemID !=' => $id);
            $result = $this->common_model->is_data_exists(AIR_FREIGHT_ITEMS, $where);
            //pr($result);
            if (empty($result)) {
                $this->common_model->updateFields(AIR_FREIGHT_ITEMS,$update,$where_id);
                $data = array('status' => 1, 'msg' => 'Updated successfully', 'url' => admin_url('item/item_type'));

            } else {
                $data = array('status' => 0, 'msg' => 'Item with this name is already added');
            }
        }
            echo json_encode($data);
    }
} //End of class
