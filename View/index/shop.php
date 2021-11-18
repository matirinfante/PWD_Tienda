<?php
include_once("../../config.php");

$sesion = new Session();
if (!$sesion->activa()) {
    header('location: login.php');
    exit();
}

$controller = new ProductoController();
$productos = $controller->buscar($datos);


#include_once "../structure/header.php";
?>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/otro.css">


<div class="row px-5 pt-5">
    <?php
        foreach ($productos as $producto) {
            echo "
            <div class='col-md-3 mt-3 mt-sm-0 card-container'>
                <div class='card text-center product p-3 pt-5 border-0 h-100 rounded-0'>
                    <a href='mostrarProducto.php?idproducto=".$producto->getIdproducto()."'><img class='img-fluid d-block mx-auto' src='../images/".$producto->getProimagen().".jpg' alt='".$producto->getPronombre()."'>
                    <div class='card-body p-3 py-0 h-xs-440p'>
                        <h5 class='card-title font-weight-semi-bold mb-3 w-xl-220p mx-auto'>".$producto->getPronombre()."</h5></a>
                        <p class='price'>$ ".$producto->getProprecio()."</p>
                    </div>";
                    if ($producto->getProCantstock() > 0){
                        echo "<p class='btn w-100 px-3 mx-auto'>
                            <a href='#' class='btn btn-danger btn-lg w-100'>Comprar</a>
                        </p>";
                    }else{
                        echo "<p class='btn w-100 px-3 mx-auto'>
                        <a href='#' class='btn btn-warning btn-lg w-100'>Sin Stock</a>
                        </p>";
                    }
                echo "</div></div>";
          }
    ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  

<?php
#include_once "../structure/footer.php";
?>