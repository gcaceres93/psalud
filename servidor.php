<?php



//servidor.php
include_once 'biblioteca/conexionBd.php';
$recursoDeConexion = conectar('postgresql');
include ('nusoap/lib/nusoap.php');


$servidor = new nusoap_server();


$servidor->configureWSDL('urn:Servidor');
$servidor->wsdl->schemaTargetNamespace = 'urn:Servidor';

function recuperar_paciente ($cedula){

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
        return $respuesta;
    }




}

function recuperar_medico ($cedula){
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

    }
    $asd=array ('ced'=>'asd');
    return $asd;

}


$servidor->register (

    'recuperar_paciente' ,
    array ('cedula'=>'xsd:string'),
    array ('respuesta'=>'xsd:string'),
    'urn:Servidor.ejempl',
    'urn:Servidor.ejempl',
    'rpc',
    'encoded',
    'Utilizando SOAP PHP'

);


$servidor->register (

    'recuperar_medico' ,
    array ('cedula'=>'xsd:string'),
    array ('respuesta'=>'xsd:string'),
    'urn:Servidor.ejempl',
    'urn:Servidor.ejempl',
    'rpc',
    'encoded',
    'Utilizando SOAP PHP'

);


$HTTP_RAW_POST_DATA = isset ($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$servidor->service($HTTP_RAW_POST_DATA);


?>