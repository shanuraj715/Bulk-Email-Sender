<?php
include './config.php';
include SITE_DIR . 'includes/file_include.php';
$header = new Header;
$footer = new MainFooter;
$dialog_box = new dialog;

class get_page_request{
	protected $uri;
	protected $is_page_valid = '';
	protected $page = 'about_us';
	protected $page_title;

	function __construct(){

		$this -> uri = $_SERVER['REQUEST_URI'];
		if(SITE_SUBDIR != '/'){
			$this -> uri = str_replace(SITE_SUBDIR, '', $this -> uri);
		}
		if($this -> uri != ''){
			$this -> is_page_valid = explode( '/' , $this -> uri);
			if( ( $this -> is_page_valid[1] ) == 'page'){
				if( isset($this -> is_page_valid[2]) ){
					$this -> page = strtolower($this -> is_page_valid[2]);
					$this -> page_title = ucfirst($this -> page);
				}
			}
		}
	}

	public function page_title(){
		return $this -> page_title;

	}

	public function body(){
		$page_list = array(
			'contact_us' => array(
				'file_name' => 'contact_us.php'
			),
			'privacy-policy' => array(
				'file_name' => 'privacy_policy.php'
			),
			'about_us' => array(
				'file_name' => 'about_us.php'
			)
		);
		if(isset($page_list[$this -> page])){
			if(file_exists(SITE_DIR . 'pages/' . $page_list[$this -> page]['file_name'])){
				include SITE_DIR . 'pages/' . $page_list[$this -> page]['file_name'];
			}
			else{
				
			}
		}
		else{

		}
	}
}

$page_request = new get_page_request;

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php $header -> link_header_files(); ?>
	<title><?php echo $page_request -> page_title() . ' - ' . SITE_TITLE; ?></title>
</head>
<body>
	<?php
		$header -> print_header();
		$header -> print_navigation();

		$page_request -> body();

		$footer -> print_footer();
		$page_request -> page_title();
	?>
</body>
</html>