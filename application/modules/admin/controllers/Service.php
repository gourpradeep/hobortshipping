<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service extends Common_Back_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('service_model');
    }

    public function air_freight() {
        $this->check_admin_user_session();
        $data['page_title'] = "Air Freight";
        $this->load->admin_render('service/air_freight', $data);
    }

    public function sea_freight() {
        $this->check_admin_user_session();
        $data['page_title'] = "Sea Freight";
        $this->load->admin_render('service/sea_freight', $data);
    }

    public function courier_express_services() {
        $this->check_admin_user_session();
        $data['page_title'] = "Courier/Express Services";
        $this->load->admin_render('service/courier_express_services', $data);
    }

    //Add Air Freight Service Modal
    public function add_air_freight() {

        //validate ajax request
        $this->check_admin_ajax_auth();

        $this->form_validation->set_rules('weight_start_point', 'Weight Start Point', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required|numeric');

        if ($this->form_validation->run($this) == FALSE) {
            $messages = (validation_errors()) ? validation_errors() : '';
            $data = array('status' => 0, 'msg' => $messages);
            echo json_encode($data); die;
        }

        $start_point = $this->input->post('weight_start_point');
        $end_point = $this->input->post('weight_end_point');
        
        if( $end_point <= $start_point && empty($this->input->post('no_end_range')) ) {
            $err_msg = 'Weight End Point should be greater than Start point.';
            $data = array('status' => 0, 'msg' => $err_msg);
            echo json_encode($data); die;
        }

        $dataInsert['weight_from'] = $start_point;
        $dataInsert['weight_to'] = $end_point;
        $dataInsert['price'] = $this->input->post('price');
        $dataInsert['updated_at'] = datetime();
        $dataInsert['created_at'] = datetime();

        //check whether the given range is already added
        $check = $this->service_model->check_air_freight($dataInsert);
        if($check === false) {
            $data = array('status' => 0, 'msg' => 'This range is already added');
            echo json_encode($data); die;
        }

        if( !empty($this->input->post('no_end_range')) ) {
            //Check whether "No end range" record is already added
            $where_exists = array('weight_to' => NULL, 'status' => 1);
            $is_exists = $this->common_model->is_data_exists(AIR_FREIGHT_SERVICES, $where_exists);
            if($is_exists !== false) {
                $data = array('status' => 0, 'msg' => 'The "No end range" record is already added. To add new, first update the existing record');
                echo json_encode($data); die;
            }
        }

        //All validations passed, proceed to insert the record
        $last_id = $this->common_model->insertData(AIR_FREIGHT_SERVICES, $dataInsert);
        if(!$last_id) {
            $data = array('status' => 0, 'msg' => get_response_message(107) );
            echo json_encode($data); die;
        }

        $data = array('status' => 1, 'msg' => get_response_message(122), 'url' => admin_url('service/air_freight'));
        echo json_encode($data); die;
    }

    //Edit Air Freight Service Modal
    public function edit_air_freight_service() {

        //validate ajax request
        $this->check_admin_ajax_auth();

        $id = $_POST['id'];
        $this->form_validation->set_rules('weight_from', 'Weight Start Point', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required|numeric');
        if ($this->form_validation->run($this) == FALSE) {
            $messages = (validation_errors()) ? validation_errors() : '';
            $data = array('status' => 0, 'msg' => $messages);
            echo json_encode($data); die;
        }

        $start_point = $dataUpdate['weight_from'] = $this->input->post('weight_from');
        $end_point = $dataUpdate['weight_to'] = $this->input->post('weight_end_point');

        if( $end_point <= $start_point && empty($this->input->post('no_end_range')) ) {
            $err_msg = 'Weight End Point should be greater than Start point.';
            $data = array('status' => 0, 'msg' => $err_msg);
            echo json_encode($data); die;
        }

        //check whether this record exists in table
        $where_exists = array('airFreightServiceID' => $id, 'status' => 1);
        $is_exists = $this->common_model->is_data_exists(AIR_FREIGHT_SERVICES, $where_exists);
        if($is_exists === false) {
            $data = array('status' => 0, 'msg' => 'The record you are updating does not exist.');
            echo json_encode($data); die;
        }

        //check whether the given range is already added
        $check = $this->service_model->check_air_freight($dataUpdate, array($id));
        if($check === false) {
            $data = array('status' => 0, 'msg' => 'This range is already added');
            echo json_encode($data); die;
        }

        //Set weight_to NULL when no_end_range is ON
        if(!empty($this->input->post('no_end_range'))) {

            //Check whether "No end range" record is already added
            $where_exists = array('airFreightServiceID !=' => $id, 'weight_to' => NULL, 'status' => 1);
            $is_exists = $this->common_model->is_data_exists(AIR_FREIGHT_SERVICES, $where_exists);
            if($is_exists !== false) {
                $data = array('status' => 0, 'msg' => 'The "No end range" record is already added. To add new, first update the existing record');
                echo json_encode($data); die;
            }

            $dataUpdate['weight_to'] = NULL;
        }

        $dataUpdate['price'] = $this->input->post('price');
        $dataUpdate['updated_at'] = datetime();

        $update_where = array('airFreightServiceID' => $id);
        $result = $this->common_model->updateFields(AIR_FREIGHT_SERVICES, $dataUpdate, $update_where);

        $data = array('status' => 1, 'msg' => 'Updated successfully', 'url' => admin_url('service/air_freight'));
        echo json_encode($data);
    }

    //Air Freight list
    public function air_freight_list() {
        $this->load->model('air_freight_list_model');
        //$id = $_POST['user_id'];
        $list = $this->air_freight_list_model->get_list();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $user) {
            $action = '';
            $no++;
            $row = array();
            $row[] = $no;
            if ($user->weight_to == '') {
                $row[] = display_placeholder_text($user->weight_from . ' ' . 'kg' . ' ' . '+');
            } else {
                $row[] = display_placeholder_text($user->weight_from . '-' . $user->weight_to . '  ' . 'kg');
            }
            $row[] = display_placeholder_text('$' . $user->price);
            $action = '<div class="btn-group actionBtn">
                    <a class="btn btn-secondary dropdown-toggle drop-btn" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                 Select</a>
            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDivider">';
            $clk_edit = "editFn('/service','edit_air_freight','$user->airFreightServiceID');";
            $action.= '<li><a href="javascript:void(0)" onclick="' . $clk_edit . '" class="dropdown-item"><i class="fa fa-edit text-default" aria-hidden="true"></i>Edit</a></li>';
            $clk_delete = "deleteFn('" . AIR_FREIGHT_SERVICES . "','Delete','$user->airFreightServiceID','/service/','delete_air_freight_service');";
            $action.= '<li><a href="javascript:void(0)" onclick="' . $clk_delete . '" class="dropdown-item"><i class="fa fa-trash " aria-hidden="true"></i> Delete</a></li>';
            '</div>
                    </ul>
                    </div>';
            $row[] = $action;
            $data[] = $row;
        }
        $output = array("draw" => $_POST['draw'], "recordsTotal" => $this->air_freight_list_model->count_all(), "recordsFiltered" => $this->air_freight_list_model->count_filtered(), "data" => $data,);
        //output to json format
        echo json_encode($output);
    }

    //View of edit air_freight
    public function edit_air_freight() {
        $id = $_POST['id'];
        $where = array('airFreightServiceID' => $id);
        $data['result'] = $this->common_model->is_data_exists(AIR_FREIGHT_SERVICES, $where);
        $this->load->view('service/edit_air_freight', $data);
    }

    //Delete Air Service
    public function delete_air_freight_service() {
        $id = $_POST['id'];
        $where = array('airFreightServiceID' => $id);
        $dataexist = $this->common_model->is_data_exists(AIR_FREIGHT_SERVICES, $where);
        $data['status']=2;
        if (!empty($dataexist)) {
            $delete = $this->common_model->updateFields(AIR_FREIGHT_SERVICES, $data,$where);
            $data = array('status' => 1, 'url' => '', 'message' => 'Deleted successfully.');
            echo json_encode($data);
        } else {
            $data = array('status' => 0, 'message' => ' Air Freight not exist');
            echo json_encode($data);
        }
    }

    //Add services of Sea Freight
    public function add_sea_freight() {

        //validate ajax request
        $this->check_admin_ajax_auth();

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required|numeric');
        $this->form_validation->set_rules('type', 'Type', 'required');
        if ($this->form_validation->run($this) == FALSE) {
            $messages = (validation_errors()) ? validation_errors() : '';
            $data = array('status' => 0, 'msg' => $messages);
        } else {
            $dataInsert['title'] = $this->input->post('title');
            $dataInsert['price'] = $this->input->post('price');
            $dataInsert['type'] = $this->input->post('type');
            $dataInsert['updated_at'] = datetime();
            $dataInsert['created_at'] = datetime();
            //pr($dataInsert);
            $result = $this->service_model->add_sea_freight(SEA_FREIGHT_SERVICES, $dataInsert);
            if (!empty($result)) {
                $data = array('status' => 1, 'msg' => 'Added successfully', 'url' => admin_url('service/sea_freight'));
            } else {
                 $data = array('status' => 0, 'msg' => 'Item with this name is already added');
            }
        }
        echo json_encode($data);
    }

    //Sea Frright List
    public function sea_freight_list() {
        $this->load->model('sea_freight_list_model');
        //$id = $_POST['user_id'];
        $list = $this->sea_freight_list_model->get_list();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $user) {
            $action = '';
            $no++;
            $row = array();
            $row[] = $no;
            if ($user->type == 1) {
                $type = 'Light';
            } else {
                $type = 'Heavy';
            }
            $row[] = display_placeholder_text($user->title . ' ' . '(' . $type . ')');
            $row[] = display_placeholder_text('$' . $user->price);
            $action = '<div class="btn-group actionBtn">
                    <a class="btn btn-secondary dropdown-toggle drop-btn" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                 Select</a>
            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDivider">';
            $clk_edit = "editFn('/service','edit_sea_freight','$user->seaFreightServiceID');";
            $action.= '<li><a href="javascript:void(0)" onclick="' . $clk_edit . '" class="dropdown-item"><i class="fa fa-edit text-default" aria-hidden="true"></i>Edit</a></li>';
            $clk_delete = "deleteFn('" . SEA_FREIGHT_SERVICES . "','Delete','$user->seaFreightServiceID','/service/','delete_sea_freight_service');";
            $action.= '<li><a href="javascript:void(0)" onclick="' . $clk_delete . '" class="dropdown-item"><i class="fa fa-trash " aria-hidden="true"></i> Delete</a></li>';
            '</div>
                    </ul>
                    </div>';
            $row[] = $action;
            $data[] = $row;
        }
        $output = array("draw" => $_POST['draw'], "recordsTotal" => $this->sea_freight_list_model->count_all(), "recordsFiltered" => $this->sea_freight_list_model->count_filtered(), "data" => $data,);
        //output to json format
        echo json_encode($output);
    }

    public function edit_sea_freight() {
        $id = $_POST['id'];
        $where = array('seaFreightServiceID' => $id);
        $data['edit_sea_freight'] = $this->common_model->is_data_exists(SEA_FREIGHT_SERVICES, $where);
        $this->load->view('service/edit_sea_freight', $data);
    }

    public function edit_sea_freight_service() {

        //validate ajax request
        $this->check_admin_ajax_auth();

        $id = $_POST['id'];
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required|numeric');
        $this->form_validation->set_rules('type', 'Type', 'required');
        if ($this->form_validation->run($this) == FALSE) {
            $messages = (validation_errors()) ? validation_errors() : '';
            $data = array('status' => 0, 'msg' => $messages);
        } else {
            $where_id = array('seaFreightServiceID' => $id);
            $update['title'] = $this->input->post('title');
            $update['type'] = $this->input->post('type');
            $update['price'] = $this->input->post('price');
            $update['updated_at'] = datetime();
            $where = array('title'=>$update['title'],'type'=>$update['type'],'status'=>1,'seaFreightServiceID !='=>$id);
            $result = $this->common_model->is_data_exists(
                SEA_FREIGHT_SERVICES, $where);
            //pr($result);
            if (empty($result)) {
                $this->common_model->updateFields(SEA_FREIGHT_SERVICES,$update,$where_id);
                $data = array('status' => 1, 'msg' => 'Updated successfully', 'url' => admin_url('service/sea_freight'));

            } else {
                $data = array('status' => 0, 'msg' => 'Item with this name is already added');
            }
        }
            echo json_encode($data);
    }

    //Delete Sea Service
    public function delete_sea_freight_service() {
        $id = $_POST['id'];
        $where = array('seaFreightServiceID' => $id);
        $dataexist = $this->common_model->is_data_exists(SEA_FREIGHT_SERVICES, $where);
        if (!empty($dataexist)) {
            $data['status'] = 2;
            $delete = $this->common_model->updateFields(SEA_FREIGHT_SERVICES, $data, $where);
            $data = array('status' => 1, 'url' => '', 'message' => 'Deleted successfully.');
            echo json_encode($data);
        } else {
            $data = array('status' => 0, 'message' => ' Sea Freight not exist');
            echo json_encode($data);
        }
    }

    //Add Courier Service
    public function courier_service() {

        //validate ajax request
        $this->check_admin_ajax_auth();
        
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required|numeric');
        if ($this->form_validation->run($this) == FALSE) {
            $messages = (validation_errors()) ? validation_errors() : '';
            $data = array('status' => 0, 'msg' => $messages);
        } else {
            $dataInsert['title'] = $this->input->post('title');
            $dataInsert['price'] = $this->input->post('price');
            $dataInsert['updated_at'] = datetime();
            $dataInsert['created_at'] = datetime();
            //pr($dataInsert);
            $result = $this->service_model->courier_service(COURIER_SERVICES, $dataInsert);
            if ($result) {
                $data = array('status' => 1, 'msg' => 'Added successfully', 'url' => admin_url('service/courier_express_services'));
            } else {
               $data = array('status' => 0, 'msg' => ' Item with this name is already added.');
            }
        }
        echo json_encode($data);
    }

    //Courier/Express Services List
    public function courier_express_freight_list() {
        $this->load->model('courier_express_freight_list_model');
        //echo "string";
        //$id = $_POST['user_id'];
        $list = $this->courier_express_freight_list_model->get_list();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $user) {
            $action = '';
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = display_placeholder_text($user->title);
            $row[] = display_placeholder_text('$' . $user->price);
            $action = '<div class="btn-group actionBtn">
                    <a class="btn btn-secondary dropdown-toggle drop-btn" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                 Select</a>
            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDivider">';
            $clk_edit = "editFn('/service','edit_courier_freight','$user->courierServiceID');";
            $action.= '<li><a href="javascript:void(0)" onclick="' . $clk_edit . '" class="dropdown-item"><i class="fa fa-edit text-default" aria-hidden="true"></i>Edit</a></li>';
            $clk_delete = "deleteFn('" . COURIER_SERVICES . "','Delete','$user->courierServiceID','/service/','delete_courier_service');";
            $action.= '<li><a href="javascript:void(0)" onclick="' . $clk_delete . '" class="dropdown-item"><i class="fa fa-trash " aria-hidden="true"></i> Delete</a></li>';
            '</div>
                    </ul>
                    </div>';
            $row[] = $action;
            $data[] = $row;
        }
        $output = array("draw" => $_POST['draw'], "recordsTotal" => $this->courier_express_freight_list_model->count_all(), "recordsFiltered" => $this->courier_express_freight_list_model->count_filtered(), "data" => $data,);
        //output to json format
        echo json_encode($output);
    }

    public function edit_courier_freight() {
        $id = $_POST['id'];
        $where = array('courierServiceID' => $id);
        $data['result'] = $this->common_model->is_data_exists(COURIER_SERVICES, $where);
        $this->load->view('service/edit_courier_express_services', $data);
    }

    //Edit Air Freight Service
    public function edit_courier_service() {

        //validate ajax request
        $this->check_admin_ajax_auth();

        $id = $_POST['id'];
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required|numeric');
        if ($this->form_validation->run($this) == FALSE) {
            $messages = (validation_errors()) ? validation_errors() : '';
            $data = array('status' => 0, 'msg' => $messages);
        } else {
            $where_id = array('courierServiceID'=>$id);
            $update['title'] = $this->input->post('title');
            $update['price'] = $this->input->post('price');
            $update['updated_at'] = datetime();
            $where = array('title'=>$update['title'],'status'=>1,'courierServiceID !='=>$id);
            $result = $this->common_model->is_data_exists(COURIER_SERVICES, $where);
            if (empty($result)) {
                $this->common_model->updateFields(COURIER_SERVICES,$update,$where_id);
                $data = array('status' => 1, 'msg' => 'Updated successfully', 'url' => admin_url('service/courier_express_services'));

            } else {
                $data = array('status' => 0, 'msg' => 'Item with this name is already added');
            }

        }
            echo json_encode($data);
    }

    //Delete Courier Service
    public function delete_courier_service() {
        $id = $_POST['id'];
        $where = array('courierServiceID' => $id);
        $dataexist = $this->common_model->is_data_exists(COURIER_SERVICES, $where);
        if (!empty($dataexist)) {
            $data['status'] = 2;
            $delete = $this->common_model->updateFields(COURIER_SERVICES, $data, $where);
            $data = array('status' => 1, 'url' => '', 'message' => 'Deleted successfully');
            echo json_encode($data);
        } else {
            $data = array('status' => 0, 'message' => ' Courier Service not exist');
            echo json_encode($data);
        }
    }
} //End of class
