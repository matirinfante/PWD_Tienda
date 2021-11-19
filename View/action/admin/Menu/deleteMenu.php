<?php
include_once("../../../../config.php");
$data = data_submitted();

if (isset($data['idmenu']) && isset($data['menombre']) && isset($data['medescripcion']) && isset($data['idpadre']) && isset($data['medeshabilitado'])) {
    if ($data['medeshabilitado'] == "0000-00-00 00:00:00") {
        $data['medeshabilitado'] = date("Y-m-d H:i:s");
    } else {
        $data['medeshabilitado'] = "0000-00-00 00:00:00";
    }
    $controller = new MenuController();
    $resp = $controller->modificacion($data);
} else {
    $respuesta['errorMsg'] = "ERROR DELETE";
}

$respuesta['respuesta'] = $resp;
echo json_encode($respuesta);

?>