<?php
require_once '../config.php';
require_once SITE_DIR . 'includes/file_include.php';
require_once SITE_DIR . 'class/verify_account.php';

$header = new Header;
$footer = new MainFooter;
$db_query = new dbQuery;
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Verify Account</title>
	<?php $header -> link_imp_files(); ?>
	<link rel="stylesheet" type="text/css" href="<?php echo SITE_URL;?>/css/verify_account.css">
</head>
<body>
	<?php include SITE_DIR . 'elements/loading-anim.php'; ?>
	<?php
		$header -> print_header();
		$header -> print_navigation(); ?>
		<div class="verify_page">
			<div class="box">
				<?php
				$verify_account = new verifyAccount;
				if(isset($_GET['eid']) and !empty($_GET['eid'])){
					if(isset($_GET['otp']) and !empty($_GET['otp'])){
						$verify_account -> checkData();
					}
				}
				else{
					$verify_account -> form();
				} ?>
			</div>
		</div>
		<?php
		$footer -> print_footer();
	?>
	<script type="text/javascript">
		$('.resend_otp_btn').click(() => {
			var email = $('.otp_email').val();
			if(email != ''){
				$('.loading_anim').css('display', 'block');
				setTimeout(function(){
					$.ajax({
						type: "POST",
						data: "email=" + email,
						url: '<?php echo SITE_URL;?>/ajax/resend_otp.php',
						success: function( data ){
							if( data == 'success' ){
								
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
			else{
				alert("Please fill your email id to get OTP.");
			}
		});
		
	</script>
</body>
</html>