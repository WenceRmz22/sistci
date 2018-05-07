<?php 
    if(isset($_GET['id'])){
        $sql ="DELETE FROM  trgastos  WHERE gasId=".$_GET['id'];
        $query = $db->prepare($sql);
	    $query->execute();
    }
    $selCapital = "SELECT SUM(trdetamount) as monto FROM trinvoicedetails";
    $query2 = $db->prepare($selCapital);
    $query2->execute();
    $Capital = $query2->fetch(PDO::FETCH_OBJ);
    $totalCapital = $Capital->monto;

    $selGastos = "SELECT SUM(gasmonto) as monto FROM trgastos";
    $query3 = $db->prepare($selGastos);
    $query3->execute();
    $gastos = $query3->fetch(PDO::FETCH_OBJ);
    $totalGastos = $gastos->monto;
    if($totalGastos == ""){
        $tot =  $totalCapital;
        $totalGastos = 0;
    }
    else{ 
        $tot =  (FLOAT)$totalCapital-(FLOAT)$totalGastos;
    } 
?>
<div class="panel panel-default">
  <div class="panel-heading"><B>GASTOS</B></div>
    <div class="panel-body">
    <div class="line line-dashed line-lg pull-in"></div>
        <div class="row form-horizontal">
            <div class="col-md-6 " style="border-left-color: black;">
                <div class="row">
                    <div class="col-md-3 ">
                        <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#basicModal">
                        + ADD </a>
                    </div>
                </div>
                <br>
                <table id="gastos" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th width="50"><center>Clave</center></th>
                            <th width="310"><center>Description</center></th>
                            <th width="150"><center>Monto</center></th>
                            <th  width="50"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $sqlTable = "SELECT gasId,
                                            gasDescription,
                                            gasMonto
                                            FROM trGastos TR
                                            Order by gasId desc";
                            $query = $db->prepare($sqlTable);
                            $query->execute();
                            while ($row = $query->fetch(PDO::FETCH_OBJ))
                            {
                                //$arr = array("InvCruDateCrossing"=>$row->DateCrossing,"InvCruTrailerNumber"=>$row->trailerNumber,"InvCruAmount"=>$row->CruAmount,"InvCruDescription"=>$row->Description,"txtInvCruFrom"=>$row->CruFrom,"InvNum"=>$row->InvNum);
                                    echo    "<tr>";
                                    echo    "<td><center>".$row->gasId."</center></td>";
                                    echo    "<td><center>".$row->gasDescription."</center></td>";
                                    echo   "<td><center>$".$row->gasMonto."</center></td>";
                                    echo   "<td><center><a class='btn btn-primary btn-sm' href='admin.php?m=trGastos&id=".$row->gasId."'><i class='fa fa-trash' aria-hidden='true'></i></a></center>";
                                    echo   "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label col-sm-5" >Capital:</label>
                        <div class="col-sm-5">
                            <input type='text'  value="<?php echo '$'.$totalCapital; ?>" text="" class="form-control" disabled id="txtTotalCap" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-5" >Gastos:</label>
                        <div class="col-sm-5">
                            <input type='text'  value="<?php echo '$'.$totalGastos; ?>" text="" class="form-control" disabled id="txtGastos" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-5" >Total:</label>
                        <div class="col-sm-5">
                            <input type='text'  value="<?php echo '$'.$tot; ?>" text="" class="form-control" disabled id="txtTotal" />
                        </div>
                    </div>
            </div>
        </div>

    </div>
  </div>
</div>
<div class="modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">GASTOS</h4>
      </div>
      <div class="modal-body">
        <div class="row form-horizontal">
            <div class="col-md-7">
                    <div class="form-group">
                        <label class="control-label col-sm-4" >Description:</label>
                        <div class="col-sm-8">
                            <input type='text'  value="" text="" class="form-control"  id="txtDescript" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" >Amount:</label>
                        <div class="col-sm-8">
                            <input type='text'  value="" text="" class="form-control"  id="txtGastosActual" />
                        </div>
                    </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="saveGastos" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>