<?php
include_once("../../../config.php");
$datos = data_submitted();

$retorno = array();

if (isset($datos['idcompraestado']) && isset($datos['idcompra']) && isset($datos['idcompraestadotipo']) && isset($datos['cefechaini']) && isset($datos['cefechafin'])) {
    $controller = new CompraEstadoController();
    $datos['idcompraestadotipo'] = 4;
    $datos['cefechafin'] = date("Y-m-d H:i:s");
    $resp = $controller->modificacion($datos);
    $retorno['errorMsg'] = $datos['idcompraestado'];
} else {
    $resp = false;
    $retorno['errorMsg'] = "No se pudo MODIFICAR el estado.";
}
$retorno = $resp;
echo json_encode($retorno);
