<?php
include_once("../../config.php");
$datos = data_submitted();
$session = new Session();
if ($session->iniciar($datos['usnombre'], $datos['uspass'])) {
    header('location:../index/paginaSegura.php');
    exit();
} else {
    header('location:../index/login.php');
    exit();
}
?>