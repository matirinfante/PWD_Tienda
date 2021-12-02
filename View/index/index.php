<?php
include_once("../../config.php");
$data = data_submitted();
$session = new Session();
include_once("../structure/header.php");
?>
<section class="padre"
         style="background-image: url('../images/catanjuegomesa.webp'); background-size: cover;background-repeat: no-repeat;">
    <div id="index" class="container text-center">
        <br>
        <div class="row position-relative m-5">
            <div class="p-1">
                <h1 style="font-family: 'Oswald', sans-serif;font-size: 70px; font-weight: 700; color: black">Torre de
                    <span
                            style="color: darkorange">D4</span>dos</h1>
                <br>
                <br>
                <h3 class="mt-5"
                    style="font-family: 'EB Garamond', serif; font-style: oblique; font-size: 30px; font-weight: 300; color: black">
                    Todo lo que necesitas para tu ludoteca.</h3>
                <h3 class="mt-5"
                    style="font-family: 'EB Garamond', serif; font-style: oblique; font-size: 30px; font-weight: 300; color: black">
                    Juegos de mesa y rol</h3>
                <br>
                <br>
                <br>
            </div>
        </div>
    </div>

</section>
<?php
include_once('../structure/footer.php');
?>
