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


            var cedula= 'cedula';

            var datos={
                'cedula' : cedula, };

            $.ajax({
                type:"get",
                dataType:"json",
                url:"../recuperar_factura.php",
                data: datos,
                success:function (data){
                    $("#customer-title").val(data.nombreP);
                    $("#customer-ruc").val(data.cliente);
                    $("#nro_fac").val(data.nro);
                    $("#date").val(data.fecha);
                    $("#monto").val(data.monto_total);
                    $("#observacion").val(data.obs);
                    $(".cost").val(data.costoH);
                    $(".qty").val(data.cant_horas);
                    $("#iva").val(data.iva);
                    $("#subtotal").val(data.gravada);
                    $("#price").val(data.monto_total);
                    $("#total_a").val(data.monto_total);

                }
            });


        });

    </script>




</head>

<body>

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

        <textarea id="customer-title"></textarea><br/>Documento:<br/>
        <textarea id="customer-ruc"></textarea>


        <table id="meta">
            <tr>
                <td class="meta-head">Factura Numero:</td>
                <td><textarea id='nro_fac'></textarea></td>
            </tr>
            <tr>

                <td class="meta-head">Fecha:</td>
                <td><textarea id="date"></textarea></td>
            </tr>
            <tr>
                <td class="meta-head">Monto Total:</td>
                <td><textarea id='monto'></textarea></td>

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
            <td class="description"><textarea id="observacion"></textarea></td>
            <td><textarea class="cost"></textarea></td>
            <td><textarea class="qty"> </textarea></td>
            <td><textarea id="price"> </textarea></td>
        </tr>


        <tr>
            <td colspan="2" class="blank"> </td>
            <td colspan="2" class="total-line">Gravada</td>
            <td class="total-value"><textarea id="subtotal"></textarea></td>
        </tr>
        <tr>

            <td colspan="2" class="blank"> </td>
            <td colspan="2" class="total-line">IVA</td>
            <td class="total-value"><textarea id="iva"></textarea></td>
        </tr>
        <tr>
            <td colspan="2" class="blank"> </td>
            <td colspan="2" class="total-line balance">Total a PAgar</td>
            <td class="total-value balance"><textarea id="total_a"></textarea></td>
        </tr>

    </table>



</div>

</body>

</html>