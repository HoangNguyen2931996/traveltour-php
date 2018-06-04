<?php 
	session_start();
    if(!isset($_SESSION['username'])){
        header("location:../../public/login.php");
    }
	include "../../functions/DbConnect.php";
	$username = $_POST['username'];
	$fullname = $_POST['fullname'];
	$password = md5($_POST['password']);
	$role = $_POST['role'];
	$query = "INSERT INTO user(username, fullname, password, role) VALUES('{$username}', '{$fullname}', '{$password}', '{$role}')";
	$result = $mysqli ->query($query);
	if($result){
		header("location:index.php?msg=1");
	} else{
		header("location:index.php?msg=0");
	}
?>