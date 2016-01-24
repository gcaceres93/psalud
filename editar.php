<?php
include_once 'biblioteca/conexionBd.php';

$productoId=$_GET['producto_id'];
$nombreProducto=$_GET['nombreproducto'];
$descripcion=$_GET['descripcion'];
$marcaId=$_GET['marca_id'];
$nombreMarca=$_GET['nombremarca'];
$tipoId=$_GET['tipo_id'];
$tipoNombre=$_GET['nombretipo'];
echo $productoId." ".$nombreProducto." ".$descripcion." ".$marcaId." ".$nombreMarca." ".$tipoId." ".$tipoNombre;

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


$formulario=<<<INICIO
<html>
<head>
<title>Editar Tabla</title>
</head>
<form action="editar_update.php" method="post">
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
echo $formulario;
