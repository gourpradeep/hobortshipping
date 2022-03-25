<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Common Helper functions used in app
* version: 2.2 (Last updated: 02-07-2020)
*/

/**
 * [To print array]
 * @param array $arr
*/
if ( ! function_exists('pr')) {
  function pr($arr)
  {
    echo '<pre>'; 
    print_r($arr);
    echo '</pre>';
    die;
  }
}

/**
 * [To print last query]
*/
if ( ! function_exists('lq')) {
  function lq()
  {
    $CI = & get_instance();
    echo $CI->db->last_query();
    die;
  }
}

/**
 * [To get database error message]
*/
if ( ! function_exists('db_err_msg')) {
  function db_err_msg()
  {
    $CI = & get_instance();
    $error = $CI->db->error();
    if(isset($error['message']) && !empty($error['message'])){
      return 'Database error - '.$error['message'];
    }else{
      return FALSE;
    }
  }
}

/**
 * [To get current datetime]
*/
if ( ! function_exists('datetime')) {
  function datetime($default_format='Y-m-d H:i:s')
  {
    $datetime = date($default_format);
    return $datetime;
  }
}


/**
 * [To encode string]
 * @param string $str
*/
if ( ! function_exists('encoding')) {
  function encoding($str){
      $one = serialize($str);
      $two = @gzcompress($one,9);
      $three = addslashes($two);
      $four = base64_encode($three);
      $five = strtr($four, '+/=', '-_.');
      return $five;
  }
}

/**
 * [To decode string]
 * @param string $str
*/
if ( ! function_exists('decoding')) {
  function decoding($str){
    $one = strtr($str, '-_.', '+/=');
      $two = base64_decode($one);
      $three = stripslashes($two);
      $four = @gzuncompress($three);
      if ($four == '') {
          return "z1"; 
      } else {
          $five = unserialize($four);
          return $five;
      }
  }
}

/**
 * [To check number is digit or not]
 * @param int $element
*/
if ( ! function_exists('is_digits')) {
  function is_digits($element){ // for check numeric no without decimal
      return !preg_match ("/[^0-9]/", $element);
  }
}

/**
 * [To get all months list]
*/
if ( ! function_exists('getMonths')) {
  function getMonths(){
    $monthArr = array('January','February','March','April','May','June','July','August','September','October','November','December');
    return $monthArr ;
  }
}

/**
 * Load styles for frontend or admin on specific pages
 * Modified in ver 2.0
 */
if (!function_exists('load_css')) {
    
    function load_css($css){

        if(!is_array($css) || count($css)>20){
            return;
        }
        $style_tag = $css_base_path = '';

        foreach($css as $style_src){

            if(strpos($style_src, 'http://') === false && strpos($style_src, 'https://') === false){
                $css_base_path = base_url() . $style_src;
            }

            $style_tag .= "<link href=\"{$css_base_path}\" rel=\"stylesheet\">\n";
        }
        echo $style_tag; //print style tags
    }
}

/**
 * Load scripts for frontend or admin on specific pages
 * Modified in ver 2.0
 */
if (!function_exists('load_js')) {

    function load_js($js=''){
        
        if(!is_array($js) || count($js)>20){
            return;
        }
        $script_tag = $js_base_path = '';

        foreach($js as $script_src){

            if(strpos($script_src, 'http://') === false && strpos($script_src, 'https://') === false){
                $js_base_path = base_url() . $script_src;
            }

            $script_tag .= "<script src=\"{$js_base_path}\"></script>\n";
        }

        echo $script_tag; //print script tags
    }
}

/**
 * For making alias of title or any string
 * Modified in ver 2.0
 */
if (!function_exists('make_alias')) {

    function make_alias($string){
        $string = strtolower(str_replace(' ', '_', $string)); // replace space with underscore
        $alias = preg_replace('/[^A-Za-z0-9]/', '', $string); // remove specail characters
        return $alias;
    }
}

/**
 * Check is string contains any special characters
 */
if (!function_exists('alpha_spaces')) {

    function alpha_spaces($string){
        if (preg_match('/^[a-zA-Z ]*$/', $string)) {
            return TRUE;
        }
        else{
            return FALSE; //match failed(string contains characters other than aplhabets and spaces)
        }
    }
}

/**
 * Display placeholder text when string is empty
 */
if (!function_exists('display_placeholder_text')) {

    function display_placeholder_text($string=''){
        if (empty($string)) {
            return 'NA'; //if string is empty return placeholder text
        }
        else{
            return $string;  //return string as it is
        }
    }
}

/**
 * Display elapsed time as user friendly string from timestamp
 */
if (!function_exists('time_elapsed_string')) {
    function time_elapsed_string($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hr',
            'i' => 'min',
            's' => 'sec',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
     }//End Function
}

/**
 * Make user profile image url from name or check if string already has url
 */
if (!function_exists('make_img_url')) {
    function make_user_img_url($img_str) {
        if (!empty($img_str)) { 
            //check if image consists url- happens in social login case
            if (filter_var($img_str, FILTER_VALIDATE_URL)) { 
                $img_src = $img_str;
            }
            else{
                $img_src = base_url().USER_AVATAR_PATH.$img_str;
            }
        }
        else{
            $img_src = base_url().USER_DEFAULT_AVATAR; //return default image if image is empty
        }
        
        return $img_src;
    }
}

/**
 * Make log of any event/action in destination file
 * Modified in ver 2.0
 */
if (!function_exists('log_event')) {
    
    function log_event($msg, $file_name='') {
        
        $log_path = APPPATH.'logs/'; //path for logs directory
        if(empty($file_name)){
            $file_path = $log_path.'common_log.txt'; //if file name is not defined then it will be logged in common file
        }else{
            $file_path = $log_path.$file_name;
        }

        $perfix = '['.datetime().'] ';  //add current date time
        $msg = $perfix.$msg."\r\n"; //create new line
        error_log($msg, 3, $file_path); //log message in file
    }
}

/**
 *  To force browser load new file from server (Prevent caching of file)
 *  Given a file, i.e. /css/base.css, replaces it with a string containing the
 *  file's mtime, i.e. /css/base.1221534296.css.
 *  
 *  @param $file_path  The file to be loaded.  Must be an absolute path (i.e. starting with slash).
 *  Rewrite rules written in htaccess
 */
function auto_version($file_path){
    
    $asset_path =  FCPATH.'frontend_asset';  //get absolute server path
    $mtime = filemtime($asset_path.$file_path); //get last modified file time
   
    if(strpos($file_path, '/') !== 0 || !$mtime)
        return $file_path;
    
    return preg_replace('{\\.([^./]+)$}', ".$mtime.\$1", $file_path);
}


/* CSRF and XSS protection helper methods start */

/**
 * Cross Site Scripting prevention filter before saving/processing data
 * Added in ver 2.0
 */
function sanitize_input_text($str){
    $CI = & get_instance();  // get instance, access the CI superobject
    return $CI->security->xss_clean($str);  //security library must be autoloaded
}

/**
 * Cross Site Scripting prevention filter while output data
 * Certain characters have special significance in HTML into their corresponding HTML entities
 * Added in ver 2.0
 */
function sanitize_output_text($str){
    return htmlspecialchars($str);
}

/**
 * Get CSRF (Cross-site request forgery) token key-value array
 * Added in ver 2.0
 */
function get_csrf_token(){
    $CI = & get_instance();  // get instance, access the CI superobject
    $csrf = array(
        'name' => $CI->security->get_csrf_token_name(),  //csrf token key
        'hash' => $CI->security->get_csrf_hash()  //csrf token value
    );
    return $csrf;
}
/* CSRF and XSS protection helper methods end */

/* User Session management methods start */
/**
 * Returns app logout url
 * Added in ver 2.0
 */
function app_logout_url(){
    return base_url('home/logout'); //can be changed depending upon application url
}

/**
 * Check if user is logged in
 * Added in ver 2.0
 */
function is_user_logged_in(){
    
    if(!isset($_SESSION[USER_SESS_KEY]))
        return FALSE;
    
    $user_sess_data = $_SESSION[USER_SESS_KEY]; //user session array
    if( !empty($user_sess_data) &&  $user_sess_data['userID']) {
       return TRUE;
    }
    return FALSE;  
}

/**
 * Check if admin user is logged in
 * Added in ver 2.0
 */
function is_admin_logged_in(){
    
    if(!isset($_SESSION[ADMIN_USER_SESS_KEY]))
        return FALSE;
    
    $admin_user_sess_data = $_SESSION[ADMIN_USER_SESS_KEY]; //admin user session array
    if( !empty($admin_user_sess_data) &&  $admin_user_sess_data['adminUserID']) {
       return TRUE;
    }
    return FALSE;  
}

/**
 * Get logged in user data
 * Added in ver 2.0
 */
function get_user_session_data(){
    $user_data = '';
    if(is_user_logged_in()){
        $user_data = $_SESSION[USER_SESS_KEY]; //user session array
    }
    return $user_data;
}

/**
 * Get logged in admin user data
 * Added in ver 2.0
 */
function get_admin_session_data(){
    $admin_user_data = '';
    if(is_admin_logged_in()){
        $admin_user_data = $_SESSION[ADMIN_USER_SESS_KEY]; //admin user session array
    }
    return $admin_user_data;
}

/* User Session management methods end */

/**
 * Removes extra white spaces from string
 * Added in ver 2.1
 */
function remove_extra_space($str){
    $str = preg_replace( '/\s+/', ' ', $str );
    return $str;
}

/**
 * Returns json data
 * Added in ver 2.1
 */
function get_json_output($data){
    header('Content-type:application/json;charset=utf-8');
    return json_encode($data);
}

/**
 * Output json data and exit
 * Added in ver 2.1
 */
function json_output($data){
    header('Content-type:application/json;charset=utf-8');
    return json_encode($data); exit;
}

/**
 * Get admin url
 * Added in ver 2.2
 */
function admin_url( $endpoint = '' ) {

    //base url should be with trailing slash
    $admin_url = $admin_base_url = base_url() . getenv('ADMIN_FOLDER');
    if(!empty($endpoint)) {
        $admin_url = $admin_base_url . '/'. $endpoint;
    }
    return $admin_url;
}

function get_type(){
  $array = [
    ["id"=>1, "name"=>"1", "value"=> 'Light'],
    ["id"=>2, "name"=>"2", "value"=> 'Havey'],
    
  ];
  return $array;
}
/***********  Any new project specific helper method can be added below  ***********/

//get all quantity of air freight
function getAllPosition(){
  $array = [
    ['id'=>0, 'value'=>1],
    ['id'=>1, 'value'=>2],
    ['id'=>2, 'value'=>3],
    ['id'=>3, 'value'=>4],
    ['id'=>4, 'value'=>5]
  ];
  return $array;
}

//get all quantity of air freight
function getAllDelivery(){
  $array = [
    // ['id'=>0, 'value'=>'All'],
    ['id'=>1, 'value'=>'Air freight'],
    ['id'=>2, 'value'=>'Sea freight']
    // ['id'=>3, 'value'=>'Courier & Express services']
    // ['id'=>4, 'value'=>'Concierge Shipping']
  ];
  return $array;
}


function getServicetype() {
  $array = [
    //['id'=>'', 'value'=>'All'],
    ['id'=>1, 'value'=>'Air freight'],
    ['id'=>2, 'value'=>'Sea freight'],
    // ['id'=>3, 'value'=>'Courier & Express services'],
    // ['id'=>4, 'value'=>'Concierge Shipping'],
    // ['id'=>5, 'value'=>'My Shipment']
];
  return $array;
}
function get_status() {
  $array = [
    ['id'=>2, 'value'=>'Approved'],
    ['id'=>3, 'value'=>'Package Received at our warehouse'],
    ['id'=>4, 'value'=>'Package preparing to ship'],
    ['id'=>5, 'value'=>'Shipment dropped off at Atlanta Airport'],
    ['id'=>6, 'value'=>'Shipment in Transit'],
    ['id'=>7, 'value'=>'Shipment Arrived in Accra'],
    ['id'=>8, 'value'=>'Customs Clearance Started'],
    ['id'=>9, 'value'=>'Shipment Cleared']
];
  return $array;
}


function getAllDeliveryCustom(){
  $array = 
  // ['1'=>'Air freight','2'=>'Sea freight', '3'=>'Courier & Express services','5'=>'My Shipment'];
  ['1'=>'Air freight','2'=>'Sea freight', '3'=>'Courier & Express services', '4'=>'Concierge Shipping','5'=>'My Shipment'];
  
  return $array;
}

//array of image ext
function imageExtension(){
  $array = array('jpeg','png','gif','tiff','jpg');
  return $array;
}

//array of file extension
function fileExtension(){
  $array = array('doc','docx','txt','wpd','text','svc');
  return $array;
}


/**
* [To get password num]
*/
if ( ! function_exists('get_password')) {
  function get_password(){
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = ZERO; $i < EIGHT; $i++) {
      $n = rand(0, $alphaLength);
      $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
  }
}//en dof function


//function for convert into key pair 

// function key_pair($data){
//   $data = json_decode($data);
//   if($data->service_type==1){

//     $urlParam = 'qoute=true&length='.$data->length.'&width='.$data->width.'&weight='.$data->weight.'&area_total='.$data->area_total.'&item='.$data->item.'&item_value='.$data->item_value.'&height='.$data->height.'&service_type='.$data->service_type.'&service_id='.$data->service_id.'&quantity='.$data->quantity.'&price='.$data->price;

//   }

//   if($data->service_type==2){

//     $urlParam = 'qoute=true&service_type='.$data->service_type.'&service_id='.$data->service_id.'&quantity='.$data->quantity.'&price='.$data->price;
//   }

//   if($data->service_type==3){

//     $urlParam = 'qoute=true&service_type='.$data->service_type.'&service_id='.$data->service_id.'&quantity='.$data->quantity.'&price='.$data->price;

//   }

//   if($data->service_type==4){

//     $urlParam = 'qoute=true&service_type='.$data->service_type.'&description='.$data->description;

//   }
//   // pr($urlParam);
//   return $urlParam;
// }

function key_pair($data){
  // $data = json_decode($data);
  if($data['service_type']==1){

    // $urlParam = 'qoute=true&length='.$data['length'].'&width='.$data['width'].'&weight='.$data['weight'].'&area_total='.$data['area_total'].'&item='.$data['item'].'&item_value='.$data['item_value'].'&height='.$data['height'].'&service_type='.$data['service_type'].'&service_id='.$data['service_id'].'&quantity='.$data['quantity'].'&price='.$data['price'];
    $urlParam = 'qoute=true&length='.$data['length'].'&width='.$data['width'].'&weight='.$data['weight'].'&area_total='.$data['area_total'].'&item='.$data['item'].'&item_value='.$data['item_value'].'&height='.$data['height'].'&service_type='.$data['service_type'].'&quantity='.$data['quantity'].'&price='.$data['price'];

  }

  if($data['service_type']==2){

    $urlParam = 'qoute=true&service_type='.$data['service_type'].'&service_id='.$data['service_id'].'&quantity='.$data['quantity'].'&price='.$data['price'];
  }

  if($data['service_type']==3){

    $urlParam = 'qoute=true&service_type='.$data['service_type'].'&service_id='.$data['service_id'].'&quantity='.$data['quantity'].'&price='.$data['price'];

  }

  if($data['service_type']==4){

    $urlParam = 'qoute=true&service_type='.$data['service_type'].'&description='.urlencode($data['description']);

  }
  // pr($urlParam);
  return $urlParam;
}


//function for convert feet to cm

function feet_to_cm($value){
  $input = $value/0.032808;
  $input = round($input, 2);
  // echo $input;die();
  return $input;
}

/**
 * Returns word accoding to count
 */
if ( ! function_exists('get_words')) {
  function get_words($sentence, $count = 8) {
    preg_match("/(?:\w+(?:\W+|$)){0,$count}/", $sentence, $matches);
    return $matches[0];
  }
}

/**
 * Returns string accoding to given length
 */
if ( ! function_exists('the_excerpt')) {
  function the_excerpt($sentence, $length = 55) {
    if (strlen($sentence) > 55){
      $sentence = substr($sentence, 0, 55) . '...';
    }
    return $sentence;
  }
}
// Subject text for concierge delivery type emails
function get_concierge_email_subject() {
//For now there is only one email for concierge 
  return "You've got an offer for Concierge Shipping order.";
}

// Subject text order tracking emails
function get_order_tracking_email_subject($status,$delivery_type) {
    if ($delivery_type==1) {
        $service_type ='Air Freight';
    }
    if ($delivery_type==2) {
        $service_type ='Sea Freight';
    }
    // if ($delivery_type==3) {
    //     $service_type ='Courier & Express Services';
    // }
    // if($delivery_type==4){
    //     $service_type ='Concierge Shipping';
    // }
    // if($delivery_type==5){
    //     $service_type ='My Shipment';
    // }
  
    $subjects = [
        2 => "Your ".$service_type." order has been approved",
        3 => "Your ".$service_type." Package received at our warehouse", 
        4 => "Your ".$service_type." Package preparing to ship",
        5 => "Your ".$service_type." Shipment dropped off at Atlanta Airport",   
        6 => "Your ".$service_type." Shipment in Transit",   
        7 => "Your ".$service_type." Shipment arrived in Accra",   
        8 => "Your ".$service_type." Customs clearance Started",   
        9 => "Your ".$service_type." Shipment cleared"  
    ];

    if(isset($subjects[$status])) {
        return $subjects[$status];
      } else {
        return "";
    }
}

function get_status_type($status) {
  
    $status_type = [
        2 => "Approved: ",
        3 => "Package received at our warehouse: ",
        4 => "Package preparing to ship: ",
        5 => "Shipment dropped off at Atlanta Airport: ",
        6 => "Shipment in Transit: ",
        7 => "Shipment arrived in accra: ",
        8 => "Customs clearance started: ",
        9 => "Shipment cleared: "
    ];
    if(isset($status_type[$status])) {
        return $status_type[$status];
    } else {
        return "";
    }
}
function calculate_promo_discount($amount) {

    $discount_percent = getenv('PROMO_DISCOUNT');
    $total_discount = $amount/100;
    $discount_amount = $total_discount * $discount_percent;
    $final_discount = $amount - $discount_amount;
    return $final_discount;
}
if ( ! function_exists('get_random_id')) {
    function get_random_id(){
        $id = substr(mt_rand(), ZERO, NINE); //create traking random id 
        return $id;
    }
}//end of function



