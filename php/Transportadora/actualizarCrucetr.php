<?php 
	include '../db.php';
	$trDetDateCrossing = $_GET["trDetDateCrossing"];
	$trDetTrailerNumber = $_GET["trDetTrailerNumber"];
	$trDetAmount = $_GET["trDetAmount"];
	$trDescriptionPedimento = $_GET["trDescriptionPedimento"];
	$trDescription  = $_GET["trDescription"];
	$trFrom = $_GET["trFrom"];
	$trDestination = $_GET["trDestination"];
	$trId = $_GET["trDetId"];
	$sql = "UPDATE trinvoicedetails 
			SET trDetDateCrossing='".$trDetDateCrossing."',trDetTrailerNumber='".$trDetTrailerNumber."',trDetAmount=".$trDetAmount.",trDescriptionPedimento='".$trDescriptionPedimento.
				"',trDescription='".$trDescription.
				"',trFrom='".$trFrom.
				"',trDestination='".$trDestination."' WHERE trDetId=".$trId;
	$stmt = $db->prepare($sql);
    $stmt->execute(); 

 ?>