<?php




require_once ('biblioteca/lib/nusoap.php');



//Create a new soap server
$server = new soap_server();
$URL       = "http:localhost:80/servidor";
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
    'urn:Servidor.insertar_anamnesis',
    'urn:Servidor.insertar_anamnesis',
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

$server->register('verificar_fecha',
    array ('cedulaP' => 'xsd:string','cedulaM'=>'xsd:string','fecha'=>'xsd:date','horario'=>'xsd:time'),
    array ('return'=>'xsd:string'),
    'urn:Servidor.verificar_fecha',
    'urn:Servidor.verificar_fecha',
    'rpc',
    'encoded',
    'Verificar fecha'
);


$server->register('agendar',
    array ('cedulaP' => 'xsd:string','cedulaM'=>'xsd:string','fecha'=>'xsd:date','horario'=>'xsd:time','comentario'=>'xsd:string'),
    array ('return'=>'xsd:string'),
    'urn:Servidor.verificar_fecha',
    'urn:Servidor.verificar_fecha',
    'rpc',
    'encoded',
    'Verificar fecha'
);

$server->register('diagnostico',
    array ('cedula'=>'xsd:string','resumen'=>'xsd:string','procedimientos_utilizados'=>'xsd:string','diagnostico_sindromes'=>'xsd:string','diagnostico_nosografico'=>'xsd:string','diagnostico_etiologico'=>'xsd:string','diagnostico_patogenico'=>'xsd:string','conclusion'=>'xsd:string'),
    array ('return' => 'xsd:string'),
    'urn:Servidor.diagnostico',
    'urn:Servidor.diagnostico',
    'rpc',
    'encoded',
    'Diagnostico');

function diagnostico ($cedula,$resumen,$procedimientos_utilizados,$diagnostico_sindromes,$diagnostico_nosografico,$diagnostico_etiologico,$diagnostico_patogenico,$conclusion) {
    include_once 'biblioteca/conexionBd.php';
    $recursoDeConexion = conectar('postgresql');
    $query="select id_anamnesis from anamnesis where cedula='$cedula'";
    $rs=ejecutarQueryPostgreSql($recursoDeConexion,$query);

    while ($row=pg_fetch_assoc($rs)){

        $anam=$row["id_anamnesis"];
    }

    $exi='0';

    $que="select resumen from diagnostico where id_anamnesis=$anam";
    $rs2=ejecutarQueryPostgreSql($recursoDeConexion,$que);

    while ($row2=pg_fetch_assoc($rs2)){
        $exi=$row2["resumen"];
    }

    if ($exi=='0'){
        $q="insert into diagnostico (id_anamnesis,resumen,procedimientos_utilizados,diagnostico_sindromes,diagnostico_nosografico,diagnostico_etiologico,diagnostico_patogenico,conclusion) values ('$anam','$resumen','$procedimientos_utilizados','$diagnostico_sindromes','$diagnostico_nosografico','$diagnostico_etiologico','$diagnostico_patogenico','$conclusion')";
        $resultset=ejecutarQueryPostgreSql($recursoDeConexion,$q);
        return 'ok';}
    else {
        $q="update diagnostico set resumen='$resumen', procedimientos_utilizados='$procedimientos_utilizados',diagnostico_sindromes='$diagnostico_sindromes',diagnostico_nosografico='$diagnostico_nosografico',diagnostico_etiologico='$diagnostico_patogenico',conclusion='$conclusion' where id_anamnesis='$anam'";
        $resultset=ejecutarQueryPostgreSql($recursoDeConexion,$q);
        return 'ok';
    }
}


function agendar($cedulaP,$cedulaM,$fecha,$horario,$comentario){
    include_once 'biblioteca/conexionBd.php';
    $recursoDeConexion = conectar('postgresql');
    $query1="select codigo from empleado,persona where empleado.id_persona = persona.id_persona and persona.cedula = '$cedulaM'";

    $rs= ejecutarQueryPostgreSql($recursoDeConexion,$query1);
    while ($row = pg_fetch_assoc($rs)) {
        $codigo = $row["codigo"];
    }
    $fecha_actual=date("d/m/Y");
    $query2="insert into agendamiento(id_modalidad,codigo,id_sucursal,fecha_programada,fecha_registro,hora_programada,comentario)
		VALUES (1,'$codigo',1,'$fecha','$fecha_actual','$horario','$comentario')";
    $resultSet = ejecutarQueryPostgreSql($recursoDeConexion,$query2);
    return 'ok';

}




function verificar_fecha($cedulaP,$cedulaM,$fecha,$horario){


    include_once 'biblioteca/conexionBd.php';
    $recursoDeConexion = conectar('postgresql');
//Realizar Select

    $query="select a.id_agendamiento from agendamiento as a, persona as p, empleado as e where  a.fecha_programada = '$fecha' and a.hora_programada = '$horario' and p.id_persona = e.id_persona and p.cedula = '$cedulaM'";
    $resultSet = ejecutarQueryPostgreSql($recursoDeConexion,$query);
    $resultSet2 = pg_fetch_assoc($resultSet);
    if ($resultSet2==false) {
        $d = array('valor' => 'no');
        return ($d);
    } else {

        $bandera = 'true';
        $hora = mb_substr($horario,0,2)+1+':00';
        $hora_seguerida = $hora.':00';
        while ($bandera == 'true'){
            if ($hora > 19 || $hora < 8){
                $hora = 8;
                $hora_seguerida = $hora.':00';
            }
            $fecha_sugerida = array
            ("fecha" => $fecha,
                "horario" => $hora_seguerida
            );
            $query="select a.id_agendamiento from agendamiento as a, persona as p, empleado as e where  a.fecha_programada = '$fecha' and a.hora_programada = '$hora_seguerida' and p.id_persona = e.id_persona and p.cedula = '$cedulaM'";
            $rs = ejecutarQueryPostgreSql($recursoDeConexion,$query);
            $rs2 = pg_fetch_assoc($rs);
            if ($rs2==false) {
                $bandera = 'false';
            }else{
                $hora = mb_substr($hora_seguerida,0,2)+1+':00';
                $hora_seguerida = $hora.':00';
                if ($hora >= 20){
                    $dia = mb_substr($fecha,8,2) + 1;
                    $fecha = mb_substr($fecha,0,8).$dia;
                }
            }
        }
    }
    if ($bandera == 'false')
        return ($fecha_sugerida);
}





function insertar_anamnesis($cedula,$motivo_consulta,$antecedentes_familiares,$antecedentes_desarrollo,$aspectos_generales,$conclusiones,$observaciones,$plan_evaluacion)
{

    include_once 'biblioteca/conexionBd.php';
    $recursoDeConexion = conectar('postgresql');

    $query = "select id_consulta as consul from consulta_cabecera where cedula='$cedula'  ";

    $resultado = ejecutarQueryPostgreSql($recursoDeConexion,$query);

    while ($row = pg_fetch_assoc($resultado)) {

        $consulta = $row["consul"];

    }
    $exi = '0';

    $q = "select cedula from anamnesis where cedula='$cedula'  ";


    $rs = ejecutarQueryPostgreSql($recursoDeConexion,$q);

    $rs2 = pg_fetch_assoc($rs);

    if ($rs2 == false) {
        $exi = '0';

    } else {
        $exi = '1';

    }

    if ($exi == '1') {
        $que = "update anamnesis set motivo_consulta='$motivo_consulta', antecedentes_familiares='$antecedentes_familiares',antecedentes_desarrollo = '$antecedentes_desarrollo',aspectos_generales = '$aspectos_generales',conclusiones = '$conclusiones',observaciones = '$observaciones',plan_evaluacion = '$plan_evaluacion' where cedula='$cedula'";
        $rset = ejecutarQueryPostgreSql($recursoDeConexion,$que);
        return utf8_encode('ok');

    } else{
        $que = "insert into  anamnesis  (id_consulta,cedula,motivo_consulta, antecedentes_familiares,antecedentes_desarrollo,aspectos_generales,conclusiones,observaciones,plan_evaluacion) values ('$consulta','$cedula','$motivo_consulta','$antecedentes_familiares','$antecedentes_desarrollo','$aspectos_generales','$conclusiones','$observaciones','$plan_evaluacion')";
        $rset = ejecutarQueryPostgreSql($recursoDeConexion,$que);
        return utf8_encode('ok');
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