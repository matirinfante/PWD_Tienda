<?php
include_once("../../../config.php");

$data = data_submitted();
$controllerUR = new UsuarioRolController();
$listaUR = $controllerUR->buscar($data);
$returnList = array();

foreach ($listaUR as $usuarioRol) {
    $elem['idusuario'] = $usuarioRol->getObjUsuario()->getIdusuario();
    $controllerUsuario = new UsuarioController();
    $listaUsuario = $controllerUsuario->buscar(['idusuario' => $elem['idusuario']]);
    if (!empty($listaUsuario)) {
        $elem['usnombre'] = $listaUsuario[0]->getUsnombre();
    } else {
        $elem['usnombre'] = "";
    }
    $elem['idrol'] = $usuarioRol->getObjRol()->getIdrol();
    $controllerRol = new RolController();
    $listaRol = $controllerRol->buscar(['idrol' => $elem['idrol']]);
    if (!empty($listaRol)) {
        $elem['roldescripcion'] = $listaRol[0]->getRoldescripcion();
    } else {
        $elem['roldescripcion'] = "";
    }

    array_push($returnList, $elem);
}
echo json_encode($returnList);
?>