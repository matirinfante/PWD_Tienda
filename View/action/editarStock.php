<?php 
include_once("../../config.php");


$datos = data_submitted();

$controller = new ProductoController();
$response['respuesta'] = $controller->modificacion($datos);
 
echo json_encode($response); 