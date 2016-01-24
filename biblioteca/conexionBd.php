<?php
include_once 'biblioteca/utilerias.php';

function conectar($motorBd)
{
	return conectarAMotorEspecifico($motorBd);
}

function conectarAMotorEspecifico($motorBd)
{
	if( $motorBd == "postgresql" )
	   $pathArchivoConexion="config/configpostgres.inc";
	if( $motorBd == "mysql" )
	   $pathArchivoConexion="config/configmysql.inc";
	
	
	$bd       = null;
	$usuario  = null;
	$password = null;
	$host     = null;
	$port     = null;
	
	$manejador = fopen($pathArchivoConexion, "r");
    if (!$manejador) {
        die("No se pudo abrir el archivo");
    }
	
    $paramConexion = file($pathArchivoConexion);
	$cierreArch = fclose($manejador);
	if(!$cierreArch)
	   echo "No se pudo cerrar el archivo. CUIDADO!!!!";
	
	foreach ($paramConexion as $p) 
	{
        list($param, $valor) = explode("=", $p);
		$$param = $valor;
	}
	$host     = trim($host);
	$usuario  = trim($usuario);
	$password = trim($password);
	$bd       = trim($bd);
	
	if( $motorBd == 'postgresql' )
	{
		$cadenaConexion    = "host=$host port=$port dbname=$bd user=$usuario password=$password";
		$recursoDeConexion = pg_connect($cadenaConexion);
	
		if(!$recursoDeConexion)
			die("No se pudo conectar a la Base de datos");
	}
	
	if( $motorBd == 'mysql' )
	{
		$recursoDeConexion = mysql_connect($host,$usuario,$password) or die(mysql_error() ."No Pudo conectarese al servidor");
		mysql_select_db($bd,$recursoDeConexion);
	}
	
	return $recursoDeConexion;
}

function ejecutarQueryPostgreSql($recursoDeConexion,$query)
{
	$resultado = pg_query($recursoDeConexion, $query);
	if (!$resultado) 
	{
		echo "Ocurri� un Error - Fall� el Query.\n";
		exit;
	}
	return $resultado;
}

function ejecutarQueryMySql($recursoDeConexion,$query)
{
	$resultado = mysql_query($query,$recursoDeConexion);
    if(!$resultado){ 
      echo 'MySQL Error: ' . mysql_error();
      exit;
    }
    return $resultado;
}

function imprimirFormaTabularPostgreSql($resultSet,$nombreRegistros)
{
	$tamanho = count($nombreRegistros);
	echo '<html><head><title></title></head><body><table border="1">';
	while ( $registro = pg_fetch_assoc($resultSet) ) 
	{
	    echo "<tr>";
		for($i=0;$i<$tamanho;$i++)  
		  echo "<td>".utf8_decode($registro[$nombreRegistros[$i]])."</td>";
        
		echo "</tr>";
    }
	echo "</table></body>";
}

function crudPostgreSql($resultSet,$nombreRegistros)
{
	$tamanho = count($nombreRegistros);
	echo '<html><head><title></title></head><body><table border="1">';
	while ( $registro = pg_fetch_assoc($resultSet) ) 
	{
	    echo "<tr>";
		for($i=0;$i<$tamanho;$i++)  
		  echo "<td>".utf8_decode($registro[$nombreRegistros[$i]])."</td>";
        
		echo '<td><a href="borrar.php?id='. $registro[$nombreRegistros[0]] .'">Borrar</a></td>';
		echo '<td><a href="editar.php?producto_id='.$registro[$nombreRegistros[0]].'&nombreproducto='.$registro[$nombreRegistros[1]].
		      '&descripcion='.$registro[$nombreRegistros[2]].'&nombremarca='.$registro[$nombreRegistros[3]].'&nombretipo='.$registro[$nombreRegistros[4]].
		      '&marca_id='.$registro['marca_id'].'&tipo_id='.$registro['tipo_id'].'">Editar</a></td>';
		echo "</tr>";
    }
	echo '</table><a href="insertar.php">Insertar</a></body>';
}

function crearSelect($resultSet,$valorSeleccionado,$valores)
{
	$cad='';
	$cad.='<select name="'.$valores[2].'">';
	while ( $registro = pg_fetch_assoc($resultSet) ) 
	{
	    if($registro[$valores[0]]==$valorSeleccionado)
			$cad.='<option value="'.$registro[$valores[0]].'" selected="selected">'.$registro[$valores[1]].'</option>';	
		else
			$cad.='<option value="'.$registro[$valores[0]].'">'.$registro[$valores[1]].'</option>';	
	}
	$cad.="</select>";
	return $cad;
}

function imprimirFormaTabularMySql($resultSet,$nombreRegistros)
{
	$tamanho = count($nombreRegistros);
	echo '<html><head><title></title></head><body><table border="1">';
	while ( $registro = mysql_fetch_assoc($resultSet) ) 
	{
		echo "<tr>";
		for($i=0;$i<$tamanho;$i++)  
		  echo "<td>".utf8_decode($registro[$nombreRegistros[$i]])."</td>";
        
		echo "</tr>";
    }
	echo "</table></body>";
}

function desconectarPostgreSql($recursoDeConexion)
{
	pg_close($recursoDeConexion);
}

function desconectarMySql($recursoDeConexion)
{
	mysql_close($recursoDeConexion);
}
			
?>