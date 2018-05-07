<?php
   /* include '../db.php';
    $year       = $_POST['year'];
    $top        = $_POST['top'];
   // $mes            = 1;
    $arrayFinal     = array();

     $sql = "SELECT  AtRazonSocial,
        AtClaveCliente as Cliente,
        count(AtFechaPago) as Cantidad 
        FROM at001 
        WHERE  YEAR(AtFechaPago) = ".$year." 
        group by AtClaveCliente 
        order by Cantidad desc LIMIT ".$top;

    $i = 1;
    $datos = $db->query($sql);
        foreach($datos as $row){
            $name = $i.".".$row[0];
            $arrayAuxiliar = array("name"=>$name,"y"=>intval($row[2]),"drilldown"=>$row[1]);
            $i = $i+1;
            array_push($arrayFinal, $arrayAuxiliar);
        }
    echo json_encode($arrayFinal);*/
    include '../dbReplica.php';
    $year       = $_POST['year'];
    $top        = $_POST['top'];
   // $mes            = 1;
    $arrayFinal     = array();

     $sql = "SELECT C001NOMCLI AS AtRazonSocial,
        C001CVECLI as Cliente,
        count(D001FECPAG) as Cantidad 
        FROM AT001  
        WHERE  YEAR(D001FECPAG) = ".$year." 
        group by C001CVECLI 
        order by Cantidad desc LIMIT ".$top;

    $i = 1;
    $datos = $bdd->query($sql);
        foreach($datos as $row){
            $name = $i.".".$row[0];
            $arrayAuxiliar = array("name"=>$name,"y"=>intval($row[2]),"drilldown"=>$row[1]);
            $i = $i+1;
            array_push($arrayFinal, $arrayAuxiliar);
        }
    echo json_encode($arrayFinal);


?>