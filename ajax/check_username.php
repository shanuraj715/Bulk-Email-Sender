<?php
require_once '../config.php';
require_once SITE_DIR . 'includes/file_include.php';
if(isset($_POST['username']) and !empty($_POST['username'])){
	$db = new dbQuery;
	$username = mysqli_real_escape_string($db -> mres(), $_POST['username']);
	$db -> query_string = "SELECT username FROM users WHERE username = '$username'";
	$result = $db -> get_rows();
	if($result == 1){
		echo "found";
	}
}
?>