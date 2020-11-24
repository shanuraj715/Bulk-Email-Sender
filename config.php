<?php
session_start();
ob_start();

/* below code are only enable for testing purpose */
$testing_mode = true;

/*
Setting the timezone 
*/
date_default_timezone_set('Asia/Kolkata');

/* --------------------------------------------------- */

/* Getting the protocol of the website.
The following code will store http:// if the site is running on http.
if the site is running on https then it will store https://
*/

if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'){
	$protocol = "https://";
}
else{
	$protocol = "http://";
}
define('SITE_PROTOCOL', $protocol);

/* --------------------------------------------------- */

/*
Defining a constant for site home url.
Please Replace the existing domain name to your domain name
do not add http:// or https://
examples : 
1 -> 127.1.2.3
2 -> google.com
3 -> mydomain.com
4 -> sub.domain.com

Please do not add slash (/) after the domain name
*/

$site_domain = '127.3.2.3'; // do not add slash (/) after the domain name

/*
following code is for directory.
Leave the site_dir blank if the site is installed on the root directory.
example : 
$site_dir = 'dir1';
$site_dir = 'folder1';
$site_dir = 'dir/folder1';
*/
$site_dir = ''; // if the site is installed under any subdirectory.

// do not modify the below code
// $site_dir = $site_dir;
$site_url = $protocol . $site_domain;
if($site_dir != ''){
	$site_url .= '/' . $site_dir;
}
define("SITE_SUBDIR", '/' . $site_dir);
define('SITE_URL', $site_url);

/* --------------------------------------------------- */

/* Defining a constant for site Title */

$site_title = "Free Bulk Email";
define("SITE_TITLE", $site_title);

/* --------------------------------------------------- */

/* Defining a constant for site Description */

$site_desc = "Site Description Display Here";
define("SITE_DESC", $site_desc);

/* --------------------------------------------------- */

/*
Storing the absolute path of the domain

Please do not modify this.
*/

$site_directory = str_replace( '\\', '/', $_SERVER['DOCUMENT_ROOT']) . '/';
if($site_dir != ''){
	$site_directory .=  $site_dir . '/';
}

define('SITE_DIR', $site_directory);

/* --------------------------------------------------- */

if($testing_mode){
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
}




















class userDetails{
	protected $admin_name;
	protected $username;
	protected $email;
	protected $mobile;


	function __construct(){
		$details = array(
			'admin_name' => "Shanu Raj",
			'admin_username' => "shanuraj715",
			'admin_email' => "shanuraj715@gmail.com",
			'admin_mobile' => "8271890685"
		);
		foreach ($details as $key => $value) {
			$key = strtoupper($key);
			define($key, $value);
		}
	}
}

$user_details = new userDetails;


?>