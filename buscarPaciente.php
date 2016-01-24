<?php
include_once 'biblioteca/conexionBd.php';
$recursoDeConexion = conectar('postgresql');
//Realizar Select
$cedula = $_GET["cedula"];
$query="select p.nombre,p.apellido from paciente as pa, persona as p where  p.id_persona=pa.id_persona and p.cedula = '$cedula'  ";
$resultSet = ejecutarQueryPostgreSql($recursoDeConexion,$query);
$resultSet2 = pg_fetch_assoc($resultSet);
if ($resultSet2==false) {
    echo "no existe";
} else {
    $rs = ejecutarQueryPostgreSql($recursoDeConexion,$query);
    while ($row = pg_fetch_assoc($rs)) {
        $respuesta = $row["apellido"] . "," . $row["nombre"];
    }
    echo $respuesta;
}
?>