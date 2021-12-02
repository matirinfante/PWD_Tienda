<?php
include_once("../../../config.php");
$datos = data_submitted();
$controller = new Carrito();
$retorno = array();
$resp = $controller->cancelarCompra($datos);
if (!$resp) {
    $retorno['errorMsg'] = "No se pudo MODIFICAR el estado.";
}
$retorno = $resp;
echo json_encode($retorno);
