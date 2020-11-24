<?php 
require_once SITE_DIR . 'class/sender_page_options.php';

class sendEmail{

	protected $cust_email_list;
	protected $sidebar_opt;

	function __construct(){
		$this -> sidebar_opt = new sendSidebar;
	}

	public function start(){
		if(isset($_GET['type']) and !empty($_GET['type'])){
			$page = $_GET['type'];
			if($page == 'single'){

				$this -> startSingle();

			}
			elseif($page == 'multiple'){

				$this -> startMultiple();

			}
			else{
				in_page_404();
			}
		}
	}

	public function notLogged(){ 
		$redirect = '?redirect=' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		header("Location: " . SITE_URL . '/login' . $redirect);
	}

	protected function startSingle(){ ?>
		<div class="start_container">
			<div class="area_split">
				<div class="area2">
					<?php
					$this -> sidebar_opt -> saveDraft_btn();
					$this -> sidebar_opt -> receiverName();
					$this -> sidebar_opt -> emailSubject();
					$this -> sidebar_opt -> receiverEmail_Single();
					$this -> sidebar_opt -> selectSenderEmail();
					$this -> sidebar_opt -> setTime();
					$this -> sidebar_opt -> sendBtn();
					?>
				</div>
				<div class="area1">
					<?php $this -> editor(); ?>
				</div>
			</div>
		</div>
	<?php
	}

	protected function startMultiple(){ ?>
		<div class="start_container">
			<div class="area_split">
				<div class="area2">
					<?php
					$this -> sidebar_opt -> saveDraft_btn();
					$this -> sidebar_opt -> emailSubject();
					$this -> sidebar_opt -> receiverEmail_Multiple();
					$this -> sidebar_opt -> selectSenderEmail();
					$this -> sidebar_opt -> setTime();
					$this -> sidebar_opt -> sendBtn();
					?>
				</div>
				<div class="area1">
					<?php $this -> editor(); ?>
				</div>
			</div>
		</div>
	<?php
	}

	protected function editor(){ ?>
		<div id="toolbar-container"></div>
		<div id="ck_document_editor"></div>
		<script type="text/javascript" src="<?php echo SITE_URL;?>/js/editor.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){

			});
		</script>
		<?php
	}
}
?>