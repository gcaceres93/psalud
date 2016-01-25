<!DOCTYPE html>
<html dir="ltr">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="initial-scale=1.0">
	<title>Login</title>
		<!-- Start css3menu.com HEAD section -->
	<link rel="stylesheet" href="CSS3 Meeenu.css3prj_files/css3menu1/style.css" type="text/css" /><style type="text/css">._css3m{display:none}</style>
	<meta charset="utf-8"> 
  <script src="http://code.jquery.com/jquery-2.1.1.min.js"> </script>
  <script>
      $(document).ready(function(){
         $("#guardar").focus();
               $("#guardar").click(function(event){

        var nombre= $("#usuario").val();
        var pass=$("#pass").val();
        var datos={
          'usuario': nombre,
          'pass':pass
        };

        $.ajax({
            type:"post",
            url:"verificarUsuario.php",
            data: datos,
            success:function (data){
              if (data == "existe"){

                  window.location = 'home.php'

              }    else{
	              
                  $("#error").html( " <?php 'aaaa' ?> El usuario no existe o la contraseña se ha ingresado incorrectamente").fadeIn( 700 ).delay().fadeOut( 1000 );
              }
            }
          });
        });

      

        });

   </script>

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
</head>
	<!-- PROBANDO COMMIT GIT -->

<body  ontouchstart="" style="background-color:#A7C8FE">
<?php session_start();
        if(isset($_SESSION['usuario'])) {
            header('Location:home.php');
        }else{?>


<!-- Start css3menu.com BODY section -->
<input type="checkbox" id="css3menu-switcher" class="c3m-switch-input">

<!-- <ul id="css3menu1" class="topmenu"> End css3menu.com BODY section --><br/>

		<div style="text-align:center;">
  <fieldset style = "display: inline-block;">
  <div class="container">
           <h2>Ingresar Usuario y Contraseña  </h2>
<!-- <form class="form-horizontal" method="post" id="guardarPaciente" action="sesion.php"> -->

<div class="form-group">
<label class="control-label col-xs-3">Usuario:</label>
<div class="col-xs-9">
<input type="text" class="form-control" placeholder="Usuario" name="usuario" id="usuario" >
</div>
</div>
<div class="form-group">
<label class="control-label col-xs-3">Contraseña:</label>
<div class="col-xs-9">
<input type="password" class="form-control" placeholder="Contraseña" name="pass" id="pass">
</div>
</div>




<br>
<div class="form-group">
<div class="col-xs-offset-3 col-xs-9">

<input type="submit" class="btn btn-success" id="guardar" value="Acceder">
<input type="reset" class="btn btn-default" value="Limpiar">
</div>
</div>
      <div>
          <span id="error"></span>
      </div>
<!-- </form> -->
       </fieldset> 
	</div>	
</div>
</body>
<?php } ?>
</html>
