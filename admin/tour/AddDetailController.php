<?php 
	session_start();
    if(!isset($_SESSION['username'])){
        header("location:../../public/login.php");
    }
	include "../../functions/DbConnect.php";
	$id = $_GET['id'];
	$date_depart = $_POST['string_date_depart'];
	$price = $_POST['price'];
	
	$time_depart = $_POST['time_depart'];
	$address_depart = $_POST['address_depart'];
	$slot = $_POST['slot'];
	$query = "INSERT INTO detailtour(date_depart, price, time_depart, address_depart, id_tour, slot) VALUES('{$date_depart}', '{$price}', '{$time_depart}', '{$address_depart}', '{$id}', '{$slot}')";
	$result = $mysqli ->query($query);
	if($result){
		header("location:indexdetail.php?id=".$id."&msg=1");
	} else{
		header("location:indexdetail.php?id=".$id."&msg=0");
	}
?>