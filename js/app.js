$(document).ready(function(){

	//Devextrema begin
	function bindInvoice(){
		$.ajax({
			url : "php/TraerIdInv.php",
			type : "GET",
			data : {"InvDate":InvDate,"CustumerNum":CustumerNum,"InvNumber":InvNumber}
		}).done(function(data){
				$("#txtInvId").val(data);
				$("#txtInvCruDateCrossing").prop('disabled', false);
				$("#txtInvCruTrailerNumber").prop('disabled', false);
				$("#txtInvCruDescription").prop('disabled', false);
				$("#txtInvCruAmount").prop('disabled', false);
			  });
	}
	var employees = [{
		"ID": 1,
		"CustomerNumber": "John",
		"Invoice": "Heart",
		"Date": "1964/03/16",
	}];
	$("#gridContainer").dxDataGrid({
        dataSource: employees,
        keyExpr: "ID",
        editing: {
            mode: "popup",
            allowUpdating: true,
            popup: {
                title: "Invoice",
                showTitle: true,
                width: 700,
                height: 345,
                position: {
                    my: "top",
                    at: "top",
                    of: window
                }
            }
        }, paging: {
            pageSize: 10
        },
        pager: {
            showPageSizeSelector: true,
            allowedPageSizes: [5, 10, 20],
            showInfo: true
        },
        columns: [
            {
                dataField: "ID",
                caption: "ID",
                width: 100
			},
			{
                dataField: "CustomerNumber",
                caption: "Customer Number",
				width: 160,
				validationRules: [{ type: "required" }]
			},
			{
                dataField: "Invoice",
                caption: "Invoice",
				width: 160,
				validationRules: [{ type: "required" }]
            }, 
            {
                dataField: "Date",
				dataType: "date",
				validationRules: [{ type: "required" }]
            }
        ]
    });
	//End
	function limpiarCampos(){
		$("#txtInvCruDateCrossing").val("");
		$("#txtInvCruTrailerNumber").val("");
		$("#txtInvCruDescription").val("");
	}
	$("#tbl").hide();
	function actualizarTabla(id){
		var InvId = id;
		$.ajax({
			url:"php/llenarTabla.php",
			type:"GET",
			data:{"id":id,"clave":1}
		}).done(function(data){
			//alert(data);
		//	$("#tbl").show();
			var response = $.parseJSON(data);
			console.log(response);
			//alert(response[0]["InvCruDateCrossing"]);
			$("#tablacruces tbody tr").remove();
			for (var i = response.length - 1; i >= 0; i--) {
				$("#tablacruces tbody").append("<tr><td>"+response[i]["InvCruDateCrossing"]+"</td><td>"+response[i]["InvCruTrailerNumber"]+"</td><td>"+response[i]["InvCruAmount"]+"</td><td>"+response[i]["InvCruDescription"]+"</td><td>"+response[i]["txtInvCruFrom"]+"</td><td>"+response[i]["InvNum"]+"</td><tr>")
			}
		});
	}
	function limpiarCamposTr(){
		$("#txttrDetDateCrossing").val("");
		$("#txttrDetTrailerNumber").val("");
        $("#txttrDetAmount").val("");
		$("#txttrDescriptionPedimento").val("");
		$("#txttrDescription").val("");
		$("#txttrFrom").val("");
		$("#txttrDestination").val("");
			
	}
	function actualizarTablaTr(id){
		var InvId = id;
		$.ajax({
			url:"php/llenarTablaTr.php",
			type:"GET",
			data:{"id":id,"clave":1}
		}).done(function(data){
			//alert(data);
			$("#tbl").show();
			var response = $.parseJSON(data);
			console.log(response);
			//alert(response[0]["InvCruDateCrossing"]);
			$("#tablacruces tbody tr").remove();
			for (var i = response.length - 1; i >= 0; i--) {
				$("#tablacruces tbody").append("<tr><td>"+response[i]["trDetDateCrossing"]+"</td><td>"+response[i]["trDetTrailerNumber"]+"</td><td>"+response[i]["trDetAmount"]+"</td><td>"+response[i]["trDescriptionPedimento"]+"|"+response[i]["trDescription"]+"</td><td>"+response[i]["trFrom"]+"</td><td>"+response[i]["trDestination"]+"</td><td>"+response[i]["usunombre"]+"</td><tr>")
			}
		});
	}
	
	$("#btnAsignar").click(function(){
		
            					$("#InvDate").prop('disabled', true);
            					$("#txtCustumerNum").prop('disabled', true);

            					var InvDate = $("#InvDate").val();
            					var CustumerNum = $("#txtCustumerNum").val();
            					var InvNumber = $("#txtInvNum").val();
            					$.ajax({
            						url : "php/TraerIdInv.php",
            						type : "GET",
            						data : {"InvDate":InvDate,"CustumerNum":CustumerNum,"InvNumber":InvNumber}
            					}).done(function(data){
            							$("#txtInvId").val(data);
            							$("#txtInvCruDateCrossing").prop('disabled', false);
            							$("#txtInvCruTrailerNumber").prop('disabled', false);
            							$("#txtInvCruDescription").prop('disabled', false);
										$("#txtInvCruAmount").prop('disabled', false);
          							});
	   			
	});
	$("#btnNuevo").click(function(){
		location.reload();
		history.go(0);
		window.location.href = window.location.href;
	});
	$("#btnNuevoTr").click(function(){
		location.reload();
		history.go(0);
		window.location.href = window.location.href;
	});
	var a = 1;
	$("#btnGuardarTr").click(function(){
		if(validarTr() == true){
			var trDetDateCrossing 		= $("#txttrDetDateCrossing").val();
			var trDetTrailerNumber 		= $("#txttrDetTrailerNumber").val();
			var trDetAmount 			= $("#txttrDetAmount").val();
			var trDescriptionPedimento  = $("#txttrDescriptionPedimento").val();
			var trDescription		    = $("#txttrDescription").val();
			var trFrom                  = $("#txttrFrom").val();
			var trDestination			= $("#txttrDestination").val();
			var trId					= $("#txtInvId").val();
			if($("#txtInvNum").val()  != ""){
				 trId = $("#txtInvNum").val();
			}
				$.ajax({
				url:"php/guardarCruceTr.php",
				type:"GET",
				data:{"trDetDateCrossing":trDetDateCrossing,"trDetTrailerNumber":trDetTrailerNumber,
				"trDetAmount":trDetAmount,
				"trDescriptionPedimento":trDescriptionPedimento,"trDescription":trDescription,
				"trFrom":trFrom,"trDestination":trDestination,"trId":trId}
				}).done(function(data){	
					if(data == ""){
						limpiarCamposTr();
						actualizarTablaTr(trId);
					}else{
						var datos = $.parseJSON(data);
						limpiarCamposTr();
						$("#txtInvNum").val(datos.InvNumber);
						actualizarTablaTr(datos.trId);
						$("#txtInvId").val(datos.trId);
					}
					
				});
		}
		
	});
	$("#btnGuardar").click(function(){
		var InvCruDateCrossing 	= $("#txtInvCruDateCrossing").val();
		var InvCruTrailerNumber 		= $("#txtInvCruTrailerNumber").val();
		var InvCruAmount 				= $("#txtInvCruAmount").val();
		var InvCruDescription			= $("#txtInvCruDescription").val();
		var txtInvCruFrom				= $("#txtInvCruFrom").val();
		var InvId                       = $("#txtInvId").val();
			$.ajax({
			url:"php/guardarCruce.php",
			type:"GET",
			data:{"InvCruDateCrossing":InvCruDateCrossing,"InvCruTrailerNumber":InvCruTrailerNumber,"InvCruAmount":InvCruAmount,
			"InvCruDescription":InvCruDescription,"txtInvCruFrom":txtInvCruFrom,"InvId":InvId}
			}).done(function(data){	
				limpiarCampos();
				actualizarTabla(InvId);
			});
		
		
	});
	$("#saveGastos").click(function(){
		var Description = $("#txtDescript").val();
		var amount      = $("#txtGastosActual").val();
		var bandera = true;
		if($("#txtDescript").val() == ""){swal("error", "LaDescripcion es obligatoria !", "error");bandera = false;}
		if($("#txtGastosActual").val() == ""){swal("error", "El monto del Gasto es  Obligatorio !", "error");bandera = false;}	
		alert(amount);
		if(bandera == true){
			
			$.ajax({
				url:"php/guardarGasto.php",
				type:"GET",
				data:{"Description":Description,"amount":amount}
			}).done(function(data){
	
				location.reload();
	
			});
		}
	 });
	 
	$("#btnGuardarDet").click(function(){
		var InvCruDateCrossing 	= $("#txtInvCruDateCrossingDet").val();
		var InvCruTrailerNumber 		= $("#txtInvCruTrailerNumberDet").val();
		var InvCruAmount 				= 90;
		var InvCruDescription			= $("#txtInvCruDescriptionDet").val();
		var txtInvCruFrom				= $("#txtInvCruFromDet").val();
		var InvId                       = $("#txtInvIdIns").val();
		$.ajax({
			url:"php/guardarCruce.php",
			type:"GET",
			data:{"InvCruDateCrossing":InvCruDateCrossing,"InvCruTrailerNumber":InvCruTrailerNumber,"InvCruAmount":InvCruAmount,
			"InvCruDescription":InvCruDescription,"txtInvCruFrom":txtInvCruFrom,"InvId":InvId}
		}).done(function(data){

			location.reload();

		});
	});
	function validarTr(){
		var bandera = true;
		if($("#txttrDetDateCrossing").val() == ""){swal("error", "Es necesario llenar todos los  campos Obligatorio !", "error");bandera = false;}
		if($("#txttrDetTrailerNumber").val() == ""){swal("error", "Es necesario llenar todos los  campos Obligatorio !", "error");bandera = false;}
		if($("#txttrDetAmount").val() == ""){swal("error", "Es necesario llenar todos los  campos Obligatorio !", "error");bandera = false;}
		if($("#txttrDescriptionPedimento").val() == ""){swal("error", "Es necesario llenar todos los  campos Obligatorio !", "error");bandera = false;}
		if($("#txttrFrom").val() == ""){swal("error", "Es necesario llenar todos los  campos Obligatorio !", "error");bandera = false;}
		if($("#txttrDestination").val() == ""){swal("error", "Es necesario llenar todos los  campos Obligatorio !", "error");bandera = false;}
		return bandera;
	}
});