<?php
include '../config.php';
require_once SITE_URL . 'includes/file_include.php';


/**
 * 
 */
class getCustomerEmailList
{
	protected $email_list; // data type array; This will store the array of all the customer email.

	protected $db;
	protected $dialog_box;
	protected $filter;

	protected $db_query;

	
	function __construct()
	{
		$this -> db = new dbQuery;
		$this -> dialog_box = new dialog;	
	}

	public function customer_email_list(){

	}

	protected function getEmailListFromDB(){

		$filtered_data = $this -> filter;

		$this -> db -> query_string = "SELECT * FROM customer_email WHERE '$filtered_data'";

		$this -> db = select_query();


	}

	protected function filteredData(){

		$filter_string = $this -> filter;

		$filter_string = explode( '/', $filter_string);

		$number_of_filters = count($filter_string);
	}
}

?>