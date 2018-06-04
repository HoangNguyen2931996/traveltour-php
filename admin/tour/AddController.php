<?php 
	session_start();
    if(!isset($_SESSION['username'])){
        header("location:../../public/login.php");
    }
	include "../../functions/DbConnect.php";
	$name = $_POST['nameTour'];
	$id_location = $_POST['id_location'];
	$id_departure = $_POST['id_departure'];
	$number_days = $_POST['number_days'];
	$itemTour = $_POST['itemTour'];
	$discount = $_POST['discount'];
	$programs = $_POST['programs'];
	$note = $_POST['note'];
	$tourCat = "";
	if($itemTour == 0){
		$tourCat = "Cao cấp";
	} else{
		$tourCat = "Tiêu chuẩn";
	}

	$arPic = $_FILES['picture'];
    $picture = "";
    if ($arPic['name'] != ""){ 
        $tmp = explode(".",$arPic['name']);
        $ext = end($tmp);
        $picture = "pic-".microtime().".{$ext}";

        if ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif' || $ext == 'png') {
            $tmpFile = $arPic['tmp_name'];
            $pathUpload = "../../upload/{$picture}";
            
            move_uploaded_file($tmpFile,$pathUpload);
        }else{
            header("location:index.php?msg=0");
            exit();
        }
        
    }
	$query = "INSERT INTO tour(name, id_location, id_departure, number_days, item_tour, discount, images, programs, note) VALUES('{$name}', '{$id_location}', '{$id_departure}', '{$number_days}', '{$tourCat}', '{$discount}', '{$picture}', '{$programs}', '{$note}')";
	$result = $mysqli ->query($query);
	if($result){
		header("location:index.php?msg=1");
	} else{
		header("location:index.php?msg=0");
	}
?>