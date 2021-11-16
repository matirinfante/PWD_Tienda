<?php 
include_once("../../config.php");

$controller = new ProductoController();

$productos = $controller->buscar(null);

$response["total"] = count($productos); 


$productos = array(); 
while($row = $result->fetch_assoc()){ 
    array_push($users, $row); 
} 
$response["rows"] = $users; 



var_dump($productos);

var_dump("<br>");

/*** 
echo json_encode($productos);
*/