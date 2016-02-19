
<!DOCTYPE html>
<html dir="ltr">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="initial-scale=1.0">
    <title>Diagnostico del paciente </title>
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
        var ced;
        function buscarPaci() {
            var cedula= $("#cedula").val();

            $.ajax({
                type:"get",
                dataType:"json",
                url:"buscardiagnostico.php",
                data:{'cedula':cedula},
                success:function (data){
                    if (data.cedula2 == cedula)
                    {
                        window.ced=cedula;
                        $("#cedula").val(data.nombre);
                        $("#resumen").val(data.resumen);
                        $("#procedimientos_utilizados").val(data.procedimientos_utilizados);
                        $("#diagnostico_sindromes").val(data.diagnostico_sindromes);
                        $("#diagnostico_nosografico").val(data.diagnostico_nosografico);
                        $("#diagnostico_etiologico").val(data.diagnostico_etiologico);
                        $("#diagnostico_patogenico").val(data.diagnostico_patogenico);
                        $("#conclusion").val(data.conclusion);
                        $("#cedula").attr('disabled', 'disabled');
                    }
                    else
                    {
                        window.ced=cedula;
                        $("#cedula").val(data);

                    }
                }
            });
        }


        $(document).ready(function(){


            $("#guardar").click(function(event){

                // var cedula= $("#cedula").val();
                var cedula=window.ced;
                var resumen=$("#resumen").val();
                var procedimientos_utilizados=$("#procedimientos_utilizados").val();
                var diagnostico_sindromes=$("#diagnostico_sindromes").val();
                var diagnostico_nosografico=$("#diagnostico_nosografico").val();
                var diagnostico_etiologico=$("#diagnostico_etiologico").val();
                var diagnostico_patogenico=$("#diagnostico_patogenico").val();
                var conclusion=$("#conclusion").val();
                var ventana='paciente';


                var datos={
                    'cedula': cedula,
                    'resumen': resumen,
                    'procedimientos_utilizados' : procedimientos_utilizados,
                    'diagnostico_sindromes' : diagnostico_sindromes,
                    'diagnostico_nosografico' : diagnostico_nosografico,
                    'diagnostico_etiologico': diagnostico_etiologico,
                    'diagnostico_patogenico': diagnostico_patogenico,
                    'conclusion': conclusion,
                    'ventana':ventana
                };

                $.ajax({
                    type:"post",
                    url:"insertar_diagnostico.php",
                    data: datos,
                    success:function (data){

                        if (data == "ok"){

                            alert ('Se ha Grabado con Exito');

                        }    else{
                            alert ('Error, Verifique que los datos sean correctos');

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
<?php include 'menu.php'; ?>
<div style="text-align:center;">
    <fieldset style="display: inline-block;">
        <div class="container">
            <h2>Diagnostico del paciente <img src="user-add.png"
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
                    <label class="control-label col-xs-3">Resumen:</label>

                    <div class="col-xs-9">
                        <textarea  rows="10" class="form-control" placeholder="Resumen" name="resumen"
                                   id='resumen'></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-xs-3">Procedimientos utilizados:</label>

                    <div class="col-xs-9">
                        <textarea  rows="10" class="form-control" placeholder="Procedimientos utilizados" name="procedimientos_utilizados"
                                   id='procedimientos_utilizados'></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-xs-3">Diagnostico sindromes:</label>

                    <div class="col-xs-9">
                        <textarea  rows="10" class="form-control" placeholder="Diagnostico sindromes" name="diagnostico_sindromes"
                                   id='diagnostico_sindromes'></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-xs-3">Diagnostico nosografico:</label>

                    <div class="col-xs-9">
                        <textarea  rows="10" class="form-control" placeholder="Diagnostico nosografico" name="diagnostico_nosografico"
                                   id='diagnostico_nosografico'></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-xs-3">Diagnostico etiologico:</label>

                    <div class="col-xs-9">
                        <textarea  rows="10" class="form-control" placeholder="Diagnostico etiologico" name="diagnostico_etiologico"
                                   id='diagnostico_etiologico'></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-xs-3">Diagnostico patogenico:</label>

                    <div class="col-xs-9">
                        <textarea  rows="10" class="form-control" placeholder="Diagnostico patogenico" name="diagnostico_patogenico"
                                   id='diagnostico_patogenico'></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-xs-3">Conclusion:</label>

                    <div class="col-xs-9">
                        <textarea  rows="10" class="form-control" placeholder="Conclusion" name="conclusion"
                                   id='conclusion'></textarea>
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
