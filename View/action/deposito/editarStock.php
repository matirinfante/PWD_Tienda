<?php
include_once("../../../config.php");
$datos = data_submitted();

if (isset($datos['idproducto']) && isset($datos['procantstock'])) {
    $controller = new ProductoController();

    $resp = $controller->modificacion($datos);
} else {
    $resp = false;
    $retorno['errorMsg'] = "No se pudo MODIFICAR el producto.";
}
$retorno['respuesta'] = $resp;
echo json_encode($retorno);
?>