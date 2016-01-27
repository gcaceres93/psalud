


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
$ruc = $_POST ["ruc"];

$query="update persona set  nombre='$nombre', apellido='$apellido' ,nacimiento='$fecha',telefono='$telefono',direccion='$direccion',email='$email',cedula='$cedula',ruc='$ruc' where cedula='$cedula' ";

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


        $query3="update paciente set ruc= '$ruc' where id_persona = '$id_per'";
    }
    else{
        $especialidad = $_POST ["especialidad"];
        $hdesde = $_POST ["hdesde"];
        $hhasta = $_POST ["hhasta"];

        $query3="update empleado set  apellido='$apellido', hdesde='$hdesde',hhasta='$hhasta',especialidad='$especialidad' where id_persona='$id_per'";
    }
    $rset=ejecutarQueryPostgreSql($recursoDeConexion,$query3);
    echo trim('ok');
}

?>