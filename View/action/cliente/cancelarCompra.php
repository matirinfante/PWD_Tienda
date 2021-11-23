<?php
include_once("../../../config.php");
$datos = data_submitted();

$retorno = array();

if (isset($datos['idcompraestado']) && isset($datos['idcompra']) && isset($datos['idcompraestadotipo']) && isset($datos['cefechaini']) && isset($datos['cefechafin'])) {
    $controller = new CompraEstadoController();
    if ($datos['idcompraestadotipo'] == 1) {
        $datos['idcompraestadotipo'] = 4;
        $datos['cefechafin'] = date("Y-m-d H:i:s");
        $resp = $controller->modificacion($datos);
    } else {
        $retorno['errorMsg'] = "No se pudo CANCELAR la compra. Recuerde que solo puede hacerlo si el estado es INICIADA.";
    }
} else {
    $resp = false;
    $retorno['errorMsg'] = "No se pudo MODIFICAR el estado.";
}
echo json_encode($retorno);
