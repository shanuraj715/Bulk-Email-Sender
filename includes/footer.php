<?php

class MainFooter{

	public function print_footer(){ ?>
		<footer class="main_footer">
			<div class="footer1">
				<div class="image">
					<img src="<?php echo SITE_URL; ?>/images/logo.png">
				</div>
				<p class="footer_text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Numquam, voluptatibus.</p>
				<div class="footer_boundary"></div>

				<div class="footer_division">
					<div class="footer_btns_block">
						<a class="footer_link" href="<?php echo SITE_URL; ?>/page/contact_us">Contact Us</a>
						<a class="footer_link" href="<?php echo SITE_URL; ?>/page/about_us" title="Know more about our service and features.">About Us</a>
						<a class="footer_link" href="<?php echo SITE_URL; ?>/page/privacy-policy" title="Read our privacy policy.">Privacy Policy</a>
					</div>

					<div class="footer_social_block">
						<a href="#" title="Visit our facebook page."><i class="fab fa-facebook-f"></i></a>
						<a href="#" title="Follow us on twitter."><i class="fab fa-twitter"></i></a>
						<a href="#" title="Join us on Google Plus"><i class="fab fa-google-plus-g"></i></a>
						<a href="#" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
					</div>
				</div>
				<p class="credit_text">This site is developed by - Shanu Raj & Honey Raaz.</p>
			</div>
		</footer>
	<?php
	}
}


?>