<!DOCTYPE html>
<html>
<head>
    <title>Listado Anamnesis</title>

    <meta charset  = 'utf-8'>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="http://getbootstrap.com/dist/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

</head>

<body>
<?php
include_once 'biblioteca/conexionBd.php';
$recursoDeConexion = conectar('postgresql');

$query="select a.id_anamnesis, pac.cedula, p.nombre, p.apellido, a.motivo_consulta, a.antecedentes_familiares, a.antecedentes_desarrollo, a.aspectos_generales, a.conclusiones,a.observaciones, a.plan_evaluacion from anamnesis a, persona p, paciente pac where a.cedula=pac.cedula and p.cedula=pac.cedula";

$rs=ejecutarQueryPostgreSql($recursoDeConexion,$query);
echo "<table id='mytable' class='table table-bordred table-striped'><thead><th> </th><th>Id_anamnesis</th><th>Cedula</th><th>Nombre</th><th>Apellido</th><th>Motivo_consulta</th><th>Antecedentes_familiares</th><th>Antecedentes_desarrollo</th><th>Aspectos_generales</th><th>Conclusiones</th><th>Observacion</th><th>Plan_evaluacion</th></thead>";
while ($row=pg_fetch_assoc($rs))
{
    echo " <tr>" ;
    echo "<td><input type='checkbox' class='checkthis' /></td>";

    echo "<td>";
    echo $row["id_anamnesis"];
    echo "</td> <td> ";
    echo $row["cedula"];
    echo "</td> <td> ";
    echo $row["nombre"];
    echo "</td> <td> ";
    echo $row["apellido"];
    echo "</td> <td> ";
    echo $row["motivo_consulta"];
    echo "</td> <td> ";
    echo $row["antecedentes_familiares"];
    echo "</td> <td> ";
    echo $row["antecedentes_desarrollo"];
    echo "</td> <td> ";
    echo $row["aspectos_generales"];
    echo "</td> <td> ";
    echo $row["conclusiones"];
    echo "</td> <td> ";
    echo $row["observaciones"];
    echo "</td> <td> ";
    echo $row["plan_evaluacion"];
    echo "</td>";
    echo "</tr>";

}
echo "</table>";

?>

</body>

</html>
