
<?php
include_once 'biblioteca/conexionBd.php';
$recursoDeConexion = conectar('postgresql');
//Realizar Select
$cedula = $_GET["cedula"];
$query="select p.nombre,p.apellido,p.nacimiento,p.telefono,p.direccion,p.email,p.cedula, e.especialidad, e.hdesde, e.hhasta,p.ruc from persona p, empleado e  where p.cedula = '$cedula' and e.id_persona=p.id_persona   ";
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
        $respuesta['apellido'] = $row["apellido"];
        $respuesta['nombre'] = $row["nombre"];
        $respuesta['nacimiento'] = $row["nacimiento"];
        $respuesta['telefono'] = $row["telefono"];
        $respuesta['direccion'] = $row["direccion"];
        $respuesta['email'] = $row["email"];
        $respuesta['cedula2'] = $row["cedula"];
        $respuesta['especialidad'] = $row["especialidad"];
        $respuesta['hdesde'] = $row["hdesde"];
        $respuesta['hhasta'] = $row["hhasta"];
        $respuesta['ruc'] = $row["ruc"];
 

    }

    echo json_encode($respuesta);
}
?>