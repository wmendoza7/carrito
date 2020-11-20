<?php 
	session_start();
	include('functions.php');
  	$functions = new functions();  
	if (isset($_SESSION["carrito"])) {
	    if(isset($_POST["id"])){
	      	$arreglo = $_SESSION["carrito"];
	      	$find = false;
	      	$n = 0;
	      	for($i=0; $i < count($arreglo,0); $i++) {
	        	if($arreglo[$i]["Id"] == $_POST["id"]){
	          		$find = true;
	          		$n = $i;
	        	}
	      	}
	      	if ($find == true) {
	        	$arreglo[$n]['Cantidad']=$arreglo[$n]['Cantidad']+$_POST["cantidad"];
	        	$_SESSION["carrito"] = $arreglo; 
	      	}else{
	        	$nombre = "";
	        	$precio = "";
	        	$imagen = "";
	        	$inventario = "";

	        	$fila = $functions->ObtenerProducto($_POST["id"])[0];

	        	$nombre = $fila["nombre"];
	        	$precio = $fila["precio"];
	        	$imagen = $fila["imagen"];
	        	$inventario = $fila["inventario"];
	        	$arregloNuevo = array(
		          	'Id' => $_POST["id"],
		          	'Nombre' => $nombre,
		          	'Precio' => $precio,
		          	'Imagen' => $imagen,
		          	'Inventario' => $inventario,
		          	'Cantidad' => $_POST["cantidad"]
		        );
	        	array_push($arreglo, $arregloNuevo);
	        	$_SESSION["carrito"]=$arreglo; 
	      	}
	    }
	}else{
	    if(isset($_POST["id"])){
	      	$nombre = "";
	      	$precio = "";
	      	$imagen = "";
	      	$inventario = "";

	      	$fila = $functions->ObtenerProducto($_POST["id"])[0];

	      	$nombre = $fila["nombre"];
	      	$precio = $fila["precio"];
	      	$imagen = $fila["imagen"];
	      	$inventario = $fila["inventario"];
	      	$arreglo[] =
		        array(
		          'Id' => $_POST["id"],
		          'Nombre' => $nombre,
		          'Precio' => $precio,
		          'Imagen' => $imagen,
		          'Inventario' => $inventario,
		          'Cantidad' => $_POST["cantidad"]
		    	);
	      	$_SESSION["carrito"]=$arreglo;
	    }
	}
	echo "ok";
?>