<?php

include_once 'biblioteca/conexionBd.php';

include ('biblioteca/lib/nusoap.php');
$cliente = new nusoap_client('http://localhost:80/servidor.php?wsdl');


$cedula=$_POST["cedula"];
$resumen=$_POST["resumen"];
$procedimientos_utilizados=$_POST["procedimientos_utilizados"];
$diagnostico_sindromes=$_POST["diagnostico_sindromes"];
$diagnostico_nosografico=$_POST["diagnostico_nosografico"];
$diagnostico_etiologico=$_POST["diagnostico_etiologico"];
$diagnostico_patogenico=$_POST["diagnostico_patogenico"];
$conclusion=$_POST["conclusion"];


$respuesta = $cliente->call('insertar_diagnostico',array('cedula'=>$cedula,'resumen'=>$resumen,'procedimientos_utilizados'=>$procedimientos_utilizados,'diagnostico_sindromes'=>$diagnostico_sindromes,'diagnostico_nosografico'=>$diagnostico_nosografico,'diagnostico_etiologico'=>$diagnostico_etiologico,'diagnostico_patogenico'=>$diagnostico_patogenico,'conclusion'=>$conclusion));
$respuesta=utf8_encode($respuesta);
echo ($respuesta);



?>