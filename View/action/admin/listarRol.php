<?php
include_once("../../../config.php");

$data = data_submitted();
$controller = new RolController();
$resp = $controller->buscar($data);
$formatResp = array();

//Se necesita formatear la respuesta a un json

foreach ($resp as $rol) {
    $elem['idrol'] = $rol->getIdrol();
    $elem['roldescripcion'] = $rol->getRoldescripcion();
    array_push($formatResp, $elem);
}
echo json_encode($formatResp);
?>