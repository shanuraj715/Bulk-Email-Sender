<?php

class dialog{
	public $title;
	public $message;
	// protected $type;
	public $btn1;
	public $btn2;

	public function dialog_normal(){
		// for normal dialog box
		?>
		<div class="dialog_box" title="<?php echo $this -> title; ?>">
			<p><?php echo $this -> message; ?></p>
		</div>

		<script type="text/javascript">
			$('.dialog_box').dialog();
		</script>
		<?php
	}

	public function dialog_confirm(){
		/* $btn1_text : it accepts a javascript or jQuery function.
		php function will not work if the 1st parameter is not a javascript or jQuery function.
		example: 
		$dialog_box_btn1 = array(
			'btn_name' => "Ok",
			'btn_function' => '
				alert("Hello Boy");
				$( this ).dialog( "close" );
			'
		);
		$dialog_box -> title = "Some Title";
		$dialog_box -> message = "Some Text Here";
		$dialog_box -> dialog_confirm();

		*/
		// for confirmative dialog box
		if($this -> btn2 == 'close'){
			$text = '$( this ).dialog( "close" );';
		}
		else{
			$text = $this -> btn2;
		}
		?>
		<div class="dialog_confirm" title="<?php echo $this -> title; ?>">
			<p><?php echo $this -> message; ?></p>
		</div>
		<script type="text/javascript">
			$('.dialog_confirm').dialog({
				resizable: false,
				height: "auto",
				width: 500,
				modal: true,
				buttons: {
					"<?php echo $this -> btn1['btn_name'];?>": function() {
						<?php echo $this -> btn1['btn_function']; ?>
					},
					"<?php echo $this -> btn2;?>": function() {
						<?php echo $text; ?>
					}
				}
			});
		</script>
		<?php
	}

	public function dialog_message(){
		?>
		<div class="dialog_message" title="<?php echo $this -> title;?>">
			<p><?php echo $this -> message; ?></p>
		</div>
		<script type="text/javascript">
			$( ".dialog_message" ).dialog({
				width: 470,
				modal: true,
				resizable: false,
				buttons: {
					"Ok, Got it": function() {
						$( this ).dialog( "close" );
					}
				}
			});
		</script>
		<?php
	}

	public function normalText(){ ?>
	<div class="ui-widget" id="jq_ui_normal_text">
		<div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;">
			<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span> <?php echo $this -> message; ?></p>
		</div>
	</div>
	<script type="text/javascript">
		var element = $('#jq_ui_normal_text');
		element.css('position', 'absolute');
		element.css('top', '0');
		element.css('left', '0');
		element.css('width', '100vh');
		element.fadeIn(1000);
		setTimeout( () => {
			element.fadeOut(1000);
		}, 4000);
		
	</script>
	<?php
	}
}

?>