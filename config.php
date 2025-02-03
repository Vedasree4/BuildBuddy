<?php
// Start output buffering to control when output is sent to the browser
ob_start();
// Set the timezone for date and time functions
ini_set('date.timezone','Asia/Manila');
date_default_timezone_set('Asia/Manila');
// Start or resume a session for managing user-specific data across pages
session_start();

// Include essential files for application initialization
require_once('initialize.php');
require_once('classes/DBConnection.php');
require_once('classes/SystemSettings.php');
// Create a database connection object
$db = new DBConnection;
$conn = $db->conn;  // Access the database connection for queries

/**
 * Redirects the user to the specified URL.
 * 
 * @param string $url The relative URL to redirect to (e.g., 'dashboard.php').
 */
function redirect($url=''){
	if(!empty($url))
	echo '<script>location.href="'.base_url .$url.'"</script>';
}

/**
 * Validates an image file and returns its URL.
 * If the file is missing, returns a fallback image (e.g., site logo).
 * 
 * @param string $file The relative path to the image file.
 * @return string The URL to the valid image or fallback logo.
 */
function validate_image($file){
    global $_settings;
	if(!empty($file)){
			// exit;
        // Split the file path and query parameters
        $ex = explode("?",$file);
        $file = $ex[0]; // Extract the file path
        $ts = isset($ex[1]) ? "?".$ex[1] : ''; // Preserve query parameters if present

        // Check if the file exists in the application's base directory
		if(is_file(base_app.$file)){
			return base_url.$file.$ts;
		}else{
			return base_url.($_settings->info('logo')); // Return fallback logo
		}
	}else{
		return base_url.($_settings->info('logo')); // Return fallback logo
	}
}
/**
 * Formats a number to a specified number of decimal places.
 * If no decimal places are specified, it retains the original precision.
 * 
 * @param mixed $number The number to format.
 * @param int|null $decimal Optional. Number of decimal places.
 * @return string The formatted number or "Invalid Input" for non-numeric values.
 */
function format_num($number = '' , $decimal = ''){
    if(is_numeric($number)){
        $ex = explode(".",$number);
        $decLen = isset($ex[1]) ? strlen($ex[1]) : 0;
        if(is_numeric($decimal)){
            return number_format($number,$decimal);
        }else{
            return number_format($number,$decLen);
        }
    }else{
        return "Invalid Input";
    }
}

/**
 * Detects if the user is accessing the application from a mobile device.
 * 
 * @return bool True if a mobile user agent is detected, false otherwise.
 */
function isMobileDevice(){
    $aMobileUA = array(
        '/iphone/i' => 'iPhone', 
        '/ipod/i' => 'iPod', 
        '/ipad/i' => 'iPad', 
        '/android/i' => 'Android', 
        '/blackberry/i' => 'BlackBerry', 
        '/webos/i' => 'Mobile'
    );

    //Return true if Mobile User Agent is detected
    foreach($aMobileUA as $sMobileKey => $sMobileOS){
        if(preg_match($sMobileKey, $_SERVER['HTTP_USER_AGENT'])){
            return true;
        }
    }
    //Otherwise return false..  
    return false;
}
ob_end_flush();
?>