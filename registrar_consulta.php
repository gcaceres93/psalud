<!DOCTYPE html>
<html dir="ltr">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="initial-scale=1.0">
    <title>Agendar Consulta</title>
    <!-- Start css3menu.com HEAD section -->
    <link rel="stylesheet" href="CSS3 Meeenu.css3prj_files/css3menu1/style.css" type="text/css" /><style type="text/css">._css3m{display:none}</style>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <script src="http://code.jquery.com/jquery-2.1.1.min.js"> </script>
    <script type="text/javascript">
        var cedP;
        var cedM;
        function buscarMedico() {
            var cedula= $("#cedulaMedico").val();
            $.ajax({
                type:"get",
                url:"buscarMedico.php",
                data:{'cedula':cedula},
                success:function (data){
                    window.cedM=cedula;
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
                        confirmar=confirm("No se ha encontrado un paciente con la cedula: "+cedula+"\nÂ¿Desea registrar al paciente?");
                        if (confirmar)
                            window.open( "addpersona2.html?cedula="+cedula, "RegistrarPaciente", "status = 1, height = 600, width = 1100, resizable = 1, scrollbars=yes" )
                    }else{
                        window.cedP=cedula;
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
        $(document).ready(function(){


            $("#guardar").click(function(event){

                /*var cedula= $("#cedula").val();*/

                var cedulaM=window.cedM;
                var cedulaP=window.cedP;
                var fecha= $("#fecha").val();
                var horario = $("#horario").val();
                var comentario = $("#comentario").val();

                var datos={
                    'cedulaPaciente': cedulaP,
                    'cedulaMedico':cedulaM,
                    'fecha':fecha,
                    'horario': horario,
                    'comentario': comentario
                };
                $.ajax({
                    type:"post",
                    url:"agendar.php",
                    data:datos,
                    success:function (data){
                        if (data=="ok"){
                            alert("Ok");

                        }else{
                            alert("Error")

                        }
                    }
                });
            });
        });


    </script>
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
    <script type="text/javascript">
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
<?php
session_start();
if(isset($_SESSION['usuario'])){

?>
<?php include 'menu.html';?>
<div style="text-align:center;">
    <fieldset style = "display: inline-block;">
  <div class="container">
           <h2>Agendar Consulta <img src="./agenda.png" height="64px" width="64px"> </h2>
		   <br><br>
<div class="form-horizontal" >
<div class="form-group">
<label class="control-label col-xs-3">Paciente:</label>
<div class="col-xs-9">
    <input type="hidden" name="cedulaP" id="cedulaP">
<input type="text"  style='width:300px; display:inline' class="form-control" placeholder='Ingrese C.I.' value="" name="cedulacliente" id="cedulaCliente" style=" width:265px; display:inline">
	<a href="#" onclick="buscarPaciente()"  name="buscar"><img width="40px" height="40px" src="search.png"> </a>
</div>
</div>
<div class="form-group">
<label class="control-label col-xs-3">Medico:</label>
<div class="col-xs-9">
<input type="hidden" name="cedulaM" id="cedulaM">
<input type="text" style='width:300px; display:inline' class="form-control" placeholder='Ingrese C.I.' value="" name="cedulamedico" id="cedulaMedico" style=" width:265px; display:inline">
<a href="#" onclick="buscarMedico()" id="buscarMedico" name="buscar"><img width="40px" height="40px" src="search.png"> </a>
</div>
</div>
<div class="form-group">
<label class="control-label col-xs-3">Fecha:</label>
<div class="col-xs-9">
<input type="date" style='width:350px; display:inline' class="form-control" placeholder="Fecha" name="fecha" id="fecha">
</div>
</div>
<div class="form-group">
<label class="control-label col-xs-3">Horario:</label>
<div class="col-xs-9">
<input type="time" class="form-control" id="horario" name="horario" >
</div>
</div>

<div class="form-group">
<label class="control-label col-xs-3"></label>
<div class="col-xs-9">

</div>
</div>

<div class="form-group">
    <label class="control-label col-xs-3">Comentarios</label>
<div class="col-xs-9">
<textarea id="comentario" name="comentario" rows="7" cols="45"></textarea>
</div>
</div>


<div class="form-group">
<div class="col-xs-offset-3 col-xs-6">
<input type="button" onclick="verificarFecha()" class="form-control btn btn-danger" value="Verificar Disponibilidad" name="verifica" >
<br />

<div id="sugerencia" style="font-weight:bold;color:red"></div>
<input type="submit" class="btn btn-success" id="guardar" value="Registrar" >
<input type="reset" class="btn btn-default" value="Limpiar">
</div>
</div>
</div>
       </fieldset> 
	</div>	
</div>
<?php
}else{
	echo "Favor iniciar sesion para acceder al sistema";
}
?>
</body>
</html>
