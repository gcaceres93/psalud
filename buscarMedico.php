<?php
include_once 'biblioteca/conexionBd.php';
$recursoDeConexion = conectar('postgresql');
//Realizar Select
$cedula = $_GET["cedula"];
$query="select e.codigo,p.nombre,p.apellido from empleado as e, persona as p, cargos as c where c.id_cargo = 1 and e.id_persona=p.id_persona and p.cedula = '$cedula'  ";
$resultSet = ejecutarQueryPostgreSql($recursoDeConexion,$query);
$resultSet2 = pg_fetch_assoc($resultSet);
if ($resultSet2==false) {
echo "No existe";
} else {
    $rs = ejecutarQueryPostgreSql($recursoDeConexion,$query);

    while ($row = pg_fetch_assoc($rs)) {
        $respuesta = $row["apellido"] . "," . $row["nombre"];
    }
    echo $respuesta;
}
?>