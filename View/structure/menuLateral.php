<?php
$menuRolController = new MenuRolController();
$menuController = new MenuController();
$rolActivo = $session->getRolActivo();
$data = array($rolActivo);
$menu = $menuRolController->buscar($data[0]);
if (!empty($menu)) {
    $listaMenu = $menuController->buscar(["idpadre" => $menu[0]->getObjmenu()]);
}
?>


<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px;">
    <a href="../index/paginaSegura.php"
       class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <span class="fs-4">Dashboard</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <?php
        foreach ($listaMenu as $submenu) {
            ?>
            <li class="nav-item p-2">
                <a href="../index/<?php echo $submenu->getMedescripcion() ?>" class="nav-link active"
                   aria-current="page">
                    <svg class="bi me-2" width="16" height="16">
                    </svg>
                    <?php echo $submenu->getMenombre() ?>
                </a>
            </li>
            <?php
        }
        ?>
    </ul>
</div>
</div>