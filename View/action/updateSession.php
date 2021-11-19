<?php
include_once("../../config.php");
$datos = data_submitted();
$session = new Session();
$session->setRolActivo($datos);
header('location:../index/paginaSegura.php');
exit();
?>