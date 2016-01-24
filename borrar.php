<?php
include_once 'biblioteca/conexionBd.php';
$recursoDeConexion = conectar('postgresql');
$id = $_GET['id'];
$query = "delete from producto where producto_id=$id;";
$resultSet = ejecutarQueryPostgreSql($recursoDeConexion,$query);
header("location:index.php");

echo "Se ha borrado el registro con $id <br/>";

/*
$query     = "select p.producto_id,p.nombre as nombreproducto, p.descripcion, m.marca_id, m.nombre as nombremarca,
              t.tipo_id, t.nombre as nombretipo
              from producto p
              inner join marca m using(marca_id)
              inner join tipo t using(tipo_id);";
$resultSet = ejecutarQueryPostgreSql($recursoDeConexion,$query);
$nombreRegistros = array('producto_id','nombreproducto','descripcion','nombremarca','nombretipo');
crudPostgreSql($resultSet,$nombreRegistros);
desconectarPostgreSql($recursoDeConexion);
*/