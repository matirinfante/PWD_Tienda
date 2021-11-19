<?php
include_once("../../../config.php");
$data = data_submitted();

if (isset($data['idrol'])) {
    $controllerMR = new MenuRolController();
    $respMR = $controllerMR->buscar(['idrol' => $data['idrol']]);

    if (!empty($respMR)) {
        foreach ($respMR as $menuRol) {
            $menuRol->eliminar();
        }
    }

    $controllerUR = new UsuarioRolController();
    $respUR = $controllerUR->buscar(['idrol' => $data['idrol']]);

    if (!empty($respUR)) {
        foreach ($respUR as $usuarioRol) {
            $usuarioRol->eliminar();
        }
    }
    $controllerRol = new RolController();
    $resp = $controllerRol->baja($data);
} else {
    $respuesta['errorMsg'] = "ERROR ELIMINAR.";
}
$respuesta['respuesta'] = $resp;
echo json_encode($respuesta);
?>