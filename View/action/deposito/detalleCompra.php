<?php
include_once("../../../config.php");

$data = data_submitted();

$controllerCompraItem = new CompraItemController();
$controllerProducto = new ProductoController();

$listaProductos = $controllerCompraItem->buscar(['idcompra' => $data['idcompra']]);
$formatResp = array();

if (!empty($listaProductos)) {
    foreach ($listaProductos as $producto) {

        $detalleProducto = $controllerProducto->buscar(['idproducto' => $producto->getObjproducto()->getIdproducto()]);

        $elemento['idproducto'] = $producto->getObjproducto()->getIdproducto();
        $elemento['pronombre'] = $detalleProducto[0]->getPronombre();
        $elemento['proprecio'] = $detalleProducto[0]->getProprecio();
        $elemento['cantidad'] = $producto->getCicantidad();

        array_push($formatResp, $elemento);
    }
}
echo json_encode($formatResp);

