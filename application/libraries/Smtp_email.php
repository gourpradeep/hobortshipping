<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * PHPMailer library - Send mail using SMTP
 * (To load composer's autoloader, make sure $config['autoload'] is set to TRUE 
 * in config file)
 * 
 **/

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Smtp_email {

    public function __construct() {
        
        $this->host = getenv('SMTP_HOST'); //server hostname
        $this->user_name =  getenv('SMTP_USERNAME');
        $this->pwd =  getenv('SMTP_PASSWORD');
        $this->port = getenv('SMTP_PORT'); //or 465(ssl), 25(Non-Encrypted) (depends on email server configuration)

        $this->from_mail =  getenv('SMTP_FROM_MAIL');
        $this->from_name = getenv('SMTP_FROM_NAME');

        $this->mail = new PHPMailer(true);  // Passing `true` enables exceptions
        $this->mail->From = $this->from_mail;
        $this->mail->FromName = $this->from_name;
    }

    //to override default 'from' email and name
    public function set_header($from_email, $from_name, $reply_to=FALSE) {
        
        $this->mail->setFrom($from_email, $from_name);

        //whether 'reply-to' should be added?
        if($reply_to)
            $mail->addReplyTo($from_email, $from_name);
    }
 
    
    public function send_mail($to, $subject = "", $message = "") {

        try {

            //$mail->SMTPDebug = 2;  // Enable verbose debug output
            $this->mail->isSMTP();         // Set mailer to use SMTP
            $this->mail->Host = $this->host;  // Specify main and backup SMTP servers
            $this->mail->SMTPAuth = true;      // Enable SMTP authentication
            $this->mail->Username = $this->user_name;  // SMTP username
            $this->mail->Password = $this->pwd;        // SMTP password
            $this->mail->SMTPSecure = 'tls';  // Enable TLS encryption, `ssl` also accepted
            $this->mail->Port = $this->port;  // TCP port to connect to

            //Recipients
            $this->mail->addAddress($to);   // Name is optional
            
            //Content
            $this->mail->isHTML(true);      // Set email format to HTML
            $this->mail->Subject = $subject;
            $this->mail->Body    = $message;
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $this->mail->send();
            return TRUE;
            //echo 'Message has been sent';

        } catch (Exception $e) {
            return 'Message could not be sent. Error: '. $this->mail->ErrorInfo;
        }
    } 
}