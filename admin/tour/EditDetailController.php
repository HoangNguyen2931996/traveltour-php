<?php
	session_start();
    if(!isset($_SESSION['username'])){
        header("location:../../public/login.php");
    } 
	include "../../functions/DbConnect.php";
	$id = $_GET['id'];
	$idTour = $_GET['idTour'];
	$date_depart = $_POST['string_date_depart'];
	$price = $_POST['price'];
	
	$time_depart = $_POST['time_depart'];
	$address_depart = $_POST['address_depart'];
	$slot = $_POST['slot'];
	$query = "UPDATE detailtour SET date_depart = '{$date_depart}', price = '{$price}',  time_depart = '{$time_depart}', address_depart = '{$address_depart}', slot = '{$slot}' WHERE id = '{$id}'";
	$result = $mysqli ->query($query);
	if($result){
		header("location:indexdetail.php?id=".$idTour."&msg=1");
	} else{
		header("location:indexdetail.php?id=".$idTour."&msg=0");
	}
?>