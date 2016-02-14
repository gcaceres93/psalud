<?php
include_once 'biblioteca/conexionBd.php';
$recursoDeConexion = conectar('postgresql');
/*$query='select p.nombre,p.apellido,p.nacimiento,u.usuario,r.nombre from personas p, usuario u, roles r where p.id_persona=u.id_persona and u.rol '*/
    $fechadesde= $_GET["fechadesde"];
    $fechahasta= $_GET["fechahasta"];
$query="select p.cedula, p.nombre, p.apellido, p.nacimiento, pac.razon_social, pac.ruc, p.telefono, p.direccion, p.email, cc.id_consulta, a.fecha_programada, cc.observaciones, cc.cantidad_sesiones from agendamiento a,persona p, paciente pac, consulta_cabecera cc, consulta_detalle cd where p.id_persona= pac.id_persona AND a.id_agendamiento=cd.id_agendamiento AND cc.cedula= pac.cedula AND a.fecha_programada between '$fechadesde' AND '$fechahasta'";


$rs=ejecutarQueryPostgreSql($recursoDeConexion,$query);
$bar=0;
while ($row=pg_fetch_assoc($rs))
{
    $bar=$bar+1;
    $resultado[$bar]=array("<input type='checkbox' class='checkthis' />",$row["cedula"],$row["nombre"],$row["apellido"],$row["nacimiento"],$row["razon_social"],$row["ruc"],$row["telefono"],$row["direccion"],$row["email"],$row["id_consulta"],$row["observaciones"],$row["cantidad_Sesiones"]);




}
echo json_encode ($resultado);



?>