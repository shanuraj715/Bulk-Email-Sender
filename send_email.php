<?php
include './config.php';
include SITE_DIR . 'includes/file_include.php';
include SITE_DIR . 'class/main_send_email.php';
// include SITE_DIR . 'class/get_email_list.php';

$header = new Header;
$footer = new MainFooter;
$login_func = new loginValidation;
$send_email = new sendEmail;

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Start Sending Email</title>
	<?php
	$header -> link_imp_files();
	$header -> magnific_popup_files();
	?>
	<link rel="stylesheet" type="text/css" href="<?php echo SITE_URL;?>/css/main_send_email.css">
	<script type="text/javascript" src="<?php echo SITE_URL;?>/libs/ck-5-document/build/ckeditor.js"></script>
	<script type="text/javascript" src="<?php echo SITE_URL;?>/js/sender.js"></script>
</head>
<body>
	<?php include SITE_DIR . 'elements/loading_anim_2.php';
		include SITE_DIR . 'elements/loading-anim.php';
		$header -> print_header();
		$header -> print_navigation();

		if($login_func -> is_logged()){
			$send_email -> start();
		}
		else{
			$send_email -> notLogged();
		}

		$footer -> print_footer(); 
	?>
</body>
<script type="text/javascript">
	$(document).ready(() => {
		$('.loading_anim_2').fadeOut(600);
	});

</script>
</html>