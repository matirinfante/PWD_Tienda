<?php
include_once("../../../config.php");

$data = data_submitted();

$controllerCompra = new CompraController();
$controllerUsuario = new UsuarioController();

$listaCompras = $controllerCompra->buscar(null);

$formatResp = array();

//Se necesita formatear la respuesta a un json

foreach ($listaCompras as $compra) {

    //Busco al usuario (arr)
    $usuarioCompra = $compra->getObjusuario();


    $elemento['idcompra'] = $compra->getIdcompra();
    $elemento['cofecha'] = $compra->getCofecha();
    $elemento['usnombre'] = $usuarioCompra->getUsnombre();

    array_push($formatResp, $elemento);
}
echo json_encode($formatResp);