<?php
include_once("../../../config.php");
$sesion = new Session();
if (!$sesion->activa()) {
    header('location: login.php');
    exit();
}

$datos = data_submitted();

$controller = new ProductoController();
$response = $controller->agregarProducto($datos);

echo json_encode($response);

