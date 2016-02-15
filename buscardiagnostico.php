<?php
include_once 'biblioteca/conexionBd.php';
$recursoDeConexion = conectar('postgresql');
//Realizar Select
$cedula = $_GET["cedula"];

$q="select id_anamnesis from anamnesis where cedula='$cedula'";
$res=ejecutarQueryPostgreSql($recursoDeConexion,$q);

while ($row2=pg_fetch_assoc($res)){

    $anam=$row2["id_anamnesis"];
}
$que="select nombre, apellido from persona where cedula='$cedula'";
$resu=ejecutarQueryPostgreSql($recursoDeConexion,$que);

while ($row3=pg_fetch_assoc($resu)){

    $nomb=$row3["apellido"].','.$row3["nombre"];
}


$query="select id_anamnesis,resumen,procedimientos_utilizados,diagnostico_sindromes,diagnostico_nosografico,diagnostico_etiologico,diagnostico_patogenico,conclusion from diagnostico where id_anamnesis='$anam'";

$resultSet = ejecutarQueryPostgreSql($recursoDeConexion,$query);
$resultSet2 = pg_fetch_assoc($resultSet);
if ($resultSet2==false) {
    include ('nusoap/lib/nusoap.php');

    $cliente = new nusoap_client('http://localhost:80/servidor.php?wsdl');

    $respuesta = $cliente->call('recuperar_paciente',array('cedula'=>$cedula));
    $respuesta=utf8_encode($respuesta);

    echo json_encode ($respuesta);
} else {
    $rs = ejecutarQueryPostgreSql($recursoDeConexion,$query);

    while ($row = pg_fetch_assoc($rs)) {
        $respuesta = array();
        $respuesta['resumen'] = $row["resumen"];
        $respuesta['procedimientos_utilizados'] = $row["procedimientos_utilizados"];
        $respuesta['diagnostico_sindromes'] = $row["diagnostico_sindromes"];
        $respuesta['diagnostico_nosografico'] = $row["diagnostico_nosografico"];
        $respuesta['diagnostico_etiologico'] = $row["diagnostico_etiologico"];
        $respuesta['diagnostico_patogenico'] = $row["diagnostico_patogenico"];
        $respuesta['conclusion'] = $row["conclusion"];
        $respuesta['nombre'] = $nomb;
        $respuesta['cedula2'] = $cedula;
    }

    echo json_encode($respuesta);
}
?>