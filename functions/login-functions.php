<?php

class loginValidation{

	/*
	the following function is_logged() is made to return the boolean value. The values can either true or false. If the user is logged in then this function will return true but is the user is not logged in then this function will return false
	*/

	public function is_logged(){
		if(isset($_SESSION['user_id']) and isset($_SESSION['username'])){
			if(!empty($_SESSION['user_id']) and !empty($_SESSION['username'])){
				if( $this -> check_login_max_time() ) {
					return true;
				}
				else{
					return false;
				}
			}
			else{
				return false;
			}
		}
		else{
			return false;
		}
	}

	/*
	The following function check_login_max_time() is made to check the user last visited page time. if any user loaded any page and he or she do not visit any other page within the particular time then the session for that user will be destroyed and the user will successfully logged out from the session.
	*/

	public function check_login_max_time(){
		// if(isset($_SESSION['login_time']) and !empty($_SESSION['login_time'])){
		// 	if( (time() - $_SESSION['login_time']) > 600 ){
		// 		session_destroy();
		// 		return false;
		// 	}
		// 	else{
		// 		$_SESSION['login_time'] = time();
		 		return true;
		// 	}
		// }
	}

	/*
	The following function redirect_if_not_logged() is made to redirect a user to another page. If the session is not available for that particular user and the user wants to open any page that is restricted for logged user then he or she will redierct to login page and if the user is already logged in then he or she can not open or visit the login page. 

	if he or she wants to open the login page the server will redirect that user to the homepage of the site.
	*/

	public function redirect_if_not_logged(){
		$page = $_SERVER['PHP_SELF'];
		$page = explode( '/', $page);
		$page = end($page);
		if($page == 'login.php'){
			if($this -> is_logged()){
				header("Location: " . SITE_URL);
			}
		}
		else{
			if($this -> is_logged()){
				header("Location: " . SITE_URL . '/login/');
			}
		}
	}	
}
?>