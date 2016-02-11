<?php
include ('nusoap/lib/nusoap.php');

$cliente= new nusoap_client('http://localhost:80/servidor.php?wsdl');

$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$cedula = $_POST["cedula"];
$ruc = $_POST["ruc"];
$direccion = $_POST["direccion"];
$email = $_POST["email"];
$telefono = $_POST["telefono"];
$fecha = $_POST["fecha"];
$ventana = $_POST ["ventana"];
$ruc = $_POST ["ruc"];

$respuesta=$cliente->call('insertar_persona',array('cedula'=>$cedula,'nombre'=>$nombre,'apellido'=>$apellido,'ruc'=>$ruc,'direccion'=>$direccion,'email'=>$email,'telefono'=>$telefono,'fecha'=>$fecha,'ventana'=>$ventana));

$respuesta=utf8_encode($respuesta);
echo ($respuesta);

?>