<?php
include_once("../../config.php");
$datos=data_submitted();

if (isset($datos['idproducto']) && isset($datos['pronombre']) && isset($datos['prodetalle']) && isset($datos['procantstock']) && isset($datos['proprecio']) && isset($datos['proeditorial']) && isset($datos['proautor'])  ){
    $controller=new ProductoController(); 
    $datos['proimagen'] = '19660c40c3239e4d65d8e5a9d03b6f19';
    $resp=$controller->modificacion($datos);
}else{
    $resp=false;
    $retorno['errorMsg']="No se pudo MODIFICAR el producto.";
}
$retorno['respuesta']=$resp;
echo json_encode($retorno);
?>