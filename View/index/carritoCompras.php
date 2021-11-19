<?php
include_once("../../config.php");
$session = new Session();
$controller = new RolController();
if (!$session->activa()) {
    header('location: login.php');
    exit();
}
$controller = new ProductoController();
$carrito = $session->getCarrito();
include_once('../structure/header.php');
?>

<div class="container mt-5">
    <h2>Mi carrito de compras</h2>
    <?php
    if ($carrito == null) {
        echo '<div class="alert alert-info p-3"><h4> Es momento de realizar una compra! </h4></div>';
    } else {
        ?>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col" class="text-center" hidden>Id Producto</th>
                <th scope="col" class="text-center">Producto</th>
                <th scope="col" class="text-center">Precio ($)</th>
                <th scope="col" class="text-center">Cantidad</th>
                <th scope="col" class="text-center">Eliminar</th>
            </tr>
            </thead>
            <?php
            foreach ($carrito as $productoCarrito) {
                $objProducto = $controller->buscar(['idproducto' => $productoCarrito[0]['idproducto']]);
                echo '<tr><td class="text-center" style="width:200px;" hidden>' . $objProducto[0]->getIdproducto() . '</td>';
                echo '<td class="text-center" style="width:200px;">' . $objProducto[0]->getPronombre() . '</td>';
                echo '<td class="text-center" style="width:200px;">' . $objProducto[0]->getProprecio() . '</td>';
                echo '<td class="text-center" style="width:200px;">' . $productoCarrito[0]['cantidad'] . '</td>';
                '</tr>';
                echo "<form action='../action/carrito/deleteProductoCarrito.php' method='get'>
            <td class='text-center'>
                <input name='idproducto' id='idproducto' type='hidden' value='{$productoCarrito[0]['idproducto']}'>
                <button class=' btn btn-dark' type='submit'>
                    <i class='fas fa-trash-alt'></i></i></button>
            </td>
        </form>
        </tr>";
            }
            ?>
        </table>
        <div class="d-flex justify-items-right">
            <form action="../action/createCompra.php" method="post">
                <button class="btn btn-dark" type="submit" value='<?php $carrito ?>'>Finalizar compra</button>
            </form>
        </div>
        <?php
    }

    ?>

</div>

<?php
include_once('../structure/footer.php');
?>
