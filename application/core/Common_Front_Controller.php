<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* Common controller for Front(website) modules
* version: 2.0 (14-08-2018)
*/

require APPPATH . "third_party/MX/Controller.php"; //include MX library (HMVC library)

class Common_Front_Controller extends MX_Controller {

    public function __construct(){
        parent::__construct();
        $this->user_session_key = USER_SESS_KEY; //user session key
        $this->tbl_users = USERS; //users table
    }
    
    /**
     * User session authentication for pages
     * Modified in ver 2.0
     */
    public function check_user_session(){

        $page_slug = $this->router->fetch_method();
        $allowed_pages = array('signup','login','index'); //these pages/methods do not require user authentication
        $allowed_control = 'order'; //methods of this controller does not require authentication
        $current_control = $this->router->fetch_class(); // get current controller, class = controller
        
        if(!is_user_logged_in() && (in_array($page_slug,$allowed_pages)) && $current_control == $allowed_control){
            return TRUE; //session is empty and pages is not restricted
        }else{
            //either page is resticted or session exist
            if(!is_user_logged_in()){
            //pr($current_control);
                redirect('home'); //redirect to home/login if session not exit
            }
            //echo "string";die();
            //user session exists
            $user_sess_data = $_SESSION[$this->user_session_key]; //user session array
            $session_u_id = $user_sess_data['userID']; //user ID
            $where = array('userID'=>$session_u_id,'status'=>1); //status:0 means active 
            $check = $this->common_model->is_data_exists($this->tbl_users,$where);

            if($check===FALSE){
               //user is either deleted or is inactivated
               $this->logout(); //force logout
            }
            
            if(empty($page_slug)){
               return TRUE; //if slug is empty and session is set
            }
            
            $after_auth = array('signup','login', 'index'); //restrict access to these pages if session is set
          // pr($page_slug);
            if(in_array($page_slug,$after_auth) && $current_control == $allowed_control){
                redirect('order/current_order');
            }else{
                // $is_email_verified = $this->check_email_verification($session_u_id);
              $is_email_verified = $this->common_model->is_data_exists(USERS,array('userID'=>$session_u_id,'is_email_verified'=>1));
              // pr($_GET['jsonData']);
            if(empty($is_email_verified)){
                if(!empty($_GET['qoute']) && $_GET['qoute']=='true'){

                  redirect('auth/email_verification_page?user_id='.encoding($session_u_id).'&'.key_pair($_GET));
                }else{

                  redirect('auth/email_verification_page?user_id='.encoding($session_u_id));
                }
            }else{
                return TRUE; 
              }
            }
            
        } 
    }
    
    /**
     * User logout
     * Modified in ver 2.0
     */
    function logout($is_redirect=TRUE){
        
        // instead of destroying whole session data, we will just unset biz user session data
        unset($_SESSION[$this->user_session_key]); 
         
        if($is_redirect)
            redirect('home');  //redirect only when $is_redirect is set to TRUE
    }
    
    /**
     * User authentication for ajax
     * Modified in ver 2.0
     */
    public function check_ajax_auth(){
        
        //verify if request is xhr(ajax)
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        
        $failed_res = json_encode(array('status'=> -1,'msg'=>'Your session expired. Please login again.','url'=>base_url('auth/login')));
        if(!is_user_logged_in()){
            echo $failed_res; exit;
        }

        //user session exists
        $user_data = get_user_session_data();
        $where = array('userID'=>$user_data['userID'],'status'=>1); //status:0 means active 
        $check = $this->common_model->is_data_exists($this->tbl_users,$where);

        if($check===FALSE){
           //user is either deleted or is inactivated
           $this->logout(FALSE); //force logout- $is_redirect is FALSE here because we will redirect user from JS
           echo $failed_res; exit;
        }

        return TRUE; //all good
    }
}