<?php
include_once("../../../config.php");

$data = data_submitted();

if (isset($data['idusuario']) && isset($data['idrol'])) {
    $controller = new UsuarioRolController();
    $resp = $controller->baja($data);
} else {
    $respuesta['errorMsg'] = "ERROR DELETE";
}
$respuesta['respuesta'] = $resp;
echo json_encode($respuesta);
?>