<?php

class sendSidebar{
	protected $db;

	function __construct(){
		$this -> db = new dbQuery;
	}

	public function saveDraft_btn(){ ?>
		<div class="save_draft_block">
			<div class="receiver_email_block" style="text-align: right;">
				<input type="button" class="save_draft" id="save_draft" value="Save Draft">
			</div>
		</div>
		<div class="save_success_block" title="Saved" style="display: none;">
			<p style="padding: 5px 10px;"><i style="padding: 0 10px;" class="far fa-check-square"></i>Draft saved successfully. You can use this when you lost your recent email data.</p>
		</div>
		<script type="text/javascript">
			$('.save_draft_block').hide();
			$(document).ready( () => {
				var last_email_data = localStorage.getItem('last_email_data');
				// last_email_data = last_email_data.replace('', '<h1 data-placeholder="Type your title">sss</h1><p class="ck-placeholder" data-placeholder="Type or paste your content here."><br data-cke-filler="true"></p>');
				if(last_email_data == null){

				}
				else{
					$('<div class="dialog_popup" title="Saved Email Found"><p style="padding: 5px 15px;"><i class="far fa-file-alt" style="padding: 0 10px 0 0;"></i>You have a saved email. Do you want to restore that.<p></div>').appendTo('body');
					$( function() {
						$( ".dialog_popup" ).dialog({
							resizable: false,
							height: "auto",
							width: 400,
							modal: true,
							buttons: {
								"Restore": function() {
									editor_data.setData(localStorage.getItem("last_email_data"));
									setTimeout( () => {
										$( this ).dialog( "close" );
									}, 500);
								},
								"Cancel": function() {
									$( this ).dialog( "close" );
								}
							}
						});
					});
				}

				setTimeout( () => {
					$('.save_draft_block').show();
				}, 10000)

				$('#save_draft').click( () => {
					localStorage.setItem("last_email_data", $('#ck_document_editor').html() );
					localStorage.setItem("last_email_data_filtered", editor_data.getData() );
					//console.log(localStorage.getItem("last_email_data"));
					$('.save_success_block').dialog();
				});
			});
			
		</script>
	<?php
	}

	public function receiverEmail_Single(){ ?>
		<div class="receiver_email_block">
			<p class="sidebar_title"><i class="far fa-user-circle"></i> Receiver Email</p>
			<input type="email" class="receiver_email sidebar_input" name="receiver_email" id="receiver_email" required="required" placeholder="Enter Receiver Email Id">
		</div>
		<?php
	}

	public function receiverEmail_Multiple(){ ?>
		<div class="receiver_email_block">
			<p class="sidebar_title"><i class="far fa-user-circle"></i> Receiver Email List</p>
			<div class="receiver_warning_block" id="animate_left_right">
				<i class="far fa-check-circle" id="rec_war_i"></i>
				<span class="receiver_warning_text" id="rec_war_text">Enter some emails</span>
			</div>
			<div class="receiver_email_multiple_block">
				<input type="email" class="receiver_email sidebar_input rec_email_mul_flex" name="receiver_email" id="receiver_email" required="required" placeholder="Enter Receiver Email Id">
				<span id="view_email_list"><i class="far fa-window-maximize" title="View List of Email id."></i></span>
				<div id="preview_email_list"></div>
			</div>
			
			<div class="receiver_email_opt_block">
				<p class="rec_email_or_text">Or</p>
				<a href="<?php echo SITE_URL;?>/ajax/upload_txt_file.php" class="choose_txt_link">
					<input type="button" class="choose_txt_file_btn" id="choose_txt_file_btn" value="Upload text file" title="Choose a text file to upload a list of recipients." accept=".txt">
				</a>
				<a href="<?php echo SITE_URL;?>/ajax/get_email_list.php" class="get_email_list_link">
					<input type="button" class="rec_email_filter_btn" id="rec_email_filter_btn" value="Get Email List" title="Get a list of email id from our service. You can filter the recipients and sort the list of email id.">
				</a>
			</div>
		</div>
		<script type="text/javascript">
			$('#view_email_list').magnificPopup({
				items: {
					type: 'inline',
					src: '#preview_email_list'
				}
			});

			$('#view_email_list').click( () => {
				var list = $('#receiver_email').val();
				const list_array = list.split(',');
				var preview_email_inner_html = '';
				for(var i=0; i<list_array.length;i++){
					preview_email_inner_html = preview_email_inner_html + '<span class="preview_email_span">' + list_array[i] + '</span>';
				}
				$('#preview_email_list').html(preview_email_inner_html);
				$('#view_email_list').magnificPopup({
					items: {
						type: 'inline',
						src: '#preview_email_list'
					}
				});
			});

			$('.choose_txt_link, .get_email_list_link').magnificPopup({
				type: 'ajax',
				midClick: true,
				mainClass: 'mfp-fade',
				closeOnBgClick: false 
			});

			$(document).ready( () => {
				recipient_email();
			});

		</script>
		<?php
	}

	public function selectSenderEmail(){ ?>
		<div class="receiver_email_block">
			<p class="sidebar_title"><i class="far fa-paper-plane"></i> Select Sender Email</p>
			<select name="sender_email" id="sender_email" class="sender_email sidebar_input">
				<?php
			$this -> db -> query_string = "SELECT * FROM email_list WHERE is_available = 1";
			$data = $this -> db -> select_query();
			while( $email_list = mysqli_fetch_assoc($data)){
				if($email_list['email'] == 'default@techfacts007.in'){
					$selected = 'selected="selected"';
				}
				else{
					$selected = '';
				}
				echo '<option value="' . $email_list['id'] . '"' . $selected . '>' . $email_list['email'] . '</option>';
			} ?>
			</select>
		</div>
		<?php		
	}

	public function setTime(){ ?>
		<div class="receiver_email_block">
			<p class="sidebar_title"><i class="far fa-clock"></i> Set Time</p>
			<select name="scheduled_time" id="scheduled_time" class="scheduled_time sidebar_input">
				<option value="now">Send Immediately</option>
				<option value="5min">After 5 Minutes</option>
				<option value="15min">After 15 Minutes</option>
				<option value="30min">After 30 Minutes</option>
				<option value="60min">After 60 Minutes</option>
				<option value="schedule" id="schedule_dt" date="" time="">Custom</option>
			</select>

			<div class="sidebar_dt_selector_block">
				<input type="button" class="sidebar_date" id="sidebar_date" value="Select Date">
				<input type="button" class="sidebar_time" id="sidebar_time" value="00:00 AM">
			</div>

			<div class="sidebar_time_selector_block" visibility="hidden">
				<div class="sidebar_hour_div">
					<span class="sidebar_hour_view">Hour : <span id="hh">0</span></span>
					<input type="range" name="sidebar_schedule_hour" class="sidebar_schedule_hour" id="sidebar_schedule_hour" min="00" max="23" value="00">
				</div>
				<div class="sidebar_min_div">
					<span class="sidebar_min_view">Minutes : <span id="mm">0</span></span>
					<input type="range" name="sidebar_schedule_min" class="sidebar_schedule_min" id="sidebar_schedule_min" min="00" max="11" value="00">
				</div>
			</div>
		</div>
	<?php
	}

	public function emailSubject(){ ?>
		<div class="receiver_email_block">
			<p class="sidebar_title"><i class="far fa-comment-alt"></i> Email Subject</p>
			<input type="text" class="email_subject sidebar_input" name="email_subject" id="email_subject" required="required" placeholder="Enter Email Subject">
		</div>
	<?php	
	}

	public function receiverName(){ ?>
		<div class="receiver_email_block">
			<p class="sidebar_title"><i class="far fa-user"></i> Recipient Name</p>
			<input type="text" class="recipient_name sidebar_input" name="recipient_name" id="recipient_name" placeholder="Enter Recipient Name [Optional]" maxlength="32">
		</div>
		<?php
	}

	public function sendBtn(){ ?>
		<div class="receiver_email_block">
			<input type="button" class="preview_btn" id="preview_btn" value="View Preview">
			<input type="button" class="send_btn" id="send_btn" value="Send Email">
			<div id="preview_data_container" class="mfp-hide">
				<!-- class mfp hide is used to hide this block on the main page. this class is available because of magnify popup plugin of jquery -->
			</div>

		</div>
		<script type="text/javascript">
			$(document).ready( () => {
				send_btn_single();
			});
		</script>
	<?php
	}

	public function sendMultipleBtn(){ ?>
		<div class="receiver_email_block">
			<input type="button" class="preview_btn" id="preview_btn" value="View Preview">
			<input type="button" class="send_btn" id="send_btn" value="Send Email">
			<div id="preview_data_container" class="mfp-hide">
				<!-- class mfp hide is used to hide this block on the main page. this class is available because of magnify popup plugin of jquery -->
			</div>

		</div>
		<script type="text/javascript">
			$(document).ready( () => {
				send_btn_multiple();
			});
		</script>
	<?php
	}
}

?>