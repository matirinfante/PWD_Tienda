<?php
include_once("../../../config.php");
$data = data_submitted();

if (isset($data['idusuario']) && isset($data['usnombre']) && isset($data['uspass']) && isset($data['usmail'])) {
    $controller = new UsuarioController();
    $resp = $controller->modificacion($data);
} else {
    $resp = false;
    $respuesta['errorMsg'] = "ERROR MODIFICAR";
}
$respuesta['respuesta'] = $resp;
echo json_encode($respuesta);
?>