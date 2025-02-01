<?php 
// Start the session if it has not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// Construct the current page URL
if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') 
    $link = "https";  // If HTTPS is enabled, set the protocol to "https"
else
    $link = "http"; 
$link .= "://"; 
$link .= $_SERVER['HTTP_HOST']; // Append the domain name (e.g., example.com)
$link .= $_SERVER['REQUEST_URI']; // Append the full request URI (e.g., /admin/index.php?param=1)
// Redirect users to the login page if they are not logged in and not on login.php
if(!isset($_SESSION['userdata']) && !strpos($link, 'login.php')){
	redirect('admin/login.php');
}
// Redirect logged-in users away from login.php to the admin dashboard
if(isset($_SESSION['userdata']) && strpos($link, 'login.php')){
	redirect('admin/index.php');
}

$module = array('','admin','tutor');
// Restrict access for non-admin users trying to access admin pages
if(isset($_SESSION['userdata']) && (strpos($link, 'index.php') || strpos($link, 'admin/')) && $_SESSION['userdata']['login_type'] !=  1){
	echo "<script>alert('Access Denied!');location.replace('".base_url.$module[$_SESSION['userdata']['login_type']]."');</script>";
    exit;
}
