<?php 
include_once("../../config.php");


$datos = data_submitted();

$resp=false;
if (isset($datos['idproducto']) ){
    $controller = new ProductoController();
    $resp = $controller->baja($datos);
    
}

if (!$resp){
    $retorno['errorMsg']="No se pudo cambiar el estado.";
}
$retorno['respuesta']=$resp;
echo json_encode($retorno);

?>