<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Twilio API wrapper: Send SMS to phone number
 * 
*/

use Twilio\Rest\Client;  //require SDK to be insatlled via composer
class Twilio {

    public function __construct () {
        $this->ci =& get_instance();
    }

    //Sends a SMS to specified number
    public function send_sms($to_number, $text) {
        //pr($link);
        try {
            // A Twilio number you own with SMS capabilities
            $twilio_number = getenv('TWILIO_NUMBER');
            $twilio_id = getenv('TWILIO_SID');
            $twilio_token = getenv('TWILIO_TOKEN');
            $client = new Client($twilio_id,$twilio_token);
            //pr($client);
            $client->messages->create(
                // Where to send a text message
                $to_number,
                array(
                    'from' => $twilio_number,
                    'body' => $text
                )
            );
            //pr($to_number);
            return true;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}