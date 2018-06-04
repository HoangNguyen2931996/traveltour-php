<?php
	session_start();
	unset($_SESSION["username"]);
	unset($_SESSION['fullname']);
	unset($_SESSION['idUser']);
	header("location:login.php");
?>