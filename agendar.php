<?php
include_once 'biblioteca/conexionBd.php';
$recursoDeConexion = conectar('postgresql');
//Realizar Select
$cedulaM = $_POST["cedulaMedico"];
$cedulaP = $_POST["cedulaPaciente"];
$fecha = $_POST["fecha"];
$horario = $_POST["horario"];
$comentario = $_POST["comentario"];



include ('nusoap/lib/nusoap.php');

$cliente = new nusoap_client('http://localhost:80/servidor.php?wsdl');

$respuesta = $cliente->call('agendar',array('cedulaP'=>$cedulaP,'cedulaM'=>$cedulaM,'fecha'=>$fecha,'hora'=>$horario,'comentario'=>$comentario));
$respuesta=utf8_encode($respuesta);

echo ($respuesta);


?>