<?php
include_once("../../config.php");
$session = new Session();
$controller = new RolController();
var_dump($_SESSION);
if (!$session->activa()) {
    header('location: login.php');
    exit();
}
include_once("../structure/header.php");

?>

<div class="container p-5">
    LOGGED
</div>
<?php
include_once("../structure/footer.php");
?>
