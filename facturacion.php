<!DOCTYPE html>
<html dir="ltr">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="initial-scale=1.0">
	<title>Facturacion</title>
		<!-- Start css3menu.com HEAD section -->
	<link rel="stylesheet" href="CSS3 Meeenu.css3prj_files/css3menu1/style.css" type="text/css" /><style type="text/css">._css3m{display:none}</style>
	<meta charset="utf-8"> 
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
	<!-- End css3menu.com HEAD section -->
	 <style type="text/css">
    .container {
        width: 500px;
        clear: both;
    }
    .container input {
        width: 100%;
        clear: both;
    }

    </style>
	<script src="http://code.jquery.com/jquery-2.1.1.min.js"> </script>

	<script type="text/javascript">
		function buscarMedico() {
			var cedula= $("#cedulaMedico").val();
			$.ajax({
				type:"get",
				url:"buscarMedico.php",
				data:{'cedula':cedula},
				success:function (data){
					$("#cedulaM").val(cedula);
					$("#cedulaMedico").val(data);
					$("#cedulaMedico").attr('disabled', 'disabled');
				}
			});
		}
		function buscarPaciente() {
			var cedula= $("#cedulaCliente").val();
			$.ajax({
				type:"get",
				url:"buscarPaciente.php",
				data:{'cedula':cedula},
				success:function (data){
					if (data=="no existe"){
						confirmar=confirm("No se ha encontrado un paciente con la cedula: "+cedula+"\n¿Desea registrar al paciente?");
						if (confirmar)
							window.open( "addpersona2.html?cedula="+cedula, "RegistrarPaciente", "status = 1, height = 600, width = 1100, resizable = 1, scrollbars=yes" )
					}else{
						$("#cedulaP").val(cedula);
						$("#cedulaCliente").val(data);
						$("#cedulaCliente").attr('disabled', 'disabled');
					}
				}
			});
		}
		function verificarFecha(){
			var cedulaP= $("#cedulaP").val();
			var cedulaM= $("#cedulaM").val();
			var fecha= $("#fecha").val();
			var horario = $("#horario").val();
			var datos={
				'cedulaPaciente': cedulaP,
				'cedulaMedico':cedulaM,
				'fecha':fecha,
				'horario': horario
			};
			$.ajax({
				type:"get",
				url:"verificarFecha.php",
				dataType: 'json',
				data:datos,
				success:function (data){
					if (data.valor=="no"){
						alert("La fecha y horario se encuentran disponibles");
						$("#sugerencia").empty();
					}else{
						alert("La fecha y horario no se encuentran disponibles")
						$("#sugerencia").html("<p>Horario sugerido:"+data.horario+"</p>"
								+"<p>En fecha:"+data.fecha+"</p>");
					}
				}
			});
		}

		function calcular(tarifa,horas){
		
		var tar=tarifa.value;
		var hor=horas.value;
		
		var total=tar*hor;
		
		
		var tot=document.getElementById("total");
		tot.setAttribute("value",total);
		
		}
	
	</script>
</head>
	
</head>
<body ontouchstart="" style="background-color:#A7C8FE">
<!-- Start css3menu.com BODY section -->
<?php
session_start();
if(isset($_SESSION['usuario'])){

?>
<?php include 'menu.html'; ?>
<div style="text-align:center;">
	<fieldset style = "display: inline-block;">
  <div class="container">
           <h2>Ingrese datos para facturación <img src="money2.png" height="32px" width="32px"> </h2>
		   <br><br>
<form class="form-horizontal" method="post" action="./insertar.php" id="guardarPaciente" action="PacienteServlet">
<div class="form-group">
<label class="control-label col-xs-3">Cliente:</label>
<div class="col-xs-9">
<input type="text" class="form-control" placeholder='Ingrese C.I.' value="" id="cedulaCliente" name="cedulacliente" style=" width:265px; display:inline">
	<a href="#" onclick="buscarPaciente()" id="buscarPaciente" name="buscar"><img width="40px" height="40px" alt="buscar" src="search.png"> </a>
	<input type="hidden" name="cedulaP" id="cedulaP">

</div>
</div>
<div class="form-group">
<label class="control-label col-xs-3">Medico:</label>
<div class="col-xs-9">
	<input type="hidden" name="cedulaM" id="cedulaM">

	<input type="text" class="form-control" placeholder='Ingrese C.I.' value="" id="cedulaMedico" name="cedulamedico" style=" width:265px; display:inline">
	<a href="#" onclick="buscarMedico()" id="buscarMedico" name="buscar"><img alt="buscar" width="40px" height="40px" src="search.png"> </a>
</div>
</div>
<div class="form-group">
<label class="control-label col-xs-3" style="  display:inline">Tarifa por Hora:</label>
<div class="col-xs-9">
<input type="text" class="form-control" placeholder="Gs." name="tarifa" id="tarifa" >
</div>
</div>
<div class="form-group">
<label class="control-label col-xs-3">Cantidad de Horas:</label>
<div class="col-xs-9">
<input type="text" class="form-control" id="horas" placeholder="Cantidad de Horas" name="Especialidad" oninput="calcular(tarifa,horas)">
</div>
</div>
<div class="form-group">
<label class="control-label col-xs-3">Total a Cobrar:</label>
<div class="col-xs-9">
<input type="text" class="form-control" id="total" placeholder="Total" name="total" style="pointer-events:none; background-color:#c0c0c0; color:white">
</div>
</div>

<div class="form-group">

</div>
<br/>
<!-- gay -->
<br/>

<div class="form-group">
<div class="col-xs-offset-3 col-xs-9">
<!-- HOLA MUNDO-->
<input type="submit" class="btn btn-success" id="guardar" value="Facturar" >
<input type="reset" class="btn btn-default" value="Limpiar">
</div>
</div>
</form>
       </fieldset> 
	</div>	
</div>
</body>
<?php
}else{
	echo "Favor iniciar sesion para acceder al sistema";
}
?>
</html>
