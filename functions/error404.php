<?php

function in_page_404(){ ?>
	<div class="err404_container">
		<div class="err404_block1">
			<div class="err404_bg_img_cont">
				<img src="<?php echo SITE_URL;?>/images/logo.png">
			</div>
			<div class="err404_404_text">
				<span>404</span>
				<h1>PAGE NOT FOUND</h1>
			</div>
		</div>
		<div class="err404_block2">
			<a href="<?php echo SITE_URL;?>" >Take me to Homepage</a>
		</div>
	</div>
	<?php
}

function on_page_404(){

}

?>