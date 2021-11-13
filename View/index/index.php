<?php
include_once("../../config.php");
$data = data_submitted();
$session = new Session();
//var_dump($_SESSION);
include_once("../structure/header.php");
?>
<div class="container-fluid">
    <div class="row">
        <h1 class="text-center">Bienvenido</h1>
    </div>
</div>
<?php
include_once('../structure/footer.php');
?>
