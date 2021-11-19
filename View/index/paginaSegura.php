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
<div class="container col-8">
    <h2 class="text-center">LOGGED</h2>
</div>
</div>
</div>
<?php
include_once("../structure/footer.php");
?>
