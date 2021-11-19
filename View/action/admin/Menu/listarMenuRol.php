<?php
include_once("../../../../config.php");
$data = data_submitted();
$objControl = new MenuRolController();
$list = $objControl->buscar($data);

$arreglo_salida = array();
foreach ($list as $elem) {
    $nuevoElem['idmenu'] = $elem->getObjMenu()->getIdmenu();
    $abmMe = new MenuController();
    $arrMe = $abmMe->buscar(['idmenu' => $elem->getObjMenu()->getIdmenu()]);
    if (!empty($arrMe)) {
        $nuevoElem['menombre'] = $arrMe[0]->getMenombre();
    } else {
        $nuevoElem['menombre'] = "";
    }
    $nuevoElem['idrol'] = $elem->getObjRol()->getIdrol();
    $abmRol = new RolController();
    $arrRol = $abmRol->buscar(['idrol' => $elem->getObjRol()->getIdrol()]);
    if (!empty($arrRol)) {
        $nuevoElem['roldescripcion'] = $arrRol[0]->getRoldescripcion();
    } else {
        $nuevoElem['roldescripcion'] = "";
    }

    array_push($arreglo_salida, $nuevoElem);
}
echo json_encode($arreglo_salida);
?>