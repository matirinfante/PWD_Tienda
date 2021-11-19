<?php
include_once("../../../config.php");
$data = data_submitted();

if (isset($data['idusuario']) && isset($data['usnombre']) && isset($data['uspass']) && isset($data['usmail']) && isset($data['usdeshabilitado'])) {
    if ($data['usdeshabilitado'] == "0000-00-00 00:00:00") {
        $data['usdeshabilitado'] = date("Y-m-d H:i:s");
    } else {
        $data['usdeshabilitado'] = "0000-00-00 00:00:00";
    }
    $controller = new UsuarioController();
    $resp = $controller->modificacion($data);
} else {
    $respuesta['errorMsg'] = "ERROR DELETE";
}

$respuesta['respuesta'] = $resp;
echo json_encode($respuesta);

?>