<?php
include './config.php';
include 'db_connection.php';

$db = new dbQuery;

$user = rand(4545, 4599);
$db -> query_string = "DELETE FROM `users_otp`";

$db -> on_db_query();

?>