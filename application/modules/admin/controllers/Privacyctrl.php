<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Privacyctrl extends Common_Back_Controller {

    function __construct() {
        parent::__construct();
        $this->check_admin_user_session();
        $this->load->model('option_model');
    }

    /**
     * @method index
     * @description listing display
     * @return array
     */
    
    public function index() {
    $data['page_title'] =  'Privacy Policy'  ;
    $data['result'] = $this->option_model->get_option('privacy_content');
    $this->load->admin_render('content/privacy', $data, '');
    }

    public function privacy(){
    
    	$option_value=$this->input->post('editor1');
        $this->option_model->update_option('privacy_content',$option_value
    	);
        redirect('admin/Privacyctrl');
    }
}



