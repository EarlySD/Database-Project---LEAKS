<?php

	$dbhost = 'localhost';
	$username = 'root';
	$password = '';
	$db = 'leaks';
	
	$con = mysqli_connect("$dbhost", "$username", "$password");
	
	mysqli_select_db($con,"$db");
?>
