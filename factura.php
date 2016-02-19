<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />

    <title>Factura</title>

    <link rel='stylesheet' type='text/css' href='css/styles1.css' />
    <link rel='stylesheet' type='text/css' href='css/print.css' media="print" />
    <script type='text/javascript' src='js/jquery-1.3.2.min.js'></script>
    <script type='text/javascript' src='js/example.js'></script>
    <script>

        $(document).ready(function(){


        });













    </script>




</head>

<body>

<?php

require_once ('nusoap/lib/nusoap.php');
include_once ('biblioteca/conexionBd.php');

$cliente = new nusoap_client('http://localhost:80/servidor.php?wsdl');
$recursoDeConexion = conectar('postgresql');

$query="select fc.nro as nro,fc.monto_total as monto,fc.timbrado as timbrado,fc.vigencia_timbrado as vig_tim,fc.observacion as obs,fc.fecha as fecha,fc.cliente as cliente,fc.medico as medico,fc.cant_horas as cant_horas,fd.gravada10 as gravada, fd.iva10 as iva from factura_cabecera fc, factura_detalle fd where fd.id_factura_detalle = fc.id_factura_detalle   order by id_factura desc limit 1";
$resultSet = ejecutarQueryPostgreSql($recursoDeConexion,$query);
$resultSet2 = pg_fetch_assoc($resultSet);
if ($resultSet2==false) {
    $respuesta = array();
    $cedula2 = 'No';
} else {
    $rs = ejecutarQueryPostgreSql($recursoDeConexion,$query);

    while ($row = pg_fetch_assoc($rs)) {
        $respuesta = array();
        $nro = $row["nro"];
        $monto_total = $row["monto"];
        $timbrado = $row["timbrado"];
        $vig_tim = $row["vig_tim"];
        $obs = $row["obs"];
        $fecha = $row["fecha"];
        $cliente = $row["cliente"];
        $medico = $row["medico"];
        $cant_horas = $row["cant_horas"];
        $gravada = $row["gravada"];
        $iva = $row["iva"];
    }


    $costoH=$monto_total/$cant_horas;

    $q="select apellido,nombre from persona where cedula='$cliente'";
    $rs=ejecutarQueryPostgreSql($recursoDeConexion,$q);

    $row=pg_fetch_array($rs);

    $nombre=$row['apellido'].','.$row['nombre'];


}
?>

<div id="page-wrap">

    <textarea id="header">PSALUD</textarea>

    <div id="identity">
		
            <textarea id="address">PSalud
EEUU e/ 1ra y 2da;
Asuncion, Paraguay
Telefono: (0981) 314-154
Ruc:1234567-8 
Timbrado Nro:10666287
Vencimiento Timbrado:30/06/2016</textarea>

        <div id="logo">


            <img id="image" src="images/psad.png"  />
        </div>

    </div>

    <div style="clear:both"></div>
    Cliente:
    <div id="customer">

        <textarea id="customer-title"><?php echo "$nombre"; ?> </textarea><br/>Documento:<br/>
        <textarea id="customer-ruc"><?php echo "$cliente"; ?> </textarea>


        <table id="meta">
            <tr>
                <td class="meta-head">Factura Numero:</td>
                <td><textarea id='nro_fac'><?php echo "$nro"; ?> </textarea></td>
            </tr>
            <tr>

                <td class="meta-head">Fecha:</td>
                <td><textarea id="date"><?php echo "$fecha"; ?> </textarea></td>
            </tr>
            <tr>
                <td class="meta-head">Monto Total:</td>
                <td><textarea id='monto'><?php echo "$monto_total"; ?> </textarea></td>

            </tr>

        </table>

    </div>

    <table id="items">

        <tr>
            <th>Item</th>
            <th>Descripcion</th>
            <th>Costo Hora</th>
            <th>Cantidad Hora</th>
            <th>Total</th>
        </tr>

        <tr class="item-row">
            <td class="item-name"><div class="dlete-wpr"><textarea>Consulta</textarea><a class="delete" href="javascript:;" title="Remove row">X</a></div></td>
            <td class="description"><textarea id="observacion"><?php echo "$obs"; ?> </textarea></td>
            <td><textarea class="cost"><?php echo "$costoH"; ?> </textarea></td>
            <td><textarea class="qty"><?php echo "$cant_horas"; ?> </textarea></td>
            <td><textarea id="price"><?php echo "$monto_total"; ?> </textarea></td>
        </tr>


        <tr>
            <td colspan="2" class="blank"> </td>
            <td colspan="2" class="total-line">Gravada</td>
            <td class="total-value"><textarea id="subtotal"><?php echo "$gravada"; ?> </textarea></td>
        </tr>
        <tr>

            <td colspan="2" class="blank"> </td>
            <td colspan="2" class="total-line">IVA</td>
            <td class="total-value"><textarea id="iva"><?php echo "$iva"; ?> </textarea></td>
        </tr>
        <tr>
            <td colspan="2" class="blank"> </td>
            <td colspan="2" class="total-line balance">Total a PAgar</td>
            <td class="total-value balance"><textarea id="total_a"><?php echo "$monto_total"; ?> </textarea></td>
        </tr>

    </table>



</div>
<script>

</script>

</body>

</html>