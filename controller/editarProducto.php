<?php 
	include "functions.php";
	$functions = new functions();

	if (isset($_POST["nombre"]) && isset($_POST["precio"]) && isset($_POST["inventario"])) {
		extract($_POST);
		if ($_FILES["imagen"]["name"] != "") {	
			$carpeta = "../images/";
			$nombre_imagen = $_FILES["imagen"]["name"];
			$temp = explode('.', $nombre_imagen);
			$extension = end($temp);
			$nombreFinal = time().'.'.$extension;
			if($extension == "jpg" || $extension == "png"){
				if(move_uploaded_file($_FILES["imagen"]["tmp_name"], $carpeta.$nombreFinal)){
					$res = $functions->obtenerProducto($id);
					if (file_exists("../images/".$res[0]["imagen"])) {
						unlink("../images/".$res[0]["imagen"]);
					}
					$query = "UPDATE productos SET imagen = '$nombreFinal' WHERE id = $id";
					$res = $functions->insert_datos($query);
				}
			}
		}
		$update = "UPDATE productos SET nombre = '$nombre', precio = $precio, inventario = $inventario WHERE id = $id";
		$res = $functions->insert_datos($update);
		header("Location: ../administrador/productos.php?success");
	}else{
		header("Location: ../administrador/productos.php?error=Favor llenar todos los campos.");
	}
?>