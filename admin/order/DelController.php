<?php 
	session_start();
    if(!isset($_SESSION['username'])){
        header("location:../../public/login.php");
    }
	include "../../functions/DbConnect.php";
	$id = $_GET['id'];
	$query = "DELETE FROM personorder WHERE id = '{$id}'";
	$result = $mysqli ->query($query);
	if($result){
		$query = "DELETE FROM traveler WHERE id_personorder = '{$id}'";
		$result = $mysqli ->query($query);
		
		header("location:index.php?msg=1");
	} else{
		header("location:index.php?msg=0");
	}
?>