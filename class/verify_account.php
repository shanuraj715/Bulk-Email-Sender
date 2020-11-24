<?php

class verifyAccount{
	protected $dialog_box;

	function __construct(){
		$this -> dialog_box = new dialog;
	}
	public function form(){ ?>
		<div class="form">
			<div class="title_box"><span class="title">Verify Account</span></div>
			<form class="otp_form" action="" method="GET">
				<input class="otp_email" type="email" name="eid" required="required" placeholder="Enter Your Email">
				<input type="text" name="otp" class="otp" placeholder="Enter OTP" required="required">
				<div class="otp_submit_btn_block">
					<span class="resend_otp_btn">Resend OTP</span>
					<input type="submit" value="Submit" class="otp_submit">
				</div>
			</form>
		</div>
		<?php
	}

	public function accountVerified(){ ?>
		<div class="success_block">
			<img src="<?php echo SITE_URL;?>/images/verified_animated.svg?nocache=<?php echo rand(1000,9999); ?>" class="otp_success_image">
			<p class="otp_redirect_text">You will redirect to homepage after <span class="verified_countdown"></span> Seconds</p>
		</div>
		<script type="text/javascript">
			$('.form').hide(1500);
			$(document).ready(() => {
				var count_sec = 5;
				$('.verified_countdown').html(count_sec);
				setTimeout(() => {
					setInterval(() => {
						count_sec = count_sec - 1;
						$('.verified_countdown').html( count_sec );
						if(count_sec == 0){
							window.open('<?php echo SITE_URL;?>', '_SELF');
						}
					}, 1000);
				}, 1000);
			});
		</script>
		<?php
	}

	public function checkData(){
		$this -> form();
		$db = new dbQuery;
		$email = mysqli_real_escape_string($db -> mres(), $_GET['eid']);
		$otp = mysqli_real_escape_string($db -> mres(), $_GET['otp']);
		if(is_numeric($otp) and $otp <= 999999 and $otp >= 100000){
			$db -> query_string = "SELECT * FROM users WHERE email = '$email'";
			$result = $db -> select_query();
			$data = mysqli_fetch_assoc($result);
			if($data['email'] == $email ){
				$user_id = $data['user-id'];
				$status = $data['status'];

				if($status == 'pending'){
					$db -> query_string = "SELECT * FROM users_otp WHERE `user-id` = $user_id and otp = $otp";
					$result = $db -> select_query();
					if( $result ){
						$data = mysqli_fetch_assoc($result);
						$now_time = time();
						if( ($now_time - $data['otp_timestamp'] <= 1800) and $otp == $data['otp'] ){
							$db -> query_string = "DELETE FROM users_otp WHERE `user-id` = $user_id";
							if( $db -> on_db_query() ){
								$db -> query_string = "UPDATE users SET status = 'active' WHERE `user-id` = $user_id";
								if( $db -> on_db_query() ){
									$this -> accountVerified();
								}
								else{
									$this -> dialog_box -> title = "Error!";
									$this -> dialog_box -> message = "Database Update Error.<br>Unable to update the status of pending user. Your account status is still in pending. Please try generating new OTP or if the problem is from our side then we will fix this soon. Please report this error from Contact Us page.";
									$this -> dialog_box -> dialog_message();
								}
							}
							else{
								$this -> dialog_box -> title = "Error!";
								$this -> dialog_box -> message = "Database Row Deletion Failed.<br>Server is currently unable to delete otp data for the user. Your Account status is still in pending. Please Report this error on Contact Us Page.";
								$this -> dialog_box -> dialog_message();
							}
						}
						else{
							$this -> dialog_box -> title = "Error!";
							$this -> dialog_box -> message = "Expired OTP.<br>You are entering an expired OTP. Please generate a new OTP and try again.";
							$this -> dialog_box -> dialog_message();
						}
					}
					else{
						$this -> dialog_box -> title = "Error!";
						$this -> dialog_box -> message = "Unable to fetch the OTP data from the server. Try again after some time.";
						$this -> dialog_box -> dialog_message();
					}
				}
				else{
					$this -> dialog_box -> title = "Error!";
					$this -> dialog_box -> message = "Your account is already verified. Please login to your account.";
					$this -> dialog_box -> dialog_message();
				}
			}
			else{
				$this -> dialog_box -> title = "Error!";
				$this -> dialog_box -> message = "User id not fetched.<br>Server is unable to fetch the user details from the database. Please try again after some time. If this is from our side, we will fix this soon. Please report this error from Contact Us Page.";
				$this -> dialog_box -> dialog_message();
			}
		}
		else{

			$this -> dialog_box -> title = "Error!";
			$this -> dialog_box -> message = "Invalid OTP. Looks like your OTP valueis not numeric or out of range.<br>Range for OTP is in between 100000 to 999999.";
			$this -> dialog_box -> dialog_message();
		}
	}
}
?>