<?php
include_once("../../../../config.php");

$datos = data_submitted();
$resp = false;

if (isset($datos['idmenu']) && isset($datos['idrol'])) {
    $controller = new MenuRolController();
    $resp = $controller->baja($datos);
}
if (!$resp) {
    $retorno['errorMsg'] = "ERROR BAJA";
}

$retorno = $resp;
echo json_encode($retorno);
?>