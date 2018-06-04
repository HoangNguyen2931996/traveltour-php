<?php 
	session_start();
    if(!isset($_SESSION['username'])){
        header("location:../../public/login.php");
    }
	include "../../functions/DbConnect.php";

	$id = $_GET['id'];
	$name = $_POST['name'];
	$query = "UPDATE departures SET  name= '{$name}' WHERE id = '{$id}'";
	$result = $mysqli ->query($query);
	if($result){
		header("location:index.php?msg=1");
	} else{
		header("location:index.php?msg=0");
	}
?>