<?php 
include_once("../../config.php");


$datos = data_submitted();

$controller = new ProductoController();
$response['respuesta'] = $controller->baja($datos);
 
echo json_encode($response); 