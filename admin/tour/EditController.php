<?php 
	session_start();
    if(!isset($_SESSION['username'])){
        header("location:../../public/login.php");
    }
	include "../../functions/DbConnect.php";
	$id = $_GET['id'];
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
	$query = "SELECT t.id As idTour, t.name As nameTour, t.id_location, l.name As nameLocation, t.id_departure, l.name As nameLocation, d.name As nameDeparture, date_created, number_days, item_tour, discount, images, programs, note FROM tour As t INNER JOIN locations As l ON t.id_location = l.id INNER JOIN departures As d ON t.id_departure = d.id WHERE t.id = '{$id}'";
    $result = $mysqli -> query($query);
    $objTour = mysqli_fetch_assoc($result);
    $oldPicture = $objTour['images'];
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
            if($oldPicture != ""){

            $oPathPic = "../../upload/".$oldPicture;
            if (is_file($oPathPic)){
                unlink($oPathPic);
            }
		}
        }else{
            header("location:index.php?msg=0");
            exit();
        }
        
    }
	$query = "UPDATE tour SET  name= '{$name}', id_location= '{$id_location}', id_departure= '{$id_departure}', number_days= '{$number_days}', item_tour= '{$tourCat}', discount='{$discount}', images='{$picture}', programs = '{$programs}', note = '{$note}'  WHERE id= '{$id}'";
	$result = $mysqli ->query($query);
	if($result){
		header("location:index.php?msg=1");
	} else{
		header("location:index.php?msg=0");
	}
?>