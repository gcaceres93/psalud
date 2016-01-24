<?php
include_once 'biblioteca/conexionBd.php';

	$recursoDeConexion = conectar('postgresql');
	//Realizar Select
	$query     = "select marca_id,nombre
              from marca
              ;";
	$resultSetMarca = ejecutarQueryPostgreSql($recursoDeConexion,$query);
	$valoresMarca=array('marca_id','nombre','marca');
	$selectMarca=crearSelect($resultSetMarca,$marcaId,$valoresMarca);

	//Realizar Select
	$query     = "select tipo_id,nombre
              from tipo
              ;";
	$resultSetTipo = ejecutarQueryPostgreSql($recursoDeConexion,$query);
	$valoresTipo=array('tipo_id','nombre','tipo');
	$selectTipo=crearSelect($resultSetTipo,$tipoId,$valoresTipo);
	desconectarPostgreSql($recursoDeConexion);

$formulario=<<<INICIO
<html>
<head>
<title>Editar Tabla</title>
</head>
<form action="" method="post">
	<table>
		<tr>
		  <td>Nombre del Producto</td>
		  <td><input type="text" value="$nombreProducto" name='nombreproducto'/></td>
		</tr>
		<tr>
		  <td>Descripcion</td>
		  <td><input type="text" value="$descripcion" name="descripcion"/></td>
		</tr>
		<tr>
			<td>Marca</td>
			<td>$selectMarca</td>
		</tr>
		<tr>
			<td>Tipo</td>
			<td>$selectTipo</td>
		</tr>
		<tr>
		  <td></td>
		  <td><input type="submit" value="Guardar Cambios"/></td>
		</tr>
	</table>
	<input type="hidden" value="$productoId" name="productoid"/>	
</form>
</html>
INICIO;

if(!isset($_POST['productoid']))
{
	echo $formulario;
}
else{
	$recursoDeConexion = conectar('postgresql');
	$np=$_POST['nombreproducto'];
	$d=$_POST['descripcion'];
	$t=$_POST['tipo'];
	$m=$_POST['marca'];
	//Realizar Select
	$query     = "insert into producto (nombre,descripcion,tipo_id,marca_id)
			      values('$np','$d',$t,$m);";
	var_dump($query);
	$resultSet = ejecutarQueryPostgreSql($recursoDeConexion,$query);
	desconectarPostgreSql($recursoDeConexion);
	header("location:index.php");
}