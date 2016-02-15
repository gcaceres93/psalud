<?php
include_once 'biblioteca/conexionBd.php';
$recursoDeConexion = conectar('postgresql');
//Realizar Select
$cedula = $_GET["cedula"];
$query="select a.motivo_consulta as motivo_consultas,a.antecedentes_familiares, a.antecedentes_desarrollo, a.aspectos_generales, a.conclusiones, a.observaciones, a.plan_evaluacion, p.nombre, p.apellido from anamnesis a, persona p where a.cedula = '$cedula' and p.cedula= a.cedula";

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
        $respuesta['nombre'] = $row["apellido"].','.$row["nombre"];
        $respuesta['cedula2'] = $cedula;
    }

    echo json_encode($respuesta);
}
?>