<?php 
	if(!isset($_SESSION['username'])){
		header("location:../public/login.php");
	}
?>