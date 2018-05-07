<?php 
	session_start();
	include '../db.php';
	$InvDate = $_GET["InvDate"];
	$InvNumber = $_GET["InvNumber"];
	$idUsuario  = $_SESSION['id'];
	$idPagina = 0;
	//echo "CALL spLoadInvoiceTr('".$InvDate."',".$InvNumber.",".$idUsuario.")";
	$query = $db->query("CALL spLoadInvoiceTr('".$InvDate."',".$InvNumber.",".$idUsuario.")");
	$row =  $query->fetchAll(PDO::FETCH_NUM);
	//$QueryBitacora = $db->query("CALL spInsBitacora('spLoadInvoice',".$row[0][0].",'". date("Y-m-d")."',".$idUsuario.",".$idPagina.")");
		//echo "CALL spInsBitacora('spLoadInvoice',".$row[0][0].",'". date("Y-m-d")."',".$idUsuario.",".$idPagina.")" ;
	echo $row[0][0];
	
 ?>