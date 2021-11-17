<?php 
include_once("../../config.php");

$datos = data_submitted();

$page = isset($_POST['page']) ? intval($_POST['page']) : 1; 
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10; 

$controller = new ProductoController();
$productos = $controller->buscar($datos);

$response["total"] = count($productos); 

$formatResp = array();

//Se necesita formatear la respuesta a un json

foreach ($productos as $producto) {
    $nuevoElem['idproducto'] = $producto->getIdproducto();
    $nuevoElem['pronombre'] = $producto->getPronombre();
    $nuevoElem['prodetalle'] = $producto->getProdetalle();
    $nuevoElem['procantstock'] = $producto->getProCantstock();
    $nuevoElem['proprecio'] = $producto->getProprecio();
    $nuevoElem['proeditorial'] = $producto->getProeditorial();
    $nuevoElem['proautor'] = $producto->getProautor();
    $nuevoElem['proimagen'] = $producto->getProimagen();

    array_push($formatResp, $nuevoElem);
}

$response["rows"] = $formatResp;
 
echo json_encode($response);
