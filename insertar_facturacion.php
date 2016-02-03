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
$usuario=$_SESSION['usuario'];


$q="select max(id_factura_detalle) as fact from factura_detalle";

$res=ejecutarQueryPostgreSql($recursoDeConexion,$q);

$res2=pg_fetch_assoc($res);

if ($res2==false){
    echo "ERROR";
}
else {

    while ($row = pg_fetch_assoc($res)){

        $idfacdet = $row["fact"];

    }

    if (empty($var)){
        $idfacdet=0;
    }

}
$idfacdet=$idfacdet+1;

$q="select (select max(valor_numero)  from parametros where nombre='ultimo_nro_factura') as ult_fact , (select valor_numero from parametros where nombre = 'timbrado') as timbrado, valor_fecha as vtim from parametros where nombre = 'vencimiento_timbrado'";

$res=ejecutarQueryPostgreSql($recursoDeConexion,$q);

$res2=pg_fetch_assoc($res);

if ($res2==false){
    echo "ERROR";
}
else {

    while ($row = pg_fetch_assoc($res)){

        $factura_nro = $row["ult_fact"];
        $timbrado = $row["timbrado"];
        $venc_tim = $row["vtim"];

    }
    echo var_dump($timbrado);
}

$factura_nro=$factura_nro+1;


$query="insert into factura_cabecera (id_factura_detalle,nro,fecha,monto_total,timbrado,vigencia_timbrado,usuario,tipo_pago) values ('$id_facdet','001-001-00'+'$factura_nro','$fecha','$total','$timbrado','$venc_tim','$usuario' )";

$resultSet = ejecutarQueryPostgreSql($recursoDeConexion,$query);

$grav=$total-$iva;

$query2="insert into factura_detalle  (id_factura_concepto,iva10,gravada10) values (1,'$iva','$grav')";
$rs=ejecutarQueryPostgreSql($recursoDeConexion,$query2);

echo trim ('ok');

?>