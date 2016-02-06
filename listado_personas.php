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

$query="select p.cedula,p.nombre,p.apellido,p.nacimiento,e.especialidad,e.hdesde,e.hhasta,p.telefono,p.direccion,p.email from persona p, empleado e where p.id_persona=e.id_persona order by  p.apellido asc";


$rs=ejecutarQueryPostgreSql($recursoDeConexion,$query);
echo "<table id='mytable' class='table table-bordred table-striped'><thead><th> </th><th>Cedula</th><th>Nombre</th><th>Apellido</th><th>Nacimiento</th><th>Especialidad</th><th>Hora desde</th><th>Hora hasta</th><th>Telefono</th><th>Direccion</th><th>Email</th></thead>";
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
            echo $row["especialidad"];
            echo "</td> <td> ";
            echo $row["hdesde"];
            echo "</td> <td> ";
            echo $row["hhasta"];
            echo "</td> <td> ";
            echo $row["telefono"];
            echo "</td> <td> ";
            echo $row["direccion"];
            echo "</td> <td> ";
            echo $row["email"];
            echo "</td>";
        echo "</tr>";




}
echo "</table>";




?>

</body>

</html>
