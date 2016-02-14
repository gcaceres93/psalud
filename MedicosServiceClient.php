<?php
require_once "biblioteca/lib/nusoap.php";

$cliente = new nusoap_client('http://localhost:8020/psalud/medicosServiceServer.php');


$error = $cliente->getError();
if ($error) {
    echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
}

$result = $cliente->call("listarMedicos", array("medicos" => "medicos"));

if ($cliente->fault) {
    echo "<h2>Fault</h2><pre>";
    print_r($result);
    echo "</pre>";
}
else {
    $error = $cliente->getError();
    if ($error) {
        echo "<h2>Error</h2><pre>" . $error . "</pre>";
    }
    else {
        echo "<h2>Medicos</h2><pre>";
        echo $result;
        echo "</pre>";
    }
}
?>