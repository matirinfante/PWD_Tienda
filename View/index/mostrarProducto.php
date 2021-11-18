<?php
include_once("../../config.php");

$sesion = new Session();
if (!$sesion->activa()) {
    header('location: login.php');
    exit();
}

$datos = data_submitted();

$controller = new ProductoController();
$producto = $controller->buscar($datos);
#var_dump($producto);

#include_once "../structure/header.php";
?>

<link rel="stylesheet" href="//stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
<script src="//stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
<script src="//cdn.jsdelivr.net/bootstrap.filestyle/1.1.0/js/bootstrap-filestyle.min.js"></script>



<div class="container">
    <div class="row">
        
        <div class="col-sm-12 col-md-12 col-lg-6 mb-4">
        
            <div class="">
                <div class="main-product-image space">
                    <div id="product-carousel" class="carousel slide">
                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item active">
                                <img src="<?php echo '../images/'.$producto[0]->getProimagen().".jpg";?>" alt="" class="w-100">
                            </div>
                    
                            </div>
                        </div>
                    </div>
                </div>
                
      
            </div>


        <div class="col-sm-12 col-md-12 col-lg-6">
        <div class="col-sm-12 card">
            <h1 class="product-name"><?php echo $producto[0]->getPronombre();?></h1>
            <form class="form-horizontal" action="#" method="post" enctype="multipart/form-data" name="buy">
                <div>

                    <!-- Product Price  -->
                    <div class="form-group row">
                    <div class="col-12">
                        <span class="precio" id="precio"><?php echo "$".$producto[0]->getProprecio();?></span> 
                    </div>
                    </div>

                
                    <div id="editorial" class="form-group row" style="visibility:visible;">
                    <label class="col-12 form-control-label ">Editorial: </label>
                    <div class="col-12">
                        <span class="sku_elem"><?php echo $producto[0]->getProeditorial();?></span>
                    </div>
                    </div>
                    

                    
                    <div id="autor" class="form-group row sku" style="visibility:visible;">
                    <label class="col-12 form-control-label nopaddingtop">Autor: </label>
                    <div class="col-12">
                        <span class="sku_elem"><?php echo $producto[0]->getProautor();?></span>
                    </div>
                    </div>
                    

                    
                    <div id="stock" class="form-group row">
                    <div class="col-12">
                        <label class="form-control-label">Disponibilidad:</label>
                        <span class="product-form-stock"><?php echo $producto[0]->getProCantstock();?></span>
                    </div>
                    </div>
                    

                    
                    <div class="form-group row">
                        <label class="col-12 form-control-label">Descripción:</label>
                        <div class="col-12 description">
                            <p data-children-count="0"><?php echo $producto[0]->getProdetalle();?><br></p>
                        </div>
                    </div>
                    
                    <!-- Available -->
                    <div class="row">

                        <?php 
                            if($producto[0]->getProCantstock() > 0){
                        ?>
                        <div class="form-group product-stock col-4 col-sm-3 no-padding">
                            <label for="Quantity" class="col-12 form-control-label">Cantidad:</label>
                            <div class="col-12 product-form-qty">
                                <div class="quantity">
                                    <input type="number" inputmode="numeric" pattern="[0-9]*" class="qty form-control qty-input" id="proprecio" name="proprecio" maxlength="7" min="1" value="1" max="<?php echo $producto[0]->getProCantstock();?>"><div class="quantity-nav"><div class="quantity-button quantity-up"><i class="fas fa-caret-up fa-fw"></i></div><div class="quantity-button quantity-down"><i class="fas fa-caret-down fa-fw"></i></div></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group product-stock col-12 col-sm-9 no-padding">
                            <input type="submit" class="adc btn btn-danger" value="Agregar al Carro">
                            <a href="shop.php" class="btn btn-back btn-sm" title="Continúa Comprando"><i class="mdi mdi-arrow-left"></i> Continúa Comprando</a>
                        </div>
                        <?php 
                            }else{
                        ?>
                        <div class="form-group product-stock col-4 col-sm-3 no-padding">
                            <label for="Quantity" class="col-12 form-control-label">Cantidad:</label>
                            <div class="col-12 product-form-qty">
                                <div class="quantity">
                                    <input type="number" inputmode="numeric" pattern="[0-9]*" class="qty form-control qty-input" id="proprecio" name="proprecio" value="0" min="1" max="<?php echo $producto[0]->getProCantstock();?>"><div class="quantity-nav"><div class="quantity-button quantity-up"><i class="fas fa-caret-up fa-fw"></i></div><div class="quantity-button quantity-down"><i class="fas fa-caret-down fa-fw"></i></div></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group product-stock product-available col-12 col-sm-9 no-padding">
                            <input type="submit" class="adc btn btn-warning" value="Sin Stock">
                            <a href="shop.php" class="btn btn-back btn-sm" title="Continúa Comprando"><i class="mdi mdi-arrow-left"></i> Continúa Comprando</a>
                        </div>
                        <?php 
                            }
                        ?>

                </div>

                
            </form>


    

    </div>
</div>

<?php
#include_once "../structure/footer.php";
?>