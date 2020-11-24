$(document).ready(() => {
	$('.sidebar_dt_selector_block').hide();

	$('.sidebar_time_selector_block').hide();

	$('select#scheduled_time').change(() => {
		var time = $('select#scheduled_time option:selected').val();
		if(time == 'schedule'){
			$('.sidebar_dt_selector_block').show(200);
		}
		else{
			$('.sidebar_dt_selector_block').hide(200);
			$('.sidebar_time_selector_block').attr('visibility', 'hidden');
			$('.sidebar_time_selector_block').hide(200);
		}
	});

	$( function() {
		var year = new Date;
		year = year.getFullYear() + ':';
		$( "#sidebar_date" ).datepicker({
			minDate: 0,
			maxDate: "+12M",
			yearRange: year,
			onSelect : function(dataText, inst){
				$('#schedule_dt').attr('date', dataText);
			}
		});
	});

	$('#sidebar_date').click( ( event ) => {
		event.preventDefault();
	});

	$('#sidebar_time').click( ( event ) => {
		event.preventDefault();
		var visibility_status = $('.sidebar_time_selector_block');
		if( visibility_status.attr('visibility') == 'hidden'){
			visibility_status.attr('visibility', 'visible');
			visibility_status.show(200);
		}
		else{
			visibility_status.attr('visibility', 'hidden');
			visibility_status.hide(200);
		}
	});

	var hour_slider = document.getElementById('sidebar_schedule_hour');
	var hour = '00', min = '00', am_pm = 'AM';
	hour_slider.addEventListener("input", () => {
		document.getElementById('hh').innerHTML = hour_slider.value;
		hour = ('0' + hour_slider.value).slice(-2);
		if(hour > 12){
			hour = hour - 12;
			hour = ('0' + hour).slice(-2);
			am_pm = 'PM';
		}
		else{
			am_pm = "AM";
		}
		document.getElementById('sidebar_time').value = hour + ':' + min + ' ' + am_pm;
		$('#schedule_dt').attr('time', hour + ':' + min + ' ' + am_pm);
	});

	var min_slider = document.getElementById('sidebar_schedule_min');
	min_slider.addEventListener("input", () => {
		document.getElementById('mm').innerHTML = min_slider.value * 5;
		min = ('0' + min_slider.value * 5).slice(-2);
		document.getElementById('sidebar_time').value = hour + ':' + min + ' ' + am_pm;
		$('#schedule_dt').attr('time', hour + ':' + min + ' ' + am_pm);
	});
});






/* functions */

function recipient_email(){
	$('#receiver_email').focusin( () => {
		$('#animate_left_right').addClass('animate_receiver_warning_show');
		$('#animate_left_right').removeClass('animate_receiver_warning_hide');
	});

	$('#receiver_email').focusout( () => {
		$('#animate_left_right').addClass('animate_receiver_warning_hide');
		$('#animate_left_right').removeClass('animate_receiver_warning_sjow');
	});

	$('#receiver_email').keyup( () => {
		var rec_email_data = $('#receiver_email').val();
		if(rec_email_data != ''){
			rec_email_data = rec_email_data.replace(', ', ',');

			$('#receiver_email').val(rec_email_data);

			var email_array = rec_email_data.split(',');
			var last_email = email_array[email_array.length - 1]; // last types email id
			var email_split_space = last_email.split(' ');

			var email_count = total_email();
			function total_email() {
				if(last_email == null || last_email == ''){
					return email_array.length - 1;
				}
				else{
					return email_array.length;
				}
			};

			if( email_split_space.length > 1 ){
				var is_space = true;
				var is_error = true;
			}
			else{
				var is_space = false;
				var is_error = false;
			}

			if(is_space == true){
				var text = "Please remove the space.";
			}
			else{
				var text = "Done";
			}
		}
		else{
			var is_error = true;
			var text = "Please write recipient email."
		}
		


		if( is_error == true){
			$('.receiver_warning_block').css('background-color', '#eb4d4b');
			$('#rec_war_i').addClass('fa-times-circle');
			$('#rec_war_i').removeClass('fa-check-circle');
			$('#rec_war_text').html(text);
		}
		else{
			$('.receiver_warning_block').css('background-color', '#f9ca24');
			$('#rec_war_i').addClass('fa-check-circle');
			$('#rec_war_i').removeClass('fa-times-circle');
			$('#rec_war_text').html(email_count + ' Emails inserted.');
		}
	});
}


function send_btn_single(){
	$('#recipient_name').keyup( () => {
		var recipient_name = $('#recipient_name').val();
		if(recipient_name == ''){
			$('#send_btn').val('Send Email');
		}
		else{
			$('#send_btn').val('Send to ' + recipient_name);
		}
	});

	$('#preview_btn').magnificPopup({
		items: {
			src: '#preview_data_container',
			type: 'inline'
		}
	});

	$('#preview_btn').click(( event ) => {
		// event.preventDefault();
		$('#preview_data_container').html(editor_data.getData());
		$('#preview_btn').magnificPopup({
			items: {
				src: '#preview_data_container',
				type: 'inline'
			}
		});
	});


	$('#send_btn').click( ( event ) => {
		event.preventDefault();
		var recipient_name = $('#recipient_name').val();
		var email_subject = $('#email_subject').val();
		var receiver_email = $('#receiver_email').val();
		var sender_email = $('#sender_email').children("option:selected").val();
		var selected_option = $('#scheduled_time').children("option:selected").val();
		if(selected_option == 'schedule'){
			var schedule_date = $('#schedule_dt').attr('date');
			var schedule_time = $('#schedule_dt').attr('time');

			var date_time = schedule_date + '/' + schedule_time;
			//console.log(schedule_date);
		}
		else{
			var date_time = selected_option;
			//console.log(selected_option);
		}
		var email_html = escape( editor_data.getData() );
		// console.log(unescape(email_html));

		/* structure the data to send as POST */

		var query_string = 'recipient_name=' + recipient_name + '&email_subject=' + email_subject + '&receiver_email=' + receiver_email + '&sender_email=' + sender_email + '&date_time=' + date_time + '&email_content=' + email_html; 

		/* ********************************** */

		$('.loading_anim').css('display', 'block');
		setTimeout(function(){
			$.ajax({
				type: "POST",
				data: query_string,
				url: '<?php echo SITE_URL;?>/ajax/send_email.php',
				success: function( data ){
					if( data == 'success' ){
						localStorage.clear();
						$('.loading_anim').css('display', 'none');
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
	});
}


function send_btn_multiple(){
	$('#preview_btn').magnificPopup({
		items: {
			src: '#preview_data_container',
			type: 'inline',
			closeOnContentClick: false
		}
	});

	$('#preview_btn').click(( event ) => {
		// event.preventDefault();
		$('#preview_data_container').html(editor_data.getData());
		$('#preview_btn').magnificPopup({
			items: {
				src: '#preview_data_container',
				type: 'inline'
			}
		});
	});
}