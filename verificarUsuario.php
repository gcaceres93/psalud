<?php
include_once 'biblioteca/conexionBd.php';
$recursoDeConexion = conectar('postgresql');
//Realizar Select
$usuario = $_POST["usuario"]; 
$passwd = md5($_POST["pass"]);
$query="select usuario.usuario, usuario.pass from usuario where usuario.usuario = '$usuario' and pass = '$passwd'";
$resultSet = ejecutarQueryPostgreSql($recursoDeConexion,$query);
$resultSet2 = pg_fetch_assoc($resultSet);
if ($resultSet2==false) {
    echo "No existe";

} else{
echo "existe";
session_start();
$_SESSION['usuario'] = $_POST['usuario'];
}
?>