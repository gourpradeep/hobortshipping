<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// echo "string";die();
use Aws\Common\Exception\MultipartUploadException;
use Aws\S3\MultipartUploader;
use Aws\S3\S3Client;
use Aws\S3\ObjectUploader;

class Receipt_download extends Common_Front_Controller {
public function __construct() {

        parent::__construct();
        $this->load->helper('string');
        $this->s3Client = S3Client::factory([
            'credentials' => [
            'key' => getenv('S3_ACCESS_KEY'), //AWS_BUCKET_KEY
            'secret' => getenv('S3_ACCESS_SECRET')
            ],
            'version' => 'latest',
            'region'  => getenv('S3_BUCKET_REGION')
        ]);
    }
    
   

    function download_reciept() {
        // echo "string";die();
        $object = $this->s3Client->getObject(array(
    'Bucket' => getenv('S3_BUCKET_NAME'),
    'Key'    => 'uploads/receipt/'.$_GET['image_name']   
    ));
        // pr($object['Body']);
    header('Content-Description: File Transfer');
    //this assumes content type is set when uploading the file.
    header('Content-Type: ' . $object['ContentType']);
    header('Content-Disposition: attachment; filename=' . $_GET['image_name']);
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');

    //send file to browser for download. 
    echo $object['Body'];
    }
        

}//end of class
