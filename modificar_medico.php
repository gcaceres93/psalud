



<!DOCTYPE html>
<html dir="ltr">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="initial-scale=1.0">
    <title>Alta Medico</title>
    <!-- Start css3menu.com HEAD section -->
    <link rel="stylesheet" href="CSS3%20Meeenu.css3prj_files/css3menu1/style.css" type="text/css" /><style type="text/css">._css3m{display:none}</style>
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
                dataType: "json",
                url:"recuperar_medico.php",
                data:{'cedula':cedula},
                success:function (data){

                    if (data.cedula2 == "No existe")
                    {
                        a
                            . lert ('No se ha encontrado medico con ese numero de cedula');
                    }
                    else
                    {
                        $("#cedulaMedico").val(data.cedula2);
                        $("#nombre").val(data.nombre);
                        $("#fecha").val(data.nacimiento);
                        $("#apellido").val(data.apellido);
                        $("#ruc").val(data.ruc);
                        $("#especialidad").val(data.especialidad);
                        $("#email").val(data.email);
                        $("#telefono").val(data.telefono);
                        $("#direccion").val(data.direccion);
                        $("#cedulaM").val(data.cedula2);
                        $("#hdesde").val(data.hdesde);
                        $ ("#hhasta").val(data.hhasta);
                        $("#cedulaMedico").attr('disabled', 'disabled');
                    }
                }
            });
        }
        $(document).ready(function(){


            $("#guardar").click(function(event){

                var nombre= $("#nombre").val();
                var apellido=$("#apellido").val();
                var cedula=$("#cedulaM").val();
                var fecha=$("#fecha").val();
                var ruc=$("#ruc").val();
                var telefono=$("#telefono").val();
                var email=$("#email").val();
                var direccion=$("#direccion").val();
                var especialidad=$("#especialidad").val();
                var hdesde=$("#hdesde").val();
                var hhasta=$("#hhasta").val();
                var ventana='medico';

                var datos={
                    'nombre': nombre,
                    'apellido': apellido,
                    'cedula' : cedula,
                    'fecha' : fecha,
                    'ruc' : ruc,
                    'telefono': telefono,
                    'email': email,
                    'direccion':direccion,
                    'especialidad': especialidad,
                    'hdesde':hdesde,
                    'hhasta' : hhasta,
                    'ventana' : ventana
                };

                $.ajax({
                    type:"post",
                    url:"actualizar_persona.php",
                    data: datos,
                    success:function (data){
                        if (data.trim() == "ok"){
                            alert ('Se ha modifciado con exito');
                            window.location = 'home.php';

                        }    else{
                            alert (data);

                            $("#error").html("Error en la carga").fadeIn( 700 ).delay().fadeOut( 1000 );
                            alert ('NO Se ha modifciado con exito');
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
            <h2>Ingresar datos del medico <img src="Doctor.png" height="64px" width="64px"></h2>

            <div class="form-horizontal">
                <div class="form-group">
                    <label class="control-label col-xs-3">Medico:</label>
                    <div class="col-xs-9">
                        <input type="hidden" name="cedulaM" id="cedulaM">
                        <input type="text" style='width:300px; display:inline' class="form-control" placeholder='Ingrese C.I.' value="" name="cedulamedico" id="cedulaMedico" style=" width:265px; display:inline">
                        <a href="#" onclick="buscarMedico()" id="buscarMedico" name="buscar"><img width="40px" height="40px" src="search.png"> </a>
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
                    <label class="control-label col-xs-3">Especialidad:</label>

                    <div class="col-xs-9">
                        <input type="text" class="form-control" placeholder="Especialidad" id="especialidad">
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
                        <input type="tel" class="form-control" placeholder="Telefono" id="telefono">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-3">RUC:</label>

                    <div class="col-xs-9">
                        <input type="ruc" class="form-control" placeholder="RUC" id="ruc">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-3">Fecha Nacimiento:</label>

                    <div class="col-xs-9">
                        <input type="date" class="form-control" placeholder="Fecha de Nacimiento" id="fecha">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-3">Horario Disponible:</label>

                    <div class="col-xs-9">
                        <input type="time" class="form-control" placeholder="Desde" id="hdesde"
                               style="width:164px; display:inline"> a
                        <input type="time" class="form-control" placeholder="Hasta" id="hhasta"
                               style="width:164px; display:inline">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-3">DirecciÃƒÂ³n:</label>

                    <div class="col-xs-9">
                        <textarea rows="3" class="form-control" placeholder="DirecciÃƒÂ³n" id="direccion"></textarea>
                    </div>
                    <div class="form-group">

                    </div>
                    <br/>

                    <br/>

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
