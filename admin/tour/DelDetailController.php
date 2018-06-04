<?php 
	session_start();
    if(!isset($_SESSION['username'])){
        header("location:../../public/login.php");
    }
	include "../../functions/DbConnect.php";
	$id = $_GET['id'];
	$idTour = $_GET['idTour'];
	$query = "DELETE FROM detailtour WHERE id = '{$id}'";
	$result = $mysqli ->query($query);
	if($result){
		header("location:indexdetail.php?id=".$idTour."&msg=1");
	} else{
		header("location:indexdetail.php?id=".$idTour."&msg=0");
	}
?>