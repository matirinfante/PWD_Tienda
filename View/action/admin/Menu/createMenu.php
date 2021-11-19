<?php
include_once("../../../../config.php");

$data = data_submitted();

if (isset($data['menombre'])) {

    if (!isset($data['idpadre']) || $data['idpadre'] == 0) {
        $data['idpadre'] = null;
    }
    $controller = new MenuController();
    $resp = $controller->alta($data);

} else {
    $respuesta['errorMsg'] = "ERROR ALTA";
}
$respuesta['respuesta'] = $resp;
echo json_encode($respuesta);
?>