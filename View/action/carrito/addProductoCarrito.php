<?php
include_once('../../../config.php');
$data = data_submitted();

$session = new Session();
if (!$session->activa()) {
    header('location: ../../index/login.php');
    exit();
}
$carrito = $session->getCarrito();
$controller = new Carrito();
$controller->agregarCarrito($data, $carrito);

header('location: ../../index/shop.php');
exit();