<?php
include_once("../../config.php");
$data = data_submitted();
$session = new Session();
include_once("../structure/header.php");
?>

    <div class="container text-center p-2 mt-2">
        <div class="row">
            <h3 class="mb-5">NOSOTROS</h3>

            <!-- INTRO INFORMATIO-->
            <div class="col-lg-8 m-1 bg-warning bg-opacity-25 rounded p-1">
                <div class="p-4">
                    <p>El 2020 fue año diferente para todos, con más o menos matices todos pasamos mucho tiempo dentro
                        de
                        casa y redujimos nuestro contacto con otras personas. Nosotros extrañamos un montón pero hubo
                        algo
                        que nos ayudó a pasar mucho mejor el momento: <b> Los juegos de mesa!</b></p>
                    <br>
                    <p>A veces jugando en casa entre nosotros dos, otras online con plataformas o siendo creativos en
                        una
                        video llamada para aprovechar los juegos,
                        pero siempre usando este recurso para generar un mejor momento. La vuelta a vernos
                        presencialmente
                        también fue acompañada por momentos
                        lúdicos que hicieron más fáciles y divertidos los reencuentros. De esta experiencia y de esta
                        pasión
                        re-descubierta por los juegos de mesa
                        es que surge la idea de "Torre de dados", con el único objetivo de contagiar todo lo bueno que
                        nos
                        generaron los juegos de mesa
                        con todo el mundo. </p>
                </div>
            </div>
            <div class="col-lg-3 m-auto p-1 border rounded">
                <img src="../images/nosotros.jpg" width="100%">
            </div>
        </div>
    </div>
<?php
include_once('../structure/footer.php');
?>