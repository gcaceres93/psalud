<?php
include_once 'biblioteca/conexionBd.php';

$productoId=$_POST['productoid'];
$nombreProducto=$_POST['nombreproducto'];
$descripcion=$_POST['descripcion'];
$marcaId=$_POST['marca'];
$tipoId=$_POST['tipo'];

//echo $productoId." ".$nombreProducto." ".$descripcion." ".$marcaId." ".$nombreMarca." ".$tipoId." ".$tipoNombre;

$recursoDeConexion = conectar('postgresql');
//Realizar Select
$query     = "update producto 
			  set tipo_id=$tipoId,marca_id=$marcaId,nombre='$nombreProducto',descripcion='$descripcion'
              where producto_id=$productoId;";
$resultSetMarca = ejecutarQueryPostgreSql($recursoDeConexion,$query);
desconectarPostgreSql($recursoDeConexion);

header("location:index.php");