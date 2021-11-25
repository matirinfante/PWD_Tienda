<?php
include_once("../../config.php");
$session = new Session();
$controller = new RolController();

if (!$session->activa()) {
    header('location: login.php');
    exit();
}


include_once("../structure/header.php");

?>
<?php
include_once("../structure/menuLateral.php");
?>
<div class="container col-8 p-5">
    <div class="alert alert-success"><h3>¡Bienvenido nuevamente!</h3><h5>Puede navegar entre las opciones del menu
            Dashboard</h5></div>
    <h5 class="text-center">Se encuentra loggeado como:<span
                style="color: red;"> <?php $rol = $controller->buscar(['idrol' => $session->getRolActivo()]);
            echo $rol[0]->getRoldescripcion() ?> </span></h5>
</div>
</div>
</div>
<?php
include_once("../structure/footer.php");
?>
