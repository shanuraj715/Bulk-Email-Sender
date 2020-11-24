<?php include SITE_DIR . 'elements/loading_anim_2.php'; ?>
<script type="text/javascript">
	$('.loading_anim_2').css('display', 'block');

	$(document).ready(function(){
		setTimeout(function(){
			$('.loading_anim_2').fadeOut(600);
			console.log('Page Loading Complete.');
		}, 1000);
	});
</script>
<script type="text/javascript">
	$('<link rel="stylesheet" type="text/css" href="<?php echo SITE_URL; ?>/css/contact-us.css"></link>').appendTo("head");
</script>
<div class="contact_form_container">
	<div class="contact_form_sub_container">
		<h1 class="contact_us_h1">Get in touch with us</h1>
		<form action="" method="post" class="contact_form" autocomplete="off">
			<div class="form_area1">
				<div class="input_div">
					<input class="input_type_text" type="text" name="name" required="required" placeholder="Your Name [Required]" autocomplete="off" id="name">
				</div>
				<div class="input_div">
					<input class="input_type_text" type="email" name="email" required="required" placeholder="Your Email [Required]" autocomplete="off" id="email">
				</div>
			</div>
			<div class="form_area2">
				<div class="input_div">
					<input class="input_type_text" type="text" name="message" placeholder="Your Message" autocomplete="off" id="message">
				</div>
			</div>
		</form>
		<div class="form_submit_btn">
			<button id="submit_btn">Get in touch</button>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('#submit_btn').click(function(){
			var name = $('#name').val();
			var email = $('#email').val();
			var message = $('#message').val();
			
			if(name != '' && email != ''){
				$('.loading_anim').css('display', 'block');
				$('#submit_btn').html("Sending Data");
				setTimeout(function(){
					$.ajax({
						type: "POST",
						data: "name=" + name + "&email=" + email + "&message=" + message,
						url: "<?php echo SITE_URL;?>/ajax/contact_us_form.php",
						success: function( data ){
							$('<div class="js_content_block"></div>').appendTo('body');
							$('.js_content_block').html( data );
							$('#submit_btn').html("Get in touch");
							$('.ui-dialog-buttonset, .ui-icon-closethick').click(function(){
								$('.ui-dialog').remove();
								$('.js_content_block').remove();
							});
							if($('.ajax_status').html() == 'success'){
								$('#name').val('');
								$('#email').val('');
								$('#message').val('');
								$('.loading_anim').css('display', 'none');
							}
							else{
								$('.loading_anim').css('display', 'none');
							}
						},
						error: function(){
							alert("Unable to send the data to the server");
							$('#submit_btn').html("Get in touch");
							$('.loading_anim').css('display', 'none');
						}
					});
				}, 500);
				
				
			}
			else{
				alert("Please fill the form correctly. Name field and email field is mandatory.");
			}

		});

		$(document).ajaxStart(function(){
			$('#submit_btn').html("Sending Data");
		});

		
	})
	
	
</script>
<?php include SITE_DIR . 'elements/loading-anim.php'; ?>