<!DOCTYPE html>
<html dir="ltr">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="initial-scale=1.0">
	<title>Alta Paciente</title>
		<!-- Start css3menu.com HEAD section -->
	<link rel="stylesheet" href="../../../Users/gabriel/Downloads/Tema%202/CSS3%20Meeenu.css3prj_files/css3menu1/style.css" type="text/css" /><style type="text/css">._css3m{display:none}</style>
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
  <script>
      $(document).ready(function(){

       
        $("#guardar").click(function(event){

        var nombre= $("#nombre").val();
        var apellido=$("#apellido").val();
		var cedula=$("#cedula").val();
		var fecha=$("#fecha_nacimiento").val();
		var ruc=$("#ruc").val();
		var telefono=$("#telefono").val();
		var email=$("#email").val();
		var direccion=$("#direccion").val();
		var ventana='paciente';

		
        var datos={
          'nombre': nombre,
          'apellido': apellido,
		  'cedula' : cedula,
		  'fecha' : fecha,
		  'ruc' : ruc,
		  'telefono': telefono,
		  'email': email,
		  'direccion':direccion,
		  'ventana':ventana
		  };
		
        $.ajax({
            type:"post",
            url:"insertar_persona.php",
            data: datos,
            success:function (data){
              if (data == "ok"){

                  window.location = 'home.php';

              }    else{
                  $("#error").html("Error en la carga").fadeIn( 700 ).delay().fadeOut( 1000 );
              }
            }
          });
        });

      

        });

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
	<fieldset style="display: inline-block;">
		<div class="container">
			<h2>Ingresar datos del paciente <img src="user-add.png"
												 height="64px" width="64px"></h2>

			<div class="form-horizontal">
				<div class="form-group">
					<label class="control-label col-xs-3">Cedula:</label>

					<div class="col-xs-9">
						<input type="text" class="form-control" placeholder='Cedula' value="" id="cedula">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-3">Nombre:</label>

					<div class="col-xs-9">
						<input type="text" class="form-control" placeholder="Nombre" id="nombre">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-3">Apellido:</label>

					<div class="col-xs-9">
						<input type="text" class="form-control" placeholder="Apellido" id="apellido">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-3">Email:</label>

					<div class="col-xs-9">
						<input type="email" class="form-control" id="email" placeholder="Email" name="email">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-3">Telefono:</label>

					<div class="col-xs-9">
						<input type="tel" class="form-control" placeholder="Telefono" name="telefono" id='telefono'>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-3">RUC:</label>

					<div class="col-xs-9">
						<input type="tel" class="form-control" placeholder="RUC" name="ruc" id='ruc'>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-3">Fecha Nacimiento:</label>

					<div class="col-xs-9">
						<input type="date" class="form-control" placeholder="Fecha de Nacimiento" name="fecha"
							   id='fecha_nacimiento'>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-3">Dirección:</label>

					<div class="col-xs-9">
						<textarea rows="3" class="form-control" placeholder="Dirección" name="direccion"
								  id='direccion'></textarea>
					</div>
				</div>


				<br>

				<div class="form-group">
					<div class="col-xs-offset-3 col-xs-9">

						<input type="submit" class="btn btn-success" id="guardar" value="Guardar">
						<input type="reset" class="btn btn-default" value="Limpiar">
					</div>
				</div>
			</div>
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
