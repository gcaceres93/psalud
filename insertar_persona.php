


<?php
include_once 'biblioteca/conexionBd.php';
$recursoDeConexion = conectar('postgresql');
$nombre = $_POST["nombre"]; 
$apellido = $_POST["apellido"]; 
$cedula = $_POST["cedula"]; 
$ruc = $_POST["ruc"]; 
$direccion = $_POST["direccion"]; 
$email = $_POST["email"]; 
$telefono = $_POST["telefono"]; 
$fecha = $_POST["fecha"];
$ventana = $_POST ["ventana"];
$query="insert into persona (nombre,apellido,nacimiento,telefono,direccion,email,cedula) values ('$nombre','$apellido','$fecha','$telefono','$direccion','$email','$cedula' )";

$resultSet = ejecutarQueryPostgreSql($recursoDeConexion,$query);

    $query2="select id_persona  from persona where cedula='$cedula'";
    $rs=ejecutarQueryPostgreSql($recursoDeConexion,$query2);
	$rs2=pg_fetch_assoc($rs);
	 
	if ($rs2==false){
		echo "Error al hacer select";
		
	}
	else{
		$rs3=ejecutarQueryPostgreSql($recursoDeConexion,$query2);
		while ($row = pg_fetch_assoc($rs3)) {
        $id_per = $row["id_persona"];
		}
		if ($ventana=='paciente'){
			
		
		$query3="insert into paciente (id_persona,ruc,cedula) values ($id_per,'$ruc','$cedula')";
		}
		else{
			$especialidad = $_POST ["especialidad"];
			$hdesde = $_POST ["hdesde"];
			$hhasta = $_POST ["hhasta"];
		
		$query3="insert into empleado (id_persona,codigo,id_cargo,apellido,hdesde,hhasta,especialidad) values ($id_per,'$id_per',1,'$apellido','$hdesde','$hhasta','$especialidad')";
		}
		$rset=ejecutarQueryPostgreSql($recursoDeConexion,$query3);
		echo trim('ok');
	}

?>