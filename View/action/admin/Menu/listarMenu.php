<?php
include_once("../../../../config.php");

$data = data_submitted();
$controller = new MenuController();
$resp = $controller->buscar($data);
$formatResp = array();

foreach ($resp as $menu) {
    $elem['idmenu'] = $menu->getIdmenu();
    $elem['menombre'] = $menu->getMenombre();
    $elem['medescripcion'] = $menu->getMedescripcion();

    if ($menu->getObjMenu() != null) {
        $elem['idpadre'] = $menu->getObjMenu()->getIdmenu();
    } else {
        $elem['idpadre'] = null;
    }
    $elem['medeshabilitado'] = $menu->getMedeshabilitado();
    array_push($formatResp, $elem);
}
echo json_encode($formatResp);
?>