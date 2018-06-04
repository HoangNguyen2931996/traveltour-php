<?php 
	session_start();
    if(!isset($_SESSION['username'])){
        header("location:../../public/login.php");
    }
	include "../../functions/DbConnect.php";
	$name = $_POST['name'];
	$idParent = $_POST['id_parent'];
	$query = "INSERT INTO locations(name, id_parent) VALUES('$name', '$idParent')";
	$result = $mysqli ->query($query);
	if($result){
		header("location:index.php?msg=1");
	} else{
		header("location:index.php?msg=0");
	}
?>