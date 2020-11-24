<?php
include '../config.php';
require_once SITE_DIR . 'includes/file_include.php';
require_once SITE_DIR . 'class/send-otp.php';

if(isset($_POST['email']) and !empty($_POST['email'])){
	$resend = new resendOTP;
	$resend -> resend();
}


class resendOTP{
	protected $email;
	protected $user_id;
	protected $name;
	protected $db;
	protected $dialog_box;

	public function resend(){
		$this -> db = new dbQuery;
		$this -> dialog_box = new dialog;
		$this -> email = mysqli_real_escape_string($this -> db -> mres(), $_POST['email']);
		$email = $this -> email;
		$this -> db -> query_string = "SELECT * FROM users WHERE email = '$email'";
		$result = $this -> db -> select_query();
		$data = mysqli_fetch_assoc($result);
		if($data['email'] == $this -> email){
			if($data['status'] == 'pending'){
				$this -> name = $data['name'];
				$this -> user_id = $data['user-id'];

				$send_otp = new sendOTP;
				$send_otp -> name = $this -> name;
				$send_otp -> email = $this -> email;
				$send_otp -> user_id = $this -> user_id;
				if($send_otp -> send()){
					$this -> dialog_box -> message = "OTP Sent. Please check your email for OTP.";
					$this -> dialog_box -> normalText();
				}
				else{
					$this -> dialog_box -> title = "Error!";
					$this -> dialog_box -> message = "Unable to resend OTP. Please try after some time.";
					$this -> dialog_box -> dialog_message();
				}
			}
			else{
				$this -> dialog_box -> title = "Error!";
				$this -> dialog_box -> message = 'Account status is not "PENDING".';
				$this -> dialog_box -> dialog_message();
			}
			
		}
		else{
			$this -> dialog_box -> title = "Error!";
			$this -> dialog_box -> message = "No Account found for this Email id. Please register with this email id and try again.";
			$this -> dialog_box -> dialog_message();
		}
	}
}
?>