<?php 
	include "../functions/DbConnect.php";
	session_start();
	$username = $_POST['username'];
	$password = md5($_POST['password']);
	$query = "SELECT * FROM user WHERE username = '{$username}' AND password = '{$password}'";
	$result = $mysqli -> query($query);
	$objUser = mysqli_fetch_assoc($result);
	if($objUser){
		$_SESSION['username'] = $username;
		$_SESSION['fullname'] = $objUser['fullname'];
		$_SESSION['idUser'] = $objUser['id_user'];
		header("location:index.php");
	} else{
		header("location:login.php?error=0");
	}
?>