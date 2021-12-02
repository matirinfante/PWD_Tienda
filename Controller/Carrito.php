<?php

class Carrito
{
    public function efectuarCompra($datos)
    {
        $controllerProducto = new ProductoController();
        $controllerCompra = new CompraController();
        $controllerEstado = new CompraEstadoController();
        $controllerItem = new CompraItemController();
        $session = new Session();


        $exito = true;
        $carrito = $session->getCarrito();


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
                    $controllerCompra->baja(["idcompra" => $nuevaCompra->getIdcompra()]);
                }
            }
        } else {
            $exito = false;
        }
        return $exito;
    }

    public function cancelarCompra($datos)
    {
        $resp = false;
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
            }
        }
        return $resp;
    }

    public function clienteCancela($datos)
    {
        $resp = false;
        if (isset($datos['idcompraestadotipo'])) {
            if ($datos['idcompraestadotipo'] == 1) {
                $resp = $this->cancelarCompra($datos);
            }
        }
        return $resp;
    }
}