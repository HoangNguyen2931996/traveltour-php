<?php 
	session_start();
    if(!isset($_SESSION['username'])){
        header("location:../../public/login.php");
    }
	include "../../functions/DbConnect.php";
	$id = $_GET['id'];
	$query = "SELECT t.id As idTour, t.name As nameTour, t.id_location, l.name As nameLocation, t.id_departure, l.name As nameLocation, d.name As nameDeparture, date_created, number_days, item_tour, discount, images, programs, note FROM tour As t INNER JOIN locations As l ON t.id_location = l.id INNER JOIN departures As d ON t.id_departure = d.id WHERE t.id = '{$id}'";
    $result = $mysqli -> query($query);
    $objTour = mysqli_fetch_assoc($result);
    $oldPicture = $objTour['images'];
	$query = "DELETE FROM tour WHERE id ='{$id}'";
	$result = $mysqli ->query($query);
	if($result){
		if($oldPicture != ""){

            $oPathPic = "../../upload/".$oldPicture;
            if (is_file($oPathPic)){
                unlink($oPathPic);
            }
		}
		header("location:index.php?msg=1");
	} else{
		header("location:index.php?msg=0");
	}
?>