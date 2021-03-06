<?php
$menuRolController = new MenuRolController();
$menuController = new MenuController();
$rolActivo = $session->getRolActivo();
$data = array('idrol' => $rolActivo);
$menu = $menuRolController->buscar($data);
?>

<div class="row">
    <div class="flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px;">
        <a href="../index/paginaSegura.php"
           class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <span class="fs-4">Dashboard</span>
        </a>
        <hr>
        <?php
        if (!empty($menu)) {
            foreach ($menu as $me) {
                $listaMenu = $menuController->buscar(["idpadre" => $me->getObjmenu()->getIdmenu(), "medeshabilitado" => "null"]);
                if (!empty($listaMenu)) {
                    ?>

                    <?php
                } else {
                    ?>
                    <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item p-2">
                        <a href="../index/<?php echo $me->getObjMenu()->getMedescripcion() ?>.php"
                           class="nav-link active"
                           aria-current="page">
                            <svg class="bi me-2" width="16" height="16">
                            </svg>
                            <?php echo $me->getObjMenu()->getMenombre() ?>
                        </a>
                    </li>
                    <?php
                }
                ?>
                </ul>


                <?php
            }
        }
        ?>
    </div>
