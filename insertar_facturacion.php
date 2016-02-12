<?php
include ('nusoap/lib/nusoap.php');
$cliente = new nusoap_client('http://localhost:80/servidor.php?wsdl');

$cedulaP = $_POST["cedulaPaciente"];
$cedulaM = $_POST["cedulaMedico"];
$fecha = $_POST["fecha"];
$horario = $_POST["horario"];
$direccion = $_POST["direccion"];
$cantidadH = $_POST["cantidadHoras"];
$iva = $_POST["totalIVA"];
$total = $_POST["totalP"];
session_start();
$usuario = $_SESSION["usuario"];

$respuesta = $cliente->call('facturar',array('cedulaP'=>$cedulaP,'cedulaM'=>$cedulaM,'fecha'=>$fecha,'horario'=>$horario,'direccion'=>$direccion,'cantidadH'=>$cantidadH,'iva'=>$iva,'total'=>$total,'usuario'=>$usuario));
$respuesta=utf8_encode($respuesta);
echo ($respuesta);




?>