<?php
include '../config.php';
include SITE_DIR . 'includes/file_include.php';


if(isset($_POST['dialog']) and !empty($_POST['dialog'])){
	if(isset($_POST['title']) and !empty($_POST['title'])){
		if(isset($_POST['message']) and !empty($_POST['message'])){
			$d_class = new returnDialog;
			if( $d_class -> dialog_type == 'dialog_confirm'){
				$d_class -> dialog_confirm();
			}
		}
	}
}
else{
	http_response_code(500);
}





class returnDialog{
	public $dialog_type;
	protected $dialog_box;
	protected $dialog_title;
	protected $dialog_message;
	protected $dialog_btn1;
	protected $dialog_btn2;

	function __construct(){
		$this -> dialog_type = $_POST['dialog'];
		$this -> dialog_title = $_POST['title'];
		$this -> dialog_message = $_POST['message'];
	}

	public function dialog_confirm(){
		$this -> dialog_box = new dialog;
		if(isset($_POST['btn1']) and isset($_POST['btn2'])){
			$this -> dialog_btn1 = $_POST['btn1'];
			$this -> dialog_btn2 = $_POST['btn2'];

			$this -> dialog_box -> btn1 = $this -> dialog_btn1;
			$this -> dialog_box -> btn2 = $this -> dialog_btn2;

			$this -> dialog_box -> title = $this -> dialog_title;
			$this -> dialog_box -> message = $this -> dialog_message;

			echo $this -> dialog_box -> dialog_confirm();
		}
	}
}

?>