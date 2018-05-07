<?php 

	include '../db.php';
	$id = $_GET["id"];
	$clave = $_GET["clave"];
	if ($clave == 1) {
		$sql = "SELECT 	trDetId ,
		trDetDateCrossing,
		trDetTrailerNumber,
		trDetAmount,
		trDescriptionPedimento,
		trDescription,
		trFrom,
		trDestination,
		usunombre,
		ID.trId
		FROM trInvoiceDetails ID join trInvoice IC on ID.trId = IC.trId
		JOIN usuarios US ON IC.usuid = US.usuid
		WHERE ID.trId =".$id;
	}
	if($clave == 2){
		$sql = "SELECT  
						trDetId,
						trDetDateCrossing,
						trDetTrailerNumber,
						trDetAmount,
						trDescriptionPedimento,
						trDescription,
						trFrom,
						trDestination,
						'' as usunombre,
						TI.trId
				FROM trinvoice TI
					join trinvoicedetails TD on TI.trId = TD.trId 
				WHERE TD.trDetId=".$id;
	}
	
	$querySql = [];
	$query = $db->prepare($sql);
	$query->execute();
	while ($row = $query->fetch(PDO::FETCH_OBJ))
	{
		$arr = array("trDetId"=>$row->trDetId,"trDetDateCrossing"=>substr($row->trDetDateCrossing,0,10),"trDetTrailerNumber"=>$row->trDetTrailerNumber,"trDetAmount"=>$row->trDetAmount,"trDescriptionPedimento"=>$row->trDescriptionPedimento,"trDescription"=>$row->trDescription,"trFrom"=>$row->trFrom,"trDestination"=>$row->trDestination,"usunombre"=>$row->usunombre,"trId"=>$row->trId);
		array_push($querySql, $arr);
	}
	echo json_encode($querySql);
	//print_r($row);
	//echo count($row);
	
	/*if ($resultado = mysqli_query($db,$sql)) {
			while ($fila =$resultado->fetch_row()) {
				$arr = array("InvCruDateCrossing"=>$fila[0],"InvCruTrailerNumber"=>$fila[1],"InvCruAmount"=>$fila[2],"InvCruDescription"=>$fila[3],"txtInvCruFrom"=>$fila[4],"InvNum"=>$fila[5]);
				array_push($querySql, $arr);
			}
		
		$db->close();
	} else {
	    echo "Error: " . $sql . "<br>" . mysqli_error($db);
	    $db->close();
	}*/
	
 ?>