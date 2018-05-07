<?php 

    if(isset($_GET['pay'])){
        $sql ="UPDATE trinvoice SET trActivo = 0   WHERE trId=".$_GET['pay'];
        $query = $db->prepare($sql);
	    $query->execute();
    }
?>
<div class="panel panel-default">
  <div class="panel-heading"><B>INVOICES</B></div>
    <div class="panel-body">
    <div class="line line-dashed line-lg pull-in"></div>
<div class="row">
    <div class="col-md-3 pull-left"> <a href="admin.php?m=resumen" class="btn btn-primary btn-sm">Ver Resumen</a></div>
</div>
<div class="line line-dashed line-lg pull-in"></div>
<div class="">
     <div class="col-md-9 col-md-offset-1">
        <table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th width="60"><center>Clave</center></th>
                    <th width="200"><center>Customer Number</center></th>
                    <th width="150"><center>Date</center></th>
                    <th width="90"><center>Created by</center></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $sqlTable = "SELECT trId,
                                       trNumberInvoice,
                                       trDate,
                                       (SELECT usunombre from usuarios WHERE usuid= TR.usuid) as usunombre
                                       ,trActivo
                                       FROM trinvoice TR
                                       WHERE trId <> 1 
                                       Order by trId desc";
                    $query = $db->prepare($sqlTable);
                    $query->execute();
                    while ($row = $query->fetch(PDO::FETCH_OBJ))
                    {
                        //$arr = array("InvCruDateCrossing"=>$row->DateCrossing,"InvCruTrailerNumber"=>$row->trailerNumber,"InvCruAmount"=>$row->CruAmount,"InvCruDescription"=>$row->Description,"txtInvCruFrom"=>$row->CruFrom,"InvNum"=>$row->InvNum);
                            echo    "<tr>";
                            echo    "<td><center>".$row->trId."</center></td>";
                            echo    "<td><center>".$row->trNumberInvoice."</center></td>";
                            echo    "<td><center>".substr($row->trDate,0,10)."</center></td>";
                            echo   "<td><center>".$row->usunombre."</center></td>";
                            echo   "<td><a class='btn btn-primary btn-sm' href='admin.php?m=trmodificar&id=".$row->trId."'><i class='fa fa-pencil' aria-hidden='true'></i></a>";
                            if($row->trActivo == 1){
                                echo   "<a style='margin-left:5px;' class='btn btn-primary btn-sm' href='admin.php?m=trbusqueda&pay=".$row->trId."'><i class='fa fa-money'></i></a>";
                           
                            }
                            echo   "<a target='_blanck' style='margin-left:5px;' class='btn btn-primary btn-sm' href='php/trreporte.php?id=".$row->trId."'><i class='fa fa-file-pdf-o' aria-hidden='true'></i></a></td>";
                            echo   "</tr>";
                    }
                ?>
            </tbody>
        </table>
     </div>
</div>

    </div>
  </div>
</div>
