<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Termsctrl extends Common_Back_Controller {

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
    $data['page_title'] =  'Terms & conditions'  ;
    $data['result'] = $this->option_model->get_option('terms_content');
    $this->load->admin_render('content/terms', $data, '');

    }

    public function terms(){
        $option_value=$this->input->post('editor1');
		$this->option_model->update_option('terms_content',$option_value
		);
    
		redirect('admin/termsctrl');
    }
}



