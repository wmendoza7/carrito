<?php
  session_start();
  if(!isset($_SESSION['datos_login'])){
    header("Location: ./login.php");
  }
  $arregloUsuario = $_SESSION['datos_login'];
  if (!isset($_SESSION["carrito"])) {
    header('Location: ./');
  }
  $arreglo = $_SESSION["carrito"];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Checkout</title>
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
        <!-- <div class="row mb-5">
          <div class="col-md-12">
            <div class="border p-4 rounded" role="alert">
              Returning customer? <a href="#">Click here</a> to login
            </div>
          </div>
        </div> -->
        <div class="row">
          <div class="col-md-6">            
            <div class="row mb-5">
              <div class="col-md-12">
                <h2 class="h3 mb-3 text-black">Tu Orden</h2>
                <div class="p-3 p-lg-5 border">
                  <table class="table site-block-order-table mb-5">
                    <thead>
                      <th>Producto</th>
                      <th>Total</th>
                    </thead>
                    <tbody>
                      <?php 
                      $total = 0;
                      for ($i=0; $i < count($arreglo); $i++) { 
                        $total = $total + ($arreglo[$i]['Cantidad']*$arreglo[$i]['Precio']);?>
                      
                      <tr>
                        <td><?php echo $arreglo[$i]['Nombre']; ?><strong class="mx-2">x</strong> <?php echo $arreglo[$i]['Cantidad']; ?></td>
                        <td>$<?php echo $arreglo[$i]['Precio']; ?></td>
                      </tr>
                      <?php } ?>
                      <tr>
                        <td class="text-black font-weight-bold"><strong>Subtotal</strong></td>
                        <td class="text-black">$<?php echo $total; ?></td>
                      </tr>
                      <tr>
                        <td class="text-black font-weight-bold"><strong>Total Orden</strong></td>
                        <td class="text-black font-weight-bold"><strong>$<?php echo $total; ?></strong></td>
                      </tr>
                    </tbody>
                  </table>
                  <div class="form-group">
                    <button class="btn btn-primary btn-lg py-3 btn-block" onclick="terminar_compra()">Terminar Orden</button>
                  </div>

                </div>
              </div>
            </div>

          </div>
        </div>
        <!-- </form> -->
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
    function terminar_compra() {
      Swal.fire({
        title: '¿Desea terminar su compra?',
        showCancelButton: true,
        confirmButtonText: `Confirmar`
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
           window.location='thankyou.php';
        }
      });
    }
    
  </script>
    
  </body>
</html>