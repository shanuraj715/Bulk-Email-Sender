<?php

class Header{

	public function link_header_files(){ ?>
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" type="text/css" href="<?php echo SITE_URL; ?>/css/fonts-awesome/css/all.min.css">

		<link rel="stylesheet" type="text/css" href="<?php echo SITE_URL; ?>/css/style.css">

		<link rel="stylesheet" type="text/css" href="<?php echo SITE_URL; ?>/css/header.css">

		<link rel="stylesheet" type="text/css" href="<?php echo SITE_URL; ?>/css/homepage_main_data.css">

		<link rel="stylesheet" type="text/css" href="<?php echo SITE_URL; ?>/css/footer.css">

		<link rel="stylesheet" type="text/css" href="<?php echo SITE_URL; ?>/jquery_plugins/jquery-ui-1.12.1.custom/jquery-ui.min.css">

		<link rel="icon" href="<?php echo SITE_URL . '/images/logos/fevicon.png';?>">

		<script type="text/javascript" src="<?php echo SITE_URL; ?>/js/jquery-3.4.1.min.js"></script>

		<script type="text/javascript" src="<?php echo SITE_URL; ?>/js/jquery.cookie.js"></script>

		<script type="text/javascript" src="<?php echo SITE_URL; ?>/jquery_plugins/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>

		<script type="text/javascript" src="<?php echo SITE_URL; ?>/js/functions.js"></script>

	<?php
	}

	public function link_imp_files(){ ?>

		<link rel="stylesheet" type="text/css" href="<?php echo SITE_URL; ?>/css/fonts-awesome/css/all.min.css">

		<link rel="stylesheet" type="text/css" href="<?php echo SITE_URL; ?>/css/style.css">

		<link rel="stylesheet" type="text/css" href="<?php echo SITE_URL; ?>/css/header.css">

		<link rel="stylesheet" type="text/css" href="<?php echo SITE_URL; ?>/jquery_plugins/jquery-ui-1.12.1.custom/jquery-ui.min.css">

		<link rel="stylesheet" type="text/css" href="<?php echo SITE_URL; ?>/css/footer.css">

		<link rel="icon" href="<?php echo SITE_URL . '/images/logos/fevicon.png';?>">

		<script type="text/javascript" src="<?php echo SITE_URL; ?>/js/jquery-3.4.1.min.js"></script>

		<script type="text/javascript" src="<?php echo SITE_URL; ?>/js/jquery.cookie.js"></script>

		<script type="text/javascript" src="<?php echo SITE_URL; ?>/jquery_plugins/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>

		<script type="text/javascript" src="<?php echo SITE_URL; ?>/js/functions.js"></script>
	<?php
	}

	public function magnific_popup_files(){ ?>
		<link rel="stylesheet" type="text/css" href="<?php echo SITE_URL;?>/libs/magnific_popup/dist/magnific-popup.css">
		<script type="text/javascript" src="<?php echo SITE_URL;?>/libs/magnific_popup/dist/jquery.magnific-popup.min.js"></script>
		<?php
	}

	public function fevicon(){ ?>
		<link rel="icon" href="<?php echo SITE_URL . '/images/logos/fevicon.png';?>">
		<?php
	}


	public function print_header(){ ?>
		<header class="header">
		<div class="head_left">
			<img src="<?php echo SITE_URL; ?>/images/logo.png" class="header_logo">
			<div class="head_text_block">
				<a href="<?php echo SITE_URL; ?>" class="head_site_title" title="Hide My Email is an online service that help users to send email to other users without showing their original Email Id."><?php echo ucwords(SITE_TITLE); ?></a>
				<span class="head_site_desc"><?php echo SITE_DESC; ?></span>
			</div>
		</div>
		<div class="head_right">
			<?php
				$redirect = '?redirect=' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
				$login_validation = new loginValidation;
				if($login_validation -> is_logged()){
					$url = SITE_URL . '/login?logout=true';
					$btn_text = "Logout";
					$title = "Logout your account";
				}
				else{
					$url = SITE_URL . '/login' . $redirect;
					$btn_text = "Login";
					$title = "Login With Your Details.";
				}
			?>
			<a href="<?php echo $url; ?>" class="login_btn" title="<?php echo $title; ?>"><?php echo $btn_text; ?></a>
			<!-- <a href="<?php //echo SITE_URL; ?>/signup" class="signup_btn" title="Create a new Account.">Signup</a> -->
		</div>
	</header>
	<?php
	}

	public function print_navigation(){ ?>
		<nav class="navigation">
			<!-- <i class="fas fa-bars"></i> -->

			<div class="nav_block">
				<div class="nav_links_block">
					<a class="nav_link" href="<?php echo SITE_URL; ?>" title="Go To Homepage.">Home</a>
					<div class="dropdown">
						<a class="nav_link">Send Email<i class="fas fa-chevron-down"></i></a>

						<?php
						$array = array(
							array(
								'title' => 'To One User' ,
								'desc' => 'Send single email to a user.' ,
								'url' => SITE_URL . '/send?type=single' 
							),
							array(
								'title' => 'To Multiple Users' ,
								'desc' => 'Send single email to multiple users.' ,
								'url' => SITE_URL . '/send?type=multiple' 
							)
						);

						$this -> navigation_dropdown_data($array);
						

						?>

					</div>

					<div class="dropdown" style="display: none;">
						<a class="nav_link">Features<i class="fas fa-chevron-down"></i></a>

						<?php

						$array = array(
							array(
								'title' => 'To One User' ,
								'desc' => 'Send single email to a user.' ,
								'url' => '#' 
							),
							array(
								'title' => 'To Two Users' ,
								'desc' => 'Send single email to multiple users.' ,
								'url' => '#' 
							),
							array(
								'title' => 'To Three User' ,
								'desc' => 'Send single email to a user.' ,
								'url' => '#' 
							),
							array(
								'title' => 'To Multiple Users' ,
								'desc' => 'click here' ,
								'url' => '#' 
							)
						);

						$this -> navigation_dropdown_data($array);

						?>
					</div>
					
					<a class="nav_link" href="<?php echo SITE_URL; ?>/api/" title="Learn more about our API. Get code for the API.">API Integration</a>

					<div class="dropdown">
						<a class="nav_link">Documentation<i class="fas fa-chevron-down"></i></a>

						<?php

						$array = array(
							array(
								'title' => 'How To Use' ,
								'desc' => 'Learn how to use our service.' ,
								'url' => '#' 
							),
							array(
								'title' => 'API Documentation' ,
								'desc' => 'API Integration Code and API Integration Documentation.' ,
								'url' => '#' 
							)
						);

						$this -> navigation_dropdown_data($array);

						?>
					</div>
					<?php $this -> myAccountNavBtn(); ?>
				</div>
			</div>
		</nav>
	<?php
		
	}

	private function navigation_dropdown_data($data_array){ ?>
		<div class="dropdown_block">
			<?php
			foreach ($data_array as $key => $value) { ?>
				<div class="drop_links_block">
					<a href="<?php echo $value['url']; ?>" class="drop_link"><i class="far fa-hand-point-right drop_link_fa"></i> <?php echo $value['title']; ?></a>
					<span class="drop_link_desc"><?php echo $value['desc']; ?></span>
				</div>
			<?php
			}
			?>
		</div>
	<?php
	}

	protected function myAccountNavBtn(){
		$login_functions = new loginValidation;
		$is_logged = $login_functions -> is_logged();
		if( $is_logged ){ ?>
			<div class="dropdown">
				<a class="nav_link">My Account<i class="fas fa-chevron-down"></i></a>

				<?php

				$array = array(
					array(
						'title' => 'How To Use' ,
						'desc' => 'Learn how to use our service.' ,
						'url' => '#' 
					),
					array(
						'title' => 'API Documentation' ,
						'desc' => 'API Integration Code and API Integration Documentation.' ,
						'url' => '#' 
					)
				);

				$this -> navigation_dropdown_data($array);

				?>
			</div>
			<?php
		}
	}
	
}

?>