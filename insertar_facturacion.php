<?php
include_once 'biblioteca/conexionBd.php';
$recursoDeConexion = conectar('postgresql');
$cedulaP = $_POST["cedulaPaciente"];
$cedulaM = $_POST["cedulaMedico"];
$fecha = $_POST["fecha"];
$horario = $_POST["horario"];
$direccion = $_POST["direccion"];
$cantidadH = $_POST["cantidadHoras"];
$iva = $_POST["totalIVA"];
$total = $_POST["totalP"];
session_start();
$usuario = $_SESSION["usuario"];





$q="select (select max(valor_numero)  from parametros where nombre='ultimo_nro_factura') as ult_fact , (select valor_numero from parametros where nombre = 'timbrado') as timbrado, valor_fecha as vtim from parametros where nombre = 'vencimiento_timbrado'";

$res=ejecutarQueryPostgreSql($recursoDeConexion,$q);

while ($row = pg_fetch_assoc($res) ) {
    $factura_nro = $row["ult_fact"];
    $timbrado = $row["timbrado"];
    $venc_tim = $row["vtim"];

}



$factura_nro=$factura_nro+1;
$factura_nro2=$factura_nro;
$factura_nro='001-001-00'.$factura_nro;
$grav=$total-$iva;

$query2="insert into factura_detalle  (id_factura_concepto,iva10,gravada10) values (1,'$iva','$grav')";



$qu="select max(id_factura_detalle) as fact from factura_detalle";

$rese=ejecutarQueryPostgreSql($recursoDeConexion,$qu);

while ($row = pg_fetch_assoc($rese)){

    $idfacdet = $row["fact"];

}


$rs=ejecutarQueryPostgreSql($recursoDeConexion,$query2);

$query="insert into factura_cabecera (id_factura_detalle,nro,fecha,monto_total,timbrado,vigencia_timbrado,usuario,tipo_pago) values ('$idfacdet','$factura_nro','$fecha','$total','$timbrado','$venc_tim','$usuario','C' )";

$resultSet = ejecutarQueryPostgreSql($recursoDeConexion,$query);

$lq="update parametros set valor_numero='$factura_nro2' where nombre='ultimo_nro_factura'";
$resuSet = ejecutarQueryPostgreSql($recursoDeConexion,$lq);
echo trim ('ok');

?>