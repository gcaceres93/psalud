
<!DOCTYPE html>
<html dir="ltr">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="initial-scale=1.0">
    <title>Anamnesis del paciente </title>
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
        function buscarPaci() {
            var cedula= $("#cedula").val();

            $.ajax({
                type:"get",
                dataType:"json",
                url:"buscaranamnesis.php",
                data:{'cedula':cedula},
                success:function (data){
                    if (data.cedula2 == "No existe")
                    {
                        alert ('No se ha encontrado paciente con ese numero de cedula');
                    }
                    else
                    {

                        $("#cedula").val(data.nombre);
                        $("#motivo_consultas").val(data.motivo_consultas);
                        $("#antecedentes_familiares").val(data.antecedentes_familiares);
                        $("#antecedentes_desarrollo").val(data.antecedentes_desarrollo);
                        $("#aspectos_generales").val(data.aspectos_generales);
                        $("#conclusiones").val(data.conclusiones);
                        $("#observaciones").val(data.observaciones);
                        $("#plan_evaluacion").val(data.plan_evaluacion);
                        $("#cedula").attr('disabled', 'disabled');
                    }
                }
            });
        }
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
            <h2>Anamnesis del paciente <img src="user-add.png"
                                            height="64px" width="64px"></h2>

            <div class="form-horizontal">
                <div class="form-group">
                    <label class="control-label col-xs-3">Cedula:</label>

                    <div class="col-xs-9">
                        <input type="text" style='width:300px; display:inline' class="form-control" placeholder='Ingrese C.I.' value="" name="cedula" id="cedula" style=" width:265px; display:inline">
                        <a href="#" onclick="buscarPaci()" id="buscarPersona" name="buscar"><img width="40px" height="40px" src="search.png"> </a>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-3">Motivo de consulta:</label>

                    <div class="col-xs-9">
                        <textarea disabled="disabled" rows="10" class="form-control" placeholder="Motivo de consultas" name="motivo_consultas"
                                   id='motivo_consultas'></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-xs-3">Antecedentes familiares:</label>

                    <div class="col-xs-9">
                        <textarea disabled="disabled" rows="10" class="form-control" placeholder="Antecedentes familiares" name="antecedentes_familiares"
                                  id='antecedentes_familiares'></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-xs-3">Antecedentes desarrollo:</label>

                    <div class="col-xs-9">
                        <textarea disabled="disabled" rows="10" class="form-control" placeholder="Antecedentes desarrollo" name="antecedentes_desarrollo"
                                  id='antecedentes_desarrollo'></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-xs-3">Aspectos generales:</label>

                    <div class="col-xs-9">
                        <textarea disabled="disabled" rows="10" class="form-control" placeholder="Antecedentes generales" name="aspectos_generales"
                                  id='aspectos_generales'></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-xs-3">Conclusiones:</label>

                    <div class="col-xs-9">
                        <textarea disabled="disabled" rows="10" class="form-control" placeholder="conclusiones" name="conclusiones"
                                  id='conclusiones'></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-xs-3">Observaciones:</label>

                    <div class="col-xs-9">
                        <textarea disabled="disabled" rows="10" class="form-control" placeholder="Observaciones" name="observaciones"
                                  id='observaciones'></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-xs-3">Plan de evaluacion:</label>

                    <div class="col-xs-9">
                        <textarea disabled="disabled" rows="10" class="form-control" placeholder="Plan de evaluacion" name="plan_evaluacion"
                                  id='plan_evaluacion'></textarea>
                    </div>
                </div>
                <br>


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
