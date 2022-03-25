<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
use \Firebase\JWT\JWT;
/**
 * Common controller for service modules
 * REST API authentication and authorization Class
 * @version  2.2 (01-07-2020)
 * 
*/
class Common_Service_Controller extends REST_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('response_message'); //load api response message helper
        //$this->load->model('notification_model'); //load push notification model

        $this->load_headers(); // Get Headers
    }

    /**
     * Get Headers of request prior authentication
     * @since    2.1
     */
    public function load_headers() {
        $this->request_headers = $this->_head_args;
    }
    
    /**
     * Authenticate API request
     * @since    2.1
     * @param    $auth_optional  (Whether authentication needs to be done or not)
     *           (Default: false)
     */
    public function verify_request( $auth_optional = false ) {
        
        $this->authData = '';
        $headers = $this->request_headers;
        
        /*
         * Convert all keys to lower case as some server manipulates header keys
         * Header keys should always be treated as case insensitive
         */
        $headers = array_change_key_case($headers, CASE_LOWER);
        
        if (!isset($headers['device_id']) || !isset($headers['device_type']) || !isset($headers['timezone'])) {
            $this->auth_error_msg(HEADERS_MISSING, get_response_message(116), BAD_REQUEST);
        }
        
        extract($headers);
        /*
        * Check device_type value
        */
        $supported_device_types = array(1, 2, 3); //1:iOs, 2:Android, 3:Web/Desktop
        if(!in_array($device_type, $supported_device_types)) {
           $this->auth_error_msg(INVALID_HEADER_VALUE, get_response_message(116), BAD_REQUEST);
        }

        //authenticate user
        $auth_token = $this->get_bearer_token();

        if ($auth_optional === true && empty($auth_token)) {
            return TRUE; //skip authentication if $auth_optional is set to true
        }

        if( empty($authToken) ) {
            $this->auth_error_msg();
        }
        
        //Validate token
        try {
            $decoded =  JWT::decode($authToken, getenv('JWT_SECRET_KEY'), array('HS256'));
            $user_id = $decoded->data->userId;
            $device_id = $decoded->data->device_id;
        } catch ( \Firebase\JWT\ExpiredException $e ) {
            $this->auth_error_msg(SESSION_EXPIRED, get_response_message(115), BAD_REQUEST);
        } catch ( Exception $e ) {
            $this->auth_error_msg();
        }
        
        //At this point authentication is successfully done
        //Get authenticated User data
        $userAuthData = $this->general_model->getUserDetail($user_id,$device_id);

        if(empty($userAuthData)){
            
            $this->auth_error_msg(USER_NOT_FOUND, get_response_message(115), BAD_REQUEST);
        }

        if($userAuthData->status != 1) {
            $this->auth_error_msg(ACCOUNT_DISABLED, get_response_message(115), BAD_REQUEST);
        } 
        
        //user authenticated successfully
        $this->authData = $userAuthData;
        return TRUE;
    }
    
    /**
     * Returns request authentication error message
     * @since    2.0
     */
    public function auth_error_response($error_type='ACCESS_DENIED', $msg='Invalid Authorisation', $status_code=403, $data='') {
        $this->response(['status' => FAIL, 'status_code' => $status_code,'error_type' => $error_type, 'message' => $msg, "data" => $data ], $status_code);
    }

    /**
     * Returns error response for an API request
     * @since    2.1
     */
    public function error_response($msg='Invalid param value', $error_type='INVALID_PARAM', $status_code=400, $data='') {

        if(empty($data)) {
            $data=(object)[];
        }

        $this->response(['status' => FAIL, 'status_code' => $status_code,'error_type' => $error_type, 'message' => $msg, "data" => $data ], $status_code);
    }

    /**
     * Returns success response for an API request
     * @since    2.1
     */
    public function success_response($msg='', $data='', $status_code=OK) {

        if(empty($data)) {
            $data=(object)[];
        }

        $this->response(['status' => SUCCESS, 'status_code' => $status_code,'message' => $msg, "data" => $data ], $status_code);
    }

    /** 
     * Generate JWT
     * @param    int $user_id Current User ID
     * @param    array $user_entity Can be any entity related to user
     *           (user type, email, device ID etc)
     * @param    int $expire_time  Expire time in secs (Default 1hour)
     * @return   string JWT
     * @since    2.1
     * 
    */
    protected function generate_token($user_id, $user_entity=array(), $expire_time=3600) {
        
        $issuedAt   = time(); //current timestamp
        $notBefore  = $issuedAt; //Token to be not validated before given time
        $expire     = time() + $expire_time; //Adding offset time to current timestamp

        $data_arr = [];
        $data_arr['user_id'] = $user_id;
        if(!empty($user_entity)) {
            // Can be any entity related to user(user type, email, device ID etc)
            extract($user_entity);
            $data_arr['user_type'] = $user_type;
            $data_arr['device_id'] = $device_id;
        }
        
        $data = [
            'iat'  => $issuedAt,   // Issued at: time when the token was generated
            'jti'  => getenv('JWT_TOKEN_ID'), // Json Token Id: an unique  identifier for the token
            'iss'  => getenv('SERVER_NAME'), // Issuer (example.com)
            'nbf'  => $notBefore,        // Not before
            'exp'  => $expire,           // Expire time
            'data' => $data_arr
        ];

        $jwt = JWT::encode( $data, getenv('JWT_SECRET_KEY'));
        return $jwt;
    }

}//End Class