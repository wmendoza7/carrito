<?php 
  session_start();
  if(!isset($_SESSION['datos_login'])){
    header("Location: ./login.php");
  }
  $arregloUsuario = $_SESSION['datos_login'];
?>
<!DOCTYPE html>
<html lang="en">
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
          <form class="col-md-12" method="post">
            <div class="site-blocks-table">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th class="product-thumbnail">Imagen</th>
                    <th class="product-name">Producto</th>
                    <th class="product-price">Precio</th>
                    <th class="product-quantity">Cantidad</th>
                    <th class="product-total">Total</th>
                    <th class="product-remove">Eliminar</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $total = 0;
                    if (isset($_SESSION["carrito"])) {
                      $carrito = $_SESSION["carrito"];
                      for($i=0; $i<count($carrito); $i++) {
                      $total = $total + ($carrito[$i]["Precio"] * $carrito[$i]["Cantidad"]); ?>
                  <tr>
                    <td class="product-thumbnail">
                      <img src="images/<?php echo $carrito[$i]["Imagen"]; ?>" alt="Image" class="img-fluid">
                    </td>
                    <td class="product-name">
                      <h2 class="h5 text-black"><?php echo $carrito[$i]["Nombre"]; ?></h2>
                    </td>
                    <td>$<?php echo $carrito[$i]["Precio"]; ?></td>
                    <td>
                      <div class="input-group mb-3" style="max-width: 120px;">
                        <div class="input-group-prepend">
                          <button class="btn btn-outline-primary js-btn-minus btnCantidad" type="button">&minus;</button>
                        </div>
                        <input type="text" class="form-control text-center txtCantidad" data-precio="<?php echo $carrito[$i]["Precio"]; ?>" data-id="<?php echo $carrito[$i]["Id"]; ?>" value="<?php echo $carrito[$i]["Cantidad"]; ?>" data-inventario="<?php echo $carrito[$i]["Inventario"]; ?>" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                        <div class="input-group-append">
                          <button class="btn btn-outline-primary js-btn-plus btnCantidad" type="button">&plus;</button>
                        </div>
                      </div>
                    </td>
                    <td id="total<?php echo $carrito[$i]["Id"]; ?>">$<?php echo $carrito[$i]["Precio"] * $carrito[$i]["Cantidad"]; ?></td>
                    <td><a href="#" class="btn btn-danger btn-sm btnRemove" data-id="<?php echo $carrito[$i]["Id"]; ?>">X</a></td>
                  </tr>
                  <?php }
                  } ?>
                </tbody>
              </table>
            </div>
          </form>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="row mb-5">
              <div class="col-md-6">
                <a href="./" class="btn btn-outline-primary btn-sm btn-block">Continuar Comprando</a>
              </div>
              <div class="col-md-6">
                <button class="btn btn-outline-danger btn-sm btn-block cancelarCompra">Cancelar Compra</button>
              </div>
            </div>
          </div>
          <div class="col-md-6 pl-5">
            <div class="row justify-content-end">
              <div class="col-md-7">
                <div class="row">
                  <div class="col-md-12 text-right border-bottom mb-5">
                    <h3 class="text-black h4 text-uppercase">Totales</h3>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-md-6">
                    <span class="text-black">Subtotal</span>
                  </div>
                  <div class="col-md-6 text-right">
                    <strong class="text-black txtSubtotal">$<?php echo $total; ?></strong>
                  </div>
                </div>
                <div class="row mb-5">
                  <div class="col-md-6">
                    <span class="text-black">Total</span>
                  </div>
                  <div class="col-md-6 text-right">
                    <strong class="text-black txtTotal">$<?php echo $total; ?></strong>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <button class="btn btn-primary btn-lg py-3 btn-block" onclick="confirmarCompra()">Confirmar compra</button>
                  </div>
                </div>
              </div>
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
  <script type="text/javascript">
    function confirmarCompra(){
      Swal.fire({
        title: '¿Desea confirmar su compra?',
        showCancelButton: true,
        confirmButtonText: `Confirmar`
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
          window.location='checkout.php';
        }
      });
    }
  </script>
  </body>
</html>