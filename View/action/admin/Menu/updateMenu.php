<?php
include_once("../../../../config.php");
$data = data_submitted();

if (isset($data['idmenu']) && isset($data['menombre']) && isset($data['medescripcion']) && isset($data['idpadre']) && isset($data['medeshabilitado'])) {
    $controller = new MenuController();
    $resp = $controller->modificacion($data);
} else {
    $respuesta['errorMsg'] = "ERROR DELETE";
}

$respuesta['respuesta'] = $resp;
echo json_encode($respuesta);

?>