<?php include '../config.php';
include SITE_DIR . 'includes/file_include.php';
include SITE_DIR . 'class/encrypt_password.php';
include SITE_DIR . 'class/send-otp.php';

$forget_pass = new forgetPass;
$forget_pass -> checkForWork();

class forgetPass{
	protected $username;
	protected $email;
	protected $otp;
	protected $new_password;
	protected $user_id;

	protected $db; // type object for Database Connection
	protected $dialog; // type object for on page dialog box
	protected $enc_pass; // type object for encrypting the password
	protected $send_otp; // type object to send OTP to user Email Id

	function __construct(){
		$this -> db = new dbQuery;
		$this -> dialog_box = new dialog;
		$this -> enc_pass = new encPass;
		$this -> send_otp = new sendOTP;
	}

	public function checkForWork(){
		if(isset($_POST['username']) and !empty($_POST['username'])){
			if(isset($_POST['email']) and !empty($_POST['email'])){
				if( $this -> checkUserData() ){
					$this -> send_otp -> email = $this -> email;
					$this -> send_otp -> user_id = $this -> user_id;
					if( $this -> send_otp -> send_to_reset_pass()){
						echo 'success';
					}
					else{
						$this -> dialog_box -> title = 'Error!';
						$this -> dialog_box -> message = 'Server is unable to send the OTP on youe email id.';
						$this -> dialog_box -> dialog_message();
					}
				}
				else{

				}
			}
		}
		elseif(isset($_POST['otp']) and !empty($_POST['otp'])){
			if(isset($_SESSION['forget_pass_user_id'])){
				if( $this -> validateOTP() ){
					if( $this -> checkOTP() ){
						echo 'success';
					}
					else{
						echo "Unable";
					}
				}
				else{
					echo "To handle";
				}
			}
		}
		elseif(isset($_POST['password']) and !empty($_POST['password'])){
			if(isset($_SESSION['forget_pass_user_id']) && isset($_SESSION['forget_pass_otp_status']) && $_SESSION['forget_pass_otp_status'] == 'verified'){
				if($this -> validatePassword()){
					if( $this -> savePassword() ){
						session_destroy();
						echo 'success';
					}
					else{
						
					}
				}
			}
		}
		else{
			http_response_code('400');
		}
	}

	protected function checkUserData(){
		$this -> username = mysqli_real_escape_string($this -> db -> mres(), $_POST['username']);
		$this -> email = mysqli_real_escape_string($this -> db -> mres(), $_POST['email']);

		$username = $this -> username;
		$email = $this -> email;

		$this -> db -> query_string = "SELECT * FROM users WHERE `username` = '$username' and `email` = '$email'";
		$result = $this -> db -> select_query();
		$rows = $this -> db -> get_rows();
		if($rows == 1){
			$data = mysqli_fetch_assoc($result);
			if($data['status'] == 'active'){
				$this -> user_id = $data['user-id'];
				$_SESSION['forget_pass_user_id'] = $this -> user_id;
				return true;
			}
			else{
				$this -> dialog_box -> title = 'Error!';
				$this -> dialog_box -> message = 'Your account is not in Active State. You can only reset your account password if your account is active.';
				$this -> dialog_box -> dialog_message();
				return false;
			}
		}
		else{ // no rows found
			$this -> dialog_box -> title = 'Error!';
			$this -> dialog_box -> message = 'User not found. Please provide valid username and email id.';
			$this -> dialog_box -> dialog_message();
			return false;
		}
	}

	protected function checkOTP(){
		$otp = $this -> otp;
		$user_id = $_SESSION['forget_pass_user_id'];
		$this -> db -> query_string = "SELECT * FROM `users_otp` WHERE `user-id` = $user_id and otp = $otp";
		$result = $this -> db -> select_query();
		$rows = $this -> db -> get_rows();
		if($rows == 1){
			$data = mysqli_fetch_assoc($result);
			if(time() - $data['otp_timestamp'] <= 1800){
				// delete otp from database
				$this -> db -> query_string = "DELETE FROM `users_otp` WHERE `user-id` = $user_id";
				if($this -> db -> on_db_query()){
					$_SESSION['forget_pass_otp_status'] = 'verified';
					return true;
				}
				else{
					$this -> dialog_box -> title = "Error";
					$this -> dialog_box -> message = "Server is unable to modify the record of your OTP. Please try after some time or you can start this process from beginning.";
					$this -> dialog_box -> dialog_message();
					return false;
				}
			}
			else{ // expired OTP
				$this -> dialog_box -> title = "Error";
				$this -> dialog_box -> message = "Expired OTP. You are entering an expired OTP. Please Restart the forget password process to generate a new OTP.";
				$this -> dialog_box -> dialog_message();
				return false;
			}
		}
		else{ // NOW ROWS FOUND
			$this -> dialog_box -> title = "Error";
			$this -> dialog_box -> message = "Unable to fetch the details of OTP from the database or your OTP is incorrect.";
			$this -> dialog_box -> dialog_message();
			return false;
		}

	}

	protected function savePassword(){
		$password = $this -> password;
		$user_id = $_SESSION['forget_pass_user_id'];
		$this -> db -> query_string = "UPDATE users SET password = '$password' WHERE `user-id` = $user_id";

		if( $this -> db -> on_db_query() ){
			return true;
		}
		else{
			$this -> dialog_box -> title = "Error";
			$this -> dialog_box -> message = "Server is unable to update your password. Please try after some time or you can start this process from beginning.";
			$this -> dialog_box -> dialog_message();
			return false;
		}
	}

	protected function validatePassword(){
		$this -> password = mysqli_real_escape_string($this -> db -> mres(), $_POST['password']);

		if(strlen($this -> password) >= 8 and strlen($this -> password) <= 32){
			$this -> password = $this -> enc_pass -> encrypt( $this -> password );
			return true;
		}
		else{
			$this -> dialog_box -> title = "Error";
			$this -> dialog_box -> message = "Invalid Password. Password length should between 8 to 32 characters long.";
			$this -> dialog_box -> dialog_message();
			return false;
		}
	}

	protected function validateOTP(){
		$this -> otp = mysqli_real_escape_string($this -> db -> mres(), $_POST['otp']);
		if(strlen($this -> otp) == 6){
			if(is_numeric($this -> otp)){
				return true;
			}
			else{
				$this -> dialog_box -> title = "Error";
				$this -> dialog_box -> message = "Invalid OTP. OTP must contain Numeric value.";
				$this -> dialog_box -> dialog_message();
				return false;
			}
		}
		else{
			$this -> dialog_box -> title = "Error";
			$this -> dialog_box -> message = "Invalid OTP. OTP length should equal to 6 characters.";
			$this -> dialog_box -> dialog_message();
			return false;
		}
	}

}

?>