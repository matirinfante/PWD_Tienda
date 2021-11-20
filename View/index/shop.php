<?php
include_once("../../config.php");

$session = new Session();
if (!$session->activa()) {
    header('location: login.php');
    exit();
}

$controller = new ProductoController();
$carrito = $session->getCarrito();
$productos = $controller->buscar(null);


include_once "../structure/header.php";
?>
    <div class="row px-5 pt-5">
        <?php
        foreach ($productos as $producto) {
            echo "
            <div class='col-md-3 mt-3 mt-sm-0 card-container'>
                <div class='card text-center p-3 pt-5 border-0 h-50 rounded-0'>
                    <a href='mostrarProducto.php?idproducto=" . $producto->getIdproducto() . "'><img class='img-fluid' src='../images/" . $producto->getProimagen() . ".jpg' alt='" . $producto->getPronombre() . "'>
                    <div class='card-body p-3 py-0'>
                        <h5 class='card-title font-weight-semi-bold mb-3 mx-auto'>" . $producto->getPronombre() . "</h5></a>
                        <p class='price'>$ " . $producto->getProprecio() . "</p>
                    </div>";
            if ($producto->getProCantstock() > 0) {
                echo "<p class='btn w-100 px-3 mx-auto'>
                            <a href='mostrarProducto.php?idproducto=" . $producto->getIdproducto() . "' class='btn btn-danger btn-lg w-100'>Ver detalle</a>
                        </p>";
            } else {
                echo "<p class='btn w-100 px-3 mx-auto'>
                        <a href='#' class='btn btn-warning btn-lg w-100'>Sin Stock</a>
                        </p>";
            }
            echo "</div></div>";
        }
        ?>
    </div>

<?php
include_once "../structure/footer.php";
?>