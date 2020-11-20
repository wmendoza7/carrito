<?php 
	include "functions.php";
	$functions = new functions();

	if (isset($_POST["nombre"]) && isset($_POST["precio"]) && isset($_POST["inventario"])) {
		extract($_POST);
		$carpeta = "../images/";
		$nombre_imagen = $_FILES["imagen"]["name"];
		$temp = explode('.', $nombre_imagen);
		$extension = end($temp);
		$nombreFinal = time().'.'.$extension;
		if($extension == "jpg" || $extension == "png"){
			if(move_uploaded_file($_FILES["imagen"]["tmp_name"], $carpeta.$nombreFinal)){
				$query = "INSERT INTO productos(nombre,precio,imagen,inventario) VALUES ('$nombre','$precio','$nombreFinal', '$inventario')";
				$res = $functions->insert_datos($query);
				echo "Se subio correctamente";
				header("Location: ../administrador/productos.php?success");
			}else{
				header("Location: ../administrador/productos.php?error=No se pudo subir la imagen.");
			}
		}else{
			header("Location: ../administrador/productos.php?error=Favor subir una imagen valida.");
		}

	}else{
		header("Location: ../administrador/productos.php?error=Favor llenar todos los campos.");
	}
?>