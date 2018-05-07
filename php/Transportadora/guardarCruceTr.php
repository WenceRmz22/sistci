<?php 
	session_start();
	include '../db.php';
	$trDetDateCrossing = $_GET["trDetDateCrossing"];
	$trDetTrailerNumber = $_GET["trDetTrailerNumber"];
	$trDetAmount = $_GET["trDetAmount"];
	$trDescriptionPedimento = $_GET["trDescriptionPedimento"];
	$trDescription  = $_GET["trDescription"];
	$trFrom = $_GET["trFrom"];
	$trDestination = $_GET["trDestination"];
	$trId = $_GET["trId"];
	$idInv = 0;
	if($trId  ==  0 ){
		$sqlInv = "SELECT max(trNumberInvoice) as NumeroFactura FROM trinvoice";
		$numInicial = 0;
		if($db->query($sqlInv)){
			foreach ($db->query($sqlInv) as $row) {
				// echo 'FAC-'.$row['NumeroFactura'];
				if($row['NumeroFactura'] <> 1){
					$numInicial = $row['NumeroFactura'] +1;
				}else{
					$numInicial = 5523;
				}
			}
		}
		
		$sqlInsertInvoice = "INSERT INTO trinvoice(trNumberInvoice,
			trDate,
			usuid,
			trActivo) 
			VALUES(".$numInicial.",'".date("Y-m-d")."',".$_SESSION['id'].",1)";
		$invConsul = $db->prepare($sqlInsertInvoice);
		$invConsul->execute(); 
		
		$sqlId = "SELECT max(trId) as numid FROM trinvoice";
		if($db->query($sqlId)){
			foreach ($db->query($sqlId) as $row) {
					$idInv = $row['numid'];
			}
		}
		$sql ="INSERT INTO trInvoiceDetails(trDetDateCrossing
									,trDetTrailerNumber
									,trDetAmount
									,trDescriptionPedimento
									,trDescription
									,trFrom
									,trDestination
									,trId) 
				values('".$trDetDateCrossing."','"
				.$trDetTrailerNumber."',"
				.$trDetAmount.",'"
				.$trDescriptionPedimento."','"
				.$trDescription."','"
				.$trFrom."','"
				.$trDestination."',"
				.$idInv.")";

			$stmt = $db->prepare($sql);
			$stmt->execute(); 


			$array1 =array("trId"=>$idInv,"InvNumber"=>$numInicial);
			echo json_encode($array1);
			//echo 
	}else{
			$sqlId = "SELECT trId as numid FROM trinvoice WHERE trNumberInvoice=".$trId;
			if($db->query($sqlId)){
				foreach ($db->query($sqlId) as $row) {
						$idInv = $row['numid'];
				}
			}
			$sql ="INSERT INTO trInvoiceDetails(trDetDateCrossing
									,trDetTrailerNumber
									,trDetAmount
									,trDescriptionPedimento
									,trDescription
									,trFrom
									,trDestination
									,trId) 
				values('".$trDetDateCrossing."','"
				.$trDetTrailerNumber."',"
				.$trDetAmount.",'"
				.$trDescriptionPedimento."','"
				.$trDescription."','"
				.$trFrom."','"
				.$trDestination."',"
				.$idInv.")";
				$array1 =array("trId"=>$idInv,"InvNumber"=>$trId);

			$stmt = $db->prepare($sql);
			$stmt->execute(); 
			echo json_encode($array1);

	}
	
 ?>