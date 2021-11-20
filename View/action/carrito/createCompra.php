<?php
include_once('../../../config.php');
$data = data_submitted();

$session = new Session();
if (!$session->activa()) {
    header('location: ../../index/login.php');
    exit();
}
$exito = true;
$carrito = $session->getCarrito();
$controllerProducto = new ProductoController();
$controllerCompra = new CompraController();
$controllerEstado = new CompraEstadoController();
$controllerItem = new CompraItemController();

$timestamp = date("Y-m-d H:i:s");

if (!empty($carrito)) {

    $exito = $controllerCompra->alta(["idusuario" => $session->getUsuario()->getIdusuario(), "cofecha" => $timestamp]);

    if ($exito) {

        //Debo buscar la compra recientemente creada
        $resp = $controllerCompra->buscar(["idusuario" => $session->getUsuario()->getIdusuario(), "cofecha" => $timestamp]);
        $nuevaCompra = $resp[0];

        //Se chequean los stock sin modificar ni crear registros
        foreach ($carrito as $itemVerificar) {
            $resp = $controllerProducto->buscar(['idproducto' => $itemVerificar[0]['idproducto']]);
            if (empty($resp)) {
                $exito = false;
            } else {
                //Se chequea el stock vs la cantidad que se quiere comprar
                if ($itemVerificar[0]['cantidad'] > $resp[0]->getProcantstock()) {
                    //Se registra en la base de datos
                    $exito = false;
                }
            }
        }
        if ($exito) {
            //Se crean los item segun los elementos del carrito
            foreach ($carrito as $itemCarrito) {
                $resp = $controllerProducto->buscar(['idproducto' => $itemCarrito[0]['idproducto']]);
                //Se registra en la base de datos
                $exito = $controllerItem->alta(["idproducto" => $resp[0]->getIdproducto(), "idcompra" => $nuevaCompra->getIdcompra(), "cicantidad" => $itemCarrito[0]['cantidad']]);
                //Se actualiza el stock del producto
                if ($exito) {
                    $exito = $controllerProducto->actualizarStock(["idproducto" => $resp[0]->getIdproducto(), "procantstock" => $resp[0]->getProcantstock() - $itemCarrito[0]['cantidad']]);
                }
            }

            if ($exito) {
                //Se registra el estado inicial para la compra. Default: 1
                $exito = $controllerEstado->alta(["idcompra" => $nuevaCompra->getIdcompra(), "idcompraestadotipo" => 1, "cefechaini" => $timestamp, "cefechafin" => null]);
                //var_dump($exito);
                if ($exito) {
                    //Finalizó el registro de todos los datos necesarios, se elimina el carrito.
                    $session->eliminarCarrito();
                }
            }

        } else {
            $nuevaCompra->baja();
        }
    }
} else {
    $exito = false;
}
header("location: ../../index/carritoCompras.php?codexitocompra={$exito}");
exit();


?>
