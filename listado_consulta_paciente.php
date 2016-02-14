<!DOCTYPE html>
<html>
<head>
    <title>Listado</title>

    <meta charset  = 'utf-8'>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="http://getbootstrap.com/dist/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

</head>

<body>
<?php
include_once 'biblioteca/conexionBd.php';
$recursoDeConexion = conectar('postgresql');
/*$query='select p.nombre,p.apellido,p.nacimiento,u.usuario,r.nombre from personas p, usuario u, roles r where p.id_persona=u.id_persona and u.rol '*/

$query="select p.cedula, p.nombre, p.apellido, p.nacimiento, pac.razon_social, pac.ruc, p.telefono, p.direccion, a.fecha_programada, cc.observaciones, cc.cantidad_sesiones from agendamiento a, persona p, paciente pac, consulta_cabecera cc, consulta_detalle cd where p.id_persona= pac.id_persona AND cc.cedula= pac.cedula AND cd.id_agendamiento = a.id_agendamiento";


$rs=ejecutarQueryPostgreSql($recursoDeConexion,$query);
echo "<table id='mytable' class='table table-bordred table-striped'><thead><th> </th><th>Cedula</th><th>Nombre</th><th>Apellido</th><th>Nacimiento</th><th>Razon Social</th><th>Ruc</th><th>Telefono</th><th>Direccion</th><th>Fecha_programada</th><th>Observaciones</th><th>cantidad_Sesiones</th></thead>";
while ($row=pg_fetch_assoc($rs))
{
    echo " <tr>" ;
    echo "<td><input type='checkbox' class='checkthis' /></td>";

    echo "<td>";
    echo $row["cedula"];
    echo "</td> <td> ";
    echo $row["nombre"];
    echo"</td> <td> ";
    echo $row["apellido"];
    echo "</td> <td> ";
    echo $row["nacimiento"];
    echo "</td> <td> ";
    echo $row["razon_social"];
    echo "</td> <td> ";
    echo $row["ruc"];
    echo "</td> <td> ";
    echo $row["telefono"];
    echo "</td> <td> ";
    echo $row["direccion"];
    echo "</td> <td> ";
    echo $row["fecha_programada"];
    echo "</td> <td> ";
    echo $row["observaciones"];
    echo "</td> <td> ";
    echo $row["cantidad_sesiones"];
    echo "</td>";
    echo "</tr>";




}
echo "</table>";




?>

</body>

</html>
