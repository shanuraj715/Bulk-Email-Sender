<?php
include './config.php'; 
include SITE_DIR . 'includes/file_include.php';
include SITE_DIR . 'includes/homepage_main_data.php';

$header = new Header;
$home = new homepage;
$footer = new MainFooter;
$db_query = new dbQuery;

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Hide My Email - Send Free Emails</title>
	<?php $header -> link_header_files(); ?>
</head>
<body>
	<?php include SITE_DIR . 'elements/loading_anim_2.php'; ?>
	<script type="text/javascript">
		$('.loading_anim_2').css('display', 'block');

		$(document).ready(function(){
			setTimeout(function(){
				$('.loading_anim_2').fadeOut(600);
				console.log('Page Loading Complete.');
			}, 500);
		});
	</script>
	<?php
		$header -> print_header();
		$header -> print_navigation();
		
		$home -> our_service();
		$home -> choose_email();
		$home -> api_integration();

		$footer -> print_footer();
	?>

	
	
</body>
</html>