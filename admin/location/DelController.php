<?php 
	session_start();
    if(!isset($_SESSION['username'])){
        header("location:../../public/login.php");
    }
	include "../../functions/DbConnect.php";
	$id = $_GET['id'];
	$query = "DELETE FROM locations WHERE id ='{$id}'";
	$result = $mysqli ->query($query);
	if($result){
		$query = "UPDATE locations SET id_parent = '0' WHERE id_parent = '{$id}'";
		$result = $mysqli ->query($query);
		header("location:index.php?msg=1");
	} else{
		header("location:index.php?msg=0");
	}
?>