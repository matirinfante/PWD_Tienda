<?php 
include_once("../../config.php");
$sesion = new Session();
if (!$sesion->activa()) {
    header('location: login.php');
    exit();
}
#include_once("../structure/header.php");

$datos = data_submitted();

$controller = new ProductoController();
$datos['idproducto'] = null;
$datos['proimagen'] = '19660c40c3239e4d65d8e5a9d03b6f19';
$result = $controller->alta($datos);
if($result){ 
    $response['status'] = 1; 
    $response['msg'] = 'User data has been updated successfully!'; 
}
 
echo json_encode($response); 
