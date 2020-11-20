<?php 
  session_start();
  if (!isset($_SESSION["datos_login"])) {
    header("Location: ./login.php");
  }
  if($_SESSION["datos_login"]["nivel"] != "admin"){
    header("Location: ./");
  }
  $arregloUsuario = $_SESSION["datos_login"];
  include "../controller/functions.php";
  $functions = new functions();
  $productos = $functions->obtenerProductos();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Productos</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
  <link rel="stylesheet" type="text/css" href="plugins/sweetalert2/sweetalert2.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <?php include "./layouts/header.php"; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Productos</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <div class="float-sm-right">
              <button class="btn btn-primary" data-toggle="modal" data-target="#insertarModal"><i class="fas fa-plus mr-1"></i>Insertar producto</button>
            </div>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <?php if (isset($_GET["error"])) { ?>
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo $_GET["error"]; ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <?php } ?>
        <?php if (isset($_GET["success"])) { ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            Se ha guardado el producto correctamente.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <?php } ?>
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Imagen</th>
                <th>Inventario</th>
                <th>Funciones</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($productos as $key => $producto): ?>
                <tr>
                  <td><?php echo $producto["id"]; ?></td>
                  <td><?php echo $producto["nombre"]; ?></td>
                  <td><img class="img-fluid" style="max-width: 200px;" src="../images/<?php echo $producto["imagen"]; ?>"></td>
                  <td><?php echo $producto["inventario"]; ?></td>
                  <td>
                    <button class="btn btn-primary mr-1" data-toggle="modal" data-target="#editarModal" data-id="<?php echo $producto["id"]; ?>" data-nombre="<?php echo $producto["nombre"]; ?>" data-precio="<?php echo $producto["precio"]; ?>" data-inventario="<?php echo $producto["inventario"]; ?>"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-danger btnEliminar" data-id="<?php echo $producto["id"]; ?>"><i class="fas fa-trash-alt"></i></button></td>
                </tr>
              <?php endforeach ?>
            </tbody>
            <tfoot>
              <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Imagen</th>
                <th>Inventario</th>
                <th>Funciones</th>
              </tr>
            </tfoot>
          </table>
        </div>
        
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <!-- Modal Insertar Producto -->
    <div class="modal fade" id="insertarModal" tabindex="-1" aria-labelledby="insertarModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form action="../controller/insertarProducto.php" method="POST" enctype="multipart/form-data">
          <div class="modal-header">
            <h5 class="modal-title" id="insertarModalLabel">Insertar Producto</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="nombre">Nombre</label>
              <input type="text" name="nombre" placeholder="Nombre" id="nombre" class="form-control" required="">
            </div>
            <div class="form-group">
              <label for="precio">Precio</label>
              <input type="number" name="precio" min="0" id="precio" class="form-control" required="">
            </div>
            <div class="form-group">
              <label for="inventario">Inventario</label>
              <input type="number" name="inventario" min="0" id="inventario" class="form-control" required="">
            </div>
            <div class="form-group">
              <label for="imagen">Imagen</label>
              <input type="file" name="imagen" id="imagen" class="form-control" required="">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>
          </form>
        </div>
      </div>
    </div>
    <div class="modal fade" id="editarModal" tabindex="-1" aria-labelledby="editarModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form action="../controller/editarProducto.php" method="POST" enctype="multipart/form-data">
          <div class="modal-header">
            <h5 class="modal-title" id="editarModalLabel">Insertar Producto</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="nombre_edit">Nombre</label>
              <input type="hidden" name="id" id="id">
              <input type="text" name="nombre" placeholder="Nombre" id="nombre_edit" class="form-control">
            </div>
            <div class="form-group">
              <label for="precio_edit">Precio</label>
              <input type="number" name="precio" min="0" id="precio_edit" class="form-control">
            </div>
            <div class="form-group">
              <label for="inventario_edit">Inventario</label>
              <input type="number" name="inventario" min="0" id="inventario_edit" class="form-control">
            </div>
            <div class="form-group">
              <label for="imagen_edit">Imagen</label>
              <input type="file" name="imagen" id="imagen_edit" class="form-control">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- /.content-wrapper -->
  <?php include "./layouts/footer.php" ?>
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<script type="text/javascript">
  $('#editarModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var id = button.data('id');
    var nombre = button.data('nombre');
    var precio = button.data('precio');
    var inventario = button.data('inventario');
    var modal = $(this);
    modal.find('.modal-body input#id').val(id);
    modal.find('.modal-body input#nombre_edit').val(nombre);
    modal.find('.modal-body input#precio_edit').val(precio);
    modal.find('.modal-body input#inventario_edit').val(inventario);
  });
  $(".btnEliminar").click(function(event){
    event.Prevent
    var id =  $(this).data("id");
    var fila = $(this).parent("td").parent("tr");
    Swal.fire({
      icon: 'error',
      title: '¿Quieres eliminar este producto?',
      showCancelButton: true,
      confirmButtonText: `Eliminar`,
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          method: 'POST',
          url: '../controller/eliminarProducto.php',
          data: {id:id}
        }).done(function(res){
          if(res == "listo"){
            Swal.fire({
              icon: 'success',
              title: 'Eliminado',
              text: 'Producto eliminado con exito!'
            });
            $(fila).fadeOut(1000);
          }else{
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: 'No se pudo eliminar el producto.'
            });
          }
        });
      }
    });
  });
</script>
</body>
</html>
