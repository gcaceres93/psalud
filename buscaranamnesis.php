<?php
include_once 'biblioteca/conexionBd.php';
$recursoDeConexion = conectar('postgresql');
//Realizar Select
$cedula = $_GET["cedula"];
$query="select a.motivo_consulta as motivo_consultas,a.antecedentes_familiares, a.antecedentes_desarrollo, a.aspectos_generales, a.conclusiones, a.observaciones, a.plan_evaluacion, p.nombre, p.apellido from anamnesis a, persona p where a.cedula = '$cedula' and p.cedula= a.cedula";

$resultSet = ejecutarQueryPostgreSql($recursoDeConexion,$query);
$resultSet2 = pg_fetch_assoc($resultSet);
if ($resultSet2==false) {
    $respuesta = array();
    $respuesta['cedula2'] = 'No existe';
    echo json_encode ($respuesta);
} else {
    $rs = ejecutarQueryPostgreSql($recursoDeConexion,$query);

    while ($row = pg_fetch_assoc($rs)) {
        $respuesta = array();
        $respuesta['motivo_consultas'] = $row["motivo_consultas"];
        $respuesta['antecedentes_familiares'] = $row["antecedentes_familiares"];
        $respuesta['antecedentes_desarrollo'] = $row["antecedentes_desarrollo"];
        $respuesta['aspectos_generales'] = $row["aspectos_generales"];
        $respuesta['conclusiones'] = $row["conclusiones"];
        $respuesta['observaciones'] = $row["observaciones"];
        $respuesta['plan_evaluacion'] = $row["plan_evaluacion"];
        $respuesta['nombre'] = $row["apellido"].','.$row["nombre"];
        $respuesta['cedula2'] = $cedula;
    }

    echo json_encode($respuesta);
}
?>