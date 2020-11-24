<?php
include '../config.php';
include SITE_DIR . 'includes/file_include.php';

class contactForm{
	public $name;
	public $email;
	public $message;
	/* $err_msg is to store error text */
	private $err_msg;
	private $is_login_required;

	protected function validateName(){
		$min_length = 4;
		$max_length = 32;
		$is_alphanumeric = false;
		if($this -> name != ''){
			if((strlen($this -> name) >= $min_length) && (strlen($this -> name) <= $max_length)){
				return true;
			}
			else{
				$this -> err_msg = "Name text length should be greater than equal to " . $min_length . " characters and less than equal to " . $max_length . " characters.";
				return false;
			}
		}
		else{
			$this -> err_msg = "Please enter your name. Name field is mandatory. Please fill the form correctly";
			return false;
		}
	}

	protected function validateEmail(){
		$min_length = 12;
		$max_length = 56;

		if($this -> email != ''){
			if(strlen($this -> email) >= $min_length && strlen($this -> email) <= $max_length){
				if(preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $this -> email)){
					return true;
				}
				else{
					$this -> err_msg = "Patter of email id is wrong. Please write your right email id.";
					return false;
				}
			}
			else{
				$this -> err_msg = "Email length should be greater than equal to " . $min_length . ' characters and less than equal to ' . $max_length . ' characters.';
				return false;
			}
		}
		else{
			$this -> err_msg = "Please enter your email id. Email id field is mandatory. Please fill the form correctly";
			return false;
		}
	}

	protected function validateMessage(){
		$min_length = 12;
		$max_length = 512;
		if($this -> message != ''){
			if(strlen($this -> message) >= $min_length && strlen($this -> message) <= $max_length){
				return true;
			}
			else{
				$this -> err_msg = "Message length should be grater than equal to " . $min_length . "characters and less than equal to " . $max_length . " characters.";
				return false;
			}
		}
		else{
			return true; // returning true because we se message as optional
		}
	}

	private function validateLogin(){
		$this -> is_login_required = false; //required login
		if($this -> is_login_required == true){
			$login_obj = new loginValidation;
			if($login_obj -> is_logged()){
				return true;
			}
			else{
				return false;
			}
		}
		else{
			return true;
		}
		
	}

	public function sendMessage(){
		$dialog_box = new dialog;
		if($this -> validateName() and $this -> validateEmail() and $this -> validateMessage()){
			if($this -> validateLogin()){
				if($this -> insertDataIntoDb()){
					$dialog_box -> title = "Congrats...";
					$dialog_box -> message = "Congratulations... Form Successfully saved in our database.";
					$dialog_box -> dialog_message();
					echo '<p class="ajax_status">success</p>';
				}
				else{
					$dialog_box -> title = "Error Warning !!!";
					$dialog_box -> message = "Server is unable to save your data. Please check the form and try again.";
					$dialog_box -> dialog_message();
					echo '<p class="ajax_status">failed</p>';
				}
			}
			else{
				$dialog_box -> title = "Login Required";
				$dialog_box -> message = "To contact us, Please login to your account. If you don't have account, please signup.";
				$window_open = SITE_URL . '/login';
				// $dialog_box -> btn1 = "window.open('" . $window_open . "', '_self');";

				$dialog_box -> btn1 = array(
					'btn_name' => "Login/Signup",
					'btn_function' => '
						window.open("' . $window_open . '", "_self");
					'
				);
				$dialog_box -> btn2 = 'close';
				$dialog_box -> dialog_confirm();
				echo '<p class="ajax_status">failed</p>';
			}
		}
		else{
			$dialog_box -> title = "Error Warning !!!";
			$dialog_box -> message = $this -> err_msg;
			$dialog_box -> dialog_message();
			echo '<p class="ajax_status">failed</p>';
		}
	}

	protected function insertDataIntoDb(){
		$db_conn = new dbQuery;
		$name = $this -> name;
		$email = $this -> email;
		$message = $this -> message;
		$time = time();
		$user_ip = $_SERVER['REMOTE_ADDR'];

		$name = mysqli_real_escape_string($db_conn -> mres(), $name);
		$email = mysqli_real_escape_string($db_conn -> mres(), $email);
		$message = mysqli_real_escape_string($db_conn -> mres(), $message);

		$db_conn -> query_string = "INSERT INTO contact_form_submissions(`name`, `email`, `message`, `timestamp`, `user_ip`) VALUES('$name', '$email', '$message', '$time', '$user_ip')";
		$query_status = $db_conn -> on_db_query();
		if($query_status){
			return true;
		}
		else{
			$this -> err_msg = "Unable to do query";
			return false;
		}
	}
}

$contact_form = new contactForm;
if(isset($_POST['name']) and isset($_POST['email'])){
	$contact_form -> name = $_POST['name'];
	$contact_form -> email = $_POST['email'];
	$contact_form -> message = $_POST['message'];
	$contact_form -> sendMessage();
}
?>

