<?php
include_once("../../config.php");
$datos=data_submitted();
$controller = new ProductoController();
$datos['proimagen'] = md5("test");
$retorno=$controller->cargarImagen($datos);
echo json_encode($retorno);
?>