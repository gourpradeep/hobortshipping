
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * Omnivore API 1.0 wrapper Class
 * https://panel.omnivore.io/docs/api/1.0/
*/
class Tracking_more {

    public function __construct() {
        $this->CI =& get_instance();
       
        $this->headers = array(
			    'Content-Type:application/json',
                'Trackingmore-Api-Key:'.getenv('TRACKING_MORE_API_KEY').'' 
			);
    }

    //function for get company name from tracking more api
    function getCompanyName($data){
        $data = json_encode($data);
        // pr($this->headers);
    	$ch = curl_init('https://api.trackingmore.com/v2/carriers/detect');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // curl_setopt($ch, CURLOPT_URL, 'https://api.clevertap.com/1/upload');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $encodedResponse = curl_exec($ch);
        curl_close($ch);
        $response = json_decode( $encodedResponse );
        return $response;
    }//end of function

    //function for create tracking from tracking more api
    function createTracking($tracking_number,$carrier_code){
        // $data = json_encode($data);
        // pr($this->headers);
        $ch = curl_init('https://api.trackingmore.com/v2/trackings/:'.$carrier_code.'/:'.$tracking_number.'/:en');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // curl_setopt($ch, CURLOPT_URL, 'https://api.clevertap.com/1/upload');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $encodedResponse = curl_exec($ch);
        curl_close($ch);
        $response = json_decode( $encodedResponse );
        //pr($response);
        return $response;
    }//end of function

    //function for get tracking detail from tracking more api
    function getTrackingInfo($tracking_number,$carrier_code){

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.trackingmore.com/v2/trackings/'.$carrier_code.'/'.$tracking_number.'/en');
        curl_setopt($ch, CURLOPT_HTTPHEADER,  $this->headers);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $encodedResponse = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($encodedResponse);
        // pr($response);
        return $response;
    }//end of function

}//end of class