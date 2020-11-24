<?php

class login_form{

	protected $redirect;

	function __construct(){
		if(isset($_GET['redirect']) and !empty($_GET['redirect'])){
			$this -> redirect = SITE_PROTOCOL . $_GET['redirect'];
		}
		else{
			$this -> redirect = SITE_URL;
		}
		return $this -> redirect;
	}

	public function login(){ ?>
		<div class="form_data">
			<h2 class="form_heading">Login</h2>
			<img class="form_title_logo" src="<?php echo SITE_URL;?>/images/logo.png">
			<form class="form1" action="" method="get">
				<div class="input_block">
					<input class="text_input" type="text" name="username" required="required" placeholder="Username [Required]" id="username">
				</div>
				<div class="input_block">
					<input class="text_input" type="password" name="password" required="required" placeholder="Password [Required]" id="password">
				</div>
				<div class="submit_btn_block">
					<input type='submit' value='Login' class="submit_btn" id="login_btn">
				</div>
			</form>
			
			<div class="form_back_btn">
				<a href="<?php echo $this -> redirect; ?>"><i class="fas fa-angle-double-left"></i> Back</a>
			</div>
		</div>
		<?php
		$this -> login_script();
	}

	public function signup(){ ?>
		<div class="form_data">
			<h2 class="form_heading">Register</h2>
			<img class="form_title_logo" src="<?php echo SITE_URL;?>/images/logo.png">
			<form class="form1" action="" method="get" autocomplete="off">
				<div class="input_block">
					<input class="text_input" type="text" name="name" required="required" placeholder="Your Name" id="name">
				</div>
				<div class="input_block">
					<input class="text_input" type="email" name="email" required="required" placeholder="Your Email" id="email">
				</div>
				<div class="input_block registration_date_block">
					<div class="center_block" id="date_popup_trigger">
						<input class="text_input" type="text" name="user_dob" required="required" placeholder="Select Date of Birth" id="pickdate" autocomplete="off" disabled="disabled">
						<input type="submit" id="pickdate_btn" value="Select Date" style="opacity: 0;">
					</div>
				</div>
				<div class="input_block">
					<input class="text_input" type="password" name="password" required="required" placeholder="Password" id="pass">
				</div>
				<div class="input_block">
					<input class="text_input" type="password" name="re-password" required="required" placeholder="Re-type Password" id="re-pass">
				</div>
				<div class="submit_btn_block">
					<input type='submit' value='Signup' class="signup_btn" id="register_btn">
				</div>
			</form>
			
			<div class="form_back_btn">
				<a href="<?php echo $this -> redirect; ?>"><i class="fas fa-angle-double-left"></i> Back</a>
			</div>
		</div>
		<?php
		$this -> signup_script();
	}

	public function forgetPassword(){ ?>
		<div class="form_data">
			<h2 class="form_heading">Forget Password</h2>
			<img class="form_title_logo" src="<?php echo SITE_URL;?>/images/logo.png">
			<form class="form1" id="forget_pass_form1" action="" method="get" autocomplete="off">
				<div class="input_block">
					<input class="text_input" type="text" name="username" required="required" placeholder="Your Username" id="otp_username">
				</div>
				<div class="input_block">
					<input class="text_input" type="email" name="email" required="required" placeholder="Your Email" id="otp_email">
				</div>
				<div class="submit_btn_block">
					<input type='submit' value='Get OTP' class="forget_pass_get_otp_btn" id="forget_pass_get_otp_btn">
				</div>
			</form>
			<form class="form2" id="forget_pass_form2" action="" method="get" autocomplete="off">
				<div class="input_block">
					<input class="text_input" type="text" name="otp" required="required" placeholder="Enter OTP" id="otp_field">
				</div>
				<div class="submit_btn_block">
					<input type='submit' value='Submit OTP' class="forget_pass_submit_otp_btn" id="forget_pass_submit_otp_btn">
				</div>
			</form>
			<form class="form3" id="forget_pass_form3" action="" method="get" autocomplete="off">
				<div class="input_block">
					<input class="text_input" type="password" name="reset_pass1" required="required" placeholder="Enter New Password" id="new_pass_1">
				</div>
				<div class="input_block">
					<input class="text_input" type="password" name="reset_pass2" required="required" placeholder="Confirm New Password" id="new_pass_2">
				</div>
				<div class="submit_btn_block">
					<input type='submit' value='Reset Password' class="forget_pass_submit_pass_btn" id="forget_pass_submit_pass_btn">
				</div>
			</form>
			<div class="password_reset_success_block" id="password_reset_success_block">
				<p id="one">All Done</p>
				<p id="two">Redirecting you to login page.</p>
			</div>
			
			<div class="form_back_btn">
				<a href="<?php echo $this -> redirect; ?>"><i class="fas fa-angle-double-left"></i> Back</a>
			</div>
		</div>
	<?php
	$this -> forgetPasswordScript();
	}

	public function help(){ ?>
		<div class="form_data">
			<h2 class="form_heading">Help</h2>
			<img class="form_title_logo" src="<?php echo SITE_URL;?>/images/logo.png">
			<div style="max-height: 75vh; overflow-y: auto;">
				<div class="help_section">
					<h2>Login</h2>
					<p>In case, if you are facing any problem in login, please contact us via <?php echo ADMIN_EMAIL; ?>.</p>
					<p>If you forgot your password : <a class="form_link" href="#">Click here</a></p>
				</div>
				<div class="help_section">
					<h2>Registration</h2>
					<p>Kindly read our <strong><a class="form_link" href="<?php echo SITE_URL;?>/page/privacy-policy" title="Click to read">Privacy Policy</a></strong> page before registration.</p>
					<p>All input fields are mandatory. Your form will not save if any of the field is empty or value is invalid. Please fill the form correctly.</p>
					<p>You can change your name and password anytime from the dashboard of your account. You can not change your email id and Date of Birth once you saved your data. Please fill these field carefully.</p>
				</div>
				<div class="help_section">
					<h2>Forgot Password</h2>
					<p>You can change your password anytime. If you forget your password and you are not able to login you can reset your password.</p>
					<p>Just enter your username and email id then click on send button. An OTP Email will send to your registered email id.</p>
					<p>Enter OTP and click on Change Password. Create a new password and it's all done. After this you can login to your account with your new password.</p>
				</div>
				<div class="help_section">
					<h2>Account Confirmation</h2>
					<p>You can confirm your account after registration. OTP is valid for 30 minutes.</p>
					<p>If you did not get any OTP on your email id, don't worry you can generate a new one from resend OTP button.</p>
					<p>If your account is not verified with OTP, You can verify by this link <a class="form_link" href="<?php echo SITE_URL . '/confirm';?>">Verify Now</a>.</p>
				</div>
				<div class="form_back_btn">
					<a href="<?php echo $this -> redirect; ?>"><i class="fas fa-angle-double-left"></i> Back</a>
				</div>
			</div>
		</div>
		<?php
	}

	protected function login_script(){ ?>
		<script type="text/javascript">
			$('#login_btn').click(function( event ){
				event.preventDefault();
				var username = $("#username").val();
				var password = $("#password").val();
				if(username != '' && password != ''){
					$('#login_btn').val("Please Wait");
					$('.loading_anim').css('display', 'block');
					setTimeout(function(){
						$.ajax({
							type: "POST",
							data: "username=" + username + "&password=" + password,
							url: '<?php echo SITE_URL;?>/ajax/login.php',
							success: function( data ){
								if( data == 'success' ){
									var query_string = location.search;
									if(query_string != ''){
										query_string = query_string.replace('?redirect=', '');
										//console.log(query_string);
										window.open('<?php echo SITE_PROTOCOL;?>' + query_string, '_self');
									}
									else{
										window.open('<?php echo SITE_URL;?>', '_self');
									}
								}
								else{
									$('<div class="js_content_block"></div>').appendTo('body');
									$('.js_content_block').html( data );
									$('#login_btn').val("Login");
									$('.ui-dialog-buttonset, .ui-icon-closethick').click(function(){
										$('.ui-dialog').remove();
										$('.js_content_block').remove();
									});
									$('.loading_anim').css('display', 'none');
								}
							},
							error: function( data ){
								console.log("ERROR");
								alert("Unable to send data to the server. Please check your internet connection or try again after some time.");
								$('.loading_anim').css('display', 'none');
								$('#login_btn').val("Login");
							}
						});
					}, 1000);
				}
				
			});

			$('#username').keyup(() =>{
				var username_text = $('#username').val();
				if(username_text.length >= 6 && username_text.length <= 32){
					$.ajax({
						type: "POST",
						data: "username=" + username_text,
						url: '<?php echo SITE_URL;?>/ajax/check_username.php',
						success: function( data ){
							if( data == 'found' ){
								$('#username').css('color', '#58B19F');
							}
							else{
								$('#username').css('color', 'initial');
							}
						}
					});
				}
				else{
					$('#username').css('color', 'initial');
				}
			});
		</script>
	<?php
	}

	protected function signup_script(){ ?>
		<script type="text/javascript">
			$(document).ready(function(){
				$('#re-pass').keyup(function(){
					validate_pass_field();
				});
				function validate_pass_field(){
					var pass = $("#pass").val();
					var re_pass = $("#re-pass").val();
					if(pass == re_pass){
						$('#re-pass').css('color', 'rgba(29, 209, 161,1.0)');
						return true;
					}
					else{
						$('#re-pass').css('color', 'rgba(255, 107, 107,1.0)');
						return false;
					}
				}

				$('#date_popup_trigger').click( () => {
					$('#pickdate_btn').trigger('focus');
					console.log( 'Clicked' );
				});

				$('#register_btn').click( ( event ) => {
					event.preventDefault();
					var name = $('#name').val();
					var email = $('#email').val();
					var dob = $('#pickdate').val();
					var pass = $('#pass').val();

					if(name != '' && email != '' && dob != '' && pass != '' && validate_pass_field()){
						$('#register_btn').val("Please Wait");
						$('.loading_anim').css('display', 'block');
						setTimeout(function(){
							$.ajax({
								type: "POST",
								data: "name=" + name + "&password=" + pass + '&email=' + email + '&dob=' + dob,
								url: '<?php echo SITE_URL;?>/ajax/register.php',
								success: function( data ){
									console.log( data );
									if( data == 'success' ){
										window.open('<?php echo SITE_URL;?>/confirm', '_self');

									}
									else{
										console.log("done2");
										$('<div class="js_content_block"></div>').appendTo('body');
										$('.js_content_block').html( data );
										$('#register_btn').val("Login");
										$('.ui-dialog-buttonset, .ui-icon-closethick').click(function(){
											$('.ui-dialog').remove();
											$('.js_content_block').remove();
										});
										$('.loading_anim').css('display', 'none');
									}
								},
								error: function( data ){
									console.log("ERROR");
									alert("Unable to send data to the server. Please check your internet connection or try again after some time.");
									$('.loading_anim').css('display', 'none');
									$('#register_btn').val("Login");
								}
							});
						}, 1000);
					}

				});
				$('#pickdate_btn').click(( event ) => {
					event.preventDefault();
				});

				$( function() {
					$( "#pickdate_btn" ).datepicker({
						changeMonth: true,
						changeYear: true,
						yearRange: "1970:",
						onSelect : function(dataText, inst){
							var date = dataText;
							$('#pickdate').val( date );
							$(this).val('Select Date');
						}
					});
				});
			});
		</script>
	<?php
	}

	protected function forgetPasswordScript(){ ?>
		<script type="text/javascript">
			$(document).ready(() => {
				$('#forget_pass_get_otp_btn').click( ( event ) => {
					var username = $('#otp_username').val();
					var email = $('#otp_email').val();
					if( username != '' && email != ''){
						event.preventDefault();
						$('.loading_anim').css('display', 'block');
						setTimeout(function(){
							$.ajax({
								type: "POST",
								data: "username=" + username + '&email=' + email,
								url: '<?php echo SITE_URL;?>/ajax/forget_pass.php',
								success: function( data ){
									if( data == 'success' ){
										$('#forget_pass_form1').fadeOut();
										$('#forget_pass_form1').hide(1000);
										$('#forget_pass_form2').fadeIn();
										$('#forget_pass_form2').show(1000);
										$('.loading_anim').css('display', 'none');
									}
									else{
										$('<div class="js_content_block"></div>').appendTo('body');
										$('.js_content_block').html( data );
										$('.ui-dialog-buttonset, .ui-icon-closethick').click(function(){
											$('.ui-dialog').remove();
											$('.js_content_block').remove();
										});
										$('.loading_anim').css('display', 'none');
									}
								},
								error: function( data ){
									console.log("ERROR");
									alert("Unable to send data to the server. Please check your internet connection or try again after some time.");
									$('.loading_anim').css('display', 'none');
								}
							});
						}, 1000);
					}
				});

				$('#forget_pass_submit_otp_btn').click( ( event ) => {
					var otp = $('#otp_field').val();
					if(otp != ''){
						event.preventDefault();
						$('.loading_anim').css('display', 'block');
						setTimeout(function(){
							$.ajax({
								type: "POST",
								data: "otp=" + otp,
								url: '<?php echo SITE_URL;?>/ajax/forget_pass.php',
								success: function( data ){
									if( data == 'success' ){
										$('#forget_pass_form2').fadeOut();
										$('#forget_pass_form2').hide(1000);
										$('#forget_pass_form3').fadeIn();
										$('#forget_pass_form3').show(1000);
										$('.loading_anim').css('display', 'none');
									}
									else{
										$('<div class="js_content_block"></div>').appendTo('body');
										$('.js_content_block').html( data );
										$('.ui-dialog-buttonset, .ui-icon-closethick').click(function(){
											$('.ui-dialog').remove();
											$('.js_content_block').remove();
										});
										$('.loading_anim').css('display', 'none');
									}
								},
								error: function( data ){
									console.log("ERROR");
									alert("Unable to send data to the server. Please check your internet connection or try again after some time.");
									$('.loading_anim').css('display', 'none');
								}
							});
						}, 1000);
					}
				});

				$('#forget_pass_submit_pass_btn').click( ( event ) => {
					var pass1 = $('#new_pass_1').val();
					var pass2 = $('#new_pass_2').val();
					if(pass1 != '' && pass2 != ''){
						event.preventDefault();
						if( pass1 == pass2){
							$('.loading_anim').css('display', 'block');
							setTimeout(function(){
								$.ajax({
									type: "POST",
									data: "password=" + pass1,
									url: '<?php echo SITE_URL;?>/ajax/forget_pass.php',
									success: function( data ){
										if( data == 'success' ){
											$('#forget_pass_form3').fadeOut();
											$('#forget_pass_form3').hide(1000);
											$('#password_reset_success_block').fadeIn();
											$('#password_reset_success_block').show(1000);
											setTimeout(() => {
												window.open('<?php echo SITE_URL;?>/login', '_self');
											}, 3000);
											$('.loading_anim').css('display', 'none');
										}
										else{
											$('<div class="js_content_block"></div>').appendTo('body');
											$('.js_content_block').html( data );
											$('.ui-dialog-buttonset, .ui-icon-closethick').click(function(){
												$('.ui-dialog').remove();
												$('.js_content_block').remove();
											});
											$('.loading_anim').css('display', 'none');
										}
									},
									error: function( data ){
										console.log("ERROR");
										alert("Unable to send data to the server. Please check your internet connection or try again after some time.");
										$('.loading_anim').css('display', 'none');
									}
								});
							}, 1000);
						}
						else{
							alert("Password do not match.");
						}
					}
				});

				$('#forget_pass_form2').hide(0);
				$('#forget_pass_form3').hide(0)
				$('#password_reset_success_block').hide(0);
			});
		</script>
	<?php
	}

	public function logout(){
		session_destroy();
		header("Location: " . SITE_URL . '/login/');
	}
}
?>