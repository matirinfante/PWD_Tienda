<?php
include_once("../../../config.php");
$data = data_submitted();

if (isset($data['idrol']) && isset($data['roldescripcion'])) {
    $controller = new RolController();
    $resp = $controller->modificacion($data);
} else {
    $resp = false;
    $respuesta['errorMsg'] = "ERROR MODIFICAR";
}
$respuesta['respuesta'] = $resp;
echo json_encode($respuesta);
?>