<?php
if(isset($_GET['uid'])){
	require_once '../config.php';
	require_once SITE_DIR . 'includes/file_include.php';
	$obj = new sendOTP;
	$obj -> name = $_GET['name'];
	$obj -> email = $_GET['email'];
	$obj -> user_id = $_GET['uid'];
	if($obj -> send()){
		echo "DONE";
	}
	else{
		echo "Not Done";
	}
}

class sendOTP{
	public $name;
	public $email;
	public $user_id;
	private $otp;

	public function send(){
		$this -> otp = rand(100000, 999999);
		$otp = $this -> otp;
		$name = $this -> name;
		$to = $this -> email;

		$subject = "Account Confirmation | " . SITE_TITLE;
		$header = "MIME-Version: 1.0" . "\r\n";
		$header .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		$header .= 'From: <support@techfacts007.in>' . "\r\n";

		$verify_url = SITE_URL . '/confirm/?eid=' . $to . '&otp=' . $otp;

		$site_image_logo = SITE_URL . '/images/logo.png';
		
		$message = '<html><body style="padding-left:40px;">';
		$message .= '<h2>Confirm Your Account</h2>';
		$message .= '<div style="text-align:center; width: 80px; height: 80px;><img src="' . $site_image_logo . '" style="width: 100%; height:100%; /></div>';
		$message .= '<p style="color: #58B19F; padding-left: 15px;">Dear <strong>' . $name . '</strong></p>';
		$message .= '<p style="color: #2C3A47;">Please verify your account.<br>OTP for your account confirmation is </p>';
		$message .= '<span style="background:#006266; color: white; padding: 5px 15px;">' . $otp . '</span>';
		$message .= '<p style="color: #2C3A47;">You can also confirm your account with the following link.</p>';
		$message .= '<div style="text-align: center; margin-bottom: 20px;"><a style="padding: 5px 15px; background: #3498db; border-radius: 5px; border: solid 1px #2c3e50; color: white; text-decoration: none;" href="' . $verify_url . '">Verify Now</a></div>';
		$message .= '<span style="">Your OTP is valid for 30 Minutes. </span>';
		$message .= '<span style="color:#ff7979;">If this is not  you, please ignore this email.</span>';
		$message .= '</body></html>';

		if( mail( $to, $subject, $message, $header) ){
			if( $this -> insertIntoDB() ){
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

	public function send_to_reset_pass(){
		$this -> otp = rand(100000, 999999);
		$otp = $this -> otp;
		$to = $this -> email;

		$subject = "Reset Account Password | " . SITE_TITLE;
		$header = "MIME-Version: 1.0" . "\r\n";
		$header .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		$header .= 'From: <support@techfacts007.in>' . "\r\n";

		$site_image_logo = SITE_URL . '/images/logo.png';
		
		$message = '<html><body style="padding-left:40px;">';
		$message .= '<h2>Reset Your Password</h2>';
		$message .= '<div style="text-align:center; width: 80px; height: 80px;><img src="' . $site_image_logo . '" style="width: 100%; height:100%; /></div>';
		$message .= '<p style="color: #2C3A47;">We have recieved a request to reset your account password.</p>';
		$message .= '<p style="color: #2C3A47;">Please provide the below OTP to Reset your password.<br>Your OTP is </p>';
		$message .= '<span style="background:#006266; color: white; padding: 5px 15px;">' . $otp . '</span>';
		$message .= '<p><span style="">Your OTP is valid for 30 Minutes. </span><p>';
		$message .= '<p style="color:#ff7979;">If this is not  you, please ignore this email. Do not share your OTP with anyone.</p>';
		$message .= '</body></html>';

		if( mail( $to, $subject, $message, $header) ){
			if( $this -> insertIntoDB() ){
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

	private function insertIntoDB(){
		$db = new dbQuery;
		$now_time = time();
		$otp = $this -> otp;
		$user_id = $this -> user_id;
		$db -> query_string = "INSERT INTO `users_otp` (`user-id`, `otp`, `otp_timestamp`) VALUES($user_id, $otp, '$now_time')";
		if( $db -> on_db_query() ){
			return true;
		}
		else{
			return false;
		}
	}
}
?>