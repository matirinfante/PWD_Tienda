<?php
include_once('../../../config.php');
$data = data_submitted();

$session = new Session();
if (!$session->activa()) {
    header('location: ../../index/login.php');
    exit();
}
$controllerProducto = new ProductoController();
$carrito = $session->getCarrito();
$exito = true;
$i = 0;
if (isset($data['idproducto']) && !empty($carrito)) {
    foreach ($carrito as $producto) {
        if ($producto[0]['idproducto'] == $data['idproducto']) {
            unset($carrito[$i]);
            $carrito = array_values($carrito);
        }
        $i++;
    }
    var_dump($carrito);
    $session->setCarrito($carrito);
}
header('location: ../../index/carritoCompras.php');
exit();