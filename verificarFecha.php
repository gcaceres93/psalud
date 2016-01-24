<?php
include_once 'biblioteca/conexionBd.php';
$recursoDeConexion = conectar('postgresql');
//Realizar Select
$cedulaM = $_GET["cedulaMedico"];
$cedulaP = $_GET["cedulaPaciente"];
$fecha = $_GET["fecha"];
$horario = $_GET["horario"];
$query="select a.id_agendamiento from agendamiento as a, persona as p, empleado as e where  a.fecha_programada = '$fecha' and a.hora_programada = '$horario' and p.id_persona = e.id_persona and p.cedula = '$cedulaM'";
$resultSet = ejecutarQueryPostgreSql($recursoDeConexion,$query);
$resultSet2 = pg_fetch_assoc($resultSet);
if ($resultSet2==false) {
    $d = array('valor' => 'no');
    echo json_encode($d);
} else {

    $bandera = 'true';
    $hora = mb_substr($horario,0,2)+1+':00';
    $hora_seguerida = $hora.':00';
    while ($bandera == 'true'){
    if ($hora > 19 || $hora < 8){
        $hora = 8;
        $hora_seguerida = $hora.':00';
    }
        $fecha_sugerida = array
        ("fecha" => $fecha,
        "horario" => $hora_seguerida
        );
    $query="select a.id_agendamiento from agendamiento as a, persona as p, empleado as e where  a.fecha_programada = '$fecha' and a.hora_programada = '$hora_seguerida' and p.id_persona = e.id_persona and p.cedula = '$cedulaM'";
        $rs = ejecutarQueryPostgreSql($recursoDeConexion,$query);
        $rs2 = pg_fetch_assoc($rs);
        if ($rs2==false) {
            $bandera = 'false';
        }else{
            $hora = mb_substr($hora_seguerida,0,2)+1+':00';
            $hora_seguerida = $hora.':00';
            if ($hora >= 20){
                $dia = mb_substr($fecha,8,2) + 1;
                $fecha = mb_substr($fecha,0,8).$dia;
            }
        }
    }
    if ($bandera == 'false')
        echo json_encode($fecha_sugerida);
}
?>