<?php
include_once('../../../config.php');
$data = data_submitted();

$session = new Session();
if (!$session->activa()) {
    header('location: ../../index/login.php');
    exit();
}

$controller = new Carrito();

$exito = $controller->efectuarCompra($data);


header("location: ../../index/carritoCompras.php?codexitocompra={$exito}");
exit();


?>
