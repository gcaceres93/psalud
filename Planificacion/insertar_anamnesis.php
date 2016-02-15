<?php

include_once 'biblioteca/conexionBd.php';

include ('biblioteca/lib/nusoap.php');
$cliente = new nusoap_client('http://localhost:80/servidor.php?wsdl');


$cedula=$_POST["cedula"];
$motivo_consulta=$_POST["motivo_consulta"];
$antecedentes_familiares=$_POST["antecedentes_familiares"];
$antecedentes_desarrollo=$_POST["antecedentes_desarrollo"];
$aspectos_generales=$_POST["aspectos_generales"];
$conclusiones=$_POST["conclusiones"];
$observaciones=$_POST["observaciones"];
$plan_evaluacion=$_POST["plan_evaluacion"];


$respuesta = $cliente->call('insertar_anamnesis',array('cedula'=>$cedula,'motivo_consulta'=>$motivo_consulta,'antecedentes_familiares'=>$antecedentes_familiares,'antecedentes_desarrollo'=>$antecedentes_desarrollo,'aspectos_generales'=>$aspectos_generales,'conclusiones'=>$conclusiones,'observaciones'=>$observaciones,'plan_evaluacion'=>$plan_evaluacion));
$respuesta=utf8_encode($respuesta);
echo ($respuesta);



?>