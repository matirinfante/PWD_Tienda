<?php
include_once("../../../config.php");
$datos = data_submitted();
$controller = new ProductoController();
$retorno = $controller->cargarImagen($datos);
echo json_encode($retorno);
?>