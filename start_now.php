<?php
	include './config.php';
	include SITE_DIR . 'includes/file_include.php';
	include './includes/start_now_content.php';

	$header_obj = new header;
	$start_now = new start_now_main;
	$footer_obj = new MainFooter;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php $header_obj -> link_header_files(); ?>
	<title>Start Now - <?php echo SITE_TITLE; ?></title>
</head>
<body>
	<?php include SITE_DIR . 'elements/loading_anim_2.php'; ?>
	<script type="text/javascript">
		$('.loading_anim_2').css('display', 'block');

		$(document).ready(function(){
			setTimeout(function(){
				$('.loading_anim_2').fadeOut(600);
				console.log('Page Loading Complete.');
			}, 0);
		});
	</script>
	<?php
	$header_obj -> print_header();
	$header_obj -> print_navigation();

	$start_now -> print_main();

	$footer_obj -> print_footer();
	?>

</body>
</html>