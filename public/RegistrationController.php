<?php 
	include "../functions/DbConnect.php";
	$username = $_POST['username'];
	$fullname = $_POST['fullname'];
	$password = md5($_POST['password']);
	$query = "INSERT INTO user(username, fullname, password, role) VALUES('{$username}', '{$fullname}', '{$password}', 'Customer')";
	$result = $mysqli -> query($query);
	if($result){
		
		header("location:registration.php?msg=1");
	} else{
		header("location:registration.php?msg=0");
	}
?>