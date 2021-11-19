<?php
include_once("../../../config.php");

$data = data_submitted();

$controllerCompra = new CompraController();
$controllerEstado = new CompraEstadoController();
$controllerTipo = new CompraEstadoTipoController();
$controllerUsuario = new UsuarioController();

//Busco la desc del tipo de estado vinculado
$listaEstados = $controllerTipo->buscar(null);
$encontrado = false;
$i = 0;
while (!$encontrado && $i < count($listaEstados)) {
    if ($listaEstados[$i]->getIdcompraestadotipo() == $data['idcompraestadotipo']) {
        $encontrado = true;
        $tipoEstado = $listaEstados[$i];
    } else {
        $i++;
    }
}

//Busco todas las compras registradas para el estado
$compraEstados = $controllerEstado->buscar(null);


$formatResp = array();


//Se necesita formatear la respuesta a un json

foreach ($compraEstados as $compra) {

    //Busco la compra (arr)
    $compraDetalle = $controllerCompra->buscar(["idcompra" => $compra->getObjcompra()->getIdcompra()]);
    //Busco al usuario (arr)
    $usuarioCompra = $compraDetalle[0]->getObjusuario();

    $elemento['idcompraestado'] = $compra->getIdcompraestado();
    $elemento['idcompra'] = $compra->getObjcompra()->getIdcompra();
    $elemento['cetdescripcion'] = $tipoEstado->getCetdescripcion();
    $elemento['cefechaini'] = $compra->getCefechaini();
    $elemento['cefechafin'] = $compra->getCefechafin();
    $elemento['usnombre'] = $usuarioCompra->getUsnombre();

    array_push($formatResp, $elemento);
}
echo json_encode($formatResp);