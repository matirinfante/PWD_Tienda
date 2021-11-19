<?php
include_once("../../config.php");

$session = new Session();
if (!$session->activa()) {
    header('location: login.php');
    exit();
}

$datos = data_submitted();
$controller = new UsuarioController();

if (!empty($datos)) {
    $datos['usdeshabilitado'] = null;

    $datos['uspass'] = md5($datos['uspass']);
    $exito = $controller->modificacion($datos);

}

include_once "../structure/Header.php";
echo "<div class='container'>";

if ($exito) {
    echo "<div class='alert alert-success mt-5' role='alert'><h3>Usuario modificado con éxito!</h3></div>";
} else {
    echo "<div class='alert alert-danger mt-5' role='alert'><h3>Ha ocurrido un error. Intentelo nuevamente</h3></div>";
}

include_once "../structure/Footer.php";
?>