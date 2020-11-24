<?php
class homepage {
	public function our_service(){ ?>
		<div class="container">
			<div class="division">
				<div class="left_container">
					<div class="left_block">
						<img class="area1_image" src="<?php echo SITE_URL; ?>/images/email2.png">
						<div class="left_block_text_block">
							<p class="left_block_text">Use our powerful segmentation tool, while enjoying unlimited contacts. Include conditional logic to personalize your communication and improve your reactivity rates. You can send upto 1000 Emails Daily and it's totally free for all users.</p>
						</div>
					</div>
				</div>

				<div class="right_container">
					<div class="left_curve"></div>
					<div class="area1">
						
					</div>
					<div class="area2">
						<span class="area2_text">
							<h2 class="area_title">Bulk Email</h2>
							You can send email to multiple users in one click. Email delivery time is very fast. Feel free to use our service. Just Register and start your business.
						</span>
						<img src="<?php echo SITE_URL; ?>/images/multi_users.png" class="multi_user_image">
					</div>
				</div>
			</div>
		</div>
	<?php
	}

	public function choose_email(){ ?>
		<section class="choose_email_facility">
			<div class="division">
				<div class="choose_email_block">
					<img src="<?php echo SITE_URL; ?>/images/email3.png" alt="" class="choose_email_image">
				</div>
				<div class="choose_email_desc_block">
					<p class="choose_email_text">Our Top Features</p>
					<p><i class="far fa-paper-plane"></i>Choose Your Own Id To Send Emails.</p>
					<p><i class="far fa-paper-plane"></i>We provide more than 50 email id list. You can choose any one from them.</p>
					<p><i class="far fa-paper-plane"></i>Pattern of Id's are : example@techfacts007.in</p>
					<p><i class="far fa-paper-plane"></i>You can send email on any domain. We support Google Mail, Yahoo Mail, Hotmail etc...</p>
				</div>
			</div>
			<div class="start_now_btn_block">
				<a class="start_now_btn" href="<?php echo SITE_URL . '/start/';?>" title="Start your business now. Our all Features are totally free of cost.">Start Sending Email</a>
			</div>
		</section>
		<?php
	}

	public function api_integration(){ ?>
		<section class="api_integration">
			<p class="api_integration_title"><i class="fas fa-cogs"></i> We Also Provide Our REST API</p>
			<div class="api_image_block">
				<img src="<?php echo SITE_URL; ?>/images/api_logo.png" alt="API Image" class="api_image">
			</div>
			<p class="api_text"><i class="fas fa-exchange-alt"></i> We provide our API for all users. API is also free to use.</p>

			<p class="api_text"><i class="fas fa-exchange-alt"></i> Get your API Authorization key and use that in your own projects.</p>

			<p class="api_text"><i class="fas fa-exchange-alt"></i> Use our API to send Email. Send Upto 500 Emails at a time.</p>

			<p class="api_text"><i class="fas fa-exchange-alt"></i> Our API Service is fast and Secure. No data leakage and No Private data sharing to any other user.</p>

			<p class="api_text"><i class="fas fa-exchange-alt"></i> Send Email and Fetch User Email Id List Througn our API.</p>

			<p class="api_text"><i class="fas fa-exchange-alt"></i> Get full statistics about your account through API. <a class="" href="<?php echo SITE_URL;?>/api/" title="Click here to read our API Documentation and get source code for your own project."><i class="fas fa-link"></i> Learn More</a></p>

			<div class="get_api_key_block">
				<a class="get_api_key_btn" href="<?php echo SITE_URL;?>/api/key/" title="Get your own key for your own project. Do not share your API key to anyone.">Get Your Key Now</a>
			</div>
			
		</section>
		<?php
	}
}

?>