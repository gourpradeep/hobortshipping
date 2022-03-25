<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    /** check login  */
    function isUserLogin($email, $password, $table) {

        $this->db->select("*");
        $this->db->where('email', $email);
        $query = $this->db->get($table);
        if (!$query) {
            $this->output_db_error(); //500 error
            
        }
        $user = $query->row();
        if (empty($user)) {
            return FALSE;
        }
        
        $id = $user->userID;

        if (password_verify($password, $user->password)) {
            if($user->status==0){
                return 'UI';
            }
            $this->session_create($id);
            return TRUE;
        } else {
            return FALSE;
        }
    }
    //END OF FUNCTION..
    
    /**  Create sesion for checking user login or not*/
    function session_create($id) {
        $sql = $this->db->select('*')->where(array('userID' => $id))->get(USERS);
        if (!$sql) {
            $this->output_db_error(); //500 error
            
        }
        $user = $sql->row();
        if (empty($user)) {
            return FALSE;
        }
        $user = $sql->row();
        // if( $user->avatar != "" && $user->avatar != null ) {
        //     $session_data['avatar'] = getenv('S3_USER_AVATAR_THUMB').$user->avatar;
        // }else {
        $session_data['avatar'] = getenv('S3_USER_PLACEHOLDER_AVATAR');
        // }
        $session_data['userID'] = $user->userID;
        $session_data['emailId'] = $user->email;
        $session_data['name'] = $user->full_name;
        $session_data['isLogin'] = TRUE;
        $_SESSION['is_user_logged_in'] = 1;
        $_SESSION['email_verified_check'] = 1;
        $_SESSION[USER_SESS_KEY] = $session_data;

    //    pr($_SESSION[USER_SESS_KEY]);
        //pr($session_data);
        return TRUE;
    }
}
