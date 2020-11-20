<?php 
  session_start();
  include('./controller/functions.php');
  $functions = new functions();
  if(!isset($_SESSION['datos_login'])){
    header("Location: ./login.php");
  }
  $arregloUsuario = $_SESSION['datos_login'];
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <title>Harry Books</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mukta:300,400,700"> 
    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/style.css">
    
  </head>
  <body>
  
  <div class="site-wrap">
    <?php include("./layouts/header.php"); ?> 

    <div class="site-section">
      <div class="container">

        <div class="row mb-5">
          <div class="col-md-12">
            <div class="row mb-5">
              <?php 
                $productos = $functions->obtenerProductos();
                foreach ($productos as $prod => $producto) { ?>
                  <div class="col-sm-6 col-lg-4 mb-4" data-aos="fade-up">
                    <div class="block-4 text-center border">
                      <figure class="block-4-image">
                        <img src="images/<?php echo $producto['imagen']; ?>" alt="<?php echo $producto['imagen']; ?>" class="img-fluid">
                      </figure>
                      <div class="block-4-text p-4">
                        <h3><a href="shop-single.php"><?php echo $producto["nombre"]; ?></a></h3>
                        <p class="mb-0">Cantidad disponible: <span class="text-primary font-weight-bold"><?php if($producto["inventario"] > 0){ echo $producto["inventario"]; }else{ echo "Agotado"; }?></span></p>
                        <p class="text-primary font-weight-bold"><?php echo '$'.$producto["precio"]; ?></p>
                        <div class="mb-3">
                          <?php if($producto["inventario"] > 0){ ?>
                            <div class="input-group mx-auto mb-3" style="max-width: 120px;">
                              <div class="input-group-prepend">
                                <button class="btn btn-outline-primary js-btn-minus" type="button">−</button>
                              </div>
                              <input type="text" class="form-control text-center" id="cantidad<?php echo $producto["id"]; ?>" data-inventario="<?php echo $producto["inventario"]; ?>" value="1" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                              <div class="input-group-append">
                                <button class="btn btn-outline-primary js-btn-plus" type="button">+</button>
                              </div>
                            </div>
                          <?php }  ?>
                        </div>
                        <p><a href="" class="buy-now btn btn-sm btn-primary <?php if($producto['inventario'] <= 0){ echo 'disabled'; } ?>" data-id="<?php echo $producto["id"]; ?>" >Agregar</a></p>
                      </div>
                    </div>
                  </div>
              <?php } ?>
            </div>
          </div>
        </div>        
      </div>
    </div>
    <?php include("./layouts/footer.php"); ?> 
  </div>

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.js"></script>
  <script src="js/main.js"></script>
    
  </body>
</html>