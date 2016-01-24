<?php
include_once 'biblioteca/conexionBd.php';
$recursoDeConexion = conectar('postgresql');
//Realizar Select
$cedulaM = $_POST["cedulaM"];
$cedulaP = $_POST["cedulaP"];
$fecha = $_POST["fecha"];
$horario = $_POST["horario"];
$comentario = $_POST["comentario"];
$query1="select codigo from empleado,persona where empleado.id_persona = persona.id_persona and persona.cedula = '$cedulaM'";
$rs= ejecutarQueryPostgreSql($recursoDeConexion,$query1);
while ($row = pg_fetch_assoc($rs)) {
    $codigo = $row["codigo"];
}
$fecha_actual=date("d/m/Y");
$query2="insert into agendamiento(id_modalidad,codigo,id_sucursal,fecha_programada,fecha_registro,hora_programada,comentario)
VALUES (1,'$codigo',1,'$fecha','$fecha_actual','$horario','$comentario')";
$resultSet = ejecutarQueryPostgreSql($recursoDeConexion,$query2);
echo "SE AGENDADO LA CONSULTA <img src=\"yes.png\"> <br> <a href='home.php'>Menu</a> "
?>