
<!DOCTYPE html>
<html dir="ltr">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="initial-scale=1.0">
	<title>Alta Usuario </title>
		<!-- Start css3menu.com HEAD section -->


	<style type="text/css">._css3m{display:none}</style>
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
             function buscarPersona() {
                 var cedula= $("#cedula").val();

                 $.ajax({
                type:"post",
                url:"buscarMedico.php",
                data:{'cedula':cedula},
                success:function (data){

                     if (data.cedula2 == "No existe")
                     {
                         alert ('No se ha encontrado medico con ese numero de cedula');
                     }
                     else
                     {

                         $("#cedula").val(data);
                         $("#cedula").attr('disabled', 'disabled');
                     }
                 }
            });
        }
$(document).ready(function(){


    $("#guardar").click(function(event){

		var cedula=$("#cedula").val();
        var usuario= $("#usuario").val();
        var ingrese_contraseña=$("#ingrese_contraseña").val();
        var confirme_contraseña=$("#confirme_contraseña").val();
        var rol=$("#rol").val();

	   if (ingrese_contraseña==confirme_contraseña){
		   var datos={
			   'cedula' : cedula,
			   'usuario' : usuario,
			   'contra': ingrese_contraseña,
			   'contra2' : confirme_contraseña,
			   'rol': rol,
		   };

		   $.ajax({
			   type:"post",
			   url:"insertar_usuario.php",
			   data: datos,
			   success:function (data){
				   if (data == "ok"){

					   window.location = 'home.php';

				   }    else{
					   $("#error").html("Error en la carga").fadeIn( 700 ).delay().fadeOut( 1000 );
				   }
			   }
		   });
	   }
		else{

		   alert("Verifique constraseñas");
	   }

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
			<h2>Agregar Usuario <img src="user-add.png"
												 height="64px" width="64px"></h2>

			<div class="form-horizontal">
				<div class="form-group">
					<label class="control-label col-xs-3">Cedula:</label>

					<div class="col-xs-9">
						<input type="text" style='width:300px; display:inline' class="form-control" placeholder='Ingrese C.I.' value="" name="cedula" id="cedula" style=" width:265px; display:inline">
                        <a href="#" onclick="buscarPersona()" id="buscarPersona" name="buscar"><img width="40px" height="40px" src="search.png"> </a>
                   </div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-3">Usuario:</label>

					<div class="col-xs-9">
						<input type="text" class="form-control" placeholder="Usuario" id="usuario">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-3">Ingrese contraseña:</label>

					<div class="col-xs-9">
						<input type="password" class="form-control" placeholder="Ingrese contraseña" id="ingrese_contraseña">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-3">Confirme contraseña:</label>

					<div class="col-xs-9">
						<input type="password" class="form-control" id="confirme_contraseña" placeholder="Confirme contraseña" name="confirme_contraseña">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-3">Rol:</label>

					<div class="col-xs-9">
						<select id="rol" style='width:340px; height:35px'>


						<?php
						include_once 'biblioteca/conexionBd.php';
						$recursoDeConexion = conectar('postgresql');

						$query="select * from roles;";

						$rs=ejecutarQueryPostgreSql($recursoDeConexion,$query);

						while ($row=pg_fetch_assoc($rs)){
							echo "<option value=". $row['rol'].">". $row['nombre']."</option> ";
							}
s
						?>
						</select>
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
