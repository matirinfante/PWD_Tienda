<?php
include_once("../../../config.php");
$datos = data_submitted();

if (isset($datos['idproducto']) && isset($datos['pronombre']) && isset($datos['prodetalle']) && isset($datos['procantstock']) && isset($datos['proprecio']) && isset($datos['proeditorial']) && isset($datos['proautor']) && isset($datos['proimagen'])) {
    $controller = new ProductoController();
    $resp = $controller->modificacion($datos);
} else {
    $resp = false;
    $retorno['errorMsg'] = "No se pudo MODIFICAR el producto.";
}
$retorno['respuesta'] = $resp;
echo json_encode($retorno);
?>