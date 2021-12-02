<?php
include_once("../../../config.php");
$datos = data_submitted();

$retorno = array();
$controller = new CompraEstadoController();
$resp = $controller->cambiarEstado($datos);

$retorno = $resp;
echo json_encode($retorno);
