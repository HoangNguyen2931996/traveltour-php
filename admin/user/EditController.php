<?php 
	session_start();
    if(!isset($_SESSION['username'])){
        header("location:../../public/login.php");
    }
	include "../../functions/DbConnect.php";
	$id = $_GET['id'];
	$fullname = $_POST['fullname'];
	$password = "";
	if($_POST['password'] == ''){
		$query = "SELECT * FROM user WHERE id_user = '$id'";
		$result = $mysqli -> query($query);
		$objUser = mysqli_fetch_assoc($result);
		$password = $objUser['password'];
	} else{
		$password = md5($_POST['password']);
	}
	$role = $_POST['role'];
	$query = "UPDATE user SET  fullname = '{$fullname}', password = '{$password}', role = '{$role}' WHERE id_user = '{$id}'";
	$result = $mysqli ->query($query);
	if($result){
		header("location:index.php?msg=1");
	} else{
		header("location:index.php?msg=0");
	}
?>