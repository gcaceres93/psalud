<?php
require_once "biblioteca/lib/nusoap.php";
include_once 'biblioteca/conexionBd.php';

function listarMedicos($medicos) {
    $lista_medicos = array();
    $recursoDeConexion = conectar('postgresql');
    /*$query='select p.nombre,p.apellido,p.nacimiento,u.usuario,r.nombre from personas p, usuario u, roles r where p.id_persona=u.id_persona and u.rol '*/
    $query="select p.cedula,p.nombre,p.apellido,p.nacimiento,e.especialidad,e.hdesde,e.hhasta,p.telefono,p.direccion,p.email from persona p, empleado e where p.id_persona=e.id_persona order by  p.apellido asc";
    $rs=ejecutarQueryPostgreSql($recursoDeConexion,$query);
    while ($row=pg_fetch_assoc($rs))
    {
        array_push($lista_medicos, $row["apellido"].",".["nombre"]);
    }
}

$server = new soap_server();
$server->configureWSDL("medico", "urn:medico");

$server->register("listarMedicos",
    array("medicos" => "xsd:string"),
    array("return" => "xsd:string"),
    "urn:medico",
    "urn:medico#listarMedicos",
    "rpc",
    "encoded",
    "Nos da una lista de los medicos");

$server->service($HTTP_RAW_POST_DATA);

?>