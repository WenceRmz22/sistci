<?php 
    include '../db.php';
    $arrayTemp = array();
    $Consulta1 ="SELECT COUNT(AtNumeroPedimento) AS total, AtClaveCliente 
                FROM at001 
                WHERE AtClaveCliente='MAH#6' OR
                        AtClaveCliente='MAH#3' OR
                        AtClaveCliente='00011' or
                        AtClaveCliente='INTERF' OR
                        AtClaveCliente='DUDEK' OR
                        AtClaveCliente='WG PLU' or
                        AtClaveCliente='BREMBO' OR
                        AtClaveCliente='AFTERMARKET' OR
                        AtClaveCliente='COMOSA' OR
                        AtClaveCliente='C-AGRICO' or
                        AtClaveCliente='MATTSA-FURNA' OR
                        AtClaveCliente='NOVOTEK' OR
                        AtClaveCliente='UTILITY' OR
                        AtClaveCliente='C.ZAC' OR
                        AtClaveCliente='C.NAVA' OR
                        AtClaveCliente='BALL' OR
                        AtClaveCliente='000169' or
                        AtClaveCliente='R.A. PHILLIP' OR
                        AtClaveCliente='ALD TR'
                group by AtClaveCliente
                ORDER BY total desc;";
    /*echo $Consulta1;
    data: [ {
        name: 'MAHLE DE MEXICO - MAH#3',
        y: 12120,
        drilldown: 'MAHLE DE MEXICO - MAH#3'
    }]*/
    $query1 =$bdd->prepare($Consulta1);
    $query1->execute();
    while($row1 = $query1->fetch(PDO::FETCH_OBJ)){
        $arrayTemp = array( "name"=> $row1->$AtClaveCliente
                            ,"y" => $row1->total
                            ,"drilldown"=>$row1->AtClaveCliente);
    }

    echo json_encode($arrayTemp);
?>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         