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

$query="select d.id_diagnostico, p.cedula, p.nombre, p.apellido, d.resumen, d.procedimientos_utilizados, d.diagnostico_sindromes, d.diagnostico_nosografico, d.diagnostico_etiologico, d.diagnostico_patogenico, d.conclusion from diagnostico d, anamnesis a, persona p where d.id_diagnostico=a.id_diagnostico and a.cedula=p.cedula";

$rs=ejecutarQueryPostgreSql($recursoDeConexion,$query);
echo "<table id='mytable' class='table table-bordred table-striped'><thead><th> </th><th>Id_diagnostico</th><th>Cedula</th><th>Nombre</th><th>Apellido</th><th>Resumen</th><th>Procedimientos_utilizados</th><th>Diagnostico_sindromes</th><th>Diagnostico_nosografico</th><th>Diagnostico_etiologico</th><th>Diagnostico_patogenico</th><th>Conclusion</th></thead>";
while ($row=pg_fetch_assoc($rs))
{
    echo " <tr>" ;
    echo "<td><input type='checkbox' class='checkthis' /></td>";

    echo "<td>";
    echo $row["id_diagnostico"];
    echo "</td> <td> ";
    echo $row["cedula"];
    echo"</td> <td> ";
    echo $row["nombre"];
    echo "</td> <td> ";
    echo $row["apellido"];
    echo "</td> <td> ";
    echo $row["resumen"];
    echo "</td> <td> ";
    echo $row["procedimientos_utilizados"];
    echo "</td> <td> ";
    echo $row["diagnostico_sindromes"];
    echo "</td> <td> ";
    echo $row["diagnostico_nosografico"];
    echo "</td> <td> ";
    echo $row["diagnostico_etiologico"];
    echo "</td> <td> ";
    echo $row["diagnostico_patogenico"];
    echo "</td> <td> ";
    echo $row["conclusion"];
    echo "</td>";
    echo "</tr>";




}
echo "</table>";

?>

</body>

</html>
