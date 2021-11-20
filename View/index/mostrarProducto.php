<?php
include_once("../../config.php");

$session = new Session();
if (!$session->activa()) {
    header('location: login.php');
    exit();
}

$datos = data_submitted();

$controller = new ProductoController();
$producto = $controller->buscar($datos);
#var_dump($producto);

include_once "../structure/header.php";
?>


    <div class="container">
        <div class="row">

            <div class="col-sm-12 col-md-12 col-lg-6 mb-4 p-3">

                <div class="">
                    <div class="main-product-image space">
                        <div id="product-carousel" class="carousel slide">
                            <div class="carousel-inner" role="listbox">
                                <div class="carousel-item active">
                                    <img src="<?php echo '../images/' . $producto[0]->getProimagen() . ".jpg"; ?>"
                                         alt="" class="w-100">
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


            </div>


            <div class="col-sm-12 col-md-12 col-lg-6 mt-5">
                <div class="col-sm-12 card p-3 mb-3">
                    <h1 class="product-name"><?php echo $producto[0]->getPronombre(); ?></h1>
                    <form class="form-horizontal" action="../action/carrito/addProductoCarrito.php" method="post"
                          enctype="multipart/form-data" name="buy">
                        <div>

                            <!-- Product Price  -->
                            <div class="form-group row">
                                <div class="col-12">
                                    <span class="precio"
                                          id="precio"><?php echo "$" . $producto[0]->getProprecio(); ?></span>
                                </div>
                            </div>


                            <div id="editorial" class="form-group row" style="visibility:visible;">
                                <label class="col-12 form-control-label ">Editorial: </label>
                                <div class="col-12">
                                    <span class="sku_elem"><?php echo $producto[0]->getProeditorial(); ?></span>
                                </div>
                            </div>


                            <div id="autor" class="form-group row sku" style="visibility:visible;">
                                <label class="col-12 form-control-label nopaddingtop">Autor: </label>
                                <div class="col-12">
                                    <span class="sku_elem"><?php echo $producto[0]->getProautor(); ?></span>
                                </div>
                            </div>


                            <div id="stock" class="form-group row">
                                <div class="col-12">
                                    <label class="form-control-label">Disponibilidad:</label>
                                    <span class="product-form-stock"><?php echo $producto[0]->getProCantstock(); ?></span>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-12 form-control-label">Descripción:</label>
                                <div class="col-12 description">
                                    <p data-children-count="0"><?php echo $producto[0]->getProdetalle(); ?><br></p>
                                </div>
                            </div>
                            <div>
                                <input name="idproducto" value="<?php echo $producto[0]->getIdproducto(); ?>" hidden>
                            </div>
                            <!-- Available -->
                            <div class="row d-inline align-items-center">

                                <?php
                                if ($producto[0]->getProCantstock() > 0) {
                                    ?>
                                    <div class="form-group col-4 col-sm-3 p-2">
                                        <label for="Quantity" class="col-12 form-control-label">Cantidad:</label>
                                        <div class="col-12 product-form-qty">
                                            <div class="quantity">
                                                <input type="number" inputmode="numeric" pattern="[0-9]*"
                                                       class="qty form-control qty-input" id="cantidad"
                                                       name="cantidad" maxlength="7" min="1" value="1"
                                                       max="<?php echo $producto[0]->getProCantstock(); ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group product-stock col-12 col-sm-9 p-2">
                                        <input type="submit" class="adc btn btn-danger" value="Agregar al Carro">
                                        <a href="shop.php" class="btn btn-outline-dark" title="Continúa Comprando"><i
                                                    class="mdi mdi-arrow-left"></i> Continúa Comprando</a>
                                    </div>
                                    <?php
                                } else {
                                    ?>
                                    <div class="form-group product-stock col-4 col-sm-3 no-padding">
                                        <label for="Quantity" class="col-12 form-control-label">Cantidad:</label>
                                        <div class="col-12 product-form-qty">
                                            <div class="quantity">
                                                <input type="number" inputmode="numeric" pattern="[0-9]*"
                                                       class="qty form-control qty-input" id="cantidad"
                                                       name="cantidad" value="0" min="1"
                                                       max="<?php echo $producto[0]->getProCantstock(); ?>">
                                                <div class="quantity-nav">
                                                    <div class="quantity-button quantity-up"><i
                                                                class="fas fa-caret-up fa-fw"></i></div>
                                                    <div class="quantity-button quantity-down"><i
                                                                class="fas fa-caret-down fa-fw"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group product-stock product-available col-12 col-sm-9 no-padding">
                                        <input type="submit" class="adc btn btn-warning" value="Sin Stock">
                                        <a href="shop.php" class="btn btn-outline-dark" title="Continúa Comprando"><i
                                                    class="mdi mdi-arrow-left"></i> Continúa Comprando</a>
                                    </div>
                                    <?php
                                }
                                ?>

                            </div>


                    </form>


                </div>
            </div>
        </div>
    </div>
    </div>
<?php
include_once "../structure/footer.php";
?>