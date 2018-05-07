<?php
   /* include '../db.php';
    $year            = $_POST['year'];
    $claveCliente    = $_POST['cliente'];
    $nombre          = $_POST['nombre'];
   // $mes            = 1;
    $arrayFinal     = array();
    $arrayAuxiliar  = array();
    $arratAuxiliar2 = array();
    $months = array('ENERO','FEBRERO','MARZO','ABRIL','MAYO','JUNIO','JULIO','AGOSTO','SEPTIEMBRE','OCTUBRE','NOVIEMBRE','DICIEMBRE');
    for($i = 1; $i < 13;$i++)
    {
        $sql = "SELECT count(AtFechaPago) FROM AT001 WHERE MONTH(AtFechaPago) = ".$i." AND YEAR(AtFechaPago) = ".$year." AND AtClaveCliente='".$claveCliente."'";
        $datos = $db->query($sql);
        foreach($datos as $row){
            $arrayAuxiliar = array($months[$i -1],intval($row[0]));
            array_push($arratAuxiliar2,$arrayAuxiliar);
        }
        
       
        //echo $sql;
    }
    //array_push($arratAuxiliar2,);
    $arrayFinal = array("name"=>$nombre,"id"=>$claveCliente,"data"=>$arratAuxiliar2);
    echo json_encode($arrayFinal);*/
    include '../dbReplica.php';
    $year            = $_POST['year'];
    $claveCliente    = $_POST['cliente'];
    $nombre          = $_POST['nombre'];
   // $mes            = 1;
    $arrayFinal     = array();
    $arrayAuxiliar  = array();
    $arratAuxiliar2 = array();
    $months = array('ENERO','FEBRERO','MARZO','ABRIL','MAYO','JUNIO','JULIO','AGOSTO','SEPTIEMBRE','OCTUBRE','NOVIEMBRE','DICIEMBRE');
    for($i = 1; $i < 13;$i++)
    {
        $sql = "SELECT count(D001FECPAG) FROM AT001 WHERE MONTH(D001FECPAG) = ".$i." AND YEAR(D001FECPAG) = ".$year." AND C001CVECLI='".$claveCliente."'";
        $datos = $bdd->query($sql);
        foreach($datos as $row){
            $arrayAuxiliar = array($months[$i -1],intval($row[0]));
            array_push($arratAuxiliar2,$arrayAuxiliar);
        }
        
       
        //echo $sql;
    }
    //array_push($arratAuxiliar2,);
    $arrayFinal = array("name"=>$nombre,"id"=>$claveCliente,"data"=>$arratAuxiliar2);
    echo json_encode($arrayFinal);



?>