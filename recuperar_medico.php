
<?php
include_once 'biblioteca/conexionBd.php';
$recursoDeConexion = conectar('postgresql');
//Realizar Select
$cedula = $_GET["cedula"];
$query="select nombre,apellido,nacimiento,telefono,direccion,email,cedula from persona  where cedula = '$cedula'  ";
$resultSet = ejecutarQueryPostgreSql($recursoDeConexion,$query);
$resultSet2 = pg_fetch_assoc($resultSet);
if ($resultSet2==false) {
echo "No existe";
} else {
    $rs = ejecutarQueryPostgreSql($recursoDeConexion,$query);

    while ($row = pg_fetch_assoc($rs)) {
       $respuesta= array();
	$respuesta['apellido'] = $row["apellido"];
        $respuesta['nombre'] = $row["nombre"];
        $respuesta['nacimiento'] = $row["nacimiento"];
        $respuesta['telefono'] = $row["telefono"];
        $respuesta['direccion'] = $row["direccion"];
        $respuesta['email'] = $row["email"];
        $respuesta['cedula'] = $row["cedula"];
    }
    echo json_encode.($respuesta);
}
?>