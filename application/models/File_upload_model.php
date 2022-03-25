<?php
/**
* Handles Video, audio, doc file upload
*
* @package       CodeIgniter
* @subpackage    Models
* @version       1.0.0
* @date          04-08-2020
* @author        Mindiii
* 
*/

class File_upload_model extends CI_Model {

    /**
	 * Error messages list
	 *
	 * @var	array
	 */
    public $error_msg = array();
    

    /**
	 * Uploaded file name
	 *
	 * @var	string
	 */
    private $field = 'myfile';
    
    /**
	 * Uploaded file name
	 *
	 * @var	int
	 */
    private $max_file_size = 2097152; //2mb

    /**
	 * Uploaded file MIME type
	 *
	 * @var	string
	 */
    private $file_mime_type = '';

    /**
	 * Allowed file extension
	 *
	 * @var	string
	 */
    private $allowed_file_types = '';

    /**
	 * File Upload Path
	 *
	 * @var	string
	 */
    private $file_upload_path = 'uploads/';
    
    /**
     * Constructor
     *
     * @since     1.0.0
     * @access	  public
     * 
     */
    public function __construct() {
        parent::__construct();
        $this->load->helper('string');
        $this->load->helper('response_message_helper');
    }

    /**
     * Validate the file which is to be uploaded
     * 
     * @param      array $config Config array with type, size value
     * @return     boolean true if validation passed, false if failed
     * @since      1.0.0
     * @version    1.0.0
     * 
     */
    private function validate_file($config=array()) {
        // Undefined | Multiple Files | $_FILES Corruption Attack
        // If this request falls under any of them, treat it invalid.
        if ( !isset($_FILES[$this->field]['error']) || is_array($_FILES[$this->field]['error']) ) {
            $this->error_msg[] = get_response_message(109);
            return false;
        }


        // Check $_FILES['upfile']['error'] value.
        switch ($_FILES[$this->field]['error']) {
            case UPLOAD_ERR_OK:
                break;
            case UPLOAD_ERR_NO_FILE:
                $this->error_msg[] = get_response_message(109); return false; //No file sent.
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                $this->error_msg[] = get_response_message(109); return false; //Exceeded filesize limit.
            default:
                $this->error_msg[] = get_response_message(109); return false; //Unknown errors.
        }
        // echo $this->error_msg[];

        // You should also check filesize here.
        if ($_FILES[$this->field]['size'] > $this->max_file_size || $_FILES[$this->field]["size"] == 0) {
            $this->error_msg[] = get_response_message(109); return false; //Exceeded filesize limit.
        }
        // pr($this->max_file_size);

        // DO NOT TRUST $_FILES['upfile']['mime'] VALUE !!
        // Check MIME Type by yourself.
        $this->check_file_mime_type();

        $this->check_file_extension();

        return true;
    }

    /**
     * Check file extension
     * 
     * @return     boolean
     * @since      1.0.0
     * @version    1.0.0
     * 
     */
    protected function check_file_extension() {
        
        $ext = strtolower(pathinfo($_FILES[$this->field]['name'], PATHINFO_EXTENSION));
        
        if(empty($this->allowed_file_types) || $this->allowed_file_types === "*") {
            return true; //allow all types
        }

        $all_mimes = get_mimes();
        $allowed_type_arr = explode("|", $this->allowed_file_types);

        if(!in_array($ext, $allowed_type_arr, TRUE) || !isset($all_mimes[$ext])) {
            $this->error_msg[] = get_response_message(109); return false; //Type not supported
        }

        if((is_array($all_mimes[$ext]) && !in_array($this->file_mime_type, $all_mimes[$ext], TRUE)) || (!is_array($all_mimes[$ext]) && $all_mimes [$ext] !== $this->file_mime_type) ) {
            $this->error_msg[] = get_response_message(109); return false; //finfo_file function not enabled
        }

        return true;
    }

    /**
     * Check file mime type
     * 
     * @return     boolean
     * @since      1.0.0
     * @version    1.0.0
     * 
     */
    protected function check_file_mime_type() {

        // We'll need this to validate the MIME info string (e.g. text/plain; charset=us-ascii)
		$regexp = '/^([a-z\-]+\/[a-z0-9\-\.\+]+)(;\s.+)?$/';

		/**
		 * Fileinfo extension - most reliable method
		 *
		 */
		if (!function_exists('finfo_file')) {
            $this->error_msg[] = get_response_message(109); return false; //finfo_file function not enabled
        }


        $finfo = @finfo_open(FILEINFO_MIME);
        if (!is_resource($finfo)) // It is possible that a FALSE value is returned, if there is no magic MIME database file found on the system
		{
            $this->error_msg[] = get_response_message(109); return false; //Invalid MIME type
        }

        $mime = @finfo_file($finfo, $_FILES[$this->field]['tmp_name']);
        finfo_close($finfo);

        /* According to the comments section of the PHP manual page,
            * it is possible that this function returns an empty string
            * for some files (e.g. if they don't exist in the magic MIME database)
            */
        if (is_string($mime) && preg_match($regexp, $mime, $matches)) {
            $this->file_mime_type = $matches[1];
            return $this->file_mime_type;
        } else {
            $this->error_msg[] = get_response_message(109); return false; //Invalid MIME type
        }

        return true;
    }

    /**
     * Show error message
     * 
     * @return     string
     * @since      1.0.0
     * @version    1.0.0
     * 
     */
    public function show_errors() {
		return (count($this->error_msg) > 0) ? implode('|', $this->error_msg) : '';
    }
    

    /**
     * Set file configuration which needs to uploaded
     * 
     * @return     
     * @since      1.0.0
     * @version    1.0.0
     * 
     */
    protected function set_config($type = '') {
        switch ($type) {
            case 'image':
                $this->allowed_file_types = "png|jpg|jpeg";
                $this->max_file_size = 52428800; //50MB
                break;
            case 'video':
                $this->allowed_file_types = "mp4|MP4|mov|MOV";
                $this->max_file_size = 52428800; //50MB
                break;
            case 'audio':
                $this->allowed_file_types = "mp3|m4a";
                $this->max_file_size = 52428800; //50MB
                break;
            case 'doc':
                $this->allowed_file_types = "pdf|txt|doc|docx|csv";
                $this->max_file_size = 5242880; //5MB
                break;
            default:
                $this->allowed_file_types = "*"; //all types
        }
    }

    /**
     * Upload file to S3 bucket
     * 
     * @param      string $file Name of file to upload
     * @param      string $folder Upload destination directory name
     * @return     string $thumb_img Uploaded thumb image name
     * @since      2.0.0
     * @version    3.3.0
     * 
     */
    function upload_file_to_s3($field, $folder, $filename='', $type = '') {


        $this->set_config($type);

        $this->field = $field;
        $filename = ($filename)? $filename : random_string('alnum', 16);
        $file_extension = pathinfo($_FILES[$this->field]['name'], PATHINFO_EXTENSION);
        $filename = $filename.".".$file_extension;

        $is_validate = $this->validate_file();
        if($is_validate === false) {
            return $error = [
                'error' => $this->show_errors()
            ];
            //error in upload
        }

        // Validations passed, proceed to upload file
        $upload_path = $this->file_upload_path . $folder . '/';
        $source_path = $_FILES[$this->field]['tmp_name'];

        //Upload file to S3 bucket
        $this->load->model('image_model');
        $s3_result = $this->image_model->aws_bucket_upload($source_path, $upload_path, $filename, FALSE);

        if ($s3_result !== TRUE) {
            $error = array('error' => 'Problem uploading file. Please try again');
            return $error; //error in upload
        }

        // Uploaded Successfully
        return $filename;
    }

    /**
     * Upload file to server
     * 
     * @param      string $field Name of file to upload
     * @param      string $folder Upload destination directory name
     * @return     string $thumb_img Uploaded thumb image name
     * @since      2.0.0
     * @version    3.3.0
     * 
     */
    function upload_file($field, $folder, $filename='', $type = '') {

        $this->set_config($type);
        $this->field = $field;
        $filename = ($filename)? $filename : random_string('alnum', 16);

        $config = array(
            'upload_path' => $this->file_upload_path . $folder . '/',
            'allowed_types' => $this->allowed_file_types,
            'max_size' => $this->max_file_size, //(Can be changed)
            'file_name' => $filename,
            'overwrite' => FALSE,
            'remove_spaces' => TRUE,
        );

        $this->load->library('upload'); //upload library
        $this->upload->initialize($config);
        if (!$this->upload->do_upload($video)){
            $error = array(
                'error' => $this->upload->display_errors()
            );
            return $error; //error in upload
        }

        // Uploaded Successfully
        return $filename;
    }
}