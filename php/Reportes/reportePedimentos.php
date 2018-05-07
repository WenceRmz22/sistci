<?php
		
		include '../dbReplica.php';
		$DateInicial =  $_GET['DateInicial'];
		$DateFinal =  	$_GET['DateFinal'];
		$FechaInicial 		= date('Y-m-d', strtotime($DateInicial));
		$FechaFinal 		= date('Y-m-d', strtotime($DateFinal));
		$aduana 	  = $_GET['AduSec'];
		$tipop          =  $_GET['tipop'];
		$NoCliente      =  $_GET['txtClave'];
		$Aduana         =  240;
		$array1         = array();
		$array2         = array();
		$array3         = array();
		$array4         = array();
		$IGIIGE 		= 0;
		$DTA    		= 0;
		$IVA    		= 0;
		$PREV   		= 0;
		$TodosImpuesto 	= 0;
		$IdTemporal     = 0;
		$cve            = $_GET['cve'];
		//$clv            = '';
		if($cve != 'T'){
		 $clv = "AND  C001CVEDOC='".$cve."'";
		}
		//Consultas
		$Consulta1 ="SELECT SQL_BIG_RESULT C001PATEN AS PATENTE,
		C001ADUSEC AS ADUANA,
		C001REFPED AS REFERENCIA,
		C001NUMPED AS NUMEROPEDIMENTO,
		D001FECPAG AS FECHAPAGO,
		C001CVEDOC AS CLAVE,
		F001VALCOE AS VALORCOMERCIAL,
		N001TOTINC AS INCREMENTABLE,
		F001TIPCAM AS TIPODECAMBIO, 
		C001TIPREG AS REGIMEN,
		C001FIRELE AS FIRMAVALIDACION,
		C001FIRBAN AS FIRMAPAGO,
		C001MEDTRS AS MEDIOTRANSPORTE 
		FROM AT001 
		WHERE  C001CVECLI = '".$NoCliente."' AND C001TIPOPE=".$tipop." AND C001ADUSEC='".$Aduana."' AND  D001FECPAG BETWEEN '".$FechaInicial."' AND '".$FechaFinal."' ".$clv." ORDER BY(D001FECPAG)";
		//echo $Consulta1;
		$query1 =$bdd->prepare($Consulta1);
		$query1->execute();
		while($row1 = $query1->fetch(PDO::FETCH_OBJ)){
			$IdTemporal = $IdTemporal + 1;
			$arrayTemp = array( "IdTemporal"=>$IdTemporal
								,"PATENTE" => $row1->PATENTE
								,"ADUANA"=>$row1->ADUANA
								,"REFERENCIA"=>$row1->REFERENCIA
								,"NUMEROPEDIMENTO"=>$row1->NUMEROPEDIMENTO
								,"FECHAPAGO"=>$row1->FECHAPAGO
								,"CLAVE"=>$row1->CLAVE
								,"VALORCOMERCIAL"=>$row1->VALORCOMERCIAL
								,"INCREMENTABLE"=>$row1->INCREMENTABLE
								,"TIPODECAMBIO"=>$row1->TIPODECAMBIO
								,"REGIMEN"=>$row1->REGIMEN
								,"FIRMAVALIDACION"=>$row1->FIRMAVALIDACION
								,"FIRMAPAGO"=>$row1->FIRMAPAGO
								,"MEDIOTRANSPORTE"=>$row1->MEDIOTRANSPORTE);
			array_push($array1, $arrayTemp);
		}
		 //echo 'Consulta 1  : '.$Consulta1;
			for ($i=0; $i <count($array1); $i++) { 
				//CONSULTA AT005
				$consulta2 = "SELECT SQL_SMALL_RESULT  C005NOMPRO AS PROVEEDOR
									,C005NUMFAC AS FACTURA
									,D005FECFAC AS FECHAFACTURA
									,C005EDOC AS COVE
									, C005IDEPRO AS TAXID
									, C005PAISPR AS IDPAIS 
							 FROM AT005 
							 WHERE C005REFPED='".$array1[$i]["REFERENCIA"]."' AND C005NUMPED='".$array1[$i]["NUMEROPEDIMENTO"]."' AND C005ADUSEC='".$array1[$i]['ADUANA']."'
							  AND C005PATEN=3649";
				$query2 = $bdd->prepare($consulta2);
				$query2->execute();
				$arrayTemp2 = array();
				while ($row =$query2->fetch(PDO::FETCH_OBJ) ) {
					$arrayTemp2 = array("Id05"=>$array1[$i]["IdTemporal"]
										,"PROVEEDOR"=>$row->PROVEEDOR
										,"FACTURA"=>$row->FACTURA
										,"FECHAFACTURA"=>$row->FECHAFACTURA
										,"COVE"=>$row->COVE
										,"TAXID"=>$row->TAXID
										,"IDPAIS"=>$row->IDPAIS);
					array_push($array2,$arrayTemp2);
				}
	
	
	
				//CONSULTA AT016
				$consulta3 ="SELECT  SQL_SMALL_RESULT C016FRAC AS FRACCION
									,C016DESMER AS DESCRIPCION
									,F016CANUMC AS CANTIDAD
									,F016VALDOL AS VALDOLARES
									,C016PAISOD AS PV
									,C016PAISCV AS PO
									,N016VALCOM AS VALORP
									,N016VALADU AS VALPESOS 
							 FROM AT016 
							 WHERE C016NUMPED='".$array1[$i]["NUMEROPEDIMENTO"]."' AND C016REFPED='".$array1[$i]["REFERENCIA"]."' AND C016ADUSEC='".$array1[$i]['ADUANA']."'
							  AND C016PATEN=3649";
				$query3 = $bdd->prepare($consulta3);
				$query3->execute();
				while ($row3 =$query3->fetch(PDO::FETCH_OBJ) ) {
					$arrayTemp3 = array("Id16"=>$array1[$i]["IdTemporal"]
										,"FRACCION"=>$row3->FRACCION
										,"DESCRIPCION"=>$row3->DESCRIPCION
										,"CANTIDAD"=>$row3->CANTIDAD
										,"VALDOLARES"=>$row3->VALDOLARES
										,"PV"=>$row3->PV
										,"PO"=>$row3->PO
										,"VALORP"=>$row3->VALORP
										,"VALPESOS"=>$row3->VALPESOS);
					array_push($array3,$arrayTemp3);
				}
				//CONSULTA AT008
				$consulta4 ="SELECT SQL_SMALL_RESULT  C008CVECON AS TITULO
									,N008IMPCON AS VALOR
									,C008CVEPAG AS CLAVEP
							 FROM AT008 
							 WHERE C008NUMPED='".$array1[$i]["NUMEROPEDIMENTO"]."' AND C008REFPED='".$array1[$i]["REFERENCIA"]."' AND C008ADUSEC='".$array1[$i]['ADUANA']."'
							  AND C008PATEN=3649";
				$query4 = $bdd->prepare($consulta4);
				$query4->execute();
				while ($row4 =$query4->fetch(PDO::FETCH_OBJ) ) {
					$arrayTemp4 = array("Id08"=>$array1[$i]["IdTemporal"]
										,"TITULO"=>$row4->TITULO
										,"VALOR"=>$row4->VALOR
										,"CLAVEP"=>$row4->CLAVEP);
					array_push($array4,$arrayTemp4);
				}
			}
		//echo count($array1);
		//echo json_encode($array1);
		//  print_r($array1[0]['REFERENCIA']);
		//Creacion del Excel
		require_once 'Classes/PHPExcel.php';
		// Crea un nuevo objeto PHPExcel
		$objPHPExcel = new PHPExcel();
		//Definir titulo
		if($tipop == 1){
			$tituloReporte = "REPORTE DE OPERACIONES DE IMPORTACION DEL ".$FechaInicial." AL ".$FechaFinal;
		}else{
			$tituloReporte = "REPORTE DE OPERACIONES DE EXPORTACION DEL ".$FechaInicial." AL ".$FechaFinal;
		}
		// Establecer propiedades
		$objPHPExcel->getProperties()
		->setCreator("TRAMITACIONES DE COMERCIO INTERCONTINENTAL")
		->setLastModifiedBy("TCI")
		->setTitle("REPORTE DE PEDIMENTOS")
		->setSubject("")
		->setDescription("")
		->setKeywords("Excel Office 2007 openxml php")
		->setCategory("Reporte Excel");
		//Tamano de celdas
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(14);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(16);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(80);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(14);
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(9);
		$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(9);
		$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(9);
		$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('X')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('Z')->setWidth(45);
		$objPHPExcel->getActiveSheet()->getColumnDimension('AA')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('AB')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('AC')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('AD')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('AE')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('AF')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('AG')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('AH')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('AI')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('AL')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('AM')->setWidth(100);
		$objPHPExcel->setActiveSheetIndex(0)
		->mergeCells('A1:AH1');
		// Agregar Informacion -Titulos
	
		$objPHPExcel->setActiveSheetIndex(0)
		->setCellValue('A1',$tituloReporte)
		->setCellValue('A2', "DEL CLIENTE: <".$NoCliente.">")
		->setCellValue('A3','REFERENCIA')
		->setCellValue('B3','PATENTE     ')
		->setCellValue('C3','ADUANA')
		->setCellValue('D3','PEDIMENTO')
		->setCellValue('E3','FRACCION')
		->setCellValue('F3','DESCRIPCION')
		->setCellValue('G3','CANTIDAD')
		->setCellValue('H3','VALOR DOLARES')
		->setCellValue('I3','VALOR PESOS')
		->setCellValue('J3','FECHA DE PAGO')
		->setCellValue('K3','CLAVE')
		->setCellValue('L3','P.V')
		->setCellValue('M3','P.O')
		->setCellValue('N3','VALOR COMERCIAL')
		->setCellValue('O3','INCREMENTABLE')
		->setCellValue('P3','AD VALOREM')
		->setCellValue('Q3','AD VALOREM - Tip. Pago')
		->setCellValue('R3','D.T.A')
		->setCellValue('S3','D.T.A - Tip. Pago')
		->setCellValue('T3','I.V.A')
		->setCellValue('U3','I.V.A - Tip. Pago')
		->setCellValue('V3','PREV')
		->setCellValue('W3','PREV - Tip. Pago')
		->setCellValue('X3','OTROS IMP.')
		->setCellValue('Y3','OTROS IMP - Tip. Pago')
		->setCellValue('Z3','PROVEEDOR')
		->setCellValue('AA3','FACTURA')
		->setCellValue('AB3','FECHA PAG.')
		->setCellValue('AC3','TIP. CAMBIO')
		->setCellValue('AD3','COVE')
		->setCellValue('AE3','TAX-ID')
		->setCellValue('AF3','ID PAIS')
		->setCellValue('AG3','REGIMEN')
		->setCellValue('AH3','FIRMA DE VALIDACION.')
		->setCellValue('AI3','FIRMA DE PAGO')
		->setCellValue('AJ3','MEDIO DE TRANSPORTE')
		->setCellValue('AK3','IDENTIFICADOR')
		->setCellValue('AL3','COMPLEMENTO')
		->setCellValue('AM3','OBSERVACIONES');
		//DATOS EN ARRAYS
		$i = 4;
		$fc = 0;
		for($d = 0;$d < count($array1);$d++ ){
			$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A'.$i,$array1[$d]['REFERENCIA'])
			->setCellValue('B'.$i,$array1[$d]['PATENTE'])
			->setCellValue('C'.$i,$array1[$d]['ADUANA'])
			->setCellValue('D'.$i,$array1[$d]['NUMEROPEDIMENTO'])
			->setCellValue('J'.$i,$array1[$d]['FECHAPAGO'])
			->setCellValue('K'.$i,$array1[$d]['CLAVE'])
			->setCellValue('N'.$i,$array1[$d]['VALORCOMERCIAL'])
			->setCellValue('O'.$i,$array1[$d]['INCREMENTABLE'])
			->setCellValue('AC'.$i,$array1[$d]['TIPODECAMBIO'])
			->setCellValue('AG'.$i,$array1[$d]['REGIMEN'])
			->setCellValue('AH'.$i,$array1[$d]['FIRMAVALIDACION'])
			->setCellValue('AI'.$i,$array1[$d]['FIRMAPAGO'])
			->setCellValue('AJ'.$i,$array1[$d]['MEDIOTRANSPORTE']);
			
			$SelObservaciones = "SELECT M010OBSERV FROM AT010 WHERE C010NUMPED='".$array1[$d]['NUMEROPEDIMENTO']."' AND C010ADUSEC='".$array1[$d]['ADUANA']."'
			 AND C010PATEN='3649'  AND  C010REFPED='".$array1[$d]['REFERENCIA']."'";
			$queryObservaciones = $bdd->prepare($SelObservaciones);
			while ($obser =$query4->fetch(PDO::FETCH_OBJ) ) {
				$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('AL'.$i,$obser->M010OBSERV);
			}

			$fc = $i;
			$ds = $i;
			$vl = $i;
			for($f = 0; $f < count($array2);$f++){
				if($array1[$d]['IdTemporal'] == $array2[$f]['Id05']){
					$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('Z'.$fc,$array2[$f]['PROVEEDOR'])
					->setCellValue('AA'.$fc,$array2[$f]['FACTURA'])
					->setCellValue('AB'.$fc,$array2[$f]['FECHAFACTURA'])
					->setCellValue('AD'.$fc,$array2[$f]['COVE'])
					->setCellValue('AE'.$fc,$array2[$f]['TAXID'])
					->setCellValue('AF'.$fc,$array2[$f]['IDPAIS']);
					$fc++;
				}
			}
			for($des = 0; $des < count($array3);$des++){
				if($array1[$d]['IdTemporal'] == $array3[$des]['Id16']){
					$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('E'.$ds,$array3[$des]['FRACCION'])
					->setCellValue('F'.$ds,$array3[$des]['DESCRIPCION'])
					->setCellValue('G'.$ds,$array3[$des]['CANTIDAD'])
					->setCellValue('H'.$ds,$array3[$des]['VALDOLARES'])
					->setCellValue('I'.$ds,$array3[$des]['VALPESOS'])
					->setCellValue('L'.$ds,$array3[$des]['PV'])
					->setCellValue('M'.$ds,$array3[$des]['PO']);
				   // ->setCellValue('Z'.$fc,$array2[$des]['VALORP']);
					$ds++;
				}
			}
			for($fac = 0; $fac < count($array4);$fac++){
				if($array1[$d]['IdTemporal'] == $array4[$fac]['Id08']){
					switch ($array4[$fac]["TITULO"]) {
							case 'IGI/IGE':
							$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('O'.$i,$array4[$fac]["VALOR"])
							->setCellValue('P'.$i,$array4[$fac]["CLAVEP"]);
							break;
							case 'DTA':
							$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('Q'.$i,$array4[$fac]["VALOR"])
							->setCellValue('R'.$i,$array4[$fac]["CLAVEP"]);
							break;
							case 'IVA':
							$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('S'.$i,$array4[$fac]["VALOR"])
							->setCellValue('T'.$i,$array4[$fac]["CLAVEP"]);
								break;
							case 'PREV':
							$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('U'.$i,$array4[$fac]["VALOR"])
							->setCellValue('V'.$i,$array4[$fac]["CLAVEP"]);
								break;						
							default:
							$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('W'.$i,$array4[$fac]["VALOR"])
							->setCellValue('X'.$i,$array4[$fac]["CLAVEP"]);
								break;
						}
				}
			}
	
			if ($fc > $ds) {
					$i = $fc+1;
			}else{
					$i = $ds+1;
			}
		}
	   
	  $objPHPExcel->getActiveSheet()->setTitle('Reporte de '.$NoCliente);
		// Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
		$objPHPExcel->setActiveSheetIndex(0);
		// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$NoCliente.'-'.date("Y-m-d H:i:s").'.xlsx"');
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		ob_end_clean();
		$objWriter->save('php://output');
		exit;
	
	  
	
 ?>