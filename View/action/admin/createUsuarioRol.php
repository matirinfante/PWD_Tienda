<?php
include_once("../../../config.php");
$data = data_submitted();

if (isset($data['idusuario']) && isset($data['idrol'])) {
    $controller = new UsuarioRolController();
    $resp = $controller->alta($data);
} else {
    $respuesta['errorMsg'] = "No se pudo dar de ALTA el usuarioRol.";
}
$respuesta['respuesta'] = $resp;
echo json_encode($respuesta);

?>