<?php




require_once ('biblioteca/lib/nusoap.php');



//Create a new soap server
$server = new soap_server();
$URL       = "http:localhost:8020/psalud/servidor";
$namespace = $URL . '?wsdl';
//using soap_server to create server object
$server    = new soap_server;
$server->configureWSDL('servidor', $namespace);
//Define our namespace

/*$server->wsdl->addComplexType(
    'Person',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'id_user' => array('name' => 'id_user', 'type' => 'xsd:int'))
);

*/

//first simple function
$server->register ('insertar_persona',
    array ('cedula' => 'xsd:string', 'nombre' =>'xsd:string', 'apellido'=> 'xsd:string', 'ruc'=>'xsd:string','direccion'=>'xsd:string','email'=>'xsd:string','telefono'=>'xsd:string','fecha'=>'xsd:date','ventana'=>'xsd:string'),
    array ('return'=> 'xsd:string'),
    'urn:Servidor.insertar_persona',   //namespace
    'urn:Servidor.insertar_persona',  //soapaction
    'rpc', // style
    'encoded', // use
    'Se inserta en personas');


$server->register('insertar_anamnesis',
    array('cedula'=>'xsd:string','motivo_consulta'=>'xsd:string','antecedentes_familiares'=>'xsd:string','antecedentes_desarrollo'=>'xsd:string','aspectos_generales'=>'xsd:string','conclusiones'=>'xsd:string','observaciones'=>'xsd:string','plan_evaluacion'=>'xsd:string'),
    array ('return'=>'xsd:string'),
    'urn:Servidor.insertar_anamneis',
    'urn:Servidor.insertar_anamneis',
    'rpc','encoded','Se inserta el anamnesis');


$server->register('recuperar_paciente',
    array('cedula' => 'xsd:string'),  //parameter
    array('return' => 'xsd:string'),  //output
    'urn:Servidor.recuperar_paciente',   //namespace
    'urn:Servidor.recuperar_paciente',  //soapaction
    'rpc', // style
    'encoded', // use
    'Just say hello');


$server->register('recuperar_medico',
    array ('cedula'=>'xsd:string'),
    array ('return' => 'xsd:string'),
    'urn:Servidor.recuperar_medico',
    'urn:Servidor.recuperar_medico',
    'rpc',
    'encoded',
    'Recuperar');

$server->register('verificar_persona',
    array ('cedula'=>'xsd:string'),
    array ('return' => 'xsd:boolean'),
    'urn:Servidor.verificar_persona',
    'urn:Servidor.verificar_persona',
    'rpc',
    'encoded',
    'Verificar');


$server->register('facturar',
    array ('cedulaP' => 'xsd:string','cedulaM'=>'xsd:string','fecha'=>'xsd:date','horario'=>'xsd:time','direccion'=>'xsd:string','cantidadH'=>'xsd:integer','iva'=>'xsd:numeric','total'=>'xsd:numeric','usuario'=>'xsd:string'),
    array ('return'=>'xsd:string'),
    'urn:Servidor.facturar',
    'urn:Servidor.facturar',
    'rpc',
    'encoded',
    'Facturar'
);

function insertar_anamnesis($cedula,$motivo_consulta,$antecedentes_familiares,$antecedentes_desarrollo,$aspectos_generales,$conclusiones,$observaciones,$plan_evaluacion)
{

    include_once 'biblioteca/conexionBd.php';
    $recursoDeConexion = conectar('postgresql');
    $exi = 0;
    $query = "select id_consulta from consulta_cabecera where cedula='$cedula'  ";

    $resultado = "ejecutarQueryPostgreSql($recursoDeConexion,$query)";

    while ($row = pg_fetch_assoc($resultado)) {

        $consulta = $row['id_consulta'];

    }


    $q = "select cedula from anamnesis where cedula='$cedula'  ";


    $rs = "ejecutarQueryPostgreSql($recursoDeConexion,$q)";

    $rs2 = pg_fetch_assoc($rs);

    if ($rs2 == false) {
        $exi = 0;

    } else {
        $exi = 1;

    }

    if ($exi == 1) {
        $que = "update anamnesis set motivo_consulta='$motivo_consulta', antecedentes_familiares='$antecedentes_familiares',antecedentes_desarrollo = '$antecedentes_desarrollo',aspectos_generales = '$aspectos_generales',conclusiones = '$conclusiones',observaciones = '$observaciones',plan_evaluacion = '$plan_evaluacion' where cedula='$cedula'";
        $rset = "ejecutarQueryPostgreSql($recursoDeConexion,$que)";
        return 'ok';

    } else{
        $que = "insert into  anamnesis  (id_consulta,cedula,motivo_consulta, antecedentes_familiares,antecedentes_desarrollo,aspectos_generales,conclusiones,observaciones,plan_evaluacion) values '$consulta','$cedula','$motivo_consulta','$antecedentes_familiares','$antecedentes_desarrollo','$aspectos_generales','$conclusiones','$observaciones','$plan_evaluacion'";
        $rset = "ejecutarQueryPostgreSql($recursoDeConexion,$que)";
        return 'ok2';
    }




}


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