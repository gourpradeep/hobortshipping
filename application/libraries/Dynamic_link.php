
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dynamic_link {

    public function __construct() {
        $this->CI =& get_instance();
       
        $this->headers = array(
			    'Content-Type:application/json'
			);
    }

    //function for upload user info to claver tap
    function create_dynamic_link($link){
        //pr($link);
        $data = array(
                    'longDynamicLink'=>getenv('DYNAMIC_LINK_URL_PREFIX').'/?link='.$link,
                    'suffix'=>array('option'=>'SHORT')
                    );
        $data = json_encode($data);
       
    	$ch = curl_init(getenv('DYNAMIC_LINK_API_URL'));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $encodedResponse = curl_exec($ch);
        curl_close($ch);
        $response = json_decode( $encodedResponse );
        //pr($response);
        return $response;
    }//end of function

}//end of class