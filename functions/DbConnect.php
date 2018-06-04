<?php
	$localhost = 'localhost';
	$username = 'root';
	$password = '';
	$database = 'traveltour';
	$mysqli = new mysqli($localhost, $username, $password, $database);
	$mysqli -> set_charset('utf8');
	if(mysqli_connect_error()){
		echo 'Có lỗi khi kết nối: '. mysqli_connect_error();
		die();
	}
 ?>