<?php
include_once("../../../config.php");
$datos = data_submitted();

$retorno = array();

if (isset($datos['idcompraestado']) && isset($datos['idcompra']) && isset($datos['idcompraestadotipo']) && isset($datos['cefechaini']) && isset($datos['cefechafin'])) {
    if ($datos['idcompraestadotipo'] <> 4) {
        $controller = new CompraEstadoController();
        $controllerCompraItem = new CompraItemController();
        $controllerProducto = new ProductoController();
        $datos['idcompraestadotipo'] = 4;
        $datos['cefechafin'] = date("Y-m-d H:i:s");
        $resp = $controller->modificacion($datos);
        if ($resp) {
            $listaRestaurar = $controllerCompraItem->buscar(["idcompra" => $datos['idcompra']]);
            if (!empty($listaRestaurar)) {
                foreach ($listaRestaurar as $prodRestaurar) {
                    $producto = $controllerProducto->buscar(["idproducto" => $prodRestaurar->getObjproducto()->getIdproducto()]);
                    $controllerProducto->actualizarStock(['idproducto' => $prodRestaurar->getObjproducto()->getIdproducto(), 'procantstock' => $producto[0]->getProcantstock() + $prodRestaurar->getCicantidad()]);
                }
            }
        }
        $retorno['errorMsg'] = $datos['idcompraestado'];
    } else {
        $resp = false;
        $retorno['errorMsg'] = "Compra actualmente CANCELADA";
    }
} else {
    $resp = false;
    $retorno['errorMsg'] = "No se pudo MODIFICAR el estado.";
}
$retorno = $resp;
echo json_encode($retorno);
