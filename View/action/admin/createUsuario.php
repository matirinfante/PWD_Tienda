<?php
include_once("../../../config.php");
$data = data_submitted();

if (isset($data['usnombre']) && isset($data['uspass'])) {
    $data['uspass'] = md5($data['uspass']);
    $controller = new UsuarioController();
    $respuesta = $controller->insertar($data);
} else {
    $resp['errorMsg'] = "ERROR";
}
$resp['resp'] = $respuesta;
echo json_encode($resp);
?>