<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>TorreDeD4Dos - Online shop</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico"/>
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css"/>
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet"
          type="text/css"/>
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../css/styles.css" rel="stylesheet"/>
    <!-- EasyUI-->
    <!-- Enlaces jQuery-Easyui -->
    <link rel="stylesheet" type="text/css" href="../../Util/EasyUI/themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="../../Util/EasyUI/themes/icon.css">
    <link rel="stylesheet" type="text/css" href="../../Util/EasyUI/themes/color.css">
    <script type="text/javascript" src="../../Util/EasyUI/jquery.min.js"></script>
    <script type="text/javascript" src="../../Util/EasyUI/jquery.easyui.min.js"></script>
    <script type="text/javascript" src="https://www.jeasyui.com/easyui/datagrid-detailview.js"></script>
</head>
<body id="page-top" class="d-flex flex-column min-vh-100">
<!-- Navigation-->
<nav class="navbar navbar-expand-lg bg-secondary text-uppercase" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="../index/index.php">TORRE<span style="color:black">DE</span><span
                    style="color:darkorange">D4</span>DOS</a>
        <button class="navbar-toggler text-uppercase font-weight-bold bg-primary text-white rounded" type="button"
                data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive"
                aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded"
                                                     href="../index/nosotros.php">Nosotros</a>
                </li>
                <?php
                if ($session->activa()) {
                    if ($session->getRolActivo() == "3") {
                        echo "<li class='nav-item mx-0 mx-lg-1'><a class='nav-link py-3 px-0 px-lg-3 rounded'
                                                     href='../index/carritoCompras.php'><i class='fas fa-shopping-cart'></i></a></li>";
                    }
                    $user = $session->getUsuario();
                    $username = $user->getusnombre();
                    echo "<li class='nav-item mx-0 mx-lg-1'><a class='nav-link py-3 px-0 px-lg-3 rounded'
                                                     href='../index/paginaSegura.php'>${username}</a></li>";
                    ?>


                    <div class="dropdown mt-2 p-2">
                        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                           data-bs-toggle="dropdown" aria-expanded="false">
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <?php
                            $roles = $session->getRol();
                            foreach ($roles as $rol) {
                                $desc_rol = $rol->getRoldescripcion();
                                echo "<li><a class='dropdown-item' href='../action/updateSession.php?idrol=" . $rol->getIdrol() . "'>" . $desc_rol . "</a></li>";
                            }
                            ?>


                        </ul>
                    </div>


                    <!-- ICONO CERRAR SESION -->
                    <li class='nav-item mx-0 mx-lg-1'><a class='nav-link py-3 px-0 px-lg-3 rounded'
                                                         href='../action/cerrarSesion.php'><i
                                    class="fas fa-sign-out-alt"></i></a></li>
                    <?php
                } else {
                    echo '<li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded"
                                                     href="../index/login.php">Ingresar</a></li>';
                    echo '<li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded"
                                                     href="../index/registro.php">Registrarse</a></li>';
                }
                ?>

            </ul>
        </div>
    </div>
</nav>
