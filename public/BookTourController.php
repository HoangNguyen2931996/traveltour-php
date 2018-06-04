<?php
	include "../functions/DbConnect.php";
	session_start();
	$idDetail = $_GET['id']; 
	$name_orderer = $_POST['name_orderer'];
	$mail_orderer = $_POST['mail_orderer'];
	$phone_orderer = $_POST['phone_orderer'];
	$address_orderer = $_POST['address_orderer'];
	$number = $_POST['number'];
	$note_orderer = $_POST['note_orderer'];
	$id_user = $_SESSION['idUser'];
	$name_traveler = $_POST['name_traveler'];
	$gender_traveler = $_POST['gender_traveler'];
	$birth_traveler = $_POST['birth_traveler'];


	$query = "INSERT INTO personorder(name, email, phone, address, note, idDetail, num_passenger, id_user) VALUES('{$name_orderer}','{$mail_orderer}','{$phone_orderer}','{$address_orderer}','{$note_orderer}','{$idDetail}','{$number}', '{$id_user}')";
	$result = $mysqli ->query($query);
	if($result){
		$id =  $mysqli ->insert_id;
		for($i=0; $i < count($name_traveler); $i++){ 
			$query = "INSERT INTO traveler(name, gender, birth, id_personorder) VALUES('{$name_traveler[$i]}', '{$gender_traveler[$i]}', '{$birth_traveler[$i]}', '{$id}')";
			$result = $mysqli ->query($query);
		}

		header("location:bookstep1.php?id=".$idDetail."&msg=1");
	} else{
		header("location:bookstep1.php?id=".$idDetail."&msg=0");
	}
	

?>