<?php 
  /*$sql = "SELECT max(trNumberInvoice) as NumeroFactura FROM trinvoice";
  
  $numInicial = 5121;
  if($db->query($sql)){
    foreach ($db->query($sql) as $row) {
        if(!empty($row['NumeroFactura'])){
            $numInicial = $row['NumeroFactura'];
        }
    }
  }*/
  $hoy = date("Y-m-d");
 
 ?>
 <style>
 table>tbody>tr>td>table>tbody>tr>td{
    border: 0px solid #dddddd;
    text-align: center;
    padding: 1px;
}
table>tbody>tr>td{
    border: 1px solid #dddddd;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
 </style>
<div class="panel panel-default">
  <div class="panel-heading">Formato</div>
  <div class="panel-body">
        <div class="row form-horizontal">
            <div class="col-lg-8">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="control-label col-sm-5" >ASSIGNED INVOICE:</label>
                        <div class="col-sm-7">
                            <input type='text'  value="" text="" class="form-control" id="txtInvNum" />
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="control-label col-sm-5" >DATE:</label>
                        <div class="col-sm-7">
                            <input type='text'  value="<?php echo $hoy; ?>" text="<?php echo $hoy; ?>" class="form-control" disabled id="txtInvDate" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr />
  		<div class="row form-horizontal">
  			<!--<div class="col-lg-4">
            <div class="form-group">
              <label class="control-label col-sm-5" for="email">Invoice date:</label>
              <div class="col-sm-7">
                    <input type='text'  class="form-control" value="<?php echo $hoy; ?>" id='InvDate' disabled />
                  <script type="text/javascript">
                      $(function () {
                          $('#InvDate').datetimepicker({
                              format: 'YYYY/MM/DD'  
                          });
                          $('#txtInvCruDateCrossing').datetimepicker({
                              format: 'YYYY/MM/DD'  
                          });
                      });
                  </script>
              </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-5" >Invoice Num:</label>
                <div class="col-sm-7">
                      <input type='text'  value="<?php echo $numInicial+1; ?>" text="<?php echo $numInicial + 1; ?>" class="form-control" disabled id="txtInvNum" />
                </div>
            </div>
            <input value="0" type="hidden"  id="txtInvId">            
            <span id="ErrorMsg"  class="pull-right"></span>

            <div class="form-group">
                <div class="col-sm-6 pull-right ">
                  <button class="btn btn-success" id="btnAsignarTr"  >Asignar</button>
                      <button class="btn btn-primary"  id="btnNuevoTr" >Nuevo</button>
                </div>
            </div>
  			</div>-->
        <div class="col-lg-8">
            <div class="col-lg-6">
                <div class="form-group">
                    <input value="0" type="hidden"  id="txtInvId">  
                  <label class="control-label col-sm-5" >DATE OF CROSSING:</label>
                  <div class="col-sm-7">
                        <input type='text' class="form-control" id='txttrDetDateCrossing'  />
                    <script type="text/javascript">
                      $(function () {
                          $('#txttrDetDateCrossing').datetimepicker({
                              format: 'YYYY/MM/DD'  
                          });
                          $('#txtInvCruDateCrossing').datetimepicker({
                              format: 'YYYY/MM/DD'  
                          });
                      });
                    </script>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" >
                <div class="form-group">
                  <label class="control-label col-sm-5">TRAILER NUMBER:</label>
                  <div class="col-sm-7">
                        <input type='text' class="form-control" id='txttrDetTrailerNumber'  />
                  </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                  <label class="control-label col-sm-5">AMOUNT:</label>
                  <div class="col-sm-7">
                        <input type='text' class="form-control" id='txttrDetAmount'  />
                  </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                  <label class="control-label col-sm-5">DESCRIPTION (Pedimento):</label>
                  <div class="col-sm-7">
                        <input type='text' class="form-control" id='txttrDescriptionPedimento'  />
                  </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                  <label class="control-label col-sm-5">DESCRIPTION :</label>
                  <div class="col-sm-7">
                        <input type='text' class="form-control" id='txttrDescription'  />
                  </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                  <label class="control-label col-sm-5">FROM:</label>
                  <div class="col-sm-7">
                        <input type='text' class="form-control"  id='txttrFrom'  />
                        <script>
                          $( function() {
                            var availableTags = [
                                "CIRRUS",
                                "FJ",
                                "GST",
                                "M13",
                                "MAHLE",
                                "METALDYNE",
                                "MOR",
                                "PHILLIPS",
                                "VIA EXP"
                                ];
                                $( "#txttrFrom" ).autocomplete({
                                source: availableTags
                                });
                            });
                        </script>
                  </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                  <label class="control-label col-sm-5">DESTINATION:</label>
                  <div class="col-sm-7">
                        <input type='text' class="form-control"  id='txttrDestination'  />
                        <script>
                          $( function() {
                            var availableTags = [
                                "CIRRUS",
                                "FJ",
                                "GST",
                                "M13",
                                "MAHLE",
                                "METALDYNE",
                                "MOR",
                                "PHILLIPS",
                                "VIA EXP"
                                ];
                                $( "#txttrDestination" ).autocomplete({
                                source: availableTags
                                });
                            });
                        </script>
                  </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                  <button id="btnGuardarTr" type="button" class="btn btn-primary  pull-right">Guardar</button>
                  <button id="btnNuevoTr" type="button" class="btn btn-primary  pull-right" style="margin-right:5px;">Nueva Remision</button>
                </div>
            </div>
          </div>
    	</div>
    </div>
      
      <div class="line line-dashed line-lg pull-in"></div>
      <div  id="tbl">
            <table class="table table-responsive" id="tablacruces" style=" text-align: center; ">
                <thead>
                    <tr>
                        <th><center>DATE OF CROSSING</center></th>
                        <th width=""><center>TRAILER NUMBER</center></th>
                        <th width=""><center>AMOUNT<center></th>
                        <th width=""><center>DESCRIPTION</center></th>
                        <th width=""><CENTER>FROM</CENTER></th>	
                        <th>DESTINATION</th>
                        <th width=""><center>CREATED BY</center></th>
                    </tr>
                </thead>
                <tbody> </tbody>
            </table>
        </div>
  </div>
</div>