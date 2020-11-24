<?php

if(isset($_POST['email_content'])){
	//echo htmlspecialchars($_POST['email_content']);

	$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
	$txt = str_replace('&nbsp;', ' ', $_POST['email_content']);
	fwrite($myfile, $txt);
	fclose($myfile);
	echo 'success';
}



?>