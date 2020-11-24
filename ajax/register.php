<?php
require_once '../config.php';
require_once SITE_DIR . 'includes/file_include.php';
require_once SITE_DIR . 'class/send-otp.php';
require_once SITE_DIR . 'class/encrypt_password.php';

class userRegistration extends registerFormValidation{
	protected $name;
	protected $email;
	protected $dob;
	protected $password;
	protected $db;

	protected $user_id;
	protected $dialog_box;

	function __construct(){
		$this -> db = new dbQuery;
		if(isset($_POST['name']) and !empty($_POST['name'])){
			$this -> name = $_POST['name'];
			$this -> name = mysqli_real_escape_string($this -> db -> mres(), $this -> name);
		}
		if(isset($_POST['email']) and !empty($_POST['email'])){
			$this -> email = $_POST['email'];
			$this -> email = mysqli_real_escape_string($this -> db -> mres(), $this -> email);
		}
		if(isset($_POST['dob']) and !empty($_POST['dob'])){
			$this -> dob = $_POST['dob'];
			$this -> dob = mysqli_real_escape_string($this -> db -> mres(), $this -> dob);
		}
		if(isset($_POST['password']) and !empty($_POST['password'])){
			$this -> password = $_POST['password'];
			$this -> password = mysqli_real_escape_string($this -> db -> mres(), $this -> password);
		}
		$this -> dialog_box = new dialog;
		setcookie('name', $this -> name . ' / ' . $this -> email . ' / ' . $this -> dob . ' / ' . $this -> password);
	}

	public function registerCheck(){
		if( parent :: validateName( $this -> name ) ){
			if( parent :: validateEmail( $this -> email ) ){
				if( parent :: validateDob( $this -> dob ) ){
					if( parent :: validatePassword( $this -> password ) ) {
						if( parent :: is_email_available( $this -> email ) ){
							if( $this -> storeIntoDB() ){
								$otp = new sendOTP;
								$otp -> user_id = $this -> user_id;
								$otp -> name = $this -> name;
								$otp -> email = $this -> email;
								if( $otp -> send() ){
									echo 'success';
								}
								else{
									$this -> dialog_box -> title = "Error!";
									$this -> dialog_box -> message = "OTP not Sent.<br>We are unable to send One Time Password (OTP) to your provided email id. Please check your email id. If your provided email id is correct then please wait we will fix this soon. Don't forget to report about this error. Visit Contact Us page to report this error.";
									$this -> dialog_box -> dialog_message();
								}
							}
							else{
								$this -> dialog_box -> title = "Error!";
								$this -> dialog_box -> message = "Database Error. Unable to insert your record into our database. Please contact our Adminstator for help or visit our contact us page.";
								$this -> dialog_box -> dialog_message();
							}
						}
						else{ // is_email_available
							$this -> dialog_box -> title = "Error!";
							$this -> dialog_box -> message = "Email already exist.<br/>Please choose login option instead of registration. View help section for any help.";
							$this -> dialog_box -> dialog_message();
						}
					}
					else{ // validatePassword
						$this -> dialog_box -> title = "Error!";
						$this -> dialog_box -> message = "Invalid Password. Password length should between " . $this -> min_password_length . ' to ' . $this -> max_password_length . ' characters.';
						$this -> dialog_box -> dialog_message();
					}
				}
				else{ //validateDob
					$this -> dialog_box -> title = "Error!";
					$this -> dialog_box -> message = "Invalid Date Of Birth. Looks like you changed your date of birth manually.";
					$this -> dialog_box -> dialog_message();
				}
			}
			else{ // validateEmail
				$this -> dialog_box -> title = "Error!";
				$this -> dialog_box -> message = "Invalid Email Id. Please provide correct email id. We will send an OTP for account confirmation.";
				$this -> dialog_box -> dialog_message();
			}
		}
		else{ // validateName
			$this -> dialog_box -> title = "Error!";
			$this -> dialog_box -> message = "Invalid Name. Name length should between " . $this -> min_name_length . ' to ' . $this -> max_name_length . $this -> name . ' characters.';
			$this -> dialog_box -> dialog_message();
		}
	}

	private function storeIntoDB(){
		$name = $this -> name;
		$email = $this -> email;
		$dob = $this -> dob;
		//$password = $this -> password;
		$now_time = time();

		/* encrypting the password */
		$enc_pass = new encPass;
		$password = $enc_pass -> encrypt ( $this -> password );


		$this -> user_id = $this -> generateUserid();
		$user_id = $this -> user_id;
		$this -> db -> query_string = "INSERT INTO `users`(`user-id`, `name`, `username`, `email`, `password`, `dob`, `reg_date_time`, `status`) VALUES ($user_id, '$name', '$email', '$email', '$password', '$dob', '$now_time', 'pending')";
		$status = $this -> db -> on_db_query();
		if($status){
			return true;
		}
		else{
			return false;
		}
	}

	private function generateUserid(){
		do{
			$user_id = rand(122334, 987654);
			$flag = false;
			$this -> db -> query_string = "SELECT `user-id` FROM users WHERE `user-id` = $user_id";
			$is_regisreted_user_id = $this -> db -> get_rows();
			if( $is_regisreted_user_id >= 1 ){
				$flag = false;
			}
			else{
				$flag = true;
				return $user_id;
			}
		} while( $flag != true);
	}

	// closing class braces
}

class registerFormValidation{

	public $min_name_length;
	public $max_name_length;

	public $min_email_length;
	public $max_email_length;

	public $min_password_length;
	public $max_password_length;

	function validateName( $name ){
		$this -> min_name_length = 4;
		$this -> max_name_length = 32;
		if( strlen($name) >= $this -> min_name_length and strlen($name) <= $this -> max_name_length){
			return true;
		}
		else{
			return false;
		}
	}

	function validateEmail( $email ){
		$this -> min_email_length = 12;
		$this -> max_email_length = 56;
		if(strlen($email) >= $this -> min_email_length and strlen($email) <= $this -> max_email_length){
			if(preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)){
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

	function validateDob( $dob ){
		$month_array = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
		$dob = explode('/', $dob);
		$date = $dob[1];
		$month = $dob[0];
		$month = $month_array[$month - 1];
		$year = $dob[2];
		$date = $date . '-' . strtolower($month) . '-' . $year;
		if(strtotime($date)){
			return $date;
			return true;
		}
		return false;
	}

	function validatePassword( $pass ){
		$this -> min_password_length = 8;
		$this -> max_password_length = 32;
		if(strlen($pass) >= $this -> min_password_length and strlen($pass) <= $this -> max_password_length){
			return true;
		}
		else{
			return false;
		}
	}

	function is_email_available( $email ){
		$db = new dbQuery;
		$db -> query_string = "SELECT email FROM users WHERE email = '$email'";
		$rows = $db -> get_rows();
		if( $rows != 0){
			return false;
		}
		else{
			return true;
		}
	}

}

$registerAccount = new userRegistration;
$registerAccount -> registerCheck();
?>