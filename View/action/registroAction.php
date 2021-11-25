<?php
include_once "../../config.php";

$session = new Session();
if ($session->activa()) {
    header('Location: paginaSegura.php');
    exit();
}

$datos = data_submitted();

$controllerUsuario = new UsuarioController();
$controllerUsuarioRol = new UsuarioRolController();
$usuario = array();
$exito = false;
if (!empty($datos)) {
    $datos['usdeshabilitado'] = null;
    $datos['uspass'] = md5($datos['uspass']);
    $datos['idusuario'] = "";

    if ($checkVacia = $controllerUsuario->vacia()) {
        if ($exito = $controllerUsuario->insertar($datos)) {
            unset($datos['idusuario']);
            $user = $controllerUsuario->buscar($datos);
            $data['idusuario'] = $user[0]->getIdUsuario();
            $data['idrol'] = 1;
            $controllerUsuarioRol->alta($data);
        }
    } else {
        if ($exito = $controllerUsuario->insertar($datos)) {
            unset($datos['idusuario']);
            $user = $controllerUsuario->buscar($datos);
            $data['idusuario'] = $user[0]->getIdUsuario();
            $data['idrol'] = 3;
            $controllerUsuarioRol->alta($data);
        }
    }

}


include_once("../structure/header.php");
echo "<div class='container'>";
if ($exito) {
    echo "<div class='alert alert-success mt-5' role='alert'><h3>Usuario creado con éxito! Inicie sesión</h3></div>";
} else {
    echo "<div class='alert alert-danger mt-5' role='alert'><h3>Ha ocurrido un error. Intentelo nuevamente</h3></div>";
}
echo "</div>";
include_once('../structure/footer.php');
?>