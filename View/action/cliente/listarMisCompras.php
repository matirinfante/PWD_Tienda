<?php
include_once("../../../config.php");

$data = data_submitted();

$controllerCompra = new CompraController();
$controllerEstado = new CompraEstadoController();
$controllerTipo = new CompraEstadoTipoController();
$controllerUsuario = new UsuarioController();


//Busco todas las compras registradas para el estado
$listaCompras = $controllerCompra->buscar(["idusuario" => $data['idusuario']]);

$formatResp = array();


//Se necesita formatear la respuesta a un json

foreach ($listaCompras as $compra) {

    //Busco la compra (arr)
    $compraEstado = $controllerEstado->buscar(["idcompra" => $compra->getIdcompra()]);
    //Busco al usuario (arr)
    $usuarioCompra = $compra->getObjusuario();

    $elemento['idcompraestado'] = $compraEstado[0]->getIdcompraestado();
    $elemento['idcompra'] = $compra->getIdcompra();
    $elemento['idcompraestadotipo'] = $compraEstado[0]->getObjcompraestadotipo()->getIdcompraestadotipo();
    $elemento['cetdescripcion'] = $compraEstado[0]->getObjCompraestadotipo()->getCetdescripcion();
    $elemento['cefechaini'] = $compraEstado[0]->getCefechaini();
    $elemento['cefechafin'] = $compraEstado[0]->getCefechafin();
    $elemento['usnombre'] = $usuarioCompra->getUsnombre();

    array_push($formatResp, $elemento);
}
echo json_encode($formatResp);