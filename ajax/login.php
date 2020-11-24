<?php
include '../config.php';
include SITE_DIR . 'includes/file_include.php';
include SITE_DIR . 'class/encrypt_password.php';

class getLoginDetails extends loginFormValidation{
	protected $username;
	protected $password;
	protected $dialog;
	protected $db;

	/*
	The following function __construct() is a constructor. This function is made to assign data to the variables. Because this is a constructor so this method will automatically called when the object of this class is initialize.
	*/

	function __construct(){
		$this -> db = new dbQuery;
		if(isset($_POST['username']) and !empty($_POST['username'])){
			$this -> username = $_POST['username'];
			$this -> username = mysqli_real_escape_string($this -> db -> mres(), $this -> username);
		}
		if(isset($_POST['password']) and !empty($_POST['password'])){
			$this -> password = $_POST['password'];
			$this -> password = mysqli_real_escape_string($this -> db -> mres(), $this -> password);
		}
		$this -> dialog_box = new dialog();
	}

	/*
	The following function loginCheck() is made to check the login form data like username and password. This is a final function that can do everything for login form. (Only login).
	*/

	public function loginCheck(){
		if( parent :: validateUsername( $this -> username ) ){
			if( parent :: validatePassword( $this -> password ) ){
				$username = $this -> username;
				$password = $this -> password;
				$enc_pass = new encPass;
				$password = $enc_pass -> encrypt( $password );
				$this -> db -> query_string = "SELECT * from users WHERE `username` = '$username' and `password` = '$password'";
				$data = $this -> db -> select_query();
				$result = mysqli_fetch_assoc($data);
				$rows = mysqli_num_rows($data);
				if($rows == 1){
					if($result['status'] == 'active'){
						if($this -> setSession( $result )){
							echo "success";
						}
						else{
							$this -> dialog_box -> title = "Error!";
							$this -> dialog_box -> message = "Unable to set session for your account. We will fix this soon.";
							$this -> dialog_box -> dialog_message();
						}
					}
					elseif($result['status'] == 'pending'){
						$this -> dialog_box -> title = "Account Verification Needed";
						$this -> dialog_box -> message = "Your account is not verified yet. Please verify your account first then you can login to your dashboard.<br><br><a style='padding: 5px 15px; background: #2c3e50; color: white; border: solid 1px #f39c12; border-radius: 5px; font-size: 16px; text-decoration: none; margin-left: 10px;' href='" . SITE_URL . "/confirm'>Verify Now</a>";
						$this -> dialog_box -> dialog_message();
					}
					elseif($result['status'] == 'blocked'){
						$this -> dialog_box -> title = "Account Blocked";
						$this -> dialog_box -> message = "Your account is blocked due to some reason. You can get help from our Contact Us page.";
						$this -> dialog_box -> dialog_message();
					}
					else{
						$this -> dialog_box -> title = "Unknown Error!";
						$this -> dialog_box -> message = "An error occured during your account validation. You can visit Contact Us page for any help.";
						$this -> dialog_box -> dialog_message();
					}
				}
				else{
					$this -> dialog_box -> title = "Error!";
					$this -> dialog_box -> message = "Username or password is incorrect.<br><br>If you forgot your password, please visit the help section where you can reset your password.";
					$this -> dialog_box -> dialog_message();
				}
			}
			else{
				$this -> dialog_box -> title = "Error";
				$this -> dialog_box -> message = "Invalid Password. Password length must be greater than equal to " . $this -> min_password_length . " characters and less than equal to " . $this -> max_password_length . " characters.";
				$this -> dialog_box -> dialog_message();
			}
		}
		else{
			$this -> dialog_box -> title = "Error";
			$this -> dialog_box -> message = "Invalid Username. Username length must in between " . $this -> min_username_length . "  to " . $this -> max_username_length . " characters.";
			$this -> dialog_box -> dialog_message();
		}
	}

	/*
	The following function setSession() is made to set session for the user. When the user fill the login form and submit the data. After verification of data the session will be set for the user.
	*/

	public function setSession( $user_data ){

		$user_id = $user_data['user-id'];
		$username = $user_data['username'];
		$email = $user_data['email'];
		$login_time = time();

		$_SESSION['user_id'] = $user_id;
		$_SESSION['username'] = $username;
		$_SESSION['email'] = $email;
		$_SESSION['login_time'] = $login_time;

		if(isset($_SESSION['user_id']) and isset($_SESSION['username']) and isset($_SESSION['email']) and isset($_SESSION['login_time'])){
			return true;
		}
		else{
			return false;
		}
	}
}

class loginFormValidation{

	public $min_username_length;
	public $max_username_length;

	public $min_password_length;
	public $max_password_length;

	public function validateUsername( $data ){

		$this -> min_username_length = 8;
		$this -> max_username_length = 32;
		if(strlen($data) >= $this -> min_username_length and strlen($data) <= $this -> max_username_length){
			return true;
		}
		else{
			return false;
		}
	}

	public function validatePassword( $data ){
		$this -> min_password_length = 8;
		$this -> max_password_length = 32;
		if(strlen($data) >= $this -> min_password_length and strlen($data) <= $this -> max_password_length){
			return true;
		}
		else{
			return false;
		}
	}
}

$check_login = new getLoginDetails;
$check_login -> loginCheck();

?>