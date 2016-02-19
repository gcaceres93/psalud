<?php
include_once 'biblioteca/conexionBd.php';
$recursoDeConexion = conectar('postgresql');
$user_name=$_POST['usuario'];
$pass=md5($_POST['contra']);
$rol=$_POST['rol'];



$query="CREATE USER $user_name WITH PASSWORD '$pass'";

$resultset = ejecutarQueryPostgreSql($recursoDeConexion,$query);

$q="insert into usuario (usuario,pass,rol) values ('$user_name','$pass','$rol')";

$rs = ejecutarQueryPostgreSql($recursoDeConexion,$q);


echo "ok";


?>
