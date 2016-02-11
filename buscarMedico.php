<?php




include ('nusoap/lib/nusoap.php');


$cliente = new nusoap_client('http://localhost:80/servidor.php?wsdl');


$cedula = $_GET["cedula"];

$respuesta = $cliente->call('recuperar_medico', array ('cedula'=>$cedula));
$respuesta=utf8_encode($respuesta);

echo ($respuesta);


?>