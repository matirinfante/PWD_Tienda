<?php
include_once("../../../config.php");
$data = data_submitted();

if (isset($data['idrol']) && isset($data['roldescripcion'])) {
    $controller = new RolController();
    $resp = $controller->alta($data);
} else {
    $respuesta['errorMsg'] = "ERROR ALTA";
}
$respuesta['respuesta'] = $resp;
echo json_encode($respuesta);
?>