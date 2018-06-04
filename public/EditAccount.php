<?php 
	session_start();
    if(!isset($_SESSION['username'])){
        header("location:login.php");
    }
	include "../functions/DbConnect.php";
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
	
	$query = "UPDATE user SET  fullname = '{$fullname}', password = '{$password}' WHERE id_user = '{$id}'";
	$result = $mysqli ->query($query);
	if($result){
		header("location:account.php?id=".$id."&msg=1");
	} else{
		header("location:account.php?id=".$id."&msg=1");
	}
?>