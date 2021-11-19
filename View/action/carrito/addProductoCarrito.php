<?php
include_once('../../../config.php');
$data = data_submitted();

$session = new Session();
if (!$session->activa()) {
    header('location: ../../index/login.php');
    exit();
}
$carrito = $session->getCarrito();
$controllerProducto = new ProductoController();
$exito = true;
$repetido = false;
if (isset($data['idproducto'])) {
    $resp = $controllerProducto->buscar(['idproducto' => $data['idproducto']]);
    if (empty($resp)) {
        $exito = false;
        $error = "Producto inválido";
    }
}


if (!isset($data['cantidad'])) {
    $cantidad = 1;
} else {
    $cantidad = $data['cantidad'];
}
if ($exito) {
    foreach ($carrito as &$producto) {
        if ($producto[0]['idproducto'] == $data['idproducto']) {
            $producto[0]['cantidad'] += $cantidad;
            $repetido = true;
        }
    }

    if (!$repetido) {
        $nuevoElemento = array(["idproducto" => $data['idproducto'], "cantidad" => $cantidad]);
        array_push($carrito, $nuevoElemento);
    }
    $session->setCarrito($carrito);
    $carrito = $session->getCarrito();

}
header('location: ../../index/shop.php');
exit();