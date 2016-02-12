<?php




require_once ('nusoap/lib/nusoap.php');



//Create a new soap server
$server = new soap_server();

//Define our namespace
$server->configureWSDL('urn:Servidor');
$server->wsdl->schemaTargetNamespace = 'urn:Servidor';
$server->wsdl->addComplexType(
    'Person',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'id_user' => array('name' => 'id_user', 'type' => 'xsd:int'))
);



//first simple function
$server->register ('insertar_persona',
    array ('cedula' => 'xsd:string', 'nombre' =>'xsd:string', 'apellido'=> 'xsd:string', 'ruc'=>'xsd:string','direccion'=>'xsd:string','email'=>'xsd:string','telefono'=>'xsd:string','fecha'=>'xsd:date','ventana'=>'xsd:string'),
    array ('return'=> 'xsd:string'),
    'urn:Servidor.hello',   //namespace
    'urn:Servidor.hello',  //soapaction
    'rpc', // style
    'encoded', // use
    'Se inserta en personas');


$server->register('recuperar_paciente',
    array('cedula' => 'xsd:string'),  //parameter
    array('return' => 'xsd:string'),  //output
    'urn:Servidor.hello',   //namespace
    'urn:Servidor.hello',  //soapaction
    'rpc', // style
    'encoded', // use
    'Just say hello');


$server->register('recuperar_medico',
    array ('cedula'=>'xsd:string'),
    array ('return' => 'xsd:string'),
    'urn:Servidor',
    'urn:Servidor',
    'rpc',
    'encoded',
    'Recuperar');

$server->register('verificar_persona',
    array ('cedula'=>'xsd:string'),
    array ('return' => 'xsd:boolean'),
    'urn:Servidor',
    'urn:Servidor',
    'rpc',
    'encoded',
    'Verificar');


$server->register('facturar',
    array ('cedulaP' => 'xsd:string','cedulaM'=>'xsd:string','fecha'=>'xsd:date','horario'=>'xsd:time','direccion'=>'xsd:string','cantidadH'=>'xsd:integer','iva'=>'xsd:numeric','total'=>'xsd:numeric','usuario'=>'xsd:string'),
    array ('return'=>'xsd:string'),
    'urn:Servidor',
    'urn:Servidor',
    'rpc',
    'encoded',
    'Facturar'
);

function facturar ($cedulaP,$cedulaM,$fecha,$horario,$direccion,$cantidadH,$iva,$total,$usuario){

    include_once 'biblioteca/conexionBd.php';
    $recursoDeConexion = conectar('postgresql');


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
    return trim ('ok');



}

function verificar_persona ($cedula){
    include_once 'biblioteca/conexionBd.php';
    $recursoDeConexion = conectar('postgresql');

    $query="select cedula from persona p where p.cedula='$cedula'";

    $resultSet = ejecutarQueryPostgreSql($recursoDeConexion,$query);

    $rs=pg_fetch_assoc($resultSet);

    if ($rs==false){
        $resultado=false;
        return $resultado;
    }
    else {
        $resultado=true;
        return $resultado;
    }

}

function insertar_persona($cedula,$nombre,$apellido,$ruc,$direccion,$email,$telefono,$fecha,$ventana){

    include_once 'biblioteca/conexionBd.php';
    $recursoDeConexion = conectar('postgresql');
    $query="insert into persona (nombre,apellido,nacimiento,telefono,direccion,email,cedula) values ('$nombre','$apellido','$fecha','$telefono','$direccion','$email','$cedula' )";

    $resultSet = ejecutarQueryPostgreSql($recursoDeConexion,$query);

    $query2="select id_persona  from persona where cedula='$cedula'";
    $rs=ejecutarQueryPostgreSql($recursoDeConexion,$query2);
    $rs2=pg_fetch_assoc($rs);

    if ($rs2==false){
        return ("Error al hacer select");

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
        return trim('ok');
    }

}


function recuperar_paciente($cedula) {
    include_once 'biblioteca/conexionBd.php';
    $recursoDeConexion = conectar('postgresql');

    $query="select p.nombre,p.apellido from paciente as pa, persona as p where  p.id_persona=pa.id_persona and p.cedula = '$cedula'  ";
    $resultSet = ejecutarQueryPostgreSql($recursoDeConexion,$query);
    $resultSet2 = pg_fetch_assoc($resultSet);
    if ($resultSet2==false) {
        return "no existe";
    } else {
        $rs = ejecutarQueryPostgreSql($recursoDeConexion,$query);
        while ($row = pg_fetch_assoc($rs)) {
            $respuesta = $row["apellido"] . "," . $row["nombre"];
        }
        return $respuesta;
    }
}

function recuperar_medico($cedula){
    include_once 'biblioteca/conexionBd.php';
    $recursoDeConexion = conectar('postgresql');


    $query="select e.codigo,p.nombre,p.apellido from empleado as e, persona as p, cargos as c where c.id_cargo = 1 and e.id_persona=p.id_persona and p.cedula = '$cedula' ";
    $resultSet = ejecutarQueryPostgreSql($recursoDeConexion,$query);
    $resultSet2 = pg_fetch_assoc($resultSet);
    if ($resultSet2==false) {
        return "no existe";
    } else {
        $rs = ejecutarQueryPostgreSql($recursoDeConexion,$query);
        while ($row = pg_fetch_assoc($rs)) {
            $respuesta = $row["apellido"] . "," . $row["nombre"];
        }
        return $respuesta;
    }

}

$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';

$server->service($HTTP_RAW_POST_DATA);


?>