<?php
include_once("../../config.php");
$session = new Session();
$controller = new RolController();

if (!$session->activa()) {
    header('location: login.php');
    exit();
}

var_dump($session->getRolActivo());


include_once("../structure/header.php");



?>
<div class="container-fluid p-5">
    <div class="row">
        <?php
        include_once("../structure/menuLateral.php");
        ?>
        <div class="container">
            <h2 class="text-center">LOGGED</h2>
        </div>
    </div>
</div>
<?php
include_once("../structure/footer.php");
?>
