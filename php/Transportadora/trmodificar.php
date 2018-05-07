<script type="text/javascript">	
 $("#modifyRemisiones").hide();
	function traerCruces(id){
    var InvId = id;
   
		$.ajax({
			url:"php/llenarTablaTr.php",
			type:"GET",
			data:{"id":id,"clave":2}
		}).done(function(data){
      var response = $.parseJSON(data);
      location.hash = "#modifyRemisiones";
			$("#txttrDetDateCrossingUpt").val(response[0]["trDetDateCrossing"]);
			$("#txttrDetTrailerNumberUpt").val(response[0]["trDetTrailerNumber"]);
			$("#txttrDetAmountUpt").val(response[0]["trDetAmount"]);
			$("#txttrDescriptionPedimentoUpt").val(response[0]["trDescriptionPedimento"]);
      $("#txttrDescriptionUpt").val(response[0]["trDescription"]);
			$("#txttrFromUpt").val(response[0]["trFrom"]);
			$("#txttrDestinationUpt").val(response[0]["trDestination"]);
      $("#txttrIdUpt").val(InvId);
      
      $("#txttrDetDateCrossingUpt").prop('disabled', false);
			$("#txttrDetTrailerNumberUpt").prop('disabled', false);
			$("#txttrDetAmountUpt").prop('disabled', false);
			$("#txttrDescriptionPedimentoUpt").prop('disabled', false);
      $("#txttrDescriptionUpt").prop('disabled', false);
			$("#txttrFromUpt").prop('disabled', false);
			$("#txttrDestinationUpt").prop('disabled', false);
			/*for (var i = response.length - 1; i >= 0; i--) {
				$("#tablacruces tbody").append("<tr><td>"+response[i]["InvCruDateCrossing"]+"</td><td>"+response[i]["InvCruTrailerNumber"]+"</td><td>"+response[i]["InvCruAmount"]+"</td><td>"+response[i]["InvCruDescription"]+"</td><td>"+response[i]["txtInvCruFrom"]+"</td><td>"+response[i]["InvNum"]+"</td><tr>")
			}*/
		})	
	}
 function EliminarCruce(id){
		var InvId = id;
		$.ajax({
			url:"php/EliminarCrucetr.php",
			type:"GET",
			data:{"id":id}
		}).done(function(data){
			location.reload();
		})	
	}
	function actualizarCruce(){
		var trDetDateCrossing 		= $("#txttrDetDateCrossingUpt").val();
			var trDetTrailerNumber 		= $("#txttrDetTrailerNumberUpt").val();
			var trDetAmount 			= $("#txttrDetAmountUpt").val();
			var trDescriptionPedimento  = $("#txttrDescriptionPedimentoUpt").val();
			var trDescription		    = $("#txttrDescriptionUpt").val();
			var trFrom                  = $("#txttrFromUpt").val();
			var trDestination			= $("#txttrDestinationUpt").val();
			var trId					= $("#txttrIdUpt").val();
			$.ajax({
			url:"php/actualizarCrucetr.php",
			type:"GET",
			data:{"trDetDateCrossing":trDetDateCrossing,"trDetTrailerNumber":trDetTrailerNumber,
				"trDetAmount":trDetAmount,
				"trDescriptionPedimento":trDescriptionPedimento,"trDescription":trDescription,
				"trFrom":trFrom,"trDestination":trDestination,"trDetId":trId}
			}).done(function(data){	
				location.reload();
			});
	}
</script>
<style>
 table>tbody>tr>td>table>tbody>tr>td{
    border: 0px solid #dddddd;
    text-align: center;
    padding: 1px;
}
table>tbody>tr>td{
    border-right: 1px solid #dddddd;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #81F7F3;
}
 </style>
<div class="row">
	<div class="col-lg-12">
	  <button type="button"  class="btn btn-primary btn-sm pull-right" style="margin-top:10px;" data-toggle="modal" data-target="#myModal">
      <i class="fa fa-plus-square" aria-hidden="true"></i> Nueva Remision
		</button>
	</div>
</div>
<br>
<table id="example2" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                	<th width="200"><center>DATE OF CROSSING</center></th>
		    		<th width="150"><center>TRAILER NUMBER</center></th>
		    		<th width="150"><center>AMOUNT<center></th>
		    		<th width="250"><center>DESCRIPTION</center></th>
		    		<th width="100"><CENTER>FROM</CENTER></th>	
            <th>DESTINATION</th>
            			<th width="50"></th>
            </tr>
        </thead>
        <tbody>
            <?php 
    $sqlTable = "SELECT * FROM trinvoicedetails WHERE trId=".$_GET['id'];
    $query = $db->prepare($sqlTable);
	$query->execute();
	while ($row = $query->fetch(PDO::FETCH_OBJ))
	{
		//$arr = array("InvCruDateCrossing"=>$row->DateCrossing,"InvCruTrailerNumber"=>$row->trailerNumber,"InvCruAmount"=>$row->CruAmount,"InvCruDescription"=>$row->Description,"txtInvCruFrom"=>$row->CruFrom,"InvNum"=>$row->InvNum);
		    echo   "<tr>";
            echo   "<td><center>".substr($row->trDetDateCrossing,0,10)."</center></td>";
            echo   "<td><center>".$row->trDetTrailerNumber."</center></td>";
            echo   "<td><center>$".$row->trDetAmount."</center></td>";
            echo   "<td><center><table><tr ><td>".$row->trDescriptionPedimento."</td><td>".$row->trDescription."</td></tr></table></center></td>";
            echo   "<td><center>".$row->trFrom."</center></td>";
            echo   "<td><center>".$row->trDestination."</center></td>";
            echo   "<td><button  class='btn btn-primary btn-xs' Alt='Elegir' id='".$row->trDetId."' onClick='traerCruces(this.id)' ><i class='fa fa-pencil' aria-hidden='true'></i></button>";
	          echo   "<button  class='btn btn-primary btn-xs' style='margin-left:5px;' id='".$row->trDetId."' onClick='EliminarCruce(this.id)' ><i class='fa fa-trash' aria-hidden='true'></i></button></td>";
            echo   "</tr>";
	}
 ?>
        </tbody>
    </table>
<div class="line line-dashed line-lg pull-in"></div>
    <!-- Button trigger modal -->
<div class="row form-horizontal" id="modifyRemisiones">
			<input  class="form-control" id='txttrIdUpt' type="hidden"  />
      <div class="col-lg-6">
            <div class="form-group">
                <label class="control-label col-sm-5" >DATE OF CROSSING:</label>
                <div class="col-sm-7">
                      <input type='text' class="form-control" id='txttrDetDateCrossingUpt' disabled />
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
                  <input type='text' class="form-control" id='txttrDetTrailerNumberUpt' disabled />
            </div>
          </div>
      </div>                                                                                                                                                                                                                                                                            
      <div class="col-lg-6">
          <div class="form-group">
            <label class="control-label col-sm-5">AMOUNT:</label>
            <div class="col-sm-7">
                  <input type='text' class="form-control" id='txttrDetAmountUpt' disabled />
            </div>
          </div>
      </div>
      <div class="col-lg-6">
          <div class="form-group">
            <label class="control-label col-sm-5">DESCRIPTION (Pedimento):</label>
            <div class="col-sm-7">
                  <input type='text' class="form-control" id='txttrDescriptionPedimentoUpt' disabled />
            </div>
          </div>
      </div>
      <div class="col-lg-6">
          <div class="form-group">
            <label class="control-label col-sm-5">DESCRIPTION :</label>
            <div class="col-sm-7">
                  <input type='text' class="form-control" id='txttrDescriptionUpt' disabled />
            </div>
          </div>
      </div>
      <div class="col-lg-6">
          <div class="form-group">
            <label class="control-label col-sm-5">FROM:</label>
            <div class="col-sm-7">
                  <input type='text' class="form-control"  id='txttrFromUpt' disabled />
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
                  <input type='text' class="form-control"  id='txttrDestinationUpt' disabled />
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
      <div class="col-lg-6">
                <div class="form-group">
                  <button id="btnActualizar" onclick="actualizarCruce()" class="btn btn-primary  pull-right" ><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
                </div>
      </div>
</div>          
<!-- Modal -->
<div class="line line-dashed line-lg pull-in"></div><br><br>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

  <script type="text/javascript" src="js/bootstrap-datetimepicker.js"></script>
  <link rel="stylesheet" type="text/css" href="css/bootstrap-datetimepicker.css">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Agregar un cruce</h4>
      </div>
      <div class="modal-body">
        <input type="text" name="txtInvIdIns" type="hidden" value="<?php echo $_GET['id']; ?>" id="txtInvIdIns">
        <div class="row form-horizontal">
        	<div class="col-lg-6">
                <div class="form-group">
                  <label class="control-label col-sm-5" >DATE OF CROSSING:</label>
                  <div class="col-sm-7">
                  
                        <input type='text' class="form-control" id='txtInvCruDateCrossingDet'  />
                        <script type="text/javascript">
                    $('#txtInvCruDateCrossingDet').datetimepicker({
                              format: 'YYYY/MM/DD'  
                          });
                  </script>
                  </div>
                </div>
            </div>
            <div class="col-lg-6" >
                <div class="form-group">
                  <label class="control-label col-sm-5">TRAILER NUMBER:</label>
                  <div class="col-sm-7">
                        <input type='text' class="form-control" id='txtInvCruTrailerNumberDet'  />
                  </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                  <label class="control-label col-sm-5">AMOUNT:</label>
                  <div class="col-sm-7">
                        <input type='text' class="form-control" disabled value="90" id='txtInvCruAmountDet' disabled />
                  </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                  <label class="control-label col-sm-5">DESCRIPTION:</label>
                  <div class="col-sm-7">
                        <input type='text' class="form-control" id='txtInvCruDescriptionDet'  />
                  </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                  <label class="control-label col-sm-5">FROM:</label>
                  <div class="col-sm-7">
                        <input type='text' class="form-control" value="MAHLE" id='txtInvCruFromDet' disabled />
                  </div>
                </div>
            </div>
        </div>
        		    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="btnGuardarDet"  >Guardar</button>
      </div>
    </div>
  </div>
</div>