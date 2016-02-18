
<?php
require_once ('nusoap/lib/nusoap.php');
include_once ('biblioteca/conexionBd.php');

$cliente = new nusoap_client('http://localhost:80/servidor.php?wsdl');
$recursoDeConexion = conectar('postgresql');
$cedula = $_GET["cedula"];
$query="select fc.nro as nro,fc.monto_total as monto,fc.timbrado as timbrado,fc.vigencia_timbrado as vig_tim,fc.observacion as obs,fc.fecha as fecha,fc.cliente as cliente,fc.medico as medico,fc.cant_horas as cant_horas,fd.gravada10 as gravada, fd.iva10 as iva from factura_cabecera fc, factura_detalle fd where fd.id_factura_detalle = fc.id_factura_detalle   order by id_factura desc limit 1";
$resultSet = ejecutarQueryPostgreSql($recursoDeConexion,$query);
$resultSet2 = pg_fetch_assoc($resultSet);
if ($resultSet2==false) {
    $respuesta = array();
    $respuesta['cedula2'] = 'No existe';
    echo json_encode ($respuesta);
} else {
    $rs = ejecutarQueryPostgreSql($recursoDeConexion,$query);

    while ($row = pg_fetch_assoc($rs)) {
        $respuesta = array();
        $respuesta['nro'] = $row["nro"];
        $respuesta['monto_total'] = $row["monto"];
        $respuesta['timbrado'] = $row["timbrado"];
        $respuesta['vig_tim'] = $row["vig_tim"];
        $respuesta['obs'] = $row["obs"];
        $respuesta['fecha'] = $row["fecha"];
        $respuesta['cliente'] = $row["cliente"];
        $respuesta['medico'] = $row["medico"];
        $respuesta['cant_horas'] = $row["cant_horas"];
        $respuesta['gravada'] = $row["gravada"];
        $respuesta['iva'] = $row["iva"];


    }


    $respuesta['costoH']=$respuesta['monto_total']/$respuesta['cant_horas'];
    $respuesta['nombreP'] = $cliente->call('recuperar_paciente',array('cedula'=>$respuesta['cliente']));
    $respuesta['nombreP']=utf8_encode($respuesta['nombreP']);
    $respuesta['nombreM'] = $cliente->call('recuperar_medico',array('cedula'=>$respuesta['medico']));
    $respuesta['nombreM']=utf8_encode($respuesta['nombreM']);


    echo json_encode($respuesta);
}
?>