<?php
/**
* Handles image upload, resize, crop and rotate
*
* @package       CodeIgniter
* @subpackage    Models
* @version       3.3.0
* @date          08-02-2020
* @author        Mindiii
* 
*/

use Aws\Common\Exception\MultipartUploadException;
use Aws\S3\MultipartUploader;
use Aws\S3\S3Client;
use Aws\S3\ObjectUploader;

class File_model extends CI_Model {
    
    /**
     * Constructor
     *
     * @since     2.0.0
     * @access	  public
     * 
     */
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
    
    function upload_image($image, $folder, $path = FALSE){

        $this->make_dirs($folder);
        $realpath = $path ? '../uploads/' : 'uploads/';
        $allowed_types = "doc|docx|txt|wpd|pdf";
        $file_name = random_string('alnum', 16); //generate random string for image name
        $config = array(
            'upload_path' => $realpath . $folder,
            'allowed_types' => $allowed_types,
            'max_size' => "10480", // File size 204.8 limitation, initially w'll set to 10mb (Can be changed)
            'file_name' => $file_name,
            'overwrite' => FALSE,
            'remove_spaces' => TRUE,
            'quality' => '100%',
        );
        $this->load->library('upload'); //upload library
        $this->upload->initialize($config);
        if (!$this->upload->do_upload($image)){
            $error = array(
                'error' => $this->upload->display_errors()
            );
            return $error; //error in upload
        }

        // video uploaded successfully - proceed to create resized copies

        $video_data = $this->upload->data(); //get uploaded data
        $this->load->library('image_lib'); //image library
        //upload to AWS S3 bucket?
        $bucket_upload = $this->config->item('bucket_upload');
        if(isset($bucket_upload) && $bucket_upload===TRUE) {

            $upload_path = $realpath.$folder.'/';
            $image_name = $video_data['file_name'];
            $source_img_path = $video_data['full_path'];

            //unlink param here is FALSE, because for orignial image it will be later used to create resizes. So we will unlink from application uploads folder after resize/crop process is completed 
            $s3_result = $this->aws_bucket_upload($source_img_path, $upload_path, $image_name, FALSE);

            if($s3_result!==TRUE) {
                $error = array('error' => 'Problem uploading image. Please try again');
                return $error; //error in upload
            }
        }

        $real_path = realpath(FCPATH . $realpath . $folder);
        $resize['source_image'] = $video_data['full_path'];
        $resize['maintain_ratio'] = FALSE;
        $resize['quality'] = '100%';
        $this->image_lib->initialize($resize);
        $this->image_lib->resize();
        $this->image_lib->clear(); //clear memory
        return $video_data['file_name'];
        

    }//end of function


    function make_dirs($folder='', $mode=DIR_WRITE_MODE, $defaultFolder='uploads/') {

        if(!@is_dir(FCPATH . $defaultFolder)){
            mkdir(FCPATH . $defaultFolder, $mode);
        }
        
        if(!empty($folder)){

            if(!@is_dir(FCPATH . $defaultFolder . '/' . $folder)) {
                mkdir(FCPATH . $defaultFolder . '/' . $folder, $mode,true);
            }
        } 
    }


    function aws_bucket_upload($source_img_path, $upload_path, $image_name, $unlink=TRUE) {

        $bucket = getenv('AWS_BUCKET_NAME');

        // path: uploads/profile/thumb/abc.jpg
        // If Folder is not there at bucket, SDK will create it and then upload
        $key = $upload_path.$image_name;
        try {
            // Upload data.
            $result = $this->s3Client->putObject([
                'Bucket'     => $bucket,
                'Key'        => $key,
                'SourceFile' => $source_img_path,
                'ACL'        => 'public-read'
            ]);
            // pr($result);
            //File uploaded successfully, unlink file from application uploads folder
            if($unlink === TRUE){
                unlink($source_img_path);
            }
        
            // Print the URL to the object.
            //echo $result['ObjectURL'] . PHP_EOL;
            return TRUE;
        } catch (S3Exception $e) {
            //echo $e->getMessage() . PHP_EOL;
            return FALSE;
        }
    }

}// End of class Image_model