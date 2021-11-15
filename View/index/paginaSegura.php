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

<div class="container p-5">
    LOGGED
</div>
<?php
include_once("../structure/footer.php");
?>
