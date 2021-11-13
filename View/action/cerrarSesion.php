<?php
include_once("../../config.php");
$sesion = new Session();
$sesion->cerrar();
header('Location:../../index.php');
?>