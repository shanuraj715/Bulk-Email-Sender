<?php
include './config.php';
include './includes/file_include.php';
include './class/class_login.php';
$header = new Header;
$form = new login_form;

$login_functions = new loginValidation;

$login_functions -> redirect_if_not_logged();

if(isset($_GET['logout']) and $_GET['logout'] == 'true'){
	$form -> logout();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<?php $header -> link_imp_files(); ?>
	<link rel="stylesheet" type="text/css" href="<?php echo SITE_URL; ?>/css/login.css">
</head>
<body>
<?php include SITE_DIR . 'elements/loading_anim_2.php'; ?>
<script type="text/javascript">
	$('.loading_anim_2').css('display', 'block');
	$(document).ready(function(){
		setTimeout(function(){
			$('.loading_anim_2').fadeOut(600);
			console.log('Page Loading Complete.');
		}, 10);
	});
</script>
	<div class="login_form">
		<div class="form" id="form">
			<ul class="form_ul">
				<li class="form_li"><a class="form_tab_anchor" id="form_tab_anchor" href="#login"><i class="fas fa-user"></i> Login</a></li>
				<li class="form_li"><a class="form_tab_anchor" id="form_tab_anchor" href="#register"><i class="fas fa-user-plus"></i> Register</a></li>
				<li class="form_li"><a class="form_tab_anchor" id="form_tab_anchor" href="#forget"><i class="fa fa-key" aria-hidden="true"></i> Forgot Pass</a></li>
				<li class="form_li"><a class="form_tab_anchor" id="form_tab_anchor" href="#help"><i class="fas fa-question-circle"></i> Help</a></li>
			</ul>
			<div id="login">
				<?php $form -> login(); ?>
			</div>
			<div id="register">
				<?php $form -> signup(); ?>
			</div>
			<div id="forget">
				<?php $form -> forgetPassword(); ?>
			</div>
			<div id="help">
				<?php $form -> help(); ?>
			</div>
		</div>
	</div>
	<?php include SITE_DIR . 'elements/loading-anim.php'; ?>
	<script type="text/javascript">
		$( function() {
			$('#form').tabs().addClass("ui-tabs-vertical ui-helper-clearfix");
			$('#form li').removeClass('ui-corner-top').addClass('ui-corner-left');
		});
		$(document).ready(( ) => {
			
		});
	</script>
</body>
</html>